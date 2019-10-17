<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Distributor_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		// table
		$this->master_model->get_tables($this);
	}
	

	function get_distributor_dt($channelID)
	{
		// ---- Get All show as Json ----

		$channel_id = "dist_channel_id='{$channelID}'";
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 20;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array($channel_id);
		$sql_where 		= '';
		$cols 			= array( "dist_id" );
		$sort 			= "desc";
		
		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		// limit
		$start    = $this->datatables_model->get_start();
		$rows     = $this->datatables_model->get_rows();
		// sort
		$sort     = $this->datatables_model->get_sort($cols);
		$sort_dir = $this->datatables_model->get_sort_dir();
		        
        // Running Query Total Row
		$sql = " SELECT count(0) as iTotal FROM {$this->distributor} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(dist_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(dist_city) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(dist_address_1) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(dist_address_2) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(dist_address_3) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(dist_market_area) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(prov_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT * FROM {$this->distributor}
				LEFT JOIN {$this->province} p ON (prov_id=dist_province_id) $sql_where ";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query = $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data  = $query->result_array();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}

        $query->free_result();

        // query Province
        $sql_p = "SELECT prov_id, prov_name FROM {$this->province}";
        $query = $this->db->query($sql_p);
        $propinsi = $query->result_array();
        $query->free_result();
		
		// ----- START Looping dapatkan nama provinsi sesuai market area ------
		$loop = count($data);
		if ($loop > 0)
		{

	        for ($i=0; $i < $loop; $i++) { 
				$nama_prov = array();
				$tmp       = array();

				$market_id    = explode(',', $data[$i]['dist_market_area']);
				$total_market = count($market_id);

	        	if ($total_market > 0){
	        		for ($j=0; $j < $total_market; $j++) { 
		        		$is_found = $this->in_array_r($propinsi, 'prov_id', $market_id[$j]);
		        		$nama_prov[] = $is_found;
		        	}	
	        	}

	        	$nama_prov = implode(', ', $nama_prov);
	        	$tmp['wilayah_pemasaran']= $nama_prov;
	        	$gabung = array_merge($data[$i], $tmp);
	        	// print_r(array_merge($data[$i], $tmp));

	        	$final_data[$i] = $gabung;
	        }
	        // ------ END Looping -------
	    }else{
	    	$final_data = $data;
	    }

        /*_d($final_data);
        exit;*/

        // * Output         
        $output = array(
             "sEcho" => $this->datatables_model->get_echo(),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => $final_data
        );


		return json_encode($output);
	}

	public function insert_new_distributor($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->distributor, $data);
		return $this->db->insert_id();
	}

	public function update_distributor($data, $ID)
	{
		$ID   = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('dist_id', $ID);
		$this->db->update($this->distributor, $data);
		return $this->db->affected_rows();
	}

	public function delete_distributor($id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete($this->distributor, array('dist_id'=>$id));
	}

	function get_distributor_by($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->distributor);
		$this->db->where('dist_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	// PROVINSI
	function get_allprovince()
	{
		$query = $this->db->get($this->province);
		$ret = $query->result_array();

		$query->free_result();
		return $ret;
	}

	// Dapatkan Nama provinsi di dalam array multidimensi
	public function in_array_r($array, $field, $find){
		$tmp = array();
	    foreach($array as $item){
	        if($item[$field] == $find){ 
	        $tmp = $item['prov_name'];
	        // echo "array ->".$item['prov_name']."<br />";
		    }
	    }
	    return $tmp;
	}

	function get_all_distributor()
	{
		$this->db->select('dist_id, dist_name');
		$this->db->from($this->distributor);
		$this->db->where('dist_status', '1');
		$query = $this->db->get();
		$hasil = $query->result_array();
		$query->free_result();
		return $hasil;
	}

	// ==================== SUB DISTRIBUTOR ===========================
	public function insert_subdistributor($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->sub_distributor, $data);
		return $this->db->insert_id();
	}

	function get_subdistributor()
	{
		// ---- Get All show as Json ----
		
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 20;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$order          = '';
		$cols 			= array( "sd_id" );
		$sort 			= "desc";
		
		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		// limit
		$start    = $this->datatables_model->get_start();
		$rows     = $this->datatables_model->get_rows();
		// sort
		$sort     = $this->datatables_model->get_sort($cols);
		$sort_dir = $this->datatables_model->get_sort_dir();
		        
        // Running Query Total Row
		$sql = " SELECT count(0) as iTotal FROM {$this->sub_distributor} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(sd_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR
					UCASE(sd_city) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = "SELECT sd_id, sd_name, sd_city, sd_address, sd_pic, sd_telp, sd_hp, sd_distributor_id, sd_status, 
				dist_name
				FROM {$this->sub_distributor} s
				LEFT JOIN {$this->distributor} d ON (d.dist_id=s.sd_distributor_id)
				$sql_where ";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query = $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data  = $query->result_array();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}

        $query->free_result();

        // * Output         
        $output = array(
             "sEcho" => $this->datatables_model->get_echo(),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => $data
        );


		return json_encode($output);
	}

	function get_subdistributor_by($id)
	{
		$id = $this->db->escape_str($id);

		$this->db->select('*');
		$this->db->from($this->sub_distributor);
		$this->db->where('sd_id', $id);
		$prod = $this->db->get();

		return $prod->row_array();
	}

	public function update_subdistributor($data, $ID)
	{
		$ID   = $this->db->escape_str($ID);
		$data = $this->master_model->escape_all($data);

		$this->db->where('sd_id', $ID);
		$this->db->update($this->sub_distributor, $data);
		return $this->db->affected_rows();
	}

	public function delete_subdistributor($id)
	{
		$id = $this->db->escape_str($id);
		return $this->db->delete($this->sub_distributor, array('sd_id'=>$id));
	}


}
