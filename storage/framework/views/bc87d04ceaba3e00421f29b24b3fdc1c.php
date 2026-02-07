<?php
	$customCaptcha = loadCustomCaptcha();
    $googleCaptcha = loadReCaptcha()
?>
<?php if($googleCaptcha): ?>
    <div class="mb-3">
        <?php echo $googleCaptcha ?>
    </div>
<?php endif; ?>
<?php if($customCaptcha): ?>
    <div class="form-group <?php echo e($custom ? 'form--group' : 'form-group'); ?>">
        <div class="mb-2">
            <?php echo $customCaptcha ?>
        </div>
        <label class="<?php echo e($custom ? 'form--label' : 'form-label'); ?>"><?php echo app('translator')->get('Captcha'); ?></label>
        <input type="text" name="captcha" class="form-control form--control" placeholder="<?php echo e($custom ? 'Enter Captcha Code' : ''); ?>" required>
    </div>
<?php endif; ?>
<?php if($googleCaptcha): ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($){
            "use strict"
            $('.verify-gcaptcha').on('submit',function(){
                var response = grecaptcha.getResponse();
                if (response.length == 0) {
                    document.getElementById('g-recaptcha-error').innerHTML = '<span class="text--danger"><?php echo app('translator')->get("Captcha field is required."); ?></span>';
                    return false;
                }
                return true;
            });

            window.verifyCaptcha = () => {
                document.getElementById('g-recaptcha-error').innerHTML = '';
            }
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/partials/captcha.blade.php ENDPATH**/ ?>