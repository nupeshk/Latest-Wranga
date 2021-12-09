

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
                                                        <th>#</th>
                                                        <th>name</th>
                                                        <th>email</th>
                                                        <th>socialid</th>
                                                        <th>longitude/latitude</th>
                                                        <th>status</th>
                                                        <th>createdDate</th>
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
                                                        <td><?=$list->longitude?>/<?=$list->latitude?></td>
                                                        <td><?=$list->status?></td>
                                                        <td><?=$list->createdDate?></td>
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
                </div> <!-- content -->