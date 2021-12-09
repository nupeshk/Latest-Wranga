<!-- Page Content -->
<div id="page-wrapper">
    <div class="overlay"></div>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-md-8 col-sm-12 col-xs-12 text-left">
                <h4>Change Password</h4>
            </div>
            <div class="col-md-8 col-sm-7 col-xs-12 text-right">			
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <?php $this->load->view('layout/message'); ?>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form class="form-horizontal" action="" method="post" id="change-password-form">                                
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label label-required">Old Password <span class="text-danger">*</span></label>
                                            <div class="col-md-9"><div class="InputField "><input type="password" name="old_password" id="old_password" value="" class="form-control input-sm" placeholder="Old Password">                                                    
                                                    <span class="form_error error text-danger" id="err_oldPassword"><?php echo form_error('old_password'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label label-required">New Password <span class="text-danger">*</span></label>
                                            <div class="col-md-9"><div class="InputField "><input type="password" name="new_password" id="new_password" value="" class="form-control input-sm" placeholder="New Password">
                                                    <span class="form_error error text-danger" id="err_newPassword"><?php echo form_error('new_password'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label label-required">Confirm Password <span class="text-danger">*</span></label>
                                            <div class="col-md-9"><div class="InputField "><input type="password" name="confirm_new_password" id="confirm_new_password" value="" class="form-control input-sm" placeholder="Confirm Password">
                                                    <span class="form_error error text-danger" id="err_confirmNewPassword"><?php echo form_error('confirm_new_password'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-9">
                                                <div class="btn-toolbar"><button type="submit" name="submit" id="submit" class="btn waves-effect btn-success pull-right">Save</button></div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.panel -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->   
</div>
<script>
    $(document).ready(function () {
        $("#change-password-form").validate({
            rules: {
                old_password: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                new_password: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                confirm_new_password: {
                    required: true,
                    equalTo: "#new_password",
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                }

            },
            messages: {
                old_password: {
                    required: "Please enter old password",
                },
                new_password: {
                    required: "Please enter new password",
                },
                confirm_new_password: {
                    required: "Please enter confirm password",
                }
            },
            errorElement: 'span',
            errorClass: 'error-msg text-danger',
            errorPlacement: function (error, element) {
                "use strict";
                error.insertAfter(element);
            },
        });
    });
</script>
</body>
</html>
