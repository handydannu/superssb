<?php
$config['doc_root']   = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
if($_SERVER['SERVER_ADDR'] == '10.5.5.56' || $_SERVER['SERVER_ADDR'] == '10.5.5.46'){
	// STAGGING
	// path and directory application
	$config['server_url'] = 'http://'.$_SERVER['HTTP_HOST'].'/';
	$config['doc_root']   = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	$config['doc_root']   .= "://".$_SERVER['HTTP_HOST'];
	$config['doc_root']   .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	$config['images_posts_uri'] = $config['doc_root'] . "images-data/";

	define('DOCROOT', '/mainData');
	$config['root_dir']   = "/mainData";
	$config['data_dir'] = $config['root_dir'] . '/data-banksulselbar/';
}else{
	// LIVE
	if ( $config['doc_root'] == 'http') {
		$config['server_url'] = 'http://www.banksulselbar.co.id/superssb/';
	    $config['doc_root']   = 'http://www.banksulselbar.co.id/';
	    $config['images_posts_uri'] = $config['doc_root'] . "images-data/images/";

		define('DOCROOT', '/home/bankssb/public_html');
		$config['root_dir']   = "/home/bankssb/public_html";
		$config['data_dir'] = $config['root_dir'] . '/images-data/';
	}
	else {
		$config['server_url'] = 'https://www.banksulselbar.co.id/superssb/';
	    $config['doc_root']   = 'https://www.banksulselbar.co.id/';
	    $config['images_posts_uri'] = $config['doc_root'] . "images-data/images/";

		define('DOCROOT', '/home/bankssb/public_html');
		$config['root_dir']   = "/home/bankssb/public_html";
		$config['data_dir'] = $config['root_dir'] . '/images-data/';
	}
	
}

$config['images_dir']           = $config['data_dir'] . 'images/';
// image path configuration
$config['posts_images_dir']     = $config['images_dir'] . 'posts/';
$config['photos_images_dir']    = $config['images_dir'] . 'photos/';
$config['videos_images_dir']    = $config['images_dir'] . 'videos/';
$config['pages_images_dir']     = $config['images_dir'] . 'pages/';
$config['events_images_dir']    = $config['images_dir'] . 'events/';
$config['headline_images_dir']  = $config['images_dir'] . 'headline/';
$config['testimoni_images_dir'] = $config['images_dir'] . 'testimoni/';

$config['files_dir']            = $config['data_dir'] . 'files/';		// files download

$config['template_uri']         = $config['server_url'] .'static/';
$config['images_uri']           = $config['server_url'] .'static/images/';


?>