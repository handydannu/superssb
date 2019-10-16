<?php

if ( ! function_exists('_d')){
    function _d($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}
if ( ! function_exists('_j')){
    function _j($content){
        header('Content-Type: application/json');
        echo json_encode($content);
        exit;
    }
}

function watermarkText($SourceFile, $WaterMarkText, $DestinationFile, $fontFile)
{
   list($width, $height) = getimagesize($SourceFile);
   $image_p = imagecreatetruecolor($width, $height);
   $image = imagecreatefromjpeg($SourceFile);
   imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
   // $black = imagecolorallocate($image_p, 0, 0, 0);
   $fontColor = imagecolorallocate($image_p, 255, 255, 255);
   $font = $fontFile;
   echo $fontFile;
   $font_size = 30;
   // imagettftext($image_p, $font_size, 0, 10, 35, $fontColor, $font, $WaterMarkText);
   imagettftext($image_p, $font_size, 0, $height - 10, $width - 50, $fontColor, $font, $WaterMarkText);
   if ($DestinationFile <> '') {
      imagejpeg($image_p, $DestinationFile, 100);
   } else {
      header('Content-Type: image/jpeg');
      imagejpeg($image_p, null, 100);
   } ;
   imagedestroy($image);
   imagedestroy($image_p);
}

function watermarkImage($SourceFile, $WaterMarkImage, $DestinationFile)
{
   header('Content-Type: image/jpeg');

   $watermark = imagecreatefrompng($WaterMarkImage);
   $watermark_width = imagesx($watermark);
   $watermark_height = imagesy($watermark);
   $image = imagecreatetruecolor($watermark_width, $watermark_height);
   $image = imagecreatefromjpeg($SourceFile);
   $size = getimagesize($SourceFile);
   $dest_x = $size[0] - $watermark_width - 5;
   $dest_y = $size[1] - $watermark_height - 5;
   imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 100);
   imagejpeg($image, $DestinationFile, 100);
   // imagejpeg($image);
   imagedestroy($image);
   imagedestroy($watermark);
}

function createThumbImage($SourceFile, $scale, $DestinationFile)
{
   header('Content-Type: image/jpeg');
   // Get the original geometry and calculate scales
   list($width, $height) = getimagesize($SourceFile);
   $new_width = $width * $scale / 100;
   $new_height = $height * $scale / 100;
   // Resize the original image
   $imageResized = imagecreatetruecolor($new_width, $new_height);
   $imageTmp = imagecreatefromjpeg ($SourceFile);
   imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
   imagejpeg($imageResized, $DestinationFile, 100);
   imagedestroy($imageResized);
}

function randomString($charNum = 7)
{
   $codelenght = $charNum;
   while ($newcode_length < $codelenght) {
      $x = 1;
      $y = 3;
      $part = rand($x, $y);
      if ($part == 1) {
         $a = 48;
         $b = 57;
      } // Numbers
      if ($part == 2) {
         $a = 65;
         $b = 90;
      } // UpperCase
      if ($part == 3) {
         $a = 97;
         $b = 122;
      } // LowerCase
      $code_part = chr(rand($a, $b));
      $newcode_length = $newcode_length + 1;
      $newcode = $newcode . $code_part;
   }
   return $newcode;
}
// Generate Guid
function NewGuid()
{
   $s = strtolower(md5(uniqid(rand(), true)));
   $guidText = substr($s, 0, 8) . '-' . substr($s, 8, 4);
   return $guidText;
}
// End Generate Guid
function getIndonesianDay($int = "1")
{
   switch ($int) {
      case "7":
         $strReturn = "Minggu";
         break;
      case "6":
         $strReturn = "Sabtu";
         break;
      case "5":
         $strReturn = "Jum'at";
         break;
      case "4":
         $strReturn = "Kamis";
         break;
      case "3":
         $strReturn = "Rabu";
         break;
      case "2":
         $strReturn = "Selasa";
         break;
      case "1":
      default:
         $strReturn = "Senin";
         break;
   }
   return $strReturn;
}

