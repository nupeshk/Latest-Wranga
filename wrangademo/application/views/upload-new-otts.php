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
<nav class="sidebar sidebar-offcanvas" id="sidebar">
<ul class="nav">
  
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'published-otts'; ?>">
    <span class="menu-title"><i class="mdi mdi-arrow-left"></i> Back To OTT</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url_index.'#'; ?>">
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
      <div class="row">


<!-- ===========  Tabing =========-->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General Information</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Cast Information</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Image Information</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false">Video Information</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  
<!-- tabingation 1 -->
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<form method="post" action="" enctype="multipart/form-data">  
<div class="card mb-1">
          
              <div class="card-body text-muted">

                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Title</label>
                  <div class="col-lg-10">
                    <input type="title" class="form-control" required="required" id="title" value="<?=$content[0]->title?>" name="title">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Select OTT Language</label>
                  <div class="col-lg-10">
                    <select class="form-control custom-select" id="sub_catgId" name="languageId" placeholder="Subcatagories">
                      <?php foreach ($wrng_language as $key => $wrng_language) {?>
                      <option value="<?=$wrng_language->lId?>" <?php if($content[0]->languageId==$wrng_language->lId){ echo "selected"; } ?>><?=$wrng_language->lName?></option>
                     <?php } ?>  
                    </select>
                  </div>
                </div>

                  <div class="form-group row">
                  <label class="col-lg-2 col-form-label">OTT Platform Type</label>
                  <div class="col-lg-10">
                  <select class="form-control custom-select" id="ottPlaformType" name="ottPlaformType" >
                    <option value="">Select OTT Platform Type</option>
                      <?php foreach ($wrng_ottPlatformType as $key => $wrng_ottPlatformType) {?>
                      <option value="<?=$wrng_ottPlatformType->ottPlatformTypeId?>" <?php if($content[0]->ottPlaformType==$wrng_ottPlatformType->ottPlatformTypeId){ echo "selected"; } ?>><?=$wrng_ottPlatformType->title?></option>
                     <?php } ?>  
                    </select>
                  </div>
                </div>



                <!-- <hr style="margin: 50px 0;"> -->

                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Subcatagories</label>
                  <div class="col-lg-10">
                    <select class="form-control custom-select" id="sub_catgId" name="sub_catgId" placeholder="Subcatagories">
                      <option value="">Select Subcatagories</option>
                       <?php foreach ($subCatagories as $key => $subCatagories) {?>
                        <option value="<?=$subCatagories->subId?>" 
                          <?php if($content[0]->sub_catgId==$subCatagories->subId){ echo "selected";}?> ><?=$subCatagories->name?></option>
                    <?php } ?>
                    </select>

                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label" for="example-textarea">Short Desc.</label>
                  <div class="col-lg-10">
                    <textarea class="form-control" required="required" rows="5" placeholder="Enter desc." name="description" id="example-textarea"><?=$content[0]->description?></textarea>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">OTT Content Type</label>
                  <div class="col-lg-10">
                    <select class="form-control custom-select" id="ott type" name="ottcontentTypeId" placeholder="ott type">
                      <option selected="1">video</option>
                        
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Ott Type</label>
                  <div class="col-lg-10">
                   
                    <select class="form-control custom-select" id="ottType_Id" name="ottType_Id" onchange="showDiv(this)">
                    <option value="">Ott Type</option>
                         <?php foreach ($ottType as $key => $ottType) {?>
                        <option value="<?=$ottType->ottTypeId?>" <?php if($content[0]->ottType_Id==$ottType->ottTypeId){ echo "selected";}?> ><?=$ottType->name?></option>
                      <?php } ?> 
                    </select>

                  </div>
                </div>

            <div id="hidden_div" 
           <?php  if($content[0]->ottType_Id!=3){?> style="display:none;"  <?php } ?> >
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Season</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="sesson" placeholder="Enter season number" name="sesson" value="<?=$content[0]->sesson?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Episode</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="episode" placeholder="Enter episode number" name="episode" value="<?=$content[0]->episode?>">
                  </div>
                </div>
          </div>      

          <script type="text/javascript">
            function showDiv(select){
               if(select.value==3){
                document.getElementById('hidden_div').style.display = "block";
               }else if(select.value!=3) {
                 document.getElementById('hidden_div').style.display = "none";
               } 
            } 
        </script>


                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Genre</label>
                  <div class="col-lg-10">
                    <div class="table-responsive">
                      <table class="table m-0">
                        <thead>
                          <tr>
                            <th colspan="6"> <label class="col-lg-2 col-form-label">Select genre.</label></th>
                          </tr>
                         <tr>
                           <?php $people =   explode(",",$wrng_contentGenreAll); ?>
                        <?php foreach ($wrng_genre as $key => $wrng_genre) {?>
                            <td style="float:left;"><div class="mt-3">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="customCheck<?=$wrng_genre->gId?>" value="<?=$wrng_genre->gId?>" name="genre[]"

                                    <?php if(in_array($wrng_genre->gId, $people)){ echo "checked";} ?> >
                                  <label class="custom-control-label" for="customCheck<?=$wrng_genre->gId?>"><?=$wrng_genre->name?></label>
                                </div>
                              </div></td>
                        <?php }    ?>                              
                          </tr>                          
                        </tbody>
                      </table>
                        <div class="clearfix"> </div>
                    </div>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Year of Release</label>
                  <div class="col-lg-10">
                    <input type="text" id="basic-datepicker" class="form-control" required="required" placeholder="Year of Release" name="releaseYear" value="<?=$content[0]->releaseYear?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Name of Director</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" required="required" id="editorName" placeholder="Enter editor name" name="editorName" value="<?=$content[0]->editorName?>">
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
  

