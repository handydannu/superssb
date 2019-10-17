<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('date');
		$this->load->model('pages_model');
		$this->load->model('contact_model');
		$this->load->model('user_model');
		
		$this->user_model->has_login();
	}

	function index()
	{
		// error_reporting(E_ALL);
		$output['PAGE_TITLE'] = 'Contact';

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
		$mainData['bottom_js'] .= add_js('js/data/contact.js');

		$mainData['mainContent']  = $this->load->view('content/vcontact', $output,true);
		$this->load->view('vbase',$mainData);
	}

	function json()
	{			
		$data = $this->contact_model->get_contact();
		print_r($data);
	}

	function change_status()
	{
		// error_reporting(E_ALL);
		$ID                   = $this->uri->segment(3);
		$a['CU']              = $this->user_model->current_user();
		$output['EDIT']       = $this->contact_model->get_contact_byid($ID);

		$post = $this->input->post(null, true);

		$EDIT = $output['EDIT'];
		if($EDIT['contact_status']=='1'){
			$data['contact_status'] = '0';
		}
		else{
			$data['contact_status'] = '1';
		}

		$update = $this->contact_model->update_contact($data, $ID);
		if ($update){
			$this->session->set_userdata('message','Data berhasil di-update.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Tidak ada yang diubah.');
			$this->session->set_userdata('message_type','success');
		}
	 	redirect('contact');
	}

	function delete()
	{
		$ID = $this->uri->segment(3);

		$EDIT = $this->contact_model->get_contact_byid($ID);

		$delete_execution = $this->contact_model->delete_contact($ID);

		if ($delete_execution)
		{
			$this->session->set_userdata('message','Data berhasil dihapus.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','ERROR Deleting Data.');
			$this->session->set_userdata('message_type','error');
		}

		redirect('contact');
	}

}

/* End of file pages.php */