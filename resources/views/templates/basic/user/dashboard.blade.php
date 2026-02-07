@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        
        <div class="row">
            <div class="col-md-12">
                <div class="notice"></div>
                @php
$kyc = \App\Models\UserKyc::where('user_id', auth()->id())->first();
@endphp

<div class="card mt-3">
    <div class="card-body">
        <h5>KYC Status</h5>

        @if(!$kyc)
            <span class="badge bg-secondary">Not Submitted</span>

            <div class="mt-3">
                <a href="{{ route('user.kyc.form') }}" class="btn btn-primary">
                    Submit KYC
                </a>
            </div>

        @elseif($kyc->status == 'pending')
            <span class="badge bg-warning">Pending Verification</span>

            <div class="mt-3">
                <a href="{{ route('user.kyc.form') }}" class="btn btn-outline-primary">
                    View / Update KYC
                </a>
            </div>

        @elseif($kyc->status == 'approved')
            <span class="badge bg-success">Approved</span>

        @else
            <span class="badge bg-danger">Rejected</span>
            <p class="text-danger mt-2">
                Reason: {{ $kyc->admin_remark }}
            </p>

            <div class="mt-3">
                <a href="{{ route('user.kyc.form') }}" class="btn btn-danger">
                    Re-submit KYC
                </a>
            </div>
        @endif
    </div>
</div>

                @php
                    $kyc = getContent('kyc.content', true);
                @endphp
                @if (auth()->user()->kv == Status::KYC_UNVERIFIED && auth()->user()->kyc_rejection_reason)
                    <div class="alert alert--danger" role="alert">
                        <div class="alert__icon"><i class="fas fa-file-signature"></i></div>
                        <p class="alert__message">
                            <span class="fw-bold">@lang('KYC Documents Rejected')</span><br>
                            <small>
                                <i>
                                    {{ __(@$kyc->data_values->reject) }}
                                    <a class="link-color text--base" data-bs-toggle="modal" data-bs-target="#kycRejectionReason"
                                        href="javascript::void(0)">@lang('Click here')</a> @lang('to show the reason').
                                    <a class="link-color text--base" href="{{ route('user.kyc.form') }}">@lang('Click Here')</a>
                                    @lang('to Re-submit Documents'). <br>

                                    <a class="link-color text--base mt-2" href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a>
                                </i>
                            </small>
                        </p>
                    </div>
                @elseif (auth()->user()->kv == Status::KYC_UNVERIFIED)
                    <div class="alert alert--info" role="alert">
                        <div class="alert__icon"><i class="fas fa-file-signature"></i></div>
                        <p class="alert__message">
                            <span class="fw-bold">@lang('KYC Verification Required')</span><br>
                            <small>
                                <i>
                                    {{ __(@$kyc->data_values->required) }}
                                    <a class="link-color text--base" href="{{ route('user.kyc.form') }}">@lang('Click here')</a>
                                    @lang('to submit KYC information').
                                </i>
                            </small>
                        </p>
                    </div>
                @elseif(auth()->user()->kv == Status::KYC_PENDING)
                    <div class="alert alert--warning" role="alert">
                        <div class="alert__icon"><i class="fas fa-user-check"></i></div>
                        <p class="alert__message">
                            <span class="fw-bold">@lang('KYC Verification Pending')</span><br>
                            <small>
                                <i>
                                    {{ __(@$kyc->data_values->pending) }}
                                    <a class="link-color text--base" href="{{ route('user.kyc.data') }}">@lang('Click here')</a> @lang('to see your submitted information')
                                </i>
                            </small>
                        </p>
                    </div>
                @endif
                
              <!-- Current Plan start -->
<div class="col-12">
    <div class="current-plan-full">
        
      <!-- scroll start -->
<!DOCTYPE html>
<html>
<head>
<style>
.marquee-container {
    width: 100%;
    overflow: hidden;
    background: #305acc;
    padding: 12px 0;
}

.marquee-text {
    display: inline-block;
    white-space: nowrap;
    font-size: 20px;
    font-weight: bold;
    animation: scroll-left 30s linear infinite;
}

