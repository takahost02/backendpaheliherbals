
<?php
    $registerContent = getContent('register.content', true);
    $privacyAndPolicyContents = getContent('policy_pages.element');
?>
<?php $__env->startSection('panel'); ?>
    <section class="account-section">
        <div class="row g-0">
            <div class="col-md-6 col-xl-7 col-lg-6">
                <div class="account-thumb">
                    <img src="<?php echo e(frontendImage('register', @$registerContent->data_values->register_image, '1100x750')); ?>" alt="thumb">
                    <div class="account-thumb-content">
                        <p class="welc"><?php echo e(__(@$registerContent->data_values->title)); ?></p>
                        <h3 class="title"><?php echo e(__(@$registerContent->data_values->heading)); ?></h3>
                        <p class="info"><?php echo e(__(@$registerContent->data_values->sub_heading)); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-5 col-lg-6">
                <div class="account-form-wrapper <?php if(!gs('registration')): ?> form-disabled <?php endif; ?>">
                    <?php if(!gs('registration')): ?>
                        <span class="form-disabled-text">
                            <svg class="" style="enable-background:new 0 0 512 512" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0" viewBox="0 0 512 512"
                                xml:space="preserve">
                                <g>
                                    <path class="" data-original="#f99f0b"
                                        d="M255.999 0c-79.044 0-143.352 64.308-143.352 143.353v70.193c0 4.78 3.879 8.656 8.659 8.656h48.057a8.657 8.657 0 0 0 8.656-8.656v-70.193c0-42.998 34.981-77.98 77.979-77.98s77.979 34.982 77.979 77.98v70.193c0 4.78 3.88 8.656 8.661 8.656h48.057a8.657 8.657 0 0 0 8.656-8.656v-70.193C399.352 64.308 335.044 0 255.999 0zM382.04 204.89h-30.748v-61.537c0-52.544-42.748-95.292-95.291-95.292s-95.291 42.748-95.291 95.292v61.537h-30.748v-61.537c0-69.499 56.54-126.04 126.038-126.04 69.499 0 126.04 56.541 126.04 126.04v61.537z"
                                        fill="#f99f0b" opacity="1"></path>
                                    <path class="" data-original="#f99f0b"
                                        d="M410.63 204.89H101.371c-20.505 0-37.188 16.683-37.188 37.188v232.734c0 20.505 16.683 37.188 37.188 37.188H410.63c20.505 0 37.187-16.683 37.187-37.189V242.078c0-20.505-16.682-37.188-37.187-37.188zm19.875 269.921c0 10.96-8.916 19.876-19.875 19.876H101.371c-10.96 0-19.876-8.916-19.876-19.876V242.078c0-10.96 8.916-19.876 19.876-19.876H410.63c10.959 0 19.875 8.916 19.875 19.876v232.733z"
                                        fill="#f99f0b" opacity="1"></path>
                                    <path class="" data-original="#f99f0b"
                                        d="M285.11 369.781c10.113-8.521 15.998-20.978 15.998-34.365 0-24.873-20.236-45.109-45.109-45.109-24.874 0-45.11 20.236-45.11 45.109 0 13.387 5.885 25.844 16 34.367l-9.731 46.362a8.66 8.66 0 0 0 8.472 10.436h60.738a8.654 8.654 0 0 0 8.47-10.434l-9.728-46.366zm-14.259-10.961a8.658 8.658 0 0 0-3.824 9.081l8.68 41.366h-39.415l8.682-41.363a8.655 8.655 0 0 0-3.824-9.081c-8.108-5.16-12.948-13.911-12.948-23.406 0-15.327 12.469-27.796 27.797-27.796 15.327 0 27.796 12.469 27.796 27.796.002 9.497-4.838 18.246-12.944 23.403z"
                                        fill="#f99f0b" opacity="1"></path>
                                </g>
                            </svg>
                        </span>
                    <?php endif; ?>

                    <div class="logo"><a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(siteLogo()); ?>" alt="logo"></a></div>
                    <form class="account-form verify-gcaptcha disableSubmission" method="POST" action="<?php echo e(route('user.register')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <?php if($refUser == null): ?>
                                <div class="col-md-6">
                                    <div class="form--group">
                                        <label class="form--label"><?php echo app('translator')->get('Referral Username'); ?></label>
                                        <input class="referral form-control form--control" id="referenceBy" name="referBy" type="text"
                                            value="<?php echo e(old('referBy')); ?>" placeholder="<?php echo app('translator')->get('Enter referral username'); ?>" required>
                                        <div id="ref"></div>
                                        <span id="referral"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form--group">
                                        <label class="form--label"><?php echo app('translator')->get('Position'); ?></label>
                                        <select class="position form--control form-select select2" id="position" name="position" required
                                            data-minimum-results-for-search="-1">
                                            <option value="" selected disabled><?php echo app('translator')->get('Select position'); ?></option>
                                            <?php $__currentLoopData = mlmPositions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>"><?php echo app('translator')->get($v); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span id="position-test"><span class="text--danger"></span></span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="col-md-6">
                                    <div class="form--group">
                                        <label class="form--label"><?php echo app('translator')->get('Referral Username'); ?></label>
                                        <input class="referral form-control form--control"value="<?php echo e($refUser->username); ?>" id="ref_name" name="referBy"
                                            type="text" placeholder="<?php echo app('translator')->get('Enter referral username'); ?>*" required readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form--group">
                                        <label class="form--label"><?php echo app('translator')->get('Position'); ?></label>
                                        <select class="position form--control form-select" id="position" required>
                                            <option value="" selected hidden><?php echo app('translator')->get('Select position'); ?></option>
                                            <?php $__currentLoopData = mlmPositions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php if($position == $k): ?> selected <?php endif; ?>><?php echo app('translator')->get($v); ?>
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <input name="position" type="hidden" value="<?php echo e($position); ?>">
                                        <?php echo $joining; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form--group">
                                    <label class="form--label"><?php echo app('translator')->get('First Name'); ?></label>
                                    <input class="form-control form--control" name="firstname" type="text" value="<?php echo e(old('firstname')); ?>" required
                                        placeholder="Enter Your First Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form--group">
                                    <label class="form--label"><?php echo app('translator')->get('Last Name'); ?></label>
                                    <input class="form-control form--control" name="lastname" type="text" value="<?php echo e(old('lastname')); ?>" required
                                        placeholder="Enter Your Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form--group">
                                    <label class="form--label"><?php echo app('translator')->get('Email'); ?></label>
                                    <input class="form-control form--control checkUser" name="email" type="email" required
                                        placeholder="Enter Your Email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form--group hover-input-popup">
                                    <label class="form--label"><?php echo app('translator')->get('Password'); ?></label>
                                    <input class="form-control form--control <?php if(gs('secure_password')): ?> secure-password <?php endif; ?>" name="password"
                                        type="password" required placeholder="Enter Password">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form--group">
                                    <label class="form--label"><?php echo app('translator')->get('Re-Password'); ?></label>
                                    <input class="form-control form--control" name="password_confirmation" type="password" required
                                        placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>

                        <?php
                            $custom = true;
                        ?>
                        <?php if (isset($component)) { $__componentOriginalff0a9fdc5428085522b49c68070c11d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff0a9fdc5428085522b49c68070c11d6 = $attributes; } ?>
