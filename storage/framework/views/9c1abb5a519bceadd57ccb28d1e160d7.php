<div class="overlay"></div>
<!-- Preloader -->
<div id="preloader">
    <div id="loader"></div>
</div>

<!-- Header Section Starts Here -->
<header class="header" style="background: linear-gradient(90deg, #75c4f0, #42919e); color:#000;">
    <div class="header-bottom" style="background: linear-gradient(90deg, #75c4f0, #42919e); color:#000;">
        <div class="container">
            <div class="header-bottom-area" style="background: linear-gradient(90deg, #75c4f0, #42919e); color:#000;">
                
                <div class="logo">
                    <a href="<?php echo e(route('home')); ?>">
                        <img src="<?php echo e(siteLogo('dark')); ?>" alt="logo">
                    </a>
                </div>

                <div class="header-trigger-wrapper d-flex d-lg-none align-items-center">
                    <div class="header-trigger d-block d-lg-none">
                        <span></span>
                    </div>
                    <div class="account-cart-wrapper">
                        <a class="account" href="<?php echo e(route('user.login')); ?>"><i class="las la-user"></i></a>
                    </div>
                </div>

                <ul class="menu" style="color:#000;">
                    <li><a href="https://paheliherbals.com/" style="color:#000;"><?php echo app('translator')->get('Home'); ?></a></li>
                    <li><a href="<?php echo e(route('products')); ?>" style="color:#000;"><?php echo app('translator')->get('Product'); ?></a></li>

                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('pages', [$data->slug])); ?>" style="color:#000;"><?php echo e($data->name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <li><a href="<?php echo e(route('contact')); ?>" style="color:#000;"><?php echo app('translator')->get('Contact'); ?></a></li>

                    <li>
                        <?php if(gs('multi_language')): ?>
                            <?php
                                $language = App\Models\Language::all();
                                $selectLang = $language->where('code', config('app.locale'))->first();
                                $currentLang = session('lang')
                                    ? $language->where('code', session('lang'))->first()
                                    : $language->where('is_default', Status::YES)->first();
                            ?>

                            <div class="custom--dropdown" style="color:#000;">
                                <div class="custom--dropdown__selected dropdown-list__item">
                                    <div class="thumb">
                                        <img src="<?php echo e(getImage(getFilePath('language') . '/' . $currentLang->image, getFileSize('language'))); ?>"
                                            alt="image">
                                    </div>
                                    <span class="text" style="color:#000;"> <?php echo e(__(@$selectLang->name)); ?> </span>
                                </div>
                                <ul class="dropdown-list" style="color:#000;">
                                    <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="dropdown-list__item" data-value="en">
                                            <a class="thumb" href="<?php echo e(route('lang', $item->code)); ?>" style="color:#000;">
                                                <img src="<?php echo e(getImage(getFilePath('language') . '/' . $item->image, getFileSize('language'))); ?>" alt="image">
                                                <span class="text" style="color:#000;"> <?php echo e(__($item->name)); ?> </span>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </li>

                    <li class="account-cart-wrapper d-none d-lg-block">
                        <a class="account" href="<?php echo e(route('user.login')); ?>" style="color:#000;"><i class="las la-user"></i></a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</header>


<!-- Header Section Ends Here -->
<?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/partials/header.blade.php ENDPATH**/ ?>