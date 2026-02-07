@extends($activeTemplate.'layouts.master')

@section('content')
<div class="card custom--card text-center">
    <div class="card-body">
        <h4>@lang('Retail Profits Income')</h4>
        <h2 class="text-success mt-3">{{ showAmount($income) }}</h2>
        <p class="text-muted mt-2">Profit earned from retail product sales.</p>
    </div>
</div>
@endsection
