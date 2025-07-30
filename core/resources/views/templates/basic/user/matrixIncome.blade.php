@extends($activeTemplate.'layouts.master')

@section('content')
<div class="card custom--card p-0">
    <div class="card-body p-0">
        <div class="table-responsive--sm">
            <table class="table custom--table">
                <thead>
                    <tr>
                        <th>@lang('Level')</th>
                        <th>@lang('From User')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Date')</th>
                        <th>@lang('Details')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commissions as $commission)
                        <tr>
                            <td>Level {{ $commission->level }}</td>
                            <td>{{ $commission->source_username }}</td>
                            <td>{{ showAmount($commission->amount) }} {{ __($general->cur_text) }}</td>
                            <td>{{ showDateTime($commission->created_at) }}</td>
                            <td>{{ __($commission->details) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ __('No level commissions found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            @if($commissions->hasPages())
                <div class="pagination-wrapper mt-3">
                    {{ $commissions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection