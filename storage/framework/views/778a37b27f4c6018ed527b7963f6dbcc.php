<?php
use Illuminate\Support\Str;

$bannerContent = getContent('banner.content', true);
$images = [];

if ($bannerContent && isset($bannerContent->data_values)) {
    foreach ($bannerContent->data_values as $key => $val) {
        if (Str::startsWith($key, 'image_') && !empty($val)) {
            $images[] = $val;
        }
    }
}
?>

<?php if(count($images)): ?>
<section class="hero-banner">

    <div id="heroCarousel"
         class="carousel slide"
         data-bs-ride="carousel"
         data-bs-interval="6000"
         data-bs-touch="true">

        
        <div class="carousel-indicators">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide-to="<?php echo e($i); ?>"
                        class="<?php echo e($i === 0 ? 'active' : ''); ?>"
                        aria-label="Slide <?php echo e($i + 1); ?>">
                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="carousel-inner">

            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-item <?php echo e($i === 0 ? 'active' : ''); ?>">

                    
                    <div class="hero-media">
                        <img src="<?php echo e(frontendImage('banner', $image)); ?>"
                             alt="Banner <?php echo e($i + 1); ?>"
                             loading="lazy">
                    </div>

                    
                    <div class="hero-overlay"></div>

                    
                    <?php if($i === 0): ?>
                        <div class="hero-caption">
                            <div class="container text-center">

                                <h1 class="hero-title">
                                    <?php echo e(__(@$bannerContent->data_values->heading)); ?>

                                </h1>

                                <p class="hero-subtitle">
                                    <?php echo e(__(@$bannerContent->data_values->sub_heading)); ?>

                                </p>

                                <!--<div class="hero-actions">
                                    <a href="<?php echo e(@$bannerContent->data_values->left_button_link); ?>"
                                       class="btn btn-primary px-4 py-2">
                                        <?php echo e(__(@$bannerContent->data_values->left_button)); ?>

                                    </a>

                                    <a href="<?php echo e(@$bannerContent->data_values->right_button_link); ?>"
                                       class="btn btn-outline-light px-4 py-2">
                                        <?php echo e(__(@$bannerContent->data_values->right_button)); ?>

                                    </a>
                                </div>-->

                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        
        <button class="carousel-control-prev" type="button"
                data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button"
                data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>
</section>
<?php endif; ?>


<?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/sections/banner.blade.php ENDPATH**/ ?>