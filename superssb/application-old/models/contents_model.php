<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contents_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('datatables_model');

		$this->master_model->get_tables($this);
	}

	function get_articles_datatable($channelID)
	{
		// Select all data where type=1 (1=article) and status not trash
		$typeID = 2; // News
		$channelID = $this->db->escape_str($channelID);	// Berita atau CSR

		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 20;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array("c_channel_id='{$channelID}'", "c_type='{$typeID}'", "c_status !='trash'");
		$sql_where 		= '';
		$cols 			= array("c_publish_date", "", "c_publish_date", "c_title", "c_hits", "c_status", "c_images_thumbnail", "c_channel_id", "c_feature", "c_author");
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

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(c_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_subtitle) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_author_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_status) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_publish_date) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(u.nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(e.nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ch_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);

		// Running Query Total Row
		$sql = " SELECT count(0) as iTotal FROM {$this->contents} c
				LEFT JOIN channels ch ON(ch.ch_id=c.c_channel_id)
				LEFT JOIN features f ON(f.fe_id=c.c_feature)
				LEFT JOIN user u ON(u.uid=c.c_author)
				LEFT JOIN user e ON(e.uid=c.c_editor)
				$sql_where ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Query Grab Data Rows
		$sql = "SELECT 
			c.c_id, c.c_publish_date, c.c_subtitle, c.c_title, c.c_slug, c.c_images_thumbnail, c.c_author, c.c_author_name, c.c_hits, c.c_status, c.c_created_date, c.c_is_editing, c_content_type, c_youtube_id,
			ch.ch_id, ch.ch_name,
			f.fe_id, f.fe_name,
			u.nama as authorName,
			e.nama as editorName
			FROM {$this->contents} c
			LEFT JOIN channels ch ON(ch.ch_id=c.c_channel_id)
			LEFT JOIN features f ON(f.fe_id=c.c_feature)
			LEFT JOIN user u ON(u.uid=c.c_author)
			LEFT JOIN user e ON(e.uid=c.c_editor)
			$sql_where 
		";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query = $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data  = $query->result();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}

		//echo $this->db->last_query();
		
        // * Output         
        $output = array(
             "sEcho" => $this->datatables_model->get_echo(),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => $data
        );

        $query->free_result();

		return json_encode($output);
	}

	public function insert_content($data)
	{
		$data = $this->master_model->escape_all($data);

		$this->db->insert($this->contents, $data);
		return $this->db->insert_id();
	}

	function get_content_by($id)
	{
		$id = $this->db->escape_str($id);
		
		$this->db->select('*');
		$this->db->from($this->contents);
		$this->db->where('c_id', $id);
		$sql = $this->db->get();

		return $sql->row_array();
	}

	function update_content($data,$id)
	{
		$id = $this->db->escape_str($id);
		//$data = $this->master_model->escape_all($data);
		$this->db->where('c_id', $id);
		$this->db->update($this->contents,$data);
		return $this->db->affected_rows();
	}

	// -------- MY ARTICLES ------------
	function get_myarticles_datatable($authorID)
	{
		// Select all data where type=1 (1=article) and status not trash

		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 20;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array("c_type='1'", "c_status !='trash'", "c_author='{$authorID}'"); // 1.article
		$sql_where 		= '';
		$cols 			= array( "c_publish_date" );
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
		$sql = " SELECT count(0) as iTotal FROM {$this->contents} where c_type='1' AND c_status !='trash' AND c_author='{$authorID}' "; 	// 1.article

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(c_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_subtitle) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_author_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_status) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_publish_date) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(u.nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(e.nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ch_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

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
			$sql_where 
		";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query = $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data  = $query->result();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}

		// echo $this->db->last_query();
		
        // * Output         
        $output = array(
             "sEcho" => $this->datatables_model->get_echo(),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => $data
        );

        $query->free_result();

		return json_encode($output);
	}


	// --------- LOCKED ARTICLE ----------
	function get_locked_articles()
	{
		// Select all data where type= all and status not trash and c_is_editing=1

		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 20;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array("c_status !='trash'", "c_is_editing=1");
		$sql_where 		= '';
		$cols 			= array( "c_id" );
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
		$sql = " SELECT count(0) as iTotal FROM {$this->contents} where c_status !='trash' AND c_is_editing='1' "; 	// 1.article

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(c_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_subtitle) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_author_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_status) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_publish_date) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(u.nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(e.nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

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
			$sql_where 
		";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query = $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data  = $query->result();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}

		//echo $this->db->last_query();
		
        // * Output         
        $output = array(
             "sEcho" => $this->datatables_model->get_echo(),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => $data
        );

        $query->free_result();

		return json_encode($output);
	}

	function set_post_editing($ID,$flag='1')
	{
		$data = array('c_is_editing' => $flag);
		$insert_id = $this->db->insert("posts_editing",$data);
		return $insert_id;
	}

	// ---------- TRASH ------------
	
	function get_trash_data()
	{
		// Select all data where status trash

		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 20;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array("c_status = 'trash'");
		$sql_where 		= '';
		$cols 			= array( "c_id" );
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
		$sql = " SELECT count(0) as iTotal FROM {$this->contents} where c_status ='trash' ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(c_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_subtitle) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_author_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_status) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_publish_date) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(u.nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(e.nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

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
			$sql_where 
		";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query = $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data  = $query->result();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}

		//echo $this->db->last_query();
		
        // * Output         
        $output = array(
             "sEcho" => $this->datatables_model->get_echo(),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => $data
        );

        $query->free_result();

		return json_encode($output);
	}

	// ----- Delete from Trash page -----
	function delete_content_by($id)
	{
		$id = $this->db->escape_str($id);
		$this->db->where('c_id', $id);
		$this->db->delete($this->contents);
		return $this->db->affected_rows();
	}
	

	public function publish($artikel_id)
	{
		$artikel_id = $this->db->escape_str($artikel_id);
		
		$this->db->where('c_id', $artikel_id);
		$this->db->set('c_status', 'publish');
		$this->db->update($this->contents);
		return $this->db->affected_rows();
	}

	function get_video_datatable()
	{
		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 20;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array("c_content_type='video'", "c_status !='trash'");
		$sql_where 		= '';
		$cols 			= array("c_publish_date", "", "c_publish_date", "c_title", "c_hits", "c_status", "c_images_thumbnail", "c_channel_id", "c_feature", "c_author");
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

		// Kolom Pencarian
		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(c_title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_subtitle) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_author_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_status) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(c_publish_date) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(u.nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(e.nama) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(ch_name) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);

		// Running Query Total Row
		$sql = " SELECT count(0) as iTotal 
				FROM {$this->contents} c
				LEFT JOIN channels ch ON(ch.ch_id=c.c_channel_id)
				LEFT JOIN features f ON(f.fe_id=c.c_feature)
				LEFT JOIN user u ON(u.uid=c.c_author)
				LEFT JOIN user e ON(e.uid=c.c_editor)
				$sql_where ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		$q->free_result();

		// Query Grab Data Rows
		$sql = "SELECT 
			c.c_id, c.c_publish_date, c.c_subtitle, c.c_title, c.c_slug, c.c_images_thumbnail, c.c_author, c.c_author_name, c.c_hits, c.c_status, c.c_created_date, c.c_is_editing, c_content_type, c_youtube_id,
			ch.ch_id, ch.ch_name,
			f.fe_id, f.fe_name,
			u.nama as authorName,
			e.nama as editorName
			FROM {$this->contents} c
			LEFT JOIN channels ch ON(ch.ch_id=c.c_channel_id)
			LEFT JOIN features f ON(f.fe_id=c.c_feature)
			LEFT JOIN user u ON(u.uid=c.c_author)
			LEFT JOIN user e ON(e.uid=c.c_editor)
			$sql_where 
		";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query = $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data  = $query->result();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}

		//echo $this->db->last_query();
		
        // * Output         
        $output = array(
             "sEcho" => $this->datatables_model->get_echo(),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => $data
        );

        $query->free_result();

		return json_encode($output);
	}

	// ======================================

}