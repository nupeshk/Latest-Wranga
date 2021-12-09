
<div id="alert-error" class="myadmin-alert alert-danger myadmin-alert-top-right" style="display: none;"> 
    <a href="#" class="closed">x</a>
    <p id="message"></p>
</div>
<div id="alert-success" class="myadmin-alert alert-success myadmin-alert-top-right" style="display: none;"> 
    <a href="#" class="closed">x</a>
    <p id="message"></p>
</div>
<div id="alert-info" class="myadmin-alert alert-info myadmin-alert-top-right" style="display: none;"> 
    <a href="#" class="closed">x</a>
    <p id="message"></p>
</div>

<div id="loverlay" class="loading-overlay">
	<div class="loading-text"><img src="<?php echo base_url(); ?>public/images/busy.gif" alt="loading"> <h2>Please Wait ...</h2></div>
</div>
<!--------- ****************************** -------->
<!--------- Delete Process For All Section -------->
<!--------- ****************************** -------->
<script>
    function showAlert(type, message) {
        $("#alert-" + type).fadeIn("slow");
        $("#alert-" + type + " #message").text(message);
        setInterval(function () {
            $(".myadmin-alert").fadeOut('slow');
        }, 3000);
    }
    function changeLabelStatus(action, userId, url) {
        var status = $("#" + action + "_" + userId).val();
        if (action == "label") {
            var data = {"labelId": userId, "labelVal": status};
        } else {
            var data = {StatusId: userId, StatusVal: status};
        }
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/" + url,
            data: data,
            beforeSend: function () {
                //$("#confirmLabelUpdate").attr("disabled", true).text('Please wait...');
            },
            success: function (data)
            {
                //alert(data);return false;
                var returnedData = JSON.parse(data);
                if (returnedData['success_code'] == 200) {
                    if (status == "1") {
                        $("#" + action + "_" + userId).val("0");
                    } else {
                        $("#" + action + "_" + userId).val("1");
                    }
                    showAlert("success", returnedData['message']);
                } else {
                    showAlert("error", returnedData['message']);
                }
            }
        });
    }
    function openModal(deleteId, Url, view_delete) {
        $("#confirmModal").modal("show");
        $("#deleteId").val(deleteId);
        $("#Url").val(Url);
        $("#view_delete").val(view_delete);
    }
    $(document).on('click', '#confirmOk', function (e) {
        var DeleteId = $("#deleteId").val();
        var Url = $("#Url").val();
        var View = $("#view_delete").val();
        var url = $("#Url").val().split('/');
        //alert(url[0]);return false;        	  
        //My code to delete
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/" + Url,
            data: {"DeleteId": DeleteId},
            beforeSend: function () {
                $("#confirmOk").attr("disabled", true).text('Please wait...');
            },
            success: function (data)
            {
                //alert(data);return false();
                var returnedData = JSON.parse(data);
                if (returnedData['success_code'] == 200) {
                    if (View == 'view') {
                        window.location.href = "<?php echo base_url(); ?>admin/" + url[0];
                    }
                    $('#removeRow_' + DeleteId).remove();
                    $("#confirmOk").attr("disabled", false).text('Ok');
                    $("#confirmModal").modal("hide");
                    showAlert("error", returnedData['message']);
                    //$("#messageDiv").html();
                    //location.reload();
                    var tbl = $('#myTable').DataTable();
                    //var pageInfo = JSON.stringify(tbl.page.info());
                    var pageInfo = tbl.page.info();
                    var start = pageInfo.start;
                    var pcount = start + 1;
                    //alert(pcount);
                    $('#myTable tbody tr td.delete_row').each(function () {
                        $(this).text(pcount);
                        pcount++;
                    });
                } else {
                    showAlert("error", returnedData['message']);
                }
            }
        });

    });
</script>
<!--------- ************************************* -------->
<!--------- Update Status Process For All Section -------->
<!--------- ************************************* -------->
<script>
    function openStatus_Modal(statusId, statusVal, Url) {
        $("#confirmStatusModal").modal("show");
        $("#statusId").val(statusId);
        $("#statusVal").val(statusVal);
        $("#Url").val(Url);
    }
    $(document).on('click', '#confirmUpdate', function (e) {
        var StatusId = $("#statusId").val();
        var StatusVal = $("#statusVal").val();
        var Url = $("#Url").val();
        //My code to delete
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/" + Url,
            data: ({StatusId: StatusId, StatusVal: StatusVal}),
            beforeSend: function () {
                $("#confirmUpdate").attr("disabled", true).text('Please wait...');
            },
            success: function (data)
            {
                //alert(data);return false;
                var returnedData = JSON.parse(data);
                if (returnedData['success_code'] == 200) {
                    if (StatusVal == "1") {
                        var text = "<a href='javascript:void(0);' class='btn-danger btn' style='cursor: pointer; width:87px;'>Deactivate</a>";
                        var text1 = "Deactivate";
                        var func = "openStatus_Modal(" + StatusId + ", 0, 'migrants/changestatus')";
                    } else {
                        var text = "<a href='javascript:void(0);' class='btn-success btn' style='cursor: pointer; width:87px;'>Activate</a>";
                        var text1 = "Activate";
                        var func = "openStatus_Modal(" + StatusId + ", 1, 'migrants/changestatus')";
                    }
                    $('#statusData_' + StatusId).attr("onclick", func).html(text);
                    $('#view-status-btn').attr("onclick", func).html(text1);
                    $('#view-status').html(text1);
                    $("#confirmUpdate").attr("disabled", false).text('Ok');
                    $("#confirmStatusModal").modal("hide");
                }

            }
        });

    });
