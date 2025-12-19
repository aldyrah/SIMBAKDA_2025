<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlap extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
    function  tanggal_indonesia($tgl)
    {
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this->getBulan($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2].' '.$bulan.' '.$tahun;
        
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
                         'logo' => $resulte['logo'],
                         'logo2' => $resulte['logo2'],
                         'kabupaten' => $resulte['kabupaten']                                                                         					
                         );
        }
	   
       $query1->free_result(); 
	   return $resulte;        	
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
    
    public function lap_rkbu()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $konfig   = $this->ambil_config();
		$kota  	  			= strtoupper($konfig['kota']);
		$nm_client  	  	= strtoupper($konfig['nm_client']);
        $thn  	  = $this->session->userdata('ta_simbakda');
        $ex       = $this->uri->segment(3);
        $cskpd    = $_REQUEST['kd_skpd'];
        $cnm_skpd = $this->mdata2->get_nama($cskpd,'nm_skpd','ms_skpd','kd_skpd');
        $lctahu   = $_REQUEST['tahu'];
        $lcbend   = $_REQUEST['bend'];
        $lctgl    = $_REQUEST['tgl'];
        $tahun    = $_REQUEST['ctahun'];
		$biaya	  = 0; 
        if($lctahu==''){
            $nm_tahu  = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        $key = $trh1->ckey;
        }

        if ($key=='PA'){
            $jabat='Kepala';
        } else if ($key=='IP') {
            $jabat='INSPEKTUR';
        } else if ($key=='SP') {
            $jabat='SEKRETARIS DPRD';
        }  else if ($key=='DR') {
            $jabat='DIREKTUR';
        } else if ($key=='SD'){
          $jabat='';
        } else {
            $jabat='BENDAHARA BARANG';

        }

        // if($key=='PA')
        // {
        //   $jabat='KEPALA DINAS';
        // }else {
        //   $jabat='BENDAHARA BARANG';
        // }
		// identitas bendahara
        if($lcbend==''){
            $nm_bend  = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs       = $this->db->query($csql1);
        $trh2     = $rs->row();
        $nm_bend  = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
         $cRet='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
            <tr>
				<td rowspan=\"2\" colspan=\"2\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"50\" height=\"70\"  /></td>
                <td colspan=\"5\" align=\"center\" style=\"font-size:14px; font-family:tahoma;\"><b>DAFTAR RENCANA KEBUTUHAN BARANG UNIT (RKBU)<br>TAHUN ANGGARAN $thn</b></td>
				<td width=\"20%\"></td>
			</tr>
            
            
         </table>";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td colspan=\"2\">&nbsp;</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b> $cskpd - $cnm_skpd </b></td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KOTA</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px;font-family: tahoma;\">No</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px;font-family: tahoma;\">Nama Belanja</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px;font-family: tahoma;\">Merek/<br>Type Ukuran</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px;font-family: tahoma;\">Jumlah<br>Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px;font-family: tahoma;\">Harga<br>Satuan<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px;font-family: tahoma;\">Jumlah<br>Biaya<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px;font-family: tahoma;\">Kode<br>Kegiatan</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px;font-family: tahoma;\">Kode<br>Rekening</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px;font-family: tahoma;\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">9</td>
            </tr>
            </thead>";
             
             $csql = "SELECT a.nm_brg,a.merek,a.jumlah,a.jumlah AS jml,a.harga AS nil,(SELECT IFNULL((a.harga),0)) AS harga,a.kd_brg,a.kd_rek5,a.ket
                      ,c.kd_kegiatan FROM trd_planbrg a LEFT JOIN mbarang b ON a.kd_brg = b.kd_brg LEFT JOIN 
                      trh_planbrg c ON a.no_dokumen = c.no_dokumen  AND a.kd_uskpd = c.kd_uskpd WHERE c.kd_uskpd = '$cskpd' AND c.tahun='$tahun'";
                         
             $hasil = $this->db->query($csql);
             $i 	= 1;
			 $jumlahx=0;
			 $nilaix=0;
			 $totx=0;
             foreach ($hasil->result() as $row)
             {
                $tot     = $row->jumlah * $row->harga;
                $totx     = $totx + $tot;
                $jumlahx = $row->jml+$jumlahx;
                $nilaix  = $row->nil+$nilaix;
                   
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->jumlah,0,',','.')."</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->harga,2,',','.')."</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">".number_format($tot,2,',','.')."</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_kegiatan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_rek5</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->ket</td>
                    
                </tr>";
              $i++; }
			
		$cRet .="<tr>
                    <td colspan=\"3\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; font-family:tahoma;\"><b>".number_format($jumlahx,0,',','.')."</b></td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px; font-family:tahoma;border-left:none;\"><b>Rp. ".number_format($totx,2,',','.')."</b></td>
                    <td colspan=\"3\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; font-family:tahoma; border-left:none;\"></td>
				</tr>";
             
   //          $cRet .="
   //                  <tr>
   //                      <td height=\"60\" colspan =\"8\" align=\"center\" style=\"font-size:11px;border: solid 1px white;border-top:solid 1px black;\">&nbsp;</td>
   //                      </td>
   //                  </tr>                    
   //                  <tr>
   //                      <td colspan =\"4\" align=\"center\" style=\"font-size:11px;border: solid 1px white;\">
   //                      ,,<br><br>&nbsp;<br>&nbsp;<br>
   //                      <br>  
   //                      </td>
   //                      <td colspan =\"4\" align=\"center\" style=\"font-size:11px;border: solid 1px white; font-family:tahoma;\">
   //                      $kota, ".$this->tanggal_indonesia($lctgl).",<br>$jabat<br>&nbsp;<br><br>&nbsp;<br>&nbsp;<br>
   //                      (<u>$nm_tahu</u>)<br>$pkt_tahu<br>NIP. $nip_tahu                        
   //                      </td>
   //                  </tr>";
			// $cRet .=" </table>";
                $cRet .="
                    <tr>
                        <td height=\"60\" colspan =\"8\" align=\"right\" style=\"font-size:11px;border: solid 1px white;border-top:solid 1px black;\">&nbsp;</td>
                        </td>
                    </tr>                    
                    <tr>
                    <td colspan =\"4\" align=\"center\" style=\"font-size:11px;border: solid 1px white; font-family:tahoma;\">
                         
                        </td>
                        <td colspan =\"4\" align=\"center\" style=\"font-size:11px;border: solid 1px white; font-family:tahoma;\">
                              
                        </td>
                       
                        <td colspan =\"1\" align=\"center\" style=\"font-size:11px;border: solid 1px white; font-family:tahoma;\">
                        $kota, ".$this->tanggal_indonesia($lctgl).",<br>$jabat $cnm_skpd<br>&nbsp;<br><br>&nbsp;<br>&nbsp;<br>
                        (<u>$nm_tahu</u>)<br>$pkt_tahu<br>NIP. $nip_tahu                        
                        </td>
                    </tr>";
            $cRet .=" </table>";
		
		
		$data['prev']= $cRet;     
		$kertas='LEGAL';  
        $this->template->set('title', 'RENCANA KEBUTUHAN BARANG');
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $cnm_skpd);
        switch($ex) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= RKBU $cskpd - $test.xls");
            $this->load->view('transaksi/excel', $data);
        break;
        
                }
         } 
	}
	
public function rencana_pengadaan()
{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd = $_REQUEST['kd_skpd'];
        $cnm_skpd = $_REQUEST['nm_skpd'];
        $lctahu = $_REQUEST['tahu'];
        $lcbend = $_REQUEST['bend'];
        $lctgl = $_REQUEST['tgl'];
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
		 //COPI1=$cskpd - $cnm_skpd
		 $cRet="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:</td>
				<br/>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
			<tr>
                <th align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\">DAFTAR PENGADAAN BARANG<br>DARI TANGGAL 1 JANUARI.... S/D 31 DESEMBER....</th>
            </tr>
            
            </table>
			<br/>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
			
            <tr>
                <td rowspan='3'align=\"center\" style=\"font-size:10px; font-family:tahoma;\">No</td>
                <td rowspan='3'align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jenis Barang Yang Dibeli</td>
                <td colspan='2'align=\"center\" style=\"font-size:10px; font-family:tahoma;\">SPK/Perjanjian/ </td>
                <td colspan='2'align=\"center\" style=\"font-size:10px; font-family:tahoma;\">DPA/SP2D/</td>
                <td rowspan='2'colspan='3'align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah</td>
                <td rowspan='3'align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Dipergunakan pada Unit</td>
                <td rowspan='3'align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Ket.</td>
            </tr>
			<tr>
				<td colspan='2'align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Kontrak</td>
				<td colspan='2'align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Kwitansi</td>
			</tr>
			
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nomor</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nomor</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Banyaknya<br/>Barang</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Harga<br/>Satuan</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah<br/>Harga</td>
				
            </tr>
			
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9 (7x8)</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">11</td>
            </tr>
            
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				
            </tr>
			</thead>
			";
             
             $csql = "SELECT a.nm_brg,a.merek,a.jumlah,a.harga,a.kd_brg,b.kd_rek5,a.ket
                      FROM trd_planbrg a LEFT JOIN mbarang b ON a.kd_brg = b.kd_brg LEFT JOIN 
                      trh_planbrg c ON a.no_dokumen = c.no_dokumen WHERE c.kd_uskpd = '$cskpd'";
                         
             $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {
                $tot = $row->jumlah * $row->harga;
                $i++;    
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-srize:10px\">$i</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->harga</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$tot</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_rek5</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->ket</td>
                    
                </tr>";
              
             }
            $cRet.="</table>";	
                
                
            $cRet .="
			<br>
			<br>

			<table style=\"border-collapse:collapse;\" width=\"40%\" align=\"right\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        tgl,<br>jabatan<br>&nbsp;<br>&nbsp;<br>
                        <u>nama skpd</u><br>nip  
                        </td>
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'RENCANA KEBUTUHAN BARANG');        
        $this->_mpdf('',$cRet,10,10,10,1); 
         } 
	}
	
	
	public function lap_rkpbu()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $konfig  	= $this->ambil_config();
		$kota  	  	= strtoupper($konfig['kota']);
		$nm_client  = strtoupper($konfig['nm_client']);
        $kdbid 		= $_REQUEST['kd_skpd'];
        $kdbidx		= $_REQUEST['mlokasi'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        //$lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
		//$kdbid 	= $_REQUEST['kd_bid'];
        $thn  		= $this->session->userdata('ta_simbakda');
		$biaya	  	= 0; 
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
      /*if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }*/
        
		 //COPI1=$cskpd - $cnm_skpd
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"1\" style=\"font-size:14px; font-family:tahoma;\"><b>DAFTAR RENCANA KEBUTUHAN PEMELIHARAAN BARANG UNIT (RKPBU)<br>TAHUN ANGGARAN $thn</b></td>
				<td width=\"5%\"></td>
			</tr>
            
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b> $kdbid - $cnm_skpd </b></td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KOTA</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:11px; font-family:tahoma;\">No</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:11px; font-family:tahoma;\">Nama/<br>Jenis Barang</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:11px; font-family:tahoma;\">Uraian/<br>Pemeliharaan</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:11px; font-family:tahoma;\">Lokasi</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:11px; font-family:tahoma;\">Kode<br>Barang</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:11px; font-family:tahoma;\">Jumlah<br>Barang<br>Rp</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" bgcolor=\"#ADFF2F\" style=\"font-size:11px; font-family:tahoma;\">Harga<br>Satuan</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:11px; font-family:tahoma;\">Jumlah Biaya<br>Rp.</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:11px; font-family:tahoma;\">Kode Rekening</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:11px; font-family:tahoma;\">Ket.</td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
            </tr>
			</thead> ";
             
             $csql = "SELECT a.nm_brg,a.uraian_pelihara,a.kd_rek,b.nm_uskpd,a.kd_brg,a.jumlah,a.harga,a.total,a.ket FROM trd_treatbrg a 
                    INNER JOIN trh_treatbrg b ON a.no_dokumen=b.no_dokumen
					AND a.kd_uskpd = b.kd_uskpd AND a.kd_unit = b.kd_unit WHERE b.kd_uskpd = '$kdbid'";
                         
             $hasil = $this->db->query($csql);
             $i = 1;
			 $total_harga = 0;
			 $total_jumlah = 0;
             foreach ($hasil->result() as $row){
                           $i++;
						   $total_harga	 = $row->total+$total_harga;
						   $total_jumlah = $row->jumlah+$total_jumlah;
              $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:11px\">$i</td>
                    <td align=\"left\" width =\"17%\" style=\"font-size:11px\">$row->nm_brg</td>
                    <td align=\"left\" width =\"18%\" style=\"font-size:11px\">$row->uraian_pelihara</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:11px\">$row->nm_uskpd</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:11px\">$row->kd_brg</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:11px\">$row->jumlah</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:11px\">".number_format("$row->harga")."</td>
                    <td align=\"right\" width =\"13%\" style=\"font-size:11px\">".number_format("$row->total")."</td>
    				<td align=\"center\" width =\"10%\" style=\"font-size:11px\">$row->kd_rek</td>
    				<td align=\"left\" width =\"9%\" style=\"font-size:11px\">$row->ket</td>
                </tr>";
             }
			 
			/*    $csql = "SELECT sum(a.harga) as biaya,sum(a.jumlah) as jumlah
                      FROM trd_treatbrg a LEFT JOIN mbarang b ON a.kd_brg = b.kd_brg LEFT JOIN 
                      trh_treatbrg c ON a.no_dokumen = c.no_dokumen WHERE c.kd_uskpd = '$kdbid' and tahun='$thn'";
                         
             $hasil = $this->db->query($csql);
			 $biaya	= 0; 
             foreach ($hasil->result() as $row){
			  $biaya	= $row->biaya;
			  $jumlah	= $row->jumlah;
			  } */
				$cRet .="<tr>
                    <td colspan=\"5\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$total_jumlah</td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px\"></td>
                    <td colspan=\"3\" bgcolor=\"#ADFF2F\" align=\"left\" style=\"font-size:11px; font-family:tahoma;\">Rp. ".number_format($total_harga)."</td>
				</tr>";
			 
            $cRet.="</table>";
                
				
            $cRet .="
			<br>
			<br>

			<table style=\"border-collapse:collapse;\" width=\"40%\" align=\"right\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white; font-family:tahoma;\">
                        $kota, ".$this->tanggal_indonesia($lctgl).",<br>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
                       ( <u>$nm_tahu</u> )<br>Nip. $nip_tahu  
                        </td>
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'RENCANA KEBUTUHAN BARANG');        
        $this->_mpdf('',$cRet,10,10,10,1);
         } 
	}
	
	
	public function lap_pb()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $konfig   	= $this->ambil_config();
		$kota  	  			= strtoupper($konfig['kota']);
		$nm_client  	  	= strtoupper($konfig['nm_client']);
		$thn 		= $this->session->userdata('ta_simbakda');
        //$penyimpan	= $_REQUEST['penyimpan'];
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $penyimpan 	= $_REQUEST['penyimpan'];
        $nip_penyimpan 	= $_REQUEST['nip_penyimpan'];
        $lctgl 		= $_REQUEST['tgl'];
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        /* if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        } */
        
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr><td  width=\"10%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" style=\"font-size:14px; font-family:tahoma;\">BUKU PENERIMAAN BARANG<br>TAHUN ANGGARAN $thn </td>
				<td></td>
			</tr>
            
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"3\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">No</td>
                <td rowspan=\"3\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Tanggal</td>
                <td rowspan=\"3\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Dari</td>
                <td colspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Dokumen Faktur</td>
                <td rowspan=\"3\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nama Barang</td>
                <td rowspan=\"3\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Banyaknya</td>
                <td rowspan=\"3\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Harga<br>Satuan</td>
                <td rowspan=\"3\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Harga</td>
				<td colspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Bukti Penerimaan</td>
				<td rowspan=\"3\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Ket.</td>
            </tr>
            <tr>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nomor</td>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Tanggal</td>
				<td colspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">B.A Penerimaan</td>
            </tr>
			<tr>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px;font-family: tahoma;\">Nomor</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px;font-family: tahoma;\">Tanggal</td>
                
            </tr>
            
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">11</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">12</td>
            </tr>
			</thead>";
             
             $csql = "SELECT a.tgl_periksa,a.kd_uskpd AS dari,a.no_faktur,a.tgl_faktur,b.nm_brg,coalesce((b.jumlah),0) as jumlah,sum(b.jumlah) as jmlx,b.harga,coalesce((b.harga),0)as harga,coalesce((b.total),0)as total,sum(b.total) as totalx,a.no_bap,a.tgl_bap,a.keterangan       
                    FROM trh_terimabrg a INNER JOIN trd_terimabrg b ON a.no_bap=b.no_bap WHERE a.kd_uskpd = '$cskpd'";
                         
             $hasil = $this->db->query($csql);
             $i = 0;
			 $totalx = 0;
			 $jmlx = 0;
             foreach ($hasil->result() as $row)
             {
			 $totalxx = $row->totalx+$totalx;
			 $jumlahxx = $row->jmlx+$jmlx;
                $i++;    
                $cRet .="
                    <tr>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->tgl_periksa</td>
                        <td align=\"center\" width =\"9%\" style=\"font-size:10px; font-family:tahoma;\">$row->dari</td>
                        <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->no_faktur</td>
                        <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tgl_faktur</td>
                        <td align=\"left\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                        <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->jumlah</td>
                        <td align=\"right\" width =\"13%\" style=\"font-size:10px; font-family:tahoma;\">".number_format("$row->harga")."</td>
        				<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format("$row->total")."</td>
        				<td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->no_bap</td>
        				<td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->tgl_bap</td>
                        <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->keterangan</td>
                    </tr>";
             }
			 
				$cRet .="<tr>
                    <td colspan=\"6\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px\"><b>$jumlahxx</b></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px\"></td>
                    <td colspan=\"4\" bgcolor=\"#ADFF2F\" align=\"left\" style=\"font-size:11px\"><b>Rp. ".number_format("$totalxx")."</b></td>
						</tr>";
			
            $cRet .="</table>";
				
            $cRet .="
			<br>
			<br>
			<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;font-family: tahoma;\">
                        <br>ATASAN LANGSUNG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_tahu )</u><br>NIP. $nip_tahu   
                        </td>
						
						<td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;font-family: tahoma;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENYIMPAN BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $penyimpan )</u><br>NIP. $nip_penyimpan    
                        </td>
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'RENCANA KEBUTUHAN BARANG');        
        $this->_mpdf('',$cRet,10,10,10,1);
         } 
	}
	
	public function lap_pengeluaran_barang()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $konfig   = $this->ambil_config();
		$kota  	  			= strtoupper($konfig['kota']);
		$nm_client  	  	= strtoupper($konfig['nm_client']);
        
		$thn  		= $this->session->userdata('ta_simbakda');
        //$penyimpan	= $_REQUEST['penyimpan'];
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $penyimpan 	= $_REQUEST['penyimpan'];
        $nip_penyimpan 	= $_REQUEST['nip_penyimpan'];
        $lctgl 		= $_REQUEST['tgl'];
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        /* if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        } */
        
         
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
				<td  width=\"10%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" style=\"font-size:14px; font-family:tahoma;\">BUKU PENGELUARAN BARANG<br>TAHUN ANGGARAN $thn</td>
				<td></td>
			</tr>
            
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px; font-family:tahoma;\">No</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px; font-family:tahoma;\">Nomor Urut</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px; font-family:tahoma;\">Nama Barang</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px; font-family:tahoma;\">Banyaknya</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px; font-family:tahoma;\">Harga<br>Satuan</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px; font-family:tahoma;\">Jumlah<br>Harga</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px; font-family:tahoma;\">Untuk</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px; font-family:tahoma;\">Tanggal Penyerahan</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px; font-family:tahoma;\">Ket.</td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
            </tr>
 			</thead>";
             
             $csql = "SELECT a.tgl_bak,a.no_bak,b.nm_brg,coalesce((b.jumlah),0) as jumlah,sum(b.jumlah) as jml,coalesce((b.harga),0) as harga,sum(b.harga) as biaya,coalesce((b.total),0) as total,b.ket AS untuk,(a.tgl_bak) AS tgl_penyerahan,b.ket   
                 FROM trh_keluarbrg a INNER JOIN trd_keluarbrg b ON a.no_bak = b.no_bak WHERE a.kd_uskpd = '$cskpd'";
                         
             $hasil = $this->db->query($csql);
             $i = 0;
			 $biayax=0;
			 $jumlahx=0;
             foreach ($hasil->result() as $row)
             {
			 $biayaxx	= $row->biaya+$biayax;
			 $jumlahxx	= $row->jml+$jumlahx;
			 
                $i++;    
                $cRet .="
                <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->tgl_bak</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->no_bak</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"right\" width =\"13%\" style=\"font-size:10px; font-family:tahoma;\">".number_format("$row->harga")."</td>
                    <td align=\"right\" width =\"13%\" style=\"font-size:10px; font-family:tahoma;\">".number_format("$row->total")."</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->untuk</td>
    				<td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->tgl_penyerahan</td>
    				<td align=\"left\" width =\"9%\" style=\"font-size:10px; font-family:tahoma;\">$row->ket</td>
               </tr>";
              
             }
			 
				$cRet .="<tr>
                    <td colspan=\"4\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px; font-family:tahoma;\"><b>$jumlahxx</b></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px; font-family:tahoma;\"><b></b></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px; font-family:tahoma;\"><b>Rp. ".number_format("$biayaxx")."</b></td>
                    <td colspan=\"3\" bgcolor=\"#ADFF2F\" align=\"left\" style=\"font-size:11px\"></td>
						</tr>";
			
            $cRet .="</table>";
            
            $cRet .="
			<br>
			<br>
			<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white; font-family:tahoma;\">
                        <br>ATASAN LANGSUNG<br>&nbsp;<br>&nbsp;<br>
                        (<u> $nm_tahu </u>)<br>NIP. $nip_tahu   
                        </td>
						
						<td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white; font-family:tahoma;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENERIMA BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $penyimpan )</u><br>NIP. $nip_penyimpan 
                        </td>
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'RENCANA KEBUTUHAN BARANG');        
        $this->_mpdf('',$cRet,10,10,10,1);
         } 
	}
	
	
	public function lap_bbi()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$thn  		= $this->session->userdata('ta_simbakda');
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		$penyimpan 	= $_REQUEST['penyimpan'];
		$cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        //$lctahu = $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
       /* 
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
         */
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
		$cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
           
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
            </tr>
			 <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\">BUKU BARANG INVENTARIS<br>TAHUN ANGGARAN $thn</td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td bgcolor=\"#ADFF2F\" rowspan=\"3\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">No</td>
                <td bgcolor=\"#ADFF2F\" COLSPAN=\"8\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">PENERIMAAN</td>
                <td bgcolor=\"#ADFF2F\" colspan=\"4\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">PENGELUARAN</td>
                <td bgcolor=\"#ADFF2F\" rowspan=\"3\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Ket.</td>
            </tr>
            <tr>
                <td bgcolor=\"#ADFF2F\" rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tanggal<br/>Diterima</td>
                <td bgcolor=\"#ADFF2F\" rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nama/Jenis<br/>Barang</td>
                <td bgcolor=\"#ADFF2F\" rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Merk/Ukuran</td>
                <td bgcolor=\"#ADFF2F\" rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tahun Pembuatan</td>
                <td bgcolor=\"#ADFF2F\" rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah/<br/>Satuan<br/>Barang</td>
                <td bgcolor=\"#ADFF2F\" rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tgl/No.<br/>Kontrak/SP/SPK<br/>Harga Satuan</td>
                <td bgcolor=\"#ADFF2F\" colspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Berita Acara<br/>Pemeriksaan</td>
                <td bgcolor=\"#ADFF2F\" rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tanggal<br/>Dikeluarkan</td>
				<td bgcolor=\"#ADFF2F\" rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Diserahkan<br/>Kepada</td>
				<td bgcolor=\"#ADFF2F\" rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah Satuan<br/>Barang</td>
				<td bgcolor=\"#ADFF2F\" rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tgl/No. Surat<br/>Penyerahan</td>
            </tr>
			<tr>
                <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tanggal</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nomor</td>
            </tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">11</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">12</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">13</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">14</td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
			</thead>
			</table>";
             
             /*$csql = "SELECT a.nm_brg,a.merek,a.jumlah,a.harga,a.kd_brg,b.kd_rek5,a.ket
                      FROM trd_planbrg a LEFT JOIN mbarang b ON a.kd_brg = b.kd_brg LEFT JOIN 
                      trh_planbrg c ON a.no_dokumen = c.no_dokumen WHERE c.kd_uskpd = '$cskpd'";
                         
             $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {
                $tot = $row->jumlah * $row->harga;
                $i++;    
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->harga</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$tot</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_rek5</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->ket</td>
                    
                </tr>";
              
             }
            */
           // for ($i = 1; $i <= 50; $i++) 
//            {
//                $cRet .="
//                 <tr>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" width =\"18%\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                </tr>";
//            }

				//COPI2=$jbt_tahu
				//COPI3=$nm_tahu
				//COPI4=$nip_tahu
				//COPI5=".$this->tanggal_indonesia($lctgl)."
				//COPI6=$jbt_bend
				//COPI7=$nm_bend
				//COPI8=$nip_bend
				
            $cRet .="
			<br>
			<br>

					<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>ATASAN LANGSUNG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_bend )</u><br>NIP. $nip_bend  
                        </td>
						
						<td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENYIMPAN BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $penyimpan )</u><br>NIP.   
                        </td>
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'KARTU BARANG');        
        $this->_mpdf('',$cRet,5,5,5,1);
         } 
	}

	public function lap_kb()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$konfig 		= $this->ambil_config();
		$kota  			= strtoupper($konfig['kota']);
		$prov  			= strtoupper($konfig['nm_client']);
        $penyimpan 		= $_REQUEST['penyimpan'];
        $nama_barang 	= $_REQUEST['nama_barang'];
        $satuan 		= $_REQUEST['satuan'];
        $spesifikasi 	= $_REQUEST['spesifikasi'];
        $cskpd 			= $_REQUEST['kd_skpd'];
        $cnm_skpd 		= $_REQUEST['nm_skpd'];
        $lctahu 		= $_REQUEST['tahu'];
        $lcbend 		= $_REQUEST['bend'];
        $lctgl 			= $_REQUEST['tgl'];
        $thn  			= $this->session->userdata('ta_simbakda');
        
        // identitas yang mengetahuin / pengguna anggaran
       if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KOTA</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"4\" style=\"font-size:14px; font-family:tahoma;\"><B>KARTU BARANG<br>TAHUN ANGGARAN $thn</B></td>
            </tr>
            
            <tr>
                <td width =\"10%\" align=\"rigth\" style=\"font-size:12px; font-family:tahoma;\">&ensp;NAMA BARANG</td>
                <td width =\"50%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nama_barang</td>
				<td width =\"20%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
            <tr>
                <td width =\"20%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SATUAN</td>
                <td width =\"50%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $satuan</td>
				<td width =\"1%\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">SPESIFIKASI</td>
				<td width =\"20%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $spesifikasi</td>
            </tr>
            
            </table>
			<br />
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px\">No</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px\">Tanggal</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px\">Masuk</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px\">Keluar</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px\">Sisa</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px\">Keterangan</td>
            </tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
			</thead>";
			
             //faizz
             $csql = "SELECT a.nm_brg,a.jumlah,c.jumlah AS jum, b.keterangan,b.tgl_bap FROM trd_terimabrg a 
					INNER JOIN trh_terimabrg b ON a.no_bap=b.no_bap LEFT JOIN trd_keluarbrg c 
					ON a.kd_brg=c.kd_brg WHERE b.kd_uskpd='$cskpd'";
                         
             $hasil = $this->db->query($csql);
             $i = 1;
             foreach ($hasil->result() as $row)
             {
			 $sisa = $row->jumlah-$row->jum;
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->tgl_bap</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->jum</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$sisa</td>
                    <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$row->keterangan</td>
                    
                </tr>";
              $i++; 
             }
            $cRet .="</table>";
           
            $cRet .="
			<br>
			<br>

			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>ATASAN LANGSUNG<br>&nbsp;<br>&nbsp;<br>
                        (<u> $nm_tahu</u>)<br>NIP. $nip_tahu  
                        </td>
						
						<td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENYIMPAN BARANG<br>&nbsp;<br>&nbsp;<br>
                        (<u> $penyimpan </u>)<br>NIP.   
                        </td>
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'KARTU BARANG');        
        $this->_mpdf('',$cRet,5,5,5,1);
         } 
	}

	public function lap_sbi()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		$thn  = $this->session->userdata('ta_simbakda');
		$cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        //$lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl		= $_REQUEST['tgl'];
        
        /*// identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
         */
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
				<BR />
            </tr>
			
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <th colspan='4'align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\">LAPORAN SEMESTER TENTANG PENERIMAAN DAN PENGELUARAN BARANG INVENTARIS<br>SEMESTER....TAHUN $thn</th>
            </tr>
            
            </table>
			<br />
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">No.</td>
                <td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Terima Tgl</td>
                <td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Dari<br/>Perusahaan</td>
                <td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Penerimaan<br/>SPK/Perjanjian</td>
                <td colspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Dokumen Faktur</td>
                <td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Banyaknya</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nama<br/>Barang</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Harga<br/>Satuan</td>
				<td colspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Buku Peneriman<br/>B.A./Srt.Penerimaan</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Ket.</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">No<br/>Urut</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Pengeluaran<br/>Tgl</td>
				<td colspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Surat Bon</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Untuk</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Banyaknya</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nama<br/>Barang</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Harga<br/>Satuan</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Jumlah<br/>Harga</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Tgl<br/>Penyerahan</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">ket.</td>
			</tr>
			<tr>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nomor</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Tanggal</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nomor</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Tanggal</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nomor</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Tanggal</td>
			</tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">11</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">12</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">13</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">14</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">15</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">16</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">17</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">18</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">19</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">20</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">21</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">22</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">23</td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
			</thead>
			</table>";
             
             /*$csql = "SELECT a.nm_brg,a.merek,a.jumlah,a.harga,a.kd_brg,b.kd_rek5,a.ket
                      FROM trd_planbrg a LEFT JOIN mbarang b ON a.kd_brg = b.kd_brg LEFT JOIN 
                      trh_planbrg c ON a.no_dokumen = c.no_dokumen WHERE c.kd_uskpd = '$cskpd'";
                         
             $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {
                $tot = $row->jumlah * $row->harga;
                $i++;    
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->harga</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$tot</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_rek5</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->ket</td>
                    
                </tr>";
              
             }
            */
           // for ($i = 1; $i <= 50; $i++) 
