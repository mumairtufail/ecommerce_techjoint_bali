<!-- Start Footer -->
<footer class="cs_footer cs_style_1">
    <div class="cs_height_130 cs_height_lg_80"></div>
    <div class="container">
        <div class="cs_footer_main">
            <div class="row">
                <div class="col-xxl-3 col-lg-3">
                    <div class="cs_footer_widget cs_text_widget">
                        <img src="{{ asset('web/assets/img/logo.png') }}" alt="Logo" style="height:60px; width:auto; max-width:180px; object-fit:contain; display:block; background:#9C7541; border-radius:8px; padding:4px;">
                        <p>Discover endless delights your one stop eCommerce destination.</p>
                        {{-- <img src="" alt="Payment"> --}}
                    </div>
                </div>
                <div class="col-xxl-7 offset-xxl-2 offset-lg-1 col-lg-8">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="cs_footer_widget cs_menu_widget">
                                <h3 class="cs_footer_widget_title cs_fs_21 cs_semibold">Get to know</h3>
                                <ul>
                                                                      <li><a href="/">Home</a></li>

                                    <li><a href="{{ route('web.view.about') }}">About Us</a></li>
                                    <li><a href="{{ route('web.view.shop') }}">Product</a></li>
                                    <li><a href="{{ route('web.view.contact') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cs_footer_widget cs_menu_widget">
                                {{-- <h3 class="cs_footer_widget_title cs_fs_21 cs_semibold">Customer Service</h3> --}}
                                {{-- <ul>
                                    <li><a href="{{ route('web.view.help') }}">Help Center</a></li>
                                    <li><a href="{{ route('web.view.shipping') }}">Shipping & Delivery</a></li>
                                    <li><a href="{{ route('web.view.returns') }}">Exchange & Return</a></li>
                                    <li><a href="{{ route('web.view.payment') }}">Payment Method</a></li>
                                </ul> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cs_footer_widget cs_menu_widget">
                                <h3 class="cs_footer_widget_title cs_fs_21 cs_semibold">Contact Information</h3>
                                <ul class="cs_contact_info">
                                    <li>Call: +00(244)14-50-774</li>
                                    <li>Email: <a href="mailto:info@sattiyas.com">info@sattiyas.com</a></li>
                                    <li>Mon – Fri: 11:00 – 19:00</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cs_footer_bottom">
            <div>
                <p class="cs_copywrite_text mb-0">Copyright © {{ date('Y') }}, All rights reserved.</p>
            </div>
            <div>
                <ul class="cs_footer_menu_widget_2">
                    <li><a href="">Privacy Policy</a></li>
                    <li><a href="">Terms of Use</a></li>
                    <li><a href="">Legal</a></li>
                </ul>
            </div>
            <div>
                <div class="cs_social_links">
                    <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://twitter.com/" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->