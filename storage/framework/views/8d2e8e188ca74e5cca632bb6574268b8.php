<?php echo $__env->make($activeTemplate.'partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <section class="blog-details padding-top padding-bottom">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-8">
                    <div class="blog-details-wrapper">
                        <div class="details-thumb"><img src="<?php echo e(frontendImage('blog',@$blog->data_values->image, '820x540')); ?>" alt="blog"></div>
                        <h3 class="title"><?php echo e(__($blog->data_values->title)); ?></h3>
                        <div>
                            <?php echo $blog->data_values->description ?>
                        </div>
                        <div class="mt-5">
                            <div class="blog-details__share d-flex align-items-center mt-4 flex-wrap">
                                <ul class="social-list">
                                    <li class="social-list__item">
                                        <b><?php echo app('translator')->get('Share Now :'); ?></b>
                                    </li>
                                    <li class="social-list__item">
                                        <a class="social-list__link flex-center facebook"
                                            href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a class="social-list__link flex-center twitter"
                                            href="https://x.com/intent/tweet?text=<?php echo e(__($blog->data_values->title)); ?>&amp;url=<?php echo e(urlencode(url()->current())); ?>"
                                            target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a class="social-list__link flex-center linkedin"
                                            href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>&amp;title=<?php echo e(__($blog->data_values->title)); ?>&amp;summary=<?php echo strLimit(strip_tags($blog->data_values->description),100) ?>"
                                            target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a class="social-list__link flex-center instagram"
                                            href="https://www.instagram.com/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="comments-area">
                        <div class="fb-comments" data-width="100%" data-href="<?php echo e(url()->current()); ?>" data-numposts="5"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-sidebar">
                        <div class="sidebar-item">
                            <h5 class="title"><?php echo app('translator')->get('Recent Post'); ?></h5>
                            <div class="recent-post-wrapper">
                                <?php $__currentLoopData = $latestBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="recent-post-item">
                                        <div class="thumb"><img src="<?php echo e(frontendImage('blog', 'thumb_' . @$blog->data_values->image, '820x540')); ?>"
                                                alt="blog"></div>
                                        <div class="content">
                                            <h6 class="title hover-line"><a
                                                    href="<?php echo e(route('blog.details', $blog->slug)); ?>"><?php echo e(__($blog->data_values->title)); ?></a>
                                            </h6>
                                            <span class="date"><i
                                                    class="las la-calendar-check"></i><?php echo e(showDateTime($blog->created_at, 'd M, Y')); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('fbComment'); ?>
    <?php echo loadExtension('fb-comment') ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/blog_details.blade.php ENDPATH**/ ?>