<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body ">

                    <h6 class="card-title  mb-4">
                        <div class="row align-items-center">
                            <div class="col-sm-8 col-md-6">
                                <?php echo $ticket->statusBadge; ?>
                                [<?php echo app('translator')->get('Ticket#'); ?><?php echo e($ticket->ticket); ?>] <?php echo e($ticket->subject); ?>

                            </div>
                            <div class="col-sm-4  col-md-6 text-sm-end mt-sm-0 mt-3">
                                <?php if($ticket->status != Status::TICKET_CLOSE): ?>
                                    <button class="btn btn--danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#DelModal">
                                        <i class="la la-times"></i> <?php echo app('translator')->get('Close Ticket'); ?>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </h6>



                    <form action="<?php echo e(route('admin.ticket.reply', $ticket->id)); ?>" enctype="multipart/form-data" method="post" class="form-horizontal disableSubmission">
                        <?php echo csrf_field(); ?>


                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" rows="5" required id="inputMessage" placeholder="<?php echo app('translator')->get('Enter reply here'); ?>"></textarea>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn--dark addAttachment my-2"> <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Attachment'); ?> </button>
                                <p class="mb-2"><span class="text--info"><?php echo app('translator')->get('Max 5 files can be uploaded | Maximum upload size is '.convertToReadableSize(ini_get('upload_max_filesize')) .' | Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx'); ?></span></p>
                                <div class="row fileUploadsContainer">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn--primary w-100 my-2" type="submit" name="replayTicket" value="1"><i class="la la-fw la-lg la-reply"></i> <?php echo app('translator')->get('Reply'); ?>
                                </button>
                            </div>
                        </div>

                    </form>


                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($message->admin_id == 0): ?>
                            <div class="row border border--primary border-radius-3 my-3 mx-0">

                                <div class="col-md-3 border-end text-md-end text-start">
                                    <h5 class="my-3"><?php echo e($ticket->name); ?></h5>
                                    <?php if($ticket->user_id != null): ?>
                                        <p><a href="<?php echo e(route('admin.users.detail', $ticket->user_id)); ?>">&#64;<?php echo e($ticket->name); ?></a></p>
                                    <?php else: ?>
                                        <p>@<span><?php echo e($ticket->name); ?></span></p>
                                    <?php endif; ?>
                                    <button class="btn btn--danger btn-sm my-3 confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to delete this message?'); ?>" data-action="<?php echo e(route('admin.ticket.delete', $message->id)); ?>"><i class="la la-trash"></i> <?php echo app('translator')->get('Delete'); ?></button>
                                </div>

                                <div class="col-md-9">
                                    <p class="text-muted fw-bold my-3">
                                        <?php echo app('translator')->get('Posted on'); ?> <?php echo e(showDateTime($message->created_at, 'l, dS F Y @ h:i a')); ?></p>
                                    <p><?php echo e($message->message); ?></p>
                                    <?php if($message->attachments->count() > 0): ?>
                                        <div class="my-3">
                                            <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('admin.ticket.download', encrypt($image->id))); ?>" class="me-2"><i class="fa-regular fa-file"></i> <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row border border-warning border-radius-3 my-3 mx-0 admin-bg-reply">

                                <div class="col-md-3 border-end text-md-end text-start">
                                    <h5 class="my-3"><?php echo e(@$message->admin->name); ?></h5>
                                    <p class="lead text-muted"><?php echo app('translator')->get('Staff'); ?></p>
                                    <button class="btn btn--danger btn-sm my-3 confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to delete this message?'); ?>" data-action="<?php echo e(route('admin.ticket.delete', $message->id)); ?>"><i class="la la-trash"></i> <?php echo app('translator')->get('Delete'); ?></button>
                                </div>

                                <div class="col-md-9">
                                    <p class="text-muted fw-bold my-3">
                                        <?php echo app('translator')->get('Posted on'); ?> <?php echo e(showDateTime($message->created_at, 'l, dS F Y @ h:i a')); ?></p>
                                    <p><?php echo e($message->message); ?></p>
                                    <?php if($message->attachments->count() > 0): ?>
                                        <div class="my-3">
                                            <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('admin.ticket.download', encrypt($image->id))); ?>" class="me-2"><i class="fa-regular fa-file"></i> <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?> </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <?php echo app('translator')->get('Close Support Ticket!'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo app('translator')->get('Are you want to close this support ticket?'); ?></p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo e(route('admin.ticket.close', $ticket->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="replayTicket" value="2">
                        <button type="button" class="btn btn--dark" data-bs-dismiss="modal"> <?php echo app('translator')->get('No'); ?> </button>
                        <button type="submit" class="btn btn--primary"> <?php echo app('translator')->get('Yes'); ?> </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalbd5922df145d522b37bf664b524be380 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbd5922df145d522b37bf664b524be380 = $attributes; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ConfirmationModal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
<?php $__env->stopSection(); ?>




<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginal3b9bf6c313f6db4d5c9389e5666c89a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b9bf6c313f6db4d5c9389e5666c89a5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.ticket.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.ticket.index')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b9bf6c313f6db4d5c9389e5666c89a5)): ?>
<?php $attributes = $__attributesOriginal3b9bf6c313f6db4d5c9389e5666c89a5; ?>
<?php unset($__attributesOriginal3b9bf6c313f6db4d5c9389e5666c89a5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b9bf6c313f6db4d5c9389e5666c89a5)): ?>
<?php $component = $__componentOriginal3b9bf6c313f6db4d5c9389e5666c89a5; ?>
<?php unset($__componentOriginal3b9bf6c313f6db4d5c9389e5666c89a5); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function($) {
            $('.delete-message').on('click', function(e) {
                $('.message_id').val($(this).data('id'));
            })
            var fileAdded = 0;
            $('.addAttachment').on('click', function() {
                fileAdded++;
                if (fileAdded == 5) {
                    $(this).attr('disabled',true)
                }
                $(".fileUploadsContainer").append(`
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 removeFileInput">
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
                $('.addAttachment').removeAttr('disabled',true)
                fileAdded--;
                $(this).closest('.removeFileInput').remove();
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/admin/support/reply.blade.php ENDPATH**/ ?>