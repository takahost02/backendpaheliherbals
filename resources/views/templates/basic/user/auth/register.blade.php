@extends($activeTemplate . 'layouts.app')
@php
    $registerContent = getContent('register.content', true);
    $privacyAndPolicyContents = getContent('policy_pages.element');
@endphp

@section('panel')
<section class="modern-auth-section">
    <div class="container-fluid g-0 h-100">
        <div class="row g-0 h-100 justify-content-center">
            <!-- Form Section - Centered -->
            <div class="col-12 col-lg-6 col-xl-5">
                <div class="auth-form-wrapper h-100 d-flex align-items-center justify-content-center @if (!gs('registration')) form-disabled @endif">
                    @if (!gs('registration'))
                    <div class="form-disabled-overlay w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="disabled-content text-center">
                            <i class="fas fa-lock fs-1 text-warning mb-3"></i>
                            <h4 class="text-dark">Registration Temporarily Disabled</h4>
                            <p class="text-muted">We're currently upgrading our system. Please check back later.</p>
                        </div>
                    </div>
                    @endif

                    <div class="form-content-wrapper w-100 d-flex align-items-center justify-content-center">
                        <div class="form-container w-100 px-4 px-xl-5" style="max-width: 450px;">
                            <!-- Header -->
                            <div class="text-center mb-5">
                                <a href="{{ route('home') }}" class="d-inline-block mb-4">
                                    <img src="{{ siteLogo() }}" alt="Logo" class="brand-logo">
                                </a>
                                <h2 class="auth-title">Create Your Account</h2>
                                <p class="auth-subtitle text-muted">Join our community today</p>
                            </div>

                            <form class="modern-auth-form verify-gcaptcha disableSubmission" method="POST" action="{{ route('user.register') }}">
                                @csrf
                                
                                <!-- Referral Section -->
                                <div class="referral-section mb-4">
                                    <div class="row g-3">
                                        @if ($refUser == null)
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control referral" id="referenceBy" name="referBy" 
                                                       type="text" value="{{ old('referBy') }}" 
                                                       placeholder="Referral Username" required>
                                                <label for="referenceBy" class="form-label">
                                                    <i class="fas fa-user-friends me-2"></i>Referral Username
                                                </label>
                                                <div id="ref"></div>
                                                <span id="referral"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select position" id="position" name="position" required
                                                        data-minimum-results-for-search="-1">
                                                    <option value="" selected disabled>Select position</option>
                                                    @foreach (mlmPositions() as $k => $v)
                                                        <option value="{{ $k }}">{{ __($v) }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="position" class="form-label">
                                                    <i class="fas fa-map-marker-alt me-2"></i>Position
                                                </label>
                                                <span id="position-test"><span class="text-danger"></span></span>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control referral" value="{{ $refUser->username }}" 
                                                       id="ref_name" name="referBy" type="text" required readonly>
                                                <label for="ref_name" class="form-label">
                                                    <i class="fas fa-user-friends me-2"></i>Referral Username
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select position" id="position" required>
                                                    <option value="" selected hidden>Select position</option>
                                                    @foreach (mlmPositions() as $k => $v)
                                                        <option value="{{ $k }}" @if ($position == $k) selected @endif>
                                                            {{ __($v) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input name="position" type="hidden" value="{{ $position }}">
                                                <label for="position" class="form-label">
                                                    <i class="fas fa-map-marker-alt me-2"></i>Position
                                                </label>
                                                @php echo $joining; @endphp
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Personal Information -->
                                <div class="personal-info-section mb-4">
                                    <h6 class="section-title mb-3">
                                        <i class="fas fa-user me-2"></i>Personal Information
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" name="firstname" type="text" 
                                                       value="{{ old('firstname') }}" required placeholder="First Name">
                                                <label for="firstname" class="form-label">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" name="lastname" type="text" 
                                                       value="{{ old('lastname') }}" required placeholder="Last Name">
                                                <label for="lastname" class="form-label">Last Name</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <div class="form-floating">
                                        <input class="form-control checkUser" name="email" type="email" required 
                                               placeholder="Enter Your Email">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-2"></i>Email Address
                                        </label>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="password-section mb-4">
                                    <h6 class="section-title mb-3">
                                        <i class="fas fa-lock me-2"></i>Security
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating hover-input-popup">
                                                <input class="form-control @if (gs('secure_password')) secure-password @endif" 
                                                       name="password" type="password" required placeholder="Password">
                                                <label for="password" class="form-label">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" name="password_confirmation" type="password" 
                                                       required placeholder="Confirm Password">
                                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Captcha -->
                                @php $custom = true; @endphp
                                <x-captcha :custom="$custom" />

                                <!-- Terms & Conditions -->
                                @if (gs('agree'))
                                    @php
                                        $policyPages = getContent('policy_pages.element', false, orderById: true);
                                    @endphp
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" id="agree" name="agree" type="checkbox" @checked(old('agree')) required>
                                        <label class="form-check-label small" for="agree">
                                            I agree to the 
                                            @foreach ($policyPages as $policy)
                                                <a class="text-primary text-decoration-none" href="{{ route('policy.pages', $policy->slug) }}" target="_blank">
                                                    {{ __($policy->data_values->title) }}
                                                </a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </label>
                                    </div>
                                @endif

                                <!-- Submit Button -->
                                <div class="d-grid mb-4">
                                    <button class="btn btn-primary btn-lg modern-btn" type="submit">
                                        <i class="fas fa-user-plus me-2"></i>Create Account
                                    </button>
                                </div>

                                <!-- Additional Links -->
                                <div class="auth-links text-center">
                                    <p class="mb-3">Already have an account? 
                                        <a href="{{ route('user.login') }}" class="text-primary text-decoration-none fw-semibold">
                                            Sign In
                                        </a>
                                    </p>
                                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-home me-1"></i>Back to Home
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Existing Modal -->
<div class="modal fade" id="existModalCenter" role="dialog" aria-bs-labelledby="existModalCenterTitle" aria-bs-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modern-modal">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="existModalLongTitle">
                    <i class="fas fa-info-circle me-2 text-primary"></i>Account Exists
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-user-check fs-1 text-warning mb-3"></i>
                <h6>You're Already With Us!</h6>
                <p class="text-muted mb-0">You already have an account. Please sign in to continue.</p>
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal" type="button">Close</button>
                <a class="btn btn-primary" href="{{ route('user.login') }}">Sign In</a>
            </div>
        </div>
    </div>
</div>
@endsection

@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('style')
<style>
.modern-auth-section {
    font-family: 'Inter', sans-serif;
    height: 100vh;
    background: #ffffff;
}

.container-fluid.h-100 {
    height: 100% !important;
}

.row.h-100 {
    height: 100% !important;
}

.auth-form-wrapper {
    background: #ffffff;
    position: relative;
    height: 100%;
}

.form-content-wrapper {
    height: 100%;
}

.form-container {
    max-width: 450px;
    margin: 0 auto;
}

.brand-logo {
    height: 50px;
    width: auto;
}

.auth-title {
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.auth-subtitle {
    color: #718096;
}

.form-floating {
    position: relative;
}

.form-floating > .form-control {
    height: calc(3.5rem + 2px);
    line-height: 1.25;
    padding: 1rem 0.75rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.form-floating > .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-floating > label {
    padding: 1rem 0.75rem;
    color: #a0aec0;
    transition: all 0.2s ease;
}

.section-title {
    color: #4a5568;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.modern-btn {
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    border: none;
    background: #667eea;
    transition: all 0.3s ease;
}

.modern-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    background: #5a6fd8;
}

.form-disabled-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    z-index: 1000;
}

.modern-modal .modal-content {
    border-radius: 16px;
    border: none;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
}

.auth-links {
    border-top: 1px solid #e2e8f0;
    padding-top: 1.5rem;
}

.select2-container--default .select2-selection--single {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    height: calc(3.5rem + 2px);
    display: flex;
    align-items: center;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: calc(3.5rem + 2px);
}

/* Responsive Design */
@media (max-width: 991.98px) {
    .modern-auth-section {
        background: #ffffff;
        height: auto;
        min-height: 100vh;
    }
    
    .auth-form-wrapper {
        padding: 3rem 0;
    }
    
    .form-content-wrapper {
        height: auto;
    }
}

@media (max-width: 575.98px) {
    .form-container {
        padding: 0 0.5rem;
    }
    
    .auth-title {
        font-size: 1.5rem;
    }
    
    .modern-btn {
        padding: 0.875rem 1.5rem;
    }
    
    .auth-form-wrapper {
        padding: 2rem 0;
    }
}

@media (min-width: 992px) {
    .auth-form-wrapper {
        box-shadow: 0 0 0 1px #e2e8f0;
        border-radius: 20px;
        margin: 2rem;
    }
}
</style>
@endpush

@push('script')
<script>
(function($) {
    "use strict";

    var not_select_msg = $('#position-test').html();

    $('#referenceBy').on('blur', function() {
        var username = $(this).val();
        var token = "{{ csrf_token() }}";
        $.ajax({
            type: "POST",
            url: "{{ route('check.referral') }}",
            data: {
                'username': username,
                '_token': token
            },
            success: function(data) {
                if (data.success) {
                    $('select[name=position]').attr('disabled', false);
                    $('#position-test').text('');
                } else {
                    $('select[name=position]').attr('disabled', true);
                    $('#position-test').html(not_select_msg);
                }
                $("#ref").html(data.msg);
            }
        });
    });

    $(document).on('change', '#position', function() {
        updateHand();
    });

    function updateHand() {
        var pos = $('#position').val();
        var referrer_id = $('#referrer_id').val();
        var token = "{{ csrf_token() }}";
        $.ajax({
            type: "POST",
            url: "{{ route('get.user.position') }}",
            data: {
                'referrer': referrer_id,
                'position': pos,
                '_token': token
            },
            success: function(data) {
                if (!data.success) {
                    document.getElementById("ref_name").focus()
                }
                $("#position-test").html(data.msg);
            }
        });
    }

    @if (old('position'))
        $(`select[name=position]`).val('{{ old('position') }}');
    @endif

    $('.checkUser').on('focusout', function(e) {
        var url = '{{ route('user.checkUser') }}';
        var value = $(this).val();
        var token = '{{ csrf_token() }}';
        var data = {
            email: value,
            _token: token
        }
        $.post(url, data, function(response) {
            if (response.data != false) {
                $('#existModalCenter').modal('show');
            }
        });
    });

    @if (!gs('registration'))
        console.warn('Registration is currently disabled');
    @endif

})(jQuery);
</script>
@endpush