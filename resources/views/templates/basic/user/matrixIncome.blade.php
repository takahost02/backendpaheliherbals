@extends($activeTemplate.'layouts.master')

@section('content')

@php
    // Safe defaults
    $teamSize = $teamSize ?? 0;

    // Level rules
    $levels = [
        1 => ['team' => 5,    'income' => 50],
        2 => ['team' => 30,   'income' => 125],
        3 => ['team' => 155,  'income' => 625],
        4 => ['team' => 780,  'income' => 3125],
        5 => ['team' => 3905, 'income' => 15625],
    ];

    // Detect highest achieved level
    $achievement = null;
    foreach ($levels as $level => $data) {
        if ($teamSize >= $data['team']) {
            $achievement = [
                'level' => $level,
                'team'  => $data['team'],
                'income'=> $data['income'],
            ];
        }
    }
@endphp

<div class="row justify-content-center">
    <div class="col-lg-6">

        <!-- Team Size Card -->
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted mb-1">Your Team Size</h6>
                <h2 class="fw-bold">{{ $teamSize }}</h2>
            </div>
        </div>

        <!-- Matrix Progress -->
        <div class="card custom--card mt-4">
            <div class="card-header">
                <h5>@lang('Matrix Progress')</h5>
            </div>

            <div class="card-body">
                @foreach($levels as $level => $data)
                    @php
                        $percent  = min(100, ($teamSize / $data['team']) * 100);
                        $achieved = $teamSize >= $data['team'];
                    @endphp

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <strong>Level {{ $level }}</strong>
                            <span>
                                {{ min($teamSize, $data['team']) }} / {{ $data['team'] }}
                            </span>
                        </div>

                        <div class="progress" style="height:18px">
                            <div class="progress-bar {{ $achieved ? 'bg-success' : 'bg-info' }}"
                                 style="width: {{ $percent }}%">
                                {{ $achieved ? 'Achieved' : round($percent).'%' }}
                            </div>
                        </div>

                        <small class="text-muted">
                            Income: ₹{{ number_format($data['income']) }}
                        </small>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Achievement Card -->
        @if($achievement)
            <div class="card border-success shadow-lg mt-4">
                <div class="card-body text-center p-4">

                    <h3 class="fw-bold text-success mb-2">
                        🎉 Congratulations!
                    </h3>

                    <p class="fs-5 mb-3">
                        You’ve successfully reached 
                        <strong class="text-primary">
                            Level {{ $achievement['level'] }}
                        </strong>
                    </p>

                    <hr class="my-3">

                    <div class="d-flex justify-content-center gap-4 mb-2">
                        <div>
                            <div class="text-muted small">Team Size</div>
                            <div class="fw-bold">
                                {{ $achievement['team'] }}
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small">Income</div>
                            <div class="fw-bold text-success fs-5">
                                ₹{{ number_format($achievement['income']) }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <div class="card border-warning shadow-sm mt-4">
                <div class="card-body text-center">
                    <h5 class="fw-bold text-warning mb-2">
                        🚀 Keep Going!
                    </h5>
                    <p>
                        Add <strong>{{ max(0, $levels[1]['team'] - $teamSize) }}</strong> more members
                        to achieve <strong>Level 1</strong>.
                    </p>
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
