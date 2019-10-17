<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emagz_model extends CI_Model
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
	

	function get_emagz_datatable()
	{
		// ---- Get All Quotes show as Json ----
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 20;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array( "em_id", "em_page" );
		$sort 			=  "desc";
		
		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		// limit
		$start    = $this->datatables_model->get_start();
		$rows     = $this->datatables_model->get_rows($rows);
		// sort
		$sort     = $this->datatables_model->get_sort($cols);
		$sort_dir = $this->datatables_model->get_sort_dir();
		        
        // Running Query Total Row
		$sql = " SELECT count(0) as iTotal FROM {$this->emagz} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(ea_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(ea_summary) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(ea_edition) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(em_page) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT ea_id, ea_date, ea_edition, ea_title, ea_created_date, ea_modified_date, ea_status,
				em_id, em_title, em_images_thumbnail, em_album_id, em_is_cover, em_page, em_status
				FROM {$this->emagz_album} album
				LEFT JOIN {$this->emagz} E ON(album.ea_id=E.em_album_id)
				$sql_where ";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query = $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data  = $query->result();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}
		
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

	// ============== EMAGZ ALBUM =====================
	public function insert_album($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->emagz_album, $data);
		return $this->db->insert_id();
	}

	public function update_album($data, $ID)
	{
		$ID   = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('ea_id', $ID);
		$this->db->update($this->emagz_album, $data);
		return $this->db->affected_rows();
	}

	function get_album_by($ID)
	{
		$ID = $this->db->escape_str($ID);

		$this->db->select('*');
		$this->db->from($this->emagz_album);
		$this->db->where('ea_id', $ID);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	// ============== EMAGZ =====================
	public function insert_emagz($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->emagz, $data);
		return $this->db->insert_id();
	}

	public function update_emagz($data, $ID)
	{
		$ID   = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('em_id', $ID);
		$this->db->update($this->emagz, $data);
		return $this->db->affected_rows();
	}

	function get_emagz_by($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->emagz.' E');
		$this->db->join($this->emagz_album. ' album', 'E.em_album_id=album.ea_id', 'left');
		$this->db->where('em_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	function count_emagz_one_album($albumID)
	{
		$this->db->select('count(em_id) as itotal, MAX(em_page) as last_page');
		$this->db->from($this->emagz);
		$this->db->where('em_album_id', $albumID);
		$query = $this->db->get();
		$ret = $query->row_array();

		$query->free_result();
		return $ret;
	}

	public function delete_emagz($id, $albumID)
	{
		// ------ Delete data di tabel emagz dan emagz_album ---------
		
		$id      = $this->db->escape_str($id);
		$albumID = $this->db->escape_str($albumID);

		// get total emagz in an album
		$total = $this->count_emagz_one_album($albumID);

		/*print_r($total);
		exit();*/

		// Delete data di table emagz
		$this->db->where('em_id', $id);
		$this->db->delete($this->emagz);
		$ret = $this->db->affected_rows();

		// Delete Album
		if($ret && ($total['itotal'] ==1) )
		{
			$this->db->where('ea_id', $albumID);
			$this->db->delete($this->emagz_album);
		}

		return $ret;
	}

}
