@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="container">
        <div class="card custom--card">
            <div class="card-header">
                <h5 class="card-title">@lang('Withdraw Via') {{ $withdraw->method->name }}</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-primary">
                                <p class="mb-0">
                <i class="las la-info-circle"></i> 
                @lang('You are requesting to withdraw') 
                <b>{{ showAmount($withdraw->amount) }} {{ $withdraw->currency }}</b>.<br>
                @lang('Processing Fee:') 
                <b>{{ showAmount($withdraw->charge) }} {{ $withdraw->currency }}</b><br>
                @lang('You will receive:') 
                <b class="text--success">{{ showAmount($withdraw->after_charge) }} {{ $withdraw->currency }}</b>
            </p>

                </div>
                <form action="{{route('user.withdraw.submit')}}" class="disableSubmission" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        @php
                            echo $withdraw->method->description;
                        @endphp
                    </div>
                    <x-viser-form identifier="id" identifierValue="{{ $withdraw->method->form_id }}" />
                    @if(auth()->user()->ts)
                    <div class="form-group">
                        <label>@lang('Google Authenticator Code')</label>
                        <input type="text" name="authenticator_code" class="form-control form--control" required>
                    </div>
                    @endif
                    <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