/* Individual sentence colors */
.text-1 { color: #ffffff; }   /* White */
.text-2 { color: #ffeb3b; }   /* Yellow */
.text-3 { color: #00ffcc; }   /* Cyan */
.text-4 { color: #ff6f61; }   /* Coral */

@keyframes scroll-left {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(-100%);
    }
}
</style>
</head>
<body>

<div class="marquee-container">
    <div class="marquee-text">
        <span class="text-1">Welcome to Paheli Herbals!! </span>
        <span class="text-2">Exclusive Pre-Launch Offer Going On!! </span>
        <span class="text-3">Hurry Up!! </span>
        <span class="text-4">Super Global Income Is Coming Soon!</span>
    </div>
</div>

</body>
</html>


     <!--  scroll end -->
<br>
<hr>
        <!-- Header -->
        <div class="current-plan-header">
            @lang('Your Current Plan')
        </div>

        <!-- Plan Name -->
        <div class="current-plan-value">
            @if (auth()->user()->plan)
                {{ auth()->user()->plan->name }}
            @else
                <span class="text-danger">@lang('N/A')</span>
            @endif
        </div>

    </div>
</div>
<style>.current-plan-full {
    width: 100%;
    padding: 16px 20px;
    border-radius: 10px;
    background: #ffffff;
}

.current-plan-header {
    font-size: 14px;
    font-weight: 600;
    color: #03caae; /* heading color */
    text-transform: uppercase;
    margin-bottom: 6px;
}

.current-plan-value {
    font-size: 22px;
    font-weight: 700;
    /*color: var(--base-color);*/ /* plan text color */
     color: #FF7518; /* plan text color */
}

</style>

<!-- Current Plan end -->

                 <!--Notice-->

                @if (gs('notice'))
                    <div class="col-lg-12 col-sm-6 mt-4">
                        <div class="card notice--card custom--card">
                            <div class="card-header">
                                <h5 class="pb-2">@lang('Notice')</h5>
                            </div>
                            <div class="card-body">
                                @if (gs('notice'))
                                    <p class="notice-text-inner">@php echo gs('notice') @endphp</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                <!--Free User Notice-->

                @if (gs('free_user_notice'))
                    <div class="col-lg-12 col-sm-6 mt-4">
                        <div class="card notice--card custom--card">
                            <div class="card-header">
                                <h5 class="pb-1">@lang('Free User Notice')</h5>
                            </div>
                            <div class="card-body">
                                @if (gs('free_user_notice') != null)
                                    <p class="notice-text-inner"> @php echo gs('free_user_notice'); @endphp </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!--Current Balance-->

            <div class="row justify-content-center g-3">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Current Balance')</h6>
                                <h3 class="ammount theme-two">{{ showAmount(auth()->user()->balance) }}</h3>
                            </div>
                            <div class="right-content">
                                <div class="icon"><i class="flaticon-wallet"></i></div>
                            </div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
              <!--  total Income -->
                <!--<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total income')</h6>
                                <h3 class="ammount theme-two">{{ showAmount($totalIncome) }}</h3>
                            </div>
                            <div class="right-content">
                                <div class="icon"><i class="flaticon-wallet"></i></div>
                            </div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>-->
                
               <!-- Current Plan start -->
                <!--<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">
                                    @lang('Current Plan')
                                </h6>
                                <h3 class="ammount">
                                    @if (auth()->user()->plan)
                                        <span>{{ auth()->user()->plan->name }}</span>
                                    @else
                                        <span class="text--danger">@lang('N/A')</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="right-content">
                                <div class="icon"><i class="las la-paper-plane"></i></div>
                            </div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>-->
                 <!-- Current Plan end -->
               <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total Deposit')</h6>
                                <h3 class="ammount text--base">{{ showAmount($totalDeposit) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-save-money"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>-->
                <!--Total Withdraw-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total Withdraw')</h6>
                                <h3 class="ammount theme-one">{{ showAmount($totalWithdraw) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-withdraw"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                
                <!--Complete Withdraw-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Complete Withdraw')</h6>
                                <h3 class="ammount theme-two">{{ getAmount($completeWithdraw) }}</h3>
                            </div>
                            <div class="right-content">
                                <div class="icon"><i class="flaticon-wallet"></i></div>
                            </div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                
                <!--Pending Withdraw-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Pending Withdraw')</h6>
                                <h3 class="ammount text--base">{{ getAmount($pendingWithdraw) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-withdrawal"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                <!--Total Invest-->
                <!--<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total Invest')</h6>
                                <h3 class="ammount theme-one">{{ showAmount(auth()->user()->total_invest) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-tag-1"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>-->
                
                <!--refferal commission-->
                <!--<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total Referral Commission')</h6>
                                <h3 class="ammount theme-one">{{ showAmount(auth()->user()->total_ref_com) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-clipboards"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>-->
               <!-- Total Franchise Bonus Income-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total Master Matching Incomen')</h6>
                                <h3 class="ammount theme-one">{{ showAmount(auth()->user()->total_binary_com) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-money-bag"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
               <!--Total Level Income-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total Level Income')</h6>
                                <h3 class="ammount theme-one">{{ showAmount(auth()->user()->total_level_com) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-money-bag"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
              <!--  Total Salary Income-->
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total Salary Income')</h6>
                                <h3 class="ammount theme-one">{{ showAmount(auth()->user()->total_level_com) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-money-bag"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
               <!-- Franchise Bonus Income-->
               <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total Franchise Bonus Income')</h6>
                                <h3 class="ammount theme-one">{{ showAmount(auth()->user()->total_level_com) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-money-bag"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                
               <!--Rank Achievement Income-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Rank Achievement Income')</h6>
                                <h3 class="ammount theme-one">{{ showAmount(auth()->user()->total_royalty_com) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-crown"></i></div> {{-- crown icon for royalty --}}
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
               <!--Total Repurchase Commission-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total Repurchase Commission')</h6>
                                <h3 class="ammount theme-one">{{ showAmount(auth()->user()->total_repurchase_com) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-shopping-cart"></i></div> {{-- shopping cart icon for repurchase --}}
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
               <!-- Retail Profit-->
                <!--<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total Retail Profits Income')</h6>
                                <h3 class="ammount theme-one">{{ showAmount(auth()->user()->total_repurchase_com) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-shopping-cart"></i></div> {{-- shopping cart icon for repurchase --}}
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>-->
                
                <!--Global Matching Income-->
                 <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">@lang('Total Global Matching Income')</h6>
                                <h3 class="ammount theme-one">{{ showAmount(auth()->user()->total_repurchase_com) }}</h3>
                            </div>
                            <div class="icon"><i class="flaticon-shopping-cart"></i></div> {{-- shopping cart icon for repurchase --}}
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>

            </div>
        @endsection
        
       <!-- KYC Document Rejection Reason-->

        @if (auth()->user()->kv == Status::KYC_UNVERIFIED && auth()->user()->kyc_rejection_reason)
            <div class="modal fade" id="kycRejectionReason">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('KYC Document Rejection Reason')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>{{ auth()->user()->kyc_rejection_reason }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
