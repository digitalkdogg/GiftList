<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

//$route['gift'] = 'gift/display_gift';
$route['default_controller'] = 'search'; //Our default Controller
$route['/'] = 'search';
//$route['default_controller'] = 'welcome';

$route['gift'] = 'welcome';
$route["logout"] = 'dashboard/logout';
$route["comment/(.*)"] = 'gift/comment_form/$1';
$route["send_comment/(.*)"] = 'gift/send_comment_email/$1';
$route["gift/(.*)/(.*)"] = 'gift/display_gift/$1/$2';
$route["gift/(.*)"] = 'gift/display_list/$1';
$route["taken/(.*)"] = 'gift/item_taken/$1';
$route["one_item/(.*)"] = 'gift/display_gift_one_item/$1';
$route["menu_taken/(.*)"] = 'gift/menu_taken/$1';
$route["admin/(.*)"] = 'gift/gift_list_admin/$1';
//$route["home/(.*)"] = 'gift/display_gift/$1';
$route["add_comment/(.*)"] = 'gift/add_comment/$1';
$route["email_admin/(.*)"] = 'gift/email_admin/$1';
$route["send_email_admin/(.*)"] = 'gift/send_email_admin/$1';
$route["send_share_email/(.*)"] = 'gift/send_share_email/$1';
$route["send_email/(.*)"] = 'gift/send_email/$1';
$route["likes/(.*)"] = 'gift/update_likes/$1';


$route["load_dashboard/(.*)"] = 'dashboard/load_dashboard/$1';
$route["dash_add_form"] = 'dashboard/get_dashboard_add_form';
$route["dash_add_gift/(.*)"] = 'dashboard/add_gift/$1';
$route["dash_edit_gift/(.*)"] = 'dashboard/edit_gift/$1';
$route["dash_edit_gift_item/(.*)"] = 'dashboard/edit_gift_item/$1';
$route["dash_delete_gift/(.*)"] = 'dashboard/delete_gift/$1';
$route["dash_delete_gift_item/(.*)"] = 'dashboard/delete_gift_item/$1';
$route["dash_add_list/(.*)"] = 'dashboard/add_list/$1';
$route["logmein"] = "dashboard/logmein";
$route["addGiftLink"] = "dashboard/addGiftLink";
$route["editGiftLink"] = "dashboard/editGiftLink";
$route["dash_edit_owner"] = "dashboard/edit_owner";
$route["dash_edit_admin"] = "dashboard/edit_admin";
$route["config"]= "dashboard/get_config";
$route["signup"] = "dashboard/signup";
$route['404_override'] = '';

$route["home"] = "search/index";


/* End of file routes.php */
/* Location: ./application/config/routes.php */