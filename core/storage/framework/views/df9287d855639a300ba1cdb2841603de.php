<?php $__env->startSection('panel'); ?>
<?php $__env->startPush('topBar'); ?>
<?php echo $__env->make('admin.gateways.top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Gateway'); ?></th>
                                <th><?php echo app('translator')->get('Status'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <?php echo e(__($gateway->name)); ?>

                                    </td>

                                    <td>
                                        <?php
                                            echo $gateway->statusBadge
                                        ?>
                                    </td>
                                    <td>
                                        <div class="button--group">
                                            <a href="<?php echo e(route('admin.gateway.manual.edit', $gateway->alias)); ?>" class="btn btn-sm btn-outline--primary editGatewayBtn">
                                                <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                            </a>

                                            <?php if($gateway->status == Status::DISABLE): ?>
                                                <button class="btn btn-sm btn-outline--success confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to enable this gateway?'); ?>" data-action="<?php echo e(route('admin.gateway.manual.status',$gateway->id)); ?>">
                                                    <i class="la la-eye"></i><?php echo app('translator')->get('Enable'); ?>
                                                </button>
                                            <?php else: ?>
                                                <button class="btn btn-sm btn-outline--danger confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to disable this gateway?'); ?>" data-action="<?php echo e(route('admin.gateway.manual.status',$gateway->id)); ?>">
                                                    <i class="la la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
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
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
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
    <div class="input-group w-auto search-form">
        <input type="text" name="search_table" class="form-control bg--white" placeholder="<?php echo app('translator')->get('Search'); ?>...">
        <button class="btn btn--primary input-group-text"><i class="fas fa-search"></i></button>
    </div>
    <a class="btn btn-outline--primary" href="<?php echo e(route('admin.gateway.manual.create')); ?>"><i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/admin/gateways/manual/list.blade.php ENDPATH**/ ?>