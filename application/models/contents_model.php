<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contents_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		// table
		$this->master_model->get_tables($this);
		$this->db = $this->load->database('default', TRUE);

		error_reporting(E_ALL);
	}

	function get_headlines($count, $type='')
	{
		// Feature ID:
		// 1.Headline
		// 2.Editor Choice

		$type  = $this->db->escape_str($type);
		$count = $this->db->escape_str($count);

		$sql = "SELECT c_id, c_subtitle, c_title, c_slug, c_summary, c_images_headline, c_created_date 
				FROM {$this->contents} 
				WHERE c_status='publish' AND c_feature='1' 
				ORDER BY c_publish_date DESC 
				LIMIT {$count} ";

		/*$sql = "SELECT c_id, c_subtitle, c_title, c_slug, c_summary, c_images_headline, c_created_date 
				FROM {$this->contents} 
				WHERE c_status='publish' AND c_feature='1' AND (c_content_type='text')
				ORDER BY c_publish_date DESC 
				LIMIT {$count} ";*/

		$get = $this->db->query($sql);
		//echo $this->db->last_query();

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_list_breaking($channelID, $offset, $limit)
	{
		// ---- latest news based on c_channel_id ------
		$channelID = $this->db->escape_str($channelID);
		$offset    = $this->db->escape_str($offset);
		$limit     = $this->db->escape_str($limit);

		$sql = "SELECT c_id, c_publish_date, c_subtitle, c_title, c_slug, c_summary, c_images_content, c_images_thumbnail, c_author_name, c_hits, c_created_date, c_content_type,
				ch_name, ch_slug
				FROM {$this->contents} c
				LEFT JOIN {$this->channels} ch ON(ch.ch_id=c.c_channel_id)
				WHERE c_status='publish' AND c_channel_id='{$channelID}' AND c_type='2'
				ORDER BY c_publish_date DESC 
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_list_breaking_parent($channelID, $count)
	{
		// ---- latest news based on c_type ------
		$channelID = $this->db->escape_str($channelID);
		$count     = $this->db->escape_str($count);

		$sql = "SELECT c_id, c_subtitle, c_title, c_slug, c_summary, c_images_content, c_images_thumbnail, c_author_name, c_hits, c_created_date,
				ch_name, ch_slug
				FROM {$this->contents} c
				LEFT JOIN {$this->channels} ch ON(ch.ch_id=c.c_channel_id)
				WHERE c_status='publish' AND c_type='{$channelID}' AND (c_content_type='text')
				ORDER BY c_publish_date DESC 
				LIMIT {$count} ";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}	

	function get_breaking_parent_paging($channelID, $offset, $limit)
	{
		$channelID = $this->db->escape_str($channelID);
		$offset    = $this->db->escape_str($offset);
		$limit     = $this->db->escape_str($limit);

		$sql = "SELECT c_id, c_publish_date, c_subtitle, c_title, c_slug, c_summary, c_images_content, c_images_thumbnail, c_author_name, c_created_date, c_content_type,
				ch_slug, ch_name, nama 
				FROM {$this->contents} c 
				LEFT JOIN {$this->channels} ch ON(ch.ch_id=c.c_channel_id)
				LEFT JOIN {$this->user} u ON(u.uid=c.c_author)
				WHERE c_status='publish' AND c_type='{$channelID}' 
				ORDER BY c_publish_date DESC 
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);
		$ret = $get->result_array();
		$get->free_result();
		return $ret;
	}

	/*function get_list_breaking_paging($channelID, $offset, $limit)
	{
		$channelID = $this->db->escape_str($channelID);
		$offset    = $this->db->escape_str($offset);
		$limit     = $this->db->escape_str($limit);

		$sql = "SELECT c_id, c_publish_date, c_subtitle, c_title, c_slug, c_summary, c_images_content, c_images_thumbnail, c_author_name, c_created_date, c_content_type,
				ch_name, nama 
				FROM {$this->contents} c 
				LEFT JOIN {$this->channels} ch ON(ch.ch_id=c.c_channel_id)
				LEFT JOIN {$this->user} u ON(u.uid=c.c_author)
				WHERE c_status='publish' AND c_channel_id='{$channelID}'
				ORDER BY c_publish_date DESC 
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);
		$ret = $get->result_array();
		$get->free_result();
		return $ret;
	}*/

	function get_list_breaking_all($count)
	{
		$count = $this->db->escape_str($count);
		
		$sql = "SELECT c_id, c_publish_date, c_subtitle, c_title, c_slug, c_summary, c_images_content, c_images_thumbnail, c_author_name, c_hits, c_created_date, c_content_type, 
				CH.ch_id, CH.ch_name
				FROM {$this->contents} C
				LEFT JOIN {$this->channels} CH ON(CH.ch_id=C.c_channel_id)
				WHERE c_status='publish'
				ORDER BY c_publish_date DESC 
				LIMIT {$count} ";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_total_breaking_by_channel($id)
	{
		$id = $this->db->escape_str($id);

		$sql = "SELECT count(c_id) AS itotal 
				FROM {$this->contents} 
				WHERE c_status='publish' AND c_channel_id='{$id}'
				";

		$get = $this->db->query($sql);
		$ret = $get->row_array();
		
		$get->free_result();
		return $ret;
	}

	function get_total_breaking_by_parent($id)
	{
		$id = $this->db->escape_str($id);

		$sql = "SELECT count(c_id) AS itotal 
				FROM {$this->contents} 
				WHERE c_status='publish' AND c_type='{$id}'
				";

		$get = $this->db->query($sql);
		$ret = $get->row_array();
		
		$get->free_result();
		return $ret;
	}

	function get_video_breaking($channelID, $offset, $limit)
	{
		$channelID = $this->db->escape_str($channelID);
		$offset    = $this->db->escape_str($offset);
		$limit     = $this->db->escape_str($limit);
		$add_where = '';

		if (!empty($channelID))
		{
			$add_where = " AND c_channel_id='{$channelID}'";
		}

		$sql = "SELECT c_id, c_publish_date, c_subtitle, c_title, c_slug, c_summary, c_images_content, c_images_thumbnail, c_author_name, c_hits, c_created_date, c_content_type,
				ch_name, ch_slug, c_youtube_id
				FROM {$this->contents} c
				LEFT JOIN {$this->channels} ch ON(ch.ch_id=c.c_channel_id)
				WHERE c_status='publish' AND c_content_type = 'video' 
				ORDER BY c_publish_date DESC 
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_single_video($id)
	{
		$channelID = $this->db->escape_str($channelID);
		$offset    = $this->db->escape_str($offset);
		$limit     = $this->db->escape_str($limit);
		$add_where = '';

		$sql = "SELECT c_id, c_publish_date, c_subtitle, c_title, c_slug, c_summary, c_images_content, c_images_thumbnail, c_author_name, c_hits, c_created_date, c_content_type,
				ch_name, ch_slug, c_youtube_id, c_youtube_url
				FROM {$this->contents} c
				LEFT JOIN {$this->channels} ch ON(ch.ch_id=c.c_channel_id)
				WHERE c_status='publish' AND c_content_type = 'video' AND c_id='$id'
				ORDER BY c_publish_date DESC";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_total_video($channelID)
	{
		$channelID = $this->db->escape_str($channelID);
		$add_where = '';

		if (!empty($channelID))
		{
			$add_where = " AND c_channel_id='{$channelID}'";
		}		

		$sql = "SELECT count(c_id) AS itotal 
				FROM {$this->contents} c
				LEFT JOIN {$this->channels} ch ON(ch.ch_id=c.c_channel_id)
				WHERE c_status='publish' AND c_content_type = 'video' 
				{$add_where} ";

		$get = $this->db->query($sql);

		$ret = $get->row_array();

		$get->free_result();
		return $ret;
	}

	/*function get_video_breaking($channelID, $count='')
	{
		$channelID = $this->db->escape_str($channelID);
		$count     = $this->db->escape_str($count);
		$add_where = '';

		if (!empty($channelID))
		{
			$add_where = " AND c_channel_id='{$channelID}'";
		}		

		$sql = "SELECT c_id, c_subtitle, c_title, c_slug, c_summary, c_images_content, c_images_thumbnail, c_author_name, c_hits, c_created_date, c_youtube_id, 
				ch_name, ch_slug
				FROM {$this->contents} c
				LEFT JOIN {$this->channels} ch ON(ch.ch_id=c.c_channel_id)
				WHERE c_status='publish' AND c_content_type = 'video' 
				{$add_where}
				ORDER BY c_publish_date DESC 
				LIMIT {$count} ";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}*/

	// ----- QUOTES ------
	function get_quote()
	{
		$sql = "SELECT * FROM {$this->quotes} 
				WHERE q_status='1' 
				ORDER BY q_id DESC 
				LIMIT 1 ";

		$get = $this->db->query($sql);
		$ret = $get->row_array();

		$get->free_result();
		return $ret;
	}

	// ----- SEARCHING -------	
	function search_content($string, $offset, $limit){
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);

		if (!empty($string)){
			$string = strtoupper($this->db->escape_str($string));

			$sql = "SELECT * FROM {$this->pages} p LEFT OUTER JOIN {$this->contents} c ON (0) LEFT OUTER JOIN {$this->photo_album} pa ON (0) LEFT OUTER JOIN {$this->photos} photo ON(photo.ph_album_id=pa.album_id) WHERE (UCASE(p_title) like '%{$string}%') OR (UCASE(c_title) like '%{$string}%') OR (UCASE(album_title) like '%{$string}%') ";
			$sql .= " UNION ";
			$sql .= "SELECT * FROM {$this->pages} p RIGHT OUTER JOIN {$this->contents} c ON (0) LEFT OUTER JOIN {$this->photo_album} pa ON (0) LEFT OUTER JOIN {$this->photos} photo ON(photo.ph_album_id=pa.album_id) WHERE (UCASE(p_title) like '%{$string}%') OR (UCASE(c_title) like '%{$string}%') OR (UCASE(album_title) like '%{$string}%') ";
			$sql .= " UNION ";
			$sql .= "SELECT * FROM {$this->pages} p LEFT OUTER JOIN {$this->contents} c ON (0) RIGHT OUTER JOIN {$this->photo_album} pa ON (0) RIGHT OUTER JOIN {$this->photos} photo ON(photo.ph_album_id=pa.album_id) WHERE (UCASE(p_title) like '%{$string}%') OR (UCASE(c_title) like '%{$string}%') OR (UCASE(album_title) like '%{$string}%') ";
			$sql .= " UNION ";
			$sql .= "SELECT * FROM {$this->pages} p RIGHT OUTER JOIN {$this->contents} c ON (0) RIGHT OUTER JOIN {$this->photo_album} pa ON (0) RIGHT OUTER JOIN {$this->photos} photo ON(photo.ph_album_id=pa.album_id) WHERE (UCASE(p_title) like '%{$string}%') OR (UCASE(c_title) like '%{$string}%') OR (UCASE(album_title) like '%{$string}%') ";


			// Total Data
			$query           = $this->db->query($sql);
			$ret['totalrow'] = $query->num_rows();
			$query->free_result();

			// Save Query
			$query       = $this->db->query($sql . " ORDER BY p_id DESC, c_publish_date DESC LIMIT $offset, $limit ");
			$ret['data'] = $query->result_array();
			$query->free_result();

			return $ret;
		}else{
			return FALSE;
		}
		
	}
	/*function search_content($string, $offset, $limit){
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);

		if (!empty($string)){
			$string = strtoupper($this->db->escape_str($string));

			$sql = "SELECT * FROM {$this->pages} p LEFT OUTER JOIN {$this->contents} c ON (0) LEFT OUTER JOIN {$this->photo_album} pa ON (0) WHERE (UCASE(p_title) like '%{$string}%') OR (UCASE(c_title) like '%{$string}%') OR (UCASE(album_title) like '%{$string}%') ";
			$sql .= " UNION ALL ";
			$sql .= "SELECT * FROM {$this->pages} p RIGHT OUTER JOIN {$this->contents} c ON (0) RIGHT OUTER JOIN {$this->photo_album} pa ON (0) WHERE (UCASE(p_title) like '%{$string}%') OR (UCASE(c_title) like '%{$string}%') OR (UCASE(album_title) like '%{$string}%') ";

			// Total Data
			$query           = $this->db->query($sql);
			$ret['totalrow'] = $query->num_rows();
			$query->free_result();

			// Save Query
			$query       = $this->db->query($sql . " ORDER BY p_id DESC, c_publish_date DESC LIMIT $offset, $limit ");
			$ret['data'] = $query->result_array();
			$query->free_result();

			return $ret;
		}else{
			return FALSE;
		}
		
	}*/
	/*function search_content($string, $offset, $limit){
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);

		if (!empty($string)){
			$string = strtoupper($this->db->escape_str($string));

			$sql = "SELECT c_id, c_publish_date, c_subtitle, c_title, c_slug, c_summary, c_images_content, c_images_thumbnail, c_author_name, c_created_date, c_content_type,
					ch_slug, ch_name, nama 
					FROM {$this->contents} c 
					LEFT JOIN {$this->channels} ch ON(ch.ch_id=c.c_channel_id)
					LEFT JOIN {$this->user} u ON(u.uid=c.c_author)
					WHERE UCASE(c_title) like '%{$string}%' AND c_status='publish' ORDER BY c_publish_date DESC LIMIT $offset, $limit ";

			$query = $this->db->query($sql);
			$ret['data']  = $query->result_array();

			$query->free_result();

			$sqltotal = "SELECT count(c_id) as iTotal FROM {$this->contents} WHERE UCASE(c_title) like '%{$string}%' AND c_status='publish' ";
			$query = $this->db->query($sqltotal);
			$ret['totalrow'] = $query->row_array();

			$query->free_result();
			return $ret;
		}else{
			return FALSE;
		}
		
	}*/

	function get_single_content($ID)
	{
		$ID = $this->db->escape_str($ID);

		$this->db->select('c_id, c_publish_date, c_subtitle, c_title, c_summary, c_content, c_images_content, c_images_caption, c_keyword, c_type, c_source, c_author_name, c_hits, c_created_date, c_content_type, c_youtube_url, c_youtube_id, 
			CH.ch_id, CH.ch_name, CH.ch_slug, T.tp_name,
			A.nama as authorName, E.nama as editorName');
		$this->db->from($this->contents.' C');
		$this->db->join($this->user.' A', 'C.c_author=A.uid', 'left');
		$this->db->join($this->user.' E', 'C.c_editor=E.uid', 'left');
		$this->db->join($this->channels.' CH', 'C.c_channel_id=CH.ch_id', 'left');
		$this->db->join($this->types.' T', 'T.tp_id=CH.ch_type', 'left');
		$this->db->where('c_id', $ID);
		$this->db->where('c_status', 'publish');
		$query = $this->db->get();

		return $query->row_array();
	}

	function get_others_article($id, $count)
	{
		$id    = $this->db->escape_str($id);
		$count = $this->db->escape_str($count);
		
		$sql = "SELECT c_id, c_publish_date, c_subtitle, c_title, c_slug, c_created_date
				FROM {$this->contents}
				WHERE c_status='publish' AND c_id!='{$id}'
				ORDER BY c_publish_date DESC 
				LIMIT {$count} ";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_emagz($count)
	{
		// select from album join emagz where is cover and status aktif //

		$count = $this->db->escape_str($count);

		$sql = "SELECT ea_id, ea_date, ea_edition, ea_title, ea_slug, ea_summary, ea_created_date, em_images_thumbnail FROM {$this->emagz_album} album
				LEFT JOIN {$this->emagz} e ON(e.em_album_id=album.ea_id) 
				WHERE em_status='1' AND em_is_cover='1'
				ORDER BY ea_edition*1 DESC 
				LIMIT {$count} ";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_product($count)
	{
		$count = $this->db->escape_str($count);

		$sql = "SELECT product_id, product_title, product_slug, product_summary, product_images_thumbnail, product_created_date FROM {$this->product}
				WHERE product_status='1' 
				ORDER BY product_id DESC 
				LIMIT {$count} ";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_docs($count)
	{
		$count = $this->db->escape_str($count);

		$sql = "SELECT doc_id, doc_title, doc_created_date, doc_file FROM {$this->doc}
				ORDER BY doc_id DESC 
				LIMIT {$count} ";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	public function insert_contact($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert('contact', $data);
		return $this->db->affected_rows();
	}

	public function insert_testimoni($table, $data)
	{
		// $data = $this->master_model->escape_all($data);

		// $this->db->insert('testimoni', $data);
		// return $this->db->affected_rows();

		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	function get_highlight()
	{
		$this->db->select('*');
		$this->db->from($this->highlight);
		$this->db->order_by('hi_id', 'desc');
		$sql = $this->db->get();
		$ret = $sql->result_array();

		$sql->free_result();
		return $ret;

	}

	function get_list_testimoni($offset, $limit)
	{
		$offset    = $this->db->escape_str($offset);
		$limit     = $this->db->escape_str($limit);

		$sql = "SELECT *
				FROM {$this->testimoni} t
				WHERE testimoni_status = '1'
				ORDER BY testimoni_id DESC 
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_total_testimoni()
	{
		$this->db->where('testimoni_status', '1');
		$this->db->from($this->testimoni);
		return $this->db->count_all_results();
	}

	// --------- AGENDA -----------

	function get_events()
	{
		$sql = "SELECT *
				FROM {$this->events} 
				WHERE ev_status = '1'
				ORDER BY ev_id DESC";

		$get = $this->db->query($sql);

		$ret = $get->result_array();

		$get->free_result();
		return $ret;
	}

	function get_detail_event($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->events);
		$this->db->where('ev_id', $id);
		$sql = $this->db->get();

		$ret = $sql->row_array();

		$sql->free_result();
		return $ret;
	}

	function thumb_gambar($path=null,$name)
	{
		$con['image_library'] = 'gd2';
		$con['source_image'] = 'http://newbigcms.bisnisdev.com/uploads/'.$path.''.$name;
		$con['new_image'] = 'http://newbigcms.bisnisdev.com/uploads/'.$path.'thumb/';
		$con['create_thumb'] = TRUE;
		$con['thumb_marker'] = '';
		$con['maintain_ratio'] = TRUE;
		$con['width'] = 75;
		$con['height'] = 50;

		$this->load->library('image_lib', $con);
		$this->image_lib->initialize($con);
		$this->image_lib->resize();
		return true;
	}


	function unggah_gambar($name=null,$rename=null,$thumb=false,$id)
	{
		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$config['upload_path'] = '/mainData/data-banksulselbar/images/testimoni/'.$id.'/';
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['max_size'] = '2200';

		if($rename!=null) {
			$config['file_name'] = $rename;
		}
		if(!is_dir($config['upload_path'])) mkdir_r($config['upload_path']);
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if(!$this->upload->do_upload($name)) {
			return false;
		} else {		
			if($thumb===true) {
				$this->thumb_gambar($path,$rename);
			}
			return true;
		}
	}

}