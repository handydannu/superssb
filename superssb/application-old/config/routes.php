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

$route['default_controller'] = "dashboard";
$route['404_override']       = 'error/error404';

$route['lock']               = 'dashboard/lock';

$route['image/add']          = 'image/add';
$route['image/edit']         = 'image/edit';
$route['image/delete/(.*)']  = 'image/delete/$1';
$route['image/(.*)']         = 'image/index/$1';

$route['profile']            = 'personal/profile';
$route['edit-profile']       = 'personal/edit';

$route['profil-perusahaan']               = 'pages/index';
$route['profil-perusahaan/json']          = 'pages/json';
$route['profil-perusahaan/add']           = 'pages/add';
$route['profil-perusahaan/edit/(.*)']     = 'pages/edit/$1';
$route['profil-perusahaan/delete/(.*)']   = 'pages/delete/$1';

$route['akses-informasi']                 = 'pages/index';
$route['akses-informasi/json']            = 'pages/json';
$route['akses-informasi/add']             = 'pages/add';
$route['akses-informasi/edit/(.*)']       = 'pages/edit/$1';
$route['akses-informasi/delete/(.*)']     = 'pages/delete/$1';

$route['sumber-daya-manusia']             = 'pages/index';
$route['sumber-daya-manusia/json']        = 'pages/json';
$route['sumber-daya-manusia/add']         = 'pages/add';
$route['sumber-daya-manusia/edit/(.*)']   = 'pages/edit/$1';
$route['sumber-daya-manusia/delete/(.*)'] = 'pages/delete/$1';

$route['teknologi-informasi']             = 'pages/index';
$route['teknologi-informasi/json']        = 'pages/json';
$route['teknologi-informasi/add']         = 'pages/add';
$route['teknologi-informasi/edit/(.*)']   = 'pages/edit/$1';
$route['teknologi-informasi/delete/(.*)'] = 'pages/delete/$1';

$route['manajemen-resiko']                = 'pages/index';
$route['manajemen-resiko/json']           = 'pages/json';
$route['manajemen-resiko/add']            = 'pages/add';
$route['manajemen-resiko/edit/(.*)']      = 'pages/edit/$1';
$route['manajemen-resiko/delete/(.*)']    = 'pages/delete/$1';

$route['csr']                    = 'berita/index';
$route['csr/json']               = 'berita/json';
$route['csr/add']                = 'berita/add';
$route['csr/submit_add']         = 'berita/submit_add';
$route['csr/edit/(.*)']          = 'berita/edit/$1';
$route['csr/delete/(.*)']        = 'berita/delete/$1';
$route['csr/release/(.*)']       = 'berita/release/$1';
$route['csr/publish/(.*)']       = 'berita/publish/$1';
$route['csr/submit_update/(.*)'] = 'berita/submit_update/$1';

$route['simpanan']               = 'pages/index';
$route['simpanan/json']          = 'pages/json';
$route['simpanan/add']           = 'pages/add';
$route['simpanan/edit/(.*)']     = 'pages/edit/$1';
$route['simpanan/delete/(.*)']   = 'pages/delete/$1';

$route['simpanan-tapemda']             = 'pages/index';
$route['simpanan-tapemda/json']        = 'pages/json';
$route['simpanan-tapemda/add']         = 'pages/add';
$route['simpanan-tapemda/edit/(.*)']   = 'pages/edit/$1';
$route['simpanan-tapemda/delete/(.*)'] = 'pages/delete/$1';

$route['pinjaman']                     = 'pages/index';
$route['pinjaman/json']                = 'pages/json';
$route['pinjaman/add']                 = 'pages/add';
$route['pinjaman/edit/(.*)']           = 'pages/edit/$1';
$route['pinjaman/delete/(.*)']         = 'pages/delete/$1';

$route['jasa-bank']                    = 'pages/index';
$route['jasa-bank/json']               = 'pages/json';
$route['jasa-bank/add']                = 'pages/add';
$route['jasa-bank/edit/(.*)']          = 'pages/edit/$1';
$route['jasa-bank/delete/(.*)']        = 'pages/delete/$1';

$route['syariah']                      = 'pages/index';
$route['syariah/json']                 = 'pages/json';
$route['syariah/add']                  = 'pages/add';
$route['syariah/edit/(.*)']            = 'pages/edit/$1';
$route['syariah/delete/(.*)']          = 'pages/delete/$1';

$route['atm']                          = 'pages/index';
$route['atm/json']                     = 'pages/json';
$route['atm/add']                      = 'pages/add';
$route['atm/edit/(.*)']                = 'pages/edit/$1';
$route['atm/delete/(.*)']              = 'pages/delete/$1';

$route['garansi-bank']                 = 'pages/index';
$route['garansi-bank/json']            = 'pages/json';
$route['garansi-bank/add']             = 'pages/add';
$route['garansi-bank/edit/(.*)']       = 'pages/edit/$1';
$route['garansi-bank/delete/(.*)']     = 'pages/delete/$1';

$route['produk-dan-jasa-uus']             = 'pages/index';
$route['produk-dan-jasa-uus/json']        = 'pages/json';
$route['produk-dan-jasa-uus/add']         = 'pages/add';
$route['produk-dan-jasa-uus/edit/(.*)']   = 'pages/edit/$1';
$route['produk-dan-jasa-uus/delete/(.*)'] = 'pages/delete/$1';

$route['karir']                          = 'pages/index';
$route['karir/json']                     = 'pages/json';
$route['karir/add']                      = 'pages/add';
$route['karir/edit/(.*)']                = 'pages/edit/$1';
$route['karir/delete/(.*)']              = 'pages/delete/$1';

// DOWNLOAD
$route['annual-report']             = 'download/index';
$route['annual-report/json']        = 'download/json';
$route['annual-report/add']         = 'download/add';
$route['annual-report/edit/(.*)']   = 'download/edit/$1';
$route['annual-report/delete/(.*)'] = 'download/delete/$1';

$route['gcg']                       = 'download/index';
$route['gcg/json']                  = 'download/json';
$route['gcg/add']                   = 'download/add';
$route['gcg/edit/(.*)']             = 'download/edit/$1';
$route['gcg/delete/(.*)']           = 'download/delete/$1';

$route['data-lainnya']                       = 'download/index';
$route['data-lainnya/json']                  = 'download/json';
$route['data-lainnya/add']                   = 'download/add';
$route['data-lainnya/edit/(.*)']             = 'download/edit/$1';
$route['data-lainnya/delete/(.*)']           = 'download/delete/$1';

$route['lelang']                       = 'download/index';
$route['lelang/json']                  = 'download/json';
$route['lelang/add']                   = 'download/add';
$route['lelang/edit/(.*)']             = 'download/edit/$1';
$route['lelang/delete/(.*)']           = 'download/delete/$1';

$route['sbdk']                       = 'download/index';
$route['sbdk/json']                  = 'download/json';
$route['sbdk/add']                   = 'download/add';
$route['sbdk/edit/(.*)']             = 'download/edit/$1';
$route['sbdk/delete/(.*)']           = 'download/delete/$1';
/* End of file routes.php */
/* Location: ./application/config/routes.php */