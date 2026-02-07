<?php $__env->startSection('content'); ?>
    <div class="card custom--card">
        <div class="card-body">
            <form class="register" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="row">
                    <div class="form--group col-12">
                        <label class="form--label"><?php echo app('translator')->get('Profile Photo'); ?></label>
                        <input class="form-control" name="image" type="file" accept=".png, .jpg, .jpeg" onchange="loadFile(event)">

                        <small class="text-muted mt-3"> <?php echo app('translator')->get('Supported Files:'); ?>
                            <b><?php echo app('translator')->get('.png, .jpg, .jpeg '); ?></b> <?php echo app('translator')->get('Image will be resized into'); ?> <b><?php echo app('translator')->get('350x300'); ?></b><?php echo app('translator')->get('px'); ?>
                        </small>
                    </div>

                    <div class="form--group col-sm-6">
                        <label class="form--label"><?php echo app('translator')->get('First Name'); ?></label>
                        <input class="form-control form--control" name="firstname" type="text" value="<?php echo e($user->firstname); ?>" required>
                    </div>
                    <div class="form--group col-sm-6">
                        <label class="form--label"><?php echo app('translator')->get('Last Name'); ?></label>
                        <input class="form-control form--control" name="lastname" type="text" value="<?php echo e($user->lastname); ?>" required>
                    </div>

                    <div class="form--group col-sm-6">
                        <label class="form--label"><?php echo app('translator')->get('E-mail Address'); ?></label>
                        <input class="form-control form--control" value="<?php echo e($user->email); ?>" readonly>
                    </div>
                    <div class="form--group col-sm-6">
                        <label class="form--label"><?php echo app('translator')->get('Mobile Number'); ?></label>
                        <input class="form-control form--control" value="<?php echo e($user->mobile); ?>" readonly>
                    </div>

                    <div class="form--group col-sm-6">
                        <label class="form--label"><?php echo app('translator')->get('Address'); ?></label>
                        <input class="form-control form--control" name="address" type="text" value="<?php echo e(@$user->address); ?>">
                    </div>
                    <div class="form--group col-sm-6">
                        <label class="form--label"><?php echo app('translator')->get('State'); ?></label>
                        <input class="form-control form--control" name="state" type="text" value="<?php echo e(@$user->state); ?>">
                    </div>

                    <div class="form--group col-sm-4">
                        <label class="form--label"><?php echo app('translator')->get('Zip Code'); ?></label>
                        <input class="form-control form--control" name="zip" type="text" value="<?php echo e(@$user->zip); ?>">
                    </div>

                    <div class="form--group col-sm-4">
                        <label class="form--label"><?php echo app('translator')->get('City'); ?></label>
                        <input class="form-control form--control" name="city" type="text" value="<?php echo e(@$user->city); ?>">
                    </div>

                    <div class="form--group col-sm-4">
                        <label class="form--label"><?php echo app('translator')->get('Country'); ?></label>
                        <input class="form-control form--control" value="<?php echo e(@$user->country_name); ?>" disabled>
                    </div>

                    <div class="col-12">
                        <button class="btn btn--base w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>

                </div>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .profile-image {
            flex-shrink: 0;
        }

        .profile-image img {
            height: 100px;
            width: 100px;
            border-radius: 50%;
            border: 6px solid #00000010;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/profile_setting.blade.php ENDPATH**/ ?>