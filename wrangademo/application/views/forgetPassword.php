<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Wranga</title>
  <!-- plugins:css -->
  
  <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>fonts/materialdesignicons.min.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.png" />
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />

<style> 
.emailicon {
    float: left;
    background-color: #eee;
    padding: 4px 6px;
    position: absolute;
    top: 25px;
    left: 1px;
}
.btn-primary{background-color: #191643 !important; border-color: #191643 !important;}
.form-control{text-indent: 26px;}
</style>
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth-pages">
          <div class="card col-lg-4 mx-auto">
		   

       <form method="post" action="<?php echo base_url_index.'forgetPassword'; ?>" onSubmit="return frmValidation();">

            <div class="card-body px-5 py-5">
			  <img src="<?php echo base_url(); ?>images/logo.png" width="150" alt="logo"/><br /><br />
              <h4 class="card-title text-left mb-3">Welcome Back!</h4>
			  <p>Enter your Email address and retrieve your password</p>
              <span style="color:red;font-weight:bold;height:20px;padding-bottom:1%;">&nbsp;&nbsp;&nbsp;<?php if(isset($error)){ echo $error;} ?></span>
                <div class="form-group" style="position: relative;">
                  <label><b>Email Address -</b> *</label>
                  <div class="emailicon"><i class="mdi mdi-email-outline"></i></div> <input type="email" name="email" id="email" placeholder="hello@abc.com" class="form-control p_input" required>
                </div>
              


                <div class="text-center">
                  <input type="submit" class="btn btn-primary btn-block enter-btn" value="submit">
                </div>
                <div class="d-flex">
                  <button class="btn" style="background: none;">
                  </button>
                </div>
                <p class="sign-up"><a href="#"></a></p>
            </div>
           </form>
		  </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="../../node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../../node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/misc.js"></script>
  <!-- endinject -->
</body>

</html>
