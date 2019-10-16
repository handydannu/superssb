<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss extends CI_Controller {

	/******* RSS FEED *******/

	function __construct()
	{
		parent::__construct();

		$this->load->model('contents_model');
		$this->load->helper('contentdate');
		// error_reporting(E_ALL);
	}

	public function index()
	{
		$title = "Banksulselbar.co.id";
		$descr = "Bank Sulselbar - Melayani Sepenuh hati";

		$xml = '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
		<channel>
			<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/"/>
			<atom:link href="'.base_url().'rss" rel="self" type="application/rss+xml" />
			<title>'.$title.'</title>
			<description>'.$descr.'</description>
			<link>'.site_url().'</link>
			<copyright>Copyright (c) '.date('Y').' '.$title.'</copyright>
			<lastBuildDate>'.$this->_topubDate(date('Y-m-d H:i:s')).'</lastBuildDate>
			<generator>Banksulselbar.com RSS 2.0 Generator</generator>';

		$data = $this->contents_model->get_list_breaking_all(10);
		
		$xml .= $this->my_feed_rss('', $data, '');
		$xml .= '</channel>
				</rss>';				
		header("Content-Type: text/xml");
		echo $xml;
	}

	function my_feed_rss($canal, $data, $from)
	{
		$xml = '';

		$total = count($data);
		if ($total > 0){
			for ($i=0; $i < $total; $i++) { 

				$kategori = $data[$i]['ch_name'];
                $kategori = str_replace(' & ', ' &#38; ', $kategori);
                $kategori = str_replace('&amp;', '&#38;', $kategori);

				$date = parseDateTime($data[$i]['c_created_date']);

				if ($data[$i]['c_content_type']=='video'){
					$url = base_url().'video/read/'.$date['year'].$date['month'].$date['day'].'/'.$data[$i]['c_id'].'/'.$data[$i]['c_slug'];
				}else{
					$url = base_url().'read/'.$date['year'].$date['month'].$date['day'].'/'.$data[$i]['c_id'].'/'.$data[$i]['c_slug'];
				}

				if (empty($data[$i]['c_images_thumbnail'])) {
					$breaking_image = '';
				}else{
					$breaking_image = $this->config->item('images_posts_uri') . $date['year'] . '/' . $date['month'] . '/' . $date['day'] . '/' . $data[$i]['c_id'] . '/' . $data[$i]['c_images_thumbnail'];
				}
		
				$img	  = $data[$i]['c_images_thumbnail'];

				if (!empty($img)) {
					// use absolute path to get image size
					$theimage = $this->config->item('images_path') .'/posts/' . $date['year'] . '/' . $date['month'] . '/' . $date['day'] . '/' . $data[$i]['c_id'] . '/' . rawurlencode(basename($img));

	                // Get Image size in bytes
	                $img_size = filesize($theimage);
	                //$img_size = $this->format_size($img_size);	// format image size in KB, MB, ...
	            }else{
	            	$img_size = 0;
	            }

				$xml.='
					<item>
					<title>'.htmlspecialchars(clean(strip_tags($data[$i]['c_title']))).'</title>
					<link>'.$url.'</link>
					<guid>'.$url.'</guid>
					<category>'. $kategori .'</category>
					<pubDate>'.$this->_topubDate($data[$i]['c_publish_date']).'</pubDate>
					<description>'.htmlspecialchars(strip_tags($data[$i]['c_summary'])).'</description>
					<enclosure url="'.$breaking_image.'" type="image/jpeg" length="'.$img_size.'" />
					</item>';
			}
		}else{
	        $xml ='
			<item>
			<title>0</title>
			<link></link>
			<guid></guid>
			<category>0</category>
			<pubDate>0</pubDate>
			<description>0</description>
			</item>';
		}
    	return $xml;
	}

	private function _topubDate($dateOnXML){
		$DateNTime = explode(" ",@$dateOnXML);
		$dateChunk = explode("-",@$DateNTime[0]);
		$dateFeed = date("D",mktime(0,0,0,intval(@$dateChunk[1]),intval(@$dateChunk[2]),intval(@$dateChunk[0]))).", ".@$dateChunk[2]." ".date("M",mktime(0,0,0,intval(@$dateChunk[1]),intval(@$dateChunk[2]),intval(@$dateChunk[0])))." ".@$dateChunk[0]." ".$DateNTime[1]." +0700";
		return $dateFeed;
	}

	/*function format_size($size) {
	      $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
	      if ($size == 0) { return('n/a'); } else {
	      return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); }
	}*/

}

/* End of file rss.php */