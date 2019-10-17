<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allsection_category_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');

		// table
		$this->master_model->get_tables($this);
		$this->SERVER = $this->db->escape_str($this->session->userdata('SERVER'));
	}

	/**
	 * Frontend-method
	 */

	function get_public_allsection_category()
	{
		$sql = " SELECT * FROM {$this->allsection_category} ORDER BY ordering ASC ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	/**
	 * Backend-method
	 */

	function get_allsection_category_by_id($id)
	{
		$id = $this->db->escape_str($id);
		$query = $this->db->query(" SELECT * FROM {$this->allsection_category} WHERE category_id = '{$id}' ");
		return (object) $query->row();
	}

	function insert_allsection_category($data)
	{
		$data = $this->master_model->escape_all($data);
		$this->db->insert($this->allsection_category, $data);
		return $this->db->affected_rows();
	}

	function update_allsection_category($data,$id)
	{
		$id = $this->db->escape_str($id);
		$data = $this->master_model->escape_all($data);
		$this->db->where('category_id', $id);
		$this->db->update($this->allsection_category,$data);
		return $this->db->affected_rows();
	}

	function delete_allsection_category($id)
	{
		$id = $this->db->escape_str($id);
		$this->db->where('category_id', $id);
		$this->db->delete($this->allsection_category);
		return $this->db->affected_rows();
	}

	function get_allsection_category()
	{
		$sql = "
			SELECT * FROM {$this->allsection_category}
			ORDER BY ordering ASC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_allsection_category_all()
	{
		$query = $this->db->query(" SELECT * FROM {$this->allsection_category} ORDER BY ordering ASC ");
		return $query->result();
	}

	function get_allsection_category_select($init = array())
	{
		$tmp = array();
		if(is_array($init) AND count($init)>0) $tmp = $init;
		$res = $this->get_allsection_category_all();
		if(count($res)>0){
			foreach($res as $row){
				$tmp[$row->category_id] = ucfirst($row->category);
			}
		}
		return $tmp;
	}
}