<!-- ============Footer Section Starts Here============ -->
<?php
    $socials     = getContent('social_icon.element');
    $footer      = getContent('footer_section.content', true);
    $policyPages = getContent('policy_pages.element', false, orderById: true);

?>


<!-- Footer Section Starts Here -->
<footer class="footer-section">
    <div class="footer-top">
        <div class="container">
            <div class="row justify-content-between gy-5">
                <div class="col-lg-4 col-xl-3 col-sm-6">
                    <div class="footer-widget p-0">
                        <div class="logo"><a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(siteLogo('dark')); ?>" alt="logo"></a></div>
                        <p><?php echo e(__($footer->data_values->description)); ?></p>
                    </div>
                </div>
                <div class="col-lg-2 col-xl-3 col-sm-6">
                    <div class="footer-widget">
                        <h4 class="widget-title"><?php echo app('translator')->get('Quick Links'); ?></h4>
                        <ul class="footer-links">
                            <li><a href="<?php echo e(route('home')); ?>"><i class="las la-angle-double-right"></i><?php echo app('translator')->get('Home'); ?></a></li>
                            <li><a href="<?php echo e(route('products')); ?>"><i class="las la-angle-double-right"></i><?php echo app('translator')->get('Products'); ?></a></li>
                            <li><a href="<?php echo e(route('blog')); ?>"><i class="las la-angle-double-right"></i><?php echo app('translator')->get('Blog'); ?></a></li>
                            <li><a href="<?php echo e(route('contact')); ?>"><i class="las la-angle-double-right"></i><?php echo app('translator')->get('Contact'); ?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-xl-3 col-sm-6">
                    <div class="footer-widget">
                        <h4 class="widget-title"><?php echo app('translator')->get('Policy Links'); ?></h4>
                        <ul class="footer-links">
                            <?php $__currentLoopData = $policyPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('policy.pages', $policy->slug)); ?>"><i
                                            class="las la-angle-double-right"></i><?php echo e(__($policy->data_values->title)); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-3 col-sm-6">
                    <div class="footer-widget">
                        <h4 class="widget-title"><?php echo app('translator')->get('Contact'); ?></h4>
                        <ul class="footer-info">
                            <li>
                                <p><i class="las la-map-marker"></i><?php echo e(@$footer->data_values->website_footer_address); ?></p>
                            </li>
                            <li><a href="tel:<?php echo e(@$footer->data_values->website_footer_phone_number); ?>"><i
                                        class="las la-phone-volume"></i><?php echo e(@$footer->data_values->website_footer_phone_number); ?></a></li>
                            <li><a href="mailto:<?php echo e(@$footer->data_values->website_footer_email); ?>"><i
                                        class="las la-envelope"></i><?php echo e(@$footer->data_values->website_footer_email); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-wrapper">
               <!--<p class="copy-text">&copy; <?php echo app('translator')->get('All Right Reserved By'); ?> <a href="<?php echo e(route('home')); ?>"><?php echo e(__(gs('site_name'))); ?></a></p>-->
                <p class="copy-text">Copyrigh &copy; <script type="text/javascript">document.write(new Date().getFullYear());</script>, Paheli Herbal's Marketing, <?php echo app('translator')->get('All Right Reserved , Developed by '); ?> <a href="https://takahostwebsolution.com">Takahost Web Solution</a></a></p>
                <ul class="social-icons">
                    <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(@$social->data_values->url); ?>" title="<?php echo e(@$social->data_values->title); ?>" target="_blank">
                                <?php echo @$social->data_values->social_icon; ?>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/partials/footer.blade.php ENDPATH**/ ?>