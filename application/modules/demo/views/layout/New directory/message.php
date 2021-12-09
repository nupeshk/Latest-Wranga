<?php if (!empty($this->session->flashdata('success'))) { ?>
    <div class="alert alert-success alert-dismissible login_error" id="clientDiv">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:#000;">&times;</button>
        <h5 style="color:#FFF;"><?php echo $this->session->flashdata('success'); ?></h5>            
    </div>
<?php } ?>
<?php if (!empty($this->session->flashdata('error'))) { ?>
    <div class="alert alert-danger alert-dismissible login_error">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:#000;">&times;</button>
        <h5 style="color:#FFF;"><?php echo $this->session->flashdata('error'); ?></h5>            
    </div>
<?php } ?>