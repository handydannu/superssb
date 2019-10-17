<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('master_model');
		$this->load->model('user_model');
		$this->load->model('report_model');

		$this->load->helper('text');

		$this->user_model->has_login();
	}

	function index()
	{
		//error_reporting(E_ALL);
		$mainData['CU'] = $this->user_model->current_user();

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		$mainData['top_css'] .= add_css('js/css3clock/css/style.css');

		$mainData['bottom_js'] .= add_js('js/jquery.js');
		$mainData['bottom_js'] .= add_js('bs3/js/bootstrap.min.js');
		$mainData['bottom_js'] .= add_js('js/jquery.dcjqaccordion.2.7.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo.min.js');
		$mainData['bottom_js'] .= add_js('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.nicescroll.js');
		$mainData['bottom_js'] .= add_js('js/jquery.scrollTo/jquery.scrollTo.js');
		$mainData['bottom_js'] .= add_js('js/jquery-easing/jquery.easing.min.js');
		$mainData['bottom_js'] .= add_js('js/underscore/underscore-min.js');
		$mainData['bottom_js'] .= add_js('js/css3clock/js/css3clock.js');

		// dashboard content
		$data['popular_today'] = $this->report_model->article_popular_today(5);
		$data['popular_month'] = $this->report_model->article_popular_month(5);
		//$data['inbox']         = $this->report_model->get_inbox(5);
		$data['subscriber']    = $this->report_model->get_subscriber(5);
		$data['publish']       = $this->report_model->get_publish_article();
		$data['draft']         = $this->report_model->get_draft_article();

		//$data = null;
		
		$mainData['mainContent'] = $this->load->view('content/vdashboard', $data,true);

		// _d($data['subscriber']);
		// exit;

		$this->load->view('vbase',$mainData);
	}

	function lock()
	{
		$mainData['CU'] = $this->user_model->current_user();
		$this->load->view('vlockscreen',$mainData);
	}
}