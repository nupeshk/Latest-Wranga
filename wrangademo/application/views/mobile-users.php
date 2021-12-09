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
.mainpdg{padding: 0 !important}
.mainsec{min-height: auto !important;}
</style>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

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
          <h1>User's Locations</h1> 

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30703620.672472216!2d64.41390989859407!3d20.050418843029927!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1594951865883!5m2!1sen!2sin" height="450" frameborder="0" style="border:0; width: 100%;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      
          </div>
      </div>
      <br><br>


<div class="row">
  <div class="mainsec mainpdg"> 
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body mainpdg">
        <h4 class="header-title mt-0 mb-1" style="padding-top: 20px;">Mobile Users</h4>
        <p class="sub-header"> </p>
        <div>
          <div>
            <div class="row">
               
             
            </div>
            <div class="row">
              <div class="col-sm-12">


        <table id="example" class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>name</th>
                <th>email</th>
                <th>gender</th>
                <th>phone</th>
                <th>longitude</th>
                <th>latitude</th>
                <th>deviceId</th>
            </tr>
        </thead>
        <tbody>
            		
            		<?php foreach ($users as $key => $users) {

            				/*echo "<pre>";
            				print_r($users);
            				echo "</pre>";*/

            			?>
            		


            <tr>
                <td><?=$users->name?></td>
                <td><?=$users->email?></td>
                <td><?=$users->gender?></td>
                <td><?=$users->phone?></td>
                <td><?=$users->longitude?></td>
                <td><?=$users->latitude?></td>
                <td><?=$users->deviceId?></td>
            </tr>
            <?php } ?>
              </tbody>
          <tfoot>   
          	<tr>
                <th>name</th>
                <th>email</th>
                <th>gender</th>
                <th>phone</th>
                <th>longitude</th>
                <th>latitude</th>
                <th>deviceId</th>
            </tr>
        </tfoot>
    </table>


      
              </div>
            </div>
           

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>



    </div>
  </div>
</div>


    
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

  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>





<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
          



</body>

</html>