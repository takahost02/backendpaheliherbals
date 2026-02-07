<?php
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

<?php if(!empty($images)): ?>
<section class="banner-section bg_img p-0 m-0" style="background: none; height: 100vh; overflow: hidden;">
    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">

        
        <div class="carousel-indicators">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo e($index); ?>" class="<?php echo e($index === 0 ? 'active' : ''); ?>" aria-label="Slide <?php echo e($index + 1); ?>"></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="carousel-inner h-100">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item h-100 <?php echo e($index === 0 ? 'active' : ''); ?>">
                <img src="<?php echo e(frontendImage('banner', $image)); ?>" class="d-block w-100 h-100 object-fit-cover" alt="Banner Image <?php echo e($index + 1); ?>">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center h-100">
                    <?php if($index === 0): ?> 
                        <h1 class="title"><?php echo e(__(@$bannerContent->data_values->heading)); ?></h1>
                        <p><?php echo e(__(@$bannerContent->data_values->sub_heading)); ?></p>
                        <div class="button--wrapper">
                            <a class="cmn--btn active" href="<?php echo e(@$bannerContent->data_values->left_button_link); ?>">
                                <span><?php echo e(__(@$bannerContent->data_values->left_button)); ?></span>
                            </a>
                            <a class="cmn--btn" href="<?php echo e(@$bannerContent->data_values->right_button_link); ?>">
                                <span><?php echo e(__(@$bannerContent->data_values->right_button)); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    
    <div class="shapes d-none d-sm-block">
        <div class="shape shape1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/circle-triangle.png')); ?>" alt="shape"></div>
        <div class="shape2 shape"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/shape-circle.png')); ?>" alt="shape"></div>
        <div class="shape3 shape"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/dots-colour.png')); ?>" alt="shape"></div>
        <div class="shape4 shape"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/plus-big.png')); ?>" alt="shape"></div>
        <div class="shape5 shape"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/waves.png')); ?>" alt="shape"></div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/sections/banner.blade.php ENDPATH**/ ?>