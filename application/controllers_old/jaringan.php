<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jaringan extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('contents_model');
		$this->load->model('jaringan_model');
		$this->load->helper('contentdate');
		$this->load->helper('text');
		// error_reporting(E_ALL);
	}

	function index()
	{
		$mainData['top_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

        // --------- CONTENT ----------------------
		$sitemap = $this->config->item('site_map');
		$parent  = $this->config->item('parent_map');

		$c['data'] = '';

		// _d($mainData['emagz']);
		/*$meta_fb = array(
            'url'         => (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
            'type'        => 'article',
            'title'       => 'Semen Tiga Roda',
            'image'       => $this->config->item('images_uri').'sementigaroda.jpg',
            'site_name'   => 'sementigaroda.com',
            'description' => 'Semen Tiga Roda, Kokoh dan Terpercaya'
            );
        $mainData['meta']['facebook_tags'] = metaname_facebook($meta_fb);*/

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('home/vcontent', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

	function kantor_cabang()
	{
		$mainData['top_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

        $mainData['bottom_js'] .= add_js('js/datatables-1-10-3/js/jquery.dataTables.min.js');
		// use this js for this page
		$mainData['bottom_js'] .= add_js('js/data/jaringan.js');

        // --------- CONTENT ----------------------
		$sitemap = $this->config->item('site_map');
		$parent  = $this->config->item('parent_map');

		$c['data'] = '';
		$c['title'] = ' / Jaringan / Kantor Cabang';
		$c['share']  = shareSocmedia(current_url());

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/jaringan/vkantor_cabang', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

	function json_kantorcabang()
	{		
		$data = $this->jaringan_model->get_kantor_cabang();
		print_r($data);
	}

	function kantor_kas()
	{
		$mainData['top_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

        $mainData['bottom_js'] .= add_js('js/datatables-1-10-3/js/jquery.dataTables.min.js');
		// use this js for this page
		$mainData['bottom_js'] .= add_js('js/data/jaringan.js');

        // --------- CONTENT ----------------------
		$sitemap = $this->config->item('site_map');
		$parent  = $this->config->item('parent_map');

		$c['data'] = '';
		$c['title'] = ' / Jaringan / Kantor Kas';
		$c['share']  = shareSocmedia(current_url());


		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/jaringan/vkantor_kas', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

	function json_kantorkas()
	{		
		$data = $this->jaringan_model->get_kantor_kas();
		print_r($data);
	}

	function lokasi_atm()
	{
		$mainData['top_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

        $mainData['bottom_js'] .= add_js('js/datatables-1-10-3/js/jquery.dataTables.min.js');
		// use this js for this page
		$mainData['bottom_js'] .= add_js('js/data/jaringan.js');

        // --------- CONTENT ----------------------
		$sitemap = $this->config->item('site_map');
		$parent  = $this->config->item('parent_map');

		$c['data'] = '';
		$c['title'] = ' / Jaringan / Lokasi ATM';
		$c['share']  = shareSocmedia(current_url());


		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/jaringan/vlokasi_atm', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

	function json_lokasiatm()
	{		
		$data = $this->jaringan_model->get_lokasi_atm();
		print_r($data);
	}

	function payment_point()
	{
		$mainData['top_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

        $mainData['bottom_js'] .= add_js('js/datatables-1-10-3/js/jquery.dataTables.min.js');
		// use this js for this page
		$mainData['bottom_js'] .= add_js('js/data/jaringan.js');

        // --------- CONTENT ----------------------
		$sitemap = $this->config->item('site_map');
		$parent  = $this->config->item('parent_map');

		$c['data'] = '';
		$c['title'] = ' / Jaringan / Payment Point';
		$c['share']  = shareSocmedia(current_url());


		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/jaringan/vpayment_point', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

	function json_paymentpoint()
	{		
		$data = $this->jaringan_model->get_payment_point();
		print_r($data);
	}
}

/* End of file home.php */