//            {
//                $cRet .="
//                 <tr>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" width =\"18%\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                </tr>";
//            }

				//COPI2=$jbt_tahu
				//COPI3=$nm_tahu
				//COPI4=$nip_tahu
				//COPI5=".$this->tanggal_indonesia($lctgl)."
				//COPI6=$jbt_bend
				//COPI7=$nm_bend
				//COPI8=$nip_bend
				
            $cRet .="
			<br>
			<br>

			<table style=\"border-collapse:collapse;\" width=\"30%\" align=\"right\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
	
						<td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENYIMPAN BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_bend )</u><br>NIP. $nip_bend  
                        </td>
                        
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'RENCANA KEBUTUHAN BARANG');        
        $this->_mpdf('',$cRet,10,10,10,1);
         } 
	}
	
	
	public function lap_sbph()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        
		$thn  		= $this->session->userdata('ta_simbakda');
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		$cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        //$lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
        
       /* // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }*/
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
         
		$cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
				<BR />
            </tr>
			
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <th colspan='4'align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\">LAPORAN SEMESTERAN TENTANG PENERIMAAN DAN PENGELUARAN BARANG HABIS PAKAI<br>SEMESTER....TAHUN $thn</th>
            </tr>
            
            </table>
			<br />
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">No.</td>
                <td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Terima Tgl</td>
                <td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Dari<br/>Perusahaan</td>
                <td colspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Dokumen Faktur</td>
				<td colspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Dasar Penerimaan</td>
                <td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Banyaknya</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nama<br/>Barang</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Harga<br/>Satuan</td>
				<td colspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Buku Peneriman<br/>B.A./Srt.Penerimaan</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Ket.</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">No<br/>Urut</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Terima<br/>Tgl</td>
				<td colspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Surat Bon</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Untuk</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Banyaknya</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nama<br/>Barang</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Harga<br/>Satuan</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Jumlah<br/>Harga</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Tgl<br/>Penyerahan</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">ket.</td>
			</tr>
			<tr>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nomor</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Tanggal</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Jenis Surat</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nomor</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nomor</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Tanggal</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nomor</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Tanggal</td>
			</tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
			    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">11</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">12</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">13</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">14</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">15</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">16</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">17</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">18</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">19</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">20</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">21</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">22</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">23</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">24</td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
			</thead>
			</table>";
             
             /*$csql = "SELECT a.nm_brg,a.merek,a.jumlah,a.harga,a.kd_brg,b.kd_rek5,a.ket
                      FROM trd_planbrg a LEFT JOIN mbarang b ON a.kd_brg = b.kd_brg LEFT JOIN 
                      trh_planbrg c ON a.no_dokumen = c.no_dokumen WHERE c.kd_uskpd = '$cskpd'";
                         
             $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {
                $tot = $row->jumlah * $row->harga;
                $i++;    
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->harga</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$tot</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_rek5</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->ket</td>
                    
                </tr>";
              
             }
            */
           // for ($i = 1; $i <= 50; $i++) 
//            {
//                $cRet .="
//                 <tr>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                    <td align=\"center\" width =\"18%\" style=\"font-size:10px; font-family:tahoma;\"></td>
//                </tr>";
//            }

				//COPI2=$jbt_tahu
				//COPI3=$nm_tahu
				//COPI4=$nip_tahu
				//COPI5=".$this->tanggal_indonesia($lctgl)."
				//COPI6=$jbt_bend
				//COPI7=$nm_bend
				//COPI8=$nip_bend
				
            $cRet .="
			<br>
			<br>

			<table style=\"border-collapse:collapse;\" width=\"30%\" align=\"right\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
	
						<td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENYIMPAN BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_bend )</u><br>NIP. $nip_bend  
                        </td>
                        
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'RENCANA KEBUTUHAN BARANG');        
        $this->_mpdf('',$cRet,10,10,10,1);
         } 
	}
	
	
	public function lap_kir()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
        $nama_ruang = $_REQUEST['nama_ruang'];
        $lctahu		= $_REQUEST['mengetahui'];
        $lcbend		= $_REQUEST['pengurus'];
		$cskpd 		= $_REQUEST['kd_skpd'];
		$cbidskpd	= $_REQUEST['cbidskpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $kdruangan 	= $_REQUEST['kdruangan'];
        //$lcbend		= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
        
       // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
		$cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
             <tr>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:14px; font-family:tahoma;\">KARTU INVENTARIS RUANGAN</td>
            </tr>
			<br />
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
				<br/>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;UNIT</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">&ensp;NO. KODE LOKASI</td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kdruangan</td>
            </tr>
			<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SATUAN KERJA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
				<td width =\"30%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;RUANGAN</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nama_ruang</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">NO<br/>Urut</td>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nama Barang/<br/>Jenis Barang</td>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Merk/<br/>Model</td>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">No. Seri<br/>Pabrik</td>
				<td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Ukuran</td>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Bahan</td>
				<td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tahun<br/>Pembuatan/<br/>Pembelian</td>
				<td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">No.Kode<br/>Barang</td>
				<td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah<br/>Barang/<br/>Register</td>
				<td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Harga<br/>Beli/<br/>Perolehan</td>
				<td colspan=\"3\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Keadaan Barang</td>
				<td rowspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Keterangan<br/>Mutasi Dll</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\">Baik<BR/>B</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\">Kurang Baik<br/>KB</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\">Rusak Berat<br/>RB</td>
			</tr>
			<tr>
                <td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">4</td>
			    <td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">7</td>
				<td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">10</td>
				<td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">11</td>
				<td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">12</td>
				<td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">13</td>
				<td align=\"center\" bgcolor=\"#FFFF00\" style=\"font-size:10px; font-family:tahoma;\">14</td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
			</thead>";
			$csql="SELECT * FROM (SELECT b.nm_brg,a.no_mesin,a.silinder,a.kd_bahan,a.tahun,
a.no_reg,
a.merek,a.kd_brg,a.nilai,IF((a.kondisi)='B','B','-') AS kondisia,
IF((a.kondisi)='KB','KB','-') AS kondisib,
IF((a.kondisi)='RB','RB','-') AS kondisic,
a.keterangan FROM trkib_b a LEFT JOIN 
mbarang b ON b.kd_brg=a.kd_brg WHERE a.kd_unit='$cbidskpd' AND a.kd_ruang='$kdruangan'


UNION

SELECT b.nm_brg,a.tipe AS no_mesin,a.kd_satuan AS silinder,a.kd_bahan,a.tahun,
a.no_reg,
a.judul AS merek,a.kd_brg,a.nilai,IF((a.kondisi)='B','B','-') AS kondisia,
IF((a.kondisi)='KB','KB','-') AS kondisib,
IF((a.kondisi)='RB','RB','-') AS kondisic,
a.keterangan FROM trkib_e a LEFT JOIN 
mbarang b ON b.kd_brg=a.kd_brg WHERE a.kd_unit='$cbidskpd' AND a.kd_ruang='$kdruangan'


) faiz ORDER BY kd_brg";

                         
             $hasil = $this->db->query($csql);
             $i = 0;
			 $tot = 0;
             foreach ($hasil->result() as $row)
             {
                $tot = $row->nilai + $tot;
                $i++;    
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->no_mesin</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->no_reg</td>
                    <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai)."</td>
					<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kondisia</td>
					<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kondisib</td>
					<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kondisic</td>
					<td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";
              
             }
			  $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" colspan=\"9\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">TOTAL</td>
                    <td bgcolor=\"#ADFF2F\" align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot)."</td>
					<td bgcolor=\"#ADFF2F\" colspan=\"4\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                </tr>";
			 $cRet .="</table>";
            $cRet .="
			
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white; font-family:tahoma;\">
                        <br>MENGETAHUI<BR/>KEPALA $cnm_skpd<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_tahu )</u><br>NIP. $nip_tahu  
                        </td>
						
						<td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white; font-family:tahoma;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS RUANGAN<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_bend )</u><br>NIP. $nip_bend    
                        </td>
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'KARTU INVENTARIS RUANGAN');        
        $this->_mpdf('',$cRet,5,5,5,1);
         } 
	}
	
