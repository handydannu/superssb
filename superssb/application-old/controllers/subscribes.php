<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribes extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('date');
		$this->load->model('inbox_model');
		$this->load->model('user_model');
		$this->user_model->has_login();
	}

	function index()
	{
		// error_reporting(E_ALL);
		$output['PAGE_TITLE'] = 'Subscribe';
		$this->user_model->has_login();

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
		$mainData['bottom_js'] .= add_js('js/data/subscribes.js');

		$mainData['mainContent']  = $this->load->view('content/vsubscribes', $output,true);
		$this->load->view('vbase',$mainData);
	}

	function json()
	{
		$data = $this->inbox_model->get_subscribers();
		print_r($data);
	}

	function delete()
	{
		// error_reporting(E_ALL);
		$ID = $this->uri->segment(3);
		$remove = $this->inbox_model->delete_subscriber($ID);

		if($remove){
			$this->session->set_userdata('message','Data Subscriber telah dihapus.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Tidak ada data yang dihapus.');
			$this->session->set_userdata('message_type','warning');
		}
		redirect('subscribes');
	}

	function edit()
	{
		// error_reporting(E_ALL);
		$ID                   = $this->uri->segment(3);
		$a['CU']              = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'EDIT SUBSCRIBER';
		$output['add_mode']   = 2; // sbg tanda edit
		$output['EDIT']       = $this->inbox_model->get_subscriber_byid($ID);

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
			$mainData['bottom_js'] .= add_js('js/data/global.js');
			
			$mainData['mainContent'] = $this->load->view('content/vsubscribes_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post(null, true);

			$ID   = $post['sid'];
			$EDIT = $output['EDIT'];

			$data['sub_name']   = $this->security->sanitize_filename($post['sname']);
			$data['sub_email']  = $this->security->sanitize_filename($post['semail']);
			$data['sub_phone']  = $this->security->sanitize_filename($post['sphone']);
			$data['sub_date']   = $this->security->sanitize_filename($post['sdate']);			
			$data['sub_status'] = $this->security->sanitize_filename($post['status']);

			$update = $this->inbox_model->update_subscriber($data, $ID);
			if ($update){
				$this->session->set_userdata('message','Data berhasil di-update.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Tidak ada yang diubah.');
				$this->session->set_userdata('message_type','success');
			}
		 	redirect('subscribes');
		}
	}

	function validation()
	{
		error_reporting(E_ALL);
		$this->form_validation->set_rules('sname', 'Nama Subscriber', 'trim|required');
		$this->form_validation->set_message('required', '%s harus diisi.');
	}

}

/* End of file subscribes.php */