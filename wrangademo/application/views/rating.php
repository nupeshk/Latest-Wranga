<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$id=$this->uri->segment(2);


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
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 28px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 15px;
    width: 15px;
    left: 10px;
    bottom: 6px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.nav-tabs {
    padding-left: 59px !important;
}

.nav-tabs li a.active {
    border-bottom: 2px solid #5369f8!important;
    -webkit-border-radius: 360px;
    -moz-border-radius: 360px;
    border-radius: 360px;
}

.nav-pills>li>a, .nav-tabs>li>a {
    font-size: 16px !important;
    padding: 10px 16px !important;
}

.nav-pills>li>a, .nav-tabs>li>a {
    font-weight: normal !important;
}

.card .card-body {
   padding: 20px 0px !important;
}

.card{margin-bottom: 0 !important;}
.content-wrapper{padding-top: 0 !important;}
.ratsec{margin: 20px 0;}
</style>


<script>
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("text");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>


</head>
<body>
<div class="container-scroller">
<?php include('template/upload-new-otts.php'); ?>

<div class="container-fluid page-body-wrapper">
<div class="row row-offcanvas row-offcanvas-right">

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
<ul class="nav">
  
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'published-otts'; ?>">
    <span class="menu-title"><i class="mdi mdi-arrow-left"></i> Back To OTT</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'upload-new-otts/'.$id; ?>">
    <span class="menu-title"><i class="mdi mdi-chevron-right"></i> General Infomation</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'rating/'.$id; ?>">
    <span class="menu-title"><i class="mdi mdi-chevron-right"></i> Rating</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'short-review/'.$id; ?>">
    <span class="menu-title"><i class="mdi mdi-chevron-right"></i> Short Review</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'tips-and-tricks/'.$id; ?>">
    <span class="menu-title"><i class="mdi mdi-chevron-right"></i> Tips and Tricks</span>
  </a>
</li>


</ul>
</nav>

<div class="content-wrapper">
  <div id="about" class="about-area area-padding">
    <div class="container">


<!-- 0 row -->
<div class="row">
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body ptb64">


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ratsec">
        <h4 class="header-title mt-0 mb-1 topcont" style="font-size: 22px;">Content Rating 
          <span>
            <?=$content[0]->rating?>
            <i class="mdi mdi-star"></i>
            <!-- <i class="mdi mdi-star"></i>
            <i class="mdi mdi-star"></i>
            <i class="mdi mdi-star-outline"></i>
            <i class="mdi mdi-star-outline"></i> -->
          </span>
          </h4>
         </div>

         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ratsec">
            <h4 class="header-title mt-0 mb-1 topcont" style="font-size: 22px;">Allowed Age 
              <span><?=$content[0]->age?> +</span>
            </h4>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ratsec">
            <h4 class="header-title mt-0 mb-1 topcont" style="font-size: 22px;">

             PG Status<br>
             <?php if($content[0]->pgStatus==1){?>
               <a href="<?=base_url_index?>OttContent/pgStatusActivate/0/<?=$id?>"> Active</a>
             <?php }else{?>
               <a href="<?=base_url_index?>OttContent/pgStatusActivate/1/<?=$id?>"> Inactive</a>
             <?php }?>
          
          




            </h4>
          </div>

      </div>
    </div>
  </div>




  <div class="col-lg-9">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <div class="table-responsive">


<!-- 0 row -->
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <div class="table-responsive">


