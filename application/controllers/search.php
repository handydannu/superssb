<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('contents_model');

		$this->load->helper('contentdate');
		$this->load->helper('text');
	}

	function index()
	{
		/******** Display Search Result *******/

		error_reporting(E_ALL);

		$this->load->library('security');

		$output['page_title']    = 'Hasil Pencarian';
		$mainData['active_menu'] = '';

		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';


		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

        // -------------- CONTENT ---------------------

		$GET = $this->input->get(NULL, TRUE); // returns all GET items with XSS filter

		//_d($GET);

		$page          = strip_tags($GET['page']);		
		$is_numeric    = preg_match('/[a-zA-Z]/i', $page);	// numeric only, return 0 if numeric. 1 if letter
		
		$search_string = strip_tags(trim($GET['q']));
		$search_string = preg_replace('/[^a-z0-9]/i', ' ', $search_string);	// allow alphabet and numeric only

        $limit  = 10;

    	if (empty($page)) {
            $offset = 0;
        }else{
            $offset = ($page*$limit)-$limit;
        }

		if (!empty($search_string) && ($is_numeric==0) ){
			$post = $this->contents_model->search_content($search_string, $offset, $limit);
			$output['articles'] = $post['data'];

			/*_d($output['articles']);
			exit;*/

			// --------- PAGINATION --------------
			$this->load->library('pagination');
			$config['base_url']             = base_url(). 'search?q='.$search_string;
			$config['uri_segment']          = 2;
			$config['total_rows']           = $post['totalrow'];
			$config['per_page']             = $limit;
			$config['page_query_string']    = TRUE;
			$config['query_string_segment'] = 'page';
			$config['num_links']            = 3;
			$config['use_page_numbers']     = TRUE;
			
			$config['full_tag_open']        = '<ul class="pagination">';
			$config['full_tag_close']       = '</ul>';
			$config['first_tag_open']       = '<li>';
			$config['first_tag_close']      = '</li>';
			$config['last_tag_open']        = '<li>';
			$config['last_tag_close']       = '</li>';
			$config['next_link']            = '<i class="fa fa-angle-right"></i>';
			$config['next_tag_open']        = '<li>';
			$config['next_tag_close']       = '</li>';
			$config['prev_link']            = '<i class="fa fa-angle-left"></i>';
			$config['prev_tag_open']        = '<li>';
			$config['prev_tag_close']       = '</li>';
			$config['cur_tag_open']         = '<li class="active"><a href="javascript:;">';
			$config['cur_tag_close']        = '</a></li>';
			$config['num_tag_open']         = '<li>';
			$config['num_tag_close']        = '</li>';

	        $this->pagination->initialize($config);
	        $output['pagination'] = $this->pagination->create_links();
	        // --------- END OF PAGINATION ---------
		}else{
			$output['search_result'] = '';
		}

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vsearch', $output, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

}

/* End of file search.php */