@extends($activeTemplate.'layouts.master')

@section('content')

@php

 // ===============================
    // SAFE CARRY FORWARD DEFAULT
    // ===============================
    $carryForward = $carryForward ?? [
        'left'  => 0,
        'right' => 0,
    ];
/* ======================================================
   ABSOLUTE SAFE DEFAULTS (NO CONTROLLER DEPENDENCY)
====================================================== */
$bvLeft   = $bvLeft   ?? 0;
$bvRight  = $bvRight  ?? 0;

$firstHalfPair  = $firstHalfPair  ?? 0; // 12 PM
$secondHalfPair = $secondHalfPair ?? 0; // 12 AM

$pairMatch        = $pairMatch ?? ($firstHalfPair + $secondHalfPair);
$binaryCommission = $binaryCommission ?? 0;

/* DAILY CAP */
$dailyCap     = 4;
$remainingCap = max(0, $dailyCap - $pairMatch);

/* POWER LEG */
if ($bvLeft > $bvRight) {
    $powerLeg = 'left';
} elseif ($bvRight > $bvLeft) {
    $powerLeg = 'right';
} else {
    $powerLeg = 'equal';
}

/* MONTHLY PERFORMANCE */
$monthlyPairs  = $monthlyPairs  ?? 0;
$monthlyIncome = $monthlyIncome ?? 0;

/* PREDICTION */
$prediction = $prediction ?? 0;

/* COUNTDOWN */
$nowHour  = now()->hour;
$nextSlot = $nowHour < 12 ? '12:00 PM' : '12:00 AM';
$targetHr = $nowHour < 12 ? 12 : 24;

/* PAID/FREE LOG */
$log = $logs ?? null;
@endphp

<div class="row g-3">

    {{-- ACTION BAR --}}
    <div class="col-12 d-flex justify-content-between align-items-center mb-3">

    {{-- Open Binary Rules Modal --}}
    <!--<button type="button"
            class="btn btn-sm btn-outline-primary"
            data-bs-toggle="modal"
            data-bs-target="#binaryRuleModal">
        @lang('View Binary Rules')
    </button>-->

    {{-- Weekly PDF --}}
    @if(Route::has('user.binary.weekly.pdf'))
        <a href="{{ route('user.binary.weekly.pdf') }}"
           class="btn btn-sm btn-outline-success">
            📤 @lang('Weekly PDF')
        </a>
    @endif

</div>


    {{-- COUNTDOWN --}}
    <div class="col-12">
        <div class="alert alert-warning text-center">
            ⏳ <strong>@lang('Next Matching In'):</strong>
            <span id="countdownTimer">--:--:--</span><br>
            <small>@lang('Next Slot'): {{ $nextSlot }}</small>
        </div>
    </div>

    {{-- HEADER --}}
    <div class="col-12 text-center">
        <h3>@lang('My Master Matching Income')</h3>
        <h4 class="text-success">{{ number_format($binaryCommission,2) }}</h4>
        <small class="text-muted">
            @lang('Daily Cap: 4 Pairs | 12 PM (2) + 12 AM (2)')
        </small>
        <hr>
    </div>
                          
                                <!-- Current Balance Card -->
<div class="col-12">
    <div class="card shadow-sm border-0 text-center p-4">
        
        <h6 class="text-muted mb-2">@lang('Current Balance')</h6>

        <!-- Main Balance -->
        <h2 class="fw-bold text-success mb-3">
            {{ showAmount(auth()->user()->balance) }}
        </h2>
        <small class="text-muted">
        @lang('Available for withdrawal')
    </small>

       

    </div>
