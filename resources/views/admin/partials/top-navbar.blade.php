<!-- Navbar HTML Structure -->
<style>
    .badge {
    padding: 0.2rem 0.5rem !important;
    font-weight: 500 !important;
}
                            .custom-btn-primary {
                                background-color: #8365A0 !important;
                                border-color: #8365A0 !important;
                                color: white !important;
                                transition: all 0.3s ease;
                            }

                            .custom-btn-primary:hover {
                                background-color: #d62f26 !important;
                                border-color: #d62f26 !important;
                                transform: translateY(-1px);
                                box-shadow: 0 2px 5px rgba(245, 59, 49, 0.2);
                            }

                            .custom-btn-primary:active,
                            .custom-btn-primary:focus {
                                background-color: #c52820 !important;
                                border-color: #c52820 !important;
                                box-shadow: 0 0 0 0.2rem rgba(245, 59, 49, 0.25) !important;
                            }
                        </style>
<style>
    /* Theme Colors */
:root {
    /* Primary Colors */
    --primary: #8365A0;
    --primary-hover: #d62f26;
    --primary-active: #c52820;
    --primary-light: #fff1f0;
    --primary-dark: #b2231c;

    /* Secondary Colors */
    --secondary: #5b6be8;
    --secondary-light: #e3e7fc;
    --secondary-hover: #4a5ad7;

    /* Neutral Colors */
    --text-primary: #333333;
    --text-secondary: #666666;
    --text-muted: #888888;
    
    /* Background Colors */
    --bg-light: #f8f9fa;
    --bg-lighter: #f1f1f1;
    
    /* Border Colors */
    --border-color: #dee2e6;
    --border-light: #eee;

    /* Status Colors */
    --success: #28a745;
    --danger: #dc3545;
    --warning: #ffc107;
    --info: #17a2b8;
}

/* Update dropdown styling */
/* .dropdown-menu {
    border: none !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
    border-radius: 8px !important;
    padding: 0.5rem 0 !important;
    min-width: 200px !important;
} */

.dropdown-item {
    padding: 0.75rem 1.5rem !important;
    transition: all 0.3s ease !important;
    color: var(--text-primary) !important;
}

.dropdown-item:hover {
    background-color: var(--primary-light) !important;
    color: var(--primary) !important;
    transform: translateX(5px);
}

.dropdown-item.active,
.dropdown-item:active {
    background-color: var(--primary) !important;
    color: white !important;
}

/* Active state for dropdown parent */
.nav-item.dropdown.active .nav-link {
    color: var(--primary) !important;
    font-weight: 600 !important;
}

.nav-item.dropdown.active .nav-link::after {
    background: var(--primary) !important;
}

/* Consistent active states */
.nav-item.active .nav-link {
    color: var(--primary) !important;
    font-weight: 600 !important;
}

.nav-item .nav-link:hover {
    color: var(--primary) !important;
}

/* Button styling */
.btn-primary {
    background-color: var(--primary) !important;
    border-color: var(--primary) !important;
    color: white !important;
}

.btn-primary:hover {
    background-color: var(--primary-hover) !important;
    border-color: var(--primary-hover) !important;
}

.btn-primary:active,
.btn-primary:focus {
    background-color: var(--primary-active) !important;
    border-color: var(--primary-active) !important;
    box-shadow: 0 0 0 0.2rem rgba(245, 59, 49, 0.25) !important;
}

/* Update User Management dropdown specific styles */
.navbar-nav .dropdown-item i {
    margin-right: 10px !important;
    font-size: 18px !important;
    color: inherit !important;
}

/* Ensure consistency in active states */
.navbar-nav .nav-item.active .nav-link::after,
.navbar-nav .nav-item .nav-link:hover::after {
    background: var(--primary) !important;
}

