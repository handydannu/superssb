<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('contents_model');
		$this->load->model('page_model');
		$this->load->model('headline_model');
		$this->load->model('photo_model');
		$this->load->model('download_model');

		$this->load->helper('contentdate');
		$this->load->helper('text');
		// error_reporting(E_ALL);
	}

	function index()
	{
		$mainData['top_js'] = '';

		$mainData['meta']['descriptions'] = 'Bank Sulawesi Selatan dan Sulawesi Barat';
		$mainData['meta']['keywords']     = 'BPD, Bank, Sulsel, BankSulsel, Sulawesi, Sulawesi Selatan, Bank Daerah, Bank Sulawesi Barat, Makassar,Asbanda,Asosiasi Bank Daerah,Bank Sulselbar,Asosiasi Bank Daerah';
		
		if ($this->config->item('production')) {
            error_reporting(0);
            $mainData['top_js'] .= google_analytics($this->config->item('google_uacct'));
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }
        
        	// ------------------- CONTENT -----------------------
		$limit = 5;
		$id    = 24;

		if (empty($page)) {
            $offset = 0;
        }else{
            $offset = ($page * $limit) - $limit;
        }
        
		$post 		= $this->download_model->get_all_lainnya($offset, $limit);
		$total 		= $this->download_model->get_total_all_lainnya();

		$c['files_lain']	 = $post['data'];
		$c['yearlist']  = $this->download_model->get_year_download($id);

		
        
        
        // --------- CONTENT ----------------------

		$c['data'] = '';

		$c['csr']       = $this->contents_model->get_list_breaking(7, 0, 1);	// channel csr, offset, limit
		$c['berita']    = $this->contents_model->get_list_breaking(6, 0, 4);
		$c['artikel']   = $this->contents_model->get_list_breaking(28, 0, 6);	// channel Artikel, offset, limit
		$c['sejarah']   = $this->page_model->get_page_byid(5);
		$c['headline']  = $this->headline_model->getData('headlines',array('h_status'=>1),'h_id','',5,0); // get Headline 
		$c['testimoni'] = $this->headline_model->getTestimoni("SELECT * FROM testimoni WHERE testimoni_status = 1 ORDER BY testimoni_id DESC limit 0,1"); // get Testiomoni
		$c['highlight'] = $this->contents_model->get_highlight();
		$idkanal = 0;
		$limit   = 2;
		if (empty($page)) {
            $offset = 0;
        }else{
            $offset = ($page * $limit) - $limit;
        }

		$breaking 	= $this->contents_model->get_video_breaking($idkanal, $offset, 1);
		$c['video'] = $breaking;
		$c['album']	= $this->photo_model->get_album_last();
		$c['foto']	= $this->photo_model->get_photo_album_home();
		//_d($c['highlight']);


		//pengumuman
		// ------------------- CONTENT -----------------------
		$limit = 5;
		$id    = 25;

		if (empty($page)) {
            $offset = 0;
        }else{
            $offset = ($page * $limit) - $limit;
        }

        $tahun = strip_tags($this->uri->segment(3));
        if(empty($tahun)){
        	$year = date('Y');
        }
        else{
        	$year = $this->uri->segment(3);
        }

        $yearActive	= $this->download_model->get_year_download_sort($id);
		foreach ($yearActive->result() as $rows) {
			$c['aktif'] = $rows->doc_year;
		}
        
		$post 		= $this->download_model->get_all_lelang($year, $offset, $limit);
		$total 		= $this->download_model->get_total_all_lelang($year);

		$c['files']	 = $post['data'];
		$c['yearlist']  = $this->download_model->get_year_download($id);
		//!--pengumuman



		$meta_fb = array(
            'url'         => (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
            'type'        => 'article',
            'title'       => 'Bank Sulselbar - Melayani Sepenuh Hati',
            'image'       => $this->config->item('images_uri').'logo-big.png',
            'site_name'   => 'banksulselbar.co.id',
            'description' => 'Bank Sulawesi Selatan dan Sulawesi Barat'
            );

        $mainData['meta']['facebook_tags'] = metaname_facebook($meta_fb);

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('home/vcontent', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);

		$this->load->view('vbase', $mainData);
	}

}

/* End of file home.php */
