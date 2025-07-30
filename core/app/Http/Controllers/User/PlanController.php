<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use App\Models\Plan;
use App\Models\User;
use App\Models\BvLog;
use App\Models\UserExtra;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommissionSetting;
use App\Models\CommissionLog;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PlanController extends Controller
{
    /**
     * Show all available plans
     */
    public function planIndex()
    {
        $pageTitle = "Plans";
        $plans = Plan::orderBy('price', 'asc')->active()->get();
        return view('Template::user.plan', compact('pageTitle', 'plans'));
    }

    /**
     * Handle plan purchase
     */
    public function planStore(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer',
        ]);
    
        $plan = Plan::active()->where('id', $request->plan_id)->first();
    
        if (!$plan) {
            $notify[] = ['error', 'The plan is currently unavailable'];
            return back()->withNotify($notify);
        }
    
        $user = auth()->user();
    
        if ($user->balance < $plan->price) {
            $notify[] = ['error', 'Insufficient Balance'];
            return back()->withNotify($notify);
        }
    
        $oldPlan = $user->plan_id;
    
        // Deduct balance and update plan
        $user->plan_id = $plan->id;
        $user->balance -= $plan->price;
        $user->total_invest += $plan->price;
        $user->save();
    
        // Transaction log
        $trx = new Transaction();
        $trx->user_id = $user->id;
        $trx->amount = $plan->price;
        $trx->trx_type = '-';
        $trx->details = 'Purchased ' . $plan->name;
        $trx->remark = 'purchased_plan';
        $trx->trx = getTrx();
        $trx->post_balance = $user->balance;
        $trx->save();
    
        // Notify user
        notify($user, 'PLAN_PURCHASED', [
            'plan' => $plan->name,
            'amount' => showAmount($plan->price, false),
            'trx' => $trx->trx,
            'post_balance' => showAmount($user->balance, false),
        ]);
    
        if ($oldPlan == 0) {
            updatePaidCount($user->id);
        }
    
        $details = $user->username . ' Subscribed to ' . $plan->name . ' plan.';
    
        // Business volume update
        updateBV($user->id, $plan->bv, $details);
    
        // Tree Commission
        if ($plan->tree_com > 0) {
            treeComission($user->id, $plan->tree_com, $details);
    
            CommissionLog::create([
                'user_id'         => $user->ref_by ?? null,
                'type'            => 'tree',
                'amount'          => $plan->tree_com,
                'details'         => 'Tree commission from ' . $user->username,
                'source_username' => $user->username,
            ]);
        }
    
        // Referral Commission (direct sponsor commission)
        $this->referralCommission($user->id, $plan->price, $details);
    
        // Level commissions (multi-level commissions)
        $this->levelCommission($user->id, $plan->price, $details);
    
        $notify[] = ['success', 'Purchased ' . $plan->name . ' successfully'];
        return back()->withNotify($notify);
    }
    
    /**
     * Handle direct referral commission (for sponsor)
     */
    protected function referralCommission($userId, $amount, $details)
    {
        $setting = CommissionSetting::find(1);
        if (!$setting || !$setting->referral_commission) return;
    
        $referralPercent = $setting->referral_commission;
        $commissionAmount = ($amount * $referralPercent) / 100;
    
        $user = User::find($userId);
        if (!$user || !$user->ref_by) return;
    
        $referralUser = User::find($user->ref_by);
        if (!$referralUser) return;
    
        $referralUser->balance += $commissionAmount;
        $referralUser->total_ref_com += $commissionAmount;
        $referralUser->save();
    
        // Create transaction
        Transaction::create([
            'user_id'      => $referralUser->id,
            'amount'       => $commissionAmount,
            'post_balance' => $referralUser->balance,
            'trx_type'     => '+',
            'trx'          => getTrx(),
            'remark'       => 'referral_commission',
            'details'      => 'Referral commission from ' . $user->username . '. ' . $details
        ]);
    
        // Log the commission
        CommissionLog::create([
            'user_id'         => $referralUser->id,
            'type'            => 'referral',
            'amount'          => $commissionAmount,
            'details'         => 'Referral commission from ' . $user->username . '. ' . $details,
            'source_username' => $user->username,
        ]);
    }
    
    /**
     * Handle level commission distribution with logging
     */
    protected function levelCommission($userId, $amount, $details)
    {
        $setting = CommissionSetting::find(1);
        if (!$setting || !$setting->commissions) return;
    
        $commissionLevels = is_array($setting->commissions)
            ? $setting->commissions
            : json_decode($setting->commissions, true);
    
        if (!is_array($commissionLevels)) return;
    
        $currentUser = User::find($userId);
        if (!$currentUser) return;
    
        $upline = $currentUser->ref_by;
    
        for ($level = 1; $level <= 15; $level++) {
            if (!$upline || !isset($commissionLevels[$level])) break;
    
            $percent = $commissionLevels[$level];
            $commissionAmount = ($amount * $percent) / 100;
    
            $uplineUser = User::find($upline);
            if ($uplineUser) {
                $uplineUser->balance += $commissionAmount;
                $uplineUser->total_level_com += $commissionAmount;
                $uplineUser->save();
    
                Transaction::create([
                    'user_id'      => $uplineUser->id,
                    'amount'       => $commissionAmount,
                    'post_balance' => $uplineUser->balance,
                    'trx_type'     => '+',
                    'trx'          => getTrx(),
                    'remark'       => 'level_commission',
                    'details'      => 'Level ' . $level . ' Commission From ' . $currentUser->username . '. ' . $details
                ]);
    
                CommissionLog::create([
                    'user_id'         => $uplineUser->id,
                    'type'            => 'level',
                    'amount'          => $commissionAmount,
                    'level'           => $level,
                    'details'         => 'Level ' . $level . ' Commission From ' . $currentUser->username . '. ' . $details,
                    'source_username' => $currentUser->username,
                ]);
            }
    
            $upline = $uplineUser ? $uplineUser->ref_by : null;
        }
    }


    public function binaryCom()
    {
        $pageTitle    = "Binary Commission";
        $logs         = Transaction::where('user_id', auth()->id())->where('remark', 'binary_commission')->orderBy('id', 'DESC')->paginate(getPaginate());
        $emptyMessage = 'No data found';
        return view('Template::user.transactions', compact('pageTitle', 'logs', 'emptyMessage'));
    }

    public function binarySummery()
    {
        $pageTitle = "Binary Summary";
        $logs      = UserExtra::where('user_id', auth()->id())->firstOrFail();
        $log      = User::where('id', auth()->id())->firstOrFail();
        return view('Template::user.binarySummery', compact('pageTitle', 'logs', 'log'));
    }
    
    public function binaryIncome()
    {
        $pageTitle = "Binary Income";
        $transactions = Transaction::where('user_id', auth()->id())
                                ->where('remark', 'binary_commission')
                                ->latest()
                                ->paginate(getPaginate());
        
        return view('Template::user.binaryIncome', compact('pageTitle', 'transactions'));
    }
    
    public function RefferalIncome()
    {
        $pageTitle = "Refferal Income";
        
        $logs = User::where('ref_by', auth()->id())
            ->leftJoin('commission_logs', function($join) {
                $join->on('users.id', '=', 'commission_logs.user_id')
                     ->where('commission_logs.type', '=', 'referral');
            })
            ->select('users.*', 'commission_logs.amount as commission_amount', 'commission_logs.created_at as commission_date')
            ->latest('users.created_at')
            ->paginate(getPaginate());
        
        return view('Template::user.refferalIncome', compact('pageTitle', 'logs'));
    }
    
    public function SponsorIncome()
    {
        $pageTitle = "Sponsor Royalty Income";
        $logs      = UserExtra::where('user_id', auth()->id())->firstOrFail();
        $log      = User::where('id', auth()->id())->firstOrFail();
        return view('Template::user.sponsorIncome', compact('pageTitle', 'logs', 'log'));
    }
    
    public function MatrixIncome()
    {
        $pageTitle = "Matrix Income";
        
        // Get all level commissions for the authenticated user
        $commissions = CommissionLog::where('user_id', auth()->id())
            ->where('type', 'level')
            ->with('sourceUser') // assuming you have this relationship
            ->latest()
            ->paginate(getPaginate());
        
        return view('Template::user.matrixIncome', compact('pageTitle', 'commissions'));
    }

    public function bvlog(Request $request)
    {
        if ($request->type) {
            if ($request->type == 'leftBV') {
                $pageTitle = "Left BV";
            } elseif ($request->type == 'rightBV') {
                $pageTitle = "Right BV";
            } elseif ($request->type == 'cutBV') {
                $pageTitle = "Cut BV";
            } else {
                $pageTitle = "All Paid BV";
            }

            $logs = $this->bvData($request->type);
        } else {
            $pageTitle = "BV Log";
            $logs      = $this->bvData();
        }

        $logs = $logs->where('user_id', auth()->id())->latest('id')->paginate(getPaginate());

        return view('Template::user.bvLog', compact('pageTitle', 'logs'));
    }

    protected function bvData($scope = null)
    {
        if ($scope) {
            $logs = BvLog::$scope();
        } else {
            $logs = BvLog::query();
        }
        return $logs;
    }

    public function myRefLog()
    {
        $pageTitle = "My Referral";
        $logs      = User::where('ref_by', auth()->id())->latest()->paginate(getPaginate());
        return view('Template::user.myRef', compact('pageTitle', 'logs'));
    }
    
    public function myTree()
    {
        $tree      = showTreePage(auth()->user()->id);
        $pageTitle = "My Tree";
        $user      = auth()->user();
        return view('Template::user.myTree', compact('pageTitle', 'tree', 'user'));
    }
    
    public function myTeam(Request $request)
    {
        $pageTitle = "My Team";
        $userId    = auth()->id();
    
        // Get all downline including self
        $rows = $this->getPlacementDownlineFor($userId, true);
    
        // Convert to collection and sort
        $rows = collect($rows)->sortBy([
            ['level', 'asc'],
            ['id', 'asc'],
        ])->values();
    
        // Remove self (id == auth user id)
        $rows = $rows->reject(function ($item) use ($userId) {
            return (int) $item->id === $userId;
        })->values();
    
        $lookupIds = $rows->pluck('ref_by')
            ->merge($rows->pluck('pos_id'))
            ->filter(function ($v) { return (int) $v > 0; })
            ->unique()
            ->values();
    
        // Fetch once
        $nameLookup = DB::table('users')
            ->whereIn('id', $lookupIds)
            ->get(['id', 'firstname', 'username'])
            ->mapWithKeys(function ($u) {
                return [
                    (int) $u->id => sprintf('%s (%s)', $u->firstname, $u->username),
                ];
            });
    
        // Attach friendly labels
        $rows = $rows->map(function ($item) use ($nameLookup) {
            $refId = (int) ($item->ref_by ?? 0);
            $posId = (int) ($item->pos_id ?? 0);
    
            $item->ref_by_label = $nameLookup[$refId] ?? '-';
            $item->pos_id_label = $nameLookup[$posId] ?? '-';
    
            return $item;
        });
    
        // Paginate the filtered/enriched collection
        $logs = $this->paginateCollection($rows, getPaginate());
    
        return view('Template::user.myTeam', compact('pageTitle', 'logs'));
    }
    
    protected function getPlacementDownlineFor(int $userId, bool $includeSelf = true): array
    {
        $cols = 'id, ref_by, pos_id, position, level, firstname, username';
    
        $sql = "
            WITH RECURSIVE downline AS (
                SELECT $cols
                FROM users
                WHERE id = ?
    
                UNION ALL
    
                SELECT u.$cols
                FROM users u
                INNER JOIN downline d ON u.pos_id = d.id
            )
            SELECT * FROM downline
        ";
    
        try {
            $all = DB::select($sql, [$userId]);
        } catch (\Throwable $e) {
            $all = $this->fallbackPlacementDownline($userId, $includeSelf);
        }
    
        if (!$includeSelf) {
            $all = array_values(array_filter($all, fn ($r) => (int)$r->id !== $userId));
        }
    
        return $all;
    }
    
    protected function fallbackPlacementDownline(int $userId, bool $includeSelf = true): array
    {
        $selectCols = ['id','ref_by','pos_id','position','level','firstname','username'];
    
        $queue = new \SplQueue();
        $all   = [];
    
        $root = DB::table('users')->select($selectCols)->where('id', $userId)->first();
        if ($root) {
            if ($includeSelf) {
                $all[] = $root;
            }
            $queue->enqueue($root->id);
        }
    
        while (!$queue->isEmpty()) {
            $pid = $queue->dequeue();
            $children = DB::table('users')->select($selectCols)->where('pos_id', $pid)->get();
            foreach ($children as $c) {
                $all[] = $c;
                $queue->enqueue($c->id);
            }
        }
    
        return $all;
    }
    
    protected function paginateCollection(Collection $items, int $perPage, string $pageName = 'page')
    {
        $page = LengthAwarePaginator::resolveCurrentPage($pageName);
        $slice = $items->slice(($page - 1) * $perPage, $perPage)->values();
    
        return new LengthAwarePaginator(
            $slice,
            $items->count(),
            $perPage,
            $page,
            [
                'path'  => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

}
