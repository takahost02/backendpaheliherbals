<?php $__env->startSection('content'); ?>
    <div class="card custom--card">
        <form class="contact-form" method="POST" action="<?php echo e(route('user.balance.transfer')); ?>">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="text-center">
                    <div class="alert block-none alert-danger p-2" role="alert">
                        <strong><?php echo app('translator')->get('Balance Transfer Charge'); ?> <?php echo e(getAmount(gs('bal_trans_fixed_charge'))); ?> <?php echo e(__(gs('cur_text'))); ?> <?php echo app('translator')->get('Fixed and'); ?>
                            <?php echo e(getAmount(gs('bal_trans_per_charge'))); ?>

                            % <?php echo app('translator')->get('of your total amount to transfer balance.'); ?></strong> <br/>
                        <p id="after-balance" class="d-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label form--label"><?php echo app('translator')->get('Username / Email To Send Amount'); ?> </label>
                    <input class="form-control form--control" id="username" name="username" type="text" placeholder="<?php echo app('translator')->get('username / email'); ?>" required
                        autocomplete="off">
                    <span id="position-test"></span>
                </div>
                <div class="form-group">
                    <label class="form-label form--label" for="InputMail"><?php echo app('translator')->get('Transfer Amount'); ?></label>
                    <input class="form-control form--control" type="number" step="any" id="amount" name="amount"
                        onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" autocomplete="off"
                        placeholder="<?php echo app('translator')->get('Amount'); ?> <?php echo e(__(gs('cur_text'))); ?>" required>
                    <span id="balance-message"></span>
                </div>
                <button class="btn btn--base w-100" type="submit"><?php echo app('translator')->get('Transfer Balance'); ?></button>
            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        (function($) {
            $(document).on('focusout', '#username', function() {
                var username = $('#username').val();
                var token = "<?php echo e(csrf_token()); ?>";
                if (username) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(route('user.search.user')); ?>",
                        data: {
                            'username': username,
                            '_token': token
                        },
                        success: function(data) {
                            if (data.success) {
                                $('#position-test').html('<div class="text--success mt-1"><?php echo app('translator')->get('User found'); ?></div>');
                            } else {
                                $('#position-test').html('<div class="text--danger mt-2"><?php echo app('translator')->get('User not found'); ?></div>');
                            }
                        }
                    });
                } else {
                    $('#position-test').html('');
                }
            });
            $(document).on('keyup', '#amount', function() {
                var amount = parseFloat($('#amount').val());
                var balance = parseFloat("<?php echo e(Auth::user()->balance + 0); ?>");
                var fixed_charge = parseFloat("<?php echo e(gs('bal_trans_fixed_charge') + 0); ?>");
                var percent_charge = parseFloat("<?php echo e(gs('bal_trans_per_charge') + 0); ?>");
                var percent = (amount * percent_charge) / 100;
                var with_charge = amount + fixed_charge + percent;
                if (with_charge > balance) {
                    $('#after-balance').html('<p  class="text--danger">' + with_charge + ' <?php echo e(gs('cur_text')); ?> ' +
                        ' <?php echo e(__('will be subtracted from your balance')); ?>' + '</p>');
                    $('#balance-message').html('<small class="text--danger">Insufficient Balance!</small>');
                } else if (with_charge <= balance) {
                    $('#after-balance').html('<p class="text--danger">' + with_charge + ' <?php echo e(gs('cur_text')); ?> ' +
                        ' <?php echo e(__('will be subtracted from your balance')); ?>' + '</p>');
                    $('#balance-message').html('');
                }
            });
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/templates/basic/user/balanceTransfer.blade.php ENDPATH**/ ?>