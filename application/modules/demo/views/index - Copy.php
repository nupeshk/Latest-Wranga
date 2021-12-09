<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Wranga - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, Content Management, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon-96x96.ico">

        <!-- plugins -->
        <link href="assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
                <div class="container-fluid">
                    <!-- LOGO -->
                    <a href="index.html" class="navbar-brand mr-0 mr-md-2 logo">
                        <span class="logo-lg">
                            <img src="assets/images/logo.png" alt="" height="24" />
                            <span class="d-inline h5 ml-1 text-logo">WRANGA</span>
                        </span>
                        <span class="logo-sm">
                            <img src="assets/images/logo.png" alt="" height="24">
                        </span>
                    </a>

                    <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
                        <li class="">
                            <button class="button-menu-mobile open-left disable-btn">
                                <i data-feather="menu" class="menu-icon"></i>
                                <i data-feather="x" class="close-icon"></i>
                            </button>
                        </li>
                    </ul>

                    <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
                        <li class="d-none d-sm-block">
                            <div class="app-search">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span data-feather="search"></span>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="dropdown d-none d-lg-block" data-toggle="tooltip" data-placement="left" title="Change language">
                            <a class="nav-link dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <i data-feather="globe"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/germany.jpg" alt="user-image" class="mr-2" height="12"> <span
                                        class="align-middle">German</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/italy.jpg" alt="user-image" class="mr-2" height="12"> <span
                                        class="align-middle">Italian</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/spain.jpg" alt="user-image" class="mr-2" height="12"> <span
                                        class="align-middle">Spanish</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/russia.jpg" alt="user-image" class="mr-2" height="12"> <span
                                        class="align-middle">Russian</span>
                                </a>
                            </div>
                        </li>


                        <li class="dropdown notification-list" data-toggle="tooltip" data-placement="left"
                            title="8 new unread notifications">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <i data-feather="bell"></i>
                                <span class="noti-icon-badge"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                <!-- item-->
                                <div class="dropdown-item noti-title border-bottom">
                                    <h5 class="m-0 font-size-16">
                                        <span class="float-right">
                                            <a href="" class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>

                                <div class="slimscroll noti-scroll">

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                        <div class="notify-icon bg-primary"><i class="uil uil-user-plus"></i></div>
                                        <p class="notify-details">New user registered.<small class="text-muted">5 hours ago</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/avatar-1.jpg" class="img-fluid rounded-circle" alt="" />
                                        </div>
                                        <p class="notify-details">Karen Robinson</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Wow ! this admin looks good and awesome design</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" />
                                        </div>
                                        <p class="notify-details">Cristina Pride</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Hi, How are you? What about our next meeting</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom active">
                                        <div class="notify-icon bg-success"><i class="uil uil-comment-message"></i> </div>
                                        <p class="notify-details">Jaclyn Brunswick commented on Dashboard<small class="text-muted">1
                                                min
                                                ago</small></p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                        <div class="notify-icon bg-danger"><i class="uil uil-comment-message"></i></div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">4 days
                                                ago</small></p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary">
                                            <i class="uil uil-heart"></i>
                                        </div>
                                        <p class="notify-details">Carlos Crouch liked
                                            <b>Admin</b>
                                            <small class="text-muted">13 days ago</small>
                                        </p>
                                    </a>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);"
                                    class="dropdown-item text-center text-primary notify-item notify-all border-top">
                                    View all
                                    <i class="fi-arrow-right"></i>
                                </a>

                            </div>
                        </li>

                        <li class="dropdown notification-list" data-toggle="tooltip" data-placement="left" title="Settings">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                                <i data-feather="settings"></i>
                            </a>
                        </li>

                        <li class="dropdown notification-list align-self-center profile-dropdown">
                            <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <div class="media user-profile ">
                                    <img src="assets/images/users/avatar-7.jpg" alt="user-image" class="rounded-circle align-self-center" />
                                    <div class="media-body text-left">
                                        <h6 class="pro-user-name ml-2 my-0">
                                            <span>Wranga N</span>
                                            <span class="pro-user-desc text-muted d-block mt-1">Administrator </span>
                                        </h6>
                                    </div>
                                    <span data-feather="chevron-down" class="ml-2 align-self-center"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
                                <a href="pages-profile.html" class="dropdown-item notify-item">
                                    <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                                    <span>My Account</span>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
                                    <span>Settings</span>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="help-circle" class="icon-dual icon-xs mr-2"></i>
                                    <span>Support</span>
                                </a>

                                <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                    <i data-feather="lock" class="icon-dual icon-xs mr-2"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">
                <div class="media user-profile mt-2 mb-2">
                    <img src="assets/images/users/avatar-7.jpg" class="avatar-sm rounded-circle mr-2" alt="Wranga" />
                    <img src="assets/images/users/avatar-7.jpg" class="avatar-xs rounded-circle mr-2" alt="Wranga" />

                    <div class="media-body">
                        <h6 class="pro-user-name mt-0 mb-0">Nik Patel</h6>
                        <span class="pro-user-desc">Administrator</span>
                    </div>
                    <div class="dropdown align-self-center profile-dropdown-menu">
                        <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <span data-feather="chevron-down"></span>
                        </a>
                        <div class="dropdown-menu profile-dropdown">
                            <a href="pages-profile.html" class="dropdown-item notify-item">
                                <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                                <span>My Account</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
                                <span>Settings</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="help-circle" class="icon-dual icon-xs mr-2"></i>
                                <span>Support</span>
                            </a>

                            <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                <i data-feather="lock" class="icon-dual icon-xs mr-2"></i>
                                <span>Lock Screen</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-content">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu" class="slimscroll-menu">
                        <ul class="metismenu" id="menu-bar">
                            <li class="menu-title">Navigation</li>

                             <li>
                                <a href="index.html">
                                    <i data-feather="home"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                             <li class="menu-title">User Management</li>

                            <li>
                                <a href="super-admin.html">
                                    <i data-feather="user"></i>
                                    <span class="badge badge-success float-right">1</span>
                                    <span> Super Admin </span>
                                </a>
                            </li>
                            <li>
                                <a href="admin.html">
                                    <i data-feather="users"></i>
                                    <span class="badge badge-success float-right">2</span>
                                    <span> Admin/tech </span>
                                </a>
                            </li>
                            <li>
                                <a href="team-leader.html">
                                    <i data-feather="users"></i>
                                    <span class="badge badge-success float-right">2</span>
                                    <span> Team Leader/s  </span>
                                </a>
                            </li>
                            <li>
                                <a href="reviewer.html">
                                    <i data-feather="users"></i>
                                    <span class="badge badge-success float-right">5</span>
                                    <span> Reviewer/s </span>
                                </a>
                            </li>
                            <li class="menu-title">Apps</li>
                            <li>
                                <a href="apps-calendar.html">
                                    <i data-feather="calendar"></i>
                                    <span> Calendar </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="inbox"></i>
                                    <span> Email </span>
                                    <span class="menu-arrow"></span>
                                </a>

                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="email-inbox.html">Inbox</a>
                                    </li>
                                    <li>
                                        <a href="email-read.html">Read</a>
                                    </li>
                                    <li>
                                        <a href="email-compose.html">Compose</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="briefcase"></i>
                                    <span> Projects </span>
                                    <span class="menu-arrow"></span>
                                </a>
    
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="project-list.html">List</a>
                                    </li>
                                    <li>
                                        <a href="project-detail.html">Detail</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="bookmark"></i>
                                    <span> Tasks </span>
                                    <span class="menu-arrow"></span>
                                </a>
    
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="task-list.html">List</a>
                                    </li>
                                    <li>
                                        <a href="task-board.html">Kanban Board</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-title">Custom</li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="file-text"></i>
                                    <span> Pages </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="pages-starter.html">Starter</a>
                                    </li>
                                    <li>
                                        <a href="pages-profile.html">Profile</a>
                                    </li>
                                    <li>
                                        <a href="pages-activity.html">Activity</a>
                                    </li>
                                    <li>
                                        <a href="pages-invoice.html">Invoice</a>
                                    </li>
                                    <li>
                                        <a href="pages-pricing.html">Pricing</a>
                                    </li>
                                    <li>
                                        <a href="pages-maintenance.html">Maintenance</a>
                                    </li>
                                    <li>
                                        <a href="pages-login.html">Login</a>
                                    </li>
                                    <li>
                                        <a href="pages-register.html">Register</a>
                                    </li>
                                    <li>
                                        <a href="pages-recoverpw.html">Recover Password</a>
                                    </li>
                                    <li>
                                        <a href="pages-confirm-mail.html">Confirm</a>
                                    </li>
                                    <li>
                                        <a href="pages-404.html">Error 404</a>
                                    </li>
                                    <li>
                                        <a href="pages-500.html">Error 500</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="layout"></i>
                                    <span> Layouts </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="layouts-horizontal.html">Horizontal Nav</a>
                                    </li>
                                    <li>
                                        <a href="layouts-rtl.html">RTL</a>
                                    </li>
                                    <li>
                                        <a href="layouts-dark.html">Dark</a>
                                    </li>
                                    <li>
                                        <a href="layouts-scrollable.html">Scrollable</a>
                                    </li>
                                    <li>
                                        <a href="layouts-boxed.html">Boxed</a>
                                    </li>
                                    <li>
                                        <a href="layouts-preloader.html">With Pre-loader</a>
                                    </li>
                                    <li>
                                        <a href="layouts-dark-sidebar.html">Dark Side Nav</a>
                                    </li>
                                    <li>
                                        <a href="layouts-condensed.html">Condensed Nav</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-title">Components</li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="package"></i>
                                    <span> UI Elements </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="components-bootstrap.html">Bootstrap UI</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" aria-expanded="false">Icons
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level" aria-expanded="false">
                                            <li>
                                                <a href="icons-feather.html">Feather Icons</a>
                                            </li>
                                            <li>
                                                <a href="icons-unicons.html">Unicons Icons</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="widgets.html">Widgets</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" aria-expanded="false">
                                    <i data-feather="file-text"></i>
                                    <span> Forms </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="forms-basic.html">Basic Elements</a>
                                    </li>
                                    <li>
                                        <a href="forms-advanced.html">Advanced</a>
                                    </li>
                                    <li>
                                        <a href="forms-validation.html">Validation</a>
                                    </li>
                                    <li>
                                        <a href="forms-wizard.html">Wizard</a>
                                    </li>
                                    <li>
                                        <a href="forms-editor.html">Editor</a>
                                    </li>
                                    <li>
                                        <a href="forms-file-uploads.html">File Uploads</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="charts-apex.html" aria-expanded="false">
                                    <i data-feather="pie-chart"></i>
                                    <span> Charts </span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" aria-expanded="false">
                                    <i data-feather="grid"></i>
                                    <span> Tables </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="tables-basic.html">Basic</a>
                                    </li>
                                    <li>
                                        <a href="tables-datatables.html">Advanced</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row page-title align-items-center">
                            <div class="col-sm-4 col-xl-6">
                                <h4 class="mb-1 mt-0">Dashboard</h4>
                            </div>
                            <div class="col-sm-8 col-xl-6">
                                <form class="form-inline float-sm-right mt-3 mt-sm-0">
                                    <div class="form-group mb-sm-0 mr-2">
                                        <input type="text" class="form-control" id="dash-daterange" style="min-width: 190px;" />
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class='uil uil-file-alt mr-1'></i>Download
                                            <i class="icon"><span data-feather="chevron-down"></span></i></button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item notify-item">
                                                <i data-feather="mail" class="icon-dual icon-xs mr-2"></i>
                                                <span>Email</span>
                                            </a>
                                            <a href="#" class="dropdown-item notify-item">
                                                <i data-feather="printer" class="icon-dual icon-xs mr-2"></i>
                                                <span>Print</span>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item notify-item">
                                                <i data-feather="file" class="icon-dual icon-xs mr-2"></i>
                                                <span>Re-Generate</span>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- content -->
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Today
                                                    Revenue</span>
                                                <h2 class="mb-0">$2189</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <div id="today-revenue-chart" class="apex-charts"></div>
                                                <span class="text-success font-weight-bold font-size-13"><i
                                                        class='uil uil-arrow-up'></i> 10.21%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Product
                                                    Sold</span>
                                                <h2 class="mb-0">1065</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <div id="today-product-sold-chart" class="apex-charts"></div>
                                                <span class="text-danger font-weight-bold font-size-13"><i
                                                        class='uil uil-arrow-down'></i> 5.05%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">New
                                                    Customers</span>
                                                <h2 class="mb-0">11</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <div id="today-new-customer-chart" class="apex-charts"></div>
                                                <span class="text-success font-weight-bold font-size-13"><i
                                                        class='uil uil-arrow-up'></i> 25.16%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">New
                                                    Visitors</span>
                                                <h2 class="mb-0">750</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <div id="today-new-visitors-chart" class="apex-charts"></div>
                                                <span class="text-danger font-weight-bold font-size-13"><i
                                                        class='uil uil-arrow-down'></i> 5.05%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- stats + charts -->
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <h5 class="card-title header-title border-bottom p-3 mb-0">Overview</h5>
                                        <!-- stat 1 -->
                                        <div class="media px-3 py-4 border-bottom">
                                            <div class="media-body">
                                                <h4 class="mt-0 mb-1 font-size-22 font-weight-normal">121,000</h4>
                                                <span class="text-muted">Total Visitors</span>
                                            </div>
                                            <i data-feather="users" class="align-self-center icon-dual icon-lg"></i>
                                        </div>

                                        <!-- stat 2 -->
                                        <div class="media px-3 py-4 border-bottom">
                                            <div class="media-body">
                                                <h4 class="mt-0 mb-1 font-size-22 font-weight-normal">21,000</h4>
                                                <span class="text-muted">Total Product Views</span>
                                            </div>
                                            <i data-feather="image" class="align-self-center icon-dual icon-lg"></i>
                                        </div>

                                        <!-- stat 3 -->
                                        <div class="media px-3 py-4">
                                            <div class="media-body">
                                                <h4 class="mt-0 mb-1 font-size-22 font-weight-normal">$21.5</h4>
                                                <span class="text-muted">Revenue Per Visitor</span>
                                            </div>
                                            <i data-feather="shopping-bag" class="align-self-center icon-dual icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <ul class="nav card-nav float-right">
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">Today</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">7d</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#">15d</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">1m</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">1y</a>
                                            </li>
                                        </ul>
                                        <h5 class="card-title mb-0 header-title">Revenue</h5>

                                        <div id="revenue-chart" class="apex-charts mt-3"  dir="ltr"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <h5 class="card-title header-title">Targets</h5>
                                        <div id="targets-chart" class="apex-charts mt-3" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                
                        <!-- products -->
                        <div class="row">
                            <div class="col-xl-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mt-0 mb-0 header-title">Sales By Category</h5>
                                        <div id="sales-by-category-chart" class="apex-charts mb-0 mt-4" dir="ltr"></div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                            <div class="col-xl-7">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="" class="btn btn-primary btn-sm float-right">
                                            <i class='uil uil-export ml-1'></i> Export
                                        </a>
                                        <h5 class="card-title mt-0 mb-0 header-title">Recent Orders</h5>

                                        <div class="table-responsive">
                                         <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Customer</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>#98754</td>
                                                        <td>ASOS Ridley High</td>
                                                        <td>Otto B</td>
                                                        <td>$79.49</td>
                                                        <td><span class="badge badge-soft-warning py-1">Pending</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>#98753</td>
                                                        <td>Marco Lightweight Shirt</td>
                                                        <td>Mark P</td>
                                                        <td>$125.49</td>
                                                        <td><span class="badge badge-soft-success py-1">Delivered</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>#98752</td>
                                                        <td>Half Sleeve Shirt</td>
                                                        <td>Dave B</td>
                                                        <td>$35.49</td>
                                                        <td><span class="badge badge-soft-danger py-1">Declined</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>#98751</td>
                                                        <td>Lightweight Jacket</td>
                                                        <td>Wranga N</td>
                                                        <td>$49.49</td>
                                                        <td><span class="badge badge-soft-success py-1">Delivered</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>#98750</td>
                                                        <td>Marco Shoes</td>
                                                        <td>Rik N</td>
                                                        <td>$69.49</td>
                                                        <td><span class="badge badge-soft-danger py-1">Declined</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                        <!-- widgets -->
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body pt-2">
                                        <h5 class="mb-4 header-title">Top Performers</h5>
                                        <div class="media border-top pt-3">
                                            <img src="assets/images/users/avatar-7.jpg" class="avatar rounded mr-3"
                                                alt="Wranga">
                                            <div class="media-body">
                                                <h6 class="mt-1 mb-0 font-size-15">Wranga N</h6>
                                                <h6 class="text-muted font-weight-normal mt-1 mb-3">Senior Sales Guy</h6>
                                            </div>
                                            <div class="dropdown align-self-center float-right">
                                                <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                                            class="uil uil-edit-alt mr-2"></i>Edit</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                                            class="uil uil-exit mr-2"></i>Remove from Team</a>
                                                    <div class="dropdown-divider"></div>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                            class="uil uil-trash mr-2"></i>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media mt-1 border-top pt-3">
                                            <img src="assets/images/users/avatar-9.jpg" class="avatar rounded mr-3"
                                                alt="Wranga">
                                            <div class="media-body">
                                                <h6 class="mt-1 mb-0 font-size-15">Greeva Y</h6>
                                                <h6 class="text-muted font-weight-normal mt-1 mb-3">Social Media Campaign</h6>
                                            </div>
                                            <div class="dropdown align-self-center float-right">
                                                <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                                            class="uil uil-edit-alt mr-2"></i>Edit</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                                            class="uil uil-exit mr-2"></i>Remove from Team</a>
                                                    <div class="dropdown-divider"></div>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                            class="uil uil-trash mr-2"></i>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media mt-1 border-top pt-3">
                                            <img src="assets/images/users/avatar-4.jpg" class="avatar rounded mr-3"
                                                alt="Wranga">
                                            <div class="media-body">
                                                <h6 class="mt-1 mb-0 font-size-15">Nik G</h6>
                                                <h6 class="text-muted font-weight-normal mt-1 mb-3">Inventory Manager</h6>
                                            </div>
                                            <div class="dropdown align-self-center float-right">
                                                <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                                            class="uil uil-edit-alt mr-2"></i>Edit</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                                            class="uil uil-exit mr-2"></i>Remove from Team</a>
                                                    <div class="dropdown-divider"></div>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                            class="uil uil-trash mr-2"></i>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media mt-1 border-top pt-3">
                                            <img src="assets/images/users/avatar-1.jpg" class="avatar rounded mr-3"
                                                alt="Wranga">
                                            <div class="media-body">
                                                <h6 class="mt-1 mb-0 font-size-15">Hardik G</h6>
                                                <h6 class="text-muted font-weight-normal mt-1 mb-3">Sales Person</h6>
                                            </div>
                                            <div class="dropdown align-self-center float-right">
                                                <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                                            class="uil uil-edit-alt mr-2"></i>Edit</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                                            class="uil uil-exit mr-2"></i>Remove from Team</a>
                                                    <div class="dropdown-divider"></div>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                            class="uil uil-trash mr-2"></i>Delete</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="media mt-1 border-top pt-3">
                                            <img src="assets/images/users/avatar-5.jpg" class="avatar rounded mr-3"
                                                alt="Wranga">
                                            <div class="media-body">
                                                <h6 class="mt-1 mb-0 font-size-15">Stive K</h6>
                                                <h6 class="text-muted font-weight-normal mt-1 mb-1">Sales Person</h6>
                                            </div>
                                            <div class="dropdown align-self-center float-right">
                                                <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                                            class="uil uil-edit-alt mr-2"></i>Edit</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                                            class="uil uil-exit mr-2"></i>Remove from Team</a>
                                                    <div class="dropdown-divider"></div>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                            class="uil uil-trash mr-2"></i>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body pt-2 pb-3">
                                        <a href="task-list.html" class="btn btn-primary btn-sm mt-2 float-right">
                                            View All
                                        </a>
                                        <h5 class="mb-4 header-title">Tasks</h5>
                                        <div class="slimscroll" style="max-height: 390px;">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="task1">
                                                        <label class="custom-control-label" for="task1">
                                                            Draft the new contract document for
                                                            sales team
                                                        </label>
                                                        <p class="font-size-13 text-muted">Due on 24 Aug, 2020</p>
                                                    </div> <!-- end checkbox -->
                                                </div>
                                            </div>
    
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="task2">
                                                        <label class="custom-control-label" for="task2">
                                                            iOS App home page
                                                        </label>
                                                        <p class="font-size-13 text-muted">Due on 23 Aug, 2020</p>
                                                    </div> <!-- end checkbox -->
                                                </div>
                                            </div>
    
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="task3">
                                                        <label class="custom-control-label" for="task3">
                                                            Write a release note for Wranga
                                                        </label>
                                                        <p class="font-size-13 text-muted">Due on 22 Aug, 2020</p>
                                                    </div> <!-- end checkbox -->
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="task4">
                                                        <label class="custom-control-label" for="task4">
                                                            Invite Greeva to a project Wranga admin
                                                        </label>
                                                        <p class="font-size-13 text-muted">Due on 21 Aug, 2020</p>
                                                    </div> <!-- end checkbox -->
                                                </div>
                                            </div>
    
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="task5">
                                                        <label class="custom-control-label" for="task5">
                                                            Enable analytics tracking for main website
                                                        </label>
                                                        <p class="font-size-13 text-muted">Due on 20 Aug, 2020</p>
                                                    </div> <!-- end checkbox -->
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="task6">
                                                        <label class="custom-control-label" for="task6">
                                                            Invite user to a project
                                                        </label>
                                                        <p class="font-size-13 text-muted">Due on 18 Aug, 2020</p>
                                                    </div> <!-- end checkbox -->
                                                </div>
                                            </div>
    
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="task7">
                                                        <label class="custom-control-label" for="task7">
                                                            Write a release note
                                                        </label>
                                                        <p class="font-size-13 text-muted">Due on 14 Aug, 2020</p>
                                                    </div> <!-- end checkbox -->
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body pt-2">
                                        <div class="dropdown mt-2 float-right">
                                            <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="uil uil-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-refresh mr-2"></i>Refresh</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-user-plus mr-2"></i>Add Member</a>
                                                <div class="dropdown-divider"></div>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                        class="uil uil-exit mr-2"></i>Exit</a>
                                            </div>
                                        </div>
                                        <h5 class="mb-4 header-title">Recent Conversation</h5>
                                        <div class="chat-conversation">
                                            <ul class="conversation-list slimscroll" style="max-height: 328px;">
                                                <li class="clearfix">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/avatar-9.jpg" alt="Female">
                                                        <i>10:00</i>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <i>Greeva</i>
                                                            <p>
                                                                Hello!
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="clearfix odd">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/avatar-7.jpg" alt="Male">
                                                        <i>10:01</i>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <i>Wranga</i>
                                                            <p>
                                                                Hi, How are you? What about our next meeting?
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="clearfix">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/avatar-9.jpg" alt="female">
                                                        <i>10:01</i>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <i>Greeva</i>
                                                            <p>
                                                                Yeah everything is fine
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="clearfix odd">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/avatar-7.jpg" alt="male">
                                                        <i>10:02</i>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <i>Wranga</i>
                                                            <p>
                                                                Awesome! let me know if we can talk in 20 min
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <form class="needs-validation" novalidate name="chat-form" id="chat-form">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control chat-input"
                                                            placeholder="Enter your text" required>
                                                        <div class="invalid-feedback">
                                                            Please enter your messsage
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="submit"
                                                            class="btn btn-danger chat-send btn-block waves-effect waves-light">Send</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div> <!-- end .chat-conversation-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div>
                </div> <!-- content -->

                

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                2020 &copy; Wranga. All Rights Reserved. Crafted with <i class='uil uil-heart text-danger font-size-12'></i> by <a href="#" target="_blank">WRANGA</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i data-feather="x-circle"></i>
                </a>
                <h5 class="m-0">Customization</h5>
            </div>
    
            <div class="slimscroll-menu">
    
                <h5 class="font-size-16 pl-3 mt-4">Choose Variation</h5>
                <div class="p-3">
                    <h6>Default</h6>
                    <a href="index.html"><img src="assets/images/layouts/vertical.jpg" alt="vertical" class="img-thumbnail demo-img" /></a>
                </div>
                <div class="px-3 py-1">
                    <h6>Top Nav</h6>
                    <a href="layouts-horizontal.html"><img src="assets/images/layouts/horizontal.jpg" alt="horizontal" class="img-thumbnail demo-img" /></a>
                </div>
                <div class="px-3 py-1">
                    <h6>Dark Side Nav</h6>
                    <a href="layouts-dark-sidebar.html"><img src="assets/images/layouts/vertical-dark-sidebar.jpg" alt="dark sidenav" class="img-thumbnail demo-img" /></a>
                </div>
                <div class="px-3 py-1">
                    <h6>Condensed Side Nav</h6>
                    <a href="layouts-dark-sidebar.html"><img src="assets/images/layouts/vertical-condensed.jpg" alt="condensed" class="img-thumbnail demo-img" /></a>
                </div>
                <div class="px-3 py-1">
                    <h6>Fixed Width (Boxed)</h6>
                    <a href="layouts-boxed.html"><img src="assets/images/layouts/boxed.jpg" alt="boxed"
                            class="img-thumbnail demo-img" /></a>
                </div>
            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- optional plugins -->
        <script src="assets/libs/moment/moment.min.js"></script>
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
        <script src="assets/libs/flatpickr/flatpickr.min.js"></script>

        <!-- page js -->
        <script src="assets/js/pages/dashboard.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>


    </body>
</html>