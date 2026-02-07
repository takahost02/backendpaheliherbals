@extends($activeTemplate.'layouts.master')

@push('style')
<link href="{{ asset('assets/global/css/tree.css') }}" rel="stylesheet">
<style>
.showDetails {
    cursor: pointer;
}
</style>
@endpush

@section('content')

<div class="card custom--card">

    <div class="row text-center justify-content-center llll">
        <div class="w-1">{!! showSingleUserinTree($tree['a']) !!}</div>
    </div>

    <div class="row text-center justify-content-center llll">
        <div class="w-2">{!! showSingleUserinTree($tree['b']) !!}</div>
        <div class="w-2">{!! showSingleUserinTree($tree['c']) !!}</div>
    </div>

    <div class="row text-center justify-content-center llll">
        <div class="w-4">{!! showSingleUserinTree($tree['d']) !!}</div>
        <div class="w-4">{!! showSingleUserinTree($tree['e']) !!}</div>
        <div class="w-4">{!! showSingleUserinTree($tree['f']) !!}</div>
        <div class="w-4">{!! showSingleUserinTree($tree['g']) !!}</div>
    </div>

    <div class="row text-center justify-content-center llll">
        <div class="w-8">{!! showSingleUserinTree($tree['h']) !!}</div>
        <div class="w-8">{!! showSingleUserinTree($tree['i']) !!}</div>
        <div class="w-8">{!! showSingleUserinTree($tree['j']) !!}</div>
        <div class="w-8">{!! showSingleUserinTree($tree['k']) !!}</div>
        <div class="w-8">{!! showSingleUserinTree($tree['l']) !!}</div>
        <div class="w-8">{!! showSingleUserinTree($tree['m']) !!}</div>
        <div class="w-8">{!! showSingleUserinTree($tree['n']) !!}</div>
        <div class="w-8">{!! showSingleUserinTree($tree['o']) !!}</div>
    </div>

</div>

@endsection

@push('script')
<script>
"use strict";

(function ($) {

    $(document).on('click', '.showDetails', function (e) {
        e.preventDefault();

        const treeUrl = $(this).data('treeurl');
        if (!treeUrl) return;

        // ðŸ”„ Reload SAME page with clicked user id
        window.location.href = treeUrl;
    });

})(jQuery);
</script>
@endpush

@push('breadcrumb-plugins')
    <form action="{{route('user.other.tree')}}" method="GET" class="form-inline float-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="username" class="form-control form--control" placeholder="@lang('Search by username')">
            <button class="btn btn--success" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
@endpush



