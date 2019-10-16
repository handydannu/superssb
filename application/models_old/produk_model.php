<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		// table
		$this->master_model->get_tables($this);
		$this->db = $this->load->database('default', TRUE);

		error_reporting(E_ALL);
	}

	function get_produk($produkID, $offset, $count)
	{
		// ------- get all product ---------
		$produkID = $this->db->escape_str($produkID);
		$offset   = $this->db->escape_str($offset);
		$count    = (empty($count))? '7' : $this->db->escape_str($count);

		$sql_where = ($produkID=='')? "" : "AND product_channel_id='{$produkID}'";

		$sql = "SELECT count(product_id) as itotal FROM {$this->product} WHERE product_status='1' {$sql_where}";
		$get = $this->db->query($sql);
		
		$ret['total'] = $get->row_array();

		$get->free_result();

		$sql2 = "SELECT product_id, product_title, product_slug, product_summary, product_price, product_stock, product_images_thumbnail, product_created_date,
				ch_name
				FROM {$this->product} p
				LEFT JOIN {$this->channels} c ON(c.ch_id=p.product_channel_id)
				WHERE product_status='1' {$sql_where}
				ORDER BY product_id DESC
				LIMIT {$offset},{$count} ";

		$get = $this->db->query($sql2);
		$ret['data'] = $get->result_array();
		$get->free_result();

		return $ret;
	}

	function get_single_product($ID)
	{
		$ID = $this->db->escape_str($ID);

		$sql = "SELECT product_id, product_title, product_summary, product_description, product_price, product_channel_id, product_images, product_created_date,
				ch_name
				FROM {$this->product} p
				LEFT JOIN {$this->channels} c ON(c.ch_id=p.product_channel_id)
				WHERE product_id='{$ID}' AND product_status='1' 
				limit 1
				";

		$get = $this->db->query($sql);
		//echo $this->db->last_query();

		$ret = $get->row_array();

		$get->free_result();
		return $ret;
	}

	function get_other_products($excludeID, $offset, $limit)
	{
		// --- product lainnya ---
		$excludeID = $this->db->escape_str($excludeID);
		$offset    = $this->db->escape_str($offset);
		$limit     = $this->db->escape_str($limit);
		
		$sql2 = "SELECT product_id, product_title, product_slug, product_summary, product_price, product_stock, product_images_thumbnail, product_created_date,
				ch_name
				FROM {$this->product} p
				LEFT JOIN {$this->channels} c ON(c.ch_id=p.product_channel_id)
				WHERE product_status='1' AND product_id != '{$excludeID}'
				ORDER BY product_id DESC
				LIMIT {$offset},{$limit} ";

		$get = $this->db->query($sql2);
		$ret = $get->result_array();
		$get->free_result();

		return $ret;
	}


}