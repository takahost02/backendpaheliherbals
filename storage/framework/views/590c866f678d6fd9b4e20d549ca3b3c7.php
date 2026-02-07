<?php $__env->startSection('content'); ?>
    <div class="<?php echo e(auth()->check() ? '' : 'padding-top padding-bottom'); ?>">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card custom--card">
                        <div class="card-header card-header-bg d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <h5 class="mt-0">
                                <?php echo $myTicket->statusBadge; ?>
                                [<?php echo app('translator')->get('Ticket'); ?>#<?php echo e($myTicket->ticket); ?>] <?php echo e($myTicket->subject); ?>

                            </h5>
                            <?php if($myTicket->status != Status::TICKET_CLOSE && $myTicket->user): ?>
                                <button class="btn btn-danger close-button btn-sm confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to close this ticket?'); ?>" data-action="<?php echo e(route('ticket.close', $myTicket->id)); ?>" type="button"><i class="fas fa-lg fa-times-circle"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <form class="disableSubmission" method="post" action="<?php echo e(route('ticket.reply', $myTicket->id)); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row justify-content-between">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control form--control" name="message" rows="4" required><?php echo e(old('message')); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <button class="btn btn-dark btn-sm addAttachment my-2" type="button"> <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Attachment'); ?> </button>
                                        <p class="mb-2"><span class="text--info"><?php echo app('translator')->get('Max 5 files can be uploaded | Maximum upload size is ' . convertToReadableSize(ini_get('upload_max_filesize')) . ' | Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx'); ?></span></p>
                                        <div class="row fileUploadsContainer">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn--base w-100 my-2" type="submit"><i class="la la-fw la-lg la-reply"></i> <?php echo app('translator')->get('Reply'); ?>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-4 custom--card">
                        <div class="card-body">
                            <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($message->admin_id == 0): ?>
                                    <div class="border-primary support-message border-radius-3 border py-3">
                                        <div class="message-box border-end text-end">
                                            <h5 class="my-3"><?php echo e($message->ticket->name); ?></h5>
                                        </div>
                                        <div class="message-box">
                                            <p class="text-muted fw-bold my-3">
                                                <?php echo app('translator')->get('Posted on'); ?> <?php echo e(showDateTime($message->created_at, 'l, dS F Y @ h:i a')); ?></p>
                                            <p><?php echo e($message->message); ?></p>
                                            <?php if($message->attachments->count() > 0): ?>
                                                <div class="mt-2">
                                                    <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a class="me-3" href="<?php echo e(route('ticket.download', encrypt($image->id))); ?>"><i class="fa-regular fa-file"></i> <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?> </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="border-warning  support-message border-radius-3 reply-bg border py-3">
                                        <div class="message-box border-end text-end">
                                            <h5 class="my-3"><?php echo e($message->admin->name); ?></h5>
                                            <p class="lead text-muted"><?php echo app('translator')->get('Staff'); ?></p>
                                        </div>
                                        <div class="message-box">
                                            <p class="text-muted fw-bold my-3">
                                                <?php echo app('translator')->get('Posted on'); ?> <?php echo e(showDateTime($message->created_at, 'l, dS F Y @ h:i a')); ?></p>
                                            <p><?php echo e($message->message); ?></p>
                                            <?php if($message->attachments->count() > 0): ?>
                                                <div class="mt-2">
                                                    <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a class="me-3" href="<?php echo e(route('ticket.download', encrypt($image->id))); ?>"><i class="fa-regular fa-file"></i> <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?> </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="empty-message text-center">
                                    <img src="<?php echo e(asset('assets/images/empty_list.png')); ?>" alt="empty">
                                    <h5 class="text-muted"><?php echo app('translator')->get('No replies found here!'); ?></h5>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('modal'); ?>
    <?php if (isset($component)) { $__componentOriginalbd5922df145d522b37bf664b524be380 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbd5922df145d522b37bf664b524be380 = $attributes; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ConfirmationModal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['base' => 'true']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbd5922df145d522b37bf664b524be380)): ?>
<?php $attributes = $__attributesOriginalbd5922df145d522b37bf664b524be380; ?>
<?php unset($__attributesOriginalbd5922df145d522b37bf664b524be380); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbd5922df145d522b37bf664b524be380)): ?>
<?php $component = $__componentOriginalbd5922df145d522b37bf664b524be380; ?>
<?php unset($__componentOriginalbd5922df145d522b37bf664b524be380); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('style'); ?>
    <style>
        .input-group-text:focus {
            box-shadow: none !important;
        }

        .reply-bg {
            background-color: #ffd96729
        }

        .empty-message img {
            width: 120px;
            margin-bottom: 15px;
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
                        <div class="form-group">
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

<?php echo $__env->make($activeTemplate . 'layouts.' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/support/view.blade.php ENDPATH**/ ?>