@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 mb-30">

            <div class="card b-radius--5 overflow-hidden">
                <div class="card-body p-0">
                    <div class="d-flex bg--primary align-items-center p-3">
                        <div class="avatar avatar--lg">
                            <img src="{{ getImage(getFilePath('adminProfile') . '/' . $admin->image, getFileSize('adminProfile')) }}" alt="Image">
                        </div>
                        <div class="ps-3">
                            <h4 class="text--white">{{ __($admin->name) }}</h4>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Name')
                            <span class="fw-bold">{{ __($admin->name) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="fw-bold">{{ __($admin->username) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Email')
                            <span class="fw-bold">{{ $admin->email }}</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title border-bottom mb-4 pb-2">@lang('Profile Information')</h5>

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xxl-4 col-lg-6">
                                <div class="form-group">
                                    <label>@lang('Image')</label>
                                    <x-image-uploader class="w-100" type="adminProfile" image="{{ $admin->image }}" :required=false />
                                </div>
                            </div>
                            <div class="col-xxl-8 col-lg-6">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input class="form-control" name="name" type="text" value="{{ $admin->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Email')</label>
                                    <input class="form-control" name="email" type="email" value="{{ $admin->email }}" required>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn--primary h-45 w-100" type="submit">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.password') }}"><i class="las la-key"></i>@lang('Password Setting')</a>
@endpush
@push('style')
    <style>
        .list-group-item:first-child {
            border-top-left-radius: unset;
            border-top-right-radius: unset;
        }
    </style>
@endpush