function getIndonesianMonth($int = "1")
{
   switch ($int) {
      case "12":
         $strReturn = "Desember";
         break;
      case "11":
         $strReturn = "November";
         break;
      case "10":
         $strReturn = "Oktober";
         break;
      case "9":
         $strReturn = "September";
         break;
      case "8":
         $strReturn = "Agustus";
         break;
      case "7":
         $strReturn = "Juli";
         break;
      case "6":
         $strReturn = "Juni";
         break;
      case "5":
         $strReturn = "Mei";
         break;
      case "4":
         $strReturn = "April";
         break;
      case "3":
         $strReturn = "Maret";
         break;
      case "2":
         $strReturn = "Februari";
         break;
      case "1":
      default:
         $strReturn = "Januari";
         break;
   }
   return $strReturn;
}

function getEnglishMonth($int = "1")
{
   switch ($int) {
      case "12":
         $strReturn = "December";
         break;
      case "11":
         $strReturn = "November";
         break;
      case "10":
         $strReturn = "October";
         break;
      case "9":
         $strReturn = "September";
         break;
      case "8":
         $strReturn = "August";
         break;
      case "7":
         $strReturn = "July";
         break;
      case "6":
         $strReturn = "June";
         break;
      case "5":
         $strReturn = "May";
         break;
      case "4":
         $strReturn = "April";
         break;
      case "3":
         $strReturn = "March";
         break;
      case "2":
         $strReturn = "February";
         break;
      case "1":
      default:
         $strReturn = "January";
         break;
   }
   return $strReturn;
}

function getEnglishShortMonth($int = "1")
{
   switch ($int) {
      case "12":
         $strReturn = "Dec";
         break;
      case "11":
         $strReturn = "Nov";
         break;
      case "10":
         $strReturn = "Oct";
         break;
      case "9":
         $strReturn = "Sep";
         break;
      case "8":
         $strReturn = "Aug";
         break;
      case "7":
         $strReturn = "July";
         break;
      case "6":
         $strReturn = "June";
         break;
      case "5":
         $strReturn = "May";
         break;
      case "4":
         $strReturn = "Apr";
         break;
      case "3":
         $strReturn = "Mar";
         break;
      case "2":
         $strReturn = "Feb";
         break;
      case "1":
      default:
         $strReturn = "Jan";
         break;
   }
   return $strReturn;
}

function ReformatDateIndo2($date) // yyyy-mm-dd
{
   $d = explode('-', $date);
   return $d[2] . ' ' . getIndonesianMonth($d[1]) . ' ' . $d[0];
}

function ReformatDayDateIndo($date) // N-yyyy-mm-dd
{
   $d = explode('-', $date);
   return  getIndonesianDay($d[0]) . ', ' . $d[3] . ' ' . getIndonesianMonth($d[2]) . ' ' . $d[1];
}

function ReformatDate($date) // yyyy-mm-dd
{
   $d = explode('-', $date);
   return $d[2] . ' ' . getEnglishShortMonth($d[1]) . ' ' . $d[0];
}

function ReformatDateTime($date) // yyyy-mm-dd hh:mm:ss
{
   $dt = explode(' ', $date);
   $t = explode(':', $dt[1]);
   $d = explode('-', $dt[0]);
   return $d[2] . ' ' . getEnglishShortMonth($d[1]) . ' ' . $d[0] . '&nbsp;&nbsp;&nbsp;' . $t[0] . ':' . $t[1] . ' WIB';
}

function ReformatDateIndo($date){
   $dt = explode(' ', $date);
   $t = explode(':', $dt[1]);
   $d = explode('-', $dt[0]);
   return $d[2] . ' ' . getIndonesianMonth($d[1]) . ' ' . $d[0];
}

function ReformatTimeIndo($date){
   $dt = explode(' ', $date);
   $t = explode(':', $dt[1]);
   $d = explode('-', $dt[0]);
   return $t[0] . '.' . $t[1];
}


function findFileExtension($filename)
{
   $filename = strtolower($filename);
   $exts = split("[/\\.]", $filename);
   $n = count($exts) - 1;
   $exts = $exts[$n];
   return $exts;
}

function string_limit_words($string, $word_limit)
{
   $words = explode(' ', $string);
   return implode(' ', array_slice($words, 0, $word_limit));
}

function slug($string, $delimiter = '-')
{
   $new_string = strip_tags($string);
   $new_string = strtolower($new_string);
   $new_string = preg_replace("/&(.)(uml);/", "$1e", $new_string);
   $new_string = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml);/", "$1", $new_string);
   $new_string = preg_replace("/([^a-z0-9]+)/", $delimiter, $new_string);
   $new_string = trim($new_string, $delimiter);
   return $new_string;
}

