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
                                <h5>@lang('Repurchase Commission Settings')</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>@lang('Level')</th>
                                                <th>@lang('Commission (%)')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $placeholders = [
                                                    1 => '10%', 2 => '5%', 3 => '3%', 4 => '2%', 5 => '1%',
                                                    6 => '1%', 7 => '1%', 8 => '1%', 9 => '1%', 10 => '1%',
                                                    11 => '1%', 12 => '1%', 13 => '1%', 14 => '1%', 15 => '1%',
                                                ];
                                                $stored = json_decode($commissions->commissions ?? '[]', true);
                                            @endphp
                                            @for ($i = 1; $i <= 15; $i++)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        <input type="number" 
                                                               name="commission[{{ $i }}]" 
                                                               class="form-control"
                                                               step="any" 
                                                               min="0"
                                                               placeholder="{{ $placeholders[$i] }}"
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
