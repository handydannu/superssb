<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		// table
		$this->master_model->get_tables($this);
	}
	

	function get_documents($channelID)
	{
		// ---- Get All show as Json ----
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array( "doc_channel_id='{$channelID}' " );
		$sql_where 		= '';
		$cols 			= array( "doc_id", "", "doc_title", "doc_year", "doc_publish_date", "doc_summary", "doc_file", "doc_status" );
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
					UCASE(doc_title) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(doc_year) LIKE '%".strtoupper($this->db->escape_str($search))."%'  OR
					UCASE(doc_file) LIKE '%".strtoupper($this->db->escape_str($search))."%' 
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		// Running Query Total Row
		$sql = " SELECT count(0) as iTotal FROM {$this->doc} $sql_where";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Grab Data
		$sql = "SELECT doc_id, doc_title, doc_summary, doc_file, doc_publish_date, doc_created_date, doc_modified_date, doc_year, doc_channel_id, doc_status
				FROM {$this->doc} $sql_where ";

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

	public function insert_new_doc($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->doc, $data);
		return $this->db->insert_id();
	}

	public function update_doc($data, $ID)
	{
		$ID = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('doc_id', $ID);
		$this->db->update($this->doc, $data);
		return $this->db->affected_rows();
	}

	public function delete_doc($id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete($this->doc, array('doc_id'=>$id));
	}

	function get_doc_byid($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->doc);
		$this->db->where('doc_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	function get_channel_laporan_keuangan()
	{
		$this->db->select('*');
		$this->db->from($this->channels);
		$this->db->where('ch_parent_id', $this->config->item('laporan-keuangan'));
		$prod = $this->db->get();

		return $prod->result_array();
	}

	function get_laporan_keuangan()
	{		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array( "doc_channel_id IN(18,19,20) " );
		$sql_where 		= '';
		$cols 			= array( "doc_id", "", "doc_title", "doc_year", "doc_publish_date", "doc_summary", "doc_file", "doc_status" );
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
					UCASE(doc_title) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(doc_year) LIKE '%".strtoupper($this->db->escape_str($search))."%'  OR
					UCASE(doc_file) LIKE '%".strtoupper($this->db->escape_str($search))."%' 
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		// Running Query Total Row
		$sql = " SELECT count(0) as iTotal FROM {$this->doc} $sql_where";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Grab Data
		$sql = "SELECT doc_id, doc_title, doc_summary, doc_file, doc_created_date, doc_modified_date, doc_year, doc_publish_date, doc_channel_id, doc_status, ch_name 
				FROM {$this->doc} d 
				LEFT JOIN {$this->channels} c ON(c.ch_id=d.doc_channel_id)
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

	function get_channel_pengumuman()
	{
		$this->db->select('*');
		$this->db->from($this->channels);
		$this->db->where('ch_parent_id', $this->config->item('pengumuman'));
		$prod = $this->db->get();

		return $prod->result_array();
	}

	function get_pengumuman()
	{		
		$channelID = $this->config->item('pengumuman');
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array( "ch_parent_id='{$channelID}' " );
		$sql_where 		= '';
		$cols 			= array( "doc_id", "", "doc_title", "doc_year", "doc_summary", "doc_file", "doc_status" );
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
					UCASE(doc_title) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(doc_year) LIKE '%".strtoupper($this->db->escape_str($search))."%'  OR
					UCASE(doc_file) LIKE '%".strtoupper($this->db->escape_str($search))."%' 
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		// Running Query Total Row
		$sql = " SELECT count(0) as iTotal 
				FROM {$this->doc} d 
				LEFT JOIN {$this->channels} c ON(c.ch_id=d.doc_channel_id)
				$sql_where";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Grab Data
		$sql = "SELECT doc_id, doc_title, doc_summary, doc_file, doc_created_date, doc_modified_date, doc_year, doc_channel_id, doc_status, ch_name 
				FROM {$this->doc} d 
				LEFT JOIN {$this->channels} c ON(c.ch_id=d.doc_channel_id)
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

}