/* Base notification dropdown styles */
.custom-notification-dropdown {
    width: 320px;
    position: absolute;
    right: 0;
    margin-top: 15px;
    z-index: 1050;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

/* Tablet view adjustments (768px to 1199px) */
@media (min-width: 768px) and (max-width: 1199px) {
    .custom-dropdown-notifications {
        position: relative;
    }

    .custom-notification-dropdown {
        width: 300px;
        right: -10px;
        margin-top: 10px !important;
        max-height: calc(90vh - 70px);
        overflow-y: auto;
    }

    .notification-body {
        max-height: 350px;
    }

    .notification-item {
        padding: 12px 15px;
    }
}

/* Small tablet and large mobile adjustments */
@media (max-width: 767px) {
    .custom-dropdown-notifications {
        position: static;
    }

    .custom-notification-dropdown {
        width: calc(100vw - 30px);
        position: fixed;
        top: 70px;
        left: 15px;
        right: 15px;
        margin-top: 0 !important;
        max-height: calc(90vh - 80px);
    }

    .notification-body {
        max-height: calc(70vh - 100px);
    }
}

/* Mobile specific adjustments */
@media (max-width: 576px) {
    .custom-notification-dropdown {
        top: 65px;
    }

    .notification-item {
        padding: 10px 12px;
    }

    .notification-avatar {
        width: 35px;
        height: 35px;
        margin-right: 10px;
    }
}

/* Ensure proper z-index stacking */
.navbar {
    z-index: 1040;
}

.dropdown-menu {
    z-index: 1045;
}

/* Fix notification badge positioning */
.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    padding: 2px 4px;
    font-size: 10px;
    line-height: 1;
    min-width: 16px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Improve dropdown arrow positioning */
.dropdown-menu::before {
    content: '';
    position: absolute;
    top: -8px;
    right: 20px;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-bottom: 8px solid white;
}
</style>

<!-- filepath: f:\work\taysan\resources\views\admin\partials\top-navbar.blade.php -->
<nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar hk-navbar-alt">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('logo.png') }}" alt="taysan" class="navbar-logo">
    </a>

    <div class="collapse navbar-collapse" id="navbarCollapseAlt">
        <ul class="navbar-nav">
            <!-- Mobile Profile Header (New) -->
            <li class="nav-item d-xl-none mobile-profile-section">
                <div class="dropdown-header d-flex align-items-center mobile-profile-header" onclick="window.location.href='{{ route('settings.index') }}'">
                    <div class="avatar mr-3">
                        @if(Auth::user()->profile_picture)
                            <img src="https://limostorage.s3.ap-southeast-2.amazonaws.com/{{ Auth::user()->profile_picture }}" 
                                 alt="{{ Auth::user()->first_name }}" class="avatar-img rounded-circle">
                        @else
                            <div class="avatar-initial rounded-circle">
                                {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="user-info">
                        <span class="d-block font-weight-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="zmdi zmdi-view-home d-xl-none"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.products.index') }}">
                    <i class="fa fa-cube d-xl-none"></i>
                    <span>Products</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.orders.index') }}">
                    <i class="fa fa-shopping-cart d-xl-none"></i>
                    <span>Orders</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('settings.index') }}">
                    <i class="fa fa-cog d-xl-none"></i>
                    <span>Settings</span>
                </a>
            </li>
            <!-- Mobile-only logout button -->
            <li class="nav-item d-xl-none">
                <form method="POST" action="{{ route('admin.logout') }}" class="mobile-logout">
                    @csrf
                    <a class="nav-link" href="{{ route('admin.logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="dropdown-icon zmdi zmdi-power"></i>
                        <span>Log out</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>

    <ul class="navbar-nav hk-navbar-content">
        <!-- Notifications Dropdown -->
        <!-- Desktop-only notifications -->
        <li class="nav-item dropdown custom-dropdown-notifications d-none d-xl-block">
            <a class="nav-link dropdown-toggle no-caret mt-3" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img src="" alt="Notifications" class="notification-icon">
                <span class="badge badge-danger notification-badge notification-count" style="display: none;"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right custom-notification-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                <div class="notification-header">
                    <span>Notifications</span>
                    <a href="#" class="mark-all-read">Mark all as read</a>
                </div>
                <div class="notification-body">
                    <!-- Notifications will be loaded here -->
                </div>
                <a href="#" class="dropdown-item text-center text-primary">View all</a>
            </div>
        </li>

        <!-- User Profile Dropdown -->
        <!-- Desktop-only profile -->
        <li class="nav-item dropdown dropdown-authentication d-none d-xl-block">
            <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media">
                    <div class="media-img-wrap">
                        <div class="avatar">
                            @if(Auth::user()->profile_picture)
                                <img src="https://limostorage.s3.ap-southeast-2.amazonaws.com/{{ Auth::user()->profile_picture }}" 
                                     alt="{{ Auth::user()->first_name }}" class="avatar-img rounded-circle">
                            @else
                                <div class="avatar-initial rounded-circle">
                                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <!-- <span class="badge badge-success badge-indicator"></span> -->
                    </div>
                    <div class="media-body">
                        <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<i class="zmdi zmdi-chevron-down"></i></span>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                <a class="dropdown-item" href="{{ route('settings.index') }}">
                    <i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span>
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <a class="dropdown-item" href="{{ route('admin.logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span>
                    </a>
                </form>
            </div>
        </li>

        <!-- Mobile Notifications (New) -->
        <li class="nav-item dropdown custom-dropdown-notifications d-xl-none mobile-notification">
            <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img src="" alt="Notifications" class="notification-icon">
                <span class="badge badge-danger notification-badge notification-count" style="display: none;"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right custom-notification-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                <!-- Same content as desktop notifications -->
                <div class="notification-header">
                    <span>Notifications</span>
                    <a href="#" class="mark-all-read">Mark all as read</a>
                </div>
                <div class="notification-body">
                    <!-- Notifications will be loaded here -->
                </div>
                <a href="#" class="dropdown-item text-center text-primary">View all</a>
            </div>
        </li>

        <!-- Mobile Toggle Button -->
        <li class="nav-item d-xl-none mobile-toggle">
            <button class="navbar-toggle-btn" data-toggle="collapse"
                data-target="#navbarCollapseAlt" aria-controls="navbarCollapseAlt" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="feather-icon"><i data-feather="menu"></i></span>
            </button>
        </li>
    </ul>
