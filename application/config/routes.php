<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/* assign asyncronous url via routers (prevent 404 page) */


$route['404_override']       = 'error/index';
$route['default_controller'] = "home";

$route['search']             = "search/index";
$route['search/(.*)']        = "search/index/$1";
$route['rss']                = "rss/index";

$route['page']               = "page/index";
$route['page/(.*)']          = "page/index/$1";

$route['kalkulator-kredit']	 = "kalkulator/index";
$route['kantor-cabang']		 = "jaringan/kantor_cabang";
$route['kantor-kas']		 = "jaringan/kantor_kas";
$route['lokasi-atm']		 = "jaringan/lokasi_atm";
$route['payment-point']		 = "jaringan/payment_point";
$route['office-channeling']	 = "jaringan/office_channeling";
$route['mobil-kas-keliling'] = "jaringan/mobil_kas";


$route['berita']             = "berita/index";
$route['berita/(.*)']        = "berita/index/$1";

$route['artikel']            = "artikel/index";
$route['artikel/(.*)']       = "artikel/index/$1";

$route['read']               = "berita/detail";
$route['read/(.*)']          = "berita/detail/$1";

$route['foto']             	 = "gallery/index";
$route['foto/read/(.*)']   	 = "gallery/read/$1";
$route['foto/(.*)']       	 = "gallery/index/$1";

$route['video']				 = "video/index";
$route['video/read(.*)']     = "video/read/$1";
$route['video/(.*)']       	 = "video/index/$1";

$route['download'] = "download/index";

$route['download/pengumuman-lelang']		= "download/lelang";
$route['download/pengumuman-lelang/(.*)'] 	= "download/lelang/$1";

$route['download/laporan-tahunan']			= "download/laporan_tahunan";
$route['download/laporan-tahunan/(.*)'] 	= "download/laporan_tahunan/$1";

$route['download/sbdk']						= "download/sbdk";
$route['download/sbdk/(.*)'] 				= "download/sbdk/$1";

$route['download/gcg']						= "download/gcg";
$route['download/gcg/(.*)'] 				= "download/gcg/$1";

$route['download/other']					= "download/other";
$route['download/other/(.*)'] 				= "download/other/$1";

$route['download/laporan-keuangan-publikasi']		= "download/laporan_keuangan";
$route['download/laporan-keuangan-publikasi/(.*)'] 	= "download/laporan_keuangan/$1";

$route['loadmore']                = "loadmore/index";
$route['loadmore/testimoni/(.*)'] = "loadmore/testimoni/$1";

$route['search']                  = "search/index";
$route['search/(.*)']             = "search/index/$1";

$route['agenda-kegiatan']         = "agenda/index";
$route['agenda-kegiatan/(.*)']    = "agenda/detail/$1";

$route['captcha']                 = "captcha/index";
$route['captcha/(.*)']            = "captcha/index/$1";

$route['sbdk']						= "download/sbdk";
$route['sbdk/(.*)'] 				= "download/sbdk/$1";

$route['privacy'] = 'privacy/index';

/* End of file routes.php */
/* Location: ./application/config/routes.php */