<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Header_image extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('date');
		$this->load->model('user_model');
		
		$this->user_model->has_login();
		error_reporting(E_ALL);
	}

	function index()
	{
		$mainData['CU'] = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'Header Image';

		$mainData['CU'] = $this->user_model->current_user();
		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css'] .= add_css("js/fileinput/fileinput.min.css");

		$mainData['top_js'] .= add_js('js/jquery.js');
		$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");

		$mainData['bottom_js'] .= add_js('bs3/js/bootstrap.min.js');
		$mainData['bottom_js'] .= add_js('js/jquery.dcjqaccordion.2.7.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo.min.js');
		$mainData['bottom_js'] .= add_js('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.nicescroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo/jquery.scrollTo.js');
		$mainData['bottom_js'] .= add_js('js/jquery-easing/jquery.easing.min.js');
		$mainData['bottom_js'] .= add_js('js/underscore/underscore-min.js');

		$mainData['mainContent']  = $this->load->view('setting/vheader_image', $output,true);
		$this->load->view('vbase',$mainData);
	}

	function submit_ruang_kita()
	{
		// -------- Upload image for header RUANG KITA --------

		if ($_FILES['img']['name'] != '') {

			$file_image_name = 'ruangkita_default.jpg';
			$destination     = $this->config->item('header_images_dir') . 'ruang-kita/';

			unlink($destination . $file_image_name);

			if (move_uploaded_file($_FILES['img']['tmp_name'], $destination.$file_image_name))
			{
				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Error Saving image!');
				$this->session->set_userdata('message_type','error');
			}
		}
		redirect('header-image');
	}

	function submit_tentang_str()
	{
		// -------- Upload image for header Tentang STR -> Berita --------

		if ($_FILES['img']['name'] != '') {

			$file_image_name = 'str_default.jpg';
			$destination     = $this->config->item('header_images_dir') . 'tentang-str/';

			unlink($destination . $file_image_name);

			if (move_uploaded_file($_FILES['img']['tmp_name'], $destination.$file_image_name))
			{
				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Error Saving image!');
				$this->session->set_userdata('message_type','error');
			}
		}
		redirect('header-image');
	}

	function submit_galeri()
	{
		// -------- Upload image for header GALERI --------

		if ($_FILES['img']['name'] != '') {

			$file_image_name = 'galeri_default.jpg';
			$destination     = $this->config->item('header_images_dir') . 'galeri/';

			unlink($destination . $file_image_name);

			if (move_uploaded_file($_FILES['img']['tmp_name'], $destination.$file_image_name))
			{
				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Error Saving image!');
				$this->session->set_userdata('message_type','error');
			}
		}
		redirect('header-image');
	}

	function submit_buletin()
	{
		// -------- Upload image for header BULETIN KOKOH --------

		if ($_FILES['img']['name'] != '') {

			$file_image_name = 'buletin_default.jpg';
			$destination     = $this->config->item('header_images_dir') . 'buletin/';

			unlink($destination . $file_image_name);

			if (move_uploaded_file($_FILES['img']['tmp_name'], $destination.$file_image_name))
			{
				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Error Saving image!');
				$this->session->set_userdata('message_type','error');
			}
		}
		redirect('header-image');
	}

}

/* End of file header_image.php */