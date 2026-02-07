@extends($activeTemplate . 'layouts.master')

@section('content')

{{-- =======================
   Binary Withdrawal Block
======================= --}}
@if(isset($canWithdraw) && !$canWithdraw)
    <div class="alert alert-danger mb-3">
        <strong>❌ Withdrawal Blocked</strong><br>
        {{ $withdrawError ?? 'Withdrawal is currently unavailable.' }}
        <br>
        <small>
            Current PV →
            Left: {{ $binary->left_pv ?? 0 }} |
            Right: {{ $binary->right_pv ?? 0 }}
        </small>
    </div>
@endif

<div class="text-end mb-3">
    <a class="btn btn--base" href="{{ route('user.withdraw.history') }}">
        <i class="las la-list"></i> @lang('Withdraw History')
    </a>
</div>

{{-- =======================
   Available Balance
======================= --}}
<div class="header-right mb-3">
    <h6 class="title">@lang('Available Balance')</h6>
    <h6 class="ammount theme-two">
        {{ showAmount(auth()->user()->balance) }}
    </h6>
</div>

{{-- =======================
   Withdraw Card
======================= --}}
<div class="card custom--card">
    <div class="card-body">
        <form action="{{ route('user.withdraw.money') }}" method="post" class="withdraw-form">
            @csrf

            <div class="gateway-card">
                <div class="row justify-content-center gy-3">

                    {{-- =======================
                       Payment Methods
                    ======================= --}}
                    <div class="col-lg-6">
                        <div class="payment-system-list is-scrollable gateway-option-list">

                            @foreach ($withdrawMethod as $data)
                                <label
                                    for="{{ titleToKey($data->name) }}"
                                    class="payment-item gateway-option {{ $loop->index > 4 ? 'd-none' : '' }}"
                                >
                                    <div class="payment-item__info">
                                        <span class="payment-item__check"></span>
                                        <span class="payment-item__name">{{ __($data->name) }}</span>
                                    </div>

                                    <div class="payment-item__thumb">
                                        <img
                                            class="payment-item__thumb-img"
                                            src="{{ getImage(getFilePath('withdrawMethod').'/'.$data->image) }}"
                                            alt="@lang('payment-thumb')"
                                        >
                                    </div>

                                    <input
                                        type="radio"
                                        hidden
                                        class="payment-item__radio gateway-input"
                                        id="{{ titleToKey($data->name) }}"
                                        name="method_code"
                                        value="{{ $data->id }}"
                                        data-gateway='@json($data)'
                                        data-min-amount="{{ showAmount($data->min_limit) }}"
                                        data-max-amount="{{ showAmount($data->max_limit) }}"
                                        @checked(old('method_code', $withdrawMethod->first()->id) == $data->id)
                                    >
                                </label>
                            @endforeach

                            @if ($withdrawMethod->count() > 5)
                                <button type="button" class="payment-item__btn more-gateway-option">
                                    <p class="payment-item__btn-text">@lang('Show All Payment Options')</p>
                                    <span class="payment-item__btn__icon">
                                        <i class="fas fa-chevron-down"></i>
                                    </span>
                                </button>
                            @endif

                        </div>
                    </div>

                    {{-- =======================
                       Amount & Calculation
                    ======================= --}}
                    <div class="col-lg-6">
                        <div class="payment-system-list p-3">

                            {{-- Amount --}}
                            <div class="deposit-info">
                                <p class="text mb-1">@lang('Amount')</p>
                                <div class="input-group">
                                    <span class="input-group-text">{{ gs('cur_sym') }}</span>
                                    <input
                                        type="text"
                                        name="amount"
                                        class="form-control form--control amount"
                                        placeholder="0.00"
                                        value="{{ old('amount') }}"
                                        autocomplete="off"
                                    >
                                </div>
                            </div>

                            <hr>

                            {{-- Limit --}}
                            <div class="deposit-info">
                                <p class="text">@lang('Limit')</p>
                                <p class="text gateway-limit">0.00</p>
                            </div>

                            {{-- Charge --}}
                            <div class="deposit-info">
                                <p class="text">
                                    @lang('Processing Charge')
                                    <i class="las la-info-circle proccessing-fee-info"
                                       data-bs-toggle="tooltip"
                                       title="@lang('Processing charge for withdraw method')">
                                    </i>
                                </p>
                                <p class="text">
                                    {{ gs('cur_sym') }}<span class="processing-fee">0.00</span>
                                </p>
                            </div>

                            {{-- Receivable --}}
                            <div class="deposit-info total-amount pt-2">
                                <p class="text">@lang('Receivable')</p>
                                <p class="text">
                                    {{ gs('cur_sym') }}<span class="final-amount">0.00</span>
                                </p>
                            </div>

                            {{-- Conversion --}}
                            <div class="deposit-info gateway-conversion d-none pt-2">
                                <p class="text"></p>
                            </div>

                            {{-- Submit --}}
                            <button
                                type="submit"
                                class="btn btn--base w-100 mt-3"
                                {{ (isset($canWithdraw) && !$canWithdraw) ? 'disabled' : '' }}
                            >
                                @lang('Confirm Withdraw')
                            </button>

                            <p class="text pt-3">
                                @lang('Safely withdraw your funds using our highly secure process and various withdrawal methods')
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('script')
<script>
"use strict";
(function ($) {

    let amount = 0;
    let gateway;

    function calculation() {
        if (!gateway) return;

        let percent = parseFloat(gateway.percent_charge);
        let fixed   = parseFloat(gateway.fixed_charge);

        let percentCharge = (amount * percent) / 100;
        let totalCharge   = percentCharge + fixed;
        let receivable    = amount - totalCharge;

        $(".gateway-limit").text(
            gateway.min_limit + " - " + gateway.max_limit
        );

        $(".processing-fee").text(totalCharge.toFixed(2));
        $(".final-amount").text(receivable.toFixed(2));

        if (
            amount < Number(gateway.min_limit) ||
            amount > Number(gateway.max_limit)
        ) {
            $(".withdraw-form button[type=submit]").prop('disabled', true);
        } else {
            $(".withdraw-form button[type=submit]").prop(
                'disabled',
                {{ isset($canWithdraw) && !$canWithdraw ? 'true' : 'false' }}
            );
        }
    }

    $('.amount').on('input', function () {
        amount = parseFloat($(this).val()) || 0;
        calculation();
    });

    $('.gateway-input').on('change', function () {
        gateway = $(this).data('gateway');
        calculation();
    });

    $('.gateway-input:checked').trigger('change');

    $('.more-gateway-option').on('click', function () {
        $('.gateway-option').removeClass('d-none');
        $(this).remove();
    });

})(jQuery);
</script>
@endpush