</script>
<!--------- ************************************* -------->
<!--------- Update Label Process For All Section -------->
<!--------- ************************************* -------->
<script>
    function openLabel_Modal(labelId, labelVal, Url) {
        $("#confirmLabelModal").modal("show");
        $("#labelId").val(labelId);
        $("#labelVal").val(labelVal);
        $("#Url").val(Url);
    }
    $(document).on('click', '#confirmLabelUpdate', function (e) {
        var labelId = $("#labelId").val();
        var labelVal = $("#labelVal").val();
        var Url = $("#Url").val();
        //My code to delete
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/" + Url,
            data: ({labelId: labelId, labelVal: labelVal}),
            beforeSend: function () {
                $("#confirmLabelUpdate").attr("disabled", true).text('Please wait...');
            },
            success: function (data)
            {
                //alert(data);return false;
                var returnedData = JSON.parse(data);
                if (returnedData['success_code'] == 200) {
                    if (labelVal == "1") {
                        var text = "<a href='javascript:void(0);' class='btn-danger btn' style='cursor: pointer; width:65px;'>Disable</a>";
                        var text1 = "Disable";
                        var func = "openLabel_Modal(" + labelId + ", 0, 'migrants/changelabel')";
                    } else {
                        var text = "<a href='javascript:void(0);' class='btn-success btn' style='cursor: pointer; width:65px;'>Enable</a>";
                        var text1 = "Enable";
                        var func = "openLabel_Modal(" + labelId + ", 1, 'migrants/changelabel')";
                    }
                    $('#labelData_' + labelId).attr("onclick", func).html(text);
                    $('#view-status-btn').attr("onclick", func).html(text1);
                    $('#view-status').html(text1);
                    $("#confirmLabelUpdate").attr("disabled", false).text('Ok');
                    $("#confirmLabelModal").modal("hide");
                }

            }
        });

    });
</script>
<!--------- ********************************************* -------->
<!--------- For Numeric Value Type Like Phone and Zipcode -------->
<!--------- ********************************************* -------->
<script>
    function onlyNumber(txbValue) {
        txbValue.value = txbValue.value.replace(/\D/g, '');

    }
</script>
<!--------- ********************************************* -------->
<!--------- For Select Multiple Check Boxes Onclick -------->
<!--------- ********************************************* -------->
<script>
    function masterCheckBox() {
        //"select all" change
        $(".child_checkbox").each(function () {
            if (!(this.disabled)) {
                if ($("#master_checkbox").is(":checked")) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            }
        });
    }

    function checkedBoxes() {
        //select all checkboxes        
        $('.child_checkbox').change(function () {
            //uncheck "select all", if one of the listed checkbox item is unchecked
            var checked_len = $('.child_checkbox:checked').not(':disabled').length;
            var len = $('.child_checkbox').not(':disabled').length;
            //check "select all" if all checkbox items are checked
            if (checked_len == len) {
                $("#master_checkbox").prop('checked', true);
            } else {
                $("#master_checkbox").prop('checked', false);
            }
        });
    }
</script>
<!--------- ************************************* -------->
<!--------- Open Survey Model To Send Survey To Users -------->
<!--------- ************************************* -------->
<script>
    function openSurvey_Modal() {
        if ($('#master_checkbox').is(':checked')) {
            $("#myModal").modal("show");
        } else if (!$('#master_checkbox').is(':checked')) {
            if ($('.child_checkbox:checked').length != 0) {
                $("#myModal").modal("show");
            } else {
                alert("Please select at least one user.");
                return false;
            }
        }
    }
</script>
<!--------- ************************************* -------->
<!--------- Open Survey Model To Send Survey To Users -------->
<!--------- ************************************* -------->
<script>
    function openMessage_Modal() {
        if ($('#master_checkbox').is(':checked')) {
            $("#myModal").modal("show");
        } else if (!$('#master_checkbox').is(':checked')) {
            if ($('.child_checkbox:checked').length != 0) {
                $("#myModal").modal("show");
            } else {
                alert("Please select at least one user.");
                return false;
            }
        }
    }
