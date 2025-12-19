<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cmrskpd extends CI_Controller {

	function __construct()
	{	
		parent::__construct();
		$this->load->model('mmr_skpd');
	}

  function mrskpd()
    {
        $data['page_title']= 'Manajemen Report SKPD';
        $this->template->set('title', 'Manajemen Report SKPD');   
        $this->template->load('template','/utilitas/mrskpd',$data) ; 
    }
	
		function config_skpd(){
		$lccr = $this->input->post('q');		
        $sql = "SELECT DISTINCT kd_skpd,nm_skpd FROM  ms_skpd where(upper(kd_skpd) like upper('$lccr%') or nm_skpd like '%$lccr%') ";
        $query1 = $this->db->query($sql);  
		$result = array();
		$test = $query1->num_rows();
		
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(
                        'id' => $ii,        
                        'kd_skpd' => $resulte['kd_skpd'],
                        'nm_skpd' => $resulte['nm_skpd']
                        );
                        $ii++;
        }
		

		
		
        echo json_encode($result);
    	$query1->free_result();   
    }
	
	
	
	function cetak_mr($ctgl='',$cetak='',$cskpd='',$corder='',$csort='',$csppp=''){ 		
        $cRet = $this->mmr_skpd->cetak_mr($ctgl,$cskpd,$corder,$csort,$csppp);	
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
				$this->mmr_skpd->_mpdf('', $cRet, 10, 10, 10, 'L');  
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


