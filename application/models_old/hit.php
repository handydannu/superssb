<?php
class Hit extends CI_Model{

	function __construct() {
		parent::__construct();
		//error_reporting(E_ALL);
	}

	public function insert_hit($id){
		$this->db->set('c_hits', 'c_hits+1', FALSE);
		$this->db->where('c_id', $id);
		$this->db->update('contents');
	}
}