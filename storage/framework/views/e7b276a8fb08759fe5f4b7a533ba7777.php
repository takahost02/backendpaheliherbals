<?php echo $__env->make($activeTemplate.'partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('content'); ?>
    <?php
        $contactContent = getContent('contact_us.content', true);
        $contactElement = getContent('contact_us.element');
    ?>

    <section class="contact-section padding-top padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="contact-thumb rtl">
                        <img src="<?php echo e(frontendImage('contact_us', @$contactContent->data_values->image, '700x600')); ?>" alt="thumb">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form-wrapper">
                        <h3 class="title"><?php echo e(__(@$contactContent->data_values->title)); ?></h3>
                        <form class="contact-form verify-gcaptcha" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form--group">
                                <label class="form--label"><?php echo app('translator')->get('Name'); ?></label>
                                <input class="form--control" name="name" type="text" value="<?php echo e(old('name', @$user->fullname)); ?>"
                                    placeholder="<?php echo app('translator')->get('Enter Your Full Name'); ?>" <?php if($user && $user->profile_complete): ?> readonly <?php endif; ?> required>
                            </div>
                            <div class="form--group">
                                <label class="form--label"><?php echo app('translator')->get('Email Address'); ?></label>
                                <input class="form--control" name="email" type="email" value="<?php echo e(old('email', @$user->email)); ?>"
                                    placeholder="<?php echo app('translator')->get('Enter Your Email Address'); ?>" <?php if($user): ?> readonly <?php endif; ?> required>
                            </div>
                            <div class="form--group">
                                <label class="form--label"><?php echo app('translator')->get('Subject'); ?></label>
                                <input class="form--control" name="subject" type="text" value="<?php echo e(old('subject')); ?>" placeholder="<?php echo app('translator')->get('Enter Your Subject'); ?>"
                                    required>
                            </div>
                            <div class="form--group">
                                <label class="form--label" for="msg"><?php echo app('translator')->get('Your Message'); ?></label>
                                <textarea class="form--control" id="msg" name="message" placeholder="<?php echo app('translator')->get('Enter Your Message'); ?>" required><?php echo e(old('message')); ?></textarea>
                            </div>
                            <?php
                                $custom = true;
                            ?>
                            <?php if (isset($component)) { $__componentOriginalff0a9fdc5428085522b49c68070c11d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff0a9fdc5428085522b49c68070c11d6 = $attributes; } ?>
<?php $component = App\View\Components\Captcha::resolve(['custom' => $custom] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Captcha::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $attributes = $__attributesOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $component = $__componentOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__componentOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>
                            <div class="form--group">
                                <button class="btn btn--base w-100" type="submit"><?php echo app('translator')->get('Send Us Message'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-info padding-bottom">
        <div class="shape shape1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/shape/all-shape.png')); ?>" alt="shape"></div>
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-lg-6 col-xl-5">
                    <div class="contact-info-wrapper row gy-4 justify-content-center">
                        <?php $__currentLoopData = $contactElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $information): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-12 col-md-6 col-sm-10">
                                <div class="contact-info-item">
                                    <div class="thumb"><img src="<?php echo e(frontendImage('contact_us', $information->data_values->image)); ?>" alt="icon">
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><?php echo e(__(@$information->data_values->title)); ?> :</h5>
                                        <span><?php echo e(__(@$information->data_values->content)); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-7">
                    <div class="map-wrapper">
                        <iframe class="map" src="<?php echo e(__(@$contactContent->data_values->map_iframe_url)); ?>" style="border:0;" allowfullscreen=""
                            loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if(@$sections->secs != null): ?>
        <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($activeTemplate . 'sections.' . $sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/contact.blade.php ENDPATH**/ ?>