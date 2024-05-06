<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Star</title>

    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link class="main-css" href="css/style.css" rel="stylesheet">

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
                                <i class="fas fa-chevron-down"></i>
                            </div>

                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="/" class="dropdown-item ai-icon ">

                            <span class="ms-2">Profile </span>
                        </a>
                        <a href="/" class="dropdown-item ai-icon">

                            <span class="ms-2">Inbox </span>
                        </a>
                        <a href="/" class="dropdown-item ai-icon">

                            <span class="ms-2">Logout </span>
                        </a>
                    </div>
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
            <!-- row -->
            <div class="container-fluid">

            </div>
        </div>

        <div class="footer">
            <div class="copyright">
                <p>Surveillance Technical and Analytics Report</p>
            </div>
        </div>



    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Job Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Company Name<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="Name" aria-label="name">
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Position<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="Name" aria-label="name">
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Job Category<span class="text-danger scale5 ms-2">*</span></label>
                            <select class="nice-select default-select wide form-control solid">
                                <option selected>Choose...</option>
                                <option>QA Analyst</option>
                                <option>IT Manager</option>
                                <option>Systems Analyst</option>
                            </select>
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Job Type<span class="text-danger scale5 ms-2">*</span></label>
                            <select class="nice-select default-select wide form-control solid">
                                <option selected>Choose...</option>
                                <option>Part-Time</option>
                                <option>Full-Time</option>
                                <option>Freelancer</option>
                            </select>
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">No. of Vancancy<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="Name" aria-label="name">
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Select Experience<span class="text-danger scale5 ms-2">*</span></label>
                            <select class="nice-select default-select wide form-control solid">
                                <option selected>1 yr</option>
                                <option>2 Yr</option>
                                <option>3 Yr</option>
                                <option>4 Yr</option>
                            </select>
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Posted Date<span class="text-danger scale5 ms-2">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                <input type="date" name="datepicker" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Last Date To Apply<span class="text-danger scale5 ms-2">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                <input type="date" name="datepicker" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Close Date<span class="text-danger scale5 ms-2">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                <input type="date" name="datepicker" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Select Gender:<span class="text-danger scale5 ms-2">*</span></label>
                            <select class="nice-select default-select wide form-control solid">
                                <option selected>Choose...</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Salary Form<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="$" aria-label="name">
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Salary To<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="$" aria-label="name">
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Enter City:<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="$" aria-label="name">
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Enter State:<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="State" aria-label="name">
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Enter Counter:<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="State" aria-label="name">
                        </div>
                        <div class="col-xl-6  col-md-6 mb-4">
                            <label class="form-label font-w600">Enter Education Level:<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="Education Level" aria-label="name">
                        </div>
                        <div class="col-xl-12 mb-4">
                            <label class="form-label font-w600">Description:<span class="text-danger scale5 ms-2">*</span></label>
                            <textarea class="form-control solid" rows="5" aria-label="With textarea"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>
</body>

</html>