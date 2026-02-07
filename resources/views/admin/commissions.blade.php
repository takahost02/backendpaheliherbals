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
                                <th>@lang('User')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Source')</th>
                                <th>@lang('Level')</th>
                                <th>@lang('Type')</th>
                                <th>@lang('Details')</th>
                                <th>@lang('Date')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($commissions as $commission)
                                <tr>
                                    <td>
                                        @if($commission->user)
                                            <span class="fw-bold">{{ $commission->user->fullname }}</span><br>
                                            <span class="small">
                                                <a href="{{ route('admin.users.detail', $commission->user_id) }}">
                                                    <span>@</span>{{ $commission->user->username }}
                                                </a>
                                            </span>
                                        @else
                                            <span class="text-danger">User not found</span>
                                        @endif
                                    </td>
                   
                                    <td>{{ showAmount($commission->amount) }}</td>
                                    <td>{{ $commission->source_username ?? '-' }}</td>
                                    <td>{{ $commission->level ?? '-' }}</td>
                                    <td>{{ ucfirst($commission->type) }}</td>
                                    <td>
                                        @php
                                            $words = explode(' ', $commission->details);
                                            $wrapped = collect($words)
                                                ->chunk(5)
                                                ->map(fn($chunk) => implode(' ', $chunk->toArray()))
                                                ->toArray();
                                        @endphp
                                        {!! implode('<br>', $wrapped) !!}
                                    </td>


                                    <td>{{ showDateTime($commission->created_at) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">
                                        {{ __($emptyMessage) }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($commissions->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($commissions) }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
@endpush
