

<?php $__env->startSection('content'); ?>

<?php
    // Safe defaults
    $teamSize = $teamSize ?? 0;

    // Level rules
    $levels = [
        1 => ['team' => 5,    'income' => 50],
        2 => ['team' => 25,   'income' => 125],
        3 => ['team' => 125,  'income' => 625],
        4 => ['team' => 625,  'income' => 3125],
        5 => ['team' => 3125, 'income' => 15625],
    ];

    // Detect highest achieved level
    $achievement = null;
    foreach ($levels as $level => $data) {
        if ($teamSize >= $data['team']) {
            $achievement = [
                'level' => $level,
                'team'  => $data['team'],
                'income'=> $data['income'],
            ];
        }
    }
?>

<div class="row justify-content-center">
    <div class="col-lg-6">

        <!-- Team Size Card -->
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted mb-1">Your Team Size</h6>
                <h2 class="fw-bold"><?php echo e($teamSize); ?></h2>
            </div>
        </div>

        <!-- Matrix Progress -->
        <div class="card custom--card mt-4">
            <div class="card-header">
                <h5><?php echo app('translator')->get('Matrix Progress'); ?></h5>
            </div>

            <div class="card-body">
                <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $percent  = min(100, ($teamSize / $data['team']) * 100);
                        $achieved = $teamSize >= $data['team'];
                    ?>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <strong>Level <?php echo e($level); ?></strong>
                            <span>
                                <?php echo e(min($teamSize, $data['team'])); ?> / <?php echo e($data['team']); ?>

                            </span>
                        </div>

                        <div class="progress" style="height:18px">
                            <div class="progress-bar <?php echo e($achieved ? 'bg-success' : 'bg-info'); ?>"
                                 style="width: <?php echo e($percent); ?>%">
                                <?php echo e($achieved ? 'Achieved' : round($percent).'%'); ?>

                            </div>
                        </div>

                        <small class="text-muted">
                            Income: ₹<?php echo e(number_format($data['income'])); ?>

                        </small>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Achievement Card -->
        <?php if($achievement): ?>
            <div class="card border-success shadow-lg mt-4">
                <div class="card-body text-center p-4">

                    <h3 class="fw-bold text-success mb-2">
                        🎉 Congratulations!
                    </h3>

                    <p class="fs-5 mb-3">
                        You’ve successfully reached 
                        <strong class="text-primary">
                            Level <?php echo e($achievement['level']); ?>

                        </strong>
                    </p>

                    <hr class="my-3">

                    <div class="d-flex justify-content-center gap-4 mb-2">
                        <div>
                            <div class="text-muted small">Team Size</div>
                            <div class="fw-bold">
                                <?php echo e($achievement['team']); ?>

                            </div>
                        </div>

                        <div>
                            <div class="text-muted small">Income</div>
                            <div class="fw-bold text-success fs-5">
                                ₹<?php echo e(number_format($achievement['income'])); ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php else: ?>
            <div class="card border-warning shadow-sm mt-4">
                <div class="card-body text-center">
                    <h5 class="fw-bold text-warning mb-2">
                        🚀 Keep Going!
                    </h5>
                    <p>
                        Add <strong><?php echo e(max(0, $levels[1]['team'] - $teamSize)); ?></strong> more members
                        to achieve <strong>Level 1</strong>.
                    </p>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/user/matrixIncome.blade.php ENDPATH**/ ?>