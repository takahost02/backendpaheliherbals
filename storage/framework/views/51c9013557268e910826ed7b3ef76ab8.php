<?php $__env->startSection('content'); ?>
    <div class="card custom--card">
        <div class="card-body">
            <form method="post">
                <?php echo csrf_field(); ?>
                <div class="form--group">
                    <label class="form--label"><?php echo app('translator')->get('Current Password'); ?></label>
                    <input class="form-control form--control" name="current_password" type="password" required autocomplete="current-password">
                </div>
                <div class="form--group">
                    <label class="form--label"><?php echo app('translator')->get('Password'); ?></label>
                    <input class="form-control form--control <?php if(gs('secure_password')): ?> secure-password <?php endif; ?>" name="password" type="password" required autocomplete="current-password">
                </div>
                <div class="form--group">
                    <label class="form--label"><?php echo app('translator')->get('Confirm Password'); ?></label>
                    <input class="form-control form--control" name="password_confirmation" type="password" required autocomplete="current-password">
                </div>
                <button class="btn btn--base w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php if(gs('secure_password')): ?>
    <?php $__env->startPush('script-lib'); ?>
        <script src="<?php echo e(asset('assets/global/js/secure_password.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/templates/basic/user/password.blade.php ENDPATH**/ ?>