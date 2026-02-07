<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Method'); ?></th>
                                    <th><?php echo app('translator')->get('Currency'); ?></th>
                                    <th><?php echo app('translator')->get('Charge'); ?></th>
                                    <th><?php echo app('translator')->get('Withdraw Limit'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb"><img src="<?php echo e(getImage(getFilePath('withdrawMethod') . '/' . $method->image)); ?>"
                                                        alt="<?php echo app('translator')->get('image'); ?>"></div>
                                                <span class="name"><?php echo e(__($method->name)); ?></span>
                                            </div>
                                        </td>

                                        <td class="fw-bold"><?php echo e(__($method->currency)); ?></td>
                                        <td class="fw-bold"><?php echo e(showAmount($method->fixed_charge)); ?>

                                            <?php echo e(0 < $method->percent_charge ? ' + ' . showAmount($method->percent_charge) . ' %' : ''); ?> </td>
                                        <td class="fw-bold"><?php echo e(showAmount($method->min_limit)); ?>

                                            <?php echo app('translator')->get('to'); ?> <?php echo e(showAmount($method->max_limit)); ?></td>
                                        <td>
                                            <?php
                                                echo $method->statusBadge;
                                            ?>
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <a href="<?php echo e(route('admin.withdraw.method.edit', $method->id)); ?>"
                                                    class="btn btn-sm btn-outline--primary ms-1"><i class="las la-pen"></i><?php echo app('translator')->get('Edit'); ?></a>
                                                <?php if($method->status == Status::ENABLE): ?>
                                                    <button class="btn btn-sm btn-outline--danger ms-1 confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to disable this method?'); ?>"
                                                        data-action="<?php echo e(route('admin.withdraw.method.status', $method->id)); ?>">
                                                        <i class="la la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-outline--success ms-1 confirmationBtn"
                                                        data-question="<?php echo app('translator')->get('Are you sure to enable this method?'); ?>"
                                                        data-action="<?php echo e(route('admin.withdraw.method.status', $method->id)); ?>">
                                                        <i class="la la-eye"></i><?php echo app('translator')->get('Enable'); ?>
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
    <div class="input-group w-auto search-form">
        <input type="text" name="search_table" class="form-control bg--white" placeholder="<?php echo app('translator')->get('Search'); ?>...">
        <button class="btn btn--primary input-group-text"><i class="fas fa-search"></i></button>
    </div>
    <a class="btn btn-outline--primary" href="<?php echo e(route('admin.withdraw.method.create')); ?>"><i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/admin/withdraw/index.blade.php ENDPATH**/ ?>