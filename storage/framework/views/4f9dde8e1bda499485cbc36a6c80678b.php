<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom--card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm">
                        <table class="custom--table table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('ID'); ?></th>
                                    <th><?php echo app('translator')->get('Ref By'); ?></th>
                                    <th><?php echo app('translator')->get('Pos ID'); ?></th>
                                    <th><?php echo app('translator')->get('Position'); ?></th>
                                    <th><?php echo app('translator')->get('Level'); ?></th>
                                    <th><?php echo app('translator')->get('First Name'); ?></th>
                                    <th><?php echo app('translator')->get('Username'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($row->id); ?></td>
                                        <td><?php echo e($row->ref_by_label ?? '-'); ?></td>
                                        <td><?php echo e($row->pos_id_label ?? '-'); ?></td>
                                        <td>
                                            <?php if($row->position == 1): ?>
                                                <?php echo app('translator')->get('Left'); ?>
                                            <?php elseif($row->position == 2): ?>
                                                <?php echo app('translator')->get('Right'); ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($row->level); ?></td>
                                        <td><?php echo e($row->firstname); ?></td>
                                        <td><?php echo e($row->username); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">
                                            <?php echo app('translator')->get('No team members found.'); ?>
                                        </td>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/reports/myupline.blade.php ENDPATH**/ ?>