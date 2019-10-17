<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {

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
		// error_reporting(E_ALL);		
		// print_r($this->session->userdata); 
		$mainData['CU'] = $this->user_model->current_user();
		$output['PAGE_TITLE'] = ucwords($this->uri->segment(1));

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
		$mainData['bottom_js'] .= add_js('js/data/articles.js');

		$mainData['mainContent']  = $this->load->view('berita/vlist', $output,true);

		$this->load->view('vbase',$mainData);
	}

	function json()
	{
		$channelID = $this->config->item($this->uri->segment(1));
		$article = $this->contents_model->get_articles_datatable($channelID);
		print_r($article);
	}

	function add($idkanal='')
	{
		
		// error_reporting(E_ALL);
		$mainData['CU'] = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'Add <strong>'.ucwords($this->uri->segment(1)).'</strong>';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css'] .= add_css("css/validationEngine.jquery.css");
		$mainData['top_css'] .= add_css("js/select2/select2.css");
		$mainData['top_css'] .= add_css("js/bootstrap-wysihtml5/bootstrap-wysihtml5.css");
		$mainData['top_css'] .= add_css("js/fileinput/fileinput.min.css");
		$mainData['top_css'] .= add_css("css/bootstrap-datepicker.css");
		$mainData['top_css'] .= add_css("css/bootstrap-timepicker.css");

		$mainData['top_js'] .= add_js('js/jquery.js');
		$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/wysihtml5-0.3.0.js");
		$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/bootstrap-wysihtml5.js");
		$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
		$mainData['top_js'] .= add_js("js/bootstrap-datepicker.js");
		$mainData['top_js'] .= add_js("js/bootstrap-timepicker.js");
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

		$output['EDIT']           = array();
		$output['mode']           = 'ADD';
		$output['CU']             = $mainData['CU'];
		$output['channel']        = $this->config->item($this->uri->segment(1));	// berita atau csr
		$output['features']       = $this->features_model->get_all_active_features();
		$output['author']         = $this->user_model->get_all_active_user();
		$output['editor']         = $this->user_model->get_all_active_editor();

		// _d($output['CU']);
		// exit;

		$mainData['mainContent']  = $this->load->view('berita/vform', $output,true);

		$this->load->view('vbase',$mainData);		
	}

	function submit_add() 
	{
	  if($_SERVER['REQUEST_METHOD']=='POST'){
		$post = $this->input->post();

		// _d($post);
		// exit();

		if($_FILES['userfile']['name'] == ''){
			if ($post['content_type'] =='video'){
				$file_image_name   = trim($post['youtube_id']).'.jpg';
				$file_image_thumb  = trim($post['youtube_id']).'.jpg';
			}else{
				$file_image_name   = '';
				$file_image_thumb  = '';
			}
		}else{
			// ----- Process Image Name -----
			$img_info          = pathinfo($_FILES['userfile']['name']);
			$fileName          = strtolower(str_replace(' ', '-', $img_info['filename']));
			$fileName          = preg_replace('#[^a-z.0-9_-]#i', '', $fileName);
			$fileExt           = $img_info['extension'];
			$file_image_name   = $fileName.'.'.$fileExt;
			$file_image_thumb  = $fileName. '_thumb.' .$fileExt;
			// ----- END Process Image Name -----
		}

		$post_content = str_replace('cms.sementigaroda.com', 'www.sementigaroda.com', $post['content']);

		$data['c_publish_date']     = $post['pubdate'] .' '. $post['pubtime'].':'.date('s');
		$data['c_subtitle']         = in(trim($post['subtitle']));
		$data['c_title']            = in(trim($post['title']));
		$data['c_slug']             = trim($post['slug']);
		$data['c_summary']          = in($post['summary']);
		$data['c_content']          = in($post_content);
		$data['c_images_thumbnail'] = $file_image_thumb;
		$data['c_images_content']   = $file_image_name;
		$data['c_images_caption']   = trim($post['img_caption']);
		$data['c_keyword']          = $post['keyword'];
		$data['c_channel_id']       = $post['channel_id'];
		$data['c_feature']          = $post['feature'];
		$data['c_type']             = $this->config->item('news');
		$data['c_source']           = trim($post['source']);
		$data['c_author']           = $post['author'];
		$data['c_author_name']      = trim($post['other_author_name']);
		$data['c_editor']           = $post['editor'];
		$data['c_hits']             = '';
		$data['c_status']           = $post['status'];
		$data['c_created_date']     = date('Y-m-d H:i:s');
		$data['c_modified_date']    = date('Y-m-d H:i:s');
		$data['c_is_editing']       = 0;
		$data['c_content_type']     = $post['content_type'];
		// $data['c_youtube_url']      = trim($post['youtube_url']);
		// $data['c_youtube_id']       = trim($post['youtube_id']);

		$insertID = $this->contents_model->insert_content($data);

		if ($insertID){
			// ------- Upload Image file --------
			if ($_FILES['userfile']['name'] != '')
			{
				// Upload image from computer
				$destination = $this->config->item('posts_images_dir'). date("Y").'/'. date("m").'/'. date("d").'/'. $insertID."/";
				if (!is_file($destination.$file_image_name)) {
					mkdir_r($destination);
				}
				move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_image_name);
				// -------- create Thumbnail (template_helper) ---------
				create_img_thumbnail($destination.$file_image_name);
			
			}elseif ($_FILES['userfile']['name'] == '' && $post['content_type'] =='video'){
				// Grab image from youtube if this is video article
				$destination = $this->config->item('posts_images_dir'). date("Y").'/'. date("m").'/'. date("d").'/'. $insertID."/";
				if (!is_file($destination.$file_image_name)) {
					mkdir_r($destination);
				}
				file_put_contents ($destination."/".$data['c_youtube_id'].".jpg",file_get_contents("http://img.youtube.com/vi/".$data['c_youtube_id']."/hqdefault.jpg"));
			}

			$this->session->set_userdata('message','Data has been saved.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Error Saving Data.');
			$this->session->set_userdata('message_type','error');
		}
	  }
		redirect($this->uri->segment(1));
	}

	function edit($ID) 
	{
		// error_reporting(E_ALL);
		// print_r($this->session->userdata); 
		$mainData['CU'] = $this->user_model->current_user();
		$ID = $this->uri->segment(3);
		$output['PAGE_TITLE'] = 'Edit <strong>Ruang Kita</strong>';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css'] .= add_css("css/validationEngine.jquery.css");
		$mainData['top_css'] .= add_css("js/select2/select2.css");
		$mainData['top_css'] .= add_css("js/bootstrap-wysihtml5/bootstrap-wysihtml5.css");
		$mainData['top_css'] .= add_css("js/fileinput/fileinput.min.css");
		$mainData['top_css'] .= add_css("css/bootstrap-datepicker.css");
		$mainData['top_css'] .= add_css("css/bootstrap-timepicker.css");

		$mainData['top_js'] .= add_js('js/jquery.js');
		$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/wysihtml5-0.3.0.js");
		$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/bootstrap-wysihtml5.js");
		$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
		$mainData['top_js'] .= add_js("js/bootstrap-datepicker.js");
		$mainData['top_js'] .= add_js("js/bootstrap-timepicker.js");
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

		$output['mode']           = 'EDITING';
		$output['EDIT']           = $this->contents_model->get_content_by($ID);
		$output['CU']             = $mainData['CU'];
		$output['channel']        = $this->config->item($this->uri->segment(1));	// berita atau csr
		$output['features']       = $this->features_model->get_all_active_features();
		$output['author']         = $this->user_model->get_all_active_user();
		$output['editor']         = $this->user_model->get_all_active_editor();

		// Jika artikel sedang di edit oleh user lain maka tidak bisa edit artikel ini dan tampilkan pesan
		if ($output['EDIT']['c_is_editing'] == 1){
			$this->session->set_userdata('message','Data sedang dalam proses editing..!!!');
			$this->session->set_userdata('message_type','error');
			redirect($this->uri->segment(1));
			exit;
		}else{
			// jika tidak sedang diedit, maka jadikan status editing = 1 
			$data['c_is_editing'] = 1;
			$this->contents_model->update_content($data, $ID);	
		}

		// _d($output['EDIT']);
		// exit;

		$mainData['mainContent']  = $this->load->view('berita/vform', $output,true);

		$this->load->view('vbase',$mainData);		
	}

	function submit_update() 
	{
	  if($_SERVER['REQUEST_METHOD']=='POST'){
		$post = $this->input->post();

		$ID   = $post['cid'];
		$EDIT = $this->contents_model->get_content_by($ID);

		if($_FILES['userfile']['name'] == ''){
			if ($post['content_type'] =='video'){
				$file_image_name   = trim($post['youtube_id']).'.jpg';
				$file_image_thumb  = trim($post['youtube_id']).'.jpg';
			}else{
				$file_image_name   = $EDIT['c_images_content'];
				$file_image_thumb  = $EDIT['c_images_thumbnail'];
			}
		}else{
			// ----- Process Image Name -----
			//$valid_chars_regex = 'A-Za-z0-9_-\s '; // Characters allowed in the file name (in a Regular Expression format)
			$img_info          = pathinfo($_FILES['userfile']['name']);
			//$fileName          = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', '', strtolower(str_replace(' ', '-', $img_info['filename'])));
			
			$fileName          = strtolower(str_replace(' ', '-', $img_info['filename']));
			$fileName          = preg_replace('#[^a-z.0-9_-]#i', '', $fileName);
			$fileExt           = $img_info['extension'];
			$file_image_name   = $fileName.'.'.$fileExt;
			$file_image_thumb  = $fileName. '_thumb.' .$fileExt;
			// ----- END Process Image Name -----
		}

		$post_content = str_replace('cms.banksulselbar.com', 'www.banksulselbar.com', $post['content']);

		$data['c_publish_date']     = $post['pubdate'] .' '. $post['pubtime'].':'.date('s');
		$data['c_subtitle']         = in(trim($post['subtitle']));
		$data['c_title']            = in(trim($post['title']));
		$data['c_slug']             = trim($post['slug']);
		$data['c_summary']          = in($post['summary']);
		$data['c_content']          = in($post_content);
		$data['c_images_thumbnail'] = $file_image_thumb;
		$data['c_images_content']   = $file_image_name;
		$data['c_images_caption']   = trim($post['img_caption']);
		$data['c_keyword']          = trim($post['keyword']);
		$data['c_channel_id']       = $post['channel_id'];
		$data['c_feature']          = $post['feature'];
		$data['c_type']             = $this->config->item('news');
		$data['c_source']           = $post['source'];
		$data['c_author']           = trim($post['author']);
		$data['c_author_name']      = trim($post['other_author_name']);
		$data['c_editor']           = $post['editor'];
		$data['c_hits']             = $post['hit'];
		$data['c_status']           = $post['status'];
		$data['c_created_date']     = $post['dateCreated'];
		$data['c_modified_date']    = date('Y-m-d H:i:s');
		$data['c_is_editing']       = 0;
		$data['c_content_type']     = $post['content_type'];
		// $data['c_youtube_url']      = trim($post['youtube_url']);
		// $data['c_youtube_id']       = trim($post['youtube_id']);

		$update = $this->contents_model->update_content($data, $ID);

		if ($update){

			$tgl   = explode(' ', $EDIT['c_created_date']);	// [0] =2014-09-22 [1] =10:00:00
          	$tgl   = explode('-', $tgl[0]);
			$year  = $tgl[0];
			$month = $tgl[1];
			$day   = $tgl[2];

			if ($_FILES['userfile']['name'] != '') {
				
				// Delete old Image
				if (file_exists($this->config->item('posts_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/'.$EDIT['c_images_content'])) {
					unlink($this->config->item('posts_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/'.$EDIT['c_images_content']);
					unlink($this->config->item('posts_images_dir').$year.'/'.$month.'/'.$day.'/'.$ID.'/'.$EDIT['c_images_thumbnail']);
				}
				
				// Upload New Image
				$destination = $this->config->item('posts_images_dir'). $year.'/'.$month.'/'.$day.'/'.$ID.'/';
				if (!is_file($destination.$file_image_name)) {
					mkdir_r($destination);
				}
				
				move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_image_name);
				create_img_thumbnail($destination.$file_image_name);
			}elseif ($_FILES['userfile']['name'] == '' && $post['content_type'] =='video'){
				/*$tgl   = explode(' ', $EDIT['c_created_date']);	// [0] =2014-09-22 [1] =10:00:00
              	$tgl   = explode('-', $tgl[0]);
				$year  = $tgl[0];
				$month = $tgl[1];
				$day   = $tgl[2];*/
				$destination = $this->config->item('posts_images_dir'). $year.'/'.$month.'/'.$day.'/'.$ID.'/';
				if (!is_file($destination.$file_image_name)) {
					mkdir_r($destination);
				}
				file_put_contents ($destination."/".$data['c_youtube_id'].".jpg",file_get_contents("http://img.youtube.com/vi/".$data['c_youtube_id']."/hqdefault.jpg"));
			}

			$this->session->set_userdata('message','Article has been updated.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Error Saving Data.');
			$this->session->set_userdata('message_type','error');
		}
	  }
		redirect($this->uri->segment(1));
	}

	function delete()
	{
		$id = $this->uri->segment(3);

		$EDIT = $this->contents_model->get_content_by($id);

		// --- jika artikel dalam proses editing, maka tidak bisa di delete
		if ($EDIT['c_is_editing'] == 1){
			$this->session->set_userdata('message','Data sedang dalam proses editing..!!!');
			$this->session->set_userdata('message_type','error');
			redirect('ruang_kita');
			exit;
		}else{
		
			$data = array();
			$data['c_status'] = 'trash';
			if($this->contents_model->update_content($data,$id)){
				$this->session->set_userdata('message','Data has been deleted and moved to trash.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','There is no data on this action!.');
				$this->session->set_userdata('message_type','warning');
			}
			redirect($this->uri->segment(1));
		}
	}

	function release()
	{
		$ID = $this->uri->segment(3);

		if (!empty($ID))
		{
			// set status editing 0
			$data['c_is_editing'] = 0;
			$this->contents_model->update_content($data, $ID);
		}
		redirect($this->uri->segment(1));
	}

	function publish()
	{
		$ID = $this->uri->segment(3);
		$this->contents_model->publish($ID);

		$this->session->set_userdata('message','Publish Success.');
		$this->session->set_userdata('message_type','success');
		redirect($this->uri->segment(1));
	}

	function thumbnail($ID)
	{
		error_reporting(E_ALL);

		$mainData['CU']       = $this->user_model->current_user();
		$ID                   = $this->uri->segment(3);
		$thumb_w              = (empty($_GET['w'])) ? '469' : $_GET['w'];
		$thumb_h              = (empty($_GET['h'])) ? '312' : $_GET['h'];
		$output['PAGE_TITLE'] = 'Edit <strong>Thumbnail</strong>';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css'] .= add_css("js/bootstrap-wysihtml5/bootstrap-wysihtml5.css");
		$mainData['top_css'] .= add_css("js/fileinput/fileinput.min.css");
		$mainData['top_css'] .= add_css("css/imgeareaselect/imgareaselect-default.css");

		$mainData['top_js'] .= add_js('js/jquery.js');
		$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/wysihtml5-0.3.0.js");
		$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/bootstrap-wysihtml5.js");
		$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
		$mainData['top_js'] .= add_js("js/imgareaselect/jquery.imgareaselect.js");

		$mainData['bottom_js'] .= add_js('bs3/js/bootstrap.min.js');
		$mainData['bottom_js'] .= add_js('js/jquery.dcjqaccordion.2.7.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo.min.js');
		$mainData['bottom_js'] .= add_js('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.nicescroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo/jquery.scrollTo.js');
		$mainData['bottom_js'] .= add_js('js/jquery-easing/jquery.easing.min.js');
		$mainData['bottom_js'] .= add_js('js/underscore/underscore-min.js');
		
		$mainData['bottom_js'] .= add_js('js/data/global.js');

		$output['mode']    = 'EDITING';
		$output['EDIT']    = $this->contents_model->get_content_by($ID);
		$output['thumb_w'] = $thumb_w;
		$output['thumb_h'] = $thumb_h;


		$mainData['mainContent']  = $this->load->view('content/vthumbnail_form', $output,true);

		$this->load->view('vbase',$mainData);
	}
	
	function create_thumbnail()
	{
		// error_reporting(E_ALL);
		// get post param
		$x             = $this->input->post('x');
		$x1            = $this->input->post('x1');
		$y             = $this->input->post('y');
		$y1            = $this->input->post('y1');
		$height        = $this->input->post('height');
		$width         = $this->input->post('width');
		$img_content   = $this->input->post('img_content');
		$img_thumbnail = $this->input->post('img_thumbnail');
		$c_id          = $this->input->post('c_id');
		$create_date   = $this->input->post('create_date');

		$path            = parseDateTime($create_date);
		$source_img      = $this->config->item('posts_images_dir'). $path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$c_id.'/'.$img_content;
		unlink($this->config->item('posts_images_dir').$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$c_id.'/'.$img_thumbnail);

		list($name, $type) = explode('.', $img_content);
        list($width_src, $height_src) = getimagesize($source_img);
        $file_image_thumb = $name.'_'.randomString(4).'.'.$type;
        $destination_img = $this->config->item('posts_images_dir'). $path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$c_id.'/'.$file_image_thumb;

		$thumb_width = $this->input->post('thumb_width');
		$scale_src   = $width_src / 600;
		$act_width   = ceil($width * $scale_src);
		$act_height  = ceil($height * $scale_src);
		$scale       = $thumb_width / $act_width;

        $act_x = ceil($x * $scale_src);
        $act_y = ceil($y * $scale_src);

		// cropping & resize image content base on selection
		$cropped = croppingImagetoThumb($destination_img, $source_img, $act_width, $act_height, $act_x, $act_y, $scale);

		$data['c_images_thumbnail'] = $file_image_thumb; 
		$update                     = $this->contents_model->update_content($data, $c_id);

		redirect('ruang_kita');
	}


}

/* End of file ruang_kita.php */