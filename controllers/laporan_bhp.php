<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_bhp extends CI_Controller {
        
	public function __construct() {
		parent::__construct();
	}
	public function index($data) {
    	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
         	$this->template->set('title','.::SIMBAKDA::.');
         	$this->template->load('index',$data['tabel'],$data['isi']);		
		}	
	}	
    function  tanggal_indonesia($tgl)
    {
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this->getBulan($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2].' '.$bulan.' '.$tahun;
        
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
                         'logo2' => $resulte['logo2']                                                                         					
                         );
        }
	   
       $query1->free_result(); 
	   return $resulte;        	
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
  function cetak_lap_masuk()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN BARANG MASUK HABIS PAKAI';
        $this->template->set('title', 'CETAK LAPORAN BARANG MASUK HABIS PAKAI');   
        $this->template->load('index','bhp/lap_masuk_bhp_dh',$data) ;
        } 
    }	
	
  function cetak_bhp_buku_masuk()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN BUKU BARANG MASUK HABIS PAKAI';
        $this->template->set('title', 'CETAK BUKU LAPORAN BARANG MASUK HABIS PAKAI');   
        $this->template->load('index','bhp/lap_masuk_buku_bhp',$data) ;
        } 
    }
	
  function cetak_lap_keluar()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN BARANG KELUAR HABIS PAKAI';
        $this->template->set('title', 'CETAK LAPORAN BARANG KELUAR HABIS PAKAI');   
        $this->template->load('index','bhp/lap_keluar_bhp_dh',$data) ;
        } 
    }
  function cetak_bhp_buku_keluar()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK BUKU LAPORAN BARANG KELUAR HABIS PAKAI';
        $this->template->set('title', 'CETAK BUKU LAPORAN BARANG KELUAR HABIS PAKAI');   
        $this->template->load('index','bhp/lap_keluar_buku_bhp',$data) ;
        } 
    }
	
	function cetak_kartu_bhp()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN KARTU BARANG HABIS PAKAI';
        $this->template->set('title', 'CETAK LAPORAN KARTU BARANG HABIS PAKAI');   
        $this->template->load('index','bhp/lap_kartu_bhp',$data) ;
        } 
    }
	
	function cetak_bbph()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN BUKU BARANG PAKAI HABIS';
        $this->template->set('title', 'CETAK LAPORAN BUKU BARANG PAKAI HABIS');   
        $this->template->load('index','bhp/lap_bbph',$data);
        } 
    }
	function cetak_kartu_persediaan()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK KARTU PERSEDIAAN BARANG';
        $data['page_title']= 'CETAK KARTU PERSEDIAAN BARANG';
        $this->template->set('title', 'CETAK KARTU PERSEDIAAN BARANG');   
        $this->template->load('index','bhp/lap_kpb',$data);
        } 
    }
	
/* LAPORAN BHP START*/

