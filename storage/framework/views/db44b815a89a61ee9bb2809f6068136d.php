

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="card custom--card">
            <div class="card-header text-center">
                <h4><?php echo app('translator')->get('Rank Achievement Income'); ?></h4>
            </div>

            <div class="card-body text-center">
                <h6 class="text-muted"><?php echo app('translator')->get('Total Rank Income'); ?></h6>
                <h2 class="fw-bold text-success">
                    <?php echo e(showAmount($totalRankIncome)); ?>

                </h2>

                <hr>

                <p class="text-muted">
                    <?php echo app('translator')->get('This income is generated when you achieve company-defined rank milestones.'); ?>
                </p>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/rank_income.blade.php ENDPATH**/ ?>