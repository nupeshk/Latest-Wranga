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



.dropdown:hover .dropdown-content {
  display: block;
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
.otthd{float: left; color: #191643; font-size: 30px; margin: 3px 0 0 0;}
.commbtn{
    cursor: pointer;
    font-size: 14px;
    color: #fff !important;
    padding: 5px 15px;
    background-color: #6A0089;
    border: 2px #6A0089 solid;
    -webkit-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
    -moz-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
    box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
}

.commbtnn{
    cursor: pointer;
    font-size: 14px;
    color: #fff !important;
    padding: 5px 15px;
    background-color: #a4a2a5;
    border: 2px #a4a2a5 solid;
    -webkit-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
    -moz-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
    box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
}



.commbtnnn{
    cursor: pointer;
    font-size: 14px;
    color: #fff !important;
    padding: 5px 15px;
    background-color: #FFC0CB;
    border: 2px #FFC0CB solid;
    -webkit-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
    -moz-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
    box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
}

.published{
   color: #fff !important;
    background-color: green !important;
    border: none !important;
}



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

        


<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="<?php echo base_url(); ?>images/logo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url(); ?>"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
      
          


          <div class="col-md-6 otthd">

            <?php if(isset($content)){
               echo $content[0]->title;
            }else{
             echo "N/A";
            }

            ?>
            

          </div>


          <?php  if($content[0]->status==1){ ?>
<div class="col-md-6" style="margin-top: 19px;color: green;"><span style="float: right;color: green;">
  <a class="commbtnn published">Published</a></span></div>

<?php }elseif($content[0]->status==2){ ?>
<div class="col-md-6" style="margin-top: 19px;"><span style="float: right;background-color: #e4eaec;border: 2px #e2e7f1 solid;">
  <a href="<?=base_url_index?>AdvisoryContent/contentStatusActivate/1/<?=$id;?>" class="commbtn">Publish</a></span></div>

<?php }else{?>

<div class="col-md-6" style="margin-top: 19px;"><span style="float: right;background-color: #eee;border: 2px #eee solid;"><a class="commbtnn">Publish</a></span></div>

<?php } ?>

     
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
      </div>
    </nav>