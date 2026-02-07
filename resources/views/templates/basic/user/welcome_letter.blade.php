@extends($activeTemplate.'layouts.master')

@push('style')
<style>
.welcome-wrapper {
    max-width: 900px;
    margin: auto;
}

.welcome-header {
    background: linear-gradient(135deg, #0d6efd, #198754);
    color: #fff;
    padding: 5px;
    border-radius: 6px 6px 0 0;
}

.welcome-body {
    background: #ffffff;
    padding: 35px;
    border-radius: 0 0 16px 16px;
    box-shadow: 0 15px 40px rgba(0,0,0,.08);
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
    gap: 15px;
    margin: 25px 0;
}

.info-box {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 15px;
    border-left: 5px solid #0d6efd;
}

.signature {
    margin-top: 40px;
}

.action-bar {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 20px;
}

@media (max-width: 576px) {
    .action-bar {
        flex-direction: column;
    }
}
</style>
@endpush

@section('content')
<div class="welcome-wrapper">

    <!-- ACTION BUTTONS -->
    <!--<div class="action-bar">-->
        <!--<a href="javascript:void(0)" onclick="downloadLetter()" class="btn btn-outline-primary">
            <i class="las la-file-download"></i> @lang('Download PDF')
        </a>-->
            <!--<a href="{{ route('user.welcome.letter.pdf') }}"
       class="btn btn-outline-primary">
        <i class="las la-file-pdf"></i> Download PDF
    </a>-->


        <!--<button onclick="window.print()" class="btn btn-outline-secondary">
            <i class="las la-print"></i> @lang('Print')
        </button>
    </div>-->

    <!-- LETTER CARD -->
    <center><img src="/assets/images/logoIcon/logo_dark.png" alt="" width="400" height="200">
     <p class="mb-0 opacity-75">@lang('A/174, H.B.Town,Road No.5,sodepur,Kolkata • 70011O | info@paheliherbal.com')</p></center> <br>
    <div class="welcome-header">
        
        <!--<h3 class="mb-1">@lang('Welcome to Paheli Herbals')</h3>-->
       <!-- <p class="mb-0 opacity-75">@lang('Official Welcome Letter')</p>-->
    </div>

    <div class="welcome-body">
        <center><img src="/welcome_PNG41.png" alt="Girl in a jacket" width="400" height="200"></center>

        <p class="fs-5">
            @lang('Dear') <strong>{{ $user->fullname }}</strong>,
        </p>

        <p>
            @lang('<strong>Congratulations !!</strong> We are pleased to welcome you to Paheli Herbal’s Marketing Pvt. Ltd. Your decision to join us marks the beginning of a rewarding journey toward growth, success, and financial independence.')
        </p>

        <p>
            @lang('Your account has been successfully created and activated. Please find your joining details below:')
        </p>

        <!-- USER INFO -->
        <div class="info-grid">
            <div class="info-box">
                <small class="text-muted">@lang('Username')</small>
                <div class="fw-bold">{{ $user->username }}</div>
                
                <small class="text-muted">@lang('Email')</small>
                <div class="fw-bold">{{ $user->email  }}</div>
                
                <small class="text-muted">@lang('Mobile')</small>
                <div class="fw-bold">{{ $user->mobile }}</div>
            </div>

            <div class="info-box">
                <small class="text-muted">@lang('Address')</small>
                <div class="fw-bold">{{ $user->address }},{{ $user->city }},{{ $user->state }} ,{{ $user->zip }}</div>
                
                
                <small class="text-muted">@lang('Joining Date')</small>
                <div class="fw-bold">{{ showDateTime($user->created_at) }}</div>
            </div>

            <div class="info-box">
                <small class="text-muted">@lang('Current Plan')</small>
                <div class="fw-bold">
                    {{ optional($user->plan)->name ?? __('N/A') }}
                </div>
            </div>
        </div>

        <p>
            @lang('We encourage you to explore your dashboard, understand the compensation structure, and actively participate in our programs. Our support team is always available to assist you.')
        </p>

        <p>
            @lang('We wish you great success and long-term growth with Paheli Herbals.')
        </p>

        <!-- SIGNATURE -->
        <div class="signature">
            <p class="mb-1">@lang('Warm Regards'),</p>
            <img src="/signature.png" alt="" width="300" height="100"> <br>
            <!--<strong>{{ config('app.name') }}</strong><br>-->
            <span class="text-muted">@lang('Authorized Management')</span>
        </div>

    </div>
</div>
@endsection
@push('script')
<script>
function downloadLetter() {
    const element = document.createElement('a');
    const content = document.documentElement.outerHTML;
    const file = new Blob([content], {type: 'text/html'});
    element.href = URL.createObjectURL(file);
    element.download = "Welcome_Letter.html";
    element.click();
}
</script>
@endpush

