<?php echo $__env->make($activeTemplate.'partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <section class="product-section padding-top padding-bottom mb-5">
        <div class="container">
            <ul class="mr-list justify-content-center">
                <li class="mr-list__item">
                    <a class="mr-list__btn <?php if(!$categoryId): ?> active <?php endif; ?>" href="<?php echo e(route('products')); ?>"><?php echo app('translator')->get('All Products'); ?></a>
                </li>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="mr-list__item">
                        <a class="mr-list__btn <?php if($categoryId == $category->id): ?> active <?php endif; ?>"
                            href="<?php echo e(route('products', $category->id)); ?>"><?php echo e(__($category->name)); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="row g-3 justify-content-center">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                        <div class="product-item h-100">
                            <div class="product-thumb">
                                <img src="<?php echo e(getImage(getFilePath('products') . '/' . $product->thumbnail, getFileSize('products'))); ?>" alt="products">
                                <ul class="product-options">
                                    <li>
                                        <a class="image"
                                            href="<?php echo e(getImage(getFilePath('products') . '/' . $product->thumbnail, getFileSize('products'))); ?>"><i
                                                class="las la-expand"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-content">
                                <h6 class="product-title">
                                    <a
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
            <?php if($products->hasPages()): ?>
                <div class="pagination-wrapper">
                    <?php echo e(paginateLinks($products)); ?>

                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/products.blade.php ENDPATH**/ ?>