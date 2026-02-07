<?php
    $loginContent = getContent('login.content', true);
?>
<?php $__env->startSection('panel'); ?>
    <section class="account-section">
        <div class="row g-0 flex-wrap-reverse">
            <div class="col-md-6 col-xl-5 col-lg-6">
                <div class="account-form-wrapper">
                    <div class="logo"><a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(siteLogo()); ?>" alt="logo"></a></div>

                    <form class="account-form verify-gcaptcha" method="POST" action="<?php echo e(route('user.login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form--group">
                            <label class="form--label"><?php echo app('translator')->get('Username'); ?></label>
                            <input class="form-control form--control" name="username" type="text" value="<?php echo e(old('username')); ?>"
                                placeholder="<?php echo app('translator')->get('Enter Username'); ?>" required>
                        </div>
                        <div class="form--group">
                            <label class="form--label"><?php echo app('translator')->get('Password'); ?></label>
                            <input class="form-control form--control" id="password" name="password" type="password" placeholder="<?php echo app('translator')->get('Enter Password'); ?>"
                                required>
                        </div>

                        <?php
                            $custom = true;
                        ?>
                        <?php if (isset($component)) { $__componentOriginalff0a9fdc5428085522b49c68070c11d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff0a9fdc5428085522b49c68070c11d6 = $attributes; } ?>
<?php $component = App\View\Components\Captcha::resolve(['custom' => $custom] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Captcha::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $attributes = $__attributesOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $component = $__componentOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__componentOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>

                        <div class="form--group custom--checkbox">
                            <input class="form--control" id="remember" name="remember" type="checkbox" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="form--label" for="remember">
                                <?php echo app('translator')->get('Remember Me'); ?>
                            </label>
                        </div>
                        <div class="form--group button-wrapper">
                            <button class="account--btn" type="submit"><?php echo app('translator')->get('Sign In'); ?></button>
                            <a class="custom--btn" href="http://paheliherbals.com/"><span><?php echo app('translator')->get('Home'); ?></span></a>
                            <a class="custom--btn" href="<?php echo e(route('user.register')); ?>"><span><?php echo app('translator')->get('Create Account'); ?></span></a>
                        </div>

                    </form>
                    <p class="text--dark"><?php echo app('translator')->get('Forgot your login credentials'); ?> ? <a class="text--base ms-2" href="<?php echo e(route('user.password.request')); ?>"><?php echo app('translator')->get('Reset Password'); ?></a>
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-xl-7 col-lg-6">
                <div class="account-thumb">
                    <img src="<?php echo e(frontendImage('login', @$loginContent->data_values->login_image, '1100x750')); ?>" alt="thumb">
                    <div class="account-thumb-content">
                        <p class="welc"><?php echo e(__(@$loginContent->data_values->title)); ?></p>
                        <h3 class="title"><?php echo e(__(@$loginContent->data_values->heading)); ?></h3>
                        <p class="info"><?php echo e(__(@$loginContent->data_values->sub_heading)); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="shape shape1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/08.png')); ?>" alt="shape"></div>
        <div class="shape shape2"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/waves.png')); ?>" alt="shape"></div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/user/auth/login.blade.php ENDPATH**/ ?>