</nav>

<!-- CSS Styles -->
<style>
    /* Mobile Toggle Button Styles */
.mobile-toggle {
    display: none; /* Hidden by default on desktop */
}

.navbar-toggle-btn {
    background: none;
    border: none;
    padding: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 10px;
}

.feather-icon {
    display: flex;
    align-items: center;
    justify-content: center;
}

.feather-icon i {
    color: #333;
    font-size: 24px;
    transition: color 0.3s ease;
}

/* Media Queries for Mobile */
@media (max-width: 1200px) {
    .mobile-toggle {
        display: block;
        margin-left: auto; /* Push to the right */
    }

    .navbar-toggle-btn {
        width: 40px;
        height: 40px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .navbar-toggle-btn:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .feather-icon i {
        width: 24px;
        height: 24px;
    }
}

/* Small Mobile Devices */
@media (max-width: 576px) {
    .mobile-toggle {
        margin-left: 5px; /* Less spacing on very small screens */
    }

    .navbar-toggle-btn {
        width: 35px;
        height: 35px;
        padding: 6px;
    }

    .feather-icon i {
        width: 20px;
        height: 20px;
    }
}

/* Active State */
.navbar-toggle-btn[aria-expanded="true"] .feather-icon i {
    color: #8365A0; /* Changes color when menu is open */
}
/* Base Navbar Styles */
.navbar {
    padding: 0.5rem 1rem;
}

.navbar-brand {
    padding: 4px 0;
    margin-right: 5rem;
    display: flex;
    align-items: center;
}

.navbar-logo {
    height: 55px;
    width: auto;
    margin-left: 50px;
    object-fit: contain;
}

.navbar-nav {
    margin-left: 20px;
}

/* Navigation Links */
.nav-link {
    position: relative;
    padding: 0.5rem 1rem;
    color: #555;
    transition: color 0.3s ease;
}

.nav-item.active .nav-link {
    color: #8365A0;
    font-weight: 600;
}

.nav-item.active .nav-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 95%;
    height: 3px;
    margin-left: 2px;
    background: #8365A0;
    border-radius: 2px;
    transform: scaleX(1);
}

