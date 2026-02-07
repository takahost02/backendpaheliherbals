@extends($activeTemplate.'layouts.frontend')

@section('content')
<div class="container padding-top padding-bottom">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xl-6">
            <div class="card custom--card">
                <div class="card-header text-center">
                    <h5 class="mb-0">@lang('Complete Your Profile')</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.data.submit') }}">
                        @csrf

                        <div class="row">

                            {{-- USERNAME --}}
                            <div class="col-12">
                                <div class="form--group">
                                    <label class="form--label">@lang('Username')</label>
                                    <input type="text"
                                           class="form-control form--control"
                                           value="{{ $nextUsername }}"
                                           readonly>
                                    <input type="hidden" name="username" value="{{ $nextUsername }}">
                                </div>
                            </div>

                            {{-- COUNTRY (INDIA FIXED) --}}
                            <div class="col-md-6">
                                <div class="form--group">
                                    <label class="form--label">@lang('Country')</label>
                                    <input type="text"
                                           class="form-control form--control"
                                           value="India"
                                           readonly>

                                    <input type="hidden" name="country" value="India">
                                    <input type="hidden" name="country_code" value="IN">
                                    <input type="hidden" name="mobile_code" value="91">
                                </div>
                            </div>

                            {{-- MOBILE --}}
                            <div class="col-md-6">
                                <div class="form--group">
                                    <label class="form--label">@lang('Mobile')</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+91</span>
                                        <input type="number"
                                               name="mobile"
                                               class="form-control form--control"
                                               placeholder="Enter mobile number"
                                               required>
                                    </div>
                                </div>
                            </div>

                            {{-- STATE --}}
                            <div class="col-md-6">
                                <div class="form--group">
                                    <label class="form--label">@lang('State')</label>
                                    <select name="state"
                                            id="state"
                                            class="form-control form--control select2"
                                            required>
                                        <option value="">@lang('Select State')</option>
                                    </select>
                                </div>
                            </div>

                            {{-- CITY --}}
                            <div class="col-md-6">
                                <div class="form--group">
                                    <label class="form--label">@lang('City')</label>
                                    <select name="city"
                                            id="city"
                                            class="form-control form--control select2"
                                            required>
                                        <option value="">@lang('Select City')</option>
                                    </select>
                                </div>
                            </div>

                            {{-- ADDRESS --}}
                            <div class="col-12">
                                <div class="form--group">
                                    <label class="form--label">@lang('Address')</label>
                                    <input type="text"
                                           name="address"
                                           class="form-control form--control"
                                           placeholder="House / Street / Area"
                                           required>
                                </div>
                            </div>

                            {{-- ZIP --}}
                            <div class="col-md-6">
                                <div class="form--group">
                                    <label class="form--label">@lang('Zip Code')</label>
                                    <input type="text"
                                           name="zip"
                                           class="form-control form--control"
                                           required>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn--base w-100 mt-3">
                            @lang('Save & Continue')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style-lib')
<link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
<script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush

@push('script')
<script>
"use strict";
$(document).ready(function () {

    $('.select2').select2({ width: '100%' });

    const indiaData = {
        "West Bengal": ["Kolkata","Howrah","Hooghly","South 24 Parganas","North 24 Parganas","Durgapur","Asansol","Siliguri"],
        "Maharashtra": ["Mumbai","Pune","Nagpur","Nashik"],
        "Delhi": ["New Delhi","Dwarka","Rohini"],
        "Karnataka": ["Bengaluru","Mysuru","Hubli"],
        "Tamil Nadu": ["Chennai","Coimbatore","Madurai"],
        "Uttar Pradesh": ["Lucknow","Noida","Ghaziabad","Kanpur"],
        "Gujarat": ["Ahmedabad","Surat","Vadodara"],
        "Rajasthan": ["Jaipur","Jodhpur","Udaipur"],
        "Bihar": ["Patna","Gaya","Bhagalpur"],
        "Odisha": ["Bhubaneswar","Cuttack"]
    };

    // Populate states
    $.each(indiaData, function (state) {
        $('#state').append(`<option value="${state}">${state}</option>`);
    });

    // Populate cities
    $('#state').on('change', function () {
        let state = $(this).val();
        $('#city').html('<option value="">Select City</option>');

        if (indiaData[state]) {
            indiaData[state].forEach(city => {
                $('#city').append(`<option value="${city}">${city}</option>`);
            });
        }
    });

});
</script>
@endpush