<!-- Chat Bar -->
<script type="text/javascript">
window.onload = function () {

    CanvasJS.addColorSet("greenShades",
                [//colorSet Array
                "<?=wrng_ratingCalCategoryColor(1)?>",
                "<?=wrng_ratingCalCategoryColor(2)?>",
                "<?=wrng_ratingCalCategoryColor(3)?>",
                "<?=wrng_ratingCalCategoryColor(4)?>",
                 "<?=wrng_ratingCalCategoryColor(5)?>",
                 "<?=wrng_ratingCalCategoryColor(6)?>",
                "<?=wrng_ratingCalCategoryColor(7)?>",
                "<?=wrng_ratingCalCategoryColor(8)?>",
                "<?=wrng_ratingCalCategoryColor(9)?>",
                "<?=wrng_ratingCalCategoryColor(10)?>"                
                ]);
var chart = new CanvasJS.Chart("chartContainer", {
  //theme: "light1", // "light2", "dark1", "dark2"
  animationEnabled: true, // change to true    
   colorSet: "greenShades",
  title:{ 
    text: "CATEGORY RATING"
  },
 axisY: [
  {
    title: "RATING",
     maximum: 5,
  }
],
axisX: [
  {
    title: "CATEGORY",
  }
],
  data: [
  {
    type: "column",
      dataPoints: [
      { label: "Postive MSG",  y: <?php echo $positiveRating ? $positiveRating[0]->ratning : 0 ?>  },
      { label: "Education values", y:  <?php echo $educationRating ? $educationRating[0]->ratning : 0 ?> },
      { label: "Consumerism",  y: <?php echo $consumerismRatingValue ? $consumerismRatingValue[0]->ratning : 0 ?>  },
      { label: "Violence", y:   <?php echo $violenceRating ? $violenceRating[0]->ratning : 0 ?>},
      { label: "Sex and Nudity",  y: <?php echo $sexRating ? $sexRating[0]->ratning : 0 ?>  },
      { label: "Abusive language",  y: <?php echo $abusiveRatingValue ? $abusiveRatingValue[0]->ratning : 0 ?>  },
      { label: "Child Abuse",  y: <?php echo $childRating ? $childRating[0]->ratning : 0 ?>  },
      { label: "Drinking, Drugs, Smoking",  y: <?php echo $drinkingRating ? $drinkingRating[0]->ratning : 0 ?>  },
      { label: "Stereotype",  y: <?php echo $stereotypeRating ? $stereotypeRating[0]->ratning : 0 ?>  },
      { label: "Sexism",  y: <?php echo $sexismRating ? $sexismRating[0]->ratning : 0 ?>  },
    ]
  }
  ]
});
chart.render();
  
}
</script> 



<div class="fullbox">
<div class="col-md-12 chart" id="chartContainer" style="height: 300px; padding: 0; width: 100%; margin: 0 auto; overflow: hidden;"></div>
<div class="whiteolap"></div>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
<!-- End Chat Bar -->


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- 0 row end -->


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- 0 row end -->





<section>
  <div class="app-sec" style="margin-top: 60px;">
    <div class="container">
      <div class="row">
        <div class="wrapper">
          <div class="container">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">

              <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">

                <li role="presentation" class="active"> <a href="#positive" id="positive-tab" role="tab" data-toggle="tab" aria-controls="positive" aria-expanded="true"> <span class="text">Positive Messages</span> </a> </li>

                <li role="presentation" class="next"> <a href="#educational" role="tab" id="educational-tab" data-toggle="tab" aria-controls="educational"> <span class="text">Educational Values</span> </a> </li>

                <li role="presentation"> <a href="#consumerism" role="tab" id="consumerism-tab" data-toggle="tab" aria-controls="consumerism"> <span class="text">Consumerism</span> </a> </li>

                <li role="presentation"> <a href="#violence" role="tab" id="violence-tab" data-toggle="tab" aria-controls="violence"> <span class="text">Violence</span> </a> </li>

                <li role="presentation"> <a href="#sex" role="tab" id="sex-tab" data-toggle="tab" aria-controls="sex"> <span class="text">Sex & Nudity</span> </a> </li>

                <li role="presentation"> <a href="#abusive" role="tab" id="abusive-tab" data-toggle="tab" aria-controls="abusive"> <span class="text">Abusive Language</span> </a> </li>

                <li role="presentation"> <a href="#child" role="tab" id="child-tab" data-toggle="tab" aria-controls="child"> <span class="text">Child Abuse</span> </a> </li>

                <li role="presentation"> <a href="#drinking" role="tab" id="drinking-tab" data-toggle="tab" aria-controls="drinking"> <span class="text">Drinking, Drugs, Smoking</span> </a> </li>

                <li role="presentation"> <a href="#stereotype" role="tab" id="stereotype-tab" data-toggle="tab" aria-controls="stereotype"> <span class="text">Stereotype</span> </a> </li>

                <li role="presentation"> <a href="#sexism" role="tab" id="sexism-tab" data-toggle="tab" aria-controls="sexism"> <span class="text">Sexism</span> </a> </li>

                <li role="presentation"> <a href="#prohibitive" role="tab" id="prohibitive-tab" data-toggle="tab" aria-controls="prohibitive"> <span class="text">Prohibitive</span> </a> </li>
                
              </ul>

              <div id="myTabContent" class="tab-content">


                <div role="tabpanel" class="tab-pane fade in active" id="positive" aria-labelledby="positive-tab">
                  <!-- 1 row -->      
