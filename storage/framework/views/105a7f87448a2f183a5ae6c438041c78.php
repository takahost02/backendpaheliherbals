<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-12">
            <div class="row gy-4">
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(showAmount($user->balance)).'','title' => 'Balance','style' => '7','link' => ''.e(route('admin.report.transaction', $user->id)).'','icon' => 'las la-money-bill-wave-alt','bg' => 'indigo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(showAmount($user->balance)).'','title' => 'Balance','style' => '7','link' => ''.e(route('admin.report.transaction', $user->id)).'','icon' => 'las la-money-bill-wave-alt','bg' => 'indigo']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(showAmount($totalIncome)).'','title' => 'Income','style' => '7','link' => ''.e(route('admin.report.transaction', $user->id)).'','icon' => 'las la-money-bill-wave-alt','bg' => 'indigo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(showAmount($totalIncome)).'','title' => 'Income','style' => '7','link' => ''.e(route('admin.report.transaction', $user->id)).'','icon' => 'las la-money-bill-wave-alt','bg' => 'indigo']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(showAmount($totalDeposit)).'','title' => 'Deposits','style' => '7','link' => ''.e(route('admin.deposit.list', $user->id)).'','icon' => 'las la-wallet','bg' => '8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(showAmount($totalDeposit)).'','title' => 'Deposits','style' => '7','link' => ''.e(route('admin.deposit.list', $user->id)).'','icon' => 'las la-wallet','bg' => '8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(showAmount($totalWithdrawals)).'','title' => 'Withdrawals','style' => '7','link' => ''.e(route('admin.withdraw.data.all', $user->id)).'','icon' => 'la la-bank','bg' => '6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(showAmount($totalWithdrawals)).'','title' => 'Withdrawals','style' => '7','link' => ''.e(route('admin.withdraw.data.all', $user->id)).'','icon' => 'la la-bank','bg' => '6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e($totalTransaction).'','title' => 'Transactions','style' => '7','link' => ''.e(route('admin.report.transaction', $user->id)).'','icon' => 'las la-exchange-alt','bg' => '17']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e($totalTransaction).'','title' => 'Transactions','style' => '7','link' => ''.e(route('admin.report.transaction', $user->id)).'','icon' => 'las la-exchange-alt','bg' => '17']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(showAmount($user->total_invest)).'','title' => 'Total Invest','style' => '7','link' => ''.e(route('admin.report.invest', $user->id)).'','icon' => 'la la-money','bg' => '17']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(showAmount($user->total_invest)).'','title' => 'Total Invest','style' => '7','link' => ''.e(route('admin.report.invest', $user->id)).'','icon' => 'la la-money','bg' => '17']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(showAmount($user->total_ref_com)).'','title' => 'Total Referral Commission','style' => '7','link' => ''.e(route('admin.report.referral.commission', $user->id)).'','icon' => 'la la-user','bg' => '2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(showAmount($user->total_ref_com)).'','title' => 'Total Referral Commission','style' => '7','link' => ''.e(route('admin.report.referral.commission', $user->id)).'','icon' => 'la la-user','bg' => '2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(showAmount($user->total_binary_com)).'','title' => 'Total Binary Commission','style' => '7','link' => ''.e(route('admin.report.binary.commission', $user->id)).'','icon' => 'la la-tree','bg' => '2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(showAmount($user->total_binary_com)).'','title' => 'Total Binary Commission','style' => '7','link' => ''.e(route('admin.report.binary.commission', $user->id)).'','icon' => 'la la-tree','bg' => '2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(showAmount($user->total_level_com)).'','title' => 'Total Level Commission','style' => '7','link' => ''.e(route('admin.report.binary.commission', $user->id)).'','icon' => 'la la-tree','bg' => '2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(showAmount($user->total_level_com)).'','title' => 'Total Level Commission','style' => '7','link' => ''.e(route('admin.report.binary.commission', $user->id)).'','icon' => 'la la-tree','bg' => '2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(showAmount($user->total_repurchase_com)).'','title' => 'Total Repurchase Commission','style' => '7','link' => ''.e(route('admin.report.binary.commission', $user->id)).'','icon' => 'la la-tree','bg' => '2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(showAmount($user->total_repurchase_com)).'','title' => 'Total Repurchase Commission','style' => '7','link' => ''.e(route('admin.report.binary.commission', $user->id)).'','icon' => 'la la-tree','bg' => '2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(showAmount($user->total_royalty_com)).'','title' => 'Total Royalty Commission','style' => '7','link' => ''.e(route('admin.report.binary.commission', $user->id)).'','icon' => 'la la-tree','bg' => '2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(showAmount($user->total_royalty_com)).'','title' => 'Total Royalty Commission','style' => '7','link' => ''.e(route('admin.report.binary.commission', $user->id)).'','icon' => 'la la-tree','bg' => '2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(getAmount($totalBvCut)).'','title' => 'Total Cut BV','style' => '7','link' => ''.e(route('admin.report.bvLog', $user->id)).'?type=cutBV','icon' => 'la la-cut','bg' => '4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(getAmount($totalBvCut)).'','title' => 'Total Cut BV','style' => '7','link' => ''.e(route('admin.report.bvLog', $user->id)).'?type=cutBV','icon' => 'la la-cut','bg' => '4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e($user->level).'','title' => 'User Level','style' => '7','link' => ''.e(route('admin.users.detail', $user->id)).'','icon' => 'la la-signal','bg' => '4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e($user->level).'','title' => 'User Level','style' => '7','link' => ''.e(route('admin.users.detail', $user->id)).'','icon' => 'la la-signal','bg' => '4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(getAmount(optional($user->userExtra)->bv_left ?? 0)).'','title' => 'Left BV','style' => '7','link' => ''.e(route('admin.report.bvLog', $user->id)).'?type=leftBV','icon' => 'las la-arrow-alt-circle-left','bg' => '1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(getAmount(optional($user->userExtra)->bv_left ?? 0)).'','title' => 'Left BV','style' => '7','link' => ''.e(route('admin.report.bvLog', $user->id)).'?type=leftBV','icon' => 'las la-arrow-alt-circle-left','bg' => '1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(getAmount(optional($user->userExtra)->bv_right ?? 0)).'','title' => 'Right BV','style' => '7','link' => ''.e(route('admin.report.bvLog', $user->id)).'?type=rightBV','icon' => 'las la-arrow-alt-circle-right','bg' => '13']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(getAmount(optional($user->userExtra)->bv_right ?? 0)).'','title' => 'Right BV','style' => '7','link' => ''.e(route('admin.report.bvLog', $user->id)).'?type=rightBV','icon' => 'las la-arrow-alt-circle-right','bg' => '13']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e(getAmount((optional($user->userExtra)->bv_left ?? 0) + (optional($user->userExtra)->bv_right ?? 0))).'','title' => 'Total BV','style' => '7','link' => ''.e(route('admin.report.bvLog', $user->id)).'','icon' => 'las la-arrow-alt-circle-right','bg' => '14']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e(getAmount((optional($user->userExtra)->bv_left ?? 0) + (optional($user->userExtra)->bv_right ?? 0))).'','title' => 'Total BV','style' => '7','link' => ''.e(route('admin.report.bvLog', $user->id)).'','icon' => 'las la-arrow-alt-circle-right','bg' => '14']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>

                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e($totalOrder).'','title' => 'Total Orders','style' => '7','link' => ''.e(route('admin.order.index', $user->id)).'','icon' => 'las la-question-circle','bg' => '16']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e($totalOrder).'','title' => 'Total Orders','style' => '7','link' => ''.e(route('admin.order.index', $user->id)).'','icon' => 'las la-question-circle','bg' => '16']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['type' => '2','value' => ''.e($totalMyUpline).'','title' => 'Total Upline','style' => '7','link' => ''.e(route('admin.report.myupline', $user->id)).'','icon' => 'las la-users','bg' => '16']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => '2','value' => ''.e($totalMyUpline).'','title' => 'Total Upline','style' => '7','link' => ''.e(route('admin.report.myupline', $user->id)).'','icon' => 'las la-users','bg' => '16']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $attributes = $__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__attributesOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9)): ?>
