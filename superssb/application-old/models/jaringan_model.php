<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jaringan_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		// table
		$this->master_model->get_tables($this);
	}
	

	function get_kantor_cabang()
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
		$cols 			= array( "branch_id","","branch_name","branch_address","branch_phone","branch_fax","branch_status" );
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
		$sql = " SELECT count(0) as iTotal FROM {$this->branch_office} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(branch_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(branch_address) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(branch_phone) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(branch_fax) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT * FROM {$this->branch_office} $sql_where ";

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

	function get_kantor_kas()
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
		$cols 			= array( "kas_id","","kas_name","kas_address","kas_phone","kas_fax","kas_status" );
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
		$sql = " SELECT count(0) as iTotal FROM {$this->cash_office} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(kas_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(kas_address) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(kas_phone) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(kas_fax) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT * FROM {$this->cash_office} $sql_where ";

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

	function get_lokasi_atm()
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
		$cols 			= array( "atm_id","","atm_location","atm_address","atm_created","atm_modified","atm_status" );
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
		$sql = " SELECT count(0) as iTotal FROM {$this->atm_location} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(atm_location) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(atm_address) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(atm_created) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(atm_modified) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT * FROM {$this->atm_location} $sql_where ";

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

	function get_payment_point()
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
		$cols 			= array( "pp_id","","pp_location","pp_address","pp_phone","pp_fax","pp_status" );
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
		$sql = " SELECT count(0) as iTotal FROM {$this->payment_point} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(pp_location) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(pp_address) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(pp_phone) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(pp_fax) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT * FROM {$this->payment_point} $sql_where ";

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

	public function insert_new_page($table, $data)
	{
		//$data = $this->master_model->escape_all($data);

		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update_kantor_cabang($data, $ID)
	{
		$ID = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('branch_id', $ID);
		$this->db->update($this->branch_office, $data);
		return $this->db->affected_rows();
	}

	public function update_kantor_kas($data, $ID)
	{
		$ID = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('kas_id', $ID);
		$this->db->update($this->cash_office, $data);
		return $this->db->affected_rows();
	}

	public function update_atm_location($data, $ID)
	{
		$ID = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('atm_id', $ID);
		$this->db->update($this->atm_location, $data);
		return $this->db->affected_rows();
	}

	public function update_payment_point($data, $ID)
	{
		$ID = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('pp_id', $ID);
		$this->db->update($this->payment_point, $data);
		return $this->db->affected_rows();
	}

	public function delete_jaringan($table, $where, $id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete($table, array($where=>$id));
	}

	function get_page_kantor_cabang_byid($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->branch_office);
		$this->db->where('branch_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	function get_kantor_kas_byid($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->cash_office);
		$this->db->where('kas_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	function get_atmlocation_byid($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->atm_location);
		$this->db->where('atm_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	function get_paymentpoint_byid($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->payment_point);
		$this->db->where('pp_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

}
