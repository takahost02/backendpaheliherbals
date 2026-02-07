

<?php $__env->startSection('content'); ?>
<div class="card custom--card text-center">
    <div class="card-body">
        <h4><?php echo app('translator')->get('Global Matching Income'); ?></h4>
        <h2 class="text-success mt-3"><?php echo e(showAmount($income)); ?></h2>
        <p class="text-muted mt-2">Global matching rewards based on company turnover.</p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/incomes/global_matching.blade.php ENDPATH**/ ?>