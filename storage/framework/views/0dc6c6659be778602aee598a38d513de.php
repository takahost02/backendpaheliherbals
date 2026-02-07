<?php
    $transactionContent = getContent('transaction.content', true);
    $transactions = App\Models\Transaction::orderBy('id','desc')->take(10)->with('user')->get();
?>

<?php if(!blank($transactionContent)): ?>
<section class="transection-section padding-top padding-bottom pos-rel">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section-header text-center">
                    <span class="subtitle"><?php echo e(__(@$transactionContent->data_values->heading)); ?></span>
                    <h2 class="title"><?php echo e(__(@$transactionContent->data_values->sub_heading)); ?></h2>
                </div>
            </div>
        </div>
        <div class="transection-table-wrapper">
            <table class="transection-table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('User'); ?></th>
                        <th><?php echo app('translator')->get('Trx'); ?></th>
                        <th><?php echo app('translator')->get('Transacted'); ?></th>
                        <th><?php echo app('translator')->get('Amount'); ?></th>
                        <th><?php echo app('translator')->get('Post Balance'); ?></th>
                        <th><?php echo app('translator')->get('Detail'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="usr-type" data-label="<?php echo app('translator')->get('User'); ?>">
                            <?php if($trx->user): ?>
                                <?php echo e($trx->user->fullname); ?>

                            <?php else: ?>
                                <span class="text-muted">N/A</span>
                            <?php endif; ?>
                        </td>

                        <td data-label="<?php echo app('translator')->get('Trx'); ?>">
                            <strong><?php echo e($trx->trx); ?></strong>
                        </td>

                        <td data-label="<?php echo app('translator')->get('Transacted'); ?>">
                            <?php echo e(showDateTime($trx->created_at)); ?>

                        </td>

                        <td data-label="<?php echo app('translator')->get('Amount'); ?>" class="budget">
                            <span class="font-weight-bold <?php if($trx->trx_type == '+'): ?>text--success <?php else: ?> text--danger <?php endif; ?>">
                                <?php echo e($trx->trx_type); ?> <?php echo e(showAmount($trx->amount)); ?>

                            </span>
                        </td>

                        <td data-label="<?php echo app('translator')->get('Post Balance'); ?>" class="budget">
                           <?php echo e(showAmount($trx->post_balance)); ?>

                       </td>


                        <td data-label="<?php echo app('translator')->get('Detail'); ?>"><?php echo e(__($trx->details)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-muted text-center" colspan="100%"><?php echo app('translator')->get('Transaction not found'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /home/paheliherbals/public_html/Back/core/resources/views/templates/basic/sections/transaction.blade.php ENDPATH**/ ?>