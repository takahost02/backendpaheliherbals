<?php $__env->startSection('panel'); ?>
<?php $__env->startPush('topBar'); ?>
  <?php echo $__env->make('admin.notification.top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
<div class="row">
    <?php echo $__env->make('admin.notification.global_template_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.notification.global_shortcodes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="col-md-12">
        <div class="card mt-5">
            <div class="card-body">
                <form action="<?php echo e(route('admin.setting.notification.global.sms.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('SMS Sent From'); ?> </label>
                                <input class="form-control" placeholder="<?php echo app('translator')->get('SMS Sent From'); ?>" name="sms_from" value="<?php echo e(gs('sms_from')); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('SMS Body'); ?> </label>
                                <textarea class="form-control" rows="4" placeholder="<?php echo app('translator')->get('SMS Body'); ?>" name="sms_template" required><?php echo e(gs('sms_template')); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn w-100 btn--primary h-45"><?php echo app('translator')->get('Submit'); ?></button>
                </form>
            </div>
        </div><!-- card end -->
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/admin/notification/global_sms_template.blade.php ENDPATH**/ ?>