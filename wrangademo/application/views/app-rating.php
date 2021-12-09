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
               <a href="<?=base_url_index?>AppContent/pgStatusActivate/0/<?=$id?>"> Active</a>
             <?php }else{?>
               <a href="<?=base_url_index?>AppContent/pgStatusActivate/1/<?=$id?>"> Inactive</a>
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
                "<?=wrng_ratingCalCategoryColor(16)?>",
                "<?=wrng_ratingCalCategoryColor(17)?>",
                "<?=wrng_ratingCalCategoryColor(18)?>",
                "<?=wrng_ratingCalCategoryColor(19)?>",
                 "<?=wrng_ratingCalCategoryColor(20)?>",
                 "<?=wrng_ratingCalCategoryColor(21)?>",
                "<?=wrng_ratingCalCategoryColor(22)?>",
                "<?=wrng_ratingCalCategoryColor(26)?>"                
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
      { label: "Ease of Use",  y: <?php echo $REaseOfUse ? $REaseOfUse[0]->ratning : 0 ?>  },
      { label: "PwD Accessibility", y:  <?php echo $RPwDAccessibility ? $RPwDAccessibility[0]->ratning : 0 ?> },
      { label: "Safety Features",  y: <?php echo $RSafetyFeatures ? $RSafetyFeatures[0]->ratning : 0 ?>  },
      { label: "Risk to Privacy", y:   <?php echo $RRisktoPrivacy ? $RRisktoPrivacy[0]->ratning : 0 ?>},
      { label: "Positive Learning",  y: <?php echo $RPositiveLearning ? $RPositiveLearning[0]->ratning : 0 ?>  },
      { label: "Negative Features",  y: <?php echo $RNegativeFeatures ? $RNegativeFeatures[0]->ratning : 0 ?>  },
      { label: "Additional Feature",  y: <?php echo $RAdditionalFeature ? $RAdditionalFeature[0]->ratning : 0 ?>  },
      { label: "Prohibitive Category",  y: <?php echo $RProhibitiveCategory ? $RProhibitiveCategory[0]->ratning : 0 ?>  }
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
      <div class="row col-lg-6">
      Suggested Age Group for Using Gaming App
      <form method="post" action="">      
            <select class="form-control custom-select" name="age">
                        <option value="1">Select Age Group</option>
                        <option value="4" <?php echo getAgeValue($this->uri->segment(2))==4?"selected":'';?>>4-7</option>
                        <option value="7" <?php echo getAgeValue($this->uri->segment(2))==7?"selected":'';?>>7-10</option>
                        <option value="10" <?php echo getAgeValue($this->uri->segment(2))==10?"selected":'';?>>10-14</option>
                        <option value="14" <?php echo getAgeValue($this->uri->segment(2))==14?"selected":'';?>>14-18</option>
                      </select>
                   <input type="submit" name="SubmitAgeGroup">     
</form>
         </div>
      </div>
      </div>     
      </section>


<section>
  <div class="app-sec" style="margin-top: 60px;">
    <div class="container">
      <div class="row">
        <div class="wrapper">
          <div class="container">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">

              <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
                <li role="presentation" class="active"> <a href="#Ease" id="Ease-tab" role="tab" data-toggle="tab" aria-controls="Ease" aria-expanded="true"> <span class="text">Ease of Use</span> </a> </li>
               
                <li role="presentation"> <a href="#PwD" role="tab" id="PwD-tab" data-toggle="tab" aria-controls="PwD"> <span class="text">PwD Accessibility</span> </a> </li>
                <li role="presentation"> <a href="#Safety" role="tab" id="Safety-tab" data-toggle="tab" aria-controls="Safety"> <span class="text">Safety Features</span> </a> </li>
                <li role="presentation"> <a href="#Risk" role="tab" id="Risk-tab" data-toggle="tab" aria-controls="Risk"> <span class="text">Risk to Privacy</span> </a> </li>
                <li role="presentation"> <a href="#Positive" role="tab" id="Positive-tab" data-toggle="tab" aria-controls="Positive"> <span class="text">Positive Learning</span> </a> </li>
                <li role="presentation"> <a href="#Negative" role="tab" id="Negative-tab" data-toggle="tab" aria-controls="Negative"> <span class="text">Negative Features</span> </a> </li>
                <li role="presentation"> <a href="#Additional" role="tab" id="Additional-tab" data-toggle="tab" aria-controls="Additional"> <span class="text">Additional Feature</span> </a> </li>
                <li role="presentation"> <a href="#ProhibitiveCategory" role="tab" id="ProhibitiveCategory-tab" data-toggle="tab" aria-controls="ProhibitiveCategory"> <span class="text">Prohibitive Category</span> </a> </li>
              </ul>
              

              <div id="myTabContent" class="tab-content">


                <div role="tabpanel" class="tab-pane fade in active" id="Ease" aria-labelledby="Ease-tab">
                  <!-- 1 row -->      
<form method="post" action="">
<input type="hidden" name="ratingCalCategoryId" value="16">
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Ease Of Use  
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
            <?php foreach ($EaseOfUse as $key => $EaseOfUseValue) {?>
              <tr>
                <td></td> 
                <td><?=$EaseOfUseValue->name?></td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      <select class="form-control custom-select" name="EaseOfUseValue<?=$key?>">
<option value="1" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),16,$EaseOfUseValue->id)==1){ echo "selected";}?>>Yes</option>
<option value="0" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),16,$EaseOfUseValue->id)==0){ echo "selected";}?>>No</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
              <?php } ?>
             
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Brief description of 'Ease of Access’ in the App (25-50 words) *<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Positive Messages in the show (25-50 words)
" class="form-control ckeditor"><?=descMoralbord($id,1)?></textarea>
             
              <input name="SubmitEaseOfUse" type="submit" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<!-- 1 row end --> 
                </div>


                <div role="tabpanel" class="tab-pane fade" id="PwD" aria-labelledby="PwD-tab">
                  <!-- PwD Values row -->      
