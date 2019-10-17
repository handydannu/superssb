<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('user_model');
		$this->user_model->has_login();
	}

	function index()
	{
		// Show All
		
		// error_reporting(E_ALL);
		$output['PAGE_TITLE'] = 'USER CMS';

		$mainData['CU'] = $this->user_model->current_user();

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css'] .= add_css('js/datatables-1-10-3/css/jquery.dataTables.css');

		$mainData['bottom_js'] .= add_js('js/jquery.js');
		$mainData['bottom_js'] .= add_js('bs3/js/bootstrap.min.js');
		$mainData['bottom_js'] .= add_js('js/jquery.dcjqaccordion.2.7.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo.min.js');
		$mainData['bottom_js'] .= add_js('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.nicescroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo/jquery.scrollTo.js');
		$mainData['bottom_js'] .= add_js('js/jquery-easing/jquery.easing.min.js');
		$mainData['bottom_js'] .= add_js('js/underscore/underscore-min.js');
		$mainData['bottom_js'] .= add_js('js/datatables-1-10-3/js/jquery.dataTables.min.js');
		// use this js for this page
		$mainData['bottom_js'] .= add_js('js/data/user.js');

		$mainData['mainContent'] = $this->load->view('setting/vuser', $output, TRUE);

		$this->load->view('vbase', $mainData);
	}

	public function json()
	{		
		$result=$this->user_model->get_cms_user();
		print_r($result);
	}

	public function add()
	{
		//error_reporting(E_ALL);
		
		$a['CU'] = $this->user_model->current_user();
		$mainData['CU']       = $a['CU'];
		$mainData['add_mode'] = 1; // sbg tanda add new
		$mainData['EDIT']     = '';

		$this->validation();
		if ($this->form_validation->run() == FALSE)
		{
			$a['top_css']   ="";
			$a['top_js']    ="";
			$a['bottom_js'] ="";
			
			$a['top_css']  .= add_css("js/select2/select2.css");
			$a['top_css']  .= add_css("css/validationEngine.jquery.css");

			$a['bottom_js'] .= add_js('js/jquery.js');
			$a['bottom_js'] .= add_js('bs3/js/bootstrap.min.js');
			$a['bottom_js'] .= add_js('js/jquery.dcjqaccordion.2.7.js');
			$a['bottom_js'] .= add_js('js/jquery.scrollTo.min.js');
			$a['bottom_js'] .= add_js('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js');
			$a['bottom_js'] .= add_js('js/jquery.nicescroll.js');
			$a['bottom_js'] .= add_js('js/jquery.scrollTo/jquery.scrollTo.js');
			$a['bottom_js'] .= add_js('js/jquery-easing/jquery.easing.min.js');
			$a['bottom_js'] .= add_js('js/underscore/underscore-min.js');
			$a['bottom_js'] .= add_js('js/jquery.validationEngine-en.js');
			$a['bottom_js'] .= add_js('js/jquery.validationEngine.min.js');
			$a['bottom_js'] .= add_js("js/select2/select2.js");
			// init data utk select2
			$a['bottom_js'] .= add_js('js/data/select2-data.js');
			$a['bottom_js'] .= add_js('js/data/global.js');
			
			$a['mainContent'] = $this->load->view('setting/vuser_form', $mainData, TRUE);

			$this->load->view('vbase', $a);
		}else{
			$post = $this->input->post(null, true);

			if ($this->input->post('password') != $this->input->post('password2'))
			{
				$this->session->set_userdata('message','Password dan Re-type Password didn\'t match.');
				$this->session->set_userdata('message_type','error');
				redirect('user/add');
				exit;
			}

			$data['privilege'] = $post['privilege'];
			$data['username']  = $post['username'];
			$data['password']  = md5($post['password']);
			$data['nama']      = $post['fullname'];
			$data['email']     = $post['email'];
			$data['telpon']    = $post['telpon'];
			$data['active']    = $post['status'];

			$insertnew = $this->user_model->insert_new_user($data);
			if ($insertnew){ 
				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');
				redirect('user'); 
			}
			exit();
		}
	}

	function delete()
	{
		$id = $this->uri->segment(3);

		$del = $this->user_model->delete_cms_user($id);
		if($id && $del){

			$this->session->set_userdata('message','Data telah dihapus.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Tidak ada data yang dihapus.');
			$this->session->set_userdata('message_type','warning');
		}

		redirect('user');
	}

	function edit()
	{
		$ID = $this->uri->segment(3);
		$a['CU'] = $this->user_model->current_user();
		$mainData['add_mode'] = 2; // sbg tanda edit
		$mainData['CU']       = $a['CU'];
		$mainData['EDIT']     = $this->user_model->get_cmsuser_byid($ID);

		$this->validation();
		if ($this->form_validation->run() == FALSE)
		{
			$a['top_css']  ="";
			$a['top_js']   ="";
			$a['bottom_js'] ="";
			
			$a['top_css']  .= add_css("js/select2/select2.css");
			$a['top_css']  .= add_css("css/validationEngine.jquery.css");

			$a['bottom_js'] .= add_js('js/jquery.js');
			$a['bottom_js'] .= add_js('bs3/js/bootstrap.min.js');
			$a['bottom_js'] .= add_js('js/jquery.dcjqaccordion.2.7.js');
			$a['bottom_js'] .= add_js('js/jquery.scrollTo.min.js');
			$a['bottom_js'] .= add_js('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js');
			$a['bottom_js'] .= add_js('js/jquery.nicescroll.js');
			$a['bottom_js'] .= add_js('js/jquery.scrollTo/jquery.scrollTo.js');
			$a['bottom_js'] .= add_js('js/jquery-easing/jquery.easing.min.js');
			$a['bottom_js'] .= add_js('js/underscore/underscore-min.js');
			$a['bottom_js'] .= add_js('js/jquery.validationEngine-en.js');
			$a['bottom_js'] .= add_js('js/jquery.validationEngine.min.js');
			$a['bottom_js'] .= add_js("js/select2/select2.js");
			// init data utk select2
			$a['bottom_js'] .= add_js('js/data/select2-data.js');
			$a['bottom_js'] .= add_js('js/data/global.js');
			
			$a['mainContent'] = $this->load->view('setting/vuser_form', $mainData, TRUE);

			$this->load->view('vbase', $a);
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

			$data['privilege'] = $post['privilege'];
			$data['username']  = $post['username'];
			$data['password']  = md5($post['password']);
			$data['nama']      = $post['fullname'];
			$data['email']     = $post['email'];
			$data['telpon']    = $post['telpon'];
			$data['active']    = $post['status'];

			$update = $this->user_model->update_cms_user($data, $ID);
			if ($update){
				$this->session->set_userdata('message','Data berhasil diupdate.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Tidak ada yang diubah.');
				$this->session->set_userdata('message_type','success');
			}

			$akses = $this->session->userdata('privilege');
			if ($akses == 'reporter'):
		 	 redirect('dashboard'); 
		 	else:
		 		redirect('user'); 
		 	endif;
		 	
			exit();
		}
	}


	function validation()
	{
		error_reporting(E_ALL);
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$this->form_validation->set_message('required', '%s harus diisi.');
	}

	function save_excel()
	{
		$data = $this->user_model->save_cms_users();
		
		function cleanData(&$str) { 
			$str = preg_replace("/\t/", "\\t", $str); 
			$str = preg_replace("/\r?\n/", "\\n", $str); 
			if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
		} 

		// filename for download 
		$filename = "cms_users_saved_" . date('Ymd') . ".xls"; 

		header("Content-Disposition: attachment; filename=\"$filename\""); 
		header("Content-Type: application/vnd.ms-excel"); 

		$flag = false; 
		foreach($data as $row) { 
			if(!$flag) { // display field/column names as first row 
				echo implode("\t", array_keys($row)) . "\r\n"; 
				$flag = true; 
			} 
		array_walk($row, 'cleanData'); 
		echo implode("\t", array_values($row)) . "\r\n"; } 
		exit;		
	}

}

/* End of file user.php */