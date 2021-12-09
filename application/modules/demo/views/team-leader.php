

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
                                        <li class="breadcrumb-item active" aria-current="page">Team Leader</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Team Leader</h4>
                            </div>
                        </div>
                        <br><br>


                        <!-- end row -->
                           <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                      <h4 class="header-title mt-0 mb-1">Team Leader</h4>
                                      <div class="table-responsive">
                                     <?php   if($this->session->userdata('MSG')){
                                        //echo $this->tempVars["MSG"];
                                        echo $this->session->userdata('MSG');                           
                                        $msg=array("MSG"=>"");
                                        $this->session->set_userdata($msg);
                                        }
                                    ?>

                                       <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                  <th>Photo</th>
                                                  <th>ID</th>
                                                  <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Creation Date</th>
                                                   <th style="margin-left: 30px;">Action</th>
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>

                                <?php $sn=1;foreach ($teamLeader as $key => $admin) {?>
                                                
                                                 <tr>
                                                  <td>
                                                    <?php if($admin->photo){ ?>
                                                        <img src="http://wranga.in/assets/photo/<?=$admin->photo?>" width="25"/>
                                                    <?php }else{ ?>
                                                        <img src="http://wranga.in/public/assets/images/users/avatar-77.jpg" width="25" />
                                                    <?php } ?></td>

                                                  <td><?=$sn?></td>
                                                  <td><?=$admin->name?></td>
                                                  <td><?=$admin->email?></td>
                                                  <td><?=$admin->phone?></td>
                                                  <td><?=$admin->created_at?></td>
                                                   <td> <div align="center"><a href="javascript:void(0);"><i data-feather="user-check" data-toggle="modal" data-target="#myModal<?=$sn?>" style="color: #25b580;"></i> </a></div></td>
                                                    

                                                    <td> <div align="center" style="float:left;"><a href="http://wranga.in/index.php/demo/welcome/delete/cms_admin/<?=$admin->id?>/team-leader.html"><i data-feather="trash-2" style="color: #ff000f;" onclick="return confirm('Are you sure you want to delete this item?');"></i> </a></div></td>




                                                </tr>






                                                     <!-- Edit modal content -->
                                        <div id="myModal<?=$sn?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="width: 705px;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel"> View Team Leader</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0">Profile(Personal Options)</h4>
                                        <p class="sub-header">
                                           All the access and modification rights. Page addition and manage the preview in the front end for the guest users and other users.
                                        </p>
                                        
                                        <form class="form-horizontal" method="post" action="">

                                            <input type="hidden" name="id" value="<?=$admin->id?>">

                                            <div class="row" style="width: 655px;">
                                                <div class="col">
                                               
                                                   <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="simpleinput"></label>
                                                        <div class="col-lg-10" style="text-align: center;">
    <?php if($admin->photo){?>
    <img src="http://wranga.in/assets/photo/<?=$admin->photo?>" width="25"/>                                             
<?php }else{?>
    <img src="http://wranga.in/public/assets/images/users/avatar-77.jpg" style="width: 74px; height: 70px;" class="avatar-sm rounded-circle mr-2" alt="Wranga">
<?php } ?>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                   <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="simpleinput">Name</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="name" value="<?=$admin->name?>" placeholder="Name" required="">
                                                        </div>
                                                        
                                                    </div>
                                                   

                                                    
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-email">Email</label>
                                                        <div class="col-lg-10">
                                                            <input type="email" name="email"  class="form-control" value="<?=$admin->email?>" placeholder="Email"  required="">
                                                            <input type="hidden" value="2" name="user_type">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-password">Password</label>
                                                        <div class="col-lg-10">
                                                            <input type="password" class="form-control" id="password" value="<?=$admin->password?>" name="password" placeholder="Password" required="">
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Phone</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" type="phone" name="phone" value="<?=$admin->phone?>" id="phone" placeholder="Phone" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-textarea">Address</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" rows="5"
                                                                name="address" placeholder="Address" required=""><?=$admin->address?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-email">PAN</label>
                                                        <div class="col-lg-10">
                                                           <input type="text" class="form-control" name="pan" placeholder="PAN" value="<?=$admin->pan?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Adhar</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" type="adhar" name="adhar" id="adhar" placeholder="Adhar" value="<?=$admin->adhar?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-fileinput">Photo</label>
                                                        <div class="col-lg-10">
                                                            
                                                            <input type="file" class="form-control"  name="photo" placeholder="Photo" required="">
                                                        <?php if($admin->photo){?>
                                                             <input class="form-control" type="hidden" name="photo1" id="photo1" value="<?=$admin->photo?>">
                                                         <?php } ?>   
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-textarea">Comment</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" rows="5"
                                                                name="comment" placeholder="Comment"><?=$admin->comment?></textarea>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"></label>
                                                        <div class="col-lg-10">
                                                            <input type="submit" class="btn btn-success width-sm" value="Edit">
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </form>
            


                                    </div> <!-- end card-body -->
                                </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.Edit modal -->




                                                 <?php $sn++;} ?>       
                                            </tbody>
                                        </table>
                                    </div>
                                  </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                      
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                

              