</div>



    {{-- REMAINING CAP --}}
    <div class="col-12">
        <div class="alert {{ $remainingCap==0?'alert-danger':'alert-info' }} text-center">
            <strong>@lang('Remaining Daily Pairs'):</strong>
            {{ $remainingCap }} / {{ $dailyCap }}
        </div>
    </div>

    {{-- PROGRESS BARS --}}
    <div class="col-md-6">
        <label>@lang('12 PM Matching')</label>
        <div class="progress" style="height:20px">
            <div class="progress-bar bg-success"
                 style="width: {{ min(100, ($firstHalfPair / 2) * 100) }}%">
                {{ $firstHalfPair }} / 2
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label>@lang('12 AM Matching')</label>
        <div class="progress" style="height:20px">
            <div class="progress-bar bg-primary"
                 style="width: {{ min(100, ($secondHalfPair / 2) * 100) }}%">
                {{ $secondHalfPair }} / 2
            </div>
        </div>
    </div>

    {{-- PAID / FREE --}}
    @foreach([
        ['Paid Left','success','la-user-check',$log->paid_left??0],
        ['Paid Right','success','la-user-check',$log->paid_right??0],
        ['Free Left','warning','la-user-clock',$log->free_left??0],
        ['Free Right','warning','la-user-clock',$log->free_right??0],
    ] as $item)
    <div class="col-md-3">
        <div class="card custom--card text-center">
            <div class="card-body">
                <div class="icon-box bg-{{ $item[1] }}"><i class="las {{ $item[2] }}"></i></div>
                <h6>@lang($item[0])</h6>
                <h4>{{ $item[3] }}</h4>
            </div>
        </div>
    </div>
    @endforeach

    {{-- BV LEFT --}}
    <div class="col-md-3">
        <div class="card custom--card text-center {{ $powerLeg=='left'?'border-success':'' }}">
            <div class="card-body">
                <div class="icon-box bg-info"><i class="las la-arrow-left"></i></div>
                <h6>@lang('Total BV Left')</h6>
                <h4>{{ number_format($bvLeft,2) }}</h4>
                @if($powerLeg=='left')
                    <span class="badge bg-success">@lang('Power Leg')</span>
                @endif
            </div>
        </div>
    </div>

    {{-- BV RIGHT --}}
    <div class="col-md-3">
        <div class="card custom--card text-center {{ $powerLeg=='right'?'border-success':'' }}">
            <div class="card-body">
                <div class="icon-box bg-info"><i class="las la-arrow-right"></i></div>
                <h6>@lang('Total BV Right')</h6>
                <h4>{{ number_format($bvRight,2) }}</h4>
                @if($powerLeg=='right')
                    <span class="badge bg-success">@lang('Power Leg')</span>
                @endif
            </div>
        </div>
    </div>
    
    <!--Carry-Forward Card (Visual)-->
    
    <div class="col-md-6">
    <div class="card custom--card text-center">
        <div class="card-body">
            <h6>@lang('Carry Forward BV')</h6>

            @if($carryForward['left'] > 0)
                <span class="badge bg-success">
                    @lang('BV Left'): {{ number_format($carryForward['left'],2) }} ||
                     @lang('BV Right : 0')
                    
                </span>
            @elseif($carryForward['right'] > 0)
                <span class="badge bg-success">
                    @lang('BV Right'): {{ number_format($carryForward['right'],2) }} ||
                    @lang('BV Left : 0')
                </span>
            @else
                <span class="badge bg-secondary">
                    @lang('No Carry Forward')
                </span>
            @endif
        </div>
    </div>
</div>


    {{-- PAIR --}}
    <div class="col-md-3">
        <div class="card custom--card text-center">
            <div class="card-body">
                <div class="icon-box bg-primary"><i class="las la-random"></i></div>
                <h6>@lang('Pair Match (Today)')</h6>
                <h4 class="pair-count" data-count="{{ $pairMatch }}">0</h4>
            </div>
        </div>
    </div>

    {{-- COMMISSION --}}
    <!--<div class="col-md-3">
        <div class="card custom--card text-center border-success">
            <div class="card-body">
                <div class="icon-box bg-success"><i class="las la-money-bill-wave"></i></div>
                <h6>@lang('Binary Commission')</h6>
                <h4 class="text-success">₹ {{ number_format($binaryCommission,2) }}</h4>
            </div>
        </div>
    </div>-->

    {{-- MONTHLY --}}
    <div class="col-md-6">
        <div class="card custom--card text-center">
            <div class="card-body">
                <h6>@lang('This Month Performance')</h6>
                <h4>{{ $monthlyPairs }} @lang('Pairs')</h4>
                <h5 class="text-success">{{ number_format($monthlyIncome,2) }}</h5>
            </div>
        </div>
    </div>

    {{-- PREDICTION --}}
   <!-- <div class="col-md-6">
        <div class="alert alert-secondary text-center mt-4">
            🧠 <strong>@lang('Estimated Tomorrow Matching'):</strong>
            {{ $prediction }} @lang('Pairs')
        </div>
    </div>-->

</div>

{{-- RULE MODAL --}}
<!--<div class="modal fade" id="binaryRuleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5>@lang('Binary Matching Rules')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">✔ 2:1 or 1:2 first match (once)</li>
                    <li class="list-group-item">✔ Then 1:1</li>
                    <li class="list-group-item">✔ 12 PM: 2 pairs</li>
                    <li class="list-group-item">✔ 12 AM: 2 pairs</li>
                    <li class="list-group-item">✔ Daily cap: 4 pairs</li>
                    <li class="list-group-item">✔ Power leg carry forward</li>
                    <li class="list-group-item">✔ Flush after 12 AM</li>
                </ul>
            </div>
        </div>
    </div>
</div>-->

@endsection

@push('script')
<script>
document.querySelectorAll('.pair-count').forEach(el=>{
    let t=parseInt(el.dataset.count||0),c=0;
    let i=setInterval(()=>{el.innerText=c++; if(c>t)clearInterval(i)},300);
});
(function(){
    let target=new Date(); target.setHours({{ $targetHr }},0,0,0);
    setInterval(()=>{
        let d=target-new Date(); if(d<=0)return;
        let h=Math.floor(d/36e5),m=Math.floor(d%36e5/6e4),s=Math.floor(d%6e4/1e3);
        document.getElementById('countdownTimer').innerText=`${h}h ${m}m ${s}s`;
    },1000);
})();
</script>
@endpush
