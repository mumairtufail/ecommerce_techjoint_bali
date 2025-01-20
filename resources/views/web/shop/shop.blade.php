@extends('web.layout.app')
@section('content')



<!-- start wpo-page-title -->
@if(isset($shopBanner) && $shopBanner->image)
<section class="wpo-page-title" style="background: url('{{ asset('storage/'.$shopBanner->image) }}') no-repeat center center/cover;">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap" style="margin-left:600px !important">
                    <h2>{{ $shopBanner->title ?? 'Shop' }}</h2>
                    <ol class="wpo-breadcumb-wrap">
                        <!-- <li><a href="{{ url('/') }}">{{ $shopBanner->subtitle ?? 'Home' }}</a></li> -->
                        <!-- <li>about</li> -->
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
                    <h2>about us</h2>
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="index.html">Home</a></li>
                        <li>about</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
@endif
<!-- end page-title -->
<style>
/* Responsive Styles */
@media (max-width: 768px) {
    .wpo-page-title {
        padding: 50px 0 !important;
    }
    
    .wpo-page-title h2 {
        font-size: 32px !important;
    }
    
    .wpo-breadcumb-wrap {
        font-size: 14px !important;
        margin-left: 0px !important;

    }
}

@media (max-width: 480px) {
    .wpo-page-title {
        padding: 40px 0 !important;
    }
    
    .wpo-page-title h2 {
        font-size: 28px !important;
    }
    
    .wpo-breadcumb-wrap {
        font-size: 13px !important;
        margin-left: 0px !important;

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