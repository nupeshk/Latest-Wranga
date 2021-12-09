<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">Users </h4>
                <!--<ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                    <li class="active">Hosts </li>
                </ol> -->
            </div> 
            <div class="col-md-6 col-sm-6 col-xs-12 text-right">                
                 <!--<a href="javascript:void(0);" class="btn btn-success m-t-10 m-r-15" onclick="openTag_Modal();">Add Study Stage</a>                
                   <a href="javascript:void(0);" class="btn btn-success m-t-10 m-r-15" onclick="openSurvey_Modal();">Send Survey</a>--> 
                   <a href="javascript:void(0);" id="export" onclick="exportData();" class="btn btn-yellow openTag_Modal m-t-10"><i class="fa fa-download"></i> Export</a>  
               </div>          
           </div>
           <!--/.row -->
           <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <form name="searchForm" id="searchForm" class="search-form form-inline pull-right" action="" method="POST">
                        <div class="form-group">                        
                            <input type="search" name="search" id="search" value="<?php echo isset($post['search']) && !empty($post['search']) ? $post['search'] : ""; ?>" placeholder="Search" class="form-control" onblur="searchFilter();">
                            <button type="submit" name="submit" id="searchData" value=""><i class="fa fa-search"></i></button>
                        </div>
                    </form>                    
                    <div class="table-responsive" id="userList">
                        <h3 class="box-title m-b-40 font-normal" id="page-info"><?php echo $pageInfo; ?></h3>
                        <table id="example1" class="table table">
                            <thead>
                                <tr>
                                    <!--<th align="left" style="text-align: left;">User Id</th> -->
                                    <th align="left" style="text-align: left;">First Name</th>
                                    <th align="left" style="text-align: left;">Last Name</th>
                                    <th align="left">Email</th>
                                    <th align="left">Mobile</th>
                                    <th align="left">DOB</th>
                                    <th align="left">Total Points</th>
                                    <th align="left">Last Transation Date</th>
                                    <!--<th align="left">Is Active</th>-->
                                    <th align="left">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($userArr)) {
                                    foreach ($userArr as $result) {
                                         //printArr($result);

                                        ?>
                                        <tr id="removeRow_<?php echo $result['userId']; ?>">
                                            <!--<td align="left" class="txt-oflo"><?php //echo $result['userId'];     ?></td> -->
                                            <td align="left" width="200" class="txt-oflo">
                                                <!--<img src="<?php echo $result['photo']; ?>" class="img-circle user-icon" width="36px" height="36px" alt="user">-->
                                                <a href="#"><?php echo ucwords($result['firstName']); ?></a> 
                                            </td>      
                                            <td align="left" class="txt-oflo"><?php echo ucwords($result['lastName']); ?></td>
                                            <td align="left" class="txt-oflo"><?php echo $result['email']; ?></td>
                                            <td align="left" class="txt-oflo"><?php echo $result['mobile']; ?></td>
                                            <td align="left" class="txt-oflo"><?php echo $result['dob']; ?></td>
                                            <td align="left" class="txt-oflo"><?php echo $result['totalPoints']; ?></td>   
                                            <td align="left" class="txt-oflo"><?php echo $result['lastTransactionDate']; ?></td>                                 
                                            <!--<td align="left" class="txt-oflo">
                                                <label class="switch">
                                                    <input type="checkbox" id="status_<?php echo $result['userId']; ?>" onclick="changeLabelStatus('status', <?php echo $result['userId']; ?>, 'users/changestatus')" value="<?php echo $result['status']; ?>" <?php echo ($result['status'] == '1') ? "checked" : ""; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>  -->                                  
                                            
                                            <td align="left">
                                                <!--<a href="<?php //echo base_url(); ?>admin/users/generateidcard/<?php //echo $result['userId']; ?>" download class="btn btn-yellow btn-sm"><i class="fa fa-download"></i></a>  -->
                                                <button type="button" onClick="editUserModal('<?php echo $result['userId']; ?>')" class="btn btn-yellow btn-sm" title="Edit User"><i class="fa fa-edit"></i></button>
                                                <a href="<?php echo base_url(); ?>admin/transaction/<?php echo $result['userId']; ?>" title="Transaction History" class="btn btn-yellow btn-sm"><i class="fa fa-exchange"></i></a>
                                                <button class="btn btn-danger btn-sm" title="Delete" onClick="openModal(<?php echo $result['userId']; ?>, 'users/delete')" id="<?php echo $result['userId']; ?>"><i class="fa fa-trash"></i></button>                                    
                                            </td>
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
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalTitle">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <input type="hidden" name="deleteId" id="deleteId" value="">               
                <input type="hidden" name="Url" id="Url" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-yellow" id="confirmOk">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalTitle">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" method="post" id="user-form" name="user-form"> 
                <div class="modal-body">
                    <input type="hidden" name="userId" id="userId" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" name="firstName" id="firstName" class="form-control" required value="" autofocus>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" name="lastName" id="lastName" class="form-control" required value="" autofocus>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="" autofocus>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" name="mobile" id="mobile" class="form-control" required value="" autofocus>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse" data-dismiss="modal">Close</button>
                    <button type="submit" id="edit_submit" name="edit_submit" class="btn btn-yellow">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--------- For Search Host Data  -------->
<script>

    $(document).ready(function () {
        $("#user-form").validate({
            ignore:[],
            rules: {
                firstName: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                lastName: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                email: {
                    email: {
                        depends: function (element) {
                            return $('#email').val().length > 0
                        }
                    },
                    remote: {
                        url: "<?php echo base_url() ?>admin/users/checkemail",
                        type: "post",
                        data: {
                            userId: function()
                            {
                                return $('#userId').val();
                            }
                        },
                    },
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                },
                mobile: {
                    required: true,
                    number:true,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    remote: {
                        url: "<?php echo base_url() ?>admin/users/checkmobile",
                        type: "post",
                        data: {
                            userId: function()
                            {
                                return $('#userId').val();
                            }
                        },
                    }
                }
            },
            messages: {
                firstName: {
                    required: "Please enter first name",
                },
                lastName: {
                    required: "Please enter last name",
                },
                email: {
                    required: "Please enter email",
                    email: "Please enter valid email",
                     remote: "Email already exists."
                },
                mobile: {
                    required: "Please enter mobile",
                    remote: "Mobile already exists."
                }

            },
            errorElement: 'span',
            errorClass: 'error-msg text-danger',
            errorPlacement: function (error, element) {
                "use strict";
                //error.appendTo($("#err_" + element.attr("name")));
                error.insertAfter(element);
            },
            submitHandler: function (form, evt) {
                evt.preventDefault();
                var userId = $("#userId").val();
                var url = "<?php echo base_url() ?>admin/users/edit";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $(form).serialize(),
                    //cache: false,
                    //processData: false,
                    beforeSend: function () {
                        $("#edit_submit").attr("disabled", true).text('Please wait...');
                    },
                    success: function (data) {
                        var returnedData = JSON.parse(data);
                        if (returnedData['success_code'] == 200) {
                            showAlert("success", returnedData['message']);
                            $("#edit_submit").attr("disabled", false).text('Submit');
                            $("#userModal").modal("hide");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            showAlert("error", returnedData['message']);
                        }

                    }
                });
                return false;
            }
        });
    });

    function editUserModal(userId) {
        $("#userModal").modal("show");
        var firstName = $("#removeRow_" + userId).find("td").eq(0).text();
        var lastName = $("#removeRow_" + userId).find("td").eq(1).text();
        var email = $("#removeRow_" + userId).find("td").eq(2).text();
        var mobile = $("#removeRow_" + userId).find("td").eq(3).text();
        $("#userModal #firstName").val($.trim(firstName));
        $("#userModal #lastName").val(lastName);
        $("#userModal #mobile").val(mobile);
        $("#userModal #email").val(email);
        $("#userModal #userId").val(userId);
    }


    function searchFilter(page_num) {
        page_num = page_num ? page_num : 0;
        var search = $('#search').val();
        var month = $('#month').val();
        var year = $('#year').val();
        var order = $('#order').val();
        var orderBy = $('#orderBy').val();
        var tag = $('#tag').val();
        //alert(year);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/users/getajax/' + page_num,
            data: 'page=' + page_num + '&search=' + search,
            beforeSend: function () {
                $('.loading').show();
            },
            success: function (html) {
                $('#userList').html(html);
                $('.loading').fadeOut("slow");
            }
        });
    }
    
    function exportData() {
        var search = $('#search').val();        
        //alert(status);return false;
        window.location.href = '<?php echo base_url(); ?>admin/users/export?search=' + search;        
    }

</script>
