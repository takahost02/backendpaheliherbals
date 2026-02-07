@extends('admin.layouts.app')

@section('panel')
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">Binary Income Report</h5>

        <div class="table-responsive">
            <table class="table table--light">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Date</th>
                        <th>Half</th>
                        <th>Pairs</th>
                        <th>Commission</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->username }}</td>
                            <td>{{ showDateTime($log->date, 'd M Y') }}</td>
                            <td>{{ $log->half == 'first' ? '12 PM' : '12 AM' }}</td>
                            <td>{{ $log->pair }}</td>
                            <td>{{ showAmount($log->commission) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $logs->links() }}
    </div>
</div>
@endsection
