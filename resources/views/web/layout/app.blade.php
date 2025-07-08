<!DOCTYPE html>
<html lang="en">

@include('web.partials.head')
<!-- Required CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<body>
@include('toast')
<!-- Include cart components -->
@include('web.shop.partials.cart-sidebar')
@include('web.shop.partials.floating-cart')
@include('web.shop.partials.toast')

<!-- Cart Styles -->
<link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">

<!-- Cart Functionality -->
<script src="{{ asset('assets/js/cart.js') }}"></script>
    <!-- start page-wrapper -->
    <div class="page-wrapper">
        <!-- start preloader -->
       <!-- Place this at the beginning of your body tag -->
 <!-- Start Preloader -->
  {{-- <div class="cs_perloader">
    <div class="cs_perloader_in">
      <svg class="cs_cart_animation" role="img" aria-label="Sattiyas Preloader" viewBox="0 0 128 128" width="128px" height="128px" xmlns="http://www.w3.org/2000/svg">
        <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="8">
          <g class="cs_cart_track" stroke="hsla(0,10%,10%,0.1)">
            <polyline points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80" />
            <circle cx="43" cy="111" r="13" />
            <circle cx="102" cy="111" r="13" />
          </g>
          <g class="cs_cart_lines" stroke="currentColor">
            <polyline class="cs_cart_top" points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80" stroke-dasharray="338 338" stroke-dashoffset="-338" />
            <g class="cs_cart_wheel_1" transform="rotate(-90,43,111)">
              <circle class="cs_cart_wheel_stroke" cx="43" cy="111" r="13" stroke-dasharray="81.68 81.68" stroke-dashoffset="81.68" />
            </g>
            <g class="cs_cart_wheel_2" transform="rotate(90,102,111)">
              <circle class="cs_cart_wheel_stroke" cx="102" cy="111" r="13" stroke-dasharray="81.68 81.68" stroke-dashoffset="81.68" />
            </g>
          </g>
        </g>
      </svg>
      <span class="cs_perloader_text">Welcome to Sattiyas. Loading...</span>
    </div>
  </div> --}}
  <!-- End Preloader -->

        <!-- end preloader -->
    @include('web.partials.navbar')

    <!-- all content for pages extensd here -->
       @yield('content')
    <!-- all content for pages extensd here -->

        <!-- start of wpo-site-footer-section -->
       @include('web.partials.footer')
        <!-- end of wpo-site-footer-section -->

    </div>
    <!-- end of page-wrapper -->

@include('web.partials.scripts')
@stack('scripts')

</body>

</html>