<form method="post" action="">
<input type="hidden" name="ratingCalCategoryId" value="17">


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">PwD Accessibility<br><br></h4>
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
              <?php foreach ($PwdAccessibility as $key => $PwdAccessibilityValue) {?>
              <tr>
                <td></td> 
                <td><?=$PwdAccessibilityValue->name?></td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                    <select class="form-control custom-select" name="PwdAccessibilityValue<?=$key?>">
                    <option value="1" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),17,$PwdAccessibilityValue->id)==1){ echo "selected";}?>>Yes</option>
                    <option value="0" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),17,$PwdAccessibilityValue->id)==0){ echo "selected";}?>>No</option>
                      </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Brief description of 'PwD Accessibility’ in the App (25-50 words) *<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of PwD Values in the show (25-50 words)
" class="form-control ckeditor"><?=descMoralbord($id,2)?></textarea>
              <input name="SubmitPwdAccessibility"  type="submit" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<!-- PwD Values row end --> 
                </div>


                <div role="tabpanel" class="tab-pane fade" id="Safety" aria-labelledby="Safety-tab">
                  <!-- Safety Values row -->   
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Safety Features<br><br></h4>
        <div class="table-responsive">
    <form method="post" action="">
    <input type="hidden" name="ratingCalCategoryId" value="18">     
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
            <?php foreach ($SafetyFeatures as $key => $SafetyFeaturesValue) {?>            
              <tr>
                <td></td> 
                <td><?=$SafetyFeaturesValue->name?></td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                    <select class="form-control custom-select" name="SafetyFeaturesValue<?=$key?>">
                    <option value="1" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),18,$SafetyFeaturesValue->id)==1){ echo "selected";}?>>Yes</option>
                  <option value="0" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),18,$SafetyFeaturesValue->id)==0){ echo "selected";}?>>No</option>
   </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
            <?php } ?>    
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Brief description of 'Safety Features ’ in the App (25-50 words) *<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Safety in the show (25-50 words)
" class="form-control ckeditor"><?=descMoralbord($id,3)?></textarea>
              <input type="submit" name="SubmitSafetyFeaturesValue" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>


    </div>
  </div>
</div>
<!-- Safety row end --> 
                </div>


                <div role="tabpanel" class="tab-pane fade" id="Risk" aria-labelledby="Risk-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Risk to Privacy</h4>
        <div class="table-responsive">
       
      <form method="post" action="">    
      <input type="hidden" name="ratingCalCategoryId" value="19">
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
            <?php foreach ($RiskToPrivacy as $key => $RiskToPrivacyValue) {?>
              <tr>
                <td></td> 
                <td><?=$RiskToPrivacyValue->name?></td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                    <select class="form-control custom-select" name="RiskToPrivacyValue<?=$key?>">
                    <option value="1" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),19,$RiskToPrivacyValue->id)==1){ echo "selected";}?>>Yes</option>
<option value="0" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),19,$RiskToPrivacyValue->id)==0){ echo "selected";}?>>No</option>
  </select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
            <?php } ?>  
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Risk<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Violent content in the show 25-50 words
" class="form-control ckeditor"><?=descMoralbord($id,4)?></textarea>
          <input type="submit" name="SubmitRiskToPrivacyValue" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
  </form>
    </div>
  </div>
</div>
<!--  row end -->
                </div>


                <div role="tabpanel" class="tab-pane fade" id="Positive" aria-labelledby="Positive-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Positive Learning<br><br></h4>
        <div class="table-responsive">
      <form method="post" action="">
      <input type="hidden" name="ratingCalCategoryId" value="20">
          <table class="table">
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
             <?php foreach ($PositiveLearning as $key => $PositiveLearningValue) {?>
            <tr>
                <td></td> 
                <td><?=$PositiveLearningValue->name?></td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      
                    <select class="form-control custom-select" name="PositiveLearningValue<?=$key?>">
                    <option value="1" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),20,$PositiveLearningValue->id)==1){ echo "selected";}?>>Yes</option>
                    <option value="0" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),20,$PositiveLearningValue->id)==0){ echo "selected";}?>>No</option></select>
                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
            <?php } ?>  

              </tbody>            
          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Brief description of 'Positive Learning' in the App (25-50 words) *<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Positive & Nudity in the show 25-50 words
