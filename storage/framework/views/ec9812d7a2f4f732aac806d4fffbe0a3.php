<?php
    $planeSectionContent = getContent('plan.content', true);
    $plans               = \App\Models\Plan::orderBy('price')->active()->get();
?>



<!-- Pricing Plan Section Starts Here -->
<section class="plan-section padding-bottom pos-rel">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section-header text-center">
                    <span class="subtitle"><?php echo e(__(@$planeSectionContent->data_values->heading)); ?></span>
                    <h2 class="title"><?php echo e(__(@$planeSectionContent->data_values->sub_heading)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center gy-5">

            <?php $__currentLoopData = @$plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                <div class="plan-item">
                    <span class="plan-serial"><?php echo e($k+1); ?></span>
                    <div class="plan-bottom">
                        <div class="plan-header"><div class="plan-price"><sup><?php echo e(gs('cur_sym')); ?></sup><?php echo e(showAmount($plan->price,currencyFormat:false)); ?></div></div>
                        <div class="plan-body">
                            <p class="plan-name"><?php echo e(__(@$plan->name)); ?></p>
                            <ul class="plan-info">
                                <li class="active"><i  class="las la-business-time __plan_info " data="bv"></i><?php echo app('translator')->get('Business Volume: '); ?><?php echo e(__(@$plan->bv)); ?></li>
                                <li class="active"><i class="las la-comment-dollar __plan_info" data="ref_com"></i><?php echo app('translator')->get('Referral Commission: '); ?><?php echo e(gs('cur_sym')); ?> <?php echo e(getAmount($plan->ref_com)); ?></li>
                                <li class="active"><i class="las la-comments-dollar __plan_info" data="tree_com"></i><?php echo app('translator')->get('Commission To Tree:'); ?> <?php echo e(gs('cur_sym')); ?> <?php echo e(getAmount($plan->tree_com)); ?></li>
                            </ul>
                            <div class="text-center"><a href="<?php echo e(route('user.plan.index')); ?>"  class="cmn--btn-2 btn--md active"><span><?php echo app('translator')->get('Subscribe Plan'); ?></span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<div class="modal fade" id="__modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="__modal_title"><?php echo app('translator')->get('Commission to tree info'); ?></h5>

            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer text-right ">
               <div class="row">
                   <div class="col-lg-12">
                    <button type="button" class="btn btn-dark" id="__modal_close"><?php echo app('translator')->get('Close'); ?></button>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        (function($){
            $('.__plan_info').on('click', function (e) {
                let html="";
               let data=$(this).attr('data');
               let modal=$("#__modal");
               if(data=='bv'){
                html=` <h5>   <span class="text--danger"><?php echo app('translator')->get('When someone from your below tree subscribe this plan, You will get this Business Volume  which will be used for matching bonus'); ?>.</span>
                </h5>`
                modal.find('#__modal_title').html("<?php echo app('translator')->get('Business Volume (BV) info'); ?>")

               }
               if(data=='ref_com'){
                 html=`  <h5>  <span class=" text--danger"><?php echo app('translator')->get('When Your Direct-Referred/Sponsored  User Subscribe in'); ?> <b> <?php echo app('translator')->get('ANY PLAN'); ?> </b>, <?php echo app('translator')->get('You will get this amount'); ?>.</span>
                        <br>
                        <br>
                        <span class="text--success"> <?php echo app('translator')->get('This is the reason You should Choose a Plan With Bigger Referral Commission'); ?>.</span> </h5>`
                        modal.find('#__modal_title').html("<?php echo app('translator')->get('Referral Commission info'); ?>")

               }
               if(data=='tree_com'){
                    html=` <h5 class=" text--danger"><?php echo app('translator')->get('When someone from your below tree subscribe this plan, You will get this amount as Tree Commission'); ?>. </h5>`
                    modal.find('#__modal_title').html(html)
                }
              modal.find('.modal-body').html(html)
               $(modal).modal('show')
             });

            $('body').on('click', '#__modal_close',function (e) {
            $("#__modal").modal('hide');
            });
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/templates/basic/sections/plan.blade.php ENDPATH**/ ?>