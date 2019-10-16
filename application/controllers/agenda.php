<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('contents_model');
		$this->load->helper('contentdate');
	}

	public function index()
	{
		$c['top_css']   = '';
		$c['top_js']    = '';
		$c['bottom_js'] = '';

		$c['top_css']   .= add_css('js/fullcalendar-2-9-1/fullcalendar.css');

		$c['bottom_js']   .= add_js('js/moment.js');
		$c['bottom_js']   .= add_js('js/fullcalendar-2-9-1/fullcalendar.js');
		$c['bottom_js']   .= add_js('js/data/calendar.js');


		if ($this->config->item('production')) {
            error_reporting(0);

            $c['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

        // --------- CONTENT ----------------------

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vagenda', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

	public function calendar_json()
	{
		$data = $this->contents_model->get_events();

		$i = 0;
		$color = array('primary', 'lime', 'inverse', 'info', 'midnightblue', 'purple', 'warning');
		
		foreach ($data as $row) {
			$start = $row['ev_startdate'];
			$end   = $row['ev_enddate'];
			$title = $row['ev_title'];
			$url   = base_url() .'agenda-kegiatan/detail/'. str_replace('-', '', $row['ev_startdate']).'/'.$row['ev_id'].'/'. url_title(strtolower($row['ev_title']));
			
			// ------ Data for Calendar ------
			$eventsArray['title']           = $title;
			$eventsArray['start']           = $start;
			$eventsArray['url']             = $url;
			$eventsArray['allDay']          = 'false';
			$eventsArray['backgroundColor'] = "Utility.getBrandColor('".$color[$i]."')";
			
			$events[] = $eventsArray;

			$i++;
		}

		echo json_encode($events);
	}

	public function detail()
	{
		$mainData['top_css']   = '';
		$mainData['top_js']    = '';
		$mainData['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $mainData['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

		// ------------- CONTENT ----------------
		$ID = $this->uri->segment(4);
		$detail = $this->contents_model->get_detail_event($ID);

		$c['detail'] = $detail;
		$c['share']  = shareSocmedia($detail['ev_title'], current_url());

		$path = parseDateTime($detail['ev_create_date']);
		$image_ = $this->config->item('images_event_uri') .  $path['year'] . '/' . $path['month'] . '/' . $path['day'] . '/' . $detail['ev_id'] . '/' . $detail['ev_images_content'];

		$c['img_article'] = $image_;		

        $meta_fb = array(
            'url'         => (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
            'type'        => 'article',
            'title'       => $detail['ev_title'],
            'image'       => $image_,
            'site_name'   => 'banksulselbar.co.id',
            'description' => $detail['ev_summary']
            );
        $mainData['meta']['facebook_tags'] = metaname_facebook($meta_fb);
		
		$mainData['page_title']           = $detail['ev_title'];
		$mainData['meta']['descriptions'] = $detail['ev_summary'];
		$mainData['meta']['keywords']     = str_replace(' ', ',', ($detail['ev_title']));
		
		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vagenda_detail', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

	

}

/* End of file agenda.php */