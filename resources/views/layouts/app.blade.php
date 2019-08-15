<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $set->site_name }}</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:css -->
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/horizontal-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>

<body>
<div class="container-scroller">
    <!-- partial:../../partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
            <div class="container">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="{{ route('home') }}"><img src="{{ asset($set->site_logo) }}" alt="logo"/></a>
                    <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{ asset($set->site_logo) }}" alt="logo"/></a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item count-indicator nav-profile dropdown">
                            <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                                <span class="nav-profile-name">Hi, {{ auth()->user() ? auth()->user()->name : '' }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a href="{{ route('profile.index') }}" class="dropdown-item text-primary">
                                    <i class="mdi mdi-face-profile"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item text-primary" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi mdi-logout text-primary"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </div>
        </nav>
        <nav class="bottom-navbar">
            <div class="container">
                <ul class="nav page-navigation">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    @can('customer-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-face menu-icon"></i>
                                <span class="menu-title">Customers</span>
                                <i class="menu-arrow"></i></a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    @can('customer-create')
                                    <li class="nav-item"><a class="nav-link" href="{{ route('customer.create') }}">Add Customer</a></li>
                                    @endcan
                                    <li class="nav-item"><a class="nav-link" href="{{ route('customer.index') }}">Browse Customers</a></li>
                                </ul>
                            </div>
                        </li>
                    @endcan
                    @can('sale-type-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="mdi mdi-finance menu-icon"></i>
                            <span class="menu-title">Sale Types</span>
                            <i class="menu-arrow"></i></a>
                        <div class="submenu">
                            <ul class="submenu-item">
                                @can('sale-type-create')
                                <li class="nav-item"><a class="nav-link" href="{{ route('sale-type.create') }}">Add Sale Type</a></li>
                                @endcan
                                <li class="nav-item"><a class="nav-link" href="{{ route('sale-type.index') }}">Browse Sale Types</a></li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    @can('vehicle-record-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                            <span class="menu-title">Vehicles Record</span>
                            <i class="menu-arrow"></i></a>
                        <div class="submenu">
                            <ul class="submenu-item">
                                @can('vehicle-record-create')
                                <li class="nav-item"><a class="nav-link" href="{{ route('vehicle-record.create') }}">Add Vehicle Record</a></li>
                                @endcan
                                <li class="nav-item"><a class="nav-link" href="{{ route('vehicle-record.index') }}">Browse Vehicle Records</a></li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="mdi mdi-file-document-box-multiple-outline menu-icon"></i>
                            <span class="menu-title">Reports</span>
                            <i class="menu-arrow"></i></a>
                        <div class="submenu">
                            <ul class="submenu-item">
                                <li class="nav-item"><a class="nav-link" href="{{ route('pending.report') }}">Pending Payment Report</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('received.report') }}">Received Payment Report</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('vehicle.report') }}">Vehicle Report</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('sales.report') }}">Sales Report</a></li>
                            </ul>
                        </div>
                    </li>
                    @can('user-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                            <span class="menu-title">User Management</span>
                            <i class="menu-arrow"></i></a>
                        <div class="submenu">
                            <ul class="submenu-item">
                                @can('user-list')
                                <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}">Users</a></li>
                                @endcan
                                @can('role-list')
                                <li class="nav-item"><a class="nav-link" href="{{ route('role-permission.index') }}">Roles & Permissions</a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                    @endcan
                    @can('settings')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting.create') }}">
                            <i class="mdi mdi-settings menu-icon"></i>
                            <span class="menu-title">Settings</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </nav>
    </div>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            @yield('content')
            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
                <div class="container">
                    <div class="w-100 clearfix">
                        <span class="d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018. All rights reserved.</span>
                    </div>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- base:js -->
<script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ asset('js/off-canvas.js') }}"></script>
<script src="{{ asset('js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>
<script src="{{ asset('js/settings.js') }}"></script>
<script src="{{ asset('js/todolist.js') }}"></script>
@stack('scripts')
<!-- endinject -->
<!-- plugin js for this page -->
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<!-- End custom js for this page-->
</body>

</html>
