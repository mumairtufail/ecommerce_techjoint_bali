<!-- Start header -->
        <header id="header" class="wpo-header-style-5">
            <!-- end topbar -->
            <div class="wpo-site-header">
                <nav class="navigation navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-3 col-3 d-lg-none dl-block">
                                <div class="mobail-menu">
                                    <button type="button" class="navbar-toggler open-btn">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar first-angle"></span>
                                        <span class="icon-bar middle-angle"></span>
                                        <span class="icon-bar last-angle"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6">
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="index.html"><img src="{{ asset('assets/images/logo.svg') }}" alt="logo"></a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-1 col-1">
                                <div id="navbar" class="collapse navbar-collapse navigation-holder">
                                    <button class="menu-close"><i class="ti-close"></i></button>
                                    <ul class="nav navbar-nav mb-2 mb-lg-0">
                                    <li><a href="{{ route('web.view.index') }}">Home</a></li>

                                        <li><a href="{{ route('web.view.shop') }}">Shop</a></li>
                                        <li><a href="{{ route('web.view.about') }}">About</a></li>
                                        <li><a href="{{ route('web.view.contact') }}">Contact Us</a></li>
                                    </ul>
                                </div><!-- end of nav-collapse -->
                            </div>
                          @include('web.partials.cart')
                        </div>
                    </div><!-- end of container -->
                </nav>
            </div>
        </header>
        <!-- end of header -->
