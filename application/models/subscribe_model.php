<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		// table
		$this->master_model->get_tables($this);
		$this->db = $this->load->database('default', TRUE);

		 error_reporting(E_ALL);

	}

	// --------- SUBSCRIBES -------------
	public function add_subscribe($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->subscribes, $data);
		return $this->db->insert_id();

	}

	function cek_subscriber($email)
	{
		$email = $this->db->escape_str($email);

		$this->db->select('sub_id');
		$this->db->from($this->subscribes);
		$this->db->where('sub_email', $email);
		$query = $this->db->get();

		$ret = $query->row_array();
		$query->free_result();
		return $ret;
	}

	// ----- DAFTAR -------
	public function add_registrant($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->user_str, $data);
		return $this->db->insert_id();

	}

	function do_login($u,$p)
	{
		$u = $this->db->escape_str($u);
		$p = $this->db->escape_str($p);

		$query = $this->db->query(" SELECT * FROM {$this->user_str} WHERE username='$u' AND password=md5('$p') AND active='1' ");
		if($query->num_rows()>0){
			$cu = $query->row();
			
			$data = array();
			$data['login_status']     = 1;
			$data['current_user']     = $cu->user_id;
			$data['current_username'] = $cu->username;
			$this->session->set_userdata($data);

			return true;
		}else{
			// return false;
			$message = 'Invalid Username/Password !';
			return $message;
		}
	}
}