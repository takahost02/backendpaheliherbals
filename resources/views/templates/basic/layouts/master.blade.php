@extends($activeTemplate . 'layouts.app')

@section('panel')
   

    @include($activeTemplate.'layouts.breadcrumb')

    @include($activeTemplate.'partials.dashboard')

<script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>


@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            window.addEventListener('scroll', function(){
              var header = document.querySelector('header');
              header.classList.toggle('sticky', window.scrollY > 0);
            });   
        })(jQuery);
    </script>
@endpush
