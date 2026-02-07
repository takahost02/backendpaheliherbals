@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h5>@lang('Multi-Level Commission Settings')</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>@lang('Rank')</th>
                                                <th>@lang('Commission (%)')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $stored = json_decode($commissions->commissions ?? '[]', true);
                                            @endphp
                                            @for ($i = 2; $i <= 16; $i++) {{-- start loop from 2 --}}
                                                <tr>
                                                    {{-- Show label starting from 1 now --}}
                                                    <td>{{ $i - 1 }}</td>
                                                    <td>
                                                        <input type="number" 
                                                               name="commission[{{ $i }}]" 
                                                               class="form-control"
                                                               step="any" 
                                                               min="0"
                                                               value="{{ old('commission.' . $i, $stored[$i] ?? '') }}"
                                                               required>
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn--primary">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
