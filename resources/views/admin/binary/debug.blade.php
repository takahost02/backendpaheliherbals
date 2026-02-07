@extends('admin.layouts.app')

@section('panel')
<div class="card">
    <div class="card-body">
        <h5>Binary Debug Logs</h5>

        <table class="table table--light">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->user_id }}</td>
                        <td>{{ $log->message }}</td>
                        <td>{{ showDateTime($log->created_at) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $logs->links() }}
    </div>
</div>
@endsection
