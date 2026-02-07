

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card custom--card p-0">
                <div class="card-header bg--primary-gradient p-3">
                    <h4 class="card-title font-weight-normal text-white"><?php echo app('translator')->get('Referrer Link'); ?></h4>
                </div>
                <div class="card-body mb-3 p-4">
                    <h4 class="card-title font-weight-normal"><?php echo app('translator')->get('Join left'); ?></h4>
                    <form id="copyBoard" class="mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-10 my-1">
                                <input class="form-control form--control from-control-lg" id="ref" type="url"
                                    value="<?php echo e(route('user.register')); ?>/?ref=<?php echo e(auth()->user()->username); ?>&position=left" readonly>
                            </div>
                            <div class="col-md-2 my-1">
                                <button class="cmn--btn btn-block active" id="copybtn" type="button" onclick="myFunction('ref')"> <span><i
                                            class="fa fa-copy"></i> <?php echo app('translator')->get('Copy'); ?></span></button>
                            </div>
                        </div>
                    </form>

                    <h4 class="card-title font-weight-normal"><?php echo app('translator')->get('Join right'); ?></h4>
                    <form id="copyBoard2">
                        <div class="row align-items-center">
                            <div class="col-md-10 my-1">
                                <input class="form-control form--control from-control-lg" id="ref2" type="url"
                                    value="<?php echo e(route('user.register')); ?>?ref=<?php echo e(auth()->user()->username); ?>&position=right" readonly>
                            </div>
                            <div class="col-md-2 my-1">
                                <button class="cmn--btn btn-block btn-sm active" id="copybtn2" type="button" onclick="myFunction('ref2')"> <span><i
                                            class="fa fa-copy"></i> <?php echo app('translator')->get('Copy'); ?></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card custom--card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm">
                        <table class="custom--table table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Username'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Email'); ?></th>
                                    <th><?php echo app('translator')->get('Join Date'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($data->username); ?></td>
                                        <td><?php echo e($data->fullname); ?></td>
                                        <td><?php echo e($data->email); ?></td>
                                        <td>
                                            <?php echo e(showDateTime($data->created_at)); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <?php if($logs->hasPages()): ?>
            <div class="mt-4">
                <?php echo e(paginateLinks($logs)); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';

        function myFunction(id) {
            var copyText = document.getElementById(id);
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            notify('success', 'Url copied successfully ' + copyText.value);
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/user/myRef.blade.php ENDPATH**/ ?>