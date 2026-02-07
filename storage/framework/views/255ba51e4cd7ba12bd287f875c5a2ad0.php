

<?php $__env->startSection('panel'); ?>
<?php $__env->startPush('topBar'); ?>
  <?php echo $__env->make('admin.notification.top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php
    $mailConfig = gs('mail_config');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form method="POST">
    <?php echo csrf_field(); ?>
    <div class="card-body">
        <div class="form-group">
            <label><?php echo app('translator')->get('Email Send Method'); ?></label>
            <select name="email_method" class="select2 form-control" data-minimum-results-for-search="-1">
                <option value="php" <?php if(old('email_method', $mailConfig->name ?? '') == 'php'): echo 'selected'; endif; ?>><?php echo app('translator')->get('PHP Mail'); ?></option>
                <option value="smtp" <?php if(old('email_method', $mailConfig->name ?? '') == 'smtp'): echo 'selected'; endif; ?>><?php echo app('translator')->get('SMTP'); ?></option>
                <option value="sendgrid" <?php if(old('email_method', $mailConfig->name ?? '') == 'sendgrid'): echo 'selected'; endif; ?>><?php echo app('translator')->get('SendGrid API'); ?></option>
                <option value="mailjet" <?php if(old('email_method', $mailConfig->name ?? '') == 'mailjet'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Mailjet API'); ?></option>
            </select>
        </div>

        
        <div class="row mt-4 d-none configForm" id="smtp">
            <div class="col-md-12"><h6 class="mb-2"><?php echo app('translator')->get('SMTP Configuration'); ?></h6></div>

            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo app('translator')->get('Host'); ?></label>
                    <input type="text" class="form-control" name="smtp_host" value="<?php echo e(old('smtp_host', $mailConfig->host ?? '')); ?>" placeholder="e.g. smtp.googlemail.com">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo app('translator')->get('Port'); ?></label>
                    <input type="text" class="form-control" name="smtp_port" value="<?php echo e(old('smtp_port', $mailConfig->port ?? '')); ?>" placeholder="<?php echo app('translator')->get('Available port'); ?>">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo app('translator')->get('Encryption'); ?></label>
                    <select class="form-control select2" name="smtp_issecure">
                        <option value="ssl" <?php if(old('smtp_issecure', $mailConfig->enc ?? '') == 'ssl'): echo 'selected'; endif; ?>><?php echo app('translator')->get('SSL'); ?></option>
                        <option value="tls" <?php if(old('smtp_issecure', $mailConfig->enc ?? '') == 'tls'): echo 'selected'; endif; ?>><?php echo app('translator')->get('TLS'); ?></option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo app('translator')->get('Username'); ?></label>
                    <input type="text" class="form-control" name="smtp_uname" value="<?php echo e(old('smtp_uname', $mailConfig->username ?? '')); ?>" placeholder="<?php echo app('translator')->get('Normally your email address'); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo app('translator')->get('Password'); ?></label>
                    <input type="text" class="form-control" name="smtp_pwd" value="<?php echo e(old('smtp_pwd', $mailConfig->password ?? '')); ?>" placeholder="<?php echo app('translator')->get('Normally your email password'); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo app('translator')->get('Email From'); ?></label>
                    <input type="email" class="form-control" name="smtp_emailfrom" value="<?php echo e(old('smtp_emailfrom', $mailConfig->email_from ?? '')); ?>" placeholder="e.g. noreply@yourdomain.com">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo app('translator')->get('Reply To'); ?></label>
                    <input type="email" class="form-control" name="smtp_replyto" value="<?php echo e(old('smtp_replyto', $mailConfig->reply_to ?? '')); ?>" placeholder="e.g. support@yourdomain.com">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo app('translator')->get('SMTP Authentication'); ?></label>
                    <select class="form-control" name="smtp_auth">
                        <option value="true" <?php if(old('smtp_auth', $mailConfig->auth ?? '') == 'true'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Enable'); ?></option>
                        <option value="false" <?php if(old('smtp_auth', $mailConfig->auth ?? '') == 'false'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Disable'); ?></option>
                    </select>
                </div>
            </div>
        </div>

        
        <div class="row mt-4 d-none configForm" id="sendgrid">
            <div class="col-md-12"><h6 class="mb-2"><?php echo app('translator')->get('SendGrid API Configuration'); ?></h6></div>
            <div class="form-group col-md-12">
                <label><?php echo app('translator')->get('App Key'); ?></label>
                <input type="text" class="form-control" name="appkey" value="<?php echo e(old('appkey', $mailConfig->appkey ?? '')); ?>" placeholder="<?php echo app('translator')->get('SendGrid App Key'); ?>">
            </div>
        </div>

        
        <div class="row mt-4 d-none configForm" id="mailjet">
            <div class="col-md-12"><h6 class="mb-2"><?php echo app('translator')->get('Mailjet API Configuration'); ?></h6></div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo app('translator')->get('API Public Key'); ?></label>
                    <input type="text" class="form-control" name="public_key" value="<?php echo e(old('public_key', $mailConfig->public_key ?? '')); ?>" placeholder="<?php echo app('translator')->get('Mailjet API Public Key'); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo app('translator')->get('API Secret Key'); ?></label>
                    <input type="text" class="form-control" name="secret_key" value="<?php echo e(old('secret_key', $mailConfig->secret_key ?? '')); ?>" placeholder="<?php echo app('translator')->get('Mailjet API Secret Key'); ?>">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn--primary w-100 h-45 mt-4"><?php echo app('translator')->get('Submit'); ?></button>
    </div>
</form>


        </div>
    </div>
</div>


<div id="testMailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo app('translator')->get('Test Mail Setup'); ?></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="<?php echo e(route('admin.setting.notification.email.test')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Send To'); ?></label>
                        <input type="email" name="email" class="form-control" placeholder="<?php echo app('translator')->get('Email Address'); ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <button type="button" data-bs-toggle="modal" data-bs-target="#testMailModal" class="btn btn-sm btn-outline--primary">
        <i class="las la-paper-plane"></i> <?php echo app('translator')->get('Send Test Mail'); ?>
    </button>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
    (function($) {
        "use strict";

        function emailMethod(method) {
            $('.configForm').addClass('d-none');
            if (method !== 'php') {
                $('#' + method).removeClass('d-none');
            }
        }

        const selectedMethod = <?php echo json_encode(old('email_method', $mailConfig->name ?? 'php'), 512) ?>;
        emailMethod(selectedMethod);

        $('select[name="email_method"]').on('change', function() {
            emailMethod($(this).val());
        });

    })(jQuery);
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/notification/email_setting.blade.php ENDPATH**/ ?>