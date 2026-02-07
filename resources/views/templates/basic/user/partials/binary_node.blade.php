@if($node && isset($node['user']))
<div class="binary-node text-center" style="margin:30px">

    {{-- USER CARD --}}
    {!! showSingleUserinTree($node['user']) !!}

    {{-- EXPAND / COLLAPSE BUTTON --}}
    @if($node['left'] || $node['right'])
        <div class="mt-1">
            <i class="las la-plus-circle toggle-children"
               style="cursor:pointer;font-size:18px;color:#0d6efd">
            </i>
        </div>
    @endif

    {{-- CHILDREN CONTAINER --}}
    <div class="children-container"
         style="display:none;justify-content:center;gap:40px;margin-top:25px">

        @if($node['left'])
            @include($activeTemplate.'user.partials.binary_node', ['node' => $node['left']])
        @endif

        @if($node['right'])
            @include($activeTemplate.'user.partials.binary_node', ['node' => $node['right']])
        @endif

    </div>

</div>
@endif
