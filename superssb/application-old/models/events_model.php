<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		// table
		$this->master_model->get_tables($this);
	}
	

	function get_events()
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
		$cols 			= array( "ev_id" );
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
		$sql = " SELECT count(0) as iTotal FROM {$this->events} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(ev_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ev_summary) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ev_startdate) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ev_enddate) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ev_starttime) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ev_endtime) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT * FROM {$this->events} $sql_where ";

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

	public function insert_new_event($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->events, $data);
		return $this->db->insert_id();
	}

	public function update_event($data, $ID)
	{
		$ID = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('ev_id', $ID);
		$this->db->update($this->events, $data);
		return $this->db->affected_rows();
	}

	public function delete_event($id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete($this->events, array('ev_id'=>$id));
	}

	function get_event_byid($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->events);
		$this->db->where('ev_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

}
