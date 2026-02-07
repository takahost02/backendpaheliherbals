<?php
    $referContent = getContent('refer.content', true);
?>

<?php if(!blank($referContent)): ?>
    <section class="referral-section"
        style="background: url(<?php echo e(frontendImage('refer', @$referContent->data_values->background_image, '1900x1200')); ?>) center; color:#ffffff;">
        
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-lg-6">
                    <div class="refer-content" style="color:#ffffff;">
                        <h2 class="title" style="color:#ffffff;"><?php echo e(__(@$referContent->data_values->heading)); ?></h2>
                        <p style="color:#ffffff;"><?php echo e(__(@$referContent->data_values->description)); ?></p>

                        <a class="cmn--btn active" href="#0">
                            <span><?php echo app('translator')->get('Get Started'); ?></span>
                        </a>

                        <div class="shape shape1">
                            <img src="<?php echo e(asset($activeTemplateTrue . 'images/icon/gft.png')); ?>" alt="icon">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-none d-lg-block">
                    <div class="refer-thumb">
                        <img src="<?php echo e(frontendImage('refer', @$referContent->data_values->refer_image, '650x580')); ?>" alt="thumb">
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php endif; ?>
<style>
.referral-section,
.referral-section h2,
.referral-section p {
    color: #ffffff !important;
}
</style><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/sections/refer.blade.php ENDPATH**/ ?>