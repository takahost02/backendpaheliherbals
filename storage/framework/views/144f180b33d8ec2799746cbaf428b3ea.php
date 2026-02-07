<?php
    $faqTitle = getContent('faq.content', true);
    $faqs = getContent('faq.element');
?>


<section class="faq-section padding-top padding-bottom">
    <div class="container">
        <div class="section-header">
            <h2 class="title"><?php echo app('translator')->get(@$faqTitle->data_values->heading); ?></h2>
            <p><?php echo app('translator')->get(@$faqTitle->data_values->subheading); ?></p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="faq-wrapper style-two">
                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faql): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="faq-item">
                            <div class="faq-title">
                                <h6 class="title"><?php echo e(__(@$faql->data_values->question)); ?></h6>
                                <div class="right-icon"></div>
                            </div>
                            <div class="faq-content">
                                <p><?php echo e(__(@$faql->data_values->answer)); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/sections/faq.blade.php ENDPATH**/ ?>