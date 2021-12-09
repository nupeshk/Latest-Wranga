<?php
$baseUrl = "http://poojaiocl.appsmediaz.com/api/v1/";
?>
<html>
<head>
    <title>Pooja IOCL :: Web-Service Detail </title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script>
        $(function () {
            var availableTags = [
            "customer-registration",
            'login',
            'logout',
            'forget-password',
            'search-customer',
            'search-transaction',
            'add-transaction',
            'cancel-transaction'
            ];
            $("#serviceName").autocomplete({
                source: availableTags,
                select: function (event, ui) {
                    var selectedObj = ui.item;
                    setContent(selectedObj.value);
                        //alert(selectedObj.value);
                    }
                });
        });
    </script>
</head>
<body>
    <div id="searchbycharacter">
        <div class="service" style="padding-bottom: 5px;border-bottom: 2px solid #8E9CB2">
            Enter Service Name : <input type="text" id="serviceName" name="serviceName">
        </div>
    </div>

        <!-- <div class="main mainclear">
             <div class="clear"><b>Production URL :</b> http://139.59.16.146/quikcatalog_prod/api/</div>
             <div class="clear">    <b>Development URL :</b> http://139.59.16.146/quikcatalog_dev/api/</div>
         </div> -->

         <div id="">
            <!-- <div class="service" style="padding-bottom: 5px;border-bottom: 2px solid #8E9CB2">
                 <div>success = 0 problem in request</div>
                 <div>success = 1 success request</div>
                 <div>success = 2 no record found</div> 
                 <div>success = 4 Authentication failed</div> 
                 <div>success = 5 Your account is blocked</div> 
             </div>-->
         </div>
         <div id="login" class="main mainclear">
            <div class="service"><b>Service Name :</b>Login</div>
            <div class="clear">
                <b>Method:</b> <strong>POST</strong>
            </div>
            <div class="clear">
                <b>Url:</b> <?php echo $baseUrl; ?>login
            </div>
            <div class="clear">
                <b>Request Param:</b>email, password,  deviceType, deviceToken,
            </div>

            <div class="clear">
                <b>Response:</b>{
                "code": 200,
                "status": "success",
                "message": "Login successfull",
                "adminData": {
                "adminId": "1",
                "adminName": "Pooja Filling Station",
                "adminEmail": "admin@poojafillingstation.com",
                "token": "e40a26d6dafee2b7a6186b6a8dbfbebc2302ee429609625f90800681e9ec4f9c"
            }
        }
    </div>
    <div class="clear">
        <b>Mandatory:</b> email, password, deviceType
    </div>
    <div class="clear">
        <b>Note:</b> deviceType =  1 = IOS , deviceType = 2 = Android
    </div>
    <div class="clear">
        <b>Note:</b> all the params will be form-data
    </div>
</div>

<div id="customer-registration" class="main mainclear">
    <div class="service"><b>Service Name :</b>Customer Registration</div>
    <div class="clear">
        <b>Method:</b> POST
    </div>
    <div class="clear">
        <b>Url:</b> <?php echo $baseUrl; ?>user/add
    </div>
    <div class="clear">
        <b>Request Param:</b>firstName, lastName, email, mobile, dob, vehicleNumber, vehicleType, referrer
    </div>
    <div class="clear">
        <b>Response:</b> {
        "code": 200,
        "status": "success",
        "message": "Added successfully."
    }
</div>
<div class="clear">
    <b>Mandatory:</b>firstName, lastName, mobile, dob, vehicleNumber, vehicleType
</div>
<div class="clear">
    <b>Note:</b> Header Key = token
</div>
<div class="clear">
    <b>Note:</b> token will be in header only
</div>

</div>

<div id="logout" class="main mainclear">
    <div class="service"><b>Service Name :</b>Log Out</div>
    <div class="clear">
        <b>Method:</b> <strong>GET</strong>
    </div>
    <div class="clear">
        <b>Url:</b> <?php echo $baseUrl; ?>logout
    </div>
    <div class="clear">
        <b>Response:</b>{
        "code": 200,
        "status": "success",
        "message": "Logout successfully."
    }
</div>
<div class="clear">
    <b>Note:</b> Header Key = token
