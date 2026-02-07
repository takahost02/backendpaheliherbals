<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BinaryReportController extends Controller
{
    /* =====================================================
     |  BINARY REPORT LIST
     ===================================================== */
    public function report(Request $request)
    {
        try {

            /* ============================
             |  BASE QUERY
             ============================ */
            $query = DB::table('binary_logs as bl')
                ->join('users as u', 'u.id', '=', 'bl.user_id')
                ->select(
                    'bl.id',
                    'bl.user_id',
                    'u.username',
                    'bl.amount',
                    'bl.type',
                    'bl.description',
                    'bl.is_dry_run',
                    'bl.created_at'
                );

            /* ============================
             |  DATE FILTER (FROM - TO)
             ============================ */
            if ($request->filled(['from_date', 'to_date'])) {

                $from = Carbon::parse($request->from_date)->startOfDay();
                $to   = Carbon::parse($request->to_date)->endOfDay();

                $query->whereBetween('bl.created_at', [$from, $to]);
            }

            /* ============================
             |  TYPE FILTER
             |  left | right | matching
             ============================ */
            if ($request->filled('type')) {
                $query->where('bl.type', $request->string('type'));
            }

            /* ============================
             |  DRY RUN FILTER
             ============================ */
            if ($request->filled('dry_run')) {
                $query->where('bl.is_dry_run', (int) $request->dry_run);
            }

            /* ============================
             |  SORT & PAGINATION
             ============================ */
            $logs = $query
                ->orderByDesc('bl.id')
                ->paginate(30)
                ->withQueryString();

            return view('admin.binary.report', compact('logs'));

        } catch (\Throwable $e) {

            Log::error('Binary Report Load Failed', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'request' => $request->all(),
            ]);

            return back()->with('error', 'Unable to load binary report. Please try again.');
        }
    }

    /* =====================================================
     |  BINARY DASHBOARD
     ===================================================== */
    public function index()
    {
        try {

            $today = Carbon::today()->toDateString();

            $data = [
                'today_pair' => DB::table('binary_logs')
                    ->whereDate('created_at', $today)
                    ->sum('pair'),

                'today_commission' => DB::table('binary_logs')
                    ->whereDate('created_at', $today)
                    ->sum('commission'),

                'first_half' => DB::table('binary_logs')
                    ->whereDate('created_at', $today)
                    ->where('half', 'first')
                    ->sum('pair'),

                'second_half' => DB::table('binary_logs')
                    ->whereDate('created_at', $today)
                    ->where('half', 'second')
                    ->sum('pair'),
            ];

            return view('admin.binary.dashboard', $data);

        } catch (\Throwable $e) {

            Log::error('Binary Dashboard Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return back()->with('error', 'Unable to load binary dashboard.');
        }
    }
}
