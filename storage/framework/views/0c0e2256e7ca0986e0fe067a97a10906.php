

<?php $__env->startSection('content'); ?>

<?php
    use Illuminate\Support\Facades\DB;

    // -----------------------------
    // SAFE DEFAULT + AUTO-FALLBACK
    // -----------------------------
    if (!isset($totalPairs)) {
        $userId = auth()->id();

        $leftBV = DB::table('bv_logs')
            ->where('user_id', $userId)
            ->where('position', 1)
            ->where('trx_type', '+')
            ->sum('amount');

        $rightBV = DB::table('bv_logs')
            ->where('user_id', $userId)
            ->where('position', 2)
            ->where('trx_type', '+')
            ->sum('amount');

        $totalPairs = (int) min($leftBV, $rightBV);
    }

    // -----------------------------
    // STATIC REWARD STRUCTURE
    // -----------------------------
    $rewardLevels = [
        [
            'pairs' => 20,
            'title' => 'Bag',
            'description' => 'High-quality travel bag for daily & office use',
            'image' => 'https://cdn-icons-png.flaticon.com/512/263/263142.png'
        ],
        [
            'pairs' => 60,
            'title' => 'Blazer + Tie',
            'description' => 'Premium formal blazer with stylish tie',
            'image' => 'https://cdn-icons-png.flaticon.com/512/892/892458.png'
        ],
        [
            'pairs' => 140,
            'title' => 'Trolley Bag',
            'description' => 'Durable travel trolley bag for long journeys',
            'image' => 'https://cdn-icons-png.flaticon.com/512/2331/2331970.png'
        ],
        [
            'pairs' => 300,
            'title' => 'Titan Watch',
            'description' => 'Branded Titan wrist watch (premium edition)',
            'image' => 'https://cdn-icons-png.flaticon.com/512/747/747310.png'
        ],
        [
            'pairs' => 600,
            'title' => 'Tablet',
            'description' => 'High-performance tablet for work & entertainment',
            'image' => 'https://cdn-icons-png.flaticon.com/512/3659/3659899.png'
        ],
    ];
?>

<div class="row">

    <!-- HEADER -->
    <div class="col-12 text-center mb-4">
        <h3 class="fw-bold"><?php echo app('translator')->get('Pair Matching Rewards'); ?></h3>
        <h4 class="text-primary">
            <?php echo e($totalPairs); ?> <?php echo app('translator')->get('Pairs Completed'); ?>
        </h4>
        <small class="text-muted">
            <?php echo app('translator')->get('Complete more pairs to unlock exciting rewards'); ?>
        </small>
    </div>

    <!-- TABLE -->
    <div class="col-12">
        <div class="card custom--card shadow-sm">
            <div class="card-body p-0">

                <table class="table custom--table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><?php echo app('translator')->get('Pair'); ?></th>
                            <th><?php echo app('translator')->get('Reward'); ?></th>
                            <th><?php echo app('translator')->get('Picture'); ?></th>
                            <th><?php echo app('translator')->get('Status'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $rewardLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $achieved = $totalPairs >= $reward['pairs'];
                                $progress = $reward['pairs'] > 0
                                    ? min(100, ($totalPairs / $reward['pairs']) * 100)
                                    : 0;
                            ?>
                            <tr>
                                <!-- Pair -->
                                <td>
                                    <strong><?php echo e($reward['pairs']); ?> <?php echo app('translator')->get('Pairs'); ?></strong>
                                </td>

                                <!-- Reward Info -->
                                <td>
                                    <strong><?php echo e($reward['title']); ?></strong><br>
                                    <small class="text-muted">
                                        <?php echo e($reward['description']); ?>

                                    </small>

                                    <!-- Progress Bar -->
                                    <div class="progress mt-2" style="height: 10px;">
                                        <div class="progress-bar <?php echo e($achieved ? 'bg-success' : 'bg-info'); ?>"
                                             style="width: <?php echo e($progress); ?>%">
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        <?php echo e(min($totalPairs, $reward['pairs'])); ?>

                                        / <?php echo e($reward['pairs']); ?> pairs
                                    </small>
                                </td>

                                <!-- Picture -->
                                <td class="text-center">
                                    <img src="<?php echo e($reward['image']); ?>"
                                         alt="<?php echo e($reward['title']); ?>"
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

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/user/reward/index.blade.php ENDPATH**/ ?>