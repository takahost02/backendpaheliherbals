<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom--card p-0">
                <div class="card-body p-0">
                    <div class="table-responsive--sm">
                        <table class="custom--table table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Sl'); ?></th>
                                    <th><?php echo app('translator')->get('BV'); ?></th>
                                    <th><?php echo app('translator')->get('Position'); ?></th>
                                    <th><?php echo app('translator')->get('Detail'); ?></th>
                                    <th><?php echo app('translator')->get('Date'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($logs->firstItem() + $key); ?></td>
                                        <td class="budget">
                                            <strong <?php if($data->trx_type == '+'): ?> class="text--success" <?php else: ?> class="text--danger" <?php endif; ?>>
                                                <?php echo e($data->trx_type == '+' ? '+' : '-'); ?> <?php echo e(getAmount($data->amount)); ?></strong>
                                        </td>
                                        <td>
                                            <?php if($data->position == 1): ?>
                                                <span class="badge badge--success"><?php echo app('translator')->get('Left'); ?></span>
                                            <?php else: ?>
                                                <span class="badge badge--primary"><?php echo app('translator')->get('Right'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($data->details); ?></td>
                                        <td><?php echo e($data->created_at != '' ? date('d/m/y  g:i A', strtotime($data->created_at)) : __('Not Assign')); ?></td>
                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php if($logs->hasPages()): ?>
                <div class="mt-4">
                    <?php echo e(paginateLinks($logs)); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/user/bvLog.blade.php ENDPATH**/ ?>