<form method="post" action="">
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Positive Messages  


          <br><br></h4>
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td> 
                <td>Nation Building</td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      <select class="form-control custom-select" name="nationBuilding">
                        <option value="1" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,1)==1){ echo "selected";}?>>Non Thematic</option>
                        <option value="3" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,1)==3){ echo "selected";}?>>Thematic</option>
                        <option value="0" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,1)==0){ echo "selected";}?> >Not Present</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Social Harmony</td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      <select class="form-control custom-select" name="socialHarmony">
                        <option value="1" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,2)==1){ echo "selected";}?>>Non Thematic</option>
                        <option value="3" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,2)==3){ echo "selected";}?>>Thematic</option>
                        <option value="0" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,2)==0){ echo "selected";}?>>Not Present</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Family Values</td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      <select class="form-control custom-select" name="familyValues">
                         <option value="1" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,3)==1){ echo "selected";}?>>Non Thematic</option>
                        <option value="3" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,3)==3){ echo "selected";}?>>Thematic</option>
                        <option value="0" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,3)==0){ echo "selected";}?>>Not Present</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
               <tr>
                <td></td> 
                <td>Motivation</td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      <select class="form-control custom-select"  name="motivation">
                        <option value="1" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,4)==1){ echo "selected";}?>>Non Thematic</option>
                        <option value="3" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,4)==3){ echo "selected";}?>>Thematic</option>
                        <option value="0" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,1,4)==0){ echo "selected";}?>>Not Present</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Positive Messages<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Positive Messages in the show (25-50 words)
" class="form-control ckeditor"><?=descMoralbord($id,1)?></textarea>
             
              <input name="positiveMessages" type="submit" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<!-- 1 row end --> 
                </div>


                <div role="tabpanel" class="tab-pane fade" id="educational" aria-labelledby="educational-tab">
                  <!-- Educational Values row -->      
<form method="post" action="">
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Educational Values<br><br></h4>
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td> 
                <td>Informative</td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      <select class="form-control custom-select" name="informative">
<option value="1" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,5)==1){ echo "selected";}?>>Non Thematic</option>
<option value="3" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,5)==3){ echo "selected";}?>>Thematic</option>
<option value="0" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,5)==0){ echo "selected";}?>>Not Present</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Logical Thinking</td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      <select class="form-control custom-select" name="logicalThinking">
<option value="1" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,6)==1){ echo "selected";}?>>Non Thematic</option>
<option value="3" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,6)==3){ echo "selected";}?>>Thematic</option>
<option value="0" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,6)==0){ echo "selected";}?>>Not Present</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Skills (advanced learning, DIY, etc.)</td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      <select class="form-control custom-select" name="skills">
<option value="1" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,7)==1){ echo "selected";}?>>Non Thematic</option>
<option value="3" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,7)==3){ echo "selected";}?>>Thematic</option>
<option value="0" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,7)==0){ echo "selected";}?>>Not Present</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
               <tr>
                <td></td> 
                <td>Health and Fitness</td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      <select class="form-control custom-select" name="healthFitness">
<option value="1" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,8)==1){ echo "selected";}?>>Non Thematic</option>
<option value="3" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,8)==3){ echo "selected";}?>>Thematic</option>
<option value="0" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,8)==0){ echo "selected";}?>>Not Present</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Gender Sensitisation</td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      <select class="form-control custom-select" name="genderSensitisation">
<option value="1" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,9)==1){ echo "selected";}?>>Non Thematic</option>
<option value="3" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,9)==3){ echo "selected";}?>>Thematic</option>
<option value="0" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,2,9)==0){ echo "selected";}?>>Not Present</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>

            </tbody>
          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Educational Values<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Educational Values in the show (25-50 words)
