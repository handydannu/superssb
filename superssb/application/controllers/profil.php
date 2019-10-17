<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

	/* PROFIL PERUSAHAAN */

	function __construct()
	{
		parent::__construct();

		$this->load->helper('date');
		$this->load->model('pages_model');
		$this->load->model('user_model');
		
		$this->user_model->has_login();
	}

	function index()
	{
		// error_reporting(E_ALL);
		$output['PAGE_TITLE'] = ucwords(str_replace('-', ' ', $this->uri->segment(1)));

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
		$mainData['bottom_js'] .= add_js('js/data/pages.js');

		$mainData['mainContent']  = $this->load->view('pages/vpages', $output,true);
		$this->load->view('vbase',$mainData);
	}

	function json()
	{
			
		$data = $this->pages_model->get_pages($this->config->item('profil-perusahaan'));
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
			//$mainData['top_css']  .= add_css("js/fileinput/fileinput.min.css");

			$mainData['top_js'] .= add_js('js/jquery.js');
			//$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
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

			$output['channel_id'] = 1;
			
			$mainData['mainContent'] = $this->load->view('pages/vpages_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post();


			/*if($_FILES['userfile']['name'] == ''){
				$file_image_name   = '';
			}else{
				// ----- Process Image Name -----
				$valid_chars_regex = 'A-Za-z0-9_-\s '; // Characters allowed in the file name (in a Regular Expression format)
				$img_info          = pathinfo($_FILES['userfile']['name']);
				$fileName          = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', '', strtolower(str_replace(' ', '-', $img_info['filename'])));
				$fileExt           = $img_info['extension'];
				$file_image_name   = $fileName.'.'.$fileExt;
				$file_image_thumb  = $fileName. '_thumb.' .$fileExt;
				// ----- END Process Image Name -----
			}*/

			$data['p_title']            = in(trim($post['ptitle']));
			$data['p_slug']             = $this->security->sanitize_filename(trim($post['pslug']));
			$data['p_summary']          = in($post['psummary']);
			$data['p_content']          = in($post['pcontent']);
			// $data['p_images_thumbnail'] = $file_image_thumb;
			// $data['p_images_content']   = $file_image_name;
			// $data['p_images_caption']   = $this->security->sanitize_filename($post['pimagecaption']);
			$data['p_create_date']      = date("Y-m-d H:i:s");
			$data['p_modified_date']    = date("Y-m-d H:i:s");
			$data['p_status']           = $this->security->sanitize_filename($post['pstatus']);
			$data['p_channel_id']       = $this->security->sanitize_filename($post['channel_id']);

			$insertID = $this->pages_model->insert_new_page($data);
			if ($insertID){
				/*if($_FILES['userfile']['name'] != ''){
					// ------- Upload Image file --------
					$destination = $this->config->item('pages_images_dir'). date("Y").'/'. date("m").'/'. date("d").'/'. $insertID."/";
					if (!is_file($destination.$file_image_name)) {
						mkdir_r($destination);
					}
					move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_image_name);

					// ---- Create Thumbnail ----
					$this->create_img_thumbnail($destination.$file_image_name);
				}*/

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
		$output['PAGE_TITLE'] = 'EDIT PAGE';
		$output['add_mode']   = 2; // sbg tanda edit
		$output['EDIT']       = $this->pages_model->get_page_byid($ID);

		$this->validation();
		if ($this->form_validation->run() == FALSE)
		{

			$mainData['top_css']   ="";
			$mainData['top_js']    ="";
			$mainData['bottom_js'] ="";
			
			$mainData['top_css']  .= add_css("css/validationEngine.jquery.css");
			$mainData['top_css']  .= add_css("js/select2/select2.css");
			//$mainData['top_css']  .= add_css("js/fileinput/fileinput.min.css");

			$mainData['top_js'] .= add_js('js/jquery.js');
			//$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
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

			$output['channel_id'] = 1;
			
			$mainData['mainContent'] = $this->load->view('pages/vpages_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post();

			$ID   = $post['pid'];
			$EDIT = $output['EDIT'];

			/*if($_FILES['userfile']['name'] == ''){
				$file_image_name   = $EDIT['p_images_content'];
				$file_image_thumb  = $EDIT['p_images_thumbnail'];
			}else{
				// ----- Process Image Name -----
				$valid_chars_regex = 'A-Za-z0-9_-\s '; // Characters allowed in the file name (in a Regular Expression format)
				$img_info          = pathinfo($_FILES['userfile']['name']);
				$fileName          = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', '', strtolower(str_replace(' ', '-', $img_info['filename'])));
				$fileExt           = $img_info['extension'];
				$file_image_name   = $fileName.'.'.$fileExt;
				$file_image_thumb  = $fileName. '_thumb.' .$fileExt;
				// ----- END Process Image Name -----
			}*/

			$data['p_title']            = in(trim($post['ptitle']));
			$data['p_slug']             = $this->security->sanitize_filename(trim($post['pslug']));
			$data['p_summary']          = in($post['psummary']);
			$data['p_content']          = in($post['pcontent']);
			// $data['p_images_thumbnail'] = $file_image_thumb;
			// $data['p_images_content']   = $file_image_name;
			// $data['p_images_caption']   = $this->security->sanitize_filename($post['pimagecaption']);
			$data['p_create_date']      = $post['pcreate_date'];
			$data['p_modified_date']    = date("Y-m-d H:i:s");
			$data['p_status']           = $this->security->sanitize_filename($post['pstatus']);
			$data['p_channel_id']       = $this->security->sanitize_filename($post['channel_id']);

			$update = $this->pages_model->update_page($data, $ID);
			if ($update){
				/*if ($_FILES['userfile']['name'] != '') {
					// Delete old image. Upload the new one.
					$tgl   = explode(' ', $EDIT['p_create_date']);	// [0] =2014-09-22 [1] =10:00:00
                  	$tgl   = explode('-', $tgl[0]);
					$year  = $tgl[0];
					$month = $tgl[1];
					$day   = $tgl[2];

					// Delete old Image
					unlink($this->config->item('pages_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/'.$EDIT['p_images_content']);
					unlink($this->config->item('pages_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/'.$EDIT['p_images_thumbnail']);
					
					// Upload New Image
					$destination = $this->config->item('pages_images_dir'). $year.'/'.$month.'/'.$day.'/'.$ID.'/';
					if (!is_file($destination.$file_image_name)) {
						mkdir_r($destination);
					}
					move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_image_name);

					// ---- Create Thumbnail ----
					$this->create_img_thumbnail($destination.$file_image_name);
				}*/

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
		$this->form_validation->set_rules('ptitle', 'Title', 'trim|required');
		//$this->form_validation->set_rules('pcontent', 'Content', 'trim|required');

		$this->form_validation->set_message('required', '%s harus diisi.');
	}

	function delete()
	{
		// error_reporting(E_ALL);
		$ID = $this->uri->segment(3);
		$data         = $this->pages_model->get_page_byid($ID);
		$remove_quote = $this->pages_model->delete_page($ID);
		
		$tgl   = explode(' ', $data['p_create_date']);
		$tgl   = explode('-', $tgl[0]);
		$year  = $tgl[0];
		$month = $tgl[1];
		$day   = $tgl[2];

		if($remove_quote){
			if (!empty($data['p_images_content'])) {
				// Delete image
				unlink($this->config->item('pages_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/'.$data['p_images_content']);
				unlink($this->config->item('pages_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/'.$data['p_images_thumbnail']);
				// Delete the image's folder
				rmdir($this->config->item('pages_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID);
			}
			$this->session->set_userdata('message','Page berhasil dihapus.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Tidak ada data yang dihapus.');
			$this->session->set_userdata('message_type','warning');
		}
		redirect('pages');
	}


	function create_img_thumbnail($fullpath)
	{
		// ------ Create Thumbnail -------
		$this->load->library('image_lib');
		$this->image_lib->clear();

		// create image thumbnail
		list($width, $height, $type, $attr) = getimagesize($fullpath);
		
		// landscape
		$config['image_library']  = 'gd2';
		$config['source_image']   = $fullpath;
		$config['create_thumb']   = true;
		$config['maintain_ratio'] = true;
        // we set to 25%
        if ($width >= $height) {
        	$res_width = 150;
        	$res_height = 100;
        } else {
        	$res_width = 0.25*$width;
        	$res_height = 0.25*$height;
        }
        $config['width'] = $res_width;
        $config['height'] = $res_height;
    	$this->image_lib->initialize($config);
        
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
	}

}

/* End of file pages.php */