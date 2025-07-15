@extends($activeTemplate . 'layouts.master')
@section('content')
     <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h5>@lang('Multi-Level Commission')</h5>
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
                                                $placeholders = [
                                                    1 => '20%', 2 => '10%', 3 => '5%', 4 => '3%', 5 => '2%',
                                                    6 => '1%', 7 => '1%', 8 => '1%', 9 => '1%', 10 => '1%',
                                                    11 => '1%', 12 => '1%', 13 => '1%', 14 => '1%', 15 => '1%',
                                                ];
                                                $stored = json_decode($commissions->commissions ?? '[]', true);
                                            @endphp
                                            @for ($i = 1; $i <= 15; $i++)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        <input type="number" name="commission[{{ $i }}]" class="form-control"
                                                               step="any" min="0"
                                                               placeholder="{{ $placeholders[$i] }}"
                                                               value="{{ old('commission.' . $i, $stored[$i] ?? '') }}" required>
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


