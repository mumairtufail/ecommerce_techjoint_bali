@extends('web.layout.app')
@section('content')
@include('web.partials.cart_related')


<!-- start shop-page-banner -->
@if(isset($shopBanner) && $shopBanner->image)
<section class="shop-page-banner" style="background: url('{{ asset('storage/'.$shopBanner->image) }}') no-repeat center center/cover;">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="shop-banner-content">
                    <h2 class="shop-banner-title">{{ $shopBanner->title ?? 'Shop' }}</h2>
                    <ol class="shop-banner-breadcrumb">
                        <!-- <li><a href="{{ url('/') }}">{{ $shopBanner->subtitle ?? 'Home' }}</a></li> -->
                        <!-- <li>about</li> -->
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<section class="shop-page-banner">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="shop-banner-content">
                    <h2 class="shop-banner-title">Shop</h2>
                    <ol class="shop-banner-breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li>Shop</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<style>
.shop-page-banner {
    position: relative;
    padding: 120px 0 80px; /* Increased top padding to account for navbar */
    background-color: #f5f5f5;
    margin-top: 0; /* Remove any top margin */
    z-index: 1; /* Ensure banner is above default elements */
    min-height: 300px; /* Minimum height for the banner */
    display: flex;
    align-items: center;
}

.shop-banner-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 15px;
    position: relative; /* Ensure content stays above background */
    z-index: 2;
}

.shop-banner-title {
    font-size: 48px;
    color: #fff;
    margin-bottom: 15px;
    font-weight: 700;
    text-transform: capitalize;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.shop-banner-breadcrumb {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}

.shop-banner-breadcrumb li {
    color: #fff;
    font-size: 16px;
    position: relative;
}

.shop-banner-breadcrumb li a {
    color: #fff;
    text-decoration: none;
}

.shop-banner-breadcrumb li:not(:last-child)::after {
    content: "/";
    margin-left: 10px;
    color: #fff;
}

/* Tablet Responsive */
@media (max-width: 768px) {
    .shop-page-banner {
        padding: 100px 0 60px; /* Adjusted padding for mobile */
        min-height: 250px;
    }
    
    .shop-banner-title {
        font-size: 36px;
    }
    
    .shop-banner-breadcrumb li {
        font-size: 14px;
    }
}

/* Mobile Responsive */
@media (max-width: 480px) {
    .shop-page-banner {
        padding: 80px 0 40px;
        min-height: 200px;
    }
    
    .shop-banner-title {
        font-size: 28px;
    }
    
    .shop-banner-breadcrumb li {
        font-size: 13px;
    }
}
</style>

<!-- Added desktop banner margin fix -->
<style>
@media (min-width: 992px) {
    .shop-page-banner {
        margin-top: 130px !important;
    }
}
</style>


<div class="ts-shop-wrapper" style="display: flex !important; gap: 2rem !important; padding: 2rem !important; min-height: 100vh !important; position: relative !important; flex-direction: row !important;">

<!-- Filters Section -->
@include('web.shop.partials.filters')

<!-- Products Grid -->
@include('web.shop.partials.products-grid')

<!-- Quick View Modal -->
@include('web.shop.partials.quick-view-modal')

<!-- Cart Sidebar -->
@include('web.shop.partials.cart-sidebar')

<!-- Floating Cart Button -->
{{-- @include('web.shop.partials.floating-cart') --}}

<!-- Toast Notification -->
@include('web.shop.partials.toast')
</div>

<!-- Include JavaScript -->
<script src="{{ asset('assets/js/shop.js') }}"></script>
<script>
    // Adjust sticky behavior on mobile
function adjustStickyFilter() {
    const filterContainer = document.querySelector('.ts-filter-section').parentElement;
    if (window.innerWidth <= 768) {
        filterContainer.style.position = 'static';
        filterContainer.style.height = 'auto';
    } else {
        filterContainer.style.position = 'sticky';
        filterContainer.style.height = 'calc(100vh - 40px)';
    }
}

// Listen for resize events
window.addEventListener('resize', adjustStickyFilter);
// Initial call
adjustStickyFilter();
    </script>


<style>
/* Responsive Styles */
@media (max-width: 1024px) {
    .ts-shop-wrapper {
        padding: 1rem !important;
        gap: 1rem !important;
    }

    .ts-product-grid {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)) !important;
    }
}

@media (max-width: 768px) {
    .ts-shop-wrapper {
        flex-direction: column !important;
        padding: 1rem !important;
    }

    .ts-filters-container {
        width: 100% !important;
        position: relative !important;
        height: auto !important;
        margin-bottom: 1rem !important;
    }

    .ts-filter-section {
        width: 100% !important;
        min-width: 100% !important;
    }

    .ts-product-grid {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)) !important;
        gap: 1rem !important;
    }

    /* Adjust product card styles for mobile */
    .ts-product-card {
        margin-bottom: 1rem !important;
    }

    .ts-product-details {
        padding: 1rem !important;
    }

    .ts-product-title {
        font-size: 1rem !important;
    }

    .ts-product-price {
        font-size: 1rem !important;
    }

    .ts-add-to-cart-btn {
        padding: 0.5rem !important;
        font-size: 0.9rem !important;
    }
}

@media (max-width: 480px) {
    .ts-shop-wrapper {
        padding: 0.5rem !important;
    }

    .ts-product-grid {
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)) !important;
        gap: 0.5rem !important;
    }

    .ts-product-image-wrapper {
        padding-top: 100% !important;
    }

    .ts-quick-view-btn {
        width: 30px !important;
        height: 30px !important;
    }
}
</style>

<script>
// Responsive handling
function handleResponsiveLayout() {
    const wrapper = document.querySelector('.ts-shop-wrapper');
    const filtersContainer = document.querySelector('.ts-filters-container');
    const isMobile = window.innerWidth <= 768;

    if (isMobile) {
        // Mobile layout adjustments
        wrapper.style.flexDirection = 'column';
        filtersContainer.style.position = 'relative';
        filtersContainer.style.height = 'auto';
        filtersContainer.style.width = '100%';
    } else {
        // Desktop layout
        wrapper.style.flexDirection = 'row';
        filtersContainer.style.position = 'sticky';
        filtersContainer.style.height = 'calc(100vh - 40px)';
        filtersContainer.style.width = '300px';
    }
}

// Listen for window resize
window.addEventListener('resize', handleResponsiveLayout);
// Initial call
handleResponsiveLayout();

// Add touch support for mobile
if ('ontouchstart' in window) {
    document.querySelectorAll('.ts-product-card').forEach(card => {
        card.addEventListener('touchstart', () => {
            card.querySelector('.ts-quick-view-btn').style.opacity = '1';
        });
        
        card.addEventListener('touchend', () => {
            setTimeout(() => {
                card.querySelector('.ts-quick-view-btn').style.opacity = '0';
            }, 300);
        });
    });
}
</script>
@push('scripts')
<script src="{{ asset('js/cart-manager.js') }}"></script>
@endpush

@endsection