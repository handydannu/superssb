<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		// table
		$this->master_model->get_tables($this);

		//error_reporting(E_ALL);
	}

	function get_photos()
	{
		// Select all data where type=1 (1=article) and status not trash

		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 20;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array( "album_date", "ph_album_id", "ph_id" );
		$sort 			= "desc";
		
		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		// limit
		$start    = $this->datatables_model->get_start();
		$rows     = $this->datatables_model->get_rows();
		// sort
		$sort     = $this->datatables_model->get_sort($cols);
		$sort_dir = $this->datatables_model->get_sort_dir();
		        
        // Running Query Total Row
		$sql = " SELECT count(0) as iTotal FROM {$this->photos} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(ph_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(album_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ph_images) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ph_caption) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ph_credit) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ph_photographer) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT ph_id, ph_title, ph_images_thumbnail, ph_caption, ph_credit, ph_photographer, ph_album_id, ph_is_cover, ph_status,
			album_id, album_date, album_title, album_slug, album_created_date, album_status, DATE_FORMAT(album_date, '%d %M %Y') as showdate
			FROM {$this->photos} p
			LEFT JOIN {$this->photo_album} pa ON (pa.album_id=p.ph_album_id)
			$sql_where 
		";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query = $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data  = $query->result();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}

		// echo $this->db->last_query();
		
        // * Output         
        $output = array(
             "sEcho" => $this->datatables_model->get_echo(),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => $data
        );

        $query->free_result();

		return json_encode($output);
	}

	public function insert_album($data)
	{
		$data = $this->master_model->escape_all($data);
		$this->db->insert($this->photo_album, $data);
		return $this->db->insert_id();
	}

	public function insert_photo($data)
	{
		$data = $this->master_model->escape_all($data);
		$this->db->insert($this->photos, $data);
		return $this->db->insert_id();
	}

	public function update_album($data, $id)
	{
		$id   = $this->db->escape_str($id);
		$data = $this->master_model->escape_all($data);

		$this->db->where('album_id', $id);
		$this->db->update($this->photo_album,$data);
		return $this->db->affected_rows();
	}

	public function update_photo($data, $id)
	{
		$id   = $this->db->escape_str($id);
		$data = $this->master_model->escape_all($data);
		
		$this->db->where('ph_id', $id);
		$this->db->update($this->photos,$data);
		return $this->db->affected_rows();
	}

	function get_single_photo($id)
	{
		$id = $this->db->escape_str($id);
		
		$sql = "SELECT * FROM {$this->photos} p 
				LEFT JOIN {$this->photo_album} pa ON (pa.album_id=p.ph_album_id)
				WHERE ph_id='{$id}' ";

		$result = $this->db->query($sql);
		return $result->row_array();
	}

	public function delete_photo($id, $albumID)
	{
		// ------ Delete data di tabel photos dan photo_album ---------
		
		$id      = $this->db->escape_str($id);
		$albumID = $this->db->escape_str($albumID);

		// get total photo in an album
		$this->db->select('count(ph_id) as photo');
		$this->db->from($this->photos);
		$this->db->where('ph_album_id', $albumID);
		$query = $this->db->get();

		$total = $query->row_array();

		$query->free_result();

		// Delete photo di table Photos
		$this->db->where('ph_id', $id);
		$this->db->delete($this->photos);
		$ret = $this->db->affected_rows();

		// Delete Album
		if($ret && $total['photo'] ==1)
		{
			$this->db->where('album_id', $albumID);
			$this->db->delete($this->photo_album);
		}

		return $ret;
	}

	public function publish($albumid)
	{
		$this->db->set('album_status', '1');
		$this->db->where('album_id', $albumid);
		$sql = $this->db->update($this->photo_album);

		//echo $this->db->last_query();

		//$sql->free_result();

		$this->db->set('ph_status', '1');
		$this->db->where('ph_album_id', $albumid);
		$sql = $this->db->update($this->photos);

		
		//$sql->free_result();
	}

	function get_channel_photo()
	{
		$this->db->select('*');
		$this->db->from($this->channels);
		$this->db->where('ch_type', $this->config->item('photo'));
		$this->db->order_by('ch_id', 'ASC');
		$sql = $this->db->get();

		$ret = $sql->result_array();
		$sql->free_result();

		return $ret;
	}
}