/* Dropdown Styles */
.dropdown-menu {
    border: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    padding: 0.5rem 0;
    min-width: 200px;
}

.dropdown-item {
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.dropdown-item i {
    margin-right: 10px;
    font-size: 18px;
}

/* Avatar & Profile Styles */
.avatar {
    width: 40px;
    height: 40px;
    position: relative;
}

.avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-initial {
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, #e3e7fc, #d1d7fb);
    color: #5b6be8;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
}

/* Add this to your existing styles and remove the previous notification styles */
.custom-dropdown-notifications {
    position: relative;
}

.custom-dropdown-notifications .nav-link {
    padding: 0.5rem;
    position: relative;
}

.custom-dropdown-notifications .zmdi-notifications-none {
    font-size: 20px;
    color: #555;
}

.notification-badge {
    position: absolute;
    top: 0;
    right: 0;
    transform: translate(25%, -25%);
    padding: 1px 3px; /* Make the red badge smaller */
    font-size: 10px;
    background: #8365A0;
    color: white;
    border-radius: 10px;
    min-width: 15px;
    text-align: center;
}

.custom-notification-dropdown {
    width: 320px;
    padding: 0;
    margin-top: 10px;
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

.notification-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    background: #f8f9fa;
    border-bottom: 1px solid #eee;
    border-radius: 8px 8px 0 0;
}

.notification-header span {
    font-weight: 600;
    color: #333;
}

.notification-header .mark-all-read {
    color: #8365A0;
    font-size: 12px;
    text-decoration: none;
}

.notification-body {
    max-height: 350px;
    overflow-y: auto;
    padding: 0;
}

.notification-item {
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: flex-start;
    transition: all 0.3s ease;
    cursor: pointer;
    background-color: #fff; /* Default white background for read notifications */
}

.notification-item:hover {
    background-color: #f8f9fa;
}

.notification-item.unread {
    background-color: #fff8f8; /* Light red background for unread notifications */
}

@media (max-width: 1200px) {
    .notification-item {
        background-color: #fff; /* Ensure read notifications are white on mobile */
    }

    .notification-item.unread {
        background-color: #fff8f8; /* Keep unread notifications light red */
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }
}

.notification-avatar {
    width: 40px;
    height: 40px;
    margin-right: 12px;
    border-radius: 50%;
    overflow: hidden;
}

.notification-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.notification-content {
    flex: 1;
}

.notification-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
}

.notification-time {
    font-size: 11px;
    color: #888;
}

.notification-sender {
    font-weight: 600;
    color: #333;
    font-size: 13px;
}

.notification-message {
    font-size: 12px;
    color: #666;
    line-height: 1.4;
}

.notification-actions {
    margin-left: 8px;
}

.delete-notification {
    color: #999;
    padding: 4px;
    background: none;
    border: none;
    transition: color 0.3s ease;
}

.delete-notification:hover {
    color: #8365A0;
}

