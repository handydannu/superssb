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
		$cols 			= array( "branch_id","branch_name","branch_address","branch_phone","branch_fax" );
		$sort 			= "asc";
		
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
		$sql = " SELECT count(0) as iTotal FROM branch_office where branch_status='0' ";

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
		$sql_where = " where branch_status='0' ";

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where)."and branch_status = '0'";	

		$sql = " SELECT * FROM branch_office $sql_where ";
		$order = " ORDER BY branch_created DESC";

		// if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
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
		$cols 			= array( "kas_id","kas_name","kas_address","kas_phone","kas_fax" );
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

		$sql_where = " where kas_status='0' ";

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where)."and kas_status = '0'";		

		$sql = "SELECT * FROM {$this->cash_office} $sql_where ";
		$order = " ORDER BY kas_created DESC ";
		
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
				)
			";
		}

		$sql_where = " where atm_status='0' ";

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where)."and atm_status = '0'";		

		$sql = "SELECT * FROM {$this->atm_location} $sql_where ";
		$order = " ORDER BY atm_created DESC ";
		
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

		$sql_where = " where pp_status='0' ";

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where)."and pp_status = '0'";		

		$sql = "SELECT * FROM {$this->payment_point} $sql_where ";
		$order = " ORDER BY pp_created DESC ";
		
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

	function get_office_channeling()
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
		$cols 			= array( "oc_id","oc_name","oc_address","oc_phone","oc_fax" );
		$sort 			= "asc";
		
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
		$sql = " SELECT count(0) as iTotal FROM office_channeling ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(oc_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(oc_address) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(oc_phone) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(oc_fax) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		$sql_where = " where oc_status='0' ";

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where)."and oc_status = '0'";		

		$sql = "SELECT * FROM office_channeling $sql_where ";
		$order = " ORDER BY oc_created DESC ";
		
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

	function get_mobil_kas()
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
		$cols 			= array( "mk_id","mk_name","mk_address" );
		$sort 			= "asc";
		
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
		$sql = " SELECT count(0) as iTotal FROM mobil_kas ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(mk_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(mk_address) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		$sql_where = " where mk_status='0' ";

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where)."and mk_status = '0'";		

		$sql = "SELECT * FROM mobil_kas $sql_where ";

		$order = " ORDER BY mk_created DESC ";
		
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
}
