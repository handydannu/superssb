<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		$this->master_model->get_tables($this);
	}

	function get_product_datatable()
	{

		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 20;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array("product_id");
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
		$sql = " SELECT count(0) as iTotal FROM {$this->product} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(product_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(product_price) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(product_stock) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT 
			product_id, product_title, product_price, product_stock, product_images_thumbnail, product_created_date, product_status, 
			ch.ch_id, ch.ch_name
			FROM {$this->product} p
			LEFT JOIN channels ch ON(ch.ch_id=p.product_channel_id)
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

		//echo $this->db->last_query();
		
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

	public function insert_product($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->product, $data);
		return $this->db->insert_id();
	}

	function get_product_by($id)
	{
		$id = $this->db->escape_str($id);
		
		$this->db->select('*');
		$this->db->from($this->product);
		$this->db->where('product_id', $id);
		$sql = $this->db->get();

		return $sql->row_array();
	}

	function update_product($data,$id)
	{
		$id   = $this->db->escape_str($id);
		$data = $this->master_model->escape_all($data);
		$this->db->where('product_id', $id);
		$this->db->update($this->product, $data);
		return $this->db->affected_rows();
	}

	function delete_product($id)
	{
		$id = $this->db->escape_str($id);
		$this->db->where('product_id', $id);
		$this->db->delete($this->product);
		return $this->db->affected_rows();
	}



}