<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');

		// table
		$this->master_model->get_tables($this);
		// db library	
        $this->DBLib = $this->load->database('library',TRUE);
		$this->SERVER = $this->session->userdata('SERVER');
	}

	function get_image_by_id($id,$site_id)
	{
		$id = $this->db->escape_str($id);
		$query = $this->DBLib->query(" SELECT * FROM {$this->image} WHERE img_id = '$id' AND img_site_id = '$site_id'");
		$data = $query->row();
		$query->free_result();
		return $data;
	}

	function insert_image($data)
	{
		$data = $this->master_model->escape_all($data);
		$this->DBLib->insert($this->image, $data);
		// echo $this->db->last_query();
		return $this->DBLib->affected_rows();
	}

	function update_image($data,$id)
	{
		$id   = $this->db->escape_str($id);
		$data = $this->master_model->escape_all($data);
		$this->DBLib->where('img_id', $id);
		$this->DBLib->update($this->image,$data);
		return $this->DBLib->affected_rows();
	}

	function delete_image($id,$site_id)
	{
		$id      = $this->db->escape_str($id);
		$site_id = $this->db->escape_str($site_id);
		$this->DBLib->where('img_id', $id);
		$this->DBLib->where('img_site_id', $site_id);
		$this->DBLib->delete($this->image);
		// echo $this->DBLib->last_query();
		return $this->DBLib->affected_rows();
	}

	function get_image($keyword, $page)
	{
		/*$page = $this->input->post('page') ? $this->input->post('page') : 1;
		$rows = $this->input->post('rows') ? $this->input->post('rows') : 20;
		$sort = $this->input->post('sort') ? $this->input->post('sort') : 'img_id';
		$order = $this->input->post('order') ? $this->input->post('order') : 'desc';
		$offset = ($page-1)*$rows;

		
		$keyword = $this->input->post('keyword') ? $this->input->post('keyword') : '';*/

		$page    = (empty($page)) ? 1 : $page;
		$rows    = $this->input->post('rows') ? $this->input->post('rows') : 20;
		$sort    = $this->input->post('sort') ? $this->input->post('sort') : 'img_id';
		$order   = $this->input->post('order') ? $this->input->post('order') : 'desc';
		$keyword = (empty($keyword)) ? '' : $keyword;
		$offset  = ($page-1)*$rows;

		$_sql_where = array();

		if( ! empty($keyword) ){
			$_sql_where[] = "
				(
					UCASE(img_keyword) LIKE '%".strtoupper($this->db->escape_str($keyword))."%' OR
					UCASE(img_file) LIKE '%".strtoupper($this->db->escape_str($keyword))."%' OR
					UCASE(img_caption) LIKE '%".strtoupper($this->db->escape_str($keyword))."%'
				)
			";
		}
		$size = $this->input->post('size') ? $this->input->post('size') : '';
		if( ! empty($size) ){
			$_sql_where[] = "
				(UCASE(img_size) LIKE '".strtoupper($this->db->escape_str($size))."%')
			";
		}
		$resolution = $this->input->post('resolution') ? $this->input->post('resolution') : '';
		if( ! empty($resolution) ){
			$_sql_where[] = "
				(UCASE(img_resolution) LIKE '%".strtoupper($this->db->escape_str($resolution))."%')
			";
		}
		$_sql_where[] = " img_site_id = " . $this->SERVER;

		$sql_where = '';
		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);

		$sql = " SELECT *, year(img_date) as year, LPAD(month(img_date),2,'0') as month, LPAD(day(img_date),2,'0') as day 
				 FROM {$this->image} $sql_where ";
		$query = $this->DBLib->query($sql);
		$ret['num_rows'] = $query->num_rows();
		$query->free_result();

		$query = $this->DBLib->query($sql." ORDER BY $sort $order LIMIT $offset,$rows ");
		$ret['result'] = $query->result();
		$query->free_result();
		return $ret;
	}
}