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

//$this->ctr->load->library('DX_Auth');

/*** Defaults ***/
$route['default_controller'] = 'auth/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*** Login ***/
$route['login/'] = 'auth/login';
$route['logout/'] = 'auth/logout';
$route['register/'] = 'auth/register';

/*** Pages ***/
$route['(:any)'] = 'pages/view/$1';

/*** Tickets ***/
$route['add/ticket'] = 'tickets/add';
$route['ticket/:num'] = 'tickets/view/$1';
$route['ticket/:num/validate'] = 'tickets/validate/$1';

/*** Settings ***/
$route['settings/category'] = 'settings/category';
$route['settings/add/category'] = 'settings/addcategory';
$route['settings/edit/category/:num'] = 'settings/editcategory/$1';

$route['settings/status'] = 'settings/status';
$route['settings/add/status'] = 'settings/addstatus';
$route['settings/edit/status/:num'] = 'settings/editstatus/$1';

$route['settings/importance'] = 'settings/importance';
$route['settings/add/importance'] = 'settings/addimportance';
$route['settings/edit/importance/:num'] = 'settings/editimportance/$1';

/*** Configuration ***/
$route['configuration/category'] = 'configuration/add';