function lap_masukbhp_dh(){
       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['nm_client']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
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
        $jenis       = $_REQUEST['jenis'];
        if($pilctk=='1' || $pilctk=='2'){
            $bulan      = $_REQUEST['bulan'];
            $tahun      = $_REQUEST['tahun'];
            $bul        = $this->getBulan($bulan); 
            $dcetak=$tahun."-".$bulan."-".'01';
            $last=date('Y-m-t',strtotime($dcetak));
        }else{        
            $tahun1     = $_REQUEST['tahun1'];
            $tahun2     = $_REQUEST['tahun2'];
        }
        
        
        $tglcetak   = $this->tanggal_indonesia($_REQUEST['tglcetak']);
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENERIMAAN BARANG HABIS PAKAI (BHP)<br>TAHUN ANGGARAN $thn</B></td>
            </tr><BR/><BR/><BR/></table>";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"10%\" >&ensp;&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $skpd  $nmskpd</B></td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"15%\" >&ensp;&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $bidang  $nmbid</B></td>
            </tr>";}
          $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KOTA</td>
                <td align=\"left\" style=\"font-size:13px;\">: $kota</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $bul  $tahun </td>
            </tr>";
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">No</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">No. Dokumen/Faktur</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Detail Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Merk/Tipe Ukuran</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Jumlah Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Satuan</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Harga Satuan<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Jumlah Biaya<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">1</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">2</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">3</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">4</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">5</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">6</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">7</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">8</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">9</td>
            </tr>
            </thead>
                ";
                $giat='';
                if($jenis!=''){
                    $giat="AND a.kodegiat='$jenis'";
                }
                $where='';
                if($pilctk=='1' || $pilctk=='3'){
                    $where="c.skpd = '$skpd'";
                }else{
                    $where="c.skpd = '$skpd' AND c.unit='$bidang'";
                }
                $where2='';
                if($pilctk=='1' || $pilctk=='2'){
                    $where2="AND c.tgl_dokumen<='$last'";
                }else{
                    $where2="AND YEAR(c.tgl_dokumen) BETWEEN '$tahun1' AND '$tahun2'";
                }
                $csql = "SELECT a.detail_brg,a.no_dokumen,a.merk,SUM(a.jumlah) AS jumlah,a.harga,
                        a.satuan,SUM(a.total) AS total,a.keterangan
                        FROM trd_masuk_bhp a 
                        LEFT JOIN trh_masuk_bhp c ON a.no_dokumen = c.no_dokumen AND c.unit=a.unit AND c.skpd=a.skpd 
                        WHERE $where $giat $where2 
                        GROUP BY a.kode_brg,a.harga,a.no_dokumen ORDER BY c.tgl_dokumen,a.no_dokumen";
               
             $hasil = $this->db->query($csql);
             $i = 1;
             $all=0;
             foreach ($hasil->result() as $row)
             {
                $all = $row->total+$all;
                $cRet .="
                 <tr>
                    <td align=\"center\" width=\"5%\" style=\"font-size:12px\">$i</td>
                    <td align=\"left\" width=\"20%\" style=\"font-size:12px\">$row->no_dokumen</td>
                    <td align=\"left\" width=\"20%\" style=\"font-size:12px\">$row->detail_brg</td>
                    <td align=\"center\" width=\"15%\" style=\"font-size:12px\">$row->merk</td>
                    <td align=\"center\" width=\"5%\" style=\"font-size:12px\">$row->jumlah</td>
                    <td align=\"center\" width=\"10%\" style=\"font-size:12px\">$row->satuan</td>
                    <td align=\"right\" width=\"10%\" style=\"font-size:12px\">".number_format($row->harga,2,',','.')."</td>
                    <td align=\"right\" width=\"10%\" style=\"font-size:12px\">".number_format($row->total,2,',','.')."</td>
                    <td align=\"left\" width=\"15%\" style=\"font-size:12px\">$row->keterangan</td>
                </tr>";
              $i++; 
             }
            
                
               $cRet .="  <tr>
                <td bgcolor=\"#f2fece\" colspan=\"7\" align=\"center\" style=\"font-size:12px\">Jumlah</td>
                <td bgcolor=\"#f2fece\" align=\"right\" style=\"font-size:12px\">".number_format($all,2,',','.')."</td>
                <td bgcolor=\"#f2fece\" align=\"center\" style=\"font-size:12px\"></td>
                </tr>";
                
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
        $this->template->set('title', 'Laporan BHP Masuk'); 
        $judul  = 'Laporan BHP Masuk';
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);  
        switch($pilih) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul - $skpd $test.xls");
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
	function lap_masukbhp()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $thn	  = $this->session->userdata('ta_simbakda');
        $konfig   = $this->ambil_config();
		$kota  	  			= strtoupper($konfig['kota']);
		$nm_client  	  	= strtoupper($konfig['nm_client']);
        $cskpd    = $_REQUEST['kd_skpd'];
        $cnm_skpd = $_REQUEST['nm_skpd'];
        $giat     = $_REQUEST['giat'];
        $nmgiat	  = $_REQUEST['nmgiat'];
        $lctahu   = $_REQUEST['tahu'];
        $lcbend   = $_REQUEST['bend'];
        $lctgl    = $_REQUEST['tgl'];
        $lctgl2   = $_REQUEST['tgl2'];
        $cetak    = $_REQUEST['cetak'];
		$iz	 	  = $_REQUEST['fa'];
		$kegiatan="";
		if($giat<>''){
			$kegiatan="and a.kodegiat='$giat'";
		}
        
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
        }
        
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
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
           <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px;\">:<b> $cskpd - $cnm_skpd</b></td>
            </tr>"; 
		if($nmgiat<>''){
		$cRet .= "
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kegiatan</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b>$giat-$nmgiat</b></td>
            </tr>";	}
            $cRet .= "<tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
			<tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px;\"><b>DAFTAR PENERIMAAN BARANG HABIS PAKAI (BHP)<br>TAHUN ANGGARAN $thn<br>PERIODE: $lctgl S/D $lctgl2</b></td>
            </tr>
            
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">No</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">No. Dokumen/Faktur</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Detail Barang</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Merk/Tipe Ukuran</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Jumlah Barang</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Satuan</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Harga Satuan<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Jumlah Biaya<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:12px\">1</td>
                <td align=\"center\" style=\"font-size:12px\">2</td>
                <td align=\"center\" style=\"font-size:12px\">3</td>
                <td align=\"center\" style=\"font-size:12px\">4</td>
                <td align=\"center\" style=\"font-size:12px\">5</td>
                <td align=\"center\" style=\"font-size:12px\">6</td>
                <td align=\"center\" style=\"font-size:12px\">7</td>
                <td align=\"center\" style=\"font-size:12px\">8</td>
                <td align=\"center\" style=\"font-size:12px\">9</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"20%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"20%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"25%\" style=\"font-size:12px\"></td>
            </tr>";
        $csql = 
		"SELECT a.detail_brg,a.no_dokumen,a.merk,sum(a.jumlah) as jumlah,a.harga,
		a.total,a.satuan,sum(a.total) as total,a.keterangan
		FROM trd_masuk_bhp a 
		LEFT JOIN trh_masuk_bhp c ON a.no_dokumen = c.no_dokumen and c.unit=a.unit and c.skpd=a.skpd 
		WHERE  c.skpd = '$cskpd' $kegiatan 
		and c.tgl_dokumen between '$lctgl' AND '$lctgl2' 
		group by a.kode_brg,a.harga,a.no_dokumen order by c.tgl_dokumen,a.no_dokumen";
               
             $hasil = $this->db->query($csql);
             $i = 1;
			 $all=0;
             foreach ($hasil->result() as $row)
             {
				$all = $row->total+$all;
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:12px\">$i</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->no_dokumen</td>
                    <td align=\"left\" style=\"font-size:12px\">$row->detail_brg</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->merk</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->satuan</td>
                    <td align=\"right\" style=\"font-size:12px\">".number_format($row->harga)."</td>
                    <td align=\"right\" style=\"font-size:12px\">".number_format($row->total)."</td>
                    <td align=\"left\" style=\"font-size:12px\">$row->keterangan</td>
                </tr>";
              $i++; 
             }
            
				
               $cRet .="  <tr>
				<td bgcolor=\"#f2fece\" colspan=\"6\" align=\"center\" style=\"font-size:12px\">Jumlah</td>
                <td bgcolor=\"#f2fece\" align=\"right\" style=\"font-size:12px\">".number_format($all)."</td>
				<td bgcolor=\"#f2fece\" colspan=\"2\" align=\"center\" style=\"font-size:12px\"></td>
				</tr>
           <tr>
                        <td height=\"40\" colspan =\"9\" align=\"center\" style=\"font-size:12px;border: solid 1px white;border-top:solid 1px black;\">&nbsp;</td>
                        </td>
            </tr>                    
                    <tr>
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Mengetahui,<br>$jbt_tahu<br>&nbsp;<br>&nbsp;<br>
                        <u>$nm_tahu</u><br>$nip_tahu                        
                        </td>
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($cetak).",<br>$jbt_bend<br>&nbsp;<br>&nbsp;<br>
                        <u>$nm_bend</u><br>$nip_bend  
                        </td>
                    </tr>";
			$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'Laporan BHP Masuk'); 
        $judul  = 'Laporan BHP Masuk';
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

    function lap_keluarbhp_dh(){
       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['nm_client']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
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
        $jenis       = $_REQUEST['jenis'];
        if($pilctk=='1' || $pilctk=='2'){
            $bulan      = $_REQUEST['bulan'];
            $tahun      = $_REQUEST['tahun'];
            $bul        = $this->getBulan($bulan); 
            $dcetak=$tahun."-".$bulan."-".'01';
            $last=date('Y-m-t',strtotime($dcetak));
        }else{        
            $tahun1     = $_REQUEST['tahun1'];
            $tahun2     = $_REQUEST['tahun2'];
        }
        
        
        $tglcetak   = $this->tanggal_indonesia($_REQUEST['tglcetak']);
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENERIMAAN BARANG HABIS PAKAI (BHP)<br>TAHUN ANGGARAN $thn</B></td>
            </tr><BR/><BR/><BR/></table>";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"10%\" >&ensp;&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $skpd  $nmskpd</B></td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"15%\" >&ensp;&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $bidang  $nmbid</B></td>
            </tr>";}
          $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KOTA</td>
                <td align=\"left\" style=\"font-size:13px;\">: $kota</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $bul  $tahun </td>
            </tr>";
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">No</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">No. Dokumen Pengeluaran</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Detail Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Merk/Tipe Ukuran</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Jumlah Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Harga Satuan<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Jumlah Biaya<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">Penerima Barang</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">1</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">2</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">3</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">4</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">5</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">6</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">7</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">8</td>
            </tr>
            </thead>
                ";
                $giat='';
                if($jenis!=''){
                    $giat="AND a.kodegiat='$jenis'";
                }
                $where='';
                if($pilctk=='1' || $pilctk=='3'){
                    $where="b.skpd = '$skpd'";
                }else{
                    $where="b.skpd = '$skpd' AND b.unit='$bidang'";
                }
                $where2='';
                if($pilctk=='1' || $pilctk=='2'){
                    $where2="AND b.tgl_keluar<='$last'";
                }else{
                    $where2="AND YEAR(b.tgl_keluar) BETWEEN '$tahun1' AND '$tahun2'";
                }
                $csql = "SELECT a.no_dokumen,a.detail_brg,a.merk,a.jumlahbrg,a.harga,a.totjumlah,b.penerima 
                        FROM trd_keluar_bhp a INNER JOIN trh_keluar_bhp b ON b.no_dokumen=a.no_dokumen AND b.skpd=a.skpd AND b.unit=b.unit 
                        WHERE $where $giat $where2 
                        GROUP BY a.kd_brg,a.harga,a.no_dokumen ORDER BY b.tgl_keluar,a.no_dokumen";
               
             $hasil = $this->db->query($csql);
             $i = 1;
             $afandi =0;
             foreach ($hasil->result() as $row)
             {
                $tot = $row->jumlahbrg * $row->harga;
                $afandi = $afandi+$row->totjumlah;
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:12px\">$i</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->no_dokumen</td>
                    <td align=\"left\" style=\"font-size:12px\">$row->detail_brg</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->merk</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->jumlahbrg</td>
                    <td align=\"right\" style=\"font-size:12px\">".number_format($row->harga)."</td>
                    <td align=\"right\" style=\"font-size:12px\">".number_format($row->totjumlah)."</td>
                    <td align=\"left\" style=\"font-size:12px\">$row->penerima</td>
                </tr>";
              $i++; 
             }
             
                $cRet .="
                <tr>
                <td bgcolor=\"#f2fece\" colspan=\"6\" align=\"center\" style=\"font-size:12px\">Jumlah</td>
                <td bgcolor=\"#f2fece\" align=\"right\" style=\"font-size:12px\">".number_format($afandi)."</td>
                <td bgcolor=\"#f2fece\" align=\"center\" style=\"font-size:12px\"></td>
                </tr>";
                
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
        $this->template->set('title', 'Laporan BHP Masuk'); 
        $judul  = 'Laporan BHP Masuk'; 
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd); 
        switch($pilih) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul - $skpd $test.xls");
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
	
	function lap_keluarbhp()
		{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $konfig   = $this->ambil_config();
		$kota  	  			= strtoupper($konfig['kota']);
		$nm_client  	  	= strtoupper($konfig['nm_client']);
        $cskpd    = $_REQUEST['kd_skpd'];
        $giat     = $_REQUEST['giat'];
        $nmgiat	  = $_REQUEST['nmgiat'];
        $cnm_skpd = $_REQUEST['nm_skpd'];
        $lctahu   = $_REQUEST['tahu'];
        $lcbend   = $_REQUEST['bend'];
        $lctgl    = $_REQUEST['tgl'];
        $lctgl2   = $_REQUEST['tgl2'];
        $cetak    = $_REQUEST['cetak'];
		$iz	 	  = $_REQUEST['fa'];
		$kegiatan="";
		if($giat<>''){
			$kegiatan="and a.kodegiat='$giat'";
		}
        
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
        }
        
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
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
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
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b> $cskpd - $cnm_skpd</b></td>
            </tr>";
		if($nmgiat<>''){
		$cRet .= "
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kegiatan</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b>$giat-$nmgiat</b></td>
            </tr>";	}
        $cRet .= "<tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
			<tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>DAFTAR PENGELUARAN BARANG HABIS PAKAI (BHP)<br>TAHUN ANGGARAN 2015<br>PERIODE: $lctgl S/D $lctgl2</b></td>
            </tr>
            
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">No</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">No. Dokumen Pengeluaran</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Detail Barang</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Merk/Tipe Ukuran</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Jumlah Barang</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Harga Satuan<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Jumlah Biaya<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Penerima Barang</td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:12px\">1</td>
                <td align=\"center\" style=\"font-size:12px\">2</td>
                <td align=\"center\" style=\"font-size:12px\">3</td>
                <td align=\"center\" style=\"font-size:12px\">4</td>
                <td align=\"center\" style=\"font-size:12px\">5</td>
                <td align=\"center\" style=\"font-size:12px\">6</td>
                <td align=\"center\" style=\"font-size:12px\">7</td>
                <td align=\"center\" style=\"font-size:12px\">8</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"30%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"18%\" style=\"font-size:12px\"></td>
            </tr>";
        $csql = 
		"SELECT a.no_dokumen,a.detail_brg,a.merk,a.jumlahbrg,a.harga,a.totjumlah,b.penerima 
		FROM trd_keluar_bhp a
		INNER JOIN trh_keluar_bhp b ON b.no_dokumen=a.no_dokumen AND b.skpd=a.skpd AND b.unit=b.unit WHERE b.skpd='$cskpd' $kegiatan  
		AND b.tgl_keluar BETWEEN '$lctgl' AND '$lctgl2' group by a.kd_brg,a.harga,
		a.no_dokumen ORDER BY b.tgl_keluar,a.no_dokumen";
               
             $hasil = $this->db->query($csql);
             $i = 1;
			 $afandi =0;
             foreach ($hasil->result() as $row)
             {
                $tot = $row->jumlahbrg * $row->harga;
				$afandi = $afandi+$row->totjumlah;
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:12px\">$i</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->no_dokumen</td>
                    <td align=\"left\" style=\"font-size:12px\">$row->detail_brg</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->merk</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->jumlahbrg</td>
                    <td align=\"right\" style=\"font-size:12px\">".number_format($row->harga)."</td>
                    <td align=\"right\" style=\"font-size:12px\">".number_format($row->totjumlah)."</td>
                    <td align=\"left\" style=\"font-size:12px\">$row->penerima</td>
                </tr>";
              $i++; 
             }
			 
				$cRet .="
                <tr>
				<td bgcolor=\"#f2fece\" colspan=\"6\" align=\"center\" style=\"font-size:12px\">Jumlah</td>
                <td bgcolor=\"#f2fece\" align=\"right\" style=\"font-size:12px\">".number_format($afandi)."</td>
				<td bgcolor=\"#f2fece\" align=\"center\" style=\"font-size:12px\"></td>
				</tr>
            <tr>
                        <td height=\"40\" colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;border-top:solid 1px black;\">&nbsp;</td>
                        </td>
            </tr>                    
                    <tr>
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Mengetahui,<br>$jbt_tahu<br>&nbsp;<br>&nbsp;<br>
                        (<u>$nm_tahu</u>)<br>$nip_tahu                        
                        </td>
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($cetak).",<br>$jbt_bend<br>&nbsp;<br>&nbsp;<br>
                        (<u>$nm_bend</u>)<br>$nip_bend  
                        </td>
                    </tr>";
			$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'Laporan BHP Keluar'); 
        $judul  = 'Laporan BHP Keluar';
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
	
	function lap_buku_masukbhp()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $thn	  = $this->session->userdata('ta_simbakda');
        $konfig   = $this->ambil_config();
		$kota  	  			= strtoupper($konfig['kota']);
		$nm_client  	  	= strtoupper($konfig['nm_client']);
        $cskpd    = $_REQUEST['kd_skpd'];
        $cnm_skpd = $_REQUEST['nm_skpd'];
        $giat     = $_REQUEST['giat'];
        $nmgiat	  = $_REQUEST['nmgiat'];
        $lctahu   = $_REQUEST['tahu'];
        $lcbend   = $_REQUEST['bend'];
        $lctgl    = $_REQUEST['tgl'];
        $tgl_satu = $_REQUEST['tgl_satu'];
        $tgl_dua  = $_REQUEST['tgl_dua'];
		$iz	 	  = $_REQUEST['fa'];
		$periode  =	"";
		if($tgl_satu<>'' && $tgl_dua<>''){
		$periode  =	"and a.tgl_dokumen between '$tgl_satu' AND '$tgl_dua'";
		}
		$kegiatan="";
		if($giat<>''){
			$kegiatan="and b.kodegiat='$giat'";
		}
        $where    = "";
		if($cskpd<>''){
		$where="where a.skpd='$cskpd'";	
		}
        
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
        }
        
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
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
			<tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px;\"><b>BUKU PENERIMAAN BARANG</b></td>
            </tr>
			";
		if( $tgl_satu<>'' && $tgl_dua<>'' ){
			$cRet .= "<tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>PERIODE: $tgl_satu S/D $tgl_dua</b></td>
            </tr>";
			}
		if($nmgiat<>''){
		$cRet .= "
            <tr>
                <td  width =\"1%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kegiatan</td>
                <td  width =\"20%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b>&ensp;$giat - $nmgiat</b></td>
            </tr>";	}
        $cRet .= "<br/>
            
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"3\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">No</td>
                <td rowspan=\"3\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Tanggal</td>
                <td rowspan=\"3\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Dari</td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Dokumen Faktur</td>
                <td rowspan=\"3\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Nama Barang</td>
                <td rowspan=\"3\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Banyaknya</td>
                <td rowspan=\"3\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Harga Satuan</td>
                <td rowspan=\"3\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Jumlah Harga</td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Bukti Penerimaan</td>
                <td rowspan=\"3\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Keterangan</td>
			</tr>
			<tr>
			    <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Tanggal</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Nomor</td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">B.A Penerimaan</td>
			</tr>
			<tr>
			    <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Nomor</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:13px\">Tanggal</td>
			</tr>
            <tr>
                <td align=\"center\" style=\"font-size:12px\">1</td>
                <td align=\"center\" style=\"font-size:12px\">2</td>
                <td align=\"center\" style=\"font-size:12px\">3</td>
                <td align=\"center\" style=\"font-size:12px\">4</td>
                <td align=\"center\" style=\"font-size:12px\">5</td>
                <td align=\"center\" style=\"font-size:12px\">6</td>
                <td align=\"center\" style=\"font-size:12px\">7</td>
                <td align=\"center\" style=\"font-size:12px\">8</td>
                <td align=\"center\" style=\"font-size:12px\">9</td>
                <td align=\"center\" style=\"font-size:12px\">10</td>
                <td align=\"center\" style=\"font-size:12px\">11</td>
                <td align=\"center\" style=\"font-size:12px\">12</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"7%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"7%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"7%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"20%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"7%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"7%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"25%\" style=\"font-size:12px\"></td>
            </tr>";
        $csql = 
		"SELECT a.no_dokumen,a.tgl_dokumen,a.nm_perush,b.detail_brg,
		b.jumlah,b.harga,b.total,a.no_terima,a.tgl_terima,b.keterangan FROM trh_masuk_bhp a 
		LEFT JOIN trd_masuk_bhp b ON b.no_dokumen=a.no_dokumen AND b.skpd=a.skpd AND b.unit=a.unit
		$where $kegiatan ORDER BY a.tgl_dokumen,a.no_dokumen";
               
             $hasil = $this->db->query($csql);
             $i = 1;
			 $all=0;
             foreach ($hasil->result() as $row)
             {
				$all = $row->total+$all;
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:14px\">$i</td>
                    <td align=\"center\" style=\"font-size:14px\">$row->tgl_dokumen</td>
                    <td align=\"left\" style=\"font-size:14px\">$row->nm_perush</td>
                    <td align=\"center\" style=\"font-size:14px\">$row->tgl_dokumen</td>
                    <td align=\"center\" style=\"font-size:14px\">$row->no_dokumen</td>
                    <td align=\"left\" style=\"font-size:14px\">$row->detail_brg</td>
                    <td align=\"center\" style=\"font-size:14px\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:14px\">".number_format($row->harga)."</td>
                    <td align=\"right\" style=\"font-size:14px\">".number_format($row->total)."</td>
                    <td align=\"center\" style=\"font-size:14px\">$row->no_terima</td>
                    <td align=\"center\" style=\"font-size:14px\">$row->tgl_terima</td>
                    <td align=\"left\" style=\"font-size:14px\">$row->keterangan</td>
                </tr>";
              $i++; 
             }
            
				
               $cRet .="  <tr>
				<td bgcolor=\"#f2fece\" colspan=\"8\" align=\"center\" style=\"font-size:12px\">Jumlah</td>
                <td bgcolor=\"#f2fece\" align=\"right\" style=\"font-size:12px\">".number_format($all)."</td>
				<td bgcolor=\"#f2fece\" colspan=\"3\" align=\"center\" style=\"font-size:12px\"></td>
				</tr>
           <tr>
                        <td height=\"40\" colspan =\"12\" align=\"center\" style=\"font-size:12px;border: solid 1px white;border-top:solid 1px black;\">&nbsp;</td>
                        </td>
            </tr>                    
                    <tr>
                        <td colspan =\"6\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Mengetahui,<br>$jbt_tahu<br>&nbsp;<br>&nbsp;<br>
                        <u>$nm_tahu</u><br>$nip_tahu                        
                        </td>
                        <td colspan =\"6\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($lctgl).",<br>$jbt_bend<br>&nbsp;<br>&nbsp;<br>
                        <u>$nm_bend</u><br>$nip_bend  
                        </td>
                    </tr>";
			$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'Laporan BHP Masuk'); 
        $judul  = 'Laporan BHP Masuk';
	     switch($iz) {
        case 1;
             echo $cRet;
        break;
        case 2;        
             $this->_mpdf('',$cRet,10,10,10,'1');
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
	
	function lap_buku_keluarbhp()
		{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $konfig   = $this->ambil_config();
		$kota  	  = strtoupper($konfig['kota']);
		$nm_client= strtoupper($konfig['nm_client']);
        $cskpd    = $_REQUEST['kd_skpd'];
        $cnm_skpd = $_REQUEST['nm_skpd'];
        $giat     = $_REQUEST['giat'];
        $nmgiat	  = $_REQUEST['nmgiat'];
        $lctahu   = $_REQUEST['tahu'];
        $lcbend   = $_REQUEST['bend'];
        $tgl_satu = $_REQUEST['tgl_satu'];
        $tgl_dua  = $_REQUEST['tgl_dua'];
        $lctgl    = $_REQUEST['tgl'];
		$iz	 	  = $_REQUEST['fa'];
		$periode  =	"";
		if($tgl_satu<>'' && $tgl_dua<>''){
		$periode  =	"and a.tgl_dokumen between '$tgl_satu' AND '$tgl_dua'";
		}
		$kegiatan =	"";
		if($giat<>''){
			$kegiatan="and b.kodegiat='$giat'";
		}
		$where	  = "";
		if($cskpd<>''){
		$where="where a.skpd='$cskpd'";	
		}
        
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
        }
        
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
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<br/>
			<tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>BUKU PENGELUARAN BARANG</b></td>
            </tr>";
		if( $tgl_satu<>'' && $tgl_dua<>'' ){
			$cRet .= "<tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>PERIODE: $tgl_satu S/D $tgl_dua</b></td>
            </tr>";
			}	
		if($nmgiat<>''){
		$cRet .= "
            <tr>
                <td  width =\"1%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kegiatan</td>
                <td  width =\"20%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b>&ensp;$giat - $nmgiat</b></td>
            </tr>";	}
        $cRet .= "
            
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">No</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Tanggal</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Nomor Urut</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Nama Barang</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Banyaknya</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Harga Satuan<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Jumlah Harga<br>(Rp)</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Untuk</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Tanggal Penyerahan</td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:12px\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:12px\">1</td>
                <td align=\"center\" style=\"font-size:12px\">2</td>
                <td align=\"center\" style=\"font-size:12px\">3</td>
                <td align=\"center\" style=\"font-size:12px\">4</td>
                <td align=\"center\" style=\"font-size:12px\">5</td>
                <td align=\"center\" style=\"font-size:12px\">6</td>
                <td align=\"center\" style=\"font-size:12px\">7</td>
                <td align=\"center\" style=\"font-size:12px\">8</td>
                <td align=\"center\" style=\"font-size:12px\">9</td>
                <td align=\"center\" style=\"font-size:12px\">10</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"20%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"18%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:12px\"></td>
                <td align=\"center\" width =\"20%\" style=\"font-size:12px\"></td>
            </tr>";
        $csql = 
		"SELECT a.tgl_keluar,a.no_dokumen,b.detail_brg,b.jumlahbrg,b.harga,b.totjumlah,b.peruntukan,b.keterangan
		FROM trh_keluar_bhp a LEFT JOIN
		trd_keluar_bhp b ON b.no_dokumen=a.no_dokumen AND b.`skpd`=a.skpd AND b.unit=a.unit
		$where $kegiatan $periode group by b.kd_brg,b.harga,a.no_dokumen ORDER BY a.tgl_keluar,a.no_dokumen";
               
             $hasil = $this->db->query($csql);
             $i = 1;
			 $afandi =0;
             foreach ($hasil->result() as $row)
             {
				$afandi = $afandi+$row->totjumlah;
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:12px\">$i</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->tgl_keluar</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->no_dokumen</td>
                    <td align=\"left\" style=\"font-size:12px\">$row->detail_brg</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->jumlahbrg</td>
                    <td align=\"right\" style=\"font-size:12px\">".number_format($row->harga)."</td>
                    <td align=\"right\" style=\"font-size:12px\">".number_format($row->totjumlah)."</td>
                    <td align=\"left\" style=\"font-size:12px\">$row->peruntukan</td>
                    <td align=\"center\" style=\"font-size:12px\">$row->tgl_keluar</td>
                    <td align=\"left\" style=\"font-size:12px\">$row->keterangan</td>
                </tr>";
              $i++; 
             }
			 
				$cRet .="
                <tr>
				<td bgcolor=\"#f2fece\" colspan=\"6\" align=\"center\" style=\"font-size:12px\">Jumlah</td>
                <td bgcolor=\"#f2fece\" align=\"right\" style=\"font-size:12px\">".number_format($afandi)."</td>
				<td colspan=\"3\" bgcolor=\"#f2fece\" align=\"center\" style=\"font-size:12px\"></td>
				</tr>
            <tr>
                        <td height=\"40\" colspan =\"10\" align=\"center\" style=\"font-size:12px;border: solid 1px white;border-top:solid 1px black;\">&nbsp;</td>
                        </td>
            </tr>                    
                    <tr>
                        <td colspan =\"5\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Mengetahui,<br>$jbt_tahu<br>&nbsp;<br>&nbsp;<br>
                        (<u>$nm_tahu</u>)<br>$nip_tahu                        
                        </td>
                        <td colspan =\"5\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($lctgl).",<br>$jbt_bend<br>&nbsp;<br>&nbsp;<br>
                        (<u>$nm_bend</u>)<br>$nip_bend  
                        </td>
                    </tr>";
			$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'Laporan BHP Keluar'); 
        $judul  = 'Laporan BHP Keluar';
	     switch($iz) {
        case 1;
             echo $cRet;
        break;
        case 2;        
             $this->_mpdf('',$cRet,10,10,10,'1');
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
	
	public function lap_kartubhp()
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
        $giat     	= $_REQUEST['giat'];
        $nmgiat	  	= $_REQUEST['nmgiat'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
        $tgl_satu 	= $_REQUEST['tgl_satu'];
        $tgl_dua  	= $_REQUEST['tgl_dua'];
		$iz	 		= $_REQUEST['fa'];
		$periode  =	"";
		if($tgl_satu<>'' && $tgl_dua<>''){
		$periode  =	"and tgl_masuk >='$tgl_satu' AND tgl_keluar<='$tgl_dua'";
		}
		$kegiatan="";
		if($giat<>''){
			$kegiatan="and kodegiat='$giat'";
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
        
        // identitas penyimpan
        
        if($lcbend==''){
            $nm_penyi = '';
            $nip_penyi = '';
            $pkt_penyi = '';
            $jbt_penyi = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs 	  = $this->db->query($csql1);
        $trh2 	  = $rs->row();
        $nm_penyi  = $trh2->nama;
        $nip_penyi = $trh2->nip;
        $pkt_penyi = $trh2->nm_pangkat;
        $jbt_penyi = $trh2->jabatan;
        }
        
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"8\" style=\"font-size:14px; font-family:tahoma;\">PERSEDIAAN BARANG HABIS PAKAI</td>
            </tr>";
            
		if( $tgl_satu<>'' && $tgl_dua<>'' ){
			$cRet .= "<tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>PERIODE: $tgl_satu S/D $tgl_dua</b></td>
            </tr>";
			}
            $cRet .= "

            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
		";
		if($nmgiat<>''){
		$cRet .= "
            <tr>
                <td  width =\"1%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kegiatan</td>
                <td  width =\"20%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b>&ensp;$giat - $nmgiat</b></td>
            </tr>";	}
        $cRet .= "
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>			
            <tr>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">NO</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">JENIS PERSEDIAAN BARANG PAKAI HABIS</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">SISA PERSEDIAAN BHP s/d ".$this->tanggal_indonesia($lctgl)."</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">SATUAN</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">HARGA SATUAN</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">JUMLAH</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">KETERANGAN</td>
            </tr>
			<tr>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:8px; font-family:tahoma;\">1</td>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:8px; font-family:tahoma;\">2</td>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:8px; font-family:tahoma;\">3</td>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:8px; font-family:tahoma;\">4</td>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:8px; font-family:tahoma;\">5</td>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:8px; font-family:tahoma;\">6</td>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:8px; font-family:tahoma;\">7</td>
            </tr>
            <tr>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
			</thead>";
             $csql = "SELECT detail_brg,SUM(jml_masuk) AS masuk,SUM(jml_keluar) AS keluar,
					  satuan_brg AS satuan,harga,keterangan 
					  FROM thistory_bhp WHERE skpd='$cskpd' $kegiatan $periode 
					  GROUP BY kode_brg,harga ORDER BY kode_brg";
                         
             $hasil = $this->db->query($csql);
             $i   = 0;
             $tot = 0;
             foreach ($hasil->result() as $row)
             {
                $sisa 	= $row->masuk - $row->keluar;
                $total 	= $sisa * $row->harga;
                $tot 	= $tot + $total;
                $i++;    
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$row->detail_brg</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$sisa</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->satuan</td>
                    <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->harga)."</td>
                    <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($total)."</td>
                    <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";
              
             }
			$cRet .="
                 <tr>
                    <td bgcolor=\"#FFD700\" colspan=\"5\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#FFD700\" align=\"right\" style=\"font-size:10px; font-family:tahoma;\">Rp. ".number_format($tot)."</td>
                    <td bgcolor=\"#FFD700\" align=\"right\" style=\"font-size:10px; font-family:tahoma;\"></td>
                </tr>
			</table>";
            $cRet .="
			<br>
			<br>

				<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        <td colspan =\"3\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>ATASAN LANGSUNG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_tahu )</u><br>NIP. $nip_tahu  
                        </td>
						<td></td>
						<td colspan =\"3\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($lctgl)."<br>PENYIMPAN BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_penyi )</u><br>NIP. $nip_penyi  
                        </td>
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'PERSEDIAAN BHP'); 
        $judul  = 'PERSEDIAAN BHP';
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
	
	function lap_bbph()
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
        $giat       = $_REQUEST['giat'];
        $nmgiat	    = $_REQUEST['nmgiat'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
        $tgl_satu   = $_REQUEST['tgl_satu'];
        $tgl_dua    = $_REQUEST['tgl_dua'];
		$iz	 		= $_REQUEST['fa'];
		$periode  =	"";
		if($tgl_satu<>'' && $tgl_dua<>''){
		$periode  =	"and tgl_masuk >='$tgl_satu' AND tgl_keluar<='$tgl_dua'";
		}
		$kegiatan="";
		if($giat<>''){
			$kegiatan="and kodegiat='$giat'";
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
        
        // identitas penyimpan
        
        if($lcbend==''){
            $nm_penyi = '';
            $nip_penyi = '';
            $pkt_penyi = '';
            $jbt_penyi = '';
        }else{
        $csql1 = "SELECT a.*, b.nm_pangkat FROM ttd a LEFT JOIN mpangkat b 
                  ON a.kd_pangkat = b.kd_pangkat WHERE nip='$lcbend'";
        
        $rs 	  = $this->db->query($csql1);
        $trh2 	  = $rs->row();
        $nm_penyi  = $trh2->nama;
        $nip_penyi = $trh2->nip;
        $pkt_penyi = $trh2->nm_pangkat;
        $jbt_penyi = $trh2->jabatan;
        }
        
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"6\" style=\"font-size:14px; font-family:tahoma;\">LAPORAN REKAPITULASI BARANG HABIS PAKAI</td>
            </tr>";
            
		if( $tgl_satu<>'' && $tgl_dua<>'' ){
			$cRet .= "<tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>PERIODE: $tgl_satu S/D $tgl_dua</b></td>
            </tr>";
			}
            $cRet .= "<tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cnm_skpd</td>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
		if($nmgiat<>''){
		$cRet .= "
            <tr>
                <td  width =\"1%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kegiatan</td>
                <td  width =\"20%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b>&ensp;$giat - $nmgiat</b></td>
            </tr>";	}
        $cRet .= "
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">NO</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Nama Barang</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Harga Satuan</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Masuk</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Keluar</td>
                <td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Sisa</td>
				<td bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">Jumlah Biaya<br/>(Rp)</td>
            </tr>
			<tr>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6=4 - 5</td>
				<td bgcolor=\"#FFD700\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7=3 * 6</td>
            </tr>
            <tr>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
			</thead>";
             $csql = "SELECT detail_brg,harga,SUM(jml_masuk) AS masuk_ini,
						SUM(jml_keluar) AS keluar_ini,SUM(sisa) AS sisa,SUM(total) AS jml_biaya FROM thistory_bhp
						WHERE skpd='$cskpd' $kegiatan $periode GROUP BY kode_brg,harga ORDER BY kode_brg";
                         
             $hasil = $this->db->query($csql);
             $i   = 0;
             $tot = 0;
             foreach ($hasil->result() as $row)
             {
				$nm			= $row->detail_brg;
				$masuk_ini	= $row->masuk_ini;
				$keluar_ini	= $row->keluar_ini;
				$sisa		= $masuk_ini-$keluar_ini;//$row->sisa;
				$jml		= $sisa*$row->harga;//$row->jml_biaya;
                $tot 		= $tot + $jml;
                $i++;    
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$nm</td>
                    <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->harga)."</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$masuk_ini</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$keluar_ini</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$sisa</td>
                    <td align=\"right\" style=\"font-size:10px; font-family:tahoma;\">".number_format($jml)."</td>
                    
                </tr>";
              
             }
			$cRet .="
                 <tr>
                    <td bgcolor=\"#FFD700\" colspan=\"6\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#FFD700\" align=\"right\" style=\"font-size:10px; font-family:tahoma;\">Rp. ".number_format($tot)."</td>
                    
                </tr>
			</table>";
            $cRet .="
			<br>
			<br>

				<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        <td colspan =\"3\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>ATASAN LANGSUNG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_tahu )</u><br>NIP. $nip_tahu  
                        </td>
						<td colspan =\"3\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($lctgl)."<br>PENYIMPAN BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_penyi )</u><br>NIP. $nip_penyi  
                        </td>
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'REKAPITULASI BHP'); 
        $judul  = 'REKAPITULASI BHP';	     
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
	
function lap_kpb()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
        $konfig 		= $this->ambil_config();
		$kota  			= strtoupper($konfig['kota']);
		$prov  			= strtoupper($konfig['nm_client']);
		$thn  			= $this->session->userdata('ta_simbakda');
		$kd_brg 		= $_REQUEST['brg'];
		$nm_brg 		= $_REQUEST['nm'];
		$cskpd 			= $_REQUEST['kd_skpd'];
        $cnm_skpd 		= $_REQUEST['nm_skpd'];
        $giat     		= $_REQUEST['giat'];
        $nmgiat	  		= $_REQUEST['nmgiat'];
        $lctahu 		= $_REQUEST['tahu'];
        $lcbend 		= $_REQUEST['bend'];
        $lctgl 			= $_REQUEST['tgl'];
        $tgl_satu 		= $_REQUEST['tgl_satu'];
        $tgl_dua  		= $_REQUEST['tgl_dua'];
        $satuan 		= $_REQUEST['satuan'];
        $spek 			= $_REQUEST['spek'];
		$iz	 			= $_REQUEST['fa'];
		$periode  =	"";
		if($tgl_satu<>'' && $tgl_dua<>''){
		$periode  =	"and tgl_masuk >='$tgl_satu' AND tgl_keluar<='$tgl_dua'";
		}
		$kegiatan="";
		if($giat<>''){
			$kegiatan="and kodegiat='$giat'";
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
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $cskpd-$cnm_skpd </td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $prov</td>
            </tr>
		";
		if($nmgiat<>''){
		$cRet .= "
            <tr>
                <td  width =\"1%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kegiatan</td>
                <td  width =\"20%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b>&ensp;$giat - $nmgiat</b></td>
            </tr>";	}
        $cRet .= "
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td colspan=\"6\" align=\"center\" style=\"font-size:14px; font-family:tahoma;\">KARTU BARANG HABIS PAKAI</td>
            </tr>
            ";
            
		if( $tgl_satu<>'' && $tgl_dua<>'' ){
			$cRet .= "<tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>PERIODE: $tgl_satu S/D $tgl_dua</b></td>
            </tr>";
			}
            $cRet .= "
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Nama Barang</td>
                <td colspan=\"3\" width =\"70%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kd_brg/ $nm_brg</td>
            </tr>
            <tr>
                <td width =\"20%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Spesifikasi</td>
                <td colspan=\"3\" width =\"70%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $spek</td>
            </tr>
            <tr>
                <td width =\"20%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Satuan</td>
                <td colspan=\"3\" width =\"70%\"align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $satuan</td>
            </tr>
            
            </table>
			<br />
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
			<tr>
                <td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">NO</td>
                <td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">TANGGL</td>
                <td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">MASUK</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">KELUAR</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">SISA</td>
				<td  bgcolor=\"#ADFF2F\" align=\"center\"  style=\"font-size:12px\">KETERANGAN</td>
            </tr>
			<tr>
                <td align=\"center\" style=\"font-size:8px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:8px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:8px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:8px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:8px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:8px; font-family:tahoma;\">6</td>
            </tr>
            <tr>
                <td bgcolor=\"#FEBFEF\" align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td bgcolor=\"#FEBFEF\" align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td bgcolor=\"#FEBFEF\" align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td bgcolor=\"#FEBFEF\" align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td bgcolor=\"#FEBFEF\" align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td bgcolor=\"#FEBFEF\" align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
			</thead>";
					$csql = "SELECT tgl_gabung,jml_masuk,jml_keluar,sisa,keterangan
							 FROM thistory_bhp WHERE skpd='$cskpd' $kegiatan $periode
							 AND kode_brg='$kd_brg' ORDER BY date_time";//group by kode_brg 
                         
             $hasil = $this->db->query($csql);
             $i = 0;
				 $tot_masuk=0;
				 $tot_keluar=0;
				 $tot_sisa=0;
             foreach ($hasil->result() as $row)
             {
				 $tot_masuk=$tot_masuk+$row->jml_masuk;
				 $tot_keluar=$tot_keluar+$row->jml_keluar;
				 $tot_sisa=$tot_masuk-$tot_keluar;
                $i++;    
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->tgl_gabung</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->jml_masuk</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->jml_keluar</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$row->sisa</td>
                    <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$row->keterangan</td>
                    
                </tr>";
              
             }
			 
			    $cRet .="
                 <tr>
                    <td bgcolor=\"#ADFF2F\" colspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">TOTAL BARANG</td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$tot_masuk</td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$tot_keluar</td>
                    <td bgcolor=\"#ADFF2F\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$tot_sisa</td>
                    <td bgcolor=\"#ADFF2F\" align=\"left\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    
                </tr>";
                $cRet .="
                 <tr>
                    <td bgcolor=\"#FEBFEF\" colspan=\"6\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                </tr>
				</table>";
				
            $cRet .="
			<br>
			<br>

					<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        <td colspan =\"3\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>ATASAN LANGSUNG<br>&nbsp;<br>&nbsp;<br>
                        (<u> $nm_tahu </u>)<br>NIP. $nip_tahu  
                        </td>
						
						<td colspan =\"3\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($lctgl)."<br>PENYIMPAN BARANG<br>&nbsp;<br>&nbsp;<br>
                        (<u> $nm_bend </u>)<br>NIP. $nip_bend  
                        </td>
                    </tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'KARTU BARANG'); 
        $judul  = 'KARTU BHP';
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
	/* LAPORAN BHP END*/
	
}