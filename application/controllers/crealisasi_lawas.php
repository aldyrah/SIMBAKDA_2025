<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crealisasi extends CI_Controller {

	function __construct()
	{	
		parent::__construct();
		$this->load->model('mrealisasi');
	}

  function realisasi_apbd()
    {
        $data['page_title']= 'Upload Data';
        $this->template->set('title', 'Realisasi APBD');   
        $this->template->load('template','/utilitas/realisasi_apbd',$data) ; 
    }

	
	function cetak_realisasi_apbd($ctgl='',$capbd='',$cetak=''){ 		
        $cRet = $this->mrealisasi->cetak_realisasi_apbd($ctgl,$capbd);	
		$data['prev']= $cRet;  
		$data['sikap'] = 'preview';
		$judul = 'LAPORAN REALISASI APBD';
		$this->template->set('title', 'LAPORAN REALISASI APBD');  
		switch ($cetak){						
			case 0;
				echo $cRet;
				echo "<title>$judul</title>";
				break;
			case 1;
				$this->mrealisasi->_mpdf('', $cRet, 10, 10, 10, 'L');  
				break;
			case 2;
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename= $judul.xls");
				$this->load->view('utilitas/tampil', $data);
			break;
			case 3;
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd.ms-word");
				header("Content-Disposition: attachment; filename= $judul.doc");
				$this->load->view('utilitas/tampil', $data);
				break;
		}
	

	
	}		
		
}


