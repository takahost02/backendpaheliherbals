@extends($activeTemplate.'layouts.master')

@section('content')
<div class="card custom--card">
    <div class="card-body">
        <h5 class="mb-3">@lang('Binary Income History')</h5>

        <div class="table-responsive">
            <table class="table custom--table">
                <thead>
                    <tr>
                        <th>@lang('Date')</th>
                        <th>@lang('Half')</th>
                        <th>@lang('Pairs')</th>
                        <th>@lang('Commission')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ showDateTime($log->date, 'd M Y') }}</td>
                            <td>
                                <span class="badge badge--info">
                                    {{ $log->half == 'first' ? '12 PM' : '12 AM' }}
                                </span>
                            </td>
                            <td>{{ $log->pair }}</td>
                            <td>{{ showAmount($log->commission) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                @lang('No binary income found')
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $logs->links() }}
    </div>
</div>
@endsection
