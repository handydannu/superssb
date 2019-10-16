<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privacy extends CI_Controller {


	public function index()
	{
		$mainData['top_js'] = '';

        // --------- CONTENT ----------------------
		$sitemap = $this->config->item('site_map');

		$this->load->view('template/vnavigation.php', NULL, TRUE);
		$this->load->view('content/vprivacy.php', $data);
		$this->load->view('template/vfooter.php', $data);
		
		$this->load->view('vbase', $mainData);
	}

}

/* End of file page.php */
