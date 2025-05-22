<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Tayson - @yield('title')</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard/favicon.ico') }}">
    <link rel="icon" href="{{ asset('dashboard/favicon.ico') }}" type="image/x-icon">
    
    <!-- Toggles CSS -->
    <link href="{{ asset('dashboard/vendors/jquery-toggles/css/toggles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/vendors/jquery-toggles/css/themes/toggles-light.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Toastr CSS -->
    <link href="{{ asset('dashboard/vendors/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Morris Charts CSS -->
    <link href="{{ asset('dashboard/vendors/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- DataTables CSS -->
    <link href="{{ asset('dashboard/vendors/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Custom CSS -->
    <link href="{{ asset('dashboard/dist/css/style.css') }}" rel="stylesheet" type="text/css">

    <!-- Additional Styles -->
    @stack('styles')

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .hk-wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
        .hk-pg-wrapper {
            flex: 1;
        }
        :root {
    --ts-primary: #8D68AD;
    --ts-primary-light: #A587C1;
    --ts-primary-dark: #735891;
    --ts-white: #ffffff;
    --ts-black: #333333;
    --ts-gray: #666666;
    --ts-light-gray: #f5f5f5;
}

   .breadcrumb a {
        color: var(--ts-primary);
    }

    </style>
    
</head>

<body>
    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-alt-nav">
        <!-- Top Navbar -->
        @include('admin.partials.top-navbar')
        <!-- /Top Navbar -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Container -->
            @yield('content')
            <!-- /Container -->
            
            <!-- Footer -->
            @include('admin.partials.footer')
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->
    </div>
    <!-- /HK Wrapper -->

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('dashboard/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Init JavaScript -->
    <script src="{{ asset('dashboard/dist/js/init.js') }}"></script>

    <!-- CSRF Token Setup -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
<!-- jQuery -->
<script src="{{ asset('dashboard/vendors/jquery/dist/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('dashboard/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('dashboard/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Slimscroll JavaScript -->
<script src="{{ asset('dashboard/dist/js/jquery.slimscroll.js') }}"></script>

<!-- Fancy Dropdown JS -->
<script src="{{ asset('dashboard/dist/js/dropdown-bootstrap-extended.js') }}"></script>

<!-- FeatherIcons JavaScript -->
<script src="{{ asset('dashboard/dist/js/feather.min.js') }}"></script>

<!-- Toggles JavaScript -->
<script src="{{ asset('dashboard/vendors/jquery-toggles/toggles.min.js') }}"></script>
<script src="{{ asset('dashboard/dist/js/toggle-data.js') }}"></script>

<!-- Counter Animation JavaScript -->
<script src="{{ asset('dashboard/vendors/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('dashboard/vendors/jquery.counterup/jquery.counterup.min.js') }}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{ asset('dashboard/vendors/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('dashboard/vendors/morris.js/morris.min.js') }}"></script>

<!-- EChartJS JavaScript -->
<script src="{{ asset('dashboard/vendors/echarts/dist/echarts-en.min.js') }}"></script>

<!-- Owl JavaScript -->
<script src="{{ asset('dashboard/vendors/owl.carousel/dist/owl.carousel.min.js') }}"></script>

<!-- Toastr JS -->
<script src="{{ asset('dashboard/vendors/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

<!-- Init JavaScript -->
<script src="{{ asset('dashboard/dist/js/init.js') }}"></script>
<script src="{{ asset('dashboard/dist/js/dashboard4-data.js') }}"></script>

    @stack('scripts')
</body>
</html>