<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="notice"></div>
                <?php
                    $kyc = getContent('kyc.content', true);
                ?>
                <?php if(auth()->user()->kv == Status::KYC_UNVERIFIED && auth()->user()->kyc_rejection_reason): ?>
                    <div class="alert alert--danger" role="alert">
                        <div class="alert__icon"><i class="fas fa-file-signature"></i></div>
                        <p class="alert__message">
                            <span class="fw-bold"><?php echo app('translator')->get('KYC Documents Rejected'); ?></span><br>
                            <small>
                                <i>
                                    <?php echo e(__(@$kyc->data_values->reject)); ?>

                                    <a class="link-color text--base" data-bs-toggle="modal" data-bs-target="#kycRejectionReason"
                                        href="javascript::void(0)"><?php echo app('translator')->get('Click here'); ?></a> <?php echo app('translator')->get('to show the reason'); ?>.
                                    <a class="link-color text--base" href="<?php echo e(route('user.kyc.form')); ?>"><?php echo app('translator')->get('Click Here'); ?></a>
                                    <?php echo app('translator')->get('to Re-submit Documents'); ?>. <br>

                                    <a class="link-color text--base mt-2" href="<?php echo e(route('user.kyc.data')); ?>"><?php echo app('translator')->get('See KYC Data'); ?></a>
                                </i>
                            </small>
                        </p>
                    </div>
                <?php elseif(auth()->user()->kv == Status::KYC_UNVERIFIED): ?>
                    <div class="alert alert--info" role="alert">
                        <div class="alert__icon"><i class="fas fa-file-signature"></i></div>
                        <p class="alert__message">
                            <span class="fw-bold"><?php echo app('translator')->get('KYC Verification Required'); ?></span><br>
                            <small>
                                <i>
                                    <?php echo e(__(@$kyc->data_values->required)); ?>

                                    <a class="link-color text--base" href="<?php echo e(route('user.kyc.form')); ?>"><?php echo app('translator')->get('Click here'); ?></a>
                                    <?php echo app('translator')->get('to submit KYC information'); ?>.
                                </i>
                            </small>
                        </p>
                    </div>
                <?php elseif(auth()->user()->kv == Status::KYC_PENDING): ?>
                    <div class="alert alert--warning" role="alert">
                        <div class="alert__icon"><i class="fas fa-user-check"></i></div>
                        <p class="alert__message">
                            <span class="fw-bold"><?php echo app('translator')->get('KYC Verification Pending'); ?></span><br>
                            <small>
                                <i>
                                    <?php echo e(__(@$kyc->data_values->pending)); ?>

                                    <a class="link-color text--base" href="<?php echo e(route('user.kyc.data')); ?>"><?php echo app('translator')->get('Click here'); ?></a> <?php echo app('translator')->get('to see your submitted information'); ?>
                                </i>
                            </small>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if(gs('notice')): ?>
                    <div class="col-lg-12 col-sm-6 mt-4">
                        <div class="card notice--card custom--card">
                            <div class="card-header">
                                <h5 class="pb-2"><?php echo app('translator')->get('Notice'); ?></h5>
                            </div>
                            <div class="card-body">
                                <?php if(gs('notice')): ?>
                                    <p class="notice-text-inner"><?php echo gs('notice') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(gs('free_user_notice')): ?>
                    <div class="col-lg-12 col-sm-6 mt-4">
                        <div class="card notice--card custom--card">
                            <div class="card-header">
                                <h5 class="pb-1"><?php echo app('translator')->get('Free User Notice'); ?></h5>
                            </div>
                            <div class="card-body">
                                <?php if(gs('free_user_notice') != null): ?>
                                    <p class="notice-text-inner"> <?php echo gs('free_user_notice'); ?> </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row justify-content-center g-3">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title"><?php echo app('translator')->get('Current Balance'); ?></h6>
                                <h3 class="ammount theme-two"><?php echo e(showAmount(auth()->user()->balance)); ?></h3>
                            </div>
                            <div class="right-content">
                                <div class="icon"><i class="flaticon-wallet"></i></div>
                            </div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title"><?php echo app('translator')->get('Total income'); ?></h6>
                                <h3 class="ammount theme-two"><?php echo e(showAmount($totalIncome)); ?></h3>
                            </div>
                            <div class="right-content">
                                <div class="icon"><i class="flaticon-wallet"></i></div>
                            </div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title">
                                    <?php echo app('translator')->get('Current Plan'); ?>
                                </h6>
                                <h3 class="ammount">
                                    <?php if(auth()->user()->plan): ?>
                                        <span><?php echo e(auth()->user()->plan->name); ?></span>
                                    <?php else: ?>
                                        <span class="text--danger"><?php echo app('translator')->get('N/A'); ?></span>
                                    <?php endif; ?>
                                </h3>
                            </div>
                            <div class="right-content">
                                <div class="icon"><i class="las la-paper-plane"></i></div>
                            </div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title"><?php echo app('translator')->get('Total Deposit'); ?></h6>
                                <h3 class="ammount text--base"><?php echo e(showAmount($totalDeposit)); ?></h3>
                            </div>
                            <div class="icon"><i class="flaticon-save-money"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title"><?php echo app('translator')->get('Total Withdraw'); ?></h6>
                                <h3 class="ammount theme-one"><?php echo e(showAmount($totalWithdraw)); ?></h3>
                            </div>
                            <div class="icon"><i class="flaticon-withdraw"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title"><?php echo app('translator')->get('Complete Withdraw'); ?></h6>
                                <h3 class="ammount theme-two"><?php echo e(getAmount($completeWithdraw)); ?></h3>
                            </div>
                            <div class="right-content">
                                <div class="icon"><i class="flaticon-wallet"></i></div>
                            </div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title"><?php echo app('translator')->get('Pending Withdraw'); ?></h6>
                                <h3 class="ammount text--base"><?php echo e(getAmount($pendingWithdraw)); ?></h3>
                            </div>
                            <div class="icon"><i class="flaticon-withdrawal"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title"><?php echo app('translator')->get('Total Invest'); ?></h6>
                                <h3 class="ammount theme-one"><?php echo e(showAmount(auth()->user()->total_invest)); ?></h3>
                            </div>
                            <div class="icon"><i class="flaticon-tag-1"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title"><?php echo app('translator')->get('Total Referral Commission'); ?></h6>
                                <h3 class="ammount theme-one"><?php echo e(showAmount(auth()->user()->total_ref_com)); ?></h3>
                            </div>
                            <div class="icon"><i class="flaticon-clipboards"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title"><?php echo app('translator')->get('Total Binary Commission'); ?></h6>
                                <h3 class="ammount theme-one"><?php echo e(showAmount(auth()->user()->total_binary_com)); ?></h3>
                            </div>
                            <div class="icon"><i class="flaticon-money-bag"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="dashboard-item">
                        <div class="dashboard-item-header">
                            <div class="header-left">
                                <h6 class="title"><?php echo app('translator')->get('Total Level Commission'); ?></h6>
                                <h3 class="ammount theme-one"><?php echo e(showAmount(auth()->user()->total_level_com)); ?></h3>
                            </div>
                            <div class="icon"><i class="flaticon-money-bag"></i></div>
                        </div>
                        <div class="dashboard-item-body">
                        </div>
                    </div>
                </div>
            </div>
        <?php $__env->stopSection(); ?>

        <?php if(auth()->user()->kv == Status::KYC_UNVERIFIED && auth()->user()->kyc_rejection_reason): ?>
            <div class="modal fade" id="kycRejectionReason">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo app('translator')->get('KYC Document Rejection Reason'); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><?php echo e(auth()->user()->kyc_rejection_reason); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/templates/basic/user/dashboard.blade.php ENDPATH**/ ?>