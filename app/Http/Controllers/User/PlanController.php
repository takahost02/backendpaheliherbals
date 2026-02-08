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
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class PlanController extends Controller
{

    public function planIndex()
    {
        $pageTitle = "Plans";
        $plans = Plan::orderBy('price', 'asc')->active()->get();
        return view('Template::user.plan', compact('pageTitle', 'plans'));
    }

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
            // treeComission($user->id, $plan->tree_com, $details);

            CommissionLog::create([
                'user_id'         => $user->ref_by ?? null,
                'type'            => 'tree',
                'amount'          => $plan->tree_com,
                'details'         => 'Tree commission from ' . $user->username,
                'source_username' => $user->username,
            ]);
        }

        // Referral Commission (direct sponsor commission)
        $this->referralCommission($user->id, $plan->id, $details);
        // Matching Commission Distribution
        // Matching Commission

        // Matching Commission for uplines
        $this->matchingCommissionForUplines($user->id, $plan->bv, $details);


        $notify[] = ['success', 'Purchased ' . $plan->name . ' successfully'];
        return back()->withNotify($notify);
    }

    protected function referralCommission($userId, $planId, $details)
    {
        $user = User::find($userId);
        if (!$user || !$user->ref_by) return;

        $plan = Plan::find($planId);
        if (!$plan || $plan->ref_com <= 0) return;

        $commissionAmount = $plan->ref_com;

        $referralUser = User::find($user->ref_by);
        if (!$referralUser) return;

        // Update both totals for referral
        $referralUser->balance += $commissionAmount;
        $referralUser->total_ref_com += $commissionAmount;
        $referralUser->save();

        // Transaction
        Transaction::create([
            'user_id'      => $referralUser->id,
            'amount'       => $commissionAmount,
            'post_balance' => $referralUser->balance,
            'trx_type'     => '+',
            'trx'          => getTrx(),
            'remark'       => 'referral_commission',
            'details'      => 'Referral commission from ' . $user->username . '. ' . $details
        ]);

        // Log
        CommissionLog::create([
            'user_id'         => $referralUser->id,
            'type'            => 'referral',
            'amount'          => $commissionAmount,
            'details'         => 'Referral commission from ' . $user->username . '. ' . $details,
            'source_username' => $user->username,
        ]);

        // Call levelCommission starting from Level 2 to avoid double-paying Level 1
        $this->levelCommission($userId, $plan->price, $details, true);
    }


    protected function levelCommission($userId, $amount, $details, $skipLevel1 = false)
    {
        $setting = CommissionSetting::find(1);
        if (!$setting || !$setting->commissions) return;

        $commissionLevels = is_array($setting->commissions)
            ? $setting->commissions
            : json_decode($setting->commissions, true);

        if (!is_array($commissionLevels)) return;

        $currentUser = User::find($userId);
        if (!$currentUser) return;

        // get upline
        $upline = $this->getPlacementUplineFor($userId, true);

        $rows = collect($upline)->reject(fn($item) => (int) $item->id === $userId)->values();

        $lookupIds = $rows->pluck('ref_by')
            ->merge($rows->pluck('pos_id'))
            ->filter(fn($v) => (int) $v > 0)
            ->unique()
            ->values();

        $nameLookup = DB::table('users')
            ->whereIn('id', $lookupIds)
            ->get(['id', 'firstname', 'username'])
            ->mapWithKeys(fn($u) => [
                (int) $u->id => sprintf('%s (%s)', $u->firstname, $u->username),
            ]);

        $rows = $rows->values()->map(function ($item, $index) use ($nameLookup) {
            $refId = (int) ($item->ref_by ?? 0);
            $posId = (int) ($item->pos_id ?? 0);

            $item->ref_by_label = $nameLookup[$refId] ?? '-';
            $item->pos_id_label = $nameLookup[$posId] ?? '-';

            $item->level = $index + 2; // calculation level

            return $item;
        });

        foreach ($rows as $item) {
            $level = $item->level;

            if (!isset($commissionLevels[$level])) {
                continue; // no commission configured for this level
            }

            $percent = $commissionLevels[$level];
            $commissionAmount = ($amount * $percent) / 100;

            $uplineUser = User::find($item->id);
            if (!$uplineUser || $commissionAmount <= 0) continue;

            // ↓↓↓ Display level decreased by 1 ↓↓↓
            $displayLevel = $level - 1;

            $remark = 'level_commission';
            $detailsText = 'Level ' . $displayLevel . ' Commission From ' . $currentUser->username . '. ' . $details;
            $logType = 'level';

            $uplineUser->total_level_com += $commissionAmount;
            $uplineUser->balance += $commissionAmount;
            $uplineUser->save();

            Transaction::create([
                'user_id'      => $uplineUser->id,
                'amount'       => $commissionAmount,
                'post_balance' => $uplineUser->balance,
                'trx_type'     => '+',
                'trx'          => getTrx(),
                'remark'       => $remark,
                'details'      => $detailsText
            ]);

            CommissionLog::create([
                'user_id'         => $uplineUser->id,
                'type'            => $logType,
                'amount'          => $commissionAmount,
                'details'         => $detailsText,
                'source_username' => $currentUser->username,
                'level'           => $displayLevel, // also store decreased level
            ]);
        }
    }


    public function myupline(Request $request)
    {
        $pageTitle = "My Upline";
        $userId    = auth()->id();

        // Get all upline including self
        $rows = $this->getPlacementUplineFor($userId, true);

        // Convert to collection and sort (root/top most first)
        $rows = collect($rows)->sortBy([
            ['level', 'asc'],
            ['id', 'asc'],
        ])->values();

        // Remove self (id == auth user id)
        $rows = $rows->reject(function ($item) use ($userId) {
            return (int) $item->id === $userId;
        })->values();

        // Lookup names for ref_by and pos_id
        $lookupIds = $rows->pluck('ref_by')
            ->merge($rows->pluck('pos_id'))
            ->filter(function ($v) {
                return (int) $v > 0;
            })
            ->unique()
            ->values();

        $nameLookup = DB::table('users')
            ->whereIn('id', $lookupIds)
            ->get(['id', 'firstname', 'username'])
            ->mapWithKeys(function ($u) {
                return [
                    (int) $u->id => sprintf('%s (%s)', $u->firstname, $u->username),
                ];
            });

        $total = $rows->count();
        $rows = $rows->values()->map(function ($item, $index) use ($total, $nameLookup) {
            $refId = (int) ($item->ref_by ?? 0);
            $posId = (int) ($item->pos_id ?? 0);

            $item->ref_by_label = $nameLookup[$refId] ?? '-';
            $item->pos_id_label = $nameLookup[$posId] ?? '-';

            // Reverse level: bottom=1, top=$total
            $item->level = $total - $index;

            return $item;
        });

        // Paginate
        $logs = $this->paginateCollection($rows, getPaginate());

        return view('Template::user.myUpline', compact('pageTitle', 'logs'));
    }


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
            $all = $this->fallbackPlacementUpline($userId, $includeSelf);
        }

        if (!$includeSelf) {
            $all = array_values(array_filter($all, fn($r) => (int)$r->id !== $userId));
        }

        return $all;
    }

    protected function fallbackPlacementUpline(int $userId, bool $includeSelf = true): array
    {
        $selectCols = ['id', 'ref_by', 'pos_id', 'position', 'level', 'firstname', 'username'];
        $all = [];

        $current = DB::table('users')->select($selectCols)->where('id', $userId)->first();
        if ($current) {
            if ($includeSelf) {
                $all[] = $current;
            }

            // walk upward until no pos_id
            $pid = $current->pos_id;
            while ($pid) {
                $parent = DB::table('users')->select($selectCols)->where('id', $pid)->first();
                if (!$parent) break;

                $all[] = $parent;
                $pid = $parent->pos_id;
            }
        }

        return $all;
    }


    public function binaryCom()
    {
        $pageTitle    = "Binary Commission";
        $logs         = Transaction::where('user_id', auth()->id())->where('remark', 'binary_commission')->orderBy('id', 'DESC')->paginate(getPaginate());
        $emptyMessage = 'No data found';
        return view('Template::user.transactions', compact('pageTitle', 'logs', 'emptyMessage'));
    }

    protected function matchingCommissionForUplines(int $userId, float $planBV, string $details)
    {
        $upline = $this->getPlacementUplineFor($userId, true);

        // Remove the purchaser themselves
        $upline = collect($upline)->reject(fn($u) => (int)$u->id === $userId);

        foreach ($upline as $item) {
            $uplineUserId = $item->id;

            // 12 PM / 12 AM split
            $todayStart = now()->startOfDay();
            $noonTime   = now()->setTime(12, 0);
            $todayEnd   = now()->endOfDay();

            // BV sums for left/right
            $leftBVMorning  = BvLog::where('user_id', $uplineUserId)->where('position', 1)->where('trx_type', '+')->whereBetween('created_at', [$todayStart, $noonTime])->sum('amount');
            $rightBVMorning = BvLog::where('user_id', $uplineUserId)->where('position', 2)->where('trx_type', '+')->whereBetween('created_at', [$todayStart, $noonTime])->sum('amount');

            $leftBVEvening  = BvLog::where('user_id', $uplineUserId)->where('position', 1)->where('trx_type', '+')->whereBetween('created_at', [$noonTime, $todayEnd])->sum('amount');
            $rightBVEvening = BvLog::where('user_id', $uplineUserId)->where('position', 2)->where('trx_type', '+')->whereBetween('created_at', [$noonTime, $todayEnd])->sum('amount');

            // First half (12 PM)
            $firstHalfPair = min(2, min($leftBVMorning, $rightBVMorning));

            // Second half (12 AM)
            $secondHalfPair = min(2, min($leftBVEvening, $rightBVEvening));

            $pairMatch = $firstHalfPair + $secondHalfPair;
            $dailyCap = 4;
            $effectivePairs = min($pairMatch, $dailyCap);

            $pairIncome = 750;
            $matchingCommission = $effectivePairs * $pairIncome;

            if ($matchingCommission <= 0) continue;

            // Update user balance
            $uplineUser = User::find($uplineUserId);
            if (!$uplineUser) continue;

            $uplineUser->balance += $matchingCommission;
            $uplineUser->total_matching_com += $matchingCommission; // optional column
            $uplineUser->save();

            // Transaction log
            Transaction::create([
                'user_id'      => $uplineUserId,
                'amount'       => $matchingCommission,
                'post_balance' => $uplineUser->balance,
                'trx_type'     => '+',
                'trx'          => getTrx(),
                'remark'       => 'matching_commission',
                'details'      => 'Matching commission from downline ' . $userId . '. ' . $details,
            ]);

            // Commission log
            CommissionLog::create([
                'user_id'         => $uplineUserId,
                'type'            => 'matching',
                'amount'          => $matchingCommission,
                'details'         => 'Matching commission from downline ' . $userId . '. ' . $details,
                'source_username' => $uplineUser->username,
            ]);
        }
    }


    public function binarySummery()
    {
        $pageTitle = "Binary Summary";

        // Safely get authenticated user id
        $userId = Auth::user()->id;

        // Fetch user extra logs
        $logs = UserExtra::where('user_id', $userId)->firstOrFail();

        // Fetch user
        $log  = User::where('id', $userId)->firstOrFail();

        // Get bv_price from general_settings
        $general = DB::table('general_settings')
            ->select('bv_price')
            ->first();

        // Calculate binary commission
        $minPaidSide = min($logs->paid_left, $logs->paid_right);
        $binaryCommission = $minPaidSide * ($general->bv_price ?? 0);

        // Return view
        return view('Template::user.binarySummery', compact(
            'pageTitle',
            'logs',
            'log',
            'binaryCommission',
            'minPaidSide'
        ));
    }

    public function royaltySummery()
    {
        $pageTitle = "Royalty Summary";

        $logs = UserExtra::where('user_id', auth()->id())->firstOrFail();
        $log  = User::where('id', auth()->id())->firstOrFail();

        // Get bv_price & royalty percentage from general_settings
        $general = \DB::table('general_settings')
            ->select('bv_price', 'royalty_bonus_percentage')
            ->first();

        // Calculate pair match
        $minPaidSide = min($logs->paid_left, $logs->paid_right);

        // Royalty Commission = (pairMatch * bv_price) * (royalty_bonus_percentage / 100)
        $royaltyCommission = ($minPaidSide * $general->bv_price) * ($general->royalty_bonus_percentage / 100);

        return view('Template::user.royaltySummery', compact(
            'pageTitle',
            'logs',
            'log',
            'minPaidSide',
            'royaltyCommission'
        ));
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

    public function repurchaseIncome()
    {
        $pageTitle = "Repurchase Income";
        $transactions = Transaction::where('user_id', auth()->id())
            ->where('remark', 'repurchase_level_commission')
            ->latest()
            ->paginate(getPaginate());

        return view('Template::user.repurchaseIncome', compact('pageTitle', 'transactions'));
    }

    public function RefferalIncome()
    {
        $pageTitle = "Referral Income";
        $transactions = Transaction::where('user_id', auth()->id())
            ->where('remark', 'referral_commission')
            ->latest()
            ->paginate(getPaginate());

        $general = gs(); // <-- load global settings

        return view('Template::user.refferalIncome', compact('pageTitle', 'transactions', 'general'));
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
        $pageTitle = "Level Income";

        // Get all level commissions for the authenticated user
        $commissions = CommissionLog::where('user_id', auth()->id())
            ->where('type', 'level')
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
        $user = auth()->user();
        $tree = showTreePage($user->id, $user->fullname);
        $pageTitle = "My Tree";

        return view('Template::user.myTree', compact('pageTitle', 'tree', 'user'));
    }


    public function otherTree(Request $request, $username = null)
    {
        if ($request->username) {
            $user = User::where('username', $request->username)->first();
        } else {
            $user = User::where('username', $username)->first();
        }
        if ($user) {
            $tree      = showTreePage($user->id);
            $pageTitle = "Tree of " . $user->fullname;
            return view('Template::user.myTree', compact('tree', 'pageTitle'));
        }

        $notify[] = ['error', 'Tree Not Found !'];
        return redirect()->route('user.dashboard')->withNotify($notify);
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
            ->filter(function ($v) {
                return (int) $v > 0;
            })
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
            $all = array_values(array_filter($all, fn($r) => (int)$r->id !== $userId));
        }

        return $all;
    }

    protected function fallbackPlacementDownline(int $userId, bool $includeSelf = true): array
    {
        $selectCols = ['id', 'ref_by', 'pos_id', 'position', 'level', 'firstname', 'username'];

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
