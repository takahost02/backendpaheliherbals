<div class="col-md-12">
    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive table-responsive--sm">
                <table class=" table align-items-center table--light">
                    <thead>
                    <tr>
                        <th><?php echo app('translator')->get('Short Code'); ?> </th>
                        <th><?php echo app('translator')->get('Description'); ?></th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    
                    <tr>
                        <td><span class="short-codes">{{fullname}}</span></td>
                        <td><?php echo app('translator')->get('Full Name of User'); ?></td>
                    </tr>
                    <tr>
                        <td><span class="short-codes">{{username}}</span></td>
                        <td><?php echo app('translator')->get('Username of User'); ?></td>
                    </tr>
                    <tr>
                        <td><span class="short-codes">{{message}}</span></td>
                        <td><?php echo app('translator')->get('Message'); ?></td>
                    </tr>
                    <?php $__currentLoopData = gs('global_shortcodes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shortCode => $codeDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><span class="short-codes">{{<?php echo $shortCode ?>}}</span></td>
                        <td><?php echo e(__($codeDetails)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/notification/global_shortcodes.blade.php ENDPATH**/ ?>