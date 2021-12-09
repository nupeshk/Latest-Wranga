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
</style>

</head>
<body>
<div class="container-scroller">
<?php include('template/upload-new-app.php'); ?>

<div class="container-fluid page-body-wrapper">
<div class="row row-offcanvas row-offcanvas-right">

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
<ul class="nav">
  
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'app-published'; ?>">
    <span class="menu-title"><i class="mdi mdi-arrow-left"></i> Back to App</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'upload-new-app/'.$id; ?>">
    <span class="menu-title"><i class="mdi mdi-chevron-right"></i> General Infomation</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'app-rating/'.$id; ?>">
    <span class="menu-title"><i class="mdi mdi-chevron-right"></i> Rating</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'app-short-review/'.$id; ?>">
    <span class="menu-title"><i class="mdi mdi-chevron-right"></i> Short Review</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'app-tips-and-tricks/'.$id; ?>">
    <span class="menu-title"><i class="mdi mdi-chevron-right"></i> Tips and Tricks</span>
  </a>
</li>


</ul>
</nav>

<div class="content-wrapper">
  <div id="about" class="about-area area-padding">
    <div class="container">
      <div class="row">
      


<div class="mainsec"> 
<h1>Tips and Tricks
<span><a data-toggle="modal" data-target="#exampleModal" class="rightpop">New Tips &amp; tricks</a></span>
</h1> 


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New New Tips &amp; tricks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form method="post" action="" enctype="multipart/form-data">

  <div class="form-group row">
          <label for="inputPassword3" class="col-sm-4 col-form-label">Title</label>
          <div class="col-sm-8">
            <input type="text" name="title" class="form-control" placeholder="Title">
          </div>
        </div>
      <div class="form-group row">
          <label for="inputPassword3" class="col-sm-12 col-form-label">Description</label>
          <div class="col-sm-12">
            <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
                <textarea name="description" cols="" rows="10" placeholder="Type your page content" class="form-control"></textarea>
                <script>
                        CKEDITOR.replace( 'description' );
                </script>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-4 col-form-label">Upload Video Image</label>
          <div class="col-sm-8">
            <input name="videoThumbnailImage" type="file">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-4 col-form-label">Video Url</label>
          <div class="col-sm-8">
            <input type="text" name="videourl" class="form-control" placeholder="Video Url">
          </div>
        </div>

        <div class="modal-footer">
          <input type="submit" name="submit" class="btn btn-primary" value="Submit Tips & Tricks">
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
      <th>Image</th>
      <th>Title</th>
      <th>Description</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
<?php if(isset($wrng_tipslist)){
foreach ($wrng_tipslist as $wrng_tipslist) {?>

    <tr role="row" class="odd">
      <td><img src="<?=base_url()?>assets/photo/<?=$wrng_tipslist->videoThumbnailImage?>" width="50"></td>
      <td><?=$wrng_tipslist->title?> </td>
      <td><?=$wrng_tipslist->description?>  </td>
      <td><div class="unpbsh-box"><a href="<?=$wrng_tipslist->id?> "><i class="mdi mdi-pencil"></i></a></div></td>
     
     <td><div class="unpbsh-box"><a href="<?php echo base_url_index;?>AppContent/tipsDelete/wrng_tipsList/<?=$wrng_tipslist->id?>/app-tips-and-tricks/<?=$id?>"><i class="mdi mdi-delete"></i></a></div></td>

    </tr>

    <?php //echo base_url_index.'upload-new-otts/'.$id; ?>
    
    <?php } 
  }?>

  </tbody>
</table>


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