<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Push Notification</title>
  <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url(); ?>fonts/materialdesignicons.min.css">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.png" />

  <style> 
.table th img, .table td img{border-radius: 0 !important; width: 100%; height:100px;}
.mdi-pencil{font-size: 20px !important;}
.mdi-delete{font-size: 20px !important;}
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td{line-height: 18px;}
.pushleft{float: left;}
.rightpop{
    cursor: pointer;
    font-size: 14px;
    float: right;
    color: #fff !important;
    padding: 5px 15px;
    background-color: #6A0089;
    border: 2px #6A0089 solid;
    -webkit-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
    -moz-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
    box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
}

.mdi-pencil{color: #6a0089 !important;}
.mdi-delete{color: #6a0089 !important;}
</style>


</head>
<body>
<div class="container-scroller">
<?php include('template/topbar.php'); ?>

<div class="container-fluid page-body-wrapper">
<div class="row row-offcanvas row-offcanvas-right">

<?php include('template/leftmenu.php'); ?>

<div class="content-wrapper">


<div id="about" class="about-area area-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top:3%;">
        <div class="single-services" style="background:#fff;border: 0 none;border-radius: 3px;box-shadow: 0 17px 41px -21px rgb(0, 0, 0);padding-top: 20px;border-top: 9px solid #7CCDDE;box-sizing: border-box;">
          <div class="container" style="width: 100%;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline services-head text-center">
                  <style>
.section-headline h2::after {
  border:0px;
}
.pushsubmit{
  background: #191643;
  color: #fff !important;
}
</style>
                  <h2>Push Notification
                    <hr style="border: 1px solid #333;background:black; width:40%;">
                  </h2>

                </div>
              </div>
            </div>
            <div class="row text-center">
              <div class="services-contents" style="width: 100%;">
                <br><br>
                <div class="row text-center" style="width: 100%;">
                  <div class="services-contents" style="margin-left: 2%;width: 100%;">
                    <!-- Start Left services -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div style="width:100%;">
                      <form method="post" action="" enctype="multipart/form-data">
                         
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Reciever</label>
                          <div class="col-sm-6">
                            <select class="form-control pushleft" name="userId">
                              <option value="0">All Reciever</option>
                              <?php foreach ($user as $key => $user) { ?>
                             
                              <option value="<?= $user->email?>"><?= $user->name?></option>
                               <?php } ?>
                            </select>
                          </div>
                        </div>



                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Title</label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control pushleft" id="inputPassword3" required="required" name="title" placeholder="Title">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Message</label>
                          <div class="col-sm-6">
                            <textarea type="text" class="form-control pushleft" id="inputPassword3" required="required" name="body" placeholder="Message"></textarea>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Upload Image</label>
                          <div class="col-sm-6">
                            <input name="image" type="file" class="pushleft">
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-sm-4"></div>
                          <div class="col-sm-2">
                            <input name="submit" class="form-control pushsubmit" type="submit">
                          </div>
                        </div>


                      </div>
                      <br>
                    </div>

          </form> 
                             
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- #primary -->
        </div>
        <!-- #main .wrapper -->
      </div>
      <!-- #page -->
    </div>
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