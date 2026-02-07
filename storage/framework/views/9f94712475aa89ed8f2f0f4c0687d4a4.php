<?php
    $productContent = getContent('product.content', true);
    $products = App\Models\Product::active()
        ->where('is_featured', Status::YES)
        ->get();
?>

<section class="product-section padding-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section-header text-center">
                    <span class="subtitle"><?php echo e(__(@$productContent->data_values->heading)); ?></span>
                    <h2 class="title"><?php echo e(__(@$productContent->data_values->sub_heading)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
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
    </div>
</section>
<?php /**PATH /home/paheliherbals/public_html/Back/core/resources/views/templates/basic/sections/product.blade.php ENDPATH**/ ?>