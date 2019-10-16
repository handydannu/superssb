<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimoni extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('contents_model');
		$this->load->library('Recaptcha');
		$this->load->helper('contentdate');
		$this->load->helper('text');
		error_reporting(E_ALL);
	}

	function index()
	{
		$mainData['page_title'] = 'Testimoni - Bank Sulselbar';
		$mainData['meta']['descriptions'] = 'Testimoni Bank Sulawesi Selatan dan Sulawesi Barat';
		$mainData['meta']['keywords']     = 'BPD, Bank, Sulsel, BankSulsel, Sulawesi, Sulawesi Selatan, Bank Daerah, Bank Sulawesi Barat, Makassar,Asbanda,Asosiasi Bank Daerah,Bank Sulselbar,Asosiasi Bank Daerah';

		$meta_fb = array(
            'url'         => (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
            'type'        => 'article',
            'title'       => 'Testimoni Bank Sulselbar - Melayani Sepenuh Hati',
            'image'       => $this->config->item('images_uri').'logo-big.png',
            'site_name'   => 'banksulselbar.co.id',
            'description' => 'Testimoni Bank Sulawesi Selatan dan Sulawesi Barat'
            );
		
        $mainData['meta']['facebook_tags'] = metaname_facebook($meta_fb);

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css']	.= add_css('js/fileinput/fileinput.min.css');
		$mainData['top_js']		.= add_js('js/jquery.js');
		$mainData['top_js']		.= add_js('js/fileinput/fileinput.min.js');
		$mainData['top_js']		.= add_js('js/loadmore.js');

		// --------- CONTENT ----------------------
		$rowsperpage = 10;
		$output['testimoni'] = $this->contents_model->get_list_testimoni(0, $rowsperpage);

		$total_nums = $this->contents_model->get_total_testimoni();
        $output['total_pages'] = ceil($total_nums/$rowsperpage);
        $output['data']		   = array(
        	'action'          => site_url('test/login'),
            'username'        => set_value('username'),
            'password'        => set_value('password'),
            'captcha'         => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha'  => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        	);
        $destination = $this->config->item('images_testi_uri');

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vtestimoni', $output, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);

		$this->load->view('vbase',$mainData);

	}

	function add()
	{
		$this->form_validation->set_rules('testimoni_name','Judul Foto','required');
		$this->form_validation->set_rules('testimoni_email','Email','required');
		$this->form_validation->set_rules('testimoni_alamat','Alamat','required');
		$this->form_validation->set_rules('testimoni_content','Pesan','required');

		$recaptcha = $this->input->post('g-recaptcha-response');
        $response  = $this->recaptcha->verifyResponse($recaptcha);
		
		if($this->form_validation->run()===TRUE) {
			

			if($_FILES['userfile']['name'] == ''){
				$file_image_name   = '';
			}
			else{
				// ----- Process Image Name -----
				$proses           = $this->image_name_validation($_FILES['userfile']['name']);
				$file_image_name  = $proses['file_image_name'];
				//$file_image_thumb = $proses['file_image_thumb'];
				// ----- END Process Image Name -----
			}
			$data['testimoni_name']		= strip_tags($this->input->post('testimoni_name'));
			$data['testimoni_email']	= strip_tags($this->input->post('testimoni_email'));
			$data['testimoni_address']	= strip_tags($this->input->post('testimoni_alamat'));
			$data['testimoni_content']	= strip_tags($this->input->post('testimoni_content'));
			$data['testimoni_website']	= strip_tags($this->input->post('testimoni_website'));
			$data['testimoni_about']	= strip_tags($this->input->post('testimoni_about'));
			$data['testimoni_status']	= '0';
			$data['testimoni_created']	= date("Y-m-d H:i:s");
			$data['testimoni_image']	= $file_image_name;
			
			if (!isset($response['success']) || $response['success'] <> true) {
	            $this->session->set_flashdata('error', 'Pesan Tidak Terkirim.');
	        } else {
	            $inserted = $this->contents_model->insert_testimoni('testimoni', $data);
	        }
			

			if($inserted){				
				if($_FILES['userfile']['name']) {
					$name = $file_image_name;
					$unggah = $this->contents_model->unggah_gambar('userfile',$name,false,$inserted);
				}
				$this->session->set_flashdata('success', 'Terima kasih, pesan anda telah terkirim.');
			}
			else{
				$this->session->set_flashdata('error', 'Pesan Tidak Terkirim.');
			}			
			redirect('testimoni'); 
		}
		else{
			$this->session->set_flashdata('error', 'Pesan yang anda kirim tidak dapat diproses!, harap mengisi semua kolom yang ada.');
			redirect('testimoni'); 
		}
	}

	function image_name_validation($file)
	{
		$img_info          = pathinfo($file);
		$fileName          = strtolower(str_replace(' ', '-', $img_info['filename']));
		$fileName          = preg_replace('#[^a-z.0-9_-]#i', '', $fileName);
		$fileExt           = $img_info['extension'];
		$ret['file_image_name']   = $fileName.'.'.$fileExt;
		$ret['file_image_thumb']  = $fileName. '_thumb.' .$fileExt;

		return $ret;
	}

}

/* End of file testimoni.php */