

<?php $__env->startSection('content'); ?>

<?php
    $binaryIncome   = $income['binary']   ?? 0; // Master Matching
    $directIncome   = $income['level']    ?? 0; // Matrix Level
    $matchingBonus  = $income['rank']     ?? 0;
    $rewardIncome   = 0; // if not implemented yet
    $totalEarned    = $totalIncome ?? 0;
?>

<div class="container-fluid">

    <!-- Export Buttons -->
   <!-- <div class="text-end mb-3">
        <a href="<?php echo e(route('earnings.export.pdf')); ?>" class="btn btn-danger btn-sm">
            <i class="las la-file-pdf"></i> Export PDF
        </a>
        <a href="<?php echo e(route('earnings.export.excel')); ?>" class="btn btn-success btn-sm">
            <i class="las la-file-excel"></i> Export Excel
        </a>
    </div>-->

    <!-- Date Filters -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button class="btn btn-outline-primary filter-btn" data-range="today">Today</button>
        <button class="btn btn-outline-success filter-btn" data-range="7days">Last 7 Days</button>
        <button class="btn btn-outline-warning filter-btn" data-range="month">This Month</button>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12">

            <!-- Total Income -->
            <div class="card custom--card mb-4 text-center">
                <div class="card-body">
                    <h4><?php echo app('translator')->get('Total Income'); ?></h4>
                    <h2 class="text-success fw-bold mt-2" id="totalEarned">
                        ₹<?php echo e(showAmount($totalIncome ?? 0)); ?>

                    </h2>
                </div>
            </div>

            <!-- Earnings Progress -->
            <div class="card shadow-sm border-0 p-4 mb-4">
                <h5 class="mb-3"><?php echo app('translator')->get('Earnings Progress'); ?></h5>

                <?php
                    $total = max($totalEarned ?? 1, 1);
                    $binaryPercent   = (($binaryIncome ?? 0) / $total) * 100;
                    $directPercent   = (($directIncome ?? 0) / $total) * 100;
                    $matchingPercent = (($matchingBonus ?? 0) / $total) * 100;
                    $rewardPercent  = (($rewardIncome ?? 0) / $total) * 100;
                ?>

                <!-- Binary -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <small><?php echo app('translator')->get('Binary Income'); ?></small>
                        <small><?php echo e(number_format($binaryPercent, 1)); ?>%</small>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" style="width: <?php echo e($binaryPercent); ?>%"></div>
                    </div>
                </div>

                <!-- Direct -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <small><?php echo app('translator')->get('Direct Referral'); ?></small>
                        <small><?php echo e(number_format($directPercent, 1)); ?>%</small>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: <?php echo e($directPercent); ?>%"></div>
                    </div>
                </div>

                <!-- Matching -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <small><?php echo app('translator')->get('Matching Bonus'); ?></small>
                        <small><?php echo e(number_format($matchingPercent, 1)); ?>%</small>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" style="width: <?php echo e($matchingPercent); ?>%"></div>
                    </div>
                </div>

                <!-- Rewards -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <small><?php echo app('translator')->get('Rewards'); ?></small>
                        <small><?php echo e(number_format($rewardPercent, 1)); ?>%</small>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: <?php echo e($rewardPercent); ?>%"></div>
                    </div>
                </div>
            </div>

            <!-- Current Balance -->
            <div class="card shadow-sm border-0 text-center p-4 mb-4">
                <h6 class="text-muted mb-2"><?php echo app('translator')->get('Current Balance'); ?></h6>

                <h2 class="fw-bold text-success mb-2">
                    ₹<?php echo e(showAmount(auth()->user()->balance)); ?>

                </h2>

                <small class="text-muted"><?php echo app('translator')->get('Available for withdrawal'); ?></small>

                <hr>

                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <div class="small text-muted"><?php echo app('translator')->get('Total Earned'); ?></div>
                        <div class="fw-semibold text-primary">
                            ₹<?php echo e(showAmount($totalEarned ?? 0)); ?>

                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="small text-muted"><?php echo app('translator')->get('Total Withdrawn'); ?></div>
                        <div class="fw-semibold text-danger">
                            ₹<?php echo e(showAmount($totalWithdrawn ?? 0)); ?>

                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="small text-muted"><?php echo app('translator')->get('Pending Amount'); ?></div>
                        <div class="fw-semibold text-warning">
                            ₹<?php echo e(showAmount($pendingAmount ?? 0)); ?>

                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="small text-muted"><?php echo app('translator')->get('Last Updated'); ?></div>
                        <div class="fw-semibold">
                            <?php echo e(now()->format('d M Y, h:i A')); ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Earn Breakdown -->
            <div class="card shadow-sm border-0 p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><?php echo app('translator')->get('Total Earn Breakdown'); ?></h5>
                    <span class="badge bg-success">
                        <?php echo e(showAmount($totalEarned ?? 0)); ?>

                    </span>
                </div>

                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted"><?php echo app('translator')->get('Master Maching Income'); ?></div>
                            <h6 class="fw-bold text-primary mb-0" id="binaryIncome">
                               <?php echo e(showAmount($binaryIncome ?? 0)); ?>

                            </h6>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted"><?php echo app('translator')->get('Lavel Income'); ?></div>
                            <h6 class="fw-bold text-success mb-0" id="directIncome">
                                <?php echo e(showAmount($directIncome ?? 0)); ?>

                            </h6>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted"><?php echo app('translator')->get('Rank Achievemt. Bonus'); ?></div>
                            <h6 class="fw-bold text-warning mb-0" id="matchingBonus">
                                <?php echo e(showAmount($matchingBonus ?? 0)); ?>

                            </h6>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted"><?php echo app('translator')->get('Rewards / Incentives'); ?></div>
                            <h6 class="fw-bold text-info mb-0" id="rewardIncome">
                               <?php echo e(showAmount($rewardIncome ?? 0)); ?>

                            </h6>
                        </div>
                    </div>
                    
                     <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted"><?php echo app('translator')->get('Salary Income'); ?></div>
                            <h6 class="fw-bold text-info mb-0" id="rewardIncome">
                                <?php echo e(showAmount($rewardIncome ?? 0)); ?>

                            </h6>
                        </div>
                    </div>
                    
                     <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted"><?php echo app('translator')->get('Repurchase Income'); ?></div>
                            <h6 class="fw-bold text-info mb-0" id="rewardIncome">
                                <?php echo e(showAmount($rewardIncome ?? 0)); ?>

                            </h6>
                        </div>
                    </div>
                    
                    
                     <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted"><?php echo app('translator')->get('Global Matching Income'); ?></div>
                            <h6 class="fw-bold text-info mb-0" id="rewardIncome">
                                <?php echo e(showAmount($rewardIncome ?? 0)); ?>

                            </h6>
                        </div>
                    </div>
                    
                     <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted"><?php echo app('translator')->get('Franchise Bonuses Income'); ?></div>
                            <h6 class="fw-bold text-info mb-0" id="rewardIncome">
                                <?php echo e(showAmount($rewardIncome ?? 0)); ?>

                            </h6>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Transactions Button -->
           <!-- <div class="text-end mb-4">
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#transactionsModal">
                    <i class="las la-list"></i> <?php echo app('translator')->get('View Transactions'); ?>
                </button>
            </div>-->

        </div>
    </div>

    <!-- Transactions Modal -->
    <div class="modal fade" id="transactionsModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Transaction History'); ?></h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th class="text-end">Amount (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $transactions ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>
                                <td><?php echo e(\Carbon\Carbon::parse($tx->created_at)->format('d M Y')); ?></td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <?php echo e(ucfirst($tx->type)); ?>

                                    </span>
                                </td>
                                <td><?php echo e($tx->description); ?></td>
                                <td class="text-end fw-bold">
                                    ₹<?php echo e(showAmount($tx->amount)); ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    <?php echo app('translator')->get('No transactions found'); ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {

    // Filter Buttons
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const range = this.dataset.range;

            fetch(`<?php echo e(route('earnings.filter')); ?>?range=${range}`)
                .then(res => res.json())
                .then(updateUI);
        });
    });

    // Auto Refresh every 10s
    setInterval(() => {
        fetch(`<?php echo e(route('earnings.filter')); ?>?range=current`)
            .then(res => res.json())
            .then(updateUI);
    }, 10000);

    // UI Update
    function updateUI(data) {
        document.getElementById('binaryIncome').innerText  = '₹' + data.binary;
        document.getElementById('directIncome').innerText  = '₹' + data.direct;
        document.getElementById('matchingBonus').innerText = '₹' + data.matching;
        document.getElementById('rewardIncome').innerText  = '₹' + data.reward;
        document.getElementById('totalEarned').innerText   = '₹' + data.total;
    }

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/user/incomes/my_income.blade.php ENDPATH**/ ?>