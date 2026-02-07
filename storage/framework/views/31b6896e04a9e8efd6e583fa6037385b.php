<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Subject'); ?></th>
                                <th><?php echo app('translator')->get('Submitted By'); ?></th>
                                <th><?php echo app('translator')->get('Status'); ?></th>
                                <th><?php echo app('translator')->get('Priority'); ?></th>
                                <th><?php echo app('translator')->get('Last Reply'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e(route('admin.ticket.view', $item->id)); ?>" class="fw-bold"> [<?php echo app('translator')->get('Ticket'); ?>#<?php echo e($item->ticket); ?>] <?php echo e(strLimit($item->subject,30)); ?> </a>
                                    </td>

                                    <td>
                                        <?php if($item->user_id): ?>
                                        <a href="<?php echo e(route('admin.users.detail', $item->user_id)); ?>"> <?php echo e(@$item->user->fullname); ?></a>
                                        <?php else: ?>
                                            <p class="fw-bold"> <?php echo e($item->name); ?></p>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo $item->statusBadge; ?>
                                    </td>
                                    <td>
                                        <?php if($item->priority == Status::PRIORITY_LOW): ?>
                                            <span class="badge badge--dark"><?php echo app('translator')->get('Low'); ?></span>
                                        <?php elseif($item->priority == Status::PRIORITY_MEDIUM): ?>
                                            <span class="badge  badge--warning"><?php echo app('translator')->get('Medium'); ?></span>
                                        <?php elseif($item->priority == Status::PRIORITY_HIGH): ?>
                                            <span class="badge badge--danger"><?php echo app('translator')->get('High'); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php echo e(diffForHumans($item->last_reply)); ?>

                                    </td>

                                    <td>
                                        <a href="<?php echo e(route('admin.ticket.view', $item->id)); ?>" class="btn btn-sm btn-outline--primary ms-1">
                                            <i class="las la-desktop"></i> <?php echo app('translator')->get('Details'); ?>
                                        </a>
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
                <?php if($items->hasPages()): ?>
                <div class="card-footer py-4">
                    <?php echo e(paginateLinks($items)); ?>

                </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginale48b4598ffc2f41a085f001458a956d1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale48b4598ffc2f41a085f001458a956d1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Search here...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Search here...']); ?>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/admin/support/tickets.blade.php ENDPATH**/ ?>