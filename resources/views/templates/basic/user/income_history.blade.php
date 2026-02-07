@extends($activeTemplate . 'layouts.master')
@section('content')
    
    <div class="card custom--card  p-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="custom--table table">
                    <thead>
                        <tr>
                            <th>@lang('Transaction')</th>
                            <th>@lang('Initiated')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Post Balance')</th>
                            <th>@lang('Remark')</th>
                            <th>@lang('Details')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                {{-- Transaction --}}
                                <td>
                                    <span class="fw-bold">
                                        <span class="text-primary">
                                            @if ($transaction->method_code < 5000)
                                                {{ __(@$transaction->gateway->name) }}
                                            @else
                                                @lang('Google Pay')
                                            @endif
                                        </span>
                                    </span>
                                    <br>
                                    <small>{{ $transaction->trx }}</small>
                                </td>
                
                                {{-- Initiated --}}
                                <td>
                                    {{ showDateTime($transaction->created_at) }}
                                    <br>
                                    {{ diffForHumans($transaction->created_at) }}
                                </td>
                
                                {{-- Amount --}}
                                <td>
                                    <strong data-bs-toggle="tooltip" title="@lang('Amount with charge')">
                                        {{ showAmount($transaction->amount) }}
                                    </strong>
                                </td>
                
                                {{-- Post Balance --}}
                                <td>
                                    <strong data-bs-toggle="tooltip" title="@lang('Post Balance')">
                                        {{ showAmount($transaction->post_balance) }}
                                    </strong>
                                </td>
                
                                {{-- Remark --}}
                                <td>
                                    <span class="badge bg-info">
                                        {{ ucfirst($transaction->remark) }}
                                    </span>
                                </td>
                
                                {{-- Details --}}
                                <td>
                                    {{ $transaction->details ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center">
                                    {{ __($emptyMessage) }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </div>
    @if ($transactions->hasPages())
        <div class="mt-4">
            {{ paginateLinks($transactions) }}
        </div>
    @endif
@endsection

@push('modal')
    {{-- APPROVE MODAL --}}
    <div class="modal fade" id="detailModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
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
@endpush


@push('script')
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
                                <span"><a href="${element.value}"><i class="fa-regular fa-file"></i> @lang('Attachment')</a></span>
                            </li>`;
                        }
                    });
                }

                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3">
                            <strong>@lang('Admin Feedback')</strong>
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
@endpush
