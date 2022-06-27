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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['admin'] = 'Admin/C_Admin';
$route['admin/c_admin'] = 'Admin/C_Admin';
$route['admin/users'] = 'Admin/C_Users';
$route['admin/c_users'] = 'Admin/C_Users';
$route['admin/c_users/(:any)'] = 'Admin/C_Users/$1';
$route['admin/c_users/(:any)/(:any)'] = 'Admin/C_Users/$1/$2';
$route['admin/faskes'] = 'Admin/C_Faskes';
$route['admin/c_faskes'] = 'Admin/C_Faskes';
$route['admin/c_faskes/(:any)'] = 'Admin/C_Faskes/$1';
$route['admin/c_faskes/(:any)/(:any)'] = 'Admin/C_Faskes/$1/$2';
$route['admin/kapasitas'] = 'Admin/C_Kapasitas';
$route['admin/c_kapasitas'] = 'Admin/C_Kapasitas';
$route['admin/c_kapasitas/(:any)'] = 'Admin/C_Kapasitas/$1';
$route['admin/c_kapasitas/(:any)/(:any)'] = 'Admin/C_Kapasitas/$1/$2';
$route['admin/ketersediaan'] = 'Admin/C_Ketersediaan';
$route['admin/c_ketersediaan'] = 'Admin/C_Ketersediaan';
$route['admin/c_ketersediaan/(:any)'] = 'Admin/C_Ketersediaan/$1';
$route['admin/c_ketersediaan/(:any)/(:any)'] = 'Admin/C_Ketersediaan/$1/$2';

$route['pegawai'] = 'Pegawai/C_Pegawai';
$route['pegawai/c_pegawai'] = 'Pegawai/C_Pegawai';
$route['pegawai/faskes'] = 'Pegawai/C_Faskes';
$route['pegawai/c_faskes'] = 'Pegawai/C_Faskes';
$route['pegawai/c_faskes/(:any)'] = 'Pegawai/C_Faskes/$1';
$route['pegawai/c_faskes/(:any)/(:any)'] = 'Pegawai/C_Faskes/$1/$2';
$route['pegawai/kapasitas'] = 'Pegawai/C_Kapasitas';
$route['pegawai/c_kapasitas'] = 'Pegawai/C_Kapasitas';
$route['pegawai/c_kapasitas/(:any)'] = 'Pegawai/C_Kapasitas/$1';
$route['pegawai/c_kapasitas/(:any)/(:any)'] = 'Pegawai/C_Kapasitas/$1/$2';
$route['pegawai/ketersediaan'] = 'Pegawai/C_Ketersediaan';
$route['pegawai/c_ketersediaan'] = 'Pegawai/C_Ketersediaan';
$route['pegawai/c_ketersediaan/(:any)'] = 'Pegawai/C_Ketersediaan/$1';
$route['pegawai/c_ketersediaan/(:any)/(:any)'] = 'Pegawai/C_Ketersediaan/$1/$2';
