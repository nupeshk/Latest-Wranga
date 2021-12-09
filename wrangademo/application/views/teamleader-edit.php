<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <title></title>
  <!-- plugins:css -->
  
  <!--<link rel="stylesheet" href="https://markup.themewagon.com/PurpleAdmin-Free-Admin-Template/node_modules/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://markup.themewagon.com/PurpleAdmin-Free-Admin-Template/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css">
  <link rel="stylesheet" href="https://markup.themewagon.com/PurpleAdmin-Free-Admin-Template/node_modules/jquery-bar-rating/dist/themes/css-stars.css">
  <link rel="stylesheet" href="https://markup.themewagon.com/PurpleAdmin-Free-Admin-Template/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/materialdesignicons.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>fonts/materialdesignicons.min.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url(); ?>"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <div class="search-field ml-4 d-none d-md-block">
          <form class="d-flex align-items-stretch h-100" action="#">
            <div class="input-group">
              <input type="text" class="form-control bg-transparent border-0" placeholder="Search">
              <div class="input-group-btn">
                <button type="button" class="btn bg-transparent dropdown-toggle px-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-earth"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#">Today</a>
                  <a class="dropdown-item" href="#">This week</a>
                  <a class="dropdown-item" href="#">This month</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Month and older</a>
                </div>
              </div>
              <div class="input-group-addon bg-transparent border-0 search-button">
                <button type="submit" class="btn btn-sm bg-transparent px-0">
                  <i class="mdi mdi-magnify"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-email-outline"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <h6 class="p-3 mb-0">Messages</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                  <p class="text-gray mb-0">
                    1 Minutes ago
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                  <p class="text-gray mb-0">
                    15 Minutes ago
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                  <p class="text-gray mb-0">
                    18 Minutes ago
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">4 new messages</h6>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell-outline"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <h6 class="p-3 mb-0">Notifications</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-calendar"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                  <p class="text-gray ellipsis mb-0">
                    Just a reminder that you have an event today
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-settings"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                  <p class="text-gray ellipsis mb-0">
                    Update dashboard
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-link-variant"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                  <p class="text-gray ellipsis mb-0">
                    New admin wow!
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">See all notifications</h6>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-profile" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
			<?php if(!empty($this->session->userdata('userPhoto'))){ ?>
			<img src="<?php echo base_url($this->session->userdata('userPhoto')); ?>" width="50" height="50" alt="Image" /><?php } else { ?><img src="<?php echo base_url(); ?>userphoto/userlogo.jpg" width="50" height="50" alt="User Image"/><?php } ?>
              <span class="d-none d-lg-inline"><?php if(!empty($this->session->userdata('userName'))){ echo $this->session->userdata('userName'); } ?></span>
            </a>
            <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-cached mr-2 text-success"></i>
                Activity Log
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo base_url_index.'logout'; ?>">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Signout
              </a>
            </div>
          </li>
          <li class="nav-item nav-logout d-none d-lg-block">
            <a class="nav-link" href="<?php echo base_url_index.'logout'; ?>">
              <i class="mdi mdi-power"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:partials/_sidebar.html -->
        <?php include('template/leftmenu.php'); ?>
		<!-- partial -->
        <div class="content-wrapper">
		
		<div id="about" class="about-area area-padding">
		<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12" style="padding-top:3%;">
<div style="text-align:right"><h5><a class="services-ico" href="<?php echo base_url_index.'teamleaderprocess'; ?>">&lt;&lt; Back</a></h5></div>
<div class="row text-center">
<div class="services-contents"  style="width: 100%;">
<!-- Start Left services -->
<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:0px;">
<div class= "about-move" >
<div class="services-details" style="padding-top:10px;">
<div class="single-services" style="background:#fff;border: 0 none;border-radius: 3px;box-shadow: 0 17px 41px -21px rgb(0, 0, 0);border-top: 9px solid #7CCDDE;box-sizing: border-box;">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="form-group" >
<h3 style="margin-top:30px;"><strong>Edit Team Leader</strong><div class="fs-subtitle" align="center" style="font-weight:normal;font-size:16px;width:90%;margin-left:5%;"></div> </h3>
</div>

