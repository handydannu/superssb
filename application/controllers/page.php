<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
		$this->load->model('contents_model');
		$this->load->helper('contentdate');
	}

	public function index()
	{
		$mainData['top_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);
           	$mainData['top_js'] .= google_analytics($this->config->item('google_uacct'));
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

        // --------- CONTENT ----------------------
		$sitemap = $this->config->item('site_map');
		$page_slug = $this->uri->segment(2);
		$page_id = $sitemap[$page_slug];

		// echo $page_id;

		$content = $this->page_model->get_page_byid($page_id);

		//_d($content);
		$mainData['page_title'] = $content['p_title']." - Bank Sulselbar";
		$mainData['meta']['descriptions'] = $content['p_summary'];
		$mainData['meta']['keywords']     = str_replace(' ', ',', ($content['p_title']));

		$c['page_data'] = $content;

		$meta_fb = array(
            'url'         => (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
            'type'        => 'article',
            'title'       => $mainData['page_title'],
            'image'       => $this->config->item('images_uri').'logo-big.png',
            'site_name'   => 'banksulselbar.co.id',
            'description' => $mainData['meta']['descriptions']
            );
        $mainData['meta']['facebook_tags'] = metaname_facebook($meta_fb);

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('pages/vcontent', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

}

/* End of file page.php */