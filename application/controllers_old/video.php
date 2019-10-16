<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('contents_model');
		$this->load->helper('contentdate');
		error_reporting(E_ALL);
	}

	public function index()
	{

		$kanal = strip_tags($this->uri->segment(1));
		$page  = strip_tags($this->uri->segment(2));
		
		$output['page_title'] = ucwords(str_replace('-', ' ', $kanal));

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css'] .= add_css('css/bootstrap.min.css.css');
		$mainData['top_css'] .= add_css('css/style.css');
		$mainData['top_css'] .= add_css('css/responsive.css');
		$mainData['top_css'] .= add_css('css/full-slider.css.css');
		$mainData['top_css'] .= add_css('assets/fonts/font-awesome-4.6.3/css/font-awesome.css');

		$mainData['bottom_js'] .= add_js('js/jquery-2.2.4.min.js');
		$mainData['bottom_js'] .= add_js('js/bootstrap.min.js');
		$mainData['bottom_js'] .= add_js('js/vendor.js');

		if ($this->config->item('production')) {
            error_reporting(0);
            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

		// ------------------- CONTENT -----------------------
		$idkanal = 0;
		$limit   = 9;
		if (empty($page)) {
            $offset = 0;
        }else{
            $offset = ($page * $limit) - $limit;
        }

		$breaking = $this->contents_model->get_video_breaking($idkanal, $offset, $limit);
		$count    = $this->contents_model->get_total_video($idkanal);

		$baseURL = base_url(). $this->uri->segment(1);
		$paging_uri = 2;
		$output['kanal_title']  = 'Galeri/Video';
		$mainData['page_title'] = $output['kanal_title'];
		
		$output['articles'] = $breaking;

		// --------- PAGINATION --------------
		$this->load->library('pagination');
		$config['base_url']     = $baseURL;
        $config['uri_segment']  = $paging_uri;
        $config['total_rows']   = $count['itotal'];
        $config['per_page']     = $limit;
        $config['num_links']    = 3;                // jml links disamping kanan-kiri link yg sdg aktif
        $config['use_page_numbers'] = TRUE;         // Gunakan penomoran 1, 2, 3, dst di URL

		$config['full_tag_open']  = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['next_link']      = '<i class="fa fa-angle-right"></i>';
		$config['next_tag_open']  = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link']      = '<i class="fa fa-angle-left"></i>';
		$config['prev_tag_open']  = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open']   = '<li class="active"><a href="javascript:;">';
		$config['cur_tag_close']  = '</a></li>';
		$config['num_tag_open']   = '<li>';
		$config['num_tag_close']  = '</li>';
        
        $this->pagination->initialize($config);
        $output['pagination'] = $this->pagination->create_links();
        // --------- PAGINATION END --------------

		$mainData['meta']['descriptions'] = $breaking[0]['c_summary'];
		$mainData['meta']['keywords']     = ((!empty($breaking[0]['c_keyword'])) ? $breaking[0]['c_keyword'].',' : '') . str_replace(' ', ',', ($breaking[0]['c_title']));

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content']  = $this->load->view('gallery/vvideo', $output, true);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);

		$this->load->view('vbase', $mainData);
	}

	function read()
	{
		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css'] .= add_css('css/bootstrap.min.css');
		$mainData['top_css'] .= add_css('css/style.css');
		$mainData['top_css'] .= add_css('css/full-slider.css');
		$mainData['top_css'] .= add_css('css/responsive.css');
		$mainData['top_css'] .= add_css('fonts/font-awesome-4.6.3/css/font-awesome.css');

		$mainData['bottom_js'] .= add_js('js/jquery-2.2.4.min.js');
		$mainData['bottom_js'] .= add_js('js/bootstrap.min.js');	
		$mainData['bottom_js'] .= add_js('js/navbar.js');

		if ($this->config->item('production')) {
            error_reporting(0);
            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

		// ------------------- CONTENT -----------------------
		$idkanal = $this->uri->segment(4);;
		$limit   = 6;
		if (empty($page)) {
            $offset = 0;
        }else{
            $offset = ($page * $limit) - $limit;
        }

		$breaking = $this->contents_model->get_single_video($idkanal);
		$count    = $this->contents_model->get_total_video($idkanal);

		$baseURL = base_url(). $this->uri->segment(1);
		$paging_uri = 2;
		$output['kanal_title']  = ' Galeri/Video';
		$mainData['page_title'] = $output['kanal_title'];
		
		$output['articles'] = $breaking;

		$mainData['meta']['descriptions'] = $breaking[0]['c_summary'];
		$mainData['meta']['keywords']     = ((!empty($breaking[0]['c_keyword'])) ? $breaking[0]['c_keyword'].',' : '') . str_replace(' ', ',', ($breaking[0]['c_title']));

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('gallery/vvideo_detail', $output, true);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
        
		$this->load->view('vbase', $mainData);
	}

}

/* End of file video.php */