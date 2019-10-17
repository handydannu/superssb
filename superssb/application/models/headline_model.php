<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class headline_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		// table
		$this->master_model->get_tables($this);
	}
	
	function get_all()
	{
		// ---- Get All Quotes show as Json ----
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array( "h_id","","h_title","h_summary","h_url","h_image","h_status" );
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
		$sql = " SELECT count(0) as iTotal FROM headlines  ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(h_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(h_summary) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(h_url) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT * FROM headlines $sql_where ";

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

	public function insert_headline($table, $data)
	{
		//$data = $this->master_model->escape_all($data);

		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function get_headline_byid($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from('headlines');
		$this->db->where('h_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	public function update_headline($data, $ID)
	{
		$ID = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('h_id', $ID);
		$this->db->update('headlines', $data);
		return $this->db->affected_rows();
	}

	public function delete_headline($id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete('headlines', array('h_id'=>$id));
	}
}
