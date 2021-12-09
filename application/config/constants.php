<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


define("BASEURL", "http://localhost/WrangaWeb/wrangademo");

define("PUBLIC_PATH", getcwd()."/public/");
define("TRANSACTION_PATH", "transaction/");
define("PROFILE_PATHS", "userProfile/");
define("PUBLIC_ABS", "public/");

define("PROFILE_PATH", "profilePhoto/");
define("PROFILE_THUMB_PATH", "profilePhoto/thumbs/");

define("GOOGLE_API_KEY", "AIzaSyALllYwkTc941ZpTi6nOtPEIWOYmbK5mR4");
define("FCM_API_KEY", "AIzaSyA7KBVjlmCRTcslJvphM9CDL704BINAMyQ");

define ("ENCRYPTION_KEY","#@!qu!kc@t@l0g#!$3nc#@!$");
define ("SITE_TITLE","Welcome To Wrangaapp");

define ("SITE_URL","http://wranga.in");
 
define ("SUCCESS_CODE", 200);
define ("UNSUCCESS_CODE", 400);
define ("AUTH_FAIL_CODE", 401);

/****
 * Constant message
 ***/
define ("AUTH_SUCCESS", "Authentication successfull.");
define ("INVALID_POST_DATA", "Post data not available"); 
define ("PARAM_MISSING", "Parameter Missing");
define ("STATUS_SUCCESS", "success");
define ("STATUS_ERROR", "error");
define ("STATUS_INVALID", "invalid");
define ("SOMETHING_WRONG", "Something went wrong!");
define ("SIGNUP_SUCCESS", "Signup successfully.");
define ("SIGNUP_FAILED", "Signup failed.");
define ("ACTIVE_VERIFIED", "This email is not verified!");
define ("LOGIN_SUCCESS", "Login successfull");
define ("LOGIN_FAIL", "Login failed, try again");
define ("INVALID_CREDENTIAL", "Please enter valid credentials");
define ("INVALID_TOKEN", "Token invalid in header");
define ("TOKEN_EMPTY", "Token empty in header");

define ("WRONG_OTP", "Please enter correct one time password");
define ("SENT_OTP", "OTP sent to your number");
define ("NOT_SENT_OTP", "OTP not sent to your number");
define ("RESET_PASSWORD", "Password has been reset successfully.");
define ("FILL", "Please fill all tags.");

define ("USER_NOT_EXIST", "User does not exist");
define ("USERNAME_EXIST", "Username already exists");
define ("EMAIL_EXIST", "Email already exists");
define ("MOBILE_EXIST", "Mobile number already exists");
define ("DATA_EXIST", "Data already exists");
define ("DATA_NOT_EXIST", "Data not exists");
define ("DEACTIVATE_ACCOUNT", "Account not activated");
define ("UPDATE_SUCCESS", "Updated successfully.");
define ("UPDATE_FAILED", "Update failed.");


define ("OTP_SUCCESS", "Otp verified successfully.");
define ("OTP_FAILED", "Otp verified failed.");


define ("MAIL_SENT", "Mail sent to your email id.");

define ("DATA_NOT_FOUND", "Data not found.");
define ("DATA_FOUND", "Fetched successfully.");

define ("DATA_INSERT", "Added successfully.");
define ("DATA_NOT_INSERT", "Error! Data not inserted.");
define ("GROUP_INSERT", "Group created Successfully.");
define ("GROUP_NOT_INSERT", "Error! Data not inserted.");
define ("GROUP_LIST_SUCCESS", "Group send successfully.");
define ("GROUP_LIST_FAILED", "Group send failed.");
define ("UPLOAD_SUCCESS", "Image uploaded, successfully.");
define ("UPLOAD_ERROR", "Image not uploaded, Try again.");
define ("WRONG_PASSWORD", "You have entered wrong old password.");
define ("CHANGED_PASSWORD", "Password has been changed successfully.");
define ("SEND_NOTIFICATION_SUCCESS", "Notification send successfully.");
define ("SEND_NOTIFICATION_FAILED", "Notification send failed.");

define ("DELETE_SUCCESS", "Deleted successfully.");
define ("DELETE_FAILED", "Data not deleted.");
define ("LOGOUT", "Logout successfully.");
define('FIREBASE_API_KEY', 'AAAAw4nIoTk:APA91bEzPV2eHTx1OAreASxQYWkMX50dUV-5K_KGB_KDrdeoz5vTN8NGVlU6croKYLUdPp_RTOFu41AokWi8VqKhs2WvBwx83XbLl-e_u0KZhd4fFzj1CkBa5EBTCF5UgSOhW5iiWLYI');