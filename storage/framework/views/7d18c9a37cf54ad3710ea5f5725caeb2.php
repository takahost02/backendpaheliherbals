

<?php $__env->startPush('style'); ?>
<link href="<?php echo e(asset('assets/global/css/tree.css')); ?>" rel="stylesheet">
<style>
.showDetails {
    cursor: pointer;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="card custom--card">

    <div class="row text-center justify-content-center llll">
        <div class="w-1"><?php echo showSingleUserinTree($tree['a']); ?></div>
    </div>

    <div class="row text-center justify-content-center llll">
        <div class="w-2"><?php echo showSingleUserinTree($tree['b']); ?></div>
        <div class="w-2"><?php echo showSingleUserinTree($tree['c']); ?></div>
    </div>

    <div class="row text-center justify-content-center llll">
        <div class="w-4"><?php echo showSingleUserinTree($tree['d']); ?></div>
        <div class="w-4"><?php echo showSingleUserinTree($tree['e']); ?></div>
        <div class="w-4"><?php echo showSingleUserinTree($tree['f']); ?></div>
        <div class="w-4"><?php echo showSingleUserinTree($tree['g']); ?></div>
    </div>

    <div class="row text-center justify-content-center llll">
        <div class="w-8"><?php echo showSingleUserinTree($tree['h']); ?></div>
        <div class="w-8"><?php echo showSingleUserinTree($tree['i']); ?></div>
        <div class="w-8"><?php echo showSingleUserinTree($tree['j']); ?></div>
        <div class="w-8"><?php echo showSingleUserinTree($tree['k']); ?></div>
        <div class="w-8"><?php echo showSingleUserinTree($tree['l']); ?></div>
        <div class="w-8"><?php echo showSingleUserinTree($tree['m']); ?></div>
        <div class="w-8"><?php echo showSingleUserinTree($tree['n']); ?></div>
        <div class="w-8"><?php echo showSingleUserinTree($tree['o']); ?></div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
"use strict";

(function ($) {

    $(document).on('click', '.showDetails', function (e) {
        e.preventDefault();

        const treeUrl = $(this).data('treeurl');
        if (!treeUrl) return;

        // ðŸ”„ Reload SAME page with clicked user id
        window.location.href = treeUrl;
    });

})(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <form action="<?php echo e(route('user.other.tree')); ?>" method="GET" class="form-inline float-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="username" class="form-control form--control" placeholder="<?php echo app('translator')->get('Search by username'); ?>">
            <button class="btn btn--success" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
<?php $__env->stopPush(); ?>




<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/myTree.blade.php ENDPATH**/ ?>