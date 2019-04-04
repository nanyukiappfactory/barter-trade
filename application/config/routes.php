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

$route['default_controller'] = 'admin/admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin/login']='auth/auth/login_admin';
$route['users/add-user']='admin/users/add_user';
$route['users/all-users']='admin/users/index';
$route['users/all-users/(:any)/(:any)/(:num)'] ='admin/users/index/$1/$2/$3';
$route['users/all-users/(:any)/(:any)'] ='admin/users/index/$1/$2';
$route['users/edit-user/(:num)'] ='admin/users/edit_user/$1';
$route['users/activate-user/(:num)'] = 'admin/users/activate_user/$1';
$route['users/deactivate-user/(:num)']= 'admin/users/deactivate_user/$1';
$route['users/delete-user/(:num)'] ='admin/users/delete_user/$1';
$route['users/search-user'] = 'admin/users/search_user';
$route['users/close-search'] = 'admin/users/unset_search_user';

$route['categories/add-category']='admin/categories/add_category';
$route['categories/all-categories']='admin/categories/index';
$route['categories/all-categories/(:any)/(:any)/(:num)'] ='admin/categories/index/$1/$2/$3';
$route['categories/all-categories/(:any)/(:any)'] ='admin/categories/index/$1/$2';
$route['categories/edit-category/(:num)'] ='admin/categories/edit_category/$1';
$route['categories/activate-category/(:num)'] = 'admin/categories/activate_category/$1';
$route['categories/deactivate-category/(:num)']= 'admin/categories/deactivate_category/$1';
$route['categories/delete-category/(:num)'] ='admin/categories/delete_category/$1';
$route['categories/search-category'] = 'admin/categories/execute_search';
$route['categories/close-search'] = 'admin/categories/unset_search';

$route['roles/add-role']='admin/roles/add_role';
$route['roles/all-roles']='admin/roles/index';
$route['roles/all-roles/(:any)/(:any)/(:num)'] ='admin/roles/index/$1/$2/$3';
$route['roles/all-roles/(:any)/(:any)'] ='admin/roles/index/$1/$2';
$route['roles/edit-role/(:num)'] ='admin/roles/edit_role/$1';
$route['roles/activate-role/(:num)'] = 'admin/roles/activate_role/$1';
$route['roles/deactivate-role/(:num)']= 'admin/roles/deactivate_role/$1';
$route['roles/delete-role/(:num)'] ='admin/roles/delete_role/$1';
$route['roles/search-role'] = 'admin/roles/execute_search';
$route['roles/close-search'] = 'admin/roles/unset_search';

//user type routes
$route['user-types/add-user-type']='admin/user_types/add_user_type';
$route['user-types/all-user-types']='admin/user_types/index';
$route['user-types/all-user-types/(:any)/(:any)/(:num)'] ='admin/user_types/index/$1/$2/$3';
$route['user-types/all-user-types/(:any)/(:any)'] ='admin/user_types/index/$1/$2';
$route['user-types/edit-user-type'] ='admin/user_types/index';
$route['user-types/edit-user-type/(:num)'] ='admin/user_types/edit_user_type/$1';
$route['user-types/activate-user-type/(:num)'] = 'admin/user_types/activate_user_type/$1';
$route['user-types/deactivate-user-type/(:num)']= 'admin/user_types/deactivate_user_type/$1';
$route['user-types/delete-user-type/(:num)'] ='admin/user_types/delete_user_type/$1';
$route['user-types/search-user-type'] = 'admin/user_types/execute_search';
$route['user-types/close-search'] = 'admin/user_types/unset_search';

//$route['user-types/all-user-types/user-type-name/(:any)/(:any)'] = 'admin/user_types/all_user_types/user_type_name/$1/$2';
$route['user-type-roles/add-user-type-role']='admin/user_type_roles/add_user_type_role';
$route['user-type-roles/all-user-type-roles']='admin/user_type_roles/index';
$route['user-type-roles/all-user-type-roles/(:any)/(:any)/(:num)'] ='admin/user_type_roles/index/$1/$2/$3';
$route['user-type-roles/all-user-type-roles/(:any)/(:any)'] ='admin/user_type_roles/index/$1/$2';
$route['user-type-roles/edit-user-type-role/(:num)'] ='admin/user_type_roles/edit_user_type_role/$1';
$route['user-type-roles/activate-user-type-role/(:num)'] = 'admin/user_type_roles/activate_user_type_role/$1';
$route['user-type-roles/deactivate-user-type-role/(:num)']= 'admin/user_type_roles/deactivate_user_type_role/$1';
$route['user-type-roles/delete-user-type-role/(:num)'] ='admin/user_type_roles/delete_user_type_role/$1';
$route['user-type-roles/search-user-type-role'] = 'admin/user_type_roles/search_user_type_role';
$route['user-type-roles/close-search'] = 'admin/user_type_roles/unset_user_type_role_search';

//locations
$route['location/add-location']='admin/locations/add_location';
$route['location/all-locations']='admin/locations/index';
$route['location/all-locations/(:any)/(:any)/(:num)'] ='admin/locations/index/$1/$2/$3';
$route['location/all-locations/(:any)/(:any)'] ='admin/locations/index/$1/$2';
$route['location/edit-location/(:num)'] ='admin/locations/edit_location/$1';
$route['location/activate-location/(:num)'] = 'admin/locations/activate_location/$1';
$route['location/deactivate-location/(:num)']= 'admin/locations/deactivate_location/$1';
$route['location/delete-location/(:num)'] ='admin/locations/delete_location/$1';
$route['location/search-location'] = 'admin/locations/search_location';
$route['location/close-search'] = 'admin/locations/unset_location_search';
$route['csv_import/load_data'] ='admin/locations/import_csv';
