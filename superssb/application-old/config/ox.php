<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Available server */
// $config['SERVER']			= array('1' => 'bisnis.com', '10' => 'en.bisnis.com');
$config['SERVER']			= array('1' => 'bisnis.com', '10' => 'en.bisnis.com');

/* Thumb use url rewrite via htaccess */
$config['rewrite_thumb']	= TRUE;

$config['backend_path']		= 'backend';
$config['frontend_path']	= 'public';

$config['admin_path']		= 'admin';

if(SERVER=='1') $config['user_path'] = 'bisnis';
if(SERVER=='10') $config['user_path'] = 'bisnis';