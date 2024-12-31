@extends('web.layout.app')
@section('content')

   <!-- start wpo-page-title -->
   @if(isset($homeBanner) && $homeBanner->image)
    <section class="wpo-page-title" style="background: url('{{ asset('storage/'.$homeBanner->image) }}') no-repeat center center/cover;">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>{{ $homeBanner->title ?? 'Home' }}</h2>
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="{{ url('/') }}">{{ $homeBanner->subtitle ?? 'Home' }}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
   <section class="wpo-page-title">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="wpo-breadcumb-wrap">
                            <h2>Home</h2>
                            <ol class="wpo-breadcumb-wrap">
                                <li><a href="index.html">Home</a></li>
                            </ol>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        @endif
        <!-- end page-title -->


        <!-- start of pengu-product-section -->
        <section class="pengu-product-section section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-12">
                        <div class="wpo-section-title">
                            <h2>New Arraival</h2>
                            <p>Here is our new arraival products that you may like.</p>
                        </div>
                    </div>
                </div>
                <div class="product-wrap">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="product-single-item">
                                <div class="image">
                                    <img src="{{ asset('assets/images/product-single/1.jpg') }}" alt="">
                                    <div class="card-icon">
                                        <a class="icon" href="wishlist.html">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="icon-active" href="wishlist.html">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <ul class="cart-wrap">
                                        <li>
                                            <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Add To Cart"><i class="fi flaticon-shopping-cart"></i></a>
                                        </li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                            <button data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button>
                                        </li>
                                        <li>
                                            <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Compare"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                    <div class="shop-btn">
                                        <a class="product-btn" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                                <div class="text">
                                    <h2><a href="product-single.html">Long Sleeve Tops</a></h2>
                                    <div class="price">
                                        <del class="old-price">$85.50</del>
                                        <span class="present-price">$70.30</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="product-single-item active">
                                <div class="image">
                                    <img src="{{ asset('assets/images/product-single/2.jpg') }}" alt="">
                                    <div class="card-icon">
                                        <a class="icon" href="wishlist.html">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="icon-active" href="wishlist.html" data-bs-toggle="tooltip"
                                            data-bs-html="true" title="Add To Wishlist">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <ul class="cart-wrap">
                                        <li>
                                            <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Add To Cart"><i class="fi flaticon-shopping-cart"></i></a>
                                        </li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                            <button data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button>
                                        </li>
                                        <li>
                                            <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Compare"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                    <div class="shop-btn">
                                        <a class="product-btn" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                                <div class="text">
                                    <h2><a href="product-single.html">White Wedding Shoe</a></h2>
                                    <div class="price">
                                        <del class="old-price">$150.20</del>
                                        <span class="present-price">$120.50</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="product-single-item">
                                <div class="image">
                                    <img src="{{ asset('assets/images/product-single/3.jpg') }}" alt="">
                                    <div class="card-icon">
                                        <a class="icon" href="wishlist.html">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="icon-active" href="wishlist.html">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <ul class="cart-wrap">
                                        <li>
                                            <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Add To Cart"><i class="fi flaticon-shopping-cart"></i></a>
                                        </li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                            <button data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button>
                                        </li>
                                        <li>
                                            <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Compare"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                    <div class="shop-btn">
                                        <a class="product-btn" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                                <div class="text">
                                    <h2><a href="product-single.html">Long Chain With Lockel</a></h2>
                                    <div class="price">
                                        <del class="old-price">$85.50</del>
                                        <span class="present-price">$70.30</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="product-single-item">
                                <div class="image">
                                    <img src="{{ asset('assets/images/product-single/4.jpg') }}" alt="">
                                    <div class="card-icon">
                                        <a class="icon" href="wishlist.html">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="icon-active" href="wishlist.html">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <ul class="cart-wrap">
                                        <li>
                                            <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Add To Cart"><i class="fi flaticon-shopping-cart"></i></a>
                                        </li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                            <button data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button>
                                        </li>
                                        <li>
                                            <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Compare"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                    <div class="shop-btn">
                                        <a class="product-btn" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                                <div class="text">
                                    <h2><a href="product-single.html">Winter Jacket</a></h2>
                                    <div class="price">
                                        <del class="old-price">$100.50</del>
                                        <span class="present-price">$80.30</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of pengu-product-section -->

        <!-- start of pengu-banner-section -->
        <section class="pengu-banner-section">
            <div class="container">
                <div class="banner-wrap">
                    <div class="row">
                        <div class="col-lg-7 col-md-9 col-12">
                            <div class="content">
                                <div class="bg-text">
                                    <h1>fasion</h1>
                                </div>
                                <h2>Stylish casual
                                    sweater & sneakers</h2>
                                <p>Beautiful, Fashionable and Stylish</p>
                                <a href="shop.html">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of pengu-banner-section -->

        <!-- start of pengu-product-category-section -->
        <section class="pengu-product-category-section section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-12">
                        <div class="wpo-section-title">
                            <h2>Popular Products</h2>
                            <p>Here is our new arraival products that you may like.</p>
                        </div>
                    </div>
                </div>
                <div class="category-wrap">
                    <div class="row">
                        <div class="col col-xs-12 sortable-gallery">
                            <div class="gallery-filters">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6 col-12">
                                        <ul class="category-item">
                                            <li><a data-filter=".all" href="#" class="product-btn current">
                                                    All Products
                                                </a>
                                            </li>
                                            <li>
                                                <a data-filter=".men" href="#" class="product-btn">
                                                    Men
                                                </a>
                                            </li>
                                            <li>
                                                <a data-filter=".women" href="#" class="product-btn">
                                                    Women
                                                </a>
                                            </li>
                                            <li><a data-filter=".kids" href="#" class="product-btn">
                                                    Kids
                                                </a>
                                            </li>
                                            <li><a data-filter=".sales" href="#" class="product-btn">
                                                    Sales
                                                </a>
                                            </li>
                                            <li><a data-filter=".offers" href="#" class="product-btn">
                                                    Offers
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-container gallery-fancybox masonry-gallery row">
                                <div class="col-lg-3 col-md-6 col-12 custom-grid IllustAtor all sales women zoomIn"
                                    data-wow-duration="2000ms">
                                    <div class="product-single-item">
                                        <div class="image">
                                            <img src="assets/images/product-category/1.jpg" alt="">
                                            <div class="card-icon">
                                                <a class="icon" href="wishlist.html">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </a>
                                                <a class="icon-active" href="wishlist.html">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <ul class="cart-wrap">
                                                <li>
                                                    <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Add To Cart"><i
                                                            class="fi flaticon-shopping-cart"></i></a>
                                                </li>
                                                <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                                    <button data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Quick View"><i class="fi ti-eye"></i></button>
                                                </li>
                                                <li>
                                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Compare"><i class="fa fa-compress"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                            <div class="shop-btn">
                                                <a class="product-btn" href="shop.html">Shop Now</a>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h2><a href="product-single.html">Long Sleeve Tops</a></h2>
                                            <div class="price">
                                                <del class="old-price">$85.50</del>
                                                <span class="present-price">$70.30</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 custom-grid all  women men offers kids zoomIn"
                                    data-wow-duration="2000ms">
                                    <div class="product-single-item">
                                        <div class="image">
                                            <img src="assets/images/product-category/2.jpg" alt="">
                                            <div class="card-icon">
                                                <a class="icon" href="wishlist.html">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </a>
                                                <a class="icon-active" href="wishlist.html">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <ul class="cart-wrap">
                                                <li>
                                                    <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Add To Cart"><i
                                                            class="fi flaticon-shopping-cart"></i></a>
                                                </li>
                                                <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                                    <button data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Quick View"><i class="fi ti-eye"></i></button>
                                                </li>
                                                <li>
                                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Compare"><i class="fa fa-compress"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                            <div class="shop-btn">
                                                <a class="product-btn" href="shop.html">Shop Now</a>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h2><a href="product-single.html">White Wedding Shoe</a></h2>
                                            <div class="price">
                                                <del class="old-price">$150.50</del>
                                                <span class="present-price">$120.30</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 custom-grid all women men offers kids zoomIn"
                                    data-wow-duration="2000ms">
                                    <div class="product-single-item">
                                        <div class="image">
                                            <img src="assets/images/product-category/3.jpg" alt="">
                                            <div class="card-icon">
                                                <a class="icon" href="wishlist.html">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </a>
                                                <a class="icon-active" href="wishlist.html">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <ul class="cart-wrap">
                                                <li>
                                                    <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Add To Cart"><i
                                                            class="fi flaticon-shopping-cart"></i></a>
                                                </li>
                                                <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                                    <button data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Quick View"><i class="fi ti-eye"></i></button>
                                                </li>
                                                <li>
                                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Compare"><i class="fa fa-compress"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                            <div class="shop-btn">
                                                <a class="product-btn" href="shop.html">Shop Now</a>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h2><a href="product-single.html">Long Chain With Lockel</a></h2>
                                            <div class="price">
                                                <del class="old-price">$180.50</del>
                                                <span class="present-price">$150.30</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 custom-grid women  kids all zoomIn"
                                    data-wow-duration="2000ms">
                                    <div class="product-single-item">
                                        <div class="image">
                                            <img src="assets/images/product-category/4.jpg" alt="">
                                            <div class="card-icon">
                                                <a class="icon" href="wishlist.html">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </a>
                                                <a class="icon-active" href="wishlist.html">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <ul class="cart-wrap">
                                                <li>
                                                    <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Add To Cart"><i
                                                            class="fi flaticon-shopping-cart"></i></a>
                                                </li>
                                                <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                                    <button data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Quick View"><i class="fi ti-eye"></i></button>
                                                </li>
                                                <li>
                                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Compare"><i class="fa fa-compress"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                            <div class="shop-btn">
                                                <a class="product-btn" href="shop.html">Shop Now</a>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h2><a href="product-single.html">Winter Jacket </a></h2>
                                            <div class="price">
                                                <del class="old-price">$100.50</del>
                                                <span class="present-price">$70.30</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 all custom-grid  women sales kidszoomIn"
                                    data-wow-duration="2000ms">
                                    <div class="product-single-item">
                                        <div class="image">
                                            <img src="assets/images/product-category/5.jpg" alt="">
                                            <div class="card-icon">
                                                <a class="icon" href="wishlist.html">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </a>
                                                <a class="icon-active" href="wishlist.html">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <ul class="cart-wrap">
                                                <li>
                                                    <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Add To Cart"><i
                                                            class="fi flaticon-shopping-cart"></i></a>
                                                </li>
                                                <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                                    <button data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Quick View"><i class="fi ti-eye"></i></button>
                                                </li>
                                                <li>
                                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Compare"><i class="fa fa-compress"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                            <div class="shop-btn">
                                                <a class="product-btn" href="shop.html">Shop Now</a>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h2><a href="product-single.html">Long Sleeve Tops</a></h2>
                                            <div class="price">
                                                <del class="old-price">$85.50</del>
                                                <span class="present-price">$70.30</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 custom-grid all men offers zoomIn"
                                    data-wow-duration="2000ms">
                                    <div class="product-single-item">
                                        <div class="image">
                                            <img src="assets/images/product-category/6.jpg" alt="">
                                            <div class="card-icon">
                                                <a class="icon" href="wishlist.html">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </a>
                                                <a class="icon-active" href="wishlist.html">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <ul class="cart-wrap">
                                                <li>
                                                    <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Add To Cart"><i
                                                            class="fi flaticon-shopping-cart"></i></a>
                                                </li>
                                                <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                                    <button data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Quick View"><i class="fi ti-eye"></i></button>
                                                </li>
                                                <li>
                                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Compare"><i class="fa fa-compress"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                            <div class="shop-btn">
                                                <a class="product-btn" href="shop.html">Shop Now</a>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h2><a href="product-single.html">White Wedding Shoe</a></h2>
                                            <div class="price">
                                                <del class="old-price">$120.50</del>
                                                <span class="present-price">$100.30</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 custom-grid all  men  zoomIn"
                                    data-wow-duration="2000ms">
                                    <div class="product-single-item">
                                        <div class="image">
                                            <img src="assets/images/product-category/7.jpg" alt="">
                                            <div class="card-icon">
                                                <a class="icon" href="wishlist.html">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </a>
                                                <a class="icon-active" href="wishlist.html">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <ul class="cart-wrap">
                                                <li>
                                                    <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Add To Cart"><i
                                                            class="fi flaticon-shopping-cart"></i></a>
                                                </li>
                                                <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                                    <button data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Quick View"><i class="fi ti-eye"></i></button>
                                                </li>
                                                <li>
                                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Compare"><i class="fa fa-compress"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                            <div class="shop-btn">
                                                <a class="product-btn" href="shop.html">Shop Now</a>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h2><a href="product-single.html">Long Chain With Lockel</a></h2>
                                            <div class="price">
                                                <del class="old-price">$150.50</del>
                                                <span class="present-price">$130.30</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 custom-grid all  men  zoomIn"
                                    data-wow-duration="2000ms">
                                    <div class="product-single-item">
                                        <div class="image">
                                            <img src="assets/images/product-category/8.jpg" alt="">
                                            <div class="card-icon">
                                                <a class="icon" href="wishlist.html">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </a>
                                                <a class="icon-active" href="wishlist.html">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <ul class="cart-wrap">
                                                <li>
                                                    <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Add To Cart"><i
                                                            class="fi flaticon-shopping-cart"></i></a>
                                                </li>
                                                <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                                    <button data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Quick View"><i class="fi ti-eye"></i></button>
                                                </li>
                                                <li>
                                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Compare"><i class="fa fa-compress"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                            <div class="shop-btn">
                                                <a class="product-btn" href="shop.html">Shop Now</a>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h2><a href="product-single.html">Winter Jacket </a></h2>
                                            <div class="price">
                                                <del class="old-price">$100.50</del>
                                                <span class="present-price">$70.30</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of pengu-product-category-section -->

        <!-- start of pengu-spacing-section -->
        <section class="pengu-spacing-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="lookbook-benner">
                            <div class="bg-image">
                                <img src="assets/images/lookbook.jpg" alt="">
                            </div>
                            <div class="content">
                                <h2>LOOKBOOK 2023</h2>
                                <p>Best fasionable brand in the world</p>
                                <a class="theme-btn" href="shop.html">View Collection</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="winter-benner">
                            <div class="bg-image">
                                <img src="assets/images/winter.jpg" alt="">
                            </div>
                            <div class="content">
                                <span>Winter Sale</span>
                                <h2>UP TO 70% OFF</h2>
                                <a class="theme-btn" href="shop.html">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of pengu-spacing-section -->

        <!-- start of pengu-bestseller-section -->
        <section class="pengu-bestseller-section section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-12">
                        <div class="wpo-section-title">
                            <h2>Best Seller</h2>
                            <p>Top sale in this week and this season.</p>
                        </div>
                    </div>
                </div>
                <div class="bestseller-wrap">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="product-single-item">
                                <div class="image">
                                    <img src="assets/images/bestseller/img-1.jpg" alt="">
                                    <div class="card-icon">
                                        <a class="icon" href="wishlist.html">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="icon-active" href="wishlist.html">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <ul class="cart-wrap">
                                        <li>
                                            <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Add To Cart"><i class="fi flaticon-shopping-cart"></i></a>
                                        </li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                            <button data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button>
                                        </li>
                                        <li>
                                            <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Compare"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                    <div class="shop-btn">
                                        <a class="product-btn" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                                <div class="text">
                                    <h2><a href="product-single.html">Long Sleeve Tops</a></h2>
                                    <div class="price">
                                        <del class="old-price">$850.50</del>
                                        <span class="present-price">$70.30</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="product-single-item">
                                <div class="image">
                                    <img src="assets/images/bestseller/img-2.jpg" alt="">
                                    <div class="card-icon">
                                        <a class="icon" href="wishlist.html">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="icon-active" href="wishlist.html">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <ul class="cart-wrap">
                                        <li>
                                            <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Add To Cart"><i class="fi flaticon-shopping-cart"></i></a>
                                        </li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                            <button data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button>
                                        </li>
                                        <li>
                                            <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Compare"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                    <div class="shop-btn">
                                        <a class="product-btn" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                                <div class="text">
                                    <h2><a href="product-single.html">White Wedding Shoe</a></h2>
                                    <div class="price">
                                        <del class="old-price">$150.50</del>
                                        <span class="present-price">$120.30</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="product-single-item">
                                <div class="image">
                                    <img src="assets/images/bestseller/img-3.jpg" alt="">
                                    <div class="card-icon">
                                        <a class="icon" href="wishlist.html">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="icon-active" href="wishlist.html">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <ul class="cart-wrap">
                                        <li>
                                            <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Add To Cart"><i class="fi flaticon-shopping-cart"></i></a>
                                        </li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                            <button data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button>
                                        </li>
                                        <li>
                                            <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Compare"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                    <div class="shop-btn">
                                        <a class="product-btn" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                                <div class="text">
                                    <h2><a href="product-single.html">Long Chain With Lockel</a></h2>
                                    <div class="price">
                                        <del class="old-price">$85.50</del>
                                        <span class="present-price">$60.30</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="product-single-item">
                                <div class="image">
                                    <img src="assets/images/bestseller/img-4.jpg" alt="">
                                    <div class="card-icon">
                                        <a class="icon" href="wishlist.html">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="icon-active" href="wishlist.html">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <ul class="cart-wrap">
                                        <li>
                                            <a href="cart.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Add To Cart"><i class="fi flaticon-shopping-cart"></i></a>
                                        </li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview">
                                            <button data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button>
                                        </li>
                                        <li>
                                            <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Compare"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                    <div class="shop-btn">
                                        <a class="product-btn" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                                <div class="text">
                                    <h2><a href="product-single.html">Winter Jacket</a></h2>
                                    <div class="price">
                                        <del class="old-price">$100.50</del>
                                        <span class="present-price">$80.30</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- end of pengu-bestseller-section -->

        <!-- start of wpo-blog-section -->
        <!-- <section class="wpo-blog-section section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-12">
                        <div class="wpo-section-title">
                            <h2>Latest News</h2>
                            <p>Here is our top newses for your fasion guide.</p>
                        </div>
                    </div>
                </div>
                <div class="blog-wrap">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="blog-item">
                                <div class="post-image">
                                    <div class="post-img-title">
                                        <span>Fasion</span>
                                    </div>
                                    <img src="assets/images/blog/img-1.jpg" alt="">
                                </div>
                                <div class="post-content">
                                    <ul class="post-date">
                                        <li>By Jastin Wastal</li>
                                        <li>15 Sep 2023</li>
                                    </ul>
                                    <h2><a href="blog-single.html">New season modern scarf</a></h2>
                                    <p>Etiam facisis urna dignissim dui quisque in mauris viverra Nulla placerat
                                        suscipit integer enim.</p>
                                    <a class="post-btn" href="blog-single.html">Read More...</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="blog-item">
                                <div class="post-image">
                                    <div class="post-img-title">
                                        <span>Trending</span>
                                    </div>
                                    <img src="assets/images/blog/img-2.jpg" alt="">
                                </div>
                                <div class="post-content">
                                    <ul class="post-date">
                                        <li>By Jastin Wastal</li>
                                        <li>20 Sep 2023</li>
                                    </ul>
                                    <h2><a href="blog-single.html">Summer Trending 2023</a></h2>
                                    <p>Etiam facisis urna dignissim dui quisque in mauris viverra Nulla placerat
                                        suscipit integer enim.</p>
                                    <a class="post-btn" href="blog-single.html">Read More...</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="blog-item">
                                <div class="post-image">
                                    <div class="post-img-title">
                                        <span>Lifestyle</span>
                                    </div>
                                    <img src="assets/images/blog/img-3.jpg" alt="">
                                </div>
                                <div class="post-content">
                                    <ul class="post-date">
                                        <li>By Jastin Wastal</li>
                                        <li>25 Sep 2023</li>
                                    </ul>
                                    <h2><a href="blog-single.html">Top 10 Curley Hairstyle</a></h2>
                                    <p>Etiam facisis urna dignissim dui quisque in mauris viverra Nulla placerat
                                        suscipit integer enim.</p>
                                    <a class="post-btn" href="blog-single.html">Read More...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- end of wpo-blog-section -->


@endsection