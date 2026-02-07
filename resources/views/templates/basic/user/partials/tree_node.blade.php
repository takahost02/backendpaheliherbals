<div class="tree-node" data-user="{{ $user->id }}">

    {!! showSingleUserinTree($user) !!}

    <div class="mt-1 text-center">
        <i class="las la-plus-circle tree-toggle"
           data-loaded="0"></i>
    </div>

    <div class="tree-children"></div>

</div>
