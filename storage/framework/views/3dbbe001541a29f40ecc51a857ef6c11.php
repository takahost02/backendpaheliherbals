<?php $__env->startSection('content'); ?>
    
    <div class="card custom--card  p-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="custom--table table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('Transaction'); ?></th>
                            <th><?php echo app('translator')->get('Initiated'); ?></th>
                            <th><?php echo app('translator')->get('Amount'); ?></th>
                            <th>Post Balance</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <span class="fw-bold">
                                        <span class="text-primary">
                                            <?php if($transaction->method_code < 5000): ?>
                                                <?php echo e(__(@$transaction->gateway->name)); ?>

                                            <?php else: ?>
                                                <?php echo app('translator')->get('Google Pay'); ?>
                                            <?php endif; ?>
                                        </span>
                                    </span>
                                    <br>
                                    <small> <?php echo e($transaction->trx); ?> </small>
                                </td>

                                <td>
                                    <?php echo e(showDateTime($transaction->created_at)); ?><br><?php echo e(diffForHumans($transaction->created_at)); ?>

                                </td>
                                <td>
                                    <strong data-bs-toggle="tooltip" title="<?php echo app('translator')->get('Amount with charge'); ?>">
                                        <?php echo e(showAmount($transaction->amount)); ?>

                                    </strong>
                                </td>
                                <td>
                                    <strong data-bs-toggle="tooltip" title="<?php echo app('translator')->get('Amount with charge'); ?>">
                                        <?php echo e(showAmount($transaction->post_balance)); ?>

                                    </strong>
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
    <?php if($transactions->hasPages()): ?>
        <div class="mt-4">
            <?php echo e(paginateLinks($transactions)); ?>

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

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/user/binary_history.blade.php ENDPATH**/ ?>