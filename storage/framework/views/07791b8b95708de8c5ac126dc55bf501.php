<section class="user-dashboard padding-top padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="dashboard-sidebar">
                    <div class="close-dashboard d-lg-none">
                        <i class="las la-times"></i>
                    </div>
                    <div class="dashboard-user">
                        <div class="user-thumb">
                            <img  id="output" src="<?php echo e(getImage('assets/images/user/profile/'. auth()->user()->image, '350x300',true)); ?>" alt="dashboard">
                        </div>
                        <div class="user-content">
                            <span><?php echo app('translator')->get('Welcome'); ?></span>
                            <h5 class="name"><?php echo e(auth()->user()->fullname); ?></h5>
                            <h5 class="username" style="color: green;"><?php echo e(auth()->user()->username); ?></h5>
                        </div>
                    </div>
                    <ul class="user-dashboard-tab">
                        <li>
                            <a class="<?php echo e(menuActive('user.home')); ?>" href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('Dasboard'); ?></a>
                        </li>
                        <li>
                            <a class="<?php echo e(menuActive('user.plan.index')); ?>" href="<?php echo e(route('user.plan.index')); ?>"> <?php echo app('translator')->get('Plan'); ?> </a>
                        </li>
                        <li>
                            <a class="<?php echo e(menuActive('user.bv.log')); ?>" href="<?php echo e(route('user.bv.log')); ?>"><?php echo app('translator')->get('BV Log'); ?> </a>
                        </li>
                        <li>
                            <a class="<?php echo e(menuActive('user.my.ref')); ?>" href="<?php echo e(route('user.my.ref')); ?>"> <?php echo app('translator')->get('My Referrals'); ?></a>
                        </li>
                        <li>
                            <a class="<?php echo e(menuActive('user.my.team')); ?>" href="<?php echo e(route('user.my.team')); ?>"> <?php echo app('translator')->get('My Team'); ?></a>
                        </li>
                        <li>
                            <a class="<?php echo e(menuActive('user.my.tree')); ?>" href="<?php echo e(route('user.my.tree')); ?>"><?php echo app('translator')->get('My Tree'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.binary.summery')); ?>" class="<?php echo e(menuActive('user.binary.summery')); ?>">
                                <?php echo app('translator')->get('Binary Summary'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.orders')); ?>" class="<?php echo e(menuActive('user.orders')); ?>">
                                <?php echo app('translator')->get('My Order'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.balance.transfer')); ?>" class="<?php echo e(menuActive('user.balance.transfer')); ?>">
                                <?php echo app('translator')->get('Balance Transfer'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.deposit.history')); ?>" class="<?php echo e(menuActive(['user.deposit*'])); ?>">
                                <?php echo app('translator')->get('Deposit History'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.withdraw.history')); ?>" class="<?php echo e(menuActive('user.withdraw*')); ?>">
                                <?php echo app('translator')->get('Withdraw History'); ?>
                            </a>
                        </li>
                       
                        <li>
                            <a href="<?php echo e(route('user.transactions')); ?>" class="<?php echo e(menuActive('user.transactions')); ?>">
                                <?php echo app('translator')->get('Transactions History'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('ticket.index')); ?>" class="<?php echo e(menuActive('ticket*')); ?>">
                                <?php echo app('translator')->get('Support Ticket'); ?>
                            </a>
                        </li>
                        
                        <li>
                            <a class="<?php echo e(menuActive('user.profile.setting')); ?>" href="<?php echo e(route('user.profile.setting')); ?>" class=""><?php echo app('translator')->get('Profile Setting'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.twofactor')); ?>" class="<?php echo e(menuActive('user.twofactor')); ?>">
                                <?php echo app('translator')->get('2FA Security'); ?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php echo e(menuActive('user.change.password')); ?>" href="<?php echo e(route('user.change.password')); ?>" class=""><?php echo app('translator')->get('Change Password'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.logout')); ?>" class=""><?php echo app('translator')->get('Sign Out'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">

                <div class="user-toggler-wrapper d-flex d-lg-none">
                    <h4 class="title"><?php echo e(__($pageTitle)); ?></h4>
                    <div class="user-toggler">
                        <i class="las la-sliders-h"></i>
                    </div>
                </div>


                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
</section><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/templates/basic/partials/dashboard.blade.php ENDPATH**/ ?>