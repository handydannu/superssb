<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artikel extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('contents_model');
		$this->load->model('photo_model');

		$this->load->helper('contentdate');
		$this->load->helper('text');

		//error_reporting(E_ALL);
	}

	public function index()
	{
		// ====== Show List Article ======

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics($this->config->item('google_uacct'));
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }


		// ------------- CONTENT ----------------
		$page  = strip_tags($this->uri->segment(2));
		
		$idkanal = 28;	// berita

		$limit = 5;
		if (empty($page)) {
            $offset = 0;
        }else{
            $offset = ($page * $limit) - $limit;
        }

		$breaking = $this->contents_model->get_list_breaking($idkanal, $offset, $limit);
		$count    = $this->contents_model->get_total_breaking_by_channel($idkanal);

		//_d($breaking);

		$baseURL = base_url(). $this->uri->segment(1);
		$paging_uri = 2;

		$mainData['page_title']           = 'Artikel BankSulselbar';
		$mainData['meta']['descriptions'] = 'Artikel terbaru Bank Sulawesi Selatan dan Sulawesi Barat';
		$mainData['meta']['keywords']     = 'BPD, Bank, Sulsel, BankSulsel, Sulawesi, Sulawesi Selatan, Bank Daerah, Bank Sulawesi Barat, Makassar,Asbanda,Asosiasi Bank Daerah,Bank Sulselbar,Asosiasi Bank Daerah';

		$c['articles'] = $breaking;
		$video_list = $this->contents_model->get_video_breaking($idkanal, $offset, 1);
		$c['video'] = $video_list;
		$c['foto']	= $this->photo_model->get_photo_album_home();

		$meta_fb = array(
            'url'         => (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
            'type'        => 'article',
            'title'       => 'Artikel Bank Sulselbar - Melayani Sepenuh Hati',
            'image'       => $this->config->item('images_uri').'logo-big.png',
            'site_name'   => 'banksulselbar.co.id',
            'description' => 'Artikel terbaru Bank Sulawesi Selatan dan Sulawesi Barat'
            );
		
        $mainData['meta']['facebook_tags'] = metaname_facebook($meta_fb);		

		// --------- PAGINATION --------------
		$this->load->library('pagination');
		$config['base_url']     = $baseURL;
        $config['uri_segment']  = $paging_uri;
        $config['total_rows']   = $count['itotal'];
        $config['per_page']     = $limit;
        $config['num_links']    = 3;                // jml links disamping kanan-kiri link yg sdg aktif
        $config['use_page_numbers'] = TRUE;         // Gunakan penomoran 1, 2, 3, dst di URL

		$config['full_tag_open']   = '<ul class="pagination">';
		$config['full_tag_close']  = '</ul>';
		$config['first_tag_open']  = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open']   = '<li>';
		$config['last_tag_close']  = '</li>';
		$config['next_link']       = '<i class="fa fa-angle-right"></i>';
		$config['next_tag_open']   = '<li>';
		$config['next_tag_close']  = '</li>';
		$config['prev_link']       = '<i class="fa fa-angle-left"></i>';
		$config['prev_tag_open']   = '<li>';
		$config['prev_tag_close']  = '</li>';
		$config['cur_tag_open']    = '<li class="active"><a href="javascript:;">';
		$config['cur_tag_close']   = '</a></li>';
		$config['num_tag_open']    = '<li>';
		$config['num_tag_close']   = '</li>';
        
        $this->pagination->initialize($config);
        $c['pagination'] = $this->pagination->create_links();
        // --------- PAGINATION END --------------
		
		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vartikel', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

	public function detail()
	{
		// ====== Show Detail Article ======

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';


		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics($this->config->item('google_uacct'));
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }


		// ------------- CONTENT ----------------
		$ID = $this->uri->segment(3);
		$detail = $this->contents_model->get_single_content($ID);

		//_d($detail);

		$c['detail'] = $detail;
		$c['share']  = shareSocmedia($detail['c_title'], current_url());

		$path = parseDateTime($detail['c_created_date']);
		$image_ = $this->config->item('images_posts_uri') .  $path['year'] . '/' . $path['month'] . '/' . $path['day'] . '/' . $detail['c_id'] . '/' . $detail['c_images_content'];

		$c['img_article'] = $image_;

		$pdate = parseDateTime($detail['c_publish_date']);
		$c['showdate'] = $pdate['day_ind_name'] .' | '. $pdate['day'] .' '. $pdate['month_ind_name'] .' '. $pdate['year'];

        $meta_fb = array(
            'url'         => (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
            'type'        => 'article',
            'title'       => ((!empty($detail['c_subtitle'])) ? $detail['c_subtitle'].': ' : '') . $detail['c_title'] . ' - banksulselbar.co.id',
            'image'       => $image_,
            'site_name'   => 'banksulselbar.co.id',
            'description' => $detail['c_summary']
            );
        $mainData['meta']['facebook_tags'] = metaname_facebook($meta_fb);
		
		$mainData['page_title']           = $detail['c_title'];
		$mainData['meta']['descriptions'] = $detail['c_summary'];
		$mainData['meta']['keywords']     = ((!empty($detail['c_keyword'])) ? $detail['c_keyword'].',' : '') . str_replace(' ', ',', ($detail['c_title']));
		
		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vberita_detail', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);

		// ----------- Hits ----------
        //if ($this->config->item('production'))
        //{
            $this->load->model('hit');
            $this->hit->insert_hit($ID);
        //}
        // --------- End Of Hits --------
	}

	

}

/* End of file berita.php */