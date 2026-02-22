@extends('admin.layouts.app')

@section('panel')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">

                @if($user)

                <ul class="list-group">

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Aadhaar</strong>
                        <span>{{ $user->aadhaar }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>PAN</strong>
                        <span>{{ $user->pan }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Bank Name</strong>
                        <span>{{ $user->bank_name }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Account Holder</strong>
                        <span>{{ $user->account_holder }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Account Number</strong>
                        <span>{{ $user->account_number }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>IFSC</strong>
                        <span>{{ $user->ifsc }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>ID Proof</strong>
                        <span>
                            @if($user->id_proof)
                                <a href="{{ asset('storage/'.$user->id_proof) }}" target="_blank">
                                    <i class="fa-regular fa-file"></i> View File
                                </a>
                            @else
                                No File
                            @endif
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Bank Proof</strong>
                        <span>
                            @if($user->bank_proof)
                                <a href="{{ asset('storage/'.$user->bank_proof) }}" target="_blank">
                                    <i class="fa-regular fa-file"></i> View File
                                </a>
                            @else
                                No File
                            @endif
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Status</strong>
                        <span class="badge bg-warning text-dark">
                            {{ ucfirst($user->status) }}
                        </span>
                    </li>

                    @if($user->admin_remark)
                    <li class="list-group-item">
                        <strong>Admin Remark:</strong>
                        <p class="mb-0 mt-1">{{ $user->admin_remark }}</p>
                    </li>
                    @endif

                </ul>

                @else
                    <h5 class="text-center">KYC data not found</h5>
                @endif


                {{-- APPROVE / REJECT BUTTONS --}}
                @if($user->status == 'pending')
                <div class="d-flex flex-wrap justify-content-end mt-3">
                    <button class="btn btn-outline-danger me-3" data-bs-toggle="modal" data-bs-target="#kycRejectionModal">
                        Reject
                    </button>

                    <button class="btn btn-outline-success confirmationBtn"
                        data-question="Are you sure to approve this documents?"
                        data-action="{{ route('admin.users.kyc.approve', $user->id) }}">
                        Approve
                    </button>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>


{{-- REJECTION MODAL --}}
<div id="kycRejectionModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Reject KYC Documents</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                    ×
                </button>
            </div>

            <form action="{{ route('admin.users.kyc.reject', $user->id) }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="alert alert-primary">
                        If rejected, user can re-submit new documents.
                    </div>

                    <div class="form-group">
                        <label>Rejection Reason</label>
                        <textarea class="form-control" name="reason" rows="4" required></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        Submit
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<x-confirmation-modal />

@endsection