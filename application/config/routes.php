<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//$route['default_controller'] = 'Api/v1/Login';
$route['default_controller'] = 'demo/Login';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// api

$route['webservice'] = 'Api/v1/Webservice';
$route['api/v1/signup'] = 'Api/v1/Signup';
$route['api/v1/login'] = 'Api/v1/Login';
$route['api/v1/registrefcm'] = 'Api/v1/RegistreFcm';
$route['api/v1/splash'] = 'Api/v1/Splash';
$route['api/v1/sendnotification'] = 'Api/v1/SendNotification';
$route['api/v1/firebase/send'] = 'Api/v1/Firebase/send';
$route['api/v1/firebase'] = 'Api/v1/Firebase';
$route['getAllTokens'] = 'Api/v1/Firebase/getAllTokens';
$route['api/v1/logout'] = 'Api/v1/Logout';
$route['api/v1/otp/verify'] = 'Api/v1/Otp/Verify';
$route['api/v1/otp/resend'] = 'Api/v1/Otp/Resend';
$route['api/v1/forgot'] = 'Api/v1/ForgetPassword/index';
$route['api/v1/changepassword'] = 'Api/v1/ChangePassword/index';
$route['api/v1/userkidsage'] = 'Api/v1/UserKidsAge/index';
$route['api/v1/homescreen'] = 'Api/v1/HomeScreen/index';
$route['api/v1/homescreennew'] = 'Api/v1/HomeScreenNew/index';
$route['api/v1/subcription'] = 'Api/v1/Subcription/index';
$route['api/v1/ottTypeviewAll'] = 'Api/v1/OttTypeviewAll/index';
$route['api/v1/paymentPlan'] = 'Api/v1/paymentPlan/index';

$route['api/v1/createOrder'] = 'Api/v1/Order/createOrder';
$route['api/v1/orderStatus'] = 'Api/v1/Order/orderStatus';

$route['api/v1/viewAll'] = 'Api/v1/ViewAll/index';
$route['api/v1/search'] = 'Api/v1/Search/index';
$route['api/v1/details'] = 'Api/v1/Details/index';
$route['api/v1/suggestedcontent'] = 'Api/v1/suggestedContent/index';
$route['api/v1/category'] = 'Api/v1/Category/index';
$route['api/v1/aboutUs'] = 'Api/v1/AboutUs/index';
$route['api/v1/profileEdit'] = 'Api/v1/ProfileEdit/index';
$route['api/v1/getProfile'] = 'Api/v1/GetProfile/index';
$route['api/v1/myList'] = 'Api/v1/MyList/index';
$route['api/v1/myList/addToMyList'] = 'Api/v1/MyList/AddToMyList';
$route['api/v1/myList/myListDelete'] = 'Api/v1/MyList/MyListDelete';
$route['api/v1/myNotification'] = 'Api/v1/MyNotification/index';
$route['api/v1/myNotification/addToNotification'] = 'Api/v1/MyNotification/addToNotification';
$route['api/v1/myNotification/myNotificationDelete'] = 'Api/v1/MyNotification/MyNotificationDelete';