</div>
<div class="clear">
    <b>Note:</b> token will be in header only
</div>
</div>

<!--search-customer-list-->
<div id="search-customer" class="main mainclear">
    <div class="service"><b>Service Name :</b>Search Customer</div>
    <div class="clear">
        <b>Method:</b><strong>POST</strong>
    </div>
    <div class="clear">
        <b>Request URL:</b><?php echo $baseUrl; ?>search/user
    </div>
    <div class="clear">
        <b>Request Param:</b>vehicleNumber, mobile, billNumber
    </div>

    <div class="clear">
        <b>Response:</b>{
        "code": 200,
        "status": "success",
        "message": "Fetched successfully.",
        "userData": {
        "userId": "1",
        "firstName": "shahid",
        "lastName": "DL3SDF9642",
        "email": "shahid@gmail.com",
        "mobile": "9650706465",
        "countryCode": "91",
        "dob": "0000-00-00",
        "totalPoints": "8",
        "lastTransactionDate": "17-Sep-2019",
        "referrer": null,
        "status": "1",
        "updatedDate": "2019-09-15 15:08:20",
        "createdDate": "2019-09-15 15:08:20"
    },
    "vehicleList": [
    {
        "vehicleId": "1",
        "vehicleNumber": "DL3SDF9642",
        "vehicleType": "Bike"
    },
    {
        "vehicleId": "2",
        "vehicleNumber": "UP34AB5468",
        "vehicleType": "Car"
    },
    {
        "vehicleId": "3",
        "vehicleNumber": "UP34AB5468d",
        "vehicleType": "Car"
    }
    ]
}
</div>
<div class="clear">
    <b>Note:</b> Header Key = token
</div>
<div class="clear">
    <b>Note:</b> token will be in header only
</div>
</div>


