<?php
    $aboutContent = getContent('about.content', true);
?>
<?php if(!blank(@$aboutContent)): ?>
    <section class="about-section padding-top padding-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="about-thumb rtl">
                        <img src="<?php echo e(frontendImage('about', @$aboutContent->data_values->about_image, '700x700')); ?>" alt="thumb" class="w-100">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-header">
                            <span class="subtitle"><?php echo e(__(@$aboutContent->data_values->heading)); ?></span>
                            <h2 class="title"><?php echo e(__(@$aboutContent->data_values->sub_heading)); ?></h2>
                            <p><?php echo e(__(@$aboutContent->data_values->description)); ?></p>
                        </div>

                        <a href="<?php echo e(@$aboutContent->data_values->button_url); ?>"
                            class="cmn--btn active"><span><?php echo e(__(@$aboutContent->data_values->button_text)); ?></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="shape shape1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/circle-triangle.png')); ?>" alt="shape"></div>
        <div class="shape shape2"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/circle-big.png')); ?>" alt="shape"></div>
    </section>
<?php endif; ?>
<?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/sections/about.blade.php ENDPATH**/ ?>