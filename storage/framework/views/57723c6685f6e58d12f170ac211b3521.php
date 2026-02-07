<?php $__env->startSection('panel'); ?>
    <div class="card">
        <form action="<?php echo e(route('admin.setting.notice.update')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('All user notice'); ?></label>
                            <textarea class="form-control nicEdit" name="notice" rows="10"><?php echo e(__(gs('notice'))); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Free user notice'); ?></label>
                            <textarea class="form-control nicEdit" name="free_user_notice" rows="10"><?php echo e(__(gs('free_user_notice'))); ?></textarea>
                        </div>
                        <div>
                            <button class="btn w-100 h-45 btn-primary mr-2" type="submit"><?php echo app('translator')->get('Update'); ?></button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/admin/notice.blade.php ENDPATH**/ ?>