" class="form-control ckeditor"><?=descMoralbord($id,2)?></textarea>
              <input name="educationalValues"  type="submit" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<!-- Educational Values row end --> 
                </div>


                <div role="tabpanel" class="tab-pane fade" id="consumerism" aria-labelledby="consumerism-tab">
                  <!-- Consumerism Values row -->   
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Consumerism<br><br></h4>
        <div class="table-responsive">
    
    <form method="post" action="">     

          <table class="table m-0">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td> 
                <td>Select Range</td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      
                    <select class="form-control" name="consumerismRange">
<option value="1" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,3,37)==1){ echo "selected";}?>>Non Thematic</option>
<option value="3" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,3,37)==3){ echo "selected";}?>>Thematic</option>
<option value="0" <?php if(valueAllAtributs('wrng_contentthematicrating',$id,3,37)==0){ echo "selected";}?>>Not Present</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Consumerism<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Consumerism in the show (25-50 words)
" class="form-control ckeditor"><?=descMoralbord($id,3)?></textarea>
              <input type="submit" name="consumerismValues" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>


    </div>
  </div>
</div>
<!-- Consumerism row end --> 
                </div>


                <div role="tabpanel" class="tab-pane fade" id="violence" aria-labelledby="violence-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Violence</h4>
        <div class="table-responsive">
      <form method="post" action="">    
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
                <th>Occurance</th>
                <th>Time Stamp</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Bullying</td>  
                <td>Mild</td>
                <td><input name="mild1" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,4,10)?>"></td> 
                <td><input name="mildTimeStamp1" value="<?=mildTime('wrng_contentoccurrencerating',$id,4,10)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme1" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,4,10)?>"></td> 
                <td><input name="extremeTimeStamp1" value="<?=extremeTime('wrng_contentoccurrencerating',$id,4,10)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td> 
              </tr>
              </tbody>


              <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Physical </td>  
                <td>Mild</td>
                <td><input name="mild2" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,4,11)?>"></td> 
               <td><input name="mildTimeStamp2" value="<?=mildTime('wrng_contentoccurrencerating',$id,4,11)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme2" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,4,11)?>"></td> 
                <td><input name="extremeTimeStamp2" value="<?=extremeTime('wrng_contentoccurrencerating',$id,4,11)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>
              </tr>
              <br>
            </tbody>

            <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Killing </td>  
                <td>Mild</td>
                <td><input name="mild3" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,4,12)?>" ></td> 
                <td><input name="mildTimeStamp3" value="<?=mildTime('wrng_contentoccurrencerating',$id,4,12)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>



              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme3" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,4,12)?>"></td> 
                <td><input name="extremeTimeStamp3" value="<?=extremeTime('wrng_contentoccurrencerating',$id,4,12)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td> 
              </tr>
              <br>
            </tbody>


            <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Horrific Visuals </td>  
                <td>Mild</td>
                <td><input name="mild4" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,4,13)?>"></td> 
               <td><input name="mildTimeStamp4" value="<?=mildTime('wrng_contentoccurrencerating',$id,4,13)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 

              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme4" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,4,13)?>"></td> 
                <td><input name="extremeTimeStamp4" value="<?=extremeTime('wrng_contentoccurrencerating',$id,4,13)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>
              </tr>
              <br>
            </tbody>

            <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Self Harm</td>  
                <td>Mild</td>
                <td><input name="mild5" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,4,14)?>" ></td> 
                <td><input name="mildTimeStamp5" value="<?=mildTime('wrng_contentoccurrencerating',$id,4,14)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme5" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,4,14)?>"></td> 
                <td><input name="extremeTimeStamp5" value="<?=extremeTime('wrng_contentoccurrencerating',$id,4,14)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td> 
              </tr>
              <br>
            </tbody>

            <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Domestic Violence</td>  
                <td>Mild</td>
                <td><input name="mild6" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,4,15)?>"></td> 
                <td><input name="mildTimeStamp6" value="<?=mildTime('wrng_contentoccurrencerating',$id,4,15)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme6" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,4,15)?>" ></td> 
                <td><input name="extremeTimeStamp6" value="<?=extremeTime('wrng_contentoccurrencerating',$id,4,15)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>
              </tr>
              <br>
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Violence<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Violent content in the show 25-50 words
" class="form-control ckeditor"><?=descMoralbord($id,4)?></textarea>
          <input type="submit" name="submitViolence" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
  </form>
    </div>
  </div>
