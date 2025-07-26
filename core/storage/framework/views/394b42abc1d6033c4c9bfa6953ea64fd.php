<?php $__env->startSection('panel'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
             <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two bg-white">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Name'); ?></th>
                                <th><?php echo app('translator')->get('Schedule'); ?></th>
                                <th><?php echo app('translator')->get('Next Run'); ?></th>
                                <th><?php echo app('translator')->get('Last Run'); ?></th>
                                <th><?php echo app('translator')->get('Is Running'); ?></th>
                                <th><?php echo app('translator')->get('Type'); ?></th>
                                <th><?php echo app('translator')->get('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $crons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cron): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $dateTime = now()->parse($cron->next_run);
                                    $formattedDateTime = showDateTime($dateTime,'Y-m-d\TH:i');
                                ?>
                                <tr>
                                    <td>
                                        <?php echo e(__($cron->name)); ?> <?php if($cron->logs->where('error','!=',null)->count()): ?> <i class="fas fa-exclamation-triangle text--danger"></i> <?php endif; ?> <br>
                                        <code><?php echo e(__($cron->alias)); ?></code>
                                    </td>
                                    <td><?php echo e(__($cron->schedule->name)); ?></td>
                                    <td><?php if($cron->next_run): ?> <?php echo e(__($cron->next_run)); ?> <?php if($cron->next_run > now()): ?> <br> <?php echo e(diffForHumans($cron->next_run)); ?> <?php endif; ?> <?php else: ?> -- <?php endif; ?></td>
                                    <td><?php if($cron->last_run): ?> <?php echo e(__($cron->last_run)); ?> <br> <?php echo e(diffForHumans($cron->last_run)); ?> <?php else: ?> -- <?php endif; ?></td>
                                    <td>
                                        <?php if($cron->is_running): ?>
                                            <span class="badge badge--success"><?php echo app('translator')->get('Running'); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge--dark"><?php echo app('translator')->get('Pause'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($cron->is_default): ?>
                                            <span class="badge badge--success"><?php echo app('translator')->get('Default'); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge--primary"><?php echo app('translator')->get('Customizable'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline--primary" id="actionButton" data-bs-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i><?php echo app('translator')->get('Action'); ?>
                                            </button>
                                            <div class="dropdown-menu p-0">
                                                <a href="<?php echo e(route('cron')); ?>?alias=<?php echo e($cron->alias); ?>" class="dropdown-item"><i class="las la-check-circle"></i> <?php echo app('translator')->get('Run Now'); ?></a>
                                                <?php if($cron->is_running): ?>
                                                    <a href="<?php echo e(route('admin.cron.schedule.pause', $cron->id)); ?>" class="dropdown-item"><i class="las la-pause"></i> <?php echo app('translator')->get('Pause'); ?></a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('admin.cron.schedule.pause', $cron->id)); ?>" class="dropdown-item"><i class="las la-play"></i> <?php echo app('translator')->get('Play'); ?></a>
                                                <?php endif; ?>
                                                <a href="" data-id="<?php echo e($cron->id); ?>" data-name="<?php echo e($cron->name); ?>" data-url="<?php echo e($cron->url); ?>" data-next_run="<?php echo e($formattedDateTime); ?>" data-cron_schedule_id="<?php echo e($cron->cron_schedule_id); ?>" data-default="<?php echo e($cron->is_default); ?>" class="dropdown-item updateCron"><i class="las la-pen"></i> <?php echo app('translator')->get('Edit'); ?></a>
                                                <a href="<?php echo e(route('admin.cron.schedule.logs', $cron->id)); ?>" class="dropdown-item"><i class="las la-history"></i> <?php echo app('translator')->get('Logs'); ?></a>
                                                <?php if(!$cron->is_default): ?>
                                                    <a href="javascript:void(0)" data-action="<?php echo e(route('admin.cron.delete', $cron->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to delete this cron?'); ?>" class="dropdown-item confirmationBtn"><i class="las la-trash"></i> <?php echo app('translator')->get('Delete'); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
        </div><!-- card end -->
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

<div class="modal fade" id="addCron" tabindex="-1" role="dialog" a aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('Add Cron Job'); ?></h4>
                <button type="button" class="close" data-bs-dismiss="modal"><i class="las la-times"></i></button>
            </div>
            <form class="form-horizontal disableSubmission resetForm" method="post" action="<?php echo e(route('admin.cron.store')); ?>">
                <?php echo csrf_field(); ?>

                <div class="modal-body">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Name'); ?></label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo app('translator')->get("Next Run"); ?></label>
                        <input type="datetime-local" name="next_run" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo app('translator')->get("Schedule"); ?></label>
                        <select name="cron_schedule_id" class="form-control select2" data-minimum-results-for-search="-1" required>
                            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($schedule->id); ?>"><?php echo e($schedule->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo app('translator')->get("Url"); ?></label>
                        <input type="text" name="url" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary h-45 w-100"><?php echo app('translator')->get('Submit'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="updateCron" tabindex="-1" role="dialog" a aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('Edit Cron Job'); ?></h4>
                <button type="button" class="close" data-bs-dismiss="modal"><i class="las la-times"></i></button>
            </div>
            <form class="form-horizontal resetForm" method="post" action="<?php echo e(route('admin.cron.update')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Name'); ?></label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo app('translator')->get("Next Run"); ?></label>
                        <input type="datetime-local" name="next_run" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo app('translator')->get("Schedule"); ?></label>
                        <select name="cron_schedule_id" class="form-control select2" data-minimum-results-for-search="-1" required>
                            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($schedule->id); ?>"><?php echo e($schedule->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group urlGroup">
                        <label><?php echo app('translator')->get("Url"); ?></label>
                        <input type="text" name="url" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary h-45 w-100"><?php echo app('translator')->get('Submit'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <button type="btn" class="btn btn-outline--primary addCron"><i class="las la-plus"></i><?php echo app('translator')->get('Add'); ?></button>
    <a href="<?php echo e(route('admin.cron.schedule')); ?>" class="btn btn-outline--info"><i class="las la-clock"></i><?php echo app('translator')->get('Cron Schedule'); ?></a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            $('.addCron').on('click', function() {
                let modal = $('#addCron');
                $('.resetForm').trigger('reset');
                modal.modal('show');
            });

            $('.updateCron').on('click', function(e) {
                e.preventDefault();
                var modal = $('#updateCron');
                let id = $(this).data('id');
                let name = $(this).data('name');
                let next_run = $(this).data('next_run');
                let cron_schedule_id = $(this).data('cron_schedule_id');
                let isDefault = $(this).data('default');
                if(isDefault){
                    modal.find('[name=url]').attr('required', false);
                    $('.urlGroup').hide();
                }else{
                    modal.find('[name=url]').parent().find('label').addClass('required');
                    modal.find('[name=url]').attr('required', true);
                    modal.find('[name=url]').val($(this).data('url'));
                    $('.urlGroup').show();
                }
                modal.find('input[name=id]').val(id);
                modal.find('input[name=name]').val(name);
                modal.find('input[name=next_run]').val(next_run);
                modal.find('select[name=cron_schedule_id]').val(cron_schedule_id);
                modal.find(".select2").val(cron_schedule_id).change();
                modal.modal('show');
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/admin/cron/index.blade.php ENDPATH**/ ?>