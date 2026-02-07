@extends($activeTemplate.'layouts.master')

@section('content')

@php
    use Illuminate\Support\Facades\DB;

    // -----------------------------
    // SAFE DEFAULT + AUTO-FALLBACK
    // -----------------------------
    if (!isset($totalPairs)) {
        $userId = auth()->id();

        $leftBV = DB::table('bv_logs')
            ->where('user_id', $userId)
            ->where('position', 1)
            ->where('trx_type', '+')
            ->sum('amount');

        $rightBV = DB::table('bv_logs')
            ->where('user_id', $userId)
            ->where('position', 2)
            ->where('trx_type', '+')
            ->sum('amount');

        $totalPairs = (int) min($leftBV, $rightBV);
    }

    // -----------------------------
    // STATIC REWARD STRUCTURE
    // -----------------------------
    $rewardLevels = [
        [
            'pairs' => 20,
            'title' => 'Bag',
            'description' => 'High-quality travel bag for daily & office use',
            'image' => 'https://cdn-icons-png.flaticon.com/512/263/263142.png'
        ],
        [
            'pairs' => 60,
            'title' => 'Blazer + Tie',
            'description' => 'Premium formal blazer with stylish tie',
            'image' => 'https://cdn-icons-png.flaticon.com/512/892/892458.png'
        ],
        [
            'pairs' => 140,
            'title' => 'Trolley Bag',
            'description' => 'Durable travel trolley bag for long journeys',
            'image' => 'https://cdn-icons-png.flaticon.com/512/2331/2331970.png'
        ],
        [
            'pairs' => 300,
            'title' => 'Titan Watch',
            'description' => 'Branded Titan wrist watch (premium edition)',
            'image' => 'https://cdn-icons-png.flaticon.com/512/747/747310.png'
        ],
        [
            'pairs' => 600,
            'title' => 'Tablet',
            'description' => 'High-performance tablet for work & entertainment',
            'image' => 'https://cdn-icons-png.flaticon.com/512/3659/3659899.png'
        ],
    ];
@endphp

<div class="row">

    <!-- HEADER -->
    <div class="col-12 text-center mb-4">
        <h3 class="fw-bold">@lang('Pair Matching Rewards')</h3>
        <h4 class="text-primary">
            {{ $totalPairs }} @lang('Pairs Completed')
        </h4>
        <small class="text-muted">
            @lang('Complete more pairs to unlock exciting rewards')
        </small>
    </div>

    <!-- TABLE -->
    <div class="col-12">
        <div class="card custom--card shadow-sm">
            <div class="card-body p-0">

                <table class="table custom--table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>@lang('Pair')</th>
                            <th>@lang('Reward')</th>
                            <th>@lang('Picture')</th>
                            <th>@lang('Status')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($rewardLevels as $reward)
                            @php
                                $achieved = $totalPairs >= $reward['pairs'];
                                $progress = $reward['pairs'] > 0
                                    ? min(100, ($totalPairs / $reward['pairs']) * 100)
                                    : 0;
                            @endphp
                            <tr>
                                <!-- Pair -->
                                <td>
                                    <strong>{{ $reward['pairs'] }} @lang('Pairs')</strong>
                                </td>

                                <!-- Reward Info -->
                                <td>
                                    <strong>{{ $reward['title'] }}</strong><br>
                                    <small class="text-muted">
                                        {{ $reward['description'] }}
                                    </small>

                                    <!-- Progress Bar -->
                                    <div class="progress mt-2" style="height: 10px;">
                                        <div class="progress-bar {{ $achieved ? 'bg-success' : 'bg-info' }}"
                                             style="width: {{ $progress }}%">
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        {{ min($totalPairs, $reward['pairs']) }}
                                        / {{ $reward['pairs'] }} pairs
                                    </small>
                                </td>

                                <!-- Picture -->
                                <td class="text-center">
                                    <img src="{{ $reward['image'] }}"
                                         alt="{{ $reward['title'] }}"
                                         style="width:60px;height:60px;object-fit:contain;">
                                </td>

                                <!-- Status -->
                                <td class="text-center">
                                    @if($achieved)
                                        <span class="badge bg-success">
                                            Achieved
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            Pending to Achieve
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>

</div>

@endsection
