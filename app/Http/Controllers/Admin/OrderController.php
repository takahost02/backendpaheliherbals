<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Constants\Status;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RepurchaseCommissionSetting;
use App\Models\CommissionLog;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index($userId = null)
    {
        $pageTitle = 'Orders';
        $orders    = Order::searchable(['trx', 'user:username', 'product:name']);
        if ($userId) {
            $orders = $orders->where('user_id', $userId);
        }
        $orders = $orders->with('product', 'user')->orderBy('id', 'desc')->paginate(getPaginate());

        $emptyMessage = 'Order not found';
        return view('admin.orders', compact('pageTitle', 'orders', 'emptyMessage'));
    }

    public function status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:1,2'
        ]);

        $order   = Order::where('status', Status::ORDER_PENDING)->findOrFail($id);
        $product = $order->product;
        $user    = $order->user;

        if ($request->status == Status::ORDER_SHIPPED) {
            // ✅ Mark shipped
            $order->status = Status::ORDER_SHIPPED;
            $details       = $product->name . ' product repurchase';
            updateBV($user->id, $product->bv, $details);

            // ✅ Repurchase Commission distribution
            $this->repurchaseCommission($user, $order->total_price, $details);

            $template = 'ORDER_SHIPPED';
        } else {
            // ❌ Cancel order
            $order->status  = Status::ORDER_CANCELED;
            $user->balance += $order->total_price;
            $user->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->total_price;
            $transaction->post_balance = $user->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->details      = $product->name . ' Order cancel';
            $transaction->trx          = $order->trx;
            $transaction->save();

            $product->quantity += $order->quantity;
            $product->save();

            $template = 'ORDER_CANCELED';
        }

        $order->save();

        notify($user, $template, [
            'product_name' => $product->name,
            'quantity'     => $request->quantity,
            'price'        => showAmount($product->price, currencyFormat: false),
            'total_price'  => showAmount($order->total_price, currencyFormat: false),
            'trx'          => $order->trx,
        ]);

        $notify[] = ['success', 'Product status updated successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Distribute Repurchase Commission up the upline
     */
    protected function repurchaseCommission(User $buyer, float $amount, string $details)
    {
        $setting = RepurchaseCommissionSetting::first();
        if (!$setting || !$setting->commissions) {
            return;
        }

        $commissionLevels = is_array($setting->commissions)
            ? $setting->commissions
            : json_decode($setting->commissions, true);

        if (!is_array($commissionLevels)) {
            return;
        }

        // get uplines (exclude buyer)
        $uplines = $this->getPlacementUplineFor($buyer->id, false);

        $level = 1;
        foreach ($uplines as $upline) {
            if (!isset($commissionLevels[$level])) {
                break; // stop if no commission config for this level
            }

            $percent = $commissionLevels[$level];
            $commissionAmount = ($amount * $percent) / 100;

            if ($commissionAmount > 0) {
                $uplineUser = User::find($upline->id);
                if ($uplineUser) {
                    // update balance + repurchase total
                    $uplineUser->balance += $commissionAmount;
                    $uplineUser->total_repurchase_com += $commissionAmount;
                    $uplineUser->save();

                    // Transaction
                    Transaction::create([
                        'user_id'      => $uplineUser->id,
                        'amount'       => $commissionAmount,
                        'post_balance' => $uplineUser->balance,
                        'trx_type'     => '+',
                        'trx'          => getTrx(),
                        'remark'       => 'repurchase_commission',
                        'details'      => 'Level ' . $level . ' Repurchase commission from ' . $buyer->username . '. ' . $details,
                    ]);

                    // Log
                    CommissionLog::create([
                        'user_id'         => $uplineUser->id,
                        'type'            => 'repurchase',
                        'amount'          => $commissionAmount,
                        'details'         => 'Level ' . $level . ' Repurchase commission from ' . $buyer->username . '. ' . $details,
                        'source_username' => $buyer->username,
                        'level'           => $level,
                    ]);
                }
            }

            $level++;
        }
    }

    /**
     * Placement Upline Helper (recursive SQL or fallback)
     */
    protected function getPlacementUplineFor(int $userId, bool $includeSelf = true): array
    {
        $cols = 'id, ref_by, pos_id, position, level, firstname, username';

        $sql = "
            WITH RECURSIVE upline AS (
                SELECT $cols
                FROM users
                WHERE id = ?

                UNION ALL

                SELECT u.$cols
                FROM users u
                INNER JOIN upline d ON u.id = d.pos_id
            )
            SELECT * FROM upline
        ";

        try {
            $all = DB::select($sql, [$userId]);
        } catch (\Throwable $e) {
            $all = [];
        }

        if (!$includeSelf) {
            $all = array_values(array_filter($all, fn($r) => (int)$r->id !== $userId));
        }

        return $all;
    }
}
