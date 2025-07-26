<?php
    $sideBarLinks = json_decode($sidenav);
?>

<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar__main-logo"><img src="<?php echo e(siteLogo('dark')); ?>" alt="image"></a>
        </div>
        <div class="sidebar__menu-wrapper">
            <ul class="sidebar__menu">
                <?php $__currentLoopData = $sideBarLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(@$data->header): ?>
                        <li class="sidebar__menu-header"><?php echo e(__($data->header)); ?></li>
                    <?php endif; ?>
                    <?php if(@$data->submenu): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="<?php echo e(menuActive(@$data->menu_active, 3)); ?>">
                                <i class="menu-icon <?php echo e(@$data->icon); ?>"></i>
                                <span class="menu-title"><?php echo e(__(@$data->title)); ?></span>
                                <?php $__currentLoopData = @$data->counters ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($$counter > 0): ?>
                                        <span class="menu-badge menu-badge-level-one bg--warning ms-auto">
                                            <i class="fas fa-exclamation"></i>
                                        </span>
                                        <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </a>
                            <div class="sidebar-submenu <?php echo e(menuActive(@$data->menu_active, 2)); ?> ">
                                <ul>
                                    <?php $__currentLoopData = $data->submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $submenuParams = null;
                                        if (@$menu->params) {
                                            foreach ($menu->params as $submenuParamVal) {
                                                $submenuParams[] = array_values((array)$submenuParamVal)[0];
                                            }
                                        }
                                    ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive(@$menu->menu_active)); ?> ">
                                            <a href="<?php echo e(route(@$menu->route_name,$submenuParams)); ?>" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo e(__($menu->title)); ?></span>
                                                <?php $counter = @$menu->counter; ?>
                                                <?php if(@$$counter): ?>
                                                    <span class="menu-badge bg--info ms-auto"><?php echo e(@$$counter); ?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </li>
                    <?php else: ?>
                        <?php
                            $mainParams = null;
                            if (@$data->params) {
                                foreach ($data->params as $paramVal) {
                                    $mainParams[] = array_values((array)$paramVal)[0];
                                }
                            }
                        ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive(@$data->menu_active)); ?>">
                            <a href="<?php echo e(route(@$data->route_name,$mainParams)); ?>" class="nav-link ">
                                <i class="menu-icon <?php echo e($data->icon); ?>"></i>
                                <span class="menu-title"><?php echo e(__(@$data->title)); ?></span>
                                <?php $counter = @$data->counter; ?>
                                <?php if(@$$counter): ?>
                                    <span class="menu-badge bg--info ms-auto"><?php echo e(@$$counter); ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <!--<div class="version-info text-center text-uppercase">-->
        <!--    <span class="text--primary"><?php echo e(__(systemDetails()['name'])); ?></span>-->
        <!--    <span class="text--success"><?php echo app('translator')->get('V'); ?><?php echo e(systemDetails()['version']); ?> </span>-->
        <!--</div>-->
    </div>
</div>
<!-- sidebar end -->

<?php $__env->startPush('script'); ?>
    <script>
        if($('li').hasClass('active')){
            $('.sidebar__menu-wrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            },500);
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/admin/partials/sidenav.blade.php ENDPATH**/ ?>