function SaltWord()
{
   $salt = 'B1m4sbuddh4';
   // $salt = 'm1151ndones1a';
   return $salt;
}

function rssParser($source)
{
   // $source = "http://sindikasi.okezone.com/index.php/okezone/RSS2.0";
   $strXml = @file_get_contents($source);
   if ($strXml == false) return false;

   $strXml = utf8_encode($strXml);
   $objRss = simplexml_load_string($strXml);
   $itemCount = (int) count($objRss->channel->item);
   $news[] = "";
   for ($i = 0; $i < $itemCount; $i++) {
      $news[$i]['title'] = (string) $objRss->channel->item[$i]->title;
      $news[$i]['link'] = (string) $objRss->channel->item[$i]->link;
      $news[$i]['guid'] = (string) $objRss->channel->item[$i]->guid;
      $news[$i]['description'] = (string)$objRss->channel->item[$i]->description;
      $longDesc = (string) $objRss->channel->item[$i]->description;

      $desc = str_word_count(strip_tags($longDesc), 1);
      $strTmp = "";
      $end = 50;
      if (count($desc) < $end)
         $end = count($desc);
      for ($j = 0; $j < $end; $j++) {
         $strTmp .= ' ' . $desc[$j];
      }
      $news[$i]['shortDescription'] = $strTmp;

      $news[$i]['category'] = (string) $objRss->channel->item[$i]->category;
      $news[$i]['pubDate'] = (string) $objRss->channel->item[$i]->pubDate;
      // additional
      $tmp = explode(' ', (string) $objRss->channel->item[$i]->pubDate);
      $news[$i]['pubTimeComplete'] = $tmp[4];
      $news[$i]['pubTime'] = substr($news[$i]['pubTimeComplete'], 0, strlen($news[$i]['pubTimeComplete']) - 3);
   }
   return $news;
}

function getKursAndStatistics()
{
   $strXmlKurs = utf8_encode(file_get_contents('http://economy.okezone.com/index.php/out/getKursAll'));
   $strXmlStatistics = utf8_encode(file_get_contents('http://economy.okezone.com/index.php/out/getStatistics'));
   // kurs
   $XMLobj = simplexml_load_string($strXmlKurs);
   $dataKurs = array();

   $dataKurs['totalItem'] = count($XMLobj->kurs->item);
   $dataKurs['update'] = (string)$XMLobj->kurs->item[0]->attributes()->update;
   for($i = 0; $i < $dataKurs['totalItem']; $i++) {
      $dataKurs['matauang'][] = (string)$XMLobj->kurs->item[$i]->attributes()->name;
      $dataKurs['beli'][] = (string)$XMLobj->kurs->item[$i]->beli;
      $dataKurs['jual'][] = (string)$XMLobj->kurs->item[$i]->jual;
   }
   unset($XMLobj);
   // statistics
   $xmlObj = simplexml_load_string($strXmlStatistics);
   $dataStats = array();

   $dataStats['inflasi']['bulan'] = (String)$xmlObj->inflasi->bulan;
   $dataStats['inflasi']['nilai'] = (String)$xmlObj->inflasi->nilai;

   $dataStats['birate']['tanggal'] = (String)$xmlObj->birate->tanggal;
   $dataStats['birate']['nilai'] = (String)$xmlObj->birate->nilai;

   $dataStats['devisa']['tanggal'] = (String)$xmlObj->devisa->tanggal;
   $dataStats['devisa']['nilai'] = (String)$xmlObj->devisa->nilai;

   $dataStats['sbi1']['tanggal'] = (String)$xmlObj->sbi1->tanggal;
   $dataStats['sbi1']['nilai'] = (String)$xmlObj->sbi1->nilai;
   $dataStats['sbi1']['persen'] = (String)$xmlObj->sbi1->persen;

   $dataStats['sbi2']['tanggal'] = (String)$xmlObj->sbi2->tanggal;
   $dataStats['sbi2']['nilai'] = (String)$xmlObj->sbi2->nilai;
   $dataStats['sbi2']['persen'] = (String)$xmlObj->sbi2->persen;
   unset($xmlObj);

   $economyFeed['dataStats'] = $dataStats;
   $economyFeed['dataKurs'] = $dataKurs;
   return $economyFeed;
}

