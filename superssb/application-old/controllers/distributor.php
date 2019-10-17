<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Distributor extends CI_Controller {

	// --------------------------------------------------------------------------
	// Distributor, Terminal, dan MSTR menggunakan model dan function yg sama. 
	// Perbedaan hanya pd field 'dist_channel_id'
	// --------------------------------------------------------------------------

	function __construct()
	{
		parent::__construct();

		$this->load->helper('date');
		$this->load->model('distributor_model');
		$this->load->model('user_model');
		
		$this->user_model->has_login();

		//error_reporting(E_ALL);
	}

	function index()
	{
		$output['PAGE_TITLE'] = 'Distributor';

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
		$mainData['bottom_js'] .= add_js('js/data/distributor.js');

		$mainData['mainContent']  = $this->load->view('content/vdistributor', $output,true);
		$this->load->view('vbase',$mainData);
	}

	function json()
	{
			
		$data = $this->distributor_model->get_distributor_dt($this->config->item('distributor'));
		print_r($data);
	}

	function add()
	{
		$mainData['CU']       = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'ADD DISTRIBUTOR';
		$output['mode']   = 'ADD'; // sbg tanda add new
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
			$mainData['bottom_js'] .= add_js('js/data/select2-data.js');
			
			$output['provinsi'] = $this->distributor_model->get_allprovince();
			$mainData['mainContent'] = $this->load->view('content/vdistributor_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post(null, true);

			if($_FILES['userfile']['name'] == ''){
				$file_image_name   = '';
				$file_image_thumb  = '';
			}else{
				// ----- Process Image Name -----
				$valid_chars_regex = 'A-Za-z0-9_-\s '; // Characters allowed in the file name (in a Regular Expression format)
				$img_info          = pathinfo($_FILES['userfile']['name']);
				$fileName          = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', '', strtolower(str_replace(' ', '-', $img_info['filename'])));
				$fileExt           = $img_info['extension'];
				$file_image_name   = $fileName.'.'.$fileExt;
				$file_image_thumb  = $fileName. '_thumb.' .$fileExt;
				// ----- END Process Image Name -----
			}

			$market_area = $post['market'];
			if (is_array($market_area) && count($market_area)>0)
			{
				//_d($market_area);
				$m = implode(',', $market_area);
				//_d($m);
			}else{
				$m = '';
			}

			$data['dist_name']             = in(trim($post['name']));
			$data['dist_address_1']        = in($post['address1']);
			$data['dist_address_2']        = in($post['address2']);
			$data['dist_address_3']        = in($post['address3']);
			$data['dist_telp']             = in(trim($post['telp']));
			$data['dist_fax']              = in(trim($post['fax']));
			$data['dist_email']            = in(trim($post['email']));
			$data['dist_images']           = $file_image_name;
			$data['dist_images_thumbnail'] = $file_image_thumb;
			$data['dist_market_area']      = $m;
			$data['dist_market_area_city'] = in(trim($post['market_city']));
			$data['dist_province_id']      = trim($post['provinsi']);
			$data['dist_city']             = trim($post['city']);
			$data['dist_created_date']     = date('Y-m-d H:i:s');
			$data['dist_channel_id']       = $this->config->item('distributor');
			$data['dist_status']           = $post['status'];

			$insertID = $this->distributor_model->insert_new_distributor($data);
			if ($insertID){
				// ------- Upload Image file --------
				$destination = $this->config->item('distributor_images_dir'). date("Y").'/'. date("m").'/'. date("d").'/'. $insertID."/";
				if (!is_file($destination.$file_image_name)) {
					mkdir_r($destination);
				}
				move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_image_name);
				$this->create_img_thumbnail($destination.$file_image_name);

				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');				 
			}else{
				$this->session->set_userdata('message','Error saving data!!');
				$this->session->set_userdata('message_type','error');
			}
			redirect('distributor');
		}
	}

	function edit()
	{
		// error_reporting(E_ALL);
		$ID                   = $this->uri->segment(3);
		$a['CU']              = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'EDIT DISTRIBUTOR';
		$output['mode']       = 2; // sbg tanda edit
		$output['EDIT']       = $this->distributor_model->get_distributor_by($ID);

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
			$mainData['bottom_js'] .= add_js('js/data/select2-data.js');
			$output['provinsi'] = $this->distributor_model->get_allprovince();
			$mainData['mainContent'] = $this->load->view('content/vdistributor_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post(null, true);

			$ID   = $post['d_id'];
			$EDIT = $output['EDIT'];

			if($_FILES['userfile']['name'] == ''){
				$file_image_name   = $EDIT['dist_images'];
				$file_image_thumb  = $EDIT['dist_images_thumbnail'];
			}else{
				// ----- Process Image Name -----
				$valid_chars_regex = 'A-Za-z0-9_-\s '; // Characters allowed in the file name (in a Regular Expression format)
				$img_info          = pathinfo($_FILES['userfile']['name']);
				$fileName          = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', '', strtolower(str_replace(' ', '-', $img_info['filename'])));
				$fileExt           = $img_info['extension'];
				$file_image_name   = $fileName.'.'.$fileExt;
				$file_image_thumb  = $fileName. '_thumb.' .$fileExt;
				// ----- END Process Image Name -----
			}

			$market_area = $post['market'];
			if (is_array($market_area) && count($market_area)>0)
			{
				//_d($market_area);
				$m = implode(',', $market_area);
				//_d($m);
			}else{
				$m = '';
			}

			$data['dist_name']             = in(trim($post['name']));
			$data['dist_address_1']        = in($post['address1']);
			$data['dist_address_2']        = in($post['address2']);
			$data['dist_address_3']        = in($post['address3']);
			$data['dist_telp']             = in(trim($post['telp']));
			$data['dist_fax']              = in(trim($post['fax']));
			$data['dist_email']            = in(trim($post['email']));
			$data['dist_images']           = $file_image_name;
			$data['dist_images_thumbnail'] = $file_image_thumb;
			$data['dist_market_area']      = $m;
			$data['dist_market_area_city'] = in(trim($post['market_city']));
			$data['dist_province_id']      = trim($post['provinsi']);
			$data['dist_city']             = trim($post['city']);
			$data['dist_created_date']     = $EDIT['dist_created_date'];
			$data['dist_channel_id']       = $this->config->item('distributor');
			$data['dist_status']           = $post['status'];

			$update = $this->distributor_model->update_distributor($data, $ID);
			if ($update){
				if($_FILES['userfile']['name'] != ''){
					// Delete old image. Upload the new one.
					$tgl   = explode(' ', $EDIT['dist_created_date']);	// [0] =2014-09-22 [1] =10:00:00
	              	$tgl   = explode('-', $tgl[0]);
					$year  = $tgl[0];
					$month = $tgl[1];
					$day   = $tgl[2];

					// Delete old Image
					unlink($this->config->item('distributor_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/'.$EDIT['dist_images']);
					unlink($this->config->item('distributor_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/'.$EDIT['dist_images_thumbnail']);
					
					// Upload New Image
					$destination = $this->config->item('distributor_images_dir'). $year.'/'.$month.'/'.$day.'/'.$ID.'/';
					if (!is_file($destination.$file_image_name)) {
						mkdir_r($destination);
					}				
					move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_image_name);
					$this->create_img_thumbnail($destination.$file_image_name);
				}

				$this->session->set_userdata('message','Data berhasil diupdate.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','No updating data!!');
				$this->session->set_userdata('message_type','error');
			}
			redirect('distributor');
		}
	}

	function validation()
	{
		// error_reporting(E_ALL);
		$this->form_validation->set_rules('name', 'Name', 'trim|required');

		$this->form_validation->set_message('required', '%s harus diisi.');
	}

	function delete()
	{
		// error_reporting(E_ALL);
		$ID = $this->uri->segment(3);
		$data         = $this->distributor_model->get_distributor_by($ID);
		$remove_quote = $this->distributor_model->delete_distributor($ID);
		
		$tgl   = explode(' ', $data['dist_created_date']);
		$tgl   = explode('-', $tgl[0]);
		$year  = $tgl[0];
		$month = $tgl[1];
		$day   = $tgl[2];

		if($remove_quote){
			if (!empty($data['dist_images'])) {
				$folder = $this->config->item('distributor_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID;
				// Delete image
				unlink($folder.'/'.$data['dist_images']);
				unlink($folder.'/'.$data['dist_images_thumbnail']);
				// Delete the image's folder
				rmdir($folder);
			}
			$this->session->set_userdata('message','Distributor berhasil dihapus.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Tidak ada data yang dihapus.');
			$this->session->set_userdata('message_type','warning');
		}
		redirect('distributor');
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