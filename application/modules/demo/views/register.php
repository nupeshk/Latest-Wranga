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
        <link rel="shortcut icon" href="<?php echo base_url() . PUBLIC_ABS; ?>assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">
        
        <div class="account-pages my-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-lg-6 p-5">
                                        <div class="mx-auto mb-5">
                                            <a href="index.html">
                                                <img src="assets/images/logo-log.png" alt="" height="24" />
                                                <!--<h3 class="d-inline align-middle ml-1 text-logo">Wranga</h3>-->
                                            </a>
                                        </div>

                                        <h6 class="h5 mb-0 mt-4">Create your account</h6>
                                        <p class="text-muted mt-0 mb-4">Create a free account and start using Wranga</p>

                                        <form action="" method="POST" class="authentication-form">
                                            

                                            <div class="form-group">
                                                <label class="form-control-label">User Type</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="user"></i>
                                                        </span>
                                                    </div>
                                                    <select name="user_type" id="">
                                                           <option value="1">SuperAdmin</option>
                                                           <option value="2">Admin</option>
                                                           <option value="3">teamLeader</option>
                                                           <option value="4">Reviewer</option>
                                                            
                                                            
                                                            
                                                            
                                                    </select>
                                                </div>
                                            </div>





                                            <div class="form-group">
                                                <label class="form-control-label">Name</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="user"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="name" class="form-control" id="name"
                                                        placeholder="Your full name">
                                                </div>
                                            </div>




                                            <div class="form-group">
                                                <label class="form-control-label">Email Address</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="mail"></i>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="hello@abc.com">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="form-control-label">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                                    </div>
                                                    <input type="password" name="password" class="form-control" id="password"
                                                        placeholder="Enter your password">
                                                </div>
                                            </div>

                                            <div class="form-group mb-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="terms" class="custom-control-input"
                                                        id="checkbox-signup" checked>
                                                    <label class="custom-control-label" for="checkbox-signup">
                                                        I accept <a href="javascript: void(0);">Terms and Conditions</a>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group mb-0 text-center">
                                                <input name="submit" type="submit" class="btn btn-md btn-custom btn-block" value="Register">
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <div class="col-lg-6 d-none d-md-inline-block">
                                       <div class="auth-page-sidebar" style="background-image:url(<?php echo base_url() . PUBLIC_ABS; ?>assets/images/stater-bg.png)">
                                           <!-- <div class="overlay"></div>
                                            <div class="auth-user-testimonial">
                                                <p class="font-size-24 font-weight-bold text-white mb-1">I simply love it!</p>
                                                <p class="lead">"It's a elegent templete. I love it very much!"</p>
                                                <p>- Admin User</p>
                                            </div>
                                        </div>-->
                                        </div>
                                    </div>
                                </div>
                                
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Already have account? <a href="index.html" class="text-primary font-weight-bold ml-1">Login</a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>assets/js/app.min.js"></script>
        
    </body>
</html>
