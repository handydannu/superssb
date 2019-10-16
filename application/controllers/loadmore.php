<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loadmore extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('contentdate');

        $this->load->model('contents_model');

         error_reporting(E_ALL);
    }

    public function index()
    {
        echo 'index';
    }

    public function testimoni()
    {
        $rowsperpage = 10;

        if(!empty($_GET["page"])){
            $pagenum = $_GET["page"];
            $offset = ($pagenum - 1) * $rowsperpage;
        } else {
            $pagenum = 1;
            $offset = 0;            
        }

        $output['testimoni']  = $this->contents_model->get_list_testimoni($offset, $rowsperpage);

        $this->load->view('content/vtestimoni_loadmore', $output);
    }

}

/* End of file loadmore.php */