<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get('User'); ?></th>
                                <th><?php echo app('translator')->get('Email-Mobile'); ?></th>
                                <th><?php echo app('translator')->get('Country'); ?></th>
                                <th><?php echo app('translator')->get('Joined At'); ?></th>
                                <th><?php echo app('translator')->get('Balance'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <span class="fw-bold"><?php echo e($user->fullname); ?></span>
                                    <br>
                                    <span class="small">
                                    <a href="<?php echo e(route('admin.users.detail', $user->id)); ?>"><span>@</span><?php echo e($user->username); ?></a>
                                    </span>
                                </td>


                                <td>
                                    <?php echo e($user->email); ?><br><?php echo e($user->mobileNumber); ?>

                                </td>
                                <td>
                                    <span class="fw-bold" title="<?php echo e(@$user->country_name); ?>"><?php echo e($user->country_code); ?></span>
                                </td>



                                <td>
                                    <?php echo e(showDateTime($user->created_at)); ?> <br> <?php echo e(diffForHumans($user->created_at)); ?>

                                </td>


                                <td>
                                    <span class="fw-bold">

                                    <?php echo e(showAmount($user->balance)); ?>

                                    </span>
                                </td>

                                <td>
                                    <div class="button--group">
                                        <a href="<?php echo e(route('admin.users.detail', $user->id)); ?>" class="btn btn-sm btn-outline--primary">
                                            <i class="las la-desktop"></i> <?php echo app('translator')->get('Details'); ?>
                                        </a>
                                        <?php if(request()->routeIs('admin.users.kyc.pending')): ?>
                                        <a href="<?php echo e(route('admin.users.kyc.details', $user->id)); ?>" target="_blank" class="btn btn-sm btn-outline--dark">
                                            <i class="las la-user-check"></i><?php echo app('translator')->get('KYC Data'); ?>
                                        </a>
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
                <?php if($users->hasPages()): ?>
                <div class="card-footer py-4">
                    <?php echo e(paginateLinks($users)); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginale48b4598ffc2f41a085f001458a956d1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale48b4598ffc2f41a085f001458a956d1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Username / Email']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Username / Email']); ?>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/admin/users/list.blade.php ENDPATH**/ ?>