@extends('admin.layouts.app')

@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="show-filter mb-3 text-end d-flex justify-content-end gap-2">
            <button class="btn btn-outline--primary showFilterBtn btn-sm" type="button">
                <i class="las la-filter"></i> @lang('Filter')
            </button>
            <button id="downloadPdf" class="btn btn-outline--success btn-sm" type="button">
                <i class="las la-file-pdf"></i> @lang('Download PDF')
            </button>
            <button id="downloadAllUsersPdf" class="btn btn-outline--warning btn-sm" type="button">
                <i class="las la-users"></i> @lang('Download All Users PDF')
            </button>
        </div>

        <div class="card responsive-filter-card mb-4">
            <div class="card-body">
                <form>
                    <div class="d-flex flex-wrap gap-4">
                        <div class="flex-grow-1">
                            <label>@lang('TRX/Username')</label>
                            <input class="form-control" name="search" type="search"
                                   value="{{ request()->search }}" placeholder="@lang('Search')">
                        </div>

                        @if (request()->routeIs('admin.report.transaction'))
                            <div class="flex-grow-1">
                                <label>@lang('Type')</label>
                                <select class="form-control select2" name="trx_type" data-minimum-results-for-search="-1">
                                    <option value="">@lang('All')</option>
                                    <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                    <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label>@lang('Remark')</label>
                                <select class="form-control select2" name="remark" data-minimum-results-for-search="-1">
                                    <option value="">@lang('All')</option>
                                    @foreach ($remarks as $remark)
                                        <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>
                                            {{ __(keyToTitle($remark->remark)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="flex-grow-1">
                            <label>@lang('Date')</label>
                            <input class="datepicker-here form-control bg--white date-range pe-2"
                                   name="date" type="search" value="{{ request()->date }}"
                                   placeholder="@lang('Start Date - End Date')" autocomplete="off">
                        </div>

                        <div class="flex-grow-1 align-self-end">
                            <button class="btn btn--primary w-100 h-45">
                                <i class="fas fa-filter"></i> @lang('Filter')
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
                            <th>@lang('User')</th>
                            <th>@lang('TRX')</th>
                            <th>@lang('Transacted')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Post Balance')</th>
                            <th>@lang('Details')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($transactions as $trx)
                            <tr data-username="{{ $trx->user->username ?? 'deleted' }}">
                                <td>
                                    <span class="fw-bold">{{ optional($trx->user)->fullname ?? 'User Deleted' }}</span><br>
                                    <span class="small">
                                        @if($trx->user)
                                            <a href="{{ appendQuery('search', $trx->user->username) }}">
                                                <span>@</span>{{ $trx->user->username }}
                                            </a>
                                        @else
                                            <span class="text-muted">(User Deleted)</span>
                                        @endif
                                    </span>
                                </td>
                                <td><strong>{{ $trx->trx }}</strong></td>
                                <td>{{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}</td>
                                <td>
                                    <span class="fw-bold {{ $trx->trx_type == '+' ? 'text--success' : 'text--danger' }}">
                                        {{ $trx->trx_type }} {{ showAmount($trx->amount) }}
                                    </span>
                                </td>
                                <td>{{ showAmount($trx->post_balance) }}</td>
                                <td>{{ __($trx->details) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@push('script-lib')
<script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/daterangepicker.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
@endpush

@push('style-lib')
<link type="text/css" href="{{ asset('assets/admin/css/daterangepicker.css') }}" rel="stylesheet">
@endpush

@push('script')
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
@endpush
