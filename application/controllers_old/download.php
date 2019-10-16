<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends CI_Controller {

	/*
	 * Download PDF FIle
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('contents_model');
		$this->load->model('download_model');
		$this->load->helper('contentdate');
		error_reporting(E_ALL);
	}

	public function lelang()
	{
		$page  = strip_tags($this->uri->segment(4));

		$output['page_title'] = 'Download Berkas Pengumuman Lelang - Bank Sulselbar';
		$mainData['page_title'] = 'Download Berkas Pengumuman Lelang - Bank Sulselbar';

		$mainData['meta']['descriptions'] = "Bank Sulawesi Selatan dan Sulawesi Barat";
		$mainData['meta']['keywords']     = str_replace(' ', ',', ($mainData['page_title']));


		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

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
			$output['aktif'] = $rows->doc_year;
		}
        
		$post 		= $this->download_model->get_all_lelang($year, $offset, $limit);
		$total 		= $this->download_model->get_total_all_lelang($year);

		$output['files']	 = $post['data'];
		$output['yearlist']  = $this->download_model->get_year_download($id);

		$baseURL = base_url('download/pengumuman-lelang/'.$year);

		// --------- PAGINATION --------------
		$this->load->library('pagination');
		$config['base_url']     = $baseURL;
        $config['uri_segment']  = 4;
        $config['total_rows']   = $total['itotal'];
        $config['per_page']     = $limit;
        $config['num_links']    = 3;                // jml links disamping kanan-kiri link yg sdg aktif
        $config['use_page_numbers'] = TRUE;         // Gunakan penomoran 1, 2, 3, dst di URL

		$config['full_tag_open']  = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open']  = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open']   = '<li>';
		$config['last_tag_close']  = '</li>';
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

		$meta_fb = array(
            'url'         => (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
            'type'        => 'article',
            'title'       => $mainData['page_title'],
            'site_name'   => 'banksulselbar.co.id',
            'description' => $mainData['meta']['descriptions']
            );
        $mainData['meta']['facebook_tags'] = metaname_facebook($meta_fb);

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vdownload', $output, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);

		$this->load->view('vbase', $mainData);
	}

	public function laporan_tahunan()
	{
		$page  = strip_tags($this->uri->segment(4));
		
		$output['page_title'] = 'Download Berkas Laporan Tahunan - Bank Sulselbar';
		$mainData['page_title'] = 'Download Berkas Laporan Tahunan - Bank Sulselbar';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

		// ------------------- CONTENT -----------------------
		$limit = 5;
		$id    = 16;

		
		if (empty($page)) {
            $offset = 0;
        }else{
            $offset = ($page * $limit) - $limit;
        }

        $tahun = $this->uri->segment(3);
        if(empty($tahun)){
        	$year = date('Y');
        	$tot = $this->download_model->get_total_all_laporan_tahunan($year);
        	if($tot['itotal']=='0'){										// mengecek jika tahun saat ini tidak ada pada database
        		$show = $this->download_model->get_year_download_sort($id);
        		if($show->num_rows()>0){
        			foreach ($show->result() as $rows) {
        				$year = $rows->doc_year;							// mengalihkan ke tahun terbesar yang ada database
					}
        		}
        	}
        }
        else{
        	$year = $this->uri->segment(3);
        }
        
		$post 		= $this->download_model->get_all_laporan_tahunan($year, $offset, $limit);
		$total 		= $this->download_model->get_total_all_laporan_tahunan($year);
		$yearActive	= $this->download_model->get_year_download_sort($id);
		foreach ($yearActive->result() as $rows) {
			$output['aktif'] = $rows->doc_year;
		}

		$output['files']	 = $post['data'];
		$output['yearlist']  = $this->download_model->get_year_download($id);
		

		// --------- PAGINATION --------------
		$this->load->library('pagination');
		$config['base_url']     = base_url('download/laporan-tahunan/'.$year);
        $config['uri_segment']  = 4;
        $config['total_rows']   = $total['itotal'];
        $config['per_page']     = $limit;
        $config['num_links']    = 3;                // jml links disamping kanan-kiri link yg sdg aktif
        $config['use_page_numbers'] = TRUE;         // Gunakan penomoran 1, 2, 3, dst di URL

		$config['full_tag_open']  = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open']  = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open']   = '<li>';
		$config['last_tag_close']  = '</li>';
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

		$mainData['meta']['descriptions'] = "Bank Sulawesi Selatan dan Sulawesi Barat";
		$mainData['meta']['keywords']     = str_replace(' ', ',', ($mainData['page_title']));

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vdownload_laptahunan', $output, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);

		$this->load->view('vbase', $mainData);
	}

	public function sbdk()
	{
		$page  = strip_tags($this->uri->segment(4));
		
		$output['page_title'] = 'Download Berkas Suku Bunga Dasar Kredit - Bank Sulselbar';
		$mainData['page_title'] = 'Download Berkas Suku Bunga Dasar Kredit - Bank Sulselbar';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

		// ------------------- CONTENT -----------------------
		$limit = 5;
		$id    = 23;

		if (empty($page)) {
            $offset = 0;
        }else{
            $offset = ($page * $limit) - $limit;
        }

        $tahun = $this->uri->segment(3);
        if(empty($tahun)){
        	$year = date('Y');
        	$tot = $this->download_model->get_total_all_sbdk($year);
        	if($tot['itotal']=='0'){										// mengecek jika tahun saat ini tidak ada pada database
        		$show = $this->download_model->get_year_download_sort($id);
        		if($show->num_rows()>0){
        			foreach ($show->result() as $rows) {
        				$year = $rows->doc_year;							// mengalihkan ke tahun terbesar yang ada database
					}
        		}
        	}
        }
        else{
        	$year = $this->uri->segment(3);
        }
        
        $yearActive	= $this->download_model->get_year_download_sort($id);
		foreach ($yearActive->result() as $rows) {
			$output['aktif'] = $rows->doc_year; 
		}

		$post 		= $this->download_model->get_all_sbdk($year, $offset, $limit);
		$total 		= $this->download_model->get_total_all_sbdk($year);

		$output['files']	 = $post['data'];
		$output['yearlist']  = $this->download_model->get_year_download($id);

		// --------- PAGINATION --------------
		$this->load->library('pagination');
		$config['base_url']     = base_url('download/sbdk/'.$year);
        $config['uri_segment']  = 4;
        $config['total_rows']   = $total['itotal'];
        $config['per_page']     = $limit;
        $config['num_links']    = 3;                // jml links disamping kanan-kiri link yg sdg aktif
        $config['use_page_numbers'] = TRUE;         // Gunakan penomoran 1, 2, 3, dst di URL

		$config['full_tag_open']  = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open']  = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open']   = '<li>';
		$config['last_tag_close']  = '</li>';
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

		$mainData['meta']['descriptions'] = "Bank Sulawesi Selatan dan Sulawesi Barat";
		$mainData['meta']['keywords']     = str_replace(' ', ',', ($mainData['page_title']));

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vdownload_sbdk', $output, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);

		$this->load->view('vbase', $mainData);
	}

	public function gcg()
	{
		$page  = strip_tags($this->uri->segment(4));
		
		$output['page_title'] = 'Download Berkas Good Corporate Governance - Bank Sulselbar';
		$mainData['page_title'] = 'Download Berkas Good Corporate Governance - Bank Sulselbar';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

		// ------------------- CONTENT -----------------------
		$limit = 5;
		$id    = 21;

		if (empty($page)) {
            $offset = 0;
        }else{
            $offset = ($page * $limit) - $limit;
        }

        $tahun = $this->uri->segment(3);
        if(empty($tahun)){
        	$year = date('Y');
        	$tot = $this->download_model->get_total_all_gcg($year);
        	if($tot['itotal']=='0'){										// mengecek jika tahun saat ini tidak ada pada database
        		$show = $this->download_model->get_year_download_sort($id);
        		if($show->num_rows()>0){
        			foreach ($show->result() as $rows) {
        				$year = $rows->doc_year;							// mengalihkan ke tahun terbesar yang ada database
					}
        		}
        	}
        }
        else{
        	$year = $this->uri->segment(3);
        }

        $yearActive	= $this->download_model->get_year_download_sort($id);
		foreach ($yearActive->result() as $rows) {
			$output['aktif'] = $rows->doc_year;
		}
        
		$post 		= $this->download_model->get_all_gcg($year, $offset, $limit);
		$total 		= $this->download_model->get_total_all_gcg($year);

		$output['files']	 = $post['data'];
		$output['yearlist']  = $this->download_model->get_year_download($id);

		// --------- PAGINATION --------------
		$this->load->library('pagination');
		$config['base_url']     = base_url('download/gcg/'.$year);
        $config['uri_segment']  = 4;
        $config['total_rows']   = $total['itotal'];
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

		$mainData['meta']['descriptions'] = "Bank Sulawesi Selatan dan Sulawesi Barat";
		$mainData['meta']['keywords']     = str_replace(' ', ',', ($mainData['page_title']));

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vdownload_gcg', $output, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);

		$this->load->view('vbase', $mainData);
	}

	public function other()
	{
		$page  = strip_tags($this->uri->segment(3));
		
		$output['page_title'] = ' Download Berkas Lainnya - Bank Sulselbar';
		$mainData['page_title'] = 'Download Berkas Lainnya - Bank Sulselbar';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
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

		$output['files']	 = $post['data'];
		$output['yearlist']  = $this->download_model->get_year_download($id);

		// --------- PAGINATION --------------
		$this->load->library('pagination');
		$config['base_url']     = base_url('download/other/'.$year);
        $config['uri_segment']  = 3;
        $config['total_rows']   = $total['itotal'];
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

		$mainData['meta']['descriptions'] = "Bank Sulawesi Selatan dan Sulawesi Barat";
		$mainData['meta']['keywords']     = str_replace(' ', ',', ($mainData['page_title']));

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vdownload_other', $output, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);

		$this->load->view('vbase', $mainData);
	}

	public function laporan_keuangan()
	{
		$page  = strip_tags($this->uri->segment(4));
		
		$output['page_title'] = 'Download Berkas Laporan Keuangan  - Bank Sulselbar';
		$mainData['page_title'] = 'Download Berkas Laporan Keuangan - Bank Sulselbar';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

		// ------------------- CONTENT -----------------------
		$limit = 5;
		$kat   = $this->uri->segment(3);
		
		if (empty($page)) {
            $offset = 0;
            $kat = 'Neraca%20Publikasi';
        }
        else{
            $offset = ($page * $limit) - $limit;
        }

		if ($kat=='') {
			$id    		= 18;
            $post 		= $this->download_model->get_all_laporan_keuangan($id, $offset, $limit);
			$total 		= $this->download_model->get_total_all_laporan_keuangan($id);
        }
        elseif ($kat=='Neraca%20Publikasi') {
        	$id    		= 18;
            $post 		= $this->download_model->get_all_laporan_keuangan($id, $offset, $limit);
			$total 		= $this->download_model->get_total_all_laporan_keuangan($id);
        }
        elseif ($kat=='Bulanan') {
        	$id    		= 19;
            $post 		= $this->download_model->get_all_laporan_keuangan($id, $offset, $limit);
			$total 		= $this->download_model->get_total_all_laporan_keuangan($id);
        }
        else{
            $id    		= 20;
            $post 		= $this->download_model->get_all_laporan_keuangan($id, $offset, $limit);
			$total 		= $this->download_model->get_total_all_laporan_keuangan($id);
        }
        
		$output['files']	 = $post['data'];
		$output['kategoriList']  = $this->download_model->get_kategori_lap_keuangan();

		$CategoryActive	= $this->download_model->get_kategori_lap_keuangan_sort();
		foreach ($CategoryActive->result() as $rows) {
			$output['aktif'] = $rows->ch_name;
		}

		// --------- PAGINATION --------------
		$this->load->library('pagination');
		$config['base_url']     = base_url('download/laporan-keuangan-publikasi/'.$kat);
        $config['uri_segment']  = 4;
        $config['total_rows']   = $total['itotal'];
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

		$mainData['meta']['descriptions'] = "Bank Sulawesi Selatan dan Sulawesi Barat";
		$mainData['meta']['keywords']     = str_replace(' ', ',', ($mainData['page_title']));

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vdownload_lapkeuangan', $output, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);

		$this->load->view('vbase', $mainData);
	}
}

/* End of file download.php */