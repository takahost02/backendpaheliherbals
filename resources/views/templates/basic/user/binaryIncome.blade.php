@extends($activeTemplate.'layouts.master')

@section('content')
<div class="card custom--card p-0">
    <div class="card-body p-0">
        <div class="table-responsive--sm">
            <table class="table custom--table">
                <thead>
                    <tr>
                        <th>@lang('User')</th>
                        <th>@lang('TRX')</th>
                        <th>@lang('Transacted')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Details')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                        <tr>
                            <td>
                                <span class="fw-bold">
                                    {{ optional($trx->user)->fullname ?? 'User Deleted' }}
                                </span>

                                <br>
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


                            <td>
                                {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                            </td>

                            <td class="budget">
                                <span class="fw-bold @if ($trx->trx_type == '+') text--success @else text--danger @endif">
                                    {{ $trx->trx_type }} {{ showAmount($trx->amount) }}
                                </span>
                            </td>

                            <td class="budget">
                                {{ showAmount($trx->post_balance) }}
                            </td>

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
@foreach($transactions as $trx)
<tr>
    <td>{{ $trx->created_at }}</td>
    <td>{{ $trx->details }}</td>
    <td class="text-success">+ {{ showAmount($trx->amount) }}</td>
    <td>{{ showAmount($trx->post_balance) }}</td>
</tr>
@endforeach

@endsection
