<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		// table
		$this->master_model->get_tables($this);
		$this->db = $this->load->database('default', TRUE);

		// error_reporting(E_ALL);

	}

	function get_page_byid($pid)
	{
		$this->db->select('*');
		$this->db->from($this->pages . ' p');
		$this->db->join($this->channels . ' c', 'c.ch_id=p.p_channel_id', 'left');
		$this->db->join($this->types . ' t', 't.tp_id=c.ch_type', 'left');
		$this->db->where('p_status', '1');
		$this->db->where('p_id', $pid);
		$sql = $this->db->get();

		return $sql->row_array();
	}

	function get_sections()
	{
		$sql = "SELECT sec_id, sec_name FROM {$this->sections} WHERE sec_status='1' ";

		$get = $this->db->query($sql);
		//echo $this->db->last_query();
		return $get->result_array();
	}

	public function insert_new_contact($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->inbox, $data);
		return $this->db->insert_id();
	}

}