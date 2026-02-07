<?php
    $blogSectionContent = getContent('blog.content', true);
    $blogs = getContent('blog.element', false, 3);
?>

<section class="blog-section padding-bottom pos-rel">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section-header text-center">
                    <span class="subtitle"><?php echo e(__(@$blogSectionContent->data_values->heading)); ?></span>
                    <h2 class="title"><?php echo e(__(@$blogSectionContent->data_values->sub_heading)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center gy-4">
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="post-item h-100">
                        <div class="post-thumb"><img src="<?php echo e(frontendImage('blog', 'thumb_' . @$blog->data_values->image)); ?>" alt="blog">
                            <div class="meta-date">
                                <span class="date"><?php echo e(showDateTime($blog->created_at, 'd M')); ?></span>
                                <span><?php echo e(showDateTime($blog->created_at, 'Y')); ?></span>
                            </div>
                        </div>
                        <div class="post-content">
                            <h4 class="title"><a href="<?php echo e(route('blog.details', $blog->slug)); ?>"><?php echo e(__($blog->data_values->title)); ?></a></h4>
                            <p><?php echo shortDescription(strip_tags($blog->data_values->description),120) ?></p>
                            <a href="<?php echo e(route('blog.details', $blog->slug)); ?>" class="read-more"><?php echo app('translator')->get('Read More'); ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="shape shape1">
        <img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/blob1.png')); ?>" alt="shap">
    </div>
</section>
<?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/sections/blog.blade.php ENDPATH**/ ?>