<!--search-transaction-->
<div id="search-transaction" class="main mainclear">
    <div class="service"><b>Service Name :</b>Search Transaction</div>
    <div class="clear">
        <b>Method:</b><strong>POST</strong>
    </div>
    <div class="clear">
        <b>Request URL:</b><?php echo $baseUrl; ?>search/transaction
    </div>
    <div class="clear">
        <b>Request Param:</b>keyword
    </div>

    <div class="clear">
        <b>Response:</b>{
        "code": 200,
        "status": "success",
        "message": "Fetched successfully.",
        "userData": {
        "userId": "1",
        "firstName": "shahid",
        "lastName": "DL3SDF9642",
        "email": "shahid@gmail.com",
        "mobile": "9650706465",
        "countryCode": "91",
        "dob": "0000-00-00",
        "totalPoints": "8",
        "lastTransactionDate": "2019-09-17",
        "referrer": null,
        "status": "1",
        "updatedDate": "2019-09-15 15:08:20",
        "createdDate": "2019-09-15 15:08:20"
    },
    "vehicleList": [
    {
        "vehicleId": "1",
        "vehicleNumber": "DL3SDF9642"
    },
    {
        "vehicleId": "2",
        "vehicleNumber": "UP34AB5468"
    },
    {
        "vehicleId": "3",
        "vehicleNumber": "UP34AB5468d"
    }
    ],
    "transactionList": [
    {
        "transactionId": "7",
        "userId": "1",
        "vehicleId": "1",
        "billNumber": "123",
        "points": "12",
        "remarks": "",
        "transactionType": "add",
        "transactionStatus": "Cancelled",
        "vehicleNumber": "DL3SDF9642",
        "vehicleType": "Bike",
        "transactionDate": "12-Sep-2019"
    },
    {
        "transactionId": "8",
        "userId": "1",
        "vehicleId": "1",
        "billNumber": "1234",
        "points": "12",
        "remarks": "",
        "transactionType": "add",
        "transactionStatus": "Cancelled",
        "vehicleNumber": "DL3SDF9642",
        "vehicleType": "Bike",
        "transactionDate": "13-Sep-2019"
    },
    {
        "transactionId": "9",
        "userId": "1",
        "vehicleId": "1",
        "billNumber": "12323",
        "points": "12",
        "remarks": "",
        "transactionType": "add",
        "transactionStatus": "Added",
        "vehicleNumber": "DL3SDF9642",
        "vehicleType": "Bike",
        "transactionDate": "12-Sep-2019"
    },
    {
        "transactionId": "13",
        "userId": "1",
        "vehicleId": "1",
        "billNumber": "123sd",
        "points": "12",
        "remarks": "",
        "transactionType": "add",
        "transactionStatus": "Added",
        "vehicleNumber": "DL3SDF9642",
        "vehicleType": "Bike",
        "transactionDate": "12-Sep-2019"
    },
    {
        "transactionId": "16",
        "userId": "1",
        "vehicleId": "1",
        "billNumber": "123sdds",
        "points": "12",
        "remarks": "",
        "transactionType": "add",
        "transactionStatus": "Added",
        "vehicleNumber": "DL3SDF9642",
        "vehicleType": "Bike",
        "transactionDate": "12-Sep-2019"
    },
    {
        "transactionId": "17",
        "userId": "1",
        "vehicleId": "1",
        "billNumber": "123sddsds",
        "points": "12",
        "remarks": "",
        "transactionType": "add",
        "transactionStatus": "Added",
        "vehicleNumber": "DL3SDF9642",
        "vehicleType": "Bike",
        "transactionDate": "12-Sep-2019"
    },
    {
        "transactionId": "11",
        "userId": "1",
        "vehicleId": "0",
        "billNumber": "",
        "points": "10",
        "remarks": "helmet",
        "transactionType": "redeem",
        "transactionStatus": "Added",
        "vehicleNumber": "",
        "vehicleType": "",
        "transactionDate": "17-Sep-2019"
    },
    {
        "transactionId": "12",
        "userId": "1",
        "vehicleId": "0",
        "billNumber": "",
        "points": "10",
        "remarks": "helmet",
        "transactionType": "redeem",
        "transactionStatus": "Added",
        "vehicleNumber": "",
        "vehicleType": "",
        "transactionDate": "17-Sep-2019"
    },
    {
        "transactionId": "14",
        "userId": "1",
        "vehicleId": "0",
        "billNumber": "",
        "points": "10",
        "remarks": "dasdas",
        "transactionType": "redeem",
        "transactionStatus": "Added",
        "vehicleNumber": "",
        "vehicleType": "",
        "transactionDate": "17-Sep-2019"
    },
    {
        "transactionId": "15",
        "userId": "1",
        "vehicleId": "0",
        "billNumber": "",
        "points": "10",
        "remarks": "dasdas",
        "transactionType": "redeem",
        "transactionStatus": "Added",
        "vehicleNumber": "",
        "vehicleType": "",
        "transactionDate": "17-Sep-2019"
    },
    {
        "transactionId": "18",
        "userId": "1",
        "vehicleId": "0",
        "billNumber": "",
        "points": "40",
        "remarks": "dasdas",
        "transactionType": "redeem",
        "transactionStatus": "Added",
        "vehicleNumber": "",
        "vehicleType": "",
        "transactionDate": "17-Sep-2019"
    }
    ]
}
</div>
<div class="clear">
    <b>Mandatory:</b>keyword
</div>
<div class="clear">
    <b>Note:</b> Header Key = token
</div>
<div class="clear">
    <b>Note:</b> token will be in header only
</div>
</div>

<!--Add-transaction-->
<div id="add-transaction" class="main mainclear">
    <div class="service"><b>Service Name :</b>Add Transaction</div>
    <div class="clear">
        <b>Method:</b><strong>POST</strong>
    </div>
    <div class="clear">
        <b>Request URL:</b><?php echo $baseUrl; ?>transaction/add
    </div>
    <div class="clear">
        <b>Request Param:</b>userId, vehicleId, billNumber, quantity, transactionDate
    </div>

    <div class="clear">
        <b>Response:</b>{
        "code": 200,
        "status": "success",
        "message": "Added successfully."
    }
</div>
<div class="clear">
    <b>Mandatory:</b> userId, vehicleId, billNumber, quantity, transactionDate
</div>
<div class="clear">
    <b>Note:</b> Header Key = token
</div>
<div class="clear">
    <b>Note:</b> token will be in header only
