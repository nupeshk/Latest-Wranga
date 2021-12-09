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
        
        <title> Pooja filling station | Admin </title>
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>css/style.css" rel="stylesheet">
        <link href="<?php echo base_url() . PUBLIC_ABS; ?>css/custom.css" rel="stylesheet">
    </head>
    <body class="fix-header">
        <section id="wrapper" class="login-register">
            <!--<div class="left-logo pull-left p-20">
                <span class="logo-left"><a class="logo" href="<?php //echo base_url()?>admin"><img src="<?php //echo base_url() . PUBLIC_ABS; ?>images/LOGO_ORANGE.png" style="height:200px; width:400px;" alt=""></a></span>
            </div> -->
            <div class="login-box">
                <div class="white-box text-center">   
					 <?php if (!empty($this->session->flashdata('error'))) : ?>
                        <div class="error m-t-20 m-b-20"><span class="text-danger"><?php echo $this->session->flashdata('error'); ?> </span></div> 
                     <?php endif; ?>
                     <?php if (!empty($this->session->flashdata('success'))) : ?>
                        <div class="error m-t-20 m-b-20"><span class="text-success"><?php echo $this->session->flashdata('success'); ?> </span></div> 
                     <?php endif; ?>   
                     <!--<img src="<?php //echo base_url() . PUBLIC_ABS; ?>images/Image_1.png" style="height:150px; width:400px;" alt="">  -->
                     <h3>Pooja filling station</h3>            
                    <form class="form-horizontal form-material" id="loginform" action="<?php echo base_url('admin'); ?>" method="POST">
                        <h3 class="box-title m-b-0">Login</h3>
                        <small>Enter your details below</small>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="administratorEmail" id="administratorEmail" value="<?=$this->input->cookie('administratorEmail_cookie',TRUE); ?>" placeholder="Email">
                                <span class="form_error error text-danger pull-left" id="err_administratorEmail"><?php echo form_error('administratorEmail'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="administratorPassword" id="administratorPassword" value="<?=$this->input->cookie('administratorPassword_cookie',TRUE); ?>" placeholder="Password">
                                <span class="form_error error text-danger pull-left" id="err_administratorPassword"><?php echo form_error('administratorPassword'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox checkbox-success pull-left p-t-0">
                                    <input name="remember" <?php if($this->input->cookie('administratorEmail_cookie',TRUE)){ echo "checked"; }   ?> id="remember" value="1" type="checkbox">
                                    <label for="remember"> Remember me </label>
                                </div>   
                                <!--<a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a> -->         
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-yellow btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="submit">Log In</button>
                            </div>
                        </div>
                        <?php /*?><div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                    <a href="<?php echo base_url('admin/registration'); ?>" class="m-r-10 p-t-10" id="registration" title="Account Registration">Account Registration</a> 
                                    <a href="javascript:void(0)" class="p-t-10" data-toggle="tooltip"  title="Comingsoon"> <!--<img src="<?php //echo base_url() . PUBLIC_ABS; ?>images/google-play.png" alt=""> --><i class="fa fa-user-plus" aria-hidden="true"></i></a> 
                            </div>
                        </div> <?php */ ?>
                        <!--<div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                <div class="social">
                                    <a href="javascript:void(0)" class="m-r-10 p-t-10" data-toggle="tooltip"  title="Comingsoon"> <img src="<?php //echo base_url() . PUBLIC_ABS; ?>images/app-store.png" alt=""> </a> 
                                    <a href="javascript:void(0)" class="p-t-10" data-toggle="tooltip"  title="Comingsoon"> <img src="<?php //echo base_url() . PUBLIC_ABS; ?>images/google-play.png" alt=""> </a> 
                                </div>
                            </div>
                        </div> -->
                    </form>
                    
                    <form class="form-horizontal" method="post" name="recoverform" id="recoverform" action="">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                                <div id="error_msg" class=""></div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="email" id="email" required="" placeholder="Email">
                            </div>
                        </div>
                        <a href="javascript:void(0)" id="to-login" class="text-dark pull-right m-b-20"><i class="fa fa-sign-in m-r-5"></i> Login</a>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-yellow btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" id="reset">Reset</button>
                            </div>
                        </div>
                    </form>
                    
                    <form class="form-horizontal form-material" name="registrationform" id="registrationform" action="<?php echo base_url('admin/registration'); ?>" method="POST" style="display:none;">
                        <h3 class="box-title m-b-0">Account Registration</h3>
                        <small>Enter your details below</small>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="fullName" id="fullName" value="" placeholder="Enter your name">
                                <span class="form_error error text-danger pull-left" id="err_fullName"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="email" id="email" value="" placeholder="Enter your Email">
                                <span class="form_error error text-danger pull-left" id="err_email"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" id="password" value="" placeholder="Enter your Password">
                                <span class="form_error error text-danger pull-left" id="err_password"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="c_password" id="c_password" value="" placeholder="Enter your Password Again">
                                <span class="form_error error text-danger pull-left" id="err_c_password"></span>
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-yellow btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="submit">Register</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                    <a href="javascript:void(0)" class="m-r-10 p-t-10" id="login"  title="Account Login">Already have a account</a> 
                                    <a href="javascript:void(0)" class="p-t-10" data-toggle="tooltip"  title="Comingsoon"> <!--<img src="<?php //echo base_url() . PUBLIC_ABS; ?>images/google-play.png" alt="">---> <i class="fa fa-sign-in" aria-hidden="true"></i></a> 
                            </div>
                        </div>
                    </form>

                    <!--<div class="footer-text fix-footer text-center"> <p>&copy; Copyright 2018 <a href="" target="blank">Flow Sport Life</a></p></div> -->
                </div>
            </div>
        </section>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/bootstrap.min.js"></script>        
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/sidebar-nav.min.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/custom.js"></script>
        <script src="<?php echo base_url() . PUBLIC_ABS; ?>js/jquery.validate.js"></script>

        <script>
            $(document).ready(function () {    
				$("#to-recover").on("click",function(){
					$("#loginform").slideUp(),
					$("#recoverform").fadeIn()
				});
				$("#to-login").on("click",function(){
					$("#recoverform").slideUp(),
					$("#loginform").fadeIn()
				});            
				
                $("#loginform").validate({                    
                    rules: {
                        adminEmail: {
                            required: true,
                            email: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                        },
                        adminPassword: {
                            required: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                        }
                    },
                    messages: {
                        adminEmail: {
                            required: "Please enter your email",
                        },
                        adminPassword: {
                            required: "Please enter your password",
                        }
                    },
                    errorElement: 'span',
                    errorClass: 'error-msg text-danger pull-left',
                    errorPlacement: function (error, element) {
                        "use strict";
                        error.insertAfter(element);
                    },
                });
                 
                 $("#recoverform").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                }
            },
            messages: {
                email: {
                    required: "Please enter your email",
                }
            },
            errorElement: 'span',
            errorClass: 'text-danger pull-left',
            errorPlacement: function (error, element) {
                "use strict";
                error.insertAfter(element);
            },
            submitHandler: function (form, evt) {
                evt.preventDefault();

                //sendResultData();
                var formData = new FormData(form);
                //formData.append('video', $('#video')[0].files[0]);
                $("#recoverform #reset").attr("disabled", true).text("Sending...");
                $.ajax({
                    type: $(form).attr('method'),
                    //url: $(form).attr('action'),
                    url: "<?php echo base_url() ?>admin/forgot",
                    data: formData, //$(form).serialize(),
                    mimeType: "multipart/form-data",
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function (response) {
                    $("#recoverform #email").val("");
                    $("#recoverform #reset").attr("disabled", false).text("Reset");
                    //console.log(response);
                    var result = JSON.parse(response);
                    //alert(result.code);
                    if (result.code == 200) {
                        //showAlertMessage("success", result.message);
                        var classs = "error-msg text-success";
                    } else {
                        var classs = "error-msg text-danger";
                        //showAlertMessage("error", result.message);
                    }
                    $("#recoverform #error_msg").addClass(classs).text(result.message);
                });
                return false; // required to block normal submit since you used ajax
            }
        });

                 $("#registrationform").validate({                    
                    rules: {
                        fullName: {
                            required: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                        },
                        email: {
                            required: true,
                            email: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                        },
                        password: {
                            required: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                        },
                        c_password: {
                            required: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        fullName: {
                            required: "Please enter your name",
                        },
                        email: {
                            required: "Please enter your email",
                        },
                        password: {
                            required: "Please enter your password",
                        },
                        c_password: {
                            required: "Please enter your password again",
                        }
                    },
                    errorElement: 'span',
                    errorClass: 'error-msg text-danger pull-left',
                    errorPlacement: function (error, element) {
                        "use strict";
                        error.insertAfter(element);
                    },
                });
            });
        </script>

    </body>
</html>
