<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdata2 extends CI_Model {

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
	
	function _mpdf($judul='',$isi='',$lMargin='',$rMargin='',$font=0,$orientasi='') {
        
        ini_set("memory_limit","512M");
        $this->load->library('mpdf');
        
        
        $this->mpdf->defaultheaderfontsize = 6;	/* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */
        //$this->mpdf->SetDefaultFontSize=$font;
        $this->mpdf->defaultfooterfontsize = 6;	/* in pts */
        $this->mpdf->defaultfooterfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 1; 
        $this->mpdf->SetLeftMargin = $lMargin;
        $this->mpdf->SetRightMargin = $rMargin;
        $jam = date("H:i:s");
        $this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Halaman {PAGENO} / {nb}| ');
        $this->mpdf->SetFont('','',34,true,true);
       //$this->mpdf->getPageFormat(A4);
        $this->mpdf->AddPage($orientasi);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output();
               
    }
	
    function get_nama($kode,$hasil,$tabel,$field)
	{
        $this->db->select($hasil);
		$this->db->where($field, $kode);
		$q = $this->db->get($tabel);
		$data  = $q->result_array();
		$baris = $q->num_rows();
		return $data[0][$hasil];
	}

	function getConfig($field){
		$hasil='';
		$csql = " select * FROM config ";
		$query1 = $this->db->query($csql);  
        foreach($query1->result_array() as $resulte)
        {	
			$hasil=$resulte[$field];
		}	
		return $hasil;
	}

function ambil_config(){

        $csql = " select * from config ";
        $query1 = $this->db->query($csql);  
        foreach($query1->result_array() as $resulte)
        { 
            $resulte = array(              
                         'nm_client' => $resulte['nm_client'],                                              					
                         'kepala' => $resulte['kepala'],                                              					
                         'nip_kepala'=> $resulte['nip_kepala'],                                              					
                         'pkt_kepala' => $resulte['pkt_kepala'],
                         'nama_bendahara' => $resulte['nama_bendahara'],
                         'nip_bendahara' => $resulte['nip_bendahara'],
                         'pkt_bendahara' => $resulte['pkt_bendahara'],
                         'lprint' => $resulte['lprint'],
                         'kota' => $resulte['kota'],
                         'logo' => $resulte['logo']                                                                       					
                         );
        }
	   
       $query1->free_result(); 
	   return $resulte;        	
	}
	function getObjPajak($field,$prop,$kab,$kec,$lurah,$blok,$urut,$jns){
		$hasil='';
		$csql = " select * FROM dat_objek_pajak where kd_propinsi='$prop' and kd_dati2='$kab' and kd_kecamatan='$kec' and kd_kelurahan='$lurah' and kd_blok='$blok' and no_urut='$urut' and kd_jns_op='$jns' ";
		$query1 = $this->db->query($csql);  
        foreach($query1->result_array() as $resulte)
        {	
			$hasil=$resulte[$field];
		}	
		return $hasil;
	}


	function getSubjekPajak($field,$id){
		$hasil='';
		$csql = " select * FROM dat_subjek_pajak where subjek_pajak_id='$id' ";
		$query1 = $this->db->query($csql);  
        foreach($query1->result_array() as $resulte)
        {	
			$hasil=$resulte[$field];
		}	
		return $hasil;
	}

	function getNir($kdznt,$prop,$kab,$kec,$lurah,$tahun){
		$hasil=0;
		$csql = " select * FROM dat_nir where kd_propinsi='$prop' and kd_dati2='$kab' and kd_kecamatan='$kec' and kd_kelurahan='$lurah' and thn_nir_znt='$tahun' and kd_znt='$kdznt' ";
		$query1 = $this->db->query($csql);  
        foreach($query1->result_array() as $resulte)
        {	
			$nir  =$resulte['nir'];
			$hasil=$this->getKelasTanah($nir,$tahun);
		}	
		return $hasil;
	}

	function getKelasTanah($nir,$tahun){
		$hasil='';
		$csql = " SELECT * FROM kelas_tanah WHERE (thn_awal_kls_tanah<='$tahun' and thn_akhir_kls_tanah>='$tahun' ) AND (nilai_min_tanah<=$nir AND nilai_max_tanah>=$nir) ";
		$query1 = $this->db->query($csql);  
        foreach($query1->result_array() as $resulte)
        {	
			$hasil=$resulte['kd_kls_tanah'];
		}	
		return $hasil;
	}

	function get_op_bangunan($field,$prop,$kab,$kec,$lurah,$blok,$urut,$jns){
		$hasil='';
		$csql = " select $field FROM dat_op_bangunan where kd_propinsi='$prop' and kd_dati2='$kab' and kd_kecamatan='$kec' and kd_kelurahan='$lurah' and kd_blok='$blok' and no_urut='$urut' and kd_jns_op='$jns' ";
		$query1 = $this->db->query($csql);  
        foreach($query1->result_array() as $resulte)
        {	
			$hasil=$resulte[$field];
		}	
		return $hasil;
	}

	function get_op_bumi($field,$prop,$kab,$kec,$lurah,$blok,$urut,$jns){
		$hasil='';
		$csql = " select $field FROM dat_op_bumi where kd_propinsi='$prop' and kd_dati2='$kab' and kd_kecamatan='$kec' and kd_kelurahan='$lurah' and kd_blok='$blok' and no_urut='$urut' and kd_jns_op='$jns' ";
		$query1 = $this->db->query($csql);  
        foreach($query1->result_array() as $resulte)
        {	
			$hasil=$resulte[$field];
		}	
		return $hasil;
	}
    
    function  getBulan($bln){
        switch  ($bln){
        case  1:
        return  "Januari";
        break;
        case  2:
        return  "Februari";
        break;
        case  3:
        return  "Maret";
        break;
        case  4:
        return  "April";
        break;
        case  5:
        return  "Mei";
        break;
        case  6:
        return  "Juni";
        break;
        case  7:
        return  "Juli";
        break;
        case  8:
        return  "Agustus";
        break;
        case  9:
        return  "September";
        break;
        case  10:
        return  "Oktober";
        break;
        case  11:
        return  "November";
        break;
        case  12:
        return  "Desember";
        break;
    }
    }
    
    function  tanggal_format_indonesia($tgl){
            
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this-> getBulan($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2].' '.$bulan.' '.$tahun;

    }

  function terbilang($number) {
	    $this->dasar = array(1 => 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam','Tujuh', 'Delapan', 'Sembilan');
	    $this->angka = array(1000000000, 1000000, 1000, 100, 10, 1);
	    $this->satuan = array('Milyar', 'Juta', 'Ribu', 'ratus', 'Puluh', '');
	 
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
		   $str = preg_replace("/Satu Puluh (\w+)/i", "\\1 belas", $str);
		   $str = preg_replace("/Satu (ribu|ratus|puluh|belas)/i", "Se\\1", $str);
		}
		$string = $str.'';
    	return $string;
  	} 




 //   function terbilang($number) {//
//   
//    $hyphen      = ' ';
//    $conjunction = ' ';
//    $separator   = ' ';
//    $negative    = 'minus ';
//    $decimal     = ' koma ';
//    $dictionary  = array(0 => 'nol',1 => 'Satu',2 => 'Dua',3 => 'Tiga',4 => 'Empat',5 => 'Lima',6 => 'Enam',7 => 'Tujuh',
//        8 => 'Delapan',9 => 'Sembilan',10 => 'Sepuluh',11  => 'Sebelas',12 => 'Dua belas',13 => 'Tiga belas',14 => 'Empat belas',
//        15 => 'Lima belas',16 => 'Enam belas',17 => 'Tujuh belas',18 => 'Delapan Belas',19 => 'Sembilan Belas',20 => 'Dua Puluh',
//        30 => 'Tiga Puluh',40 => 'Empat Puluh',50 => 'Lima Puluh',60 => 'Enam Puluh',70 => 'Tujuh Puluh',80 => 'Delapan Puluh',
//        90 => 'Sembilan Puluh',100 => 'Ratus',1000 => 'Ribu',1000000 => 'Juta',1000000000 => 'Milyar',1000000000000 => 'Triliun',
//    );
//   
//    if (!is_numeric($number)) {
//        return false;
//    }
//   
//    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
//        // overflow
//        trigger_error(
//            'terbilang only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
//            E_USER_WARNING
//        );
//        return false;
//    }
//
//    if ($number < 0) {
//        return $negative . $this->terbilang(abs($number));
//    }
//   
//    $string = $fraction = null;
//   
//    if (strpos($number, '.') !== false) {
//        list($number, $fraction) = explode('.', $number);
//    }
//   
//    switch (true) {
//        case $number < 21:
//            $string = $dictionary[$number];
//            break;
//        case $number < 100:
//            $tens   = ((int) ($number / 10)) * 10;
//            $units  = $number % 10;
//            $string = $dictionary[$tens];
//            if ($units) {
//                $string .= $hyphen . $dictionary[$units];
//            }
//            break;
//        case $number < 1000:
//            $hundreds  = $number / 100;
//            $remainder = $number % 100;
//            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
//            if ($remainder) {
//                $string .= $conjunction . $this->terbilang($remainder);
//            }
//            break;
//        default:
//            $baseUnit = pow(1000, floor(log($number, 1000)));
//            $numBaseUnits = (int) ($number / $baseUnit);
//            $remainder = $number % $baseUnit;
//            $string = $this->terbilang($numBaseUnits) . ' ' . $dictionary[$baseUnit];
//            if ($remainder) {
//                $string .= $remainder < 100 ? $conjunction : $separator;
//                $string .= $this->terbilang($remainder);
//            }
//            break;
//    }
//   
//    if (null !== $fraction && is_numeric($fraction)) {
//        $string .= $decimal;
//        $words = array();
//        foreach (str_split((string) $fraction) as $number) {
//            $words[] = $dictionary[$number];
//        }
//        $string .= implode(' ', $words);
//    }
//   
//    return $string;
//    }
    
	function balikTgl($tgl){
		if (trim($tgl)=='') $tgl='00-00-0000';
		$tgl=str_replace("-","/",$tgl);
		$a=explode('/',$tgl);
		$b=$a[2].'-'.$a[1].'-'.$a[0];
		return $b;
	}

	function getTarif($prop,$kab,$tahun_pajak,$vnjop){

		$hasil=100;
		$csql = " select nilai_tarif from tarif where kd_propinsi = $prop and kd_dati2 = $kab
				  and thn_awal <= $tahun_pajak and thn_akhir >= $tahun_pajak and njop_min <=$vnjop and njop_max >=$vnjop  ";
		$query1 = $this->db->query($csql);  
        foreach($query1->result_array() as $resulte)
        {	
			$hasil=$resulte['nilai_tarif'];
		}	
		return $hasil;
	}

	function getnjoptkp($prop,$kab,$kec,$lurah,$blok,$urut,$jns,$tahun){

		$hasil=0;
		$csql = " select * from dat_subjek_pajak_njoptkp where kd_propinsi = $prop and kd_dati2 = $kab and kd_kecamatan='$kec' and kd_kelurahan='$lurah' and kd_blok='$blok' and no_urut='$urut' and kd_jns_op='$jns' and thn_njoptkp='$tahun' ";
		$query1 = $this->db->query($csql);  
        $i=0;
		foreach($query1->result_array() as $resulte)
        {	
	        $i++;
		}	
		
		if ($i>0){
			$csql = " select * from njoptkp where kd_propinsi = $prop and kd_dati2 = $kab and thn_awal<='$tahun' and thn_akhir>='$tahun' ";
			$query1 = $this->db->query($csql);  
			foreach($query1->result_array() as $resulte)
			{	
				$hasil=$resulte['nilai_njoptkp'];
			}	
		
		}

		return $hasil;
	}
	/******EXPORT DATA TO EXCEL****/
	function export_kib_a(){
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$lctgl1 	= $_REQUEST['lctgl1'];
		$lctgl2 	= $_REQUEST['lctgl2'];
		$iz	 		= $_REQUEST['fa'];
		//		cbid,kib,cskpd,cnmskpd,cnm_bid,lctgl1,lctgl2
$cRet = "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
    $cRet .="<thead>
            <tr>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_reg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">id_barang</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_oleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_reg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_oleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_dokumen</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_brg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_brg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">status_tanah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kondisi</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">asal</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">dsr_peroleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_sertifikat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_sertifikat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">luas</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">nilai</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">jumlah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">total</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">penggunaan</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat1</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat3</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_mutasi</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_pindah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_hapus</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">keterangan</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_lokasi2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">milik</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">wilayah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_skpd</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_unit</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">username</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_update</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tahun</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto1</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto3</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto4</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_urut</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lon</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_riwayat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_riwayat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_riwayat</td>
            </tr>
            </thead>";

                    $csql = "select * from trkib_a where kd_skpd='$cskpd' and kd_unit='$cbid'";
							 $hasil = $this->db->query($csql);
							 $i		= 0;
							 foreach ($hasil->result() as $row)
							 {
								$cRet .="
								<tr>
								
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->id_barang</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_dokumen</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->status_tanah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kondisi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->asal</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->dsr_peroleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_sertifikat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_sertifikat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->luas</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->nilai</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->jumlah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->total</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->penggunaan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat1</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat3</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_mutasi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_pindah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_hapus</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->keterangan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_lokasi2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->milik</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->wilayah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_skpd</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_unit</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->username</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_update</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tahun</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto1</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto3</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto4</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_urut</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lon</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_riwayat</td>
								</tr>
								";$i++;}
			$cRet .=       " </table>";
			$data['prev']= $cRet;
			$judul  = 'Sheet1';
			$this->template->set('title', 'Sheet1');  

            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
    }
	
	function export_kib_b(){
			$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$lctgl1 	= $_REQUEST['lctgl1'];
		$lctgl2 	= $_REQUEST['lctgl2'];
		$iz	 		= $_REQUEST['fa'];
		//		cbid,kib,cskpd,cnmskpd,cnm_bid,lctgl1,lctgl2
$cRet = "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
    $cRet .="<thead>
            <tr>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_reg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">id_barang</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_oleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_reg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_oleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_dokumen</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_brg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_brg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">status_tanah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kondisi</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">asal</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">dsr_peroleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_sertifikat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_sertifikat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">luas</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">nilai</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">jumlah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">total</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">penggunaan</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat1</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat3</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_mutasi</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_pindah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_hapus</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">keterangan</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_lokasi2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">milik</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">wilayah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_skpd</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_unit</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">username</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_update</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tahun</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto1</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto3</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto4</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_urut</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lon</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_riwayat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_riwayat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_riwayat</td>
            </tr>
            </thead>";

                    $csql = "select * from trkib_a where kd_skpd='$cskpd' and kd_unit='$cbid'";
							 $hasil = $this->db->query($csql);
							 $i		= 0;
							 foreach ($hasil->result() as $row)
							 {
								$cRet .="
								<tr>
								
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->id_barang</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_dokumen</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->status_tanah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kondisi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->asal</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->dsr_peroleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_sertifikat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_sertifikat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->luas</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->nilai</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->jumlah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->total</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->penggunaan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat1</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat3</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_mutasi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_pindah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_hapus</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->keterangan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_lokasi2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->milik</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->wilayah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_skpd</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_unit</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->username</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_update</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tahun</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto1</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto3</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto4</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_urut</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lon</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_riwayat</td>
								</tr>
								";$i++;}
			$cRet .=       " </table>";
			$data['prev']= $cRet;
			$judul  = 'Sheet1';
			$this->template->set('title', 'Sheet1');  

            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.sql");
            $this->load->view('transaksi/excel', $data);
	}
	function export_kib_c(){
			$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$lctgl1 	= $_REQUEST['lctgl1'];
		$lctgl2 	= $_REQUEST['lctgl2'];
		$iz	 		= $_REQUEST['fa'];
		//		cbid,kib,cskpd,cnmskpd,cnm_bid,lctgl1,lctgl2
$cRet = "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
    $cRet .="<thead>
            <tr>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_reg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">id_barang</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_oleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_reg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_oleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_dokumen</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_brg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_brg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">status_tanah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kondisi</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">asal</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">dsr_peroleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_sertifikat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_sertifikat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">luas</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">nilai</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">jumlah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">total</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">penggunaan</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat1</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat3</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_mutasi</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_pindah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_hapus</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">keterangan</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_lokasi2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">milik</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">wilayah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_skpd</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_unit</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">username</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_update</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tahun</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto1</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto3</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto4</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_urut</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lon</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_riwayat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_riwayat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_riwayat</td>
            </tr>
            </thead>";

                    $csql = "select * from trkib_a where kd_skpd='$cskpd' and kd_unit='$cbid'";
							 $hasil = $this->db->query($csql);
							 $i		= 0;
							 foreach ($hasil->result() as $row)
							 {
								$cRet .="
								<tr>
								
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->id_barang</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_dokumen</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->status_tanah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kondisi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->asal</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->dsr_peroleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_sertifikat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_sertifikat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->luas</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->nilai</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->jumlah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->total</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->penggunaan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat1</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat3</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_mutasi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_pindah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_hapus</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->keterangan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_lokasi2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->milik</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->wilayah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_skpd</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_unit</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->username</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_update</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tahun</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto1</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto3</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto4</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_urut</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lon</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_riwayat</td>
								</tr>
								";$i++;}
			$cRet .=       " </table>";
			$data['prev']= $cRet;
			$judul  = 'Sheet1';
			$this->template->set('title', 'Sheet1');  

            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
	}
	function export_kib_d(){
			$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$lctgl1 	= $_REQUEST['lctgl1'];
		$lctgl2 	= $_REQUEST['lctgl2'];
		$iz	 		= $_REQUEST['fa'];
		//		cbid,kib,cskpd,cnmskpd,cnm_bid,lctgl1,lctgl2
$cRet = "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
    $cRet .="<thead>
            <tr>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_reg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">id_barang</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_oleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_reg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_oleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_dokumen</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_brg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_brg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">status_tanah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kondisi</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">asal</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">dsr_peroleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_sertifikat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_sertifikat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">luas</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">nilai</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">jumlah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">total</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">penggunaan</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat1</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat3</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_mutasi</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_pindah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_hapus</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">keterangan</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_lokasi2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">milik</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">wilayah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_skpd</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_unit</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">username</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_update</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tahun</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto1</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto3</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto4</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_urut</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lon</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_riwayat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_riwayat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_riwayat</td>
            </tr>
            </thead>";

                    $csql = "select * from trkib_a where kd_skpd='$cskpd' and kd_unit='$cbid'";
							 $hasil = $this->db->query($csql);
							 $i		= 0;
							 foreach ($hasil->result() as $row)
							 {
								$cRet .="
								<tr>
								
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->id_barang</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_dokumen</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->status_tanah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kondisi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->asal</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->dsr_peroleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_sertifikat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_sertifikat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->luas</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->nilai</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->jumlah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->total</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->penggunaan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat1</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat3</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_mutasi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_pindah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_hapus</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->keterangan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_lokasi2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->milik</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->wilayah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_skpd</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_unit</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->username</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_update</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tahun</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto1</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto3</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto4</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_urut</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lon</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_riwayat</td>
								</tr>
								";$i++;}
			$cRet .=       " </table>";
			$data['prev']= $cRet;
			$judul  = 'Sheet1';
			$this->template->set('title', 'Sheet1');  

            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
	}
	function export_kib_e(){
			$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$lctgl1 	= $_REQUEST['lctgl1'];
		$lctgl2 	= $_REQUEST['lctgl2'];
		$iz	 		= $_REQUEST['fa'];
		//		cbid,kib,cskpd,cnmskpd,cnm_bid,lctgl1,lctgl2
$cRet = "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
    $cRet .="<thead>
            <tr>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_reg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">id_barang</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_oleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_reg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_oleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_dokumen</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_brg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_brg</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">status_tanah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kondisi</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">asal</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">dsr_peroleh</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_sertifikat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_sertifikat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">luas</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">nilai</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">jumlah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">total</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">penggunaan</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat1</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat3</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_mutasi</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_pindah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_hapus</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">keterangan</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_lokasi2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">milik</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">wilayah</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_skpd</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_unit</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">username</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_update</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tahun</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto1</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto2</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto3</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto4</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_urut</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lon</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_riwayat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_riwayat</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_riwayat</td>
            </tr>
            </thead>";

                    $csql = "select * from trkib_a where kd_skpd='$cskpd' and kd_unit='$cbid'";
							 $hasil = $this->db->query($csql);
							 $i		= 0;
							 foreach ($hasil->result() as $row)
							 {
								$cRet .="
								<tr>
								
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->id_barang</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_dokumen</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->status_tanah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kondisi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->asal</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->dsr_peroleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_sertifikat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_sertifikat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->luas</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->nilai</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->jumlah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->total</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->penggunaan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat1</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat3</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_mutasi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_pindah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_hapus</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->keterangan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_lokasi2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->milik</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->wilayah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_skpd</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_unit</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->username</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_update</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tahun</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto1</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto3</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto4</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_urut</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lon</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_riwayat</td>
								</tr>
								";$i++;}
			$cRet .=       " </table>";
			$data['prev']= $cRet;
			$judul  = 'Sheet1';
			$this->template->set('title', 'Sheet1');  

            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
	}
	function export_kib_f(){
			$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$lctgl1 	= $_REQUEST['lctgl1'];
		$lctgl2 	= $_REQUEST['lctgl2'];
		$iz	 		= $_REQUEST['fa'];
	$cRet = "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
    $cRet .="<thead>
            <tr>
			
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_reg</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">id_barang</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_oleh</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_reg</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_oleh</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_dokumen</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_brg</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_brg</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_tanah</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">nilai</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">asal</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">dsr_peroleh</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">total</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kondisi</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">konstruksi</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">jenis</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">bangunan</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">luas</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">jumlah</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_awal_kerja</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">status_tanah</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">nilai_kontrak</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat1</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat2</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">alamat3</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_mutasi</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_pindah</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_hapus</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">keterangan</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_skpd</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_unit</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">milik</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">wilayah</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">username</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_update</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tahun</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">foto2</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">no_urut</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lat</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">lon</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">kd_riwayat</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">tgl_riwayat</td>
			<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px\">detail_riwayat</td>

            </tr>
            </thead>";

                    $csql = "select * from trkib_f where kd_skpd='$cskpd' and kd_unit='$cbid' and tgl_oleh>='$lctgl1' and tgl_oleh<='$lctgl2'";
							 $hasil = $this->db->query($csql);
							 $i		= 0;
							 foreach ($hasil->result() as $row)
							 {
								$cRet .="
								<tr>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->id_barang</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_reg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_oleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_dokumen</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_brg</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_tanah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->nilai</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->asal</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->dsr_peroleh</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->total</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kondisi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->konstruksi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->jenis</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->bangunan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->luas</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->jumlah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_awal_kerja</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->status_tanah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->nilai_kontrak</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat1</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->alamat3</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_mutasi</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_pindah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_hapus</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->keterangan</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_skpd</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_unit</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->milik</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->wilayah</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->username</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_update</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tahun</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->foto2</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->no_urut</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->lon</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->kd_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->tgl_riwayat</td>
								<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px\">$row->detail_riwayat</td>
								</tr>
								";$i++;}
			$cRet .=       " </table>";
			$data['prev']= $cRet;
			$judul  = 'Sheet1';
			$this->template->set('title', 'Sheet1');  

            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
	}
	/******EXND EXPORT DATA TO EXCEL****/
	
	/***********LAPORAN KIB PERJENIS***********/
	function kib_jenisb(){
		$konfig		= $this->ambil_config();
		$prov		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
		$cbid 		= $_REQUEST['cbid'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		//$lctgl	 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$lctgl	 	= $_REQUEST['lctgl2'];
        
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
				<td  width=\"10%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/logo.png\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
				<tD width =\"60%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\"><b>".strtoupper($kota)."</b><br/><b>DAFTAR ASET TETAP</b><br/><b>PERALATAN DAN MESIN</b></td>
				<td width=\"20%\"align=\"left\" style=\"font-size:12px;\"></td>
            </tr><BR><BR>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $cnm_bid</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;PROVINSI</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $prov</td>
				<td width =\"20%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Kode<br>Bidang<br>Barang</td>
                <td width=\"40%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nama <br>Bidang Barang</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Barang</td>
                <td width=\"20%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Harga<br>(Rp)</td>
            </tr>
			<tr>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">1</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">2</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">3</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">4</td>
			</tr>
            </thead> ";
            
		$csql = "SELECT kode,kd_brg,nama FROM mrekap WHERE LENGTH(kd_brg)=2 AND kd_brg='02'";
		$hasil = $this->db->query($csql);
		$i = 1;
		$cjumlah=0;
		foreach ($hasil->result() as $row)
		 {
		$kode	= $row->kode;
		$ckode	= $row->kd_brg;
		$cnama	= $row->nama;
			
		if ($ckode=='02'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE kd_skpd='$cskpd' and left(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $cjumlah2x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE kd_skpd='$cskpd' and left(kd_brg,2)='$ckode'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $charga2x = $row->nilai;
			 } 
		}
		
	$cRet .="<tr>
				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"left\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
        	</tr>";	
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$kode</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$cnama</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($charga)."</b></td>
        		</tr>";		
			
			
		$csql="SELECT left(kd_brg,2)as xkode,gol,kode,kd_brg,nama FROM mrekap 
		WHERE LENGTH(kd_brg)='5' AND LEFT(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
        $i = 1;
        foreach ($hasil->result() as $row){
			$gol2	= $row->gol;
			$kode2	= $row->kode;
			$ckode2	= $row->kd_brg;					
			$cnama2	= $row->nama;
			$ckodex	= $row->xkode;
			
				
		if ($ckodex=='02'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE kd_skpd='$cskpd ' and left(kd_brg,5)='$ckode2'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE kd_skpd='$cskpd ' and left(kd_brg,5)='$ckode2'";
			$hasil = $this->db->query($ccsql);
			$tot = 0;
			$jum = 0;
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}
		}
			 $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td bgcolor=\"#ADFF2F\"  align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$cnama2</b></td>
                        <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah2</b></td>
                        <td bgcolor=\"#ADFF2F\"  align=\"right\"  style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($charga2)."</b></td>
					</tr>
        			";
			
			$sqlb="SELECT kd_brg,nm_brg, 
			(SELECT COUNT(kd_brg) FROM  trkib_b b WHERE a.kd_brg=b.kd_brg AND kd_skpd='$cskpd' AND kondisi<>'RB' GROUP BY kd_brg) AS jumlah,
			(SELECT SUM(b.nilai) FROM trkib_b b WHERE a.kd_brg=b.kd_brg AND kd_skpd='$cskpd' AND kondisi<>'RB') AS nilai
			FROM mbarang a WHERE LEFT(kd_brg,5)='$ckode2' AND 
			kd_brg IN (SELECT kd_brg FROM trkib_b WHERE kd_skpd='$cskpd')
			ORDER BY kd_brg ";
			$hsl = $this->db->query($sqlb);
			foreach ($hsl->result() as $row){
            $nm_brg = $row->nm_brg;
            $jumlah = $row->jumlah;
            $nilai  = $row->nilai;
            $jum    = $jum+$row->jumlah;
            $tot    = $tot+$row->nilai;
			$cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"></td>
                        <td align=\"left\" 	 style=\"font-size:10px;font-family: tahoma;\">- $nm_brg</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jumlah</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">".number_format($nilai)."</td>
					</tr>
        			";
					}
					
			}
				/* $cRet .="	
                    <tr>
                        <td colspan=\"2\" align=\"center\" style=\"font-size:10px\">TOTAL</td>
                        <td align=\"center\" style=\"font-size:10px\">$jum</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($tot)."</td>
					</tr>
        			"; */
		
		}
		
		
		$cRet .=" </table>"; 
		//echo $cRet;
		$data['prev']= $cRet;
        //$this->_mpdfaiz('',$cRet,'10','10',12,'1');
		echo $cRet;

	} 
	function kib_jenisc(){
		$konfig		= $this->ambil_config();
		$prov		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
		$cbid 		= $_REQUEST['cbid'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		//$lctgl	 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$lctgl	 	= $_REQUEST['lctgl2'];
        
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
				<td  width=\"10%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/logo.png\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
				<tD width =\"80%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\"><b>".strtoupper($kota)."</b><br/><b>DAFTAR ASET TETAP</b><br/><b>GEDUNG DAN BANGUNAN</b></tD>
				<td width=\"20%\"align=\"left\" style=\"font-size:12px;\"></td>
            </tr><BR><BR>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $cnm_bid</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;PROVINSI</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $prov</td>
				<td width =\"20%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Kode<br>Bidang<br>Barang</td>
                <td width=\"40%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nama <br>Bidang Barang</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Barang</td>
                <td width=\"20%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Harga<br>(Rp)</td>
            </tr>
			<tr>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">1</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">2</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">3</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">4</td>
			</tr>
            </thead> ";
            
		$csql = "SELECT kode,kd_brg,nama FROM mrekap WHERE LENGTH(kd_brg)=2 AND kd_brg='03'";
		$hasil = $this->db->query($csql);
		$i = 1;
		$cjumlah=0;
		foreach ($hasil->result() as $row)
		 {
		$kode	= $row->kode;
		$ckode	= $row->kd_brg;
		$cnama	= $row->nama;
			
		if ($ckode=='03'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE kd_skpd='$cskpd' and left(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $cjumlah2x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE kd_skpd='$cskpd' and left(kd_brg,2)='$ckode'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $charga2x = $row->nilai;
			 } 
		}
		
	$cRet .="<tr>
				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"left\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
        	</tr>";	
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$kode</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$cnama</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($charga)."</b></td>
        		</tr>";		
			
			
		$csql="SELECT left(kd_brg,2)as xkode,gol,kode,kd_brg,nama FROM mrekap 
		WHERE LENGTH(kd_brg)='5' AND LEFT(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
        $i = 1;
        foreach ($hasil->result() as $row){
			$gol2	= $row->gol;
			$kode2	= $row->kode;
			$ckode2	= $row->kd_brg;					
			$cnama2	= $row->nama;
			$ckodex	= $row->xkode;
			
				
		if ($ckodex=='03'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE kd_skpd='$cskpd ' and left(kd_brg,5)='$ckode2'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE kd_skpd='$cskpd ' and left(kd_brg,5)='$ckode2'";
			$hasil = $this->db->query($ccsql);
			$tot = 0;
			$jum = 0;
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}
		}
			 $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"></td>
                        <td bgcolor=\"#ADFF2F\"  align=\"left\" 	 style=\"font-size:10px;font-family: tahoma;\"><b>$cnama2</b></td>
                        <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah2</b></td>
                        <td bgcolor=\"#ADFF2F\"  align=\"right\"  style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($charga2)."</b></td>
					</tr>
        			";
			
			$sqlb="SELECT kd_brg,nm_brg, 
			(SELECT COUNT(kd_brg) FROM  trkib_c b WHERE a.kd_brg=b.kd_brg AND kd_skpd='$cskpd' AND kondisi<>'RB' GROUP BY kd_brg) AS jumlah,
			(SELECT SUM(b.nilai) FROM trkib_c b WHERE a.kd_brg=b.kd_brg AND kd_skpd='$cskpd' AND kondisi<>'RB') AS nilai
			FROM mbarang a WHERE LEFT(kd_brg,5)='$ckode2' AND 
			kd_brg IN (SELECT kd_brg FROM trkib_c WHERE kd_skpd='$cskpd')
			ORDER BY kd_brg ";
			$hsl = $this->db->query($sqlb);
			foreach ($hsl->result() as $row){
            $nm_brg = $row->nm_brg;
            $jumlah = $row->jumlah;
            $nilai  = $row->nilai;
            $jum    = $jum+$row->jumlah;
            $tot    = $tot+$row->nilai;
			$cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"></td>
                        <td align=\"left\" 	 style=\"font-size:10px;font-family: tahoma;\">- $nm_brg</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jumlah</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">".number_format($nilai)."</td>
					</tr>
        			";
					}
					
			}
				/* $cRet .="	
                    <tr>
                        <td colspan=\"2\" align=\"center\" style=\"font-size:10px\">TOTAL</td>
                        <td align=\"center\" style=\"font-size:10px\">$jum</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($tot)."</td>
					</tr>
        			"; */
		
		}
		
		
		$cRet .=" </table>"; 
		//echo $cRet;
		$data['prev']= $cRet;
        //$this->_mpdfaiz('',$cRet,'10','10',12,'1');
		echo $cRet;

	} 
	function kib_jenisd(){
		$konfig		= $this->ambil_config();
		$prov		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
		$cbid 		= $_REQUEST['cbid'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		//$lctgl	 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$lctgl	 	= $_REQUEST['lctgl2'];
        
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
				<td  width=\"10%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/logo.png\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
				<tD width =\"80%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\"><b>".strtoupper($kota)."</b><br/><b>DAFTAR ASET TETAP</b><br/><b>GEDUNG DAN BANGUNAN</b></tD>
				<td width=\"20%\"align=\"left\" style=\"font-size:12px;\"></td>
            </tr><BR><BR>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $cnm_bid</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;PROVINSI</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $prov</td>
				<td width =\"20%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Kode<br>Bidang<br>Barang</td>
                <td width=\"40%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nama <br>Bidang Barang</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Barang</td>
                <td width=\"20%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Harga<br>(Rp)</td>
            </tr>
			<tr>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">1</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">2</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">3</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">4</td>
			</tr>
            </thead> ";
            
		$csql = "SELECT kode,kd_brg,nama FROM mrekap WHERE LENGTH(kd_brg)=2 AND kd_brg='04'";
		$hasil = $this->db->query($csql);
		$i = 1;
		$cjumlah=0;
		foreach ($hasil->result() as $row)
		 {
		$kode	= $row->kode;
		$ckode	= $row->kd_brg;
		$cnama	= $row->nama;
			
		if ($ckode=='04'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE kd_skpd='$cskpd' and left(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $cjumlah2x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_d WHERE kd_skpd='$cskpd' and left(kd_brg,2)='$ckode'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $charga2x = $row->nilai;
			 } 
		}
		
	$cRet .="<tr>
				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"left\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
        	</tr>";	
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$kode</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$cnama</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($charga)."</b></td>
        		</tr>";		
			
			
		$csql="SELECT left(kd_brg,2)as xkode,gol,kode,kd_brg,nama FROM mrekap 
		WHERE LENGTH(kd_brg)='5' AND LEFT(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
        $i = 1;
        foreach ($hasil->result() as $row){
			$gol2	= $row->gol;
			$kode2	= $row->kode;
			$ckode2	= $row->kd_brg;					
			$cnama2	= $row->nama;
			$ckodex	= $row->xkode;
			
				
		if ($ckodex=='04'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE kd_skpd='$cskpd ' and left(kd_brg,5)='$ckode2'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_d WHERE kd_skpd='$cskpd ' and left(kd_brg,5)='$ckode2'";
			$hasil = $this->db->query($ccsql);
			$tot = 0;
			$jum = 0;
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}
		}
			 $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"></td>
                        <td bgcolor=\"#ADFF2F\"  align=\"left\" 	 style=\"font-size:10px;font-family: tahoma;\"><b>$cnama2</b></td>
                        <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah2</b></td>
                        <td bgcolor=\"#ADFF2F\"  align=\"right\"  style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($charga2)."</b></td>
					</tr>
        			";
			
			$sqlb="SELECT kd_brg,nm_brg, 
			(SELECT COUNT(kd_brg) FROM  trkib_d b WHERE a.kd_brg=b.kd_brg AND kd_skpd='$cskpd' AND kondisi<>'RB' GROUP BY kd_brg) AS jumlah,
			(SELECT SUM(b.nilai) FROM trkib_d b WHERE a.kd_brg=b.kd_brg AND kd_skpd='$cskpd' AND kondisi<>'RB') AS nilai
			FROM mbarang a WHERE LEFT(kd_brg,5)='$ckode2' AND 
			kd_brg IN (SELECT kd_brg FROM trkib_d WHERE kd_skpd='$cskpd')
			ORDER BY kd_brg ";
			$hsl = $this->db->query($sqlb);
			foreach ($hsl->result() as $row){
            $nm_brg = $row->nm_brg;
            $jumlah = $row->jumlah;
            $nilai  = $row->nilai;
            $jum    = $jum+$row->jumlah;
            $tot    = $tot+$row->nilai;
			$cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"></td>
                        <td align=\"left\" 	 style=\"font-size:10px;font-family: tahoma;\">- $nm_brg</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jumlah</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">".number_format($nilai)."</td>
					</tr>
        			";
					}
					
			}
				/* $cRet .="	
                    <tr>
                        <td colspan=\"2\" align=\"center\" style=\"font-size:10px\">TOTAL</td>
                        <td align=\"center\" style=\"font-size:10px\">$jum</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($tot)."</td>
					</tr>
        			"; */
		
		}
		
		
		$cRet .=" </table>"; 
		//echo $cRet;
		$data['prev']= $cRet;
        //$this->_mpdfaiz('',$cRet,'10','10',12,'1');
		echo $cRet;

	} 
	function kib_jenise(){
		$konfig		= $this->ambil_config();
		$prov		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
		$cbid 		= $_REQUEST['cbid'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		//$lctgl	 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$lctgl	 	= $_REQUEST['lctgl2'];
        
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
				<td  width=\"10%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/logo.png\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
				<img src=\"".base_url()."/data/logo.png\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
				<tD width =\"80%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\"><b>".strtoupper($kota)."</b><br/><b>DAFTAR ASET TETAP</b><br/><b>JALAN, IRIGASI, DAN JARINGAN</b></tD>
				<td width=\"20%\"align=\"left\" style=\"font-size:12px;\"></td>
            </tr><BR><BR>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $cnm_bid</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;PROVINSI</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $prov</td>
				<td width =\"20%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Kode<br>Bidang<br>Barang</td>
                <td width=\"40%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nama <br>Bidang Barang</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Barang</td>
                <td width=\"20%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Harga<br>(Rp)</td>
            </tr>
			<tr>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">1</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">2</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">3</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">4</td>
			</tr>
            </thead> ";
            
		$csql = "SELECT kode,kd_brg,nama FROM mrekap WHERE LENGTH(kd_brg)=2 AND kd_brg='05'";
		$hasil = $this->db->query($csql);
		$i = 1;
		$cjumlah=0;
		foreach ($hasil->result() as $row)
		 {
		$kode	= $row->kode;
		$ckode	= $row->kd_brg;
		$cnama	= $row->nama;
			
		if ($ckode=='05'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE kd_skpd='$cskpd' and left(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $cjumlah2x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE kd_skpd='$cskpd' and left(kd_brg,2)='$ckode'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $charga2x = $row->nilai;
			 } 
		}
		
	$cRet .="<tr>
				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"left\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">&nbsp;</td>
        	</tr>";	
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$kode</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$cnama</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($charga)."</b></td>
        		</tr>";		
			
			
		$csql="SELECT left(kd_brg,2)as xkode,gol,kode,kd_brg,nama FROM mrekap 
		WHERE LENGTH(kd_brg)='5' AND LEFT(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
        $i = 1;
        foreach ($hasil->result() as $row){
			$gol2	= $row->gol;
			$kode2	= $row->kode;
			$ckode2	= $row->kd_brg;					
			$cnama2	= $row->nama;
			$ckodex	= $row->xkode;
			
				
		if ($ckodex=='05'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE kd_skpd='$cskpd ' and left(kd_brg,5)='$ckode2'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE kd_skpd='$cskpd ' and left(kd_brg,5)='$ckode2'";
			$hasil = $this->db->query($ccsql);
			$tot = 0;
			$jum = 0;
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}
		}
			 $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"></td>
                        <td bgcolor=\"#ADFF2F\"  align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$cnama2</b></td>
                        <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah2</b></td>
                        <td bgcolor=\"#ADFF2F\"  align=\"right\"  style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($charga2)."</b></td>
					</tr>
        			";
			
			$sqlb="SELECT kd_brg,nm_brg, 
			(SELECT COUNT(kd_brg) FROM  trkib_e b WHERE a.kd_brg=b.kd_brg AND kd_skpd='$cskpd' AND kondisi<>'RB' GROUP BY kd_brg) AS jumlah,
			(SELECT SUM(b.nilai) FROM trkib_e b WHERE a.kd_brg=b.kd_brg AND kd_skpd='$cskpd' AND kondisi<>'RB') AS nilai
			FROM mbarang a WHERE LEFT(kd_brg,5)='$ckode2' AND 
			kd_brg IN (SELECT kd_brg FROM trkib_e WHERE kd_skpd='$cskpd')
			ORDER BY kd_brg ";
			$hsl = $this->db->query($sqlb);
			foreach ($hsl->result() as $row){
            $nm_brg = $row->nm_brg;
            $jumlah = $row->jumlah;
            $nilai  = $row->nilai;
            $jum    = $jum+$row->jumlah;
            $tot    = $tot+$row->nilai;
			$cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"></td>
                        <td align=\"left\" 	 style=\"font-size:10px;font-family: tahoma;\">- $nm_brg</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jumlah</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">".number_format($nilai)."</td>
					</tr>
        			";
					}
					
			}
				/* $cRet .="	
                    <tr>
                        <td colspan=\"2\" align=\"center\" style=\"font-size:10px\">TOTAL</td>
                        <td align=\"center\" style=\"font-size:10px\">$jum</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($tot)."</td>
					</tr>
        			"; */
		
		}
		
		
		$cRet .=" </table>"; 
		//echo $cRet;
		$data['prev']= $cRet;
        //$this->_mpdfaiz('',$cRet,'10','10',12,'1');
		echo $cRet;

	} 
	
	function kib_kibab(){
		$konfig		= $this->ambil_config();
		$prov		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
		$cbid 		= $_REQUEST['cbid'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		//$lctgl	 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$lctgl	 	= $_REQUEST['lctgl2'];
        
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/logo.png\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
				<tD width =\"60%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\"><b>".strtoupper($kota)."</b><br/><b>DAFTAR ASET TETAP</b><br/><b>GEDUNG BANGUNAN BESERTA TANAH</b></td>
				<td width=\"10%\"align=\"left\" style=\"font-size:12px;\"></td>
            </tr><BR><BR><BR><BR>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $cnm_bid</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;PROVINSI</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $prov</td>
				<td width =\"20%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Kode Tanah</td>
                <td width=\"40%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nama Barang</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah</td>
                <td width=\"20%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Harga<br>(Rp)</td>
                <td width=\"40%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Unit Kerja</td>
            </tr>
			<tr>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">1</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">2</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">3</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">4</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">5</td>
			</tr>
            </thead> ";
            
		$csql = "SELECT a.kd_tanah,a.kd_skpd,b.nm_brg FROM trkib_c a 
				LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg  
				LEFT JOIN trkib_a c ON c.kd_brg=a.kd_brg and a.kd_skpd=c.kd_skpd
				WHERE a.kd_skpd='$cskpd' AND a.kd_tanah IS NOT NULL GROUP BY a.kd_tanah ORDER BY a.kd_brg";
		$hasil = $this->db->query($csql);
		$i = 1;
		$cjumlah=0;
		$charga=0;
		foreach ($hasil->result() as $row)
		 {
		$kd_tanah	= $row->kd_tanah;
		$nm_brg		= $row->nm_brg;
		$kd_skpd	= $row->kd_skpd;
		
		$cRet .="<tr>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$kd_tanah</b></td>
                        <td colspan=\"4\" bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:10px\"><b>".strtoupper($nm_brg)."</b></td></td>
        		</tr>";	
				
		$csqlx = "SELECT a.kd_tanah,d.nm_lokasi,b.nm_brg,COUNT(a.jumlah) AS jumlah,SUM(a.nilai) AS nilai FROM trkib_c a 
				LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
				LEFT JOIN trkib_a c ON c.kd_brg=a.kd_brg and a.kd_skpd=c.kd_skpd
				LEFT JOIN mlokasi d ON d.kd_lokasi=a.kd_unit and a.kd_skpd=d.kd_skpd
				where a.kd_tanah='$kd_tanah' AND a.kd_skpd='$kd_skpd' 
				GROUP BY a.no_reg ORDER BY a.kd_skpd";
				$hasilx = $this->db->query($csqlx);
				foreach ($hasilx->result() as $row)
			{
			  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b></b></td>
                        <td align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$row->nm_brg</b></td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$row->jumlah</b></td>
                        <td align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($row->nilai)."</b></td>
                        <td align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$row->nm_lokasi</b></td>
        		</tr>";	
			}
			
			
		
		}
		
		
		$cRet .=" </table>"; 
		//echo $cRet;
		$data['prev']= $cRet;
        $this->_mpdfaiz('',$cRet,'10','10',12,'1');
		//echo $cRet;

	}
	/***********END LAPORAN PERJENIS***********/
	
	
	 function _mpdfaiz($judul='',$isi='',$lMargin='',$rMargin='',$font=0,$orientasi='') {
        
        ini_set("memory_limit","512M");
        $this->load->library('mpdf');
        
        $this->mpdf->defaultheaderfontsize = 6;	/* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 6;	/* in pts */
        $this->mpdf->defaultfooterfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 1; 
        $this->mpdf->SetLeftMargin = $lMargin;
        $this->mpdf->SetRightMargin = $rMargin;
        $this->mpdf->_setPageSize('A4',$orientasi);
        $jam = date("H:i:s");
        //$this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Simakda| Page {PAGENO} of {nb}');
        //$this->mpdf->SetFooter('|Halaman {PAGENO} / {nb}| ');
        
        $this->mpdf->AddPage($orientasi,'','','','',$lMargin,$rMargin);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output();
               
    }
	
}

