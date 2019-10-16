<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//function to get hostname where channel article is 
function domain_article_uri($channel_id){
    $CI =& get_instance();
    $read_path  = $CI->config->item('site_read');
    $read_news  = 'read';
    $domain     = $CI->config->item('read_domain');
    if(isset($read_path[$channel_id])) {
        if(strlen($read_path[$channel_id]) >1) {
            $uri_read   = site_url($read_path[$channel_id]);
        }
    }
    return $uri_read;
}

//function to get readcontroller in domain apps
function read_article_uri($channel_id){
    $uri_read = '';
    $CI =& get_instance();
    $read_path  = $CI->config->item('site_read');
    $read_news	= 'read';
    $domain		= $CI->config->item('site_domain');
	if(isset($read_path[$channel_id])) {
        if(strlen($read_path[$channel_id]) >1) {
    		$uri_read 	= 'http://'.$domain[$channel_id].'/'.$read_news;
	    }
    }
    return $uri_read;  
}


//function to get css by channel article
function site_css($channel_id){
    $CI =& get_instance();
    $css_site  = $CI->config->item('site_css');
    $css  = 'news';
    //$domain       = $CI->config->item('read_domain');
    if(isset($css_site[$channel_id])) {
        if(strlen($css_site[$channel_id]) >1) {
            $css  = $css_site[$channel_id];
        }
    }
    return $css;
}

// function cek data GET di uri saat akses HOME, jika ada brarti data lama dari google search maka redirect ke home
function get_data_uri(){
    if(!empty($_GET))
        {            
            redirect('http://www.bisnis.com','Location','301');
        }        
}

?>