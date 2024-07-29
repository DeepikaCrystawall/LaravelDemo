@extends('layouts.frontend')
@section('content')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Product Detail</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Product Detail</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Single Product Start -->
<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <!-- Product Details -->
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded">
                            <a href="#">
                                <img src="{{ asset('uploads/products/small/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->image_alt }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3">{{ $product->title }}</h4>
                        <p class="mb-3">Category: {{ $product->category->title }}</p>
                        <h5 class="fw-bold mb-3">AED {{ $product->price }}</h5>
                        <p class="mb-4">{{ $product->short_desc }}</p>
                    </div>
                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about" aria-selected="true">Description</button>
                                <button class="nav-link border-white border-bottom-0" type="button" role="tab" id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission" aria-controls="nav-mission" aria-selected="false">Reviews</button>
                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. 
                                    Susp endisse ultricies nisi vel quam suscipit </p>
                                <p>Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic 
                                    icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.</p>
                                <div class="px-2">
                                    <div class="row g-4">
                                        <div class="col-6">
                                            <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Weight</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">1 kg</p>
                                                </div>
                                            </div>
                                            <div class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Country of Origin</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">Agro Farm</p>
                                                </div>
                                            </div>
                                            <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Quality</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">Organic</p>
                                                </div>
                                            </div>
                                            <div class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Сheck</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">Healthy</p>
                                                </div>
                                            </div>
                                            <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Min Weight</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">250 Kg</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                <div class="d-flex">
                                    <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Jason Smith</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic 
                                            words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Sam Peters</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic 
                                            words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="nav-vision" role="tabpanel">
                                <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                    amet diam et eos labore. 3</p>
                                <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                    Clita erat ipsum et lorem et sit</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Any Queries Button -->
                <div class="mb-5">
                    @if(Auth::check())
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#queryForm" aria-expanded="false" aria-controls="queryForm">
                        Any Queries?
                    </button>
                    <div class="collapse mt-4" id="queryForm">
                        @include('partials.query_form', ['product' => $product])
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Any Queries?</a>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <!-- Sidebar Content -->
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <h4>Categories</h4>
                            <ul class="list-unstyled fruite-categorie">
                                @foreach($category as $catgry)
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="{{ url('category/' . $catgry->id) }}"><i class="fas fa-apple-alt me-2"></i>{{ $catgry->title }}</a>
                                        <span>({{ $catgry->product->count() }})</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="position-relative">
                            <img src="{{ asset('assets/web/img/banner-fruits.jpg') }}" class="img-fluid w-100 rounded" alt="">
                            <div class="bg-secondary text-white text-center position-absolute top-50 start-50 translate-middle py-3 px-5 rounded">
                                <h3 class="fw-bold m-0">Natural Fruits</h3>
                                <p class="m-0">Save upto 30%</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="bg-light rounded text-center py-5 px-4">
                            <h4 class="fw-bold mb-4">Subscribe Our Newsletter</h4>
                            <form action="">
                                <input type="text" class="form-control border-0 p-3 mb-4" placeholder="Your email">
                                <button type="submit" class="btn btn-primary border-0 w-100 py-3">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="bg-light rounded text-center py-5 px-4">
                            <h4 class="fw-bold mb-4">Top Rating</h4>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/web/img/banana.jpg') }}" class="img-fluid rounded w-25" alt="">
                                <div class="text-start ps-3">
                                    <a href="product-details"><h5>Banana</h5></a>
                                    <p class="m-0">1200$</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/web/img/banana.jpg') }}" class="img-fluid rounded w-25" alt="">
                                <div class="text-start ps-3">
                                    <a href="product-details"><h5>Banana</h5></a>
                                    <p class="m-0">1200$</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/web/img/banana.jpg') }}" class="img-fluid rounded w-25" alt="">
                                <div class="text-start ps-3">
                                    <a href="product-details"><h5>Banana</h5></a>
                                    <p class="m-0">1200$</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!$relatedProducts->isEmpty())
        <h1 class="fw-bold mb-0">Related products</h1>
        <div class="owl-carousel vegetable-carousel justify-content-center">
            @foreach($relatedProducts as $rproducts)
            <div class="border border-primary rounded position-relative vesitable-item">
                <div class="vesitable-img">
                    <img src="{{ asset('uploads/products/small/' . $rproducts->image) }}" class="img-fluid w-100 rounded-top" alt="{{ $rproducts->image_alt }}">
                </div>
                <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">{{ $rproducts->category->title }}</div>
                <div class="p-4 pb-0 rounded-bottom">
                    <a href="{{ url('product-details/' . $rproducts->id) }}"><h4>{{ $rproducts->title }}</h4></a>
                    <p>{{ $rproducts->short_desc }}</p>
                    <div class="d-flex justify-content-between flex-lg-wrap">
                        <p class="text-dark fs-5 fw-bold">AED {{ $rproducts->price }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
<!-- Single Product End -->

@endsection
