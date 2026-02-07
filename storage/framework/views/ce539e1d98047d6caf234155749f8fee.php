<?php if(!request()->routeIs(['home'])): ?>
    <?php
        $breadcrumbContent = getContent('breadcrumb.content', true);
    ?>

    <div class="inner-banner bg_img"
        style="background: url(<?php echo e(frontendImage('breadcrumb', @$breadcrumbContent->data_values->background_image)); ?>) center;">
        <div class="container">
            <div class="inner-banner-wrapper">
                <h2 class="title"><?php echo e(__($pageTitle ?? 'Dashboard')); ?></h2>

            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/layouts/breadcrumb.blade.php ENDPATH**/ ?>