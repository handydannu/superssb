<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
    function textlimit($string_text, $number_limit){
		$tmp    = ((strlen($string_text) > $number_limit)) ? (substr($string_text,0,$number_limit-4)." ...") : $string_text;
		return $tmp;
	}
    
    function climiter($str, $n = 500, $end_char = '&#8230;'){
        $len = strlen(trim($str));//length of original string
        if (strlen($str) < $n){ return $str; }
        $str = preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $str));
        if (strlen($str) <= $n){ return $str; }                                  
            $out = "";
            foreach (explode(' ', trim($str)) as $val){
                $out .= $val.' ';
                if (strlen(trim($out)) == $len) { // if length not change return original string
                    return trim($out);
                }elseif (strlen($out) >= $n){
                    return trim($out).$end_char;
                }        
            }
           
    }

	function cleanHTML($htmltext){
		$patt = array('@<script[^>]*?>.*?</script>@si','@<[\\/\\!]*?[^<>]*?>@si','@<style[^>]*?>.*?</style>@siU','@<![\\s\\S]*?--[ \\t\\n\\r]*>@');
		$text = preg_replace($patt, '', $htmltext);
		
        return $text;

	}
	function decode_entities($text) {
    	$text= html_entity_decode($text,ENT_QUOTES,"ISO-8859-1"); #NOTE: UTF-8 does not work!
    	$text= preg_replace('/&#(\d+);/me',"chr(\\1)",$text); #decimal notation
    	$text= preg_replace('/&#x([a-f0-9]+);/mei',"chr(0x\\1)",$text);  #hex notation
    	return $text;
	}
	function clean($value) {
        $value = html_entity_decode($value,ENT_QUOTES,"ISO-8859-1"); #NOTE: UTF-8 does not work!
    	$value = preg_replace("@[^A-Za-z 0-9\-_'\".,/?:;()&%!<>]+@i","",$value);
        $value = preg_replace("/&#?[a-z0-9]+;/i","",$value);
    	return $value; 
	}
    function r_explode($str='/',$string)
    {
        $pos = strrpos($string, $str);
        //$vright = substr($string, $pos+1, strlen($string)-$pos);
        if ($pos != 0){
            $vright = substr($string, $pos+1, strlen($string)-$pos);
        }else{
            $vright = substr($string, $pos, strlen($string)-$pos);
        }
        $caption[0] = substr($string, 0, $pos); // caption
        $caption[1] = str_replace('-', '/', $vright); // credit
        return $caption;
    }
    function decode_htmlspecialchars($str)
    {
        // $str = htmlspecialchars_decode($str);
        $str = html_entity_decode($str);
        $str = stripslashes($str);

        return $str;
    }

    function in($text){
    $replaced = array("\n","\t","\r");
    if($text=='') return '';
    $text = preg_replace('/[^(\x20-\x7F)]*/','', $text); /* remove non-ascii */
    return htmlentities(str_replace(array_values($replaced),'',$text));
    }

    function _d($text){
        echo "<pre>";
        print_r($text);
        echo "</pre>";
    }

?>
