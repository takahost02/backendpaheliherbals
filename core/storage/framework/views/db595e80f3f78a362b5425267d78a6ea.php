<?php
    $serviceContent = getContent('service.content', true);
    $serviceElements = getContent('service.element');
?>

<?php if(!blank(@$serviceElements)): ?>
    <section class="service-section padding-bottom pos-rel">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section-header text-center">
                        <span class="subtitle"><?php echo e(__(@$serviceContent->data_values->heading)); ?></span>
                        <h2 class="title"><?php echo e(__(@$serviceContent->data_values->sub_heading)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row gy-4 justify-content-center">

                <?php $__currentLoopData = $serviceElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceSectionElement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="service-item">
                            <div class="service-icon"><?php echo @$serviceSectionElement->data_values->icon ?></div>
                            <div class="service-content">
                                <h4 class="title"><?php echo e(__(@$serviceSectionElement->data_values->title)); ?></h4>
                                <p><?php echo e(__(@$serviceSectionElement->data_values->description)); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH /home/paheliherbals/backend.paheliherbals.com/core/resources/views/templates/basic/sections/service.blade.php ENDPATH**/ ?>