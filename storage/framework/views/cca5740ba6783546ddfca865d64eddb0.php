

<?php $__env->startSection('content'); ?>


<?php if(isset($canWithdraw) && !$canWithdraw): ?>
    <div class="alert alert-danger mb-3">
        <strong>❌ Withdrawal Blocked</strong><br>
        <?php echo e($withdrawError ?? 'Withdrawal is currently unavailable.'); ?>

        <br>
        <small>
            Current PV →
            Left: <?php echo e($binary->left_pv ?? 0); ?> |
            Right: <?php echo e($binary->right_pv ?? 0); ?>

        </small>
    </div>
<?php endif; ?>

<div class="text-end mb-3">
    <a class="btn btn--base" href="<?php echo e(route('user.withdraw.history')); ?>">
        <i class="las la-list"></i> <?php echo app('translator')->get('Withdraw History'); ?>
    </a>
</div>


<div class="header-right mb-3">
    <h6 class="title"><?php echo app('translator')->get('Available Balance'); ?></h6>
    <h6 class="ammount theme-two">
        <?php echo e(showAmount(auth()->user()->balance)); ?>

    </h6>
</div>


<div class="card custom--card">
    <div class="card-body">
        <form action="<?php echo e(route('user.withdraw.money')); ?>" method="post" class="withdraw-form">
            <?php echo csrf_field(); ?>

            <div class="gateway-card">
                <div class="row justify-content-center gy-3">

                    
                    <div class="col-lg-6">
                        <div class="payment-system-list is-scrollable gateway-option-list">

                            <?php $__currentLoopData = $withdrawMethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label
                                    for="<?php echo e(titleToKey($data->name)); ?>"
                                    class="payment-item gateway-option <?php echo e($loop->index > 4 ? 'd-none' : ''); ?>"
                                >
                                    <div class="payment-item__info">
                                        <span class="payment-item__check"></span>
                                        <span class="payment-item__name"><?php echo e(__($data->name)); ?></span>
                                    </div>

                                    <div class="payment-item__thumb">
                                        <img
                                            class="payment-item__thumb-img"
                                            src="<?php echo e(getImage(getFilePath('withdrawMethod').'/'.$data->image)); ?>"
                                            alt="<?php echo app('translator')->get('payment-thumb'); ?>"
                                        >
                                    </div>

                                    <input
                                        type="radio"
                                        hidden
                                        class="payment-item__radio gateway-input"
                                        id="<?php echo e(titleToKey($data->name)); ?>"
                                        name="method_code"
                                        value="<?php echo e($data->id); ?>"
                                        data-gateway='<?php echo json_encode($data, 15, 512) ?>'
                                        data-min-amount="<?php echo e(showAmount($data->min_limit)); ?>"
                                        data-max-amount="<?php echo e(showAmount($data->max_limit)); ?>"
                                        <?php if(old('method_code', $withdrawMethod->first()->id) == $data->id): echo 'checked'; endif; ?>
                                    >
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if($withdrawMethod->count() > 5): ?>
                                <button type="button" class="payment-item__btn more-gateway-option">
                                    <p class="payment-item__btn-text"><?php echo app('translator')->get('Show All Payment Options'); ?></p>
                                    <span class="payment-item__btn__icon">
                                        <i class="fas fa-chevron-down"></i>
                                    </span>
                                </button>
                            <?php endif; ?>

                        </div>
                    </div>

                    
                    <div class="col-lg-6">
                        <div class="payment-system-list p-3">

                            
                            <div class="deposit-info">
                                <p class="text mb-1"><?php echo app('translator')->get('Amount'); ?></p>
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo e(gs('cur_sym')); ?></span>
                                    <input
                                        type="text"
                                        name="amount"
                                        class="form-control form--control amount"
                                        placeholder="0.00"
                                        value="<?php echo e(old('amount')); ?>"
                                        autocomplete="off"
                                    >
                                </div>
                            </div>

                            <hr>

                            
                            <div class="deposit-info">
                                <p class="text"><?php echo app('translator')->get('Limit'); ?></p>
                                <p class="text gateway-limit">0.00</p>
                            </div>

                            
                            <div class="deposit-info">
                                <p class="text">
                                    <?php echo app('translator')->get('Processing Charge'); ?>
                                    <i class="las la-info-circle proccessing-fee-info"
                                       data-bs-toggle="tooltip"
                                       title="<?php echo app('translator')->get('Processing charge for withdraw method'); ?>">
                                    </i>
                                </p>
                                <p class="text">
                                    <?php echo e(gs('cur_sym')); ?><span class="processing-fee">0.00</span>
                                </p>
                            </div>

                            
                            <div class="deposit-info total-amount pt-2">
                                <p class="text"><?php echo app('translator')->get('Receivable'); ?></p>
                                <p class="text">
                                    <?php echo e(gs('cur_sym')); ?><span class="final-amount">0.00</span>
                                </p>
                            </div>

                            
                            <div class="deposit-info gateway-conversion d-none pt-2">
                                <p class="text"></p>
                            </div>

                            
                            <button
                                type="submit"
                                class="btn btn--base w-100 mt-3"
                                <?php echo e((isset($canWithdraw) && !$canWithdraw) ? 'disabled' : ''); ?>

                            >
                                <?php echo app('translator')->get('Confirm Withdraw'); ?>
                            </button>

                            <p class="text pt-3">
                                <?php echo app('translator')->get('Safely withdraw your funds using our highly secure process and various withdrawal methods'); ?>
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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
                <?php echo e(isset($canWithdraw) && !$canWithdraw ? 'true' : 'false'); ?>

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
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/withdraw/methods.blade.php ENDPATH**/ ?>