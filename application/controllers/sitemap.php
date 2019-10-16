<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends CI_Controller {

	/****** Show Sitemap.xml *******/

	function __construct()
	{
		parent::__construct();

		$this->load->model('contents_model');
	}

	public function index()
	{
		$data = $this->contents_model->get_list_breaking_all(10);

		header('Content-type: application/xml');
		$xml = '<?xml version="1.0" encoding="UTF-8"?>
				<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
				     xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"
				     xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
				     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
				     xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
				       http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
				       http://www.google.com/schemas/sitemap-news/0.9
				       http://www.google.com/schemas/sitemap-news/0.9/sitemap-news.xsd">
				<url>
			    <loc>'.base_url().'</loc>
			    </url>';	

		foreach ($data as $row) {
			$date        = explode(' ', $row['c_created_date']);
			$date        = explode('-', $date[0]);
			$loc         = base_url() .'read/'. $date[0].$date[1].$date[2].'/'.$row['c_id'].'/'.$row['c_slug'];
			$img_loc     = $this->config->item('images_posts_uri'). $date[0].'/'.$date[1].'/'.$date[2].'/'.$row['c_id'].'/'.$row['c_images_content'];
			$img_caption = $row['c_images_caption'];
			$pub_date    = $row['c_publish_date'];
			$title       = $row['c_title'];
			$keyword     = str_replace(' ', ',', $row['c_title']);
			
			$xml .= '<url>
				    <loc>'.$loc.'</loc>
				    <image:image>
				    	<image:loc>'.$img_loc.'</image:loc>
				    	<image:caption>'.current(explode("/", $img_caption, 2)).'</image:caption>
				    	<image:title><![CDATA['.htmlspecialchars($title).']]></image:title>
				    </image:image>
				    <news:news>
				      <news:publication>
				        <news:name>prindonesiamagz.com</news:name>
				        <news:language>id</news:language>
				      </news:publication>
				      <news:access>Subscription</news:access>
				      <news:genres>PressRelease</news:genres>
				      <news:publication_date>'.date('c', strtotime($pub_date)).'</news:publication_date>
				      <news:title><![CDATA['.htmlspecialchars($title).']]></news:title>
				      <news:keywords>'. $keyword .'</news:keywords>
				    </news:news>
				  </url>';
		}
		$xml .= "</urlset>";
		echo $xml;
	}

}

/* End of file sitemap.php */