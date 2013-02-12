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

$route['default_controller'] = "home";
//$route['brothers'] = 'main/brothers';
$route['internal'] = 'internal';
$route['authenticate'] = 'sessions/authenticate';
$route['registration'] = 'sessions/registration';
$route['register'] = 'sessions/register';
$route['logout'] = 'sessions/logout';
$route['login']  = 'sessions/login';
$route['update'] = 'news_update';
$route['update/update'] = 'news_update/update';
$route['pledge_forum/topics'] = 'pledge_forum/load_thread_view';
$route['active_forum/topics'] = 'active_forum/load_thread_view';
$route['pledge_forum/post/([a-zA-Z]*)/(:num)'] = 'pledge_forum/load_discussion_view/$1/$2';
$route['active_forum/post/([a-zA-Z]*)/(:num)'] = 'active_forum/load_discussion_view/$1/$2';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */