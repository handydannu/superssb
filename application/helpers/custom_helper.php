<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_offset_page($page,$limit){
    # var_dump($page);  
    
    if($page == '0' or empty($page)){$page = '1';}
    else{$page = $page;}
    
    $intpage = (int)$page;
    $currpage = ($intpage-1)*$limit;

    return $currpage;
}

function get_images($html) {
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $html, $matches);
    
    if( isset($matches[1][0]) ){
        return $matches[1][0];
    }else{
        return false;
    }
    
}

function model_load_model($model_name){
    $CI =& get_instance();
    $CI->load->model($model_name);
    return $CI->$model_name;
}

if ( ! function_exists('_d')){
    function _d($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}

if ( ! function_exists('_j')){
    function _j($arr){
        header('Content-type: application/json');
        echo( json_encode($arr) );
    }
}

if ( ! function_exists('parse_args')){
    function parse_args( $args, $defaults = '' ) {
        if ( is_object( $args ) )
            $r = get_object_vars( $args );
        elseif ( is_array( $args ) )
            $r =& $args;
        else
            parse_str( $args, $r );

        if ( is_array( $defaults ) )
            return array_merge( $defaults, $r );
        
        return $r;
    }
}

if ( ! function_exists('array_search_recursive')){
    function array_search_recursive($Needle,$Haystack,$NeedleKey="", $Strict=false,$Path=array()) {
      if(!is_array($Haystack))
        return false;
      foreach($Haystack as $Key => $Val) {
        if(is_array($Val)&&
           $SubPath=array_search_recursive($Needle,$Val,$NeedleKey,$Strict,$Path)) {
          $Path=array_merge($Path,Array($Key),$SubPath);
          return $Path;
        }
        elseif((!$Strict&&$Val==$Needle&&
                $Key==(strlen($NeedleKey)>0?$NeedleKey:$Key))||
                ($Strict&&$Val===$Needle&&
                 $Key==(strlen($NeedleKey)>0?$NeedleKey:$Key))) {
          $Path[]=$Key;
          return $Path;
        }
      }
      return false;
    }

}

if ( ! function_exists('get_new_measure')){

    function get_new_measure($curmeasure, $curwidth, $curheight, $measure = 'height'){
        // hight
        if($measure == 'height'){
            $newmeasure = ($curmeasure * $curheight) / $curwidth;
        }else{
            $newmeasure = ($curmeasure * $curwidth) / $curheight;
        }
        // $newmeasure = ($curwidth * $curheight) / $curmeasure;
        return (int)$newmeasure;
    }
}

/*
Array Diff Recursive
*/
if ( ! function_exists('array_diff_recursive')){
    /*function array_diff_recursive($aArray1, $aArray2) {
        $aReturn = array();

        foreach ($aArray1 as $mKey => $mValue) {
          if (@array_key_exists($mKey, $aArray2)) {
            if (is_array($mValue)) {
                $aRecursiveDiff = array_diff_recursive($mValue, $aArray2[$mKey]);
                if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; }
            } else {
                if ($mValue !== $aArray2[$mKey]) {
                    $aReturn[$mKey] = $mValue;
                }
            }

          } else {
            $aReturn[$mKey] = $mValue;
          }
        }
        return $aReturn;
    }*/
    function array_diff_recursive($aArray1, $aArray2) {
        return get_diff($aArray1, $aArray2);
    }
}

function get_diff($new, $old){
    $result = array();
    if((is_array($new) && is_array($old) && $new != $old)){
        // check changes
        foreach($new as $newKey=>$newItem){

            if( !array_key_exists($newKey, $old) ||
                (
                    array_key_exists($newKey, $old) && $newItem !== $old[$newKey])
                ){
                $result[$newKey] = $newItem;
            }
        }
    }
    return $result;
}

function cleanup_diff($new, $old){
    $result = array();
    if((is_array($new) && is_array($old) && $new != $old)){
        // check changes
        foreach($new as $newKey=>$newItem){
            if( !array_key_exists($newKey, $old) ||
                (
                    array_key_exists($newKey, $old) &&
                    $newItem != $old[$newKey])
                ){
                //$result[$newKey] = $newItem;

                if( isset($old[$newKey]) )
                    $result[$newKey] = get_diff($newItem, $old[$newKey]);
                else
                    $result[$newKey] = $newItem;
            }
        }
    }else{
        $result = $new;
    }
    return $result;
}

/* from wordpress */
if ( ! function_exists('human_time_diff')){
  function human_time_diff( $from, $to = '' ) {
    if ( empty($to) )
        $to = time();
    $diff = (int) abs($to - $from);
    if ($diff <= 3600) {
        $mins = round($diff / 60);
        if ($mins <= 1) {
            $mins = 1;
        }
        /* translators: min=minute */
        $since = sprintf('%s menit', $mins);
    } else if (($diff <= 86400) && ($diff > 3600)) {
        $hours = round($diff / 3600);
        if ($hours <= 1) {
            $hours = 1;
        }
        $since = sprintf('%s jam', $hours);
    } elseif ($diff >= 86400) {
        $days = round($diff / 86400);
        if ($days <= 1) {
            $days = 1;
        }
        $since = sprintf('%s hari', $days);
    }
    return $since;
  }
}

/**
 * Replaces double line-breaks with paragraph elements.
 *
 * A group of regex replaces used to identify text formatted with newlines and
 * replace double line-breaks with HTML paragraph tags. The remaining
 * line-breaks after conversion become <<br />> tags, unless $br is set to '0'
 * or 'false'.
 *
 * @since 0.71
 *
 * @param string $pee The text which has to be formatted.
 * @param int|bool $br Optional. If set, this will convert all remaining line-breaks after paragraphing. Default true.
 * @return string Text which has been converted into correct paragraph tags.
 */
if ( ! function_exists('wpautop')){
  function wpautop($pee, $br = 1) {

    if ( trim($pee) === '' )
      return '';
    $pee = $pee . "\n"; // just to make things a little easier, pad the end
    $pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
    // Space things out a little
    $allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|option|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr|fieldset|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';
    $pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
    $pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
    $pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
    if ( strpos($pee, '<object') !== false ) {
      $pee = preg_replace('|\s*<param([^>]*)>\s*|', "<param$1>", $pee); // no pee inside object/embed
      $pee = preg_replace('|\s*</embed>\s*|', '</embed>', $pee);
    }
    $pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
    // make paragraphs, including one at the end
    $pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
    $pee = '';
    foreach ( $pees as $tinkle )
      $pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
    $pee = preg_replace('|<p>\s*</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
    $pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);
    $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
    $pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
    $pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
    $pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
    $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
    $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
    if ($br) {
        $pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', '_autop_newline_preservation_helper', $pee);
        $pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
        $pee = str_replace('<WPPreserveNewline />', "\n", $pee);
    }
    $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
    $pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
    if (strpos($pee, '<pre') !== false)
        $pee = preg_replace_callback('!(<pre[^>]*>)(.*?)</pre>!is', 'clean_pre', $pee );
    $pee = preg_replace( "|\n</p>$|", '</p>', $pee );

    return $pee;
  }
}
/**
 * Newline preservation help function for wpautop
 *
 * @since 3.1.0
 * @access private
 * @param array $matches preg_replace_callback matches array
 * @returns string
 */
if ( ! function_exists('_autop_newline_preservation_helper')){
  function _autop_newline_preservation_helper( $matches ) {
    return str_replace("\n", "<WPPreserveNewline />", $matches[0]);
  }
}

if ( ! function_exists('subwords')){
    function subwords($str, $length='150', $minword = 3, $substr = true)
    {
        $sub = '';
        $len = 0;

        foreach (explode(' ', $str) as $word)
        {
            $part = (($sub != '') ? ' ' : '') . $word;
            $sub .= $part;
            $len += strlen($part);

            if (strlen($word) > $minword && strlen($sub) >= $length)
            {
                break;
            }
        }

        //print 'sub : '.$sub;

        $str = $sub . (($len < strlen($str)) ? ' ...' : '');

        if($substr == true){
            return strip_tags( substr($str,0,$length) . (($length < strlen($str)) ? ' ...' : '') );
        }else{
            return strip_tags($str);
        }
    }
}

if ( ! function_exists('format_date')){
  function format_date($date,$format){
    $timestamp = strtotime( $date , time() );
    return date( $format , $timestamp );
  }
}
/* message */
if ( ! function_exists('set_message'))
{
  function set_message($message,$level=1){
    $CI =& get_instance();
    $message = array($level => $message);
    $CI->session->set_flashdata('message', $message);
    return true;
  }
}

if ( ! function_exists('show_message'))
{
    function show_message($class='success', $message=''){
        return '<div class="alert alert-'.$class.' error"><button type="button" class="close">&times;</button> '.$message.'</div>';
    }
}
//
if ( ! function_exists('get_message'))
{
  function get_message($level=1){
    $CI =& get_instance();
    $message = array();
    $message = $CI->session->flashdata('message');

    if( isset( $message[$level]['info'] ) )
    {
        $message_info = $message[$level]['info'];
    }else{
        if( $message[$level]['type'] == 'success' ){
            $message_info = '<strong>Notice :</strong> Process succeeded.';
        }else{
            $message_info = '<strong>Error : </strong> An error has occured.';
        }
    }

    if( $message ){
        $message[$level]['info'] = '<div class="alert alert-'.$message[$level]['type'].'"> <button type="button" class="close">&times;</button> '.$message_info.' </div>';
    }
    # debug($message);
    return $message[$level]['info'];

  }
}

function is_active_menu($obj,$field)
{
    $return = '';
    if(isset($obj->{$field})){
        $return = ' current';
    }

    return $return;

}

function is_active_submenu($obj,$field)
{
    $return = '';
    if(isset($obj->{$field})){
        $return = 'current-sub';
    }

    return $return;

}


function get_random_string($length=7) 
{
    $rndstring = '';
    $template = '';
    $template .= 'abcdefghijklmnopqrstuvwxyz'; 
    $template .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $template .= '1234567890';
    /* this line can include numbers or not */

    for ($a = 0; $a <= $length; $a++) {
           $b = rand(0, strlen($template) - 1);
           $rndstring .= $template[$b];
    }

    return $rndstring; 
}

function strip_userlogin($string)
{
    return strtolower( str_replace(' ', '', $string) );
}

function mkdir_r($dirName, $rights=0755){
    $dirs = explode('/', $dirName);
    $dir='';
    foreach ($dirs as $part) {
        //echo $part;
        $dir.=$part.'/';
        if (!is_dir($dir) && strlen($dir)>0)
            mkdir($dir, $rights);
    }
}

function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}

function aasort(&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    usort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}

function sum_array_by_id($arr, $id=array()) {
    $sum = 0; 
    foreach ($arr as $key=> $row) {
        if (in_array($row['id'], $id)) 
            $sum = $sum+$row['sum_article'];
    }

    return $sum;
}

?>