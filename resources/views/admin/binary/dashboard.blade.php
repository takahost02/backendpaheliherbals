@extends('admin.layouts.app')

@section('panel')
<div class="row">

<div class="col-md-3">
<div class="card"><div class="card-body">
<h6>Today Pair</h6>
<h3>{{ $today_pair }}</h3>
</div></div>
</div>

<div class="col-md-3">
<div class="card"><div class="card-body">
<h6>Today Commission</h6>
<h3>{{ showAmount($today_commission) }}</h3>
</div></div>
</div>

<div class="col-md-3">
<div class="card"><div class="card-body">
<h6>12 PM Pairs</h6>
<h3>{{ $first_half }}</h3>
</div></div>
</div>

<div class="col-md-3">
<div class="card"><div class="card-body">
<h6>12 AM Pairs</h6>
<h3>{{ $second_half }}</h3>
</div></div>
</div>

</div>
@endsection