$route['api/v1/tips'] = 'Api/v1/Tips/index';
$route['api/v1/tipsList'] = 'Api/v1/TipsList/index';
$route['api/v1/tips/tipsReply'] = 'Api/v1/Tips/TipsReply';
$route['api/v1/updateProfile'] = 'Api/v1/UpdateProfile/index';
$route['api/v1/social/login'] = 'Api/v1/Social/login';
$route['api/v1/user/add'] = 'Api/v1/User/Add';
$route['api/v1/expense/groupList'] = 'Api/v1/Expense/groupList';
$route['api/v1/expense/addTransaction'] = 'Api/v1/Expense/addTransaction';
$route['api/v1/expense/addTransactionBill'] = 'Api/v1/Expense/addTransactionBill';
$route['api/v1/expense/deleteBill'] = 'Api/v1/Expense/deleteBill';
$route['api/v1/expense/transactionHistory'] = 'Api/v1/Expense/transactionHistory';
$route['api/v1/expense/contactList'] = 'Api/v1/Expense/contactList';
$route['api/v1/expense/getProfile'] = 'Api/v1/Expense/getProfile';
$route['api/v1/expense/addContact'] = 'Api/v1/Expense/addContact';
$route['api/v1/expense/customerTransactionHistory'] = 'Api/v1/Expense/customerTransactionHistory';
$route['api/v1/expense/updateUpdateContact'] = 'Api/v1/Expense/updateUpdateContact';
$route['api/v1/expense/verifyOtp'] = 'Api/v1/Expense/verifyOtp';
$route['api/v1/expense/createGroup'] = 'Api/v1/Expense/createGroup';
$route['api/v1/expense/updateGroup'] = 'Api/v1/Expense/updateGroup';
$route['api/v1/expense/trip'] = 'Api/v1/Expense/Trip';
$route['api/v1/expense/addMemberInGroup'] = 'Api/v1/Expense/addMemberInGroup';
$route['api/v1/expense/updateMember'] = 'Api/v1/Expense/updateMember';
$route['api/v1/expense/updateProfile'] = 'Api/v1/Expense/updateProfile';
$route['api/v1/expense/addImageTransaction'] = 'Api/v1/Expense/addImageTransaction';
$route['api/v1/expense/item'] = 'Api/v1/Expense/Item';
$route['api/v1/search/transaction'] = 'Api/v1/Search/Transaction';
$route['api/v1/search/user'] = 'Api/v1/Search/User';
$route['api/v1/transaction/add'] = 'Api/v1/Transaction/Add';
$route['api/v1/transaction/cancel'] = 'Api/v1/Transaction/Cancel';
$route['api/v1/transaction/redeem'] = 'Api/v1/Transaction/Redeem';

$route['api/v1/like'] = 'Api/v1/Like';
$route['api/v1/comment'] = 'Api/v1/Comment';
$route['api/v1/comment/commentList'] = 'Api/v1/Comment/CommentList';
$route['api/v1/comment/commentReply'] = 'Api/v1/Comment/CommentReply';
$route['api/v1/comment/commentReplyAdd'] = 'Api/v1/Comment/CommentReplyAdd';





$route['webservice'] = 'Api/v2/Webservice';
$route['api/v2/signup'] = 'Api/v2/Signup';
$route['api/v2/login'] = 'Api/v2/Login';
$route['api/v2/splash'] = 'Api/v2/Splash';
$route['api/v2/logout'] = 'Api/v2/Logout';
$route['api/v2/otp/verify'] = 'Api/v2/Otp/Verify';
$route['api/v2/otp/resend'] = 'Api/v2/Otp/Resend';
$route['api/v2/forgot'] = 'Api/v2/ForgetPassword/index';
$route['api/v2/changepassword'] = 'Api/v2/ChangePassword/index';
$route['api/v2/userkidsage'] = 'Api/v2/UserKidsAge/index';
$route['api/v2/homescreen'] = 'Api/v2/HomeScreen/index';
$route['api/v2/subcription'] = 'Api/v2/Subcription/index';
$route['api/v2/viewAll'] = 'Api/v2/ViewAll/index';
$route['api/v2/search'] = 'Api/v2/Search/index';