/* Add media queries for mobile responsiveness */
@media (max-width: 768px) {

    .hk-wrapper .hk-navbar .navbar-nav .dropdown-menu {
        position: absolute;
        margin-top: 18px;
    }
    .custom-notification-dropdown {
        /* width: 90vw;
        left: 5vw !important;
        right: 5vw !important; */
        margin-top: 5px;
    }
    .notification-body {
        max-height: 50vh;
    }
    .notification-item {
        padding: 10px;
    }
    .notification-avatar {
        width: 35px;
        height: 35px;
        margin-right: 10px;
    }
    .notification-sender {
        font-size: 14px;
    }
    .notification-message {
        font-size: 12px;
    }
    .notification-time {
        font-size: 10px;
    }
    .notification-header {
        padding: 10px;
    }
    .notification-header span {
        font-size: 16px;
    }
    .notification-header .mark-all-read {
        font-size: 12px;
    }
}

@media (max-width: 576px) {
    .custom-notification-dropdown {
         width: max-content;
        /* left: 0 !important;
        right: 0 !important; */ */
        margin-top: 5px;
    }
    .notification-body {
        max-height: 50vh;
    }
    .notification-item {
        padding: 8px;
    }
    .notification-avatar {
        width: 30px;
        height: 30px;
        margin-right: 8px;
    }
    .notification-sender {
        font-size: 13px;
    }
    .notification-message {
        font-size: 11px;
    }
    .notification-time {
        font-size: 9px;
    }
    .notification-header {
        padding: 8px;
    }
    .notification-header span {
        font-size: 15px;
    }
    .notification-header .mark-all-read {
        font-size: 11px;
    }
}

/* Update your notification styles for better responsiveness */
.custom-notification-dropdown {
    width: 320px;
    max-width: 90vw;
    position: absolute;
    right: 0;
    margin-top: 10px;
}

@media (max-width: 576px) {
    .custom-notification-dropdown {
        width: calc(100vw - 30px);
        position: fixed;
        top: 60px; /* Adjust based on your navbar height */
        right: 15px;
        left: 15px;
        margin-top: 0;
    }

    .notification-body {
        max-height: calc(80vh - 120px);
        overflow-y: auto;
    }

    .notification-item {
        padding: 12px;
    }

    .notification-avatar {
        width: 32px;
        height: 32px;
    }

    .notification-message {
        font-size: 13px;
        line-height: 1.3;
    }
}

/* Add this for better dropdown positioning */
.custom-dropdown-notifications {
    position: static;
}

@media (min-width: 577px) {
    .custom-dropdown-notifications {
        position: relative;
    }
}

/* Improve notification badge positioning */
.notification-badge {
    position: absolute;
    top: 0;
    right: 0;
    transform: translate(25%, -25%);
}

.notification-icon {
    width: 24px; /* Match the hamburger icon size */
    height: 24px;
}

/* Media Queries */
@media (max-width: 1200px) {
    .hk-wrapper .hk-navbar.hk-navbar-alt.navbar-light .navbar-collapse{
        margin-top:10px;
    }
    .hk-wrapper .hk-navbar .navbar-nav .dropdown-menu {
        position: absolute;
        margin-top: 16px;
    }
    .navbar-brand {
        margin-right: 0;
    }

    .hk-navbar-content {
        margin-left: auto;
        display: flex;
        align-items: center;
        /* gap: 10px; */
    }

    .dropdown-authentication .media-body {
        display: none;
    }

    .avatar {
        width: 35px;
        height: 35px;
    }
}

@media (max-width: 576px) {
    .hk-wrapper .hk-navbar .navbar-nav .dropdown-menu {
        position: absolute;
        margin-top: 18px;
    }
    .navbar {
        padding: 0.5rem;
    }

    .navbar-logo {
        height: 60px;
        margin-left: 0;
    }

    .custom-notification-dropdown {
        width: calc(100vw - 30px);
        position: fixed;
        top: 60px;
        right: 15px;
        left: 15px;
        margin-top: 0;
    }

    .notification-body {
        max-height: calc(80vh - 120px);
    }
}
.mt-15 {
    margin-top: 30px !important;
}

