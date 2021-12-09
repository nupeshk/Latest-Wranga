<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="icon" sizes="32x32" href="<?php echo base_url() . PUBLIC_ABS; ?>images/favicon_1.ico">
        <link rel="manifest" href="<?php echo base_url() . PUBLIC_ABS; ?>images/favicon/site.webmanifest">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <title>Pooja Filling Station | Admin</title>
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>css/sidebar-nav.min.css" rel="stylesheet">
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>css/animate.min.css" rel="stylesheet">
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>css/style.css" rel="stylesheet">
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>css/custom.css" rel="stylesheet">

        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/sidebar-nav.min.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/moment.min.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/highcharts.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/jquery.validate.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/custom.js"></script>
    </head>

    <body class="fix-header">
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header">
                    <div class="top-left-part sidebar-logo"> <a class="logo" href="javascript:void(0);"> <!--<img class="header-logo" width="180px" src="<?php echo base_url() . PUBLIC_ABS; ?>images/LOGO_WHITE.png" alt="logo">-->Pooja</a> </div>
                    <ul class="nav navbar-top-links navbar-left">
                        <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="fa fa-bars" aria-hidden="true"></i></a></li>
                    </ul>
                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <!--<img src="<?php //echo base_url() . PUBLIC_ABS; ?>images/varun.jpg" alt="user-img" width="36" class="img-circle">--><b class="hidden-xs"><?php echo ucwords($adminData['adminName']); ?></b><span class="caret"></span> </a>
                            <ul class="dropdown-menu dropdown-user animated flipInY">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-text">
                                            <h4><?php echo ucwords($adminData['adminName']); ?></h4>
                                            <p class="text-muted"><?php echo $adminData['adminEmail']; ?></p>
                                        </div>
                                    </div>
                                </li>
                                <!--<li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url(); ?>admin/setting"><i class="fa fa-cog" aria-hidden="true"></i> CEBEO Account settings</a></li>-->
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url(); ?>admin/changepassword"><i class="fa fa-cog" aria-hidden="true"></i> Change Password</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url() ?>admin/logout"><i class="fa fa-lock" aria-hidden="true"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
