<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Office_channeling extends CI_Controller {

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
		$output['PAGE_TITLE'] = 'Office Channeling';

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
		$mainData['bottom_js'] .= add_js('js/data/office_channeling.js');

		$mainData['mainContent']  = $this->load->view('jaringan/voffice_channeling_form', $output,true);
		$this->load->view('vbase',$mainData);
	}

	function json()
	{
			
		$data = $this->jaringan_model->get_office_channeling();
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
			$mainData['top_css']  .= add_css("css/bootstrap-datepicker.css");
			$mainData['top_css']  .= add_css("css/bootstrap-timepicker.css");

			$mainData['top_js'] .= add_js('js/jquery.js');
			$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/wysihtml5-0.3.0.js");
			$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/bootstrap-wysihtml5.js");
			$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
			$mainData['top_js'] .= add_js('js/ckeditor/ckeditor.js');
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
			$mainData['bottom_js'] .= add_js('js/friendurl/jquery.friendurl.min.js');
			$mainData['bottom_js'] .= add_js("js/select2/select2.js");
			$mainData['bottom_js'] .= add_js('js/data/global.js');

			$output['category'] = 1;
			
			$mainData['mainContent'] = $this->load->view('jaringan/voffice_channeling_add_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}
		else{
			$post = $this->input->post(null, true);

			$data['oc_name']        = in($post['oc_name']);
			$data['oc_address']     = in($post['oc_address']);
			$data['oc_phone']       = in($post['oc_phone']);
			$data['oc_fax']         = in($post['oc_fax']);
			$data['oc_status'] 		= in($post['oc_status']);
			$data['oc_created']  	= in($post['oc_created']);
			$data['oc_modified']  	= date("Y-m-d H:i:s");

			$insertID = $this->jaringan_model->insert_new_page('office_channeling', $data);
			if ($insertID){
				$this->session->set_userdata('message','Data berhasil disimpan.');
				$this->session->set_userdata('message_type','success');
				redirect('office_channeling'); 
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
		$output['EDIT']       = $this->jaringan_model->get_office_channeling_byid($ID);

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
			$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/wysihtml5-0.3.0.js");
			$mainData['top_js'] .= add_js("js/bootstrap-wysihtml5/bootstrap-wysihtml5.js");
			$mainData['top_js'] .= add_js("js/fileinput/fileinput.min.js");
			$mainData['top_js'] .= add_js('js/ckeditor/ckeditor.js');
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
			$mainData['bottom_js'] .= add_js('js/friendurl/jquery.friendurl.min.js');
			$mainData['bottom_js'] .= add_js("js/select2/select2.js");
			$mainData['bottom_js'] .= add_js('js/data/global.js');
			
			$mainData['mainContent'] = $this->load->view('jaringan/voffice_channeling_add_form', $output, TRUE);

			$this->load->view('vbase', $mainData);
		}else{
			$post = $this->input->post(null, true);

			$ID   = $post['oc_id'];
			$EDIT = $output['EDIT'];

			$data['oc_name']        = in($post['oc_name']);
			$data['oc_address']     = in($post['oc_address']);
			$data['oc_phone']       = in($post['oc_phone']);
			$data['oc_fax']         = in($post['oc_fax']);
			$data['oc_status'] 		= in($post['oc_status']);
			$data['oc_created']  	= in($post['oc_created']);
			$data['oc_modified']  	= date("Y-m-d H:i:s");

			$update = $this->jaringan_model->update_office_channeling($data, $ID);
			if ($update){
				$this->session->set_userdata('message','Data berhasil di-update.');
				$this->session->set_userdata('message_type','success');
			}else{
				$this->session->set_userdata('message','Tidak ada yang diubah.');
				$this->session->set_userdata('message_type','success');
			}
		 	redirect('office_channeling');
		}
	}

	function delete()
	{
		// error_reporting(E_ALL);
		$ID = $this->uri->segment(3);
		$data         = $this->jaringan_model->get_office_channeling_byid($ID);
		$remove_quote = $this->jaringan_model->delete_jaringan('office_channeling', 'oc_id', $ID);
		
		$tgl   = explode(' ', $data['oc_created']);
		$tgl   = explode('-', $tgl[0]);
		$year  = $tgl[0];
		$month = $tgl[1];
		$day   = $tgl[2];

		if($remove_quote){
			$this->session->set_userdata('message','Data Office Channeling berhasil dihapus.');
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
		$this->form_validation->set_rules('oc_name', 'Nama Kantor', 'trim|required');
		$this->form_validation->set_rules('oc_address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('oc_phone', 'Nomor Telepon', 'trim|required');
		$this->form_validation->set_rules('oc_fax', 'Nomor Fax', 'trim|required');

		$this->form_validation->set_message('required', '%s harus diisi.');
	}

}

/* End of file pages.php */