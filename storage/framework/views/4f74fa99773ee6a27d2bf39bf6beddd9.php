

<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('assets/global/css/tree.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card custom--card">
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-1">
                <?php echo showSingleUserinTree($tree['a']); ?>
            </div>
        </div>
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-2">
                <?php echo showSingleUserinTree($tree['b']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-2 ">
                <?php echo showSingleUserinTree($tree['c']); ?>
            </div>
        </div>
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-4 ">
                <?php echo showSingleUserinTree($tree['d']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-4 ">
                <?php echo showSingleUserinTree($tree['e']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-4 ">
                <?php echo showSingleUserinTree($tree['f']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-4 ">
                <?php echo showSingleUserinTree($tree['g']); ?>
            </div>
            <!-- <div class="col"> -->

        </div>
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-8">
                <?php echo showSingleUserinTree($tree['h']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                <?php echo showSingleUserinTree($tree['i']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                <?php echo showSingleUserinTree($tree['j']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                <?php echo showSingleUserinTree($tree['k']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                <?php echo showSingleUserinTree($tree['l']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                <?php echo showSingleUserinTree($tree['m']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                <?php echo showSingleUserinTree($tree['n']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                <?php echo showSingleUserinTree($tree['o']); ?>
            </div>


        </div>
    </div>

<?php $__env->startPush('modal'); ?>
<div class="modal fade user-details-modal-area" id="exampleModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo app('translator')->get('User Details'); ?></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="user-details-modal">
                    <div class="user-details-header ">
                        <div class="thumb"><img src="#" alt="*" class="tree_image w-h-100-p"
                            ></div>
                        <div class="content">
                            <a class="user-name tree_url tree_name" href=""></a>
                            <span class="user-status tree_status"></span>
                            <span class="user-status tree_plan"></span>
                        </div>
                    </div>
                    <div class="user-details-body text-center">

                        <h6 class="my-3"><?php echo app('translator')->get('Referred By'); ?>: <span class="tree_ref"></span></h6>


                        <table class="table table-bordered">
                            <tr>
                                <th>&nbsp;</th>
                                <th><?php echo app('translator')->get('LEFT'); ?></th>
                                <th><?php echo app('translator')->get('RIGHT'); ?></th>
                            </tr>

                            <tr>
                                <td><?php echo app('translator')->get('Current BV'); ?></td>
                                <td><span class="lbv"></span></td>
                                <td><span class="rbv"></span></td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('Free Member'); ?></td>
                                <td><span class="lfree"></span></td>
                                <td><span class="rfree"></span></td>
                            </tr>

                            <tr>
                                <td><?php echo app('translator')->get('Paid Member'); ?></td>
                                <td><span class="lpaid"></span></td>
                                <td><span class="rpaid"></span></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopPush(); ?>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function ($) {
            $('.showDetails').on('click', function () {
                var modal = $('#exampleModalCenter');

                $('.tree_name').text($(this).data('name'));
                $('.tree_url').attr({"href": $(this).data('treeurl')});
                $('.tree_status').text($(this).data('status'));
                $('.tree_plan').text($(this).data('plan'));
                $('.tree_image').attr({"src": $(this).data('image')});
                $('.user-details-header').removeClass('Paid');
                $('.user-details-header').removeClass('Free');
                $('.user-details-header').addClass($(this).data('status'));
                $('.tree_ref').text($(this).data('refby'));
                $('.lbv').text($(this).data('lbv'));
                $('.rbv').text($(this).data('rbv'));
                $('.lpaid').text($(this).data('lpaid'));
                $('.rpaid').text($(this).data('rpaid'));
                $('.lfree').text($(this).data('lfree'));
                $('.rfree').text($(this).data('rfree'));
                $('#exampleModalCenter').modal('show');
            });
        })(jQuery);
    </script>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
    <form action="<?php echo e(route('user.other.tree.search')); ?>" method="GET" class="form-inline float-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="username" class="form-control form--control" placeholder="<?php echo app('translator')->get('Search by username'); ?>">
            <button class="btn btn--success" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
<?php $__env->stopPush(); ?>




<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/user/myTree.blade.php ENDPATH**/ ?>