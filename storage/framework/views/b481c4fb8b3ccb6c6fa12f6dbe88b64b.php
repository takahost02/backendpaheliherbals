
<?php $__env->startSection('panel'); ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--lg table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Price'); ?></th>
                                    <th><?php echo app('translator')->get('Business Volume (BV)'); ?></th>
                                    <th><?php echo app('translator')->get('Referral Commission'); ?></th>
                                    <th><?php echo app('translator')->get('Tree Commission'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>

                                        <td><?php echo e(__($plan->name)); ?></td>
                                        <td><?php echo e(showAmount($plan->price)); ?></td>
                                        <td><?php echo e($plan->bv); ?></td>
                                        <td> <?php echo e(showAmount($plan->ref_com)); ?></td>
                                        <td> <?php echo e(showAmount($plan->tree_com)); ?></td>
                                        <td><?php echo $plan->statusBadge ?> </td>
                                        <td>
                                            <div class="button--group">
                                                <button class="btn btn-outline--primary cuModalBtn btn-sm" data-modal_title="<?php echo app('translator')->get('Update Plan'); ?>"
                                                    data-resource="<?php echo e($plan); ?>">
                                                    <i class="las la-pen"></i><?php echo app('translator')->get('Edit'); ?>
                                                </button>
                                                <?php if($plan->status == Status::ENABLE): ?>
                                                    <button class="btn btn-outline--danger btn-sm confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to disable this plan?'); ?>"
                                                        data-action="<?php echo e(route('admin.plan.status', $plan->id)); ?>">
                                                        <i class="las la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-outline--success confirmationBtn btn-sm" data-question="<?php echo app('translator')->get('Are you sure to enable this plan?'); ?>"
                                                        data-action="<?php echo e(route('admin.plan.status', $plan->id)); ?>">
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
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form method="post" action="<?php echo e(route('admin.plan.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="font-weight-bold"> <?php echo app('translator')->get('Name'); ?></label>
                                <input class="form-control" name="name" type="text" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="font-weight-bold"> <?php echo app('translator')->get('Price'); ?> </label>
                                <div class="input-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><?php echo e(gs('cur_sym')); ?> </span>
                                        <input class="form-control" name="price" type="number" step="any" required value="<?php echo e(old('price')); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label class="font-weight-bold"> <?php echo app('translator')->get('Business Volume (BV)'); ?>
                                    <span data-bs-toggle="tooltip" data-bs-title="<?php echo app('translator')->get('If a user who subscribed to this plan, refers someone and if the referred user buys a plan, then he will get this amount'); ?>">
                                        <i class="las la-exclamation-circle"></i>
                                    </span>
                                </label>
                                <input class="form-control" name="bv" type="number" min="0" required value="<?php echo e(old('bv')); ?>">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="font-weight-bold"> <?php echo app('translator')->get('Referral Commission'); ?>
                                    <span data-bs-toggle="tooltip" data-bs-title="<?php echo app('translator')->get('If a user who subscribed to this plan, refers someone and if the referred user buys a plan, then he will get this amount.'); ?>">
                                        <i class="las la-exclamation-circle"></i>
                                    </span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><?php echo e(gs('cur_sym')); ?> </span>
                                        <input class="form-control" name="ref_com" type="number" step="any" required value="<?php echo e(old('ref_com')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="font-weight-bold"> <?php echo app('translator')->get('Tree Commission'); ?>
                                    <span data-bs-toggle="tooltip" data-bs-title="<?php echo app('translator')->get('When someone buys this plan, all of his ancestors will get this amount'); ?>">
                                        <i class="las la-exclamation-circle"></i>
                                    </span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><?php echo e(gs('cur_sym')); ?> </span>
                                        <input class="form-control" name="tree_com" type="number" step="any" required value="<?php echo e(old('tree_com')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn-block btn btn--primary h-45 w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
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
    <button class="btn btn-outline--primary h-45 cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Plan'); ?>">
        <i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?>
    </button>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/plan/index.blade.php ENDPATH**/ ?>