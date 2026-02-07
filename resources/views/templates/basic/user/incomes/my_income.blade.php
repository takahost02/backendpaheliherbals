@extends($activeTemplate.'layouts.master')

@section('content')

@php
    $binaryIncome   = $income['binary']   ?? 0; // Master Matching
    $directIncome   = $income['level']    ?? 0; // Matrix Level
    $matchingBonus  = $income['rank']     ?? 0;
    $rewardIncome   = 0; // if not implemented yet
    $totalEarned    = $totalIncome ?? 0;
@endphp

<div class="container-fluid">

    <!-- Export Buttons -->
   <!-- <div class="text-end mb-3">
        <a href="{{ route('earnings.export.pdf') }}" class="btn btn-danger btn-sm">
            <i class="las la-file-pdf"></i> Export PDF
        </a>
        <a href="{{ route('earnings.export.excel') }}" class="btn btn-success btn-sm">
            <i class="las la-file-excel"></i> Export Excel
        </a>
    </div>-->

    <!-- Date Filters -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button class="btn btn-outline-primary filter-btn" data-range="today">Today</button>
        <button class="btn btn-outline-success filter-btn" data-range="7days">Last 7 Days</button>
        <button class="btn btn-outline-warning filter-btn" data-range="month">This Month</button>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12">

            <!-- Total Income -->
            <div class="card custom--card mb-4 text-center">
                <div class="card-body">
                    <h4>@lang('Total Income')</h4>
                    <h2 class="text-success fw-bold mt-2" id="totalEarned">
                        {{ showAmount($totalIncome ?? 0) }}
                    </h2>
                </div>
            </div>

            <!-- Earnings Progress -->
            <div class="card shadow-sm border-0 p-4 mb-4">
                <h5 class="mb-3">@lang('Earnings Progress')</h5>

                @php
                    $total = max($totalEarned ?? 1, 1);
                    $binaryPercent   = (($binaryIncome ?? 0) / $total) * 100;
                    $directPercent   = (($directIncome ?? 0) / $total) * 100;
                    $matchingPercent = (($matchingBonus ?? 0) / $total) * 100;
                    $rewardPercent  = (($rewardIncome ?? 0) / $total) * 100;
                @endphp

                <!-- Binary -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <small>@lang('Binary Income')</small>
                        <small>{{ number_format($binaryPercent, 1) }}%</small>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" style="width: {{ $binaryPercent }}%"></div>
                    </div>
                </div>

                <!-- Direct -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <small>@lang('Direct Referral')</small>
                        <small>{{ number_format($directPercent, 1) }}%</small>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: {{ $directPercent }}%"></div>
                    </div>
                </div>

                <!-- Matching -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <small>@lang('Matching Bonus')</small>
                        <small>{{ number_format($matchingPercent, 1) }}%</small>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" style="width: {{ $matchingPercent }}%"></div>
                    </div>
                </div>

                <!-- Rewards -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <small>@lang('Rewards')</small>
                        <small>{{ number_format($rewardPercent, 1) }}%</small>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: {{ $rewardPercent }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Current Balance -->
            <div class="card shadow-sm border-0 text-center p-4 mb-4">
                <h6 class="text-muted mb-2">@lang('Current Balance')</h6>

                <h2 class="fw-bold text-success mb-2">
                    ₹{{ showAmount(auth()->user()->balance) }}
                </h2>

                <small class="text-muted">@lang('Available for withdrawal')</small>

                <hr>

                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <div class="small text-muted">@lang('Total Earned')</div>
                        <div class="fw-semibold text-primary">
                            ₹{{ showAmount($totalEarned ?? 0) }}
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="small text-muted">@lang('Total Withdrawn')</div>
                        <div class="fw-semibold text-danger">
                            ₹{{ showAmount($totalWithdrawn ?? 0) }}
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="small text-muted">@lang('Pending Amount')</div>
                        <div class="fw-semibold text-warning">
                            ₹{{ showAmount($pendingAmount ?? 0) }}
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="small text-muted">@lang('Last Updated')</div>
                        <div class="fw-semibold">
                            {{ now()->format('d M Y, h:i A') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earn Breakdown -->
            <div class="card shadow-sm border-0 p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">@lang('Total Earn Breakdown')</h5>
                    <span class="badge bg-success">
                        {{ showAmount($totalEarned ?? 0) }}
                    </span>
                </div>

                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted">@lang('Master Maching Income')</div>
                            <h6 class="fw-bold text-primary mb-0" id="binaryIncome">
                               {{ showAmount($binaryIncome ?? 0) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted">@lang('Lavel Income')</div>
                            <h6 class="fw-bold text-success mb-0" id="directIncome">
                                {{ showAmount($directIncome ?? 0) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted">@lang('Rank Achievemt. Bonus')</div>
                            <h6 class="fw-bold text-warning mb-0" id="matchingBonus">
                                {{ showAmount($matchingBonus ?? 0) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted">@lang('Rewards / Incentives')</div>
                            <h6 class="fw-bold text-info mb-0" id="rewardIncome">
                               {{ showAmount($rewardIncome ?? 0) }}
                            </h6>
                        </div>
                    </div>
                    
                     <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted">@lang('Salary Income')</div>
                            <h6 class="fw-bold text-info mb-0" id="rewardIncome">
                                {{ showAmount($rewardIncome ?? 0) }}
                            </h6>
                        </div>
                    </div>
                    
                     <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted">@lang('Repurchase Income')</div>
                            <h6 class="fw-bold text-info mb-0" id="rewardIncome">
                                {{ showAmount($rewardIncome ?? 0) }}
                            </h6>
                        </div>
                    </div>
                    
                    
                     <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted">@lang('Global Matching Income')</div>
                            <h6 class="fw-bold text-info mb-0" id="rewardIncome">
                                {{ showAmount($rewardIncome ?? 0) }}
                            </h6>
                        </div>
                    </div>
                    
                     <div class="col-md-3 col-6">
                        <div class="border rounded p-3 text-center">
                            <div class="small text-muted">@lang('Franchise Bonuses Income')</div>
                            <h6 class="fw-bold text-info mb-0" id="rewardIncome">
                                {{ showAmount($rewardIncome ?? 0) }}
                            </h6>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Transactions Button -->
           <!-- <div class="text-end mb-4">
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#transactionsModal">
                    <i class="las la-list"></i> @lang('View Transactions')
                </button>
            </div>-->

        </div>
    </div>

    <!-- Transactions Modal -->
    <div class="modal fade" id="transactionsModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">@lang('Transaction History')</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th class="text-end">Amount (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions ?? [] as $tx)

                            <tr>
                                <td>{{ \Carbon\Carbon::parse($tx->created_at)->format('d M Y') }}</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ ucfirst($tx->type) }}
                                    </span>
                                </td>
                                <td>{{ $tx->description }}</td>
                                <td class="text-end fw-bold">
                                    ₹{{ showAmount($tx->amount) }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    @lang('No transactions found')
                                </td>
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

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {

    // Filter Buttons
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const range = this.dataset.range;

            fetch(`{{ route('earnings.filter') }}?range=${range}`)
                .then(res => res.json())
                .then(updateUI);
        });
    });

    // Auto Refresh every 10s
    setInterval(() => {
        fetch(`{{ route('earnings.filter') }}?range=current`)
            .then(res => res.json())
            .then(updateUI);
    }, 10000);

    // UI Update
    function updateUI(data) {
        document.getElementById('binaryIncome').innerText  = '₹' + data.binary;
        document.getElementById('directIncome').innerText  = '₹' + data.direct;
        document.getElementById('matchingBonus').innerText = '₹' + data.matching;
        document.getElementById('rewardIncome').innerText  = '₹' + data.reward;
        document.getElementById('totalEarned').innerText   = '₹' + data.total;
    }

});
</script>
@endsection
