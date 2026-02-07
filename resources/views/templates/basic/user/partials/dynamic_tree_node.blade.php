@if($node && isset($node['user']))
<div class="tree-node">

    {!! showSingleUserinTree($node['user']) !!}

    @if(!empty($node['left']) || !empty($node['right']))
        <div class="mt-1">
            <i class="las la-plus-circle tree-toggle"></i>
        </div>
    @endif

    <div class="tree-children">

        @if(!empty($node['left']))
            @include($activeTemplate . 'user.partials.dynamic_tree_node', ['node' => $node['left']])
        @endif

        @if(!empty($node['right']))
            @include($activeTemplate . 'user.partials.dynamic_tree_node', ['node' => $node['right']])
        @endif

    </div>

</div>
@endif
