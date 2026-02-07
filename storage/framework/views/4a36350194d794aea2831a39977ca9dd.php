

<?php $__env->startPush('style'); ?>
<style>
.welcome-wrapper {
    max-width: 900px;
    margin: auto;
}

.welcome-header {
    background: linear-gradient(135deg, #0d6efd, #198754);
    color: #fff;
    padding: 5px;
    border-radius: 6px 6px 0 0;
}

.welcome-body {
    background: #ffffff;
    padding: 35px;
    border-radius: 0 0 16px 16px;
    box-shadow: 0 15px 40px rgba(0,0,0,.08);
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
    gap: 15px;
    margin: 25px 0;
}

.info-box {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 15px;
    border-left: 5px solid #0d6efd;
}

.signature {
    margin-top: 40px;
}

.action-bar {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 20px;
}

@media (max-width: 576px) {
    .action-bar {
        flex-direction: column;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="welcome-wrapper">

    <!-- ACTION BUTTONS -->
    <!--<div class="action-bar">-->
        <!--<a href="javascript:void(0)" onclick="downloadLetter()" class="btn btn-outline-primary">
            <i class="las la-file-download"></i> <?php echo app('translator')->get('Download PDF'); ?>
        </a>-->
            <!--<a href="<?php echo e(route('user.welcome.letter.pdf')); ?>"
       class="btn btn-outline-primary">
        <i class="las la-file-pdf"></i> Download PDF
    </a>-->


        <!--<button onclick="window.print()" class="btn btn-outline-secondary">
            <i class="las la-print"></i> <?php echo app('translator')->get('Print'); ?>
        </button>
    </div>-->

    <!-- LETTER CARD -->
    <center><img src="/assets/images/logoIcon/logo_dark.png" alt="" width="400" height="200">
     <p class="mb-0 opacity-75"><?php echo app('translator')->get('A/174, H.B.Town,Road No.5,sodepur,Kolkata • 70011O | info@paheliherbal.com'); ?></p></center> <br>
    <div class="welcome-header">
        
        <!--<h3 class="mb-1"><?php echo app('translator')->get('Welcome to Paheli Herbals'); ?></h3>-->
       <!-- <p class="mb-0 opacity-75"><?php echo app('translator')->get('Official Welcome Letter'); ?></p>-->
    </div>

    <div class="welcome-body">
        <center><img src="/welcome_PNG41.png" alt="Girl in a jacket" width="400" height="200"></center>

        <p class="fs-5">
            <?php echo app('translator')->get('Dear'); ?> <strong><?php echo e($user->fullname); ?></strong>,
        </p>

        <p>
            <?php echo app('translator')->get('<strong>Congratulations !!</strong> We are pleased to welcome you to Paheli Herbal’s Marketing Pvt. Ltd. Your decision to join us marks the beginning of a rewarding journey toward growth, success, and financial independence.'); ?>
        </p>

        <p>
            <?php echo app('translator')->get('Your account has been successfully created and activated. Please find your joining details below:'); ?>
        </p>

        <!-- USER INFO -->
        <div class="info-grid">
            <div class="info-box">
                <small class="text-muted"><?php echo app('translator')->get('Username'); ?></small>
                <div class="fw-bold"><?php echo e($user->username); ?></div>
                
                <small class="text-muted"><?php echo app('translator')->get('Email'); ?></small>
                <div class="fw-bold"><?php echo e($user->email); ?></div>
                
                <small class="text-muted"><?php echo app('translator')->get('Mobile'); ?></small>
                <div class="fw-bold"><?php echo e($user->mobile); ?></div>
            </div>

            <div class="info-box">
                <small class="text-muted"><?php echo app('translator')->get('Address'); ?></small>
                <div class="fw-bold"><?php echo e($user->address); ?>,<?php echo e($user->city); ?>,<?php echo e($user->state); ?> ,<?php echo e($user->zip); ?></div>
                
                
                <small class="text-muted"><?php echo app('translator')->get('Joining Date'); ?></small>
                <div class="fw-bold"><?php echo e(showDateTime($user->created_at)); ?></div>
            </div>

            <div class="info-box">
                <small class="text-muted"><?php echo app('translator')->get('Current Plan'); ?></small>
                <div class="fw-bold">
                    <?php echo e(optional($user->plan)->name ?? __('N/A')); ?>

                </div>
            </div>
        </div>

        <p>
            <?php echo app('translator')->get('We encourage you to explore your dashboard, understand the compensation structure, and actively participate in our programs. Our support team is always available to assist you.'); ?>
        </p>

        <p>
            <?php echo app('translator')->get('We wish you great success and long-term growth with Paheli Herbals.'); ?>
        </p>

        <!-- SIGNATURE -->
        <div class="signature">
            <p class="mb-1"><?php echo app('translator')->get('Warm Regards'); ?>,</p>
            <img src="/signature.png" alt="" width="300" height="100"> <br>
            <!--<strong><?php echo e(config('app.name')); ?></strong><br>-->
            <span class="text-muted"><?php echo app('translator')->get('Authorized Management'); ?></span>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
function downloadLetter() {
    const element = document.createElement('a');
    const content = document.documentElement.outerHTML;
    const file = new Blob([content], {type: 'text/html'});
    element.href = URL.createObjectURL(file);
    element.download = "Welcome_Letter.html";
    element.click();
}
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/user/welcome_letter.blade.php ENDPATH**/ ?>