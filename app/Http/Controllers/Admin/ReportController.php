<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\BvLog;
use App\Models\UserLogin;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\NotificationLog;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function transaction(Request $request, $userId = null)
    {
        $pageTitle = 'Transaction Logs';

        $remarks = Transaction::distinct('remark')->orderBy('remark')->get('remark');

        $transactions = Transaction::searchable(['trx', 'user:username'])
            ->filter(['trx_type', 'remark'])
            ->dateFilter()
            ->orderBy('id', 'desc')
            ->with('user');

        if ($userId) {
            $transactions = $transactions->where('user_id', $userId);
        }

        $transactions = $transactions->get();

        return view('admin.reports.transactions', compact('pageTitle', 'transactions', 'remarks'));
    }


    public function loginHistory(Request $request)
    {
        $pageTitle = 'User Login History';
        $loginLogs = UserLogin::orderBy('id', 'desc')->searchable(['user:username'])->dateFilter()->with('user')->paginate(getPaginate());
        return view('admin.reports.logins', compact('pageTitle', 'loginLogs'));
    }

    public function loginIpHistory($ip)
    {
        $pageTitle = 'Login by - ' . $ip;
        $loginLogs = UserLogin::where('user_ip', $ip)->orderBy('id', 'desc')->with('user')->paginate(getPaginate());
        return view('admin.reports.logins', compact('pageTitle', 'loginLogs', 'ip'));
    }

    public function notificationHistory(Request $request)
    {
        $pageTitle = 'Notification History';
        $logs      = NotificationLog::orderBy('id', 'desc')->searchable(['user:username'])->dateFilter()->with('user')->paginate(getPaginate());
        return view('admin.reports.notification_history', compact('pageTitle', 'logs'));
    }

    public function emailDetails($id)
    {
        $pageTitle = 'Email Details';
        $email     = NotificationLog::findOrFail($id);
        return view('admin.reports.email_details', compact('pageTitle', 'email'));
    }

    public function invest(Request $request, $userId = null)
    {
        $pageTitle    = 'Invest Logs';
        $transactions = Transaction::searchable(['trx', 'user:username'])->where('remark', 'purchased_plan')->with('user');
        if ($userId) {
            $transactions = $transactions->where('user_id', $userId);
        }
        $transactions = $transactions->latest()->paginate(getPaginate());

        return view('admin.reports.transactions', compact('pageTitle', 'transactions'));
    }

    public function bvLog(Request $request, $userId = null)
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
        if ($userId) {
            $logs = $logs->where('user_id', $userId);
        }

        $logs = $logs->latest('id')->paginate(getPaginate());

        return view('admin.reports.bvLog', compact('pageTitle', 'logs'));
    }

    protected function bvData($scope = null)
    {
        if ($scope) {
            $logs = BvLog::$scope();
        } else {
            $logs = BvLog::query();
        }
        return $logs->searchable(['user:username']);
    }

    public function refCom(Request $request, $userId = null)
    {
        $pageTitle    = 'Referral Commission Logs';
        $transactions = Transaction::searchable(['trx', 'user:username'])->where('remark', 'referral_commission')->with('user');
        if ($userId) {
            $transactions = $transactions->where('user_id', $userId);
        }
        $transactions = $transactions->latest()->paginate(getPaginate());

        return view('admin.reports.transactions', compact('pageTitle', 'transactions'));
    }

    public function binaryCom(Request $request, $userId = null)
    {
        $pageTitle    = 'Binary Commission Logs';
        $transactions = Transaction::searchable(['trx', 'user:username'])->where('remark', 'binary_commission')->with('user');
        if ($userId) {
            $transactions = $transactions->where('user_id', $userId);
        }
        $transactions = $transactions->latest()->paginate(getPaginate());

        return view('admin.reports.transactions', compact('pageTitle', 'transactions'));
    }

    // use the route param
    public function myupline(Request $request, $userId)
    {
        $pageTitle = "Upline";
        $userId    = (int) $userId ?: auth()->id();

        // Get all upline including self
        $rows = $this->getPlacementUplineFor($userId, true);

        // Sort root/top-most first
        $rows = collect($rows)->sortBy([
            ['level', 'asc'],
            ['id', 'asc'],
        ])->values();

        // Remove self (id == requested user id)
        $rows = $rows->reject(function ($item) use ($userId) {
            return (int) $item->id === $userId;
        })->values();

        // Lookup names for ref_by and pos_id
        $lookupIds = $rows->pluck('ref_by')
            ->merge($rows->pluck('pos_id'))
            ->filter(fn($v) => (int) $v > 0)
            ->unique()
            ->values();

        $nameLookup = DB::table('users')
            ->whereIn('id', $lookupIds)
            ->get(['id', 'firstname', 'username'])
            ->mapWithKeys(fn($u) => [(int) $u->id => sprintf('%s (%s)', $u->firstname, $u->username)]);

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

        return view('admin.reports.myupline', compact('pageTitle', 'logs'));
    }


    protected function getPlacementUplineFor(int $userId, bool $includeSelf = true): array
    {
        // NOTE: build CTE with proper "u." prefixes
        $sql = "
            WITH RECURSIVE upline AS (
                SELECT id, ref_by, pos_id, position, level, firstname, username
                FROM users
                WHERE id = ?
    
                UNION ALL
    
                SELECT u.id, u.ref_by, u.pos_id, u.position, u.level, u.firstname, u.username
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
            $all = array_values(array_filter($all, fn($r) => (int) $r->id !== $userId));
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

    // Fully qualify the type OR import it to avoid the namespace clash
    protected function paginateCollection(\Illuminate\Support\Collection $items, int $perPage, string $pageName = 'page')
    {
        $page  = LengthAwarePaginator::resolveCurrentPage($pageName);
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
