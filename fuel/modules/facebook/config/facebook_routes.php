<?php
//include(MODULES_PATH.'facebook/config/facebook_modules.php');

$route[FUEL_ROUTE.'facebook'] = 'facebook';
$route[FUEL_ROUTE.'facebook/(:any)'] = 'facebook/$1';
$route['facebook/(:any)'] = 'facebook/$1';

