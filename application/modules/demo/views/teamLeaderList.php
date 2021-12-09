
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
                         <br><br><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-error">Create New Reviewer</button><br><br>
                          <div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="modal-errorLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modal-errorLabel">Create New Reviewer</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="row">
                            <div class="col-12">
                            
                                <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0">Profile(Personal Options)</h4>
                                        <p class="sub-header">
                                           Pending review/s, can preview pending review/s, modify, publish.
                                        </p>

                                        <form class="form-horizontal">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="simpleinput">User Name</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" id="user_name"
                                                                value="User Name">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-email">First Name</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" id="F_Name"
                                                                value="First Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-email">Last Name</label>
                                                        <div class="col-lg-10">
                                                           <input type="text" class="form-control" id="L_Name"
                                                                value="Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-email">Email</label>
                                                        <div class="col-lg-10">
                                                            <input type="email" id="email" 
                                                                class="form-control" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-password">Password</label>
                                                        <div class="col-lg-10">
                                                            <input type="password" class="form-control"
                                                                id="password" value="password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-password">Confirm Password</label>
                                                        <div class="col-lg-10">
                                                            <input type="password" class="form-control"
                                                                id="confirm_password" value="password">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"
                                                            for="example-textarea">Add. Info</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" rows="5"
                                                                id="Add_Info"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label"></label>
                                                        <div class="col-lg-10">
                                                            <button type="submit" class="btn btn-success">Create</button>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </form>
            
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div><!-- end col -->
                        </div> <!-- end card-->
                            </div><!-- end col -->
                        </div>
                                                        <div class="mt-4">
                                                            <a href="#" class="btn btn-outline-primary btn-rounded width-md"  data-dismiss="modal"><i class="uil uil-arrow-left mr-1"></i> Back</a>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                        
                        <!-- end row -->

                      <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                      <h4 class="header-title mt-0 mb-1">Reviewer/s</h4>
                                      
                                     <div class="table-responsive">
                                     <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th>User Name</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Add. Info</th>
                                                    <th>Creation Date</th>
                                                    <th colspan="3"><div align="center">Action(Edit/modify/approved/unapproved/delete)</div></th>
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
                                                <tr>
                                                  <td>012</td>
                                                  <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                    <td>2011/04/25</td>
                                                    <td>abc</td>
                                                    <td>2011/04/25</td>
                                                    <td><div align="center"><a href="javascript:void(0);"><i data-feather="edit"></i> </a></div></td>
                                                    <td><div align="center"><a href="javascript:void(0);"><i data-feather="user-check" style="color: #25b580;"></i> </a></div></td>
                                                    <td><div align="center"><a href="javascript:void(0);"><i data-feather="trash-2" style="color: #ff000f;"></i> </a></div></td>
                                                </tr>
                                                <tr>
                                                  <td>013</td>
                                                  <td>Garrett Winters</td>
                                                    <td>Accountant</td>
                                                    <td>Tokyo</td>
                                                    <td>63</td>
                                                    <td>2011/07/25</td>
                                                    <td>abc</td>
                                                    <td>2011/04/25</td>
                                                   <td><div align="center"><a href="javascript:void(0);"><i data-feather="edit"></i> </a></div></td>
                                                    <td><div align="center"><a href="javascript:void(0);"><i data-feather="user-check" style="color: #25b580;"></i> </a></div></td>
                                                    <td><div align="center"><a href="javascript:void(0);"><i data-feather="trash-2" style="color: #ff000f;"></i> </a></div></td>
                                                </tr>
                                                <tr>
                                                  <td>014</td>
                                                  <td>Tiger Nixon</td>
                                                  <td>System Architect</td>
                                                  <td>Edinburgh</td>
                                                  <td>61</td>
                                                  <td>2011/04/25</td>
                                                  <td>abc</td>
                                                  <td>2011/04/25</td>
                                                  <td><div align="center"><a href="javascript:void(0);"><i data-feather="edit"></i> </a></div></td>
                                                    <td><div align="center"><a href="javascript:void(0);"><i data-feather="user-check" style="color: #25b580;"></i> </a></div></td>
                                                    <td><div align="center"><a href="javascript:void(0);"><i data-feather="trash-2" style="color: #ff000f;"></i> </a></div></td>
                                                </tr>
                                                <tr>
                                                  <td>015</td>
                                                  <td>Garrett Winters</td>
                                                  <td>Accountant</td>
                                                  <td>Tokyo</td>
                                                  <td>63</td>
                                                  <td>2011/07/25</td>
                                                  <td>abc</td>
                                                  <td>2011/04/25</td>
                                                 <td><div align="center"><a href="javascript:void(0);"><i data-feather="edit"></i> </a></div></td>
                                                    <td><div align="center"><a href="javascript:void(0);"><i data-feather="user-check" style="color: #25b580;"></i> </a></div></td>
                                                    <td><div align="center"><a href="javascript:void(0);"><i data-feather="trash-2" style="color: #ff000f;"></i> </a></div></td>
                                                </tr>
                                                <tr>
                                                  <td>016</td>
                                                  <td>Garrett Winters</td>
                                                  <td>Accountant</td>
                                                  <td>Tokyo</td>
                                                  <td>63</td>
                                                  <td>2011/07/25</td>
                                                  <td>abc</td>
                                                  <td>2011/04/25</td>
                                                  <td><div align="center"><a href="javascript:void(0);"><i data-feather="edit"></i> </a></div></td>
                                                    <td><div align="center"><a href="javascript:void(0);"><i data-feather="user-check" style="color: #25b580;"></i> </a></div></td>
                                                    <td><div align="center"><a href="javascript:void(0);"><i data-feather="trash-2" style="color: #ff000f;"></i> </a></div></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                  </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

               