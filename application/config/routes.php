<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = 'admin/auth';

/*
 * FRONTEND CUSTOM ROUTING
 */
$route['/'] = 'main/index';
$route['/home'] = 'main/index';
$route['/about-us'] = 'main/about';
$route['/service'] = 'main/service';
$route['/packages'] = 'main/packages';
$route['/branches'] = 'main/branches';
$route['/branches'] = 'main/branches';
$route['/bKash-payment'] = 'main/bkashPayment';
$route['/online-payment'] = 'main/onlinePayment';
$route['/contact'] = 'main/contact';




