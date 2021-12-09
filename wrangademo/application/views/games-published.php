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
        <h5 class="modal-title" id="exampleModalLabel">Create New GAMES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form method="post" action="">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-4 col-form-label">Select Language</label>
          <div class="col-sm-8">
            <select id="inputState" name="languageId" class="form-control">
              <option value="" selected>--- Select GAMES Language --</option>
            <?php foreach ($wrng_language as $key => $wrng_language) {?>
                    <option value="<?=$wrng_language->lId?>"><?=$wrng_language->lName?></option>
              <?php } ?>  


            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-4 col-form-label">GAMES Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="inputPassword3" required="required" name="title" placeholder="GAMES Name">
          </div>
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-primary" value="Submit" name="Create">
      </div>

      </form>

    </div>
  </div>
</div>


          <div class="mainsec"> 

          <h1>
          <span style="float: left;">
            <div class="dropdown">
              <button class="dropbtn" style="padding-top: 0;">
                <i class="mdi mdi-filter" style="color:#C2C0C1;"></i> Filter 
                <i class="mdi mdi-chevron-down" style="color:#504E4F;"></i>
                <!--
                After active check box
                 <i class="mdi mdi-chevron-down" style="color: #6a0089;"></i> -->
              </button>
              <div class="dropdown-content">

            <form method="post" action="">    
              <?php 

             

              foreach ($contentStatus as $key => $contentStatus) {
                $checked = ""; 
             if(isset($_POST['apply'])){

             
              if(in_array($contentStatus->id,$_POST['apply'])){
                $checked = "checked";
              }
             } 

                ?>
                

                <p class="dropdown-item">
                  <input type="checkbox" value="<?=$contentStatus->id?>" <?=$checked?>    name="apply[]" > <?=$contentStatus->name?></p>


               <?php } ?> 
               <input class="btnsubmit" type="submit" value="Apply" name="applyFilter">
            </form>
               
              </div>
          </div>
          </span>
          <span style="float: right;"><a data-toggle="modal" data-target="#exampleModal">CREATE NEW GAMES</a></span>
          </h1> 

       
          <table class="table table-bordered table-striped table-hover dataTable js-exportable">
  <thead>
    <tr role="row">
      <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 115px;" aria-label="Image: activate to sort column ascending">Image</th>
      <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 126px;" aria-label="Name: activate to sort column ascending">Name</th>
      <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 123px;" aria-label="Content Type: activate to sort column ascending">rating</th>


      <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 85px;" aria-label="Platform: activate to sort column ascending">Publisher</th>

      <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 85px;" aria-label="Platform: activate to sort column ascending">Status</th>

      <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 139px;" aria-label="Published Date: activate to sort column ascending">Last update</th>
      <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 97px;" aria-label="Unpublish: activate to sort column ascending"><div align="center">Action</div></th>



    </tr>
  </thead>
  <tbody>

  <?php $sn=1;
  foreach ($content as $key => $content) {?>
    <tr role="row" class="odd" id="<?=$content->statusId?>">
      <td><img src="<?=base_url?>/assets/thumbnailImage/<?=$content->thumbnailImage?>"></td>
      <td><?=$content->title?></td>
      <td><?=$content->rating?> <i class="mdi mdi-star" style="color: #690088;"></i></td>
      
      <td><?=PublisherName($content->reviewerId)?></td>
      <td><?=$content->status?></td>
      <td><?php $old_date_timestamp = strtotime($content->createdat);
         echo  date('d M Y', $old_date_timestamp); ?>
        


      </td>
      <td>
        

        <a href="<?php echo base_url_index; ?>upload-new-games/<?=$content->contentId?>"><i class="mdi mdi-pencil unpbsh"></i></a>

        <a href="<?php echo base_url_index; ?>OttContent/deleteId/content/<?=$content->contentId?>/games-published" onclick="return confirm('Are you sure?');"><i class="mdi mdi-delete unpbsh"></i></a>

        <?php if($content->status=='Published'){?>
          <a href="#"><i class="mdi mdi-eye-outline unpbsh" style="color:green;"></i></a>
        <?php }else{ ?>
          <a href="#"><i class="mdi mdi-eye-off unpbsh"></i></a>
       <?php  } ?>
        
        

      </td>
    </tr>
 <?php $sn++; }?>

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