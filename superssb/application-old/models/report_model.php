<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');

		$this->master_model->get_tables($this);
	}

	function article_popular_today($limit)
	{
		// set for 1x24 from now

		$sql = "SELECT 
			c.c_id, c.c_publish_date, c.c_subtitle, c.c_title, c.c_slug, c.c_author, c.c_author_name, c.c_hits, c.c_status, c.c_created_date, c.c_is_editing,
			ch.ch_id, ch.ch_name,
			f.fe_id, f.fe_name,
			u.nama as authorName,
			e.nama as editorName
			FROM {$this->contents} c
			LEFT JOIN channels ch ON(ch.ch_id=c.c_channel_id)
			LEFT JOIN features f ON(f.fe_id=c.c_feature)
			LEFT JOIN user u ON(u.uid=c.c_author)
			LEFT JOIN user e ON(e.uid=c.c_editor)
			WHERE c_publish_date > DATE_SUB( NOW( ) , INTERVAL 24 HOUR ) AND c_status='publish' 
			ORDER BY c_hits DESC
			LIMIT {$limit}
		";

		$query = $this->db->query($sql);
		$ret = $query->result_array();

		$query->free_result();
		return $ret;
	}

	function article_popular_month($limit)
	{
		$start = date("y-m-").'1';
		$end   = date("y-m-").'31';

		$sql = "SELECT 
			c.c_id, c.c_publish_date, c.c_subtitle, c.c_title, c.c_slug, c.c_author, c.c_author_name, c.c_hits, c.c_status, c.c_created_date, c.c_is_editing,
			ch.ch_id, ch.ch_name,
			f.fe_id, f.fe_name,
			u.nama as authorName,
			e.nama as editorName
			FROM {$this->contents} c
			LEFT JOIN channels ch ON(ch.ch_id=c.c_channel_id)
			LEFT JOIN features f ON(f.fe_id=c.c_feature)
			LEFT JOIN user u ON(u.uid=c.c_author)
			LEFT JOIN user e ON(e.uid=c.c_editor)
			WHERE c_publish_date >= '$start' AND c_publish_date <= '$end' AND c_status='publish' 
			ORDER BY c_hits DESC
			LIMIT {$limit}
		";

		$query = $this->db->query($sql);
		$ret = $query->result_array();

		$query->free_result();
		return $ret;
	}

	function get_inbox($limit)
	{
		$sql = "SELECT in_post_date, in_name, in_email, in_message FROM {$this->inbox} ORDER BY in_id DESC LIMIT {$limit} ";
		$query = $this->db->query($sql);
		$ret = $query->result_array();
		$query->free_result();
		return $ret;
	}

	function get_subscriber($limit)
	{
		$sql = "SELECT sub_name, sub_email, sub_date FROM {$this->subscribes} ORDER BY sub_id DESC LIMIT {$limit} ";
		$query = $this->db->query($sql);
		$ret = $query->result_array();
		$query->free_result();
		return $ret;
	}

	function get_publish_article()
	{
		// per month
		$start = date("y-m-").'1';
		$end   = date("y-m-").'31';

		$sql = "SELECT count(c_id) as itotal FROM {$this->contents} WHERE (c_publish_date >= '$start' AND c_publish_date <= '$end') AND c_status='publish' ";
		$query = $this->db->query($sql);
		$ret = $query->row_array();
		$query->free_result();
		return $ret;
	}

	function get_draft_article()
	{
		// per month
		$start = date("y-m-").'1';
		$end   = date("y-m-").'31';
		
		$sql = "SELECT count(c_id) as itotal FROM {$this->contents} WHERE (c_publish_date >= '$start' AND c_publish_date <= '$end') AND c_status='draft' ";
		$query = $this->db->query($sql);
		$ret = $query->row_array();
		$query->free_result();
		return $ret;
	}
	// =============================


}
