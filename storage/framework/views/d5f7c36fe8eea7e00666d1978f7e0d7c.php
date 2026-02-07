<?php $__env->startSection('panel'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light custom-data-table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Start At'); ?></th>
                                <th><?php echo app('translator')->get('End At'); ?></th>
                                <th><?php echo app('translator')->get('Execution Time'); ?></th>
                                <th><?php echo app('translator')->get('Error'); ?></th>
                                <th><?php echo app('translator')->get('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(showDateTime($log->start_at)); ?> </td>
                                    <td><?php echo e(showDateTime($log->end_at)); ?> </td>
                                    <td><?php echo e($log->duration); ?> <?php echo app('translator')->get("Seconds"); ?></td>
                                    <td><?php echo e($log->error); ?></td>
                                    <td>
                                        <?php if($log->error != null): ?>
                                        <button type="button" class="btn btn-sm btn-outline--success confirmationBtn" data-action="<?php echo e(route('admin.cron.schedule.log.resolved', $log->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to resolved this log?'); ?>">
                                            <i class="la la-check"></i> <?php echo app('translator')->get('Resolved'); ?>
                                        </button>
                                        <?php else: ?>
                                            --
                                        <?php endif; ?>
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

<?php if (isset($component)) { $__componentOriginalbd5922df145d522b37bf664b524be380 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbd5922df145d522b37bf664b524be380 = $attributes; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ConfirmationModal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbd5922df145d522b37bf664b524be380)): ?>
<?php $attributes = $__attributesOriginalbd5922df145d522b37bf664b524be380; ?>
<?php unset($__attributesOriginalbd5922df145d522b37bf664b524be380); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbd5922df145d522b37bf664b524be380)): ?>
<?php $component = $__componentOriginalbd5922df145d522b37bf664b524be380; ?>
<?php unset($__componentOriginalbd5922df145d522b37bf664b524be380); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <button type="button" class="btn btn-outline--danger confirmationBtn" data-action="<?php echo e(route('admin.cron.log.flush', $cronJob->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to flush all logs?'); ?>"><i class="la la-history"></i> <?php echo app('translator')->get('Flush Logs'); ?></button>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/admin/cron/logs.blade.php ENDPATH**/ ?>