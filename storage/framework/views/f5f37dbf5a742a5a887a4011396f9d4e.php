<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Price'); ?></th>
                                    <th><?php echo app('translator')->get('Quantity'); ?></th>
                                    <th><?php echo app('translator')->get('Feature'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb justify-content-end justify-content-md-start">
                                                    <img src="<?php echo e(getImage(getFilePath('products') . '/' . $product->thumbnail, getFileSize('products'))); ?>"
                                                        alt="Image">
                                                    <span><?php echo e(__(strLimit($product->name, '20'))); ?></span>
                                                </div>
                                            </div>
                                        </td>

                                        <td><?php echo e(__(showAmount($product->price))); ?></td>
                                        <td><?php echo e(__($product->quantity)); ?></td>
                                        <td> <?php echo $product->statusFeature ?> </td>
                                        <td> <?php echo $product->statusBadge ?> </td>
                                        <td>
                                            <div class="button--group">
                                                <a class="btn btn-outline--primary btn-sm" data-toggle="tooltip" data-original-title="Edit"
                                                    href="<?php echo e(route('admin.product.edit', $product->id)); ?>">
                                                    <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                </a>
                                                <?php if($product->is_featured == Status::ENABLE): ?>
                                                    <button class="btn btn-outline--danger btn-sm confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to feature this product?'); ?>"
                                                        data-action="<?php echo e(route('admin.product.feature', $product->id)); ?>">
                                                        <i class="las la-eye-slash"></i><?php echo app('translator')->get('Unfeatured'); ?>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-outline--warning confirmationBtn btn-sm" data-question="<?php echo app('translator')->get('Are you sure to unfeatured this product?'); ?>"
                                                        data-action="<?php echo e(route('admin.product.feature', $product->id)); ?>">
                                                        <i class="las la-eye"></i><?php echo app('translator')->get('Featured'); ?>
                                                    </button>
                                                <?php endif; ?>

                                                <?php if($product->status == Status::ENABLE): ?>
                                                    <button class="btn btn-outline--danger btn-sm confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to disable this product?'); ?>"
                                                        data-action="<?php echo e(route('admin.product.status', $product->id)); ?>">
                                                        <i class="las la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-outline--success confirmationBtn btn-sm" data-question="<?php echo app('translator')->get('Are you sure to enable this product?'); ?>"
                                                        data-action="<?php echo e(route('admin.product.status', $product->id)); ?>">
                                                        <i class="las la-eye"></i><?php echo app('translator')->get('Enable'); ?>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($products->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($products)); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginalbd5922df145d522b37bf664b524be380 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbd5922df145d522b37bf664b524be380 = $attributes; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ConfirmationModal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbd5922df145d522b37bf664b524be380)): ?>
<?php $attributes = $__attributesOriginalbd5922df145d522b37bf664b524be380; ?>
<?php unset($__attributesOriginalbd5922df145d522b37bf664b524be380); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbd5922df145d522b37bf664b524be380)): ?>
<?php $component = $__componentOriginalbd5922df145d522b37bf664b524be380; ?>
<?php unset($__componentOriginalbd5922df145d522b37bf664b524be380); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginale48b4598ffc2f41a085f001458a956d1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale48b4598ffc2f41a085f001458a956d1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale48b4598ffc2f41a085f001458a956d1)): ?>
<?php $attributes = $__attributesOriginale48b4598ffc2f41a085f001458a956d1; ?>
<?php unset($__attributesOriginale48b4598ffc2f41a085f001458a956d1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale48b4598ffc2f41a085f001458a956d1)): ?>
<?php $component = $__componentOriginale48b4598ffc2f41a085f001458a956d1; ?>
<?php unset($__componentOriginale48b4598ffc2f41a085f001458a956d1); ?>
<?php endif; ?>
    <a class="btn btn-outline--primary h-45" href="<?php echo e(route('admin.product.create')); ?>"><i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/admin/product/index.blade.php ENDPATH**/ ?>