<?php
    $sideBarLinks = json_decode($sidenav);
?>

<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn">
        <i class="las la-times"></i>
    </button>

    <div class="sidebar__inner">

        
        <div class="sidebar__logo">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar__main-logo">
                <img src="<?php echo e(siteLogo('dark')); ?>" alt="logo">
            </a>
        </div>

        
        <div class="sidebar__menu-wrapper">
            <ul class="sidebar__menu">

                
                <?php $__currentLoopData = $sideBarLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php if(!empty($data->header)): ?>
                        <li class="sidebar__menu-header">
                            <?php echo e(__($data->header)); ?>

                        </li>
                    <?php endif; ?>

                    
                    <?php if(!empty($data->submenu)): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)"
                               class="<?php echo e(menuActive($data->menu_active ?? null, 3)); ?>">
                                <i class="menu-icon <?php echo e($data->icon); ?>"></i>
                                <span class="menu-title"><?php echo e(__($data->title)); ?></span>

                                
                                <?php $__currentLoopData = $data->counters ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(isset($$counter) && $$counter > 0): ?>
                                        <span class="menu-badge bg--warning ms-auto">
                                            <i class="fas fa-exclamation"></i>
                                        </span>
                                        <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </a>

                            <div class="sidebar-submenu <?php echo e(menuActive($data->menu_active ?? null, 2)); ?>">
                                <ul>
                                    <?php $__currentLoopData = $data->submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                            $submenuParams = [];
                                            if (!empty($menu->params)) {
                                                foreach ($menu->params as $p) {
                                                    $submenuParams[] = array_values((array)$p)[0];
                                                }
                                            }
                                        ?>

                                        <?php if(Route::has($menu->route_name)): ?>
                                            <li class="sidebar-menu-item <?php echo e(menuActive($menu->menu_active ?? null)); ?>">
                                                <a href="<?php echo e(route($menu->route_name, $submenuParams)); ?>" class="nav-link">
                                                    <i class="menu-icon las la-dot-circle"></i>
                                                    <span class="menu-title"><?php echo e(__($menu->title)); ?></span>

                                                    <?php $counter = $menu->counter ?? null; ?>
                                                    <?php if(isset($$counter) && $$counter > 0): ?>
                                                        <span class="menu-badge bg--info ms-auto">
                                                            <?php echo e($$counter); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </li>

                    
                    <?php else: ?>
                        <?php
                            $mainParams = [];
                            if (!empty($data->params)) {
                                foreach ($data->params as $p) {
                                    $mainParams[] = array_values((array)$p)[0];
                                }
                            }
                        ?>

                        <?php if(Route::has($data->route_name)): ?>
                            <li class="sidebar-menu-item <?php echo e(menuActive($data->menu_active ?? null)); ?>">
                                <a href="<?php echo e(route($data->route_name, $mainParams)); ?>" class="nav-link">
                                    <i class="menu-icon <?php echo e($data->icon); ?>"></i>
                                    <span class="menu-title"><?php echo e(__($data->title)); ?></span>

                                    <?php $counter = $data->counter ?? null; ?>
                                    <?php if(isset($$counter) && $$counter > 0): ?>
                                        <span class="menu-badge bg--info ms-auto">
                                            <?php echo e($$counter); ?>

                                        </span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                

                <?php if(Route::has('admin.rewards.index')): ?>
<li class="sidebar-menu-item">
    <a href="<?php echo e(route('admin.rewards.index')); ?>">
        <i class="las la-gift"></i>
        <span><?php echo app('translator')->get('Rewards Income'); ?></span>
    </a>
</li>
<?php endif; ?>


                <?php if(Route::has('admin.matrix.index')): ?>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.matrix.index')); ?>">
                    <a href="<?php echo e(route('admin.matrix.index')); ?>">
                        <i class="las la-sitemap"></i>
                        <span><?php echo app('translator')->get('Matrix Income'); ?></span>
                    </a>
                </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</div>

<?php $__env->startPush('script'); ?>
<script>
    const activeItem = document.querySelector('.sidebar__menu .active');
    if (activeItem) {
        document.querySelector('.sidebar__menu-wrapper').scrollTop =
            activeItem.offsetTop - 250;
    }
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/partials/sidenav.blade.php ENDPATH**/ ?>