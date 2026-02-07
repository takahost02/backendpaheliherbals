<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label> <?php echo app('translator')->get('Site Title'); ?></label>
                                    <input class="form-control" name="site_name" type="text" value="<?php echo e(gs('site_name')); ?>" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="required"> <?php echo app('translator')->get('Timezone'); ?></label>
                                <select class="select2 form-control" name="timezone">
                                    <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$key); ?>" <?php if(@$key == $currentTimezone): echo 'selected'; endif; ?>><?php echo e(__($timezone)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Currency'); ?></label>
                                    <input class="form-control" name="cur_text" type="text" value="<?php echo e(gs('cur_text')); ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Currency Symbol'); ?></label>
                                    <input class="form-control" name="cur_sym" type="text" value="<?php echo e(gs('cur_sym')); ?>" required>
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label class="required"> <?php echo app('translator')->get('Site Base Color'); ?></label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 p-0">
                                        <input class="form-control colorPicker" type='text' value="<?php echo e(gs('base_color')); ?>">
                                    </span>
                                    <input class="form-control colorCode" name="base_color" type="text" value="<?php echo e(gs('base_color')); ?>">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="required"> <?php echo app('translator')->get('Site Secondary Color'); ?></label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 p-0">
                                        <input class="form-control colorPicker" type='text' value="<?php echo e(gs('secondary_color')); ?>">
                                    </span>
                                    <input class="form-control colorCode" name="secondary_color" type="text" value="<?php echo e(gs('secondary_color')); ?>">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label> <?php echo app('translator')->get('Record to Display Per page'); ?></label>
                                <select class="select2 form-control" name="paginate_number" data-minimum-results-for-search="-1">
                                    <option value="20" <?php if(gs('paginate_number') == 20): echo 'selected'; endif; ?>><?php echo app('translator')->get('20 items per page'); ?></option>
                                    <option value="50" <?php if(gs('paginate_number') == 50): echo 'selected'; endif; ?>><?php echo app('translator')->get('50 items per page'); ?></option>
                                    <option value="100" <?php if(gs('paginate_number') == 100): echo 'selected'; endif; ?>><?php echo app('translator')->get('100 items per page'); ?></option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label class="required"> <?php echo app('translator')->get('Currency Showing Format'); ?></label>
                                <select class="select2 form-control" name="currency_format" data-minimum-results-for-search="-1">
                                    <option value="1" <?php if(gs('currency_format') == Status::CUR_BOTH): echo 'selected'; endif; ?>><?php echo app('translator')->get('Show Currency Text and Symbol Both'); ?></option>
                                    <option value="2" <?php if(gs('currency_format') == Status::CUR_TEXT): echo 'selected'; endif; ?>><?php echo app('translator')->get('Show Currency Text Only'); ?></option>
                                    <option value="3" <?php if(gs('currency_format') == Status::CUR_SYM): echo 'selected'; endif; ?>><?php echo app('translator')->get('Show Currency Symbol Only'); ?></option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label> <?php echo app('translator')->get('Balance Transfer Fixed Charge'); ?></label>
                                <div class="input-group">
                                    <input class="form-control" name="bal_trans_fixed_charge" type="number"
                                        value="<?php echo e(getAmount(gs('bal_trans_fixed_charge'))); ?>" step="any">
                                    <span class="input-group-text"><?php echo e(gs('cur_text')); ?></span>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label> <?php echo app('translator')->get('Balance Transfer Perchance Charge '); ?></label>
                                <div class="input-group">
                                    <input class="form-control" type="number" step="any" name="bal_trans_per_charge"
                                        value="<?php echo e(getAmount(gs('bal_trans_per_charge'))); ?>">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                        </div>

                        <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?></button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0"><?php echo app('translator')->get('Matching Bonus'); ?></h4>
                </div>
                <form action="<?php echo e(route('admin.users.matching-bonus.update')); ?>" method="post">
                    <div class="card-body">
                        <?php echo csrf_field(); ?>
                        <div class="row justify-content-between">
                            

                            <div class="col-md-4 form-group">
                                <div class="input-group">
                                    <input class="form-control" id="#" name="total_bv" type="number" value="<?php echo e(getAmount(gs('total_bv'))); ?>"
                                        aria-describedby="#" required="">
                                    <span class="input-group-text" id="#"><?php echo app('translator')->get('BV'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <h2 class="text-center">=</h2>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="input-group">
                                    <input class="form-control" name="bv_price" type="number" value="<?php echo e(getAmount(gs('bv_price'))); ?>"
                                        aria-describedby="#" step="any" required="">
                                    <span class="input-group-text" id="#"><?php echo e(gs('cur_text')); ?></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo app('translator')->get('MAX'); ?></span>
                                    <input class="form-control" name="max_bv" type="number" value="<?php echo e(getAmount(gs('max_bv'))); ?>"
                                        aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text"><?php echo app('translator')->get('BV'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <div class="input-group">
                                    <input class="form-control" id="royalty_bonus_percentage" name="royalty_bonus_percentage" type="number" step="0.01" value="<?php echo e(getAmount(gs('royalty_bonus_percentage'))); ?>" 
                                        aria-describedby="royalty_bonus" required>
                                    <span class="input-group-text" id="royalty_bonus"><?php echo app('translator')->get('Royalty %'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label><?php echo app('translator')->get('Carry / Flush'); ?></label>
                                <select class="form-control select2" name="cary_flash" data-minimum-results-for-search="-1" required>
                                    <option value="0" <?php if(gs('cary_flash') == 0): echo 'selected'; endif; ?>><?php echo app('translator')->get('Carry (Cut Only Paid BV)'); ?></option>
                                    <option value="1" <?php if(gs('cary_flash') == 1): echo 'selected'; endif; ?>><?php echo app('translator')->get('Flush (Cut Weak Leg Value)'); ?></option>
                                    <option value="2" <?php if(gs('cary_flash') == 2): echo 'selected'; endif; ?>><?php echo app('translator')->get('Flush (Cut All BV and reset to 0)'); ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label> <?php echo app('translator')->get('Matching Bonus Time'); ?> </label>
                                <select class="form-control select2" name="matching_bonus_time" data-minimum-results-for-search="-1">
                                    <option value="daily"><?php echo app('translator')->get('Daily'); ?></option>
                                    <option value="weekly"><?php echo app('translator')->get('Weekly'); ?></option>
                                    <option value="monthly"><?php echo app('translator')->get('Monthly'); ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4" id="daily_time" style="display:none;">
                                <label><?php echo app('translator')->get('Daily Time'); ?></label>
                                <select class="form-control select2" name="daily_time" data-minimum-results-for-search="-1">
                                    <option value="1"><?php echo app('translator')->get('01:00'); ?></option>
                                    <option value="2"><?php echo app('translator')->get('02:00'); ?></option>
                                    <option value="3"><?php echo app('translator')->get('03:00'); ?></option>
                                    <option value="4"><?php echo app('translator')->get('04:00'); ?></option>
                                    <option value="5"><?php echo app('translator')->get('05:00'); ?></option>
                                    <option value="6"><?php echo app('translator')->get('06:00'); ?></option>
                                    <option value="7"><?php echo app('translator')->get('07:00'); ?></option>
                                    <option value="8"><?php echo app('translator')->get('08:00'); ?></option>
                                    <option value="9"><?php echo app('translator')->get('09:00'); ?></option>
                                    <option value="10"><?php echo app('translator')->get('10:00'); ?></option>
                                    <option value="11"><?php echo app('translator')->get('11:00'); ?></option>
                                    <option value="12"><?php echo app('translator')->get('12:00'); ?></option>
                                    <option value="13"><?php echo app('translator')->get('13:00'); ?></option>
                                    <option value="14"><?php echo app('translator')->get('14:00'); ?></option>
                                    <option value="15"><?php echo app('translator')->get('15:00'); ?></option>
                                    <option value="16"><?php echo app('translator')->get('16:00'); ?></option>
                                    <option value="17"><?php echo app('translator')->get('17:00'); ?></option>
                                    <option value="18"><?php echo app('translator')->get('18:00'); ?></option>
                                    <option value="19"><?php echo app('translator')->get('19:00'); ?></option>
                                    <option value="20"><?php echo app('translator')->get('20:00'); ?></option>
                                    <option value="21"><?php echo app('translator')->get('21:00'); ?></option>
                                    <option value="22"><?php echo app('translator')->get('22:00'); ?></option>
                                    <option value="23"><?php echo app('translator')->get('23:00'); ?></option>
                                    <option value="24"><?php echo app('translator')->get('24:00'); ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4" id="weekly_time" style="display:none;">
                                <label><?php echo app('translator')->get('Weekly Time'); ?></label>
                                <select class="form-control select2" name="weekly_time" data-minimum-results-for-search="-1">
                                    <option value="sat"><?php echo app('translator')->get('Saturday'); ?></option>
                                    <option value="sun"><?php echo app('translator')->get('Sunday'); ?></option>
                                    <option value="mon"><?php echo app('translator')->get('Monday'); ?></option>
                                    <option value="tue"><?php echo app('translator')->get('Tuesday'); ?></option>
                                    <option value="wed"><?php echo app('translator')->get('Wednesday'); ?></option>
                                    <option value="thu"><?php echo app('translator')->get('Thursday'); ?></option>
                                    <option value="fri"><?php echo app('translator')->get('Friday'); ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4" id="monthly_time" style="display:none;">
                                <label><?php echo app('translator')->get('Monthly Time'); ?></label>
                                <select class="form-control select2" name="monthly_time" data-minimum-results-for-search="-1">
                                    <option value="1"><?php echo app('translator')->get('1st day Month'); ?></option>
                                    <option value="15"><?php echo app('translator')->get('15th day of Month'); ?></option>
                                </select>
                            </div>
                        </div>

                        <button class="btn btn--primary h-45 w-100 btn-block btn-lg" type="submit"><?php echo app('translator')->get('Update'); ?></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/spectrum.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link href="<?php echo e(asset('assets/admin/css/spectrum.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";


            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function(color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function() {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });



            // matching bonus
            $("select[name=cary_flash]").val("<?php echo e(gs('cary_flash')); ?>");
            $("select[name=matching_bonus_time]").val("<?php echo e(gs('matching_bonus_time')); ?>");
            $("select[name=weekly_time]").val("<?php echo e(gs('matching_when')); ?>");
            $("select[name=monthly_time]").val("<?php echo e(gs('matching_when')); ?>");
            $("select[name=daily_time]").val("<?php echo e(gs('matching_when')); ?>");

            $('select[name=matching_bonus_time]').on('change', function() {
                matchingBonus($(this).val());
            });

            matchingBonus($('select[name=matching_bonus_time]').val());

            function matchingBonus(matching_bonus_time) {
                if (matching_bonus_time == 'daily') {
                    document.getElementById('weekly_time').style.display = 'none';
                    document.getElementById('monthly_time').style.display = 'none'
                    document.getElementById('daily_time').style.display = 'block'

                } else if (matching_bonus_time == 'weekly') {
                    document.getElementById('weekly_time').style.display = 'block';
                    document.getElementById('monthly_time').style.display = 'none'
                    document.getElementById('daily_time').style.display = 'none'
                } else if (matching_bonus_time == 'monthly') {
                    document.getElementById('weekly_time').style.display = 'none';
                    document.getElementById('monthly_time').style.display = 'block'
                    document.getElementById('daily_time').style.display = 'none'
                }
            }





        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/admin/setting/general.blade.php ENDPATH**/ ?>