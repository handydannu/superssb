<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		// table
		$this->master_model->get_tables($this);
	}
	

	function get_inbox()
	{
		// ---- Get All data show as Json ----
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array( "in_id" );
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
		$sql = " SELECT count(0) as iTotal FROM {$this->inbox} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(in_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(in_email) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(in_phone) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(in_url) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(in_message) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT * FROM {$this->inbox} $sql_where ";

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

	public function delete_message($id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete($this->inbox, array('in_id'=>$id));
	}


	// --------- SUBSCRIBES ------------
	function get_subscribers()
	{
		// ---- Get All data show as Json ----
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 20;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array( "sub_id" );
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
		$sql = " SELECT count(0) as iTotal FROM {$this->subscribes} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(sub_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(sub_email) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(sub_phone) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(sub_date) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT * FROM {$this->subscribes} $sql_where ";

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

	public function delete_subscriber($id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete($this->subscribes, array('sub_id'=>$id));
	}

	public function update_subscriber($data, $ID)
	{
		$ID = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('sub_id', $ID);
		$this->db->update($this->subscribes, $data);
		return $this->db->affected_rows();
	}

	function get_subscriber_byid($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->subscribes);
		$this->db->where('sub_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	// --- Registrant -----
	function get_registrant()
	{
		// ---- Get All data show as Json ----
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array( "user_id", "fullname", "email", "username", "sex", "birth_date", "address", "city", "job", "" );
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
		$sql = " SELECT count(0) as iTotal FROM {$this->user_str} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(fullname) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(email) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(username) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(city) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(job) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(address) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(sex) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT user_id, fullname, email, username, sex, birth_date, address, city, job, created_date, active 
				FROM {$this->user_str} $sql_where ";

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

	public function delete_registrant($id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete($this->user_str, array('user_id'=>$id));
	}

	function get_single_registrant($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->user_str);
		$this->db->where('user_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	public function update_password_reg($id, $data)
	{
		$this->db->set('password', $data['password']);
		$this->db->where('user_id', $id);
		$this->db->update($this->user_str);

		return $this->db->affected_rows();
	}

}
