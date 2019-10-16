<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontak extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('contents_model');
		$this->load->helper('contentdate');

		//error_reporting(E_ALL);
	}

	function index()
	{
		$output = '';
		$mainData['page_title']           = 'Kontak - Bank Sulselbar';
		$mainData['meta']['descriptions'] = 'Kontak Bank Sulawesi Selatan dan Sulawesi Barat';
		$mainData['meta']['keywords']     = 'BPD, Bank, Sulsel, BankSulsel, Sulawesi, Sulawesi Selatan, Bank Daerah, Bank Sulawesi Barat, Makassar,Asbanda,Asosiasi Bank Daerah,Bank Sulselbar,Asosiasi Bank Daerah';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics($this->config->item('google_uacct'));
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

		$meta_fb = array(
            'url'         => (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
            'type'        => 'article',
            'title'       => 'Kontak Bank Sulselbar - Melayani Sepenuh Hati',
            'image'       => $this->config->item('images_uri').'logo-big.png',
            'site_name'   => 'banksulselbar.co.id',
            'description' => 'Kontak Bank Sulawesi Selatan dan Sulawesi Barat'
        );
        $mainData['meta']['facebook_tags'] = metaname_facebook($meta_fb);

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vkontak', $output, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		$this->load->view('vbase',$mainData);
	}

	function add()
	{
		$this->form_validation->set_rules('contact_name','Judul Foto','required');
		$this->form_validation->set_rules('contact_email','Email','required');
		$this->form_validation->set_rules('contact_title','Judul','required');
		$this->form_validation->set_rules('contact_content','Pesan','required');
		
		if($this->form_validation->run()===TRUE) {
			$data['contact_name']		= strip_tags($this->input->post('contact_name'));
			$data['contact_email']		= strip_tags($this->input->post('contact_email'));
			$data['contact_title']		= strip_tags($this->input->post('contact_title'));
			$data['contact_content']	= strip_tags($this->input->post('contact_content'));
			$data['contact_created']	= date("Y-m-d H:i:s");
			$data['contact_status']		= '0';
	
			$inserted = $this->contents_model->insert_contact($data);
			if($inserted){
				$this->session->set_flashdata('success', 'Terima kasih, pesan anda telah terkirim.');
			}
			else{
				$this->session->set_flashdata('error', 'Pesan Tidak Terkirim.');
			}			
			redirect('kontak#message'); 
		}
		else{
			$this->session->set_flashdata('error', 'Pesan yang anda kirim tidak dapat diproses!, harap mengisi semua kolom yang ada.');
			redirect('kontak#message'); 
		}
	}

}

/* End of file kontak.php */