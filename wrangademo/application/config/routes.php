<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['logout'] = 'login/logout';
$route['dashboard'] = 'login/dashboard';
$route['loginprocess'] = 'Login/loginprocess';


$route['adminprocess'] = 'Login/adminprocess';
$route['adminadd'] = 'Login/adminAdd';
$route['adminedit/(:any)'] = 'Login/adminEdit';
$route['update_admin/(:any)'] = 'Login/update_admin';
$route['adminaddInsert'] = 'Login/adminaddInsert';
$route['deleteadmin/(:any)'] = 'Login/deleteadmin';

$route['teamleaderprocess'] = 'Login/teamleaderprocess';
$route['teamleaderadd'] = 'Login/teamleaderAdd';
$route['teamleaderedit/(:any)'] = 'Login/teamleaderEdit';
$route['update_teamleader/(:any)'] = 'Login/update_teamleader';
$route['teamleaderaddInsert'] = 'Login/teamleaderaddInsert';
$route['deleteteamleader/(:any)'] = 'Login/deleteteamleader';

$route['reviewerprocess'] = 'Login/reviewerprocess';
$route['revieweredit/(:any)'] = 'Login/reviewerEdit';
$route['update_reviewer/(:any)'] = 'Login/update_reviewer';
$route['revieweradd'] = 'Login/reviewerAdd';
$route['revieweraddInsert'] = 'Login/revieweraddInsert';
$route['deletereviewer/(:any)'] = 'Login/deletereviewer';


//$route['dashboard'] = 'OttContent/dashboard';

$route['published-otts'] = 'OttContent/publishedOtts';

$route['upload-new-otts/:num'] = 'OttContent/uploadNewOtts/$1';
$route['upload-new-games/:num'] = 'OttContent/uploadNewGames/$1';
$route['upload-new-app/:num'] = 'OttContent/uploadNewApp/$1';
$route['upload-new-book/:num'] = 'OttContent/uploadNewBook/$1';

$route['pending-otts'] = 'OttContent/pendingOtts';
$route['upload-new-otts/:num'] = 'OttContent/uploadNewOtts/$1';
$route['deleteId/:num'] = 'OttContent/deleteId/$1';
$route['upload-paymentPlan'] = 'OttContent/uploadPaymentPlan';
$route['upload-paymentPlan/:num'] = 'OttContent/uploadPaymentPlan/$1';

$route['updateBenifits'] = 'OttContent/updateBenifits';
$route['updateBenifits/:num'] = 'OttContent/updateBenifits/$1';




$route['games-categories'] = 'OttContent/gamesCategories';
$route['games-language'] = 'OttContent/gamesLanguage';
$route['app-categories'] = 'OttContent/appCategories';
$route['app-language'] = 'OttContent/appLanguage';
$route['book-categories'] = 'OttContent/bookCategories';
$route['book-language'] = 'OttContent/bookLanguage';
$route['push-notification'] = 'OttContent/pushNotification';
$route['setting-about-us'] = 'OttContent/settingAboutUs';


$route['paymentPlan'] = 'OttContent/paymentPlan';
$route['planBenifits'] = 'OttContent/planBenifits';

$route['games-published'] = 'OttContent/gamesPublished';
$route['games-pending'] = 'OttContent/gamesPending';
$route['app-published'] = 'OttContent/appPublished';
$route['app-pending'] = 'OttContent/appPending';
$route['book-published'] = 'OttContent/bookPublished';
$route['advisory-published'] = 'OttContent/bookPublished';

$route['book-pending'] = 'OttContent/bookPending';
$route['admin'] = 'OttContent/admin';
$route['team-leaders'] = 'OttContent/teamLeaders';
$route['reviewers'] = 'OttContent/reviewers';
$route['mobile-users'] = 'OttContent/mobileUsers';

$route['categories'] = 'OttContent/categories';
$route['platform'] = 'OttContent/platform';
$route['language'] = 'OttContent/language';

$route['ott-content-type'] = 'OttContent/ottContentType';
$route['ott-platform-type'] = 'OttContent/ottPlatformType';



$route['content-type'] = 'OttContent/contentType';
$route['genre'] = 'OttContent/genre';
$route['forgetPassword'] = 'OttContent/forgetPassword';
$route['updatePassword/:num'] = 'OttContent/updatePassword/$1';


$route['rating/:num'] = 'OttContent/rating/$1';
$route['short-review/:num'] = 'OttContent/shortReview/$1';
$route['tips-and-tricks/:num'] = 'OttContent/tipsandTricks/$1';
$route['tipsDelete/:num'] = 'OttContent/tipsDelete/$1';


/*Game*/

$route['game-rating/:num'] = 'GameContent/rating/$1';
$route['game-short-review/:num'] = 'GameContent/shortReview/$1';
$route['game-tips-and-tricks/:num'] = 'GameContent/tipsandTricks/$1';
$route['game-tipsDelete/:num'] = 'GameContent/tipsDelete/$1';


/* App */

$route['app-rating/:num'] = 'AppContent/rating/$1';
$route['app-short-review/:num'] = 'AppContent/shortReview/$1';
$route['app-tips-and-tricks/:num'] = 'AppContent/tipsandTricks/$1';
$route['apptipsDelete/:num'] = 'AppContent/tipsDelete/$1';

/* Advisory
 */

$route['advisory-rating/:num'] = 'AdvisoryContent/rating/$1';
$route['advisory-short-review/:num'] = 'AdvisoryContent/shortReview/$1';
$route['advisory-tips-and-tricks/:num'] = 'AdvisoryContent/tipsandTricks/$1';
$route['advisorytipsDelete/:num'] = 'AdvisoryContent/tipsDelete/$1';