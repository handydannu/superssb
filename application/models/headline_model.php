<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Headline_model extends CI_Model {
	
	function getData($table, $field='', $order='', $dasc='DESC', $limit='', $offset='') {
		$this->db->select('*');
		$this->db->from($table);

		if(!empty($field)) {
			$this->db->where($field);
		}
		
		if(empty($order)):
			$this->db->order_by($table.'_id', $dasc);
		else:
			$this->db->order_by($order, $dasc);
		endif;
		
		if(!empty($limit)):
			$this->db->limit($limit,$offset);
		endif;
		
		$get = $this->db->get();
		
		return $get;
	}

	function getTestimoni($sql) {
		$get = $this->db->query($sql);
		return $get;
	}
}