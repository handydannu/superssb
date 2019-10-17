<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channels extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('master_model');
		$this->load->model('user_model');
		$this->load->model('channels_model');
		$this->load->helper('date');

	}

	function index()
	{
		// error_reporting(E_ALL);
		$output['PAGE_TITLE'] = 'Channels';
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
		$mainData['bottom_js'] .= add_js('js/data/channels.js');

		$mainData['mainContent']  = $this->load->view('setting/vchannels', $output,true);
		$this->load->view('vbase',$mainData);
	}

	function json()
	{
		$this->user_model->has_login();
		
		$category = $this->channels_model->get_channels_datatable();
		
		$tmp = array();
		$tmp['sEcho']                = $category['echo'];
		$tmp['iTotalRecords']        = $category['totalRecords'];
		$tmp['iTotalDisplayRecords'] = $category['totalDisplayRecords'];
		$tmp['aaData']               = $category['result'];
		echo json_encode($tmp);
	}

	function add()
	{
		$this->user_model->has_login();

		error_reporting(E_ALL);
		$mainData['CU'] = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'Add Channel';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css'] .= add_css('css/validationEngine.jquery.css');

		// core js -> use to all page
		$mainData['bottom_js'] .= add_js('js/jquery.js');
		$mainData['bottom_js'] .= add_js('bs3/js/bootstrap.min.js');
		$mainData['bottom_js'] .= add_js('js/jquery.dcjqaccordion.2.7.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo.min.js');
		$mainData['bottom_js'] .= add_js('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.nicescroll.js');
		// end core js

		// use this js for this page
		$mainData['bottom_js'] .= add_js('js/languages/jquery.validationEngine-en.js');
		$mainData['bottom_js'] .= add_js('js/jquery.validationEngine.js');
		$mainData['bottom_js'] .= add_js('js/friendurl/jquery.friendurl.min.js');
		$mainData['bottom_js'] .= add_js('js/data/global.js');

		$output['category_parent'] = $this->channels_model->get_category();
		$output['channel_types']   = $this->channels_model->get_types();
		$output['EDIT']            = new stdClass();
		$output['mode']            = 'ADD';
		$mainData['mainContent']   = $this->load->view('setting/vchannels_form', $output,true);

		// _d($output['channel_types']);
		// exit;

		$this->load->view('vbase',$mainData);	
	}

	function submit_add()
	{
		$this->user_model->has_login();
		
		$post = $this->input->post(null, true);

		if (empty($post['ch_name']) || empty($post['ch_slug']))
		{
			$this->session->set_userdata('message','Empty Channel.');
			$this->session->set_userdata('message_type','warning');
			redirect('channels/add');
			exit;
		}else{
			// check slug
			$is_exist = $this->cek_existing_channel($post['ch_slug'],'');
			if ($is_exist) {
				$post['mode'] = 'ADD';
				$this->session->set_flashdata($post);
				redirect ('channels/add');
			} else {
				$this->channels_model->insert_channel($post);

				$this->session->set_userdata('message','Data has been saved.');
				$this->session->set_userdata('message_type','success');
				redirect('channels');
			}
		}
	}

	function edit($id)
	{
		$this->user_model->has_login();

		// error_reporting(E_ALL);
		$mainData['CU'] = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'Edit Channel';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css'] .= add_css('css/validationEngine.jquery.css');
		// core js -> use to all page
		$mainData['bottom_js'] .= add_js('js/jquery.js');
		$mainData['bottom_js'] .= add_js('bs3/js/bootstrap.min.js');
		$mainData['bottom_js'] .= add_js('js/jquery.dcjqaccordion.2.7.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo.min.js');
		$mainData['bottom_js'] .= add_js('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.nicescroll.js');
		// end core js

		// use this js for this page
		$mainData['bottom_js'] .= add_js('js/languages/jquery.validationEngine-en.js');
		$mainData['bottom_js'] .= add_js('js/jquery.validationEngine.js');
		$mainData['bottom_js'] .= add_js('js/friendurl/jquery.friendurl.min.js');
		$mainData['bottom_js'] .= add_js('js/data/global.js');

		$output['category_parent'] = $this->channels_model->get_category();
		$output['EDIT']            = $this->channels_model->get_channel_by_id($id);
		$output['channel_types']   = $this->channels_model->get_types();
		$output['mode']            = 'EDIT';
		$output['category_id']     = $id;
		$mainData['mainContent']   = $this->load->view('setting/vchannels_form', $output,true);

		$this->load->view('vbase',$mainData);	
	}

	function submit_update($id)
	{
		$post = $this->input->post(null, true);

		if (empty($post['ch_name']) || empty($post['ch_slug']))
		{
			$this->session->set_userdata('message','Empty Channel.');
			$this->session->set_userdata('message_type','warning');
			redirect('channels/edit/'.$id);
			exit;
		}else{
			// check slug
			$is_exist = $this->cek_existing_channel($post['ch_slug'],$id);
			if ($is_exist) {
				$post['mode'] = 'EDIT';
				$this->session->set_flashdata($post);
				redirect ('channels/edit/'.$id);
			} else {
				$this->channels_model->update_channel($post,$id);

				$this->session->set_userdata('message','Data has been updated.');
				$this->session->set_userdata('message_type','success');
				redirect('channels');
			}
		}
	}

	function delete()
	{
		$this->user_model->has_login();
		
		$id = $this->uri->segment(3);
		if( $this->channels_model->delete_channel($id) ){
			$this->session->set_userdata('message','The Channel has been deleted.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','There is no data to be deleted!.');
			$this->session->set_userdata('message_type','warning');
		}

		redirect('channels');
	}

	function cek_existing_channel($slug, $category_id = null)
	{
		if( $this->channels_model->category_name_exists($slug, $category_id) )
		{
			$this->session->set_userdata('message','Data SEO (Slug) for this Channel has been used, Please use another name.');
			$this->session->set_userdata('message_type','error');
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}

/* End of file channels.php */