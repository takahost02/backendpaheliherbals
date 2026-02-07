<?php $__env->startSection('panel'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <?php if($user->kyc_data): ?>
                        <ul class="list-group">
                          <?php $__currentLoopData = $user->kyc_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if(!$val->value) continue; ?>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo e(__($val->name)); ?>

                            <span>
                                <?php if($val->type == 'checkbox'): ?>
                                    <?php echo e(implode(',',$val->value)); ?>

                                <?php elseif($val->type == 'file'): ?>
                                    <?php if($val->value): ?>
                                    <a href="<?php echo e(route('admin.download.attachment',encrypt(getFilePath('verify').'/'.$val->value))); ?>"><i class="fa-regular fa-file"></i>  <?php echo app('translator')->get('Attachment'); ?> </a>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('No File'); ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                <p><?php echo e(__($val->value)); ?></p>
                                <?php endif; ?>
                            </span>
                          </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php else: ?>
                        <h5 class="text-center"><?php echo app('translator')->get('KYC data not found'); ?></h5>
                    <?php endif; ?>

                    <?php if($user->kv == Status::KYC_UNVERIFIED): ?>
                    <div class="my-3">
                        <h6><?php echo app('translator')->get('Rejection Reason'); ?></h6>
                        <p><?php echo e($user->kyc_rejection_reason); ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if($user->kv == Status::KYC_PENDING): ?>
                    <div class="d-flex flex-wrap justify-content-end mt-3">
                        <button class="btn btn-outline--danger me-3" data-bs-toggle="modal" data-bs-target="#kycRejectionModal"><i class="las la-ban"></i><?php echo app('translator')->get('Reject'); ?></button>
                        <button class="btn btn-outline--success confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to approve this documents?'); ?>" data-action="<?php echo e(route('admin.users.kyc.approve', $user->id)); ?>"><i class="las la-check"></i><?php echo app('translator')->get('Approve'); ?></button>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    <div id="kycRejectionModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Reject KYC Documents'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.users.kyc.reject', $user->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="alert alert-primary p-3">
                            <?php echo app('translator')->get('If you reject these documents, the user will be able to re-submit new documents and these documents will be replaced by new documents.'); ?>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Rejection Reason'); ?></label>
                            <textarea class="form-control" name="reason" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100"><?php echo app('translator')->get('Submit'); ?></button>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/users/kyc_detail.blade.php ENDPATH**/ ?>