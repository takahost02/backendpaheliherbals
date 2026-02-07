<?php echo $__env->make($activeTemplate.'partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Blog Section Starts Here -->
    <section class="blog-section padding-bottom padding-top">
        <div class="container">
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
                                <a class="read-more" href="<?php echo e(route('blog.details', $blog->slug)); ?>"><?php echo app('translator')->get('Read More'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if($blogs->hasPages()): ?>
                <div class="pagination-wrapper">
                    <?php echo e(paginateLinks($blogs)); ?>

                </div>
            <?php endif; ?>
        </div>
        <div class="shape shape1">
            <img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/blob1.png')); ?>" alt="shap">
        </div>
    </section>
    <!-- Blog Section Ends Here -->

    <?php if($sections->secs != null): ?>
        <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($activeTemplate . 'sections.' . $sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/blog.blade.php ENDPATH**/ ?>