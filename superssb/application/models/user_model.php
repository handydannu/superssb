<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		// table
		$this->master_model->get_tables($this);
	}

	function get_cms_user($uid)
	{
		// ---- Get All CMS User show as Json ----
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array( "uid" );
		$sort 			= "desc";
		
		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		// limit
		$start 		= $this->datatables_model->get_start();
		$rows 		= $this->datatables_model->get_rows();
		// sort
		$sort 		= $this->datatables_model->get_sort($cols);		
		$sort_dir 	= $this->datatables_model->get_sort_dir();	
		        
        //running query		
		$sql = " 	SELECT count(0) as iTotal
					FROM {$this->user}
				";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(username) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = " 	SELECT *
					FROM {$this->user}
					$sql_where where uid = $uid
			";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query 	= $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data 	= $query->result();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}
		
        //    * Output
         
         $output = array(
             "sEcho" => $this->datatables_model->get_echo(),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => $data
         );

        $query->free_result();

		return json_encode($output);
	}

	function get_cms_user_admin()
	{
		// ---- Get All CMS User show as Json ----
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array( "uid" );
		$sort 			= "desc";
		
		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		// limit
		$start 		= $this->datatables_model->get_start();
		$rows 		= $this->datatables_model->get_rows();
		// sort
		$sort 		= $this->datatables_model->get_sort($cols);		
		$sort_dir 	= $this->datatables_model->get_sort_dir();	
		        
        //running query		
		$sql = " 	SELECT count(0) as iTotal
					FROM {$this->user}
				";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(username) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = " 	SELECT *
					FROM {$this->user}
					$sql_where
			";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query 	= $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data 	= $query->result();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}
		
        //    * Output
         
         $output = array(
             "sEcho" => $this->datatables_model->get_echo(),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => $data
         );

        $query->free_result();

		return json_encode($output);
	}

	// --- CMS USER ---
	public function insert_new_user($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->user, $data);
		return $this->db->insert_id();
	}
	
	public function delete_cms_user($id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete($this->user, array('uid'=>$id));
	}

	public function update_cms_user($data, $ID)
	{
		$ID = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('uid', $ID);
		$this->db->update($this->user, $data);
		return $this->db->affected_rows();
	}

	function get_cmsuser_byid($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->user);
		$this->db->where('uid', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	function save_cms_users()
	{
		$this->db->select('uid, username, nama, email, telpon');
		$this->db->from($this->user);
		$this->db->order_by("uid", "asc");
		$sql = $this->db->get();
		$hasil = $sql->result_array();

		$sql->free_result();

		return $hasil;
	}

	function user_privilege($privil)
	{
		$privil = $this->db->escape_str($privil);
		
		$USER_ID = $this->session->userdata('current_user');

		$this->db->select('*');
		$this->db->from($this->user);
		$this->db->where('uid', $USER_ID);
		$this->db->where('privilege', $privil);
		$prod = $this->db->get();

		$data = $prod->row_array();

		if ($data['privilege'] == $privil)
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function get_produktivitas($user, $startdate, $enddate)
	{
		$user      = $this->db->escape_str($user);
		$startdate = $this->db->escape_str($startdate);
		$enddate   = $this->db->escape_str($enddate);

		$sql = " SELECT post_date, post_title, nama, username, email
				FROM {$this->posts} P
				LEFT JOIN {$this->user} U ON (P.post_author=U.uid)
				WHERE
				post_author = '$user'
				AND post_date >= '$startdate'
				AND post_date <= '$enddate'
				ORDER BY post_id DESC
		";

		$get    = $this->db->query($sql);
		$result = $get->result_array();
		$get->free_result();

		return $result;
	}

	function get_all_active_user()
	{
		$this->db->select('*');
		$this->db->from($this->user);
		$this->db->where('active', '1');
		$sql = $this->db->get();
		
		return $sql->result_array();
	}

	function get_all_active_editor()
	{
		$this->db->select('*');
		$this->db->from($this->user);
		$this->db->where('privilege', 'editor');
		$this->db->or_where('privilege', 'admin');
		$this->db->where('active', '1');
		$sql = $this->db->get();
		
		return $sql->result_array();
	}

	//=======================================================

	function get_user()
	{
		$page = $this->input->post('page') ? (int) $this->input->post('page') : 1;
		$rows = $this->input->post('rows') ? (int) $this->input->post('rows') : 20;
		$sort = $this->input->post('sort') ? $this->input->post('sort') : 'uid';
		$order = $this->input->post('order') ? $this->input->post('order') : 'asc';
		$offset = ($page-1)*$rows;

		$_sql_where = array();
		
		$keyword = $this->input->post('keyword') ? $this->input->post('keyword') : '';
		if( ! empty($keyword) ){
			$_sql_where[] = "
				(
					UCASE(username) LIKE '%".strtoupper($this->db->escape_str($keyword))."%' OR
					UCASE(nama) LIKE '%".strtoupper($this->db->escape_str($keyword))."%' OR
					UCASE(email) LIKE '%".strtoupper($this->db->escape_str($keyword))."%'
				)
			";
		}

		$sql_where = '';
		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);

		$sql = " SELECT * FROM {$this->user} {$sql_where} ";
		$query = $this->db->query($sql);
		$ret['num_rows'] = $query->num_rows();
		$query = $this->db->query($sql." ORDER BY $sort $order LIMIT $offset,$rows ");
		$ret['result'] = $query->result();
		return $ret;
	}

	function user_exists($str)
	{
		$str = $this->db->escape_str($str);
		$query = $this->db->query(" SELECT * FROM {$this->user} WHERE UCASE(username)=UCASE('$str') ");
		if($query->num_rows() > 0) return TRUE;
		else return FALSE;
	}

	function get_user_by_id($id)
	{
		$id = $this->db->escape_str($id);
		$query = $this->db->query(" SELECT * FROM {$this->user} WHERE uid='$id' ");
		return (OBJECT) $query->row();
	}

	function insert_user($data)
	{
		$data = $this->master_model->escape_all($data);
		$this->db->insert($this->user, $data);
		return $this->db->affected_rows();
	}

	function update_user($data,$id)
	{
		$id = $this->db->escape_str($id);
		$data = $this->master_model->escape_all($data);
		$this->db->where('uid', $id);
		$this->db->update($this->user,$data);
		return $this->db->affected_rows();
	}

	function delete_user($id)
	{
		$id = $this->db->escape_str($id);
		$this->db->where('uid', $id);
		$this->db->delete($this->user);
		return $this->db->affected_rows();
	}

	function get_user_all()
	{
		$query = $this->db->query(" SELECT * FROM {$this->user} ORDER BY nama ASC ");
		return $query->result();
	}

	function get_user_select($init = array())
	{
		$tmp = array();
		if(is_array($init) AND count($init)>0) $tmp = $init;
		$res = $this->get_user_all();
		if(count($res)>0){
			foreach($res as $row){
				$tmp[$row->uid] = ucfirst($row->nama) . ' (' . $row->username . ')';
			}
		}
		return $tmp;
	}

	function get_user_access($id)
	{
		$acc = array();
		$id = $this->db->escape_str($id);
		$query = $this->db->query(" SELECT * FROM {$this->user_access} WHERE uid='$id' ");
		$res = $query->result();
		if(count($res)>0){
			foreach($res as $row){
				$acc[$row->access] = $row->access;
			}
		}
		return $acc;
	}

	function insert_user_access($data)
	{
		$data = $this->master_model->escape_all($data);
		$this->db->insert($this->user_access, $data);
		return $this->db->affected_rows();
	}

	function delete_user_access($id)
	{
		$id = $this->db->escape_str($id);
		$this->db->where('uid', $id);
		$this->db->delete($this->user_access);
		return $this->db->affected_rows();
	}

	function set_cb($field,$uid='')
	{
		if( $uid == '' ){
			$default = '';
		}else{
			$acc = $this->get_user_access($uid);
			if( isset($acc[$field]) ) $default = 'checked';
			else $default = '';
		}
		if($this->input->post()) $default = '';

		$access = $this->input->post('access');
		$ret = isset($access[$field]) ? 'checked' : $default;

		return $ret;
	}

	function do_login($u,$p)
	{
		$u = $this->db->escape_str($u);
		$p = $this->db->escape_str($p);
		$query = $this->db->query(" SELECT * FROM {$this->user} WHERE username='$u' AND password=md5('$p') AND active=1 ");
		if($query->num_rows()>0){
			$cu = $query->row();
			
			$data = array();
			$data['login_status'] = 1;
			$data['current_user'] = $cu->uid;
			$data['privilege']    = $cu->privilege;
			$this->session->set_userdata($data);

			return true;
		}else{
			return false;
		}
	}

	function current_user()
	{
		if($username = $this->session->userdata('current_user'))
		{
			$CU = $this->get_user_by_id($username);
			return $CU;
		}
		else
		{
			return (object) array();
		}
	}

	function is_login()
	{
		if($this->session->userdata('login_status')==1) return TRUE;
		else return FALSE;
	}

	function has_login( $checkAccess = TRUE )
	{
		if($this->session->userdata('login_status')!=1)
		{
			$redirect = isset($_SERVER['REQUEST_URI']) ? base64_encode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) : '';
			$this->session->set_userdata('message','You must log in first to this application. ');
			$this->session->set_userdata('message_type','error');
			redirect(site_url('log/in?redirect='.$redirect));
			die();
		}

		$this->has_access();
	}

	function has_access()
	{
	    $CI =& get_instance();
		$current   = $CI->uri->segment(1).'/'.$CI->uri->segment(2);		
		$akses     = $this->session->userdata('privilege');
		$read_path = $CI->config->item('forbid_page');
	    
		if( (in_array($current, $read_path)) && ($akses=='reporter') ) {
	    	    $this->session->set_userdata('message','Anda tidak diijinkan mengakses / melakukan aksi pada halaman yang anda tuju.<br><br>Silakan hubungi Administrator.');
				$this->session->set_userdata('message_type','error');
				redirect(base_url().$CI->uri->segment(1));
				exit;
	    }
	    
	}

	function logout()
	{
		$this->session->unset_userdata('login_status');
		$this->session->unset_userdata('current_user');
	
		$this->session->set_userdata('message','You have been logout. ');
		$this->session->set_userdata('message_type','info');
		redirect(site_url('/log/in'));
	}
}