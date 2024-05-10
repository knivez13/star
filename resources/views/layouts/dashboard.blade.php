<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Bonjour De Guzman - Senior Full Stack Developer">
    <link rel="icon" href="{{ asset('./logo2.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->

    <title>Central One - HRIS</title>
    <link rel="stylesheet" href="{{ asset('./css/vendors_css.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/skin_color.css') }}">
    @vite(['resources/js/app.js'])
    @yield('style')

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

    <div class="wrapper">
        <div id="loader"></div>

        <header class="main-header">
            <div class="d-flex align-items-center logo-box justify-content-start">
                <a href="#" class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent" data-toggle="push-menu" role="button">
                    <i data-feather="menu"></i>
                </a>
                <!-- Logo -->
                <a href="#" class="logo">
                    <div class="logo-lg">
                        <span class="light-logo"><img src="{{ asset('./logo3.png') }}"></span>
                    </div>
                </a>
            </div>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <div class="app-menu">
                    <ul class="header-megamenu nav">
                        <li class="btn-group nav-item d-md-none">
                            <a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu" role="button">
                                <i data-feather="menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="navbar-custom-menu r-side">
                    <ul class="nav navbar-nav">
                        <li class="btn-group nav-item d-lg-flex d-none align-items-center">
                            <p class="mb-0 text-fade pe-10 pt-5">{{date("l, jS F Y")}}</p>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar position-relative">
                <div class="user-profile px-20 py-10">
                    <div class="d-flex align-items-center">
                        <div class="image">
                            <img src="{{ asset('./logo2.png') }}" class="avatar avatar-lg bg-primary-light rounded100" alt="User Image">
                        </div>
                        <div class="info">
                            <a class="px-20" href="#">{{ Auth::user()->emp_id }}</a>
                        </div>
                    </div>
                    <ul class="list-inline profile-setting mt-20 mb-0 d-flex justify-content-between">
                        <li><a href="#" data-bs-toggle="tooltip" title="settings"><i data-feather="settings"></i></a></li>
                        <li><a href="#" data-bs-toggle="tooltip" title="Notification"><i data-feather="bell"></i></a></li>

                        <li><a href="#" data-bs-toggle="tooltip" title="Profile"><i data-feather="user"></i></a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-bs-toggle="tooltip" title="Logout"><i data-feather="log-out"></i></a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
                <div class="multinav">
                    <div class="multinav-scroll" style="height: 100%;">
                        <!-- sidebar menu-->
                        <ul class="sidebar-menu" data-widget="tree">
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="si si-grid"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li class="treeview">
                                <a href="#">
                                    <i class="si si-paper-clip"></i>
                                    <span>Upload Excel</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="icon-Briefcase"><span class="path1"></span><span class="path2"></span></i>Employee</a></li>
                                    <li><a href="#"><i class="icon-Briefcase"><span class="path1"></span><span class="path2"></span></i>Schedule</a></li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                </div>
            </section>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper ">
            <div class="container-full fs-13">
                @yield('content')
            </div>
        </div>

        <footer class="main-footer">
            <div class="pull-right d-none d-sm-inline-block">
                <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">STAR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">V1</a>
                    </li>
                </ul>
            </div>
            &copy; {{date("Y")}} <a href="#">D' Heights</a>. All Rights Reserved.
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    <script src="{{ asset('./js/vendors.min.js') }}"></script>
    <script src="{{ asset('./js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('./assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('./js/template.js') }}"></script>
    @yield('script')
</body>

</html>