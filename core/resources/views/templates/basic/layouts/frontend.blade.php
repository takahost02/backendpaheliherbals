@extends($activeTemplate . 'layouts.app')
@section('panel')
    

    @include($activeTemplate.'layouts.breadcrumb')

    @yield('content')

    
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
