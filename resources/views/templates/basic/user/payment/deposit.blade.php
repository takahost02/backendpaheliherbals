@extends($activeTemplate . 'layouts.master')

@section('content')
<div class="text-end mb-3">
    <a class="btn btn--base" href="{{ route('user.deposit.history') }}">
        <i class="las la-list"></i> @lang('Deposit History')
    </a>
</div>

<div class="gateway-card">
    <div class="row justify-content-center gy-sm-4 gy-3">
        <div class="col-lg-6">
            <div class="payment-system-list is-scrollable gateway-option-list">
                @foreach ($gatewayCurrency as $data)
                    <label for="{{ titleToKey($data->name) }}"
                        class="payment-item @if ($loop->index > 4) d-none @endif gateway-option">
                        <div class="payment-item__info">
                            <span class="payment-item__check"></span>
                            <span class="payment-item__name">{{ __($data->name) }}</span>
                        </div>
                        <div class="payment-item__thumb">
                            <img class="payment-item__thumb-img"
                                src="{{ getImage(getFilePath('gateway') . '/' . $data->method->image) }}"
                                alt="@lang('payment-thumb')">
                        </div>
                        <input class="payment-item__radio gateway-input" id="{{ titleToKey($data->name) }}" hidden
                            data-gateway='@json($data)' type="radio" name="gateway"
                            value="{{ $data->method_code }}"
                            @if (old('gateway')) @checked(old('gateway') == $data->method_code) @endif
                            data-min-amount="{{ showAmount($data->min_amount) }}"
                            data-max-amount="{{ showAmount($data->max_amount) }}">
                    </label>
                @endforeach
                

                @if ($gatewayCurrency->count() > 4)
                    <button type="button" class="payment-item__btn more-gateway-option mt-3">
                        <p class="payment-item__btn-text">@lang('Show All Payment Options')</p>
                        <span class="payment-item__btn__icon"><i class="fas fa-chevron-down"></i></span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

