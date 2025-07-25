@php
    $productContent = getContent('product.content', true);
    $products = App\Models\Product::active()
        ->where('is_featured', Status::YES)
        ->get();
@endphp

<section class="product-section padding-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section-header text-center">
                    <span class="subtitle">{{ __(@$productContent->data_values->heading) }}</span>
                    <h2 class="title">{{ __(@$productContent->data_values->sub_heading) }}</h2>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                    <div class="product-item h-100">
                        <div class="product-thumb">
                            <img src="{{ getImage(getFilePath('products') . '/' . $product->thumbnail, getFileSize('products')) }}" alt="products">
                            <ul class="product-options">
                                <li><a class="image"
                                        href="{{ getImage(getFilePath('products') . '/' . $product->thumbnail, getFileSize('products')) }}"><i
                                            class="las la-expand"></i></a></li>
                            </ul>
                        </div>
                        <div class="product-content">
                            <h6 class="product-title"><a
                                    href="{{ route('product.details', ['id' => $product->id, 'slug' => slug($product->name)]) }}">{{ __(shortDescription($product->name, 35)) }}</a>
                            </h6>

                            @if ($product->quantity >= 0)
                                <span class="product-availablity text--success">@lang('in stock')</span>
                            @else
                                <span class="product-availablity text--danger">@lang('out stock')</span>
                            @endif

                            <div class="product-price">
                                <span class="current-price">{{ showAmount($product->price) }}</span>
                            </div>
                            <a class="add-to-cart cmn--btn-2"
                                href="{{ route('product.details', ['id' => $product->id, 'slug' => slug($product->name)]) }}">@lang('Details')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
