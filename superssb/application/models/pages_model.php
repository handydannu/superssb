<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		// table
		$this->master_model->get_tables($this);
	}
	

	function get_pages($channelID)
	{
		// ---- Get All Pages show as Json ----
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array( "p_channel_id={$channelID}" );
		$sql_where 		= '';
		$cols 			= array( "p_id", "", "p_title", "p_summary", "p_modified_date", "" );
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
					UCASE(p_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(p_summary) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(p_modified_date) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);

		// Running Query Total Row
		$sql = " SELECT count(0) as iTotal FROM {$this->pages} $sql_where";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Query grab data
		$sql = "SELECT p_id, p_title, p_slug, p_summary, p_content, p_status, p_channel_id, DATE_FORMAT(p_modified_date, '%d %M %Y %H:%i') as last_update FROM {$this->pages} $sql_where ";

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

	public function insert_new_page($data)
	{
		//$data = $this->master_model->escape_all($data);

		$this->db->insert($this->pages, $data);
		return $this->db->insert_id();
	}

	public function update_page($data, $ID)
	{
		$ID = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('p_id', $ID);
		$this->db->update($this->pages, $data);
		return $this->db->affected_rows();
	}

	public function delete_page($id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete($this->pages, array('p_id'=>$id));
	}

	function get_page_byid($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->pages);
		$this->db->where('p_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

}
