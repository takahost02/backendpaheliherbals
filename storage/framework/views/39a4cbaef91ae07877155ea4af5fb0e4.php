

<?php $__env->startSection('content'); ?>

<?php

 // ===============================
    // SAFE CARRY FORWARD DEFAULT
    // ===============================
    $carryForward = $carryForward ?? [
        'left'  => 0,
        'right' => 0,
    ];
/* ======================================================
   ABSOLUTE SAFE DEFAULTS (NO CONTROLLER DEPENDENCY)
====================================================== */
$bvLeft   = $bvLeft   ?? 0;
$bvRight  = $bvRight  ?? 0;

$firstHalfPair  = $firstHalfPair  ?? 0; // 12 PM
$secondHalfPair = $secondHalfPair ?? 0; // 12 AM

$pairMatch        = $pairMatch ?? ($firstHalfPair + $secondHalfPair);
$binaryCommission = $binaryCommission ?? 0;

/* DAILY CAP */
$dailyCap     = 4;
$remainingCap = max(0, $dailyCap - $pairMatch);

/* POWER LEG */
if ($bvLeft > $bvRight) {
    $powerLeg = 'left';
} elseif ($bvRight > $bvLeft) {
    $powerLeg = 'right';
} else {
    $powerLeg = 'equal';
}

/* MONTHLY PERFORMANCE */
$monthlyPairs  = $monthlyPairs  ?? 0;
$monthlyIncome = $monthlyIncome ?? 0;

/* PREDICTION */
$prediction = $prediction ?? 0;

/* COUNTDOWN */
$nowHour  = now()->hour;
$nextSlot = $nowHour < 12 ? '12:00 PM' : '12:00 AM';
$targetHr = $nowHour < 12 ? 12 : 24;

/* PAID/FREE LOG */
$log = $logs ?? null;
?>

<div class="row g-3">

    
    <div class="col-12 d-flex justify-content-between align-items-center mb-3">

    
    <!--<button type="button"
            class="btn btn-sm btn-outline-primary"
            data-bs-toggle="modal"
            data-bs-target="#binaryRuleModal">
        <?php echo app('translator')->get('View Binary Rules'); ?>
    </button>-->

    
    <?php if(Route::has('user.binary.weekly.pdf')): ?>
        <a href="<?php echo e(route('user.binary.weekly.pdf')); ?>"
           class="btn btn-sm btn-outline-success">
            📤 <?php echo app('translator')->get('Weekly PDF'); ?>
        </a>
    <?php endif; ?>

</div>


    
    <div class="col-12">
        <div class="alert alert-warning text-center">
            ⏳ <strong><?php echo app('translator')->get('Next Matching In'); ?>:</strong>
            <span id="countdownTimer">--:--:--</span><br>
            <small><?php echo app('translator')->get('Next Slot'); ?>: <?php echo e($nextSlot); ?></small>
        </div>
    </div>

    
    <div class="col-12 text-center">
        <h3><?php echo app('translator')->get('My Master Matching Income'); ?></h3>
        <h4 class="text-success"><?php echo e(number_format($binaryCommission,2)); ?></h4>
        <small class="text-muted">
            <?php echo app('translator')->get('Daily Cap: 4 Pairs | 12 PM (2) + 12 AM (2)'); ?>
        </small>
        <hr>
    </div>
                          
                                <!-- Current Balance Card -->
<div class="col-12">
    <div class="card shadow-sm border-0 text-center p-4">
        
        <h6 class="text-muted mb-2"><?php echo app('translator')->get('Current Balance'); ?></h6>

        <!-- Main Balance -->
        <h2 class="fw-bold text-success mb-3">
            <?php echo e(showAmount(auth()->user()->balance)); ?>

        </h2>
        <small class="text-muted">
        <?php echo app('translator')->get('Available for withdrawal'); ?>
    </small>

       

    </div>
