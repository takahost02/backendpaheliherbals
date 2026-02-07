@extends($activeTemplate . 'layouts.master')

@section('content')

@php
$status = $kyc->status ?? 'not_submitted';
$percent = match($status) {
    'approved' => 100,
    'pending' => 70,
    'rejected' => 40,
    default => 10
};

$statusColor = match($status) {
    'approved' => 'success',
    'pending' => 'warning',
    'rejected' => 'danger',
    default => 'secondary'
};

$statusLabel = ucfirst(str_replace('_', ' ', $status));
@endphp

<style>
.kyc-wrapper {
    max-width: 900px;
    margin: auto;
}

.glass-card {
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);
    border-radius: 18px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    border: 1px solid rgba(255,255,255,0.4);
}

.kyc-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.progress-modern {
    height: 14px;
    border-radius: 20px;
    overflow: hidden;
    background: #e9ecef;
}

.progress-modern .bar {
    height: 100%;
    transition: width 0.8s ease;
}

.status-pill {
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
}

.doc-card {
    border: 1px dashed #ced4da;
    border-radius: 12px;
    padding: 12px;
    transition: 0.2s;
}

.doc-card:hover {
    border-color: #0d6efd;
    background: #f8f9ff;
}
</style>

<div class="container kyc-wrapper">

    <!-- Header -->
    <div class="glass-card p-4 mb-4">
        <div class="kyc-header mb-3">
            <h4 class="mb-0">KYC Verification</h4>
            <span class="status-pill bg-{{ $statusColor }} text-white">
                {{ $statusLabel }}
            </span>
        </div>

        <div class="mb-2 d-flex justify-content-between">
            <small>Progress</small>
            <small>{{ $percent }}%</small>
        </div>

        <div class="progress-modern">
            <div class="bar bg-{{ $statusColor }}" style="width: {{ $percent }}%"></div>
        </div>
    </div>

    <!-- Status Message -->
    @if($status == 'pending')
        <div class="alert alert-warning glass-card">
            ⏳ Your KYC is under review. Verification usually takes 24–48 hours.
        </div>
    @elseif($status == 'approved')
        <div class="alert alert-success glass-card">
            ✅ KYC Approved! You now have full access to withdrawals and earnings.
        </div>
    @elseif($status == 'rejected')
        <div class="alert alert-danger glass-card">
            ❌ KYC Rejected  
            <div class="mt-2">
                <strong>Reason:</strong> {{ $kyc->admin_remark }}
            </div>
            <div class="mt-2">Please correct the details and re-submit.</div>
        </div>
    @endif

    <!-- Form Card -->
    <div class="glass-card p-4">
        <form action="{{ route('user.kyc.submit') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Dynamic Fields -->
            <x-viser-form identifier="act" identifierValue="kyc" />

            

            <!-- Action Button -->
            <div class="mt-4">
                @if(!isset($kyc) || $kyc->status != 'approved')
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        {{ isset($kyc) && $kyc->status == 'rejected' ? 'Re-submit KYC' : 'Submit KYC' }}
                    </button>
                @else
                    <button class="btn btn-success btn-lg w-100" disabled>
                        KYC Approved ✔
                    </button>
                @endif
            </div>
        </form>
    </div>

</div>
<!-- Documents Preview -->
            <div class="row mt-4">
                @if(!empty($kyc->id_proof))
                    <div class="col-md-6 mb-3">
                        <div class="doc-card">
                            <small class="text-muted">Uploaded ID Proof</small>
                            <div class="mt-2">
                                <a href="{{ asset('storage/'.$kyc->id_proof) }}" target="_blank"
                                   class="btn btn-sm btn-outline-primary w-100">
                                    View Document
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                @if(!empty($kyc->bank_proof))
                    <div class="col-md-6 mb-3">
                        <div class="doc-card">
                            <small class="text-muted">Uploaded Bank Proof</small>
                            <div class="mt-2">
                                <a href="{{ asset('storage/'.$kyc->bank_proof) }}" target="_blank"
                                   class="btn btn-sm btn-outline-primary w-100">
                                    View Document
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

@endsection

@push('script')
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    let aadhaar = document.querySelector('[name="aadhaar"]')?.value || '';
    let pan = document.querySelector('[name="pan"]')?.value || '';

    if(aadhaar && !/^\d{12}$/.test(aadhaar)) {
        alert('Aadhaar must be exactly 12 digits');
        e.preventDefault();
    }

    if(pan && !/^[A-Z]{5}[0-9]{4}[A-Z]$/.test(pan)) {
        alert('PAN format invalid. Example: ABCDE1234F');
        e.preventDefault();
    }
});
</script>
@endpush
