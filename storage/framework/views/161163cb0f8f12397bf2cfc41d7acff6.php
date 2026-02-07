

<?php $__env->startSection('panel'); ?>

<?php
    // Support both controller variable names
    $withdrawal = $withdraw ?? $withdrawal ?? null;
?>

<?php if(!$withdrawal): ?>
    <div class="alert alert-danger text-center">
        <?php echo app('translator')->get('Withdrawal data not found. Please go back and try again.'); ?>
    </div>
    @return
<?php endif; ?>

<div class="row mb-none-30">

    
    
    
    <div class="col-lg-4 col-md-4 mb-30">
        <div class="card overflow-hidden box--shadow1">
            <div class="card-body">

                <h5 class="mb-3 text-muted">
                    <?php echo app('translator')->get('Withdraw Via'); ?>
                    <?php echo e(__($withdrawal->method->name ?? '-')); ?>

                </h5>

                <ul class="list-group list-group-flush">

                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo app('translator')->get('Date'); ?></span>
                        <span class="fw-bold">
                            <?php echo e(showDateTime($withdrawal->created_at)); ?>

                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo app('translator')->get('Trx Number'); ?></span>
                        <span class="fw-bold">
                            <?php echo e($withdrawal->trx ?? '-'); ?>

                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo app('translator')->get('Username'); ?></span>
                        <span class="fw-bold">
                            <?php if($withdrawal->user): ?>
                                <a href="<?php echo e(route('admin.users.detail', $withdrawal->user_id)); ?>">
                                    <span>@</span><?php echo e($withdrawal->user->username); ?>

                                </a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo app('translator')->get('Method'); ?></span>
                        <span class="fw-bold">
                            <?php echo e(__($withdrawal->method->name ?? '-')); ?>

                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo app('translator')->get('Amount'); ?></span>
                        <span class="fw-bold">
                            <?php echo e(showAmount($withdrawal->amount)); ?>

                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo app('translator')->get('Charge'); ?></span>
                        <span class="fw-bold">
                            <?php echo e(showAmount($withdrawal->charge)); ?>

                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo app('translator')->get('After Charge'); ?></span>
                        <span class="fw-bold">
                            <?php echo e(showAmount($withdrawal->after_charge)); ?>

                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo app('translator')->get('Rate'); ?></span>
                        <span class="fw-bold">
                            1 <?php echo e(__(gs('cur_text'))); ?> =
                            <?php echo e(showAmount($withdrawal->rate)); ?>

                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo app('translator')->get('Payable'); ?></span>
                        <span class="fw-bold">
                            <?php echo e(showAmount($withdrawal->final_amount)); ?>

                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo app('translator')->get('Status'); ?></span>
                        <span>
                            <?php echo $withdrawal->statusBadge; ?>

                        </span>
                    </li>

                    <?php if(!empty($withdrawal->admin_feedback)): ?>
                        <li class="list-group-item">
                            <strong><?php echo app('translator')->get('Admin Response'); ?></strong>
                            <p class="mb-0 mt-1 text-muted">
                                <?php echo e($withdrawal->admin_feedback); ?>

                            </p>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </div>

    
    
    
    <div class="col-lg-8 col-md-8 mb-30">
        <div class="card overflow-hidden box--shadow1">
            <div class="card-body">

                <h5 class="card-title border-bottom pb-2 mb-3">
                    <?php echo app('translator')->get('User Withdraw Information'); ?>
                </h5>

                
                <?php if(!empty($details)): ?>
                    <?php $__currentLoopData = json_decode($details); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row mb-3">
                            <div class="col-12">

                                <h6 class="mb-1">
                                    <?php echo e(__($val->name ?? '-')); ?>

                                </h6>

                                <?php if(($val->type ?? '') === 'checkbox'): ?>
                                    <p class="mb-0">
                                        <?php echo e(implode(', ', (array) ($val->value ?? []))); ?>

                                    </p>

                                <?php elseif(($val->type ?? '') === 'file'): ?>
                                    <?php if(!empty($val->value)): ?>
                                        <a
                                            href="<?php echo e(route('admin.download.attachment', encrypt(getFilePath('verify') . '/' . $val->value))); ?>"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fa-regular fa-file"></i>
                                            <?php echo app('translator')->get('Download Attachment'); ?>
                                        </a>
                                    <?php else: ?>
                                        <p class="text-muted mb-0">
                                            <?php echo app('translator')->get('No File'); ?>
                                        </p>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <p class="mb-0">
                                        <?php echo e(__($val->value ?? '-')); ?>

                                    </p>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="text-muted">
                        <?php echo app('translator')->get('No additional withdrawal information provided.'); ?>
                    </p>
                <?php endif; ?>

                
                <?php if($withdrawal->status == Status::PAYMENT_PENDING): ?>
                    <div class="mt-4 d-flex gap-2">
                        <button
                            type="button"
                            class="btn btn-outline--success btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#approveModal">
                            <i class="las la-check"></i>
                            <?php echo app('translator')->get('Approve'); ?>
                        </button>

                        <button
                            type="button"
                            class="btn btn-outline--danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#rejectModal">
                            <i class="las la-ban"></i>
                            <?php echo app('translator')->get('Reject'); ?>
                        </button>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>




<div id="approveModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <?php echo app('translator')->get('Approve Withdrawal Confirmation'); ?>
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <form
                action="<?php echo e(route('admin.withdraw.data.approve', $withdrawal->id)); ?>"
                method="POST">
                <?php echo csrf_field(); ?>

                <div class="modal-body">
                    <p class="mb-2">
                        <?php echo app('translator')->get('Have you sent'); ?>
                        <span class="fw-bold text--success">
                            <?php echo e(showAmount($withdrawal->final_amount, currencyFormat: false)); ?>

                            <?php echo e($withdrawal->currency); ?>

                        </span>?
                    </p>

                    <textarea
                        name="details"
                        class="form-control"
                        rows="3"
                        placeholder="<?php echo app('translator')->get('Provide the details. eg: transaction number'); ?>"
                        required><?php echo e(old('details')); ?></textarea>
                </div>

                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn--primary w-100">
                        <?php echo app('translator')->get('Submit'); ?>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>




<div id="rejectModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <?php echo app('translator')->get('Reject Withdrawal Confirmation'); ?>
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <form
                action="<?php echo e(route('admin.withdraw.data.reject', $withdrawal->id)); ?>"
                method="POST">
                <?php echo csrf_field(); ?>

                <div class="modal-body">
                    <label class="form-label">
                        <?php echo app('translator')->get('Reason of Rejection'); ?>
                    </label>

                    <textarea
                        name="details"
                        class="form-control"
                        rows="3"
                        placeholder="<?php echo app('translator')->get('Provide rejection reason'); ?>"
                        required><?php echo e(old('details')); ?></textarea>
                </div>

                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn--primary w-100">
                        <?php echo app('translator')->get('Submit'); ?>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/admin/withdraw/detail.blade.php ENDPATH**/ ?>