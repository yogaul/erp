<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['register'] = 'Register/index';
$route['request'] = 'Sample/form_request';
$route['timeline-product/(:num)'] = 'sample/timeline_product/$1';
$route['product/detail'] = 'api/json_chart_id';
$route['sales-order'] = 'SalesOrder';
$route['order/data-validasi'] = 'order/list_validasi';