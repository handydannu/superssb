<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends CI_Controller {

	/*
	 * UPLOAD FILES
	 */

	function __construct()
	{
		parent::__construct();

		$this->load->helper('date');
		$this->load->model('download_model');
		$this->load->model('user_model');
		
		$this->user_model->has_login();
		//error_reporting(E_ALL);
	}

	function index()
	{
		$output['PAGE_TITLE'] = strtoupper(str_replace('-', ' ', $this->uri->segment(1)));

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
		$mainData['bottom_js'] .= add_js('js/data/download.js');

		if ($this->uri->segment(1) == 'annual-report'){
			$mainData['mainContent']  = $this->load->view('download/vannual_report', $output,true);
		}else{
			$mainData['mainContent']  = $this->load->view('download/vdoc_list', $output,true);
		}
		$this->load->view('vbase',$mainData);
	}

	function json()
	{
		$channel_id = $this->config->item($this->uri->segment(1));
		$data = $this->download_model->get_documents($channel_id);
		print_r($data);
	}

	function add()
	{		
		$mainData['CU']       = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'ADD '.strtoupper(str_replace('-', ' ', $this->uri->segment(1)));;
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
			$mainData['top_css'] .= add_css("css/bootstrap-datepicker.css");
			$mainData['top_css'] .= add_css("css/bootstrap-timepicker.css");

			$mainData['top_js'] .= add_js('js/jquery.js');
			$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
			$mainData['top_js'] .= add_js("js/bootstrap-datepicker.js");
			$mainData['top_js'] .= add_js("js/bootstrap-timepicker.js");

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
			$mainData['bottom_js'] .= add_js('js/data/global.js');

			$output['channel_id'] = $this->config->item($this->uri->segment(1));
			
			if ($this->uri->segment(1) == 'annual-report'){
				$mainData['mainContent'] = $this->load->view('download/vannual_report_form', $output, TRUE);
			}else{
				$mainData['mainContent'] = $this->load->view('download/vdoc_form', $output, TRUE);				
			}

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post(null, true);

			$return = $post['url'];

			if($_FILES['userfile']['name'] == ''){
				// echo 'kosong';
				
				$this->session->set_userdata('message_type', 'error');
			    $this->session->set_userdata('message', 'Upload File terlebih dahulu.');
			    redirect($return);
			    exit;
			}else{

				$img_info  = pathinfo($_FILES['userfile']['name']);
				$fileName  = strtolower(str_replace(' ', '-', $img_info['filename']));
				$fileName  = preg_replace('#[^a-z.0-9_-]#i', '', $fileName);
				$fileExt   = $img_info['extension'];
				$file_name = $fileName.'.'.$fileExt;
			}

			// Insert data into database
			$data['doc_title']         = in($post['title']);
			$data['doc_summary']       = in($post['summary']);
			$data['doc_file']          = $file_name;
			$data['doc_publish_date']  = $post['pubdate'] .' '. $post['pubtime'].':'.date('s');
			$data['doc_created_date']  = date("Y-m-d H:i:s");
			$data['doc_modified_date'] = date("Y-m-d H:i:s");
			$data['doc_year']          = $post['doc_year'];
			$data['doc_channel_id']    = $post['channel_id'];
			$data['doc_status']    	   = $post['doc_status'];

			$insertID = $this->download_model->insert_new_doc($data);
			if ($insertID){
				$year  = date("Y");
				$month = date("m");
				$day   = date("d");
				$destination = $this->config->item('files_dir').$year.'/'.$month.'/'.$day.'/'.$insertID.'/';
				if(!is_dir($destination)) mkdir_r($destination);
				move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_name);

				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');
				redirect($this->uri->segment(1)); 
			}
			exit();
		}
	}

	function edit()
	{
		// error_reporting(E_ALL);
		$ID                   = $this->uri->segment(3);
		$a['CU']              = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'EDIT ' .strtoupper(str_replace('-', ' ', $this->uri->segment(1)));
		$output['add_mode']   = 2; // sbg tanda edit
		$output['EDIT']       = $this->download_model->get_doc_byid($ID);

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
			$mainData['top_css'] .= add_css("css/bootstrap-datepicker.css");
			$mainData['top_css'] .= add_css("css/bootstrap-timepicker.css");

			$mainData['top_js'] .= add_js('js/jquery.js');
			$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
			$mainData['top_js'] .= add_js("js/bootstrap-datepicker.js");
			$mainData['top_js'] .= add_js("js/bootstrap-timepicker.js");

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
			$mainData['bottom_js'] .= add_js('js/data/global.js');

			$output['channel_id'] = $this->config->item($this->uri->segment(1));
			
			if ($this->uri->segment(1) == 'annual-report'){
				$mainData['mainContent'] = $this->load->view('download/vannual_report_form', $output, TRUE);
			}else{
				$mainData['mainContent'] = $this->load->view('download/vdoc_form', $output, TRUE);
			}

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post(null, true);

			$ID   = $post['d_id'];
			$EDIT = $output['EDIT'];
			$return = $post['url'];

			if($_FILES['userfile']['name'] == ''){
				$file_name = $EDIT['doc_file'];
			}else{				
				$img_info  = pathinfo($_FILES['userfile']['name']);
				$fileName  = strtolower(str_replace(' ', '-', $img_info['filename']));
				$fileName  = preg_replace('#[^a-z.0-9_-]#i', '', $fileName);
				$fileExt   = $img_info['extension'];
				$file_name = $fileName.'.'.$fileExt;
				// echo $file_name .'<br />';
				// echo $_FILES['userfile']['tmp_name'] .'<br />';
			}

			// Insert data into database
			$data['doc_title']         = in($post['title']);
			$data['doc_summary']       = in($post['summary']);
			$data['doc_file']          = $file_name;
			$data['doc_created_date']  = $EDIT['doc_created_date'];
			$data['doc_publish_date']  = $post['pubdate'] .' '. $post['pubtime'].':'.date('s');
			$data['doc_modified_date'] = date("Y-m-d H:i:s");
			$data['doc_year']          = $post['doc_year'];
			$data['doc_channel_id']    = $post['channel_id'];
			$data['doc_status']    	   = $post['doc_status'];

			$update = $this->download_model->update_doc($data, $ID);
			if ($update){

				if($_FILES['userfile']['name'] != ''){
					$path = parseDateTime($EDIT['doc_created_date']);
					$year  = $path['year'];
					$month = $path['month'];
					$day   = $path['day'];
					$destination = $this->config->item('files_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/';

					// ---- hapus file lama ------
					$file_existing = $destination.$EDIT['doc_file'];
					if (file_exists($file_existing)) {
						unlink($file_existing);	
					}
					// echo $destination.$file_name .'<br />';
					// echo $_FILES['userfile']['tmp_name'].'<br />';
					if(!is_dir($destination)) mkdir_r($destination);
					move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_name);
				}

				$this->session->set_userdata('message','Data berhasil di-update.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Tidak ada yang diubah.');
				$this->session->set_userdata('message_type','success');
			}
			// exit;
		 	redirect($this->uri->segment(1));
		}
	}

	function validation()
	{
		// error_reporting(E_ALL);
		$this->form_validation->set_rules('title', 'Title', 'trim|required');

		$this->form_validation->set_message('required', '%s harus diisi.');
	}

	function delete()
	{
		// error_reporting(E_ALL);
		$ID = $this->uri->segment(3);
		$data    = $this->download_model->get_doc_byid($ID);
		$remove_ = $this->download_model->delete_doc($ID);
		
		$tgl   = explode(' ', $data['doc_created_date']);
		$tgl   = explode('-', $tgl[0]);
		$year  = $tgl[0];
		$month = $tgl[1];
		$day   = $tgl[2];
		
		if($remove_){
			$destination = $this->config->item('files_dir').$year.'/'.$month.'/'.$day.'/'.$ID;
			unlink($destination.'/'.$data['doc_file']);
			rmdir($destination);

			if(count(glob("$destination/*"))==0) {
			    // echo 'dir empty';
			    rmdir($destination);
			} else {
			    // echo 'dir not empty';
			}

			$this->session->set_userdata('message','Berkas berhasil dihapus.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Tidak ada data yang dihapus.');
			$this->session->set_userdata('message_type','warning');
		}

		redirect($this->uri->segment(1));
	}

}

/* End of file download.php */