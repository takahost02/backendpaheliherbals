@extends('admin.layouts.app')

@section('panel')

<div class="row">

    {{-- HEADER --}}
    <div class="col-12 text-center mb-4">
        <h3 class="fw-bold">@lang('Rewards Income')</h3>
        <h4 class="text-success">
            ₹ {{ number_format($totalReward, 2) }}
        </h4>
        <small class="text-muted">@lang('Total Rewards Paid')</small>
    </div>

    {{-- TABLE --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table--light style--two mb-0">
                        <thead>
                            <tr>
                                <th>@lang('Date')</th>
                                <th>@lang('Reward')</th>
                                <th>@lang('Type')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rewards as $row)
                                <tr>
                                    <td>{{ showDateTime($row->created_at) }}</td>

                                    <td>
                                        <strong>{{ $row->title ?? '—' }}</strong><br>
                                        <small class="text-muted">
                                            {{ $row->description ?? '' }}
                                        </small>
                                    </td>

                                    <td>
                                        <span class="badge bg--info">
                                            {{ ucfirst($row->reward_type ?? 'reward') }}
                                        </span>
                                    </td>

                                    <td>
                                        ₹ {{ number_format($row->reward_amount, 2) }}
                                    </td>

                                    <td>
                                        @if($row->status)
                                            <span class="badge bg--success">@lang('Paid')</span>
                                        @else
                                            <span class="badge bg--warning">@lang('Pending')</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        @lang('No reward records found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="mt-3">
            {{ $rewards->links() }}
        </div>
    </div>

</div>

@endsection
