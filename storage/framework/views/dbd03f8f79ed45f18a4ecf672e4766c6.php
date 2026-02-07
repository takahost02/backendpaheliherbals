<?php $__env->startSection('panel'); ?>
    <?php $__env->startPush('topBar'); ?>
        <?php echo $__env->make('admin.notification.top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->stopPush(); ?>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card bl--5 border--primary">
                <div class="card-body">
                    <p class="text--primary"><?php echo app('translator')->get('If you want to send push notification by the firebase, Your system must be SSL certified'); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('API Key'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('API Key'); ?>" name="apiKey" value="<?php echo e(@gs('firebase_config')->apiKey); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Auth Domain'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Auth Domain'); ?>" name="authDomain" value="<?php echo e(@gs('firebase_config')->authDomain); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Project Id'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Project Id'); ?>" name="projectId" value="<?php echo e(@gs('firebase_config')->projectId); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Storage Bucket'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Storage Bucket'); ?>" name="storageBucket" value="<?php echo e(@gs('firebase_config')->storageBucket); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Messaging Sender Id'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Messaging Sender Id'); ?>" name="messagingSenderId" value="<?php echo e(@gs('firebase_config')->messagingSenderId); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('App Id'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('App Id'); ?>" name="appId" value="<?php echo e(@gs('firebase_config')->appId); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Measurement Id'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Measurement Id'); ?>" name="measurementId" value="<?php echo e(@gs('firebase_config')->measurementId); ?>" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div><!-- card end -->
        </div>
    </div>

    <div id="pushNotifyModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Firebase Setup'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="steps-tab" data-bs-toggle="tab" data-bs-target="#steps" type="button" role="tab" aria-controls="steps" aria-selected="true"><?php echo app('translator')->get('Steps'); ?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="configs-tab" data-bs-toggle="tab" data-bs-target="#configs" type="button" role="tab" aria-controls="configs" aria-selected="false"><?php echo app('translator')->get('Configs'); ?></button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="steps" role="tabpanel" aria-labelledby="steps-tab">
                            <div class="table-responsive overflow-hidden">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get('To Do'); ?></th>
                                            <th><?php echo app('translator')->get('Description'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo app('translator')->get('Step 1'); ?></td>
                                            <td><?php echo app('translator')->get('Go to your Firebase account and select'); ?> <span class="text--primary">"<?php echo app('translator')->get('Go to console'); ?></span>" <?php echo app('translator')->get('in the upper-right corner of the page.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo app('translator')->get('Step 2'); ?></td>
                                            <td><?php echo app('translator')->get('Click on the'); ?> <span class="text--primary">"<?php echo app('translator')->get('Add Project'); ?></span>" <?php echo app('translator')->get('button.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo app('translator')->get('Step 3'); ?></td>
                                            <td><?php echo app('translator')->get('Enter the project name and click on the'); ?> <span class="text--primary">"<?php echo app('translator')->get('Continue'); ?></span>" <?php echo app('translator')->get('button.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo app('translator')->get('Step 4'); ?></td>
                                            <td><?php echo app('translator')->get('Enable Google Analytics and click on the'); ?> <span class="text--primary">"<?php echo app('translator')->get('Continue'); ?></span>" <?php echo app('translator')->get('button.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo app('translator')->get('Step 5'); ?></td>
                                            <td><?php echo app('translator')->get('Choose the default account for the Google Analytics account and click on the'); ?> <span class="text--primary">"<?php echo app('translator')->get('Create Project'); ?></span>" <?php echo app('translator')->get('button.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo app('translator')->get('Step 6'); ?></td>
                                            <td><?php echo app('translator')->get('Within your Firebase project, select the gear next to Project Overview and choose Project settings.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo app('translator')->get('Step 7'); ?></td>
                                            <td><?php echo app('translator')->get('Next, set up a web app under the General section of your project settings.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo app('translator')->get('Step 8'); ?></td>
                                            <td><?php echo app('translator')->get('Go to the Service accounts tab and generate a new private key.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo app('translator')->get('Step 9'); ?></td>
                                            <td><?php echo app('translator')->get('A JSON file will be downloaded. Upload the downloaded file here.'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade mt-3 ms-2 text-center" id="configs" role="tabpanel" aria-labelledby="configs-tab">
                            <img src="<?php echo e(getImage('assets/images/firebase/' . 'configs.png')); ?>" alt="Firebase Config">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="pushConfigJson" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Upload Push Notification Configuration File'); ?></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form method="POST" action="<?php echo e(route('admin.setting.notification.push.upload')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mt-2"><?php echo app('translator')->get('File'); ?></label>
                            <input type="file" class="form-control" name="file" accept=".json" required>
                            <small class="mt-3 text-muted"><?php echo app('translator')->get('Supported Files: .json'); ?></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Upload'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <button type="button" data-bs-target="#pushNotifyModal" data-bs-toggle="modal" class="btn btn-sm btn-outline--info">
        <i class="las la-question"></i><?php echo app('translator')->get('Help'); ?>
    </button>
    <button class="btn btn-outline--primary updateBtn btn-sm" data-bs-toggle="modal" data-bs-target="#pushConfigJson" type="button"><i class="las la-upload"></i><?php echo app('translator')->get('Upload Config File'); ?></button>

    <a href="<?php echo e(route('admin.setting.notification.push.download')); ?>" class="btn btn-outline--info updateBtn btn-sm  <?php if(!$fileExists): ?> disabled <?php endif; ?>" <?php if(!$fileExists): echo 'disabled'; endif; ?>>
        <i class="las la-download"></i><?php echo app('translator')->get('Download File'); ?>
    </a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/notification/push_setting.blade.php ENDPATH**/ ?>