function lap_inventarisxx(){
	   if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$konfig		= $this->ambil_config();
		$prov		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		//$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['kd_skpd'];
		$cnm_bid 	= $_REQUEST['nm_skpd'];
		$lctahu 	= $_REQUEST['tahu'];
		$lcbend 	= $_REQUEST['bend'];
		//$cnmbend 	= $_REQUEST['cnmbend'];
		//$cnmtahu 	= $_REQUEST['cnmtahu'];
		//$lctgl	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$lctgl	 	= $_REQUEST['tgl'];
		$iz	 		= $_REQUEST['fa'];
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
		
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
                <td width=\"10%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
				<th width =\"80%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">REKAPITULASI DAFTAR MUTASI BARANG<br>MILIK PEMERINTAH KOTA $kota<br><b>TAHUN $thn</b></th>
				<td width=\"10%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_bid</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">Kode Lokasi: $cbid</td>
            </tr>
            </table>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px\">No</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px\">Gol</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px\">Kode<br>Bidang<br>Barang</td>
                <td width=\"30%\" align=\"center\" style=\"font-size:12px\">Nama <br>Bidang Barang</td>
                <td width=\"10%\" align=\"center\" style=\"font-size:12px\">Jumlah Barang</td>
                <td width=\"40%\" align=\"center\" style=\"font-size:12px\">Jumlah Harga<br>(Rp)</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px\">Keterangan</td>
            </tr>

			<tr>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
			</tr>
            </thead> ";
			
/*INI DETAIL*/
	$csql="SELECT gol,nama FROM mrekap WHERE gol IS NOT NULL";			
		$hasil 	= $this->db->query($csql);
        $i 		= 0;
        foreach ($hasil->result() as $row){
			$nama	= $row->nama;
			$gol2	= $row->gol;
			
			$cjumlah2	= 0;
			$charga2	= 0;
			
			$cRet .="<tr>
                        <td bgcolor=\"#ADFF2F\" colspan=\"7\" align=\"left\" style=\"font-size:10px; font-family:tahoma;\"><b>$nama</b></td>
					</tr>";
			
		if ($gol2=='01'){
			$csql = "SELECT a.kd_brg,b.nm_brg FROM trkib_a a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cbid' AND LEFT(a.kd_brg,2)='$gol2'";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $kd_brg = $row->kd_brg;
            $nm_brg = $row->nm_brg;
			$i++;
        	  $cRet .="<tr>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$nm_brg</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"left\" 	 style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
					</tr>";
			}				
		}
			
		if ($gol2=='02'){
			$ccsql = "SELECT a.kd_brg,b.nm_brg FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cbid' AND LEFT(a.kd_brg,2)='$gol2'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
            $kd_brg = $row->kd_brg;
            $nm_brg = $row->nm_brg;
			$i++;
        	  $cRet .="<tr>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$nm_brg</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"left\" 	 style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
					</tr>";
			}
		}
			
		if ($gol2=='03'){
			$csql = "SELECT a.kd_brg,b.nm_brg FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cbid' AND LEFT(a.kd_brg,2)='$gol2'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $kd_brg = $row->kd_brg;
            $nm_brg = $row->nm_brg;
			$i++;

        	  $cRet .="<tr>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$nm_brg</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"left\" 	 style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
					</tr>";			
			}
		}
			
			if ($gol2=='04'){
			$csql = "SELECT a.kd_brg,b.nm_brg FROM trkib_d a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cbid' AND LEFT(a.kd_brg,2)='$gol2'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
            $kd_brg = $row->kd_brg;
            $nm_brg = $row->nm_brg;
			$i++;
			
        	  $cRet .="<tr>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$nm_brg</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"left\" 	 style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
					</tr>";
			 }
			}
			
			if ($gol2=='05'){
			$csql = "SELECT a.kd_brg,b.nm_brg FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cbid' AND LEFT(a.kd_brg,2)='$gol2'";
			$hasil = $this->db->query($csql);
			 
			foreach ($hasil->result() as $row){
            $kd_brg = $row->kd_brg;
            $nm_brg = $row->nm_brg;
			$i++;
        	  $cRet .="<tr>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$nm_brg</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"left\" 	 style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
					</tr>";
			
			 }
			 
			}
			
				if ($gol2=='06'){
			$csql = "SELECT a.kd_brg,b.nm_brg FROM trkib_f a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cbid' AND LEFT(a.kd_brg,2)='$gol2'"; // and left(a.kd_brg,2)='$ckodex'
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
            $kd_brg = $row->kd_brg;
            $nm_brg = $row->nm_brg;
			$i++;
			 
        	  $cRet .="<tr>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$nm_brg</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"left\" 	 style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
					</tr>";
			 
			 }
			}
			
		}

			 
	$cRet .="<tr>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"><b>jml</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px; font-family:tahoma;\"><b></b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
			</tr>";
		   
            $cRet .="</table>";
           
            /*$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Mengetahui,<br>Kepala SKPD<br><br><br><br></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Pengurus Barang<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">(<u>$nm_tahu</u>)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">(<u>$nm_bend</u>)</td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_tahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_bend</td>					
					</tr>";
		$cRet .= " </table>";*/
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'REKAP BUKU INVENTARIS BARANG';
        $this->template->set('title', 'REKAP BUKU INVENTARIS BARANG');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
		//$this->_mpdf('',$cRet,5,5,5,1);
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            
            $this->load->view('transaksi/excel', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
           $this->load->view('transaksi/excel', $data);
        break;
        } 
        } 
	}
	
	
	public function lap_inventaris()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $nip_tahu 	= $_REQUEST['tahu'];
        $nip_bend 	= $_REQUEST['bend'];
        $nm_tahu 	= $_REQUEST['nmtahu'];
        $nm_bend 	= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$jenis 		= $_REQUEST['jenis'];
		$tahun	 	= $_REQUEST['tahun'];
		$th			= "";
        if($tahun<>''){
		$th			= "and a.tahun='$tahun'";		
		}
        
       
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
				<td width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                 <img src=\"".base_url()."/data/100.jpg\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                <td colspan=\"9\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>BUKU INVENTARIS</b></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
			</tr>";
			if($jenis=='2'){
			$cRet .= "<tr>
                <th colspan=\"15\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>KIB A (TANAH)</b></th>
			</tr>";}
			if($jenis=='3'){
			$cRet .= "<tr>
                <th colspan=\"15\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>KIB B (PERALATAN DAN MESIN)</b></th>
			</tr>";}
			if($jenis=='4'){
			$cRet .= "<tr>
                <th colspan=\"15\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>KIB C (GEDUNG DAN BANGUNAN)</b></th>
			</tr>";}
			if($jenis=='5'){
			$cRet .= "<tr>
                <th colspan=\"15\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>KIB D (JALAN IRIGASI DAN JARINGAN)</b></th>
			</tr>";}
			if($jenis=='6'){
				$cRet .= "<tr>
                <th colspan=\"15\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>KIB E (ASET TETAP LAINNYA)</b></th>
			</tr>";}
			if($jenis=='7'){
			$cRet .= "<tr>
                <th colspan=\"15\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>KIB F (KONSTRUKSI DALAM PENGERJAAN)</b></th>
			</tr>";}
            $cRet .= "<tr>
                <td colspan=\"15\" align=\"center\" style=\"font-size:16px;\"></td>
			</tr>
            <tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">SKPD</td>
                <td colspan=\"13\" width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
				<br/>
            </tr>
            <tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">KABUPATEN/KOTA</td>
                <td colspan=\"13\" width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">PROVINSI</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
                <td colspan=\"8\" width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
				<td colspan=\"2\" width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">KODE LOKASI</td>
                <td colspan=\"2\" width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cskpd</td>
            </tr>
            </table>
			
           <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>NOMOR</b></td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>SPESIFIKASI BARANG</b></td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Bahan</b></td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Asal/Cara<br/>Perolehan<br/>Barang</b></td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Tahun<br/>Perolehan</b></td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</b></td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Satuan</b></td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Keadaan<br/>Barang</b></td>
				<td colspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Jumlah</b></td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Keterangan</b></td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Nomor<BR/>Urut</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Kode<br/>Barang</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Register</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Nama/Jenis<BR/>Barang</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Merk<br/>Type</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Barang</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\"><b>Harga</b></td>
			</tr>
			<tr>
                <td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">4</td>
			    <td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">7</td>
				<td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">10</td>
				<td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">11</td>
				<td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">12</td>
				<td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">13</td>
				<td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">14</td>
				<td align=\"center\" bgcolor=\"#FF00FF\" style=\"font-size:10px; font-family:tahoma;\">15</td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"11%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				
            </tr>
			</thead>";
             
if($jenis=='1'){
$csql = "SELECT * FROM 
(SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,'' AS merek,a.no_sertifikat AS gabung,'' AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.luas AS silinder,'' kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_a a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' $th 
group by a.kd_brg,a.nilai,a.keterangan,a.asal,a.tahun
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' $th 
GROUP BY a.kd_brg,a.nilai,a.asal,
a.tahun,a.silinder,a.kd_satuan,a.kondisi,a.pabrik,a.no_rangka,a.no_polisi,a.no_mesin,a.keterangan 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' $th 
group by a.kd_brg,a.nilai,a.keterangan,a.asal,a.tahun 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.panjang AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.lebar AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_d a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' $th 
group by a.kd_brg,a.nilai,a.keterangan,a.tahun
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' $th GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,'' AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
a.asal,a.tahun,'' AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_f a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' $th 
group by a.kd_brg,a.tahun,a.nilai,a.keterangan
/*UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,'' AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
a.asal,a.tahun,'' AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_g a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' $th 
group by a.kd_brg,a.tahun,a.nilai,a.keterangan*/
) faiz  ORDER BY kd_brg,no_reg,tahun";
}else{
	if($jenis=='2'){
		$csql = "SELECT a.kd_brg,a.no_reg,b.nm_brg,'' AS merek,a.no_sertifikat AS gabung,'' AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.luas AS silinder,'' kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_a a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th 
GROUP BY b.nm_brg,a.kd_brg,a.luas,a.tahun,a.alamat1,
a.status_tanah,a.tgl_sertifikat,a.no_sertifikat,a.penggunaan,a.asal,a.nilai,a.keterangan 
		ORDER BY tahun,kd_brg,no_reg";
	}elseif($jenis=='3'){
		$csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th 
GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek, a.silinder,a.tahun,a.kd_warna,
			a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai,a.keterangan
			ORDER BY tahun,kd_brg,no_reg";
	}elseif($jenis=='4'){
		$csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th 
GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
			a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai,a.keterangan 
			ORDER BY tahun,kd_brg,no_reg";
	}elseif($jenis=='5'){
		$csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.panjang AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.lebar AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_d a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th 
GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,
					a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan 
					ORDER BY tahun,kd_brg,no_reg";
	}elseif($jenis=='6'){
		$csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th 
GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tahun,a.tipe,a.nilai,a.keterangan  
			ORDER BY tahun,kd_brg,no_reg ";
	}elseif($jenis=='7'){
		$csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,'' AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
a.asal,a.tahun,'' AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_f a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th 
GROUP BY b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.bangunan,a.kd_tanah,
		a.tahun,a.asal,a.nilai,a.keterangan,a.kd_brg
		ORDER BY a.tahun,a.kd_brg,no_reg";
	}/*else{
		$csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,'' AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
a.asal,a.tahun,'' AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_g a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th 
GROUP BY b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.bangunan,a.kd_tanah,
		a.tahun,a.asal,a.nilai,a.keterangan,a.kd_brg
		ORDER BY a.tahun,a.kd_brg,no_reg";
	}*/
}
            if($iz=='1'){             
             $hasil = $this->db->query($csql);
             $i = 1;
			 $nilaix=0;
			 $jml_brgx=0;
             foreach ($hasil->result() as $row)
             {  
				$jml_brgx = $row->jumlah+$jml_brgx;
				$nilaix = $row->nilai+$nilaix;
				//$total_nilai = $row->nilai;
                $tot = $row->jumlah * $row->nilai;
				
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">".number_format($row->nilai)."</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->keterangan</td>
                    
                </tr>";
                $i++;    
              
             }
                $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"12\"align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>".number_format($nilaix)."</b></td>
                </tr>";
				}elseif($iz=='2'){             
             $hasil = $this->db->query($csql);
             $i = 1;
			 $nilaix=0;
			 $jml_brgx=0;
             foreach ($hasil->result() as $row)
             {  
				$jml_brgx = $row->jumlah+$jml_brgx;
				$nilaix = $row->nilai+$nilaix;
				//$total_nilai = $row->nilai;
                $tot = $row->jumlah * $row->nilai;
				
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->nilai</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->keterangan</td>
                    
                </tr>";
                $i++;    
              
             }
                $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"12\"align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$nilaix</b></td>
                </tr>";
				}
            $cRet .="
			 <tr></tr>
			<br/>
			<!--table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\"-->
			     
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;font-family: tahoma;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
						<u>( $nm_tahu )</u><br>NIP. $nip_tahu   
                        </td>
						
						<td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;font-family: tahoma;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_bend )</u><br>NIP. $nip_bend  
                        </td>
                    </tr></table>";
					//
		//$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'BUKU INVENTARIS';
        $this->template->set('title', 'BUKU INVENTARIS');  
        switch($iz) {
        case 1;  
		//$this->mdata->_mpdf3('',$cRet,4,3,3,3,$kertas,1);   
		echo $cRet; 
             //$this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
           $this->load->view('transaksi/excel', $data);
        break;
        }
					
				//echo $cRet;
				/*$cRet .=" </table>";
		$kertas='LEGAL';  
        $data['prev']= $cRet;
        $this->template->set('title', 'LAPORAN INVENTARIS');   
		$this->mdata->_mpdf3('',$cRet,10,10,10,2,$kertas,3);   */    
        //$this->_mpdf('',$cRet,5,5,5,1);
         } 
	}
	function lap_aset_lainnya2x(){
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
		$ctahun		= $_REQUEST['tahun'];
		$jenis		= $_REQUEST['jenis'];
        $lctgl 		= $_REQUEST['tgl'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
        
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		} 
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs 	  = $this->db->query($csql1);
        $trh2 	  = $rs->row();
        $nm_bend  = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
	// legal = 21.59 x 35.56 // 215 x 355
	define('FPDF_FONTPATH', $this->config->item('fonts_path'));

	$this->load->library('fpdf');

	$this->fpdf->FPDF($orientation='L', $unit='mm', $size='LEGAL');
	$this->fpdf->addPage();
	
	$this->fpdf->SetMargins($left = 10, $top = 10, $right = 10);

	// sisa panjang dalam = 215 - (10 + 10) = 195
	// $this->fpdf->SetFontSize(12);
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='LAPORAN ASET LAINNYA', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	if($jenis=='2'){
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='KIB B (PERALATAN DAN MESIN)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	}if($jenis=='3'){
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='KIB C (BANGUNAN DAN GEDUNG)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	}if($jenis=='4'){
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='KIB D (JARINGAN DAN IRIGASI)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	}if($jenis=='5'){
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='KIB E (ASET TENTAP LAINNYA)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	}

	$this->fpdf->Ln();
	
	$this->fpdf->SetFont('helvetica','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='SKPD ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_skpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();

	$this->fpdf->Cell($w = 50, $h = 5, $txt='KABUPATEN/KOTA ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$kota, $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	
	$this->fpdf->Cell($w = 50, $h = 5, $txt='PROVINSI ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$prov, $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();

	$height_table  = 5;
	$width_no_urut = 30;
	$width_rek     = 80;
	$width_nilai   = 20;
//test
		
    //$fa 		= $this->SetX((210-$w)/2);
	
		$this->fpdf->Setx(10);
	$this->fpdf->Cell(60, $height_table, $txt='NOMOR', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(103, $height_table, $txt='SPESIFIKASI BARANG', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->SetFont('helvetica','B',8);
	$this->fpdf->Cell(20, 17, $txt='Bahan', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 17, $txt='Asal', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 17, $txt='Tahun Peroleh', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 17, $txt='Ukuran Barang', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 17, $txt='Satuan', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 17, $txt='Kondisi', $border=1, $ln=0, $align='C', $fill=false, $link='');
/* 	$this->fpdf->Cell($width_nilai, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell($width_nilai, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell($width_nilai, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell($width_nilai, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
 */	$this->fpdf->Setx(273);
	$this->fpdf->SetFont('helvetica','B',10);
	$this->fpdf->Cell(37, $height_table, $txt='JUMLAH', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, $height_table, $txt='KET', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();	
	
	$height_table  = 7;
	$width_no_urut = 30;
	$width_rek     = 115;
	$width_nilai   = 15;
	
	$this->fpdf->SetFillColor(255,255,250);
	$this->fpdf->SetFont('helvetica','B',8);
	$this->fpdf->Cell(15, $height_table, $txt='No. Urut', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, $height_table, $txt='Kode Barang', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, $height_table, $txt='Register', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, $height_table, $txt='Nama Barang', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, $height_table, $txt='Merk/Type', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, $height_table, $txt='No.Mesin', $border=1, $ln=0, $align='C', $fill=false, $link='');
	//$this->fpdf->Sety(10);
	$this->fpdf->Setx(190);
	//$this->fpdf->Cell(20, 17, $txt='Bahan', $border=1, $ln=0, $align='C', $fill=false, $link='');
	/* 
	$this->fpdf->Cell(20, $height_table, $txt='Asal', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, $height_table, $txt='Tahun Peroleh', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, $height_table, $txt='Ukuran Barang', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, $height_table, $txt='Satuan', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, $height_table, $txt='Kondisi', $border=1, $ln=0, $align='C', $fill=false, $link=''); */
	$this->fpdf->Setx(273);
	$this->fpdf->Cell(10, $height_table, $txt='Barang', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, $height_table, $txt='Harga', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();

	
	$this->fpdf->Cell(15, 5, $txt='1', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $txt='2', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $txt='3', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $txt='4', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $txt='5', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='6', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='7', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='8', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='9', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='10', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $txt='11', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $txt='12', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $txt='13', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $txt='14', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $txt='15', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
    if($jenis=='1'){       	
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.kondisi='RB' and a.no_hapus is null GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek,
	a.silinder,a.tahun,a.kd_warna,a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai";  

    $query = $this->db->query($sql1x);
	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai2=0;
	$jumlah2=0;$i=1;
    foreach ($query->result() as $row){
		$nilai2 = $row->nilai2+$nilai2;
		$jumlah2 = $row->jumlah2+$jumlah2;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
	$this->fpdf->SetFont('helvetica','',8);	
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
           
	$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.kondisi='RB' and a.no_hapus is null group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
	a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai";  
	  
    $query = $this->db->query($sql1xx);
    

	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai3=0;
	$jumlah3=0;
    foreach ($query->result() as $row){
		$nilai3 = $row->nilai3+$nilai3;
		$jumlah3 = $row->jumlah3+$jumlah3;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}	
	
	           
	$sql1xxy="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,
	'' AS merek,a.no_dok AS gabung,'' AS kd_bahan,a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,
	a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,SUM(nilai) AS nilai3,COUNT(nilai) AS jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_d a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.kondisi='RB' and a.no_hapus is null 
	group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan";  
	  
    $query = $this->db->query($sql1xxy);
    

	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai3y=0;
	$jumlah3y=0;
    foreach ($query->result() as $row){
		$nilai3y = $row->nilai3+$nilai3y;
		$jumlah3y = $row->jumlah3+$jumlah3y;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
	
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.kondisi='RB' and a.no_hapus is null GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tipe,a.nilai,a.keterangan	";  
	  
    $query = $this->db->query($sql1xxxx);
	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai5=0;
	$jumlah5=0;
    foreach ($query->result() as $row){
		$nilai5 = $row->nilai5+$nilai5;
		$jumlah5 = $row->jumlah5+$jumlah5;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
	}else{
		if($jenis=='2'){
				$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.kondisi='RB' and a.no_hapus is null GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek,
	a.silinder,a.tahun,a.kd_warna,a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai";  

    $query = $this->db->query($sql1x);
	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai2=0;
	$jumlah2=0;$i=1;
    foreach ($query->result() as $row){
		$nilai2 = $row->nilai2+$nilai2;
		$jumlah2 = $row->jumlah2+$jumlah2;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
	$this->fpdf->SetFont('helvetica','',8);	
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
		}elseif($jenis=='3'){
				$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.kondisi='RB' and a.no_hapus is null group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
	a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai";  
	  
    $query = $this->db->query($sql1xx);
    

	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai3=0;
	$jumlah3=0;$i=1;
    foreach ($query->result() as $row){
		$nilai3 = $row->nilai3+$nilai3;
		$jumlah3 = $row->jumlah3+$jumlah3;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
		}elseif($jenis=='4'){
				$sql1xxy="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,
	'' AS merek,a.no_dok AS gabung,'' AS kd_bahan,a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,
	a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,SUM(nilai) AS nilai3,COUNT(nilai) AS jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_d a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.kondisi='RB' and a.no_hapus is null 
	group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan";  
    $query = $this->db->query($sql1xxy);

	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai3y=0;
	$jumlah3y=0;$i=1;
    foreach ($query->result() as $row){
		$nilai3y = $row->nilai3+$nilai3y;
		$jumlah3y = $row->jumlah3+$jumlah3y;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
		}else{
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.kondisi='RB' and a.no_hapus is null GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tipe,a.nilai,a.keterangan	";  
	  
    $query = $this->db->query($sql1xxxx);
	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai5=0;
	$jumlah5=0;$i=1;
    foreach ($query->result() as $row){
		$nilai5 = $row->nilai5+$nilai5;
		$jumlah5 = $row->jumlah5+$jumlah5;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
		}
	}
		
		$cRet="<tr>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				</tr>";
	if($jenis=='1'){
	$jumlahx = $jumlah2+$jumlah3+$jumlah3y+$jumlah5;
	$totalx  = $nilai2+$nilai3+$nilai3y+$nilai5;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	}elseif($jenis=='2'){
	$jumlahx = $jumlah2;
	$totalx  = $nilai2;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	}elseif($jenis=='3'){
	$jumlahx = $jumlah3;
	$totalx  = $nilai3;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	}elseif($jenis=='4'){
	$jumlahx = $jumlah3y;
	$totalx  = $nilai3y;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	}else{
	$jumlahx = $jumlah5;
	$totalx  = $nilai5;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	}
	$this->fpdf->SetFont('helvetica','',11);$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, $kota.", ".$this->tanggal_indonesia($lctgl), $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, $text='MENGETAHUI', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "KEPALA ".rtrim($cnm_skpd), $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "PENGURUS BARANG", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();$this->fpdf->Ln();$this->fpdf->Ln();$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "(".$nm_tahu.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "(".$nm_bend.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$nip_tahu, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$nip_bend, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Output();

}

	/*END FPDF*/	
	public function lap_aset_lainnya2()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
		$ctahun		= $_REQUEST['tahun'];
		$jenis		= $_REQUEST['jenis'];
        $lctgl 		= $_REQUEST['tgl'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
        
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		} 
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs 	  = $this->db->query($csql1);
        $trh2 	  = $rs->row();
        $nm_bend  = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
		$cRet  = "";
				                 if($iz=='1'){
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
			<td  width=\"10%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>LAPORAN ASET LAINNYA</b></td>
			<td></td></tr>
								 ";}else{
									 $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
			<td  width=\"10%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>LAPORAN ASET LAINNYA</b></td>
			<td></td></tr>
								 ";
								 }
			if($jenis=='2'){
			$cRet .= "<tr><td></td>
                <th colspan=\"2\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>KIB B (PERALATAN DAN MESIN)</b></th>
			<td></td>
			</tr>";}
			if($jenis=='3'){
			$cRet .= "<tr><td></td>
                <th colspan=\"2\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>KIB C (GEDUNG DAN BANGUNAN)</b></th>
			<td></td></tr>";}
			if($jenis=='4'){
			$cRet .= "<tr><td></td>
                <th colspan=\"2\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>KIB D (JALAN IRIGASI DAN JARINGAN)</b></th>
			<td></td></tr>";}
			if($jenis=='5'){
				$cRet .= "<tr><td></td>
                <th colspan=\"2\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>KIB E (ASET TETAP LAINNYA)</b></th>
			<td></td></tr>";}
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
				<br/>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KABUPATEN/KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
				<td width =\"30%\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KODE LOKASI</td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cskpd</td>
            </tr>
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Asal/Cara<br/>Perolehan<br/>Barang</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Satuan</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Keadaan<br/>Barang</td>
				<td colspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Jumlah</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Keterangan</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Nomor<BR/>Urut</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Kode<br/>Barang</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Register</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Nama/Jenis<BR/>Barang</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Merk<br/>Type</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Barang</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Harga</td>
			</tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
			    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">11</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">12</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">13</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">14</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">15</td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"11%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				
            </tr>
			</thead>";
			             if($jenis=='1'){
             //OR ((a.kd_riwayat='3' OR a.kd_riwayat='4') AND a.kd_skpd='$cskpd') OR ((a.kd_riwayat='3' OR a.kd_riwayat='4') AND a.kd_skpd='$cskpd') OR ((a.kd_riwayat='3' OR a.kd_riwayat='4') AND a.kd_skpd='$cskpd')
$csql = "SELECT * FROM 
(SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' and a.kondisi='RB' 
and a.no_hapus is null GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek,
a.silinder,a.tahun,a.kd_warna,a.kd_bahan,a.asal,a.pabrik,a.no_rangka,
a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai,a.keterangan
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' and a.kondisi='RB' and a.no_hapus is null 
group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,
a.panjang AS merek,a.no_dok AS gabung,a.konstruksi AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.luas AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,
IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_d a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' 
AND a.kondisi='RB' AND a.no_hapus IS NULL 
GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.panjang,a.luas,a.lebar,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.asal,a.nilai
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' and a.kondisi='RB' and a.no_hapus is null 
 GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tipe,a.nilai,a.keterangan) faiz  ORDER BY kd_brg,no_reg";
 			 }else{
				  if($jenis=='2'){
				 $csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' and a.kondisi='RB' 
and a.no_hapus is null GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek,
a.silinder,a.tahun,a.kd_warna,a.kd_bahan,a.asal,a.pabrik,a.no_rangka,
a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai,a.keterangan"; 
				 }elseif($jenis=='3'){
				 $csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' and a.kondisi='RB' and a.no_hapus is null 
group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai"; 
				 }elseif($jenis=='4'){
				 $csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,
a.panjang AS merek,a.no_dok AS gabung,a.konstruksi AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.luas AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,
IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_d a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' 
AND a.kondisi='RB' AND a.no_hapus IS NULL 
GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.panjang,a.luas,a.lebar,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.asal,a.nilai"; 
				 }else{
				 $csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' and a.kondisi='RB' and a.no_hapus is null 
 GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tipe,a.nilai,a.keterangan"; 
				 }
			 }
             $hasil = $this->db->query($csql);
             $i = 1;
			 $nilaix=0;
			 $jml_brgx=0;
             foreach ($hasil->result() as $row)
             {  
				$jml_brgx = $row->jumlah+$jml_brgx;
				$nilaix = $row->nilai+$nilaix;
				//$total_nilai = $row->nilai;
                $tot = $row->jumlah * $row->nilai;
				if($iz=='1'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">".number_format($row->nilai)."</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->keterangan</td>
                    
                </tr>";}
				elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->nilai</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->keterangan</td>
                    
                </tr>";}
                $i++;    
              
             }//
			 if($iz=='1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"12\"align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
			 elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"12\"align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
            $cRet .="
			 <tr></tr>
			<br/>
			<!--table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\"-->
			     
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;font-family: tahoma;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_tahu )</u><br>NIP. $nip_tahu 
                        </td>
						
						<td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;font-family: tahoma;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_bend )</u><br>NIP. $nip_bend    
                        </td>
                    </tr></table>";
					
		
		//$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan Aset Lainnya';
        $this->template->set('title', 'Laporan Aset Lainnya');  
        switch($iz) {
        case 1;  
		//$this->mdata->_mpdf3('',$cRet,4,3,3,3,$kertas,1);   
		echo $cRet; 
            // $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            
            $this->load->view('transaksi/excel', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
           $this->load->view('transaksi/excel', $data);
        break;
        }
         } 
	}
	
	public function lap_eca()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
         
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
		$ctahun		= $_REQUEST['tahun'];
		$jenis		= $_REQUEST['jenis'];
        $lctgl 		= $_REQUEST['tgl'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
        
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		} 
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs 	  = $this->db->query($csql1);
        $trh2 	  = $rs->row();
        $nm_bend  = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
		$cRet  = "";
				                 if($iz=='1'){
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>LAPORAN EKSTRA COUNTABLE ASSET (ECA)</b></td>
				<td width=\"20%\"></td>			
								 </tr>";}else{
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>LAPORAN EKSTRA COUNTABLE ASSET (ECA)</b></td>
				<td width=\"20%\"></td>			
								 </tr>";
								 }
				
			if($jenis=='2'){
			$cRet .= "<tr><td width=\"5%\"></td>	
                <th colspan=\"2\" align=\"center\" style=\"font-size:14px;font-family: tahoma;\"><b>KIB B (PERALATAN DAN MESIN)</b></th>
				<td width=\"5%\"></td>			
				</tr>";}
			if($jenis=='3'){
			$cRet .= "<tr><td width=\"20%\"></td>	
                <th colspan=\"2\" align=\"center\" style=\"font-size:14px;font-family: tahoma;\"><b>KIB C (GEDUNG DAN BANGUNAN)</b></th>
				<td width=\"5%\"></td>			
			</tr>";}
			if($jenis=='4'){
			$cRet .= "<tr><td width=\"20%\"></td>	
                <th colspan=\"2\" align=\"center\" style=\"font-size:14px;font-family: tahoma;\"><b>KIB D (JALAN IRIGASI DAN JARINGAN)</b></th>
				<td width=\"5%\"></td>			
			</tr>";}
			if($jenis=='5'){
				$cRet .= "<tr><td width=\"20%\"></td>	
                <th colspan=\"2\" align=\"center\" style=\"font-size:14px;font-family: tahoma;\"><b>KIB E (ASET TETAP LAINNYA)</b></th>
				<td width=\"5%\"></td>			
			</tr>";}
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
				<br/>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KABUPATEN/KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
				<td width =\"30%\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KODE LOKASI</td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cskpd</td>
            </tr>
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Asal/Cara<br/>Perolehan<br/>Barang</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Satuan</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Keadaan<br/>Barang</td>
				<td colspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Jumlah</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Keterangan</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Nomor<BR/>Urut</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Kode<br/>Barang</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Register</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Nama/Jenis<BR/>Barang</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Merk<br/>Type</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Barang</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:12px;font-family: tahoma;\">Harga</td>
			</tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
			    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">11</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">12</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">13</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">14</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">15</td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"11%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				
            </tr>
			</thead>";
             if($jenis=='1'){
$csql = "SELECT * FROM 
(
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and (a.nilai<500000 or a.kd_riwayat='1') 
and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.no_hapus is null GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and (a.nilai<10000000 or a.kd_riwayat='1') 
and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.no_hapus is null group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,'' AS merek,a.no_dok AS gabung,'' AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_d a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and (a.nilai<10000000 or a.kd_riwayat='1') 
and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.no_hapus is null group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan	 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and (a.nilai<500000 or a.kd_riwayat='1') 
and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.no_hapus is null GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan
			 ) faiz  ORDER BY kd_brg,no_reg";
			 }else{
				 if($jenis=='2'){
				 $csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and (a.nilai<500000 or a.kd_riwayat='1') 
and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.no_hapus is null GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan"; 
				 }elseif($jenis=='3'){
				 $csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and (a.nilai<10000000 or a.kd_riwayat='1') 
and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.no_hapus is null group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan 
"; 
				 }elseif($jenis=='4'){
				 $csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,'' AS merek,a.no_dok AS gabung,'' AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_d a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and (a.nilai<10000000 or a.kd_riwayat='1') 
and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.no_hapus is null group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan	 
"; 
				 }else{
				 $csql = "SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and (a.nilai<500000 or a.kd_riwayat='1') 
and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.no_hapus is null GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan
"; 
				 }
			 }
            		 
             $hasil = $this->db->query($csql);
             $i = 1;
			 $nilaix=0;
			 $jml_brgx=0;
             foreach ($hasil->result() as $row)
             {  
				$jml_brgx = $row->jumlah+$jml_brgx;
				$nilaix = $row->nilai+$nilaix;
				//$total_nilai = $row->nilai;
                $tot = $row->jumlah * $row->nilai;
				if($iz=='1'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">".number_format($row->nilai)."</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->keterangan</td>
                    
                </tr>";}
				elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->nilai</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\">$row->keterangan</td>
                    
                </tr>";}
                $i++;    
              
             }//
				if($iz=='1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"12\"align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
				elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"12\"align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#ADFF2F\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;font-family: tahoma;\"><b>Rp. $nilaix</b></td>
                </tr>";}
            $cRet .="
			 <tr></tr>
			<br/>
			<!--table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\"-->
			     
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;font-family: tahoma;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
						<u>( $nm_tahu )</u><br>NIP. $nip_tahu   
                        </td>
						
						<td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;font-family: tahoma;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_bend )</u><br>NIP. $nip_bend  
                        </td>
                    </tr></table>";
					
		
		//$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan ECA';
        $this->template->set('title', 'Laporan ECA');  
        switch($iz) {
        case 1;  
		//$this->mdata->_mpdf3('',$cRet,4,3,3,3,$kertas,1);   
		echo $cRet; 
             //$this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            
            $this->load->view('transaksi/excel', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
           $this->load->view('transaksi/excel', $data);
        break;
        }
         } 
	}
	
	function lap_ecax(){
	
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
		$ctahun		= $_REQUEST['tahun'];
		$jenis		= $_REQUEST['jenis'];
        $lctgl 		= $_REQUEST['tgl'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
        
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		} 
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs 	  = $this->db->query($csql1);
        $trh2 	  = $rs->row();
        $nm_bend  = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
	// legal = 21.59 x 35.56 // 215 x 355
	define('FPDF_FONTPATH', $this->config->item('fonts_path'));

	$this->load->library('fpdf');

	$this->fpdf->FPDF($orientation='L', $unit='mm', $size='LEGAL');
	$this->fpdf->addPage();
	
	$this->fpdf->SetMargins($left = 10, $top = 10, $right = 10);

	// sisa panjang dalam = 215 - (10 + 10) = 195
	// $this->fpdf->SetFontSize(12);
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='LAPORAN EKSTRA COUNTABLE ASSET (ECA)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	if($jenis=='2'){
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='KIB B (PERALATAN DAN MESIN)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	}if($jenis=='3'){
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='KIB C (BANGUNAN DAN GEDUNG)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	}if($jenis=='4'){
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='KIB D (JARINGAN DAN IRIGASI)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	}if($jenis=='5'){
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='KIB E (ASET TENTAP LAINNYA)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	}

	$this->fpdf->Ln();
	
	$this->fpdf->SetFont('helvetica','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='SKPD ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_skpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();

	$this->fpdf->Cell($w = 50, $h = 5, $txt='KABUPATEN/KOTA ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$kota, $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	
	$this->fpdf->Cell($w = 50, $h = 5, $txt='PROVINSI ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$prov, $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();

	$height_table  = 5;
	$width_no_urut = 30;
	$width_rek     = 80;
	$width_nilai   = 20;
//test
		
    //$fa 		= $this->SetX((210-$w)/2);
	
		$this->fpdf->Setx(10);
	$this->fpdf->Cell(60, $height_table, $txt='NOMOR', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(103, $height_table, $txt='SPESIFIKASI BARANG', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->SetFont('helvetica','B',8);
	$this->fpdf->Cell(20, 17, $txt='Bahan', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 17, $txt='Asal', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 17, $txt='Tahun Peroleh', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 17, $txt='Ukuran Barang', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 17, $txt='Satuan', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 17, $txt='Kondisi', $border=1, $ln=0, $align='C', $fill=false, $link='');
/* 	$this->fpdf->Cell($width_nilai, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell($width_nilai, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell($width_nilai, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell($width_nilai, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
 */	$this->fpdf->Setx(273);
	$this->fpdf->SetFont('helvetica','B',10);
	$this->fpdf->Cell(37, $height_table, $txt='JUMLAH', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, $height_table, $txt='KET', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();	
	
	$height_table  = 7;
	$width_no_urut = 30;
	$width_rek     = 115;
	$width_nilai   = 15;
	
	$this->fpdf->SetFillColor(255,255,250);
	$this->fpdf->SetFont('helvetica','B',8);
	$this->fpdf->Cell(15, $height_table, $txt='No. Urut', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, $height_table, $txt='Kode Barang', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, $height_table, $txt='Register', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, $height_table, $txt='Nama Barang', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, $height_table, $txt='Merk/Type', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, $height_table, $txt='No.Mesin', $border=1, $ln=0, $align='C', $fill=false, $link='');
	//$this->fpdf->Sety(10);
	$this->fpdf->Setx(190);
	//$this->fpdf->Cell(20, 17, $txt='Bahan', $border=1, $ln=0, $align='C', $fill=false, $link='');
	/* 
	$this->fpdf->Cell(20, $height_table, $txt='Asal', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, $height_table, $txt='Tahun Peroleh', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, $height_table, $txt='Ukuran Barang', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, $height_table, $txt='Satuan', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, $height_table, $txt='Kondisi', $border=1, $ln=0, $align='C', $fill=false, $link=''); */
	$this->fpdf->Setx(273);
	$this->fpdf->Cell(10, $height_table, $txt='Barang', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, $height_table, $txt='Harga', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, $height_table, $txt='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();

	
	$this->fpdf->Cell(15, 5, $txt='1', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $txt='2', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $txt='3', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $txt='4', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $txt='5', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='6', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='7', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='8', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='9', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='10', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $txt='11', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $txt='12', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $txt='13', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $txt='14', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $txt='15', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
    if($jenis=='1'){       	
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.nilai<'500000' and a.kondisi<>'RB' and a.no_hapus is null GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek,
	a.silinder,a.tahun,a.kd_warna,a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai";  

    $query = $this->db->query($sql1x);
	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai2=0;
	$jumlah2=0;$i=1;
    foreach ($query->result() as $row){
		$nilai2 = $row->nilai2+$nilai2;
		$jumlah2 = $row->jumlah2+$jumlah2;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
	$this->fpdf->SetFont('helvetica','',8);	
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
           
	$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.nilai<'10000000' and a.kondisi<>'RB' and a.no_hapus is null group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
	a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai";  
	  
    $query = $this->db->query($sql1xx);
    

	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai3=0;
	$jumlah3=0;
    foreach ($query->result() as $row){
		$nilai3 = $row->nilai3+$nilai3;
		$jumlah3 = $row->jumlah3+$jumlah3;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}	
	
	           
	$sql1xxy="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,
	'' AS merek,a.no_dok AS gabung,'' AS kd_bahan,a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,
	a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,SUM(nilai) AS nilai3,COUNT(nilai) AS jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_d a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.nilai<'10000000' and a.kondisi<>'RB' and a.no_hapus is null 
	group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan";  
	  
    $query = $this->db->query($sql1xxy);
    

	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai3y=0;
	$jumlah3y=0;
    foreach ($query->result() as $row){
		$nilai3y = $row->nilai3+$nilai3y;
		$jumlah3y = $row->jumlah3+$jumlah3y;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
	
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.nilai<'500000' and a.kondisi<>'RB' and a.no_hapus is null GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tipe,a.nilai,a.keterangan	";  
	  
    $query = $this->db->query($sql1xxxx);
	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai5=0;
	$jumlah5=0;
    foreach ($query->result() as $row){
		$nilai5 = $row->nilai5+$nilai5;
		$jumlah5 = $row->jumlah5+$jumlah5;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
	}else{
		if($jenis=='2'){
				$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.nilai<'500000' and a.kondisi<>'RB' and a.no_hapus is null GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek,
	a.silinder,a.tahun,a.kd_warna,a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai";  

    $query = $this->db->query($sql1x);
	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai2=0;
	$jumlah2=0;$i=1;
    foreach ($query->result() as $row){
		$nilai2 = $row->nilai2+$nilai2;
		$jumlah2 = $row->jumlah2+$jumlah2;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
	$this->fpdf->SetFont('helvetica','',8);	
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
		}elseif($jenis=='3'){
				$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.nilai<'10000000' and a.kondisi<>'RB' and a.no_hapus is null group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
	a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai";  
	  
    $query = $this->db->query($sql1xx);
    

	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai3=0;
	$jumlah3=0;$i=1;
    foreach ($query->result() as $row){
		$nilai3 = $row->nilai3+$nilai3;
		$jumlah3 = $row->jumlah3+$jumlah3;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
		}elseif($jenis=='4'){
				$sql1xxy="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,
	'' AS merek,a.no_dok AS gabung,'' AS kd_bahan,a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,
	a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,SUM(nilai) AS nilai3,COUNT(nilai) AS jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_d a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.nilai<'10000000' and a.kondisi<>'RB' and a.no_hapus is null 
	group by a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan";  
	  
    $query = $this->db->query($sql1xxy);
    

	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai3y=0;
	$jumlah3y=0;$i=1;
    foreach ($query->result() as $row){
		$nilai3y = $row->nilai3+$nilai3y;
		$jumlah3y = $row->jumlah3+$jumlah3y;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
		}else{
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$sampai_tgl' $th and a.nilai<'500000' and a.kondisi<>'RB' and a.no_hapus is null GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tipe,a.nilai,a.keterangan	";  
	  
    $query = $this->db->query($sql1xxxx);
	$this->fpdf->SetFont('Arial','',9);  
	$height_table = 5;
	$nilai5=0;
	$jumlah5=0;$i=1;
    foreach ($query->result() as $row){
		$nilai5 = $row->nilai5+$nilai5;
		$jumlah5 = $row->jumlah5+$jumlah5;
		$kd_brg = $row->kd_brg;
        $no_reg = $row->no_reg;
        $nm_brg = $row->nm_brg;
        $merek  = $row->merek;
        $gabung = $row->gabung;
        $kd_bahan = $row->kd_bahan;
        $asal = $row->asal;
        $tahun = $row->tahun;
        $silinder = $row->silinder;
        $kd_satuan = $row->kd_satuan;
        $kondisi = $row->kondisi;
        $jumlah = $row->jumlah;
		$nilai  = number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->SetFont('helvetica','',8);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $no_reg , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $silinder, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kd_satuan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, strtolower($keterangan), $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$i++;
	}
		}
	}
		
		$cRet="<tr>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				<td bgcolor=\"#ADFF2F\">sadas</td>
				</tr>";
	if($jenis=='1'){
	$jumlahx = $jumlah2+$jumlah3+$jumlah3y+$jumlah5;
	$totalx  = $nilai2+$nilai3+$nilai3y+$nilai5;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	}elseif($jenis=='2'){
	$jumlahx = $jumlah2;
	$totalx  = $nilai2;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	}elseif($jenis=='3'){
	$jumlahx = $jumlah3;
	$totalx  = $nilai3;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	}elseif($jenis=='4'){
	$jumlahx = $jumlah3y;
	$totalx  = $nilai3y;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	}else{
	$jumlahx = $jumlah5;
	$totalx  = $nilai5;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	}
	$this->fpdf->SetFont('helvetica','',11);$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, $kota.", ".$this->tanggal_indonesia($lctgl), $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, $text='MENGETAHUI', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "KEPALA ".rtrim($cnm_skpd), $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "PENGURUS BARANG", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();$this->fpdf->Ln();$this->fpdf->Ln();$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "(".$nm_tahu.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "(".$nm_bend.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$nip_tahu, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$nip_bend, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Output();

}
	/*END FPDF*/	
	
	public function lap_eca_rekap()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
         
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
		$oto  		= $this->session->userdata('otori');
        //$mengetahui	= $_REQUEST['mengetahui'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $nip_tahu 	= $_REQUEST['tahu'];
        $nip_bend 	= $_REQUEST['bend'];
        $nm_tahu 	= $_REQUEST['nmtahu'];
        $nm_bend 	= $_REQUEST['nmbend'];
		$ctahun		= $_REQUEST['tahun'];
		//$jenis		= $_REQUEST['jenis'];
        $lctgl 		= $_REQUEST['tgl'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$where		="";
		if($oto='01'){
			$where="where kd_skpd like '%$cskpd%'";
		}else{
			$where="where kd_skpd='$cskpd'";
		}/* 
        $skpdx		= "";
		if($cskpd<>''){
			$skpdx	="and a.kd_skpd='$cskpd'";
		} */
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		} 
        // identitas yang mengetahuin / pengguna anggaran
  /*       if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        } */
        // identitas bendahara
        
       /*  if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs 	  = $this->db->query($csql1);
        $trh2 	  = $rs->row();
        $nm_bend  = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        } */
        
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <th colspan=\"2\" align=\"center\" style=\"font-size:16px;font-family: tahoma;\"><b>LAPORAN RAKAP EKSTRA COUNTABLE ASSET (ECA)</b></th>
			</tr>";
			if($cskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;font-family: tahoma;\">&ensp;SKPD</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;font-family: tahoma;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
				<br/>
            </tr>";}
           $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;font-family: tahoma;\">&ensp;KABUPATEN/KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;font-family: tahoma;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;font-family: tahoma;\">&ensp;PROVINSI</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;font-family: tahoma;\">: $prov</td>
				<td width =\"30%\" align=\"right\" style=\"font-size:12px; font-family:tahoma;font-family: tahoma;\">&ensp;KODE LOKASI</td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;font-family: tahoma;\">: $cskpd</td>
            </tr>
            </table>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">KODE</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">SKPD</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">KIB B</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">KIB C</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">KIB D</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">KIB E</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">TOTAL NILAI</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">Jumlah</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">Nilai</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">Jumlah</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">Nilai</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">Jumlah</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">Nilai</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">Jumlah</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px;font-family: tahoma;\">Nilai</td>
			</tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
			    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
			    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"20%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				
            </tr>
			</thead>";
			
	$sql="SELECT kd_skpd,nm_skpd from ms_skpd $where";	
	$hasil = $this->db->query($sql);	
		$i=1;
	foreach ($hasil->result() as $row)
             {
				$skpd  = $row->kd_skpd;
				$nm_skpd = $row->nm_skpd; 
				
	$sql1="SELECT sum(a.nilai) as nilai,count(nilai) as jumlah FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg 
			WHERE a.no_hapus is null and (a.nilai<500000 or a.kd_riwayat='1') 
			and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.kd_skpd='$skpd' AND a.tgl_reg<='$sampai_tgl' $th";	
	$hsl1 = $this->db->query($sql1);	 
	foreach ($hsl1->result() as $row)
             {
				$jml1  = $row->jumlah;
				$nil1 = $row->nilai; 
			 }	
	$sql2="SELECT sum(a.nilai) as nilai,count(nilai) as jumlah FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg 
			WHERE a.no_hapus is null and (a.nilai<10000000 or a.kd_riwayat='1') 
			and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.kd_skpd='$skpd' AND a.tgl_reg<='$sampai_tgl' $th";	
	$hsl2 = $this->db->query($sql2);	 
	foreach ($hsl2->result() as $row)
             {
				$jml2  = $row->jumlah;
				$nil2 = $row->nilai; 
			 }
	$sql3="SELECT sum(a.nilai) as nilai,count(nilai) as jumlah FROM trkib_d a left join mbarang b on a.kd_brg=b.kd_brg 
			 WHERE a.no_hapus is null and (a.nilai<10000000 or a.kd_riwayat='1') 
			and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.kd_skpd='$skpd' AND a.tgl_reg<='$sampai_tgl' $th";	
	$hsl3 = $this->db->query($sql3);	 
	foreach ($hsl3->result() as $row)
             {
				$jml3  = $row->jumlah;
				$nil3 = $row->nilai; 
			 }
			 
	$sql4="SELECT sum(a.nilai) as nilai,count(nilai) as jumlah FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg 
			 WHERE a.no_hapus is null and (a.nilai<150000 or a.kd_riwayat='1') 
			and (a.kondisi<>'RB' or a.kd_riwayat<>'9') and a.kd_skpd='$skpd' AND a.tgl_reg<='$sampai_tgl' $th";	
	$hsl4 = $this->db->query($sql4);	 
	foreach ($hsl1->result() as $row)
             {
				$jml4  = $row->jumlah;
				$nil4 = $row->nilai; 
			 }		 
				$cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:12px; border-bottom:solid 1px black;\">$skpd</td>
                    <td align=\"left\" style=\"font-size:12px; border-bottom:solid 1px black;\">$nm_skpd</td>
                    <td align=\"center\" style=\"font-size:12px; border-bottom:solid 1px black;\">$jml1</td>
                    <td align=\"right\" style=\"font-size:12px; border-bottom:solid 1px black;\">".number_format($nil1)."</td>
                    <td align=\"center\" style=\"font-size:12px; border-bottom:solid 1px black;\">$jml2</td>
                    <td align=\"right\" style=\"font-size:12px; border-bottom:solid 1px black;\">".number_format($nil2)."</td>
                    <td align=\"center\" style=\"font-size:12px; border-bottom:solid 1px black;\">$jml3</td>
                    <td align=\"right\" style=\"font-size:12px; border-bottom:solid 1px black;\">".number_format($nil3)."</td>
                    <td align=\"center\" style=\"font-size:12px; border-bottom:solid 1px black;\">$jml4</td>
                    <td align=\"right\" style=\"font-size:12px; border-bottom:solid 1px black;\">".number_format($nil4)."</td>
                    <td align=\"right\" style=\"font-size:12px; border-bottom:solid 1px black;\">".number_format($nil1+$nil2+$nil3+$nil4)."</td>
				</tr>";
		$i++;
		}
		$cRet .=       " </table>";

		$cRet .="
			 <tr></tr>
			<br/>
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        <td colspan =\"5\" align=\"center\" style=\"font-size:12px;border: solid 1px white;font-family: tahoma;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
						<u>( $nm_tahu )</u><br>NIP. $nip_tahu   
                        </td>
						<td></td>
						<td colspan =\"5\" align=\"center\" style=\"font-size:12px;border: solid 1px white;font-family: tahoma;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_bend )</u><br>NIP. $nip_bend  
                        </td>
                    </tr>
					</table>";
					
		
		//$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan ECA';
        $this->template->set('title', 'Laporan ECA');  
        switch($iz) {
        case 1;  
		$this->_mpdfaiz('',$cRet,'10','10',12,'1');
		//$this->mdata->_mpdf3('',$cRet,4,3,3,3,$kertas,1);   
		//echo $cRet; 
        //$this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            
            $this->load->view('transaksi/excel', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
           $this->load->view('transaksi/excel', $data);
        break;
        }
         } 
	}
	
		public function lap_lainnya_rekap()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
         
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
		$oto  		= $this->session->userdata('otori');
        //$mengetahui	= $_REQUEST['mengetahui'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $nip_tahu 	= $_REQUEST['tahu'];
        $nip_bend 	= $_REQUEST['bend'];
        $nm_tahu 	= $_REQUEST['nmtahu'];
        $nm_bend 	= $_REQUEST['nmbend'];
		$ctahun		= $_REQUEST['tahun'];
		//$jenis		= $_REQUEST['jenis'];
        $lctgl 		= $_REQUEST['tgl'];
		$iz	 		= $_REQUEST['fa'];
		$where		="";
		if($oto='01'){
			$where="where kd_skpd like '%$cskpd%'";
		}else{
			$where="where kd_skpd='$cskpd'";
		}/* 
        $skpdx		= "";
		if($cskpd<>''){
			$skpdx	="and a.kd_skpd='$cskpd'";
		} */
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		} 
        // identitas yang mengetahuin / pengguna anggaran
  /*       if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        } */
        // identitas bendahara
        
       /*  if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs 	  = $this->db->query($csql1);
        $trh2 	  = $rs->row();
        $nm_bend  = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        } */
        
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <th colspan=\"2\" align=\"center\" style=\"font-size:16px; font-family:tahoma;\"><b>LAPORAN RAKAP ASET LAINNYA</b></th>
				<td></td>			
				</tr>";
			if($cskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
				<br/>
            </tr>";}
           $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KABUPATEN/KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
				<td width =\"30%\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KODE LOKASI</td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cskpd</td>
            </tr>
            </table>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">KODE</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">SKPD</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">KIB B</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">KIB C</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">KIB D</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">KIB E</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">TOTAL NILAI</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">Jumlah</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">Nilai</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">Jumlah</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">Nilai</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">Jumlah</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">Nilai</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">Jumlah</td>
				<td align=\"center\" bgcolor=\"#ADFF2F\"  style=\"font-size:14px; font-family:tahoma;\">Nilai</td>
			</tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
			    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
			    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"20%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				
            </tr>
			</thead>";
			
	$sql="SELECT kd_skpd,nm_skpd from ms_skpd $where";	
	$hasil = $this->db->query($sql);	
		$i=1;
	foreach ($hasil->result() as $row)
             {
				$skpd  = $row->kd_skpd;
				$nm_skpd = $row->nm_skpd; 
				
	$sql1="SELECT sum(a.nilai) as nilai,count(nilai) as jumlah FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg 
			WHERE a.no_hapus is null and a.kondisi='RB' and a.kd_skpd='$skpd' $th";	
	$hsl1 = $this->db->query($sql1);	 
	foreach ($hsl1->result() as $row)
             {
				$jml1  = $row->jumlah;
				$nil1 = $row->nilai; 
			 }	
	$sql2="SELECT sum(a.nilai) as nilai,count(nilai) as jumlah FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg 
			WHERE a.no_hapus is null and a.kondisi='RB' and a.kd_skpd='$skpd' $th";	
	$hsl2 = $this->db->query($sql2);	 
	foreach ($hsl2->result() as $row)
             {
				$jml2  = $row->jumlah;
				$nil2 = $row->nilai; 
			 }
	$sql3="SELECT sum(a.nilai) as nilai,count(nilai) as jumlah FROM trkib_d a left join mbarang b on a.kd_brg=b.kd_brg 
			 WHERE a.no_hapus is null and a.kondisi='RB' and a.kd_skpd='$skpd' $th";	
	$hsl3 = $this->db->query($sql3);	 
	foreach ($hsl3->result() as $row)
             {
				$jml3  = $row->jumlah;
				$nil3 = $row->nilai; 
			 }
			 
	$sql4="SELECT sum(a.nilai) as nilai,count(nilai) as jumlah FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg 
			 WHERE a.no_hapus is null and a.kondisi='RB' and a.kd_skpd='$skpd' $th";	
	$hsl4 = $this->db->query($sql4);	 
	foreach ($hsl1->result() as $row)
             {
				$jml4  = $row->jumlah;
				$nil4 = $row->nilai; 
			 }		 
				$cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:12px; border-bottom:solid 1px black; font-family:tahoma;\">$skpd</td>
                    <td align=\"left\" style=\"font-size:12px; border-bottom:solid 1px black; font-family:tahoma;\">$nm_skpd</td>
                    <td align=\"center\" style=\"font-size:12px; border-bottom:solid 1px black; font-family:tahoma;\">$jml1</td>
                    <td align=\"right\" style=\"font-size:12px; border-bottom:solid 1px black; font-family:tahoma;\">".number_format($nil1)."</td>
                    <td align=\"center\" style=\"font-size:12px; border-bottom:solid 1px black; font-family:tahoma;\">$jml2</td>
                    <td align=\"right\" style=\"font-size:12px; border-bottom:solid 1px black; font-family:tahoma;\">".number_format($nil2)."</td>
                    <td align=\"center\" style=\"font-size:12px; border-bottom:solid 1px black; font-family:tahoma;\">$jml3</td>
                    <td align=\"right\" style=\"font-size:12px; border-bottom:solid 1px black; font-family:tahoma;\">".number_format($nil3)."</td>
                    <td align=\"center\" style=\"font-size:12px; border-bottom:solid 1px black; font-family:tahoma;\">$jml4</td>
                    <td align=\"right\" style=\"font-size:12px; border-bottom:solid 1px black; font-family:tahoma;\">".number_format($nil4)."</td>
                    <td align=\"right\" style=\"font-size:12px; border-bottom:solid 1px black; font-family:tahoma;\">".number_format($nil1+$nil2+$nil3+$nil4)."</td>
				</tr>";
		$i++;
		}
		$cRet .=       " </table>";

		$cRet .="
			 <tr></tr>
			<br/>
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        <td colspan =\"5\" align=\"center\" style=\"font-size:12px;border: solid 1px white; font-family:tahoma;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
						<u>( $nm_tahu )</u><br>NIP. $nip_tahu   
                        </td>
						<td></td>
						<td colspan =\"5\" align=\"center\" style=\"font-size:12px;border: solid 1px white; font-family:tahoma;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_bend )</u><br>NIP. $nip_bend  
                        </td>
                    </tr>
					</table>";
					
		
		//$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan ECA';
        $this->template->set('title', 'Laporan ECA');  
        switch($iz) {
        case 1;  
		$this->_mpdfaiz('',$cRet,'10','10',12,'1');
		//$this->mdata->_mpdf3('',$cRet,4,3,3,3,$kertas,1);   
		//echo $cRet; 
        //$this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            
            $this->load->view('transaksi/excel', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
           $this->load->view('transaksi/excel', $data);
        break;
        }
         } 
	}

	public function lap_buku_inventaris()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		$cskpd    = $_REQUEST['kd_skpd'];
        $cnm_skpd = $_REQUEST['nm_skpd'];
        $lctahu   = $_REQUEST['tahu'];
        $lcbend   = $_REQUEST['bend'];
        $lctgl    = $_REQUEST['tgl'];
        $tahun    = $_REQUEST['tahun'];
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
                <td align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
				<th width =\"80%\" align=\"center\" style=\"font-size:14px; font-family:tahoma;\">REKAPITULASI BUKU INVENTARIS<br>(Rekap Hasil Sensus)</th>
				<td width=\"20%\"align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>
			
			<tr>
                <td align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $cnm_skpd</td>
				<td width =\"20%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;KAB/KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $kota</td>
				<td width =\"20%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $prov</td>
				<td width =\"20%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">Kode Lokasi: $cskpd </td>
            </tr>
            </table>
			
			<BR/>
			<BR/>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td width=\"5%\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:12px\">No.Urut</td>
                <td width=\"5%\" bgcolor=\"#ADFF2F\"  align=\"center\" style=\"font-size:12px\">Golongan</td>
                <td width=\"5%\" bgcolor=\"#ADFF2F\"  align=\"center\" style=\"font-size:12px\">Kode<br>Bidang<br>Barang</td>
                <td width=\"40%\" bgcolor=\"#ADFF2F\"  align=\"center\" style=\"font-size:12px\">Nama Bidang Barang</td>
                <td width=\"15%\" bgcolor=\"#ADFF2F\"  align=\"center\" style=\"font-size:12px\">Jumlah Barang</td>
                <td width=\"15%\" bgcolor=\"#ADFF2F\"  align=\"center\" style=\"font-size:12px\">Jumlah Harga<br>(Rp)</td>
                <td width=\"15%\" bgcolor=\"#ADFF2F\"  align=\"center\" style=\"font-size:12px\">Keterangan</td>
            </tr> 
			
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
            </tr>
            </thead> ";
            
            $csql = "SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,a.keterangan FROM trkib_a a 
                    LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY kd_brg
                    UNION SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,a.keterangan FROM trkib_b a 
                    LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY kd_brg
                    UNION SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,a.keterangan FROM trkib_c a 
                    LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY kd_brg
                    UNION SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,a.keterangan FROM trkib_d a 
                    LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY kd_brg                     
                    UNION SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,a.keterangan FROM trkib_e a 
                    LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY kd_brg
                    UNION SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,a.keterangan FROM trkib_a a 
                    LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY kd_brg
                   
                    ";
                                             
             $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {
                
                $cRet .="
                      	
                        <tr>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->gol</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_brg</td>
                            <td align=\"left\"   style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->jmlh</td>
                            <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">$row->harga</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->keterangan</td>
                         </tr>";
                 $i++;  			
              }
            $cRet .="</table><br/><br/>";
           
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Mengetahui,<br>Kepala SKPD<br><br><br><br></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Pengurus Barang<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">($nm_tahu)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">($nm_bend)</td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_tahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_bend</td>					
					</tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'RENCANA KEBUTUHAN BARANG');        
        $this->_mpdf('',$cRet,10,10,10,1);
         } 
	}
    
    
    function penghapusan($cskpd,$tahun,$kdbrg){
			$hapus=array();

			$sq2 = "SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trhapus_a a WHERE a.kd_brg ='$kdbrg' AND a.kd_unit = '$cskpd' AND a.tahun >='$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trhapus_b a WHERE a.kd_brg ='$kdbrg' AND a.kd_unit ='$cskpd' AND a.tahun >='$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trhapus_c a WHERE a.kd_brg ='$kdbrg' AND a.kd_unit ='$cskpd' AND a.tahun >='$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trhapus_d a WHERE a.kd_brg ='$kdbrg' AND a.kd_unit ='$cskpd' AND a.tahun >='$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trhapus_e a WHERE a.kd_brg ='$kdbrg' AND a.kd_unit ='$cskpd' AND a.tahun >='$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trhapus_f a WHERE a.kd_brg ='$kdbrg' AND a.kd_unit ='$cskpd' AND a.tahun >='$tahun' "; 

					 
			$query2 = $this->db->query($sq2);  
			foreach($query2->result_array() as $resulte2){					
				$jmlhps=$resulte2['jmlh'];
				$hrghps=$resulte2['harga'];
				
			}      
		
			$hapus['jmlhps']=$jmlhps;
			$hapus['hrghps']   =$hrghps;
			return $hapus;
	}

    
    
	
	public function lap_buku_inventaris2()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		$cskpd    = $_REQUEST['kd_skpd'];
        $cnm_skpd = $_REQUEST['nm_skpd'];
        $lctahu   = $_REQUEST['tahu'];
        $lcbend   = $_REQUEST['bend'];
        $lctgl    = $_REQUEST['tgl'];
        $tahun    = $_REQUEST['tahun'];
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
                <td width=\"10%\"align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
				<th width =\"80%\" align=\"center\" style=\"font-size:14px; font-family:tahoma;\">REKAPITULASI BUKU INVENTARIS<br>(Rekap Hasil Sensus)</th>
				<td width=\"10%\"align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $cnm_skpd</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;KAB/KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $prov</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">Kode Lokasi: $cskpd</td>
            </tr>
            </table>
			
			<BR/>
			<BR/>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" width=\"5%\" align=\"center\" style=\"font-size:12px\">No.Urut</td>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" width=\"5%\" align=\"center\" style=\"font-size:12px\">Golongan</td>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" width=\"5%\" align=\"center\" style=\"font-size:12px\">Kode<br>Bidang<br>Barang</td>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" width=\"30%\" align=\"center\" style=\"font-size:12px\">Nama Bidang Barang</td>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:12px\">Jumlah Barang</td>
                <td colspan=\"4\" bgcolor=\"#ADFF2F\" width=\"40%\" align=\"center\" style=\"font-size:12px\">Jumlah Harga<br>(Rp)</td>
                <td rowspan=\"2\" bgcolor=\"#ADFF2F\" width=\"5%\" align=\"center\" style=\"font-size:12px\">Keterangan</td>
            </tr> 

			<tr>
                <td align=\"center\"  bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Saldo Awal</td>
                <td align=\"center\"  bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Bertambah</td>
                <td align=\"center\"  bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Berkurang</td>
                <td align=\"center\"  bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Saldo Akhir</td>
			</tr>
			
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
			</tr>
            </thead> ";
            
     $csql = "SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,''AS jmlh_hps,''AS harga_hps, a.keterangan FROM trkib_a a 
            LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd'  AND a.tahun<'$tahun' GROUP BY kd_brg
            UNION SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,''AS jmlh_hps,''AS harga_hps, a.keterangan FROM trkib_b a 
            LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd'  AND a.tahun<'$tahun' GROUP BY kd_brg
            UNION SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,''AS jmlh_hps,''AS harga_hps, a.keterangan FROM trkib_c a 
            LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd'  AND a.tahun<'$tahun' GROUP BY kd_brg
            UNION SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,''AS jmlh_hps,''AS harga_hps, a.keterangan FROM trkib_d a 
            LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd'  AND a.tahun<'$tahun' GROUP BY kd_brg
            UNION SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,''AS jmlh_hps,''AS harga_hps, a.keterangan FROM trkib_e a 
            LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd'  AND a.tahun<'$tahun' GROUP BY kd_brg
            UNION SELECT LEFT(a.kd_brg,2)AS gol,a.kd_brg,c.nm_brg,COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga,''AS jmlh_hps,''AS harga_hps, a.keterangan FROM trkib_f a 
            LEFT JOIN trh_isianbrg b ON a.no_dokumen = b.no_dokumen LEFT JOIN mbarang c ON a.kd_brg = c.kd_brg WHERE a.kd_unit ='$cskpd'  AND a.tahun<'$tahun' GROUP BY kd_brg
            ";
        
                                             
             $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {
                         

                $kdbrg = $row->kd_brg;
                $hapus=$this->penghapusan($cskpd,$tahun,$kdbrg);
               $tot =  $row->harga- $hapus['hrghps'];
                
         
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->gol</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_brg</td>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->jmlh</td>
                        <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format("$row->harga")."</td>
                        <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\"> </td>
        				<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($hapus['hrghps'])."</td>
                        <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format("$tot")."</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->keterangan</td>  
        			</tr>
        			";
        		$i++; 
                 }
           
             $cRet .="</table><br/><br/>";
           
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Mengetahui,<br>Kepala SKPD<br><br><br><br></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Pengurus Barang<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">($nm_tahu)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">($nm_bend)</td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_tahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_bend</td>					
					</tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'RENCANA KEBUTUHAN BARANG');        
        $this->_mpdf('',$cRet,10,10,10,1);
         } 
	}
    
    function awal_mutasi($cskpd,$tahun,$kdbrg){
        
		$awal=array();

	    $sq2 ="SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_a a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and  no_hapus is null and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_b a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus IS NULL and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_c a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus IS NULL and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_d a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus IS NULL and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_e a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus IS NULL and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_f a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus IS NULL and tahun < '$tahun' ";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh       = $jmlh + $resulte2['jmlh']; 
                $harga      = $harga + $resulte2['harga'];
			}      
         
        	$awal['jmlh']     = $jmlh; 
            $awal['harga']    = $harga;
            
			return $awal;
	}
    
    function hapus_mutasi($cskpd,$tahun,$kdbrg){
        
		$hapus=array();

	    $sq2 = "SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_a a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_b a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_c a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_d a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_e a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_f a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
                ";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh       = 0; 
            $harga      = 0;
			foreach($query2->result_array() as $resulte2){	
			 
        		$jmlh       = $jmlh + $resulte2['jmlh']; 
                $harga      = $harga + $resulte2['harga'];
			}      
            $hapus['jmlh']   = $jmlh; 
            $hapus['harga']  = $harga;
            
			return $hapus;
	}
    
   function bertambah($cskpd,$tahun,$kdbrg){
        
		$tambah=array();

	    $sq2 = "SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_a a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun > '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_b a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun >'$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_c a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun >'$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_d a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun >'$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_e a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun >'$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_f a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun >'$tahun'
                ";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh       = 0; 
            $harga      = 0;
			foreach($query2->result_array() as $resulte2){	
			 
        		$jmlh       = $jmlh + $resulte2['jmlh']; 
                $harga      = $harga + $resulte2['harga'];
			}      
            $tambah['jmlh']   = $jmlh; 
            $tambah['harga']  = $harga;
            
			return $tambah;
	}

    
	public function lap_mutasi()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		
	$konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		$thn  		= $this->session->userdata('ta_simbakda');
		$cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
        $tgl_awal 	= $_REQUEST['tgl_awal'];
        $tgl_akhir	= $_REQUEST['tgl_akhir'];
        $tahun 		= $_REQUEST['tahun'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">			
			<tr><td  width=\"15%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
				<th width =\"60%\" align=\"center\" style=\"font-size:14px;font-family: tahoma;\">LAPORAN MUTASI BARANG<br>KOTA $kota<br>TAHUN ANGGARAN $thn</th>
				<td width=\"15%\"align=\"left\" style=\"font-size:14px;\"></td>
            </tr>
			<BR/>
			
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">&ensp;SKPD</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">: $cnm_skpd</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">Kode Lokasi : $cskpd</td>
            </tr>
			
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">&ensp;KABUPATEN</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">: $kota</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;\"></td>
            </tr>	
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">&ensp;PROVINSI</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">: $prov</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;\"></td>
            </tr>			
            </table>
			<BR/>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td colspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">NOMOR</td>
                <td colspan='4' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">SPESIFIKASI BARANG</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Asal / Cara<br>Perolehan<br>Barang</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Tahun<br>Beli/<br>Perolehan</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Ukuran<br>Barang/<br>Konstruksi<br>(P,SP,D)</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Satuan</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Kondisi<br>(B, RR, RB)</td>
				<td colspan='2' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah<br>(Awal)</td>
				<td colspan='4' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Mutasi / Perubahan</td>
				<td colspan='2' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah<br>(Akhir)</td>
				<td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Ket</td>

			</tr>
			

			<tr>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">No.Urut</td>
                <td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Kode Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Register</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Nama/<br>Jenis<br>Barang</td>
                <td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Merk<br>Type</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">No Sertifikat<br>No Pabrik<br>No.Chasis/<br>Mesin</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Bahan</td>				
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Harga</td>	
				<td colspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Berkurang</td>
				<td colspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Bertambah</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Harga</td>									
			</tr>
			
			<tr>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Barang</td>
                <td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Harga</td>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Barang</td>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Harga</td>
			</tr>

			
            <tr>
                <td align=\"center\" style=\"font-size:10px\">1</td>
                <td align=\"center\" style=\"font-size:10px\">2</td>
                <td align=\"center\" style=\"font-size:10px\">3</td>
                <td align=\"center\" style=\"font-size:10px\">4</td>
                <td align=\"center\" style=\"font-size:10px\">5</td>
                <td align=\"center\" style=\"font-size:10px\">6</td>
                <td align=\"center\" style=\"font-size:10px\">7</td>
                <td align=\"center\" style=\"font-size:10px\">8</td>
				<td align=\"center\" style=\"font-size:10px\">9</td>
				<td align=\"center\" style=\"font-size:10px\">10</td>
                <td align=\"center\" style=\"font-size:10px\">11</td>
                <td align=\"center\" style=\"font-size:10px\">12</td>
				<td align=\"center\" style=\"font-size:10px\">13</td>
                <td align=\"center\" style=\"font-size:10px\">14</td>
                <td align=\"center\" style=\"font-size:10px\">15</td>
                <td align=\"center\" style=\"font-size:10px\">16</td>
				<td align=\"center\" style=\"font-size:10px\">17</td>
				<td align=\"center\" style=\"font-size:10px\">18</td>
                <td align=\"center\" style=\"font-size:10px\">19</td>
                <td align=\"center\" style=\"font-size:10px\">20</td>
				<td align=\"center\" style=\"font-size:10px\">21</td>
		     </tr>
            </thead>";        
            
            
             $csql = "SELECT kd_brg,no_reg,nm_brg,merek,spek,bahan,asal,tahun,ukuran,satuan,kondisi,jml_awal,
						awal,jml_kurang,kurang,jml_tambah,tambah,jml_akhir,akhir,keterangan FROM(
						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,'-' AS merek,a.no_sertifikat AS spek,
						'-' AS bahan,a.asal,a.tahun,'-' AS ukuran,
						'-' satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_a a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY b.nm_brg,a.kd_brg,a.luas,a.tahun,a.alamat1,
							a.status_tanah,a.tgl_sertifikat,
							a.no_sertifikat,a.penggunaan,a.asal,a.nilai 

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,a.merek,CONCAT(a.no_mesin,'/',a.no_polisi) AS spek,
						a.kd_bahan AS bahan,a.asal,a.tahun,'-' AS ukuran,
						a.kd_satuan AS satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_b a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek,
						a.silinder,a.tahun,a.kd_warna,a.kd_bahan,a.asal,a.pabrik,a.no_rangka,
						a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,'-' AS merek,'-' AS spek,
						IF(a.konstruksi='beton',a.konstruksi,'-') AS  bahan,a.asal,a.tahun,a.konstruksi2 AS ukuran,
						'-' AS satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_c a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
						a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,'-' AS merek,'-' AS spek,
						a.konstruksi AS bahan,a.asal,a.tahun,CONCAT(panjang,'/',luas,'/',lebar) AS ukuran,
						'-' AS satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_d a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,
						a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,a.judul AS merek,spesifikasi AS spek,
						a.kd_bahan AS bahan,a.asal,a.tahun,'-' AS ukuran,
						a.kd_satuan AS satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_e a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tipe,a.nilai,a.keterangan

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,'' AS merek,a.kd_tanah AS spek,
						IF(a.jenis='beton',a.jenis,'-') AS bahan,a.asal,a.tahun,a.luas AS ukuran,
						'-' AS satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_f a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.bangunan,a.kd_tanah,
						a.tahun,a.asal,a.nilai,a.keterangan,a.kd_brg


						) faiz ORDER BY kd_brg,tahun;


						";
                    
             $hasil = $this->db->query($csql);
             $i = 1;
			 $jmla_awal=0;
			 $tot_awal=0;
			 $jmla_kurang=0;
			 $tot_kurang=0;
			 $jmla_tambah=0;
			 $tot_tambah=0;
			 $jmla_akhir=0;
			 $tot_akhir=0;
             foreach ($hasil->result() as $row)
             {
               
					$kd_brg   = $row->kd_brg;
					$no_reg   = $row->no_reg;
					$nm_brg   = $row->nm_brg;
					$merek   = $row->merek;
					$spek   = $row->spek;
					$bahan   = $row->bahan;
					$asal   = $row->asal;
					$tahun   = $row->tahun;
					$ukuran   = $row->ukuran;
					$satuan   = $row->satuan;
					$kondisi   = $row->kondisi;
					$jml_awal   = $row->jml_awal;
					$awal   = $row->awal;
					$jml_kurang   = $row->jml_kurang;
					$kurang   = $row->kurang;
					$jml_tambah   = $row->jml_tambah;
					$tambah   = $row->tambah;
					$jml_akhir   = $row->jml_akhir;
					$akhir   = $row->akhir;
					$keterangan   = $row->keterangan;
					
					
			 $jmla_kurang	= $jmla_kurang+$jml_kurang;
			 $tot_kurang	= $tot_kurang+$kurang;
			 $jmla_tambah	= $jmla_tambah+$jml_tambah;
			 $tot_tambah	= $tot_tambah+$tambah;
			 $jmla_akhir	= $jmla_akhir+$jml_akhir;
			 $tot_akhir		= $tot_akhir+$akhir;

                          $cRet .="
                            <tr>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$i</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$kd_brg</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$no_reg</td>
                                <td align=\"left\"   style=\"font-size:10px;font-family: tahoma;\">$nm_brg</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$merek</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$spek</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$bahan</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$asal</td>
                				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$tahun</td>
                				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$ukuran</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$satuan</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$kondisi</td>
                				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jml_awal</td>
                                <td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">".number_format($awal)."</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jml_kurang</td>
                				<td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">".number_format($kurang)."</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jml_tambah</td>
                                <td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">".number_format($tambah)."</td>
                				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jml_akhir</td>
                                <td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">".number_format($akhir)."</td>
                                <td align=\"left\" style=\"font-size:10px;font-family: tahoma;\">$keterangan</td>                
                		     </tr>";
                   
                 $i++;
                              
                   }
                    
                          $cRet .="
                            <tr>
                                <td bgcolor=\"#80FE80\" colspan=\"12\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>JUMLAH TOTAL</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmla_awal</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($tot_awal)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmla_kurang</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($tot_kurang)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmla_tambah</td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($tot_tambah)."</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmla_akhir</td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($tot_akhir)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"left\" style=\"font-size:10px;font-family: tahoma;\"></td>                
                		     </tr>";
    		$cRet .="</table><br/><br/>";
    		
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Mengetahui,</td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Kepala SKPD<br><br><br><br></td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Pengurus Barang<br><br><br><br></td>
					</tr>					
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">(<u>$nm_tahu</u>)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">(<u>$nm_bend</u>)</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nip.$lctahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nip.$lcbend</td>
					</tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'LAPORAN MUTASI BARANG';
        $this->template->set('title', 'LAPORAN MUTASI BARANG');  
        switch($iz) {
        case 1;  
		//$this->mdata->_mpdf3('',$cRet,4,3,3,3,$kertas,1);   
		echo $cRet; 
        //$this->_mpdfa('',$cRet,80,90,90,1);
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            
            $this->load->view('transaksi/excel', $data);
        break;
        }          
		
		} 
	}

function lap_mutasi_barangsss(){
	   if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$konfig		= $this->ambil_config();
		$prov		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		//$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$lctahu 	= $_REQUEST['lctahu'];
		$lcbend 	= $_REQUEST['lcbend'];
		$cnmbend 	= $_REQUEST['cnmbend'];
		$cnmtahu 	= $_REQUEST['cnmtahu'];
		//$lctgl	 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$lctgl	 	= $_REQUEST['lctgl2'];
		$iz	 		= $_REQUEST['fa'];
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
		
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
                <td width=\"10%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
				<th width =\"80%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">REKAPITULASI DAFTAR MUTASI BARANG<br>MILIK PEMERINTAH KOTA $kota<br><b>TAHUN $thn</b></th>
				<td width=\"10%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_bid</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">Kode Lokasi: $cbid</td>
            </tr>
            </table>
			
			<BR/>
			<BR/>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px\">No Urut</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px\">Gol</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px\">Kode<br>Bidang<br>Barang</td>
                <td width=\"30%\" align=\"center\" style=\"font-size:12px\">Nama <br>Bidang Barang</td>
                <td width=\"10%\" align=\"center\" style=\"font-size:12px\">Jumlah Barang</td>
                <td width=\"40%\" align=\"center\" style=\"font-size:12px\">Jumlah Harga<br>(Rp)</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px\">Keterangan</td>
            </tr>

			<tr>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
			</tr>
            </thead> ";
            
$csql = "SELECT no,gol,kode,kd_brg,nama FROM mrekap WHERE LENGTH(kd_brg)=2";
$hasil = $this->db->query($csql);
$i = 1;
$cjumlah=0;
foreach ($hasil->result() as $row)
 {
$no		= $row->no;
$gol	= $row->gol;
$kode	= $row->kode;
$ckode	= $row->kd_brg;
$cnama	= $row->nama;
			
		if ($ckode=='01'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $cjumlah1 = $row->jumlah;
			 
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_a WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $charga1 = $row->nilai;
			 }
		}
			
		if ($ckode=='02'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $cjumlah2x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $charga2x = $row->nilai;
			 }
		}
			
		if ($ckode=='03'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $charga3 = $row->nilai;
			 }
			
		}
			
		if ($ckode=='04'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_d WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $charga4 = $row->nilai;
			 }
		}
			
		if ($ckode=='05'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $cjumlah5 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $charga5 = $row->nilai;
			 }
		}
			
		if ($ckode=='06'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $cjumlah6 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_f WHERE kd_unit='$cbid' and left(kd_brg,2)='$ckode'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $charga6 = $row->nilai;
			 }
			
			$jml = $cjumlah1+$cjumlah2x+$cjumlah3+$cjumlah4+$cjumlah5+$cjumlah6;
			$hargax =  $charga3+$charga2x+$charga3+$charga4+$charga5+$charga6;
		}
			
							$cRet .="	
                <tr>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">&nbsp; </td>
        		</tr>
        			";				

			
			
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"><b>$no</b></td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"><b>$gol</b></td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"><b>$kode</b></td>
                        <td bgcolor=\"#ADFF2F\" align=\"left\" style=\"font-size:10px; font-family:tahoma;\"><b>$cnama</b></td>
                        <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#ADFF2F\" align=\"right\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($charga)."</b></td>
                        <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\"></td>
        		</tr>
        			";
					
					if ($ckode=='06'){
					
							$cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">&nbsp;</td>
                        <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">&nbsp; </td>
        		</tr>
        			";
					
					}
					
        		$i++; 
				
				
		$csql="SELECT left(kd_brg,2)as xkode,gol,kode,kd_brg,nama FROM mrekap WHERE LENGTH(kd_brg)=4 AND LEFT(kd_brg,2)='$ckode'";
		$hasil = $this->db->query($csql);
        $i = 1;
        foreach ($hasil->result() as $row){
			//no2	= $row->no;
			$gol2	= $row->gol;
			$kode2	= $row->kode;
			$ckode2	= $row->kd_brg;					
			$cnama2	= $row->nama;
			$ckodex	= $row->xkode;
			
			$cjumlah2=0;
			$charga2=0;
			
		if ($ckodex=='01'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah2 = $row->jumlah;
			}
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_a WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}					
		}
			
		if ($ckodex=='02'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_d WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			
			}
			
			if ($ckodex=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_f WHERE kd_unit='$cbid' and left(kd_brg,4)='$ckode2'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
				 
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$kode2</td>
                        <td align=\"left\" 	 style=\"font-size:10px; font-family:tahoma;\">$cnama2</td>
                        <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$cjumlah2</td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\">".number_format($charga2)."</td>
                        <td align=\"right\"  style=\"font-size:10px; font-family:tahoma;\"></td>
					</tr>
        			";
        		$i++; 
				 }
}
			 
	$cRet .="<tr>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"><b>$jml</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px; font-family:tahoma;\"><b>Rp. ".number_format($hargax)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
			</tr>";
		   
            $cRet .="</table><br/><br/>";
           
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Mengetahui,<br>Kepala SKPD<br><br><br><br></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Pengurus Barang<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">(<u>$nm_tahu</u>)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">(<u>$nm_bend</u>)</td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_tahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_bend</td>					
					</tr>";
		$cRet .= " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'REKAP BUKU INVENTARIS BARANG';
        $this->template->set('title', 'REKAP BUKU INVENTARIS BARANG');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
		//$this->_mpdf('',$cRet,5,5,5,1);
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            
            $this->load->view('transaksi/excel', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
           $this->load->view('transaksi/excel', $data);
        break;
        } 
        } 
	}
	
function lap_mutasi_barang()
{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		
		$konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		$thn  		= $this->session->userdata('ta_simbakda');
		$cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
        $tgl_awal 	= $_REQUEST['tgl_awal'];
        $tgl_akhir	= $_REQUEST['tgl_akhir'];
        $tahun 		= $_REQUEST['tahun'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">			
			<tr><td  width=\"15%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
				<th width =\"60%\" align=\"center\" style=\"font-size:14px;font-family: tahoma;\">DAFTAR MUTASI BARANG<br>KOTA $kota<br>TAHUN ANGGARAN $thn</th>
				<td width=\"15%\"align=\"left\" style=\"font-size:14px;\"></td>
            </tr>
			<BR/>
			
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">&ensp;SKPD</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">: $cnm_skpd</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">Kode Lokasi : $cskpd</td>
            </tr>
			
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">&ensp;KABUPATEN</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">: $kota</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;\"></td>
            </tr>	
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">&ensp;PROVINSI</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;font-family: tahoma;\">: $prov</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;\"></td>
            </tr>			
            </table>
			<BR/>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td colspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">NOMOR</td>
                <td colspan='4' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">SPESIFIKASI BARANG</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Asal / Cara<br>Perolehan<br>Barang</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Tahun<br>Beli/<br>Perolehan</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Ukuran<br>Barang/<br>Konstruksi<br>(P,SP,D)</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Satuan</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Kondisi<br>(B, RR, RB)</td>
				<td colspan='2' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah<br>(Awal)</td>
				<td colspan='4' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Mutasi / Perubahan</td>
				<td colspan='2' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah<br>(Akhir)</td>
				<td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Ket</td>

			</tr>
			

			<tr>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">No.Urut</td>
                <td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Kode Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Register</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Nama/<br>Jenis<br>Barang</td>
                <td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Merk<br>Type</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">No Sertifikat<br>No Pabrik<br>No.Chasis/<br>Mesin</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Bahan</td>				
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Harga</td>	
				<td colspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Berkurang</td>
				<td colspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Bertambah</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\">Harga</td>									
			</tr>
			
			<tr>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Barang</td>
                <td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Harga</td>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Barang</td>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Harga</td>
			</tr>

			
            <tr>
                <td align=\"center\" style=\"font-size:10px\">1</td>
                <td align=\"center\" style=\"font-size:10px\">2</td>
                <td align=\"center\" style=\"font-size:10px\">3</td>
                <td align=\"center\" style=\"font-size:10px\">4</td>
                <td align=\"center\" style=\"font-size:10px\">5</td>
                <td align=\"center\" style=\"font-size:10px\">6</td>
                <td align=\"center\" style=\"font-size:10px\">7</td>
                <td align=\"center\" style=\"font-size:10px\">8</td>
				<td align=\"center\" style=\"font-size:10px\">9</td>
				<td align=\"center\" style=\"font-size:10px\">10</td>
                <td align=\"center\" style=\"font-size:10px\">11</td>
                <td align=\"center\" style=\"font-size:10px\">12</td>
				<td align=\"center\" style=\"font-size:10px\">13</td>
                <td align=\"center\" style=\"font-size:10px\">14</td>
                <td align=\"center\" style=\"font-size:10px\">15</td>
                <td align=\"center\" style=\"font-size:10px\">16</td>
				<td align=\"center\" style=\"font-size:10px\">17</td>
				<td align=\"center\" style=\"font-size:10px\">18</td>
                <td align=\"center\" style=\"font-size:10px\">19</td>
                <td align=\"center\" style=\"font-size:10px\">20</td>
				<td align=\"center\" style=\"font-size:10px\">21</td>
		     </tr>
            </thead>";        
            
            
             $csql = "SELECT kd_brg,no_reg,nm_brg,merek,spek,bahan,asal,tahun,ukuran,satuan,kondisi,jml_awal,
						awal,jml_kurang,kurang,jml_tambah,tambah,jml_akhir,akhir,keterangan FROM(
						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,'-' AS merek,a.no_sertifikat AS spek,
						'-' AS bahan,a.asal,a.tahun,'-' AS ukuran,
						'-' satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_a a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY b.nm_brg,a.kd_brg,a.luas,a.tahun,a.alamat1,
							a.status_tanah,a.tgl_sertifikat,
							a.no_sertifikat,a.penggunaan,a.asal,a.nilai 

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,a.merek,CONCAT(a.no_mesin,'/',a.no_polisi) AS spek,
						a.kd_bahan AS bahan,a.asal,a.tahun,'-' AS ukuran,
						a.kd_satuan AS satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_b a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek,
						a.silinder,a.tahun,a.kd_warna,a.kd_bahan,a.asal,a.pabrik,a.no_rangka,
						a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,'-' AS merek,'-' AS spek,
						IF(a.konstruksi='beton',a.konstruksi,'-') AS  bahan,a.asal,a.tahun,a.konstruksi2 AS ukuran,
						'-' AS satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_c a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
						a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,'-' AS merek,'-' AS spek,
						a.konstruksi AS bahan,a.asal,a.tahun,CONCAT(panjang,'/',luas,'/',lebar) AS ukuran,
						'-' AS satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_d a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,
						a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,a.judul AS merek,spesifikasi AS spek,
						a.kd_bahan AS bahan,a.asal,a.tahun,'-' AS ukuran,
						a.kd_satuan AS satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_e a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tipe,a.nilai,a.keterangan

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						b.nm_brg,'' AS merek,a.kd_tanah AS spek,
						IF(a.jenis='beton',a.jenis,'-') AS bahan,a.asal,a.tahun,a.luas AS ukuran,
						'-' AS satuan,a.kondisi,(0) AS jml_awal,(0) AS awal,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_kurang,

						IF((a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir') 
						OR (a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir')  
						OR (a.tgl_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS kurang,

						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),COUNT(a.nilai),0)AS jml_tambah,
						IF((a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'),SUM(a.nilai),0)AS tambah,
						IF((a.tgl_reg<='$tgl_akhir') ,COUNT(a.nilai),0)AS jml_akhir,
						IF((a.tgl_reg<='$tgl_akhir') ,SUM(a.nilai),0)AS akhir,a.keterangan

						FROM trkib_f a 
						inner join mbarang b on a.kd_brg=b.kd_brg
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir')
						GROUP BY b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.bangunan,a.kd_tanah,
						a.tahun,a.asal,a.nilai,a.keterangan,a.kd_brg


						) faiz ORDER BY kd_brg,tahun;


						";
                    
             $hasil = $this->db->query($csql);
             $i = 1;
			 $jmla_awal=0;
			 $tot_awal=0;
			 $jmla_kurang=0;
			 $tot_kurang=0;
			 $jmla_tambah=0;
			 $tot_tambah=0;
			 $jmla_akhir=0;
			 $tot_akhir=0;
             foreach ($hasil->result() as $row)
             {
               
					$kd_brg   = $row->kd_brg;
					$no_reg   = $row->no_reg;
					$nm_brg   = $row->nm_brg;
					$merek   = $row->merek;
					$spek   = $row->spek;
					$bahan   = $row->bahan;
					$asal   = $row->asal;
					$tahun   = $row->tahun;
					$ukuran   = $row->ukuran;
					$satuan   = $row->satuan;
					$kondisi   = $row->kondisi;
					$jml_awal   = $row->jml_awal;
					$awal   = $row->awal;
					$jml_kurang   = $row->jml_kurang;
					$kurang   = $row->kurang;
					$jml_tambah   = $row->jml_tambah;
					$tambah   = $row->tambah;
					$jml_akhir   = $row->jml_akhir;
					$akhir   = $row->akhir;
					$keterangan   = $row->keterangan;
					
					
			 $jmla_kurang	= $jmla_kurang+$jml_kurang;
			 $tot_kurang	= $tot_kurang+$kurang;
			 $jmla_tambah	= $jmla_tambah+$jml_tambah;
			 $tot_tambah	= $tot_tambah+$tambah;
			 $jmla_akhir	= $jmla_akhir+$jml_akhir;
			 $tot_akhir		= $tot_akhir+$akhir;

                          $cRet .="
                            <tr>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$i</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$kd_brg</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$no_reg</td>
                                <td align=\"left\"   style=\"font-size:10px;font-family: tahoma;\">$nm_brg</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$merek</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$spek</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$bahan</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$asal</td>
                				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$tahun</td>
                				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$ukuran</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$satuan</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$kondisi</td>
                				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jml_awal</td>
                                <td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">".number_format($awal)."</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jml_kurang</td>
                				<td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">".number_format($kurang)."</td>
                                <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jml_tambah</td>
                                <td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">".number_format($tambah)."</td>
                				<td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$jml_akhir</td>
                                <td align=\"right\" style=\"font-size:10px;font-family: tahoma;\">".number_format($akhir)."</td>
                                <td align=\"left\" style=\"font-size:10px;font-family: tahoma;\">$keterangan</td>                
                		     </tr>";
                   
                 $i++;
                              
                   }
                    
                          $cRet .="
                            <tr>
                                <td bgcolor=\"#80FE80\" colspan=\"12\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>JUMLAH TOTAL</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmla_awal</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($tot_awal)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmla_kurang</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($tot_kurang)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmla_tambah</td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($tot_tambah)."</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmla_akhir</td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($tot_akhir)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"left\" style=\"font-size:10px;font-family: tahoma;\"></td>                
                		     </tr>";
    		$cRet .="</table><br/><br/>";
    		
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Mengetahui,</td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Kepala SKPD<br><br><br><br></td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Pengurus Barang<br><br><br><br></td>
					</tr>					
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">(<u>$nm_tahu</u>)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">(<u>$nm_bend</u>)</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nip.$lctahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nip.$lcbend</td>
					</tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'DAFTAR MUTASI BARANG';
        $this->template->set('title', 'DAFTAR MUTASI BARANG');  
        switch($iz) {
        case 1;  
		//$this->mdata->_mpdf3('',$cRet,4,3,3,3,$kertas,1);   
		echo $cRet; 
        //$this->_mpdfa('',$cRet,80,90,90,1);
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            
            $this->load->view('transaksi/excel', $data);
        break;
        } 
}
}
	
	public function lap_mutasi_barangxx()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		$thn  		= $this->session->userdata('ta_simbakda');
		$cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
        $tgl_awal 	= $_REQUEST['tgl_awal'];
        $tgl_akhir 	= $_REQUEST['tgl_akhir'];
        $tahun 		= $_REQUEST['tahun'];
        $iz 		= $_REQUEST['fa'];
        
        // identitas yang mengetahuin
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
        $cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">			
			<tr>
                <td width=\"15%\"align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
				<th width =\"60%\" align=\"center\" style=\"font-size:14px; font-family:tahoma;\">DAFTAR MUTASI BARANG (x)<br>KOTA $kota<br>TAHUN ANGGARAN $thn</th>
				<td width=\"15%\"align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
				<th width =\"10%\" align=\"Right\" style=\"font-size:14px; font-family:tahoma;\"></th>
            </tr>
			<tr>
			<td colspan=\"3\" align=\"center\"><b>PERIODE: $tgl_awal S/D $tgl_akhir</b>
			</td>
			</tr>
			
			<BR/>
			
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $cnm_skpd</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">Kode Lokasi </td>
				<td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $cskpd</td>
            </tr>
			
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;KABUPATEN/KOTA</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $kota</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
				<td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>	
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $prov</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
				<td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>			
			
            </table>
			<BR/>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td colspan=\"3\" width=\"9%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"4\" width=\"9%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"3\" width=\"9%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Asal / Cara<br>Perolehan<br>Barang</td>
                <td rowspan=\"3\" width=\"9%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Tahun<br>Beli/<br>Perolehan</td>
                <td rowspan=\"3\" width=\"8%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Ukuran<br>Barang/<br>Konstruksi<br>(P,SP,D)</td>
                <td rowspan=\"3\" width=\"8%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Satuan</td>
                <td rowspan=\"3\" width=\"8%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Kondisi<br>(B, RR, RB)</td>
				<td colspan=\"2\" width=\"8%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Jumlah<br>(Awal)xxx)</td>
				<td colspan=\"4\" width=\"8%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Mutasi / Perubahan</td>
				<td colspan=\"2\" width=\"8%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Jumlah<br>(Akhir)xxxx)</td>
				<td rowspan=\"3\" width=\"8%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Ket</td>

			</tr>
			
			<tr>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">No.Urut</td>
                <td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Kode Barang</td>
				<td rowspan=\"2\" width=\"8%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Register</td>
				<td rowspan=\"2\" width=\"8%\"   bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nama/<br>Jenis<br>Barang</td>
                <td rowspan=\"2\" width=\"8%\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Merk<br>Type</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">No Sertifikat<br>No Pabrik<br>No.Chasis/<br>Mesin</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Bahan</td>				
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Barang</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Harga</td>	
				<td colspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Berkurang</td>
				<td colspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Bertambah</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Barang</td>
				<td rowspan=\"2\"  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Harga</td>									
			</tr>
			
			<tr>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Jumlah Barang</td>
                <td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Jumlah Harga</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Jumlah Barang</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Jumlah Harga</td>
			</tr>

			
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">12</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">13</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">14</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">15</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">16</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">17</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">18</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">19</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">20</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">21</td>
		     </tr>
            </thead>";
            
           /*$csql = "SELECT RIGHT(no_reg,6)AS reg ,a.kd_brg,c.nm_brg,'' AS merek,''AS tipe,''AS no_rangka,''AS no_mesin,a.tahun,''AS kondisi,a.keterangan FROM trkib_a a 
                    INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg 
                    UNION SELECT RIGHT(no_reg,6)AS reg ,a.kd_brg,c.nm_brg,a.merek,a.tipe,a.no_rangka,a.no_mesin,a.tahun,a.kondisi,a.keterangan FROM trkib_b a 
                    INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg 
                    UNION SELECT RIGHT(no_reg,6)AS reg ,a.kd_brg,c.nm_brg,''AS merek,''AS tipe,''AS no_rangka,''AS no_mesin,a.tahun,a.kondisi,a.keterangan FROM trkib_c a 
                    INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg 
                    UNION SELECT RIGHT(no_reg,6)AS reg ,a.kd_brg,c.nm_brg,''AS merek,''AS tipe,''AS no_rangka,''AS no_mesin,a.tahun,a.kondisi,a.keterangan FROM trkib_d a 
                    INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg 
                    UNION SELECT RIGHT(no_reg,6)AS reg ,a.kd_brg,c.nm_brg,''AS merek,''AS tipe,''AS no_rangka,''AS no_mesin,a.tahun,a.kondisi,a.keterangan FROM trkib_e a 
                    INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg 
                    UNION SELECT RIGHT(no_reg,6)AS reg ,a.kd_brg,c.nm_brg,''AS merek,''AS tipe,''AS no_rangka,''AS no_mesin,a.tahun,a.kondisi,a.keterangan FROM trkib_f a 
                    INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg 
                      ";*/
					  $csql="SELECT * FROM (

SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
(SELECT nm_brg FROM mbarang WHERE kd_brg=a.`kd_brg`) AS nm_brg,'' AS merek,a.no_sertifikat AS gabung,'' AS kd_bahan,
a.asal,a.tahun,a.luas AS silinder,'' kd_satuan,'' AS kondisi,
(SELECT IFNULL((SELECT  COUNT(b.jumlah) FROM trkib_a b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg<'$tgl_awal'),0)) AS jumlah_awal,
(SELECT IFNULL((SELECT  SUM(b.nilai) FROM trkib_a b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg<'$tgl_awal'),0)) AS nilai_awal,
 
 '0' AS jumlah_kurang,
 '0' AS nilai_kurang,

(SELECT COUNT(b.jumlah) FROM trkib_a b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS jumlah_tambah,
(SELECT SUM(b.nilai) FROM trkib_a b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS nilai_tambah,a.keterangan
 
FROM trkib_a a WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$tgl_akhir'

UNION

SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
(SELECT nm_brg FROM mbarang WHERE kd_brg=a.`kd_brg`) AS nm_brg,a.merek,a.no_mesin AS gabung,a.kd_bahan,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,
(SELECT  COUNT(b.jumlah) FROM trkib_b b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg<'$tgl_awal') AS jumlah_awal,
(SELECT  SUM(b.nilai) FROM trkib_b b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg<'$tgl_awal') AS nilai_awal,
 
 '0' AS jumlah_kurang,
 '0' AS nilai_kurang,

(SELECT COUNT(b.jumlah) FROM trkib_b b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS jumlah_tambah,
(SELECT SUM(b.nilai) FROM trkib_b b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS nilai_tambah,a.keterangan

FROM trkib_b a WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$tgl_akhir' GROUP BY a.no_urut

UNION

SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
(SELECT nm_brg FROM mbarang WHERE kd_brg=a.`kd_brg`) AS nm_brg,
a.luas_tanah AS merek,a.luas_lantai AS gabung,a.jenis_gedung AS kd_bahan,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,
(SELECT  COUNT(b.jumlah) FROM trkib_c b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg<'$tgl_awal') AS jumlah_awal,
(SELECT  SUM(b.nilai) FROM trkib_c b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg<'$tgl_awal') AS nilai_awal,
 
 '0' AS jumlah_kurang,
 '0' AS nilai_kurang,

(SELECT COUNT(b.jumlah) FROM trkib_c b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS jumlah_tambah,
(SELECT SUM(b.nilai) FROM trkib_c b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS nilai_tambah,a.keterangan

FROM trkib_c a  
WHERE a.kd_skpd='$cskpd' AND a.tgl_reg<='$tgl_akhir'

UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
(SELECT nm_brg FROM mbarang WHERE kd_brg=a.`kd_brg`) AS nm_brg,a.panjang AS merek,a.luas AS gabung,'' AS kd_bahan,
a.asal,a.tahun,a.lebar AS silinder,'' AS kd_satuan,a.kondisi,
(SELECT  COUNT(b.jumlah) FROM trkib_d b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg<'$tgl_awal') AS jumlah_awal,
(SELECT  SUM(b.nilai) FROM trkib_d b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg<'$tgl_awal') AS nilai_awal,
 
 '0' AS jumlah_kurang,
 '0' AS nilai_kurang,

(SELECT COUNT(b.jumlah) FROM trkib_d b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS jumlah_tambah,
(SELECT SUM(b.nilai) FROM trkib_d b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS nilai_tambah,a.keterangan

FROM trkib_d a WHERE  a.kd_skpd='$cskpd' AND a.tgl_reg<='$tgl_akhir'

UNION

SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
(SELECT nm_brg FROM mbarang WHERE kd_brg=a.kd_brg) AS nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,
(SELECT  COUNT(b.jumlah) FROM trkib_e b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg<'$tgl_awal') AS jumlah_awal,
(SELECT  SUM(b.nilai) FROM trkib_e b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang  AND  b.tgl_reg<'$tgl_awal') AS nilai_awal,
 
'0' AS jumlah_kurang,
'0' AS nilai_kurang,

(SELECT COUNT(b.jumlah) FROM trkib_e b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS jumlah_tambah,
(SELECT SUM(b.nilai) FROM trkib_e b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS nilai_tambaha,a.keterangan
 
FROM trkib_e a WHERE  a.kd_skpd='$cskpd' AND a.tgl_reg<='$tgl_akhir' GROUP BY no_urut


UNION

SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
(SELECT nm_brg FROM mbarang WHERE kd_brg=a.`kd_brg`) AS nm_brg,'' AS merek,a.luas AS gabung,'' AS kd_bahan,
a.asal,a.tahun,'' AS silinder,'' AS kd_satuan,a.kondisi,
(SELECT  COUNT(b.jumlah) FROM trkib_f b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg<'$tgl_awal') AS jumlah_awal,
(SELECT  SUM(b.nilai) FROM trkib_f b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg<'$tgl_awal') AS nilai_awal,
 
 '0' AS jumlah_kurang,
 '0' AS nilai_kurang,

(SELECT COUNT(b.jumlah) FROM trkib_f b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS jumlah_tambah,
(SELECT SUM(b.nilai) FROM trkib_f b WHERE a.kd_unit=b.kd_unit AND b.id_barang=a.id_barang AND  b.tgl_reg>='$tgl_awal' AND b.tgl_reg<='$tgl_akhir') AS nilai_tambah,a.keterangan

FROM trkib_f a WHERE  a.kd_skpd='$cskpd' AND a.tgl_reg<='$tgl_akhir'


) z ORDER BY kd_brg,no_reg,tahun";
           /*$csql ="SELECT * FROM 
(SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,'' AS merek,a.no_sertifikat AS gabung,'' AS kd_bahan,
a.asal,a.tahun,a.luas AS silinder,'' kd_satuan,'' AS kondisi,COUNT(a.no_reg) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_a a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_akhir'
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,a.no_mesin AS gabung,a.kd_bahan,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.no_reg) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_b a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_akhir' GROUP BY a.no_urut
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.luas_lantai AS gabung,a.jenis_gedung AS kd_bahan,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.kd_brg) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_c a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_akhir'
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.panjang AS merek,a.luas AS gabung,'' AS kd_bahan,
a.asal,a.tahun,a.lebar AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.kd_brg) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_d a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_akhir'
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.kd_brg) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_e a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_akhir'
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,'' AS merek,a.luas AS gabung,'' AS kd_bahan,
a.asal,a.tahun,'' AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.kd_brg) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_f a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_akhir') faiz  group by kd_brg,no_reg,tahun ORDER BY kd_brg,no_reg";  */            
             $hasil = $this->db->query($csql);
             $i = 1;
             foreach ($hasil->result() as $row)
             {
                $kdbrg  		= $row->kd_brg;
                $reg    		= $row->no_reg;
                $nm_brg 		= $row->nm_brg;
                $merek  		= $row->merek;
                $gabung 		= $row->gabung;
                $kd_bahan  		= $row->kd_bahan;
                $asal  			= $row->asal;
                $tahun  		= $row->tahun;
                $silinder  		= $row->silinder;
                $kd_satuan  	= $row->kd_satuan;
                $kondisi  		= $row->kondisi;
                $jumlah_awal    = $row->jumlah_awal;
                $nilai_awal	    = $row->nilai_awal;
                $jumlah_tambah  = $row->jumlah_tambah;
                $nilai_tambah	= $row->nilai_tambah;
                $jumlah_kurang  = $row->jumlah_kurang;
                $nilai_kurang	= $row->nilai_kurang;
                $keterangan  	= $row->keterangan;
                //$cthn   = $row->tahun;
                //$kondisi= $row->kondisi;
                /*switch($kondisi)
                {
                    case '0':
                        $kondisi='-';
                        break;
                    case '1':
                        $kondisi='BAIK';
                        break;
                    case '2':
                        $kondisi='RUSAK RINGAN';
                        break;
                    case '3':
                        $kondisi='RUSAK BERAT';
                        break;
                }*/
                //$ket    = $row->keterangan; 
                
                //$awal   = $this->awal_rkp($cskpd,$tahun,$kdbrg);
				$pertama  = $this->pertama($cskpd,$tgl_awal);
                $hapus  = $this->hapus_rkp($cskpd,$tahun,$kdbrg);
                $tambah = $this->tambah_rkp($cskpd,$tahun,$kdbrg);
                
                $totjum = ($pertama['jumlah']-$hapus['jmlh'])+$tambah['jmlh'];
                $tothrg =  ($pertama['nilai']-$hapus['harga'])+$tambah['harga'];              
            
			
			    $jumlah_akhir= $jumlah_awal+$jumlah_tambah-$jumlah_kurang;
				$nilai_akhir = $nilai_awal+$nilai_tambah-$nilai_kurang;
			
            		$cRet .="	
                        <tr>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$kdbrg</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$reg</td>
                            <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$nm_brg</td>
                            <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$merek</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$gabung</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$kd_bahan</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$asal</td>
            				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$tahun</td>
            				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$silinder</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$kd_satuan</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$kondisi</td>
							<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">$jumlah_awal</td>
                            <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai_awal)."</td>
								<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">$jumlah_kurang</td>
								<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">$nilai_kurang</td>
								<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">$jumlah_tambah</td>
								<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">$nilai_tambah</td>
            				<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">$jumlah_akhir</td>
                            <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai_akhir)."</td>
                            <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$keterangan</td> 
							
							
            				<!--td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".$pertama['jumlah']."</td>
                            <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($pertama['nilai'])."</td>
								<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".$hapus['jmlh']."</td>
								<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($hapus['harga'])."</td>
								<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".$tambah['jmlh']."</td>
								<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tambah['harga'])."</td>
            				<td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".$totjum."</td>
                            <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tothrg)."</td>
                            <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td-->                
            		     </tr>";
                $i++;			
               }  
            
          $cRet .="  
			</table><BR/><BR/>";
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Mengetahui,</td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$kota, ".$this->tanggal_indonesia($lctgl).".</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Kepala SKPD<br><br><br><br></td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Pengurus Barang<br><br><br><br></td>
					</tr>					
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">( $nm_tahu )</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">( $nm_bend )</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_tahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_bend</td>
					</tr>
					</table>";
					//echo $cRet;
				//$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'BUKU INVENTARIS';
        $this->template->set('title', 'BUKU INVENTARIS');  
        switch($iz) {
        case 1;  
		//$this->mdata->_mpdf3('',$cRet,4,3,3,3,$kertas,1);   
		echo $cRet; 
        //$this->_mpdfa('',$cRet,80,90,90,1);
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            
            $this->load->view('transaksi/excel', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
           $this->load->view('transaksi/excel', $data);
        break;
        }
         } 
	}
	

	function pertama($cskpd,$tgl_awal){
		$iz=array();
		$sql="SELECT * FROM (SELECT COUNT(a.jumlah) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_a a WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_awal'
UNION
SELECT COUNT(a.jumlah) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_b a WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_awal' GROUP BY a.no_urut
UNION
SELECT COUNT(a.jumlah) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_c a WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_awal'
UNION
SELECT COUNT(a.jumlah) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_d a WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_awal'
UNION
SELECT COUNT(a.jumlah) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_e a WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_awal'
UNION
SELECT COUNT(a.jumlah) AS jumlah,SUM(a.nilai) AS nilai 
FROM trkib_f a WHERE a.kd_unit='$cskpd' AND a.tgl_reg<='$tgl_awal') faiz";
					 
			$query2 = $this->db->query($sql);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh       = $resulte2['jumlah']; 
                $harga      = $resulte2['nilai'];
			}      
         
        	$iz['jumlah']     = $jmlh; 
            $iz['nilai']      = $harga;
            
			return $iz;
	} 

	function mula($kd_unit,$id_barang,$tgl_awal){
	$awal=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_awal,sum(c.nilai) AS nilai_awal FROM trkib_a c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg<='$tgl_awal'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh       = $resulte2['jumlah_awal']; 
                $harga      = $resulte2['nilai_awal'];
			}      
         
        	$awal['jumlah_awal']     = $jmlh; 
            $awal['nilai_awal']      = $harga;
            
			return $awal;
	
	
	}
	
	function mula2($kd_unit,$id_barang,$tgl_awal){
	$awal=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_awal,sum(c.nilai) AS nilai_awal FROM trkib_b c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg<='$tgl_awal'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh       = $resulte2['jumlah_awal']; 
                $harga      = $resulte2['nilai_awal'];
			}      
         
        	$awal['jumlah_awal']     = $jmlh; 
            $awal['nilai_awal']      = $harga;
            
			return $awal;
	
	
	}
		function mula3($kd_unit,$id_barang,$tgl_awal){
	$awal=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_awal,sum(c.nilai) AS nilai_awal FROM trkib_c c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg<='$tgl_awal'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh       = $resulte2['jumlah_awal']; 
                $harga      = $resulte2['nilai_awal'];
			}      
         
        	$awal['jumlah_awal']     = $jmlh; 
            $awal['nilai_awal']      = $harga;
            
			return $awal;
	
	
	}	function mula4($kd_unit,$id_barang,$tgl_awal){
	$awal=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_awal,sum(c.nilai) AS nilai_awal FROM trkib_d c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg<='$tgl_awal'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh       = $resulte2['jumlah_awal']; 
                $harga      = $resulte2['nilai_awal'];
			}      
         
        	$awal['jumlah_awal']     = $jmlh; 
            $awal['nilai_awal']      = $harga;
            
			return $awal;
	
	
	}	function mula5($kd_unit,$id_barang,$tgl_awal){
	$awal=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_awal,sum(c.nilai) AS nilai_awal FROM trkib_e c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg<='$tgl_awal'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh       = $resulte2['jumlah_awal']; 
                $harga      = $resulte2['nilai_awal'];
			}      
         
        	$awal['jumlah_awal']     = $jmlh; 
            $awal['nilai_awal']      = $harga;
            
			return $awal;
	
	
	}	function mula6($kd_unit,$id_barang,$tgl_awal){
	$awal=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_awal,sum(c.nilai) AS nilai_awal FROM trkib_f c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg<='$tgl_awal'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh       = $resulte2['jumlah_awal']; 
                $harga      = $resulte2['nilai_awal'];
			}      
         
        	$awal['jumlah_awal']     = $jmlh; 
            $awal['nilai_awal']      = $harga;
            
			return $awal;
	
	
	}
	
	function tengah($kd_unit,$id_barang,$tgl_awal,$tgl_akhir){
	$tengah=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_tambah,sum(c.nilai) AS nilai_tambah FROM trkib_a c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg>='$tgl_awal' and c.tgl_reg<='$tgl_akhir'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh3       = $resulte2['jumlah_tambah']; 
                $harga3      = $resulte2['nilai_tambah'];
			}      
         
        	$tengah['jumlah_tambah']     = $jmlh3; 
            $tengah['nilai_tambah']      = $harga3;
            
			return $tengah;
	
	
	}	
	
	function tengah2($kd_unit,$id_barang,$tgl_awal,$tgl_akhir){
	$tengah=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_tambah,sum(c.nilai) AS nilai_tambah FROM trkib_b c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg>='$tgl_awal' and c.tgl_reg<='$tgl_akhir'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh3       = $resulte2['jumlah_tambah']; 
                $harga3      = $resulte2['nilai_tambah'];
			}      
         
        	$tengah['jumlah_tambah']     = $jmlh3; 
            $tengah['nilai_tambah']      = $harga3;
            
			return $tengah;
	
	
	}
	function tengah3($kd_unit,$id_barang,$tgl_awal,$tgl_akhir){
	$tengah=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_tambah,sum(c.nilai) AS nilai_tambah FROM trkib_c c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg>='$tgl_awal' and c.tgl_reg<='$tgl_akhir'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh3       = $resulte2['jumlah_tambah']; 
                $harga3      = $resulte2['nilai_tambah'];
			}      
         
        	$tengah['jumlah_tambah']     = $jmlh3; 
            $tengah['nilai_tambah']      = $harga3;
            
			return $tengah;
	
	
	}
	function tengah4($kd_unit,$id_barang,$tgl_awal,$tgl_akhir){
	$tengah=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_tambah,sum(c.nilai) AS nilai_tambah FROM trkib_d c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg>='$tgl_awal' and c.tgl_reg<='$tgl_akhir'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh3       = $resulte2['jumlah_tambah']; 
                $harga3      = $resulte2['nilai_tambah'];
			}      
         
        	$tengah['jumlah_tambah']     = $jmlh3; 
            $tengah['nilai_tambah']      = $harga3;
            
			return $tengah;
	
	
	}
	function tengah5($kd_unit,$id_barang,$tgl_awal,$tgl_akhir){
	$tengah=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_tambah,sum(c.nilai) AS nilai_tambah FROM trkib_e c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg>='$tgl_awal' and c.tgl_reg<='$tgl_akhir'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh3       = $resulte2['jumlah_tambah']; 
                $harga3      = $resulte2['nilai_tambah'];
			}      
         
        	$tengah['jumlah_tambah']     = $jmlh3; 
            $tengah['nilai_tambah']      = $harga3;
            
			return $tengah;
	
	
	}
	function tengah6($kd_unit,$id_barang,$tgl_awal,$tgl_akhir){
	$tengah=array();

	    $sq2 ="SELECT COUNT(c.nilai) AS jumlah_tambah,sum(c.nilai) AS nilai_tambah FROM trkib_f c WHERE '$kd_unit'=c.kd_unit AND c.id_barang='$id_barang' AND c.tgl_reg>='$tgl_awal' and c.tgl_reg<='$tgl_akhir'";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh3       = $resulte2['jumlah_tambah']; 
                $harga3      = $resulte2['nilai_tambah'];
			}      
         
        	$tengah['jumlah_tambah']     = $jmlh3; 
            $tengah['nilai_tambah']      = $harga3;
            
			return $tengah;
	
	
	}
	
    function awal_rkp($cskpd,$tahun,$kdbrg){
        
		$awal=array();

	    $sq2 ="SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_a a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and  no_hapus is null and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_b a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus IS NULL and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_c a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus IS NULL and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_d a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus IS NULL and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_e a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus IS NULL and tahun < '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_f a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus IS NULL and tahun < '$tahun' ";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh=0;
            $harga=0;
			foreach($query2->result_array() as $resulte2){

        		$jmlh       = $jmlh + $resulte2['jmlh']; 
                $harga      = $harga + $resulte2['harga'];
			}      
         
        	$awal['jmlh']     = $jmlh; 
            $awal['harga']    = $harga;
            
			return $awal;
	}
    
    function hapus_rkp($cskpd,$tahun,$kdbrg){
        
		$hapus=array();

		$sq2 = "SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_a a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
	UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_b a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
	UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_c a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
	UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_d a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
	UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_e a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
	UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_f a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun < '$tahun'
	";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh       = 0; 
            $harga      = 0;
			foreach($query2->result_array() as $resulte2){	
			 
        		$jmlh       = $jmlh + $resulte2['jmlh']; 
                $harga      = $harga + $resulte2['harga'];
			}      
            $hapus['jmlh']   = $jmlh; 
            $hapus['harga']  = $harga;
            
			return $hapus;
	}
    
   function tambah_rkp($cskpd,$tahun,$kdbrg){
        
		$tambah=array();

	    $sq2 = "SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_a a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun >= '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_b a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun >= '$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_c a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun >='$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_d a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun >='$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_e a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun >='$tahun'
                UNION SELECT COUNT(a.kd_brg)AS jmlh,SUM(a.nilai) AS harga FROM trkib_f a WHERE kd_brg='$kdbrg' and kd_unit='$cskpd' and no_hapus <>'' and tahun >='$tahun'
                ";
					 
			$query2 = $this->db->query($sq2);  
            $jmlh       = 0; 
            $harga      = 0;
			foreach($query2->result_array() as $resulte2){	
			 
        		$jmlh       = $jmlh + $resulte2['jmlh']; 
                $harga      = $harga + $resulte2['harga'];
			}      
            $tambah['jmlh']   = $jmlh; 
            $tambah['harga']  = $harga;
            
			return $tambah;
	}


	public function lap_rkp_mutasi_barang()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		$thn		= $this->session->userdata('ta_simbakda');
		$cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
        $tahun 		= $_REQUEST['tahun'];
        $tahun2 	= $_REQUEST['tahun2'];
         
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
         
        $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">					
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: Nama SKPD</td>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;KABUPATEN/KOTA</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $kota</td>
            </tr>	
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $prov</td>
            </tr>
			<tr>
                <td width=\"15%\"align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
				<th width =\"85%\" align=\"center\" style=\"font-size:14px; font-family:tahoma;\">REKAPITULASI DAFTAR MUTASI BARANG (x)<br>MILIK KOTA $kota<br>TAHUN $thn</th>
            </tr>			
            </table>
			<BR/>
			<BR/>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"2\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td rowspan='3' width=\"5%\" align=\"center\" style=\"font-size:12px\">No.Urut</td>
                <td rowspan='3' width=\"5%\" align=\"center\" style=\"font-size:12px\">Golongan</td>
                <td rowspan='3' width=\"5%\" align=\"center\" style=\"font-size:12px\">Kode<br>Bidang<br>Barang</td>
                <td rowspan='3' width=\"20%\" align=\"center\" style=\"font-size:12px\">Nama Bidang Barang</td>
                <td colspan='2' align=\"center\" style=\"font-size:12px\">Keadaan Per 1 Jan 20xx</td>
                <td colspan='4' align=\"center\" style=\"font-size:12px\">Mutasi/Perubahan Selama<br>1 Jan 20xx s/d<br>31 Des 20xx</td>
                <td colspan='2' align=\"center\" style=\"font-size:12px\">Keadaan Per 30 Des 20xx</td>
                <td rowspan='3' width=\"5%\" align=\"center\" style=\"font-size:12px\">Ket</td>					
			</tr>
            <tr>
                <td rowspan='2' width =\"8%\" align=\"center\" style=\"font-size:11px\">Jumlah Barang</td>
                <td rowspan='2' width =\"8%\" align=\"center\" style=\"font-size:11px\">Jumlah Harga</td>
                <td colspan ='2' align =\"center\" style=\"font-size:11px\">Berkurang</td>
                <td colspan ='2' align =\"center\" style=\"font-size:11px\">Bertambah</td>
                <td rowspan ='2' width =\"8%\" align=\"center\" style=\"font-size:11px\">Jumlah Barang</td>
                <td rowspan ='2' width =\"8%\" align=\"center\" style=\"font-size:11px\">Jumlah Harga</td>
		     </tr>
			<tr>
				<td width=\"7%\" align=\"center\" style=\"font-size:11px\">Jumlah Barang</td>
				<td width=\"7%\" align=\"center\" style=\"font-size:11px\">Jumlah Harga</td>
				<td width=\"7%\" align=\"center\" style=\"font-size:11px\">Jumlah Barang</td>
				<td width=\"7%\" align=\"center\" style=\"font-size:11px\">Jumlah Harga</td>
			</tr>

            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">12</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">13</td>
		     </tr>
            </thead>";
            
            $csql = "SELECT LEFT(a.kd_brg,2)AS gol ,a.kd_brg,c.nm_brg,a.keterangan FROM trkib_a a INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen
                    INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg 
                    UNION SELECT LEFT(a.kd_brg,2)AS gol ,a.kd_brg,c.nm_brg,a.keterangan FROM trkib_b a INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen
                    INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg 
                    UNION SELECT LEFT(a.kd_brg,2)AS gol ,a.kd_brg,c.nm_brg,a.keterangan FROM trkib_c a INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen
                    INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg 
                    UNION SELECT LEFT(a.kd_brg,2)AS gol ,a.kd_brg,c.nm_brg,a.keterangan FROM trkib_d a INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen
                    INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg
                    UNION SELECT LEFT(a.kd_brg,2)AS gol ,a.kd_brg,c.nm_brg,a.keterangan FROM trkib_e a INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen
                    INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg   
                    UNION SELECT LEFT(a.kd_brg,2)AS gol ,a.kd_brg,c.nm_brg,a.keterangan FROM trkib_f a INNER JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen
                    INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' GROUP BY a.kd_brg  ";
                         
             $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {
                $gol    = $row->gol;
                $kdbrg  = $row->kd_brg;
                $nm_brg = $row->nm_brg;
                $ket    = $row->keterangan; 
                
                $awal   = $this->awal_rkp($cskpd,$tahun,$kdbrg);
                $hapus  = $this->hapus_rkp($cskpd,$tahun,$kdbrg);
                $tambah = $this->tambah_rkp($cskpd,$tahun,$kdbrg);
                
                $totjum = ($awal['jmlh']-$hapus['jmlh'])+$tambah['jmlh'];
                $tothrg =  ($awal['harga']-$hapus['harga'])+$tambah['harga'];   
                
                  
                $cRet .="
			
                <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->gol</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"left\"   style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">".$awal['jmlh']."</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">".number_format($awal['harga'])."</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">".$hapus['jmlh']."</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">".number_format($hapus['harga'])."</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">".$tambah['jmlh']."</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tambah['harga'])."</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$totjum</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tothrg)."</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$ket</td>
    		     </tr>";
                 
               $i++; 
              }
                 
			$cRet.="</table>";
			
			//footer
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<tr>
						<th width =\"35%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</th>
						<td width=\"65%\"align=\"center\" style=\"font-size:12px; font-family:tahoma;\"></td>
					</tr>
					</table>";
					
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>				
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Mengetahui,</td>
						<td width=\"50%\"align=\"center\" style=\"font-size:12px; font-family:tahoma;\">.....,../../....</td>
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Kepala SKPD<br><br><br><br></td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Pengurus Barang<br><br><br><br></td>
					</tr>					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">(Nama Kepala SKPD)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">(Nama Pengurus Barang)</td>
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip.19890316 201010 1 001</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip.19890316 201010 1 002</td>
					</tr>      
					</table>";
                   
         echo $cRet;
         //$data['prev']= $cRet;    
         //$this->_mpdf('',$cRet,'5','5',5,'0'); 
         } 
	}	

	public function lap_usulan_barang_hapus()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		$cskpd = $_REQUEST['kd_skpd'];
        $cnm_skpd = $_REQUEST['nm_skpd'];
        $lctahu = $_REQUEST['tahu'];
        $lcbend = $_REQUEST['bend'];
        $lctgl = $_REQUEST['tgl'];
        $tahun = $_REQUEST['tahun'];
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend = '';
            $nip_bend = '';
            $pkt_bend = '';
            $jbt_bend = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
         $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
                <td width=\"10%\"align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
				<td width =\"80%\" align=\"center\" style=\"font-size:14px; font-family:tahoma;\"><b>DAFTAR USULAN BARANG YANG AKAN DIHAPUS</b></td>
				<td width=\"10%\"align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>
			<BR/>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">:<b> $cskpd - $cnm_skpd </b></td>
				<td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;KAB/KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>
			<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;PROVINSI</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $prov</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>
            </table>";
			
			$cRet .= "<BR/>
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\"><thead>
			<tr>
                <td width=\"10%\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">No</td>
                <td width=\"10%\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nama Barang</td>
                <td width=\"10%\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">No. Kode<br>Barang</td>
                <td width=\"10%\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">No. Kode Lokasi</td>
                <td width=\"5%\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Merk/<br>Type</td>
                <td width=\"15%\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Dokumen<br>Kepemilikan</td>
                <td width=\"10%\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tahun<br>Beli/<br>Pembelian</td>
				<td width=\"10%\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Harga<br>Perolehan</td>
				<td width=\"10%\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Keadaan<br>Barang<br>(B,KB,RB)</td>
				<td width=\"10%\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Keterangan</td>
            </tr> 
			
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
            </tr>
            </thead>";
            
            $csql = "SELECT c.nm_brg,a.kd_brg,''AS merek,''AS tipe,a.tahun,a.nilai,''kondisi,a.keterangan FROM trkib_a a INNER JOIN trd_isianbrg b 
                ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY a.kd_brg
                UNION SELECT c.nm_brg,a.kd_brg,merek,tipe,a.tahun,a.nilai,a.kondisi,a.keterangan FROM trkib_b a INNER JOIN trd_isianbrg b 
                ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY a.kd_brg
                UNION SELECT c.nm_brg,a.kd_brg,''AS merek,''AS tipe,a.tahun,a.nilai,a.kondisi,a.keterangan FROM trkib_c a INNER JOIN trd_isianbrg b 
                ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY a.kd_brg
                UNION SELECT c.nm_brg,a.kd_brg,''AS merek,''AS tipe,a.tahun,a.nilai,a.kondisi,a.keterangan FROM trkib_d a INNER JOIN trd_isianbrg b 
                ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY a.kd_brg
                UNION SELECT c.nm_brg,a.kd_brg,''AS merek,''AS tipe,a.tahun,a.nilai,a.kondisi,a.keterangan FROM trkib_e a INNER JOIN trd_isianbrg b 
                ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY a.kd_brg
                UNION SELECT c.nm_brg,a.kd_brg,''AS merek,''AS tipe,a.tahun,a.nilai,a.kondisi,a.keterangan FROM trkib_f a INNER JOIN trd_isianbrg b 
                ON a.no_dokumen=b.no_dokumen INNER JOIN mbarang c ON a.kd_brg=c.kd_brg WHERE a.kd_unit ='$cskpd' and a.tahun='$tahun' GROUP BY a.kd_brg";
                         
             $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {
                     
               $i++;          
                
                $cRet .="
                <tr>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td align=\"left\" width =\"5%\" 	style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai)."</td>
    				<td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kondisi</td>
    				<td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->keterangan</td>
    		     </tr>";
              }
                 
			$cRet.="</table><br/><br/><br/>";
           
           
         $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"></td>
						<td width=\"50%\"align=\"center\" style=\"font-size:12px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
						&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
						&ensp;&ensp;&ensp;&ensp;&ensp;Bantaeng, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Mengetahui,<br>KEPALA $cnm_skpd<br><br><br><br></td>
						<td width=\"50%\"align=\"center\" style=\"font-size:12px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
						&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
						&ensp;&ensp;&ensp;&ensp;&ensp;PENGURUS BARANG<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"><u>( $nm_tahu )</u></td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"><u>( $nm_bend )</u></td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_tahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_bend</td>					
					</tr>";
			$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'DAFTAR USULAN BARANG YANG AKAN DIHAPUS');        
        $this->_mpdf('',$cRet,10,10,10,1);
         } 
	}

    public function lap_usulan_barang_hapus_dh(){
       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
        $tah        = $this->session->userdata('ta_simbakda');
        $pilih      = $_REQUEST['pilih'];
        $tampil     = $_REQUEST['tampil'];
        $skpd       = $_REQUEST['skpd'];
        $nmskpd     = $_REQUEST['nmskpd'];
        $bidang     = $_REQUEST['bidang'];
        $nmbid      = $_REQUEST['nmbid'];
        //$tahu       = $_REQUEST['tahu'];
        //$bend       = $_REQUEST['bend'];
        //$nmtahu     = $_REQUEST['nmtahu'];
        //$nmbend     = $_REQUEST['nmbend'];
        $pilctk     = $_REQUEST['pilctk'];
        /*if($pilctk=='1' || $pilctk=='2'){
            $bulan      = $_REQUEST['bulan'];
            $tahun      = $_REQUEST['tahun'];
            $bul        = $this->getBulan($bulan); 
        }else{        
            $tahun1     = $_REQUEST['tahun1'];
            $tahun2     = $_REQUEST['tahun2'];
        }
        $jenis      = $_REQUEST['jenis'];
        $nmjenis    = $_REQUEST['nmjenis'];
        $jenis_brg  = strlen($jenis);
        
        if($jenis_brg=='2'){
            $jenis_brg="and left(a.kd_brg,2)='$jenis'";
        }elseif($jenis_brg=='5'){
            $jenis_brg="and left(a.kd_brg,5)='$jenis'";
        }*/

        if($pilctk=='1' || $pilctk=='3'){
            $xy=0;
            $csqlttdpa=$this->db->query("SELECT nip,nama,jabatan FROM ttd WHERE ckey='QQ' AND skpd='$skpd'");
            foreach($csqlttdpa->result() as $rowtd){
                $nippa =$rowtd->nip;
                $namapa=$rowtd->nama;
                $jabatanpa=$rowtd->jabatan;
                $xy++;        
            }
            if($xy==0){
                $nippa      ='Belum Ada NIP';
                $namapa     ='Belum Ada Nama';
                $jabatanpa  ='Belum Ada Jabatan';
            }
            $yx=0;
            $csqlttdbk=$this->db->query("SELECT nip,nama,jabatan FROM ttd WHERE ckey='BK' AND skpd='$skpd'");
            foreach($csqlttdbk->result() as $rowtd){
                $nipbk =$rowtd->nip;
                $namabk=$rowtd->nama;
                $jabatanbk=$rowtd->jabatan;
                $yx++;        
            }
            if($yx==0){
                $nipbk      ='Belum Ada NIP';
                $namabk     ='Belum Ada Nama';
                $jabatanbk  ='Belum Ada Jabatan';
            }
        }elseif($pilctk=='2'){
            $xy=0;
            $csqlttdpa=$this->db->query("SELECT nip,nama,jabatan FROM ttd WHERE ckey='QQ' AND skpd='$skpd' AND kd_lokasi='$bidang'");
            foreach($csqlttdpa->result() as $rowtd){
                $nippa =$rowtd->nip;
                $namapa=$rowtd->nama;
                $jabatanpa=$rowtd->jabatan;
                $xy++;        
            }
            if($xy==0){
                $nippa      ='Belum Ada NIP';
                $namapa     ='Belum Ada Nama';
                $jabatanpa  ='Belum Ada Jabatan';
            }
            $yx=0;
            $csqlttdbk=$this->db->query("SELECT nip,nama,jabatan FROM ttd WHERE ckey='BK' AND skpd='$skpd' AND kd_lokasi='$bidang'");
            foreach($csqlttdbk->result() as $rowtd){
                $nipbk =$rowtd->nip;
                $namabk=$rowtd->nama;
                $jabatanbk=$rowtd->jabatan; 
                $yx++;       
            }
            if($yx==0){
                $nipbk      ='Belum Ada NIP';
                $namabk     ='Belum Ada Nama';
                $jabatanbk  ='Belum Ada Jabatan';
            }
            
        }
        $tglcetak   = $this->tanggal_indonesia($_REQUEST['tglcetak']);
        $tglh       = $this->tanggal_indonesia($_REQUEST['th']);
        $nomor      = $_REQUEST['no_dok'];
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR USULAN BARANG YANG AKAN DIHAPUS</B></td>
            </tr><BR/><BR/><BR/></table>";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width=\"8%\" >&ensp;&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $skpd  $nmskpd</B></td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\" width=\"8%\" >&ensp;&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $bidang  $nmbid</B></td>
            </tr>";}
          $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:13px;\">: $nmkab</td>
            </tr>";
        /*if($pilctk=='1' || $pilctk=='2'){
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $bul  $tahun</td>
            </tr>";
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }*/
           $cRet .="<tr>
                        <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;NO DOKUMEN</td>
                        <td align=\"left\" style=\"font-size:13px;\">: $nomor</td>
                    </tr>
                    <tr>
                        <td align=\"left\" style=\"font-size:13px;\" width=\"13%\">&ensp;&ensp;TGL DOKUMEN</td>
                        <td align=\"left\" style=\"font-size:13px;\">: $tglh</td>
                    </tr>
                </table>";
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">No</td>
                <td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Nama Barang</td>
                <td width=\"8%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">No. Kode<br>Barang</td>
                <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">No. Dokumen<br>Penghapusan</td>
                <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Merk/<br>Type</td>
                <td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Dokumen<br>Kepemilikan</td>
                <td width=\"6%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Tahun<br>Beli/<br>Pembelian</td>
                <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Harga<br>Perolehan</td>
                <td width=\"6%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Keadaan<br>Barang<br>(B,KB,RB)</td>
                <td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Keterangan</td>
            </tr> 
            
            <tr>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">1</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">2</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">3</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">4</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">5</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">6</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">7</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">8</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">9</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">10</td>
            </tr>
            
             </thead>
                ";
                $where='';
            if($pilctk=='1'){
                $where="b.kd_skpd='$skpd' AND";
            }else{
                $where="b.kd_skpd='$skpd' AND b.kd_unit='$bidang' AND";
            }
                $sql="SELECT a.kd_bidang AS kd_brg,(SELECT nm_bidang FROM mbidang WHERE bidang=kd_bidang)AS nm_brg,''AS merek,''AS no_hapus,''AS tahun,SUM(nilai)AS nilai,''AS kondisi,''AS keterangan,''AS dok FROM trd_penghapusan a JOIN trh_penghapusan b ON a.no_hapus=b.no_hapus 
                        AND a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit WHERE $where b.no_hapus='$nomor' AND b.status='' OR b.status IS NULL GROUP BY kd_bidang
                        UNION
                        SELECT a.kd_brg,a.nm_brg,a.merek,a.no_hapus,a.tahun,a.nilai,a.kondisi,a.keterangan,
                        (CASE 
                        WHEN a.kd_golongan='01' THEN (SELECT c.no_sertifikat FROM trkib_a c WHERE c.no=a.no)
                        WHEN a.kd_golongan='02' THEN (SELECT c.no_bpkb FROM trkib_b c WHERE c.no=a.no)
                        WHEN a.kd_golongan='03' THEN (SELECT c.no_oleh FROM trkib_c c WHERE c.no=a.no)
                        WHEN a.kd_golongan='04' THEN (SELECT c.no_oleh FROM trkib_d c WHERE c.no=a.no)
                        WHEN a.kd_golongan='05' THEN (SELECT c.no_oleh FROM trkib_e c WHERE c.no=a.no)
                        WHEN a.kd_golongan='06' THEN (SELECT c.no_oleh FROM trkib_f c WHERE c.no=a.no) 
                        END)AS dok FROM trd_penghapusan a JOIN trh_penghapusan b ON a.no_hapus=b.no_hapus 
                        AND a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit WHERE $where b.no_hapus='$nomor' AND b.status='' OR b.status IS NULL
                        ORDER BY kd_brg,tahun,no_hapus ";
                    
                    $query1 = $this->db->query($sql);
                    $i=0;$totalsel=0;
                    foreach ($query1->result() as $row){
                        //$i++;
                        
                            $kd_brg     = $row->kd_brg;
                            $nm_brg     = $row->nm_brg;
                            $merek      = $row->merek;
                            $no_hapus   = $row->no_hapus;
                            $tahun      = $row->tahun;
                            $dok        = $row->dok;
                            $nilai      = number_format($row->nilai,2,',','.');
                            $kondisi    = $row->kondisi;
                            $keterangan = $row->keterangan;
                            
                            if(strlen($kd_brg)!=5 ){
                                $i++;
                                $totalsel       =$totalsel+$row->nilai;
                    
                            }
                    
                        if(strlen($kd_brg)==5){
                            $cRet .="<tr>
                                    <td colspan=\"7\" align=\"left\" style=\"font-size:11px\"><b>&nbsp;&nbsp;&nbsp;$kd_brg  $nm_brg</b></td>
                                    <td align=\"right\" style=\"font-size:11px\"><b>$nilai</b></td>
                                    <td align=\"left\" style=\"font-size:11px\"></td>
                                    <td align=\"left\" style=\"font-size:11px\"></td>
                                </tr>";
                        }else{

                        $cRet .="<tr>
                                    <td align=\"center\" style=\"font-size:11px\">$i</td>
                                    <td align=\"left\" style=\"font-size:11px\">$nm_brg </td>
                                    <td align=\"center\" style=\"font-size:11px\">$kd_brg</td>
                                    <td align=\"left\" style=\"font-size:11px\">$no_hapus</td>
                                    <td align=\"left\" style=\"font-size:11px\">$merek</td>
                                    <td align=\"left\" style=\"font-size:11px\">$dok</td>
                                    <td align=\"center\" style=\"font-size:11px\">$tahun</td>
                                    <td align=\"right\" style=\"font-size:11px\">$nilai</td>
                                    <td align=\"center\" style=\"font-size:11px\">$kondisi</td>
                                    <td align=\"left\" style=\"font-size:11px\">$keterangan</td>
                                    
                                </tr>";
                            }
                        
                    }
                    $cRet .="<tr>
                                <td bgcolor=\"#CCCCCC\" colspan=\"7\" align=\"center\" width =\"2%\" style=\"font-size:11px\"><b>Jumlah</b></td>
                                <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($totalsel,2,',','.')."</b></td>
                                <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:11px\"></td>
                                <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:11px\"></td>
                            </tr>";
           // }
         $cRet .="</table>"; 
         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td><td>
                <td align=\"center\" colspan=\"7\" style=\"font-size:10px\"></td>
            </tr>
                <br/><br/>
            <tr>
                <td><td>
                <td colspan=\"5\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>
            <tr>
                <td><td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;MENGETAHUI</td>
                <td colspan=\"2\"></td>
                <td colspan=\"3\"></td>
            </tr>
                <Tr></Tr><Tr></Tr>
            <tr>
                <td><td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;KEPALA $nmskpd</td>
                <td colspan=\"2\"></td>
                <td colspan=\"2\"></td>
                <td align=\"center\" style=\"font-size:11px\">PENGURUS BARANG</td>          
            </tr>
            <tr>
                <td><td>
                <td align=\"center\" colspan=\"7\" style=\"font-size:11px\" height=\"50\"></td>
            </tr>
            <tr>
                <td><td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;(<u> $namapa </u>)</td>
                <td colspan=\"2\"></td>
                <td colspan=\"2\"></td>
                <td align=\"center\" style=\"font-size:11px\">(<u> $namabk </u>)</td>
            </tr>
            <tr>
                <td><td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;&ensp;NIP. $nippa</td>
                <td colspan=\"2\"></td>
                <td colspan=\"2\"></td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nipbk</td>
            </tr>";
            
        $cRet .=       " </table>";
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        $judul  = 'Laporan PENGHAPUSAN ASET';
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        $this->template->set('title', 'Laporan PENGHAPUSAN ASET');  
        switch($pilih) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul - $test.xls");
            $this->load->view('transaksi/excel', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul - $test.doc");
           $this->load->view('transaksi/excel', $data);
        break;
                }   
          
    }

    public function lap_daftar_barang_hapus_dh(){
       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
        $tah        = $this->session->userdata('ta_simbakda');
        $pilih      = $_REQUEST['pilih'];
        $tampil     = $_REQUEST['tampil'];
        $skpd       = $_REQUEST['skpd'];
        $nmskpd     = $_REQUEST['nmskpd'];
        $bidang     = $_REQUEST['bidang'];
        $nmbid      = $_REQUEST['nmbid'];
        //$tahu       = $_REQUEST['tahu'];
        //$bend       = $_REQUEST['bend'];
        //$nmtahu     = $_REQUEST['nmtahu'];
        //$nmbend     = $_REQUEST['nmbend'];
        $pilctk     = $_REQUEST['pilctk'];
        if($pilctk=='1' || $pilctk=='3'){
            $xy=0;
            $csqlttdpa=$this->db->query("SELECT nip,nama,jabatan FROM ttd WHERE ckey='QQ' AND skpd='$skpd'");
            foreach($csqlttdpa->result() as $rowtd){
                $nippa =$rowtd->nip;
                $namapa=$rowtd->nama;
                $jabatanpa=$rowtd->jabatan;
                $xy++;        
            }
            if($xy==0){
                $nippa      ='Belum Ada NIP';
                $namapa     ='Belum Ada Nama';
                $jabatanpa  ='Belum Ada Jabatan';
            }
            $yx=0;
            $csqlttdbk=$this->db->query("SELECT nip,nama,jabatan FROM ttd WHERE ckey='BK' AND skpd='$skpd'");
            foreach($csqlttdbk->result() as $rowtd){
                $nipbk =$rowtd->nip;
                $namabk=$rowtd->nama;
                $jabatanbk=$rowtd->jabatan;
                $yx++;        
            }
            if($yx==0){
                $nipbk      ='Belum Ada NIP';
                $namabk     ='Belum Ada Nama';
                $jabatanbk  ='Belum Ada Jabatan';
            }
        }elseif($pilctk=='2'){
            $xy=0;
            $csqlttdpa=$this->db->query("SELECT nip,nama,jabatan FROM ttd WHERE ckey='QQ' AND skpd='$skpd' AND kd_lokasi='$bidang'");
            foreach($csqlttdpa->result() as $rowtd){
                $nippa =$rowtd->nip;
                $namapa=$rowtd->nama;
                $jabatanpa=$rowtd->jabatan;
                $xy++;        
            }
            if($xy==0){
                $nippa      ='Belum Ada NIP';
                $namapa     ='Belum Ada Nama';
                $jabatanpa  ='Belum Ada Jabatan';
            }
            $yx=0;
            $csqlttdbk=$this->db->query("SELECT nip,nama,jabatan FROM ttd WHERE ckey='BK' AND skpd='$skpd' AND kd_lokasi='$bidang'");
            foreach($csqlttdbk->result() as $rowtd){
                $nipbk =$rowtd->nip;
                $namabk=$rowtd->nama;
                $jabatanbk=$rowtd->jabatan; 
                $yx++;       
            }
            if($yx==0){
                $nipbk      ='Belum Ada NIP';
                $namabk     ='Belum Ada Nama';
                $jabatanbk  ='Belum Ada Jabatan';
            }
            
        }
        /*if($pilctk=='1' || $pilctk=='2'){
            $bulan      = $_REQUEST['bulan'];
            $tahun      = $_REQUEST['tahun'];
            $bul        = $this->getBulan($bulan); 
        }else{        
            $tahun1     = $_REQUEST['tahun1'];
            $tahun2     = $_REQUEST['tahun2'];
        }
        $jenis      = $_REQUEST['jenis'];
        $nmjenis    = $_REQUEST['nmjenis'];
        $jenis_brg  = strlen($jenis);
        
        if($jenis_brg=='2'){
            $jenis_brg="and left(a.kd_brg,2)='$jenis'";
        }elseif($jenis_brg=='5'){
            $jenis_brg="and left(a.kd_brg,5)='$jenis'";
        }*/
        $tglcetak   = $this->tanggal_indonesia($_REQUEST['tglcetak']);
        $tglh       = $this->tanggal_indonesia($_REQUEST['th']);
        $nomor      = $_REQUEST['no_dok'];
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR BARANG YANG DIHAPUS</B></td>
            </tr><BR/><BR/><BR/></table>";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width=\"8%\" >&ensp;&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $skpd  $nmskpd</B></td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\" width=\"8%\" >&ensp;&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $bidang  $nmbid</B></td>
            </tr>";}
          $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:13px;\">: $nmkab</td>
            </tr>";
        /*if($pilctk=='1' || $pilctk=='2'){
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $bul  $tahun</td>
            </tr>";
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }*/
           $cRet .="<tr>
                        <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;NO DOKUMEN</td>
                        <td align=\"left\" style=\"font-size:13px;\">: $nomor</td>
                    </tr>
                    <tr>
                        <td align=\"left\" style=\"font-size:13px;\" width=\"13%\">&ensp;&ensp;TGL DOKUMEN</td>
                        <td align=\"left\" style=\"font-size:13px;\">: $tglh</td>
                    </tr>
                </table>";
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">No</td>
                <td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Nama Barang</td>
                <td width=\"8%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">No. Kode<br>Barang</td>
                <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">No. Dokumen<br>Penghapusan</td>
                <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Merk/<br>Type</td>
                <td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Dokumen<br>Kepemilikan</td>
                <td width=\"6%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Tahun<br>Beli/<br>Pembelian</td>
                <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Harga<br>Perolehan</td>
                <td width=\"6%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Keadaan<br>Barang<br>(B,KB,RB)</td>
                <td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px; \">Keterangan</td>
            </tr> 
            
            <tr>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">1</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">2</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">3</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">4</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">5</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">6</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">7</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">8</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">9</td>
                <td align=\"center\" style=\"font-size:12px; bgcolor=\"#CCCCCC\"\">10</td>
            </tr>
            
             </thead>
                ";
                $where='';
            if($pilctk=='1'){
                $where="b.kd_skpd='$skpd' AND";
            }else{
                $where="b.kd_skpd='$skpd' AND b.kd_unit='$bidang' AND";
            }
                $sql="SELECT a.kd_bidang AS kd_brg,(SELECT nm_bidang FROM mbidang WHERE bidang=kd_bidang)AS nm_brg,''AS merek,''AS no_hapus,''AS tahun,SUM(nilai)AS nilai,''AS kondisi,''AS keterangan,''AS dok FROM trd_penghapusan a JOIN trh_penghapusan b ON a.no_hapus=b.no_hapus 
                        AND a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit WHERE $where b.no_hapus='$nomor' AND b.status='Y'  GROUP BY kd_bidang
                        UNION
                        SELECT a.kd_brg,a.nm_brg,a.merek,a.no_hapus,a.tahun,a.nilai,a.kondisi,a.keterangan,
                        (CASE 
                        WHEN a.kd_golongan='01' THEN (SELECT c.no_sertifikat FROM trkib_a c WHERE c.no=a.no)
                        WHEN a.kd_golongan='02' THEN (SELECT c.no_bpkb FROM trkib_b c WHERE c.no=a.no)
                        WHEN a.kd_golongan='03' THEN (SELECT c.no_oleh FROM trkib_c c WHERE c.no=a.no)
                        WHEN a.kd_golongan='04' THEN (SELECT c.no_oleh FROM trkib_d c WHERE c.no=a.no)
                        WHEN a.kd_golongan='05' THEN (SELECT c.no_oleh FROM trkib_e c WHERE c.no=a.no)
                        WHEN a.kd_golongan='06' THEN (SELECT c.no_oleh FROM trkib_f c WHERE c.no=a.no) 
                        END)AS dok FROM trd_penghapusan a JOIN trh_penghapusan b ON a.no_hapus=b.no_hapus 
                        AND a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit WHERE $where b.no_hapus='$nomor' AND b.status='Y' 
                        ORDER BY kd_brg,tahun,no_hapus ";
                    
                    $query1 = $this->db->query($sql);
                    $i=0;$totalsel=0;
                    foreach ($query1->result() as $row){
                        //$i++;
                        
                            $kd_brg     = $row->kd_brg;
                            $nm_brg     = $row->nm_brg;
                            $merek      = $row->merek;
                            $no_hapus   = $row->no_hapus;
                            $tahun      = $row->tahun;
                            $dok        = $row->dok;
                            $nilai      = number_format($row->nilai,2,',','.');
                            $kondisi    = $row->kondisi;
                            $keterangan = $row->keterangan;
                            
                            if(strlen($kd_brg)!=5 ){
                                $i++;
                                $totalsel       =$totalsel+$row->nilai;
                    
                            }
                    
                        if(strlen($kd_brg)==5){
                            $cRet .="<tr>
                                    <td colspan=\"7\" align=\"left\" style=\"font-size:11px\"><b>&nbsp;&nbsp;&nbsp;$kd_brg  $nm_brg</b></td>
                                    <td align=\"right\" style=\"font-size:11px\"><b>$nilai</b></td>
                                    <td align=\"left\" style=\"font-size:11px\"></td>
                                    <td align=\"left\" style=\"font-size:11px\"></td>
                                </tr>";
                        }else{

                        $cRet .="<tr>
                                    <td align=\"center\" style=\"font-size:11px\">$i</td>
                                    <td align=\"left\" style=\"font-size:11px\">$nm_brg </td>
                                    <td align=\"center\" style=\"font-size:11px\">$kd_brg</td>
                                    <td align=\"left\" style=\"font-size:11px\">$no_hapus</td>
                                    <td align=\"left\" style=\"font-size:11px\">$merek</td>
                                    <td align=\"left\" style=\"font-size:11px\">$dok</td>
                                    <td align=\"center\" style=\"font-size:11px\">$tahun</td>
                                    <td align=\"right\" style=\"font-size:11px\">$nilai</td>
                                    <td align=\"center\" style=\"font-size:11px\">$kondisi</td>
                                    <td align=\"left\" style=\"font-size:11px\">$keterangan</td>
                                    
                                </tr>";
                            }
                        
                    }
                    $cRet .="<tr>
                                <td bgcolor=\"#CCCCCC\" colspan=\"7\" align=\"center\" width =\"2%\" style=\"font-size:11px\"><b>Jumlah</b></td>
                                <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($totalsel,2,',','.')."</b></td>
                                <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:11px\"></td>
                                <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:11px\"></td>
                            </tr>";
           // }
         $cRet .="</table>"; 
         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td><td>
                <td align=\"center\" colspan=\"7\" style=\"font-size:10px\"></td>
            </tr>
                <br/><br/>
            <tr>
                <td><td>
                <td colspan=\"5\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>
            <tr>
                <td><td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;MENGETAHUI</td>
                <td colspan=\"2\"></td>
                <td colspan=\"3\"></td>
            </tr>
                <Tr></Tr><Tr></Tr>
            <tr>
                <td><td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;KEPALA $nmskpd</td>
                <td colspan=\"2\"></td>
                <td colspan=\"2\"></td>
                <td align=\"center\" style=\"font-size:11px\">PENGURUS BARANG</td>          
            </tr>
            <tr>
                <td><td>
                <td align=\"center\" colspan=\"7\" style=\"font-size:11px\" height=\"50\"></td>
            </tr>
            <tr>
                <td><td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;(<u> $namapa </u>)</td>
                <td colspan=\"2\"></td>
                <td colspan=\"2\"></td>
                <td align=\"center\" style=\"font-size:11px\">(<u> $namabk </u>)</td>
            </tr>
            <tr>
                <td><td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;&ensp;NIP. $nippa</td>
                <td colspan=\"2\"></td>
                <td colspan=\"2\"></td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nipbk</td>
            </tr>";
            
        $cRet .=       " </table>";
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        $judul  = 'Laporan Penghapusan Aset';
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        $this->template->set('title', 'Laporan Penghapusan Aset');  
        switch($pilih) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul - $test.xls");
            $this->load->view('transaksi/excel', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
           $this->load->view('transaksi/excel', $data);
        break;
                }   
          
    }

	public function lap_pemeliharaan_barang()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		//$peng 		= $_REQUEST['peng'];
        //$no_pel 	= $_REQUEST['no_pel'];
		$cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
        $thn  = $this->session->userdata('ta_simbakda');
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu 	= '';
            $nip_tahu 	= '';
            $pkt_tahu 	= '';
            $jbt_tahu 	='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend 	= '';
            $nip_bend 	= '';
            $pkt_bend 	= '';
            $jbt_bend 	= '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
    $cRet 	="";
    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\">: $prov</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
            </tr>
			
			<tr>
                <td width=\"10%\"align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
				<td width =\"80%\" align=\"center\" style=\"font-size:14px; font-family:tahoma;\"><b>KARTU PEMELIHARAAN BARANG<br>TAHUN ANGGARAN $thn </b></td>
				<td width=\"10%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\">Kode Lokasi :$cskpd</td>
            </tr>
            </table><BR/><BR/>
			
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
			<tr>
                <td rowspan='2' bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">No</td>
                <td colspan='2' bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Spesifikasi Barang</td>
                <td rowspan='2' bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nama Barang<br>Yang Dipelihara</td>
                <td rowspan='2' bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jenis<br>Pemeliharaan</td>
                <td rowspan='2' bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Yang<br>Memelihara</td>
                <td rowspan='2' bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tanggal<br>Pemeliharaan</td>
                <td rowspan='2' bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Biaya<br>Pemeliharaan</td>
				<td rowspan='2' bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Bukti<br>Pemeliharaan</td>
				<td rowspan='2' bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Keterangan</td>
            </tr>
            
			<tr>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\">Kode Barang</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\">No.Register</td>
            </tr>
			
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
            </tr>
			</thead>";
			$csql = "SELECT a.nm_brg,b.nm_uskpd,a.nm_brg,a.uraian_pelihara,b.tgl_dokumen,a.biaya_pelihara,a.kd_brg,a.jumlah,a.harga,a.total,a.ket FROM trd_trpelihara a 
                    INNER JOIN trh_trpelihara b ON a.no_dokumen=b.no_dokumen WHERE b.kd_uskpd ='$cskpd' and b.tahun='$thn'";
                         
             $hasil = $this->db->query($csql);
             $i = 0;
			 $total_biaya = 0;
             foreach ($hasil->result() as $row){
                           $i++;
						   $total_biaya= $row->biaya_pelihara+$total_biaya;
			$cRet .="<tr>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_brg</td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->uraian_pelihara</td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$peng</td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->tgl_dokumen</td>
                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format("$row->biaya_pelihara")."</td>
				<td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$no_pel</td>
				<td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->ket</td>
             </tr>";}
			 
			 /*   $csql = "SELECT sum(a.harga) as biaya
                      FROM trd_trpelihara a LEFT JOIN mbarang b ON a.kd_brg = b.kd_brg LEFT JOIN 
                      trh_trpelihara c ON a.no_dokumen = c.no_dokumen WHERE c.kd_uskpd = '$cskpd' and tahun='$thn'";
                         
             $hasil = $this->db->query($csql);
			 
             foreach ($hasil->result() as $row){
			 $biaya= $row->biaya;
			  } */
				$cRet .="<tr>
                    <td colspan=\"7\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px\">TOTAL BIAYA</td>
                    <td colspan=\"3\" bgcolor=\"#ADFF2F\" align=\"left\" style=\"font-size:11px\">Rp. ".number_format("$total_biaya")."</td>
				</tr>";
			$cRet.="</table>";
		
       $cRet .="<br/><table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Mengetahui,<br>KEPALA SKPD<br><br><br><br></td>
						<td width=\"50%\"align=\"center\" style=\"font-size:12px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
						&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
						&ensp;&ensp;&ensp;&ensp;&ensp;PENGURUS BARANG<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"><u>( $nm_tahu )</u></td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"><u>( $nm_bend )</u></td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_tahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_bend</td>					
					</tr>";
			$cRet .=" </table>";
        $data['prev']= $cRet;
        $this->template->set('title', 'KARTU PEMELIHARAAN BARANG');        
        $this->_mpdf('',$cRet,10,10,10,1);
         } 
	}
	
	public function cetak_riwayat()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
		//$peng 		= $_REQUEST['peng'];
        //$no_pel 	= $_REQUEST['no_pel'];
		$cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
        $thn  = $this->session->userdata('ta_simbakda');
        
        // identitas yang mengetahuin / pengguna anggaran
        if($lctahu==''){
            $nm_tahu 	= '';
            $nip_tahu 	= '';
            $pkt_tahu 	= '';
            $jbt_tahu 	='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
        // identitas bendahara
        
        if($lcbend==''){
            $nm_bend 	= '';
            $nip_bend 	= '';
            $pkt_bend 	= '';
            $jbt_bend 	= '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs = $this->db->query($csql1);
        $trh2 = $rs->row();
        $nm_bend = $trh2->nama;
        $nip_bend = $trh2->nip;
        $pkt_bend = $trh2->nm_pangkat;
        $jbt_bend = $trh2->jabatan;
        }
        
    $cRet 	="";
    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
                <td width=\"10%\"align=\"left\" style=\"font-size:14px; font-family:tahoma;\"></td>
				<td width =\"80%\" align=\"center\" style=\"font-size:14px; font-family:tahoma;\"><b>DAFTAR RIWAYAT ASET KOTA Bantaeng</b></td>
				<td width=\"10%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
            </table><BR/><BR/>
			
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
			<tr>
                <td  bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:13px\">NO</td>
                <td  bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:13px\">NO REG</td>
                <td  bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:13px\">TANGGAL PEROLEHAN</td>
                <td  bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:13px\">KONDISI</td>
                <td  bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:13px\">NILAI</td>
                <td  bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:13px\">SKPD</td>
                <td  bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:13px\">KETERANGAN</td>
				<td  bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:13px\">RIWAYAT</td>
				<td  bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:13px\">TANGGAL RIWAYAT</td>
				<td  bgcolor=\"#ADFF2F\" width=\"10%\" align=\"center\" style=\"font-size:13px\">DETAIL RIWAYAT</td>
            </tr>
			
			<tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">10</td>
            </tr>
			</thead>";
			$csql = "SELECT gol,nama FROM mrekap WHERE gol IS NOT NULL ";
                         
             $hasil = $this->db->query($csql);
             foreach ($hasil->result() as $row){
			 $gol	=$row->gol;
			 $nama	=$row->nama;
			$cRet .="<tr>
                <td bgcolor=\"#ADFF2F\" align=\"center\" width =\"10%\" style=\"font-size:14px\">$gol</td>
                <td bgcolor=\"#ADFF2F\" colspan=\"9\" align=\"left\" width =\"10%\" style=\"font-size:14px\">$nama</td>
			</tr>";
			if($gol=='01'){
			 $csqlx = "SELECT a.no_reg,a.tgl_oleh,a.kondisi,a.nilai,b.nm_skpd,
					a.keterangan,c.riwayat,a.`tgl_riwayat`,a.`detail_riwayat` FROM trkib_a a
					LEFT JOIN ms_skpd b ON b.`kd_skpd`=a.`kd_skpd`
					LEFT JOIN mriwayat c ON c.`kode`=a.`kd_riwayat`
					WHERE kd_riwayat IS NOT NULL order by a.kd_skpd"; //and a.kd_skpd='$skpd'
                         
             $hasilx = $this->db->query($csqlx);
			 $total=0;
             $i = 1;
             foreach ($hasilx->result() as $row){
			 $total= $total+$row->nilai;
					$cRet .="<tr>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$i</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->no_reg</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->tgl_oleh</td>
						<td align=\"center\" width =\"5%\" style=\"font-size:12px\">$row->kondisi</td>
						<td align=\"RIGHT\" width =\"10%\" style=\"font-size:12px\">$row->nilai</td>
						<td align=\"left\" width =\"20%\" style=\"font-size:12px\">$row->nm_skpd</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->keterangan</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->riwayat</td>
						<td align=\"CENTER\" width =\"10%\" style=\"font-size:12px\">$row->tgl_riwayat</td>
						<td align=\"LEFT\" width =\"10%\" style=\"font-size:12px\">$row->detail_riwayat</td>
					 </tr>";$i++;  
				}
            }
			if($gol=='02'){
			 $csqlx = "SELECT a.no_reg,a.tgl_oleh,a.kondisi,a.nilai,b.nm_skpd,
					a.keterangan,c.riwayat,a.`tgl_riwayat`,a.`detail_riwayat` FROM trkib_b a
					LEFT JOIN ms_skpd b ON b.`kd_skpd`=a.`kd_skpd`
					LEFT JOIN mriwayat c ON c.`kode`=a.`kd_riwayat`
					WHERE kd_riwayat IS NOT NULL order by a.kd_skpd"; //and a.kd_skpd='$skpd'
                         
             $hasilx = $this->db->query($csqlx);
			 $total=0;
             $i = 1;
             foreach ($hasilx->result() as $row){
			 $total= $total+$row->nilai;
					$cRet .="<tr>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$i</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->no_reg</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->tgl_oleh</td>
						<td align=\"center\" width =\"5%\" style=\"font-size:12px\">$row->kondisi</td>
						<td align=\"RIGHT\" width =\"10%\" style=\"font-size:12px\">$row->nilai</td>
						<td align=\"left\" width =\"20%\" style=\"font-size:12px\">$row->nm_skpd</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->keterangan</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->riwayat</td>
						<td align=\"CENTER\" width =\"10%\" style=\"font-size:12px\">$row->tgl_riwayat</td>
						<td align=\"LEFT\" width =\"10%\" style=\"font-size:12px\">$row->detail_riwayat</td>
					 </tr>";$i++;  
				}
            } 
			if($gol=='03'){
			 $csqlx = "SELECT a.no_reg,a.tgl_oleh,a.kondisi,a.nilai,b.nm_skpd,
					a.keterangan,c.riwayat,a.`tgl_riwayat`,a.`detail_riwayat` FROM trkib_c a
					LEFT JOIN ms_skpd b ON b.`kd_skpd`=a.`kd_skpd`
					LEFT JOIN mriwayat c ON c.`kode`=a.`kd_riwayat`
					WHERE kd_riwayat IS NOT NULL order by a.kd_skpd"; //and a.kd_skpd='$skpd'
                         
             $hasilx = $this->db->query($csqlx);
			 $total=0;
             $i = 1;
             foreach ($hasilx->result() as $row){
			 $total= $total+$row->nilai;
					$cRet .="<tr>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$i</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->no_reg</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->tgl_oleh</td>
						<td align=\"center\" width =\"5%\" style=\"font-size:12px\">$row->kondisi</td>
						<td align=\"RIGHT\" width =\"10%\" style=\"font-size:12px\">$row->nilai</td>
						<td align=\"left\" width =\"20%\" style=\"font-size:12px\">$row->nm_skpd</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->keterangan</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->riwayat</td>
						<td align=\"CENTER\" width =\"10%\" style=\"font-size:12px\">$row->tgl_riwayat</td>
						<td align=\"LEFT\" width =\"10%\" style=\"font-size:12px\">$row->detail_riwayat</td>
					 </tr>";$i++;  
				}
            } 
			if($gol=='04'){
			 $csqlx = "SELECT a.no_reg,a.tgl_oleh,a.kondisi,a.nilai,b.nm_skpd,
					a.keterangan,c.riwayat,a.`tgl_riwayat`,a.`detail_riwayat` FROM trkib_d a
					LEFT JOIN ms_skpd b ON b.`kd_skpd`=a.`kd_skpd`
					LEFT JOIN mriwayat c ON c.`kode`=a.`kd_riwayat`
					WHERE kd_riwayat IS NOT NULL order by a.kd_skpd"; //and a.kd_skpd='$skpd'
                         
             $hasilx = $this->db->query($csqlx);
			 $total=0;
             $i = 1;
             foreach ($hasilx->result() as $row){
			 $total= $total+$row->nilai;
					$cRet .="<tr>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$i</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->no_reg</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->tgl_oleh</td>
						<td align=\"center\" width =\"5%\" style=\"font-size:12px\">$row->kondisi</td>
						<td align=\"RIGHT\" width =\"10%\" style=\"font-size:12px\">$row->nilai</td>
						<td align=\"left\" width =\"20%\" style=\"font-size:12px\">$row->nm_skpd</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->keterangan</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->riwayat</td>
						<td align=\"CENTER\" width =\"10%\" style=\"font-size:12px\">$row->tgl_riwayat</td>
						<td align=\"LEFT\" width =\"10%\" style=\"font-size:12px\">$row->detail_riwayat</td>
					 </tr>";$i++;  
				}
            } 
			if($gol=='05'){
			 $csqlx = "SELECT a.no_reg,a.tgl_peroleh,a.kondisi,a.nilai,b.nm_skpd,
					a.keterangan,c.riwayat,a.`tgl_riwayat`,a.`detail_riwayat` FROM trkib_e a
					LEFT JOIN ms_skpd b ON b.`kd_skpd`=a.`kd_skpd`
					LEFT JOIN mriwayat c ON c.`kode`=a.`kd_riwayat`
					WHERE kd_riwayat IS NOT NULL order by a.kd_skpd"; //and a.kd_skpd='$skpd'
                         
             $hasilx = $this->db->query($csqlx);
			 $total=0;
             $i = 1;
             foreach ($hasilx->result() as $row){
			 $total= $total+$row->nilai;
					$cRet .="<tr>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$i</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->no_reg</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->tgl_peroleh</td>
						<td align=\"center\" width =\"5%\" style=\"font-size:12px\">$row->kondisi</td>
						<td align=\"RIGHT\" width =\"10%\" style=\"font-size:12px\">$row->nilai</td>
						<td align=\"left\" width =\"20%\" style=\"font-size:12px\">$row->nm_skpd</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->keterangan</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->riwayat</td>
						<td align=\"CENTER\" width =\"10%\" style=\"font-size:12px\">$row->tgl_riwayat</td>
						<td align=\"LEFT\" width =\"10%\" style=\"font-size:12px\">$row->detail_riwayat</td>
					 </tr>";$i++;  
				}
            } 
			if($gol=='06'){
			 $csqlx = "SELECT a.no_reg,a.tgl_oleh,a.kondisi,a.nilai,b.nm_skpd,
					a.keterangan,c.riwayat,a.`tgl_riwayat`,a.`detail_riwayat` FROM trkib_f a
					LEFT JOIN ms_skpd b ON b.`kd_skpd`=a.`kd_skpd`
					LEFT JOIN mriwayat c ON c.`kode`=a.`kd_riwayat`
					WHERE kd_riwayat IS NOT NULL order by a.kd_skpd"; //and a.kd_skpd='$skpd'
                         
             $hasilx = $this->db->query($csqlx);
			 $total=0;
             $i = 1;
             foreach ($hasilx->result() as $row){
			 $total= $total+$row->nilai;
					$cRet .="<tr>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$i</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->no_reg</td>
						<td align=\"center\" width =\"10%\" style=\"font-size:12px\">$row->tgl_oleh</td>
						<td align=\"center\" width =\"5%\" style=\"font-size:12px\">$row->kondisi</td>
						<td align=\"RIGHT\" width =\"10%\" style=\"font-size:12px\">$row->nilai</td>
						<td align=\"left\" width =\"20%\" style=\"font-size:12px\">$row->nm_skpd</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->keterangan</td>
						<td align=\"left\" width =\"10%\" style=\"font-size:12px\">$row->riwayat</td>
						<td align=\"CENTER\" width =\"10%\" style=\"font-size:12px\">$row->tgl_riwayat</td>
						<td align=\"LEFT\" width =\"10%\" style=\"font-size:12px\">$row->detail_riwayat</td>
					 </tr>";$i++;  
				}
            }        
			 
			}
	
				$cRet .="<tr>
                    <td colspan=\"4\" bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:11px\">TOTAL BIAYA</td>
                    <td colspan=\"6\" bgcolor=\"#ADFF2F\" align=\"left\" style=\"font-size:11px\">Rp. ".number_format("$total")."</td>
				</tr>";
			$cRet.="</table>";
		
     /*   $cRet .="<br/><table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Mengetahui,<br>KEPALA SKPD<br><br><br><br></td>
						<td width=\"50%\"align=\"center\" style=\"font-size:12px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
						&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
						&ensp;&ensp;&ensp;&ensp;&ensp;PENGURUS BARANG<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"><u>( $nm_tahu )</u></td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"><u>( $nm_bend )</u></td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_tahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nip. $nip_bend</td>					
					</tr>";
			$cRet .=" </table>"; */
        $data['prev']= $cRet;
        $this->template->set('title', 'KARTU PEMELIHARAAN BARANG');        
        //$this->_mpdf('',$cRet,10,10,10,1);
		echo $cRet;
         } 
	}
	
	
	/* CETAK LABEL */
	public function ctk_label()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
		$kib 		= $_REQUEST['kib'];
		$iz	 		= $_REQUEST['fa'];
		$tahun 		= $_REQUEST['tahun'];
        $logo 		= $konfig['logo'];
        //identitas yang mengetahuin / pengguna anggaran
     $where="";
	 if($cskpd<>''){
	 $where="where a.kd_skpd='$cskpd'";
	 }
	  $th="";
	 if($tahun<>''){
	 $th="and a.tahun='$tahun'";
	 }
	 $ckib="";
	 if($kib=='01'){
	 $ckib="trkib_a";
	 }if($kib=='02'){
	 $ckib="trkib_b";
	 }if($kib=='03'){
	 $ckib="trkib_c";
	 }if($kib=='04'){
	 $ckib="trkib_d";
	 }if($kib=='05'){
	 $ckib="trkib_e";
	 }if($kib=='06'){
	 $ckib="trkib_f";
	 }
	 
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"1\">";
			$csql = "SELECT CONCAT(a.milik,'.',a.wilayah,'.',LEFT(c.kd_uker,5),'.',RIGHT(a.tahun,2),'.',RIGHT(c.kd_lokasi,5)) AS id_barang,concat(a.kd_brg,'.',right(a.no_reg,4)) as no,b.nm_brg,a.detail_brg FROM $ckib a
			LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
			left join mlokasi c on a.kd_skpd=c.kd_skpd AND a.kd_unit=c.kd_lokasi
			$where $th";
		$tot	= $this->db->query($csql)->num_rows();

			 $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {  
				$i			= $i+1;
				$id_barang 	= $row->id_barang;
				$no 		= $row->no;
				$nm_brg 	= $row->nm_brg;
				$detail_brg = $row->detail_brg;
			if($i%2!=0){
				$cRet .="
                 <tr>
                    <td align=\"center\" >
					<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
						<tr>
							<td  width=\"20%\" rowspan=\"3\" align=\"center\" style=\"font-size:11px; border-bottom:solid 2px black; border-right:solid 2px black;border-top:solid 2px black;border-left:solid 2px black;\">
                            <img src=\"".FCPATH."/data/100.jpg\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
							<td align=\"center\" width=\"80%\" height=\"20%\" style=\"font-size:16px; border-bottom:solid 2px black; font-family: tahoma;border-top:solid 2px black; border-right:solid 2px black;\"><b>$id_barang</b></td>
						</tr>
						<tr>							
							<td align=\"center\" height=\"10%\" style=\"font-size:16px; border-bottom:solid 2px black;font-family: tahoma;border-right:solid 2px black;\"><b>$no</b></td>
						</tr>
						<tr>							
							<td align=\"center\" height=\"10%\" style=\"font-size:12px; border-bottom:solid 2px black;font-family: tahoma;border-right:solid 2px black;\"><b>$nm_brg/$detail_brg</b></td>
						</tr>
						<tr>							
							<td colspan=\"2\" align=\"center\" height=\"10%\" style=\"font-size:12px; font-family: tahoma; border-bottom:solid 2px black;border-right:solid 2px black;border-left:solid 2px black;\"><b>PEMERINTAH KABUPATEN BANTAENG</b></td>
						</tr>
					</table>
					</td><td border:none;>&nbsp;</td>
				";
			}else{
				$cRet .="
                     <td align=\"center\" >
					<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
						<tr>
							<td  width=\"20%\" rowspan=\"3\" align=\"center\" style=\"font-size:11px; border-bottom:solid 2px black; border-right:solid 2px black;border-top:solid 2px black;border-left:solid 2px black;\">
                            <img src=\"".FCPATH."/data/100.jpg\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
							<td align=\"center\" width=\"80%\" height=\"20%\" style=\"font-size:16px; border-bottom:solid 2px black; font-family: tahoma;border-top:solid 2px black; border-right:solid 2px black;\"><b>$id_barang</b></td>
						</tr>
						<tr>							
							<td align=\"center\" height=\"10%\" style=\"font-size:16px; border-bottom:solid 2px black;font-family: tahoma;border-right:solid 2px black;\"><b>$no</b></td>
						</tr>
						<tr>							
							<td align=\"center\" height=\"10%\" style=\"font-size:12px; border-bottom:solid 2px black;font-family: tahoma;border-right:solid 2px black;\"><b>$nm_brg/$detail_brg</b></td>
						</tr>
						<tr>							
							<td colspan=\"2\" align=\"center\" height=\"10%\" style=\"font-size:12px; font-family: tahoma; border-bottom:solid 2px black;border-right:solid 2px black;border-left:solid 2px black;\"><b>PEMERINTAH KABUPATEN BANTAENG</b></td>
						</tr>
					</table>
					</td>
			</tr>
			
			<tr><td height=\"80%\" border:none;></td></tr>";
				
			}
                //$i++;    
              
             }
		$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan Aset Lainnya';
        $this->template->set('title', 'Laporan Aset Lainnya');  
        switch($iz) {
        case 2;        
		$this->mdata->_mpdf3('',$cRet,3,3,3,3,$kertas,1);   
        break;
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
           $this->load->view('transaksi/excel', $data);
        break;
        }
         } 
	}
	/* END CETAK LABEL*/
	/*LAPORAN PENYUSUTAN*/
	
public function kibb()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$thn  = $this->session->userdata('ta_simbakda');
        $konfig   	= $this->ambil_config();
		$kota  	  	= strtoupper($konfig['kota']);
		$nm_client  = strtoupper($konfig['nm_client']);
        $iz 	  	= $_REQUEST['fa'];
        $kdbid 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lctgl 		= $_REQUEST['tgl'];
        $per1 		= $_REQUEST['per1'];
        $per2 		= $_REQUEST['per2'];
        $tahun 		= $_REQUEST['ctahun'];
        $tahun_ini	= $_REQUEST['tahun_ini'];
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
		
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>DAFTAR PENYUSUTAN ASET TETAP <br>PERALATAN DAN MESIN<br>Per TAHUN $tahun</b></td>
            </tr>
            
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b> $kdbid - $cnm_skpd </b></td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
        <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                <td colspan=\"5\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
			</tr>
			<tr>	
				<!--td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8=6 + 7</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9=5 - 8</td>
            </tr>
			</thead> ";
             
$csql ="SELECT a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,a.`nilai`,TRIM(c.umur) AS umur,
if(a.tahun='$tahun',0,($tahun-a.tahun)) AS th_lalu,$tahun AS th_ini,a.tahun,
(a.nilai/TRIM(c.umur)) AS penyusutan_pertahun,

IF(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
END)) AS tot_th_belum, 

IF(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
END)) AS nil_th_ini


FROM trkib_b a
LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
WHERE kd_barang<>'' 
AND kd_unit='$kdbid' AND tahun<='$tahun' and (a.nilai>=500000 or a.kd_riwayat='9') and a.kondisi<>'RB' ORDER BY a.kd_brg,a.tahun";            
             $hasil = $this->db->query($csql);
             $i = 0;
             $nilai = 0;
             $nilai2 = 0;
             $nilai3 = 0;
             $nilai4 = 0;
             $nilai5 = 0;
/* 			 , 

(CASE 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))=1 THEN a.nilai 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))<=0 THEN a.nilai 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))>1 THEN ((YEAR(CURDATE())-a.tahun-1)*(a.nilai/TRIM(c.umur)))
END) AS tot_th_ini,

(CASE 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))=1 THEN 0 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))<=0 THEN 0 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))>1 THEN (a.nilai-((YEAR(CURDATE())-a.tahun-1)*(a.nilai/TRIM(c.umur))))
END) AS tot_buku  */
			 
             foreach ($hasil->result() as $row){
			 $tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
			 $tot_buku = $row->nilai-$tot_th_ini;
			 
             $nilai 	= $nilai+$row->nilai;
             $nilai2 	= $nilai2+$row->tot_th_belum;
             $nilai3 	= $nilai3+$row->nil_th_ini;
             $nilai4 	= $nilai4+$tot_th_ini;
             $nilai5 	= $nilai5+$tot_buku;
             $i++;
			 $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai)."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->tot_th_belum)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nil_th_ini)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_th_ini)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku)."</td>
					</tr>";
			 }
			 	 $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#ADFF2F\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai)."</td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5)."</td>
					</tr>";
            $cRet.="</table>";
                
				
            $cRet .="
			<br>
			<br>

			<table style=\"border-collapse:collapse;\" width=\"40%\" align=\"right\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
                    <tr>
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($lctgl).",<br>KEPALA $cnm_skpd<br>&nbsp;<br>&nbsp;<br>
                        <u>$nm_tahu</u><br>Nip. $nip_tahu  
                        </td>
                    </tr>";
					//echo $cRet;</table>
			$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'CETAK PENYUSUTAN PERALATAN DAN MESIN'); 
        $judul  = 'CETAK PENYUSUTAN PERALATAN DAN MESIN';	     
		switch($iz) {
        case 1;
             echo $cRet;
        break;
        case 2;        
			 $this->mdata->_mpdf3('',$cRet,10,10,10,2,$kertas,3);      
             //$this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
        break;
		} 
         }
	}
	
public function kibc()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $konfig 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $iz 	  	= $_REQUEST['fa'];
        $kdbid 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lctgl 		= $_REQUEST['tgl'];
        $per1 		= $_REQUEST['per1'];
        $per2 		= $_REQUEST['per2'];
        $tahun 		= $_REQUEST['ctahun'];
        $tahun_ini	= $_REQUEST['tahun_ini'];
		$thn  = $this->session->userdata('ta_simbakda');
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
		
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>DAFTAR PENYUSUTAN ASET TETAP <br>GEDUNG DAN BANGUNAN<br>Per TAHUN $tahun</b></td>
            </tr>
            
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b> $kdbid - $cnm_skpd </b></td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
        <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                <td colspan=\"5\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
			</tr>
			<tr>	
				<!--td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8=6 + 7</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9=5 - 8</td>
            </tr>
			</thead> ";
             
                 $csql ="SELECT a.kd_brg AS kode,b.nm_brg,'' as merek,a.tahun,a.`nilai`,TRIM(c.umur) AS umur,
if(a.tahun='$tahun',0,($tahun-a.tahun)) AS th_lalu,$tahun AS th_ini,a.tahun,
(a.nilai/TRIM(c.umur)) AS penyusutan_pertahun,

IF(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
END)) AS tot_th_belum, 

IF(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
END)) AS nil_th_ini
 
