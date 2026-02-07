<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-4 col-md-4 mb-30 mb-4">
                <div class="card custom--card">
                    <div class="card-body">
                        <div class="pricing-table mb-4 text-center">
                            <h2 class="package-name text- mb-20"><strong><?php echo e(__(strtoupper($data->name))); ?></strong></h2>
                            <span class="price text--dark font-weight-bold d-block"><?php echo e(showAmount($data->price)); ?></span>
                            <hr>
                            <ul class="package-features-list mt-30">
                                <li>
                                    <i class="las la-business-time __plan_info text--primary" data="bv"></i> <span><?php echo app('translator')->get('Business Volume (BV)'); ?>:
                                        <?php echo e(getAmount($data->bv)); ?></span>
                                </li>
                                <li>
                                    <i class="las la-comment-dollar __plan_info text--primary" data="ref_com"></i><span> <?php echo app('translator')->get('Referral Commission'); ?>:
                                        <?php echo e(gs('cur_sym')); ?><?php echo e(getAmount($data->ref_com)); ?>

                                    </span>
                                </li>
                                <li>
                                    <i class="las la-comments-dollar __plan_info text--primary" data="tree_com"></i>
                                    <span><?php echo app('translator')->get('Tree Commission'); ?>:
                                        <?php echo e(gs('cur_sym')); ?><?php echo e(getAmount($data->tree_com)); ?>

                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center">
                            <?php if(auth()->user()->plan_id != $data->id): ?>
                                <a class="cmn--btn active __subscribe" data-id="<?php echo e($data->id); ?>" href="#"><span><?php echo app('translator')->get('Subscribe'); ?></span></a>
                            <?php else: ?>
                                <a class="cmn--btn active"><span><?php echo app('translator')->get('Already Subscribe'); ?></span></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('modal'); ?>
    <div class="modal fade" id="plan_info_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="plan_info_modal_title"><?php echo app('translator')->get('Commission to tree info'); ?></h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer text-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <button class="btn btn--dark btn--sm" id="__modal_close" type="button"><?php echo app('translator')->get('Close'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="subscribe_modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Confirm Purchase'); ?>?</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </button>
                </div>
                <div class="modal-body">
                    <h5><?php echo app('translator')->get('Are you sure to purchase this plan?'); ?></h5>
                </div>

                <div class="modal-footer">
                    <form method="post" action="<?php echo e(route('user.plan.purchase')); ?>">
                        <?php echo csrf_field(); ?>
                        <input class="form-control form--control" class="d-none" id="plan_id" name="plan_id" type="hidden">
                        <button class="btn btn--dark btn--sm" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('Close'); ?></button>
                        <button class="btn btn--base btn--sm" type="submit"> <?php echo app('translator')->get('Subscribe'); ?></button>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        (function($) {
            $('.__plan_info').on('click', function(e) {
                let html = "";
                let data = $(this).attr('data');
                let modal = $("#plan_info_modal");
                if (data == 'bv') {
                    html = ` <h5>   <span class="text--danger"><?php echo app('translator')->get('When someone from your below tree subscribe this plan, You will get this Business Volume  which will be used for matching bonus'); ?>.</span>
                </h5>`
                    modal.find('#plan_info_modal_title').html("<?php echo app('translator')->get('Business Volume (BV) info'); ?>")

                }
                if (data == 'ref_com') {
                    html = `  <h5>  <span class=" text--danger"><?php echo app('translator')->get('When Your Direct-Referred/Sponsored  User Subscribe in'); ?> <b> <?php echo app('translator')->get('ANY PLAN'); ?> </b>, <?php echo app('translator')->get('You will get this amount'); ?>.</span>
                        <br>
                        <br>
                        <span class="text--success"> <?php echo app('translator')->get('This is the reason You should Choose a Plan With Bigger Referral Commission'); ?>.</span> </h5>`
                    modal.find('#plan_info_modal_title').html("<?php echo app('translator')->get('Referral Commission info'); ?>")

                }
                if (data == 'tree_com') {
                    html = ` <h5 class=" text--danger"><?php echo app('translator')->get('When someone from your below tree subscribe this plan, You will get this amount as Tree Commission'); ?>. </h5>`
                    modal.find('#plan_info_modal_title').html("<?php echo app('translator')->get('Referral Commission info'); ?>")

                }
                modal.find('.modal-body').html(html)
                $(modal).modal('show')
            });

            $('body').on('click', '#__modal_close', function(e) {
                $("#plan_info_modal").modal('hide');
            });

            $('.__subscribe').on('click', function(e) {
                let id = $(this).attr('data-id');
                $('#plan_id').attr('value', id);
                $("#subscribe_modal").modal('show');
            })
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/user/plan.blade.php ENDPATH**/ ?>