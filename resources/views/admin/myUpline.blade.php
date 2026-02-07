@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--lg table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('ID')</th>
                                    <th>@lang('Ref By')</th>
                                    <th>@lang('Pos ID')</th>
                                    <th>@lang('Position')</th>
                                    <th>@lang('Level')</th>
                                    <th>@lang('First Name')</th>
                                    <th>@lang('Username')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->ref_by_label ?? '-' }}</td>
                                        <td>{{ $row->pos_id_label ?? '-' }}</td>
                                        <td>
                                            @if($row->position == 1)
                                                <span class="badge badge--primary">@lang('Left')</span>
                                            @elseif($row->position == 2)
                                                <span class="badge badge--success">@lang('Right')</span>
                                            @else
                                                <span class="badge badge--dark">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->level }}</td>
                                        <td>{{ $row->firstname }}</td>
                                        <td>{{ $row->username }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">
                                            @lang('No team members found.')
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($logs->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($logs) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        'use strict';
        function myFunction(id) {
            var copyText = document.getElementById(id);
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            notify('success', 'Url copied successfully ' + copyText.value);
        }
    </script>
@endpush
