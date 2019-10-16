<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('contents_model');
		$this->load->model('page_model');
		$this->load->model('headline_model');

		$this->load->helper('contentdate');
		$this->load->helper('text');
		error_reporting(E_ALL);
	}

	function index()
	{
		/*$mainData['top_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }*/

        // --------- CONTENT ----------------------

		$c['data'] = '';

		$c['csr']       = $this->contents_model->get_list_breaking(7, 0, 1);	// channel csr, offset, limit
		$c['berita']    = $this->contents_model->get_list_breaking(6, 0, 3);	// channel berita, offset, limit
		$c['sejarah']   = $this->page_model->get_page_byid(5);
		$c['headline']  = $this->headline_model->getData('headlines',array('h_status'=>1),'h_id'); // get Headline
		$c['testimoni'] = $this->headline_model->getTestimoni("SELECT * FROM testimoni WHERE testimoni_status = 1 ORDER BY testimoni_id DESC limit 0,3"); // get Testiomoni
		$c['highlight'] = $this->contents_model->get_highlight();

		//_d($c['highlight']);

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

}

/* End of file home.php */