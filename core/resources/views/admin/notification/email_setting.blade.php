@extends('admin.layouts.app')

@section('panel')
@push('topBar')
  @include('admin.notification.top_bar')
@endpush

@php
    $mailConfig = gs('mail_config');
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form method="POST">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label>@lang('Email Send Method')</label>
            <select name="email_method" class="select2 form-control" data-minimum-results-for-search="-1">
                <option value="php" @selected(old('email_method', $mailConfig->name ?? '') == 'php')>@lang('PHP Mail')</option>
                <option value="smtp" @selected(old('email_method', $mailConfig->name ?? '') == 'smtp')>@lang('SMTP')</option>
                <option value="sendgrid" @selected(old('email_method', $mailConfig->name ?? '') == 'sendgrid')>@lang('SendGrid API')</option>
                <option value="mailjet" @selected(old('email_method', $mailConfig->name ?? '') == 'mailjet')>@lang('Mailjet API')</option>
            </select>
        </div>

        {{-- SMTP Configuration --}}
        <div class="row mt-4 d-none configForm" id="smtp">
            <div class="col-md-12"><h6 class="mb-2">@lang('SMTP Configuration')</h6></div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>@lang('Host')</label>
                    <input type="text" class="form-control" name="smtp_host" value="{{ old('smtp_host', $mailConfig->host ?? '') }}" placeholder="e.g. smtp.googlemail.com">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>@lang('Port')</label>
                    <input type="text" class="form-control" name="smtp_port" value="{{ old('smtp_port', $mailConfig->port ?? '') }}" placeholder="@lang('Available port')">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>@lang('Encryption')</label>
                    <select class="form-control select2" name="smtp_issecure">
                        <option value="ssl" @selected(old('smtp_issecure', $mailConfig->enc ?? '') == 'ssl')>@lang('SSL')</option>
                        <option value="tls" @selected(old('smtp_issecure', $mailConfig->enc ?? '') == 'tls')>@lang('TLS')</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('Username')</label>
                    <input type="text" class="form-control" name="smtp_uname" value="{{ old('smtp_uname', $mailConfig->username ?? '') }}" placeholder="@lang('Normally your email address')">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('Password')</label>
                    <input type="text" class="form-control" name="smtp_pwd" value="{{ old('smtp_pwd', $mailConfig->password ?? '') }}" placeholder="@lang('Normally your email password')">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('Email From')</label>
                    <input type="email" class="form-control" name="smtp_emailfrom" value="{{ old('smtp_emailfrom', $mailConfig->email_from ?? '') }}" placeholder="e.g. noreply@yourdomain.com">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('Reply To')</label>
                    <input type="email" class="form-control" name="smtp_replyto" value="{{ old('smtp_replyto', $mailConfig->reply_to ?? '') }}" placeholder="e.g. support@yourdomain.com">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>@lang('SMTP Authentication')</label>
                    <select class="form-control" name="smtp_auth">
                        <option value="true" @selected(old('smtp_auth', $mailConfig->auth ?? '') == 'true')>@lang('Enable')</option>
                        <option value="false" @selected(old('smtp_auth', $mailConfig->auth ?? '') == 'false')>@lang('Disable')</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- SendGrid Configuration --}}
        <div class="row mt-4 d-none configForm" id="sendgrid">
            <div class="col-md-12"><h6 class="mb-2">@lang('SendGrid API Configuration')</h6></div>
            <div class="form-group col-md-12">
                <label>@lang('App Key')</label>
                <input type="text" class="form-control" name="appkey" value="{{ old('appkey', $mailConfig->appkey ?? '') }}" placeholder="@lang('SendGrid App Key')">
            </div>
        </div>

        {{-- Mailjet Configuration --}}
        <div class="row mt-4 d-none configForm" id="mailjet">
            <div class="col-md-12"><h6 class="mb-2">@lang('Mailjet API Configuration')</h6></div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('API Public Key')</label>
                    <input type="text" class="form-control" name="public_key" value="{{ old('public_key', $mailConfig->public_key ?? '') }}" placeholder="@lang('Mailjet API Public Key')">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('API Secret Key')</label>
                    <input type="text" class="form-control" name="secret_key" value="{{ old('secret_key', $mailConfig->secret_key ?? '') }}" placeholder="@lang('Mailjet API Secret Key')">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn--primary w-100 h-45 mt-4">@lang('Submit')</button>
    </div>
</form>


        </div>
    </div>
</div>

{{-- Test Mail Modal --}}
<div id="testMailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Test Mail Setup')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="{{ route('admin.setting.notification.email.test') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Send To')</label>
                        <input type="email" name="email" class="form-control" placeholder="@lang('Email Address')" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
    <button type="button" data-bs-toggle="modal" data-bs-target="#testMailModal" class="btn btn-sm btn-outline--primary">
        <i class="las la-paper-plane"></i> @lang('Send Test Mail')
    </button>
@endpush

@push('script')
<script>
    (function($) {
        "use strict";

        function emailMethod(method) {
            $('.configForm').addClass('d-none');
            if (method !== 'php') {
                $('#' + method).removeClass('d-none');
            }
        }

        const selectedMethod = @json(old('email_method', $mailConfig->name ?? 'php'));
        emailMethod(selectedMethod);

        $('select[name="email_method"]').on('change', function() {
            emailMethod($(this).val());
        });

    })(jQuery);
</script>
@endpush

