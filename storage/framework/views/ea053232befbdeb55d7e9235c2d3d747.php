

<?php $__env->startSection('content'); ?>
<div class="container padding-top padding-bottom">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xl-6">
            <div class="card custom--card">
                <div class="card-header text-center">
                    <h5 class="mb-0"><?php echo app('translator')->get('Complete Your Profile'); ?></h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('user.data.submit')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="row">

                            
                            <div class="col-12">
                                <div class="form--group">
                                    <label class="form--label"><?php echo app('translator')->get('Username'); ?></label>
                                    <input type="text"
                                           class="form-control form--control"
                                           value="<?php echo e($nextUsername); ?>"
                                           readonly>
                                    <input type="hidden" name="username" value="<?php echo e($nextUsername); ?>">
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="form--group">
                                    <label class="form--label"><?php echo app('translator')->get('Country'); ?></label>
                                    <input type="text"
                                           class="form-control form--control"
                                           value="India"
                                           readonly>

                                    <input type="hidden" name="country" value="India">
                                    <input type="hidden" name="country_code" value="IN">
                                    <input type="hidden" name="mobile_code" value="91">
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="form--group">
                                    <label class="form--label"><?php echo app('translator')->get('Mobile'); ?></label>
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

                            
                            <div class="col-md-6">
                                <div class="form--group">
                                    <label class="form--label"><?php echo app('translator')->get('State'); ?></label>
                                    <select name="state"
                                            id="state"
                                            class="form-control form--control select2"
                                            required>
                                        <option value=""><?php echo app('translator')->get('Select State'); ?></option>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="form--group">
                                    <label class="form--label"><?php echo app('translator')->get('City'); ?></label>
                                    <select name="city"
                                            id="city"
                                            class="form-control form--control select2"
                                            required>
                                        <option value=""><?php echo app('translator')->get('Select City'); ?></option>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="col-12">
                                <div class="form--group">
                                    <label class="form--label"><?php echo app('translator')->get('Address'); ?></label>
                                    <input type="text"
                                           name="address"
                                           class="form-control form--control"
                                           placeholder="House / Street / Area"
                                           required>
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="form--group">
                                    <label class="form--label"><?php echo app('translator')->get('Zip Code'); ?></label>
                                    <input type="text"
                                           name="zip"
                                           class="form-control form--control"
                                           required>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn--base w-100 mt-3">
                            <?php echo app('translator')->get('Save & Continue'); ?>
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
<?php $__env->stopPush(); ?>


<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/user/user_data.blade.php ENDPATH**/ ?>