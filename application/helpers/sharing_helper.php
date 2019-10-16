<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function shareSocmedia($url,$title=''){
	// use third party addthis.com widget for share
	$html = '<div class="addthis_inline_share_toolbox"></div><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57bbdae1a01b2b5d"></script>
	';
	return $html;   
}

?>