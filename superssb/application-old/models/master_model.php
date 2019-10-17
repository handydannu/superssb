<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_model extends CI_Model
{
	function __construct(){
		parent::__construct();
		
		$this->tables = array(
			'contents'      => 'contents',
			'channels'      => 'channels',
			'pages'         => 'pages',
			'events'        => 'events',
			'features'      => 'features',
			'inbox'         => 'inbox',
			'sections'      => 'sections',
			'subscribes'    => 'subscribes',
			'types'         => 'types',
			'photos'        => 'photos',
			'photo_album'   => 'photo_album',
			'user'          => 'user',
			'doc'           => 'documents',
			'branch_office' => 'branch_office',
			'cash_office'   => 'cash_office',
			'atm_location'  => 'atm_location',
			'payment_point' => 'payment_point',
			'career'        => 'career',
			'highlight'     => 'highlight'
		);

		/* initialize table name for this class */
		$this->get_tables($this);
	}

	/** Define table name for universal model */

	function get_tables($class)
	{
		if(count($this->tables)>0){
			foreach($this->tables as $key=>$t){
				$class->{$key} = $this->db->dbprefix($t);
			}
		}
	}

	/** Escaping several data in a time	 */

	function escape_all($data)
	{
		if( ! is_array($data) ) return $this->db->escape_str($data);

		$tmp = array();
		if(count($data) > 0){
			foreach($data as $key => $val){
				$tmp[$key] = $this->db->escape_str($val);
			}
		}
		return $tmp;
	}

	/** Get option vars stored in database */

	function get_option($var)
	{
		static $v;
		
		if( ! is_array($v) )
		{
			$v = array();
			$query = $this->db->query(" SELECT * FROM {$this->options} ");
			$result = $query->result();
			if( count($result)>0 )
			{
				foreach($result as $row){
					$v[$row->var] = ($row->val == '') ? $row->default : $row->val;
				}
			}
		}
		
		return isset($v[$this->session->userdata('SERVER').'_'.$var]) ? $v[$this->session->userdata('SERVER').'_'.$var] : NULL;
	}

	/**  Set option vars stored in database */

	function set_option($var,$val='')
	{
		if( is_array($var) )
		{
			$tmp = array();
			if(count($var)>0){
				foreach($var as $k=>$v){
					$k = $this->session->userdata('SERVER').'_'.$this->db->escape_str($k);
					$v = $this->db->escape_str($v);
					$tmp[] = "('$k','$v')";
				}
				
				$data = @implode(',',$tmp);
				$insert_string = " INSERT INTO `{$this->options}` (`var`,`val`) VALUES $data ON DUPLICATE KEY UPDATE val=VALUES(val) ";
				return $this->db->query($insert_string);
			}
			
			return FALSE;
		}
		else
		{
			$query = $this->db->query(" SELECT * FROM {$this->options} WHERE var='$var' ORDER BY var ASC LIMIT 1 ");
			if($query->num_rows()>0)
			{
				$d['val'] = $val;
				$this->db->where('var', $var);
				return $this->db->update($this->options,$d);
			}
			else
			{
				$d['var'] = $this->session->userdata('SERVER').'_'.$var;
				$d['val'] = $val;
				return $this->db->insert($this->options,$d);
			}
		}
	}
}