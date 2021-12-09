

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row page-title align-items-center">
                            <div class="col-sm-4 col-xl-6">
                                <h4 class="mb-1 mt-0">All Mobile Users</h4>
                            </div>
                            <div class="col-sm-8 col-xl-6">
                                <form class="form-inline float-sm-right mt-3 mt-sm-0">
                                    <div class="form-group mb-sm-0 mr-2">
                                        <input type="text" class="form-control" id="dash-daterange" style="min-width: 190px;" />
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class='uil uil-file-alt mr-1'></i>Download
                                            <i class="icon"><span data-feather="chevron-down"></span></i></button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item notify-item">
                                                <i data-feather="mail" class="icon-dual icon-xs mr-2"></i>
                                                <span>Email</span>
                                            </a>
                                            <a href="#" class="dropdown-item notify-item">
                                                <i data-feather="printer" class="icon-dual icon-xs mr-2"></i>
                                                <span>Print</span>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item notify-item">
                                                <i data-feather="file" class="icon-dual icon-xs mr-2"></i>
                                                <span>Re-Generate</span>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                      <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-1">User's Locations</h4>
                                        <p class="sub-header">                                                                              </p>
    
                                        <div class="table-responsive">
                                           <iframe src="https://www.google.com/maps/d/embed?mid=1QE-RXSD2SS1RO7tkE23rRlqRYMY" width="100%" height="400"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- content -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-1">Mobile Users</h4>
                                        <p class="sub-header">
                                                                              </p>
    
                                        <div class="table-responsive">
                                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>name</th>
                                                        <th>email</th>
                                                        <th>Logintype</th>
                                                        <th>createdDate</th>
                                                        <th>Active</th>
                                                        <th>Token</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                  <?php $sn=1;
                                                  foreach ($mobileusersList as $key => $list) { ?>

                                                    <tr>
                                                        <th scope="row"><?=$sn?></th>
                                                        <td><?=$list->name?></td>
                                                        <td><?=$list->email?></td>
                                                        <td><?=$list->socialid?></td>
                                                        <td><?=$list->createdDate?></td>
                                                        <td><div class="col-lg-10">
                                                            <input type="submit" class="btn btn-success" value="Inactive">
                                                        </div></td>
                                                        <td>asdksgd5w6</td>
                                                        
                                                    </tr>
                                                   <?php $sn++; } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- stats + charts -->
                     
                

                    </div>
                </div> 
                </div>
                <!-- content -->