<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('master_model');
		$this->load->model('user_model');
		
		$this->user_model->has_login();
	}

	function index()
	{
		echo "index";
	}

	function profile()
	{
		// error_reporting(E_ALL);

		$output['PAGE_TITLE'] = 'My Profile';

		$mainData['CU'] = $this->user_model->current_user();
		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['bottom_js'] .= add_js('js/jquery.js');
		$mainData['bottom_js'] .= add_js('bs3/js/bootstrap.min.js');
		$mainData['bottom_js'] .= add_js('js/jquery.dcjqaccordion.2.7.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo.min.js');
		$mainData['bottom_js'] .= add_js('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.nicescroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo/jquery.scrollTo.js');
		$mainData['bottom_js'] .= add_js('js/jquery-easing/jquery.easing.min.js');
		$mainData['bottom_js'] .= add_js('js/underscore/underscore-min.js');

		$output['CU'] = $mainData['CU'];

		$mainData['mainContent']  = $this->load->view('personal/vprofile', $output,true);

		$this->load->view('vbase',$mainData);
	}

	function edit()
	{
		$mainData['CU'] = $this->user_model->current_user();
		
		$output['add_mode'] = 2; // sbg tanda edit
		$output['CU']       = $mainData['CU'];
		$output['EDIT']     = $this->user_model->get_cmsuser_byid($mainData['CU']->uid);

		// _d($mainData['CU']);

		$this->validation();
		if ($this->form_validation->run() == FALSE)
		{

			$mainData['top_css']  ="";
			$mainData['top_js']   ="";
			$mainData['bottom_js'] ="";
			
			$mainData['top_css']  .= add_css("js/select2/select2.css");
			$mainData['top_css']  .= add_css("css/validationEngine.jquery.css");

			$mainData['bottom_js'] .= add_js('js/jquery.js');
			$mainData['bottom_js'] .= add_js('bs3/js/bootstrap.min.js');
			$mainData['bottom_js'] .= add_js('js/jquery.dcjqaccordion.2.7.js');
			$mainData['bottom_js'] .= add_js('js/jquery.scrollTo.min.js');
			$mainData['bottom_js'] .= add_js('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js');
			$mainData['bottom_js'] .= add_js('js/jquery.nicescroll.js');
			$mainData['bottom_js'] .= add_js('js/jquery.scrollTo/jquery.scrollTo.js');
			$mainData['bottom_js'] .= add_js('js/jquery-easing/jquery.easing.min.js');
			$mainData['bottom_js'] .= add_js('js/underscore/underscore-min.js');
			$mainData['bottom_js'] .= add_js('js/jquery.validationEngine-en.js');
			$mainData['bottom_js'] .= add_js('js/jquery.validationEngine.min.js');
			$mainData['bottom_js'] .= add_js("js/select2/select2.js");
			// init data utk select2
			$mainData['bottom_js'] .= add_js('js/data/select2-data.js');
			$mainData['bottom_js'] .= add_js('js/data/global.js');
			
			$mainData['mainContent'] = $this->load->view('personal/vedit_profile', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post(null, true);

			$ID = $post['uid'];

			if ($post['password'] != $post['password2'])
			{
				$this->session->set_userdata('message','Password dan Re-type Password didn\'t match.');
				$this->session->set_userdata('message_type','error');
				redirect('user/edit/'.$ID);
				exit;
			}

			$data['privilege'] = $mainData['CU']->privilege;
			$data['username']  = $post['username'];
			$data['password']  = md5($post['password']);
			$data['nama']      = $post['fullname'];
			$data['email']     = $post['email'];
			$data['telpon']    = $post['telpon'];
			$data['active']    = 1;

			$update = $this->user_model->update_cms_user($data, $ID);
			if ($update){
				$this->session->set_userdata('message','Data berhasil diupdate.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Tidak ada yang diubah.');
				$this->session->set_userdata('message_type','success');
			}

			redirect('profile'); 
		}
	}


	function validation()
	{
		error_reporting(E_ALL);
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$this->form_validation->set_message('required', '%s harus diisi.');
	}

	
}