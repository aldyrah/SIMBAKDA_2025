<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdata extends CI_Model {

	function getall($strquery,$baseurl) {
        //$string_query   = "select * from ms_kategori order by id_kategori";  
        $query          = $this->db->query($strquery);              
        $config['base_url']     = site_url().$baseurl;  
        $config['total_rows']   = $query->num_rows();  
        $config['per_page']     = '5';
        $num            = $config['per_page'];  
        $offset         = $this->uri->segment(3);  
        $offset         = ( ! is_numeric($offset) || $offset < 1) ? 0 : $offset;  
          
        if(empty($offset))  
        {  
            $offset=0;  
        }  
          
        $this->pagination->initialize($config);         
          
        $data['query']      = $this->db->query($strquery." limit $offset,$num");    
        $data['base']       = $this->config->item('base_url');  
      
        return $data;  
	}
	function getnumrow($query) {
		$res = $this->db->query($query);
		return $res->num_rows();
	}
	function getdata($where,$table) {
		if (!empty($where) or $where!=='') {
	   		$this->db->where($where);
	   	}
	   $res = $this->db->get($table);
	   return $res;
	}
	function update($data,$where,$table) {
    	if (!empty($where) or $where!=='') {
	   		$this->db->where($where);
	   	}
	   $this->db->update($table,$data);	
	}
	function delete($id,$table)
	{
		if (!empty($id) or $id!=='') {
	   		$this->db->where($id);
	   	}
	   $this->db->delete($table);
	}
	function save($data,$table) {
		$this->db->insert($table,$data);
	}
	function viewdata($query){
		$res = $this->db->query($query);
		return $res;
	}
	
	function check_id($id,$table) {
		$cond = true;
		if (!empty($id) or $id!=='') {
	   		$this->db->where($id);
	   	}
		$res = $this->db->get($table);

		if($res->num_rows() > 0) {
			$cond = false;
		}
		return $cond;
	}
	
	function terbilang1($number) {
	    $this->dasar = array(1 => 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam','Tujuh', 'Delapan', 'Sembilan');
	    $this->angka = array(1000000000, 1000000, 1000, 100, 10, 1);
	    $this->satuan = array('Milyar', 'juta', 'ribu', 'ratus', 'puluh', '');
	 
	    $i = 0;
	    if($number==0)	{
	    	$str = "nol";
	    }else{
			$str = "";
	       	while ($number != 0) {
	        	$count = (int)($number/$this->angka[$i]);
	      		if($count >= 10) {
	          		$str .= $this->terbilang($count). " ".$this->satuan[$i]." ";
	      		}else if($count > 0 && $count < 10){
	          		$str .= $this->dasar[$count] . " ".$this->satuan[$i]." ";
	      		}
			  	$number -= $this->angka[$i] * $count;
			  	$i++;
		   }
		   $str = preg_replace("/Satu Puluh (\w+)/i", "\\1 Belas", $str);
		   $str = preg_replace("/Satu (ribu|ratus|puluh|belas)/i", "Se\\1", $str);
		}
		$string = $str.'';
    	return $string;
  	} 


	
	
	function terbilang($number) {
   
    $hyphen      = ' ';
    $conjunction = ' ';
    $separator   = ' ';
    $negative    = 'minus ';
    $decimal     = ' koma ';
    $dictionary  = array(0 => 'Nol',1 => 'Satu',2 => 'Dua',3 => 'Tiga',4 => 'Empat',5 => 'Lima',6 => 'Enam',7 => 'Tujuh',
        8 => 'Delapan',9 => 'Sembilan',10 => 'Sepuluh',11  => 'Sebelas',12 => 'Dua belas',13 => 'Tiga belas',14 => 'Empat belas',
        15 => 'Lima Belas',16 => 'Enam Belas',17 => 'Tujuh Belas',18 => 'Delapan Belas',19 => 'Sembilan Belas',20 => 'Dua Puluh',
        30 => 'Tiga Puluh',40 => 'Empat Puluh',50 => 'Lima Puluh',60 => 'Enam Puluh',70 => 'Tujuh Puluh',80 => 'Delapan Puluh',
        90 => 'Sembilan Puluh',100 => 'Ratus',1000 => 'Ribu',1000000 => 'Juta',1000000000 => 'Milyar',1000000000000 => 'Triliun',
    );
   
    if (!is_numeric($number)) {
        return false;
    }
   
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'terbilang only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . $this->terbilang(abs($number));
    }
   
    $string = $fraction = null;
   
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
   
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . $this->terbilang($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = $this->terbilang($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= $this->terbilang($remainder);
            }
            break;
    }
   
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
   
    return $string;
    }
	
	  function _mpdf3($judul='',$isi='',$lMargin='',$rMargin='',$font=0,$orientasi='',$kertas='',$tmargin='') {
        
        ini_set("memory_limit","-1");
        $this->load->library('mpdf');
        
        
        $this->mpdf->defaultheaderfontsize = 6;	/* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 6;	/* in pts */
        $this->mpdf->defaultfooterfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 1; 
        $this->mpdf->SetLeftMargin = $lMargin;
        $this->mpdf->SetRightMargin = $rMargin;
        $this->mpdf->SetTopMargin($tmargin);
        $this->mpdf->SetFont = $font;
        $this->mpdf->_setPageSize($kertas,$orientasi);
		$jam = date("H:i:s");
      //  $this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Halaman {PAGENO} / {nb}| ');
        
        $this->mpdf->AddPage($orientasi,'','','','',$lMargin,$rMargin);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output('pdf/cetak.pdf','I');
               
    }
    
	function conn($query){
    $this->userconn = $this->load->database('simakda', TRUE);
    $res = $this->userconn->query($query);
    return $res;
	}
    
	
 
}
