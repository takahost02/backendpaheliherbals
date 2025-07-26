<div class="col-12">
    <div class="row">
        <div class="col-xxl-3 col-xl-4 col-md-4 col-sm-6">
            <a href="<?php echo e(route('admin.setting.notification.global.email')); ?>" class="notification-via mb-4 <?php echo e(menuActive('admin.setting.notification.global.email')); ?> d-block">
                <span class="active-badge"> <i class="las la-check"></i> </span>
                <div class="send-via-method">
                    <i class="las la-envelope"></i>
                    <h5><?php echo app('translator')->get('Email Template'); ?></h5>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-xl-4 col-md-4 col-sm-6">
            <a href="<?php echo e(route('admin.setting.notification.global.sms')); ?>" class="notification-via <?php echo e(menuActive('admin.setting.notification.global.sms')); ?> d-block mb-4">
                <span class="active-badge"> <i class="las la-check"></i> </span>
                <div class="send-via-method">
                    <i class="las la-mobile-alt"></i>
                    <h5><?php echo app('translator')->get('SMS Template'); ?></h5>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-xl-4 col-md-4 col-sm-12">
            <a href="<?php echo e(route('admin.setting.notification.global.push')); ?>" class="notification-via <?php echo e(menuActive('admin.setting.notification.global.push')); ?> d-block mb-4">
                <span class="active-badge"> <i class="las la-check"></i> </span>
                <div class="send-via-method">
                    <i class="las la-bell"></i>
                    <h5><?php echo app('translator')->get('Push Notification Template'); ?></h5>
                </div>
            </a>
        </div>
    </div>
</div>
<?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/admin/notification/global_template_nav.blade.php ENDPATH**/ ?>