@if($left)
<div>
    @include($activeTemplate.'user.partials.tree_node', ['user' => $left])
</div>
@endif

@if($right)
<div>
    @include($activeTemplate.'user.partials.tree_node', ['user' => $right])
</div>
@endif
