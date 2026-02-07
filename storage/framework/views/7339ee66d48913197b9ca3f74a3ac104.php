

<?php $__env->startSection('content'); ?>
<div class="card custom--card p-0">
    <div class="card-body p-0">
        <div class="table-responsive--sm">
            <table class="table custom--table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('Level'); ?></th>
                        <th><?php echo app('translator')->get('From User'); ?></th>
                        <th><?php echo app('translator')->get('Amount'); ?></th>
                        <th><?php echo app('translator')->get('Date'); ?></th>
                        <th><?php echo app('translator')->get('Details'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>Level <?php echo e($commission->level); ?></td>
                            <td><?php echo e($commission->source_username); ?></td>
                            <td><?php echo e(showAmount($commission->amount)); ?> <?php echo e(__(gs()->cur_text)); ?></td>
                            <td><?php echo e(showDateTime($commission->created_at)); ?></td>
                            <td><?php echo e(__($commission->details)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-muted text-center" colspan="100%"><?php echo e(__('No level commissions found')); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
            <?php if($commissions->hasPages()): ?>
                <div class="pagination-wrapper mt-3">
                    <?php echo e($commissions->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/user/matrixIncome.blade.php ENDPATH**/ ?>