function categoriesTree($data, $parent, $echo = '1')
{
   if (isset($data[$parent])) {
      // $str = '<ul id="categoryTree">';
      foreach($data[$parent] as $value) {
         $child = categoriesTree($data, $value['term_id']);
         $str .= '<li>';
         $str .= $value['term_title'];
         if ($child != '') {
            $str .= '<ul>';
            $str .= $child;
            $str .= '</ul>';
         }
         $str .= '</li>';
      }
      // $str .= '</ul>';
      return $str;
   } else {
      return '';
   }
}

function categoriesCheckBox($data, $parent, $echo = '1')
{
   if (isset($data[$parent])) {
      // $str = '<ul id="categoryTree">';
      foreach($data[$parent] as $value) {
         $child = categoriesCheckBox($data, $value['term_id']);
         $str .= '<li>';
         $str .= '<input type="checkbox" name="categories[]" value="' . $value['term_id'] . '" />' . $value['term_title'];
         if ($child != '') {
            $str .= '<ul>';
            $str .= $child;
            $str .= '</ul>';
         }
         $str .= '</li>';
      }
      // $str .= '</ul>';
      return $str;
   } else {
      return '';
   }
}

function categoriesTreeWithLink($data, $parent, $category, $echo = '1')
{
   if (isset($data[$parent])) {
      // $str = '<ul id="categoryTree">';
      foreach($data[$parent] as $value) {
         $child = categoriesTreeWithLink($data, $value['term_id'], $category);
         $str .= '<li>';
         $str .= $value['term_title'] . '&nbsp;&nbsp;';
         $str .= '<a href=' . base_url() . 'category/edit/' . $value['term_id'] . ' title="Edit"><img src="' . base_url() . 'images/pencil.png" alt="Edit" /></a>';
         $str .= '<a onclick="return confirm(\'Are you sure want to remove this item?\')" href="' . base_url() . 'category/delete/' . $value['term_id'] . '"><img src="' . base_url() . 'images/cross.png" title="Delete" /></a>';
         $str .= '<a href="' . base_url() . 'category/add/' . $category . '/' . $value['term_id'] . '"><img src="' . base_url() . 'images/add_small.png" title="Add Child" /></a>';
         if ($child != '') {
            $str .= '<ul>';
            $str .= $child;
            $str .= '</ul>';
         }
         $str .= '</li>';
      }
      // $str .= '</ul>';
      return $str;
   } else {
      return '';
   }
}

function captureVideoFrame($videoPath, $imageOutput)
{
   // get the duration and a random place within that
   $cmd = "ffmpeg -i " . $videoPath . " 2>&1";
   if (preg_match('/Duration: ((\d+):(\d+):(\d+))/s', `$cmd`, $time)) {
      $total = ($time[2] * 3600) + ($time[3] * 60) + $time[4];
      $second = rand(1, ($total - 1));
   }
   exec($cmd);

   $command = "ffmpeg -i " . $videoPath . " -deinterlace -an -ss $second -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg " . $imageOutput . " 2>&1";
   exec($command, $output);
}

function getVideoDuration($videoPath)
{
   $time = exec("ffmpeg -i " . $videoPath . " 2>&1 | grep \"Duration\" | cut -d ' ' -f 4 | sed s/,//");
   return $time;
}

/* add by: Didit Ahendra (didit.ahendra@gmail.com)
   add date: 30/1/2012
*/
function getDuration($videofile)
{
   $time = exec("ffmpeg -i " . $videofile . " 2>&1 | grep \"Duration\" | cut -d ' ' -f 4 | sed s/,//");
   return $time;
   //this only work on offline (not at client.okezone.com), this suck!
   /*
   ob_start();
   passthru("ffmpeg.exe -i \"" . $videofile . "\" 2>&1");
   $duration = ob_get_contents();
   ob_end_clean();
   preg_match('/Duration: (.*?),/', $duration, $matches);
   $duration = $matches[1];
   return($duration);
   */
}

function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function objToArray($obj, &$arr){

    if(!is_object($obj) && !is_array($obj)){
        $arr = $obj;
        return $arr;
    }

    foreach ($obj as $key => $value)
    {
        if (!empty($value))
        {
            $arr[$key] = array();
            objToArray($value, $arr[$key]);
        }
        else
        {
            $arr[$key] = $value;
        }
    }
    return $arr;
}

?>
