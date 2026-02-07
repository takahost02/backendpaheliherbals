<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card custom--card">
            <div class="card-body">
                <form action="<?php echo e(route('user.kyc.submit')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php if (isset($component)) { $__componentOriginal3bd95de28203859144f617d3fb6afebc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3bd95de28203859144f617d3fb6afebc = $attributes; } ?>
<?php $component = App\View\Components\ViserForm::resolve(['identifier' => 'act','identifierValue' => 'kyc'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('viser-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ViserForm::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3bd95de28203859144f617d3fb6afebc)): ?>
<?php $attributes = $__attributesOriginal3bd95de28203859144f617d3fb6afebc; ?>
<?php unset($__attributesOriginal3bd95de28203859144f617d3fb6afebc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3bd95de28203859144f617d3fb6afebc)): ?>
<?php $component = $__componentOriginal3bd95de28203859144f617d3fb6afebc; ?>
<?php unset($__componentOriginal3bd95de28203859144f617d3fb6afebc); ?>
<?php endif; ?>
                    <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Submit'); ?></button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/user/kyc/form.blade.php ENDPATH**/ ?>