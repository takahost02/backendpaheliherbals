

<?php $__env->startSection('content'); ?>
<div class="row">

    
    <div class="col-12 text-center mb-4">
        <h3><?php echo app('translator')->get('Rewards Income'); ?></h3>
        <h4 class="text-success">
            ₹ <?php echo e(number_format($totalReward,2)); ?>

        </h4>
        <small class="text-muted"><?php echo app('translator')->get('Total Rewards Earned'); ?></small>
    </div>

    
    <div class="col-12">
        <div class="card custom--card">
            <div class="card-body p-0">
                <table class="table custom--table mb-0">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('Date'); ?></th>
                            <th><?php echo app('translator')->get('Reward'); ?></th>
                            <th><?php echo app('translator')->get('Type'); ?></th>
                            <th><?php echo app('translator')->get('Amount'); ?></th>
                            <th><?php echo app('translator')->get('Status'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $rewards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e(showDateTime($row->created_at)); ?></td>
                            <td>
                                <strong><?php echo e($row->title); ?></strong><br>
                                <small><?php echo e($row->description); ?></small>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    <?php echo e(ucfirst($row->reward_type)); ?>

                                </span>
                            </td>
                            <td>
                                ₹ <?php echo e(number_format($row->reward_amount,2)); ?>

                            </td>
                            <td>
                                <span class="badge <?php echo e($row->status ? 'bg-success':'bg-warning'); ?>">
                                    <?php echo e($row->status ? 'Paid':'Pending'); ?>

                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                <?php echo app('translator')->get('No rewards found'); ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php echo e($rewards->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/reward/index.blade.php ENDPATH**/ ?>