<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('contents_model');
		$this->load->model('photo_model');
		$this->load->helper('contentdate');
	}

	public function index()
	{
		$c['top_css']   = '';
		$c['top_js']    = '';
		$c['bottom_js'] = '';

		$c['top_css']   .= add_css('js/fullcalendar-2-9-1/fullcalendar.css');
		$c['bottom_js']   .= add_js('js/moment.js');
		$c['bottom_js']   .= add_js('js/fullcalendar-2-9-1/fullcalendar.js');
		$c['bottom_js']   .= add_js('js/data/calendar.js');


		if ($this->config->item('production')) {
            error_reporting(0);

            $c['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

        // --------- CONTENT ----------------------
		$c['berita'] = $this->contents_model->get_list_breaking(6, 0, 1);	// channel berita, offset, limit
		$photos = $this->photo_model->get_photo_album(0, 0, 3);	//offset, limit

		$c['photos'] = $photos['data'];


		$sitemap = $this->config->item('site_map');
		$page_slug = $this->uri->segment(2);
		$page_id = $sitemap[$page_slug];

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
		$mainData['main_content'] = $this->load->view('content/vinformasi', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

}

/* End of file informasi.php */