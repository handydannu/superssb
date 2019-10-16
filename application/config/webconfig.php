<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['server_url'] = 'http://'.$_SERVER['HTTP_HOST'].'/';
$config['doc_root']   = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['doc_root']   .= "://".$_SERVER['HTTP_HOST'];
$config['doc_root']   .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$server_name = $_SERVER['SERVER_ADDR'];
// if($_SERVER['HTTP_HOST']=='localhost' )
// {
//     $config['root_dir']         = "F:\images";
//     define('DOCROOT', 'F:\biswork\htdocs\cms-sibertama\public');

// }elseif ($_SERVER['HTTP_HOST']=='banksulselbar.co.id' ){

//     $config['server_url'] = 'http://banksulselbar.co.id/';
//     $config['doc_root']   = 'http://banksulselbar.co.id/';
//     $config['root_dir']   = '/home/bankssb/public_html/';
//     define('DOCROOT', '/home/bankssb/public_html/');

// }
// elseif ($_SERVER['HTTP_HOST']=='www.banksulselbar.co.id' ){

//     $config['server_url'] = 'http://www.banksulselbar.co.id/';
//     $config['doc_root']   = 'http://www.banksulselbar.co.id/';
//     $config['root_dir']   = '/home/bankssb/public_html/';
//     define('DOCROOT', '/home/bankssb/public_html/');

// }
// else{
//     // path and directory application
//     $config['server_url'] = 'http://'.$_SERVER['HTTP_HOST'].'/';
//     $config['doc_root']   = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
//     $config['doc_root']   .= "://".$_SERVER['HTTP_HOST'];
//     $config['doc_root']   .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    
//     $config['root_dir'] = '/mainData/';
//     define('DOCROOT', '/mainData');         
// }

switch ($server_name) {
    case  "10.5.5.56": //
        $config['root_dir'] = '/mainData/';
        define('DOCROOT', '/mainData');
        $config['data_dir'] = $config['root_dir'] . 'data-banksulselbar/';

        $production         = '0'; // false
        $err_reporting      = "E_ALL ^ E_NOTICE";
        break;

    case  "10.5.5.46": // 
        $config['root_dir']   = '/home/bankssb/public_html/';
        define('DOCROOT', '/mainData');
        $config['data_dir'] = $config['root_dir'] . 'data-banksulselbar/';

        $production         = '0';
        $err_reporting      = "0";
        break;

    default:
        $config['root_dir']   = '/home/bankssb/public_html/';
        define('DOCROOT', '/home/bankssb/public_html/');
        $config['data_dir'] = $config['root_dir'] . 'data/';
        $production         = '1'; // true
        $err_reporting      = "0";
        break;
}

$config['template_uri']       = $config['doc_root'] .'assets/';
$config['images_uri']         = $config['doc_root'] .'assets/images/';
$config['images_path']        = $config['data_dir'] . 'images';

$config['production']         = $production;
$config['err_reporting']      = $err_reporting;
$config['google_uacct']       = 'UA-25108613-1';

if ($_SERVER['HTTP_HOST']=='banksulselbar.co.id' || $_SERVER['HTTP_HOST']=='www.banksulselbar.co.id' ){
    $config['images_data']         = $config['doc_root'] . 'images-data/images/';
    $config['images_posts_uri']    = $config['doc_root'] . "images-data/images/posts/";
    $config['images_quotes_uri']   = $config['doc_root'] . "images-data/images/quotes/";
    $config['images_emagz_uri']    = $config['doc_root'] . "images-data/images/emagz/";
    $config['images_event_uri']    = $config['doc_root'] . "images-data/images/events/";
    $config['images_product_uri']  = $config['doc_root'] . "images-data/images/products/";
    $config['images_pages_uri']    = $config['doc_root'] . "images-data/images/pages/";
    $config['images_headline_uri'] = $config['doc_root'] . "images-data/images/headline/";
    $config['images_photo_uri']    = $config['doc_root'] . "images-data/images/photos/";
    $config['images_testi_uri']    = $config['doc_root'] . "images-data/images/testimoni/";
    $config['pdf_dir']             = $config['doc_root'] . 'images-data/files/';     // pdf download
}else{
    $config['images_data']         = $config['doc_root'] . 'images-data/';
    $config['images_posts_uri']    = $config['doc_root'] . "images-data/posts/";
    $config['images_quotes_uri']   = $config['doc_root'] . "images-data/quotes/";
    $config['images_emagz_uri']    = $config['doc_root'] . "images-data/emagz/";
    $config['images_event_uri']    = $config['doc_root'] . "images-data/events/";
    $config['images_product_uri']  = $config['doc_root'] . "images-data/products/";
    $config['images_pages_uri']    = $config['doc_root'] . "images-data/pages/";
    $config['images_headline_uri'] = $config['doc_root'] . "images-data/headline/";
    $config['images_photo_uri']    = $config['doc_root'] . "images-data/photos/";
    $config['images_testi_uri']    = $config['doc_root'] . "images-data/testimoni/";
    $config['pdf_dir']             = $config['doc_root'] . 'files-data/';     // pdf download
}

$config['captcha_site_key']   = '6LcfrewSAAAAAG4Flh2Nj_A2jsTNBzmFo-PXFRmy';
$config['captcha_secret_key'] = '6LcfrewSAAAAAPfRrUPCMYPiwzvbisMfGx3rK_1U';

$config['google_uacct']       = 'UA-93061236-1';
?>
