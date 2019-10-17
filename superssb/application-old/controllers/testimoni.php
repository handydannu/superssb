<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimoni extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('date');

		$this->load->model('testimoni_model');
		$this->load->model('user_model');
		$this->user_model->has_login();
		error_reporting(E_ALL);
	}

	function index()
	{
		$output['PAGE_TITLE'] = 'Testimoni';
		$mainData['CU'] = $this->user_model->current_user();

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css']   .= add_css('js/datatables-1-10-3/css/jquery.dataTables.css');
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
		$mainData['bottom_js'] .= add_js('js/data/testimoni.js');

		$mainData['mainContent']  = $this->load->view('content/vtestimoni', $output,true);
		$this->load->view('vbase',$mainData);

	}

	function json()
	{		
		$data = $this->testimoni_model->get_all();
		print_r($data);
	}

	function validation()
	{
		$this->form_validation->set_rules('t_name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('t_email', 'Email', 'trim|required');
		$this->form_validation->set_rules('t_comment', 'Comment', 'trim|required');

		$this->form_validation->set_message('required', '%s harus diisi.');
	}

	function add()
	{
		// error_reporting(E_ALL);
		
		$mainData['CU']       = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'ADD SLIDER';
		$output['mode']       = 1; // sbg tanda add new
		$output['EDIT']       = NULL;

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
			
			$mainData['bottom_js'] .= add_js('js/data/global.js');
			$mainData['bottom_js'] .= add_js('js/data/select2-data.js');
			
			$mainData['mainContent'] = $this->load->view('content/vtestimoni_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}
		else{
			$post = $this->input->post(null, true);

			if($_FILES['userfile']['name'] == ''){
				$file_image_name   = '';
			}
			else{
				// ----- Process Image Name -----
				$proses           = $this->image_name_validation($_FILES['userfile']['name']);
				$file_image_name  = $proses['file_image_name'];
				//$file_image_thumb = $proses['file_image_thumb'];
				// ----- END Process Image Name -----
			}

			$indata['testimoni_name']		= in(trim($post['t_name']));
			$indata['testimoni_email']		= in(trim($post['t_email']));
			$indata['testimoni_about']		= in(trim($post['t_about']));
			$indata['testimoni_address']	= in(trim($post['t_address']));
			$indata['testimoni_website']	= in(trim($post['t_website']));
			$indata['testimoni_image']  	= $file_image_name;
			$indata['testimoni_content']	= in(trim($post['t_comment']));
			$indata['testimoni_status']		= in(trim($post['t_status']));
			$indata['testimoni_created']	= date("Y-m-d H:i:s");			

			$insertID = $this->testimoni_model->insert_testimoni('testimoni', $indata);

			$destination = $this->config->item('testimoni_images_dir'). $insertID."/";
			
			if ($insertID){
				if($_FILES['userfile']['name'] != ''){
					// ------- Upload Image file --------
					if (!is_file($destination.$file_image_name)) {
						mkdir_r($destination);
					}
					move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_image_name);
					//create_img_thumbnail($destination.$file_image_name);
				}

				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');
				redirect('testimoni'); 
			}
		}
	}

	
	function edit($id)
	{
		$this->validation();
		if ($this->form_validation->run() == FALSE)
		{
			$output['PAGE_TITLE'] = 'Edit Testimoni';

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

			$output['EDIT']            = $this->testimoni_model->get_testimoni_byid($id);
			$output['mode']            = 2;
			$mainData['mainContent']   = $this->load->view('content/vtestimoni_form', $output,true);

			$this->load->view('vbase',$mainData);
		}
		else{
			$post = $this->input->post(null, true);

			$id = $post['t_id'];

			if($_FILES['userfile']['name'] == ''){
				$file_image_name   = $post['current_image'];
			}else{
				// ----- Process Image Name -----
				$proses          = $this->image_name_validation($_FILES['userfile']['name']);
				$file_image_name = $proses['file_image_name'];
				//$file_image_thumb = $proses['file_image_thumb'];
				// ----- END Process Image Name -----
			}

			$indata['testimoni_name']		= in(trim($post['t_name']));
			$indata['testimoni_email']		= in(trim($post['t_email']));
			$indata['testimoni_about']		= in(trim($post['t_about']));
			$indata['testimoni_address']	= in(trim($post['t_address']));
			$indata['testimoni_website']	= in(trim($post['t_website']));
			$indata['testimoni_image']  	= $file_image_name;
			$indata['testimoni_content']	= in(trim($post['t_comment']));
			$indata['testimoni_status']		= in(trim($post['t_status']));
			$indata['testimoni_created']	= $post['t_created'];

			$affected = $this->testimoni_model->update_testimoni($indata, $id);

			$destination = $this->config->item('testimoni_images_dir'). $id."/";

			if ($affected)
			{
				if($_FILES['userfile']['name'] != ''){

					unlink($destination. $post['current_image']);
					//unlink($destination. $post['current_thumb']);

					// ------- Upload Image file --------
					if (!is_file($destination.$file_image_name)) {
						mkdir_r($destination);
					}
					move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_image_name);
					//create_img_thumbnail($destination.$file_image_name);
				}

				$this->session->set_userdata('message','Data has been updated.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Tidak ada yang diubah.');
				$this->session->set_userdata('message_type','warning');
			}
			redirect('testimoni');

		}
	}

	function delete()
	{
		$ID = $this->uri->segment(3);

		$EDIT = $this->testimoni_model->get_testimoni_byid($ID);

		$delete_execution = $this->testimoni_model->delete_testimoni($ID);

		if ($delete_execution)
		{
			// Delete Image
			unlink($this->config->item('testimoni_images_dir') . '/'.$ID.'/'.$EDIT['testimoni_image']);
			//unlink($this->config->item('headline_images_dir') . '/'.$ID.'/'.$EDIT['h_thumb']);
			
			// Delete the image's folder
			rmdir($this->config->item('testimoni_images_dir') .$ID);

			$this->session->set_userdata('message','Data berhasil dihapus.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','ERROR Deleting Data.');
			$this->session->set_userdata('message_type','error');
		}

		redirect('testimoni');
	}

	function image_name_validation($file)
	{
		$img_info          = pathinfo($file);
		$fileName          = strtolower(str_replace(' ', '-', $img_info['filename']));
		$fileName          = preg_replace('#[^a-z.0-9_-]#i', '', $fileName);
		$fileExt           = $img_info['extension'];
		$ret['file_image_name']   = $fileName.'.'.$fileExt;
		$ret['file_image_thumb']  = $fileName. '_thumb.' .$fileExt;

		return $ret;
	}

}

/* End of file Slider.php */