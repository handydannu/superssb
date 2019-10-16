<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emagz_model extends CI_Model
{
	/* ----- BULETIN dan EMAGZ ------ */

	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		// table
		$this->master_model->get_tables($this);
		$this->db = $this->load->database('default', TRUE);

		 error_reporting(E_ALL);

	}

	function get_buletin_list($offset, $limit)
	{
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);
		
		$sql = "SELECT count(ea_id) as itotal FROM {$this->emagz_album} WHERE ea_status='1' ";
		$get = $this->db->query($sql);
		$ret['total'] = $get->row_array();

		$get->free_result();

		$sql2 = "SELECT ea_id, ea_edition, ea_title, ea_slug, ea_summary, ea_created_date, 
				em_images, em_images_thumbnail 
				FROM {$this->emagz_album} a 
				LEFT JOIN {$this->emagz} e ON(e.em_album_id=a.ea_id)
				WHERE ea_status='1' AND em_is_cover='1'
				GROUP BY ea_id
				ORDER BY ea_date DESC
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql2);
		$ret['data'] = $get->result_array();

		$get->free_result();
		//echo $this->db->last_query();
		return $ret;
	}

	function get_buletin_byYear($y, $offset, $limit)
	{
		$offset = $this->db->escape_str($offset);
		$limit  = $this->db->escape_str($limit);
		$year   = $this->db->escape_str($y);
		
		$sql = "SELECT count(ea_id) as itotal FROM {$this->emagz_album} WHERE ea_status='1' AND YEAR(ea_date)='{$year}' ";
		$get = $this->db->query($sql);
		$ret['total'] = $get->row_array();

		$get->free_result();

		$sql2 = "SELECT ea_id, ea_edition, ea_title, ea_slug, ea_summary, ea_created_date, 
				em_images, em_images_thumbnail 
				FROM {$this->emagz_album} a 
				LEFT JOIN {$this->emagz} e ON(e.em_album_id=a.ea_id)
				WHERE ea_status='1' AND em_is_cover='1' AND YEAR(ea_date)='{$year}'
				ORDER BY ea_date DESC
				LIMIT {$offset}, {$limit} ";

		$get = $this->db->query($sql2);
		$ret['data'] = $get->result_array();

		$get->free_result();
		//echo $this->db->last_query();
		return $ret;
	}

	function get_year()
	{
		$sql = "SELECT DISTINCT YEAR(ea_date) as tahun_terbit FROM {$this->emagz_album} WHERE ea_status='1' ORDER BY tahun_terbit DESC ";
		$get = $this->db->query($sql);
		$ret = $get->result_array();

		$get->free_result();

		return $ret;
	}

	function get_emagz($ID)
	{
		// ----- Emagz detail ----
		$ID = $this->db->escape_str($ID);
		$sql = "SELECT ea_id, ea_date, ea_title, ea_slug, ea_summary, ea_created_date, 
				em_id, em_title, em_images_thumbnail, em_images, em_album_id, em_is_cover, em_page
				FROM {$this->emagz_album} a 
				LEFT JOIN {$this->emagz} e ON(e.em_album_id=a.ea_id)
				WHERE ea_id='{$ID}'
				ORDER BY em_page ASC ";

		$get = $this->db->query($sql);
		$ret = $get->result_array();

		$get->free_result();
		//echo $this->db->last_query();
		return $ret;
	}

}