<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
<ul class="nav">
	
<li class="nav-item">
	<!--a class="nav-link" href="<?php echo base_url_index.'dashboard'; ?>">
		<span class="menu-title"><i class="mdi mdi-home menu-icon"></i>	Dashboard</span>
		<span class="menu-sub-title" style="font-size: 12px;">
</a-->
			<?php 
			if(isset($_SESSION)){
				if($_SESSION['userType']==1){
					echo "Super Admin";
				}elseif($_SESSION['userType']==2){
					echo "Admin";
				}elseif($_SESSION['userType']==3){
					echo "Team Leader";
				}elseif($_SESSION['userType']==4){
					echo "Reviewer";
				}else{
					
				}
			}	
			?>

		</span>
	
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#otts" aria-expanded="false" aria-controls="ui-basic">
<span class="menu-title"><i class="mdi mdi-arrow-right-drop-circle-outline"></i> OTTs</span>
<i class="mdi mdi-arrow-down"></i>
</a>
<div class="collapse" id="otts">
	<ul class="nav flex-column sub-menu">
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'published-otts'; ?>">Publish OTTs</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'categories'; ?>">Catagories</a></li>

		

		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'ott-content-type'; ?>">OTT Content Type</a></li>


<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'ott-platform-type'; ?>">OTT Platform Type</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'content-type'; ?>">Content Type</a></li>
	</ul>
</div>
</li>


<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#games" aria-expanded="false" aria-controls="ui-basic">
<span class="menu-title"><i class="mdi mdi-gamepad-variant"></i> Games</span>
<i class="mdi mdi-arrow-down"></i>
</a>
<div class="collapse" id="games">
	
	<ul class="nav flex-column sub-menu">
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'games-published'; ?>">Publish Games</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'games-categories'; ?>">Catagories</a></li>
	</ul>

</div>
</li>


<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#app" aria-expanded="false" aria-controls="ui-basic">
<span class="menu-title"><i class="mdi mdi-shopping-music"></i> App</span>
<i class="mdi mdi-arrow-down"></i>
</a>
<div class="collapse" id="app">
	<ul class="nav flex-column sub-menu">
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'app-published'; ?>">Publish App</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'app-categories'; ?>">Catagories</a></li>
	</ul>
</div>
</li>



<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#book" aria-expanded="false" aria-controls="ui-basic">
<span class="menu-title"><i class="mdi mdi-book-open-page-variant"></i> Advisory</span>
<i class="mdi mdi-arrow-down"></i>
</a>
<div class="collapse" id="book">
	<ul class="nav flex-column sub-menu">
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'book-published'; ?>">Publish Advisory</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'book-categories'; ?>">Catagories</a></li>
	</ul>
</div>
</li>

<?php if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2') || ($this->session->userdata('userType')=='3')){ ?>

<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
<span class="menu-title"><i class="mdi mdi-account"></i> User Management</span>
<i class="mdi mdi-arrow-down"></i>
</a>
<div class="collapse" id="ui-basic4">
<ul class="nav flex-column sub-menu">
<?php if(($this->session->userdata('userType')=='1')){ ?>
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'adminprocess'; ?>">Admin</a>
<span class="badge badge-success float-right"><?php echo $adminCount?></span></li>
<?php } ?>
<?php if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2')){ ?>
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'teamleaderprocess'; ?>">Team Leader/s</a>
<span class="badge badge-success float-right"><?php echo $teamLeaderCount?></span></li>
<?php } ?>
<?php if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2') || ($this->session->userdata('userType')=='3')){ ?>
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'reviewerprocess'; ?>">Reviewer/s</a>
<span class="badge badge-success float-right"><?php echo $reviewerCount?></span></li>
<?php } ?>
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'mobile-users'; ?>">Mobile Users</a>
<span class="badge badge-success float-right"><?php echo $mobileCount?></span></li>
</ul>
</div>
</li>


<?php if(isset($_SESSION) && $_SESSION['userType']==1 OR $_SESSION['userType']==2){?>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="ui-basic">
<span class="menu-title"><i class="mdi mdi-settings"></i> Settings</span>
<i class="mdi mdi-arrow-down"></i>
</a>
<div class="collapse" id="setting">
	<ul class="nav flex-column sub-menu">
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'push-notification'; ?>">Push Notification</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'setting-about-us'; ?>">About Us</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'paymentPlan'; ?>">Payment Plan</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'planBenifits'; ?>">Plan Benifits</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'language'; ?>">Language</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'genre'; ?>">Content Genre</a></li>
	</ul>
</div>
</li>
<?php } ?>


<?php } ?>



</ul>
</nav>