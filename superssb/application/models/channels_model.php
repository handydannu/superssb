<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channels_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('dataTables_model','DT');

		// table
		$this->master_model->get_tables($this);
		//$this->SERVER = $this->db->escape_str($this->session->userdata('SERVER'));
	}

	function get_category()
	{
		$sql = " SELECT * FROM {$this->channels} WHERE ch_parent_id ='0' ORDER BY ch_id ASC ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function category_name_exists($category_name, $category_id)
	{
		$category_name = $this->db->escape_str($category_name);
		$category_id = $this->db->escape_str($category_id);

		$sql = " 
			SELECT ch_name FROM {$this->channels} 
			WHERE
				(ch_name = '{$category_name}' OR ch_slug = '{$category_name}') AND 
				ch_id <> '{$category_id}'
		";
		$query = $this->db->query($sql);
		if($query->num_rows()>0) return TRUE;
		else return FALSE;
	}

	function insert_channel($data)
	{
		$data = $this->master_model->escape_all($data);
		$this->db->insert($this->channels, $data);
		return $this->db->affected_rows();
	}

	function update_channel($data,$id)
	{
		$id = $this->db->escape_str($id);
		$data = $this->master_model->escape_all($data);
		$this->db->where('ch_id', $id);
		$this->db->update($this->channels,$data);
		return $this->db->affected_rows();
	}

	function delete_channel($id)
	{
		$id = $this->db->escape_str($id);
		$this->db->where('ch_id', $id);
		$this->db->delete($this->channels);
		return $this->db->affected_rows();
	}

	function get_channels_datatable()
	{
		$offset  = $this->DT->get_start();
		$rows    = $this->DT->get_rows();

		$_sql_where = array();

		$keyword = (isset($_GET['sSearch']) && $_GET['sSearch'] != "") ? $_GET['sSearch'] : '';
		if( ! empty($keyword) ){
			$_sql_where[] = "
				(
					UCASE(c.ch_name) LIKE '%".strtoupper($this->db->escape_str($keyword))."%' OR
					UCASE(c.ch_slug) LIKE '%".strtoupper($this->db->escape_str($keyword))."%' OR
					UCASE(t.tp_name) LIKE '%".strtoupper($this->db->escape_str($keyword))."%'
				)
			";
		}

		$sql_where = '';
		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);

		$sql = "
			SELECT c.ch_id, c.ch_name, c.ch_slug, c.ch_status, tp_name
			FROM {$this->channels} c
			LEFT JOIN {$this->types} t ON(t.tp_id=c.ch_type)
			$sql_where
			
		";

		$query     = $this->db->query($sql);
		$row_count = $query->num_rows();
		$query->free_result();

		$query = $this->db->query($sql." ORDER BY ch_id ASC");
		$ret['result'] = $query->result();
		$query->free_result();

		// result for datatables
		$ret['echo']         = $this->DT->get_echo();
		$ret['totalRecords'] = $row_count;
		if (!empty($keyword)) 
			$ret['totalDisplayRecords'] = count($ret['result']);
		else
			$ret['totalDisplayRecords'] = $row_count;
		return $ret;
	}

	function get_channel_by_id($id)
	{
		$id = $this->db->escape_str($id);
		$query = $this->db->query(" SELECT * FROM {$this->channels} WHERE ch_id = '{$id}' ");
		return (object) $query->row();
	}

	function get_all_active_channels($type='')
	{
		$this->db->select('*');
		$this->db->from($this->channels);
		$this->db->where('ch_type', $type);
		$this->db->where('ch_status', '1');
		$sql = $this->db->get();
		
		return $sql->result_array();
	}

	// get data from table types
	function get_types()
	{
		$this->db->select('*');
		$this->db->from($this->types);
		$this->db->where('tp_status', '1');
		$sql = $this->db->get();
		
		return (object) $sql->result();
	}

	// ===============================================

}