<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
<ul class="nav">
	
<li class="nav-item">
	<a class="nav-link" href="<?php echo base_url_index.'dashboard'; ?>">
		<span class="menu-title"><i class="mdi mdi-home menu-icon"></i>	Dashboard</span>
		<!-- <span class="menu-sub-title" style="font-size: 12px;">superadmin</span> -->
	</a>
</li>

<li class="nav-item">
	<a class="nav-link" href="<?php echo base_url_index.'published-otts'; ?>">
		<span class="menu-title"><i class="mdi mdi-arrow-right-drop-circle-outline"></i> OTT</span>
	</a>
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
<span class="menu-title"><i class="mdi mdi-gamepad-variant"></i> Games</span>
<i class="mdi mdi-arrow-down"></i>
</a>
<div class="collapse" id="ui-basic1">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'games-published'; ?>">Published</a></li>
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'games-pending'; ?>">Pending</a></li>
</ul>
</div>
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
<span class="menu-title"><i class="mdi mdi-shopping-music"></i> App</span>
<i class="mdi mdi-arrow-down"></i>
</a>
<div class="collapse" id="ui-basic2">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'app-published'; ?>">Published</a></li>
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'app-pending'; ?>">Pending</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
<span class="menu-title"><i class="mdi mdi-book-open-page-variant"></i> Book</span>
<i class="mdi mdi-arrow-down"></i>
</a>
<div class="collapse" id="ui-basic3">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'book-published'; ?>">Published</a></li>
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'book-pending'; ?>">Pending</a></li>
</ul>
</div>
</li>

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
<li class="nav-item"> <a class="nav-link" href="#">Mobile Users</a>
<span class="badge badge-success float-right"><?php echo $mobileCount?></span></li>
</ul>
</div>
</li>


<li class="nav-item">
	<a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="ui-basic">
		<span class="menu-title"><i class="mdi mdi-settings"></i> Settings</span>
		<i class="mdi mdi-arrow-down"></i>
	</a>
<div class="collapse" id="settings">
	<ul class="nav flex-column sub-menu">
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'catagories'; ?>">Catagories</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'platform'; ?>">Platform</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'language'; ?>">Language</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'ott-content-type'; ?>">OTT Content Type</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'content-type'; ?>">Content Type</a></li>
		<li class="nav-item"> <a class="nav-link" href="<?php echo base_url_index.'genre'; ?>">Genre</a></li>
	</ul>
</div>
</li>



</ul>
</nav>
