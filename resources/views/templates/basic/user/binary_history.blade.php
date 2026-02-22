@extends($activeTemplate . 'layouts.master')

@section('content')

@php
    $filter = $filter ?? 'today';
    $totalIncome = $totalIncome ?? 0;
@endphp

<div class="card custom--card">

    {{-- HEADER --}}
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Master Matching Income History</h5>
    </div>

    {{-- SUMMARY + FILTER --}}
    <div class="card-body border-bottom">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">

            {{-- Total Income --}}
            <div class="mb-3 mb-md-0">
                <h6 class="mb-0">
                    Total Income:
                    <span class="text-success fw-bold">
                        {{ showAmount($totalIncome) }}
                    </span>
                </h6>
            </div>

            {{-- Filters --}}
            <div class="btn-group">
                <a href="?filter=today"
                   class="btn btn-sm {{ $filter == 'today' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Today
                </a>

                <a href="?filter=week"
                   class="btn btn-sm {{ $filter == 'week' ? 'btn-primary' : 'btn-outline-primary' }}">
                    This Week
                </a>

                <a href="?filter=month"
                   class="btn btn-sm {{ $filter == 'month' ? 'btn-primary' : 'btn-outline-primary' }}">
                    This Month
                </a>
            </div>

        </div>
    </div>

    {{-- TABLE --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table custom--table mb-0">
                <thead>
                    <tr>
                        <th>TRX ID</th>
                        <th>Details</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Post Balance</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transactions as $trx)

                        <tr>
                            {{-- TRX --}}
                            <td>
                                <strong class="text-primary">
                                    {{ $trx->trx }}
                                </strong>
                            </td>

                            {{-- Details (Full DB Details) --}}
                            <td style="max-width:300px;">
                                {{ $trx->details }}
                            </td>

                            {{-- Date --}}
                            <td>
                                {{ showDateTime($trx->created_at) }}
                                <br>
                                <small class="text-muted">
                                    {{ diffForHumans($trx->created_at) }}
                                </small>
                            </td>

                            {{-- Amount --}}
                            <td>
                                <span class="{{ $trx->trx_type == '+' ? 'text-success' : 'text-danger' }} fw-bold">
                                    {{ $trx->trx_type }} {{ showAmount($trx->amount) }}
                                </span>
                            </td>

                            {{-- Post Balance --}}
                            <td>
                                {{ showAmount($trx->post_balance) }}
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                No Master Matching Income Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

{{-- Pagination --}}
@if(isset($transactions) && $transactions->hasPages())
    <div class="mt-4">
        {{ $transactions->appends(['filter' => $filter])->links() }}
    </div>
@endif

@endsection