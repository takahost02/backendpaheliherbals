

<?php $__env->startSection('content'); ?>
<div class="card custom--card p-0">
    <div class="card-body p-0">
        <div class="table-responsive--sm">
            <table class="table custom--table">
                <thead>
                <tr>
                    <th><?php echo app('translator')->get('Paid left'); ?></th>
                    <th><?php echo app('translator')->get('Paid right'); ?></th>
                    <th><?php echo app('translator')->get('Free left'); ?></th>
                    <th><?php echo app('translator')->get('Free right'); ?></th>
                    <th><?php echo app('translator')->get('Bv left'); ?></th>
                    <th><?php echo app('translator')->get('Bv right'); ?></th>
                    <th><?php echo app('translator')->get('Pair Match'); ?></th>
                    <th><?php echo app('translator')->get('Royalty Comm'); ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo e($logs->paid_left); ?></td>
                    <td><?php echo e($logs->paid_right); ?></td>
                    <td><?php echo e($logs->free_left); ?></td>
                    <td><?php echo e($logs->free_right); ?></td>
                    <td><?php echo e(getAmount($logs->bv_left)); ?></td>
                    <td><?php echo e(getAmount($logs->bv_right)); ?></td>
                    <td><?php echo e($minPaidSide); ?></td>
                    <td><?php echo e(getAmount($royaltyCommission)); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/user/royaltySummery.blade.php ENDPATH**/ ?>