@push('style')
<style>
    /* Premium Offline Cash Styling */
    .premium-cash-option {
        border: 2px solid #ffc107;
        background-color: rgba(255, 193, 7, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .premium-cash-option.active {
        border-color: #28a745;
        background-color: rgba(40, 167, 69, 0.1);
    }
    
    .premium-cash-option .payment-item__name {
        font-weight: 600;
        color: #ffc107;
    }
    
    .premium-cash-option.active .payment-item__name {
        color: #28a745;
    }
    
    .premium-cash-option .payment-item__desc {
        font-size: 0.75rem;
        color: #6c757d;
        display: block;
    }
    
    .premium-icon {
        color: #ffc107;
        font-size: 32px;
        position: relative;
    }
    
    .premium-badge-icon {
        position: absolute;
        top: -8px;
        right: -8px;
        font-size: 16px;
        color: #ffc107;
    }
    
    .premium-separator {
        position: relative;
        text-align: center;
        margin: 1.5rem 0;
    }
    
    .premium-line {
        border-top: 1px dashed #ffc107;
        margin: 0;
    }
    
    .premium-badge {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #ffc107;
        color: #000;
        padding: 0 1rem;
        font-size: 0.75rem;
        font-weight: bold;
        border-radius: 20px;
    }
</style>
@endpush

<div class="card custom--card">
    <div class="card-body">
        <form action="{{ route('user.deposit.insert') }}" method="post" class="deposit-form">
            @csrf
            <input type="hidden" name="currency">
            <div class="gateway-card">
                <div class="row justify-content-center gy-sm-4 gy-3">
                    <div class="col-lg-6">
                        <div class="payment-system-list is-scrollable gateway-option-list">
                            @foreach ($gatewayCurrency as $data)
                                <label for="{{ titleToKey($data->name) }}"
                                    class="payment-item @if ($loop->index > 4) d-none @endif gateway-option">
                                    <div class="payment-item__info">
                                        <span class="payment-item__check"></span>
                                        <span class="payment-item__name">{{ __($data->name) }}</span>
                                    </div>
                                    <div class="payment-item__thumb">
                                        <img class="payment-item__thumb-img"
                                            src="{{ getImage(getFilePath('gateway') . '/' . $data->method->image) }}"
                                            alt="@lang('payment-thumb')">
                                    </div>
                                    <input class="payment-item__radio gateway-input" id="{{ titleToKey($data->name) }}" hidden
                                        data-gateway='@json($data)' type="radio" name="gateway"
                                        value="{{ $data->method_code }}"
                                        @if (old('gateway')) @checked(old('gateway') == $data->method_code) @endif
                                        data-min-amount="{{ showAmount($data->min_amount) }}"
                                        data-max-amount="{{ showAmount($data->max_amount) }}">
                                </label>
                            @endforeach
                            
                            <!-- Include Bootstrap Icons (place in your main layout once) -->
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
            
                            {{-- Premium Offline Cash Payment --}}
                            <div class="premium-separator my-3 position-relative">
                                <span class="premium-badge">@lang('Recommended')</span>
                                <hr class="premium-line">
                            </div>
            
                            <label for="offline-cash" class="payment-item gateway-option premium-cash-option active">
                                <div class="payment-item__info">
                                    <span class="payment-item__check"></span>
                                    <span class="payment-item__name">@lang('Offline Cash Payment')</span>
                                    <small class="payment-item__desc">@lang('Easy confirmation, no fees')</small>
                                </div>
                                <div class="payment-item__thumb d-flex align-items-center justify-content-center premium-icon">
                                    <i class="bi bi-cash-coin"></i>
                                    <i class="bi bi-stars premium-badge-icon"></i>
                                </div>
                                <input class="payment-item__radio gateway-input" id="offline-cash" hidden
                                    data-gateway='{"method_code":999,"currency":"INR","rate":1,"percent_charge":0,"fixed_charge":0,"min_amount":10,"max_amount":50000,"method":{"crypto":0}}'
                                    type="radio" name="gateway" value="999" checked
                                    data-min-amount="10.00" data-max-amount="50000.00">
                            </label>
                            
                            {{-- Online Payment --}}
                            <label for="online-payment" class="payment-item gateway-option online-payment-option">
                                <div class="payment-item__info">
                                    <span class="payment-item__check"></span>
                                    <span class="payment-item__name">@lang('Online Payment')</span>
                                    <small class="payment-item__desc">@lang('Instant, Secure & Easy')</small>
                                </div>
                                <div class="payment-item__thumb d-flex align-items-center justify-content-center online-icon">
                                    <i class="bi bi-credit-card"></i>
                                    <i class="bi bi-stars premium-badge-icon"></i>
                                </div>
                                
                            </label>

            
                            @if ($gatewayCurrency->count() > 4)
                                <button type="button" class="payment-item__btn more-gateway-option mt-3">
                                    <p class="payment-item__btn-text">@lang('Show All Payment Options')</p>
                                    <span class="payment-item__btn__icon"><i class="fas fa-chevron-down"></i></span>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="payment-system-list p-3">
                            <div class="deposit-info">
                                <div class="deposit-info__title">
                                    <p class="text mb-0">@lang('Amount')</p>
                                </div>
                                <div class="deposit-info__input">
                                    <div class="deposit-info__input-group input-group">
                                        <span class="deposit-info__input-group-text px-2">{{ gs('cur_sym') }}</span>
                                        <input type="text" class="form-control form--control amount" name="amount"
                                            placeholder="@lang('00.00')" value="{{ old('amount') }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="deposit-info">
                                <div class="deposit-info__title">
                                    <p class="text has-icon">@lang('Limit')</p>
                                </div>
                                <div class="deposit-info__input">
                                    <p class="text"><span class="gateway-limit">@lang('0.00')</span></p>
                                </div>
                            </div>

                            <div class="deposit-info">
                                <div class="deposit-info__title">
                                    <p class="text has-icon">@lang('Processing Charge')
                                        <span data-bs-toggle="tooltip" title="@lang('Processing charge for payment gateways')" class="proccessing-fee-info">
                                            <i class="las la-info-circle"></i>
                                        </span>
                                    </p>
                                </div>
                                <div class="deposit-info__input">
                                    <p class="text"><span class="processing-fee">@lang('0.00')</span> {{ __(gs('cur_text')) }}</p>
                                </div>
                            </div>

                            <div class="deposit-info total-amount pt-3">
                                <div class="deposit-info__title">
                                    <p class="text">@lang('Total')</p>
                                </div>
                                <div class="deposit-info__input">
                                    <p class="text"><span class="final-amount">@lang('0.00')</span> {{ __(gs('cur_text')) }}</p>
                                </div>
                            </div>

                            <div class="d-none crypto-message mb-3">
                                @lang('Conversion with') <span class="gateway-currency"></span> @lang('and final value will Show on next step')
                            </div>

                            <button type="submit" class="btn btn--base w-100" disabled>
                                @lang('Confirm Deposit')
                            </button>

                            <div class="info-text pt-3">
                                <p class="text">@lang('Ensuring your funds grow safely through our secure deposit process with world-class payment options.')</p>
                            </div>
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
    (function($) {
        var amount = parseFloat($('.amount').val() || 0);
        var gateway, minAmount, maxAmount;

        $('.amount').on('input', function() {
            amount = parseFloat($(this).val()) || 0;
            calculation();
        });

        $('.gateway-input').on('change', function() {
            gatewayChange();
        });

        function gatewayChange() {
            let gatewayElement = $('.gateway-input:checked');
            gateway = gatewayElement.data('gateway');
            minAmount = gatewayElement.data('min-amount');
            maxAmount = gatewayElement.data('max-amount');

            let processingFeeInfo = `${parseFloat(gateway.percent_charge).toFixed(2)}% with ${parseFloat(gateway.fixed_charge).toFixed(2)} {{ __(gs('cur_text')) }} charge`;
            $(".proccessing-fee-info").attr("data-bs-original-title", processingFeeInfo);
            calculation();
        }

        $(".more-gateway-option").on("click", function() {
            $(".gateway-option-list").find(".gateway-option").removeClass("d-none");
            $(this).addClass('d-none');
        });

        function calculation() {
            if (!gateway) return;

            $(".gateway-limit").text(minAmount + " - " + maxAmount);

            let percentCharge = parseFloat(gateway.percent_charge || 0);
            let fixedCharge = parseFloat(gateway.fixed_charge || 0);
            let totalCharge = (amount * percentCharge / 100) + fixedCharge;
            let totalAmount = amount + totalCharge;

            $(".final-amount").text(totalAmount.toFixed(2));
            $(".processing-fee").text(totalCharge.toFixed(2));
            $("input[name=currency]").val(gateway.currency);
            $(".gateway-currency").text(gateway.currency);

            if (amount < parseFloat(gateway.min_amount) || amount > parseFloat(gateway.max_amount)) {
                $(".deposit-form button[type=submit]").attr('disabled', true);
            } else {
                $(".deposit-form button[type=submit]").removeAttr('disabled');
            }

            if (gateway.method.crypto == 1) {
                $('.crypto-message').removeClass('d-none');
            } else {
                $('.crypto-message').addClass('d-none');
            }
        }

        $('.gateway-input').change();

        // Bootstrap tooltip init
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(el) {
            return new bootstrap.Tooltip(el);
        });
    })(jQuery);
</script>
@endpush
