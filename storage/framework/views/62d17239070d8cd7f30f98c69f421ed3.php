<?php echo $__env->make($activeTemplate.'partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Product Details Section Starts Here -->
    <section class="product-details padding-top padding-bottom pos-rel">
        <div class="container">
            <div class="row gy-4 gy-sm-5">
                <div class="col-lg-5">
                    <div class="product-thumb-wrapper">
                        <div class="sync1 owl-carousel owl-theme">
                            <div class="thumbs">
                                <img class="zoom_img" src="<?php echo e(getImage(getFilePath('products') . '/' . $product->thumbnail, getFilePath('products'))); ?>"
                                    alt="products-details">
                            </div>
                            <?php if($product->images != null): ?>
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="thumbs"> <img class="zoom_img"
                                            src="<?php echo e(getImage(getFilePath('products') . '/' . $image->name, getFileSize('products'))); ?>"
                                            alt="products-details"></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="sync2 owl-carousel owl-theme mt-2">
                            <div class="thumbs">
                                <img class="zoom_img" src="<?php echo e(getImage(getFilePath('products') . '/' . $product->thumbnail, getFileSize('products'))); ?>"
                                    alt="products-details">
                            </div>
                            <?php if($product->images != null): ?>
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="thumbs">
                                        <img src="<?php echo e(getImage(getFilePath('products') . '/' . $image->name, getFileSize('products'))); ?>"
                                            alt="products-details">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="product-info-wrapper">
                        <h3 class="title"><?php echo e(__(@$product->name)); ?></h3>
                        <div class="product-price">
                            <span class="current-price"><?php echo e(showAmount($product->price)); ?></span>
                        </div>
                        <?php if($product->quantity > 0): ?>
                            <span class="custom--badge bg--success mt-3"><?php echo app('translator')->get('In Stock'); ?></span>
                        <?php else: ?>
                            <span class="custom--badge bg--danger mt-3"><?php echo app('translator')->get('Out of Stock'); ?></span>
                        <?php endif; ?>
                        <div class="add-cart-wrapper">
                            <div class="cart-plus-minus">
                                <div class="cart-decrease qtybutton dec"><i class="las la-minus"></i></div>
                                <input class="cart-count" type="text" value="1" readonly>
                                <div class="cart-increase qtybutton inc active"><i class="las la-plus"></i></div>
                            </div>
                            <?php if($product->quantity > 0): ?>
                                <a class="cart--btn cmn--btn-2 bg--primary purchaseBtn" data-id="<?php echo e($product->id); ?>" data-name="<?php echo e($product->name); ?>"
                                    href="javascript:void(0)"><?php echo app('translator')->get('Purchase Now'); ?></a>
                            <?php endif; ?>
                        </div>
                        <ul class="product-meta">
                            <li class="meta-item">
                                <h6 class="title"><?php echo app('translator')->get('Category'); ?> :</h6>
                                <a href="<?php echo e(route('products', $product->category_id)); ?>"><?php echo e(__($product->category->name)); ?></a>
                            </li>
                            <li class="meta-item">
                                <h6 class="title"><?php echo app('translator')->get('Tags'); ?> :</h6>
                                <?php if(!empty($product->meta_keyword) && is_iterable($product->meta_keyword)): ?>
                                    <?php $__currentLoopData = $product->meta_keyword; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="#0"><?php echo e($keyword); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </li>
                        </ul>
                        <?php if($product->specifications): ?>
                            <div class="specifications mt-3">
                                <h5 class="title"><?php echo app('translator')->get('Product Full Specifications'); ?></h5>
                                <table class="specification-table">
                                    <tbody>
                                        <?php $__currentLoopData = $product->specifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th><?php echo e($specification['name']); ?></th>
                                                <td><?php echo e($specification['value']); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="shape shape1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/blob1.png')); ?>" alt="shape"></div>
    </section>

    <div class="product-details section-bg pb-80">
        <div class="container">
            <div class="product-details-wrapper">
                <div class="description">
                    <h3 class="mb-3"><?php echo app('translator')->get('Description'); ?></h3>
                    <?php echo @$product->description ?>
                </div>

                <div class="mt-5">
                    <div class="blog-details__share d-flex align-items-center flex-wrap">
                        <ul class="social-list">
                            <li class="social-list__item">
                                <b><?php echo app('translator')->get('Share Now :'); ?></b>
                            </li>
                            <li class="social-list__item">
                                <a class="social-list__link flex-center facebook"
                                    href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="social-list__item">
                                <a class="social-list__link flex-center twitter"
                                    href="https://x.com/intent/tweet?text=<?php echo e(__($product->name)); ?>&amp;url=<?php echo e(urlencode(url()->current())); ?>"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="social-list__item">
                                <a class="social-list__link flex-center linkedin"
                                    href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>&amp;title=<?php echo e(__($product->name)); ?>&amp;summary=<?php echo strLimit(strip_tags($product->meta_description),100) ?>"
                                    target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                            <li class="social-list__item">
                                <a class="social-list__link flex-center instagram"
                                    href="https://www.instagram.com/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section Starts Here -->
    <section class="product-section padding-top padding-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section-header text-center">
                        <h2 class="title"><?php echo app('translator')->get('Related Products'); ?></h2>
                    </div>
                </div>
            </div>
            <div class="product-slider owl-carousel owl-theme owl-loaded owl-drag">
                <?php $__currentLoopData = $relates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="owl-item">
                        <div class="product-item h-100">
                            <div class="product-thumb">
                                <img src="<?php echo e(getImage(getFilePath('products') . '/' . $product->thumbnail, getFileSize('products'))); ?>" alt="products">
                                <ul class="product-options">
                                    <li><a class="image"
                                            href="<?php echo e(getImage(getFilePath('products') . '/' . $product->thumbnail, getFileSize('products'))); ?>"><i
                                                class="las la-expand"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-content">
                                <h6 class="product-title"><a
                                        href="<?php echo e(route('product.details', ['id' => $product->id, 'slug' => slug($product->name)])); ?>"><?php echo e(__(shortDescription($product->name, 35))); ?></a>
                                </h6>

                                <?php if($product->quantity >= 0): ?>
                                    <span class="product-availablity text--success"><?php echo app('translator')->get('in stock'); ?></span>
                                <?php else: ?>
                                    <span class="product-availablity text--danger"><?php echo app('translator')->get('out stock'); ?></span>
                                <?php endif; ?>

                                <div class="product-price">
                                    <span class="current-price"><?php echo e(showAmount($product->price)); ?></span>
                                </div>
                                <a class="add-to-cart cmn--btn-2"
                                    href="<?php echo e(route('product.details', ['id' => $product->id, 'slug' => slug($product->name)])); ?>"><?php echo app('translator')->get('Details'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if(blank($relates)): ?>
                <span class="w-100 text-center"><?php echo app('translator')->get('Related product not found'); ?></span>
            <?php endif; ?>
        </div>
    </section>
    <!-- Products Section Ends Here -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('modal'); ?>
    <div class="modal fade" id="purchaseModal" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('Purchase Confirmation'); ?></h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('user.purchase')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input name="quantity" type="hidden">
                        <input name="product_id" type="hidden">
                        <h6><?php echo app('translator')->get('Are you sure to buy'); ?> <span class="quantity"></span> <?php echo app('translator')->get('pieces'); ?> "<span class="p_name"></span>"</h6>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--dark" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('Close'); ?></button>
                        <button class="btn btn--base" type="submit"><?php echo app('translator')->get('Purchase'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            $('.purchaseBtn').on('click', function() {
                var counter = $('.cart-count').val();
                var modal = $('#purchaseModal');
                modal.find('input[name=quantity]').val(counter);
                modal.find('input[name=product_id]').val($(this).data('id'));
                modal.find('.p_name').text($(this).data('name'));
                modal.find('.quantity').text(counter);
                modal.modal('show');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .variants-wrapper {
            margin-left: 15px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/product_detail.blade.php ENDPATH**/ ?>