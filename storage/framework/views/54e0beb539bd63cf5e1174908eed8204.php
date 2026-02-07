<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="text-end mb-3">
                <a href="<?php echo e(route('ticket.index')); ?>" class="btn btn--base">
                    <i class="las la-list"></i> <?php echo app('translator')->get('My Support Ticket'); ?>
                </a>
            </div>
            <div class="card custom--card">
                <div class="card-body">
                    <form action="<?php echo e(route('ticket.store')); ?>" class="disableSubmission" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form--group col-md-6">
                                <label class="form--label"><?php echo app('translator')->get('Subject'); ?></label>
                                <input type="text" name="subject" value="<?php echo e(old('subject')); ?>" class="form-control form--control" required>
                            </div>
                            <div class="form--group col-md-6">
                                <label class="form--label"><?php echo app('translator')->get('Priority'); ?></label>
                                <select name="priority" class="form-select form--control select2" data-minimum-results-for-search="-1" required>
                                    <option value="3"><?php echo app('translator')->get('High'); ?></option>
                                    <option value="2"><?php echo app('translator')->get('Medium'); ?></option>
                                    <option value="1"><?php echo app('translator')->get('Low'); ?></option>
                                </select>
                            </div>
                            <div class="col-12 form--group">
                                <label class="form--label"><?php echo app('translator')->get('Message'); ?></label>
                                <textarea name="message" id="inputMessage" rows="6" class="form-control form--control" required><?php echo e(old('message')); ?></textarea>
                            </div>

                            <div class="col-md-9">
                                <button type="button" class="btn btn-dark btn-sm addAttachment my-2"> <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Attachment'); ?>
                                </button>
                                <p class="mb-2"><span class="text--info"><?php echo app('translator')->get('Max 5 files can be uploaded | Maximum upload size is ' . convertToReadableSize(ini_get('upload_max_filesize')) . ' | Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx'); ?></span></p>
                                <div class="row fileUploadsContainer">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn--base w-100 my-2" type="submit"><i class="las la-paper-plane"></i> <?php echo app('translator')->get('Submit'); ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .input-group-text:focus {
            box-shadow: none !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            var fileAdded = 0;
            $('.addAttachment').on('click', function() {
                fileAdded++;
                if (fileAdded == 5) {
                    $(this).attr('disabled', true)
                }
                $(".fileUploadsContainer").append(`
                    <div class="col-lg-4 col-md-12 removeFileInput">
                        <div class="form--group">
                            <div class="input-group">
                                <input type="file" name="attachments[]" class="form-control" accept=".jpeg,.jpg,.png,.pdf,.doc,.docx" required>
                                <button type="button" class="input-group-text removeFile bg--danger border--danger"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                `)
            });
            $(document).on('click', '.removeFile', function() {
                $('.addAttachment').removeAttr('disabled', true)
                fileAdded--;
                $(this).closest('.removeFileInput').remove();
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/support/create.blade.php ENDPATH**/ ?>