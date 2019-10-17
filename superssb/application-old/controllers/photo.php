<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class photo extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('photo_model');
		$this->load->model('user_model');

		$this->user_model->has_login();
	}

	function index()
	{
		// error_reporting(E_ALL);
		
		$mainData['CU'] = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'Foto';

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
		$mainData['bottom_js'] .= add_js('js/data/photo.js');

		$mainData['mainContent']  = $this->load->view('photo/vlist', $output,true);

		$this->load->view('vbase',$mainData);
	}

	function json()
	{
		$getdata  = $this->photo_model->get_photos();
		print_r($getdata);
	}

	function add()
	{
		$mainData['CU'] = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'Add Photo';
		$output['add_mode'] = 1;

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
		$output['CU']             = $mainData['CU'];

		$output['channels']       = $this->photo_model->get_channel_photo();

		$mainData['mainContent']  = $this->load->view('photo/vform', $output,true);

		$this->load->view('vbase',$mainData);		
	}

	function submit_add() 
	{
		// error_reporting(E_ALL);

	  if($_SERVER['REQUEST_METHOD']=='POST' && $this->input->post('title') !='' ){

		$post = $this->input->post(null, true);

		if($_FILES['userfile']['name'] == ''){
			$file_image_name  = '';
			$file_image_thumb = '';
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

		// --------- PHOTO ALBUM ----------
		$alb['album_date']          = $post['pubdate'];
		$alb['album_title']         = in($post['title']);
		$alb['album_slug']          = $post['slug'];
		$alb['album_description']   = in($post['description']);
		$alb['album_created_date']  = date("Y-m-d H:i:s");
		$alb['album_modified_date'] = '';
		$alb['album_channel_id']    = $post['channel'];
		$alb['album_status']        = $post['status'];

		$albumID = $this->photo_model->insert_album($alb);

		// --------- PHOTOS ----------
		$data['ph_title']            = in($post['title']);
		$data['ph_images_thumbnail'] = $file_image_thumb;
		$data['ph_images']           = $file_image_name;
		$data['ph_caption']          = in($post['caption']);
		$data['ph_credit']           = $post['photo_credit'];
		$data['ph_photographer']     = $post['photographer'];
		$data['ph_album_id']         = $albumID;
		$data['ph_is_cover']         = 1;
		$data['ph_status']           = $post['status'];

		$photoID = $this->photo_model->insert_photo($data);

		if ($albumID && $photoID){
			// ------- Upload Image file --------
			$destination = $this->config->item('photos_images_dir'). date("Y").'/'. date("m").'/'. date("d").'/'. $albumID."/";
			if (!is_file($destination.$file_image_name)) {
				mkdir_r($destination);
			}
			move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_image_name);
			
			// -------- create Thumbnail ---------
			$this->create_img_thumbnail($destination.$file_image_name);

			$this->session->set_userdata('message','Photo has been saved.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Error Saving Data.');
			$this->session->set_userdata('message_type','error');
		}

		// ----------------- Add Photos List -----------------
		$arrTitle   = $this->input->post('photo_title');
		$arrCaption = $this->input->post('photo_caption');
		$arrImages  = $_FILES['photo_image'];
    	$countData  = count($arrTitle);

    	if ($countData > 0){
	    	for ($i=0; $i<$countData; $i++)
	    	{
	    		if (!empty($arrImages['name'][$i])) {

	    			// ----- Process Image Name -----
					//$valid_chars_regex = 'A-Za-z0-9_-\s '; // Characters allowed in the file name (in a Regular Expression format)
					$img_info          = pathinfo($arrImages['name'][$i]);
					//$fileName          = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', '', strtolower(str_replace(' ', '-', $img_info['filename'])));
					$fileName          = strtolower(str_replace(' ', '-', $img_info['filename']));
					$fileName          = preg_replace('#[^a-z.0-9_-]#i', '', $fileName);
					$fileExt           = $img_info['extension'];
					$file_image_name   = $fileName.'.'.$fileExt;
					$file_image_thumb  = $fileName. '_thumb.' .$fileExt;
					// ----- END Process Image Name -----

	        		// insert record
	        		$p['ph_title']            = in($arrTitle[$i]);
					$p['ph_images_thumbnail'] = $file_image_thumb;
					$p['ph_images']           = $file_image_name;
					$p['ph_caption']          = in($arrCaption[$i]);
					$p['ph_credit']           = $post['photo_credit'];
					$p['ph_photographer']     = $post['photographer'];
					$p['ph_album_id']         = $albumID;
					$p['ph_is_cover']         = 0;
					$p['ph_status']           = $post['status'];

	        		$this->photo_model->insert_photo($p);

					if (!is_file($destination.$file_image_photo)) {
						mkdir_r($destination);
					}
					if (move_uploaded_file($arrImages['tmp_name'][$i], $destination.$file_image_name)) {
						// -------- create Thumbnail ---------
						$this->create_img_thumbnail($destination.$file_image_name);
					}
				}
	    	}
	    }
		// --------------------------------------------------

		redirect('photo');
	  }else{
	  	$this->session->set_userdata('message','TITLE Photo can not be empty.');
		$this->session->set_userdata('message_type','error');
	  	redirect('photo/add');
	  }
	}

	function edit($ID) 
	{
		$mainData['CU'] = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'Edit Photo';
		$output['add_mode'] = 2;
		$ID = $this->uri->segment(3);

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
		$mainData['bottom_js'] .= add_js('js/data/select2-data.js');
		$mainData['bottom_js'] .= add_js('js/data/global.js');

		$output['EDIT']          = $this->photo_model->get_single_photo($ID);
		$output['CU']            = $mainData['CU'];
		$output['channels']      = $this->photo_model->get_channel_photo();
		$mainData['mainContent'] = $this->load->view('photo/vedit_form', $output,true);

		$this->load->view('vbase',$mainData);
	}

	
	function submit_update() 
	{
	  if($_SERVER['REQUEST_METHOD']=='POST' && $this->input->post('album_title') !='' ){
		
		$post = $this->input->post(null, true);

		$photoID         = $post['photo_id'];
		$albumID         = $post['album_id'];
		$old_image       = $post['current_images'];
		$old_image_thumb = $post['current_images_thumb'];
		$date_created    = $post['album_created'];

		if($_FILES['userfile']['name'] == ''){
			$file_image_name   = $old_image;
			$file_image_thumb  = $old_image_thumb;
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

		// --------- PHOTO ALBUM ----------
		$alb['album_date']          = $post['pubdate'];
		$alb['album_title']         = in($post['album_title']);
		$alb['album_slug']          = $post['slug'];
		$alb['album_description']   = in($post['description']);
		$alb['album_created_date']  = $date_created;
		$alb['album_modified_date'] = date("Y-m-d H:i:s");
		$alb['album_channel_id']    = $post['channel'];
		$alb['album_status']        = $post['status'];

		$affected = $this->photo_model->update_album($alb, $albumID);

		// --------- PHOTOS ----------
		$data['ph_title']            = in($post['photo_title']);
		$data['ph_images_thumbnail'] = $file_image_thumb;
		$data['ph_images']           = $file_image_name;
		$data['ph_caption']          = in($post['caption']);
		$data['ph_credit']           = $post['photo_credit'];
		$data['ph_photographer']     = $post['photographer'];
		$data['ph_album_id']         = $albumID;
		$data['ph_is_cover']         = $post['is_cover'];
		$data['ph_status']           = $post['status'];

		$affected2 = $this->photo_model->update_photo($data, $photoID);

		if ($affected OR $affected2){
			if ($_FILES['userfile']['name'] != '') {
				// Delete old image. Upload the new one.
				$tgl   = explode(' ', $date_created);	// [0] =2014-09-22 [1] =10:00:00
              	$tgl   = explode('-', $tgl[0]);
				$year  = $tgl[0];
				$month = $tgl[1];
				$day   = $tgl[2];

				// Delete old Image
				unlink($this->config->item('photos_images_dir').$year.'/'.$month.'/'.$day.'/'.$albumID.'/'.$old_image);
				unlink($this->config->item('photos_images_dir').$year.'/'.$month.'/'.$day.'/'.$albumID.'/'.$old_image_thumb);
				
				// Upload New Image
				$destination = $this->config->item('photos_images_dir'). $year.'/'.$month.'/'.$day.'/'.$albumID.'/';
				if (!is_file($destination.$file_image_name)) {
					mkdir_r($destination);
				}
				
				move_uploaded_file($_FILES['userfile']['tmp_name'], $destination.$file_image_name);
				$this->create_img_thumbnail($destination.$file_image_name);

			}

			$this->session->set_userdata('message','Photo has been updated.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Error Saving Data.');
			$this->session->set_userdata('message_type','error');
		}
	  }
		redirect('photo');
	}

	function delete()
	{
		$id      = $this->uri->segment(3);
		$EDIT    = $this->photo_model->get_single_photo($id);
		$albumID = $EDIT['ph_album_id'];

		// delete data di DB: table photos (dan photo_album jika ini adalah photo terakhir pd album tsb)
		$hapus = $this->photo_model->delete_photo($id, $albumID);

		if ($hapus)
		{
			$path = parseDateTime($EDIT['album_created_date']);
			$directory = $this->config->item('photos_images_dir').$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$albumID.'/';
			// Delete old Image
			unlink($directory.$EDIT['ph_images']);
			unlink($directory.$EDIT['ph_images_thumbnail']);

			// if folder is empty then delete it
			if(count(glob("$directory/*"))==0) {
			    // echo 'dir empty';
			    rmdir($directory);
			} else {
			    // echo 'dir not empty';
			}
		}

		redirect('photo');
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
        	$res_width = 360;
        	$res_height = 221;
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

	function publish()
	{
		$album_id = $this->uri->segment(3);
		$this->photo_model->publish($album_id);

		$this->session->set_userdata('message','Publish Success.');
		$this->session->set_userdata('message_type','success');
		redirect('photo');
	}

	function loadmore()
	{
		$next = $this->input->get('next');
		echo '<div class="photo'.$next.'" style="margin-top:10px;">
				<nav role="navigation" class="navbar navbar-inverse" style="min-height:25px !important;">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand" style="padding:2px 0 2px 10px !important; font-size:15px;">NEXT PHOTO '.$next.'</a>
                    </div>
                </nav>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="photo_title[]" id="title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Caption</label>
                    <div class="col-sm-6">
                        <textarea rows="6" class="form-control" name="photo_caption[]"></textarea>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Image</label>
                  <div class="col-md-6">
                    <div class="form-group" style="margin-left:1px;">
                        <input id="file-3'.$next.'" type="file" data-show-upload="false" accept="image/*" name="photo_image[]">
                    </div>
                  </div>
                </div>
              
              <script>
				$("#file-3'.$next.'").fileinput({

				  showCaption: false,
				  fileType: "any",
				  previewFileType: "image",
				  browseClass: "btn btn-success",
				  browseLabel: "Pick Image",
				  browseIcon: \'<i class="fa fa-fw fa-folder-open-o"></i>\',
				  removeClass: "btn btn-danger",
				  removeLabel: "Delete",
				  removeIcon: \'<i class="fa fa-fw fa-trash-o"></i>\',
				  maxFileSize: 3000,
				    
				  // overwriteInitial: false,
				  // maxFilesNum: 10
				});
				</script>
				</div>
              ';
	}

}

/* End of file photo.php */