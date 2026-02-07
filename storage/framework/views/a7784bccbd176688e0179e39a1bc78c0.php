<?php
    $legalContent = getContent('legal.content', true);
    $galleryItems = [];

    if (!empty($legalContent->data_values)) {
        for ($i = 1; $i <= 12; $i++) {
            $field = 'gallery_image_' . $i;
            if (!empty($legalContent->data_values->$field)) {
                $galleryItems[] = $legalContent->data_values->$field;
            }
        }
    }
?>

<?php if(!blank($galleryItems)): ?>
    <section class="legal-gallery-section py-5 position-relative">
        <div class="container">
            <div class="row justify-content-center g-4">
                <?php $__currentLoopData = $galleryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card gallery-card h-100 overflow-hidden d-flex align-items-center justify-content-center">
                            <a href="<?php echo e(getImage('assets/images/frontend/legal/' . $item)); ?>"
                               data-lightbox="legal-gallery"
                               class="d-block w-100 text-center">
                                <img src="<?php echo e(getImage('assets/images/frontend/legal/' . $item)); ?>"
                                     alt="Gallery Item"
                                     class="img-fluid gallery-image">
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="shape shape1 position-absolute top-0 start-0 z-n1">
            <img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/circle-triangle.png')); ?>" alt="shape">
        </div>
        <div class="shape shape2 position-absolute bottom-0 end-0 z-n1">
            <img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/circle-big.png')); ?>" alt="shape">
        </div>
    </section>

    
   <?php $__env->startPush('style'); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
    <style>
        .legal-gallery-section {
            background: linear-gradient(to bottom, #f8f9fa, #ffffff);
            border-top: 4px solid #0d6efd;
            border-bottom: 4px solid #198754;
        }

        .gallery-card {
            border: 2px solid #0d6efd;
            border-radius: 12px;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .gallery-card:hover {
            border-color: #198754;
            box-shadow: 0 4px 20px rgba(0, 123, 255, 0.2);
            transform: translateY(-6px);
        }

        .gallery-image {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            border-radius: 8px;
            border: 2px solid #dee2e6;
            transition: border-color 0.3s ease;
        }

        .gallery-image:hover {
            border-color: #0d6efd;
        }

        /* --- Custom Lightbox Controls --- */
        .lightbox .lb-nav a.lb-prev,
        .lightbox .lb-nav a.lb-next,
        .lightbox .lb-close {
            filter: invert(31%) sepia(85%) saturate(5683%) hue-rotate(206deg) brightness(95%) contrast(90%);
        }

        .lightbox .lb-close {
            top: 10px;
            right: 10px;
        }

        .lightbox .lb-prev:hover,
        .lightbox .lb-next:hover,
        .lightbox .lb-close:hover {
            filter: brightness(150%);
        }
    </style>
<?php $__env->stopPush(); ?>


    <?php $__env->startPush('script'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/sections/legal.blade.php ENDPATH**/ ?>