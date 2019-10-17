<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Highlight_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		// table
		$this->master_model->get_tables($this);
	}
	

	function get_hg_datatables()
	{
		// ---- Get All Pages show as Json ----
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array( "hi_id", "", "hi_title", "hi_modified" );
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

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(hi_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);

		// Running Query Total Row
		$sql = " SELECT count(0) as iTotal FROM {$this->highlight}";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Query grab data
		$sql = "SELECT hi_id, hi_title, DATE_FORMAT(hi_modified, '%d %M %Y %H:%i') as last_update FROM {$this->highlight} $sql_where ";

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

	public function insert_new($data)
	{
		$this->db->insert($this->highlight, $data);
		return $this->db->insert_id();
	}

	public function update_($data, $ID)
	{
		$ID = $this->db->escape_str($ID);

		$this->db->where('hi_id', $ID);
		$this->db->update($this->highlight, $data);
		return $this->db->affected_rows();
	}

	public function delete_($id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete($this->highlight, array('hi_id'=>$id));
	}

	function get_data_byid($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->highlight);
		$this->db->where('hi_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

}
