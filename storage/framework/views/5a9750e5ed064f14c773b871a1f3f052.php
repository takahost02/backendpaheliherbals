<?php $__env->startSection('content'); ?>
    <div class="card custom--card p-0 p-0">
        <div class="card-body p-0">
            <div class="py-3 d-flex justify-content-center">
                <a href="<?php echo e(url('products')); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-box"></i> Buy New Product
                </a>
            </div>
            <div class="table-responsive">
                <table class="custom--table table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('Product'); ?></th>
                            <th><?php echo app('translator')->get('Quantity'); ?></th>
                            <th><?php echo app('translator')->get('Price'); ?></th>
                            <th><?php echo app('translator')->get('Total Price'); ?></th>
                            <th><?php echo app('translator')->get('Status'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <?php if(@$order->product): ?>
                                        <a href="<?php echo e(route('product.details', ['id' => @$order->product->id, 'slug' => slug($order->product->name)])); ?>">
                                            <?php echo e(__(strLimit($order->product->name, '30'))); ?></a>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($order->quantity); ?></td>
                                <td><?php echo e(showAmount($order->price)); ?></td>
                                <td><?php echo e(showAmount($order->total_price)); ?></td>
                                <td>
                                    <?php echo $order->statusOrderBadge ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td class="text-center" colspan="100%"><?php echo app('translator')->get('No order found'); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if($orders->hasPages()): ?>
        <div class="mt-4">
            <?php echo e(paginateLinks($orders)); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/user/orders.blade.php ENDPATH**/ ?>