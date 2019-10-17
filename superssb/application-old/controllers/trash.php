<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trash extends CI_Controller {

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
		$output['PAGE_TITLE'] = 'Trash';

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
		$mainData['bottom_js'] .= add_js('js/data/trash.js');

		$mainData['mainContent']  = $this->load->view('content/vlocked', $output,true);

		$this->load->view('vbase',$mainData);
	}

	function json()
	{
		$article = $this->contents_model->get_trash_data();
		print_r($article);
	}

	function restore()
	{
		// ---- restore data to draft ----

		$ID= $this->uri->segment(3);

		$data = array();
		$data['c_status'] = 'draft';
		if($this->contents_model->update_content($data,$ID)){
			$this->session->set_userdata('message','Success.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','No data selected.');
			$this->session->set_userdata('message_type','warning');
		}

		redirect('trash');
	}

	function delete()
	{
		$ID = $this->uri->segment(3);

		$EDIT = $this->contents_model->get_content_by($ID);

		$delete_execution = $this->contents_model->delete_content_by($ID);

		if ($delete_execution)
		{

			$tgl   = explode(' ', $EDIT['c_created_date']);	// [0] =2014-09-22 [1] =10:00:00
	      	$tgl   = explode('-', $tgl[0]);
			$year  = $tgl[0];
			$month = $tgl[1];
			$day   = $tgl[2];

			// Delete Images
			unlink($this->config->item('posts_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/'.$EDIT['c_images_content']);
			unlink($this->config->item('posts_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/'.$EDIT['c_images_thumbnail']);
			unlink($this->config->item('posts_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/headline/'.$EDIT['c_images_headline']);
			// Delete the image's folder
			rmdir($this->config->item('posts_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/headline/');
			rmdir($this->config->item('posts_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID);

			$this->session->set_userdata('message','Data berhasil dihapus.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','ERROR Deleting Data.');
			$this->session->set_userdata('message_type','error');
		}

		redirect('trash');
	}
}

/* End of file trash.php */