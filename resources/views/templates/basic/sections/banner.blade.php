@php
use Illuminate\Support\Str;

$bannerContent = getContent('banner.content', true);
$images = [];

if ($bannerContent && isset($bannerContent->data_values)) {
    foreach ($bannerContent->data_values as $key => $val) {
        if (Str::startsWith($key, 'image_') && !empty($val)) {
            $images[] = $val;
        }
    }
}
@endphp

@if(count($images))
<section class="hero-banner">

    <div id="heroCarousel"
         class="carousel slide"
         data-bs-ride="carousel"
         data-bs-interval="6000"
         data-bs-touch="true">

        {{-- Indicators --}}
        <div class="carousel-indicators">
            @foreach($images as $i => $image)
                <button type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide-to="{{ $i }}"
                        class="{{ $i === 0 ? 'active' : '' }}"
                        aria-label="Slide {{ $i + 1 }}">
                </button>
            @endforeach
        </div>

        {{-- Slides --}}
        <div class="carousel-inner">

            @foreach($images as $i => $image)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">

                    {{-- Image --}}
                    <div class="hero-media">
                        <img src="{{ frontendImage('banner', $image) }}"
                             alt="Banner {{ $i + 1 }}"
                             loading="lazy">
                    </div>

                    {{-- Overlay --}}
                    <div class="hero-overlay"></div>

                    {{-- Caption (first slide only) --}}
                    @if($i === 0)
                        <div class="hero-caption">
                            <div class="container text-center">

                                <h1 class="hero-title">
                                    {{ __(@$bannerContent->data_values->heading) }}
                                </h1>

                                <p class="hero-subtitle">
                                    {{ __(@$bannerContent->data_values->sub_heading) }}
                                </p>

                                <!--<div class="hero-actions">
                                    <a href="{{ @$bannerContent->data_values->left_button_link }}"
                                       class="btn btn-primary px-4 py-2">
                                        {{ __(@$bannerContent->data_values->left_button) }}
                                    </a>

                                    <a href="{{ @$bannerContent->data_values->right_button_link }}"
                                       class="btn btn-outline-light px-4 py-2">
                                        {{ __(@$bannerContent->data_values->right_button) }}
                                    </a>
                                </div>-->

                            </div>
                        </div>
                    @endif

                </div>
            @endforeach

        </div>

        {{-- Controls --}}
        <button class="carousel-control-prev" type="button"
                data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button"
                data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>
</section>
@endif