<div class="container" style="width:100%;" >
<form action="<?php echo base_url_index.'update_teamleader/'.$this->uri->segment(2); ?>" method="post" onSubmit="return checkSignatureStatus();" autocomplete="off" enctype="multipart/form-data" >
<!-- Begin Name and address of person/entity making the complaint: -->
<div class="container" style="font-size:16px;">
<div class="col-md-12 col-sm-12 col-xs-12">
<table id="frmTb" align="center" border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th style="padding:1%;width:50%;text-align:center;">Name</th>
<th style="padding:1%;text-align:center;">Email</th>
</tr>
<tr>
<td style="padding:1%;text-align:center;">
<input type="text" class="form-control" name="name" title="Name" placeholder="Name" value="<?php echo $name; ?>" required ></td>
<td style="padding:1%;text-align:center;">
<input type="email" name="email" class="form-control" title="Email" placeholder="Email" value="<?php echo $email; ?>"  required >
<input type="hidden" name="user_type" value="<?php echo "3"; ?>"></td>
</tr>
<tr>
<th style="padding:1%;text-align:center;">Password</th>
<th style="padding:1%;text-align:center;">Phone</th>
</tr>
<tr>
<td style="padding:1%;text-align:center;">
<input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" placeholder="Password" required=""></td>
<td style="padding:1%;text-align:center;">
<input class="form-control" type="phone" name="phone" id="phone" value="<?php echo $phone; ?>" onkeypress="return isNumberKey(event);" maxlength="10" placeholder="Phone" required=""></td>
</tr>
<tr>
<th style="padding:1%;text-align:center;">Address</th>
<th style="padding:1%;text-align:center;">PAN</th>
</tr>
<tr>
<td style="padding:1%;text-align:center;">
<textarea class="form-control" rows="3" name="address" placeholder="Address" required=""><?php echo $address; ?></textarea></td>
<td style="padding:1%;text-align:center;">
<input type="text" class="form-control" name="pan" value="<?php echo $pan; ?>" placeholder="PAN" required></td>
</tr>
<tr>
<th style="padding:1%;text-align:center;">Adhar</th>
<th style="padding:1%;text-align:center;">Photo</th>
</tr>
<tr>
<td style="padding:1%;text-align:center;">
<input class="form-control" type="adhar" name="adhar" id="adhar" value="<?php echo $adhar; ?>" placeholder="Adhar" required></td>
<td style="padding:1%;text-align:center;">
<input type="file" class="form-control"  name="photo" placeholder="Photo" accept="image/*" data-max-size="2048">
<input type="hidden" name="oldfile" value="<?php echo $photo; ?>" />
<?php if(!empty($photo)){ ?>
<img src="<?php echo base_url($photo); ?>" width="50" height="50" />
<?php } ?></td>
</tr>
<tr>
<th style="padding:1%;text-align:center;">Administration</th>
<th style="padding:1%;text-align:center;">Comments</th>
</tr>
<tr>
<td style="padding:1%;text-align:center;">
<select name="parent_type" id="parent_type" placeholder="Select Administration" title="Select Administration" class="form-control" required >
<option value="">Select Administration</option>
<?php foreach($this->user_database->getuserList('2') as $usr){ ?>
<option value="<?php echo $usr->id; ?>" <?php if($usr->id==$parent_type) { echo "selected"; } ?> ><?php echo $usr->name; ?></option>
<?php } ?>
</select></td>
<td style="padding:1%;text-align:center;">
<textarea class="form-control" rows="5" name="comment" placeholder="Comment"><?php echo $comment; ?></textarea></td>
</tr>

</table>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">&nbsp;</div> 
<div class="col-md-3 col-sm-12 col-xs-12" style="padding-bottom: 2%;">
<input class="btn btn-success btncenter2" type="submit" value="Submit" name="submit" style="width: 100%;">

</div>
</div>
</div>
</form>
</div>
</div>
</div>
<!-- end about-details -->
</div>
</div>
</div>
</div>
</div>
</div>
</div>
		</div>
<script>
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode != 46 && charCode > 31 
	&& (charCode < 48 || charCode > 57))
	return false;
	return true;
}
</script>		
		
		
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="https://www.bootstrapdash.com/" target="_blank"> <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
<link href="<?php echo base_url('css/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" />
  <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>js/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>js/perfect-scrollbar.jquery.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?php echo base_url(); ?>js/Chart.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo base_url(); ?>js/off-canvas.js"></script>
  <script src="<?php echo base_url(); ?>js/misc.js"></script>
  <script src="<?php echo base_url(); ?>js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