@media (max-width: 1200px) {
    .mobile-profile-section {
        border-top: 1px solid var(--border-light);
        margin-top: 1rem;
        padding-top: 1rem;
    }

    .mobile-profile-section .nav-link {
        padding: 0.75rem 1rem;
    }

    .mobile-profile-section .media {
        align-items: center;
    }

    .mobile-profile-section .avatar {
        width: 40px;
        height: 40px;
        margin-right: 12px;
    }

    .navbar-nav .nav-link i {
        width: 20px;
        margin-right: 10px;
        text-align: center;
    }

    .navbar-nav .nav-item:not(.mobile-profile-section) .nav-link {
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
    }

    .dropdown-menu {
        margin-top: 0 !important;
        border-radius: 0;
        box-shadow: none;
        border-left: 3px solid var(--primary);
        background-color: var(--bg-lighter);
    }
}

@media (max-width: 1200px) {
    .hk-navbar-content {
        margin-left: auto !important;
    }
}

/* Updated Mobile Styles */
@media (max-width: 1200px) {
    .navbar-nav .nav-link {
        padding: 12px 16px;
        display: flex;
        align-items: center;
        color: var(--text-primary);
    }

    .navbar-nav .nav-link i {
        width: 24px;
        font-size: 18px;
        margin-right: 12px;
        text-align: center;
    }

    .mobile-badge {
        position: relative;
        top: -2px;
        right: auto;
        margin-left: 8px;
        transform: none;
    }

    .dropdown-header {
        padding: 12px 16px;
        background: var(--bg-lighter);
    }

    .user-info {
        overflow: hidden;
    }

    .user-info span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .navbar-nav .dropdown-menu {
        border: none;
        border-left: 3px solid var(--primary);
        border-radius: 0;
        background: var(--bg-lighter);
        margin: 0;
        padding: 0;
    }

    .dropdown-item {
        padding: 12px 16px;
        border-bottom: 1px solid var(--border-light);
    }

    .dropdown-item:last-child {
        border-bottom: none;
    }

    .notification-body {
        max-height: 300px;
        overflow-y: auto;
    }

    .avatar {
        width: 32px;
        height: 32px;
    }

    .notification-item {
        padding: 12px 16px;
        border-bottom: 1px solid var(--border-light);
    }
}

/* Mobile notification styles */
.mobile-notification {
    display: none;
}

@media (max-width: 1200px) {
    .mobile-notification {
        display: flex;
        align-items: center;
        margin-right: 0; /* Remove right margin */
    }

    /* Align notification and hamburger buttons */
    .hk-navbar-content {
        display: flex;
        align-items: center;
        gap: 0; /* Remove gap between icons */
    }

    .mobile-toggle {
        margin-left: 0;
    }

    /* Adjust dropdown position for mobile */
    .mobile-notification .custom-notification-dropdown {
        position: fixed;
        /* top: 70px; 
        left: 15px;
        right: 15px;
        width: auto; */
        margin: 0;
        max-height: calc(100vh - 80px); /* Prevent overflow */
        overflow-y: auto;
    }
}

@media (max-width: 576px) {
    .mobile-notification {
        margin-right: 0;
    }

    .navbar-toggle-btn, 
    .mobile-notification .nav-link {
        width: 35px;
        height: 35px;
    }

    .mobile-notification .notification-icon {
        width: 20px;
        height: 20px;
    }

    /* Adjust dropdown position for smaller screens */
    .mobile-notification .custom-notification-dropdown {
        top: 65px;
    }
}

/* Update dropdown positioning for all screen sizes */
.custom-notification-dropdown {
    margin-top: 15px !important; /* Force margin-top */
    z-index: 1030; /* Ensure dropdown appears above other elements */
}