</script>
<!--------- ************************************* -------->
<!--------- Open Tag Model To Add Tag To Users -------->
<!--------- ************************************* -------->
<script>
    function openTag_Modal() {
        if ($('#master_checkbox').is(':checked')) {
            $("#tagline").modal("show");
        } else if (!$('#master_checkbox').is(':checked')) {
            if ($('.child_checkbox:checked').length != 0) {
                $("#tagline").modal("show");
            } else {
                alert("Please select at least one user.");
                return false;
            }
        }
    }
</script>
<!--------- ************************************* -------->
<!--------- Send Survey To Users -------->
<!--------- ************************************* -------->
<script>
    $(document).ready(function () {
        $('#surveySend').click(function () {
            if ($('#master_checkbox').is(':checked')) {
                var master_value = $('#master_checkbox').val();
                var totalUsers = $('#pageInfo').val();
                //alert(pageInfo);return false;
                if ($('.child_checkbox:checked').length != 0) {
                    var userIds = $("input[name='userId[]']:checked").map(function () {
                        return this.value;
                    }).get();
                } else {
                    var userIds = "";
                }
            } else if (!$('#master_checkbox').is(':checked')) {
                if ($('.child_checkbox:checked').length != 0) {
                    var userIds = $("input[name='userId[]']:checked").map(function () {
                        return this.value;
                    }).get();
                    var master_value = "";
                } else {
                    alert("Please select at least one user.");
                    return false;
                }
            }
            var surveyId = $('#surveyId').val();
            var userType = $('#userType').val();
            var totalUsers = $('#pageInfo').val();
            //alert(totalUsers);return false;

            if (surveyId == '') {
                $('#error').show();return false;
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>admin/surveys/sendsurvey",
                data: {"value": master_value, "surveyId": surveyId, "userType": userType, "userIds": userIds},
                beforeSend: function () {
                    $("#surveySend").attr("disabled", true).text('Please wait...');
                },
                success: function (data)
                {
                    $("#surveySend").attr("disabled", false).text('Send');
                    var returnedData = JSON.parse(data);
                    var sendUser = returnedData['totalUser'];
                    //alert(returnedData['totalUser'])
                    $(".child_checkbox").removeClass(".child_checkbox").prop('checked', false);
                    $("#master_checkbox").prop('checked', false);                    
                    $('#surveyId').val('');

                    if (returnedData['success_code'] == 200) {
                        showAlert("success", returnedData['message']);
                    } else {
                        showAlert("error", returnedData['message']);
                    }
                    var alreadySent = parseInt(totalUsers) - parseInt(sendUser);
                    var sent = sendUser;
                    $("#msg").show().text("Sent to " + sent + " user");
                    $("#error").show().text("Alredy sent to " + alreadySent + " user");
                    setTimeout(function () {
                        $("#myModal").modal("hide");                       
                    }, 3000);
                }
            });

        });
    });
</script>

<!--------- ************************************* -------->
<!--------- Reset Password For Migrant Section -------->
<!--------- ************************************* -------->
<script>
    function openResetPasswordModal(userId, url) {
        $("#resetPasswordModal").modal("show");
        $("#userId").val(userId);
        $("#url").val(url);
    }
    $(document).on('click', '#resetOk', function (e) {
        var userId = $("#userId").val();
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();
        var url = $("#url").val();

        if (password == '') {
            $('#errorPassword').show().text("Enter password");            
            return false;
        } else if (confirmPassword == '') {
            $('#errorCpassword').show().text("Enter confirm password");
            $('#errorPassword').hide();
            return false;
        } else if (confirmPassword != password) {
            $('#errorCpassword').show().text("Password and confirm password should be equal");
            return false;
        } else

        //My code to reset password
        {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>admin/" + url,
                data: ({userId: userId, password: password}),
                beforeSend: function () {
                    $("#resetOk").attr("disabled", true).text('Please wait...');
                },
                success: function (data)
                {
                    //alert(data);return false;
                    var returnedData = JSON.parse(data);
                    if (returnedData['success_code'] == 200) {
                        $("#resetOk").attr("disabled", false).text('Ok');
                        $("#resetPasswordModal").modal("hide");
                        $("#password").val('');
                        $("#confirmPassword").val('');
                        $("#errorCpassword").hide();
                        showAlert("success", returnedData['message']);
                    } else {
                        showAlert("error", returnedData['message']);
                    }
                }
            });
        }

    });
</script>
<footer class="footer text-center"> &copy; Copyright 2019 Pooja filling station </footer>

</body>
</html>
