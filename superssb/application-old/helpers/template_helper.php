<?php

function create_img_thumbnail($fullpath)
{
	// ------ Create Thumbnail -------
	$CI =& get_instance();
	$CI->load->library('image_lib');
	$CI->image_lib->clear();

	// create image thumbnail
	list($width, $height, $type, $attr) = getimagesize($fullpath);
	
	// landscape
	$config['image_library']  = 'gd2';
	$config['source_image']   = $fullpath;
	$config['create_thumb']   = true;
	$config['maintain_ratio'] = true;        

    /*if ($width >= $height) {
		$res_width  = 160;
		$res_height = 160;
    } else {
		$res_width  = 0.25*$width;
		$res_height = 0.25*$height;
    }*/

    // we set fix image width & height
	$config['width']  = 260;
	$config['height'] = 171;
	$CI->image_lib->initialize($config);
    
    if (!$CI->image_lib->resize()) {
        echo $CI->image_lib->display_errors();
    }
}

function create_str_thumbnail($fullpath)
{
	// ------ Create Thumbnail -------
	$CI =& get_instance();
	$CI->load->library('image_lib');
	$CI->image_lib->clear();

	// create image thumbnail
	list($width, $height, $type, $attr) = getimagesize($fullpath);
	
	// landscape
	$config['image_library']  = 'gd2';
	$config['source_image']   = $fullpath;
	$config['create_thumb']   = true;
	$config['maintain_ratio'] = true;        

    /*if ($width >= $height) {
		$res_width  = 160;
		$res_height = 160;
    } else {
		$res_width  = 0.25*$width;
		$res_height = 0.25*$height;
    }*/

    // we set fix image width & height
	$config['width']  = 487;
	$config['height'] = 292;
	$CI->image_lib->initialize($config);
    
    if (!$CI->image_lib->resize()) {
        echo $CI->image_lib->display_errors();
    }
}

function create_product_thumb($fullpath)
{
	// ------ Create Thumbnail -------
	$CI =& get_instance();
	$CI->load->library('image_lib');
	$CI->image_lib->clear();

	// create image thumbnail
	list($width, $height, $type, $attr) = getimagesize($fullpath);
	
	// landscape
	$config['image_library']  = 'gd2';
	$config['source_image']   = $fullpath;
	$config['create_thumb']   = true;
	$config['maintain_ratio'] = true;        

    /*if ($width >= $height) {
		$res_width  = 160;
		$res_height = 160;
    } else {
		$res_width  = 0.25*$width;
		$res_height = 0.25*$height;
    }*/

    // we set fix image width & height
	$config['width']  = 146;
	$config['height'] = 167;
	$CI->image_lib->initialize($config);
    
    if (!$CI->image_lib->resize()) {
        echo $CI->image_lib->display_errors();
    }
}

function option_dropdown($name,$data = array(), $selected)
{
	$v_option = '<select name="'.$name.'" class="form-control">';
	foreach ($data as $id => $value) {
		if ($id==$selected) $select = "selected"; else $select = "";
		$v_option .= '<option value="'.$id.'" '.$select.'>'.$value.'</option>';
	}
    $v_option .= '</select>';

    return $v_option;
}

function option_dropdown2($name,$data = array(), $selected)
{
	$v_option = '<select name="'.$name.'" id="'.$name.'" style="width:376px" class="populate placeholder">';
	foreach ($data as $id => $value) {
		if ($id==$selected) { $select = "selected";} else $select = "";
		$v_option .= '<option value="'.$id.'" '.$select.'>'.$value.'</option>';
	}
    $v_option .= '</select>';

    return $v_option;
}

function option_dropdown_group($name,$data = array(), $selected)
{
	$v_option = '<select name="'.$name.'" id="'.$name.'" style="width:330px" class="populate placeholder">';
	foreach ($data as $id => $parent) {
		if (isset($parent['child']) && count($parent['child']) > 0) {
			$v_option .= '<optgroup label="'.$parent['name'].'">';
			foreach ($parent['child'] as $id_child => $child) {
				if ($child['id']==$selected) { $select = "selected";} else $select = "";
				$v_option .= '<option value="'.$child['id'].'" '.$select.'>'.$child['name'].'</option>';
			}
			$v_option .= '</optgroup>';	
		} else {
			if ($parent['id']==$selected) { $select = "selected";} else $select = "";
			$v_option .= '<option value="'.$parent['id'].'" '.$select.'>'.$parent['name'].'</option>';
		}
		// echo $parent['name'].'<br />';
		// echo count($parent['child']).'<br />';
		// foreach ($parent['child'] as $id_child => $child) {
		// 	echo '----'.$child['name'].'<br />';
		// }
	}
    $v_option .= '</select>';

	return $v_option;
}

function croppingImagetoThumb($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale)
{
    list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    $imageType = image_type_to_mime_type($imageType);

    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
    switch ($imageType) {
        case "image/gif":
            $source = imagecreatefromgif($image);
            break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
            $source = imagecreatefromjpeg($image);
            break;
        case "image/png":
        case "image/x-png":
            $source = imagecreatefrompng($image);
            break;
    }
    imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
    switch ($imageType) {
        case "image/gif":
            imagegif($newImage, $thumb_image_name);
            break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
            imagejpeg($newImage, $thumb_image_name, 90);
            break;
        case "image/png":
        case "image/x-png":
            imagepng($newImage, $thumb_image_name);
            break;
    }
    chmod($thumb_image_name, 0777);
    return $thumb_image_name;
}