FROM trkib_c a
LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
WHERE kd_barang<>'' 
AND kd_unit='$kdbid' AND tahun<='$tahun' and (a.nilai>=10000000 or a.kd_riwayat='9') and a.kondisi<>'RB' ORDER BY a.kd_brg,a.tahun";            /* , 

(CASE 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))=1 THEN a.nilai 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))<=0 THEN a.nilai 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))>1 THEN ((YEAR(CURDATE())-a.tahun-1)*(a.nilai/TRIM(c.umur)))
END) AS tot_th_ini,

(CASE 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))=1 THEN 0 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))<=0 THEN 0 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))>1 THEN (a.nilai-((YEAR(CURDATE())-a.tahun-1)*(a.nilai/TRIM(c.umur))))
END) AS tot_buku  */
             $hasil = $this->db->query($csql);
             $i = 0;
             $nilai = 0;
             $nilai2 = 0;
             $nilai3 = 0;
             $nilai4 = 0;
             $nilai5 = 0;
             foreach ($hasil->result() as $row){
			 $tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
			 $tot_buku = $row->nilai-$tot_th_ini;
             $nilai 	= $nilai+$row->nilai;
             $nilai2 	= $nilai2+$row->tot_th_belum;
             $nilai3 	= $nilai3+$row->nil_th_ini;
             $nilai4 	= $nilai4+$tot_th_ini;
             $nilai5 	= $nilai5+$tot_buku;
             $i++;
			 $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai)."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->tot_th_belum)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nil_th_ini)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_th_ini)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku)."</td>
					</tr>";
			 }
			 	 $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#ADFF2F\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai)."</td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5)."</td>
					</tr>";
					
            $cRet.="</table>";
                
				
            $cRet .="
			<br>
			<br>

			<table style=\"border-collapse:collapse;\" width=\"40%\" align=\"right\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($lctgl).",<br>KEPALA $cnm_skpd<br>&nbsp;<br>&nbsp;<br>
                        <u>$nm_tahu</u><br>Nip. $nip_tahu  
                        </td>
                    </tr>";
					//echo $cRet;</table>
				$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'CETAK PENYUSUTAN GEDUNG DAN BANGUNAN'); 
        $judul  = 'CETAK PENYUSUTAN GEDUNG DAN BANGUNAN';	     
		switch($iz) {
        case 1;
             echo $cRet;
        break;
        case 2;        
			 $this->mdata->_mpdf3('',$cRet,10,10,10,2,$kertas,3);      
             //$this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
        break;
		} 
         }
	}

