<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allsection_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');

		// table
		$this->master_model->get_tables($this);
	}

	/**
	 * Frontend-method
	 */

	function get_public_allsection()
	{
		$query = $this->db->query(" SELECT * FROM {$this->allsection} ORDER BY ordering2 ASC ");
		$tmp = array();
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$tmp[$row->category_id][] = $row;
			}
		}
		return $tmp;
	}

	/**
	 * Backend-method
	 */

	function get_allsection_by_id($id)
	{
		$id = $this->db->escape_str($id);
		$query = $this->db->query(" SELECT * FROM {$this->allsection} WHERE id = '$id' ");
		return (object) $query->row();
	}

	function insert_allsection($data)
	{
		$data = $this->master_model->escape_all($data);
		$this->db->insert($this->allsection, $data);
		return $this->db->affected_rows();
	}

	function update_allsection($data,$id)
	{
		$id = $this->db->escape_str($id);
		$data = $this->master_model->escape_all($data);
		$this->db->where('id', $id);
		$this->db->update($this->allsection,$data);
		return $this->db->affected_rows();
	}

	function delete_allsection($id)
	{
		$id = $this->db->escape_str($id);
		$this->db->where('id', $id);
		$this->db->delete($this->allsection);
		return $this->db->affected_rows();
	}

	function get_allsection()
	{
		$page = $this->input->post('page') ? $this->input->post('page') : 1;
		$rows = $this->input->post('rows') ? $this->input->post('rows') : 20;
		$sort = $this->input->post('sort') ? $this->input->post('sort') : 'id';
		$order = $this->input->post('order') ? $this->input->post('order') : 'desc';
		$keyword = $this->input->post('q') ? $this->input->post('q') : '';
		$offset = ($page-1)*$rows;

		$_sql_where = array();
		if( ! empty($keyword) ){
			$_sql_where[] = " UCASE(title) LIKE '%".strtoupper($this->db->escape_str($keyword))."%' ";
		}

		$sql_where = '';
		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);

		$sql = " SELECT * FROM {$this->allsection} A LEFT JOIN {$this->allsection_category} C ON (C.category_id = A.category_id) $sql_where ";
		$query = $this->db->query($sql);
		$ret['num_rows'] = $query->num_rows();
		$query = $this->db->query($sql." ORDER BY C.ordering ASC, $sort $order LIMIT $offset,$rows ");
		$ret['result'] = $query->result();
		return $ret;
	}

}