
<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <?php echo csrf_field(); ?>
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo app('translator')->get('Multi-Level Commission Settings'); ?></h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th><?php echo app('translator')->get('Rank'); ?></th>
                                                <th><?php echo app('translator')->get('Commission (%)'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $stored = json_decode($commissions->commissions ?? '[]', true);
                                            ?>
                                            <?php for($i = 2; $i <= 16; $i++): ?> 
                                                <tr>
                                                    
                                                    <td><?php echo e($i - 1); ?></td>
                                                    <td>
                                                        <input type="number" 
                                                               name="commission[<?php echo e($i); ?>]" 
                                                               class="form-control"
                                                               step="any" 
                                                               min="0"
                                                               value="<?php echo e(old('commission.' . $i, $stored[$i] ?? '')); ?>"
                                                               required>
                                                    </td>
                                                </tr>
                                            <?php endfor; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn--primary"><?php echo app('translator')->get('Submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/admin/setting/matrics.blade.php ENDPATH**/ ?>