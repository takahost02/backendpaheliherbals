<?php $__env->startSection('content'); ?>
    <div class="padding-top padding-bottom">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <h5 class="border-bottom pb-3 text-center"><?php echo app('translator')->get('2FA Verification'); ?></h5>
                        <form class="submit-form mt-4" action="<?php echo e(route('user.2fa.verify')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <?php echo $__env->make($activeTemplate . 'partials.verification_code', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <button class="btn btn--base w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/user/auth/authorization/2fa.blade.php ENDPATH**/ ?>