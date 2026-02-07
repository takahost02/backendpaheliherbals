<?php
    $referContent = getContent('refer.content', true);
?>

<?php if(!blank($referContent)): ?>
    <section class="referral-section"
        style="background: url(<?php echo e(frontendImage('refer', @$referContent->data_values->background_image, '1900x1200')); ?>) center;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="refer-content">
                        <h2 class="title"><?php echo e(__(@$referContent->data_values->heading)); ?></h2>
                        <p><?php echo e(__(@$referContent->data_values->description)); ?></p>
                        <a class="cmn--btn active" href="#0"><span><?php echo app('translator')->get('Get Started'); ?></span></a>
                        <div class="shape shape1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/icon/gft.png')); ?>" alt="icon"></div>
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
<?php /**PATH /home/paheliherbals/public_html/Back/core/resources/views/templates/basic/sections/refer.blade.php ENDPATH**/ ?>