/* Mobile Profile Header Styles */
@media (max-width: 1200px) {
    .mobile-profile-header {
        padding: 15px;
        background-color: #f8f9fa;
    }

    .mobile-profile-header .avatar {
        width: 45px;
        height: 45px;
        margin-right: 15px;
    }

    .mobile-profile-header .avatar-img,
    .mobile-profile-header .avatar-initial {
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .mobile-profile-header .avatar-initial {
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-light);
        color: var(--primary);
        font-size: 18px;
        font-weight: 600;
    }

    .mobile-profile-header .user-info {
        overflow: hidden;
    }

    .mobile-profile-header .user-info span {
        font-size: 14px;
        color: var(--text-primary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }

    .mobile-profile-header .user-info small {
        font-size: 12px;
        color: var(--text-muted);
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }

    .dropdown-divider {
        margin: 0;
        border-top-color: var(--border-light);
    }
}

@media (max-width: 576px) {
    .mobile-profile-header .avatar {
        width: 40px;
        height: 40px;
        margin-right: 12px;
    }

    .mobile-profile-header .user-info span {
        font-size: 13px;
        max-width: 160px;
    }

    .mobile-profile-header .user-info small {
        font-size: 11px;
        max-width: 160px;
    }
}

/* Mobile Logout Styles */
.mobile-logout {
    border-top: 1px solid var(--border-light);
    margin-top: 10px;
}

.mobile-logout .nav-link {
    color: var(--danger) !important;
    padding: 12px 16px;
    display: flex;
    align-items: center;
}

.mobile-logout .nav-link i {
    width: 24px;
    font-size: 18px;
    margin-right: 12px;
    text-align: center;
}

/* Hide mobile logout on desktop */
@media (min-width: 1200px) {
    .mobile-logout {
        display: none;
    }
}

/* Remove the existing logout button that was showing in both views */
.nav-item.settings-logout {
    display: none;
}

@media (max-width: 1200px) {
    .nav-item.settings-logout {
        display: block;
    }
}

/* Profile Avatar Link Styles */
.mobile-profile-header .avatar {
    cursor: pointer;
    transition: transform 0.2s ease;
    text-decoration: none;
}

.mobile-profile-header .avatar:hover {
    transform: scale(1.05);
}

.mobile-profile-header .avatar:active {
    transform: scale(0.95);
}

/* Remove default anchor styles */
.mobile-profile-header .avatar,
.mobile-profile-header .avatar:hover,
.mobile-profile-header .avatar:focus {
    text-decoration: none;
    color: inherit;
}

/* Mobile Profile Header Styles */
.mobile-profile-header {
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.mobile-profile-header:hover {
    background-color: var(--primary-light);
}

.mobile-profile-header:active {
    background-color: var(--bg-lighter);
}

.mobile-profile-section .mobile-profile-header {
    padding: 15px;
    display: flex;
    align-items: center;
}

.mobile-profile-section .mobile-profile-header * {
    pointer-events: none; /* Prevents click events on children */
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Include CSRF token in AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Function to update the notification count
    const updateNotificationCount = (count) => {
        count = parseInt(count) || 0; // Ensure count is treated as a number
        const $notificationCount = $('.notification-count');

        if (count > 0) {
            $notificationCount.text(count).show();
        } else {
            $notificationCount.hide();
        }
    };

    // Load notifications and update the count
    const loadNotifications = () => {
        $.get('/notifications/latest')
            .done(function(data) {
                const wrapper = $('.notification-body');
                wrapper.empty();

                if (!data.notifications || data.notifications.length === 0) {
                    wrapper.append(`
                        <div class="notification-item text-center">
                            <p class="text-muted mb-0">No notifications</p>
                        </div>
                    `);
                    updateNotificationCount(0);
                    return;
                }

                let unreadCount = 0;

                data.notifications.forEach(notification => {
                    if (!notification.is_read) {
                        unreadCount++;
                    }

                    const profilePic = notification.sender.profile_picture 
                        ? `https://limostorage.s3.ap-southeast-2.amazonaws.com/${notification.sender.profile_picture}`
                        : '/default-avatar.png';

                    wrapper.append(`
                        <div 
                            class="notification-item ${!notification.is_read ? 'unread' : ''}" 
                            data-id="${notification.id}" 
                            data-type="${notification.type}" 
                            data-sender-email="${notification.sender.email}"
                        >
                            <div class="notification-avatar">
                                <img src="${profilePic}" alt="Profile picture">
                            </div>
                            <div class="notification-content">
                                <div class="notification-meta">
                                    <span class="notification-sender">${notification.sender.name}</span>
                                    <span class="notification-time">${notification.time}</span>
                                </div>
                                <div class="notification-message">${notification.message}</div>
                            </div>
                        </div>
                    `);
                });

                updateNotificationCount(unreadCount);
            })
            .fail(function() {
                console.error('Error fetching notifications');
            });
    };

    // Initial load
    loadNotifications();

    // Refetch notifications every 30 seconds
    setInterval(() => {
        loadNotifications();
    }, 30000);

    // Event handlers
    $(document).on('click', '.notification-item', function(e) {
        if (!$(e.target).closest('.delete-notification').length) {
            const item = $(this);
            const id = item.data('id');
            const type = item.data('type');
            const senderEmail = item.data('sender-email');

            // Simply mark as read without updating UI
            $.post(`/notifications/${id}/mark-as-read`, () => {
                // Redirect based on notification type
                switch(type) {
                    case 'new_user':
                    case 'user_update':
                    case 'vehicle_update':
                        window.location.href = `/users?search=${encodeURIComponent(senderEmail)}`;
                        break;

                    case 'new_ride':
                    case 'update_ride':
                        window.location.href = `/rides?search=${encodeURIComponent(senderEmail)}`;
                        break;
                    default:
                        console.log('Unknown notification type:', type);
                        break;
                }
            });
        }
    });

    $(document).on('click', '.delete-notification', function(e) {
        e.stopPropagation();
        const item = $(this).closest('.notification-item');
        const id = item.data('id');

        $.ajax({
            url: `/notifications/${id}`,
            method: 'DELETE',
            success: function() {
                if (item.hasClass('unread')) {
                    const currentCount = parseInt($('.notification-count').text()) - 1;
                    updateNotificationCount(currentCount);
                }
                item.fadeOut(300, function() {
                    $(this).remove();
                });
            }
        });
    });

    $('.mark-all-read').click(function(e) {
        e.preventDefault();
        $.post('/notifications/mark-all-read', function() {
            $('.notification-item.unread').removeClass('unread');
            updateNotificationCount(0);
        });
    });

    // Close the navbar menu when clicking outside of it
    $(document).click(function(event) {
        const $navbar = $(".navbar-collapse");
        const $toggler = $(".navbar-toggler");
        
        // Check if navbar is expanded
        if ($navbar.hasClass("show")) {
            // Check if click is outside navbar and not on toggler
            if (!$(event.target).closest('.navbar-collapse').length && 
                !$(event.target).closest('.navbar-toggler').length) {
                $navbar.collapse('hide');
            }
        }
    });
});
</script>

<style>
    /* Status Badge Base Style */
.status-badge {
    min-width: 100px !important;
    height: 28px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 12px !important;
    padding: 0 12px !important;
    border-radius: 4px !important;
    font-weight: 500 !important;
    text-transform: capitalize !important;
}

/* Status Colors with Consistent Styling */
.status-badge.badge-warning,
.status-badge.badge-pending {
    background-color: #fff5e6 !important;
    color: #ffc107 !important;
}

.status-badge.badge-success,
.status-badge.badge-completed {
    background-color: #e8f5e9 !important;
    color: #28a745 !important;
}

.status-badge.badge-danger,
.status-badge.badge-cancelled,
.status-badge.badge-rejected {
    background-color: #fde9e9 !important;
    color: #dc3545 !important;
}

.status-badge.badge-info,
.status-badge.badge-in_process {
    background-color: #e8f4ff !important;
    color: #0077ff !important;
}
</style>