<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kantor_cabang extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('date');
		$this->load->model('pages_model');
		$this->load->model('jaringan_model');
		$this->load->model('user_model');
		
		$this->user_model->has_login();
	}

	function index()
	{
		// error_reporting(E_ALL);
		$output['PAGE_TITLE'] = 'Kantor Cabang';

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
		$mainData['bottom_js'] .= add_js('js/data/kantor_cabang.js');

		$mainData['mainContent']  = $this->load->view('jaringan/vkantorcabangform', $output,true);
		$this->load->view('vbase',$mainData);
	}

	function json()
	{
			
		$data = $this->jaringan_model->get_kantor_cabang();
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

			$output['category'] = 1;
			
			$mainData['mainContent'] = $this->load->view('jaringan/vkantorcabangadd_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}
		else{
			$post = $this->input->post(null, true);

			$data['branch_name']        = in($post['branch_name']);
			$data['branch_address']     = in($post['branch_address']);
			$data['branch_phone']       = in($post['branch_phone']);
			$data['branch_fax']         = in($post['branch_fax']);
			$data['branch_status'] 		= in($post['branch_status']);
			$data['branch_created']  	= date("Y-m-d H:i:s");
			$data['branch_modified']  	= date("Y-m-d H:i:s");

			$insertID = $this->jaringan_model->insert_new_page('branch_office', $data);
			if ($insertID){
				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');
				redirect('kantor_cabang'); 
			}
			exit();
		}
	}

	function edit()
	{
		// error_reporting(E_ALL);
		$ID                   = $this->uri->segment(3);
		$a['CU']              = $this->user_model->current_user();
		$output['PAGE_TITLE'] = 'EDIT PAGES';
		$output['add_mode']   = 2; // sbg tanda edit
		$output['EDIT']       = $this->jaringan_model->get_page_kantor_cabang_byid($ID);

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
			
			$mainData['mainContent'] = $this->load->view('jaringan/vkantorcabangadd_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post(null, true);

			$ID   = $post['branch_id'];
			$EDIT = $output['EDIT'];

			$data['branch_name']        = in($post['branch_name']);
			$data['branch_address']     = in($post['branch_address']);
			$data['branch_phone']       = in($post['branch_phone']);
			$data['branch_fax']         = in($post['branch_fax']);
			$data['branch_status'] 		= in($post['branch_status']);
			$data['branch_created']  	= in($post['branch_created']);
			$data['branch_modified']  	= date("Y-m-d H:i:s");

			$update = $this->jaringan_model->update_kantor_cabang($data, $ID);
			if ($update){
				$this->session->set_userdata('message','Data berhasil di-update.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Tidak ada yang diubah.');
				$this->session->set_userdata('message_type','success');
			}
		 	redirect('kantor_cabang');
		}
	}

	function delete()
	{
		// error_reporting(E_ALL);
		$ID = $this->uri->segment(3);
		$data         = $this->jaringan_model->get_page_kantor_cabang_byid($ID);
		$remove_quote = $this->jaringan_model->delete_jaringan('branch_office', 'branch_id', $ID);
		
		$tgl   = explode(' ', $data['branch_created']);
		$tgl   = explode('-', $tgl[0]);
		$year  = $tgl[0];
		$month = $tgl[1];
		$day   = $tgl[2];

		if($remove_quote){
			$this->session->set_userdata('message','Data Kantor Cabang berhasil dihapus.');
			$this->session->set_userdata('message_type','success');
		}else{
			$this->session->set_userdata('message','Tidak ada data yang dihapus.');
			$this->session->set_userdata('message_type','warning');
		}
		redirect('kantor_cabang');
	}

	function validation()
	{
		// error_reporting(E_ALL);
		$this->form_validation->set_rules('branch_name', 'Nama Kantor', 'trim|required');
		$this->form_validation->set_rules('branch_address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('branch_phone', 'Nomor Telepon', 'trim|required');
		$this->form_validation->set_rules('branch_fax', 'Nomor Fax', 'trim|required');

		$this->form_validation->set_message('required', '%s harus diisi.');
	}

}

/* End of file pages.php */