</div>
</div>


<!--Cancel-transaction-->
<div id="cancel-transaction" class="main mainclear">
    <div class="service"><b>Service Name :</b>Cancel Transaction</div>
    <div class="clear">
        <b>Method:</b><strong>POST</strong>
    </div>
    <div class="clear">
        <b>Request URL:</b><?php echo $baseUrl; ?>transaction/cancel
    </div>
    <div class="clear">
        <b>Request Param:</b>userId, billNumber, transactionDate
    </div>

    <div class="clear">
        <b>Response:</b>{
        "code": 200,
        "status": "success",
        "message": "Updated successfully."
    }
</div>
<div class="clear">
    <b>Mandatory:</b> userId, billNumber, transactionDate
</div>
<div class="clear">
    <b>Note:</b> Header Key = token
</div>
<div class="clear">
    <b>Note:</b> token will be in header only
</div>
</div>

<!--Redeem-points-->
<div id="redeem-points" class="main mainclear">
    <div class="service"><b>Service Name :</b>Redeem Points</div>
    <div class="clear">
        <b>Method:</b><strong>POST</strong>
    </div>
    <div class="clear">
        <b>Request URL:</b><?php echo $baseUrl; ?>transaction/redeem
    </div>
    <div class="clear">
        <b>Request Param:</b>userId, points, remarks
    </div>

    <div class="clear">
        <b>Response:</b>{
        "code": 200,
        "status": "success",
        "message": "Updated successfully."
    }
</div>
<div class="clear">
    <b>Mandatory:</b> userId, points, remarks
</div>
<div class="clear">
    <b>Note:</b> Header Key = token
</div>
<div class="clear">
    <b>Note:</b> token will be in header only
</div>
</div>
<!--Change password-->
<div id="change-password" class="main mainclear">
    <div class="service"><b>Service Name :</b>Change Password</div>
    <div class="clear">
        <b>Method:</b> POST
    </div>
    <div class="clear">
        <b>Url:</b> <?php echo $baseUrl; ?>changepassword
    </div>
    <div class="clear">
        <b>Request Param:</b>oldPassword, newPassword, confirmPassword
    </div>
    <div class="clear">
        <b>Response:</b>{
        "code": 200,
        "status": "success",
        "message": "Updated successfully."
    }
</div>
<div class="clear">
    <b>Mandatory:</b> oldPassword, newPassword, confirmPassword
</div>
</div>

<!-- Forgot-Password-->
<!--<div id="forget-password" class="main mainclear">
    <div class="service"><b>Service Name :</b>Forget Password</div>
    <div class="clear">
        <b>Method:</b> POST
    </div>
    <div class="clear">
        <b>Url:</b> <?php echo $baseUrl; ?>forgot
    </div>
    <div class="clear">
        <b>Request Param:</b>email
    </div>
    <div class="clear">
        <b>Response:</b>{
        "code": 200,
        "status": "success",
        "message": "Mail sent to your email id."
    }
</div>
<div class="clear">
    <b>Mandatory:</b> email
</div>
</div> -->


</body>
</html>
<style>
    .clear{
        padding: 1px;
        font-size: 14px !important;
    }

    .mainclear{
        margin-bottom: 8px;
        border-bottom: 1px solid #8E9CB2;
    }
    .service{
        text-align: center;
        font-size: 16px !important;

    }
    .errorContainer{
        margin-top: 5px !important;
        text-align: left !important;
        padding: 10px;
    }
</style>
<script>
    $(document).ready(function () {
        $("#serviceName").keyup(function () {

            if ($(this).val() == '') {
                $(".main").fadeIn(300);
            }
        });
        $('.searchbychar').on('click', function (event) {
            event.preventDefault();
            var target = "#" + $(this).data('target');
            $(".main").fadeOut(300);
            $(target).fadeIn(300);
            $('html, body').animate({
                scrollTop: $(target).offset().top - 25
            }, 2000);
        });
    });

    function setContent(val) {
        var target = "#" + val;
        $(".main").fadeOut(300);
        $(target).fadeIn(300);
        $('html, body').animate({
            scrollTop: $(target).offset().top + 40
        }, 2000);
    }
</script>