$route['api/v2/details'] = 'Api/v2/Details/index';
$route['api/v2/category'] = 'Api/v2/Category/index';
$route['api/v2/social/login'] = 'Api/v2/Social/login';
$route['api/v2/user/add'] = 'Api/v2/User/Add';
$route['api/v2/expense/groupList'] = 'Api/v2/Expense/groupList';
$route['api/v2/expense/addTransaction'] = 'Api/v2/Expense/addTransaction';
$route['api/v2/expense/addTransactionBill'] = 'Api/v2/Expense/addTransactionBill';
$route['api/v2/expense/deleteBill'] = 'Api/v2/Expense/deleteBill';
$route['api/v2/expense/transactionHistory'] = 'Api/v2/Expense/transactionHistory';
$route['api/v2/expense/contactList'] = 'Api/v2/Expense/contactList';
$route['api/v2/expense/getProfile'] = 'Api/v2/Expense/getProfile';
$route['api/v2/expense/addContact'] = 'Api/v2/Expense/addContact';
$route['api/v2/expense/customerTransactionHistory'] = 'Api/v2/Expense/customerTransactionHistory';
$route['api/v2/expense/updateUpdateContact'] = 'Api/v2/Expense/updateUpdateContact';
$route['api/v2/expense/verifyOtp'] = 'Api/v2/Expense/verifyOtp';
$route['api/v2/expense/createGroup'] = 'Api/v2/Expense/createGroup';
$route['api/v2/expense/updateGroup'] = 'Api/v2/Expense/updateGroup';
$route['api/v2/expense/trip'] = 'Api/v2/Expense/Trip';
$route['api/v2/expense/addMemberInGroup'] = 'Api/v2/Expense/addMemberInGroup';
$route['api/v2/expense/updateMember'] = 'Api/v2/Expense/updateMember';
$route['api/v2/expense/updateProfile'] = 'Api/v2/Expense/updateProfile';
$route['api/v2/expense/addImageTransaction'] = 'Api/v2/Expense/addImageTransaction';
$route['api/v2/expense/item'] = 'Api/v2/Expense/Item';
$route['api/v2/search/transaction'] = 'Api/v2/Search/Transaction';
$route['api/v2/search/user'] = 'Api/v2/Search/User';
$route['api/v2/transaction/add'] = 'Api/v2/Transaction/Add';
$route['api/v2/transaction/cancel'] = 'Api/v2/Transaction/Cancel';
$route['api/v2/transaction/redeem'] = 'Api/v2/Transaction/Redeem';




// demo
$route['demo/registration'] = 'demo/Registration';
$route['demo/activate'] = 'demo/Activate/Index';

$route['demo'] = 'demo/Login';

$route['demo/dashboard'] = 'demo/Dashboard/index';

$route['demo/superadmin'] = 'demo/SuperAdmin/index';

$route['demo/reviewer'] = 'demo/Reviewer/index';
$route['demo/dashboard/addcomment'] = 'demo/Dashboard/AddComment';
$route['demo/dashboard/deletecomment'] = 'demo/Dashboard/DeleteComment';
$route['demo/dashboard/getlist'] = 'demo/Dashboard/getBasketUserList';
$route['demo/dashboard/savetarget'] = 'demo/Dashboard/SaveTarget';
$route['demo/changepassword'] = 'demo/ChangePassword/index';
$route['demo/logout'] = 'demo/Logout/index';
$route['demo/forgot'] = 'demo/Forgot/index';
$route['demo/setting'] = 'demo/Setting/index';

$route['demo/users'] = 'demo/Users';
$route['demo/users/getajax/(:num)'] = 'demo/Users/getAjax';
$route['demo/users/view/(:num)'] = 'demo/Users/view';
$route['demo/users/generateidcard/(:num)'] = 'demo/Users/GenerateIdCard';
$route['demo/users/delete'] = 'demo/Users/delete';
$route['demo/users/changedeletestatus'] = 'demo/Users/changeDeleteStatus';
$route['demo/users/changestatus'] = 'demo/Users/changeStatus';
$route['demo/users/export'] = 'demo/Users/Export';
$route['demo/users/add'] = 'demo/Users/Add';
$route['demo/users/edit'] = 'demo/Users/Edit';
$route['demo/users/pharmacylist'] = 'demo/Users/GetPharmacyList';
$route['demo/users/setting/save'] = 'demo/Users/SaveSetting';
$route['demo/users/checkmobile'] = 'demo/Users/CheckMobile';
$route['demo/users/checkemail'] = 'demo/Users/CheckEmail';

$route['demo/transaction'] = 'demo/Transaction';
$route['demo/transaction/(:num)'] = 'demo/Transaction';
$route['demo/transaction/getajax/(:num)'] = 'demo/Transaction/getAjax';
$route['demo/transaction/view/(:num)'] = 'demo/Transaction/view';
$route['demo/transaction/delete'] = 'demo/Transaction/delete';
$route['demo/transaction/changedeletestatus'] = 'demo/Transaction/changeDeleteStatus';
$route['demo/transaction/changestatus'] = 'demo/Transaction/changeStatus';
$route['demo/transaction/export'] = 'demo/Transaction/Export';
$route['demo/transaction/add'] = 'demo/Transaction/Add';

