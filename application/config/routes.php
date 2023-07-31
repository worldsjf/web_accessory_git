<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//login
$route['login']['GET']= 'LoginController/index';
$route['login-user']['POST']= 'LoginController/login';
//Dashboard
$route['dashboard']['GET']= 'DashboardController/index';
$route['logout']['GET']= 'DashboardController/logout';
//brand
$route['brand/created']['GET']= 'BrandController/created';
$route['brand/list']['GET']= 'BrandController/index';