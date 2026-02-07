<?php
    $testimonialContent = getContent('testimonial.content', true);
    $testimonials = getContent('testimonial.element');
?>
<section class="testimonial-section padding-bottom pos-rel">
    <div class="container">
        <div class="testimonial-wrapper row">
            <div class="col-lg-6">
                <div class="section-header">
                    <span class="subtitle"><?php echo e(__(@$testimonialContent->data_values->heading)); ?></span>
                    <h2 class="title"><?php echo e(__(@$testimonialContent->data_values->sub_heading)); ?></h2>
                </div>
                <div class="testimonial-slider owl-carousel owl-theme" data-slider-id="1">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="testimonial-item">
                            <div class="quote-icon"><i class="flaticon-left-quote"></i></div>
                            <p><?php echo e(__($testimonial->data_values->quote)); ?></p>
                            <div class="thumb"><img src="<?php echo e(getImage('assets/images/frontend/testimonial/' . $testimonial->data_values->image)); ?>"
                                    alt="testimonials"></div>
                            <h4 class="name"><?php echo e(__($testimonial->data_values->author)); ?></h4>
                            <span class="designation"><?php echo e(__($testimonial->data_values->designation)); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="owl-thumbs testimonial-img-slider" data-slider-id="1">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="owl-thumb-item">
                            <div class="thumb thumb<?php echo e($loop->index); ?>"><img
                                    src="<?php echo e(getImage('assets/images/frontend/testimonial/' . $testimonial->data_values->image)); ?>" alt="testimonials">
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="shape shape1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/blob.png')); ?>" alt="shape"></div>
    <div class="shape shape2"><img src="<?php echo e(asset($activeTemplateTrue . 'images/icon/quote.png')); ?>" alt="icon"></div>
</section>
<?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/sections/testimonial.blade.php ENDPATH**/ ?>