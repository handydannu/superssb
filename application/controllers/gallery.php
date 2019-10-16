<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('photo_model');

		$this->load->helper('contentdate');
		$this->load->helper('text');
		//error_reporting(E_ALL);
	}

	public function index()
	{
		// ====== Show GALERI ======

		$mainData['page_title']    = 'Galeri Foto';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

		// ------------- CONTENT ----------------
		$page  = strip_tags($this->uri->segment(2));

		$limit = 9;

		if ($page=='' || is_numeric($page))
		{
	        $channel_id = 0;
        }else{
        	$sitemap    = $this->config->item('site_map');
        	//$channel_id = $sitemap[$page];
        	$channel_id = $page;
        	$page       = strip_tags($this->uri->segment(3));
        }

        if (empty($page)) {
            $offset = 0;
        }else{
            $offset = ($page * $limit) - $limit;
        }
		$photo_albums = $this->photo_model->get_photo_album($channel_id, $offset ,$limit);	//offset, limit

		// $output['pchannels'] = $this->photo_model->get_channel_photo();

		$output['albums']               = $photo_albums['data'];
		$output['total_album']          = $photo_albums['total_album']['itotal'];
		$output['total_foto']           = $photo_albums['total_photo'];
		$output['totalpages']           = ceil($photo_albums['total_album']['itotal']/$limit);
		$mainData['meta']['descriptions'] = $photo_albums['data'][0]['album_title'];
		$mainData['meta']['keywords']     = str_replace(' ', ',', ($photo_albums['data'][0]['album_title']));

        $baseURL 	= base_url(). $this->uri->segment(1);
		$paging_uri = 2;
		$total 		= $output['total_album'];

        // --------- PAGINATION --------------
		$this->load->library('pagination');
		$config['base_url']     = $baseURL;
        $config['uri_segment']  = $paging_uri;
        $config['total_rows']   = $photo_albums['total_album']['itotal'];
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
        $output['pagination'] = $this->pagination->create_links();
        // --------- PAGINATION END --------------

        $meta_fb = array(
            'url'         => (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
            'type'        => 'Foto',
            'title'       => $mainData['page_title'],
            'site_name'   => 'banksulselbar.co.id',
            'description' => $mainData['meta']['descriptions']
            );
        $mainData['meta']['facebook_tags'] = metaname_facebook($meta_fb);

        $mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content']  = $this->load->view('gallery/vgallery', $output, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
        
		$this->load->view('vbase', $mainData);
	}

	function read()
	{
		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

		// ------------- CONTENT ----------------
		$albumID      = $this->uri->segment(4);
		$photo        = $this->photo_model->get_single_album($albumID);
		$other_photos = $this->photo_model->get_other_photos($albumID, 0, 3);

		$mainData['page_title']       = $photo[0]['album_title'];
		$output['photos']             = $photo;
		$output['other_photos']       = $other_photos['data'];
		$output['other_photos_total'] = $other_photos['total_photo'];
		$output['share']              = shareSocmedia($photo[0]['album_title'], current_url());

		$mainData['meta']['descriptions'] = $mainData['page_title'];
		$mainData['meta']['keywords']     = str_replace(' ', ',', ($mainData['page_title']));

		$path   = parseDateTime($photo[0]['album_created_date']);
		$image_ = $this->config->item('images_data') .'photos/'.  $path['year'] . '/' . $path['month'] . '/' . $path['day'] . '/' . $photo[0]['album_id'] . '/' . $photo[0]['ph_images'];

		$meta_fb = array(
            'url'         => (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
            'type'        => 'Foto',
            'title'       => $mainData['page_title'],
            'site_name'   => 'banksulselbar.co.id',
            'description' => $mainData['meta']['descriptions']
            );
        $mainData['meta']['facebook_tags'] = metaname_facebook($meta_fb);

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content']  = $this->load->view('gallery/vdetail', $output, true);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
        
		$this->load->view('vbase', $mainData);
	}

}

/* End of file gallery.php */