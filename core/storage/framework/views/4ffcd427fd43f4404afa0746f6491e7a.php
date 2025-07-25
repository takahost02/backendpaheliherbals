<?php $__env->startSection('panel'); ?>
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-center">
                <div class="update-available-card-wrapper">
                    <?php if(!extension_loaded('zip') && !gs('system_customized')): ?>
                        <div class="card bl--5 border--warning mb-4">
                            <div class="card-body">
                                <p class="text--warning"><i class="las la-exclamation-triangle"></i> <?php echo app('translator')->get('PHP-zip extension is required to perform the update operation.'); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(gs('system_customized')): ?>
                        <div class="card bl--5 border--warning mb-4">
                            <div class="card-body">
                                <p class="text--warning"><i class="las la-exclamation-triangle"></i> <?php echo app('translator')->get('The system already customized. You can\'t update the project.'); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>


                    <div class="update-available-card <?php echo e(version_compare(gs('available_version'), systemDetails()['version'], '>') ? 'border--danger' : 'border--success'); ?>">
                        <div class="update-available-card-top">
                            <div class="update-available-card__item <?php echo e(version_compare(gs('available_version'), systemDetails()['version'], '==') ? 'w-100' : ''); ?>">
                                <h4 class="text--warning"><?php echo e(systemDetails()['version']); ?></h4>
                                <p class="text--warning"><?php echo app('translator')->get('Your Version'); ?></p>
                            </div>
                            <?php if(version_compare(gs('available_version'), systemDetails()['version'], '>')): ?>
                                <div class="update-available-card__item">
                                    <h4 class="text--success"><?php echo e(gs('available_version')); ?></h4>
                                    <p class="text--success"><?php echo app('translator')->get('Latest Version'); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="update-available-card-bottom">
                            <?php if(version_compare(gs('available_version'), systemDetails()['version'], '==')): ?>
                                <p><span><i class="las la-info-circle text--primary"></i></span> <span><strong><?php echo app('translator')->get('You are currently using the latest version of the system.'); ?></strong> <?php echo app('translator')->get('We are committed to continuous improvement and are actively developing the next version. Stay tuned for exciting new features and enhancements to be released soon!'); ?></span></p>
                            <?php else: ?>
                                <?php if(!gs('system_customized')): ?>
                                    <p><span><i class="las la-info-circle text--primary"></i></span> <span><?php echo app('translator')->get('A new system version has already been released that you have not grabbed yet. Don\'t miss it out. Get the latest features of the system.'); ?></span></p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(version_compare(gs('available_version'), systemDetails()['version'], '>')): ?>
                    <button class="btn btn--primary w-100 h-45 mt-4" data-bs-toggle="modal" data-bs-target="#updateModal"><?php echo app('translator')->get('Update Now'); ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Update the System'); ?></h5>
                    <button type="button" class="close disableBtn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3">

                        <div class="update-text-area text-center shouldUpdate">
                            <h4 class="text--info"><?php echo app('translator')->get('You\'re about to upgrade the system to the most recent released version'); ?></h4>
                            <h1 class="modal-version-text text--success">v<?php echo e(gs('available_version')); ?></h1>
                        </div>
                        <div class="updating-version text-center d-none systemUpdating">
                            <h4 class="text--info"><?php echo app('translator')->get('The system update is currently underway. Kindly remain on standby as the process nears completion.'); ?></h4>
                            <div class="d-flex justify-content-center py-4">
                                <div class="spinner-border text--success">
                                    <span class="visually-hidden"></span>
                                </div>
                            </div>
                        </div>
                        <div class="systemUpdated text-center d-none">
                            <h4 class="text--info mb-3"><?php echo app('translator')->get('The system has been successfully updated. It will reload shortly.'); ?></h4>
                            <div class="card-section__icon">
                                <i class="las la-check"></i>
                            </div>
                        </div>
                        <div class="alert alert-warning p-3 mb-0 mt-3 noAlert" role="alert"><?php echo app('translator')->get('Before proceeding, it is strongly advised to create a backup of the system. We highly recommend backing up both your files and database.'); ?></div>
                        <div class="alert alert-danger p-3 mb-0 mt-3 noAlert" role="alert"><?php echo app('translator')->get('Don\'t reload the page or don\'t go to another page while updating the system.'); ?></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark disableBtn" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <button type="button" class="btn btn--primary updateBtn disableBtn"><?php echo app('translator')->get('Continue'); ?></button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.system.update.log')); ?>" class="btn btn-outline--primary btn-sm"><i class="las la-list"></i> <?php echo app('translator')->get('Update Log'); ?></a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            var submitted = false;
            $('.updateBtn').on('click', function() {


                var url = '<?php echo e(route('admin.system.update.process')); ?>';
                var button = $(this);
                if (!submitted) {
                    submitted = true;

                    $('.disableBtn').attr('disabled',true);
                    $('.shouldUpdate').addClass('d-none');
                    $('.systemUpdating').removeClass('d-none');
                    $.post(url, {
                        _token: "<?php echo e(csrf_token()); ?>"
                    }, function(response) {
                        if (response.status == 'error' || response.status == 'info') {
                            $.each(response.message, function(key, value) {
                                notify(response.status, value);
                            });
                            submitted = false;
                            $('.disableBtn').removeAttr('disabled');
                            $('.shouldUpdate').removeClass('d-none');
                            $('.systemUpdating').addClass('d-none');
                        } else {
                            $.each(response.message, function(key, value) {
                                notify(response.status, value);
                            });
                            $('.systemUpdating').addClass('d-none');
                            $('.noAlert').addClass('d-none');
                            $('.systemUpdated').removeClass('d-none');

                            setTimeout(() => {
                                window.location.replace(window.location.href);
                            }, 5000);
                        }
                    });
                }


            });

        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('style'); ?>
    <style>
        .spinner-border {
            width: 100px;
            height: 100px;
        }

        .update-available-card {
            background-color: #fff;
            border-radius: 5px;
            padding: 30px;
            border: 3px solid;
        }

        .update-available-card-wrapper {
            width: 730px;
        }

        .update-available-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .update-available-card__item {
            text-align: center;
            width: 50%;
        }

        .update-available-card__item:not(:first-child) {
            border-left: 2px solid #e5e5e5;
        }

        .update-available-card__item h4 {
            margin-bottom: 0px;
            font-size: 6.25rem;
            font-weight: 800;
            line-height: 1;
        }

        .update-available-card__item p {
            font-size: 1.875rem;
            font-weight: 500;
        }

        .update-available-card-bottom p {
            display: flex;
            gap: 10px;
            line-height: 1.4;
            font-style: italic;
        }

        .update-available-card-bottom p i {
            font-size: 1.25rem;
            vertical-align: middle;
        }


        @media only screen and (max-width: 767px) {
            .update-available-card__item h4 {
                font-size: 4.688rem;
            }

            .update-available-card__item p {
                font-size: 1.5rem;
            }
        }

        @media only screen and (max-width: 575px) {
            .update-available-card__item h4 {
                font-size: 3rem;
                line-height: 1.4;
            }

            .update-available-card__item p {
                font-size: 1.125rem;
            }

            .update-available-card {
                padding: 30px 15px;
            }

            .update-available-card-top {
                margin-bottom: 20px;
            }

            .update-available-card__item:not(:first-child) {
                border-width: 1px;
            }
        }

        @media only screen and (max-width: 375px) {
            .update-available-card__item h4 {
                font-size: 2rem;
            }

            .update-available-card__item p {
                font-size: 0.875rem;
            }

            .update-available-card-top {
                margin-bottom: 20px;
            }
        }
        .modal-version-text{
            font-size: 70px;
            font-weight: 600;
            margin-top: 10px;
        }
        .card-section__icon {
            text-align: center;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #28c76f;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .card-section__icon i {
            font-size: 50px;
            color: #28c76f;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/admin/system/update.blade.php ENDPATH**/ ?>