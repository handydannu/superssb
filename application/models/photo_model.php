<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		// table
		$this->master_model->get_tables($this);
		$this->db = $this->load->database('default', TRUE);

		//error_reporting(E_ALL);
	}

	function get_photo_album($channel, $offset, $count)
	{
		$offset = $this->db->escape_str($offset);
		$count = (empty($count))? '7' : $this->db->escape_str($count);
		$channel = $this->db->escape_str($channel);

		$add_where = (empty($channel))? "" : " AND c.ch_slug='{$channel}' ";
		//$add_where = (empty($channel))? "" : " AND album_channel_id='{$channel}' ";

		$sql = "SELECT count(album_id) as itotal FROM {$this->photo_album} pa LEFT JOIN {$this->channels} c ON (c.ch_id=pa.album_channel_id) WHERE album_status='1' $add_where";
		$get = $this->db->query($sql);
		
		$ret['total_album'] = $get->row_array();

		$get->free_result();

		$sql2 = "SELECT album_id, album_date, album_title, album_slug, album_created_date, album_modified_date, album_status,
				ph_id, ph_title, ph_images_thumbnail, ph_images, ph_caption, ph_credit, ph_photographer, ph_album_id, ph_is_cover, 
				ch_name
				FROM {$this->photo_album} pa
				LEFT JOIN {$this->photos} p ON(p.ph_album_id=pa.album_id)
				LEFT JOIN {$this->channels} c ON (c.ch_id=pa.album_channel_id)
				WHERE album_status='1' AND ph_is_cover='1'
				$add_where
				ORDER BY album_date DESC, album_id DESC 
				LIMIT {$offset},{$count} ";

		$get = $this->db->query($sql2);
		$ret['data'] = $get->result_array();
		$get->free_result();

		// looping utk dptkan album ID
		$loop = count($ret['data']);
		$temp = array();
		for ($i=0; $i < $loop; $i++) { 
			array_push($temp, $ret['data'][$i]['album_id']);
		}

		$albumsID = implode(', ', $temp);

		if(!empty($loop)){
			// hitung total photo dalam tiap-tiap album
			$sql3 = "SELECT count(ph_id) as ph_total, ph_album_id FROM {$this->photos} WHERE ph_status='1' AND ph_album_id IN ($albumsID) GROUP BY ph_album_id";
			$get = $this->db->query($sql3);		
			$ret['total_photo'] = $get->result_array();		
			$get->free_result();
		}
		//echo $this->db->last_query();
		return $ret;
	}

	function get_photo_album_home()
	{
		$sql = "SELECT album_id, album_date, album_title, album_slug, album_created_date, album_modified_date, album_status,
				ph_id, ph_title, ph_images_thumbnail, ph_images, ph_caption, ph_credit, ph_photographer, ph_album_id, ph_is_cover, 
				ch_name
				FROM {$this->photo_album} pa
				LEFT JOIN {$this->photos} p ON(p.ph_album_id=pa.album_id)
				LEFT JOIN {$this->channels} c ON (c.ch_id=pa.album_channel_id)
				WHERE album_status='1' AND ph_is_cover='1'
				$add_where
				ORDER BY album_date DESC, album_id DESC
				LIMIT 0,4 ";

		$get = $this->db->query($sql);
		//echo $this->db->last_query();

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_single_album($albumID)
	{
		$albumID = $this->db->escape_str($albumID);

		$sql = "SELECT ph_id, ph_title, ph_images_thumbnail, ph_images, ph_caption, ph_credit, ph_photographer, ph_album_id, ph_is_cover, 
				album_id, album_date, album_title, album_slug, album_description, album_created_date, album_modified_date, album_status
				FROM {$this->photos} p
				LEFT JOIN {$this->photo_album} pa ON(pa.album_id=p.ph_album_id)
				WHERE ph_album_id='{$albumID}' AND ph_status='1' 
				ORDER BY ph_id ASC
				";

		$get = $this->db->query($sql);
		//echo $this->db->last_query();

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_album_last()
	{
		$albumID = $this->db->escape_str($albumID);

		$sql = "SELECT ph_album_id
				FROM {$this->photos} p
				LEFT JOIN {$this->photo_album} pa ON(pa.album_id=p.ph_album_id)
				ORDER BY ph_id DESC
				";

		$get = $this->db->query($sql);
		//echo $this->db->last_query();

		$ret = $get->row_array();

		$get->free_result();
		return $ret;
	}

	function get_other_photos($excludeID, $offset, $limit)
	{
		// --- foto lainnya ---
		$excludeID = $this->db->escape_str($excludeID);
		$offset    = $this->db->escape_str($offset);
		$limit     = $this->db->escape_str($limit);
		
		$sql2 = "SELECT album_id, album_date, album_title, album_slug, album_created_date, album_modified_date, album_status,
				ph_id, ph_title, ph_images_thumbnail, ph_images, ph_caption, ph_credit, ph_photographer, ph_album_id, ph_is_cover 
				FROM {$this->photo_album} pa
				LEFT JOIN {$this->photos} p ON(p.ph_album_id=pa.album_id)
				WHERE album_status='1' AND ph_is_cover='1' AND album_id != '{$excludeID}'
				ORDER BY album_date DESC, album_id DESC 
				LIMIT {$offset},{$limit} ";

		$get = $this->db->query($sql2);
		$ret['data'] = $get->result_array();
		$get->free_result();

		// looping utk dptkan album ID
		$loop = count($ret['data']);
		$temp = array();
		for ($i=0; $i < $loop; $i++) { 
			array_push($temp, $ret['data'][$i]['album_id']);
		}

		$albumsID = implode(', ', $temp);

		if(!empty($loop)){
			// hitung total photo dalam tiap-tiap album
			$sql3 = "SELECT count(ph_id) as ph_total, ph_album_id FROM {$this->photos} WHERE ph_status='1' AND ph_album_id IN ($albumsID) GROUP BY ph_album_id";
			$get = $this->db->query($sql3);		
			$ret['total_photo'] = $get->result_array();		
			$get->free_result();
		}
		//echo $this->db->last_query();
		return $ret;
	}

	function get_channel_photo($limit)
	{
		$this->db->select('ch_id, ch_name, ch_slug');
		$this->db->from($this->channels);
		$this->db->where('ch_type', '5');
		$this->db->order_by('ch_id', 'DESC');
		if (!empty($limit)) $this->db->limit($limit);
		$sql = $this->db->get();

		$ret = $sql->result_array();
		$sql->free_result();

		return $ret;
	}


}