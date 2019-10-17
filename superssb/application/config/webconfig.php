<?php
$config['server_url'] = 'http://'.$_SERVER['HTTP_HOST'].'/';
$config['doc_root']   = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['doc_root']   .= "://".$_SERVER['HTTP_HOST'];
$config['doc_root']   .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
$server_name = $_SERVER['SERVER_ADDR'];


switch ($server_name) {
    case  "10.5.5.56": //stagging
        $config['root_dir'] = '/mainData/';
        define('DOCROOT', '/mainData');
        $config['data_dir'] = $config['root_dir'] . 'data-banksulselbar/';
        $config['images_posts_uri'] = $config['doc_root'] . "images-data/";

        $production         = '0'; // false
        $err_reporting      = "E_ALL ^ E_NOTICE";
        break;

    case  "10.5.5.46": // Demo
        $config['root_dir'] = '/mainData/';
        define('DOCROOT', '/mainData');
        $config['data_dir'] = $config['root_dir'] . 'data-banksulselbar/';
        $config['images_posts_uri'] = $config['doc_root'] . "images-data/";

        $production         = '0'; // false
        $err_reporting      = "E_ALL ^ E_NOTICE";
        break;

    default:
        $config['server_url'] = 'https://'.$_SERVER['HTTP_HOST'].'/superssb/';
        $config['root_dir']   = '/home/bankssb/public_html/';
        define('DOCROOT', '/home/bankssb/public_html/');
        $config['data_dir'] = $config['root_dir'] . 'images-data/';
        $config['images_posts_uri'] = $config['doc_root'] . "images-data/images/";
        $production         = '1'; // true
        $err_reporting      = "0";
        break;
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

$config['files_dir']            = $config['data_dir'] . 'files/';       // files download

$config['template_uri']         = $config['doc_root'] .'static/';
$config['images_uri']           = $config['doc_root'] .'static/images/';


?>