public function kibd()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $konfig   	= $this->ambil_config();
		$kota  	  	= strtoupper($konfig['kota']);
		$nm_client  = strtoupper($konfig['nm_client']);
        $iz 	  	= $_REQUEST['fa'];
        $kdbid 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lctgl 		= $_REQUEST['tgl'];
        $per1 		= $_REQUEST['per1'];
        $per2 		= $_REQUEST['per2'];
        $tahun_ini	= $_REQUEST['tahun_ini'];
        $tahun 		= $_REQUEST['ctahun'];
		$thn  = $this->session->userdata('ta_simbakda');
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
		
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>DAFTAR PENYUSUTAN ASET TETAP <br>JALAN, IRIGASI, DAN JARINGAN<br>Per TAHUN $tahun</b></td>
            </tr>
            
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b> $kdbid - $cnm_skpd </b></td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
        <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                <td colspan=\"5\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
			</tr>
			<tr>	
				<!--td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8=6 + 7</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9=5 - 8</td>
            </tr>
			</thead> ";
             
              $csql ="SELECT a.kd_brg AS kode,b.nm_brg,'' as merek,a.tahun,a.`nilai`,TRIM(c.umur) AS umur,
if(a.tahun='$tahun',0,($tahun-a.tahun)) AS th_lalu,$tahun AS th_ini,a.tahun,
(a.nilai/TRIM(c.umur)) AS penyusutan_pertahun,