</div>



    
    <div class="col-12">
        <div class="alert <?php echo e($remainingCap==0?'alert-danger':'alert-info'); ?> text-center">
            <strong><?php echo app('translator')->get('Remaining Daily Pairs'); ?>:</strong>
            <?php echo e($remainingCap); ?> / <?php echo e($dailyCap); ?>

        </div>
    </div>

    
    <div class="col-md-6">
        <label><?php echo app('translator')->get('12 PM Matching'); ?></label>
        <div class="progress" style="height:20px">
            <div class="progress-bar bg-success"
                 style="width: <?php echo e(min(100, ($firstHalfPair / 2) * 100)); ?>%">
                <?php echo e($firstHalfPair); ?> / 2
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label><?php echo app('translator')->get('12 AM Matching'); ?></label>
        <div class="progress" style="height:20px">
            <div class="progress-bar bg-primary"
                 style="width: <?php echo e(min(100, ($secondHalfPair / 2) * 100)); ?>%">
                <?php echo e($secondHalfPair); ?> / 2
            </div>
        </div>
    </div>

    
    <?php $__currentLoopData = [
        ['Paid Left','success','la-user-check',$log->paid_left??0],
        ['Paid Right','success','la-user-check',$log->paid_right??0],
        ['Free Left','warning','la-user-clock',$log->free_left??0],
        ['Free Right','warning','la-user-clock',$log->free_right??0],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-3">
        <div class="card custom--card text-center">
            <div class="card-body">
                <div class="icon-box bg-<?php echo e($item[1]); ?>"><i class="las <?php echo e($item[2]); ?>"></i></div>
                <h6><?php echo app('translator')->get($item[0]); ?></h6>
                <h4><?php echo e($item[3]); ?></h4>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <div class="col-md-3">
        <div class="card custom--card text-center <?php echo e($powerLeg=='left'?'border-success':''); ?>">
            <div class="card-body">
                <div class="icon-box bg-info"><i class="las la-arrow-left"></i></div>
                <h6><?php echo app('translator')->get('Total BV Left'); ?></h6>
                <h4><?php echo e(number_format($bvLeft,2)); ?></h4>
                <?php if($powerLeg=='left'): ?>
                    <span class="badge bg-success"><?php echo app('translator')->get('Power Leg'); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-md-3">
        <div class="card custom--card text-center <?php echo e($powerLeg=='right'?'border-success':''); ?>">
            <div class="card-body">
                <div class="icon-box bg-info"><i class="las la-arrow-right"></i></div>
                <h6><?php echo app('translator')->get('Total BV Right'); ?></h6>
                <h4><?php echo e(number_format($bvRight,2)); ?></h4>
                <?php if($powerLeg=='right'): ?>
                    <span class="badge bg-success"><?php echo app('translator')->get('Power Leg'); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!--Carry-Forward Card (Visual)-->
    
    <div class="col-md-6">
    <div class="card custom--card text-center">
        <div class="card-body">
            <h6><?php echo app('translator')->get('Carry Forward BV'); ?></h6>

            <?php if($carryForward['left'] > 0): ?>
                <span class="badge bg-success">
                    <?php echo app('translator')->get('BV Left'); ?>: <?php echo e(number_format($carryForward['left'],2)); ?> ||
                     <?php echo app('translator')->get('BV Right : 0'); ?>
                    
                </span>
            <?php elseif($carryForward['right'] > 0): ?>
                <span class="badge bg-success">
                    <?php echo app('translator')->get('BV Right'); ?>: <?php echo e(number_format($carryForward['right'],2)); ?> ||
                    <?php echo app('translator')->get('BV Left : 0'); ?>
                </span>
            <?php else: ?>
                <span class="badge bg-secondary">
                    <?php echo app('translator')->get('No Carry Forward'); ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>


    
    <div class="col-md-3">
        <div class="card custom--card text-center">
            <div class="card-body">
                <div class="icon-box bg-primary"><i class="las la-random"></i></div>
                <h6><?php echo app('translator')->get('Pair Match (Today)'); ?></h6>
                <h4 class="pair-count" data-count="<?php echo e($pairMatch); ?>">0</h4>
            </div>
        </div>
    </div>

    
    <!--<div class="col-md-3">
        <div class="card custom--card text-center border-success">
            <div class="card-body">
                <div class="icon-box bg-success"><i class="las la-money-bill-wave"></i></div>
                <h6><?php echo app('translator')->get('Binary Commission'); ?></h6>
                <h4 class="text-success">₹ <?php echo e(number_format($binaryCommission,2)); ?></h4>
            </div>
        </div>
    </div>-->

    
    <div class="col-md-6">
        <div class="card custom--card text-center">
            <div class="card-body">
                <h6><?php echo app('translator')->get('This Month Performance'); ?></h6>
                <h4><?php echo e($monthlyPairs); ?> <?php echo app('translator')->get('Pairs'); ?></h4>
                <h5 class="text-success"><?php echo e(number_format($monthlyIncome,2)); ?></h5>
            </div>
        </div>
    </div>

    
   <!-- <div class="col-md-6">
        <div class="alert alert-secondary text-center mt-4">
            🧠 <strong><?php echo app('translator')->get('Estimated Tomorrow Matching'); ?>:</strong>
            <?php echo e($prediction); ?> <?php echo app('translator')->get('Pairs'); ?>
        </div>
    </div>-->

</div>


<!--<div class="modal fade" id="binaryRuleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5><?php echo app('translator')->get('Binary Matching Rules'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">✔ 2:1 or 1:2 first match (once)</li>
                    <li class="list-group-item">✔ Then 1:1</li>
                    <li class="list-group-item">✔ 12 PM: 2 pairs</li>
                    <li class="list-group-item">✔ 12 AM: 2 pairs</li>
                    <li class="list-group-item">✔ Daily cap: 4 pairs</li>
                    <li class="list-group-item">✔ Power leg carry forward</li>
                    <li class="list-group-item">✔ Flush after 12 AM</li>
                </ul>
            </div>
        </div>
    </div>
</div>-->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
document.querySelectorAll('.pair-count').forEach(el=>{
    let t=parseInt(el.dataset.count||0),c=0;
    let i=setInterval(()=>{el.innerText=c++; if(c>t)clearInterval(i)},300);
});
(function(){
    let target=new Date(); target.setHours(<?php echo e($targetHr); ?>,0,0,0);
    setInterval(()=>{
        let d=target-new Date(); if(d<=0)return;
        let h=Math.floor(d/36e5),m=Math.floor(d%36e5/6e4),s=Math.floor(d%6e4/1e3);
        document.getElementById('countdownTimer').innerText=`${h}h ${m}m ${s}s`;
    },1000);
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/binarySummery.blade.php ENDPATH**/ ?>