<!-- tabingation 2 -->
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<form method="post" action="" enctype="multipart/form-data">
<div class="card mb-1"> 
<div class="card-body text-muted">
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Add Your Cast Name</label>
                  <div class="col-lg-10">              
                    <input type="cast" class="form-control" required="required" id="cast" placeholder="Cast Name" name="cast_name" style="width: 82%; float: right;">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Photo</label>
                  <div class="col-lg-10">
                    <div style="width: 82%; float: right;">
                      <input name="cast_image[]" type="file" multiple>
                    </div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="simpleinput"></label>
                  <div class="col-lg-8">
                    <input type="submit" class="btn btn-primary" name="castSubmit">
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 castscroll">

                  <style> 
                    .castscroll{float: left; overflow-x: scroll; margin-bottom: 12px;}
                    .actorbox{float: left;}
                    .castbox{float: left; background-color: #fff; border:1px #ddd solid; position: relative; overflow: hidden;
                    -webkit-border-radius: 10px;
                    -moz-border-radius: 10px;
                    border-radius: 10px;
                    }
                    .castpic{float: left; width: 100%;}
                   .castpic img {
              width: 100%;
              height: 110px;
              min-height: 110px;
              overflow: hidden;
          }
          .vidbox img {
              width: 100% !important;
              height: 80px !important;
              min-height: 80px !important;
              overflow: hidden;
          }
                    .castdetails{width: 100%; float: left;}
                    .castdetails h2{font-size: 14px; padding-left: 8px;}
                    .castdel{position: absolute; right: 5px; bottom: 5px;}
                  </style>
                  

                  <?php foreach ($wrng_cast as $key => $wrng_cast) {?>
                  
                  <div class="col-md-2 actorbox"> 
                      <div class="castbox"> 
                          <div class="castpic">


 <?php if($wrng_cast->cast_image==''){?>
 <img src="http://localhost/WrangaWeb/wrangademo/images/logo.png">
                          <?php }else{ ?>
 <img src="<?php echo SITE_URL;?>assets/castImage/<?=$wrng_cast->cast_image;?>">
                          <?php } ?>
                           


                          </div>



                          <div class="castdetails">
                          <h2><?=$wrng_cast->cast_name;?></h2>
                          <a href="<?php echo SITE_URL_INDEX;?>OttContent/delete/wrng_cast/<?=$wrng_cast->id;?>/upload-new-otts/<?=$content[0]->contentId?>" onclick="alert('are you sure you want to delete!');" class="castdel"><i class="mdi mdi-delete-forever"></i></a>
                        </div>
                      </div>
                  </div>

                  <?php } ?>       

 
                </div>
                <div class="clearfix text-right mt-3"> 
                  <!--<button type="button" class="btn btn-danger"> <i class="uil uil-arrow-right mr-1"></i> Submit</button>--> 
                </div>
              </div>
</div>
</form>
</div>
<!--  End -->