IF(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
END)) AS tot_th_belum, 

IF(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
END)) AS nil_th_ini

 
FROM trkib_d a
LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
WHERE kd_barang<>'' 
AND kd_unit='$kdbid' and (a.nilai>=10000000 or a.kd_riwayat='9') and a.kondisi<>'RB'
AND tahun<='$tahun' ORDER BY a.kd_brg,a.tahun";            /* , 

(CASE 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))=1 THEN a.nilai 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))<=0 THEN a.nilai 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))>1 THEN ((YEAR(CURDATE())-a.tahun-1)*(a.nilai/TRIM(c.umur)))
END) AS tot_th_ini,

(CASE 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))=1 THEN 0 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))<=0 THEN 0 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))>1 THEN (a.nilai-((YEAR(CURDATE())-a.tahun-1)*(a.nilai/TRIM(c.umur))))
END) AS tot_buku  */
             $hasil = $this->db->query($csql);
             $i = 0;
             $nilai = 0;
             $nilai2 = 0;
             $nilai3 = 0;
             $nilai4 = 0;
             $nilai5 = 0;
             foreach ($hasil->result() as $row){
			 $tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
			 $tot_buku = $row->nilai-$tot_th_ini;
			 
             $nilai 	= $nilai+$row->nilai;
             $nilai2 	= $nilai2+$row->tot_th_belum;
             $nilai3 	= $nilai3+$row->nil_th_ini;
             $nilai4 	= $nilai4+$tot_th_ini;
             $nilai5 	= $nilai5+$tot_buku;
             $i++;
			 $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai)."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->tot_th_belum)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nil_th_ini)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_th_ini)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku)."</td>
					</tr>";
			 }
			 	 $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#ADFF2F\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai)."</td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5)."</td>
					</tr>";
            $cRet.="</table>";
                
				
            $cRet .="
			<br>
			<br>

			<table style=\"border-collapse:collapse;\" width=\"40%\" align=\"right\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($lctgl).",<br>KEPALA $cnm_skpd<br>&nbsp;<br>&nbsp;<br>
                        <u>$nm_tahu</u><br>Nip. $nip_tahu  
                        </td>
                    </tr>";
					//echo $cRet;</table>
				$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'CETAK PENYUSUTAN JALAN DAN IRIGASI'); 
        $judul  = 'CETAK PENYUSUTAN JALAN DAN IRIGASI';	     
		switch($iz) {
        case 1;
             echo $cRet;
        break;
        case 2;        
			 $this->mdata->_mpdf3('',$cRet,10,10,10,2,$kertas,3);      
             //$this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
        break;
		} 
         }
	}
	
	public function kibe()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $konfig   	= $this->ambil_config();
		$kota  	  	= strtoupper($konfig['kota']);
		$nm_client	= strtoupper($konfig['nm_client']);
        $iz 	  	= $_REQUEST['fa'];
        $kdbid 	  	= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu   	= $_REQUEST['tahu'];
        $lctgl    	= $_REQUEST['tgl'];
        $per1 		= $_REQUEST['per1'];
        $per2 		= $_REQUEST['per2'];
        $tahun_ini	= $_REQUEST['tahun_ini'];
        $tahun 		= $_REQUEST['ctahun'];
		$thn  = $this->session->userdata('ta_simbakda');
        if($lctahu==''){
            $nm_tahu = '';
            $nip_tahu = '';
            $pkt_tahu = '';
            $jbt_tahu ='';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lctahu'";
        
        $rs = $this->db->query($csql1);
        $trh1 = $rs->row();
        $nm_tahu = $trh1->nama;
        $nip_tahu = $trh1->nip;
        $pkt_tahu = $trh1->nm_pangkat;
        $jbt_tahu = $trh1->jabatan;
        }
		
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>DAFTAR PENYUSUTAN ASET TETAP <br>ASET TETAP LAINNYA<br>Per TAHUN $tahun</b></td>
            </tr>
            
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b> $kdbid - $cnm_skpd </b></td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
        <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                <td colspan=\"5\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
			</tr>
			<tr>	
				<!--td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8=6 + 7</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">9=5 - 8</td>
            </tr>
			</thead> ";
             
                 $csql ="SELECT a.kd_brg AS kode,b.nm_brg,'' as merek,a.tahun,a.`nilai`,TRIM(c.umur) AS umur,
