<div class="overlay"></div>
<!-- Preloader -->
<div id="preloader">
    <div id="loader"></div>
</div>

<!-- Header Section Starts Here -->
<header class="header" style="background: linear-gradient(90deg, #75c4f0, #42919e); color:#000;">
    <div class="header-bottom" style="background: linear-gradient(90deg, #75c4f0, #42919e); color:#000;">
        <div class="container">
            <div class="header-bottom-area" style="background: linear-gradient(90deg, #75c4f0, #42919e); color:#000;">
                
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ siteLogo('dark') }}" alt="logo">
                    </a>
                </div>

                <div class="header-trigger-wrapper d-flex d-lg-none align-items-center">
                    <div class="header-trigger d-block d-lg-none">
                        <span></span>
                    </div>
                    <div class="account-cart-wrapper">
                        <a class="account" href="{{ route('user.login') }}"><i class="las la-user"></i></a>
                    </div>
                </div>

                <ul class="menu" style="color:#000;">
                    <li><a href="https://paheliherbals.com/" style="color:#000;">@lang('Home')</a></li>
                    <li><a href="{{ route('products') }}" style="color:#000;">@lang('Product')</a></li>

                    @foreach ($pages as $k => $data)
                        <li><a href="{{ route('pages', [$data->slug]) }}" style="color:#000;">{{ $data->name }}</a></li>
                    @endforeach

                    <li><a href="{{ route('contact') }}" style="color:#000;">@lang('Contact')</a></li>

                    <li>
                        @if (gs('multi_language'))
                            @php
                                $language = App\Models\Language::all();
                                $selectLang = $language->where('code', config('app.locale'))->first();
                                $currentLang = session('lang')
                                    ? $language->where('code', session('lang'))->first()
                                    : $language->where('is_default', Status::YES)->first();
                            @endphp

                            <div class="custom--dropdown" style="color:#000;">
                                <div class="custom--dropdown__selected dropdown-list__item">
                                    <div class="thumb">
                                        <img src="{{ getImage(getFilePath('language') . '/' . $currentLang->image, getFileSize('language')) }}"
                                            alt="image">
                                    </div>
                                    <span class="text" style="color:#000;"> {{ __(@$selectLang->name) }} </span>
                                </div>
                                <ul class="dropdown-list" style="color:#000;">
                                    @foreach ($language as $item)
                                        <li class="dropdown-list__item" data-value="en">
                                            <a class="thumb" href="{{ route('lang', $item->code) }}" style="color:#000;">
                                                <img src="{{ getImage(getFilePath('language') . '/' . $item->image, getFileSize('language')) }}" alt="image">
                                                <span class="text" style="color:#000;"> {{ __($item->name) }} </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>

                    <li class="account-cart-wrapper d-none d-lg-block">
                        <a class="account" href="{{ route('user.login') }}" style="color:#000;"><i class="las la-user"></i></a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</header>


<!-- Header Section Ends Here -->
