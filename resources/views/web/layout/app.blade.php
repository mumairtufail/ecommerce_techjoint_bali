<!DOCTYPE html>
<html lang="en">

@include('web.partials.head')
<script src="{{ asset('js/cart-manager.js') }}"></script>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">
        <!-- start preloader -->
        <div class="preloader">
            <div class="vertical-centered-box">
                <div class="content">
                    <div class="loader-circle"></div>
                    <div class="loader-line-mask">
                        <div class="loader-line"></div>
                    </div>
                    <img src="assets/images/preloader.png" alt="">
                </div>
            </div>
        </div>
        <!-- end preloader -->
    @include('web.partials.navbar')


    <!-- all content for pages extensd here -->
       @yield('content')
    <!-- all content for pages extensd here -->

        <!-- start of wpo-site-footer-section -->
       @include('web.partials.footer')
        <!-- end of wpo-site-footer-section -->

        <!-- popup-quickview  -->
      @include('web.partials.quickview')
        <!-- end of popup-quickview -->

    </div>
    <!-- end of page-wrapper -->

@include('web.partials.scripts')

</body>

</html>