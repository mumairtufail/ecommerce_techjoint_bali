@extends('web.layout.app')
@section('content')

    <!-- start wpo-page-title -->
    @if(isset($shopBanner) && $shopBanner->image)
    <section class="wpo-page-title" style="background: url('{{ asset('storage/'.$shopBanner->image) }}') no-repeat center center/cover;">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>{{ $shopBanner->title ?? 'Shop' }}</h2>
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="{{ url('/') }}">{{ $shopBanner->subtitle ?? 'Home' }}</a></li>
                            <li>Shop</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    @else
    <section class="wpo-page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>Shop</h2>
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="index.html">Home</a></li>
                            <li>Shop</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    @endif
    <!-- end page-title -->

    <!-- shop-section  start-->

    <div class="shop-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="shop-filter-wrap">
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <h2>Search</h2>
                                <div class="shop-filter-search">
                                    <form>
                                        <div>
                                            <input type="text" class="form-control" placeholder="Search">
                                            <button type="submit"><i class="ti-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <h2>Price</h2>
                                <ul>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            All prices
                                            <input type="radio" name="topcoat">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            $50 – $100 (1)
                                            <input type="radio" name="topcoat">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            $100 – $200 (21)
                                            <input type="radio" name="topcoat">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            $200 – $300 (13)
                                            <input type="radio" name="topcoat">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            $300 – $400 (3)
                                            <input type="radio" name="topcoat">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            $400 and more (2)
                                            <input type="radio" name="topcoat">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <h2>Size</h2>
                                <ul>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Small Size
                                            <input type="radio" name="topcoat2">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Large Size
                                            <input type="radio" name="topcoat2">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Medium Size
                                            <input type="radio" name="topcoat2">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Extra large Size
                                            <input type="radio" name="topcoat2">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item color">
                                <h2> Color</h2>
                                <div class="color-name">
                                    <ul>
                                        <li class="color1"><input id="cl1" type="radio" name="col" value="30">
                                            <label for="cl1"></label>
                                        </li>
                                        <li class="color2"><input id="cl2" type="radio" name="col" value="30">
                                            <label for="cl2"></label>
                                        </li>
                                        <li class="color3"><input id="cl3" type="radio" name="col" value="30">
                                            <label for="cl3"></label>
                                        </li>
                                        <li class="color4"><input id="cl4" type="radio" name="col" value="30">
                                            <label for="cl4"></label>
                                        </li>
                                        <li class="color5"><input id="cl5" type="radio" name="col" value="30">
                                            <label for="cl5"></label>
                                        </li>
                                        <li class="color6"><input id="cl6" type="radio" name="col" value="30">
                                            <label for="cl6"></label>
                                        </li>
                                        <li class="color7"><input id="cl7" type="radio" name="col" value="30">
                                            <label for="cl7"></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <h2>Brand</h2>
                                <ul>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Men
                                            <input type="radio" name="topcoat3">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Women
                                            <input type="radio" name="topcoat3">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Kids
                                            <input type="radio" name="topcoat3">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Sales
                                            <input type="radio" name="topcoat3">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="shop-section-top-inner">
                        <div class="shoping-list">
                            <ul class="nav nav-mb-3 main-tab" id="tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="grid-tab" data-bs-toggle="pill"
                                        data-bs-target="#grid" type="button" role="tab" aria-controls="grid"
                                        aria-selected="true"><i class="fa fa-th "></i></button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="list-tab" data-bs-toggle="pill"
                                        data-bs-target="#list" type="button" role="tab" aria-controls="list"
                                        aria-selected="false"><i class="fa fa-list "></i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="shoping-product">
                            <span>Showing Products 1 - 9 Of 13 Result</span>
                        </div>
                        <div class="short-by">
                            <ul>
                                <li>Short By :</li>
                                <li>
                                    <select name="show">
                                        <option value="">Show 9 Items</option>
                                        <option value="">Show 18 Items</option>
                                        <option value="">Show 27 Items</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                       <!-- Grid View -->
<div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
<div class="product-wrap">
    <div class="row align-items-center">
        @foreach($products as $product)
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="product-single-item">
                <div class="image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="card-icon">
                        <a class="icon" href="#">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                        </a>
                        <a class="icon-active" href="#">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                    </div>
                    <ul class="cart-wrap">
                        <li>
                            <a href="#" data-bs-toggle="tooltip" data-bs-html="true" title="Add To Cart">
                                <i class="fi flaticon-shopping-cart"></i>
                            </a>
                        </li>
                        <li>
                            <button data-bs-toggle="tooltip" data-bs-html="true" title="Quick View">
                                <i class="fi ti-eye"></i>
                            </button>
                        </li>
                        <li>
                            <a href="#" data-bs-toggle="tooltip" data-bs-html="true" title="Compare">
                                <i class="fa fa-compress" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="shop-btn">
                        <a class="product-btn" href="#">Shop Now</a>
                    </div>
                </div>
                <div class="text">
                    <h2><a href="#">{{ $product->name }}</a></h2>
                    <div class="price">
                        @if($product->old_price)
                            <del class="old-price">${{ number_format($product->old_price, 2) }}</del>
                        @endif
                        <span class="present-price">${{ number_format($product->price, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
                      <!-- List View -->
<div class="tab-pane fade product-list" id="list" role="tabpanel" aria-labelledby="list-tab">
<div class="product-wrap">
    <div class="row align-items-center">
        @foreach($products as $product)
        <div class="col-xl-12 col-12">
            <div class="product-single-item product-single-item-s2">
                <div class="image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="card-icon">
                        <a class="icon" href="#">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                        </a>
                        <a class="icon-active" href="#">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                    </div>
                    <ul class="cart-wrap">
                        <li>
                            <a href="#" data-bs-toggle="tooltip" data-bs-html="true" title="Add To Cart">
                                <i class="fi flaticon-shopping-cart"></i>
                            </a>
                        </li>
                        <li>
                            <button data-bs-toggle="tooltip" data-bs-html="true" title="Quick View">
                                <i class="fi ti-eye"></i>
                            </button>
                        </li>
                        <li>
                            <a href="#" data-bs-toggle="tooltip" data-bs-html="true" title="Compare">
                                <i class="fa fa-compress" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="shop-btn">
                        <a class="product-btn" href="#">Shop Now</a>
                    </div>
                </div>
                <div class="text">
                    <h2><a href="#">{{ $product->name }}</a></h2>
                    <div class="price">
                        @if($product->old_price)
                            <del class="old-price">${{ number_format($product->old_price, 2) }}</del>
                        @endif
                        <span class="present-price">${{ number_format($product->price, 2) }}</span>
                    </div>
                    <div class="product-ratting">
                        <ul>
                            @for($i = 1; $i <= 5; $i++)
                                <li>
                                    @if($i <= ($product->rating ?? 0))
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @else
                                        <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                    @endif
                                </li>
                            @endfor
                        </ul>
                    </div>
                    <p>{{ $product->description ?? 'No description available' }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop-area-end -->

// If there are any AJAX requests related to the shop page that interact with admin routes,
// ensure they include CSRF tokens and the user is authenticated.

// Otherwise, no changes are necessary related to the current issue.

@endsection