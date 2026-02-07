<?php $__env->startSection('panel'); ?>
    <?php $__env->startPush('topBar'); ?>
        <?php echo $__env->make('admin.notification.top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->stopPush(); ?>
    <div class="row">
        <?php echo $__env->make('admin.notification.global_template_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin.notification.global_shortcodes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-body">
                    <form action="<?php echo e(route('admin.setting.notification.global.email.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Email Sent From - Name'); ?> </label>
                                    <input type="text" class="form-control " placeholder="<?php echo app('translator')->get('Email address'); ?>" name="email_from_name" value="<?php echo e(gs('email_from_name')); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Email Sent From - Email'); ?> </label>
                                    <input type="text" class="form-control " placeholder="<?php echo app('translator')->get('Email address'); ?>" name="email_from" value="<?php echo e(gs('email_from')); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Email Body'); ?> </label>
                                    <textarea name="email_template" rows="10" class="form-control emailTemplateEditor" id="htmlInput" placeholder="<?php echo app('translator')->get('Your email template'); ?>"><?php echo e(gs('email_template')); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="previewContainer">
                                    <label>&nbsp;</label>
                                    <iframe id="iframePreview"></iframe>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn w-100 btn--primary h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </form>
                </div>
            </div><!-- card end -->
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        #iframePreview {
            width: 100%;
            height: 400px;
            border: none;
        }

        .emailTemplateEditor {
            height: 400px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        var iframe = document.getElementById('iframePreview');
        $(".emailTemplateEditor").on('input', function() {
            var htmlContent = document.getElementById('htmlInput').value;
            iframe.src = 'data:text/html;charset=utf-8,' + encodeURIComponent(htmlContent);
        }).trigger('input');
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/notification/global_email_template.blade.php ENDPATH**/ ?>