</div>
<!--  row end -->
                </div>


                <div role="tabpanel" class="tab-pane fade" id="sex" aria-labelledby="sex-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Sex & Nudity<br><br></h4>
        <div class="table-responsive">
      <form method="post" action="">
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
                <th>Occurance</th>
                <th>Time Stamp</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Sex</td>  
                <td>Mild</td>
                <td><input name="mild1" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,5,16)?>"></td> 
                <td><input name="mildTimeStamp1" value="<?=mildTime('wrng_contentoccurrencerating',$id,5,16)?>" placeholder="TimeStamp" type="number" class="mildbdr"></td>
              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme1" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,5,16)?>"></td> 
                <td><input name="extremeTimeStamp1" value="<?=extremeTime('wrng_contentoccurrencerating',$id,5,16)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td> 
              </tr>
              </tbody>
          
              <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Nudity</td>  
                <td>Mild</td>
                <td><input name="mild2" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,5,34)?>"></td> 
                <td><input name="mildTimeStamp2" value="<?=mildTime('wrng_contentoccurrencerating',$id,5,34)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme2" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,5,34)?>"></td> 
                <td><input name="extremeTimeStamp2" value="<?=extremeTime('wrng_contentoccurrencerating',$id,5,34)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>
              </tr>
              <br>
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Sex & Nudity<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Sex & Nudity in the show 25-50 words
" class="form-control ckeditor"><?=descMoralbord($id,5)?></textarea>
              
              <input type="submit" name="sexNudity" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>
    </div>
  </div>
</div>
<!--  row end -->
                </div>


                <div role="tabpanel" class="tab-pane fade" id="abusive" aria-labelledby="abusive-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Abusive Language<br><br></h4>
        <div class="table-responsive">
          <form method="post" action="">
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
                <th>Occurance</th>
                <th>Time Stamp</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Select Occurance </td>  
                <td>Mild</td>
                <td><input name="mild" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,6,20)?>"></td> 
                <td><input name="mildTimeStamp" value="<?=mildTime('wrng_contentoccurrencerating',$id,6,20)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,6,20)?>"></td> 
                <td><input name="extremeTimeStamp" value="<?=extremeTime('wrng_contentoccurrencerating',$id,6,20)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td> 
              </tr>
              </tbody>

          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Abusive Language<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of use of Abusive Language in the show 25-50 words" class="form-control ckeditor"><?=descMoralbord($id,6)?></textarea>
             
          <input type="submit" name="abusiveLanguage" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>
    </div>
  </div>
</div>
<!--  row end -->
                </div>


                <div role="tabpanel" class="tab-pane fade" id="child" aria-labelledby="child-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Child Abuse<br><br></h4>
        <div class="table-responsive">
          <form method="post" action="">
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
                <th>Occurance</th>
                <th>Time Stamp</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Select Occurance </td>  
                <td>Mild</td>
                <td><input name="mild" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,7,21)?>"></td> 
                <td><input name="mildTimeStamp" value="<?=mildTime('wrng_contentoccurrencerating',$id,7,21)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,7,21)?>"></td> 
                <td><input name="extremeTimeStamp" value="<?=extremeTime('wrng_contentoccurrencerating',$id,7,21)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td> 
              </tr>
              </tbody>

          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Child Abuse<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Child Abuse in the show 25-50 words
" class="form-control ckeditor"><?=descMoralbord($id,7)?></textarea>
              <input name="childAbuse" type="submit" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>
    </div>
  </div>
