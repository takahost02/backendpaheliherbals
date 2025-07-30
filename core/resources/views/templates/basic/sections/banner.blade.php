@php
    $bannerContent = getContent('banner.content', true);
@endphp
@section('content')
    @if ($bannerContent != null)
        <section class="banner-section bg_img p-0 m-0" style="background: none; height: 100vh; overflow: hidden;">
            <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
        
                <div class="carousel-inner h-100">
                    {{-- Slide 1 --}}
                    <div class="carousel-item active h-100">
                        <img src="{{ frontendImage('banner', $bannerContent->data_values->image) }}" class="d-block w-100 h-100 object-fit-cover" alt="Banner Image">
                        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center h-100">
                            <div class="banner-content">
                                <h1 class="title">{{ __(@$bannerContent->data_values->heading) }}</h1>
                                <p>{{ __(@$bannerContent->data_values->sub_heading) }}</p>
                                <div class="button--wrapper">
                                    <a class="cmn--btn active" href="{{ @$bannerContent->data_values->left_button_link }}">
                                        <span>{{ __(@$bannerContent->data_values->left_button) }}</span>
                                    </a>
                                    <a class="cmn--btn" href="{{ @$bannerContent->data_values->right_button_link }}">
                                        <span>{{ __(@$bannerContent->data_values->right_button) }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    {{-- Slide 2 --}}
                    <div class="carousel-item h-100">
                        <img src="{{ frontendImage('banner', $bannerContent->data_values->image) }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
                        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center h-100">
                            <h5>{{ __('Second Slide Title') }}</h5>
                            <p>{{ __('Second slide description goes here.') }}</p>
                        </div>
                    </div>
                    
                    {{-- Slide 3 --}}
                    <div class="carousel-item h-100">
                        <img src="{{ frontendImage('banner', $bannerContent->data_values->image) }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 3">
                        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center h-100">
                            <h5>{{ __('Third Slide Title') }}</h5>
                            <p>{{ __('Third slide description goes here.') }}</p>
                        </div>
                    </div>

                </div>
        
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        
            {{-- Shapes (optional, can remove if not needed) --}}
            <div class="shapes d-none d-sm-block">
                <div class="shape shape1">
                    <img src="{{ asset($activeTemplateTrue . 'images/shape/circle-triangle.png') }}" alt="shape">
                </div>
                <div class="shape2 shape">
                    <img src="{{ asset($activeTemplateTrue . 'images/shape/shape-circle.png') }}" alt="shape">
                </div>
                <div class="shape3 shape">
                    <img src="{{ asset($activeTemplateTrue . 'images/shape/dots-colour.png') }}" alt="shape">
                </div>
                <div class="shape4 shape">
                    <img src="{{ asset($activeTemplateTrue . 'images/shape/plus-big.png') }}" alt="shape">
                </div>
                <div class="shape5 shape">
                    <img src="{{ asset($activeTemplateTrue . 'images/shape/waves.png') }}" alt="shape">
                </div>
            </div>
        </section>
    @endif
