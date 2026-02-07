@extends('admin.layouts.app')

@section('panel')

@php
    // Support both controller variable names
    $withdrawal = $withdraw ?? $withdrawal ?? null;
@endphp

@if(!$withdrawal)
    <div class="alert alert-danger text-center">
        @lang('Withdrawal data not found. Please go back and try again.')
    </div>
    @return
@endif

<div class="row mb-none-30">

    {{-- ========================= --}}
    {{-- LEFT: WITHDRAW SUMMARY --}}
    {{-- ========================= --}}
    <div class="col-lg-4 col-md-4 mb-30">
        <div class="card overflow-hidden box--shadow1">
            <div class="card-body">

                <h5 class="mb-3 text-muted">
                    @lang('Withdraw Via')
                    {{ __($withdrawal->method->name ?? '-') }}
                </h5>

                <ul class="list-group list-group-flush">

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Date')</span>
                        <span class="fw-bold">
                            {{ showDateTime($withdrawal->created_at) }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Trx Number')</span>
                        <span class="fw-bold">
                            {{ $withdrawal->trx ?? '-' }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Username')</span>
                        <span class="fw-bold">
                            @if($withdrawal->user)
                                <a href="{{ route('admin.users.detail', $withdrawal->user_id) }}">
                                    <span>@</span>{{ $withdrawal->user->username }}
                                </a>
                            @else
                                -
                            @endif
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Method')</span>
                        <span class="fw-bold">
                            {{ __($withdrawal->method->name ?? '-') }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Amount')</span>
                        <span class="fw-bold">
                            {{ showAmount($withdrawal->amount) }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Charge')</span>
                        <span class="fw-bold">
                            {{ showAmount($withdrawal->charge) }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('After Charge')</span>
                        <span class="fw-bold">
                            {{ showAmount($withdrawal->after_charge) }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Rate')</span>
                        <span class="fw-bold">
                            1 {{ __(gs('cur_text')) }} =
                            {{ showAmount($withdrawal->rate) }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Payable')</span>
                        <span class="fw-bold">
                            {{ showAmount($withdrawal->final_amount) }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Status')</span>
                        <span>
                            {!! $withdrawal->statusBadge !!}
                        </span>
                    </li>

                    @if(!empty($withdrawal->admin_feedback))
                        <li class="list-group-item">
                            <strong>@lang('Admin Response')</strong>
                            <p class="mb-0 mt-1 text-muted">
                                {{ $withdrawal->admin_feedback }}
                            </p>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>

    {{-- ========================= --}}
    {{-- RIGHT: USER DETAILS --}}
    {{-- ========================= --}}
    <div class="col-lg-8 col-md-8 mb-30">
        <div class="card overflow-hidden box--shadow1">
            <div class="card-body">

                <h5 class="card-title border-bottom pb-2 mb-3">
                    @lang('User Withdraw Information')
                </h5>

                {{-- Dynamic Withdraw Form Data --}}
                @if(!empty($details))
                    @foreach(json_decode($details) as $val)
                        <div class="row mb-3">
                            <div class="col-12">

                                <h6 class="mb-1">
                                    {{ __($val->name ?? '-') }}
                                </h6>

                                @if(($val->type ?? '') === 'checkbox')
                                    <p class="mb-0">
                                        {{ implode(', ', (array) ($val->value ?? [])) }}
                                    </p>

                                @elseif(($val->type ?? '') === 'file')
                                    @if(!empty($val->value))
                                        <a
                                            href="{{ route('admin.download.attachment', encrypt(getFilePath('verify') . '/' . $val->value)) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fa-regular fa-file"></i>
                                            @lang('Download Attachment')
                                        </a>
                                    @else
                                        <p class="text-muted mb-0">
                                            @lang('No File')
                                        </p>
                                    @endif
                                @else
                                    <p class="mb-0">
                                        {{ __($val->value ?? '-') }}
                                    </p>
                                @endif

                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">
                        @lang('No additional withdrawal information provided.')
                    </p>
                @endif

                {{-- ACTION BUTTONS --}}
                @if($withdrawal->status == Status::PAYMENT_PENDING)
                    <div class="mt-4 d-flex gap-2">
                        <button
                            type="button"
                            class="btn btn-outline--success btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#approveModal">
                            <i class="las la-check"></i>
                            @lang('Approve')
                        </button>

                        <button
                            type="button"
                            class="btn btn-outline--danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#rejectModal">
                            <i class="las la-ban"></i>
                            @lang('Reject')
                        </button>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- ========================= --}}
{{-- APPROVE MODAL --}}
{{-- ========================= --}}
<div id="approveModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    @lang('Approve Withdrawal Confirmation')
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <form
                action="{{ route('admin.withdraw.data.approve', $withdrawal->id) }}"
                method="POST">
                @csrf

                <div class="modal-body">
                    <p class="mb-2">
                        @lang('Have you sent')
                        <span class="fw-bold text--success">
                            {{ showAmount($withdrawal->final_amount, currencyFormat: false) }}
                            {{ $withdrawal->currency }}
                        </span>?
                    </p>

                    <textarea
                        name="details"
                        class="form-control"
                        rows="3"
                        placeholder="@lang('Provide the details. eg: transaction number')"
                        required>{{ old('details') }}</textarea>
                </div>

                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn--primary w-100">
                        @lang('Submit')
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- ========================= --}}
{{-- REJECT MODAL --}}
{{-- ========================= --}}
<div id="rejectModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    @lang('Reject Withdrawal Confirmation')
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <form
                action="{{ route('admin.withdraw.data.reject', $withdrawal->id) }}"
                method="POST">
                @csrf

                <div class="modal-body">
                    <label class="form-label">
                        @lang('Reason of Rejection')
                    </label>

                    <textarea
                        name="details"
                        class="form-control"
                        rows="3"
                        placeholder="@lang('Provide rejection reason')"
                        required>{{ old('details') }}</textarea>
                </div>

                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn--primary w-100">
                        @lang('Submit')
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

