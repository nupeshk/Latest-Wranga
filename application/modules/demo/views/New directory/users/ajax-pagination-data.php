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
                                                <button class="btn btn-danger btn-sm" onClick="openModal(<?php echo $result['userId']; ?>, 'users/delete')" id="<?php echo $result['userId']; ?>"><i class="fa fa-trash"></i></button>                                    
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
                        <input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
