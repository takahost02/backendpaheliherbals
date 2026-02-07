<?php $__env->startSection('panel'); ?>
<?php $__env->startPush('topBar'); ?>
  <?php echo $__env->make('admin.notification.top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
<div class="row">
	<div class="col-lg-12">
        <div class="card">
            <div class="card-body px-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Name'); ?></th>
                                <th><?php echo app('translator')->get('Subject'); ?></th>
                                <th><?php echo app('translator')->get('Edit Template'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(__($template->name)); ?></td>
                                <td><?php echo e(__($template->subject)); ?></td>
                                <td>
                                    <div class="action-btns">
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?php echo e(route('admin.setting.notification.template.edit', ['email',$template->id])); ?>" class="btn btn-outline--primary"><?php echo app('translator')->get('Email'); ?></a>
                                            <span class="btn btn--primary"><?php if($template->email_status != Status::ENABLE): ?><i class="las la-times"></i> <?php else: ?> <i class="las la-check"></i> <?php endif; ?></span>
                                        </div>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?php echo e(route('admin.setting.notification.template.edit', ['sms',$template->id])); ?>"  class="btn btn-outline--info"><?php echo app('translator')->get('SMS'); ?></a>
                                            <span class="btn btn--info"><?php if($template->sms_status != Status::ENABLE): ?><i class="las la-times"></i> <?php else: ?> <i class="las la-check"></i> <?php endif; ?></span>
                                        </div>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?php echo e(route('admin.setting.notification.template.edit', ['push',$template->id])); ?>" class="btn btn-outline--success"><?php echo app('translator')->get('Push'); ?></a>
                                            <span class="btn btn--success"><?php if($template->push_status != Status::ENABLE): ?><i class="las la-times"></i> <?php else: ?> <i class="las la-check"></i> <?php endif; ?></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                            </tr>
                        <?php endif; ?>

                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
        </div><!-- card end -->
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        i.fas.fa-circle {
            font-size: 12px;
        }
        .btn-group button{
            padding: 0px 15px;
        }
        .btn-group span{
            width: 34px;
            font-size: 10px;
            line-height: 24px;
        }
        .table td{
            white-space: unset;
        }

        .action-btns{
            display: flex;
            justify-content: flex-end;
            gap: 4px;
            row-gap: 5px;
            flex-wrap: wrap;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/notification/template/index.blade.php ENDPATH**/ ?>