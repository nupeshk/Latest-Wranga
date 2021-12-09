<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>::wranga::</title>
  <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url(); ?>fonts/materialdesignicons.min.css">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.png" />

<style> 
.gall{float: left;}
.castdel{font-size: 21px; color: #690088; float: left;}
.gall img{width: 100%; height: auto;}
.tab-content{padding: 0 !important;}
.nav-tabs{width: 100%;}
.tab-content{width: 100% !important;}
</style>

</head>
<body>

<div class="container-scroller">
<?php include('template/upload-new-otts.php'); ?>

<div class="container-fluid page-body-wrapper">
<div class="row row-offcanvas row-offcanvas-right">
  

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include('template/leftmenu.php'); ?>

<div class="content-wrapper">
  <div id="about" class="about-area area-padding">
    <div class="container">
      <div class="row">


<!-- ===========  Tabing =========-->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General Information</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  
<!-- tabingation 1 -->
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<form method="post" action="" enctype="multipart/form-data">  
<div class="card mb-1">
          
              <div class="card-body text-muted">

                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Plan Name</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" required="required" id="planName" value="<?=$content[0]->planName?>" name="planName">
                  </div>
                </div>
               
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Plan Amount</label>
                  <div class="col-lg-10">
                    <input type="text" id="basic-datepicker" class="form-control" required="required" placeholder="Plan Amount" name="planAmount" value="<?=$content[0]->planAmount?>">
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Plan Image</label>
                  <div class="col-lg-10">
                    <input type="file" id="basic-datepicker" class="form-control" name="planImage">
                  </div>
                </div>
                

                <div class="form-group row">
                  <label class="col-lg-2 col-form-label" for="simpleinput"></label>
                  <div class="col-lg-10">
                    <input type="submit" class="btn btn-primary" name="submitGeneral" value="Submit">
                  </div>
                </div>
              </div>
</div>
</form>
</div>
<!--  End -->

</div>
<!-- ===========  Tabing End  =========-->


  </div>
  <!-- end col --> 
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
    
        <?php include('template/footer.php'); ?>
      </div>
    </div>


  <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>js/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>js/perfect-scrollbar.jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>js/Chart.min.js"></script>
  <script src="<?php echo base_url(); ?>js/off-canvas.js"></script>
  <script src="<?php echo base_url(); ?>js/misc.js"></script>
  <script src="<?php echo base_url(); ?>js/dashboard.js"></script>
</body>

</html>