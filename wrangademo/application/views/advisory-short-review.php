t<?php
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
</style>

</head>
<body>
<div class="container-scroller">
<?php include('template/upload-new-book.php'); ?>

<div class="container-fluid page-body-wrapper">
<div class="row row-offcanvas row-offcanvas-right">

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
<ul class="nav">
  
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'advisory-published'; ?>">
    <span class="menu-title"><i class="mdi mdi-arrow-left"></i> Back to Advisory</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'advisory-upload-new-otts/'.$id; ?>">
    <span class="menu-title"><i class="mdi mdi-chevron-right"></i> General Infomation</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'advisory-rating/'.$id; ?>">
    <span class="menu-title"><i class="mdi mdi-chevron-right"></i> Rating</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'advisory-short-review/'.$id; ?>">
    <span class="menu-title"><i class="mdi mdi-chevron-right"></i> Short Review</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'advisory-tips-and-tricks/'.$id; ?>">
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
<h1>Short review of the show</h1> 


<form method="post" action="">
  <div class="form-group row">
      <div class="col-sm-12">



          <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
              <textarea name="description" cols="" rows="30" placeholder="Description" class="form-control"><?=$wrng_shortreview[0]->description?></textarea>
              <script type="text/javascript">
              CKEDITOR.replace( 'review' );
              CKEDITOR.add            
           </script>
      </div>
  </div>
  <div class="form-group row" style="margin-bottom: 40px;">
      <div class="col-sm-12"><input type="submit" name="submit" class="btn btn-primary" value="Submit"></div>
  </div>

</form>




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