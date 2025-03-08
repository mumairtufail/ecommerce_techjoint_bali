@extends('web.layout.app')
@section('content')

@include('web.partials.cart_related')



<!-- Quick View Modal -->
@include('web.shop.partials.quick-view-modal')

<!-- Cart Sidebar -->
@include('web.shop.partials.cart-sidebar')
@include('web.shop.partials.toast')



<!-- Banner Carousel -->
<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- First Slide -->
        <div class="carousel-item active">
            <div class="banner-bg"></div>
            <div class="banner-content">
                <div class="banner-text">
                    <!-- <div class="brand-logo">
                        <img src="{{ asset('logo.png') }}" alt="Brand Logo" class="img-fluid" />
                    </div> -->
                    <h1>Taysan & co</h1>
                    <p class="cursive-text">wedding unstitched</p>
                    <div class="live-tag">LIVE NOW</div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="banner-bg" style="background-image: url('assets/crousels/home1.png');"></div>
            <div class="banner-content">
                <div class="banner-text">
                    <h1>Taysan & co</h1>
                    <p class="cursive-text">Autumn Collection</p>
                    <div class="live-tag">SALE</div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="banner-bg" style="background-image: url('assets/crousels/home1.png');"></div>
            <div class="banner-content">
                <div class="banner-text">
                    <h1>Taysan & co</h1>
                    <p class="cursive-text">Formal Wear</p>
                    <div class="live-tag">NEW</div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="banner-bg" style="background-image: url('assets/crousels/home3.jpg');"></div>
            <!-- <div class="banner-content">
                <div class="banner-text">
                    <h1>Taysan & co</h1>
                    <p class="cursive-text">Exclusive Edition</p>
                    <div class="live-tag">HOT</div>
                </div>
            </div> -->
        </div>
    </div>
    
    <!-- Carousel Navigation -->
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<style>
/* Banner Styles */
.carousel {
    position: relative;
    height: 700px;
    overflow: hidden;
}

.carousel-item {
    height: 700px;
    position: relative;
}

.banner-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('assets/crousels/home1.png');
    background-size: cover;
    background-position: center;
    filter: blur(0px); /* Adjust blur value as needed */
}

.banner-content {
    position: relative;
    height: 100%;
    display: flex;
    align-items: center;
    padding: 0 5%;
    z-index: 2;
}

.banner-text {
    text-align: left;
    color: white;
    max-width: 600px;
}

.brand-logo {
    margin-bottom: 2rem;
}

.brand-logo img {
    max-width: 200px;
    height: auto;
}

