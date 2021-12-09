<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Games Language</title>
  <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url(); ?>fonts/materialdesignicons.min.css">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.png" />

  <style> 
.table th img, .table td img{border-radius: 0 !important; width: 100%; height:100px;}
.mdi-pencil{font-size: 20px !important;}
.mdi-delete{font-size: 20px !important;}
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td{line-height: 18px;}

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
      


<div class="mainsec"> 
<h1>Games Language
<span><a data-toggle="modal" data-target="#exampleModal" class="rightpop">New Games Language</a></span>
</h1> 


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Games Language</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form method="post" action="" enctype="multipart/form-data">

  <div class="form-group row">
          <div class="col-sm-12">
            <input type="text" name="name" class="form-control" placeholder="Enter Games Language Name">

            <input type="hidden" name="catgId" value="1">
            <input type="hidden" name="status" value="1">
            
            
          </div>
        </div>

        <div class="modal-footer">
          <input type="submit" name="submitCategories" class="btn btn-primary" value="Submit Games Language">
        </div>

        </form>

    </div>
  </div>
</div>
<!-- Modal -->


</div>

    
  <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top:40px;">
  <thead>
    <tr role="row">
      <th>S. No</th>
      <th>Category Name</th>
      <th>Created Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <td>1</td>
      <td>Rahul</td>
      <td>10-05-2020</td>
      <td><a href="#"><i class="mdi mdi-delete"></i></a></td>
    </tr>



<!-- Modal -->
</tbody>
</table>


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