

<?php $__env->startSection('content'); ?>

<?php
    $filter = $filter ?? 'today';
    $totalIncome = $totalIncome ?? 0;
?>

<div class="card custom--card">

    
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Master Matching Income History</h5>
    </div>

    
    <div class="card-body border-bottom">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">

            
            <div class="mb-3 mb-md-0">
                <h6 class="mb-0">
                    Total Income:
                    <span class="text-success fw-bold">
                        <?php echo e(showAmount($totalIncome)); ?>

                    </span>
                </h6>
            </div>

            
            <div class="btn-group">
                <a href="?filter=today"
                   class="btn btn-sm <?php echo e($filter == 'today' ? 'btn-primary' : 'btn-outline-primary'); ?>">
                    Today
                </a>

                <a href="?filter=week"
                   class="btn btn-sm <?php echo e($filter == 'week' ? 'btn-primary' : 'btn-outline-primary'); ?>">
                    This Week
                </a>

                <a href="?filter=month"
                   class="btn btn-sm <?php echo e($filter == 'month' ? 'btn-primary' : 'btn-outline-primary'); ?>">
                    This Month
                </a>
            </div>

        </div>
    </div>

    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table custom--table mb-0">
                <thead>
                    <tr>
                        <th>TRX ID</th>
                        <th>Session</th>
                        <th>Pairs</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Post Balance</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <?php
                            $details = $trx->details ?? '';

                            // Extract Session (AM/PM)
                            preg_match('/\((.*?)\)/', $details, $sessionMatch);
                            $session = $sessionMatch[1] ?? '-';

                            // Extract Pair Count
                            preg_match('/(\d+)\s*Pair/', $details, $pairMatch);
                            $pairs = $pairMatch[1] ?? 0;
                        ?>

                        <tr>
                            
                            <td>
                                <strong class="text-primary">
                                    <?php echo e($trx->trx); ?>

                                </strong>
                            </td>

                            
                            <td>
                                <span class="badge bg-info">
                                    <?php echo e($session); ?>

                                </span>
                            </td>

                            
                            <td>
                                <span class="fw-bold">
                                    <?php echo e($pairs); ?>

                                </span>
                            </td>

                            
                            <td>
                                <?php echo e(showDateTime($trx->created_at)); ?>

                                <br>
                                <small class="text-muted">
                                    <?php echo e(diffForHumans($trx->created_at)); ?>

                                </small>
                            </td>

                            
                            <td>
                                <span class="text-success fw-bold">
                                    + <?php echo e(showAmount($trx->amount)); ?>

                                </span>
                            </td>

                            
                            <td>
                                <?php echo e(showAmount($trx->post_balance)); ?>

                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                No Master Matching Income Found
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>


<?php if(isset($transactions) && $transactions->hasPages()): ?>
    <div class="mt-4">
        <?php echo e($transactions->appends(['filter' => $filter])->links()); ?>

    </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/binary_history.blade.php ENDPATH**/ ?>