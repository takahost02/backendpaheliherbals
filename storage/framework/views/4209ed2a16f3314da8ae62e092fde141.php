

<?php $__env->startSection('content'); ?>

<?php
    use Illuminate\Support\Facades\DB;

    $userId = auth()->id();

    /*
    |--------------------------------------------------------------------------
    | SAFE BINARY INCOME DETECTION
    |--------------------------------------------------------------------------
    | Priority:
    | 1) Use $totalRankIncome from controller if valid
    | 2) Else sum matrix level payouts
    | 3) Else fallback to transactions table
    */

    if (!isset($totalRankIncome) || $totalRankIncome <= 0) {

        // 1️⃣ Matrix payouts (most accurate for rank system)
        $totalRankIncome = DB::table('matrix_level_incomes')
            ->where('user_id', $userId)
            ->sum('income');

        // 2️⃣ Fallback: Transactions (if you log binary here)
        if ($totalRankIncome <= 0) {
            $totalRankIncome = DB::table('transactions')
                ->where('user_id', $userId)
                ->where('details', 'LIKE', '%Binary%')
                ->sum('amount');
        }
    }

    // -----------------------------
    // RANK RULES
    // -----------------------------
    $ranks = [
        [
            'income' => 25000,
            'rank' => 'Bronze',
            'bonus' => 'Tea Set',
            'monthly' => 300,
            'image' => 'https://cdn-icons-png.flaticon.com/512/3082/3082036.png'
        ],
        [
            'income' => 75000,
            'rank' => 'Silver',
            'bonus' => 'Dining Set',
            'monthly' => 500,
            'image' => 'https://cdn-icons-png.flaticon.com/512/1046/1046857.png'
        ],
        [
            'income' => 225000,
            'rank' => 'Gold',
            'bonus' => 'Microwave Oven',
            'monthly' => 1000,
            'image' => 'https://cdn-icons-png.flaticon.com/512/1046/1046875.png'
        ],
        [
            'income' => 675000,
            'rank' => 'Platinum',
            'bonus' => 'Family Tour',
            'monthly' => 2500,
            'image' => 'https://cdn-icons-png.flaticon.com/512/854/854894.png'
        ],
        [
            'income' => 2025000,
            'rank' => 'Diamond',
            'bonus' => 'International Tour',
            'monthly' => 5000,
            'image' => 'https://cdn-icons-png.flaticon.com/512/3176/3176363.png'
        ],
        [
            'income' => 6075000,
            'rank' => 'Crown',
            'bonus' => 'Car',
            'monthly' => 15000,
            'image' => 'https://cdn-icons-png.flaticon.com/512/741/741407.png'
        ],
        [
            'income' => 18225000,
            'rank' => 'Ambassador',
            'bonus' => 'Family Car',
            'monthly' => 25000,
            'image' => 'https://cdn-icons-png.flaticon.com/512/2967/2967350.png'
        ],
        [
            'income' => 54675000,
            'rank' => 'Universal Ambassador',
            'bonus' => 'Dream House',
            'monthly' => 50000,
            'image' => 'https://cdn-icons-png.flaticon.com/512/619/619034.png'
        ],
    ];
?>

<div class="row">

    <!-- HEADER -->
    <div class="col-12 text-center mb-4">
        <h3 class="fw-bold text-dark"><?php echo app('translator')->get('Rank Achievement Bonus'); ?></h3>
        <h4 class="text-dark">
            ₹<?php echo e(number_format(0)); ?>

        </h4>
        <small class="text-muted">
            <?php echo app('translator')->get('Total Binary Matching Income (Auto Calculated)'); ?>
        </small>
    </div>

    <!-- TABLE -->
    <div class="col-12">
        <div class="card custom--card shadow-sm">
            <div class="card-body p-0">

                <table class="table custom--table mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><?php echo app('translator')->get('Matching Income'); ?></th>
                            <th><?php echo app('translator')->get('Rank Name'); ?></th>
                            <th><?php echo app('translator')->get('Bonus'); ?></th>
                            <th><?php echo app('translator')->get('Income'); ?></th>
                            <th><?php echo app('translator')->get('Picture'); ?></th>
                            <th><?php echo app('translator')->get('Status'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $ranks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $achieved = $totalRankIncome >= $rank['income'];
                                $progress = $rank['income'] > 0
                                    ? min(100, ($totalRankIncome / $rank['income']) * 100)
                                    : 0;
                            ?>
                            <tr>
                                <!-- Matching Income -->
                                <td>
                                    ₹<?php echo e(number_format($rank['income'])); ?>

                                </td>

                                <!-- Rank -->
                                <td>
                                    <strong><?php echo e($rank['rank']); ?></strong>
                                </td>

                                <!-- Bonus -->
                                <td>
                                    <strong><?php echo e($rank['bonus']); ?></strong>
                                </td>

                                <!-- Monthly Income -->
                                <td>
                                    ₹<?php echo e(number_format($rank['monthly'])); ?> x 6 Months
                                </td>

                                <!-- Picture -->
                                <td class="text-center">
                                    <img src="<?php echo e($rank['image']); ?>"
                                         alt="<?php echo e($rank['rank']); ?>"
                                         style="width:60px;height:60px;object-fit:contain;">
                                </td>

                                <!-- Status -->
                                <td class="text-center">
                                    <?php if($achieved): ?>
                                        <span class="badge bg-success">
                                            Achieved
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">
                                            Pending to Achieve
                                        </span>

                                        <div class="progress mt-1" style="height: 8px;">
                                            <div class="progress-bar bg-info"
                                                 style="width: <?php echo e($progress); ?>%">
                                            </div>
                                        </div>

                                        <small class="text-muted">
                                            ₹<?php echo e(number_format($totalRankIncome)); ?>

                                            / ₹<?php echo e(number_format($rank['income'])); ?>

                                        </small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/user/rank_income.blade.php ENDPATH**/ ?>