<?php $__env->startSection('content'); ?>
    <div class="d-flex align-items-center justify-content-end mb-3 flex-wrap gap-3">
        <form>
            <div class="d-flex justify-content-end">
                <div class="input-group">
                    <input class="form-control form--control" name="search" type="search" value="<?php echo e(request()->search); ?>" placeholder="<?php echo app('translator')->get('Search by transactions'); ?>">
                    <button class="input-group-text">
                        <i class="las la-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <a class="btn btn--base" href="<?php echo e(route('user.deposit.index')); ?>">
            <i class="las la-plus"></i> <?php echo app('translator')->get('Deposit Now'); ?>
        </a>
    </div>
    <div class="card custom--card  p-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="custom--table table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('Gateway | Transaction'); ?></th>
                            <th><?php echo app('translator')->get('Initiated'); ?></th>
                            <th><?php echo app('translator')->get('Amount'); ?></th>
                            <th><?php echo app('translator')->get('Conversion'); ?></th>
                            <th><?php echo app('translator')->get('Status'); ?></th>
                            <th><?php echo app('translator')->get('Details'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <span class="fw-bold">
                                        <span class="text-primary">
                                            <?php if($deposit->method_code < 5000): ?>
                                                <?php echo e(__(@$deposit->gateway->name)); ?>

                                            <?php else: ?>
                                                <?php echo app('translator')->get('Google Pay'); ?>
                                            <?php endif; ?>
                                        </span>
                                    </span>
                                    <br>
                                    <small> <?php echo e($deposit->trx); ?> </small>
                                </td>

                                <td>
                                    <?php echo e(showDateTime($deposit->created_at)); ?><br><?php echo e(diffForHumans($deposit->created_at)); ?>

                                </td>
                                <td>
                                    <?php echo e(showAmount($deposit->amount)); ?> + <span class="text--danger" data-bs-toggle="tooltip"
                                        title="<?php echo app('translator')->get('Processing Charge'); ?>"><?php echo e(showAmount($deposit->charge)); ?> </span>
                                    <br>
                                    <strong data-bs-toggle="tooltip" title="<?php echo app('translator')->get('Amount with charge'); ?>">
                                        <?php echo e(showAmount($deposit->amount + $deposit->charge)); ?>

                                    </strong>
                                </td>
                                <td>
                                    <?php echo e(showAmount(1)); ?> = <?php echo e(showAmount($deposit->rate, currencyFormat: false)); ?> <?php echo e(__($deposit->method_currency)); ?>

                                    <br>
                                    <strong><?php echo e(showAmount($deposit->final_amount, currencyFormat: false)); ?> <?php echo e(__($deposit->method_currency)); ?></strong>
                                </td>
                                <td>
                                    <?php echo $deposit->statusBadge ?>
                                </td>
                                <?php
                                    $details = [];
                                    if ($deposit->method_code >= 1000 && $deposit->method_code <= 5000) {
                                        foreach (@$deposit->detail ?? [] as $key => $info) {
                                            $details[] = $info;
                                            if (@$info->type == 'file' && @$info->value) {
                                                @$details[$key]->value = route(
                                                    'user.download.attachment',
                                                    encrypt(getFilePath('verify') . '/' . @$info->value),
                                                );
                                            }
                                        }
                                    }
                                ?>

                                <td>
                                    <?php if($deposit->method_code >= 1000 && $deposit->method_code <= 5000): ?>
                                        <a class="btn btn--base btn--sm detailBtn" data-info="<?php echo e(json_encode($details)); ?>" href="javascript:void(0)"
                                            <?php if($deposit->status == Status::PAYMENT_REJECT): ?> data-admin_feedback="<?php echo e($deposit->admin_feedback); ?>" <?php endif; ?>>
                                            <i class="fas fa-desktop"></i>
                                        </a>
                                    <?php else: ?>
                                        <button class="btn btn--success btn--sm" data-bs-toggle="tooltip" type="button" title="<?php echo app('translator')->get('Automatically processed'); ?>">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <?php if($deposits->hasPages()): ?>
        <div class="mt-4">
            <?php echo e(paginateLinks($deposits)); ?>

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
                    <ul class="list-group userData mb-2">
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

                var userData = $(this).data('info');
                var html = '';
                if (userData) {
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
                }

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

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/user/deposit_history.blade.php ENDPATH**/ ?>