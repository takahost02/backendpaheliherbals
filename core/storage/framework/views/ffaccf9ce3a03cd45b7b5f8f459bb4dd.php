<?php $__env->startSection('content'); ?>
    <div class="d-flex align-items-center justify-content-end mb-3 flex-wrap gap-3">
        <form>
            <div class="input-group">
                <input class="form-control form--control" name="search" type="search" value="<?php echo e(request()->search); ?>" placeholder="<?php echo app('translator')->get('Search by transactions'); ?>">
                <button class="input-group-text">
                    <i class="las la-search"></i>
                </button>
            </div>
        </form>
        <a class="btn btn--base" href="<?php echo e(route('user.withdraw')); ?>">
            <i class="las la-plus"></i> <?php echo app('translator')->get('Withdraw Now'); ?>
        </a>
    </div>
    <div class="card custom--card p-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="custom--table table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('Gateway | Transaction'); ?></th>
                            <th class="text-md-center text-end"><?php echo app('translator')->get('Initiated'); ?></th>
                            <th class="text-md-center text-end"><?php echo app('translator')->get('Amount'); ?></th>
                            <th class="text-md-center text-end"><?php echo app('translator')->get('Conversion'); ?></th>
                            <th class="text-md-center text-end"><?php echo app('translator')->get('Status'); ?></th>
                            <th><?php echo app('translator')->get('Action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $details = [];
                                foreach ($withdraw->withdraw_information as $key => $info) {
                                    $details[] = $info;
                                    if ($info->type == 'file' && @$info->value) {
                                        $details[$key]->value = route(
                                            'user.download.attachment',
                                            encrypt(getFilePath('verify') . '/' . $info->value),
                                        );
                                    }
                                }
                            ?>
                            <tr>
                                <td>
                                    <span class="fw-bold"><span class="text-primary"> <?php echo e(__(@$withdraw->method->name)); ?></span></span>
                                    <br>
                                    <small><?php echo e($withdraw->trx); ?></small>
                                </td>
                                <td class="text-md-center text-end">
                                    <?php echo e(showDateTime($withdraw->created_at)); ?> <br> <?php echo e(diffForHumans($withdraw->created_at)); ?>

                                </td>
                                <td class="text-md-center text-end">
                                    <?php echo e(showAmount($withdraw->amount)); ?> - <span class="text--danger" data-bs-toggle="tooltip"
                                        title="<?php echo app('translator')->get('Processing Charge'); ?>"><?php echo e(showAmount($withdraw->charge)); ?> </span>
                                    <br>
                                    <strong data-bs-toggle="tooltip" title="<?php echo app('translator')->get('Amount after charge'); ?>">
                                        <?php echo e(showAmount($withdraw->amount - $withdraw->charge)); ?>

                                    </strong>

                                </td>
                                <td class="text-md-center text-end">
                                    <?php echo e(showAmount(1)); ?> = <?php echo e(showAmount($withdraw->rate, currencyFormat: false)); ?> <?php echo e(__($withdraw->currency)); ?>

                                    <br>
                                    <strong><?php echo e(showAmount($withdraw->final_amount, currencyFormat: false)); ?> <?php echo e(__($withdraw->currency)); ?></strong>
                                </td>
                                <td class="text-md-center text-end">
                                    <?php echo $withdraw->statusBadge ?>
                                </td>
                                <td>
                                    <button class="btn btn--sm btn--base detailBtn" data-user_data="<?php echo e(json_encode($details)); ?>"
                                        <?php if($withdraw->status == Status::PAYMENT_REJECT): ?> data-admin_feedback="<?php echo e($withdraw->admin_feedback); ?>" <?php endif; ?>>
                                        <i class="la la-desktop"></i>
                                    </button>
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

    <?php if($withdraws->hasPages()): ?>
        <div class="mt-4">
            <?php echo e(paginateLinks($withdraws)); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('modal'); ?>
    
    <div class="modal fade" id="detailModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Details'); ?></h5>
                    <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <ul class="list-group userData">

                    </ul>
                    <div class="feedback"></div>
                </div>
              
            </div>
        </div>
    </div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');
                var userData = $(this).data('user_data');
                var html = ``;
                userData.forEach(element => {
                    if (element.type != 'file') {
                        html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>${element.name}</span>
                            <span">${element.value}</span>
                        </li>`;
                    } else {
                        html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>${element.name}</span>
                            <span"><a href="${element.value}"><i class="fa-regular fa-file"></i> <?php echo app('translator')->get('Attachment'); ?></a></span>
                        </li>`;
                    }
                });
                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3">
                            <strong><?php echo app('translator')->get('Admin Feedback'); ?></strong>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }

                modal.find('.feedback').html(adminFeedback);

                modal.modal('show');
            });

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title], [data-title], [data-bs-title]'))
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/templates/basic/user/withdraw/log.blade.php ENDPATH**/ ?>