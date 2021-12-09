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
</style>

</head>
<body>
<div class="container-scroller">
<?php include('template/topbar.php'); ?>

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
  <a class="nav-link" href="<?php echo base_url_index.'app-upload-new-otts/'.$id; ?>">
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
  <div class="col-12">
    <div class="card">
      <div class="card-body"> 
        <!-- <h5 class="header-title mb-4 mt-0">General Information</h5>-->
        <div class="custom-accordion accordion ml-4" id="customaccordion_exa">
          <div class="card mb-1"> <a href="" class="text-dark" data-toggle="collapse" data-target="#customaccorcollapseOne" aria-expanded="true" aria-controls="customaccorcollapseOne">
            <div class="card-header" id="customaccorheadingOne">
              <h5 class="m-0 font-size-14"> <i class="uil uil-question-circle h3 text-primary icon"></i> General Information </h5>
            </div>
            </a>
      <form method="post" action="" enctype="multipart/form-data">     
            <div id="customaccorcollapseOne" class="collapse show" aria-labelledby="customaccorheadingOne" data-parent="#customaccordion_exa">
              <div class="card-body text-muted">

                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Title</label>
                  <div class="col-lg-10">
                    <input type="title" class="form-control" id="title" value="<?=$content[0]->title?>" name="title">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Select OTT Language</label>
                  <div class="col-lg-10">
                    <select class="form-control custom-select" id="sub_catgId" name="sub_catgId" placeholder="Subcatagories">
                      <?php foreach ($wrng_language as $key => $wrng_language) {?>
                      <option value="<?=$wrng_language->lId?>"><?=$wrng_language->lName?></option>
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
                    <textarea class="form-control" rows="5" placeholder="Enter desc." name="description" id="example-textarea"><?=$content[0]->description?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Platform</label>
                  <div class="col-lg-10">
                    <select class="form-control custom-select" id="platform" name="platformId" placeholder="platform">
                      <option>Select platform</option>
                        <?php foreach ($platform as $key => $platform) {?>
                      <option value="<?=$platform->pId?>"    <?php if($content[0]->platformId==$platform->pId){ echo "selected";}?> ><?=$platform->name?></option>
                  <?php } ?> 
                    </select>
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

            <div id="hidden_div" style="display:none;">
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Season</label>
                  <div class="col-lg-10">
                    <input type="season" class="form-control" id="season" placeholder="Enter season number" name="<?=$content[0]->sesson?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Episode</label>
                  <div class="col-lg-10">
                    <input type="episode" class="form-control" id="episode" placeholder="Enter episode number" name="<?=$content[0]->episode?>">
                  </div>
                </div>
          </div>      

          <script type="text/javascript">
            function showDiv(select){
               if(select.value==3){
                document.getElementById('hidden_div').style.display = "block";
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
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Year of Release</label>
                  <div class="col-lg-10">
                    <input type="text" id="basic-datepicker" class="form-control" placeholder="Year of Release" name="releaseYear" value="<?=$content[0]->releaseYear?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Name of Editor</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="editorName" placeholder="Enter editor name" name="editorName" value="<?=$content[0]->editorName?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label" for="simpleinput"></label>
                  <div class="col-lg-10">
                    <input type="submit" class="btn btn-primary" name="submitGeneral"  value="Next&gt;&gt;">
                  </div>
                </div>
              </div>
            </div>
          </div>


</form>




      <form method="post" action="" enctype="multipart/form-data">
          <div class="card mb-1"> <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customaccorcollapseTwo" aria-expanded="false" aria-controls="customaccorcollapseTwo">
            <div class="card-header" id="customaccorheadingTwo">
              <h5 class="m-0 font-size-14"> <i class="uil uil-question-circle h3 text-primary icon"></i> Cast Information </h5>
            </div>
            </a>
            <div id="customaccorcollapseTwo" class="collapse" aria-labelledby="customaccorheadingTwo" data-parent="#customaccordion_exa">
              <div class="card-body text-muted">
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Add Your Cast Name</label>
                  <div class="col-lg-10">              
                    <input type="cast" class="form-control" id="cast" placeholder="Cast Name" name="cast_name" style="width: 82%; float: right;">
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
                    <input type="submit" class="btn btn-primary" name="castSubmit" value="Upload">
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php foreach ($wrng_cast as $key => $wrng_cast) {?>
                  <div class="col-md-3 gall" style="border-left:none !important; padding-left: 0 !important;"> 
              
                    <img src="<?php echo SITE_URL;?>assets/castImage/<?=$wrng_cast->cast_image;?>">
                     <a href="<?php echo SITE_URL_INDEX;?>OttContent/delete/wrng_cast/<?=$wrng_cast->id;?>/upload-new-otts/<?=$content[0]->contentId?>" onclick="alert('are you sure you want to delete!');" class="castdel"><i class="mdi mdi-delete-forever"></i></a>



                    <div class="card-body" style="padding:0;">
                      <h5 class="card-title font-size-16" style="margin-top: 10px;"><?=$wrng_cast->cast_name;?></h5>
                    </div>
                  </div>
           <?php } ?>       

 
                </div>
                <div class="clearfix text-right mt-3"> 
                  <!--<button type="button" class="btn btn-danger"> <i class="uil uil-arrow-right mr-1"></i> Submit</button>--> 
                </div>
              </div>
            </div>
          </div>
</form>


           <div class="card mb-0" style="margin-bottom: 4px !important;"> <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customaccorcollapseThree" aria-expanded="false" aria-controls="customaccorcollapseThree">
            <div class="card-header" id="customaccorheadingThree">
              <h5 class="m-0 font-size-14"> <i class="uil uil-question-circle h3 text-primary icon"></i> Image Information </h5>
            </div>
            </a>
            <div id="customaccorcollapseThree" class="collapse" aria-labelledby="customaccorheadingThree" data-parent="#customaccordion_exa">
              <div class="card-body text-muted">
               
 <form method="post" action="" enctype="multipart/form-data"> 
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Upload Thumbnail Image</label>
                  <div class="col-lg-10">
                    <div>
                      <?php if(empty($content[0]->thumbnailImage)){?>
                      <input type="file" class="form-control" name="thumbnailImage">
<?php } ?>

                   <?php if($content[0]->thumbnailImage!=""){?>
                      <img src="<?=SITE_URL?>assets/thumbnailImage/<?=$content[0]->thumbnailImage?>">
                      <a href="<?php echo SITE_URL_INDEX;?>OttContent/deleteThumbnailImage/<?=$content[0]->contentId?>" onclick="alert('are you sure you want to delete!');" class="castdel"><i class="mdi mdi-delete-forever"></i></a>
                   <?php } ?>      



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
                      <input type="file" name="image_path[]" multiple="" class="form-control">
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <?php foreach ($content_image as $key => $content_image) {?>
                  <div class="col-md-3 gall" style="border-left:none !important; padding-left: 0 !important;"> 
                    <img class="card-img-top img-fluid" src="<?php echo SITE_URL;?>assets/bannerImage/<?=$content_image->image_path;?>" alt="Card image cap">

                     <a href="<?php echo SITE_URL_INDEX;?>OttContent/delete/content_image/<?=$content_image->id;?>/upload-new-otts/<?=$content[0]->contentId?>" onclick="alert('are you sure you want to delete!');" class="castdel"><i class="mdi mdi-delete-forever"></i></a>
                    <div class="card-body" style="padding:0;">
                      <h5 class="card-title font-size-16" style="margin-top: 10px;"><?=$wrng_cast->cast_name;?></h5>
                    </div>
                  </div>
           <?php } ?>  
                </div>
                <div class="clearfix text-right mt-3"> 
                  <!--<button type="button" class="btn btn-danger"> <i class="uil uil-arrow-right mr-1"></i> Submit</button>--> 
                </div>
              </div>
            </div>
          </div>
          <br>

          <div class="card mb-0" style="margin-top: -17px;"> <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customaccorcollapse4" aria-expanded="false" aria-controls="customaccorcollapse4">
            <div class="card-header" id="customaccorheading4">
              <h5 class="m-0 font-size-14"> <i class="uil uil-question-circle h3 text-primary icon"></i> Video Information </h5>
            </div>
            </a>
      <form method="post" action="" enctype="multipart/form-data">
           
            <div id="customaccorcollapse4" class="collapse" aria-labelledby="customaccorheading4" data-parent="#customaccordion_exa">
              <div class="card-body text-muted">
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Video Platform</label>
                  <div class="col-lg-10">
                    <select class="form-control custom-select" id="videoPlatform" name="videoPlatform" placeholder="Video Platform">
                      <option>Select video platform</option>
                      <option selected="">  netfilx</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Video Preview Image</label>
                  <div class="col-lg-10">
                    <div> <input type="file" name="video_image">

                      


                     <?php if(isset($wrng_content_video_url)){ ?>
                      <img src="<?=SITE_URL?>assets/videoImage/<?=$wrng_content_video_url[0]->video_image?>">
                    <?php } ?>
                          <span class="text-muted font-13">(Upload Video Image)</span> </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Video Url</label>
                  <div class="col-lg-10">
                    <input type="Video Url" class="form-control" id="video_url" placeholder="Enter Video url" value="<?=$wrng_content_video_url[0]->video_url?>" name="video_url">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 col-form-label">Video Duration</label>
                  <div class="col-lg-10">
                    <input type="Time" class="form-control" id="duration" placeholder="Time" name="duration" value="<?php if(isset($wrng_content_video_url)){$wrng_content_video_url[0]->duration;}?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-lg-2 col-form-label" for="simpleinput"></label>
                  <div class="col-lg-10">
                    <input type="submit" class="btn btn-primary" name="videoSubmit" value="Upload">
                  </div>
                </div>

                <div class="clearfix text-right mt-3"> 
                  <!--<button type="button" class="btn btn-danger"> <i class="uil uil-arrow-right mr-1"></i> Submit</button>--> 
                </div>
              </div>
        </form>     
         
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end card--> 
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