</div>
<!--  row end -->
                </div>


                <div role="tabpanel" class="tab-pane fade" id="drinking" aria-labelledby="drinking-tab">
                 <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Drinking, Drugs, Smoking<br><br></h4>
        <div class="table-responsive">
     <form method="post" action="">     
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
                <th>Occurance</th>
                <th>Time Stamp</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Select Occurance </td>  
                <td>Mild</td>
                <td><input name="mild" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,8,22)?>"></td> 
                <td><input name="mildTimeStamp" value="<?=mildTime('wrng_contentoccurrencerating',$id,8,22)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,8,22)?>"></td> 
                <td><input name="extremeTimeStamp" value="<?=extremeTime('wrng_contentoccurrencerating',$id,8,22)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td> 
              </tr>
              </tbody>

          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Drinking, Drugs, Smoking<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Drinking Drugs & Smoking in the show 25-50 words" class="form-control ckeditor"><?=descMoralbord($id,8)?></textarea>
             
          <input type="submit" name="submitDrinking" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>
    </div>
  </div>
</div>
<!--  row end -->
                </div>




                <div role="tabpanel" class="tab-pane fade" id="stereotype" aria-labelledby="stereotype-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Stereotype <br><br></h4>
        <div class="table-responsive">
    <form method="post" action="">      
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
                <th>Occurance</th>
                <th>Time Stamp</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Ageism, Body shaming, etc.</td>  
                <td>Mild</td>
                <td><input name="mild" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,9,18)?>"></td> 
                <td><input name="mildTimeStamp" value="<?=mildTime('wrng_contentoccurrencerating',$id,9,18)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme" type="text" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,9,18)?>"></td> 
                <td><input name="extremeTimeStamp" value="<?=extremeTime('wrng_contentoccurrencerating',$id,9,18)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>  
              </tr>
              </tbody>
          </table>
        </div>
      </div>   

 <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Stereotype <br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Stereotype and Sexism in the show 25-50 words" class="form-control ckeditor"><?=descMoralbord($id,9)?></textarea>
               <input type="submit" name="submitStereotype" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>
    </div>
  </div>
</div>
<!--  row end -->
                </div>




                <div role="tabpanel" class="tab-pane fade" id="sexism" aria-labelledby="sexism-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Sexism <br><br></h4>
        <div class="table-responsive">
      <form method="post" action="">    
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
                <th>Occurance</th>
                <th>Time Stamp</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td></td> 
                <td rowspan="2" style="vertical-align: middle !important;">Objectification, Sexual Harassment, Rape Threat, etc.</td>  
                <td>Mild</td>
                <td><input name="mild" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceMild('wrng_contentoccurrencerating',$id,10,19)?>"></td> 
                <td><input name="mildTimeStamp" value="<?=mildTime('wrng_contentoccurrencerating',$id,10,19)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>
              <tr>
                <td></td> 
                <td>Extreme</td>
                <td><input name="extreme" type="number" class="mildbdr" value="<?=valueAllAtributsOccurrenceExtreme('wrng_contentoccurrencerating',$id,10,19)?>"></td> 
                <td><input name="mildTimeStamp" value="<?=mildTime('wrng_contentoccurrencerating',$id,10,19)?>" placeholder="TimeStamp" type="text" class="mildbdr"></td> 
              </tr>
              </tbody>

          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Sexism <br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Stereotype and Sexism in the show 25-50 words" class="form-control ckeditor"><?=descMoralbord($id,10)?></textarea>
              <input type="submit" name="submitSexism" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>
    </div>
  </div>
</div>
<!--  row end -->
                </div>




                <div role="tabpanel" class="tab-pane fade" id="prohibitive" aria-labelledby="prohibitive-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Prohibitive <br><br></h4>
        <div class="table-responsive">