.banner-text h1 {
    font-size: 3.5rem;
    margin-bottom: 1rem;
    font-weight: 300;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.cursive-text {
    font-family: 'Dancing Script', cursive;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    color: white;
}

.live-tag {
    display: inline-block;
    padding: 10px 25px;
    background-color: white;
    color: #9977B5;
    font-size: 1rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    transition: all 0.3s ease;
}

/* Carousel Controls */
.carousel-control-prev,
.carousel-control-next {
    width: 5%;
    z-index: 3;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(153, 119, 181, 0.5);
    border-radius: 50%;
    padding: 25px;
    transition: all 0.3s ease;
}

/* Responsive Styles */
@media (max-width: 1200px) {
    .carousel, .carousel-item {
        height: 600px;
    }
    
    .banner-text h1 {
        font-size: 3rem;
    }
}

@media (max-width: 992px) {
    .carousel, .carousel-item {
        height: 500px;
    }
    
    .banner-text h1 {
        font-size: 2.5rem;
    }
    
    .cursive-text {
        font-size: 1.8rem;
    }
}

@media (max-width: 768px) {
    .carousel, .carousel-item {
        height: 400px;
    }
    
    .banner-text h1 {
        font-size: 2rem;
    }
    
    .cursive-text {
        font-size: 1.5rem;
    }
    
    .brand-logo img {
        max-width: 150px;
    }
    
    .live-tag {
        padding: 8px 20px;
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .carousel, .carousel-item {
        height: 350px;
    }
    
    .banner-text h1 {
        font-size: 1.8rem;
    }
    
    .cursive-text {
        font-size: 1.2rem;
    }
    
    .brand-logo img {
        max-width: 120px;
    }
    
    .live-tag {
        padding: 6px 15px;
        font-size: 0.8rem;
    }
}
</style>

<!-- Featured Categories Section -->
<section class="home-feat py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="home-feat__card">
                    <div class="home-feat__content">
                        <i class="fas fa-female home-feat__icon"></i>
                        <h3 class="home-feat__title">Women's Fashion</h3>
                        <p class="home-feat__text">Discover latest trends</p>
                        <a href="/shop" class="home-feat__link">Shop Now →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="home-feat__card">
                    <div class="home-feat__content">
                        <i class="fas fa-female home-feat__icon"></i>
                        <h3 class="home-feat__title">Women's Collection</h3>
                        <p class="home-feat__text">Style redefined</p>
                        <a href="/shop" class="home-feat__link">Shop Now →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="home-feat__card">
                    <div class="home-feat__content">
                        <i class="fas fa-gem home-feat__icon"></i>
                        <h3 class="home-feat__title">Accessories</h3>
                        <p class="home-feat__text">Complete your look</p>
                        <a href="/shop" class="home-feat__link">Shop Now →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section - Using your existing grid -->
<section class="home-products py-5">
    <div class="container">
        <div class="home-products__header text-center mb-5">
            <span class="home-products__subtitle">Our Collection</span>
            <h2 class="home-products__title">Featured Products</h2>
        </div>

        <!-- Category Filter -->
        <div class="home-filter mb-4">
            <div class="home-filter__wrap">
                <button class="home-filter__btn active" data-category="all">All Items</button>
                <button class="home-filter__btn" data-category="new">New Arrivals</button>
                <button class="home-filter__btn" data-category="featured">Featured</button>
                <button class="home-filter__btn" data-category="sale">On Sale</button>
            </div>
        </div>

        <!-- Your existing product grid -->
        <div class="ts-product-grid" style="flex: 1 !important; display: grid !important; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)) !important; gap: 1.5rem !important; align-content: start !important; margin-left: 0 !important;">
        @foreach($products as $product)
            <div class="ts-product-card" 
                 data-price="{{ $product->price }}" 
                 data-category="{{ $product->category_id }}"
                 style="background: #fff !important; border-radius: 12px !important; overflow: hidden !important; transition: all 0.3s ease !important; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08) !important; display: flex !important; flex-direction: column !important;">
                
                <div class="ts-product-image-wrapper" style="position: relative !important; padding-top: 100% !important; background: #f8f9fa !important; overflow: hidden !important;">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         style="position: absolute !important; top: 0 !important; left: 0 !important; width: 100% !important; height: 100% !important; object-fit: cover !important; transition: transform 0.5s ease !important;">
                    
                    <button class="ts-quick-view-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#quickViewModal"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-price="{{ $product->price }}"
                            data-description="{{ $product->description }}"
                            data-category="{{ $product->category->name }}"
                            data-image="{{ asset('storage/' . $product->image) }}"
                            style="position: absolute !important; top: 1rem !important; right: 1rem !important; width: 35px !important; height: 35px !important; border-radius: 50% !important; background: rgba(255, 255, 255, 0.9) !important; border: none !important; display: flex !important; align-items: center !important; justify-content: center !important; cursor: pointer !important; transition: all 0.3s ease !important; z-index: 1 !important;">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <div class="ts-product-details" style="padding: 1.25rem !important; display: flex !important; flex-direction: column !important; gap: 0.75rem !important;">
                    <h3 class="ts-product-title" style="font-size: 1.1rem !important; font-weight: 600 !important; color: #333 !important; margin: 0 !important; line-height: 1.4 !important;">
                        {{ $product->name }}
                    </h3>
                    
                    <div class="ts-product-meta" style="display: flex !important; justify-content: space-between !important; align-items: center !important;">
                        <span class="ts-product-category" style="color: #666 !important; font-size: 0.9rem !important;">
                            {{ $product->category->name }}
                        </span>
                        <span class="ts-product-price" style="color: #8D68AD !important; font-weight: 700 !important; font-size: 1.15rem !important;">
                            ${{ number_format($product->price, 2) }}
                        </span>
                    </div>

                    <button class="ts-add-to-cart-btn"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-price="{{ $product->price }}"
                            data-image="{{ asset('storage/' . $product->image) }}"
                            style="width: 100% !important; padding: 0.75rem !important; background: #8D68AD !important; color: #fff !important; border: none !important; border-radius: 6px !important; font-weight: 500 !important; display: flex !important; align-items: center !important; justify-content: center !important; gap: 0.5rem !important; cursor: pointer !important; transition: all 0.3s ease !important; margin-top: auto !important;">
                        <i class="fas fa-shopping-cart"></i>
                        Add to Cart
                    </button>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>

<!-- Sale Banner Section -->
<section class="home-sale py-5">
    <div class="container">
        <div class="home-sale__wrap">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="home-sale__content">
                        <h2 class="home-sale__title">Summer Sale</h2>
                        <p class="home-sale__text">Up to 50% off on selected items</p>
                        <div class="home-sale__timer">
                            <div class="timer-item">
                                <span class="count days">00</span>
                                <span class="label">Days</span>
                            </div>
                            <div class="timer-item">
                                <span class="count hours">00</span>
                                <span class="label">Hours</span>
                            </div>
                            <div class="timer-item">
                                <span class="count minutes">00</span>
                                <span class="label">Minutes</span>
                            </div>
                            <div class="timer-item">
                                <span class="count seconds">00</span>
                                <span class="label">Seconds</span>
                            </div>
                        </div>
                        <a href="/sale" class="home-sale__btn">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Core styles with specific namespacing to avoid conflicts */
.home-feat__card {
    background: #fff;
    border-radius: 15px;
    padding: 2rem;
    height: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.home-feat__card:hover {
    transform: translateY(-5px);
}

.home-feat__icon {
    font-size: 2rem;
    color: #9977B5;
    margin-bottom: 1rem;
    display: block;
}

.home-feat__title {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: #333;
}

.home-feat__text {
    color: #666;
    margin-bottom: 1rem;
}

.home-feat__link {
    color: #9977B5;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.home-feat__link:hover {
    color: #735891;
    padding-left: 5px;
}

/* Products Section */
.home-products__header {
    margin-bottom: 3rem;
}

.home-products__subtitle {
    color: #9977B5;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 0.9rem;
    display: block;
    margin-bottom: 0.5rem;
}

.home-products__title {
    font-size: 2.5rem;
    color: #333;
    font-weight: 300;
}

.home-filter__wrap {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
}

.home-filter__btn {
    padding: 0.8rem 1.5rem;
    border: none;
    background: #f8f9fa;
    color: #666;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.home-filter__btn:hover,
.home-filter__btn.active {
    background: #9977B5;
    color: #fff;
}

/* Sale Banner */
.home-sale__wrap {
    background: linear-gradient(135deg, #9977B5 0%, #735891 100%);
    border-radius: 20px;
    padding: 4rem;
    color: #fff;
}

.home-sale__title {
    font-size: 3rem;
    font-weight: 300;
    margin-bottom: 1rem;
}

.home-sale__text {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    color:white;
}

.home-sale__timer {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
}

.timer-item {
    background: rgba(255,255,255,0.1);
    padding: 1rem;
    border-radius: 10px;
    min-width: 80px;
    text-align: center;
}

.timer-item .count {
    font-size: 1.8rem;
    font-weight: 600;
    display: block;
}

.timer-item .label {
    font-size: 0.9rem;
    opacity: 0.9;
}

.home-sale__btn {
    display: inline-block;
    padding: 1rem 2rem;
    background: #fff;
    color: #9977B5;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.home-sale__btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    color: #9977B5;
}

/* Responsive Adjustments */
@media (max-width: 991px) {
    .home-sale__wrap {
        padding: 3rem;
    }
    
    .home-sale__title {
        font-size: 2.5rem;
    }
}

@media (max-width: 767px) {
    .home-filter__btn {
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
    }
    
    .timer-item {
        min-width: 60px;
        padding: 0.8rem;
    }
    
    .home-sale__title {
        font-size: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Timer functionality
    function updateTimer() {
        const endDate = new Date('2024-02-28T00:00:00').getTime();
        const now = new Date().getTime();
        const timeLeft = endDate - now;

        if (timeLeft > 0) {
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            document.querySelector('.days').textContent = String(days).padStart(2, '0');
            document.querySelector('.hours').textContent = String(hours).padStart(2, '0');
            document.querySelector('.minutes').textContent = String(minutes).padStart(2, '0');
            document.querySelector('.seconds').textContent = String(seconds).padStart(2, '0');
        }
    }

    setInterval(updateTimer, 1000);
    updateTimer();

    // Category filtering
    const filterBtns = document.querySelectorAll('.home-filter__btn');
    const products = document.querySelectorAll('.ts-product-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const category = this.dataset.category;
            products.forEach(product => {
                if (category === 'all' || product.dataset.category === category) {
                    product.style.display = '';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    });
});
</script>

@endsection