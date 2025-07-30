@extends($activeTemplate.'layouts.master')

@section('content')
<div class="card custom--card p-0">
    <div class="card-body p-0">
        <div class="table-responsive--sm">
            <table class="custom--table table">
                <thead>
                    <tr>
                        <th>@lang('Username')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Email')</th>
                        <th>@lang('Join Date')</th>
                        <th>@lang('Commission Amount')</th>
                        <th>@lang('Commission Date')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $data)
                        <tr>
                            <td>{{ $data->username }}</td>
                            <td>{{ $data->fullname }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ showDateTime($data->created_at) }}</td>
                            <td>
                                @if($data->commission_amount)
                                    {{ showAmount($data->commission_amount) }} {{ __($general->cur_text) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($data->commission_date)
                                    {{ showDateTime($data->commission_date) }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
