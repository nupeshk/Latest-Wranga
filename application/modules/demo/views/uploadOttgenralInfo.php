

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row page-title">
                            <div class="col-md-12">
                                <nav aria-label="breadcrumb" class="float-right mt-1">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Wranga</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Upload New OTT</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Upload New OTT: Store Publishing</h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                            <div class="card">
                                    <div class="card-body">
                                       <!-- <h5 class="header-title mb-4 mt-0">General Information</h5>-->
                                        <div class="custom-accordion accordion ml-4" id="customaccordion_exa">
                                            <div class="card mb-1">
                                                <a href="" class="text-dark" data-toggle="collapse"
                                                    data-target="#customaccorcollapseOne" aria-expanded="true"
                                                    aria-controls="customaccorcollapseOne">
                                                    <div class="card-header" id="customaccorheadingOne">
                                                        <h5 class="m-0 font-size-14">
                                                            <i class="uil uil-question-circle h3 text-primary icon"></i>
                                                      General Information                                                     </h5>
                                                    </div>
                                                </a>

                                                <div id="customaccorcollapseOne" class="collapse show"
                                                    aria-labelledby="customaccorheadingOne"
                                                    data-parent="#customaccordion_exa">
                                                  <div class="card-body text-muted">
                                                        <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Subcatagories</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control custom-select" id="subcatagories" name="subcatagories" placeholder="Subcatagories">
                                                                <option>Select Subcatagories</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Title</label>
                                                        <div class="col-lg-10">
                                                            <input type="Titel" class="form-control" id="Titel" placeholder="Enter Titel" name="Titel">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-textarea">Short Desc.</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" rows="5" placeholder="Enter desc." name="Enter desc."
                                                                id="example-textarea"></textarea>
                                                        </div>
                                                    </div>
                                                  <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Platform</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control custom-select" id="platform" name="platform" placeholder="platform">
                                                                <option>Select platform</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">OTT Content Type</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control custom-select" id="ott type" name="ott type" placeholder="ott type">
                                                                <option>Select OTT type</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Type of Content</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" disabled="Type of Content"
                                                                value="Video" name="Video" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Season</label>
                                                       <div class="col-lg-10">
                                                            <input type="season" class="form-control" id="season" placeholder="Enter season number" name="season">
                                                      </div>
                                                    </div>
                                                  <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Episode</label>
                                                        <div class="col-lg-10">
                                                            <input type="episode" class="form-control" id="episode" placeholder="Enter episode number" name="episode">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Language</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control custom-select" id="language " name="language" placeholder="language">
                                                                <option>Select OTT language</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Genre</label>
                                                        <div class="col-lg-10">
                                                        <div class="table-responsive">
                                               <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                      <th colspan="6"> 
                                                      <label class="col-lg-2 col-form-label">Select genre.</label></th>
                                                    </tr>
                                                    <tr>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2" name="epic">
                                                <label class="custom-control-label" for="customCheck2">Epic</label>
                                            </div>
                                        </div></th>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3" name="history">
                                                <label class="custom-control-label" for="customCheck3">History</label>
                                            </div>
                                        </div></th>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck4" name="war">
                                                <label class="custom-control-label" for="customCheck4">War</label>
                                            </div>
                                        </div></th>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck5" name="crime">
                                                <label class="custom-control-label" for="customCheck5">Crime</label>
                                            </div>
                                        </div></th>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck6" name="thriller">
                                                <label class="custom-control-label" for="customCheck6">Thriller</label>
                                            </div>
                                        </div></th>
                                                        <th><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck7" name="horror">
                                                <label class="custom-control-label" for="customCheck7">Horror</label>
                                            </div>
                                        </div></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck8" name="Sci-fi">
                                                <label class="custom-control-label" for="customCheck8">Sci-fi</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck9" name="Fantasy">
                                                <label class="custom-control-label" for="customCheck9">Fantasy</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck10" name="Adventure">
                                                <label class="custom-control-label" for="customCheck10">Adventure</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck11" name="Sports">
                                                <label class="custom-control-label" for="customCheck11">Sports</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck12" name="Musical">
                                                <label class="custom-control-label" for="customCheck12">Musical</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck13" name="Entertainment">
                                                <label class="custom-control-label" for="customCheck13">Entertainment</label>
                                            </div>
                                        </div></td>
                                                    </tr>
                                                    <tr>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck14" name="Drama">
                                                <label class="custom-control-label" for="customCheck14">Drama</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck15" name="Romance">
                                                <label class="custom-control-label" for="customCheck15">Romance</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck16" name="Comedy">
                                                <label class="custom-control-label" for="customCheck16">Comedy</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck17" name="RomCom">
                                                <label class="custom-control-label" for="customCheck17">RomCom</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck18" name="True-Story">
                                                <label class="custom-control-label" for="customCheck18">True Story</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck19" name="Documentary">
                                                <label class="custom-control-label" for="customCheck19">Documentary</label>
                                            </div>
                                        </div></td>
                                                    </tr>
                                                    <tr>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck20" name="Animation">
                                                <label class="custom-control-label" for="customCheck20">Animation</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck21" name="Other">
                                                <label class="custom-control-label" for="customCheck21">Any Other (Please specify)</label>
                                            </div>
                                        </div></td>
                                                        <td><div class="col-lg-10">
                                                            <input type="Other" class="form-control" id="other" placeholder="other" id="Other" name="Othes">
                                                        </div></td>
                                                        <td>&nbsp;</td>
                                                      <td>&nbsp;</td>
                                                      <td>&nbsp;</td>
                                                  </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Year of Release</label>
                                                        <div class="col-lg-10">
                                                           <input type="text" id="basic-datepicker" class="form-control" placeholder="Year of Release" name="Year-of-Release">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Name of Editor</label>
                                                        <div class="col-lg-10">
                                                            <input type="editor" class="form-control" id="editor" placeholder="Enter editor name" name="editor">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="simpleinput"></label>
                                                        <div class="col-lg-10">
                                                            <button type="submit" class="btn btn-primary" name="Submit">Next>></button>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="card mb-1">
                                                <a href="" class="text-dark collapsed" data-toggle="collapse"
                                                    data-target="#customaccorcollapseTwo" aria-expanded="false"
                                                    aria-controls="customaccorcollapseTwo">
                                                    <div class="card-header" id="customaccorheadingTwo">
                                                        <h5 class="m-0 font-size-14">
                                                            <i
                                                                class="uil uil-question-circle h3 text-primary icon"></i>
                                                           Cast Information                                                        </h5>
                                                    </div>
                                                </a>

                                                <div id="customaccorcollapseTwo" class="collapse"
                                                    aria-labelledby="customaccorheadingTwo"
                                                    data-parent="#customaccordion_exa">
                                                    <div class="card-body text-muted">
                                                       <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Add Your Cast Name</label>
                                                        <div class="col-lg-10">
                                 <input type="cast" class="form-control" id="cast" placeholder="Cast Name" name="cast name" style="width: 82%; float: right;">
                                                        </div>
                                                    </div>  
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Photo</label>
                                                        <div class="col-lg-10">
                                 <div style="width: 82%; float: right;">         
                                        <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" name="upload-image">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
            
                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted  uil-cloud-upload"></i>
                                                <h3>Drop files here or click to upload.</h3>
                                                <span class="text-muted font-13">(Upload Photo)</span>                                            </div>
                                        </form></div>
                                                        </div>
                                                    </div> 
                                          <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="simpleinput"></label>
                                                        <div class="col-lg-10" style="text-align: center;">
                                                            <button type="submit" class="btn btn-primary" name="submit">Upload</button>
                                                        </div>
                                                    </div>
                                             
                                           <div class="col-lg-6 col-xl-3">
                                                <div class="card mb-4 mb-xl-0">
                                                    <img class="card-img-top img-fluid" src="http://wranga.in/public/assets/images/small/img-2.jpg" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title font-size-16">Uploaded Image 1</h5>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        <div class="clearfix text-right mt-3">
                                            <!--<button type="button" class="btn btn-danger"> <i class="uil uil-arrow-right mr-1"></i> Submit</button>-->
                                        </div> 
                                                    
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="card mb-0">
                                                <a href="" class="text-dark collapsed" data-toggle="collapse"
                                                    data-target="#customaccorcollapseThree" aria-expanded="false"
                                                    aria-controls="customaccorcollapseThree">
                                                    <div class="card-header" id="customaccorheadingThree">
                                                        <h5 class="m-0 font-size-14">
                                                            <i
                                                                class="uil uil-question-circle h3 text-primary icon"></i>
                                                           Image Information                                              </h5>
                                                    </div>
                                                </a>

                                                <div id="customaccorcollapseThree" class="collapse"
                                                    aria-labelledby="customaccorheadingThree"
                                                    data-parent="#customaccordion_exa">
                                                    <div class="card-body text-muted">
                                                       <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Image Type</label>
                                                        <div class="col-lg-10">
                                <select class="form-control custom-select" id="image-type" name="image-type" placeholder="image-type">
                                                                <option>Banner/Thumbnail</option>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Photo</label>
                                                        <div class="col-lg-10">
                                 <div>         
                                        <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" name="upload-image" placeholder="upload-image">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
            
                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted  uil-cloud-upload"></i>
                                                <h3>Drop files here or click to upload.</h3>
                                                <span class="text-muted font-13">(Upload Photo)</span>                                            </div>
                                        </form></div>
                                                        </div>
                                                    </div> 
                                          <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="simpleinput"></label>
                                                        <div class="col-lg-10" style="text-align: center;">
                                                            <button type="submit" class="btn btn-primary" name="submit">Upload</button>
                                                        </div>
                                                    </div>
                                           <div class="col-lg-6 col-xl-3">
                                                <div class="card mb-4 mb-xl-0">
                                                    <img class="card-img-top img-fluid" src="http://wranga.in/public/assets/images/small/img-2.jpg" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title font-size-16">Uploaded Image 1</h5>
                                                    </div>
                                                    
                                                </div>
                                            </div>  
                                        <div class="clearfix text-right mt-3">
                                            <!--<button type="button" class="btn btn-danger"> <i class="uil uil-arrow-right mr-1"></i> Submit</button>-->
                                        </div> 
                                                                                                       </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="card mb-0" style="margin-top: -17px;">
                                                <a href="" class="text-dark collapsed" data-toggle="collapse"
                                                    data-target="#customaccorcollapse4" aria-expanded="false"
                                                    aria-controls="customaccorcollapse4">
                                                    <div class="card-header" id="customaccorheading4">
                                                        <h5 class="m-0 font-size-14">
                                                            <i
                                                                class="uil uil-question-circle h3 text-primary icon"></i>
                                                           Video Information                            </h5>
                                                    </div>
                                                </a>
                                   
                                                <div id="customaccorcollapse4" class="collapse"
                                                    aria-labelledby="customaccorheading4"
                                                    data-parent="#customaccordion_exa">
                                                    <div class="card-body text-muted">
                                                       <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Video Platform</label>
                                                        <div class="col-lg-10">
                                <select class="form-control custom-select" id="image-type" name="Video Platform" placeholder="Video Platform">
                                                                <option>Select video platform</option>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Video Preview Image</label>
                                                        <div class="col-lg-10">
                                 <div>         
                                        <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" name="upload-video" placeholder="upload-video">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
            
                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted  uil-cloud-upload"></i>
                                                <h3>Drop files here or click to upload.</h3>
                                                <span class="text-muted font-13">(Upload Video Image)</span>                                            </div>
                                        </form></div>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Video Url</label>
                                                        <div class="col-lg-10">
                                                            <input type="Video Url" class="form-control" id="Video Url" placeholder="Enter Video url" name="Video Url" placeholder="Video Url">
                                                        </div>
                                                    </div>
                                          <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Video Duration</label>
                                                        <div class="col-lg-10">
                                                            <input type="Time" class="form-control" id="Time" placeholder="Time" name="Video Duration">
                                                        </div>
                                                    </div>
                                                    
                                           <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="simpleinput"></label>
                                                        <div class="col-lg-10" style="text-align: center;">
                                                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                                        </div>
                                                    </div>  
                                        <div class="clearfix text-right mt-3">
                                            <!--<button type="button" class="btn btn-danger"> <i class="uil uil-arrow-right mr-1"></i> Submit</button>-->
                                        </div> 
                                                                                                       </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <!-- end card-->
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div> <!-- content -->
                </div>
                

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
