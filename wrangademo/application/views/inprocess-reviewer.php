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
   endinject -->
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
			<img src="<?php echo base_url($this->session->userdata('userPhoto')); ?>" width="50" height="50" alt="Image" />
			<?php } else { ?><img src="<?php echo base_url(); ?>userphoto/userlogo.jpg" width="50" height="50" alt="User Image"/><?php } ?>
              <img src="images/faces/face1.jpg" alt="image">
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
<div class="single-services" style="background:#fff;border: 0 none;border-radius: 3px;box-shadow: 0 17px 41px -21px rgb(0, 0, 0);padding-top: 20px;border-top: 9px solid #7CCDDE;box-sizing: border-box;">
<div class="container" style="width: 100%;" >
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="section-headline services-head text-center"> 
<style>
.section-headline h2::after {
	border:0px;
}
</style>
<h2>Reviewer List<hr style="border: 1px solid #333;background:black; width:40%;"></h2>		 
<h3></h3>
</div>
</div>
</div>
<div class="row text-center">
<div class="services-contents" style="width: 100%;">
<!-- Start Left services -->
<?php if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2') || ($this->session->userdata('userType')=='3')){ ?>
<div class="data" style="margin-right: 2%;">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="section-headline services-head text-center">
<h5 style="float:right">
<a class="services-ico" href="<?php echo base_url_index.'revieweradd'; ?>" title="Add New Reviewer">	
<i class="glyphicon glyphicon-plus">
</i>Add New Reviewer</a><br /> 
</h5> 
</div>
</div>
</div>
<br />
<?php } ?>
<div class="row text-center" style="width: 100%;">
<div class="services-contents" style="margin-left: 2%;width: 100%;">
<!-- Start Left services -->
<div class="col-md-12 col-sm-12 col-xs-12">
<div style="width:100%;">
<table border="1" align="center" id="searchResultTable" style="width:100%;">
<tr style="background:rgba(0, 0, 0, 0.40);color:white;font-weight:bold;font-size:14px;" align="center" >
<td style='text-align:center;padding:1% 0% 1% 0%;'><strong>S. No.</strong></td>
<td style='text-align:center;'><strong>Photo</strong></td>
<td style='text-align:center;'><strong>Name</strong></td>
<td style='text-align:center;'><strong>Email</strong></td>
<td style='text-align:center;'><strong>Phone</strong></td>
<td style='text-align:center;'><strong>Created Date</strong></td>
<?php if($this->session->userdata('userType')=='1') { ?>
  <td style='text-align:center;'><strong>Status</strong></td>
<?php } ?>

<td style='text-align:center;'><strong>Edit</strong></td>
<td style='text-align:center;'><strong>Delete</strong></td>
</tr>
<?php 
if($getListData=="")
{ ?>
<tr style="background:rgba(0, 0, 0, 0.40);color:white;font-weight:bold;font-size:14px;" align="center" >
<td style='text-align:center;padding:1% 0% 1% 0%;' colspan="8">Records Not Found.</td>
</tr>
<?php
}else
{
$i=0;
foreach($getListData as $val){ $i++; ?>
<tr>
<td style='text-align:center;padding:1% 0% 1% 0%;'><?php echo $i ;?></td>
<td style='text-align:center;'><?php if(!empty($val->photo)){ ?>
<img src="<?php echo base_url($val->photo); ?>" width="50" height="50" alt="User Image" />
<?php } else { ?><img src="<?php echo base_url(); ?>userphoto/userlogo.jpg" width="50" height="50" alt="User Image"/><?php } ?></td>
<td style='text-align:center;'><?php echo $val->name; ?></td>
<td style='text-align:center;'><?php echo $val->email; ?></td> 
<td style='text-align:center;'><?php echo $val->phone; ?></td>
<td style='text-align:center;'><?php if($val->created_at!=""){ echo date("d-m-Y H:i:s", strtotime($val->created_at)); } ?></td> 


<?php if($this->session->userdata('userType')=='1') { ?>
<td style='text-align:center;'>
  <?php if($val->status=='1') { ?>
    <a href="<?php echo base_url_index.'OttContent/userStatusActivate/0/adminprocess/'.$val->id; ?>">Active
    </a><?php }else{?>
  <a href="<?php echo base_url_index.'OttContent/userStatusActivate/1/adminprocess/'.$val->id; ?>">Inactive</a>
<?php } ?></td>
<?php } ?>




<td style='text-align:center;'><?php if($this->session->userdata('userType')=='1') { ?><a href="<?php echo base_url_index.'revieweredit/'.$val->id; ?>"><i class="mdi mdi-tooltip-edit"></i></a><?php } ?></td>
<td style='text-align:center;'>
<?php $var1='Do you really want to delete this user?'; ?>
<?php if($this->session->userdata('userType')=='1') { ?><a data-toggle="modal" href="#myModa22" onclick="$('#condId').val('<?php echo $val->id; ?>');showingMsg2('<?php echo $var1; ?>');"><i class="mdi mdi-delete"></i></a><?php } ?></td>		
</tr><?php } } ?>
</table>			 
</div>
<br />
</div>
</div>
</div>
</div>
</div>
</div><!-- #primary -->
</div><!-- #main .wrapper -->
</div><!-- #page -->
</div>
</div>
</div>
		

<div class="modal fade" style="overflow:scroll;" id="myModa22" role="dialog" align="center" data-keyboard="false" data-backdrop="static">
<div class="modal-dialog" >
<!-- Modal content-->
<div class="modal-content" >
<div class="modal-header alert alert-success">
<button type="button" class="close" data-dismiss="modal"></button>
<h4 class="modal-title" style="color:black;">Wranga Management System states</h4>
</div>
<div class="modal-body" id="pubIdSh2">

</div>
<div class="modal-footer">
<input type="hidden" name="condId" id="condId" />
<button type="button" onclick="myFunction1();" data-dismiss="modal" class="btn btn-primary pull-left" style="width:40%;" >OK</button> <button type="button" data-dismiss="modal" class="btn btn-primary pull-right" style="width:40%;" >Cancel</button>
</div>
</div>
</div>
</div>

<script>
function showingMsg2(did) { 
	$('#pubIdSh2').html(did);
}
function myFunction1() { 
	condemnId=$('#condId').val();
	$('#myModa22').modal("hide");
	var urlI='<?php echo base_url(); ?>deletereviewer/'+condemnId;
	window.location.href = urlI;
}
</script>		
		
		
		
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="https://www.bootstrapdash.com/" target="_blank"></a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> <i class="mdi mdi-heart text-danger"></i></span>
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
