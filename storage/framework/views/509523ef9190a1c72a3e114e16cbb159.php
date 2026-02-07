<?php if($node && isset($node['user'])): ?>
<div class="tree-node">

    <?php echo showSingleUserinTree($node['user']); ?>


    <?php if(!empty($node['left']) || !empty($node['right'])): ?>
        <div class="mt-1">
            <i class="las la-plus-circle tree-toggle"></i>
        </div>
    <?php endif; ?>

    <div class="tree-children">

        <?php if(!empty($node['left'])): ?>
            <?php echo $__env->make($activeTemplate . 'user.partials.dynamic_tree_node', ['node' => $node['left']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if(!empty($node['right'])): ?>
            <?php echo $__env->make($activeTemplate . 'user.partials.dynamic_tree_node', ['node' => $node['right']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

    </div>

</div>
<?php endif; ?>
<?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/user/partials/dynamic_tree_node.blade.php ENDPATH**/ ?>