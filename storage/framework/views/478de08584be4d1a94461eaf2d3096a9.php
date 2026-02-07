<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 mb-30">

            <div class="card b-radius--5 overflow-hidden">
                <div class="card-body p-0">
                    <div class="d-flex bg--primary align-items-center p-3">
                        <div class="avatar avatar--lg">
                            <img src="<?php echo e(getImage(getFilePath('adminProfile') . '/' . $admin->image, getFileSize('adminProfile'))); ?>" alt="Image">
                        </div>
                        <div class="ps-3">
                            <h4 class="text--white"><?php echo e(__($admin->name)); ?></h4>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Name'); ?>
                            <span class="fw-bold"><?php echo e(__($admin->name)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Username'); ?>
                            <span class="fw-bold"><?php echo e(__($admin->username)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Email'); ?>
                            <span class="fw-bold"><?php echo e($admin->email); ?></span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title border-bottom mb-4 pb-2"><?php echo app('translator')->get('Profile Information'); ?></h5>

                    <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-xxl-4 col-lg-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Image'); ?></label>
                                    <?php if (isset($component)) { $__componentOriginaldbcc027cdd3569f61821c56d10b77c01 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbcc027cdd3569f61821c56d10b77c01 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image-uploader','data' => ['class' => 'w-100','type' => 'adminProfile','image' => ''.e($admin->image).'','required' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image-uploader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-100','type' => 'adminProfile','image' => ''.e($admin->image).'','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldbcc027cdd3569f61821c56d10b77c01)): ?>
<?php $attributes = $__attributesOriginaldbcc027cdd3569f61821c56d10b77c01; ?>
<?php unset($__attributesOriginaldbcc027cdd3569f61821c56d10b77c01); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldbcc027cdd3569f61821c56d10b77c01)): ?>
<?php $component = $__componentOriginaldbcc027cdd3569f61821c56d10b77c01; ?>
<?php unset($__componentOriginaldbcc027cdd3569f61821c56d10b77c01); ?>
<?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xxl-8 col-lg-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Name'); ?></label>
                                    <input class="form-control" name="name" type="text" value="<?php echo e($admin->name); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Email'); ?></label>
                                    <input class="form-control" name="email" type="email" value="<?php echo e($admin->email); ?>" required>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn--primary h-45 w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.password')); ?>"><i class="las la-key"></i><?php echo app('translator')->get('Password Setting'); ?></a>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        .list-group-item:first-child {
            border-top-left-radius: unset;
            border-top-right-radius: unset;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/profile.blade.php ENDPATH**/ ?>