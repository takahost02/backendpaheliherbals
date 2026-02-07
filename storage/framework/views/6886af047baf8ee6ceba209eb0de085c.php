<?php $__env->startSection('panel'); ?>
    <form action="<?php echo e(route('admin.product.store')); ?>" method="POST" enctype="multipart/form-data">
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
                                <input class="form-control" name="name" type="text" value="<?php echo e(old('name')); ?>" placeholder="<?php echo app('translator')->get('Name'); ?>"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Categories'); ?> </label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control select2" name="category" required>
                                    <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php if(old('category') == $category->id): echo 'selected'; endif; ?>><?php echo e(__($category->name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Price'); ?> </label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" name="price" type="number" value="<?php echo e(old('price')); ?>" step="any"  placeholder="<?php echo app('translator')->get('Price'); ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Quantity'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" name="quantity" type="number" value="<?php echo e(old('quantity')); ?>" placeholder="<?php echo app('translator')->get('Quantity'); ?>"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('BV'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" name="bv" type="number" value="<?php echo e(old('bv')); ?>" placeholder="<?php echo app('translator')->get('BV'); ?>"
                                    required>
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
                                <label><?php echo app('translator')->get('Product Discription'); ?> </label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control nicEdit" id="my-textarea" name="description" rows="3" required> <?php echo e(old('description')); ?> </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for=""><?php echo app('translator')->get('Product Specifications'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <div id="specification"></div>
                                <div class="row">
                                    <div class="col-lg-10 p-1"><label id="specifications-title"><?php echo app('translator')->get('Add specifications as you want by clicking the (+) button on the right side'); ?></label></div>
                                    <div class="col-lg-2 p-1"><a class="btn btn-outline--success add-specification mb-2"><i
                                                class="la la-plus me-0"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-header font-weight-bold bg--primary"><?php echo app('translator')->get('Product Images'); ?></div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Thumbnail'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <div class="thumbnail-image-box">
                                    <?php if (isset($component)) { $__componentOriginaldbcc027cdd3569f61821c56d10b77c01 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbcc027cdd3569f61821c56d10b77c01 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image-uploader','data' => ['class' => 'w-100','name' => 'thumbnail','type' => 'products','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image-uploader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-100','name' => 'thumbnail','type' => 'products','required' => true]); ?>
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
                                <label><?php echo app('translator')->get('Gallery'); ?></label>
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
                                <input class="form-control" name="meta_title" type="text" value="<?php echo e(old('meta_title')); ?>"
                                    placeholder="<?php echo app('translator')->get('Meta Title'); ?>">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Meta Keyword'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control select2-auto-tokenize" name="meta_keywords[]" data-placeholder="<?php echo app('translator')->get('Separate multiple keywords by ,(comma) or enter key'); ?>"
                                    multiple></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label><?php echo app('translator')->get('Meta Description'); ?> </label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" id="" name="meta_description" placeholder="<?php echo app('translator')->get('Meta Description'); ?>" cols="30" rows="10"><?php echo e(old('meta_description')); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-3">
                <button class="btn btn--primary h-45 w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a class="btn btn-sm btn-outline--dark" href="<?php echo e(route('admin.product.index')); ?>"><i class="las la-undo"></i><?php echo app('translator')->get('Back'); ?></a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/image-uploader.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link href="<?php echo e(asset('assets/admin/css/image-uploader.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function($) {

            $(".add-specification").on('click', function(e) {
                let index = $(document).find(".specification").length;
                index = parseInt(index) + parseInt(1);

                let html = `
           <div class="row mb-2 align-items-center specification">
            <div class="col-lg-5 p-1">
                <input type="text" class="form-control" name="specification[${index}][name]" placeholder="<?php echo app('translator')->get('Enter Specification Name'); ?>">
            </div>
            <div class="col-lg-5 px-1">
                <input type="text" class="form-control" name="specification[${index}][value]" placeholder="<?php echo app('translator')->get('Enter Specification Value'); ?>">
            </div>
            <div class="col-lg-2 p-1 text-right minus-specification">
                <a class="btn btn-outline--danger "><i class="las la-trash-alt me-0"></i></a>
            </div>
        </div>
           `;
                $("#specification").append(html)
                $("#specifications-title").hide()
            })


            $("body").on('click', '.minus-specification', function(e) {
                $(this).closest('.specification').remove()
                $(document).find(".specification").length <= 0 ? $("#specifications-title").show() : "";

            })

            let preloaded = [];

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

<?php $__env->startPush('style'); ?>
    <style>
        .thumbnail-image-box {
            max-width: 300px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/admin/product/create.blade.php ENDPATH**/ ?>