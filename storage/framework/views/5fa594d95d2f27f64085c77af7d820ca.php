<?php $__env->startSection('content'); ?>
<div class="container padding-top padding-bottom">
    <div class="d-flex justify-content-center">
        <div class="verification-code-wrapper">
            <div class="verification-area">
                <h5 class="pb-3 text-center border-bottom"><?php echo app('translator')->get('Verify Email Address'); ?></h5>
                <form action="<?php echo e(route('user.verify.email')); ?>" method="POST" class="submit-form">
                    <?php echo csrf_field(); ?>
                    <p class="verification-text"><?php echo app('translator')->get('A 6 digit verification code sent to your email address'); ?>:  <?php echo e(showEmailAddress(auth()->user()->email)); ?></p>

                    <?php echo $__env->make($activeTemplate.'partials.verification_code', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="mb-3">
                        <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>

                    <div class="mb-3">
                        <p>
                            <?php echo app('translator')->get('If you don\'t get any code'); ?>, <span class="countdown-wrapper"><?php echo app('translator')->get('try again after'); ?> <span id="countdown" class="fw-bold">--</span> <?php echo app('translator')->get('seconds'); ?></span> <a href="<?php echo e(route('user.send.verify.code', 'email')); ?>" class="try-again-link d-none"> <?php echo app('translator')->get('Try again'); ?></a>
                        </p>
                        <a href="<?php echo e(route('user.logout')); ?>"><?php echo app('translator')->get('Logout'); ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        var distance =Number("<?php echo e(@$user->ver_code_send_at->addMinutes(2)->timestamp-time()); ?>");
        var x = setInterval(function() {
            distance--;
            document.getElementById("countdown").innerHTML = distance;
            if (distance <= 0) {
                clearInterval(x);
                document.querySelector('.countdown-wrapper').classList.add('d-none');
                document.querySelector('.try-again-link').classList.remove('d-none');
            }
        }, 1000);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate .'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/user/auth/authorization/email.blade.php ENDPATH**/ ?>