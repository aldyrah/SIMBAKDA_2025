<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cmr extends CI_Controller {

	function __construct()
	{	
		parent::__construct();
		$this->load->model('mmr');
	}

  function mr()
    {
        $data['page_title']= 'Manajemen Report';
        $this->template->set('title', 'Manajemen Report');   
        $this->template->load('template','/utilitas/mr',$data) ; 
    }
 function selisih_tgl($cdate1,$cdate2){

            // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
            // dari tanggal pertama
           
           
            $tgl1 = $cdate1;  // 1 Oktober 2009
            $tgl2 = $cdate2;  // 10 Oktober 2009   
            
        $pecah1 = explode("-", $tgl1);
        $date1 = $pecah1[2];
        $month1 = $pecah1[1];
        $year1 = $pecah1[0];
        
        // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
        // dari tanggal kedua
        
        $pecah2 = explode("-", $tgl2);
        $date2 = $pecah2[2];
        $month2 = $pecah2[1];
        $year2 =  $pecah2[0];
        
        // menghitung JDN dari masing-masing tanggal
        
        $jd1 = GregorianToJD($month1, $date1, $year1);
        $jd2 = GregorianToJD($month2, $date2, $year2);
        
        // hitung selisih hari kedua tanggal
        
        $selisih = $jd1 - $jd2;
        return $selisih;   
       
    }
	
     function range() {
        for ($count = 1; $count <=3; $count++)
        {
            $result[]= array(
                     //'range' => $count,
                     'range' => $this->mmr->get_range($count)
                     );    
        }
        echo json_encode($result);
	}
	
	function cetak_mr($ctgl='',$cetak='',$corder='',$csort='',$cspp=''){ 		
        $cRet = $this->mmr->cetak_mr($ctgl,$corder,$csort,$cspp);	
		$data['prev']= $cRet;  
		$data['sikap'] = 'preview';
		$judul = 'LAPORAN MANAJEMEN REPORT';
		$this->template->set('title', 'LAPORAN MANAJEMEN REPORT');  
		switch ($cetak){						
			case 0;
				echo $cRet;
				echo "<title>$judul</title>";
				break;
			case 1;
			//echo $cRet;
				$this->mmr->_mpdf('', $cRet, 10, 10, 10, 'L');  
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


