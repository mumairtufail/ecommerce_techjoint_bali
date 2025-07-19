<!-- filepath: d:\ecommerce\resources\views\admin\partials\top-navbar.blade.php -->
<!-- filepath: d:\ecommerce\resources\views\admin\partials\top-navbar.blade.php -->
<style>
    /* Theme Colors - Updated to match logo */
    :root {
        --primary: #9C7541;
        --primary-hover: #8A6639;
        --primary-active: #775730;
        --primary-light: #F5F2ED;
        --primary-dark: #371502;
        --text-primary: #371502;
        --text-secondary: #5A4A3A;
        --text-muted: #8A7A6A;
        --bg-light: #FAFAF9;
        --bg-lighter: #F5F2ED;
        --border-color: #E8E2D8;
        --border-light: #F0EAE0;
        --danger: #dc3545;
        --success: #28a745;
        --warning: #ffc107;
        --info: #17a2b8;
    }

    /* Base Navbar Styles */
    .navbar {
        padding: 0.5rem 1rem;
        z-index: 1040;
        background-color: #fff;
        border-bottom: 1px solid var(--border-color);
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
        color: var(--text-secondary);
        transition: color 0.3s ease;
        font-weight: 500;
    }

    .nav-link:hover {
        color: var(--primary);
    }

    .nav-item.active .nav-link {
        color: var(--primary);
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
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 2px;
    }

    /* Button Styles */
    .btn-primary, .custom-btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-hover)) !important;
        border-color: var(--primary) !important;
        color: white !important;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-primary:hover, .custom-btn-primary:hover {
        background: linear-gradient(135deg, var(--primary-hover), var(--primary-active)) !important;
        border-color: var(--primary-hover) !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(156, 117, 65, 0.3);
    }

    .btn-primary:active, .btn-primary:focus,
    .custom-btn-primary:active, .custom-btn-primary:focus {
        background: linear-gradient(135deg, var(--primary-active), var(--primary-dark)) !important;
        border-color: var(--primary-active) !important;
        box-shadow: 0 0 0 0.2rem rgba(156, 117, 65, 0.25) !important;
    }

    /* Dropdown Styles */
    .dropdown-menu {
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 20px rgba(55, 21, 2, 0.1);
        border-radius: 8px;
        padding: 0.5rem 0;
        min-width: 200px;
        z-index: 1045;
        background-color: #fff;
    }

    .dropdown-item {
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    .dropdown-item:hover {
        background-color: var(--primary-light);
        color: var(--primary);
        transform: translateX(5px);
    }

    .dropdown-item i {
        margin-right: 10px;
        font-size: 18px;
        color: var(--text-muted);
    }

    .dropdown-item:hover i {
        color: var(--primary);
    }

    /* Avatar Styles */
    .avatar {
        width: 40px;
        height: 40px;
        position: relative;
        border: 2px solid var(--border-color);
        border-radius: 50%;
        overflow: hidden;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-initial {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        color: var(--primary-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
    }

    /* Notification Styles */
    .custom-dropdown-notifications {
        position: relative;
    }

    .custom-notification-dropdown {
        width: 320px;
        position: absolute;
        right: 0;
        margin-top: 15px;
        z-index: 1050;
        box-shadow: 0 4px 20px rgba(55, 21, 2, 0.15);
        border-radius: 8px;
        padding: 0;
        border: 1px solid var(--border-color);
        background-color: #fff;
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        padding: 2px 6px;
        font-size: 10px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-radius: 10px;
        min-width: 16px;
        text-align: center;
        font-weight: 600;
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        background: var(--bg-light);
        border-bottom: 1px solid var(--border-light);
        border-radius: 8px 8px 0 0;
    }

    .notification-header span {
        font-weight: 600;
        color: var(--text-primary);
    }

    .notification-header .mark-all-read {
        color: var(--primary);
        font-size: 12px;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .notification-header .mark-all-read:hover {
        color: var(--primary-hover);
    }

    .notification-body {
        max-height: 350px;
        overflow-y: auto;
        padding: 0;
    }

    .notification-item {
        padding: 12px 15px;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: flex-start;
        transition: all 0.3s ease;
        cursor: pointer;
        background-color: #fff;
    }

    .notification-item:hover {
        background-color: var(--bg-light);
    }

    .notification-item.unread {
        background-color: var(--primary-light);
        border-left: 3px solid var(--primary);
    }

    .notification-avatar {
        width: 40px;
        height: 40px;
        margin-right: 12px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid var(--border-color);
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

    .notification-sender {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 13px;
    }

    .notification-time {
        font-size: 11px;
        color: var(--text-muted);
    }

    .notification-message {
        font-size: 12px;
        color: var(--text-secondary);
        line-height: 1.4;
    }

    .delete-notification {
        color: var(--text-muted);
        padding: 4px;
        background: none;
        border: none;
        transition: color 0.3s ease;
    }

    .delete-notification:hover {
        color: var(--danger);
    }

    /* Bell icon styling */
    .bi-bell {
        color: var(--text-secondary);
        transition: color 0.3s ease;
    }

    .nav-link:hover .bi-bell {
        color: var(--primary);
    }

    /* Mobile Toggle Button */
    .mobile-toggle {
        display: none;
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
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .navbar-toggle-btn:hover {
        background-color: var(--primary-light);
    }

    .feather-icon i {
        color: var(--text-secondary);
        font-size: 24px;
        transition: color 0.3s ease;
    }

    .navbar-toggle-btn[aria-expanded="true"] .feather-icon i {
        color: var(--primary);
    }

    /* Mobile Styles */
    @media (max-width: 1200px) {
        .mobile-toggle {
            display: block;
            margin-left: auto;
        }

        .navbar-toggle-btn {
            width: 40px;
            height: 40px;
            border-radius: 6px;
        }

        .navbar-brand {
            margin-right: 0;
        }

        .hk-navbar-content {
            margin-left: auto;
            display: flex;
            align-items: center;
        }

        .dropdown-authentication .media-body {
            display: none;
        }

        .avatar {
            width: 35px;
            height: 35px;
        }

        /* Mobile Navigation */
        .navbar-nav .nav-link {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-light);
        }

        .navbar-nav .nav-link:hover {
            background-color: var(--primary-light);
        }

        .navbar-nav .nav-link i {
            width: 24px;
            font-size: 18px;
            margin-right: 12px;
            text-align: center;
            color: var(--text-muted);
        }

        .navbar-nav .nav-item.active .nav-link {
            background-color: var(--primary-light);
            border-left: 3px solid var(--primary);
        }

        .navbar-nav .nav-item.active .nav-link i {
            color: var(--primary);
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

        /* Mobile Profile */
        .mobile-profile-header {
            padding: 15px;
            background-color: var(--bg-light);
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid var(--border-light);
        }

        .mobile-profile-header:hover {
            background-color: var(--primary-light);
        }

        .mobile-profile-header .avatar {
            width: 45px;
            height: 45px;
            margin-right: 15px;
        }

        .mobile-profile-header .user-info span {
            font-size: 14px;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
            font-weight: 600;
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

        /* Mobile Notifications */
        .mobile-notification {
            display: flex;
            align-items: center;
        }

        .custom-notification-dropdown {
            position: fixed;
            top: 70px;
            left: 15px;
            right: 15px;
            width: auto;
            margin: 0;
            max-height: calc(100vh - 80px);
        }

        .notification-body {
            max-height: calc(70vh - 100px);
        }

        /* Mobile Logout */
        .mobile-logout {
            border-top: 2px solid var(--border-color);
            margin-top: 10px;
        }

        .mobile-logout .nav-link {
            color: var(--danger) !important;
            font-weight: 600;
        }

        .mobile-logout .nav-link:hover {
            background-color: #ffebee;
        }
    }

    @media (max-width: 576px) {
        .navbar {
            padding: 0.5rem;
        }

        .navbar-logo {
            height: 60px;
            margin-left: 0;
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

    /* Hidden elements on different screen sizes */
    .mobile-notification {
        display: none;
    }

    @media (max-width: 1200px) {
        .mobile-notification {
            display: flex;
        }
    }

    @media (min-width: 1200px) {
        .mobile-logout {
            display: none;
        }
    }

    /* Additional enhancements for better visual hierarchy */
    .dropdown-divider {
        border-top: 1px solid var(--border-light);
        margin: 0.5rem 0;
    }

    /* Chevron icon styling */
    .zmdi-chevron-down {
        color: var(--text-muted);
        transition: color 0.3s ease;
        margin-left: 8px;
    }

    .dropdown-toggle:hover .zmdi-chevron-down {
        color: var(--primary);
    }

    /* Media body styling for desktop profile */
    .media-body span {
        color: var(--text-primary);
        font-weight: 500;
    }

    /* View all notifications link */
    .dropdown-item.text-center.text-primary {
        color: var(--primary) !important;
        font-weight: 600;
        border-top: 1px solid var(--border-light);
        margin-top: 0.5rem;
    }

    .dropdown-item.text-center.text-primary:hover {
        background-color: var(--primary-light);
        transform: none;
    }
</style>

<nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar hk-navbar-alt">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('logo.png') }}" alt="ecommerce" class="navbar-logo">
    </a>

    <div class="collapse navbar-collapse" id="navbarCollapseAlt">
        <ul class="navbar-nav">
            <!-- Mobile Profile Header -->
            <li class="nav-item d-xl-none mobile-profile-section">
                <div class="dropdown-header d-flex align-items-center mobile-profile-header"
                    onclick="window.location.href=''">
                    <div class="avatar mr-3">
                        @if (Auth::user()->profile_picture)
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

            <!-- Navigation Items -->
            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="zmdi zmdi-view-home d-xl-none"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.products.index') }}">
                    <i class="fa fa-cube d-xl-none"></i>
                    <span>Products</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.categories.index') }}">
                    <i class="fa fa-tags d-xl-none"></i>
                    <span>Categories</span>
                </a>
            </li>

            {{-- <li class="nav-item {{ request()->routeIs('admin.sizes.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.sizes.index') }}">
                    <i class="fa fa-expand-arrows-alt d-xl-none"></i>
                    <span>Sizes</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.colors.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.colors.index') }}">
                    <i class="fa fa-palette d-xl-none"></i>
                    <span>Colors</span>
                </a>
            </li> --}}

            <li class="nav-item {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.orders.index') }}">
                    <i class="fa fa-shopping-cart d-xl-none"></i>
                    <span>Orders</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.queries.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.queries.index') }}">
                    <i class="fa fa-envelope d-xl-none"></i>
                    <span>Queries</span>
                </a>
            </li>

            {{-- <li class="nav-item {{ request()->routeIs('settings.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('settings.index') }}">
                    <i class="fa fa-cog d-xl-none"></i>
                    <span>Settings</span>
                </a>
            </li> --}}

            <!-- Mobile Logout -->
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
        <!-- Desktop Notifications -->
        <li class="nav-item dropdown custom-dropdown-notifications d-none d-xl-block">
            <a class="nav-link dropdown-toggle no-caret mt-3" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
                <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
                <span class="badge badge-danger notification-badge notification-count" style="display: none;"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right custom-notification-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                <div class="notification-header">
                    <span>Notifications</span>
                    <a href="#" class="mark-all-read">Mark all as read</a>
                </div>
                <div class="notification-body"></div>
                <a href="#" class="dropdown-item text-center text-primary">View all</a>
            </div>
        </li>

        <!-- Desktop Profile -->
        <li class="nav-item dropdown dropdown-authentication d-none d-xl-block">
            <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div class="media">
                    <div class="media-img-wrap">
                        <div class="avatar">
                            @if (Auth::user()->profile_picture)
                                <img src="https://limostorage.s3.ap-southeast-2.amazonaws.com/{{ Auth::user()->profile_picture }}"
                                    alt="{{ Auth::user()->first_name }}" class="avatar-img rounded-circle">
                            @else
                                <div class="avatar-initial rounded-circle">
                                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="media-body">
                        <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<i class="zmdi zmdi-chevron-down"></i></span>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                <a class="dropdown-item" href="">
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

        <!-- Mobile Notifications -->
        <li class="nav-item dropdown custom-dropdown-notifications d-xl-none mobile-notification">
            <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-bell"></i>
                <span class="badge badge-danger notification-badge notification-count" style="display: none;"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right custom-notification-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                <div class="notification-header">
                    <span>Notifications</span>
                    <a href="#" class="mark-all-read">Mark all as read</a>
                </div>
                <div class="notification-body"></div>
                <a href="#" class="dropdown-item text-center text-primary">View all</a>
            </div>
        </li>

        <!-- Mobile Toggle -->
        <li class="nav-item d-xl-none mobile-toggle">
            <button class="navbar-toggle-btn" data-toggle="collapse" data-target="#navbarCollapseAlt"
                aria-controls="navbarCollapseAlt" aria-expanded="false" aria-label="Toggle navigation">
                <span class="feather-icon"><i data-feather="menu"></i></span>
            </button>
        </li>
    </ul>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const updateNotificationCount = (count) => {
        count = parseInt(count) || 0;
        const $notificationCount = $('.notification-count');
        if (count > 0) {
            $notificationCount.text(count).show();
        } else {
            $notificationCount.hide();
        }
    };

    const loadNotifications = () => {
        $.get('/notifications/latest')
            .done(function(data) {
                const wrapper = $('.notification-body');
                wrapper.empty();

                if (!data.notifications || data.notifications.length === 0) {
                    wrapper.append('<div class="notification-item text-center"><p class="text-muted mb-0">No notifications</p></div>');
                    updateNotificationCount(0);
                    return;
                }

                let unreadCount = 0;
                data.notifications.forEach(notification => {
                    if (!notification.is_read) unreadCount++;

                    const profilePic = notification.sender.profile_picture ?
                        `https://limostorage.s3.ap-southeast-2.amazonaws.com/${notification.sender.profile_picture}` :
                        '/default-avatar.png';

                    wrapper.append(`
                        <div class="notification-item ${!notification.is_read ? 'unread' : ''}" 
                             data-id="${notification.id}" data-type="${notification.type}" 
                             data-sender-email="${notification.sender.email}">
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

    loadNotifications();
    setInterval(loadNotifications, 30000);

    // Event handlers
    $(document).on('click', '.notification-item', function(e) {
        if (!$(e.target).closest('.delete-notification').length) {
            const item = $(this);
            const id = item.data('id');
            const type = item.data('type');
            const senderEmail = item.data('sender-email');

            $.post(`/notifications/${id}/mark-as-read`, () => {
                switch (type) {
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

    $(document).click(function(event) {
        const $navbar = $(".navbar-collapse");
        if ($navbar.hasClass("show")) {
            if (!$(event.target).closest('.navbar-collapse').length &&
                !$(event.target).closest('.navbar-toggler').length) {
                $navbar.collapse('hide');
            }
        }
    });
});
</script>