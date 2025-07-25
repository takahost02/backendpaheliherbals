@php
    $transactionContent = getContent('transaction.content', true);
    $transactions = App\Models\Transaction::orderBy('id','desc')->take(10)->with('user')->get();
@endphp

@if (!blank($transactionContent))
<section class="transection-section padding-top padding-bottom pos-rel">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section-header text-center">
                    <span class="subtitle">{{ __(@$transactionContent->data_values->heading) }}</span>
                    <h2 class="title">{{ __(@$transactionContent->data_values->sub_heading) }}</h2>
                </div>
            </div>
        </div>
        <div class="transection-table-wrapper">
            <table class="transection-table">
                <thead>
                    <tr>
                        <th>@lang('User')</th>
                        <th>@lang('Trx')</th>
                        <th>@lang('Transacted')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Post Balance')</th>
                        <th>@lang('Detail')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                    <tr>
                        <td class="usr-type" data-label="@lang('User')">
                            @if ($trx->user)
                                {{ $trx->user->fullname }}
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>

                        <td data-label="@lang('Trx')">
                            <strong>{{ $trx->trx }}</strong>
                        </td>

                        <td data-label="@lang('Transacted')">
                            {{ showDateTime($trx->created_at) }}
                        </td>

                        <td data-label="@lang('Amount')" class="budget">
                            <span class="font-weight-bold @if($trx->trx_type == '+')text--success @else text--danger @endif">
                                {{ $trx->trx_type }} {{showAmount($trx->amount)}}
                            </span>
                        </td>

                        <td data-label="@lang('Post Balance')" class="budget">
                           {{ showAmount($trx->post_balance) }}
                       </td>


                        <td data-label="@lang('Detail')">{{ __($trx->details) }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">@lang('Transaction not found')</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endif
