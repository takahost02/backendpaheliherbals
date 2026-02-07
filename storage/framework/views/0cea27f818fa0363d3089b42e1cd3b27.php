

<?php $__env->startSection('panel'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive--lg table-responsive">
                    <table class="table--light style--two table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('User'); ?></th>
                                <th><?php echo app('translator')->get('Amount'); ?></th>
                                <th><?php echo app('translator')->get('Source'); ?></th>
                                <th><?php echo app('translator')->get('Level'); ?></th>
                                <th><?php echo app('translator')->get('Type'); ?></th>
                                <th><?php echo app('translator')->get('Details'); ?></th>
                                <th><?php echo app('translator')->get('Date'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <?php if($commission->user): ?>
                                            <span class="fw-bold"><?php echo e($commission->user->fullname); ?></span><br>
                                            <span class="small">
                                                <a href="<?php echo e(route('admin.users.detail', $commission->user_id)); ?>">
                                                    <span>@</span><?php echo e($commission->user->username); ?>

                                                </a>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-danger">User not found</span>
                                        <?php endif; ?>
                                    </td>
                   
                                    <td><?php echo e(showAmount($commission->amount)); ?></td>
                                    <td><?php echo e($commission->source_username ?? '-'); ?></td>
                                    <td><?php echo e($commission->level ?? '-'); ?></td>
                                    <td><?php echo e(ucfirst($commission->type)); ?></td>
                                    <td>
                                        <?php
                                            $words = explode(' ', $commission->details);
                                            $wrapped = collect($words)
                                                ->chunk(5)
                                                ->map(fn($chunk) => implode(' ', $chunk->toArray()))
                                                ->toArray();
                                        ?>
                                        <?php echo implode('<br>', $wrapped); ?>

                                    </td>


                                    <td><?php echo e(showDateTime($commission->created_at)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">
                                        <?php echo e(__($emptyMessage)); ?>

                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php if($commissions->hasPages()): ?>
                <div class="card-footer py-4">
                    <?php echo e(paginateLinks($commissions)); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/commissions.blade.php ENDPATH**/ ?>