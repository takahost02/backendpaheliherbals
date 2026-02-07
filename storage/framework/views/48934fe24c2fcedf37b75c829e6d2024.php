<?php $__env->startSection('panel'); ?>
    <div class="card">
        <div class="row justify-content-center llll text-center">
            <!-- <div class="col"> -->
            <div class="w-1">
                <?php echo showSingleUserinTree($tree['a']); ?>
            </div>
        </div>
        <div class="row justify-content-center llll text-center">
            <!-- <div class="col"> -->
            <div class="w-2">
                <?php echo showSingleUserinTree($tree['b']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-2">
                <?php echo showSingleUserinTree($tree['c']); ?>
            </div>
        </div>
        <div class="row justify-content-center llll text-center">
            <!-- <div class="col"> -->
            <div class="w-4">
                <?php echo showSingleUserinTree($tree['d']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-4">
                <?php echo showSingleUserinTree($tree['e']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-4">
                <?php echo showSingleUserinTree($tree['f']); ?>
            </div>
            <!-- <div class="col"> -->
            <div class="w-4">
                <?php echo showSingleUserinTree($tree['g']); ?>
            </div>
            <!-- <div class="col"> -->

        </div>
        <div class="row justify-content-center llll text-center">
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

    <div class="modal fade user-details-modal-area" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo app('translator')->get('User Details'); ?></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-details-modal">
                        <div class="user-details-header">
                            <div class="thumb"><img class="w-h-100-p tree_image" src="#" alt="*"></div>
                            <div class="content">
                                <a class="user-name tree_url tree_name" href=""></a>
                                <span class="user-status tree_status"></span>
                                <span class="user-status tree_plan"></span>
                            </div>
                        </div>
                        <div class="user-details-body text-center">
                            <h6 class="my-3"><?php echo app('translator')->get('Referred By'); ?>: <span class="tree_ref"></span></h6>
                            <h6 class="my-3"><?php echo app('translator')->get('Level'); ?>: <span class="tree_level"></span></h6>
                            <table class="table-bordered table">

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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        (function($) {
            $('.showDetails').on('click', function() {
                var modal = $('#exampleModalCenter');

                // Debug logs
                console.log('Name:', $(this).data('name'));
                console.log('Tree URL:', $(this).data('treeurl'));
                console.log('Status:', $(this).data('status'));
                console.log('Plan:', $(this).data('plan'));
                console.log('Image:', $(this).data('image'));
                console.log('Ref By:', $(this).data('ref_by'));
                console.log('Level:', $(this).data('level'));
                console.log('Left BV:', $(this).data('lbv'));
                console.log('Right BV:', $(this).data('rbv'));
                console.log('Left Free:', $(this).data('lfree'));
                console.log('Right Free:', $(this).data('rfree'));
                console.log('Left Paid:', $(this).data('lpaid'));
                console.log('Right Paid:', $(this).data('rpaid'));

                $('.tree_name').text($(this).data('name'));
                $('.tree_url').attr({
                    "href": $(this).data('treeurl')
                });
                $('.tree_status').text($(this).data('status'));
                $('.tree_plan').text($(this).data('plan'));
                $('.tree_image').attr({
                    "src": $(this).data('image')
                });

                $('.user-details-header').removeClass('Paid Free').addClass($(this).data('status'));

                $('.ref_by').text($(this).data('ref_by'));
                $('.level').text($(this).data('level'));
                $('.lbv').text($(this).data('lbv'));
                $('.rbv').text($(this).data('rbv'));
                $('.lpaid').text($(this).data('lpaid'));
                $('.rpaid').text($(this).data('rpaid'));
                $('.lfree').text($(this).data('lfree'));
                $('.rfree').text($(this).data('rfree'));

                $('#exampleModalCenter').modal('show');
            });
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <form class="form-inline bg--white float-right" action="<?php echo e(route('admin.users.other.tree.search')); ?>" method="GET">
        <div class="input-group flex-fill w-auto">
            <input class="form-control" name="username" type="text" placeholder="<?php echo app('translator')->get('Search by username'); ?>">
            <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('assets/global/css/tree.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/admin/users/tree.blade.php ENDPATH**/ ?>