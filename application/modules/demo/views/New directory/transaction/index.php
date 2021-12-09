<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">Transaction History </h4>
                <!--<ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                    <li class="active">Hosts </li>
                </ol> -->
            </div> 
             <div class="col-md-6 col-sm-6 col-xs-12 text-right">                
                <!-- <a href="javascript:void(0);" class="btn btn-success m-t-10 m-r-15" onclick="openTag_Modal();">Add Study Stage</a>                
                 <a href="javascript:void(0);" class="btn btn-success m-t-10 m-r-15" onclick="openSurvey_Modal();">Send Survey</a>-->
                 <a href="javascript:void(0);" id="export" onclick="exportData();" class="btn btn-yellow openTag_Modal m-t-10"><i class="fa fa-download"></i> Export</a>  
             </div>           
        </div>
        <!--/.row -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="white-box">
					<input type="hidden" name="userId" id="userId" value="<?php echo $userId; ?>">
                    <form name="searchForm" id="searchForm" class="search-form form-inline pull-right" action="" method="POST">
                        <!-- <div class="form-group m-r-15">
                             <select class="form-control" name="orderBy" id="orderBy" onchange="searchFilter()">
                                 <option value="">Order By</option>
                                 <option value="u.fullName">Name</option>
                                 <option value="u.lastLogin">Last Active</option>
                             </select>
                         </div>                        
                         <div class="form-group m-r-15">
                             <select class="form-control" name="order" id="order" onchange="searchFilter()">
                                 <option value="">Select Sort</option>
                                 <option value="ASC" <?php echo (isset($post['order']) && ($post['order'] == 'ASC')) ? "selected" : "" ?>>ASC</option>
                                 <option value="DESC" <?php echo (isset($post['order']) && ($post['order'] == 'DESC')) ? "selected" : "" ?>>DESC</option>
 
                             </select>
                         </div>
                         <div class="form-group m-r-15">                            
                        <?php //$this->load->view('layout/monthSelect'); ?>
                         </div>
                         <div class="form-group m-r-15">                            
                             <select class="form-control" name="year" id="year" onchange="searchFilter();">
                                 <option value="">Select Year</option>
                        <?php
                        for ($year = date("Y"); $year >= 2017; $year--) {
                            ?>
                                         <option value="<?php echo $year; ?>" <?php echo (!empty($_GET['y']) && ($_GET['y'] == $year)) ? "selected" : "" ?>><?php echo $year; ?></option>
                        <?php } ?>                                
                             </select>                            
                         </div> -->
                         <div class="form-group">                        
                            <input type="text" name="sTransactionDate" id="sTransactionDate" value="<?php echo isset($post['sTransactionDate']) && !empty($post['sTransactionDate']) ? $post['sTransactionDate'] : ""; ?>" placeholder="Start Date" class="form-control" onchange="searchFilter();">
                        </div>
                        <div class="form-group">                        
                            <input type="text" name="eTransactionDate" id="eTransactionDate" value="<?php echo isset($post['eTransactionDate']) && !empty($post['eTransactionDate']) ? $post['eTransactionDate'] : ""; ?>" placeholder="End Date" class="form-control" onchange="searchFilter();">
                        </div>
                        <div class="form-group">                        
                            <input type="search" name="search" id="search" value="<?php echo isset($post['search']) && !empty($post['search']) ? $post['search'] : ""; ?>" placeholder="Search" class="form-control" onblur="searchFilter();">
                            <button type="submit" name="submit" id="searchData" value=""><i class="fa fa-search"></i></button>
                        </div>
                    </form>                    
                    <div class="table-responsive" id="transactionList">
                        <h3 class="box-title m-b-40 font-normal" id="page-info"><?php echo $pageInfo; ?></h3>
                        <table id="example1" class="table table">
                            <thead>
                                <tr>
                                    <th align="left" style="text-align: left;">Vehicle Number</th>
                                    <th align="left" style="text-align: left;">Vehicle Type</th>
                                    <th align="left">Transaction Date</th>
                                    <th align="left">Bill Number</th>
                                    <th align="left">Quantity</th>
                                    <th align="left">Points</th>
                                    <th align="left">Transaction Type</th>
                                    <th align="left">Remarks</th>
                                    <!--<th align="left">Action</th>-->
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($transArr)) {
                                    foreach ($transArr as $result) {
                                       // printArr($result);
										$transaction = "";
										if($result["transactionType"] == "add" && $result["transactionStatus"] == "1"){
											$transaction = "Added";
										} else if($result["transactionType"] == "add" && $result["transactionStatus"] == "2"){
											$transaction = "Cancelled";
										} else if($result["transactionType"] == "redeem" && $result["transactionStatus"] == "1"){
											$transaction = "Redeemed";
										}
                                        ?>
                                        <tr id="removeRow_<?php echo $result['transactionId']; ?>">
                                            <td align="left" class="txt-oflo"><?php echo $result['vehicleNumber']; ?></td>
                                            <td align="left" class="txt-oflo"><?php echo ucwords($result['vehicleType']); ?></td>                                   
                                            <td align="left" class="txt-oflo"><?php echo $result['transactionDate']; ?></td>
                                            <td align="left" class="txt-oflo"><?php echo $result['billNumber']; ?></td>
                                            <td align="left" class="txt-oflo"><?php echo $result['quantity']; ?></td>
                                            <td align="left" class="txt-oflo"><?php echo $result['points']; ?></td>                                    
                                            <td align="left" class="txt-oflo"><?php echo $transaction; ?></td>
                                            <td align="left" class="txt-oflo"><?php echo $result['remarks']; ?></td> 
                                            <!--<td align="center">
                                                <a href="#" class="btn-info btn btn-sm">View</a>  
                                                <button class="btn btn-danger" onClick="openModal(<?php //echo $result['userId']; ?>, 'bartender/delete')" id="<?php //echo $result['userId']; ?>"><i class="fa fa-trash"></i></button>                                    
                                            </td> -->
                                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td width="200" align="center" class="txt-oflo" colspan="12">Data is not available.</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php echo $this->ajax_pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row -->
    </div>
    <!-- /.container-fluid -->	  
</div>


<!-- Change Status Modal confirm -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Bartender</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    Are you sure you want to delete this bartender ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="confirmCancel">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok" id="confirmOk">Ok</button>
                </div>
                <input type="hidden" name="deleteId" id="deleteId" value="">               
                <input type="hidden" name="Url" id="Url" value="">
            </form>
        </div>
    </div>
</div>
<!--------- For Search bartender Data  -------->
<script>
	$(document).ready(function(){
		 $('.datepicker').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            todayHighlight: true,
            //maxDate: new Date(),    
            endDate: '+0d',
            clearBtn: true
        }); 
        
        $("#sTransactionDate").datepicker({
            todayHighlight: true,
            autoclose: true,
            clearBtn: true,
            format: "dd-mm-yyyy",
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#eTransactionDate').datepicker('setStartDate', minDate);
        });

        $("#eTransactionDate").datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            clearBtn: true,
            //endDate: '+0d',
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#sTransactionDate').datepicker('setEndDate', minDate);
        });
        
	});

    function searchFilter(page_num) {
        page_num = page_num ? page_num : 0;
        var search = $('#search').val();
        var month = $('#month').val();
        var year = $('#year').val();
        var order = $('#order').val();
        var orderBy = $('#orderBy').val();
        var tag = $('#tag').val();
        var userId = $('#userId').val();
        var sTransactionDate = $('#sTransactionDate').val();
        var eTransactionDate = $('#eTransactionDate').val();
        //alert(year);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/transaction/getajax/' + page_num,
            data: 'page=' + page_num + '&search=' + search + '&userId='+userId + "&sTransactionDate="+sTransactionDate + "&eTransactionDate="+eTransactionDate,
            beforeSend: function () {
                $('.loading').show();
            },
            success: function (html) {
                $('#transactionList').html(html);
                $('.loading').fadeOut("slow");
            }
        });
    }

	function exportData() {
        var search = $('#search').val();  
        var userId = $('#userId').val();      
        var sTransactionDate = $('#sTransactionDate').val();
        var eTransactionDate = $('#eTransactionDate').val();     
        //alert(status);return false;
        window.location.href = '<?php echo base_url(); ?>admin/transaction/export?search=' + search+ '&userId='+userId+ '&sTransactionDate='+sTransactionDate + '&eTransactionDate='+eTransactionDate;        
    }
</script>
