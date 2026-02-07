

<?php $__env->startSection('content'); ?>
<div class="card custom--card p-0">
    <div class="card-body p-0">
        <div class="table-responsive--sm">
            <table class="table custom--table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('User'); ?></th>
                        <th><?php echo app('translator')->get('TRX'); ?></th>
                        <th><?php echo app('translator')->get('Transacted'); ?></th>
                        <th><?php echo app('translator')->get('Amount'); ?></th>
                        <th><?php echo app('translator')->get('Balance'); ?></th>
                        <th><?php echo app('translator')->get('Details'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <span class="fw-bold">
                                    <?php echo e(optional($trx->user)->fullname ?? 'User Deleted'); ?>

                                </span>
                                <br>
                                <span class="small">
                                    <?php if($trx->user): ?>
                                        <a href="<?php echo e(appendQuery('search', $trx->user->username)); ?>">
                                            <span>@</span><?php echo e($trx->user->username); ?>

                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">(User Deleted)</span>
                                    <?php endif; ?>
                                </span>
                            </td>

                            <td><?php echo e($trx->trx); ?></td>

                            <td>
                                <?php echo e(showDateTime($trx->created_at)); ?><br>
                                <?php echo e(diffForHumans($trx->created_at)); ?>

                            </td>

                            <td class="budget">
                                <span class="fw-bold <?php if($trx->trx_type == '+'): ?> text--success <?php else: ?> text--danger <?php endif; ?>">
                                    <?php echo e($trx->trx_type); ?> <?php echo e(showAmount($trx->amount)); ?> <?php echo e(__($general->cur_text)); ?>

                                </span>
                            </td>

                            <td class="budget">
                                <?php echo e(showAmount($trx->post_balance)); ?> <?php echo e(__($general->cur_text)); ?>

                            </td>

                            <td><?php echo e(__($trx->details)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-muted text-center" colspan="100%">
                                <?php echo e(__($emptyMessage)); ?>

                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if($transactions->hasPages()): ?>
        <div class="card-footer">
            <?php echo e($transactions->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/refferalIncome.blade.php ENDPATH**/ ?>