" class="form-control ckeditor"><?=descMoralbord($id,5)?></textarea>
              
              <input type="submit" name="SubmitPositiveLearningValue" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>
    </div>
  </div>
</div>
<!--  row end -->
                </div>


                <div role="tabpanel" class="tab-pane fade" id="Negative" aria-labelledby="Negative-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Negative Features<br><br></h4>
        <div class="table-responsive">

          <form method="post" action="">
          <input type="hidden" name="ratingCalCategoryId" value="21">
          <table class="table">
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
          <?php foreach ($NegativeFeatures as $key => $NegativeFeaturesValue) {?>
            <tr>
                <td></td> 
                <td><?=$NegativeFeaturesValue->name?></td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      
                    <select class="form-control custom-select" name="NegativeFeaturesValue<?=$key?>">
                    <option value="1" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),21,$NegativeFeaturesValue->id)==1){ echo "selected";}?>>Yes</option>
<option value="0" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),21,$NegativeFeaturesValue->id)==0){ echo "selected";}?>>No</option></select>

                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
              <?php } ?>

              </tbody>

          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Brief description of 'Negative Features’ in the App (25-50 words) *<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of use of Negative Language in the show 25-50 words" class="form-control ckeditor"><?=descMoralbord($id,6)?></textarea>
          <input type="submit" name="SubmitNegativeFeaturesValue" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>
    </div>
  </div>
</div>
<!--  row end -->
                </div>


                <div role="tabpanel" class="tab-pane fade" id="Additional" aria-labelledby="Additional-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Additional Feature<br><br></h4>
        <div class="table-responsive">
          <form method="post" action="">
          <input type="hidden" name="ratingCalCategoryId" value="22">
          <table class="table">
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
              <?php foreach ($AdditionalFeature as $key => $AdditionalFeatureValue) {?>
            <tr>
                <td></td> 
                <td><?=$AdditionalFeatureValue->name?></td>  
                <td><div class="form-group row">
                    <div class="col-lg-10">
                      
                    <select class="form-control custom-select" name="AdditionalFeatureValue<?=$key?>">
                    <option value="1" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),22,$AdditionalFeatureValue->id)==1){ echo "selected";}?>>Yes</option>
                    <option value="0" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),22,$AdditionalFeatureValue->id)==0){ echo "selected";}?>>No</option>
                  </select>

                    </div>
                  </div>
                </td>
                <td></td> 
                <td></td> 
              </tr>
              <?php } ?>

              </tbody>
          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Brief description of 'Additional Feature’ in the App (25-50 words) *<br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Additional Abuse in the show 25-50 words
" class="form-control ckeditor"><?=descMoralbord($id,7)?></textarea>
              <input name="SubmitAdditionalFeatureValue" type="submit" class="btn btn-primary mb-2" style="margin-top: 20px;">
          </div>
        </div>
      </div>
</form>
    </div>
  </div>
</div>
<!--  row end -->
                </div>



<div role="tabpanel" class="tab-pane fade" id="ProhibitiveCategory" aria-labelledby="ProhibitiveCategory-tab">
                  <!-- row -->      
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Prohibitive Category<br><br></h4>
        <div class="table-responsive">
        <form method="post" action="">      
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Category</th>
                <th>Range</th>
             
              </tr>
            </thead>

            <tbody>

            <?php foreach ($ProhibitiveCategoryApp as $key => $ProhibitiveCategoryAppValue) {?> 
              <tr>
                <td></td> 
                <td><?=$ProhibitiveCategoryAppValue->name?><td>  
                <td>
    <select class="form-control" name="ProhibitiveCategoryApp<?=$key?>">
<option value="1" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),26,$ProhibitiveCategoryAppValue->id)==1){ echo "selected";}?>>Yes</option>
<option value="0" <?php if(getvalueAllAtributs('wrng_contentthematicrating',$this->uri->segment(2),26,$ProhibitiveCategoryAppValue->id)==0){ echo "selected";}?>>No</option>
            </select>              
                </td> 
              </tr>
            <?php } ?>  
            
              
              </tbody>

          </table>
        </div>
      </div>
      
      <div class="card-body">
        <h4 class="header-title mt-0 mb-1">Short description on Prohibitive <br><br></h4>
        <div class="table-responsive">
          <div class="form-group">
              <textarea name="desc" cols="" rows="5" placeholder="Brief description of Prohibitive in the show 25-50 words" class="form-control ckeditor"><?=descMoralbord($id,11)?></textarea>
            
              <input name="PositiveLearningSubmitNew" type="submit" class="btn btn-primary mb-2" style="margin-top: 20px;">
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