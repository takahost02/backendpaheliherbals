<?php $__env->startSection('panel'); ?>
    <form action="<?php echo e(route('admin.product.update', @$product->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header font-weight-bold bg--primary"><?php echo app('translator')->get('Product Basic Information'); ?></div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Product Name'); ?> </label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" name="name" type="text" value="<?php echo e(@$product->name); ?>" placeholder="Name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Categories'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control select2" name="category" required>
                                    <option disabled><?php echo app('translator')->get('Please Select One'); ?></option>
                                    <?php $__currentLoopData = @$categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php if($category->id == $product->category_id): ?> selected <?php endif; ?>><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Price'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" name="price" type="number" value="<?php echo e(getAmount($product->price)); ?>" step="any" placeholder="Price" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Quantity'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" name="quantity" type="number" value="<?php echo e(@$product->quantity); ?>" placeholder="Quantity" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('BV'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" name="bv" type="number" value="<?php echo e($product->bv); ?>" placeholder="<?php echo app('translator')->get('BV'); ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-header font-weight-bold bg--primary"><?php echo app('translator')->get('Product Description'); ?></div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Product Discription'); ?> <strong class="text-danger">*</strong> </label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control nicEdit" id="my-textarea" name="description" rows="3"><?php echo e(@$product->description); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for=""><?php echo app('translator')->get('Product Specifications'); ?></label>
                            </div>
                            <div class="col-10">
                                <div id="specification">
                                    <?php $__currentLoopData = @$product->specifications ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $specification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row specification align-items-center mb-2">
                                            <div class="col-lg-5 p-1">
                                                <input class="form-control" name="specification[<?php echo e($k); ?>][name]" type="text" value="<?php echo e(@$specification['name']); ?>" placeholder="<?php echo app('translator')->get('Enter Specification Name'); ?>">
                                            </div>
                                            <div class="col-lg-5 p-1">
                                                <input class="form-control" name="specification[<?php echo e($k); ?>][value]" type="text" value="<?php echo e(@$specification['value']); ?>" placeholder="<?php echo app('translator')->get('Enter Specification Value'); ?>">
                                            </div>
                                            <div class="col-lg-2 minus-specification p-1 text-right">
                                                <a class="btn btn-outline--danger"><i class="las la-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="row p-0">
                                    <div class="col-lg-10 p-1"><label class="<?php echo e($product->specifications ? 'd-none' : ''); ?>" id="specifications-title"><?php echo app('translator')->get('Add specifications as you want by clicking the (+) button on the right side'); ?></label></div>
                                    <div class="col-lg-2 p-1"><a class="btn btn--success add-specification mb-2"><i class="la la-plus"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-header font-weight-bold bg--primary"><?php echo app('translator')->get('Product Image'); ?></div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Thumbnail'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <div class="thumbnail-image-box">
                                    <?php if (isset($component)) { $__componentOriginaldbcc027cdd3569f61821c56d10b77c01 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbcc027cdd3569f61821c56d10b77c01 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image-uploader','data' => ['class' => 'w-100','name' => 'thumbnail','type' => 'products','image' => ''.e($product->thumbnail).'','required' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image-uploader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-100','name' => 'thumbnail','type' => 'products','image' => ''.e($product->thumbnail).'','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldbcc027cdd3569f61821c56d10b77c01)): ?>
<?php $attributes = $__attributesOriginaldbcc027cdd3569f61821c56d10b77c01; ?>
<?php unset($__attributesOriginaldbcc027cdd3569f61821c56d10b77c01); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldbcc027cdd3569f61821c56d10b77c01)): ?>
<?php $component = $__componentOriginaldbcc027cdd3569f61821c56d10b77c01; ?>
<?php unset($__componentOriginaldbcc027cdd3569f61821c56d10b77c01); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="font-weight-bold" for=""><?php echo app('translator')->get('Gallery'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <div class="input-images"></div>
                                <div class="mt-1">
                                    <small class="text-muted">
                                        <?php echo app('translator')->get('Supported Files:'); ?>
                                        <b><?php echo app('translator')->get('.png, .jpg, .jpeg'); ?></b>
                                        <?php echo app('translator')->get('& you can upload maximum '); ?> <b><?php echo app('translator')->get('10'); ?></b> <?php echo app('translator')->get('images'); ?>.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-header font-weight-bold bg--primary"><?php echo app('translator')->get('SEO Contents'); ?></div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Meta Ttitle'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" name="meta_title" type="text" value="<?php echo e(@$product->meta_title); ?>" placeholder="Meta Title">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Meta Keyword'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control select2-auto-tokenize" name="meta_keywords[]" data-placeholder="<?php echo app('translator')->get('Separate multiple keywords by ,(comma) or enter key'); ?>" multiple>
                                    <?php if(@$product->meta_keyword && !empty(@$product->meta_keyword)): ?>
                                        <?php $__currentLoopData = @$product->meta_keyword; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($keyword); ?>" selected><?php echo e($keyword); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Meta Description'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="meta_description" name="meta_description" placeholder="<?php echo app('translator')->get('Meta Description'); ?>" cols="30" rows="10"><?php echo e(@$product->meta_description); ?></textarea>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-3">
                <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Update'); ?></button>
            </div>

        </div>

    </form>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginal3b9bf6c313f6db4d5c9389e5666c89a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b9bf6c313f6db4d5c9389e5666c89a5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.product.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.product.index')).'']); ?>
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

            $(".add-specification").on('click', function(e) {
                let index = $(document).find(".specification").length;
                index = parseInt(index) + parseInt(1);

                let html = `
                    <div class="row align-items-center mb-2 specification">
                        <div class="col-lg-5 p-1">
                            <input type="text" class="form-control" name="specification[${index}][name]" placeholder="<?php echo app('translator')->get('Enter Specification Name'); ?>">
                        </div>
                        <div class="col-lg-5 p-1">
                            <input type="text" class="form-control" name="specification[${index}][value]" placeholder="<?php echo app('translator')->get('Enter Specification Value'); ?>">
                        </div>
                        <div class="col-lg-2 text-right minus-specification p-1">
                            <a class="btn btn-outline--danger "><i class="las la-trash-alt"></i></a>
                        </div>
                    </div>
                `;
                $("#specification").append(html)
                $("#specifications-title").hide()
            })


            $("body").on('click', '.minus-specification', function(e) {
                $(this).closest('.specification').remove();
                $(document).find(".specification").length <= 0 ? $("#specifications-title").show() : "";

            })

            $(document).on('click', '.removeBtn', function() {
                $(this).closest('.__gallery_image').remove();
            });

            $('select[name=featured]').val(<?php echo e($product->is_featured); ?>);


            // image uploder
            <?php if(isset($images)): ?>
                let preloaded = <?php echo json_encode($images, 15, 512) ?>;
            <?php else: ?>
                let preloaded = [];
            <?php endif; ?>

            $('.input-images').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'gallery',
                preloadedInputName: 'old',
                maxSize: 3 * 1024 * 1024,
                maxFiles: 10,
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/image-uploader.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link href="<?php echo e(asset('assets/admin/css/image-uploader.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .profilePicUpload {
            height: 0px;
            padding: 0px;
        }

        .__gallery_image .form-group {
            position: relative;
        }

        .removeBtn {
            position: absolute;
            z-index: 99;
            top: 3px;
            right: 3px;
            border-radius: 5px;
        }

        .thumbnail-image-box {
            max-width: 300px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/admin/product/edit.blade.php ENDPATH**/ ?>