<?php

    $worksContent = getContent('how_it_works.content', true);
    $worksElements = getContent('how_it_works.element');
?>

<?php if(!blank($worksContent)): ?>
    <section class="work-section padding-bottom pos-rel">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section-header text-center">
                        <span class="subtitle"><?php echo e(__(@$worksContent->data_values->heading)); ?></span>
                        <h2 class="title"><?php echo e(__(@$worksContent->data_values->sub_heading)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row gy-5">

                <?php if(@$worksElements && !empty($worksElements->toArray())): ?>
                    <?php $__currentLoopData = @$worksElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $worksSectionElement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="work-item">
                                <div class="work-icon"><?php echo @$worksSectionElement->data_values->icon ?></div>
                                <div class="work-content">
                                    <h4 class="title"><?php echo e(__(@$worksSectionElement->data_values->title)); ?></h4>
                                    <p><?php echo e(__(@$worksSectionElement->data_values->description)); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

            </div>
        </div>
        <div class="shape shape1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/circle-big.png')); ?>" alt="shape"></div>
    </section>

<?php endif; ?>
<?php /**PATH /home/paheliherbals/backoffice.paheliherbals.com/core/resources/views/templates/basic/sections/how_it_works.blade.php ENDPATH**/ ?>