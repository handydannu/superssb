<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locked extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('master_model');
		$this->load->model('user_model');
		$this->load->model('channels_model');
		$this->load->model('features_model');
		$this->load->model('contents_model');

		$this->user_model->has_login();
	}

	function index()
	{
		//error_reporting(E_ALL);

		$mainData['CU'] = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'Locked';

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
		$mainData['bottom_js'] .= add_js('js/data/locked.js');

		$mainData['mainContent']  = $this->load->view('content/vlocked', $output,true);

		$this->load->view('vbase',$mainData);
	}

	function json()
	{
		$article = $this->contents_model->get_locked_articles();
		print_r($article);
	}

	function release()
	{
		$ID = $this->uri->segment(3);

		if (!empty($ID))
		{
			// set status editing 0
			$data['c_is_editing'] = 0;
			$update = $this->contents_model->update_content($data, $ID);
			
			if($update){
				$this->session->set_userdata('message','Data has been unlocked from editing status.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','There is no data!.');
				$this->session->set_userdata('message_type','warning');
			}
		}		

		redirect('locked');
	}
}

/* End of file locked.php */