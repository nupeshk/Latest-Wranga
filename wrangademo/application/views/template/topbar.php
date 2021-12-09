<style> 
.mainsec{width: 100%; float: left;; padding: 20px; background-color: #fff !important; min-height: 609px;}
.mainsec h1{font-size: 24px; color: #333; padding-bottom: 20px;}

.sidebar .nav .nav-item .nav-link i {
    padding-right: 8px !important;
}
.unpbsh{font-size: 19px; color: #6a0089; margin-left: 10px;}
.table-striped tbody tr:nth-of-type(odd){background-color: #fbfbfb !important;}

.dropbtn {
    background-color: transparent !important;
    color: #333;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
} 

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.navbar .navbar-menu-wrapper .search-field .search-button i {
    color: #555;
}

.input-group-addon {
    padding: 0 0.75rem !important;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.navbar .navbar-menu-wrapper .search-field .search-button:before {
    background: #f3f3f3 !important;
}


.fullbox{position: relative;  width: 100%; float: left;}
.whiteolap{position: absolute; bottom: 0; left: 0; width: 24%; height: 20px; background-color: #fff; z-index: 999;}
.canvasjs-chart-credit{display: none;}
.fivestar{float: left; margin-top: 54px;}
.chart{float: left;}
.starrating{width: 100%; float: left; margin-bottom: 33px;}
.table-responsive{overflow-x: hidden !important;}
.table-responsiveoverflow-x: hidden !important;}
.table td, .table th{vertical-align: middle !important;}
.card-body h4 span{float: right !important; width: 100%;}
.mildbdr {
    border: 1px #ddd solid !important;
    width: 90%;
    padding: 5px 8px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 3px;
    color: #999;
    font-size: 13px;
}
.mdi-star{color: green;}
.mdi-star-outline{color: #ccc;}
.ratsec{float: left !important;}
.ratsec h4 span{color: #008000; font-weight: normal;}
.topcont{text-align: center;}



@media only screen and (max-width: 768px){
.ratsec{margin-bottom: 20px;}
}

</style>

   
        <link href="http://wranga.in/public/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
         <link href="http://wranga.in/public/assets/css/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        

        <!--
        <link href="http://wranga.in/public/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="http://wranga.in/public/assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <script src="http://wranga.in/public/assets/js/vendor.min.js"></script>
        <script src="http://wranga.in/public/assets/libs/datatables/responsive.bootstrap4.min.js"></script>
        <script src="http://wranga.in/public/assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="http://wranga.in/public/assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="http://wranga.in/public/assets/libs/datatables/buttons.flash.min.js"></script>
        <script src="http://wranga.in/public/assets/libs/datatables/buttons.print.min.js"></script>
        <script src="http://wranga.in/public/assets/libs/dropzone/dropzone.min.js"></script>
        <script src="http://wranga.in/public/assets/libs/moment/moment.min.js"></script>
        <script src="http://wranga.in/public/assets/libs/apexcharts/apexcharts.min.js"></script>
        <script src="http://wranga.in/public/assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="http://wranga.in/public/assets/js/pages/dashboard.init.js"></script>
        <script src="http://wranga.in/public/assets/js/app.min.js"></script>
        -->




<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="<?php echo base_url(); ?>index.php/published-otts"><img src="<?php echo base_url(); ?>images/logo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url(); ?>"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <div class="search-field ml-4 d-none d-md-block">
         

        <form class="d-flex align-items-stretch h-100" action="http://localhost/WrangaWeb/wrangademo/index.php/published-otts" method="post">
            <div class="input-group">
              <input type="text" class="form-control bg-transparent border-0" placeholder="Search By OTT" name="search"
              <?php if(isset($_POST['search'])){?>
                   value="<?=$_POST['search']?>" 
              <?php } ?>
             >

              <div class="input-group-addon bg-transparent border-0 search-button">

    <input type="submit" name="searchButton" class="btn btn-sm bg-transparent px-0">

              </div>
            </div>
          </form>


        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link nav-profile" href="#">
      <?php if(!empty($this->session->userdata('userPhoto'))){ ?>
      <img src="<?php echo base_url($this->session->userdata('userPhoto')); ?>" width="50" height="50" alt="User Photo" />
      <?php } else { ?><img src="<?php echo base_url(); ?>userphoto/userlogo.jpg" width="50" height="50" alt="User Image"/><?php } ?>
      
              <span class="d-none d-lg-inline"><?php if(!empty($this->session->userdata('userName'))){ echo $this->session->userdata('userName'); } ?></span>
            </a>
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