if(a.tahun='$tahun',0,($tahun-a.tahun)) AS th_lalu,YEAR(CURDATE()) AS th_ini,a.tahun,
(a.nilai/TRIM(c.umur)) AS penyusutan_pertahun,

IF(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
END)) AS tot_th_belum, 

IF(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
END)) AS nil_th_ini
 
FROM trkib_e a
LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
WHERE kd_barang<>'' 
AND kd_unit='$kdbid' AND tahun<='$tahun' and (a.nilai>=500000 or a.kd_riwayat='9') and a.kondisi<>'RB' ORDER BY a.kd_brg,a.tahun";            /* , 

(CASE 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))=1 THEN a.nilai 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))<=0 THEN a.nilai 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))>1 THEN ((YEAR(CURDATE())-a.tahun-1)*(a.nilai/TRIM(c.umur)))
END) AS tot_th_ini,

(CASE 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))=1 THEN 0 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))<=0 THEN 0 
WHEN (TRIM(c.umur)-(YEAR(CURDATE())-a.tahun-1))>1 THEN (a.nilai-((YEAR(CURDATE())-a.tahun-1)*(a.nilai/TRIM(c.umur))))
END) AS tot_buku 
 */
             $hasil = $this->db->query($csql);
             $i = 0;
             $nilai = 0;
             $nilai2 = 0;
             $nilai3 = 0;
             $nilai4 = 0;
             $nilai5 = 0;
             foreach ($hasil->result() as $row){
			 $tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
			 $tot_buku = $row->nilai-$tot_th_ini;
             $nilai 	= $nilai+$row->nilai;
             $nilai2 	= $nilai2+$row->tot_th_belum;
             $nilai3 	= $nilai3+$row->nil_th_ini;
             $nilai4 	= $nilai4+$tot_th_ini;
             $nilai5 	= $nilai5+$tot_buku;
             $i++;
			 $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai)."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->tot_th_belum)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nil_th_ini)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_th_ini)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku)."</td>
					</tr>";
			 }
			 	 $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#ADFF2F\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai)."</td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4)."</td>
					<td bgcolor=\"#ADFF2F\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5)."</td>
					</tr>";
            $cRet.="</table>";
                
				
            $cRet .="
			<br>
			<br>

			<table style=\"border-collapse:collapse;\" width=\"40%\" align=\"right\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($lctgl).",<br>KEPALA $cnm_skpd<br>&nbsp;<br>&nbsp;<br>
                        <u>$nm_tahu</u><br>Nip. $nip_tahu  
                        </td>
                    </tr>";
					//echo $cRet;</table>
				$cRet .=" </table>";
     $data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'CETAK PENYUSUTAN ASET TETAP LAINNYA'); 
        $judul  = 'CETAK PENYUSUTAN ASET TETAP LAINNYA';	     
		switch($iz) {
        case 1;
             echo $cRet;
        break;
        case 2;        
			 $this->mdata->_mpdf3('',$cRet,10,10,10,2,$kertas,3);      
             //$this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
        break;
		} 
         }
	}

	/*END LAPORAN KEBIJAKAN AKUTANSI*/
	
	
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

    function _mpdf($judul='',$isi='',$lMargin='',$rMargin='',$font='',$orientasi='') {
        
        ini_set("memory_limit","-1");
        $this->load->library('mpdf');
        
        /*
        $this->mpdf->progbar_altHTML = '<html><body>
	                                    <div style="margin-top: 5em; text-align: center; font-family: Verdana; font-size: 12px;"><img style="vertical-align: middle" src="'.base_url().'images/loading.gif" /> Creating PDF file. Please wait...</div>';        
        $this->mpdf->StartProgressBarOutput();
        */
        
        $this->mpdf->defaultheaderfontsize = 6;	/* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 0; 	/* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 6;	/* in pts */
        $this->mpdf->defaultfooterfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 0; 
        //$this->mpdf->_setPageSize('','');
        //$this->mpdf->SetHeader('simbakda||');
        //$jam = date("H:i:s");
        //$this->mpdf->SetFooter('Page {PAGENO} ');
        $this->mpdf->SetFooter('Printed Simbakda on @ {DATE j-m-Y H:i:s} || Page {PAGENO} of {nb}');
		$halo = $this->mpdf->SetFooter('Printed Simbakda on @ {DATE j-m-Y H:i:s} || Page {PAGENO} of {nb}');
        //$this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Halaman {PAGENO} / {nb}| ');
        //fifi
        $this->mpdf->AddPage($orientasi);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output();
               
    }

        //$this->_mpdfa('',$cRet,80,90,90,1);
    function _mpdfa($judul='',$isi='',$lMargin=0,$rMargin=0,$font='',$orientasi=0) {
        
        ini_set("memory_limit","-1");
        $this->load->library('mpdf');
        $this->mpdf->defaultheaderfontsize = 6;	/* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 0; 	/* 1 to include line below header/above footer */
        $this->mpdf->defaultfooterfontsize = 6;	/* in pts */
        $this->mpdf->defaultfooterfontstyle = I;	/* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 0; 
        $this->mpdf->AddPage($orientasi);
        $this->mpdf->SetFooter('Page {PAGENO} ');
        //$this->mpdf->_setPageSize($kertas,$orientasi);
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output();
               
    }

function _mpdf3($judul='',$isi='',$lMargin='',$rMargin='',$font=0,$orientasi='P',$kertas='',$tmargin='') {
        
        ini_set("memory_limit","-1");
        $this->load->library('mpdf');
        
        
        $this->mpdf->defaultheaderfontsize = 6;	/* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 0; 	/* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 6;	/* in pts */
        $this->mpdf->defaultfooterfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 0; 
        $this->mpdf->SetLeftMargin = $lMargin;
        $this->mpdf->SetRightMargin = $rMargin;
        $this->mpdf->SetTopMargin($tmargin);
        $this->mpdf->SetFont = $font;
        $this->mpdf->_setPageSize($kertas,$orientasi);
		$jam = date("H:i:s");
      //  $this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Halaman {PAGENO} / {nb}| ');
        $this->mpdf->SetFooter('Page {PAGENO} ');
        
        $this->mpdf->AddPage($orientasi,'','','','',$lMargin,$rMargin);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);             
        $this->mpdf->Output();
               
    }	
	 
}
?>