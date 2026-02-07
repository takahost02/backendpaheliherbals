<?php $__env->startSection('content'); ?>
    <div class="container padding-bottom padding-top">
        <div class="row justify-content-center">
            <div class="col-md-8 col-xl-6">
                <div class="card custom--card">
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('user.data.submit')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form--group">
                                        <label class="form--label"><?php echo app('translator')->get('Username'); ?></label>
                                        <input type="text" 
                                               class="form-control form--control" 
                                               name="username" 
                                               value="<?php echo e($nextUsername); ?>" 
                                               readonly>
                                        <small class="text--danger usernameExist"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form--group">
                                        <label class="form--label"><?php echo app('translator')->get('Country'); ?></label>
                                        <select name="country" class="form-control form--control select2" required>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option data-mobile_code="<?php echo e($country->dial_code); ?>" value="<?php echo e($country->country); ?>" data-code="<?php echo e($key); ?>"><?php echo e(__($country->country)); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form--group">
                                        <label class="form--label"><?php echo app('translator')->get('Mobile'); ?></label>
                                        <div class="input-group ">
                                            <span class="input-group-text mobile-code">

                                            </span>
                                            <input type="hidden" name="mobile_code">
                                            <input type="hidden" name="country_code">
                                            <input type="number" name="mobile" value="<?php echo e(old('mobile')); ?>" class="form-control form--control checkUser"
                                                required>
                                        </div>
                                        <small class="text--danger mobileExist"></small>
                                    </div>
                                </div>
                                <div class="form--group col-sm-6">
                                    <label class="form--label"><?php echo app('translator')->get('Address'); ?></label>
                                    <input type="text" class="form-control form--control" name="address" value="<?php echo e(old('address')); ?>">
                                </div>
                                <div class="form--group col-sm-6">
                                    <label class="form--label"><?php echo app('translator')->get('State'); ?></label>
                                    <input type="text" class="form-control form--control" name="state" value="<?php echo e(old('state')); ?>">
                                </div>
                                <div class="form--group col-sm-6">
                                    <label class="form--label"><?php echo app('translator')->get('Zip Code'); ?></label>
                                    <input type="text" class="form-control form--control" name="zip" value="<?php echo e(old('zip')); ?>">
                                </div>
                                <div class="form--group col-sm-6">
                                    <label class="form--label"><?php echo app('translator')->get('City'); ?></label>
                                    <input type="text" class="form-control form--control" name="city" value="<?php echo e(old('city')); ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn--base w-100">
                                <?php echo app('translator')->get('Submit'); ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/select2.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/global/js/select2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function($) {

            <?php if($mobileCode): ?>
            $(`option[data-code=<?php echo e($mobileCode); ?>]`).attr('selected','');
            <?php endif; ?>

            $('.select2').select2();

            $('select[name=country]').on('change',function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
                var value = $('[name=mobile]').val();
                var name = 'mobile';
                checkUser(value,name);
            });

            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));


            $('.checkUser').on('focusout', function(e) {
                var value = $(this).val();
                var name = $(this).attr('name')
                checkUser(value,name);
            });

            function checkUser(value,name){
                var url = '<?php echo e(route('user.checkUser')); ?>';
                var token = '<?php echo e(csrf_token()); ?>';

                if (name == 'mobile') {
                    var mobile = `${value}`;
                    var data = {
                        mobile: mobile,
                        mobile_code:$('.mobile-code').text().substr(1),
                        _token: token
                    }
                }
                if (name == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                     if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.field} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            }
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/user/user_data.blade.php ENDPATH**/ ?>