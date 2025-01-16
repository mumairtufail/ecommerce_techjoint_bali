<!-- Top Bar -->
<header id="header" class="wpo-header-style-5 fixed-top">
    <div class="top-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">Free Shipping Nationwide. Call/WhatsApp: +923117317930</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="wpo-site-header navbar-glassmorphism" style="background: rgba(255, 255, 255, 0.95); padding: 0rem 0px;">
        <nav class="navigation navbar navbar-expand-lg">
            <div class="container-fluid px-4">
                <div class="row align-items-center w-100">
                    <!-- Mobile Menu Button -->
                    <div class="col-lg-3 col-md-3 col-3 d-lg-none">
                        <div class="mobile-menu">
                            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar first-angle"></span>
                                <span class="icon-bar middle-angle"></span>
                                <span class="icon-bar last-angle"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Logo -->
                    <div class="col-lg-2 col-md-6 col-6">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ asset('logo.png') }}" alt="logo" class="logo-img">
                            </a>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="col-lg-8 col-md-1 col-1">
                        <div id="navbar" class="collapse navbar-collapse navigation-holder">
                            <button class="menu-close"><i class="ti-close"></i></button>
                            <ul class="nav navbar-nav mb-2 mb-lg-0">
                                <li><a href="{{ route('web.view.index') }}">Home</a></li>
                                <li><a href="{{ route('web.view.shop') }}">Shop</a></li>
                                <li><a href="{{ route('web.view.about') }}">About</a></li>
                                <li><a href="{{ route('web.view.contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Cart Section -->
                    @include('web.partials.cart')
                </div>
            </div>
        </nav>
    </div>
</header>

<style>
/* Top Bar Styling */
.top-bar {
    background-color: #000;
    padding: 8px 0;
}

.top-bar p {
    color: #fff;
    margin: 0;
}

/* Glassmorphism Navbar */
.navbar-glassmorphism {
    background: rgba(255, 255, 255, 0.8) !important;
    backdrop-filter: blur(10px) !important;
    -webkit-backdrop-filter: blur(10px) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1) !important;
    transition: all 0.3s ease;
}


/* Logo Sizing */
.logo-img {
    max-height: 50px;
    width: auto;
    transition: all 0.3s ease;
}

/* Navigation Links */
.navbar-nav li a {
    color: #333 !important;
    font-weight: 500;
    padding: 1.5rem 1rem !important;
    transition: all 0.3s ease;
}

.navbar-nav li a:hover {
    color: #666 !important;
}

/* Mobile Menu Button */
.navbar-toggler {
    border: none;
    padding: 0;
    cursor: pointer;
}

.icon-bar {
    display: block;
    width: 25px;
    height: 2px;
    background: #333;
    margin: 5px 0;
    transition: all 0.3s ease;
}

/* Add some spacing for the fixed header */
body {
    padding-top: 120px; /* Increased to account for top bar */
}

/* For smaller screens */
@media (max-width: 991px) {
    .logo-img {
        max-height: 40px;
    }
    
    .wpo-site-header {
        padding: 0.3rem 0;
    }
    
    .navigation-holder {
        background: rgba(255, 255, 255, 0.95);
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        padding: 1rem;
        z-index: 1000;
    }
    
    body {
        padding-top: 100px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.navbar-glassmorphism');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.style.background = 'rgba(255, 255, 255, 0.95)';
            header.style.padding = '0.3rem 0';
        } else {
            header.style.background = 'rgba(255, 255, 255, 0.8)';
            header.style.padding = '0.5rem 0';
        }
    });
});
</script>