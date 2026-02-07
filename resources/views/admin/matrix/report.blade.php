@extends('admin.layouts.app')

@section('panel')
<div class="card">
    <div class="card-body p-0">
        <table class="table table--light">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Level</th>
                    <th>Team Required</th>
                    <th>Income</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($records as $row)
                <tr>
                    <td>
                        {{ $row->username }}<br>
                        <small>{{ $row->email }}</small>
                    </td>
                    <td>Level {{ $row->level }}</td>
                    <td>{{ $row->team_required }}</td>
                    <td>₹{{ number_format($row->income) }}</td>
                    <td>
                        <span class="badge {{ $row->status ? 'bg-success':'bg-warning' }}">
                            {{ $row->status ? 'Paid':'Pending' }}
                        </span>
                    </td>
                    <td>{{ showDateTime($row->created_at) }}</td>
                    <td>
                        @if($row->status)
                            <a href="{{ route('admin.matrix.rollback',$row->id) }}"
                               class="btn btn-sm btn-danger">
                                Rollback
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{ $records->links() }}
@endsection
