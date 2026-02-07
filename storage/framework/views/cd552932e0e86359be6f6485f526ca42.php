<?php $__env->startSection('content'); ?>
    <div class="login-main" style="background-image: url('<?php echo e(asset('assets/admin/images/login.jpg')); ?>')">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-8 col-sm-11">
                    <div class="login-area">
                        <div class="login-wrapper">
                            <div class="login-wrapper__top">
                                <h3 class="title text-white"><?php echo app('translator')->get('Recover Account'); ?></h3>
                            </div>
                            <div class="login-wrapper__body">
                                <form action="<?php echo e(route('admin.password.reset')); ?>" method="POST" class="login-form verify-gcaptcha">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('Email'); ?></label>
                                        <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required>
                                    </div>
                                    <?php if (isset($component)) { $__componentOriginalff0a9fdc5428085522b49c68070c11d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff0a9fdc5428085522b49c68070c11d6 = $attributes; } ?>
<?php $component = App\View\Components\Captcha::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                                    <button type="submit" class="btn cmn-btn w-100"><?php echo app('translator')->get('Submit'); ?></button>
                                    <div class="text-center mt-3">
                                        <a href="<?php echo e(route('admin.login')); ?>" class="text-white"><i class="las la-sign-in-alt" aria-hidden="true"></i><?php echo app('translator')->get('Back to Login'); ?></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/auth/passwords/email.blade.php ENDPATH**/ ?>