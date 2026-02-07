@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">{{ $pageTitle }}</h4>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-body">

                    <!-- User Info -->
                    <h5>User Information</h5>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <strong>Name:</strong> {{ $kyc->user->name ?? 'N/A' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Email:</strong> {{ $kyc->user->email ?? 'N/A' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Status:</strong>
                            <span class="badge 
                                {{ $kyc->status == 'pending' ? 'bg-warning' : 
                                   ($kyc->status == 'approved' ? 'bg-success' : 'bg-danger') }}">
                                {{ ucfirst($kyc->status) }}
                            </span>
                        </li>
                    </ul>

                    <!-- KYC Details -->
                    <h5>KYC Details</h5>
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><strong>Aadhaar:</strong> {{ $kyc->aadhaar }}</li>
                        <li class="list-group-item"><strong>PAN:</strong> {{ $kyc->pan }}</li>
                        <li class="list-group-item"><strong>Bank:</strong> {{ $kyc->bank_name }}</li>
                        <li class="list-group-item"><strong>Account:</strong> {{ $kyc->account_number }}</li>
                        <li class="list-group-item"><strong>IFSC:</strong> {{ $kyc->ifsc }}</li>
                    </ul>

                    <!-- Documents -->
                    <h5>Documents</h5>
                    <div class="mb-3">
                        <a href="{{ asset('storage/'.$kyc->id_proof) }}" target="_blank"
                           class="btn btn-outline-primary">
                            View ID Proof
                        </a>

                        <a href="{{ asset('storage/'.$kyc->bank_proof) }}" target="_blank"
                           class="btn btn-outline-secondary ms-2">
                            View Bank Proof
                        </a>
                    </div>

                    <!-- Admin Remark -->
                    @if($kyc->status == 'rejected')
                        <div class="alert alert-danger">
                            <strong>Rejection Reason:</strong> {{ $kyc->admin_remark }}
                        </div>
                    @endif

                    <!-- Actions -->
                    @if($kyc->status == 'pending')
                        <div class="d-flex justify-content-end gap-2">
                            <form action="{{ route('admin.kyc.reject', $kyc->id) }}" method="POST">
                                @csrf
                                <input type="text" name="remark" class="form-control mb-2"
                                       placeholder="Rejection reason" required>
                                <button class="btn btn-danger">Reject</button>
                            </form>

                            <form action="{{ route('admin.kyc.approve', $kyc->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-success">
                                    Approve
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
