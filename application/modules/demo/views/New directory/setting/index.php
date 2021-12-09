<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-md-8 col-sm-6 col-xs-7">
                <h4 class="page-title">Setting </h4>
                <!--<ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li> 
                    <li class="active">Settings</li>
                </ol>-->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-5">
                <!--<a href="employees-add.html" class="btn btn-info">Add Employee</a>-->
            </div>
        </div>
        <!--/.row -->
        <?php $this->load->view('layout/message'); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <form name="setting-form" id="setting-form" method="post" class="" autocomplete="off">                        
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <div class="input-col">
                                        <label>Point Per Liter</label>
                                        <input type="text" class="form-control" name="pointPerLiter" value="<?php echo $settingData['pointPerLiter']; ?>" id="pointPerLiter" placeholder="Ex. Abc" autocomplete="off">                                        
                                    </div>
                                    <span class="form_error error text-danger" id="err_pointPerLiter"></span>
                                </div>                              
                            
                                <div class="form-group">
                                    <div class="input-col">
                                        <label>Value Per Point</label>
                                        <input type="text" class="form-control" name="valuePerPoint" value="<?php echo $settingData['valuePerPoint']; ?>" id="valuePerPoint" placeholder="Ex. abc" autocomplete="off">
                                    </div>
                                    <span class="form_error error text-danger pull-left" id="err_valuePerPoint"></span>
                                </div>
                            
                                <div class="form-group">
                                    <button type="submit" class="btn btn-yellow pull-right">Save</button>
                                </div>                          
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <!--/.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<script>
    $(document).ready(function () {
        $("#setting-form").validate({
            rules: {
                pointPerLiter: {
                    required: true,
                    number:true,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                valuePerPoint: {
                    required: true,
                    number:true,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                }
            },
            messages: {
                pointPerLiter: {
                    required: "Please enter point",
                },
                valuePerPoint: {
                    required: "Please enter value per point",
                }
            },
            errorElement: 'span',
            errorClass: 'error-msg text-danger',
            errorPlacement: function (error, element) {
                "use strict";
                error.appendTo($("#err_" + element.attr("name")));
                //error.insertAfter(element);
            }
        });
    });
</script>
