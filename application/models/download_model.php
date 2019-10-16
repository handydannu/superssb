<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download_model extends CI_Model
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

	function get_all_files($offset, $limit)
	{
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);

		// select
		$sql = "SELECT doc_id, doc_title, doc_summary, doc_created_date, doc_file, doc_year
				FROM {$this->doc}
				ORDER BY doc_created_date DESC 
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);

		$ret['data'] = $get->result_array();

		$get->free_result();

		// count
		$sql2 = "SELECT count(doc_id) as itotal FROM {$this->doc} ";

		$get = $this->db->query($sql2);

		$ret['total'] = $get->row_array();

		$get->free_result();

		return $ret;
	}

	function get_all_lelang($year, $offset, $limit)
	{
		$year   = $this->db->escape_str($year);
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);

		// select
		$sql = "SELECT doc_id, doc_title, doc_summary, doc_created_date, doc_file, doc_publish_date
				FROM {$this->doc}
				WHERE doc_channel_id = 25 and doc_year = $year and doc_status = 1
				ORDER BY doc_publish_date DESC
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);

		$ret['data'] = $get->result_array();

		$get->free_result();

		// count
		$sql2 = "SELECT count(doc_id) as itotal FROM {$this->doc} ";

		$get = $this->db->query($sql2);

		$ret['total'] = $get->row_array();

		$get->free_result();

		return $ret;
	}

	function get_all_laporan_tahunan($year, $offset, $limit)
	{
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);

		// select
		$sql = "SELECT doc_id, doc_title, doc_summary, doc_created_date, doc_file, doc_publish_date
				FROM {$this->doc}
				WHERE doc_channel_id = 16 and doc_year = $year and doc_status = 1
				ORDER BY doc_publish_date DESC
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);

		$ret['data'] = $get->result_array();

		$get->free_result();

		// count
		$sql2 = "SELECT count(doc_id) as itotal FROM {$this->doc} ";

		$get = $this->db->query($sql2);

		$ret['total'] = $get->row_array();

		$get->free_result();

		return $ret;
	}

	function get_all_sbdk($year, $offset, $limit)
	{
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);

		// select
		$sql = "SELECT doc_id, doc_title, doc_summary, doc_created_date, doc_file, doc_publish_date
				FROM {$this->doc}
				WHERE doc_channel_id = 23 and doc_year = $year and doc_status = 1
				ORDER BY doc_publish_date DESC
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);

		$ret['data'] = $get->result_array();

		$get->free_result();

		// count
		$sql2 = "SELECT count(doc_id) as itotal FROM {$this->doc} ";

		$get = $this->db->query($sql2);

		$ret['total'] = $get->row_array();

		$get->free_result();

		return $ret;
	}

	function get_all_gcg($year, $offset, $limit)
	{
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);

		// select
		$sql = "SELECT doc_id, doc_title, doc_summary, doc_created_date, doc_file, doc_publish_date
				FROM {$this->doc}
				WHERE doc_channel_id = 21 and doc_year = $year and doc_status = 1
				ORDER BY doc_publish_date DESC
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);

		$ret['data'] = $get->result_array();

		$get->free_result();

		// count
		$sql2 = "SELECT count(doc_id) as itotal FROM {$this->doc} ";

		$get = $this->db->query($sql2);

		$ret['total'] = $get->row_array();

		$get->free_result();

		return $ret;
	}

	function get_all_psp($year, $offset, $limit)
	{
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);

		// select
		$sql = "SELECT doc_id, doc_title, doc_summary, doc_created_date, doc_file, doc_publish_date
				FROM {$this->doc}
				WHERE doc_channel_id = 30 and doc_year = $year and doc_status = 1
				ORDER BY doc_publish_date DESC
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);

		$ret['data'] = $get->result_array();

		$get->free_result();

		// count
		$sql2 = "SELECT count(doc_id) as itotal FROM {$this->doc} ";

		$get = $this->db->query($sql2);

		$ret['total'] = $get->row_array();

		$get->free_result();

		return $ret;
	}

	function get_all_lainnya($offset, $limit)
	{
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);

		$today	= date('Y-m-d H:i:s');

		// select
		$sql = "SELECT doc_id, doc_title, doc_summary, doc_created_date, doc_file, doc_publish_date
				FROM {$this->doc}
				WHERE doc_channel_id = 24 and doc_publish_date <= '$today' and doc_status = 1
				ORDER BY doc_publish_date DESC
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);

		$ret['data'] = $get->result_array();

		$get->free_result();

		// count
		$sql2 = "SELECT count(doc_id) as itotal FROM {$this->doc} ";

		$get = $this->db->query($sql2);

		$ret['total'] = $get->row_array();

		$get->free_result();

		return $ret;
	}

	function get_all_laporan_keuangan($channel, $offset, $limit)
	{
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);

		// select
		$sql = "SELECT doc_id, doc_title, doc_summary, doc_created_date, doc_file, doc_publish_date
				FROM {$this->doc}
				WHERE doc_channel_id = $channel
				ORDER BY doc_publish_date DESC
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql);

		$ret['data'] = $get->result_array();

		$get->free_result();

		// count
		$sql2 = "SELECT count(doc_id) as itotal FROM {$this->doc} ";

		$get = $this->db->query($sql2);

		$ret['total'] = $get->row_array();

		$get->free_result();

		return $ret;
	}

	function get_total_all_lelang($year)
	{
		$id = $this->db->escape_str($id);

		$sql = "SELECT count(doc_id) AS itotal 
				FROM {$this->doc} 
				WHERE doc_channel_id = 25 and doc_year = $year and doc_status = 1
				";

		$get = $this->db->query($sql);
		$ret = $get->row_array();
		
		$get->free_result();
		return $ret;
	}

	function get_total_all_laporan_tahunan($year)
	{
		$id = $this->db->escape_str($id);

		$sql = "SELECT count(doc_id) AS itotal 
				FROM {$this->doc} 
				WHERE doc_channel_id = 16 and doc_year = $year and doc_status = 1
				";

		$get = $this->db->query($sql);
		$ret = $get->row_array();
		
		$get->free_result();
		return $ret;
	}

	function get_total_all_sbdk($year)
	{
		$id = $this->db->escape_str($id);

		$sql = "SELECT count(doc_id) AS itotal 
				FROM {$this->doc} 
				WHERE doc_channel_id = 23 and doc_year = $year and doc_status = 1
				";

		$get = $this->db->query($sql);
		$ret = $get->row_array();
		
		$get->free_result();
		return $ret;
	}

	function get_total_all_gcg($year)
	{
		$id = $this->db->escape_str($id);

		$sql = "SELECT count(doc_id) AS itotal 
				FROM {$this->doc} 
				WHERE doc_channel_id = 21 and doc_year = $year and doc_status = 1
				";

		$get = $this->db->query($sql);
		$ret = $get->row_array();
		
		$get->free_result();
		return $ret;
	}

	function get_total_all_psp($year)
	{
		$id = $this->db->escape_str($id);

		$sql = "SELECT count(doc_id) AS itotal 
				FROM {$this->doc} 
				WHERE doc_channel_id = 30 and doc_year = $year and doc_status = 1
				";

		$get = $this->db->query($sql);
		$ret = $get->row_array();
		
		$get->free_result();
		return $ret;
	}

	function get_total_all_lainnya()
	{
		$id = $this->db->escape_str($id);

		$today	= date('Y-m-d H:i:s');

		$sql = "SELECT count(doc_id) AS itotal 
				FROM {$this->doc} 
				WHERE doc_channel_id = 24 and doc_publish_date <= '$today' and doc_status = 1";

		$get = $this->db->query($sql);
		$ret = $get->row_array();
		
		$get->free_result();
		return $ret;
	}

	function get_total_all_laporan_keuangan($id)
	{
		$id = $this->db->escape_str($id);

		$sql = "SELECT count(doc_id) AS itotal 
				FROM {$this->doc} 
				WHERE doc_channel_id = $id and doc_status = 1";

		$get = $this->db->query($sql);
		$ret = $get->row_array();
		
		$get->free_result();
		return $ret;
	}

	function get_year_download($id)
	{
		$get = $this->db->query("SELECT distinct doc_year FROM documents WHERE doc_channel_id = $id order by doc_year DESC");
		return $get;
	}

	function get_year_download_sort($id)
	{
		$get = $this->db->query("SELECT distinct doc_year FROM documents WHERE doc_channel_id = $id order by doc_year DESC limit 0,1");
		return $get;
	}

	function get_kategori_lap_keuangan()
	{
		$get = $this->db->query("SELECT ch_name,ch_id FROM channels WHERE ch_parent_id = 17 order by ch_id ASC");
		return $get;
	}

	function get_kategori_lap_keuangan_sort()
	{
		$get = $this->db->query("SELECT ch_name,ch_id FROM channels WHERE ch_parent_id = 17 order by ch_id DESC limit 0,1");
		return $get;
	}

}