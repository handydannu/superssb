<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cash_office extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('date');
		$this->load->model('pages_model');
		$this->load->model('jaringan_model');
		$this->load->model('user_model');
		
		$this->user_model->has_login();
	}

	function index()
	{
		// error_reporting(E_ALL);
		$output['PAGE_TITLE'] = 'Kantor Kas';

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
		$mainData['bottom_js'] .= add_js('js/data/kantor_kas.js');

		$mainData['mainContent']  = $this->load->view('jaringan/vkantorkasform', $output,true);
		$this->load->view('vbase',$mainData);
	}

	function json()
	{
			
		$data = $this->jaringan_model->get_kantor_kas();
		print_r($data);
	}

	function add()
	{
		// error_reporting(E_ALL);
		
		$mainData['CU']       = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'ADD PAGE';
		$output['add_mode']   = 1; // sbg tanda add new
		$output['EDIT']       = '';

		$this->validation();
		if ($this->form_validation->run() == FALSE)
		{
			$mainData['top_css']   ="";
			$mainData['top_js']    ="";
			$mainData['bottom_js'] ="";
			
			$mainData['top_css']  .= add_css("css/validationEngine.jquery.css");
			$mainData['top_css']  .= add_css("js/select2/select2.css");
			$mainData['top_css']  .= add_css("js/bootstrap-wysihtml5/bootstrap-wysihtml5.css");
			$mainData['top_css']  .= add_css("js/fileinput/fileinput.min.css");

			$mainData['top_js'] .= add_js('js/jquery.js');
			$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/wysihtml5-0.3.0.js");
			$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/bootstrap-wysihtml5.js");
			$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
			$mainData['top_js'] .= add_js('js/ckeditor/ckeditor.js');

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
			$mainData['bottom_js'] .= add_js('js/friendurl/jquery.friendurl.min.js');
			$mainData['bottom_js'] .= add_js("js/select2/select2.js");
			$mainData['bottom_js'] .= add_js('js/data/global.js');

			$output['category'] = 1;
			
			$mainData['mainContent'] = $this->load->view('jaringan/vkantorkasadd_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}
		else{
			$post = $this->input->post(null, true);

			$data['kas_name']        = in($post['kas_name']);
			$data['kas_address']     = in($post['kas_address']);
			$data['kas_phone']       = in($post['kas_phone']);
			$data['kas_fax']         = in($post['kas_fax']);
			$data['kas_status'] 	 = in($post['kas_status']);
			$data['kas_created']  	 = date("Y-m-d H:i:s");
			$data['kas_modified']  	 = date("Y-m-d H:i:s");

			$insertID = $this->jaringan_model->insert_new_page('cash_office', $data);
			if ($insertID){
				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');
				redirect('cash_office'); 
			}
			exit();
		}
	}

	function edit()
	{
		// error_reporting(E_ALL);
		$ID                   = $this->uri->segment(3);
		$a['CU']              = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'EDIT PAGES';
		$output['add_mode']   = 2; // sbg tanda edit
		$output['EDIT']       = $this->jaringan_model->get_kantor_kas_byid($ID);

		$this->validation();
		if ($this->form_validation->run() == FALSE)
		{

			$mainData['top_css']   ="";
			$mainData['top_js']    ="";
			$mainData['bottom_js'] ="";
			
			$mainData['top_css']  .= add_css("css/validationEngine.jquery.css");
			$mainData['top_css']  .= add_css("js/select2/select2.css");
			$mainData['top_css']  .= add_css("js/bootstrap-wysihtml5/bootstrap-wysihtml5.css");
			$mainData['top_css']  .= add_css("js/fileinput/fileinput.min.css");

			$mainData['top_js'] .= add_js('js/jquery.js');
			$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/wysihtml5-0.3.0.js");
			$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/bootstrap-wysihtml5.js");
			$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
			$mainData['top_js'] .= add_js('js/ckeditor/ckeditor.js');

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
			$mainData['bottom_js'] .= add_js('js/friendurl/jquery.friendurl.min.js');
			$mainData['bottom_js'] .= add_js("js/select2/select2.js");
			$mainData['bottom_js'] .= add_js('js/data/global.js');
			
			$mainData['mainContent'] = $this->load->view('jaringan/vkantorkasadd_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post(null, true);

			$ID   = $post['kas_id'];
			$EDIT = $output['EDIT'];

			$data['kas_name']        = in($post['kas_name']);
			$data['kas_address']     = in($post['kas_address']);
			$data['kas_phone']       = in($post['kas_phone']);
			$data['kas_fax']         = in($post['kas_fax']);
			$data['kas_status'] 	 = in($post['kas_status']);
			$data['kas_created']  	 = in($post['kas_created']);
			$data['kas_modified']  	 = date("Y-m-d H:i:s");

			$update = $this->jaringan_model->update_kantor_kas($data, $ID);
			if ($update){
				$this->session->set_userdata('message','Data berhasil di-update.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Tidak ada yang diubah.');
				$this->session->set_userdata('message_type','success');
			}
		 	redirect('cash_office');
		}
	}

	function delete()
	{
		// error_reporting(E_ALL);
		$ID = $this->uri->segment(3);
		$data         = $this->jaringan_model->get_kantor_kas_byid($ID);
		$remove_quote = $this->jaringan_model->delete_jaringan('cash_office', 'kas_id', $ID);
		
		if($remove_quote){
			$this->session->set_userdata('message','Page berhasil dihapus.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Tidak ada data yang dihapus.');
			$this->session->set_userdata('message_type','warning');
		}
		redirect('cash_office');
	}

	function validation()
	{
		// error_reporting(E_ALL);
		$this->form_validation->set_rules('kas_name', 'Nama Kantor', 'trim|required');
		$this->form_validation->set_rules('kas_address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('kas_phone', 'Nomor Telepon', 'trim|required');

		$this->form_validation->set_message('required', '%s harus diisi.');
	}

}

/* End of file pages.php */