<?php $component = App\View\Components\Captcha::resolve(['custom' => $custom] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Captcha::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $attributes = $__attributesOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $component = $__componentOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__componentOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>

                        <?php if(gs('agree')): ?>
                            <?php
                                $policyPages = getContent('policy_pages.element', false, orderById: true);
                            ?>

                            <div class="form-group">
                                <input id="agree" name="agree" type="checkbox" <?php if(old('agree')): echo 'checked'; endif; ?> required>
                                <label for="agree"><?php echo app('translator')->get('I agree with'); ?></label>
                                <?php $__currentLoopData = $policyPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="text-primary" href="<?php echo e(route('policy.pages', $policy->slug)); ?>"
                                        target="_blank"><?php echo e(__($policy->data_values->title)); ?></a>
                                    <?php if(!$loop->last): ?>
                                        ,
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="form--group button-wrapper">
                            <button class="account--btn" type="submit"><?php echo app('translator')->get('Create Account'); ?></button>
                            <a class="custom--btn" href="http://paheliherbals.com/"><span><?php echo app('translator')->get('Home'); ?></span></a>
                            <a class="custom--btn" href="<?php echo e(route('user.login')); ?>"><span><?php echo app('translator')->get('Login Account'); ?></span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="shape shape3"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/08.png')); ?>" alt="shape"></div>
        <div class="shape shape4"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/waves.png')); ?>" alt="shape"></div>
    </section>
    <!-- Account Section Ends Here -->

    <div class="modal fade" id="existModalCenter" role="dialog" aria-bs-labelledby="existModalCenterTitle" aria-bs-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle"><?php echo app('translator')->get('You are with us'); ?></h5>
                    <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center"><?php echo app('translator')->get('You already have an account please Login '); ?></h6>
                </div>
                <div class="modal-footer">
                    <button class="btn--sm btn btn-dark" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('Close'); ?></button>
                    <a class="btn--sm btn btn--base" href="<?php echo e(route('user.login')); ?>"><?php echo app('translator')->get('Login'); ?></a>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php if(gs('secure_password')): ?>
    <?php $__env->startPush('script-lib'); ?>
        <script src="<?php echo e(asset('assets/global/js/secure_password.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php $__env->startPush('style'); ?>
    <style>
        .select2-container--default .select2-selection--single {
            border-left: 0;
            border-right: 0;
            border-top: 0;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            var not_select_msg = $('#position-test').html();

            $('#referenceBy').on('blur', function() {

                var username = $(this).val();
                var token = "<?php echo e(csrf_token()); ?>";
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('check.referral')); ?>",
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
                var token = "<?php echo e(csrf_token()); ?>";
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('get.user.position')); ?>",
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

            <?php if(old('position')): ?>
                $(`select[name=position]`).val('<?php echo e(old('position')); ?>');
            <?php endif; ?>

            $('.checkUser').on('focusout', function(e) {
                var url = '<?php echo e(route('user.checkUser')); ?>';
                var value = $(this).val();
                var token = '<?php echo e(csrf_token()); ?>';
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

            <?php if(!gs('registration')): ?>
                notify('warning', 'Registration is currently disabled');
            <?php endif; ?>

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .form-disabled {
            overflow: hidden;
            position: relative;
        }

        .form-disabled::after {
            content: "";
            position: absolute;
            height: 100%;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            top: 0;
            left: 0;
            backdrop-filter: blur(2px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            z-index: 99;
        }

        .form-disabled-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 991;
            font-size: 24px;
            height: auto;
            width: 100%;
            text-align: center;
            color: hsl(var(--dark-600));
            font-weight: 800;
            line-height: 1.2;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/templates/basic/user/auth/register.blade.php ENDPATH**/ ?>