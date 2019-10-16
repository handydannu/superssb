<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kalkulator extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		//_d($_POST);
		$c['top_css']   = '';
		$c['top_js']    = '';
		$c['bottom_js'] = '';

		if ($this->config->item('production')) {
            error_reporting(0);

            $c['top_js'] .= google_analytics();
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
        }

		if ((isset ($_POST['calc'])) and ($_POST['waktu']<> "") and ($_POST['bunga']<>"" ) and ($_POST['kredit']<>"") and ($_POST['tipebunga']=='anuitas') ) {

			//echo 'masuk Anuitas';
		
		}elseif ((isset ($_POST['calc'])) and ($_POST['waktu']<> "") and ($_POST['bunga']<>"" ) and ($_POST['kredit']<>"") and ($_POST['tipebunga']=='efektif') ) {

			// echo 'masuk Efektif'; exit;
			
			$pinjaman = $_POST['kredit'];
			$lama     = $_POST['waktu'];
			$bunga    = $_POST['bunga'];
			$bpt      = ($pinjaman*($bunga/100)) / 12; 
			$pokok    = $pinjaman/$lama;

			$jml_angsuran = '';	// dihitung di view saat looping

		}elseif ((isset ($_POST['calc'])) and ($_POST['waktu']<> "") and ($_POST['bunga']<>"" ) and ($_POST['kredit']<>"") and ($_POST['tipebunga']='flat') ) {

			// echo 'masuk Flat'; exit;

			$pinjaman = $_POST['kredit'];
			$lama     = $_POST['waktu'];
			$bunga    = $_POST['bunga'];
			$bpt      = ($pinjaman*($bunga/100)) / 12; 
			$pokok    = $pinjaman/$lama;

			$jml_angsuran = $pokok + $bpt;
		}else{

		}

		$c['pinjaman']       = $pinjaman;
		$c['lama']           = $lama;
		$c['bunga']          = $bunga;
		$c['angsuran_pokok'] = $pokok;
		$c['angsuran_bunga'] = $bpt;
		$c['angsuran_total'] = $jml_angsuran;
		$c['EDIT']           = $_POST;

		$mainData['navigation']   = $this->load->view('template/vnavigation', NULL, TRUE);
		$mainData['main_content'] = $this->load->view('content/vkalkulator', $c, TRUE);
		$mainData['footer']       = $this->load->view('template/vfooter', NULL, TRUE);
		
		$this->load->view('vbase', $mainData);
	}

}

/* End of File Kalkulator.php */