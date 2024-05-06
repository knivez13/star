<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Star</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link class="main-css" href="{{ asset('css/style.css') }}" rel="stylesheet">
    @vite([ 'resources/js/app.js'])
</head>

<body>

    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="/" class="brand-logo">
                <img src="/logo2.png" class="logo-abbr">
                <img src="/logo.png" class="brand-title">
            </a>
        </div>
        <div class="header">
            <div class="header-content">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="line"></span><span class="line"></span><span class="line"></span>
                    </div>
                </div>
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                STAR
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell dlab-theme-mode" href="javascript:void(0);">
                                    <i id="icon-light" class="fas fa-sun"></i>
                                    <i id="icon-dark" class="fas fa-moon"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell-link " href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <div class="dropdown header-profile2 ">
                    <a class="nav-link " href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                        <div class="header-info2 d-flex align-items-center">
                            <img src="images/profile/pic1.jpg" alt="">
                            <div class="d-flex align-items-center sidebar-info">
                                <div>
                                    <span class="font-w400 d-block">Franklin Jr</span>
                                    <small class="text-end font-w400">Superadmin</small>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
                <ul class="metismenu" id="menu">
                    <li><a href="/" class="" aria-expanded="false">
                            <i class="fa fa-dashboard"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li><a href="/" class="" aria-expanded="false">
                            <i class="fa fa-file-alt"></i>
                            <span class="nav-text">Traker</span>
                        </a>
                    </li>
                    <li><a href="/" class="" aria-expanded="false">
                            <i class="fa fa-user"></i>
                            <span class="nav-text">Blacklist</span>
                        </a>
                    </li>
                    <li><a href="/" class="" aria-expanded="false">
                            <i class="fa fa-calendar-alt"></i>
                            <span class="nav-text">Daily Logs</span>
                        </a>
                    </li>
                    <li><a href="/" class="" aria-expanded="false">
                            <i class="fa fa-exclamation-triangle"></i>
                            <span class="nav-text">Brifing Logs</span>
                        </a>
                    </li>
                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-gear"></i>
                            <span class="nav-text">Maintenance</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/">Dashboard Light</a></li>
                            <li><a href="index-2.html">Dashboard Dark</a></li>
                            <li><a href="jobs-page.html">Jobs</a></li>
                            <li><a href="application-page.html">Application</a></li>
                            <li><a href="my-profile.html">Profile</a></li>
                            <li><a href="statistics-page.html">Statistics</a></li>
                            <li><a href="compaines.html">Companies</a></li>
                        </ul>

                    </li>
                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-user-tie"></i>
                            <span class="nav-text">User Management</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/">Dashboard Light</a></li>
                            <li><a href="index-2.html">Dashboard Dark</a></li>
                            <li><a href="jobs-page.html">Jobs</a></li>
                            <li><a href="application-page.html">Application</a></li>
                            <li><a href="my-profile.html">Profile</a></li>
                            <li><a href="statistics-page.html">Statistics</a></li>
                            <li><a href="compaines.html">Companies</a></li>
                        </ul>

                    </li>


                </ul>
            </div>
        </div>

        <div class="content-body">
            <div class="container-fluid">
                @yield('content')

            </div>
        </div>

        <div class="footer fixed-bottom" style="height: 30px;">
            <div class="text-center">
                <p>Surveillance Technical and Analytics Report</p>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/dlabnav-init.js') }}"></script>
</body>

</html>