<?php $component = $__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9; ?>
<?php unset($__componentOriginal433d6a5be5b58ac8aa6a74031c6196f9); ?>
<?php endif; ?>
                </div>

            </div>

            <div class="d-flex mt-4 flex-wrap gap-3">
                <div class="flex-fill">
                    <button class="btn btn--success btn--shadow w-100 btn-lg bal-btn" data-bs-toggle="modal" data-bs-target="#addSubModal" data-act="add">
                        <i class="las la-plus-circle"></i> <?php echo app('translator')->get('Balance'); ?>
                    </button>
                </div>

                <div class="flex-fill">
                    <button class="btn btn--danger btn--shadow w-100 btn-lg bal-btn" data-bs-toggle="modal" data-bs-target="#addSubModal" data-act="sub">
                        <i class="las la-minus-circle"></i> <?php echo app('translator')->get('Balance'); ?>
                    </button>
                </div>

                <div class="flex-fill">
                    <a class="btn btn--primary btn--shadow w-100 btn-lg" href="<?php echo e(route('admin.report.login.history')); ?>?search=<?php echo e($user->username); ?>">
                        <i class="las la-list-alt"></i><?php echo app('translator')->get('Logins'); ?>
                    </a>
                </div>

                <div class="flex-fill">
                    <a class="btn btn--secondary btn--shadow w-100 btn-lg" href="<?php echo e(route('admin.users.notification.log', $user->id)); ?>">
                        <i class="las la-bell"></i><?php echo app('translator')->get('Notifications'); ?>
                    </a>
                </div>

                <?php if($user->kyc_data): ?>
                    <div class="flex-fill">
                        <a class="btn btn--dark btn--shadow w-100 btn-lg" href="<?php echo e(route('admin.users.kyc.details', $user->id)); ?>" target="_blank">
                            <i class="las la-user-check"></i><?php echo app('translator')->get('KYC Data'); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="flex-fill">
                    <?php if($user->status == Status::USER_ACTIVE): ?>
                        <button class="btn btn--warning btn--shadow w-100 btn-lg userStatus" data-bs-toggle="modal" data-bs-target="#userStatusModal" type="button">
                            <i class="las la-ban"></i><?php echo app('translator')->get('Ban User'); ?>
                        </button>
                    <?php else: ?>
                        <button class="btn btn--success btn--shadow w-100 btn-lg userStatus" data-bs-toggle="modal" data-bs-target="#userStatusModal" type="button">
                            <i class="las la-undo"></i><?php echo app('translator')->get('Unban User'); ?>
                        </button>
                    <?php endif; ?>
                </div>

                <div class="flex-fill">
                    <a class="btn btn--primary btn--shadow btn-block w-100 btn-lg" href="<?php echo e(route('admin.users.other.tree', $user->username)); ?>">
                        <?php echo app('translator')->get('User Tree'); ?>
                    </a>
                </div>
                <div class="flex-fill">
                    <a class="btn btn--info btn--shadow btn-block btn-lg w-100" href="<?php echo e(route('admin.users.referral', $user->id)); ?>">
                        <?php echo app('translator')->get('User Referrals'); ?>
                    </a>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-md-5 col-xxl-4">
                    <div class="card mt-30">
                        <div class="card-body p-0">
                            <div class="bg--white p-3">
                                <div class="profile-info-top">
                                    <div class="profile-image">
                                        <img id="output"
                                            src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $user->image, null, true)); ?>"
                                            alt="image">
                                    </div>

                                    <div class="plan-info">
                                        <p class="plan-info-name">
                                            <span><?php echo app('translator')->get('Current plan'); ?></span>
                                            <?php if($user->plan->name ?? false): ?>
                                            <strong class="text--success"><?php echo e(__($user->plan->name)); ?></strong>
                                            <?php else: ?>
                                            <strong class="text-danger"><?php echo app('translator')->get('N/A'); ?></strong>
                                            <?php endif; ?>
                                        </p>

                                    </div>
                                </div>
                                <ul class="list-group mt-3">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span><?php echo app('translator')->get('Name'); ?></span> <?php echo e(__($user->fullname)); ?>

                                    </li>
                                    <li class="list-group-item rounded-0 d-flex justify-content-between">
                                        <span><?php echo app('translator')->get('Username'); ?></span> <?php echo e($user->username); ?>

                                    </li>
                                    <li class="list-group-item rounded-0 d-flex justify-content-between">
                                        <span><?php echo app('translator')->get('Email'); ?></span> <?php echo e($user->email); ?>

                                    </li>
                                    <li class="list-group-item rounded-0 d-flex justify-content-between">
                                        <span><?php echo app('translator')->get('Mobile Number'); ?></span> <?php echo e($user->dial_code); ?><?php echo e($user->mobile); ?>

                                    </li>
                                    <li class="list-group-item rounded-0 d-flex justify-content-between">
                                        <span><?php echo app('translator')->get('Ref By'); ?></span> <a href="<?php echo e(route('admin.users.detail', @$user->refBy->id)); ?>"><?php echo e('@'.@$user->refBy->username ?? 'N/A'); ?></a>
                                    </li>
                                    <li class="list-group-item rounded-0 d-flex justify-content-between">
                                        <span><?php echo app('translator')->get('Paid Left User '); ?></span> <?php echo e($user->userExtra->paid_left ?? 0); ?>

                                    </li>
                                    <li class="list-group-item rounded-0 d-flex justify-content-between">
                                        <span><?php echo app('translator')->get('Paid Right User '); ?></span><?php echo e($user->userExtra->paid_right ?? 0); ?>

                                    </li>
                                    <li class="list-group-item rounded-0 d-flex justify-content-between">
                                        <span><?php echo app('translator')->get('Free Left User'); ?></span><?php echo e($user->userExtra->free_left ?? 0); ?>

                                    </li>
                                    <li class="list-group-item rounded-0 d-flex justify-content-between">
                                        <span><?php echo app('translator')->get('Free Right User'); ?></span><?php echo e($user->userExtra->free_right ?? 0); ?>

                                    </li>

                                    <li class="list-group-item d-flex justify-content-between">
                                        <span><?php echo app('translator')->get('Joined at'); ?></span> <?php echo e(showDateTime($user->created_at)); ?>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7 col-xxl-8">
                    <div class="card mt-30">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><?php echo app('translator')->get('Information of'); ?> <?php echo e($user->fullname); ?></h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.users.update', [$user->id])); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('First Name'); ?></label>
                                            <input class="form-control" name="firstname" type="text"
                                                value="<?php echo e($user->firstname); ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><?php echo app('translator')->get('Last Name'); ?></label>
                                            <input class="form-control" name="lastname" type="text"
                                                value="<?php echo e($user->lastname); ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Email'); ?> </label>
                                            <input class="form-control" name="email" type="email"
                                                value="<?php echo e($user->email); ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Mobile Number'); ?> </label>
                                            <div class="input-group">
                                                <span class="input-group-text mobile-code">+<?php echo e($user->dial_code); ?></span>
                                                <input class="form-control checkUser" id="mobile" name="mobile"
                                                    type="number" value="<?php echo e($user->mobile); ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Address'); ?></label>
                                            <input class="form-control" name="address" type="text"
                                                value="<?php echo e(@$user->address); ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-6 col-xxl-3">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('City'); ?></label>
                                            <input class="form-control" name="city" type="text"
                                                value="<?php echo e(@$user->city); ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-6 col-xxl-3">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('State'); ?></label>
                                            <input class="form-control" name="state" type="text"
                                                value="<?php echo e(@$user->state); ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-6 col-xxl-3">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Zip/Postal'); ?></label>
                                            <input class="form-control" name="zip" type="text"
                                                value="<?php echo e(@$user->zip); ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-6 col-xxl-3">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Country'); ?> <span class="text--danger">*</span></label>
                                            <select class="form-control select2" name="country">
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option data-mobile_code="<?php echo e($country->dial_code); ?>"
                                                        value="<?php echo e($key); ?>" <?php if($user->country_code == $key): echo 'selected'; endif; ?>>
                                                        <?php echo e(__($country->country)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xxl-3">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Email Verification'); ?></label>
                                            <input name="ev" data-width="100%" data-onstyle="-success"
                                                data-offstyle="-danger" data-bs-toggle="toggle"
                                                data-on="<?php echo app('translator')->get('Verified'); ?>" data-off="<?php echo app('translator')->get('Unverified'); ?>"
                                                type="checkbox" <?php if($user->ev): ?> checked <?php endif; ?>>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xxl-3">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Mobile Verification'); ?></label>
                                            <input name="sv" data-width="100%" data-onstyle="-success"
                                                data-offstyle="-danger" data-bs-toggle="toggle"
                                                data-on="<?php echo app('translator')->get('Verified'); ?>" data-off="<?php echo app('translator')->get('Unverified'); ?>"
                                                type="checkbox" <?php if($user->sv): ?> checked <?php endif; ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xxl-3">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('2FA Verification'); ?> </label>
                                            <input name="ts" data-width="100%" data-height="50"
                                                data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle"
                                                data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="<?php echo app('translator')->get('Disable'); ?>"
                                                type="checkbox" <?php if($user->ts): ?> checked <?php endif; ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xxl-3">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('KYC'); ?> </label>
                                            <input name="kv" data-width="100%" data-height="50"
                                                data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle"
                                                data-on="<?php echo app('translator')->get('Verified'); ?>" data-off="<?php echo app('translator')->get('Unverified'); ?>"
                                                type="checkbox" <?php if($user->kv == Status::KYC_VERIFIED): ?> checked <?php endif; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            


        </div>
    </div>

    
    <div class="modal fade" id="addSubModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class="type"></span> <span><?php echo app('translator')->get('Balance'); ?></span></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form class="balanceAddSub disableSubmission" action="<?php echo e(route('admin.users.add.sub.balance', $user->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input name="act" type="hidden">
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Amount'); ?></label>
                            <div class="input-group">
                                <input class="form-control" name="amount" type="number" step="any" placeholder="<?php echo app('translator')->get('Please provide positive amount'); ?>" required>
                                <div class="input-group-text"><?php echo e(__(gs('cur_text'))); ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Remark'); ?></label>
                            <textarea class="form-control" name="remark" placeholder="<?php echo app('translator')->get('Remark'); ?>" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary h-45 w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userStatusModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <?php if($user->status == Status::USER_ACTIVE): ?>
                            <?php echo app('translator')->get('Ban User'); ?>
                        <?php else: ?>
                            <?php echo app('translator')->get('Unban User'); ?>
                        <?php endif; ?>
                    </h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.users.status', $user->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <?php if($user->status == Status::USER_ACTIVE): ?>
                            <h6 class="mb-2"><?php echo app('translator')->get('If you ban this user he/she won\'t able to access his/her dashboard.'); ?></h6>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('Reason'); ?></label>
                                <textarea class="form-control" name="reason" rows="4" required></textarea>
                            </div>
                        <?php else: ?>
                            <p><span><?php echo app('translator')->get('Ban reason was'); ?>:</span></p>
                            <p><?php echo e($user->ban_reason); ?></p>
                            <h4 class="mt-3 text-center"><?php echo app('translator')->get('Are you sure to unban this user?'); ?></h4>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <?php if($user->status == Status::USER_ACTIVE): ?>
                            <button class="btn btn--primary h-45 w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                        <?php else: ?>
                            <button class="btn btn--dark" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('No'); ?></button>
                            <button class="btn btn--primary" type="submit"><?php echo app('translator')->get('Yes'); ?></button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.users.login', $user->id)); ?>" target="_blank"><i class="las la-sign-in-alt"></i><?php echo app('translator')->get('Login as User'); ?></a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict"


            $('.bal-btn').on('click', function() {

                $('.balanceAddSub')[0].reset();

                var act = $(this).data('act');
                $('#addSubModal').find('input[name=act]').val(act);
                if (act == 'add') {
                    $('.type').text('Add');
                } else {
                    $('.type').text('Subtract');
                }
            });

            let mobileElement = $('.mobile-code');
            $('select[name=country]').on('change', function() {
                mobileElement.text(`+${$('select[name=country] :selected').data('mobile_code')}`);
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('style'); ?>
    <style>
        .profile-info-top {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 16px;
        }

        .profile-image {
            flex-shrink: 0;
        }

        .plan-info {
            flex: 1;
        }

        .plan-info-name {
            display: flex;
            flex-direction: column;
            gap: 6px;
            line-height: 1.3;
            font-size: 20px;
        }

        .plan-info-name span {
            font-size: 24px;
        }

        .profile-image img {
            height: 100px;
            width: 100px;
            border-radius: 50%;
            border: 6px solid #00000010;
        }
        .plan-info{
            background: #fafafa;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/admin/users/detail.blade.php ENDPATH**/ ?>