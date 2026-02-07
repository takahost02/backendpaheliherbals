<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\UserKyc;


/* MODELS */
use App\Models\User;
use App\Models\Order;
use App\Models\Deposit;
use App\Models\Product;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\BvLog;
use App\Models\UserExtra;

/* UTILS */
use Carbon\Carbon;

/* CONSTANTS */
use App\Constants\Status;

/* PDF */
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    
    public function kycSubmit(Request $request)
{
    $request->validate([
        'aadhaar' => 'required|digits:12',
        'pan' => 'required|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
        'bank_name' => 'required',
        'account_holder' => 'required',
        'account_number' => 'required',
        'ifsc' => 'required|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
        'id_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'bank_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    UserKyc::updateOrCreate(
        ['user_id' => auth()->id()],
        [
            'aadhaar' => $request->aadhaar,
            'pan' => strtoupper($request->pan),
            'bank_name' => $request->bank_name,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'ifsc' => strtoupper($request->ifsc),
            'id_proof' => $request->file('id_proof')->store('kyc/id'),
            'bank_proof' => $request->file('bank_proof')->store('kyc/bank'),
            'status' => 'pending'
        ]
    );

    return back()->with('success', 'KYC submitted successfully. Waiting for admin approval.');
}
    
    /* =====================================================
       USER DATA
    ===================================================== */

    public function userData()
    {
        $pageTitle = 'User Data';
        $user = auth()->user();

        $lastUser = User::where('username', 'LIKE', 'PH707%')
            ->orderByDesc('id')
            ->first();

        $nextNumber = 1;
        if ($lastUser && preg_match('/PH707(\d+)/', $lastUser->username, $m)) {
            $nextNumber = (int) $m[1] + 1;
        }

        $nextUsername = 'PH707' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        return view('Template::user.user_data', compact(
            'pageTitle',
            'user',
            'nextUsername'
        ));
    }

    /* =====================================================
       DEPOSIT HISTORY
    ===================================================== */

    public function depositHistory()
    {
        $pageTitle = 'Deposit History';

        $deposits = Deposit::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('Template::user.deposit_history', compact(
            'pageTitle',
            'deposits'
        ));
    }
    
    
    public function kycForm()
    {
      $pageTitle = 'KYC Verification';
    $kyc = UserKyc::where('user_id', auth()->id())->first();

    // This helper gets the active template path safely
    $activeTemplate = activeTemplate();

    return view($activeTemplate . 'user.kyc.form', compact('pageTitle', 'kyc'));
    }
    
    public function binarySummeryHistory()
        {
            $pageTitle = 'Binary Summary History';
        
            $transactions = Transaction::where('user_id', auth()->id())
                ->where('remark', 'master_matching_income') 
                ->latest()
                ->paginate(10);
        
            return view('Template::user.binary_history', compact(
                'pageTitle',
                'transactions'
            ));
        }

        public function SummeryHistory()
        {
            $pageTitle = 'Income History';
        
            $transactions = Transaction::where('user_id', auth()->id())
                ->where('trx_type', '+')
                ->whereIn('remark', [
                    'master_matching_income',
                    'matrix_income'
                ])
                ->latest()
                ->paginate(10);
        
            return view('Template::user.income_history', compact(
                'pageTitle',
                'transactions'
            ));
        }



    /* =====================================================
       USER DATA SUBMIT
    ===================================================== */

    public function userDataSubmit(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => [
                'required', 'string', 'max:50',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'mobile' => [
                'required', 'digits:10',
                Rule::unique('users', 'mobile')->ignore($user->id),
            ],
            'state'   => 'required|string|max:100',
            'city'    => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'zip'     => 'required|string|max:10',
        ]);

        $user->update([
            'username'          => $request->username,
            'mobile'            => $request->mobile,
            'state'             => $request->state,
            'city'              => $request->city,
            'address'           => $request->address,
            'zip'               => $request->zip,
            'profile_complete' => Status::YES,
        ]);

        return redirect()
            ->route('user.home')
            ->withNotify([['success', 'Profile updated successfully']]);
    }

    /* =====================================================
       DASHBOARD
    ===================================================== */

    public function home()
    {
        $pageTitle = 'Dashboard';
        $user = auth()->user();

        $totalDeposit     = Deposit::whereUserId($user->id)->whereStatus(1)->sum('amount');
        $totalWithdraw    = Withdrawal::whereUserId($user->id)->whereStatus(1)->sum('amount');
        $completeWithdraw = Withdrawal::whereUserId($user->id)->whereStatus(1)->count();
        $pendingWithdraw  = Withdrawal::whereUserId($user->id)->whereStatus(2)->count();
        $totalRef         = User::where('ref_by', $user->id)->count();
        $totalBvCut       = BvLog::whereUserId($user->id)->where('trx_type', '-')->sum('amount');

        $totalIncome =
            ($user->total_ref_com ?? 0) +
            ($user->total_binary_com ?? 0) +
            ($user->total_royalty_com ?? 0) +
            ($user->total_repurchase_com ?? 0) +
            ($user->total_level_com ?? 0);

        return view('Template::user.dashboard', compact(
            'pageTitle',
            'totalDeposit',
            'totalWithdraw',
            'completeWithdraw',
            'pendingWithdraw',
            'totalRef',
            'totalBvCut',
            'totalIncome'
        ));
    }

    /* =====================================================
       BINARY SUMMARY
    ===================================================== */

    public function binarySummery()
    {
        $userId = auth()->id();
        $pageTitle = 'Master Matching Income';

        $logs = (object) [
            'paid_left'  => User::where('ref_by', $userId)->where('position', 1)->where('plan_id', '!=', 0)->count(),
            'paid_right' => User::where('ref_by', $userId)->where('position', 2)->where('plan_id', '!=', 0)->count(),
            'free_left'  => User::where('ref_by', $userId)->where('position', 1)->where('plan_id', 0)->count(),
            'free_right' => User::where('ref_by', $userId)->where('position', 2)->where('plan_id', 0)->count(),
        ];

        $todayStart = Carbon::today();
        $noonTime   = Carbon::today()->setTime(12, 0);
        $todayEnd  = Carbon::today()->endOfDay();

        $firstLeftBV = BvLog::where('user_id', $userId)
            ->where('position', 1)
            ->where('trx_type', '+')
            ->whereBetween('created_at', [$todayStart, $noonTime])
            ->sum('amount');

        $firstRightBV = BvLog::where('user_id', $userId)
            ->where('position', 2)
            ->where('trx_type', '+')
            ->whereBetween('created_at', [$todayStart, $noonTime])
            ->sum('amount');

        $rawFirstHalfPair = min($firstLeftBV, $firstRightBV);
        $firstHalfPair = min(2, $rawFirstHalfPair);

        $secondLeftBV = BvLog::where('user_id', $userId)
            ->where('position', 1)
            ->where('trx_type', '+')
            ->whereBetween('created_at', [$noonTime, $todayEnd])
            ->sum('amount');

        $secondRightBV = BvLog::where('user_id', $userId)
            ->where('position', 2)
            ->where('trx_type', '+')
            ->whereBetween('created_at', [$noonTime, $todayEnd])
            ->sum('amount');

        $rawSecondHalfPair = min($secondLeftBV, $secondRightBV);
        $secondHalfPair = min(2, $rawSecondHalfPair);

        $pairMatch = $firstHalfPair + $secondHalfPair;
        $dailyCap = 4;

        $effectivePairs = min($pairMatch, $dailyCap);
        $remainingCap = max(0, $dailyCap - $effectivePairs);

        $pairIncome = 750;
        $binaryCommission = $effectivePairs * $pairIncome;

        $bvLeft = BvLog::where('user_id', $userId)->where('position', 1)->where('trx_type', '+')->sum('amount');
        $bvRight = BvLog::where('user_id', $userId)->where('position', 2)->where('trx_type', '+')->sum('amount');

        $bvHistory = BvLog::where('user_id', $userId)
            ->latest()
            ->limit(20)
            ->get();

        $carryAmount = abs($bvLeft - $bvRight);

        $carryForward = [
            'left'  => $bvLeft > $bvRight ? $carryAmount : 0,
            'right' => $bvRight > $bvLeft ? $carryAmount : 0,
        ];

        return view('Template::user.binarySummery', compact(
            'pageTitle',
            'logs',
            'firstHalfPair',
            'secondHalfPair',
            'pairMatch',
            'remainingCap',
            'binaryCommission',
            'bvHistory',
            'bvLeft',
            'bvRight',
            'carryForward'
        ));
    }
    
    // public function binarySummery()
    // {
    //     $userId = auth()->id();
    //     $pageTitle = 'Master Matching Income';
    
    //     // -----------------------------
    //     // TEAM LOGS
    //     // -----------------------------
    //     $logs = (object) [
    //         'paid_left'  => User::where('ref_by', $userId)->where('position', 1)->where('plan_id', '!=', 0)->count(),
    //         'paid_right' => User::where('ref_by', $userId)->where('position', 2)->where('plan_id', '!=', 0)->count(),
    //         'free_left'  => User::where('ref_by', $userId)->where('position', 1)->where('plan_id', 0)->count(),
    //         'free_right' => User::where('ref_by', $userId)->where('position', 2)->where('plan_id', 0)->count(),
    //     ];
    
    //     // -----------------------------
    //     // TIME WINDOWS
    //     // -----------------------------
    //     $todayStart = Carbon::today();
    //     $noonTime   = Carbon::today()->setTime(12, 0);
    //     $todayEnd   = Carbon::today()->endOfDay();
    
    //     // -----------------------------
    //     // 1ST HALF PAIRS (LOG BASED)
    //     // -----------------------------
    //     $firstHalfPair = DB::table('binary_logs')
    //         ->where('user_id', $userId)
    //         ->where('date', $todayStart->toDateString())
    //         ->where('half', 'first')
    //         ->sum('pair');
    
    //     // -----------------------------
    //     // 2ND HALF PAIRS (LOG BASED)
    //     // -----------------------------
    //     $secondHalfPair = DB::table('binary_logs')
    //         ->where('user_id', $userId)
    //         ->where('date', $todayStart->toDateString())
    //         ->where('half', 'second')
    //         ->sum('pair');
    
    //     // -----------------------------
    //     // TOTAL PAIRS & CAPPING
    //     // -----------------------------
    //     $pairMatch = $firstHalfPair + $secondHalfPair;
    //     $dailyCap  = 4;
    
    //     $effectivePairs = min($pairMatch, $dailyCap);
    //     $remainingCap   = max(0, $dailyCap - $effectivePairs);
    
    //     // -----------------------------
    //     // INCOME
    //     // -----------------------------
    //     $pairIncome = 750;
    //     $binaryCommission = $effectivePairs * $pairIncome;
    
    //     // -----------------------------
    //     // REAL BV (FROM USER EXTRA)
    //     // -----------------------------
    //     $uex = UserExtra::where('user_id', $userId)->first();
    
    //     $bvLeft  = $uex->bv_left  ?? 0;
    //     $bvRight = $uex->bv_right ?? 0;
    
    //     // -----------------------------
    //     // BV HISTORY (UNCHANGED)
    //     // -----------------------------
    //     $bvHistory = BvLog::where('user_id', $userId)
    //         ->latest()
    //         ->limit(20)
    //         ->get();
    
    //     // -----------------------------
    //     // REAL CARRY FORWARD
    //     // -----------------------------
    //     $carryForward = [
    //         'left'  => $bvLeft,
    //         'right' => $bvRight,
    //     ];
    
    //     return view('Template::user.binarySummery', compact(
    //         'pageTitle',
    //         'logs',
    //         'firstHalfPair',
    //         'secondHalfPair',
    //         'pairMatch',
    //         'remainingCap',
    //         'binaryCommission',
    //         'bvHistory',
    //         'bvLeft',
    //         'bvRight',
    //         'carryForward'
    //     ));
    // }


    /* =====================================================
       ORDERS
    ===================================================== */

    public function orders()
    {
        $pageTitle = 'My Orders';

        $orders = Order::whereUserId(auth()->id())
            ->with('product')
            ->latest()
            ->paginate(10);

        return view('Template::user.orders', compact('pageTitle', 'orders'));
    }

    /* =====================================================
       PURCHASE
    ===================================================== */

    public function purchase(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::active()->findOrFail($request->product_id);
        $user = auth()->user();

        $totalPrice = $product->price * $request->quantity;

        if ($user->balance < $totalPrice) {
            return back()->withNotify([['error', 'Insufficient balance']]);
        }

        DB::transaction(function () use ($user, $product, $request, $totalPrice) {

            $trx = getTrx();

            $user->decrement('balance', $totalPrice);
            $product->decrement('quantity', $request->quantity);

            Transaction::create([
                'user_id'      => $user->id,
                'amount'       => $totalPrice,
                'trx_type'     => '-',
                'post_balance' => $user->balance,
                'trx'          => $trx,
                'details'      => 'Product Purchase',
            ]);

            Order::create([
                'user_id'     => $user->id,
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
                'price'      => $product->price,
                'total_price'=> $totalPrice,
                'trx'        => $trx,
                'status'     => 0,
            ]);
        });

        return back()->withNotify([['success', 'Order placed successfully']]);
    }

    /* =====================================================
       EARNINGS FILTER (AJAX)
    ===================================================== */

    public function filter(Request $request)
    {
        $userId = auth()->id();
        $range = $request->get('range', 'current');

        $query = DB::table('incomes')->where('user_id', $userId);

        if ($range === 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($range === '7days') {
            $query->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()]);
        } elseif ($range === 'month') {
            $query->whereMonth('created_at', Carbon::now()->month);
        }

        $clone = clone $query;

        return response()->json([
            'binary'  => (clone $clone)->where('type', 'binary')->sum('amount'),
            'direct' => (clone $clone)->where('type', 'direct')->sum('amount'),
            'matching' => (clone $clone)->where('type', 'matching')->sum('amount'),
            'reward' => (clone $clone)->where('type', 'reward')->sum('amount'),
            'total'  => $query->sum('amount'),
        ]);
    }

    /* =====================================================
       EXPORT PDF
    ===================================================== */

    public function exportPDF()
    {
        $transactions = DB::table('incomes')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('exports.earnings_pdf', compact('transactions'));

        return $pdf->download('earnings-report.pdf');
    }

    /* =====================================================
       WELCOME LETTER
    ===================================================== */

    public function welcomeLetter()
    {
        return view('Template::user.welcome_letter', [
            'pageTitle' => 'Welcome Letter',
            'user' => auth()->user(),
        ]);
    }

    public function welcomeLetterPdf()
    {
        $user = auth()->user();

        return Pdf::loadView('Template::user.welcome_letter_pdf', compact('user'))
            ->download('Welcome_Letter_' . $user->username . '.pdf');
    }
                public function myIncome()
            {
                $pageTitle = 'My Income';
                $userId = auth()->id();
            
                // -----------------------------
                // BASE QUERY
                // -----------------------------
                $baseQuery = \DB::table('incomes')
                    ->where('user_id', $userId);
            
                // -----------------------------
                // TOTALS
                // -----------------------------
                $binaryIncome = (clone $baseQuery)->where('type', 'binary')->sum('amount');
                $directIncome = (clone $baseQuery)->where('type', 'direct')->sum('amount');
                $matchingBonus = (clone $baseQuery)->where('type', 'matching')->sum('amount');
                $rewardIncome = (clone $baseQuery)->where('type', 'reward')->sum('amount');
            
                $totalEarned = $binaryIncome + $directIncome + $matchingBonus + $rewardIncome;
            
                // -----------------------------
                // WITHDRAW / PENDING
                // -----------------------------
                $totalWithdrawn = \DB::table('withdrawals')
                    ->where('user_id', $userId)
                    ->where('status', 1)
                    ->sum('amount');
            
                $pendingAmount = \DB::table('withdrawals')
                    ->where('user_id', $userId)
                    ->where('status', 2)
                    ->sum('amount');
            
                // -----------------------------
                // TRANSACTIONS LIST (FIXED!)
                // -----------------------------
                $transactions = \DB::table('incomes')
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->limit(50)
                    ->get();
            
                // -----------------------------
                // TOTAL INCOME (DISPLAY CARD)
                // -----------------------------
                $totalIncome = $totalEarned;
            
                return view('Template::user.incomes.my_income', compact(
                    'pageTitle',
                    'binaryIncome',
                    'directIncome',
                    'matchingBonus',
                    'rewardIncome',
                    'totalEarned',
                    'totalIncome',
                    'totalWithdrawn',
                    'pendingAmount',
                    'transactions'
                ));
            }

}
