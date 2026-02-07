

<?php $__env->startSection('panel'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="show-filter mb-3 text-end d-flex justify-content-end gap-2">
            <button class="btn btn-outline--primary showFilterBtn btn-sm" type="button">
                <i class="las la-filter"></i> <?php echo app('translator')->get('Filter'); ?>
            </button>
            <button id="downloadPdf" class="btn btn-outline--success btn-sm" type="button">
                <i class="las la-file-pdf"></i> <?php echo app('translator')->get('Download PDF'); ?>
            </button>
            <button id="downloadAllUsersPdf" class="btn btn-outline--warning btn-sm" type="button">
                <i class="las la-users"></i> <?php echo app('translator')->get('Download All Users PDF'); ?>
            </button>
        </div>

        <div class="card responsive-filter-card mb-4">
            <div class="card-body">
                <form>
                    <div class="d-flex flex-wrap gap-4">
                        <div class="flex-grow-1">
                            <label><?php echo app('translator')->get('TRX/Username'); ?></label>
                            <input class="form-control" name="search" type="search"
                                   value="<?php echo e(request()->search); ?>" placeholder="<?php echo app('translator')->get('Search'); ?>">
                        </div>

                        <?php if(request()->routeIs('admin.report.transaction')): ?>
                            <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Type'); ?></label>
                                <select class="form-control select2" name="trx_type" data-minimum-results-for-search="-1">
                                    <option value=""><?php echo app('translator')->get('All'); ?></option>
                                    <option value="+" <?php if(request()->trx_type == '+'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Plus'); ?></option>
                                    <option value="-" <?php if(request()->trx_type == '-'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Minus'); ?></option>
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Remark'); ?></label>
                                <select class="form-control select2" name="remark" data-minimum-results-for-search="-1">
                                    <option value=""><?php echo app('translator')->get('All'); ?></option>
                                    <?php $__currentLoopData = $remarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $remark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($remark->remark); ?>" <?php if(request()->remark == $remark->remark): echo 'selected'; endif; ?>>
                                            <?php echo e(__(keyToTitle($remark->remark))); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <?php endif; ?>

                        <div class="flex-grow-1">
                            <label><?php echo app('translator')->get('Date'); ?></label>
                            <input class="datepicker-here form-control bg--white date-range pe-2"
                                   name="date" type="search" value="<?php echo e(request()->date); ?>"
                                   placeholder="<?php echo app('translator')->get('Start Date - End Date'); ?>" autocomplete="off">
                        </div>

                        <div class="flex-grow-1 align-self-end">
                            <button class="btn btn--primary w-100 h-45">
                                <i class="fas fa-filter"></i> <?php echo app('translator')->get('Filter'); ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive--lg table-responsive">
                    <table id="transactionTable" class="table--light style--two table">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('User'); ?></th>
                            <th><?php echo app('translator')->get('TRX'); ?></th>
                            <th><?php echo app('translator')->get('Transacted'); ?></th>
                            <th><?php echo app('translator')->get('Amount'); ?></th>
                            <th><?php echo app('translator')->get('Post Balance'); ?></th>
                            <th><?php echo app('translator')->get('Details'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr data-username="<?php echo e($trx->user->username ?? 'deleted'); ?>">
                                <td>
                                    <span class="fw-bold"><?php echo e(optional($trx->user)->fullname ?? 'User Deleted'); ?></span><br>
                                    <span class="small">
                                        <?php if($trx->user): ?>
                                            <a href="<?php echo e(appendQuery('search', $trx->user->username)); ?>">
                                                <span>@</span><?php echo e($trx->user->username); ?>

                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">(User Deleted)</span>
                                        <?php endif; ?>
                                    </span>
                                </td>
                                <td><strong><?php echo e($trx->trx); ?></strong></td>
                                <td><?php echo e(showDateTime($trx->created_at)); ?><br><?php echo e(diffForHumans($trx->created_at)); ?></td>
                                <td>
                                    <span class="fw-bold <?php echo e($trx->trx_type == '+' ? 'text--success' : 'text--danger'); ?>">
                                        <?php echo e($trx->trx_type); ?> <?php echo e(showAmount($trx->amount)); ?>

                                    </span>
                                </td>
                                <td><?php echo e(showAmount($trx->post_balance)); ?></td>
                                <td><?php echo e(__($trx->details)); ?></td>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-lib'); ?>
<script src="<?php echo e(asset('assets/admin/js/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/daterangepicker.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
<link type="text/css" href="<?php echo e(asset('assets/admin/css/daterangepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
(function ($) {
    "use strict";

    // Setup datepicker
    $('.date-range').daterangepicker({
        autoUpdateInput: false,
        locale: { cancelLabel: 'Clear' },
        showDropdowns: true,
        maxDate: moment(),
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 15 Days': [moment().subtract(14, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'This Year': [moment().startOf('year'), moment().endOf('year')],
        }
    }).on('apply.daterangepicker', (ev, picker) => {
        $(ev.target).val(picker.startDate.format('MMMM DD, YYYY') + ' - ' + picker.endDate.format('MMMM DD, YYYY'));
    });

    // Download single PDF (current page table)
    $('#downloadPdf').on('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'pt', 'a4');
        doc.setFont("helvetica").setFontSize(12);
        doc.text("Transaction Report", 40, 30);

        doc.autoTable({
            html: '#transactionTable',
            startY: 50,
            theme: 'grid',
            styles: { fontSize: 9, cellPadding: 4, overflow: 'linebreak', halign: 'left', valign: 'middle' },
            headStyles: { fillColor: [22, 160, 133] },
            didParseCell: (data) => {
                if (typeof data.cell.raw === "string") {
                    data.cell.text = data.cell.raw.replace(/₹/g, '\u20B9');
                }
            }
        });

        doc.save("transactions.pdf");
    });

    // Download PDF for each user (current page only)
    $('#downloadAllUsersPdf').on('click', function () {
        const { jsPDF } = window.jspdf;
        let usernames = [];

        $('#transactionTable tbody tr').each(function () {
            let u = $(this).data('username');
            if (u && u !== 'deleted' && !usernames.includes(u)) usernames.push(u);
        });

        if (!usernames.length) {
            alert("No active users found in the table.");
            return;
        }

        let doc = new jsPDF('l', 'pt', 'a4');
        let firstPage = true;

        usernames.forEach((username) => {
            if (!firstPage) doc.addPage();
            firstPage = false;

            doc.setFont("helvetica").setFontSize(12);
            doc.text("Transaction Report - @" + username, 40, 30);

            let filteredTable = $('<table></table>').append($('#transactionTable thead').clone());
            let tbody = $('<tbody></tbody>');

            $('#transactionTable tbody tr').each(function () {
                if ($(this).data('username') === username) tbody.append($(this).clone());
            });

            filteredTable.append(tbody);

            doc.autoTable({
                html: filteredTable.get(0),
                startY: 50,
                theme: 'grid',
                styles: { fontSize: 9, cellPadding: 4, overflow: 'linebreak', halign: 'left', valign: 'middle' },
                headStyles: { fillColor: [22, 160, 133] },
                didParseCell: (data) => {
                    if (typeof data.cell.raw === "string") {
                        data.cell.text = data.cell.raw.replace(/₹/g, '\u20B9');
                    }
                }
            });
        });

        let today = new Date().toISOString().split('T')[0];
        doc.save(`transactions_all_users_${today}.pdf`);
    });

})(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/admin/reports/transactions.blade.php ENDPATH**/ ?>