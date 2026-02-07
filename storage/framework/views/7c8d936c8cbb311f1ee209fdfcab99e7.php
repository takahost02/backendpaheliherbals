<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--lg table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('User'); ?></th>
                                    <th><?php echo app('translator')->get('Trx'); ?></th>
                                    <th><?php echo app('translator')->get('Price'); ?></th>
                                    <th><?php echo app('translator')->get('Total Price'); ?></th>
                                    <th><?php echo app('translator')->get('Quantity'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>

                                        <td>
                                            <?php if($order->user): ?>
                                                <span class="fw-bold"><?php echo e($order->user->fullname); ?></span>
                                                <br>
                                                <span class="small">
                                                    <a href="<?php echo e(route('admin.users.detail', $order->user_id)); ?>"><span>@</span><?php echo e($order->user->username); ?></a>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-danger">User not found</span>
                                            <?php endif; ?>
                                        </td>

                                        <td><?php echo e('#' . $order->trx); ?></td>

                                        <td><?php echo e(showAmount($order->price)); ?> </td>
                                        <td><?php echo e(showAmount($order->total_price)); ?></td>
                                        <td><?php echo e($order->quantity); ?></td>
                                        <td>
                                            <?php echo $order->statusOrderBadge ?>
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <button class="btn btn-outline--primary btn-sm orderBtn"
                                                    data-action="<?php echo e(route('admin.order.status', $order->id)); ?>"
                                                    <?php if($order->status != 0): ?> disabled <?php endif; ?>><?php echo app('translator')->get('Order Status'); ?></button>
                                                <button class="btn btn-sm btn-outline--success orderDetailsBtn" data-order='<?php echo json_encode($order, 15, 512) ?>'
                                                    data-date="<?php echo e(showDateTime($order->created_at)); ?>" data-status="<?php echo e($order->statusOrderBadge); ?>"><i
                                                        class="las la-desktop"></i><?php echo app('translator')->get('Details'); ?></button>
                                            </div>
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
                <?php if($orders->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($orders)); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderStatusModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Update Order Status'); ?></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Order Status'); ?></label>
                            <select class="form-control select2" name="status" data-minimum-results-for-search="-1">
                                <option value="1"><?php echo app('translator')->get('Shipped'); ?></option>
                                <option value="2"><?php echo app('translator')->get('Cancel'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--dark" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('Cancel'); ?></button>
                        <button class="btn btn--primary" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderDetailsModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Order Details'); ?></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <b><?php echo app('translator')->get('Product'); ?></b> <a class="product" href=""></a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <b><?php echo app('translator')->get('Quantity'); ?> </b> <span class="quantity"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <b><?php echo app('translator')->get('Price'); ?> </b> <span class="price"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <b><?php echo app('translator')->get('Total Price'); ?> </b> <span class="total-price"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <b><?php echo app('translator')->get('Username'); ?></b> <span class="username"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <b><?php echo app('translator')->get('Transition No'); ?></b> <span class="trx"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <b><?php echo app('translator')->get('Order Date'); ?> </b> <span class="date"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <b><?php echo app('translator')->get('Status'); ?> </b> <span class="status"></span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginale48b4598ffc2f41a085f001458a956d1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale48b4598ffc2f41a085f001458a956d1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale48b4598ffc2f41a085f001458a956d1)): ?>
<?php $attributes = $__attributesOriginale48b4598ffc2f41a085f001458a956d1; ?>
<?php unset($__attributesOriginale48b4598ffc2f41a085f001458a956d1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale48b4598ffc2f41a085f001458a956d1)): ?>
<?php $component = $__componentOriginale48b4598ffc2f41a085f001458a956d1; ?>
<?php unset($__componentOriginale48b4598ffc2f41a085f001458a956d1); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            $('.orderBtn').on('click', function() {
                var modal = $('#orderStatusModal');
                modal.find('form').attr('action', $(this).data('action'));
                modal.modal('show');
            });

            $('.orderDetailsBtn').on('click', function() {
                var modal = $('#orderDetailsModal');
                var order = $(this).data('order');
                var date = $(this).data('date');
                var status = $(this).data('status');
                var curSym = `<?php echo e(gs('cur_sym')); ?>`;
                var price = curSym + parseFloat(order.price).toFixed(2);
                var totalPrice = curSym + parseFloat(order.total_price).toFixed(2);
                var url = (`<?php echo e(route('admin.product.edit', ':id')); ?>`).replace(":id", order.product_id);
                modal.find('.username').text(order.user.username);
                modal.find('.trx').text(order.trx);
                modal.find('.product').text(order.product.name);
                modal.find('.product').attr('href', url);
                modal.find('.quantity').text(order.quantity);
                modal.find('.quantity').text(order.quantity);
                modal.find('.price').text(price);
                modal.find('.total-price').text(totalPrice);
                modal.find('.status').html(status);
                modal.find('.date').html(date);
                modal.modal('show');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/admin/orders.blade.php ENDPATH**/ ?>