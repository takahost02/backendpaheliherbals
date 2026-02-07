@extends('admin.layouts.app')

@section('content')

<div class="container">
    <h4 class="mb-4">{{ $pageTitle }}</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kycs as $kyc)
                        <tr>
                            <td>{{ $kyc->user->name ?? 'N/A' }}</td>
                            <td>{{ $kyc->user->email ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-warning">Pending</span>
                            </td>
                            <td>{{ $kyc->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.kyc.show', $kyc->id) }}"
                                   class="btn btn-sm btn-primary">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No pending KYC found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $kycs->links() }}
        </div>
    </div>
</div>

@endsection