$route['demo/demoistrator'] = 'demo/demoistrator/index';
$route['demo/demoistrator/getajax/(:num)'] = 'demo/demoistrator/getAjax';
$route['demo/demoistrator/add'] = 'demo/demoistrator/add';
$route['demo/demoistrator/edit/(:num)'] = 'demo/demoistrator/edit';
$route['demo/demoistrator/delete'] = 'demo/demoistrator/delete';
$route['demo/demoistrator/check'] = 'demo/demoistrator/Check';

$route['demo/pharmacy'] = 'demo/Pharmacy';
$route['demo/pharmacy/add'] = 'demo/Pharmacy/Add';
$route['demo/pharmacy/getajax/(:num)'] = 'demo/Pharmacy/getAjax';
$route['demo/pharmacy/edit/(:num)'] = 'demo/Pharmacy/Edit';
$route['demo/pharmacy/delete'] = 'demo/Pharmacy/Delete';
$route['demo/pharmacy/changestatus'] = 'demo/Pharmacy/changeStatus';
$route['demo/pharmacy/status'] = 'demo/Pharmacy/Status';
$route['demo/pharmacy/check'] = 'demo/Pharmacy/Check';


$route['demo/image'] = 'demo/Image';
$route['demo/image/add'] = 'demo/Image/add';
$route['demo/image/edit/(:num)'] = 'demo/Image/edit';
$route['demo/image/delete'] = 'demo/Image/delete';
$route['demo/image/getajax/(:num)'] = 'demo/Image/getAjax';
$route['demo/image/changestatus'] = 'demo/Image/ChangeStatus';

$route['demo/banner'] = 'demo/Banner';
$route['demo/banner/add'] = 'demo/Banner/add';
$route['demo/banner/edit/(:num)'] = 'demo/Banner/edit';
$route['demo/banner/delete'] = 'demo/Banner/delete';
$route['demo/banner/getajax/(:num)'] = 'demo/Banner/getAjax';
$route['demo/banner/changestatus'] = 'demo/Banner/ChangeStatus';
$route['demo/banner/pharmacy'] = 'demo/Banner/UpdatePharmacy';

$route['demo/languages'] = 'demo/Languages';
$route['demo/languages/getajax/(:num)'] = 'demo/Languages/getAjax';
$route['demo/languages/delete'] = 'demo/Languages/delete';
$route['demo/languages/add/(:num)'] = 'demo/Languages/Add';
$route['demo/languages/changestatus'] = 'demo/Languages/changeStatus';
$route['demo/languages/savetext'] = 'demo/Languages/SaveText';
$route['demo/languages/addlanguage'] = 'demo/Languages/AddLanguage';

$route['demo/superadmin'] = 'demo/SuperAdmin/index';
$route['demo/teamleader'] = 'demo/TeamLeader/index';





$route['demo/pending-OTTs.html'] = 'demo/welcome/pendingOtt';
$route['demo/published-OTTs.html'] = 'demo/welcome/publishedOtt';
$route['demo/upload-new-OTT.html'] = 'demo/welcome/uploadOtt';


$route['demo/gamePublished.html'] = 'demo/welcome/gamePublished';
$route['demo/gamePending.html'] = 'demo/welcome/gamePending';
$route['demo/appPublished.html'] = 'demo/welcome/appPublished';
$route['demo/appPending.html'] = 'demo/welcome/appPending';
$route['demo/bookPublished.html'] = 'demo/welcome/bookPublished';
$route['demo/bookPending.html'] = 'demo/welcome/bookPending';

$route['demo/bookPending.html'] = 'demo/welcome/bookPending';
$route['demo/dashboard.html'] = 'demo/welcome/dashboard';


$route['demo/uploadOttgenralInfo.html'] = 'demo/welcome/uploadOttgenralInfo';
$route['demo/uploadOttRating.html'] = 'demo/welcome/uploadOttRating';
$route['demo/uploadOttReview.html'] = 'demo/welcome/uploadOttReview';



$route['demo/admin.html'] = 'demo/welcome/admin';
$route['demo/team-leader.html'] = 'demo/welcome/teamLeader';
$route['demo/reviewer.html'] = 'demo/welcome/reviewer';
$route['demo/mobileusersList'] = 'demo/welcome/mobileusersList';







