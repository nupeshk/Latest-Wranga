<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url(); ?>fonts/materialdesignicons.min.css">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.png" />

<style> 
.dropdown-content a:hover {
    background-color: #f1f1f1;
    color: #333 !important;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}

.mainsec span a {
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

.btnsubmit {
    cursor: pointer;
    font-size: 14px;
    color: #fff !important;
    width: 100%;
    padding: 5px 15px;
    background-color: #6A0089;
    border: 2px #6A0089 solid;
    -webkit-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
    -moz-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
    box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.61);
}

.dropdown-item {
    padding: 0 1.5rem !important;
    margin-top: 14px !important;
    margin-bottom: 15px !important;
    line-height: 0 !important;
}

.table th img, .table td img{border-radius: 0 !important;}
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Plan Benifits</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form method="post" action="">
       
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-4 col-form-label">benifitsTitle</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="inputPassword3" required="required" name="benifitsTitle" placeholder="benifitsTitle">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-4 col-form-label">Select paymentPlanId</label>
          <div class="col-sm-8">
            <select id="inputState" name="paymentPlanId" class="form-control">
              <option value="" selected>--- Select paymentPlanId --</option>
                  <?php foreach($wrng_paymentPlan as $plan){?>
                    <option value="<?=$plan->paymentPlanId?>"><?=$plan->planName?></option>
                  <?php } ?>  
            </select>
          </div>
        </div>
       
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-4 col-form-label">Select Status</label>
          <div class="col-sm-8">
            <select id="inputState" name="status" class="form-control">
              <option value="" selected>--- Select Status --</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
            </select>
          </div>
        </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-primary" value="Submit" name="submitBenifits">
      </div>
      </form>
    </div>
  </div>
</div>

          <div class="mainsec"> 
          <h1>
          <span style="float: right;"><a data-toggle="modal" data-target="#exampleModal">CREATE NEW Plan Benifits</a></span>
          </h1> 

       
          <table class="table table-bordered table-striped table-hover dataTable js-exportable">
  <thead>
    <tr role="row">
      <th class="sorting" rowspan="1" colspan="1" style="width: 115px;">benifitsTitle</th>
      <th class="sorting" rowspan="1" colspan="1" style="width: 126px;">paymentPlanId</th>
      <th class="sorting" rowspan="1" colspan="1" style="width: 123px;">status</th>
      <th class="sorting" rowspan="1" colspan="1" style="width: 139px;">createdat</th>
      <th class="sorting" rowspan="1" colspan="1" style="width: 97px;"><div align="center">Action</div></th>
    </tr>
  </thead>
  <tbody>

<?php foreach ($wrng_planBenifits as $key => $benifits) {?>
    <tr>
      <tr>
      <td><?=$benifits->benifitsTitle?></td>
      <td><?=paymentPlanTitle($benifits->paymentPlanId)?></td>
      <td><?php if($benifits->status==1){echo "Active";}else{echo "Inactive";}?></td>
      <td><?=$benifits->createdat?></td>
      <td>
        <a data-toggle="modal" data-target="#exampleModal<?=$benifits->benifitsId?>"><i class="mdi mdi-pencil unpbsh"></i></a>     
        <a href="http://localhost/WrangaWeb/wrangademo/index.php/OttContent/deleteIdALl/wrng_planBenifits/<?=$benifits->benifitsId?>/planBenifits" onclick="return confirm('Are you sure?');"><i class="mdi mdi-delete unpbsh"></i></a>
      
    
      </td>
    </tr>
    </tr>



    <!-- Modal -->
<div class="modal fade" id="exampleModal<?=$benifits->benifitsId?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Plan Benifits</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form method="post" action="<?=base_url_index.'updateBenifits'?>">

          <input type="hidden"  name="benifitsId" value="<?=$benifits->benifitsId?>">
       
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-4 col-form-label">benifitsTitle</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="inputPassword3" required="required" name="benifitsTitle" placeholder="benifitsTitle" value="<?=$benifits->benifitsTitle?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-4 col-form-label">Select paymentPlanId</label>
          <div class="col-sm-8">
            <select id="inputState" name="paymentPlanId" class="form-control">
              <option value="" selected>--- Select paymentPlanId --</option>
                  <?php foreach($wrng_paymentPlan as $plan){?>
                    <option <?php if($benifits->paymentPlanId==$plan->paymentPlanId){ echo "selected";}?> value="<?=$plan->paymentPlanId?>"><?=$plan->planName?></option>
                  <?php } ?>  
            </select>
          </div>
        </div>
       
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-4 col-form-label">Select Status</label>
          <div class="col-sm-8">
            <select id="inputState" name="status" class="form-control">
              <option value="" selected>--- Select Status --</option>
                    <option <?php if($benifits->status==1){ echo "selected";}?> value="1">Active</option>
                    <option <?php if($benifits->status==0){ echo "selected";}?> value="0">Inactive</option>
            </select>
          </div>
        </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-primary" value="Submit" name="submitBenifits">
      </div>
      </form>
    </div>
  </div>
</div>
  <?php } ?>

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