
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head hidden-md">
            <h3><span class="fa-fw open-close"><i class="fa fa-times" aria-hidden="true"></i></span>
                <span class="hide-menu">Navigation</span>
            </h3>
        </div>
        <ul class="nav" id="side-menu">
            <li> <a href="<?php echo base_url(); ?>admin/dashboard" class=""><i class="fa fa-tachometer"></i> <span class="hide-menu">Dashboard</span></a></li>
            <li> <a href="<?php echo base_url(); ?>admin/users" class=""><i class="fa fa-user"></i> <span class="hide-menu">Users</span></a></li>
            <li> <a href="<?php echo base_url(); ?>admin/transaction" class=""><i class="fa fa-exchange"></i> <span class="hide-menu">Transaction</span></a></li>
            <!--<li> <a href="<?php //echo base_url(); ?>admin/products" class=""><i class="fa fa-tags"></i> <span class="hide-menu">Products</span></a></li>
            <li> <a href="<?php //echo base_url(); ?>admin/inventory" class=""><i class="fa fa-archive"></i> <span class="hide-menu">Inventories</span></a></li>
            <li> <a href="<?php //echo base_url(); ?>admin/project" class=""><i class="fa fa-tasks"></i> <span class="hide-menu">Projects</span></a></li>
            <li class=""> <a href="#" class="waves-effect"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="hide-menu">Purchasing <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
					<li><a href="<?php //echo base_url(); ?>admin/purchase/goods-receipt"><span class="fa fa-angle-right"></span> Goods Receipt</a></li>
				</ul>
            </li>-->
            <li> <a href="<?php echo base_url(); ?>admin/setting" class=""><i class="fa fa-gear"></i> <span class="hide-menu">Settings</span></a></li>
        </ul>
    </div>
</div>
<?php $page_title = $this->uri->segment('2'); ?>

<!--/.row -->

