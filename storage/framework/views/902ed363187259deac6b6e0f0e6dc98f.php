<section class="user-dashboard padding-top padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="dashboard-sidebar">
                    <div class="close-dashboard d-lg-none">
                        <i class="las la-times"></i>
                    </div>
                    <div class="dashboard-user">
                        <div class="user-thumb" style="border: 9px solid green; display: inline-block; border-radius: 50%; overflow: hidden;">
                            <img id="output" 
                                 src="<?php echo e(getImage('assets/images/user/profile/' . auth()->user()->image, '350x300', true)); ?>" 
                                 alt="dashboard" 
                                 style="display: block; width: 100%; height: auto;">
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
                        <a href="<?php echo e(route('user.my.income')); ?>"
                           class="<?php echo e(menuActive('user.my.income')); ?>">
                            <?php echo app('translator')->get('My Income'); ?>
                        </a>
                    </li>

                        <li>
                            <a class="<?php echo e(menuActive('user.plan.index')); ?>" href="<?php echo e(route('user.plan.index')); ?>"> <?php echo app('translator')->get('Plan'); ?> </a>
                        </li>
                       <!-- <li>
                            <a class="<?php echo e(menuActive('user.bv.log')); ?>" href="<?php echo e(route('user.bv.log')); ?>"><?php echo app('translator')->get('BV Log'); ?> </a>
                        </li>-->
                        <li>
                            <a class="<?php echo e(menuActive('user.my.ref')); ?>" href="<?php echo e(route('user.my.ref')); ?>"> <?php echo app('translator')->get('My Referrals'); ?></a>
                        </li>
                        
                        <li>
                            <a class="<?php echo e(menuActive('user.my.team')); ?>" href="<?php echo e(route('user.my.team')); ?>"> <?php echo app('translator')->get('My Team'); ?></a>
                        </li>
                        <li>
                            <a class="<?php echo e(menuActive('user.my.tree')); ?>" href="<?php echo e(route('user.my.tree')); ?>"><?php echo app('translator')->get('My Tree'); ?></a>
                        </li>
                        <!--<li>
                            <a href="<?php echo e(route('user.royalty.summery')); ?>"
                               class="<?php echo e(menuActive('user.royalty.summery')); ?>">
                                <?php echo app('translator')->get('Master Matching Income'); ?>
                            </a>
                        </li>-->

                        
                        
                        <li>
                            <a href="<?php echo e(route('user.binary.summery')); ?>" class="<?php echo e(menuActive('user.binary.summery')); ?>">
                                <?php echo app('translator')->get('Master Matching Income'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.binary.summeryhistory')); ?>" class="<?php echo e(menuActive('user.binary.history')); ?>">
                                <?php echo app('translator')->get('Master Matching Income History'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.summery.history')); ?>" class="<?php echo e(menuActive('user.binary.history')); ?>">
                                <?php echo app('translator')->get('Income History'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.matrix.income')); ?>" class="<?php echo e(menuActive('user.matrix.income')); ?>">
                                <?php echo app('translator')->get('Level Income'); ?>
                            </a>
                        </li>
                        <!--<li>
                            <a href="<?php echo e(route('user.binary.income')); ?>" class="<?php echo e(menuActive('user.binary.income')); ?>">
                                <?php echo app('translator')->get('Binary Income'); ?>
                            </a>
                        </li>-->
                       
                       <li>
    <a href="<?php echo e(route('user.rewards.index')); ?>">
        <i class="las la-gift"></i> <?php echo app('translator')->get('Rewards Income'); ?>
    </a>
</li>

                
                                <li>
                    <a href="<?php echo e(route('user.rank.income')); ?>"
                       class="<?php echo e(menuActive('user.rank.income')); ?>">
                        <?php echo app('translator')->get('Rank Achievement Income'); ?>
                    </a>
                </li>
                
                
                <li>
                        <a href="<?php echo e(route('user.salary.income')); ?>"
                           class="<?php echo e(menuActive('user.salary.income')); ?>">
                            <?php echo app('translator')->get('Salary Income'); ?>
                        </a>
                    </li>
                    
                     <li>
                            <a href="<?php echo e(route('user.repurchase.income')); ?>" class="<?php echo e(menuActive('user.repurchase.income')); ?>">
                                <?php echo app('translator')->get('Repurchase Income'); ?>
                            </a>
                        </li>
                          <li>
                        <a href="<?php echo e(route('user.global.matching.income')); ?>"
                           class="<?php echo e(menuActive('user.global.matching.income')); ?>">
                            <?php echo app('translator')->get('Global Matching Income'); ?>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo e(route('user.franchise.income')); ?>"
                           class="<?php echo e(menuActive('user.franchise.income')); ?>">
                            <?php echo app('translator')->get('Franchise Bonus Income'); ?>
                        </a>
                    </li>
                    
                   <!-- <li>
                        <a href="<?php echo e(route('user.retail.income')); ?>"
                           class="<?php echo e(menuActive('user.retail.income')); ?>">
                            <?php echo app('translator')->get('Retail Profits Income'); ?>
                        </a>
                    </li>-->
                    
                  



                          
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
                       
                       <!-- <li>
                            <a href="<?php echo e(route('user.transactions')); ?>" class="<?php echo e(menuActive('user.transactions')); ?>">
                                <?php echo app('translator')->get('Transactions History'); ?>
                            </a>
                        </li>-->
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
                    <a class="<?php echo e(menuActive('user.welcome.letter')); ?>"
                       href="<?php echo e(route('user.welcome.letter')); ?>">
                        <i class="las la-envelope-open-text"></i>
                        <?php echo app('translator')->get('Welcome Letter'); ?>
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
</section><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/partials/dashboard.blade.php ENDPATH**/ ?>