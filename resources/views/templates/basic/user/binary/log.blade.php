@extends($activeTemplate.'layouts.master')

@section('content')
<div class="card custom--card">
    <div class="card-body">
        <table class="table custom--table">
            <tr><th>Pair</th><td>{{ $log->pair ?? 0 }}</td></tr>
            <tr><th>Commission</th><td>{{ showAmount($log->commission ?? 0) }}</td></tr>
            <tr><th>Half</th><td>{{ $log->half ?? '-' }}</td></tr>
            <tr><th>Date</th><td>{{ $log->date ?? '-' }}</td></tr>
        </table>
    </div>
</div>
@endsection