<form method="post" action="">      
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
                <th>Time Stamp</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td></td> 
                <td>Suicide</td>  
                <td>
                  <input type="radio" name="suicide" value="1" <?php if(prohibitiveValue($id,11,38)==1){ echo "checked";}?>> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="suicide" value="0" <?php if(prohibitiveValue($id,11,38)==0){ echo "checked";}?>> No 
                </td> 
                <td><input name="timeStamp1" value="<?=prohobitive($id,11,38)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>
              </tr>

              <tr>
                <td></td> 
                <td>Hardcore Sex</td>  
                <td>
                  <input type="radio" name="hardcoreSex" value="1" <?php if(prohibitiveValue($id,11,39)==1){ echo "checked";}?>> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="hardcoreSex" value="0" <?php if(prohibitiveValue($id,11,39)==0){ echo "checked";}?>> No 
                </td> 
                <td><input name="timeStamp2" value="<?=prohobitive($id,11,39)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>
              </tr>

              <tr>
                <td></td> 
                <td>Paedophilia</td>  
                <td>
                  <input type="radio" name="paedophilia" value="1" <?php if(prohibitiveValue($id,11,40)==1){ echo "checked";}?>> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="paedophilia" value="0" <?php if(prohibitiveValue($id,11,40)==0){ echo "checked";}?>> No 
                </td> 
                <td><input name="timeStamp3" value="<?=prohobitive($id,11,40)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>
              </tr>

              <tr>
                <td></td> 
                <td>Excessive Drinking, Drugs & Smoking including its glorification</td>  
                <td>
                  <input type="radio" name="excessiveDrinking" value="1" <?php if(prohibitiveValue($id,11,41)==1){ echo "checked";}?>> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="excessiveDrinking" value="0" <?php if(prohibitiveValue($id,11,41)==0){ echo "checked";}?>> No 
                </td> 
                <td><input name="timeStamp4" value="<?=prohobitive($id,11,41)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>
              </tr>

              <tr>
                <td></td> 
                <td>Rape Threat/ Rape</td>  
                <td>
                  <input type="radio" name="rape" value="1" <?php if(prohibitiveValue($id,11,42)==1){ echo "checked";}?>> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="rape" value="0" <?php if(prohibitiveValue($id,11,42)==0){ echo "checked";}?>> No 
                </td> 
                <td><input name="timeStamp5" value="<?=prohobitive($id,11,42)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>
              </tr>

              <tr>
                <td></td> 
                <td>Promotes Terrorism and/ or Violence against the State</td>  
                <td>
                  <input type="radio" name="promotes" value="1" <?php if(prohibitiveValue($id,11,43)==1){ echo "checked";}?>> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="promotes" value="0" <?php if(prohibitiveValue($id,11,43)==0){ echo "checked";}?>> No 
                </td> 
                <td><input name="timeStamp6" value="<?=prohobitive($id,11,43)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td> 
              </tr>

              <tr>
                <td></td> 
                <td>Banned Content by the Law/ Court</td>  
                <td>
                  <input type="radio" name="banned" value="1" <?php if(prohibitiveValue($id,11,44)==1){ echo "checked";}?>> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="banned" value="0" <?php if(prohibitiveValue($id,11,44)==0){ echo "checked";}?>> No 
                </td> 
                <td><input name="timeStamp7" value="<?=prohobitive($id,11,44)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>
              </tr>

              <tr>
                <td></td> 
                <td>Disrespect to Nation & its symbol</td>  
                <td>
                  <input type="radio" name="disrespect" value="1" <?php if(prohibitiveValue($id,11,45)==1){ echo "checked";}?>> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="disrespect" value="0" <?php if(prohibitiveValue($id,11,45)==0){ echo "checked";}?>> No 
                </td> 
               <td><input name="timeStamp8" value="<?=prohobitive($id,11,45)?>" placeholder="Time Stamp" type="text" class="mildbdr"></td>
              </tr>
              </tbody>

          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Prohibitive <br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Prohibitive in the show 25-50 words" class="form-control ckeditor"><?=descMoralbord($id,11)?></textarea>
            
              <input name="submitProhibitive" type="submit" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>

    </div>
  </div>
</div>
<!--  row end -->
                </div>



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>





  </div>
</div>





<style>
.wrapper{width: 100%;}
.bs-example-tabs ul li{margin-bottom: 20px;}
.nav-pills>li>a, .nav-tabs>li>a{font-size: 16px !important;}
.fade:not(.show) {
    opacity: 1 !important;
}
</style>




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
<script type="text/javascript">
                CKEDITOR.replaceClass ( 'ckeditor' );
                CKEDITOR.add            
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