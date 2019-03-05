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
*/
//ecommerce routes
//$route['friends/hello']='friends/friends/index';

/*

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

$route['admin/login']='auth/auth/login_admin';
$route['default_controller'] = 'auth/auth/login_admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['users/add-user']='admin/users/add_user';
$route['users/all-users']='admin/users/index';
$route['users/all-users/(:any)/(:any)/(:num)'] ='admin/users/index/$1/$2/$3';
$route['users/all-users/(:any)/(:any)'] ='admin/users/index/$1/$2';
$route['users/all-users/(:num)'] ='admin/users/index/$1';
$route['users/edit-user'] ='admin/users/edit_user';
$route['users/edit-user/(:num)'] ='admin/users/edit_user/$1';
$route['users/activate-user'] = 'admin/users/activate_user';
$route['users/activate-user/(:num)'] = 'admin/users/activate_user/$1';
$route['users/deactivate-user']= 'admin/users/deactivate_user';
$route['users/deactivate-user/(:num)']= 'admin/users/deactivate_user/$1';
$route['users/delete-user'] ='admin/users/delete_user';
$route['users/delete-user/(:num)'] ='admin/users/delete_user/$1';
$route['users/search-user'] = 'admin/users/execute_search';

$route['categories/add-category']='admin/categories/add_category';
$route['categories/all-categories']='admin/categories/index';
$route['categories/all-categories/(:any)/(:any)/(:num)'] ='admin/categories/index/$1/$2/$3';
$route['categories/all-categories/(:any)/(:any)'] ='admin/categories/index/$1/$2';
$route['categories/all-categories/(:num)'] ='admin/categories/index/$1';
$route['categories/edit-category'] ='admin/categories/edit_category';
$route['categories/edit-category/(:num)'] ='admin/categories/edit_category/$1';
$route['categories/activate-category'] = 'admin/categories/activate_category';
$route['categories/activate-category/(:num)'] = 'admin/categories/activate_category/$1';
$route['categories/deactivate-category']= 'admin/categories/deactivate_category';
$route['categories/deactivate-category/(:num)']= 'admin/categories/deactivate_category/$1';
$route['categories/delete-category'] ='admin/categories/delete_category';
$route['categories/delete-category/(:num)'] ='admin/categories/delete_category/$1';
$route['categories/search-category'] = 'admin/categories/execute_search';

$route['categories/index']='admin/categories/index';
$route['roles/index']='admin/roles/index';
$route['user-type-roles/index']='admin/user_type_roles/index';
