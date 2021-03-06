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
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
         <link href="assets/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />

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
                            <span class="d-inline h5 ml-1 text-logo">Wranga</span>                        </span>
                        <span class="logo-sm">
                            <img src="assets/images/logo.png" alt="" height="24">                        </span>                    </a>

                    <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
                        <li class="">
                            <button class="button-menu-mobile open-left disable-btn">
                                <i data-feather="menu" class="menu-icon"></i>
                                <i data-feather="x" class="close-icon"></i>                            </button>
                        </li>
                    </ul>

                    <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
                        <li class="d-none d-sm-block">
                            <div class="app-search">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span data-feather="search"></span>                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="dropdown d-none d-lg-block" data-toggle="tooltip" data-placement="left" title="Change language">
                            <a class="nav-link dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <i data-feather="globe"></i>                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/germany.jpg" alt="user-image" class="mr-2" height="12"> <span
                                        class="align-middle">German</span>                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/italy.jpg" alt="user-image" class="mr-2" height="12"> <span
                                        class="align-middle">Italian</span>                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/spain.jpg" alt="user-image" class="mr-2" height="12"> <span
                                        class="align-middle">Spanish</span>                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/russia.jpg" alt="user-image" class="mr-2" height="12"> <span
                                        class="align-middle">Russian</span>                                </a>                            </div>
                        </li>


                        <li class="dropdown notification-list" data-toggle="tooltip" data-placement="left"
                            title="8 new unread notifications">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <i data-feather="bell"></i>
                                <span class="noti-icon-badge"></span>                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                <!-- item-->
                                <div class="dropdown-item noti-title border-bottom">
                                    <h5 class="m-0 font-size-16">
                                        <span class="float-right">
                                            <a href="" class="text-dark">
                                                <small>Clear All</small>                                            </a>                                        </span>Notification                                    </h5>
                                </div>

                                <div class="slimscroll noti-scroll">

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                        <div class="notify-icon bg-primary"><i class="uil uil-user-plus"></i></div>
                                        <p class="notify-details">New user registered.<small class="text-muted">5 hours ago</small>                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/avatar-1.jpg" class="img-fluid rounded-circle" alt="" />                                        </div>
                                        <p class="notify-details">Karen Robinson</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Wow ! this admin looks good and awesome design</small>                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" />                                        </div>
                                        <p class="notify-details">Cristina Pride</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Hi, How are you? What about our next meeting</small>                                        </p>
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
                                            <i class="uil uil-heart"></i>                                        </div>
                                        <p class="notify-details">Carlos Crouch liked
                                            <b>Admin</b>
                                            <small class="text-muted">13 days ago</small>                                        </p>
                                    </a>                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);"
                                    class="dropdown-item text-center text-primary notify-item notify-all border-top">
                                    View all
                                    <i class="fi-arrow-right"></i>                                </a>                            </div>
                        </li>

                        <li class="dropdown notification-list" data-toggle="tooltip" data-placement="left" title="Settings">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                                <i data-feather="settings"></i>                            </a>                        </li>

                        <li class="dropdown notification-list align-self-center profile-dropdown">
                            <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <div class="media user-profile ">
                                    <img src="assets/images/users/avatar-7.jpg" alt="user-image" class="rounded-circle align-self-center" />
                                    <div class="media-body text-left">
                                        <h6 class="pro-user-name ml-2 my-0">
                                            <span>Wranga N</span>
                                            <span class="pro-user-desc text-muted d-block mt-1">Administrator </span>                                        </h6>
                                    </div>
                                    <span data-feather="chevron-down" class="ml-2 align-self-center"></span>                                </div>
                            </a>
                            <div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
                                <a href="pages-profile.html" class="dropdown-item notify-item">
                                    <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                                    <span>My Account</span>                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
                                    <span>Settings</span>                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="help-circle" class="icon-dual icon-xs mr-2"></i>
                                    <span>Support</span>                                </a>

                                <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                    <i data-feather="lock" class="icon-dual icon-xs mr-2"></i>
                                    <span>Lock Screen</span>                                </a>

                                <div class="dropdown-divider"></div>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                                    <span>Logout</span>                                </a>                            </div>
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
                        <span class="pro-user-desc">Administrator</span>                    </div>
                    <div class="dropdown align-self-center profile-dropdown-menu">
                        <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <span data-feather="chevron-down"></span>                        </a>
                        <div class="dropdown-menu profile-dropdown">
                            <a href="pages-profile.html" class="dropdown-item notify-item">
                                <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                                <span>My Account</span>                            </a>

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
                                <span>Settings</span>                            </a>

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="help-circle" class="icon-dual icon-xs mr-2"></i>
                                <span>Support</span>                            </a>

                            <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                <i data-feather="lock" class="icon-dual icon-xs mr-2"></i>
                                <span>Lock Screen</span>                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                                <span>Logout</span>                            </a>                        </div>
                    </div>
                </div>
                <div class="sidebar-content">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu" class="slimscroll-menu">
                        <ul class="metismenu" id="menu-bar">
                            <li class="menu-title">Navigation</li>

                             <li>
                                <a href="dashboard.html">
                                    <i data-feather="home"></i>
                                    <span> Dashboard </span>                                </a>                            </li>
                              <li class="menu-title">User Management</li>

                           <li class="menu-title">Content Management</li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="airplay"></i>
                                    <span>OTT</span>
                                    <span class="menu-arrow"></span>                                </a>
    
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                   
                                        <a href="published-OTTs.html">Published OTTs</a>                                    </li>
                                        <li>
                                   
                                        <a href="pending-OTTs.html">Pending OTTs</a>                                    </li>
                                        <li>
                                   
                                        <a href="upload-new-OTT.html">Upload New OTT</a>                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="tablet"></i>
                                    <span>Game</span>
                                    <span class="menu-arrow"></span>                                </a>
    
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                   
                                        <a href="task-list.html">Published</a>                                    </li>
                                        <li>
                                   
                                        <a href="task-list.html">Pending</a>                                    </li>
                                        
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="package"></i>
                                    <span>App</span>
                                    <span class="menu-arrow"></span>                                </a>
    
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                   
                                        <a href="task-list.html">Published</a>                                    </li>
                                        <li>
                                   
                                        <a href="task-list.html">Pending</a>                                    </li>
                                        
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="book-open"></i>
                                    <span>Book</span>
                                    <span class="menu-arrow"></span>                                </a>
    
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                   
                                        <a href="task-list.html">Published</a>                                    </li>
                                        <li>
                                   
                                        <a href="task-list.html">Pending</a>                                    </li>
                                        
                                </ul>
                                <li>
                                <a href="section-1.html">
                                    <i data-feather="settings"></i>
                                    <span> Section-1</span>                                </a>                            </li>

                            <li>
                                <a href="section-2.html">
                                    <i data-feather="youtube"></i>
                                    <span> Section-2 </span>                                </a>                            </li>
                             <li>
                                <a href="section-3.html">
                                    <i data-feather="star"></i>
                                    <span> Section-3 </span>                                </a>                            </li>
                             <li>
                                <a href="section-4.html">
                                    <i data-feather="upload-cloud"></i>
                                    <span> Section-4 </span>                                </a>                            </li>
                            </li>
                            <li class="menu-title">User Management</li>
                            <!--<li>
                                <a href="admin.html">
                                    <i data-feather="user"></i>
                                    <span class="badge badge-success float-right">1</span>
                                    <span> Super Admin </span>                                </a>                            </li>-->
                            <li>
                                <a href="admin.html">
                                    <i data-feather="users"></i>
                                    <span class="badge badge-success float-right">2</span>
                                    <span> Admin/tech </span>                                </a>                            </li>
                            <li>
                                <a href="team-leader.html">
                                    <i data-feather="users"></i>
                                    <span class="badge badge-success float-right">2</span>
                                    <span> Team Leader/s  </span>                                </a>                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="users"></i>
                                    <span>Total  Reviewer/s </span>
                                    <span class="menu-arrow"></span>                                </a>
    
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                    <span class="badge badge-success float-right">5</span>
                                        <a href="task-list.html">Userwise Rreviver/s</a>                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="mobile-users.html">
                                    <i data-feather="smartphone"></i>
                                    <span class="badge badge-success float-right">65</span>
                                    <span> Mobile users </span>
                                </a>
                            </li>
                            <li class="menu-title">Settings</li>
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
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row page-title">
                            <div class="col-md-12">
                                <nav aria-label="breadcrumb" class="float-right mt-1">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Wranga</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Upload New OTT</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Upload New OTT: Store Publishing</h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                            <div class="card">
                                    <div class="card-body">
                                       <!-- <h5 class="header-title mb-4 mt-0">General Information</h5>-->
                                        <div class="custom-accordion accordion ml-4" id="customaccordion_exa">
                                            <div class="card mb-1">
                                                <a href="" class="text-dark" data-toggle="collapse"
                                                    data-target="#customaccorcollapseOne" aria-expanded="true"
                                                    aria-controls="customaccorcollapseOne">
                                                    <div class="card-header" id="customaccorheadingOne">
                                                        <h5 class="m-0 font-size-14">
                                                            <i class="uil uil-question-circle h3 text-primary icon"></i>
                                                      General Information                                                     </h5>
                                                    </div>
                                                </a>

                                                <div id="customaccorcollapseOne" class="collapse show"
                                                    aria-labelledby="customaccorheadingOne"
                                                    data-parent="#customaccordion_exa">
                                                  <div class="card-body text-muted">
                                                        <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Subcatagories</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control custom-select" id="subcatagories" name="subcatagories" placeholder="Subcatagories">
                                                                <option>Select Subcatagories</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Title</label>
                                                        <div class="col-lg-10">
                                                            <input type="Titel" class="form-control" id="Titel" placeholder="Enter Titel" name="Titel">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-textarea">Short Desc.</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" rows="5" placeholder="Enter desc." name="Enter desc."
                                                                id="example-textarea"></textarea>
                                                        </div>
                                                    </div>
                                                  <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Platform</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control custom-select" id="platform" name="platform" placeholder="platform">
                                                                <option>Select platform</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">OTT Content Type</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control custom-select" id="ott type" name="ott type" placeholder="ott type">
                                                                <option>Select OTT type</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Type of Content</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" disabled="Type of Content"
                                                                value="Video" name="Video" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Season</label>
                                                       <div class="col-lg-10">
                                                            <input type="season" class="form-control" id="season" placeholder="Enter season number" name="season">
                                                      </div>
                                                    </div>
                                                  <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Episode</label>
                                                        <div class="col-lg-10">
                                                            <input type="episode" class="form-control" id="episode" placeholder="Enter episode number" name="episode">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Language</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control custom-select" id="language " name="language" placeholder="language">
                                                                <option>Select OTT language</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Genre</label>
                                                        <div class="col-lg-10">
                                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                      <th colspan="6"> 
                                                      <label class="col-lg-2 col-form-label">Select genre.</label></th>
                                                    </tr>
                                                    <tr>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2" name="epic">
                                                <label class="custom-control-label" for="customCheck2">Epic</label>
                                            </div>
                                        </div></th>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3" name="history">
                                                <label class="custom-control-label" for="customCheck3">History</label>
                                            </div>
                                        </div></th>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck4" name="war">
                                                <label class="custom-control-label" for="customCheck4">War</label>
                                            </div>
                                        </div></th>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck5" name="crime">
                                                <label class="custom-control-label" for="customCheck5">Crime</label>
                                            </div>
                                        </div></th>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck6" name="thriller">
                                                <label class="custom-control-label" for="customCheck6">Thriller</label>
                                            </div>
                                        </div></th>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck7" name="horror">
                                                <label class="custom-control-label" for="customCheck7">Horror</label>
                                            </div>
                                        </div></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck8" name="Sci-fi">
                                                <label class="custom-control-label" for="customCheck8">Sci-fi</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck9" name="Fantasy">
                                                <label class="custom-control-label" for="customCheck9">Fantasy</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck10" name="Adventure">
                                                <label class="custom-control-label" for="customCheck10">Adventure</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck11" name="Sports">
                                                <label class="custom-control-label" for="customCheck11">Sports</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck12" name="Musical">
                                                <label class="custom-control-label" for="customCheck12">Musical</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck13" name="Entertainment">
                                                <label class="custom-control-label" for="customCheck13">Entertainment</label>
                                            </div>
                                        </div></td>
                                                    </tr>
                                                    <tr>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck14" name="Drama">
                                                <label class="custom-control-label" for="customCheck14">Drama</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck15" name="Romance">
                                                <label class="custom-control-label" for="customCheck15">Romance</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck16" name="Comedy">
                                                <label class="custom-control-label" for="customCheck16">Comedy</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck17" name="RomCom">
                                                <label class="custom-control-label" for="customCheck17">RomCom</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck18" name="True-Story">
                                                <label class="custom-control-label" for="customCheck18">True Story</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck19" name="Documentary">
                                                <label class="custom-control-label" for="customCheck19">Documentary</label>
                                            </div>
                                        </div></td>
                                                    </tr>
                                                    <tr>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck20" name="Animation">
                                                <label class="custom-control-label" for="customCheck20">Animation</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck21" name="Other">
                                                <label class="custom-control-label" for="customCheck21">Any Other (Please specify)</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="col-lg-10">
                                                            <input type="Other" class="form-control" id="other" placeholder="other" id="Other" name="Othes">
                                                        </div></td>
                                                        <td>&nbsp;</td>
                                                      <td>&nbsp;</td>
                                                      <td>&nbsp;</td>
                                                  </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Year of Release</label>
                                                        <div class="col-lg-10">
                                                           <input type="text" id="basic-datepicker" class="form-control" placeholder="Year of Release" name="Year-of-Release">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Name of Editor</label>
                                                        <div class="col-lg-10">
                                                            <input type="editor" class="form-control" id="editor" placeholder="Enter editor name" name="editor">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="simpleinput"></label>
                                                        <div class="col-lg-10">
                                                            <button type="submit" class="btn btn-primary" name="Submit">Next>></button>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="card mb-1">
                                                <a href="" class="text-dark collapsed" data-toggle="collapse"
                                                    data-target="#customaccorcollapseTwo" aria-expanded="false"
                                                    aria-controls="customaccorcollapseTwo">
                                                    <div class="card-header" id="customaccorheadingTwo">
                                                        <h5 class="m-0 font-size-14">
                                                            <i
                                                                class="uil uil-question-circle h3 text-primary icon"></i>
                                                           Cast Information                                                        </h5>
                                                    </div>
                                                </a>

                                                <div id="customaccorcollapseTwo" class="collapse"
                                                    aria-labelledby="customaccorheadingTwo"
                                                    data-parent="#customaccordion_exa">
                                                    <div class="card-body text-muted">
                                                       <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Add Your Cast Name</label>
                                                        <div class="col-lg-10">
                                 <input type="cast" class="form-control" id="cast" placeholder="Cast Name" name="cast name" style="width: 82%; float: right;">
                                                        </div>
                                                    </div>  
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Photo</label>
                                                        <div class="col-lg-10">
                                 <div style="width: 82%; float: right;">         
                                        <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" name="upload-image">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
            
                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted  uil-cloud-upload"></i>
                                                <h3>Drop files here or click to upload.</h3>
                                                <span class="text-muted font-13">(Upload Photo)</span>                                            </div>
                                        </form></div>
                                                        </div>
                                                    </div> 
                                          <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="simpleinput"></label>
                                                        <div class="col-lg-10" style="text-align: center;">
                                                            <button type="submit" class="btn btn-primary" name="submit">Upload</button>
                                                        </div>
                                                    </div>
                                             
                                           <div class="col-lg-6 col-xl-3">
                                                <div class="card mb-4 mb-xl-0">
                                                    <img class="card-img-top img-fluid" src="assets/images/small/img-2.jpg" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title font-size-16">Uploaded Image 1</h5>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        <div class="clearfix text-right mt-3">
                                            <!--<button type="button" class="btn btn-danger"> <i class="uil uil-arrow-right mr-1"></i> Submit</button>-->
                                        </div> 
                                                    
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="card mb-0">
                                                <a href="" class="text-dark collapsed" data-toggle="collapse"
                                                    data-target="#customaccorcollapseThree" aria-expanded="false"
                                                    aria-controls="customaccorcollapseThree">
                                                    <div class="card-header" id="customaccorheadingThree">
                                                        <h5 class="m-0 font-size-14">
                                                            <i
                                                                class="uil uil-question-circle h3 text-primary icon"></i>
                                                           Image Information                                              </h5>
                                                    </div>
                                                </a>

                                                <div id="customaccorcollapseThree" class="collapse"
                                                    aria-labelledby="customaccorheadingThree"
                                                    data-parent="#customaccordion_exa">
                                                    <div class="card-body text-muted">
                                                       <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Image Type</label>
                                                        <div class="col-lg-10">
                                <select class="form-control custom-select" id="image-type" name="image-type" placeholder="image-type">
                                                                <option>Banner/Thumbnail</option>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Photo</label>
                                                        <div class="col-lg-10">
                                 <div>         
                                        <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" name="upload-image" placeholder="upload-image">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
            
                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted  uil-cloud-upload"></i>
                                                <h3>Drop files here or click to upload.</h3>
                                                <span class="text-muted font-13">(Upload Photo)</span>                                            </div>
                                        </form></div>
                                                        </div>
                                                    </div> 
                                          <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="simpleinput"></label>
                                                        <div class="col-lg-10" style="text-align: center;">
                                                            <button type="submit" class="btn btn-primary" name="submit">Upload</button>
                                                        </div>
                                                    </div>
                                           <div class="col-lg-6 col-xl-3">
                                                <div class="card mb-4 mb-xl-0">
                                                    <img class="card-img-top img-fluid" src="assets/images/small/img-2.jpg" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title font-size-16">Uploaded Image 1</h5>
                                                    </div>
                                                    
                                                </div>
                                            </div>  
                                        <div class="clearfix text-right mt-3">
                                            <!--<button type="button" class="btn btn-danger"> <i class="uil uil-arrow-right mr-1"></i> Submit</button>-->
                                        </div> 
                                                                                                       </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="card mb-0" style="margin-top: -17px;">
                                                <a href="" class="text-dark collapsed" data-toggle="collapse"
                                                    data-target="#customaccorcollapse4" aria-expanded="false"
                                                    aria-controls="customaccorcollapse4">
                                                    <div class="card-header" id="customaccorheading4">
                                                        <h5 class="m-0 font-size-14">
                                                            <i
                                                                class="uil uil-question-circle h3 text-primary icon"></i>
                                                           Video Information                            </h5>
                                                    </div>
                                                </a>
                                   
                                                <div id="customaccorcollapse4" class="collapse"
                                                    aria-labelledby="customaccorheading4"
                                                    data-parent="#customaccordion_exa">
                                                    <div class="card-body text-muted">
                                                       <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Video Platform</label>
                                                        <div class="col-lg-10">
                                <select class="form-control custom-select" id="image-type" name="Video Platform" placeholder="Video Platform">
                                                                <option>Select video platform</option>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Video Preview Image</label>
                                                        <div class="col-lg-10">
                                 <div>         
                                        <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" name="upload-video" placeholder="upload-video">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
            
                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted  uil-cloud-upload"></i>
                                                <h3>Drop files here or click to upload.</h3>
                                                <span class="text-muted font-13">(Upload Video Image)</span>                                            </div>
                                        </form></div>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Video Url</label>
                                                        <div class="col-lg-10">
                                                            <input type="Video Url" class="form-control" id="Video Url" placeholder="Enter Video url" name="Video Url" placeholder="Video Url">
                                                        </div>
                                                    </div>
                                          <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Video Duration</label>
                                                        <div class="col-lg-10">
                                                            <input type="Time" class="form-control" id="Time" placeholder="Time" name="Video Duration">
                                                        </div>
                                                    </div>
                                                    
                                           <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="simpleinput"></label>
                                                        <div class="col-lg-10" style="text-align: center;">
                                                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                                        </div>
                                                    </div>  
                                        <div class="clearfix text-right mt-3">
                                            <!--<button type="button" class="btn btn-danger"> <i class="uil uil-arrow-right mr-1"></i> Submit</button>-->
                                        </div> 
                                                                                                       </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <!-- end card-->
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div> <!-- content -->

                

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                2020 &copy; Wranga. All Rights Reserved. Crafted with <i class='uil uil-heart text-danger font-size-12'></i> by <a href="#" target="_blank">WRANGA</a>                            </div>
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
                    <i data-feather="x-circle"></i>                </a>
                <h5 class="m-0">Customization</h5>
            </div>
    
            <div class="slimscroll-menu">
    
                <h5 class="font-size-16 pl-3 mt-4">Choose Variation</h5>
                <div class="p-3">
                    <h6>Default</h6>
                    <a href="index.html"><img src="assets/images/layouts/vertical.jpg" alt="vertical" class="img-thumbnail demo-img" /></a>                </div>
                <div class="px-3 py-1">
                    <h6>Top Nav</h6>
                    <a href="layouts-horizontal.html"><img src="assets/images/layouts/horizontal.jpg" alt="horizontal" class="img-thumbnail demo-img" /></a>                </div>
                <div class="px-3 py-1">
                    <h6>Dark Side Nav</h6>
                    <a href="layouts-dark-sidebar.html"><img src="assets/images/layouts/vertical-dark-sidebar.jpg" alt="dark sidenav" class="img-thumbnail demo-img" /></a>                </div>
                <div class="px-3 py-1">
                    <h6>Condensed Side Nav</h6>
                    <a href="layouts-dark-sidebar.html"><img src="assets/images/layouts/vertical-condensed.jpg" alt="condensed" class="img-thumbnail demo-img" /></a>                </div>
                <div class="px-3 py-1">
                    <h6>Fixed Width (Boxed)</h6>
                    <a href="layouts-boxed.html"><img src="assets/images/layouts/boxed.jpg" alt="boxed"
                            class="img-thumbnail demo-img" /></a>                </div>
            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>
 <!-- Plugins Js -->
       <script src="assets/libs/dropzone/dropzone.min.js"></script>
        <script src="assets/libs/select2/select2.min.js"></script>
        <script src="assets/libs/multiselect/jquery.multi-select.js"></script>
        <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
       
        
        <!-- Init js-->
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
    </body>
</html>