<!-- tabingation 3 -->
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
<div class="card mb-0" style="margin-bottom: 4px !important;"> 
<div class="card-body text-muted">
               
 <form method="post" action="" enctype="multipart/form-data"> 
                <div class="form-group row">


                  <label class="col-lg-2 col-form-label">Upload Thumbnail Image</label>
                  <div class="col-lg-2 actorbox">
                    <div class="castbox">
                    <div class="castpic">
                      <?php if(empty($content[0]->thumbnailImage)){?>
                      <input type="file" class="form-control" required="required" name="thumbnailImage">
<?php } ?>

                   <?php if($content[0]->thumbnailImage!=""){?>
                      <img src="<?=SITE_URL?>assets/thumbnailImage/<?=$content[0]->thumbnailImage?>">
                      <a href="<?php echo SITE_URL_INDEX;?>OttContent/deleteThumbnailImage/<?=$content[0]->contentId?>" onclick="alert('are you sure you want to delete!');" class="castdel"><i class="mdi mdi-delete-forever"></i></a>
                   <?php } ?>      



                    </div>
                  </div>
              </div>
                </div>
                 <div class="form-group row">
                  <label class="col-lg-2 col-form-label" for="simpleinput"></label>
                  <div class="col-lg-10">
                       <?php if(empty($content[0]->thumbnailImage)){?>
                       <input type="submit" class="btn btn-primary" name="submitThumbnail" value="Upload">
                     <?php } ?>
                  </div>
                </div>
 </form>               

         <form method="post" action="" enctype="multipart/form-data">       
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Upload Banner Images</label>
                  <div class="col-lg-10">
                    <div>
                      <input type="file" name="image_path[]" multiple="" class="form-control" required="required">
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-lg-2 col-form-label" for="simpleinput"></label>
                  <div class="col-lg-10">
                    <input type="submit" class="btn btn-primary" name="submitBanner" value="Upload">

                  </div>
                </div>
      </form>


            <div class="clearfix"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 castscroll">


              <?php foreach ($content_image as $key => $content_image) {?>

                <div class="col-md-3 actorbox vidbox" style="float: left;"> 
                      <div class="castbox"> 
                          <div class="castpic"><img src="<?php echo SITE_URL;?>assets/bannerImage/<?=$content_image->image_path;?>"></div>
                          <div class="castdetails">
                          <a href="<?php echo SITE_URL_INDEX;?>OttContent/delete/content_image/<?=$content_image->id;?>/upload-new-otts/<?=$content[0]->contentId?>" onclick="alert('are you sure you want to delete!');" class="castdel"><i class="mdi mdi-delete-forever"></i></a>
                        </div>
                      </div>  
                  </div>

             <?php } ?>   

          </div>


</div>
</div>
</div>
<!--  End -->


<!-- tabingation 4 -->
<div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
<div class="card mb-0" style="margin-bottom: 4px !important;"> 
<div class="card-body text-muted">

<form method="post" action="" enctype="multipart/form-data">

              <div class="card-body text-muted">
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Video Platform</label>
                  <div class="col-lg-10">
                  
                   <select class="form-control custom-select" id="videoPlatform" name="videoPlatform" placeholder="videoPlatform">
                      <option>Select platform</option>
                        <?php foreach ($platform as $key => $platform) {?>
                      <option value="<?=$platform->pId?>"    <?php if($wrng_content_video_url[0]->videoPlatform==$platform->pId){ echo "selected";}?> ><?=$platform->name?></option>
                  <?php } ?> 
                    </select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Video</label>
                  <div class="col-lg-10">
                    <div> <input type="file" name="video_mp4">                      
                     <?php if(isset($wrng_content_video_url)){ ?>
                      
              <a href="<?=SITE_URL?>assets/videoMP4/<?=$wrng_content_video_url[0]->video_mp4?>" target="_blank"><img src="<?=SITE_URL?>assets/videoImage/<?=$wrng_content_video_url[0]->video_image?>" width="100"></a>

                    <?php } ?>
                           </div>
                    </div>
                  </div>


                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Video Preview Image</label>
                  <div class="col-lg-10">
                    <div> <input type="file" name="video_image">                      
                     <?php if(isset($wrng_content_video_url)){ ?>
                      <img src="<?=SITE_URL?>assets/videoImage/<?=$wrng_content_video_url[0]->video_image?>" width="100">
                    <?php } ?>
                           </div>
                    </div>
                  </div>
                </div>

                <div class="card-body text-muted row">
                  <label class="col-lg-2 col-form-label">Video Url</label>
                  <div class="col-lg-10">
                    <input type="Video Url" class="form-control" id="video_url" placeholder="Enter Video url" value="<?=$wrng_content_video_url[0]->video_url?>" name="video_url">
                  </div>
                </div>
                <div class="card-body text-muted row">
                  <label class="col-lg-2 col-form-label">Video Duration</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="duration" placeholder="Video Duration in minute" name="duration" value="<?php if(isset($wrng_content_video_url)){ echo  $wrng_content_video_url[0]->duration;}?>">
                  </div>
                </div>

                <div class="card-body text-muted row">
                  <label class="col-lg-2 col-form-label" for="simpleinput"></label>
                  <div class="col-lg-10">
                    <input type="submit" class="btn btn-primary" name="videoSubmit" value="Upload">
                  </div>
                </div>

                <div class="clearfix text-right mt-3"> 
                  <!--<button type="button" class="btn btn-danger"> <i class="uil uil-arrow-right mr-1"></i> Submit</button>--> 
                </div>

</form>     
</div>
</div>
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