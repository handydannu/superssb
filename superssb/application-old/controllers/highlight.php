<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Highlight extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('user_model');
		$this->load->model('highlight_model');
		$this->load->helper('date');

	}

	function index()
	{
		// error_reporting(E_ALL);
		$output['PAGE_TITLE'] = 'Highlight';
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
		$mainData['bottom_js'] .= add_js('js/data/highlight.js');

		$mainData['mainContent']  = $this->load->view('highlight/vlist', $output,true);
		$this->load->view('vbase',$mainData);
	}

	function json()
	{		
		$category = $this->highlight_model->get_hg_datatables();
		
		print_r($category);
	}

	function add()
	{
		$mainData['CU']       = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'ADD HIGHLIGHT';
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
			// $mainData['top_css']  .= add_css("js/fileinput/fileinput.min.css");

			$mainData['top_js'] .= add_js('js/jquery.js');
			// $mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
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
			
			$mainData['mainContent'] = $this->load->view('highlight/vform', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post();

			$data['hi_title']    = in(trim($post['title']));
			$data['hi_content']  = in($post['content']);
			$data['hi_link']     = $post['link'];
			$data['hi_modified'] = date("Y-m-d H:i:s");

			$insertID = $this->highlight_model->insert_new($data);
			if ($insertID){
				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');
				redirect($this->uri->segment(1)); 
			}
			exit();
		}	
	}
	

	function edit($id)
	{
		$ID                   = $this->uri->segment(3);
		$mainData['CU']       = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'EDIT HIGHLIGHT';
		$output['add_mode']   = 2; // sbg tanda edit
		$output['EDIT']       = $this->highlight_model->get_data_byid($ID);

		$this->validation();
		if ($this->form_validation->run() == FALSE)
		{

			$mainData['top_css']   ="";
			$mainData['top_js']    ="";
			$mainData['bottom_js'] ="";
			
			$mainData['top_css']  .= add_css("css/validationEngine.jquery.css");
			$mainData['top_css']  .= add_css("js/select2/select2.css");
			// $mainData['top_css']  .= add_css("js/fileinput/fileinput.min.css");

			$mainData['top_js'] .= add_js('js/jquery.js');
			// $mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
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
			
			$mainData['mainContent'] = $this->load->view('highlight/vform', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post();

			$ID   = $post['hid'];
			$EDIT = $output['EDIT'];

			$data['hi_title']    = in(trim($post['title']));
			$data['hi_content']  = in($post['content']);
			$data['hi_link']     = $post['link'];
			$data['hi_modified'] = date("Y-m-d H:i:s");

			$update = $this->highlight_model->update_($data, $ID);
			if ($update){
				$this->session->set_userdata('message','Data berhasil diupdate.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Tidak ada yang diubah.');
				$this->session->set_userdata('message_type','success');
			}
		 	redirect($this->uri->segment(1));
		}
	}

	function validation()
	{
		// error_reporting(E_ALL);
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_message('required', '%s harus diisi.');
	}

}

/* End of file highlight.php */