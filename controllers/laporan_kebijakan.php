<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_kebijakan extends CI_Controller {
        
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

    function  tanggal_format_indonesia($tgl){
            
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this-> getBulan($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2].' '.$bulan.' '.$tahun;

    }

    

	function penyusutan_kibb()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK DAFTAR PENYUSUTAN KIB B';
        $this->template->set('title', 'DAFTAR PENYUSUTAN KIB B');   
        $this->template->load('index','kebijakan/kibb_dh',$data) ;
        } 
    }

    function kibb_dh(){       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
        $pilih      = $_REQUEST['pilih'];
        $tampil     = $_REQUEST['tampil'];
        $pilctk     = $_REQUEST['pilctk'];
        $blnthn     = $_REQUEST['blnthn'];
        if($blnthn=='01'){
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun'];
            $dcetak=$tahun."-".$bulan."-".'31';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));
        }else if($blnthn=='02'){
            $tahun1  = $_REQUEST['tahun1'];
            $tahun   = $_REQUEST['tahun2'];
            
        }else{
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun3'];
            $dcetak=$tahun."-".$bulan."-".'31';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));
        }
        
        
        if($pilctk=='1'){
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
        }else{
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
            $bidang     = $_REQUEST['bidang'];
            $nmbid      = $_REQUEST['nmbid'];
        }
            
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
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          if($blnthn=='01' || $blnthn=='03'){
            $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>PERALATAN DAN MESIN<br>Per BULAN $periodbulan $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
          }else{
              $cRet .="
                
                <tr>
                    <td></td>
                    <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>PERALATAN DAN MESIN<br>Per TAHUN $tahun</B></td>
                </tr><BR/><BR/><BR/></table>";
            }
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"10%\" >&ensp;&ensp;OPD</td>
                <td align=\"left\" style=\"font-size:13px;\">: $skpd  $nmskpd</td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"15%\" >&ensp;&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:13px;\">: $bidang  $nmbid</td>
            </tr>";}
          $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:13px;\">: $nmkab</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            if($blnthn=='01' || $blnthn=='03'){
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $periodbulan $tahun </td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:&ensp;$tahun1 s.d $tahun </td>
            </tr>";
            }
            
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";

        if($blnthn=='01' || $blnthn=='03'){
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Ini</b></td>
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
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
            }else{
                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\" width =\"5%\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
                </tr>
                <tr>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\" width =\"5%\">1</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
            }
        
                
                $where='';
                if($pilctk=='1' || $pilctk=='3'){
                    $where="a.kd_skpd = '$skpd'";
                }else{
                    $where="a.kd_skpd = '$skpd' AND a.kd_unit='$bidang'";
                }
                 $nilai = 0;
                 $nilai2 = 0;
                 $nilai3 = 0;
                 $nilai4 = 0;
                 $nilai5 = 0;
            if($blnthn=='01'){
                //demansyah
                $csql = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                        (CASE WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(((a.nilai/TRIM(a.masa_manfaat*12))*MONTH(a.tgl_oleh)) AS DECIMAL (18,2)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN TRUNCATE(CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,9)),2)
                        END) AS lalu_pelihara,

                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)
                        AS bulan_lalu,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))
                        AS bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))>-12 
                        THEN TRUNCATE(CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,2)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))<=-12 
                        THEN 0
                        END) AS nil_bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END) AS akum_penyusutan_bulan,

                        (CASE
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap<'$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))
                        END)
                        AS akum_tot_bln_belum

                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE kd_barang<>'' AND tgl_oleh<='$last' AND $where 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
                {
                $cbln = $row->bln;
                $cbulan_lalu = $row->bulan_lalu;
                $cakum_penyusutan_bulan = $row->akum_penyusutan_bulan;
                $clalu_pelihara = $row->lalu_pelihara;

                    if($row->bulan_lalu>=$row->bln)
                    { 
                        $bln_lalu = $clalu_pelihara + ($cakum_penyusutan_bulan*($cbulan_lalu - $cbln));
                        $bln_ini =$row->akum_penyusutan_bulan + $bln_lalu;
                        $penyusutan_bulan = $row->akum_penyusutan_bulan;
                    }else{   
                        $bln_lalu= $row->tot_bln_belum;                 
                        $bln_ini = $row->nil_bulan_ini;                        
                        $penyusutan_bulan = $row->penyusutan_bulan;
                    }

                     $tot_buku  = $row->nilai-$bln_ini;
                     $bln       = strtoupper($this->getBulan($row->bln));
                     $nilai     = $nilai+$row->nilai;
                     $nilai2    = $nilai2+$bln_ini;
                     $nilai3    = $nilai3+$row->penyusutan_bulan;
                     $nilai4    = $nilai4+$bln_ini;
                     $nilai5    = $nilai5+$tot_buku;
                     $i++;
                     $cRet .="
                     <tr>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                        <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                        <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                        <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row->tahun</td>
                        <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur_bulan</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->bulan_lalu</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                        </tr>";
                }
            }else if($blnthn=='02'){

                $csql="SELECT a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),0)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                        WHERE $where AND YEAR(a.tgl_oleh) BETWEEN '$tahun1' AND '$tahun' 
                        AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')order by a.kd_brg,a.tahun,a.no_reg ";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                
             if($row->masa_manfaat_baru<>null){
                $susut_per_tahun = $row->ada3_susut_per_thn;
                $susut_thn_lalu = $row->ada2_akm_thn_lalu;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                $umur = $row->masa_manfaat_baru;
                $nb = $row->nilai - $susut_thn_ini;
            }else{
                $susut_per_tahun = $row->penyusutan_pertahun;
                $susut_thn_lalu = $row->tot_th_belum;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                $umur = $row->umur;
                $nb = $row->nilai - $susut_thn_ini;
            }
                
             
                
             
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$susut_thn_lalu;
             $nilai3    = $nilai3+$susut_per_tahun;
             $nilai4    = $nilai4+$susut_thn_ini;
             $nilai5    = $nilai5+$nb;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_per_tahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nb,2,',','.')."</td>
                    </tr>";
             }
            }else if($blnthn=='03')
            {
                        $csql="SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),0)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                        WHERE $where AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015' 
                        AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')order by a.kd_brg,a.tahun,a.no_reg ";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row2)
             {
                
             if($row2->masa_manfaat_baru<>null){
                $susut_per_tahun = $row2->ada3_susut_per_thn;
                $susut_thn_lalu = $row2->ada2_akm_thn_lalu;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                $umur = $row2->masa_manfaat_baru*12;
                $nb = $row2->nilai - $susut_thn_ini;
                $th_lalu = $row2->th_lalu*12;
            }else{
                $susut_per_tahun = $row2->penyusutan_pertahun;
                $susut_thn_lalu = $row2->tot_th_belum;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                $umur = $row2->umur*12;
                $th_lalu = $row2->th_lalu*12;
                $nb = $row2->nilai - $susut_thn_ini;
            }
                
             
                
             $bln       = strtoupper($this->getBulan($row2->bln));
             $nilai     = $nilai+$row2->nilai;
             $nilai2    = $nilai2+$susut_thn_lalu;
             $nilai3    = $nilai3+$susut_per_tahun;
             $nilai4    = $nilai4+$susut_thn_ini;
             $nilai5    = $nilai5+$nb;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row2->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row2->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row2->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_per_tahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nb,2,',','.')."</td>
                    </tr>";
             }
                //}
                //Awal Tahun berjalan
                $csql_ini="SELECT a.id_barang,a.kd_brg AS kode,
                    IF(a.tahun='$tahun',1,('$tahun'-a.tahun+1)) AS th_lalu,                    
                    IF(a.tahun='$tahun',0,(CASE 
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))>1 THEN CAST(('$tahun'-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN a.nilai
                    END)) AS tot_th_belum, 
                    (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang))-('$tahun'-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN 0 END)
                    AS penyusutan_pertahun
                    FROM trkib_b a
                    LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                    LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                    WHERE $where 
                    AND a.tgl_oleh BETWEEN '2016-01-01' AND '$last'
                    AND IF('$last'>='2016-01-01',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')ORDER BY a.kd_brg,a.tahun,a.no_reg";
       
             $hasil_ini = $this->db->query($csql_ini);
             foreach ($hasil_ini->result() as $row)
                {                
                    $cid_barang_b = $row->id_barang;
                    $cth_lalu_b = $row->th_lalu * 12;                
                    $susut_per_tahun_b = $row->penyusutan_pertahun;
                    $susut_thn_lalu_b = $row->tot_th_belum;
                    $susut_thn_ini_b = $susut_thn_lalu_b+$susut_per_tahun_b;
             
                    $sql_ini = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap BETWEEN '2016-01-01' AND '$last' GROUP BY id_barang),
                        (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))
                        ,0)AS umur_bulan_baru,

                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                        (SELECT (('$tahun'-YEAR(a.tgl_oleh))*12) - (MONTH(a.tgl_oleh)-'$bulan')+1) AS pake1, 

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2016')*12))
                        AS bulan_lalu,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12))>=0 
                        THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-'2016')*12))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan

                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                        WHERE a.tgl_oleh BETWEEN '2016-01-01' AND '$last' AND $where and a.id_barang='$cid_barang_b'
                        AND IF('$last'>='2016-01-01',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
                       
                     $hasil2_ini = $this->db->query($sql_ini);                     
                     
                    foreach ($hasil2_ini->result() as $row2)
                        {
                            $cpaket_b = $row2->pake;
                            if ($cpaket_b == NULL){
                            $cpake_b = $row2->pake1;
                            }else{
                            $cpake_b = $row2->pake;
                            }

                            $cbulan_pake_ini_b = $row2->bulan_lalu;
                            $cbulan_lalu_b = $cbulan_pake_ini_b;                            
                            
                            $cakum_penyusutan_bulan_b = $row2->akum_penyusutan_bulan;
                            $cpenyusutan_bulan_b = $row2->penyusutan_bulan;

                            $cumur_bulan_baru_b = $row2->umur_bulan_baru;
                            if($cumur_bulan_baru_b == 0){
                            $cumur_bulan_b = $row2->umur_bulan ;
                            }else{
                            $cumur_bulan_b = $row2->umur_bulan_baru ;
                            }

                            /*if($cbulan_lalu_b < $cumur_bulan_b){
                                if($cpake_b<=$cbulan_lalu_b)
                                { 
                                    $bln_lalu_b = ($cpake_b*$cpenyusutan_bulan_b)+($cakum_penyusutan_bulan_b*($cbulan_lalu_b-$cpake_b)) ;
                                    $bln_ini_b = $row2->akum_penyusutan_bulan + $bln_lalu_b;
                                    $penyusutan_bulan_b = $row2->akum_penyusutan_bulan;
                                }else{
                                    
                                    $bln_lalu_b= $row2->tot_bln_belum ;                
                                    $bln_ini_b = $row2->penyusutan_bulan + $bln_lalu_b;                        
                                    $penyusutan_bulan_b = $row2->penyusutan_bulan;
                                }
                            }else{
                                $bln_lalu_b= $row2->nilai ;
                                $bln_ini_b = 0 + $bln_lalu_b;
                                $penyusutan_bulan_b = 0;

                            }*/if($cbulan_lalu_b < $cumur_bulan_b){
                                if($cpake_b<=$cbulan_lalu_b)
                                { 
                                    $bln_lalu_b = ($cpake_b*$cpenyusutan_bulan_b)+($cakum_penyusutan_bulan_b*($cbulan_lalu_b-$cpake_b)) ;
                                    $bln_ini_b = $row2->akum_penyusutan_bulan + $bln_lalu_b;
                                    $penyusutan_bulan_b = $row2->akum_penyusutan_bulan;
                                }else{
                                    $bln_lalu_b= $row2->tot_bln_belum ;                                                   
                                     //kondisi untuk bulan penutupan,agar tidak ada sisa nilai buku koma                       
                                    if($cumur_bulan_b==($cbulan_lalu_b+1)){
                                        $penyusutan_bulan_b = $row2->nilai-$row2->tot_bln_belum;
                                        $bln_ini_b = $penyusutan_bulan_b + $bln_lalu_b;
                                    }else{
                                        $penyusutan_bulan_b = $row2->penyusutan_bulan;
                                        $bln_ini_b = $row2->penyusutan_bulan + $bln_lalu_b;
                                    }

                                }
                            }else{
                                $bln_lalu_b= $row2->nilai ;
                                $bln_ini_b = 0 + $bln_lalu_b;
                                $penyusutan_bulan_b = 0;

                            }

                             $tot_buku_b  = $row2->nilai-$bln_ini_b;
                             $bln_b       = strtoupper($this->getBulan($row2->bln));
                             $nilai     = $nilai+$row2->nilai;
                             $nilai2    = $nilai2+$bln_lalu_b;
                             $nilai3    = $nilai3+$penyusutan_bulan_b;
                             $nilai4    = $nilai4+$bln_ini_b;
                             $nilai5    = $nilai5+$tot_buku_b;
                             $i++;
                             $cRet .="
                             <tr>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->kode</td>
                                <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row2->nm_brg</td>
                                <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->merek</td>
                                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln_b &nbsp; $row2->tahun</td>
                                <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row2->nilai,2,',','.')."</td>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$cumur_bulan_b</td>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$cbulan_lalu_b</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu_b,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan_b,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini_b,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku_b,2,',','.')."</td>
                                </tr>";
                        }
                }
                //Akhir tahun berjalan
            
            }       

            //TOTAL
                $cRet .="
                 <tr>
                    <td bgcolor=\"#e8e8e8\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"><b>TOTAL NILAI</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai2,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai3,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai4,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai5,2,',','.')."</b></td>
                    </tr>
                </table>"; 
         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\" ></td>
            </tr>
                
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">KEPALA $nmskpd<br><br><br><br><br><br></td>          
            </tr>
            
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">(<u> $namapa </u>)</td>
            </tr>
            <tr>
                <td width=\"35%\" ></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nippa</td>
            </tr>";
            
        $cRet .=       " </table>";
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        $this->template->set('title', 'CETAK PENYUSUTAN PERALATAN DAN MESIN'); 
        $judul  = 'CETAK PENYUSUTAN PERALATAN DAN MESIN';  
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        switch($pilih) {
        case 1;
             $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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
        case 4;     
            echo $cRet;
        break;
                }   
          
    }

    function kibb_dh2(){       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
        $pilih      = $_REQUEST['pilih'];
        $tampil     = $_REQUEST['tampil'];
        $pilctk     = $_REQUEST['pilctk'];
        $blnthn     = $_REQUEST['blnthn'];
        if($blnthn=='01'){
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun'];
            $dcetak=$tahun."-".$bulan."-".'01';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));
        }else{
            $tahun1  = $_REQUEST['tahun1'];
            $tahun   = $_REQUEST['tahun2'];
            
        }
        
        
        if($pilctk=='1'){
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
        }else{
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
            $bidang     = $_REQUEST['bidang'];
            $nmbid      = $_REQUEST['nmbid'];
        }
            
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
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          if($blnthn=='01'){
            $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>PERALATAN DAN MESIN<br>Per BULAN $periodbulan $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
          }else{
              $cRet .="
                
                <tr>
                    <td></td>
                    <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>PERALATAN DAN MESIN<br>Per TAHUN $tahun</B></td>
                </tr><BR/><BR/><BR/></table>";
            }
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"10%\" >&ensp;&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:13px;\">: $skpd  $nmskpd</td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"15%\" >&ensp;&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:13px;\">: $bidang  $nmbid</td>
            </tr>";}
          $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:13px;\">: $nmkab</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            if($blnthn=='01'){
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$periodbulan $tahun </td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:&ensp;$tahun1 s.d $tahun </td>
            </tr>";
            }
            
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";

        if($blnthn=='01'){
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Ini</b></td>
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
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
            }else{
                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\" width =\"5%\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
                </tr>
                <tr>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\" width =\"5%\">1</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
            }
        
                
                $where='';
                if($pilctk=='1' || $pilctk=='3'){
                    $where="a.kd_skpd = '$skpd'";
                }else{
                    $where="a.kd_skpd = '$skpd' AND a.kd_unit='$bidang'";
                }
                 $nilai = 0;
                 $nilai2 = 0;
                 $nilai3 = 0;
                 $nilai4 = 0;
                 $nilai5 = 0;
            if($blnthn=='01'){
                //demansyah
                $csql = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                        (CASE WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(((a.nilai/TRIM(a.masa_manfaat*12))*MONTH(a.tgl_oleh)) AS DECIMAL (18,2)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN TRUNCATE(CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,9)),2)
                        END) AS lalu_pelihara,

                        IF(a.tahun='$tahun',1,(2016-a.tahun+1)) AS th_lalu,2016 AS th_ini,

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)
                        AS bulan_lalu,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))
                        AS bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))>-12 
                        THEN TRUNCATE(CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,2)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))<=-12 
                        THEN 0
                        END) AS nil_bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END) AS akum_penyusutan_bulan,

                        (CASE
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap<'$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))
                        END)
                        AS akum_tot_bln_belum

                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE kd_barang<>'' AND a.tgl_reg<='$last' AND $where 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
                {
                $cbln = $row->bln;
                $cbulan_lalu = $row->bulan_lalu;
                $cakum_penyusutan_bulan = $row->akum_penyusutan_bulan;
                $clalu_pelihara = $row->lalu_pelihara;

                    if($row->bulan_lalu>=$row->bln)
                    { 
                        $bln_lalu = $clalu_pelihara + ($cakum_penyusutan_bulan*($cbulan_lalu - $cbln));
                        $bln_ini =$row->akum_penyusutan_bulan + $bln_lalu;
                        $penyusutan_bulan = $row->akum_penyusutan_bulan;
                    }else{   
                        $bln_lalu= $row->tot_bln_belum;                 
                        $bln_ini = $row->nil_bulan_ini;                        
                        $penyusutan_bulan = $row->penyusutan_bulan;
                    }

                     $tot_buku  = $row->nilai-$bln_ini;
                     $bln       = strtoupper($this->getBulan($row->bln));
                     $nilai     = $nilai+$row->nilai;
                     $nilai2    = $nilai2+$bln_ini;
                     $nilai3    = $nilai3+$row->penyusutan_bulan;
                     $nilai4    = $nilai4+$bln_ini;
                     $nilai5    = $nilai5+$tot_buku;
                     $i++;
                     $cRet .="
                     <tr>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                        <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                        <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                        <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row->tahun</td>
                        <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur_bulan</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->bulan_lalu</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                        </tr>";
                }
            }else{

                $csql="SELECT a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),0)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE $where AND kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun' 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')order by a.kd_brg,a.tahun,a.no_reg ";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                
             if($row->masa_manfaat_baru<>null){
                $susut_per_tahun = $row->ada3_susut_per_thn;
                $susut_thn_lalu = $row->ada2_akm_thn_lalu;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                $umur = $row->masa_manfaat_baru;
                $nb = $row->nilai - $susut_thn_ini;
            }else{
                $susut_per_tahun = $row->penyusutan_pertahun;
                $susut_thn_lalu = $row->tot_th_belum;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                $umur = $row->umur;
                $nb = $row->nilai - $susut_thn_ini;
            }
                
             
                
             
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$susut_thn_lalu;
             $nilai3    = $nilai3+$susut_per_tahun;
             $nilai4    = $nilai4+$susut_thn_ini;
             $nilai5    = $nilai5+$nb;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_per_tahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nb,2,',','.')."</td>
                    </tr>";
             }
            }

                $cRet .="
                 <tr>
                    <td bgcolor=\"#e8e8e8\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5,2,',','.')."</td>
                    </tr>
                </table>"; 
         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\" ></td>
            </tr>
                
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">KEPALA $nmskpd<br><br><br><br><br><br></td>          
            </tr>
            
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">(<u> $namapa </u>)</td>
            </tr>
            <tr>
                <td width=\"35%\" ></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nippa</td>
            </tr>";
            
        $cRet .=       " </table>";
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        $this->template->set('title', 'CETAK PENYUSUTAN PERALATAN DAN MESIN'); 
        $judul  = 'CETAK PENYUSUTAN PERALATAN DAN MESIN';  
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        switch($pilih) {
        case 1;
             $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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
        case 4;     
            echo $cRet;
        break;
                }   
          
    }

    function kibb_dhxx(){
       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
        $pilih      = $_REQUEST['pilih'];
        $tampil     = $_REQUEST['tampil'];
        $pilctk     = $_REQUEST['pilctk'];
        $blnthn     = $_REQUEST['blnthn'];
        if($blnthn=='01'){
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun'];
            $dcetak=$tahun."-".$bulan."-".'01';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));
        }else{
            $tahun1  = $_REQUEST['tahun1'];
            $tahun   = $_REQUEST['tahun2'];
            
        }
        
        
        if($pilctk=='1'){
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
        }else{
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
            $bidang     = $_REQUEST['bidang'];
            $nmbid      = $_REQUEST['nmbid'];
        }
            
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
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          if($blnthn=='01'){
            $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>PERALATAN DAN MESIN<br>Per BULAN $periodbulan $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
          }else{
              $cRet .="
                
                <tr>
                    <td></td>
                    <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>PERALATAN DAN MESIN<br>Per TAHUN $tahun</B></td>
                </tr><BR/><BR/><BR/></table>";
            }
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
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:13px;\">: $nmkab</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            if($blnthn=='01'){
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$periodbulan $tahun </td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$tahun1 s.d $tahun </td>
            </tr>";
            }
            
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";

        if($blnthn=='01'){
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Ini</b></td>
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
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
            }else{
                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\" width =\"10%\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
                </tr>
                <tr>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\" width =\"10%\">1</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
            }
        
                
                $where='';
                if($pilctk=='1' || $pilctk=='3'){
                    $where="a.kd_skpd = '$skpd'";
                }else{
                    $where="a.kd_skpd = '$skpd' AND a.kd_unit='$bidang'";
                }
                 $nilai = 0;
                 $nilai2 = 0;
                 $nilai3 = 0;
                 $nilai4 = 0;
                 $nilai5 = 0;
            if($blnthn=='01'){
                //demansyah
                $csql = "SELECT MONTH(a.tgl_oleh)as bln,a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,a.nilai,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,a.tahun,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)
                        AS bulan_lalu,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))
                        AS bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=1 THEN CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9))
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))=0 THEN a.nilai
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<1 THEN a.nilai END)AS penyusutan_bulan,
                        (CASE 
                                WHEN TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))=1 
                                    THEN CAST((a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>1 
                                    THEN CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<1 
                                    THEN a.nilai
                            END)
                         AS tot_bln_belum,
                         
                        (CASE 
                                WHEN (TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))=1 
                                    THEN CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))>1 
                                    THEN CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))<1 
                                    THEN a.nilai
                        END) AS nil_bulan_ini
                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)
                        
                        WHERE kd_barang<>'' AND tgl_oleh<='$last' AND $where
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9') ORDER BY a.kd_brg,a.tahun ";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                //$tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
                if($row->umur_bulan>=$row->bulan_ini){
                    $bln_ini =$row->bulan_ini*$row->penyusutan_bulan;
                    $bln_lalu=$row->bulan_lalu*$row->penyusutan_bulan;
                    $tot_bln_ini = $bln_ini+$bln_lalu;
                    $penyusutan_bulan = $row->penyusutan_bulan;
                }else{
                    $penyusutan_bulan = 0;
                    $bln_ini = $row->nilai;
                    $bln_lalu= $row->nilai;
                    $tot_bln_ini=$row->tot_bln_belum+$row->penyusutan_bulan;
                }
             $tot_buku  = $row->nilai-$bln_ini;
             $bln       = strtoupper($this->getBulan($row->bln));
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$row->tot_bln_belum;
             $nilai3    = $nilai3+$row->penyusutan_bulan;
             $nilai4    = $nilai4+$tot_bln_ini;
             $nilai5    = $nilai5+$tot_buku;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur_bulan</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->bulan_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                    </tr>";
             }
            }else{
                
            

                $csql="SELECT a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),a.nilai/a.masa_manfaat)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE $where AND kd_barang<>'' AND a.tahun BETWEEN '$tahun1' AND '$tahun' ";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                /*if($row->masa_manfaat_baru<>null){
                $umur = $row->masa_manfaat_baru;
             }else{
                $umur = $row->umur;
             }

             if($row->ada<>0){
                $susut_thn_lalu = $row->ada+$row->ada2;
                $penyusutan_pertahun= $row->ada3;
                $tot_th_ini= $susut_thn_lalu+$penyusutan_pertahun;
             }else{
                $susut_thn_lalu = $row->tot_th_belum;
                $penyusutan_pertahun= $row->penyusutan_pertahun;
                $tot_th_ini= $susut_thn_lalu+$penyusutan_pertahun;
             }
                
                //$tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
                //if($row->th_lalu!=$row->umur){
                //    $tot_th_ini=$row->nil_th_ini;
                //}else{
                    //$tot_th_ini=$row->tot_th_belum+$penyusutan_pertahun;
                //}
             $tot_buku = $row->nilai-$tot_th_ini;*/
             if($row->masa_manfaat_baru<>null){
                $susut_per_tahun = $row->ada3_susut_per_thn;
                $susut_thn_lalu = $row->ada2_akm_thn_lalu;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;//$row->ada_akum_susut_sd_thn_ini;
                $umur = $row->masa_manfaat_baru;
                $nb = $row->nilai - $susut_thn_ini;
            }else{
                $susut_per_tahun = $row->penyusutan_pertahun;
                $susut_thn_lalu = $row->tot_th_belum;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;//$row->nil_th_ini;
                $umur = $row->umur;
                $nb = $row->nilai - $susut_thn_ini;
            }
                
             
                
             
             /*$nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$susut_thn_lalu;
             $nilai3    = $nilai3+$penyusutan_pertahun;
             $nilai4    = $nilai4+$tot_th_ini;
             $nilai5    = $nilai5+$tot_buku;*/
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_per_tahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nb,2,',','.')."</td>
                    </tr>";
             }
            }
                
                 
                 /*<tr>
                    <td bgcolor=\"#e8e8e8\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5,2,',','.')."</td>
                    </tr>*/
                $cRet .="</table>"; 
         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\" ></td>
            </tr>
                
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">KEPALA $nmskpd<br><br><br><br><br><br></td>          
            </tr>
            
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">(<u> $namapa </u>)</td>
            </tr>
            <tr>
                <td width=\"35%\" ></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nippa</td>
            </tr>";
            
        $cRet .=       " </table>";
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        $this->template->set('title', 'CETAK PENYUSUTAN PERALATAN DAN MESIN'); 
        $judul  = 'CETAK PENYUSUTAN PERALATAN DAN MESIN';  
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        switch($pilih) {
        case 1;
             $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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
        case 4;     
            echo $cRet;
        break;
                }   
          
    }


    /*function kibb_dh(){
       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
        $pilih      = $_REQUEST['pilih'];
        $tampil     = $_REQUEST['tampil'];
        $pilctk     = $_REQUEST['pilctk'];
        $blnthn     = $_REQUEST['blnthn'];
        if($blnthn=='01'){
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun'];
            $dcetak=$tahun."-".$bulan."-".'01';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));
        }else{
            $tahun1  = $_REQUEST['tahun1'];
            $tahun   = $_REQUEST['tahun2'];
            
        }
        
        
        if($pilctk=='1'){
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
        }else{
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
            $bidang     = $_REQUEST['bidang'];
            $nmbid      = $_REQUEST['nmbid'];
        }
            
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
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          if($blnthn=='01'){
            $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>PERALATAN DAN MESIN<br>Per BULAN $periodbulan $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
          }else{
              $cRet .="
                
                <tr>
                    <td></td>
                    <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>PERALATAN DAN MESIN<br>Per TAHUN $tahun</B></td>
                </tr><BR/><BR/><BR/></table>";
            }
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
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:13px;\">: $nmkab</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            if($blnthn=='01'){
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$periodbulan $tahun </td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$tahun1 s.d $tahun </td>
            </tr>";
            }
            
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";

        if($blnthn=='01'){
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Ini</b></td>
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
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
            }else{
                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\" width =\"10%\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
                </tr>
                <tr>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\" width =\"10%\">1</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
            }
        
                
                $where='';
                if($pilctk=='1' || $pilctk=='3'){
                    $where="a.kd_skpd = '$skpd'";
                }else{
                    $where="a.kd_skpd = '$skpd' AND a.kd_unit='$bidang'";
                }
                 $nilai = 0;
                 $nilai2 = 0;
                 $nilai3 = 0;
                 $nilai4 = 0;
                 $nilai5 = 0;
            if($blnthn=='01'){
                //demansyah
                $csql = "SELECT MONTH(a.tgl_oleh)as bln,a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,a.nilai,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,a.tahun,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)
                        AS bulan_lalu,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))
                        AS bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=1 THEN CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9))
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))=0 THEN a.nilai
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<1 THEN a.nilai END)AS penyusutan_bulan,
                        (CASE 
                                WHEN TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))=1 
                                    THEN CAST((a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>1 
                                    THEN CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<1 
                                    THEN a.nilai
                            END)
                         AS tot_bln_belum,
                         
                        (CASE 
                                WHEN (TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))=1 
                                    THEN CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))>1 
                                    THEN CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))<1 
                                    THEN a.nilai
                        END) AS nil_bulan_ini
                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)
                        
                        WHERE kd_barang<>'' AND tgl_oleh<='$last' AND $where
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9') ORDER BY a.kd_brg,a.tahun ";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                //$tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
                if($row->umur_bulan>=$row->bulan_ini){
                    $bln_ini =$row->bulan_ini*$row->penyusutan_bulan;
                    $bln_lalu=$row->bulan_lalu*$row->penyusutan_bulan;
                    $tot_bln_ini = $bln_ini+$bln_lalu;
                    $penyusutan_bulan = $row->penyusutan_bulan;
                }else{
                    $penyusutan_bulan = 0;
                    $bln_ini = $row->nilai;
                    $bln_lalu= $row->nilai;
                    $tot_bln_ini=$row->tot_bln_belum+$row->penyusutan_bulan;
                }
             $tot_buku  = $row->nilai-$bln_ini;
             $bln       = strtoupper($this->getBulan($row->bln));
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$row->tot_bln_belum;
             $nilai3    = $nilai3+$row->penyusutan_bulan;
             $nilai4    = $nilai4+$tot_bln_ini;
             $nilai5    = $nilai5+$tot_buku;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur_bulan</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->bulan_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                    </tr>";
             }
            }else{
                
            $csql = "SELECT a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,a.nilai,TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,a.tahun,

                        (CASE WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                         AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)
                        
                        WHERE kd_barang<>'' AND a.tahun BETWEEN '$tahun1' AND '$tahun' AND $where
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9') ORDER BY a.kd_brg,a.tahun";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                //$tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
                if($row->th_lalu!=$row->umur){
                    $tot_th_ini=$row->nil_th_ini;
                }else{
                    $tot_th_ini=$row->tot_th_belum+$row->penyusutan_pertahun;
                }
             $tot_buku = $row->nilai-$tot_th_ini;
             
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$row->tot_th_belum;
             $nilai3    = $nilai3+$row->penyusutan_pertahun;
             $nilai4    = $nilai4+$tot_th_ini;
             $nilai5    = $nilai5+$tot_buku;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->tot_th_belum,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->penyusutan_pertahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_th_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                    </tr>";
             }
            }
                
                 $cRet .="
                 <tr>
                    <td bgcolor=\"#e8e8e8\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5,2,',','.')."</td>
                    </tr>
                </table>"; 
         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\" ></td>
            </tr>
                
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">KEPALA $nmskpd<br><br><br><br><br><br></td>          
            </tr>
            
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">(<u> $namapa </u>)</td>
            </tr>
            <tr>
                <td width=\"35%\" ></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nippa</td>
            </tr>";
            
        $cRet .=       " </table>";
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        $this->template->set('title', 'CETAK PENYUSUTAN PERALATAN DAN MESIN'); 
        $judul  = 'CETAK PENYUSUTAN PERALATAN DAN MESIN';  
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        switch($pilih) {
        case 1;
             $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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
        case 4;     
            echo $cRet;
        break;
                }   
          
    }*/
    function kibc_dh(){       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
        $pilih      = $_REQUEST['pilih'];
        $tampil     = $_REQUEST['tampil'];
        $blnthn     = $_REQUEST['blnthn'];
        $pilctk     = $_REQUEST['pilctk'];
        if($blnthn=='01'){
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun'];
            $dcetak=$tahun."-".$bulan."-".'31';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));
        }else if($blnthn=='02'){
            $tahun1  = $_REQUEST['tahun1'];
            $tahun   = $_REQUEST['tahun2'];
            
        }else{
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun3'];
            $dcetak=$tahun."-".$bulan."-".'31';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));
        }

        if($pilctk=='1'){
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
        }else{
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
            $bidang     = $_REQUEST['bidang'];
            $nmbid      = $_REQUEST['nmbid'];
        }
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
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
        if($blnthn=='01' || $blnthn=='03'){
            $cRet .="
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>GEDUNG DAN BANGUNAN<br>Per BULAN $periodbulan $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
        }else{
            $cRet .="
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>GEDUNG DAN BANGUNAN<br>Per TAHUN $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
        }
        
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"10%\" >&ensp;&ensp;OPD</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $skpd  $nmskpd</B></td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"15%\" >&ensp;&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $bidang  $nmbid</B></td>
            </tr>";}
          $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:13px;\">: $nmkab</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            if($blnthn=='01' || $blnthn=='03'){
                
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$periodbulan $tahun </td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$tahun1 s.d $tahun </td>
            </tr>";
            }
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";
           if($blnthn=='01' || $blnthn=='03'){
                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                <thead>
                    <tr>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                        <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                    </tr>
                    <tr>    
                        <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Lalu</b></td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Sebelumnya</b></td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Ini</b></td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Ini</b></td>
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
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                        
                     </tr>
                </thead>
                <tfoot>
                            <tr>
                                <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                            </tr>
                        </tfoot>
                    ";
            }else{
                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                    <thead>
                        <tr>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                            <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                        </tr>
                        <tr>    
                            <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
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
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                            
                         </tr>
                    </thead>
                    <tfoot>
                                <tr>
                                    <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                                </tr>
                            </tfoot>
                        ";
            }    
                $where='';
                if($pilctk=='1' || $pilctk=='3'){
                    $where="a.kd_skpd = '$skpd'";
                }else{
                    $where="a.kd_skpd = '$skpd' AND a.kd_unit='$bidang'";
                }
                 $nilai = 0;
                 $nilai2 = 0;
                 $nilai3 = 0;
                 $nilai4 = 0;
                 $nilai5 = 0;
                if($blnthn=='01'){
                //demansyah
                $csql="SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,''AS merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                        (TRIM(a.masa_manfaat*12)+((SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang)*12))
                        ,0)AS umur_bulan_baru,

                        (CASE WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(((a.nilai/TRIM(a.masa_manfaat*12))*MONTH(a.tgl_oleh)) AS DECIMAL (18,2)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN TRUNCATE(CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,9)),2)
                        END) AS lalu_pelihara,

                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)
                        AS bulan_lalu,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))
                        AS bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))>-12 
                        THEN TRUNCATE(CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,2)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))<=-12 
                        THEN 0
                        END) AS nil_bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END) AS akum_penyusutan_bulan,

                        (CASE
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap<'$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))
                        END)
                        AS akum_tot_bln_belum

                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE kd_barang<>'' AND tgl_oleh<='$last' AND $where 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
                {
                $cbln = $row->bln;
                $cbulan_lalu = $row->bulan_lalu;
                $cakum_penyusutan_bulan = $row->akum_penyusutan_bulan;
                $clalu_pelihara = $row->lalu_pelihara;

                    if($row->umur_bulan_baru<>0)
                    { 
                        $bln_lalu = $clalu_pelihara + ($cakum_penyusutan_bulan*($cbulan_lalu - $cbln));
                        $bln_ini =$row->akum_penyusutan_bulan + $bln_lalu;
                        $penyusutan_bulan = $row->akum_penyusutan_bulan;
                    }else{   
                        $bln_lalu= $row->tot_bln_belum;                 
                        $bln_ini = $row->nil_bulan_ini;                        
                        $penyusutan_bulan = $row->penyusutan_bulan;
                    }

                     $tot_buku  = $row->nilai-$bln_ini;
                     $bln       = strtoupper($this->getBulan($row->bln));
                     $nilai     = $nilai+$row->nilai;
                     $nilai2    = $nilai2+$bln_ini;
                     $nilai3    = $nilai3+$penyusutan_bulan;
                     $nilai4    = $nilai4+$bln_ini;
                     $nilai5    = $nilai5+$tot_buku;
                     $i++;
                     $cRet .="
                     <tr>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                        <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                        <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                        <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row->tahun</td>
                        <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur_bulan</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->bulan_lalu</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                        </tr>";
                }
            }else if($blnthn=='02'){
                $csql="SELECT a.kd_brg AS kode,b.nm_brg,'' as merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),a.nilai/a.masa_manfaat)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                        WHERE $where AND YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun' 
                        AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                
                 if($row->masa_manfaat_baru<>null){
                    $susut_per_tahun = $row->ada3_susut_per_thn;
                    $susut_thn_lalu = $row->ada2_akm_thn_lalu;
                    $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                    $umur = $row->masa_manfaat_baru;
                    $nb = $row->nilai - $susut_thn_ini;
                }else{
                    $susut_per_tahun = $row->penyusutan_pertahun;
                    $susut_thn_lalu = $row->tot_th_belum;
                    $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                    $umur = $row->umur;
                    $nb = $row->nilai - $susut_thn_ini;
                }
                    
                 
                    
                 
                 $nilai     = $nilai+$row->nilai;
                 $nilai2    = $nilai2+$susut_thn_lalu;
                 $nilai3    = $nilai3+$susut_per_tahun;
                 $nilai4    = $nilai4+$susut_thn_ini;
                 $nilai5    = $nilai5+$nb;
                 $i++;
                 $cRet .="
                 <tr>
                    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_per_tahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nb,2,',','.')."</td>
                    </tr>";
                }
            }else if($blnthn=='03')
            {
                /*$csql="SELECT a.id_barang,a.kd_brg AS kode,
                    IF(a.tahun='2015',1,(2015-a.tahun+1)) AS th_lalu,

                    (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='2015' AND b.id_barang=a.id_barang))-(2015-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN 0 END)
                    AS penyusutan_pertahun,

                    IF(a.tahun='2015',0,(CASE 
                    WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))>1 THEN CAST((2015-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN a.nilai
                    END)) AS tot_th_belum

                    FROM trkib_c a
                    LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                    LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                    WHERE $where AND kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '1945' AND '2015' 
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')";
       
                 $hasil = $this->db->query($csql);
                 $i = 0;
                 
                 foreach ($hasil->result() as $row)
                {                
                    $cid_barang = $row->id_barang;
                    $cth_lalu = $row->th_lalu * 12;                
                    $susut_per_tahun = $row->penyusutan_pertahun;
                    $susut_thn_lalu = $row->tot_th_belum;
                    $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
             
                    $sql = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,'' as merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                            IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                            (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))
                            ,0)AS umur_bulan_baru,

                            (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                            FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,
                            (SELECT (('$tahun'-YEAR(a.tgl_oleh)+1)*12) - (MONTH(a.tgl_reg)-'$bulan')) AS pake1, 

                            CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                            TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12)-1)
                            AS bulan_lalu,

                            TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12))
                            AS bulan_ini,

                            (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                            WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                            (CASE 
                            WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>=0 
                            THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-'2015')*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                            WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                            THEN a.nilai
                            END)
                            AS tot_bln_belum,

                            (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                            THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                            (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                            FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                            ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                            (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                            FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                            WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan

                            FROM trkib_c a
                            LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                            LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                            WHERE kd_barang<>'' AND a.tgl_reg<='$last' AND $where AND a.id_barang='$cid_barang'
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
                       
                     $hasil2 = $this->db->query($sql);                     
                     
                    foreach ($hasil2->result() as $row2)
                        {
                            $cpaket = $row2->pake;
                            if ($cpaket == NULL){
                            $cpake = $row2->pake1;
                            }else{
                            $cpake = $row2->pake;
                            }

                            $cbulan_pake_ini = $row2->bulan_lalu;
                            $cbulan_lalu = $cbulan_pake_ini + $cth_lalu;                            
                            
                            $cakum_penyusutan_bulan = $row2->akum_penyusutan_bulan;
                            $cpenyusutan_bulan = $row2->penyusutan_bulan;

                            $cumur_bulan_baru = $row2->umur_bulan_baru;
                            if($cumur_bulan_baru == 0){
                            $cumur_bulan = $row2->umur_bulan ;
                            }else{
                            $cumur_bulan = $row2->umur_bulan_baru ;
                            }

                            if($cbulan_lalu < $cumur_bulan){
                                if($cpake<=$cbulan_lalu)
                                { 
                                    $bln_lalu = ($cpake*$cpenyusutan_bulan)+($cakum_penyusutan_bulan*($cbulan_lalu-$cpake)) ;
                                    $bln_ini = $row2->akum_penyusutan_bulan + $bln_lalu;
                                    $penyusutan_bulan = $row2->akum_penyusutan_bulan;
                                }else{
                                    if($cumur_bulan>=$cbulan_lalu){
                                     $bln_lalu= $susut_thn_ini + $row2->tot_bln_belum ;    
                                    }else{
                                     $bln_lalu= $row2->tot_bln_belum ;    
                                    }                                                   
                                    $bln_ini = $row2->penyusutan_bulan + $bln_lalu;                        
                                    $penyusutan_bulan = $row2->penyusutan_bulan;
                                }
                            }else{
                                $bln_lalu= $row2->nilai ;
                                $bln_ini = 0 + $bln_lalu;
                                $penyusutan_bulan = 0;

                            }

                             $tot_buku  = $row2->nilai-$bln_ini;
                             $bln       = strtoupper($this->getBulan($row2->bln));
                             $nilai     = $nilai+$row2->nilai;
                             $nilai2    = $nilai2+$bln_lalu;
                             $nilai3    = $nilai3+$penyusutan_bulan;
                             $nilai4    = $nilai4+$bln_ini;
                             $nilai5    = $nilai5+$tot_buku;
                             $i++;
                             $cRet .="
                             <tr>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->kode</td>
                                <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row2->nm_brg</td>
                                <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->merek</td>
                                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row2->tahun</td>
                                <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row2->nilai,2,',','.')."</td>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$cumur_bulan</td>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$cbulan_lalu</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                                </tr>";
                        }
                }*/
                $csql="SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,'' as merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),a.nilai/a.masa_manfaat)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                        WHERE $where AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015' 
                        AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                
                 if($row->masa_manfaat_baru<>null){
                    $susut_per_tahun = $row->ada3_susut_per_thn;
                    $susut_thn_lalu = $row->ada2_akm_thn_lalu;
                    $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                    $umur = $row->masa_manfaat_baru*12;
                    $nb = $row->nilai - $susut_thn_ini;
                    $th_lalu = $row->th_lalu*12;
                }else{
                    $susut_per_tahun = $row->penyusutan_pertahun;
                    $susut_thn_lalu = $row->tot_th_belum;
                    $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                    $umur = $row->umur*12;
                    $nb = $row->nilai - $susut_thn_ini;
                    $th_lalu = $row->th_lalu*12;
                }
                    
                 
                    
                 $bln       = strtoupper($this->getBulan($row->bln));
                 $nilai     = $nilai+$row->nilai;
                 $nilai2    = $nilai2+$susut_thn_lalu;
                 $nilai3    = $nilai3+$susut_per_tahun;
                 $nilai4    = $nilai4+$susut_thn_ini;
                 $nilai5    = $nilai5+$nb;
                 $i++;
                 $cRet .="
                 <tr>
                    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_per_tahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nb,2,',','.')."</td>
                    </tr>";
                }
                //awal thn berjalan
                $csql_ini="SELECT a.id_barang,a.kd_brg AS kode,
                    IF(a.tahun='$tahun',1,('$tahun'-a.tahun+1)) AS th_lalu,                    
                    IF(a.tahun='$tahun',0,(CASE 
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))>1 THEN CAST(('$tahun'-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN a.nilai
                    END)) AS tot_th_belum, 
                    (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))-('$tahun'-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN 0 END)
                    AS penyusutan_pertahun
                    FROM trkib_c a
                    LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                    LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                    WHERE $where 
                    AND a.tgl_oleh BETWEEN '2016-01-01' AND '$last'
                    AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')ORDER BY a.kd_brg,a.tahun,a.no_reg";
       
                 $hasil_ini = $this->db->query($csql_ini);                 
                 foreach ($hasil_ini->result() as $row)
                {                
                    $cid_barang_c = $row->id_barang;
                    $cth_lalu_c = $row->th_lalu * 12;                
                    $susut_per_tahun_c = $row->penyusutan_pertahun;
                    $susut_thn_lalu_c = $row->tot_th_belum;
                    $susut_thn_ini_c = $susut_thn_lalu_c+$susut_per_tahun_c;
             
                    $sql_ini = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,''as merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap BETWEEN '2016-01-01' AND '$last' GROUP BY id_barang),
                        (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))
                        ,0)AS umur_bulan_baru,

                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                        (SELECT (('$tahun'-YEAR(a.tgl_oleh))*12) - (MONTH(a.tgl_oleh)-'$bulan')+1) AS pake1, 

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'$tahun')*12))
                        AS bulan_lalu,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12))>=0 
                        THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-'$tahun')*12))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan

                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                        WHERE a.tgl_oleh BETWEEN '2016-01-01' AND '$last' AND $where
                         AND a.id_barang='$cid_barang_c'
                         AND IF('$last'>='2016-01-01',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
                       
                     $hasil2_ini = $this->db->query($sql_ini);                     
                     
                    foreach ($hasil2_ini->result() as $row2)
                        {
                            $cpaket_c = $row2->pake;
                            if ($cpaket_c == NULL){
                            $cpake_c = $row2->pake1;
                            }else{
                            $cpake_c = $row2->pake;
                            }

                            $cbulan_pake_ini_c = $row2->bulan_lalu;
                            $cbulan_lalu_c = $cbulan_pake_ini_c;                            
                            
                            $cakum_penyusutan_bulan_c = $row2->akum_penyusutan_bulan;
                            $cpenyusutan_bulan_c = $row2->penyusutan_bulan;

                            $cumur_bulan_baru_c = $row2->umur_bulan_baru;
                            if($cumur_bulan_baru_c == 0){
                            $cumur_bulan_c = $row2->umur_bulan ;
                            }else{
                            $cumur_bulan_c = $row2->umur_bulan_baru ;
                            }

                            /*if($cbulan_lalu_c < $cumur_bulan_c){
                                if($cpake_c<=$cbulan_lalu_c)
                                { 
                                    $bln_lalu_c = ($cpake_c*$cpenyusutan_bulan_c)+($cakum_penyusutan_bulan_c*($cbulan_lalu_c-$cpake_c)) ;
                                    $bln_ini_c = $row2->akum_penyusutan_bulan + $bln_lalu_c;
                                    $penyusutan_bulan_c = $row2->akum_penyusutan_bulan;
                                }else{
                                    $bln_lalu_c= $row2->tot_bln_belum ;                  
                                    $bln_ini_c = $row2->penyusutan_bulan + $bln_lalu_c;                        
                                    $penyusutan_bulan_c = $row2->penyusutan_bulan;
                                }
                            }else{
                                $bln_lalu_c= $row2->nilai ;
                                $bln_ini_c = 0 + $bln_lalu_c;
                                $penyusutan_bulan_c = 0;

                            }*/
                            if($cbulan_lalu_c < $cumur_bulan_c){
                                if($cpake_c<=$cbulan_lalu_c)
                                { 
                                    $bln_lalu_c = ($cpake_c*$cpenyusutan_bulan_c)+($cakum_penyusutan_bulan_c*($cbulan_lalu_c-$cpake_c)) ;
                                    $bln_ini_c = $row2->akum_penyusutan_bulan + $bln_lalu_c;
                                    $penyusutan_bulan_c = $row2->akum_penyusutan_bulan;
                                }else{
                                    $bln_lalu_c= $row2->tot_bln_belum ;                                                   
                                     //kondisi untuk bulan penutupan,agar tidak ada sisa nilai buku koma                       
                                    if($cumur_bulan_c==($cbulan_lalu_c+1)){
                                        $penyusutan_bulan_c = $row2->nilai-$row2->tot_bln_belum;
                                        $bln_ini_c = $penyusutan_bulan_c + $bln_lalu_c;
                                    }else{
                                        $penyusutan_bulan_c = $row2->penyusutan_bulan;
                                        $bln_ini_c = $row2->penyusutan_bulan + $bln_lalu_c;
                                    }

                                }
                            }else{
                                $bln_lalu_c= $row2->nilai ;
                                $bln_ini_c = 0 + $bln_lalu_c;
                                $penyusutan_bulan_c = 0;

                            }

                             $tot_buku_c  = $row2->nilai-$bln_ini_c;
                             $bln_c       = strtoupper($this->getBulan($row2->bln));
                             $nilai     = $nilai+$row2->nilai;
                             $nilai2    = $nilai2+$bln_lalu_c;
                             $nilai3    = $nilai3+$penyusutan_bulan_c;
                             $nilai4    = $nilai4+$bln_ini_c;
                             $nilai5    = $nilai5+$tot_buku_c;
                             $i++;
                             $cRet .="
                             <tr>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->kode</td>
                                <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row2->nm_brg</td>
                                <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->merek</td>
                                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln_c &nbsp; $row2->tahun</td>
                                <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row2->nilai,2,',','.')."</td>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$cumur_bulan_c</td>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$cbulan_lalu_c</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu_c,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan_c,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini_c,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku_c,2,',','.')."</td>
                                </tr>";
                        }
                }

                //akhir thn berjalan
            }

                $cRet .="
                 <tr>
                    <td bgcolor=\"#e8e8e8\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"><b>TOTAL NILAI</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai2,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai3,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai4,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai5,2,',','.')."</b></td>
                    </tr>
                </table>"; 
                
         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\" ></td>
            </tr>
                
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">KEPALA $nmskpd<br><br><br><br><br><br></td>          
            </tr>
            
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">(<u> $namapa </u>)</td>
            </tr>
            <tr>
                <td width=\"35%\" ></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nippa</td>
            </tr>";
            
        $cRet .=       " </table>";
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        $this->template->set('title', 'CETAK PENYUSUTAN GEDUNG DAN BANGUNAN'); 
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        $judul  = 'CETAK PENYUSUTAN GEDUNG DAN BANGUNAN';  
        switch($pilih) {
        case 1;
             $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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
        case 4;     
            echo $cRet;
        break;
                }   
          
    }
    function kibc_dh2(){
       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
        $pilih      = $_REQUEST['pilih'];
        $tampil     = $_REQUEST['tampil'];
        $blnthn     = $_REQUEST['blnthn'];
        $pilctk     = $_REQUEST['pilctk'];
        if($blnthn=='01'){
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun'];
            $dcetak=$tahun."-".$bulan."-".'01';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));
        }else{
            $tahun1  = $_REQUEST['tahun1'];
            $tahun   = $_REQUEST['tahun2'];
            
        }

        if($pilctk=='1'){
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
        }else{
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
            $bidang     = $_REQUEST['bidang'];
            $nmbid      = $_REQUEST['nmbid'];
        }
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
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
        if($blnthn=='01'){
            $cRet .="
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>GEDUNG DAN BANGUNAN<br>Per BULAN $periodbulan $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
        }else{
            $cRet .="
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>GEDUNG DAN BANGUNAN<br>Per TAHUN $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
        }
        
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
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:13px;\">: $nmkab</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            if($blnthn=='01'){
                
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$periodbulan $tahun </td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$tahun1 s.d $tahun </td>
            </tr>";
            }
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";
           if($blnthn=='01'){
                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                <thead>
                    <tr>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                        <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                        <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                    </tr>
                    <tr>    
                        <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Lalu</b></td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Sebelumnya</b></td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Ini</b></td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Ini</b></td>
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
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                        
                     </tr>
                </thead>
                <tfoot>
                            <tr>
                                <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                            </tr>
                        </tfoot>
                    ";
            }else{
                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                    <thead>
                        <tr>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                            <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                            <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                        </tr>
                        <tr>    
                            <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
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
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                            <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                            
                         </tr>
                    </thead>
                    <tfoot>
                                <tr>
                                    <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                                </tr>
                            </tfoot>
                        ";
            }    
                $where='';
                if($pilctk=='1' || $pilctk=='3'){
                    $where="a.kd_skpd = '$skpd'";
                }else{
                    $where="a.kd_skpd = '$skpd' AND a.kd_unit='$bidang'";
                }
                 $nilai = 0;
                 $nilai2 = 0;
                 $nilai3 = 0;
                 $nilai4 = 0;
                 $nilai5 = 0;
                if($blnthn=='01'){
                //demansyah
                /*$csql = "SELECT MONTH(a.tgl_oleh)as bln,a.kd_brg AS kode,b.nm_brg,''as merek,a.tahun,a.nilai,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,a.tahun,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)
                        AS bulan_lalu,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))
                        AS bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=1 THEN CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9))
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))=0 THEN a.nilai
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<1 THEN a.nilai END)AS penyusutan_bulan,
                        (CASE 
                                WHEN TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))=1 
                                    THEN CAST((a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>1 
                                    THEN CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<1 
                                    THEN a.nilai
                            END)
                         AS tot_bln_belum,
                         
                        (CASE 
                                WHEN (TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))=1 
                                    THEN CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))>1 
                                    THEN CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))<1 
                                    THEN a.nilai
                        END) AS nil_bulan_ini
                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)
                        LEFT JOIN ms_kapitalisasi d ON  c.kd_barang=d.kd_kelompok
                        WHERE kd_barang<>'' AND tgl_oleh<='$last' AND $where
                        AND (a.nilai>=d.nilai_kap AND a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9') AND a.kondisi<>'RB' ORDER BY a.kd_brg,a.tahun ";*/
                $csql="SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,''AS merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                        (TRIM(a.masa_manfaat*12)+((SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang)*12))
                        ,0)AS umur_bulan_baru,

                        (CASE WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(((a.nilai/TRIM(a.masa_manfaat*12))*MONTH(a.tgl_oleh)) AS DECIMAL (18,2)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN TRUNCATE(CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,9)),2)
                        END) AS lalu_pelihara,

                        IF(a.tahun='$tahun',1,(2016-a.tahun+1)) AS th_lalu,2016 AS th_ini,

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)
                        AS bulan_lalu,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))
                        AS bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))>-12 
                        THEN TRUNCATE(CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,2)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))<=-12 
                        THEN 0
                        END) AS nil_bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END) AS akum_penyusutan_bulan,

                        (CASE
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap<'$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))
                        END)
                        AS akum_tot_bln_belum

                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE kd_barang<>'' AND tgl_oleh<='$last' AND $where 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
                {
                $cbln = $row->bln;
                $cbulan_lalu = $row->bulan_lalu;
                $cakum_penyusutan_bulan = $row->akum_penyusutan_bulan;
                $clalu_pelihara = $row->lalu_pelihara;

                    if($row->umur_bulan_baru<>0)
                    { 
                        $bln_lalu = $clalu_pelihara + ($cakum_penyusutan_bulan*($cbulan_lalu - $cbln));
                        $bln_ini =$row->akum_penyusutan_bulan + $bln_lalu;
                        $penyusutan_bulan = $row->akum_penyusutan_bulan;
                    }else{   
                        $bln_lalu= $row->tot_bln_belum;                 
                        $bln_ini = $row->nil_bulan_ini;                        
                        $penyusutan_bulan = $row->penyusutan_bulan;
                    }

                     $tot_buku  = $row->nilai-$bln_ini;
                     $bln       = strtoupper($this->getBulan($row->bln));
                     $nilai     = $nilai+$row->nilai;
                     $nilai2    = $nilai2+$bln_ini;
                     $nilai3    = $nilai3+$penyusutan_bulan;
                     $nilai4    = $nilai4+$bln_ini;
                     $nilai5    = $nilai5+$tot_buku;
                     $i++;
                     $cRet .="
                     <tr>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                        <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                        <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                        <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row->tahun</td>
                        <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur_bulan</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->bulan_lalu</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                        </tr>";
                }
            }else{
                $csql="SELECT a.kd_brg AS kode,b.nm_brg,'' as merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),a.nilai/a.masa_manfaat)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE $where AND kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun' 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                
             if($row->masa_manfaat_baru<>null){
                $susut_per_tahun = $row->ada3_susut_per_thn;
                //$susut_thn_lalu = $row->ada2_akm_thn_lalu+$row->ada3_susut_per_thn;
                $susut_thn_lalu = $row->ada2_akm_thn_lalu;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;//$row->ada_akum_susut_sd_thn_ini;
                $umur = $row->masa_manfaat_baru;
                $nb = $row->nilai - $susut_thn_ini;
            }else{
                $susut_per_tahun = $row->penyusutan_pertahun;
                $susut_thn_lalu = $row->tot_th_belum;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;//$row->nil_th_ini;
                $umur = $row->umur;
                $nb = $row->nilai - $susut_thn_ini;
            }
                
             
                
             
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$susut_thn_lalu;
             $nilai3    = $nilai3+$susut_per_tahun;
             $nilai4    = $nilai4+$susut_thn_ini;
             $nilai5    = $nilai5+$nb;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_per_tahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nb,2,',','.')."</td>
                    </tr>";
             }
            }

                $cRet .="
                 <tr>
                    <td bgcolor=\"#e8e8e8\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5,2,',','.')."</td>
                    </tr>
                </table>"; 
                /*$csql = "SELECT a.kd_brg AS kode,b.nm_brg,'' as merek,a.tahun,a.nilai,TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,a.tahun,

                        (CASE WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                         AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)
                        
                        WHERE kd_barang<>'' AND a.tahun BETWEEN '$tahun1' AND '$tahun' AND $where
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9') ORDER BY a.kd_brg,a.tahun";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                //$tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
                if($row->th_lalu!=$row->umur){
                    $tot_th_ini=$row->nil_th_ini;
                }else{
                    $tot_th_ini=$row->tot_th_belum+$row->penyusutan_pertahun;
                }
             $tot_buku = $row->nilai-$tot_th_ini;
             
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$row->tot_th_belum;
             $nilai3    = $nilai3+$row->penyusutan_pertahun;
             $nilai4    = $nilai4+$tot_th_ini;
             $nilai5    = $nilai5+$tot_buku;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->tot_th_belum,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->penyusutan_pertahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_th_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                    </tr>";
             }
            }
                 $cRet .="
                 <tr>
                    <td bgcolor=\"#e8e8e8\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5,2,',','.')."</td>
                    </tr>
                </table>";*/ 
         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\" ></td>
            </tr>
                
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">KEPALA $nmskpd<br><br><br><br><br><br></td>          
            </tr>
            
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">(<u> $namapa </u>)</td>
            </tr>
            <tr>
                <td width=\"35%\" ></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nippa</td>
            </tr>";
            
        $cRet .=       " </table>";
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        $this->template->set('title', 'CETAK PENYUSUTAN GEDUNG DAN BANGUNAN'); 
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        $judul  = 'CETAK PENYUSUTAN GEDUNG DAN BANGUNAN';  
        switch($pilih) {
        case 1;
             $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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

    function kibd_dh(){
       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
        $pilih      = $_REQUEST['pilih'];
        $tampil     = $_REQUEST['tampil'];
        $pilctk     = $_REQUEST['pilctk'];
        $blnthn     = $_REQUEST['blnthn'];
        if($blnthn=='01'){
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun'];
            $dcetak =$tahun."-".$bulan."-".'31';
            $last=date('Y-m-t',strtotime($dcetak));
            //$last = strftime($dcetak);//date('Y-m-t',strtotime());
            $periodbulan = strtoupper($this->getBulan($bulan));
        }else if($blnthn=='02'){
            $tahun1  = $_REQUEST['tahun1'];
            $tahun   = $_REQUEST['tahun2'];
            
        }else{
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun3'];
            $dcetak=$tahun."-".$bulan."-".'31';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));
        }

        if($pilctk=='1'){
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
        }else{
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
            $bidang     = $_REQUEST['bidang'];
            $nmbid      = $_REQUEST['nmbid'];
        }
            
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
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
        
        if($blnthn=='01' || $blnthn=='03'){
            $cRet .="
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>JALAN, IRIGASI, DAN JARINGAN<br>Per BULAN $periodbulan $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
        }else{
            $cRet .="
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>JALAN, IRIGASI, DAN JARINGAN<br>Per TAHUN $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
        }
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"10%\" >&ensp;&ensp;OPD</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $skpd  $nmskpd</B></td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"15%\" >&ensp;&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $bidang  $nmbid</B></td>
            </tr>";}
          $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:13px;\">: $nmkab</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            if($blnthn=='01' || $blnthn=='03'){
                
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$periodbulan $tahun</td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$tahun1 s.d $tahun </td>
            </tr>";
            }
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";

           if($blnthn=='01' || $blnthn=='03'){
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Ini</b></td>
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
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
    }else{
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
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
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
          }      
                $where='';
                if($pilctk=='1' || $pilctk=='3'){
                    $where="a.kd_skpd = '$skpd'";
                }else{
                    $where="a.kd_skpd = '$skpd' AND a.kd_unit='$bidang'";
                }
                 $nilai = 0;
                 $nilai2 = 0;
                 $nilai3 = 0;
                 $nilai4 = 0;
                 $nilai5 = 0;
                if($blnthn=='01'){
                //demansyah
                $csql="SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,''AS merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                        (TRIM(a.masa_manfaat*12)+((SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang)*12))
                        ,0)AS umur_bulan_baru,

                        (CASE WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(((a.nilai/TRIM(a.masa_manfaat*12))*MONTH(a.tgl_oleh)) AS DECIMAL (18,2)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN TRUNCATE(CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,9)),2)
                        END) AS lalu_pelihara,

                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)
                        AS bulan_lalu,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))
                        AS bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))>-12 
                        THEN TRUNCATE(CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,2)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))<=-12 
                        THEN 0
                        END) AS nil_bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END) AS akum_penyusutan_bulan,

                        (CASE
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap<'$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))
                        END)
                        AS akum_tot_bln_belum

                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE kd_barang<>'' AND tgl_oleh<='$last' AND $where 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
                {
                $cbln = $row->bln;
                $cbulan_lalu = $row->bulan_lalu;
                $cakum_penyusutan_bulan = $row->akum_penyusutan_bulan;
                $clalu_pelihara = $row->lalu_pelihara;

                    if($row->umur_bulan_baru<>0)
                    { 
                        $bln_lalu = $clalu_pelihara + ($cakum_penyusutan_bulan*($cbulan_lalu - $cbln));
                        $bln_ini =$row->akum_penyusutan_bulan + $bln_lalu;
                        $penyusutan_bulan = $row->akum_penyusutan_bulan;
                        $tot_buku  = $row->nilai-$bln_ini;
                    }else{   
                        $bln_lalu= $row->tot_bln_belum;                 
                        $bln_ini = $bln_lalu+$row->penyusutan_bulan;                        
                        $penyusutan_bulan = $row->penyusutan_bulan;
                        $tot_buku  = $row->nilai-$bln_ini;
                    }

                     
                     $bln       = strtoupper($this->getBulan($row->bln));
                     $nilai     = $nilai+$row->nilai;
                     $nilai2    = $nilai2+$bln_lalu;
                     $nilai3    = $nilai3+$penyusutan_bulan;
                     $nilai4    = $nilai4+$bln_ini;
                     $nilai5    = $nilai5+$tot_buku;
                     $i++;
                     $cRet .="
                     <tr>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                        <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                        <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                        <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row->tahun</td>
                        <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur_bulan</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->bulan_lalu</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                        </tr>";
                }
            }else if($blnthn=='02'){
                $csql="SELECT a.kd_brg AS kode,b.nm_brg,''as merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),a.nilai/a.masa_manfaat)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur_ori c ON c.kd_barang=right(a.kd_brg,5)
                        WHERE kd_barang<>'' AND a.tahun BETWEEN '$tahun1' AND '$tahun' 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                
             if($row->masa_manfaat_baru<>null){
                $susut_per_tahun = $row->ada3_susut_per_thn;
                //$susut_thn_lalu = $row->ada2_akm_thn_lalu+$row->ada3_susut_per_thn;
                $susut_thn_lalu = $row->ada2_akm_thn_lalu;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;//$row->ada_akum_susut_sd_thn_ini;
                $umur = $row->masa_manfaat_baru;
                $nb = $row->nilai - $susut_thn_ini;
            }else{
                $susut_per_tahun = $row->penyusutan_pertahun;
                $susut_thn_lalu = $row->tot_th_belum;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;//$row->nil_th_ini;
                $umur = $row->umur;
                $nb = $row->nilai - $susut_thn_ini;
            }
                
             
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$susut_thn_lalu;
             $nilai3    = $nilai3+$susut_per_tahun;
             $nilai4    = $nilai4+$susut_thn_ini;
             $nilai5    = $nilai5+$nb;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_per_tahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nb,2,',','.')."</td>
                    </tr>";
             }
            }else if($blnthn=='03')
            {
                //kib_d
                /*$csql="SELECT a.id_barang,a.kd_brg AS kode,
                    IF(a.tahun='2015',1,(2015-a.tahun+1)) AS th_lalu,

                    (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='2015' AND b.id_barang=a.id_barang))-(2015-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN 0 END)
                    AS penyusutan_pertahun,

                    IF(a.tahun='2015',0,(CASE 
                    WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))>1 THEN CAST((2015-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN a.nilai
                    END)) AS tot_th_belum

                    FROM trkib_d a
                    LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                    LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                    WHERE $where AND kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '1945' AND '2015' 
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')";
       
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
                {  
                    $cid_barang = $row->id_barang;
                    $cth_lalu = $row->th_lalu * 12;                
                    $susut_per_tahun = $row->penyusutan_pertahun;
                    $susut_thn_lalu = $row->tot_th_belum;
                    $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
             
                    $sql = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,'' AS merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                        (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))
                        ,0)AS umur_bulan_baru,

                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,
                        (SELECT (('$tahun'-YEAR(a.tgl_oleh)+1)*12) - (MONTH(a.tgl_reg)-'$bulan')) AS pake1, 

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12)-1)
                        AS bulan_lalu,

                        TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12))
                        AS bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>=0 
                        THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-'2015')*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan

                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE kd_barang<>'' AND a.tgl_reg<='$last' AND $where AND a.id_barang='$cid_barang' 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
                       
                     $hasil2 = $this->db->query($sql);                     
                     
                    foreach ($hasil2->result() as $row2)
                        {
                            $cpaket = $row2->pake;
                            if ($cpaket == NULL){
                            $cpake = $row2->pake1;
                            }else{
                            $cpake = $row2->pake;
                            }

                            $cbulan_pake_ini = $row2->bulan_lalu;
                            $cbulan_lalu = $cbulan_pake_ini + $cth_lalu;                            
                            
                            $cakum_penyusutan_bulan = $row2->akum_penyusutan_bulan;
                            $cpenyusutan_bulan = $row2->penyusutan_bulan;

                            $cumur_bulan_baru = $row2->umur_bulan_baru;
                            if($cumur_bulan_baru == 0){
                            $cumur_bulan = $row2->umur_bulan ;
                            }else{
                            $cumur_bulan = $row2->umur_bulan_baru ;
                            }

                            if($cbulan_lalu < $cumur_bulan){
                                if($cpake<=$cbulan_lalu)
                                { 
                                    $bln_lalu = ($cpake*$cpenyusutan_bulan)+($cakum_penyusutan_bulan*($cbulan_lalu-$cpake)) ;
                                    $bln_ini = $row2->akum_penyusutan_bulan + $bln_lalu;
                                    $penyusutan_bulan = $row2->akum_penyusutan_bulan;
                                }else{
                                    if($cumur_bulan>=$cbulan_lalu){
                                     $bln_lalu= $susut_thn_ini + $row2->tot_bln_belum ;    
                                    }else{
                                     $bln_lalu= $row2->tot_bln_belum ;    
                                    }                                                   
                                    $bln_ini = $row2->penyusutan_bulan + $bln_lalu;                        
                                    $penyusutan_bulan = $row2->penyusutan_bulan;
                                }
                            }else{
                                $bln_lalu= $row2->nilai ;
                                $bln_ini = 0 + $bln_lalu;
                                $penyusutan_bulan = 0;

                            }

                             $tot_buku  = $row2->nilai-$bln_ini;
                             $bln       = strtoupper($this->getBulan($row2->bln));
                             $nilai     = $nilai+$row2->nilai;
                             $nilai2    = $nilai2+$bln_ini;
                             $nilai3    = $nilai3+$penyusutan_bulan;
                             $nilai4    = $nilai4+$bln_ini;
                             $nilai5    = $nilai5+$tot_buku;
                             $i++;
                             $cRet .="
                             <tr>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->kode</td>
                                <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row2->nm_brg</td>
                                <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->merek</td>
                                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row2->tahun</td>
                                <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row2->nilai,2,',','.')."</td>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$cumur_bulan</td>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$cbulan_lalu</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                                </tr>";
                        }
                }*/
                $csql="SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,''as merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),a.nilai/a.masa_manfaat)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        
                        WHERE $where AND a.tahun BETWEEN '1945' AND '2015' 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $rowd)
             {
                
             if($rowd->masa_manfaat_baru<>null){
                $susut_per_tahun = $rowd->ada3_susut_per_thn;
                //$susut_thn_lalu = $row->ada2_akm_thn_lalu+$row->ada3_susut_per_thn;
                $susut_thn_lalu = $rowd->ada2_akm_thn_lalu;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;//$rowd->ada_akum_susut_sd_thn_ini;
                $umur = $rowd->masa_manfaat_baru*12;
                $nb = $rowd->nilai - $susut_thn_ini;
            }else{
                $susut_per_tahun = $rowd->penyusutan_pertahun;
                $susut_thn_lalu = $rowd->tot_th_belum;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;//$row->nil_th_ini;
                $umur = $rowd->umur*12;
                $nb = $rowd->nilai - $susut_thn_ini;
            }
                
             $th_lalu = $rowd->th_lalu*12;
             $bln       = strtoupper($this->getBulan($rowd->bln));
             $nilai     = $nilai+$rowd->nilai;
             $nilai2    = $nilai2+$susut_thn_lalu;
             $nilai3    = $nilai3+$susut_per_tahun;
             $nilai4    = $nilai4+$susut_thn_ini;
             $nilai5    = $nilai5+$nb;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$rowd->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$rowd->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$rowd->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $rowd->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($rowd->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_per_tahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nb,2,',','.')."</td>
                    </tr>";
             }
                //awal thn jalan
                $csql_ini="SELECT a.id_barang,a.kd_brg AS kode,
                    IF(a.tahun='$tahun',1,('$tahun'-a.tahun+1)) AS th_lalu,                    
                    IF(a.tahun='$tahun',0,(CASE 
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))>1 THEN CAST(('$tahun'-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN a.nilai
                    END)) AS tot_th_belum, 
                    (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang))-('$tahun'-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN 0 END)
                    AS penyusutan_pertahun
                    FROM trkib_d a
                    LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                    

                    WHERE $where 
                    AND a.tgl_oleh BETWEEN '2016-1-01' AND '$last'
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')ORDER BY a.kd_brg,a.tahun,a.no_reg";
       
             $hasil_ini = $this->db->query($csql_ini);
             
             foreach ($hasil_ini->result() as $row)
                {  
                    $cid_barang_d = $row->id_barang;
                    $cth_lalu_d = $row->th_lalu * 12;                
                    $susut_per_tahun_d = $row->penyusutan_pertahun;
                    $susut_thn_lalu_d = $row->tot_th_belum;
                    $susut_thn_ini_d = $susut_thn_lalu_d+$susut_per_tahun_d;
             
                    $sql_ini = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,''as merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap BETWEEN '2016-1-01' AND '$last' GROUP BY id_barang),
                        (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang))
                        ,0)AS umur_bulan_baru,

                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                        (SELECT (('$tahun'-YEAR(a.tgl_oleh))*12) - (MONTH(a.tgl_oleh)-'$bulan')+1) AS pake1, 

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'$tahun')*12))
                        AS bulan_lalu,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12))>=0 
                        THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-'$tahun')*12))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan

                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        

                        WHERE a.tgl_oleh BETWEEN '2016-1-01' AND '$last' AND $where
                         AND a.id_barang='$cid_barang_d'
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
                       
                     $hasil2_ini = $this->db->query($sql_ini);                     
                     
                    foreach ($hasil2_ini->result() as $row2)
                        {
                            $cpaket_d = $row2->pake;
                            if ($cpaket_d == NULL){
                            $cpake_d = $row2->pake1;
                            }else{
                            $cpake_d = $row2->pake;
                            }

                            $cbulan_pake_ini_d = $row2->bulan_lalu;
                            $cbulan_lalu_d = $cbulan_pake_ini_d;                            
                            
                            $cakum_penyusutan_bulan_d = $row2->akum_penyusutan_bulan;
                            $cpenyusutan_bulan_d = $row2->penyusutan_bulan;

                            $cumur_bulan_baru_d = $row2->umur_bulan_baru;
                            if($cumur_bulan_baru_d == 0){
                            $cumur_bulan_d = $row2->umur_bulan ;
                            }else{
                            $cumur_bulan_d = $row2->umur_bulan_baru ;
                            }

                            /*if($cbulan_lalu_d < $cumur_bulan_d){
                                if($cpake_d<=$cbulan_lalu_d)
                                { 
                                    $bln_lalu_d = ($cpake_d*$cpenyusutan_bulan_d)+($cakum_penyusutan_bulan_d*($cbulan_lalu_d-$cpake_d)) ;
                                    $bln_ini_d = $row2->akum_penyusutan_bulan + $bln_lalu_d;
                                    $penyusutan_bulan_d = $row2->akum_penyusutan_bulan;
                                }else{
                                    $bln_lalu_d= $row2->tot_bln_belum ;
                                    $bln_ini_d = $row2->penyusutan_bulan + $bln_lalu_d;                        
                                    $penyusutan_bulan_d = $row2->penyusutan_bulan;
                                }
                            }else{
                                $bln_lalu_d= $row2->nilai ;
                                $bln_ini_d = 0 + $bln_lalu_d;
                                $penyusutan_bulan_d = 0;

                            }*/
                            if($cbulan_lalu_d < $cumur_bulan_d){
                                if($cpake_d<=$cbulan_lalu_d)
                                { 
                                    $bln_lalu_d = ($cpake_d*$cpenyusutan_bulan_d)+($cakum_penyusutan_bulan_d*($cbulan_lalu_d-$cpake_d)) ;
                                    $bln_ini_d = $row2->akum_penyusutan_bulan + $bln_lalu_d;
                                    $penyusutan_bulan_d = $row2->akum_penyusutan_bulan;
                                }else{
                                    $bln_lalu_d= $row2->tot_bln_belum ;                                                   
                                     //kondisi untuk bulan penutupan,agar tidak ada sisa nilai buku koma                       
                                    if($cumur_bulan_d==($cbulan_lalu_d+1)){
                                        $penyusutan_bulan_d = $row2->nilai-$row2->tot_bln_belum;
                                        $bln_ini_d = $penyusutan_bulan_d + $bln_lalu_d;
                                    }else{
                                        $penyusutan_bulan_d = $row2->penyusutan_bulan;
                                        $bln_ini_d = $row2->penyusutan_bulan + $bln_lalu_d;
                                    }

                                }
                            }else{
                                $bln_lalu_d= $row2->nilai ;
                                $bln_ini_c = 0 + $bln_lalu_d;
                                $penyusutan_bulan_c = 0;

                            }

                             $tot_buku_d  = $row2->nilai-$bln_ini_d;
                             $bln_d       = strtoupper($this->getBulan($row2->bln));
                             $nilai     = $nilai+$row2->nilai;
                             $nilai2    = $nilai2+$bln_lalu_d;
                             $nilai3    = $nilai3+$penyusutan_bulan_d;
                             $nilai4    = $nilai4+$bln_ini_d;
                             $nilai5    = $nilai5+$tot_buku_d;
                             $i++;
                             $cRet .="
                             <tr>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->kode</td>
                                <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row2->nm_brg</td>
                                <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row2->merek</td>
                                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln_d &nbsp; $row2->tahun</td>
                                <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row2->nilai,2,',','.')."</td>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$cumur_bulan_d</td>
                                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$cbulan_lalu_d</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu_d,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan_d,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini_d,2,',','.')."</td>
                                <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku_d,2,',','.')."</td>
                                </tr>";
                        }
                }
                //akhir thn jalan

            }

                $cRet .="
                 <tr>
                    <td bgcolor=\"#e8e8e8\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"><b>TOTAL NILAI</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai2,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai3,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai4,2,',','.')."</b></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai5,2,',','.')."</b></td>
                    </tr>
                </table>"; 
                
         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\" ></td>
            </tr>
                
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">KEPALA $nmskpd<br><br><br><br><br><br></td>          
            </tr>
            
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">(<u> $namapa </u>)</td>
            </tr>
            <tr>
                <td width=\"35%\" ></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nippa</td>
            </tr>";
            
        $cRet .=       " </table>";
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        $this->template->set('title', 'CETAK PENYUSUTAN JALAN DAN IRIGASI'); 
        $judul  = 'CETAK PENYUSUTAN JALAN DAN IRIGASI'; 
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd); 
        switch($pilih) {
        case 1;
             $this->mlap->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul $skpd $test.xls");
            $this->load->view('transaksi/excel', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
           $this->load->view('transaksi/excel', $data);
        break;
        case 4;     
            echo $cRet;
        break;
                }   
          
    }

    function kibd_dh2(){
       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
        $pilih      = $_REQUEST['pilih'];
        $tampil     = $_REQUEST['tampil'];
        $pilctk     = $_REQUEST['pilctk'];
        $blnthn     = $_REQUEST['blnthn'];
        if($blnthn=='01'){
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun'];
            $dcetak=$tahun."-".$bulan."-".'01';
            $last=date('Y-m-t',strtotime($dcetak));
            //$last = strftime($dcetak);//date('Y-m-t',strtotime());
            $periodbulan = strtoupper($this->getBulan($bulan));
        }else{
            $tahun1  = $_REQUEST['tahun1'];
            $tahun   = $_REQUEST['tahun2'];
            
        }

        if($pilctk=='1'){
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
        }else{
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
            $bidang     = $_REQUEST['bidang'];
            $nmbid      = $_REQUEST['nmbid'];
        }
            
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
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
        
        if($blnthn=='01'){
            $cRet .="
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>JALAN, IRIGASI, DAN JARINGAN<br>Per BULAN $periodbulan $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
        }else{
            $cRet .="
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>JALAN, IRIGASI, DAN JARINGAN<br>Per TAHUN $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
        }
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
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:13px;\">: $nmkab</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            if($blnthn=='01'){
                
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$periodbulan $tahun</td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$tahun1 s.d $tahun </td>
            </tr>";
            }
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";

           if($blnthn=='01'){
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Ini</b></td>
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
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
    }else{
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
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
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
          }      
                $where='';
                if($pilctk=='1' || $pilctk=='3'){
                    $where="a.kd_skpd = '$skpd'";
                }else{
                    $where="a.kd_skpd = '$skpd' AND a.kd_unit='$bidang'";
                }
                 $nilai = 0;
                 $nilai2 = 0;
                 $nilai3 = 0;
                 $nilai4 = 0;
                 $nilai5 = 0;
                if($blnthn=='01'){
                //demansyah
                $csql="SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,''AS merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                        (TRIM(a.masa_manfaat*12)+((SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang)*12))
                        ,0)AS umur_bulan_baru,

                        (CASE WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(((a.nilai/TRIM(a.masa_manfaat*12))*MONTH(a.tgl_oleh)) AS DECIMAL (18,2)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN TRUNCATE(CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,9)),2)
                        END) AS lalu_pelihara,

                        IF(a.tahun='$tahun',1,(2016-a.tahun+1)) AS th_lalu,2016 AS th_ini,

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)
                        AS bulan_lalu,

                        TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))
                        AS bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))>-12 
                        THEN TRUNCATE(CAST((TRIM('$bulan'+1-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,2)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun'+1)-YEAR(a.tgl_oleh))*12)))<=-12 
                        THEN 0
                        END) AS nil_bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>-12 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh))*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<=-12 THEN 0 END) AS akum_penyusutan_bulan,

                        (CASE
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>-12 
                        THEN TRUNCATE(CAST(TRIM('$bulan'+1-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<=-12 
                        THEN CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap<'$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))
                        END)
                        AS akum_tot_bln_belum

                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE kd_barang<>'' AND tgl_oleh<='$last' AND $where 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
                {
                $cbln = $row->bln;
                $cbulan_lalu = $row->bulan_lalu;
                $cakum_penyusutan_bulan = $row->akum_penyusutan_bulan;
                $clalu_pelihara = $row->lalu_pelihara;

                    if($row->umur_bulan_baru<>0)
                    { 
                        $bln_lalu = $clalu_pelihara + ($cakum_penyusutan_bulan*($cbulan_lalu - $cbln));
                        $bln_ini =$row->akum_penyusutan_bulan + $bln_lalu;
                        $penyusutan_bulan = $row->akum_penyusutan_bulan;
                        $tot_buku  = $row->nilai-$bln_ini;
                    }else{   
                        $bln_lalu= $row->tot_bln_belum;                 
                        $bln_ini = $bln_lalu+$row->penyusutan_bulan;                        
                        $penyusutan_bulan = $row->penyusutan_bulan;
                        $tot_buku  = $row->nilai-$bln_ini;
                    }

                     
                     $bln       = strtoupper($this->getBulan($row->bln));
                     $nilai     = $nilai+$row->nilai;
                     $nilai2    = $nilai2+$bln_lalu;
                     $nilai3    = $nilai3+$penyusutan_bulan;
                     $nilai4    = $nilai4+$bln_ini;
                     $nilai5    = $nilai5+$tot_buku;
                     $i++;
                     $cRet .="
                     <tr>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                        <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                        <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                        <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                        <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row->tahun</td>
                        <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur_bulan</td>
                        <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->bulan_lalu</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini,2,',','.')."</td>
                        <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                        </tr>";
                }
            }else{
                $csql="SELECT a.kd_brg AS kode,b.nm_brg,''as merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),a.nilai/a.masa_manfaat)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE $where AND kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun' 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                
             if($row->masa_manfaat_baru<>null){
                $susut_per_tahun = $row->ada3_susut_per_thn;
                //$susut_thn_lalu = $row->ada2_akm_thn_lalu+$row->ada3_susut_per_thn;
                $susut_thn_lalu = $row->ada2_akm_thn_lalu;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;//$row->ada_akum_susut_sd_thn_ini;
                $umur = $row->masa_manfaat_baru;
                $nb = $row->nilai - $susut_thn_ini;
            }else{
                $susut_per_tahun = $row->penyusutan_pertahun;
                $susut_thn_lalu = $row->tot_th_belum;
                $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;//$row->nil_th_ini;
                $umur = $row->umur;
                $nb = $row->nilai - $susut_thn_ini;
            }
                
             
                
             
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$susut_thn_lalu;
             $nilai3    = $nilai3+$susut_per_tahun;
             $nilai4    = $nilai4+$susut_thn_ini;
             $nilai5    = $nilai5+$nb;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_per_tahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($susut_thn_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nb,2,',','.')."</td>
                    </tr>";
             }
            }

                $cRet .="
                 <tr>
                    <td bgcolor=\"#e8e8e8\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5,2,',','.')."</td>
                    </tr>
                </table>"; 
                /*$csql = "SELECT a.kd_brg AS kode,b.nm_brg,'' as merek,a.tahun,a.nilai,TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,a.tahun,

                        (CASE WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                         AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)
                        
                        WHERE kd_barang<>'' AND a.tahun BETWEEN '$tahun1' AND '$tahun' AND $where
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9') ORDER BY a.kd_brg,a.tahun";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                //$tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
                if($row->th_lalu!=$row->umur){
                    $tot_th_ini=$row->nil_th_ini;
                }else{
                    $tot_th_ini=$row->tot_th_belum+$row->penyusutan_pertahun;
                }
             $tot_buku = $row->nilai-$tot_th_ini;
             
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$row->tot_th_belum;
             $nilai3    = $nilai3+$row->penyusutan_pertahun;
             $nilai4    = $nilai4+$tot_th_ini;
             $nilai5    = $nilai5+$tot_buku;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->tot_th_belum,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->penyusutan_pertahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_th_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                    </tr>";
             }
        }
                 $cRet .="
                 <tr>
                    <td bgcolor=\"#e8e8e8\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5,2,',','.')."</td>
                    </tr>
                </table>";*/ 
         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\" ></td>
            </tr>
                
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">KEPALA $nmskpd<br><br><br><br><br><br></td>          
            </tr>
            
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">(<u> $namapa </u>)</td>
            </tr>
            <tr>
                <td width=\"35%\" ></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nippa</td>
            </tr>";
            
        $cRet .=       " </table>";
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        $this->template->set('title', 'CETAK PENYUSUTAN JALAN DAN IRIGASI'); 
        $judul  = 'CETAK PENYUSUTAN JALAN DAN IRIGASI'; 
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd); 
        switch($pilih) {
        case 1;
             $this->mlap->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul $skpd $test.xls");
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

    function kibe_dh(){
       
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $kota       = strtoupper($konfig['kota']);
        $logo       = $konfig['logo'];
        $thn        = $this->session->userdata('ta_simbakda');
        $unit_skpd  = $this->session->userdata('unit_skpd');
        $pilih      = $_REQUEST['pilih'];
        $tampil     = $_REQUEST['tampil'];
        $pilctk     = $_REQUEST['pilctk'];
        $blnthn     = $_REQUEST['blnthn'];
        if($blnthn=='01'){
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun'];
            $dcetak=$tahun."-".$bulan."-".'01';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));
        }else{
            $tahun1  = $_REQUEST['tahun1'];
            $tahun   = $_REQUEST['tahun2'];
            
        }

        if($pilctk=='1'){
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
        }else{
            $skpd       = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];
            $bidang     = $_REQUEST['bidang'];
            $nmbid      = $_REQUEST['nmbid'];
        }
            
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
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
        if($blnthn=='01'){
            $cRet .="
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>ASET TETAP LAINNYA<br>Per BULAN $periodbulan $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
        }else{
            $cRet .="
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>DAFTAR PENYUSUTAN ASET TETAP <br>ASET TETAP LAINNYA<br>Per TAHUN $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
        }
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
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:13px;\">: $nmkab</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            if($blnthn=='01'){
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$periodbulan $tahun </td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">:$tahun1 s.d $tahun </td>
            </tr>";
            }
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";
        if($blnthn=='01'){
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Bulan Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Bulan Ini</b></td>
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
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
            }else{
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA BARANG</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>MERK/TIPE</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>TAHUN PEROLEHAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                    <td colspan=\"5\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                    <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
                </tr>
                <tr>    
                    <!--td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Nilai Residu</b></td-->
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Lalu</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
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
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">11 = 9 + 10</td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">12 = 6 - 11</td>
                    
                 </tr>
            </thead>
            <tfoot>
                        <tr>
                            <td colspan=\"12\" style=\"border:solid 1px white; border-top:solid 1px black;\"></td>
                        </tr>
                    </tfoot>
                ";
            }    
                $where='';
                if($pilctk=='1' || $pilctk=='3'){
                    $where="a.kd_skpd = '$skpd'";
                }else{
                    $where="a.kd_skpd = '$skpd' AND a.kd_unit='$bidang'";
                }
                 $nilai = 0;
                 $nilai2 = 0;
                 $nilai3 = 0;
                 $nilai4 = 0;
                 $nilai5 = 0;
                if($blnthn=='01'){
                //demansyah
                $csql = "SELECT MONTH(a.tgl_peroleh)as bln,a.kd_brg AS kode,b.nm_brg,''as merek,a.tahun,a.nilai,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,a.tahun,

                        TRIM('$bulan'+1-MONTH(a.tgl_peroleh)+((('$tahun')-YEAR(a.tgl_peroleh))*12)-1)
                        AS bulan_lalu,

                        TRIM('$bulan'+1-MONTH(a.tgl_peroleh)+(('$tahun'-YEAR(a.tgl_peroleh))*12))
                        AS bulan_ini,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_peroleh)+(('$tahun'-YEAR(a.tgl_peroleh))*12))))>=1 THEN CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9))
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_peroleh)+(('$tahun'-YEAR(a.tgl_peroleh))*12))))=0 THEN a.nilai
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_peroleh)+(('$tahun'-YEAR(a.tgl_peroleh))*12))))<1 THEN a.nilai END)AS penyusutan_bulan,
                        (CASE 
                                WHEN TRIM('$bulan'-MONTH(a.tgl_peroleh)+(('$tahun'-YEAR(a.tgl_peroleh))*12))=1 
                                    THEN CAST((a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'+1-MONTH(a.tgl_peroleh)+((('$tahun')-YEAR(a.tgl_peroleh))*12)-1)>1 
                                    THEN CAST(TRIM('$bulan'+1-MONTH(a.tgl_peroleh)+((('$tahun')-YEAR(a.tgl_peroleh))*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_peroleh)+(('$tahun'-YEAR(a.tgl_peroleh))*12))<1 
                                    THEN a.nilai
                            END)
                         AS tot_bln_belum,
                         
                        (CASE 
                                WHEN (TRIM('$bulan'-MONTH(a.tgl_peroleh)+((('$tahun'+1)-YEAR(a.tgl_peroleh))*12)))=1 
                                    THEN CAST((TRIM('$bulan'+1-MONTH(a.tgl_peroleh)+(('$tahun'-YEAR(a.tgl_peroleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_peroleh)+((('$tahun'+1)-YEAR(a.tgl_peroleh))*12)))>1 
                                    THEN CAST((TRIM('$bulan'+1-MONTH(a.tgl_peroleh)+(('$tahun'-YEAR(a.tgl_peroleh))*12)))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9))
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_peroleh)+((('$tahun'+1)-YEAR(a.tgl_peroleh))*12)))<1 
                                    THEN a.nilai
                        END) AS nil_bulan_ini
                        FROM trkib_e a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)
                        WHERE kd_barang<>'' AND a.tgl_peroleh<='$last' AND $where
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun ";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                //$tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
                if($row->umur_bulan>=$row->bulan_ini){
                    $bln_ini =$row->bulan_ini*$row->penyusutan_bulan;
                    $bln_lalu=$row->bulan_lalu*$row->penyusutan_bulan;
                    $tot_bln_ini = $bln_ini+$bln_lalu;
                    $penyusutan_bulan = $row->penyusutan_bulan;
                }else{
                    $penyusutan_bulan = 0;
                    $bln_ini = $row->nilai;
                    $bln_lalu= $row->nilai;
                    $tot_bln_ini=$row->tot_bln_belum+$row->penyusutan_bulan;
                }
             $tot_buku  = $row->nilai-$bln_ini;
             $bln       = strtoupper($this->getBulan($row->bln));
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$row->tot_bln_belum;
             $nilai3    = $nilai3+$row->penyusutan_bulan;
             $nilai4    = $nilai4+$tot_bln_ini;
             $nilai5    = $nilai5+$tot_buku;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$bln &nbsp; $row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur_bulan</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->bulan_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_lalu,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($penyusutan_bulan,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($bln_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                    </tr>";
             }
            }else{
                $csql = "SELECT a.kd_brg AS kode,b.nm_brg,'' as merek,a.tahun,a.nilai,TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,a.tahun,

                        (CASE WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                         AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_e a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)
                        
                        WHERE kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun' AND $where
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$tahun') ORDER BY a.kd_brg,a.tahun";
               
             $hasil = $this->db->query($csql);
             $i = 0;
             
             foreach ($hasil->result() as $row)
             {
                //$tot_th_ini = $row->tot_th_belum+$row->nil_th_ini;
                if($row->th_lalu!=$row->umur){
                    $tot_th_ini=$row->nil_th_ini;
                }else{
                    $tot_th_ini=$row->tot_th_belum+$row->penyusutan_pertahun;
                }
             $tot_buku = $row->nilai-$tot_th_ini;
             
             $nilai     = $nilai+$row->nilai;
             $nilai2    = $nilai2+$row->tot_th_belum;
             $nilai3    = $nilai3+$row->penyusutan_pertahun;
             $nilai4    = $nilai4+$tot_th_ini;
             $nilai5    = $nilai5+$tot_buku;
             $i++;
             $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai,2,',','.')."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->th_lalu</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->tot_th_belum,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->penyusutan_pertahun,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_th_ini,2,',','.')."</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku,2,',','.')."</td>
                    </tr>";
             }
        }
                 $cRet .="
                 <tr>
                    <td bgcolor=\"#e8e8e8\" colspan=\"5\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">TOTAL NILAI</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4,2,',','.')."</td>
                    <td bgcolor=\"#e8e8e8\" align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai5,2,',','.')."</td>
                    </tr>
                </table>"; 
         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\" ></td>
            </tr>
                
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">KEPALA $nmskpd<br><br><br><br><br><br></td>          
            </tr>
            
            <tr>
                
                <td width=\"35%\" ></td>
                <td width=\"35%\" ></td>
                <td align=\"center\" style=\"font-size:11px\">(<u> $namapa </u>)</td>
            </tr>
            <tr>
                <td width=\"35%\" ></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nippa</td>
            </tr>";
            
        $cRet .=       " </table>";
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        $this->template->set('title', 'CETAK PENYUSUTAN ASET TETAP LAINNYA'); 
        $judul  = 'CETAK PENYUSUTAN ASET TETAP LAINNYA'; 
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd); 
        switch($pilih) {
        case 1;
             $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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
	function kibb(){
	$this->mlap->kibb();
	}

	function penyusutan_kibc()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK DAFTAR PENYUSUTAN KIB C';
        $this->template->set('title', 'DAFTAR PENYUSUTAN KIB C');   
        $this->template->load('index','kebijakan/kibc_dh',$data) ;
        } 
    }	
	
	function kibc(){
	$this->mlap->kibc();
	}

	function penyusutan_kibd()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK DAFTAR PENYUSUTAN KIB D';
        $this->template->set('title', 'DAFTAR PENYUSUTAN KIB D');   
        $this->template->load('index','kebijakan/kibd_dh',$data) ;
        } 
    }	
	
	function kibd(){
	$this->mlap->kibd();
	}	
	
	function penyusutan_kibe()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK DAFTAR PENYUSUTAN KIB E';
        $this->template->set('title', 'DAFTAR PENYUSUTAN KIB E');   
        $this->template->load('index','kebijakan/kibe_dh',$data) ;
        } 
    }	
	
	function kibe(){
	$this->mlap->kibe();
	}
	
	function penyusutan_rekap()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK REKAP DAFTAR PENYUSUTAN';
        $this->template->set('title', 'DAFTAR REKAP PENYUSUTAN');   
        $this->template->load('index','kebijakan/kib_rekap',$data) ;
        } 
    }		
	
	function penyusutan_rekap_all()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK REKAP DAFTAR PENYUSUTAN';
        $this->template->set('title', 'DAFTAR REKAP PENYUSUTAN');   
        $this->template->load('index','kebijakan/kib_rekap_all',$data) ;
        } 
    }	
	
	function penyusutan_akumulasi()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK REKAP DAFTAR AKUMULASI PENYUSUTAN';
        $this->template->set('title', 'DAFTAR REKAP AKUMULASI PENYUSUTAN');   
        $this->template->load('index','kebijakan/kib_akumulasi',$data) ;
        } 
    }	
	
		function penyusutan_rekap_skpd()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK REKAP DAFTAR PENYUSUTAN';
        $this->template->set('title', 'DAFTAR REKAP PENYUSUTAN');   
        $this->template->load('index','kebijakan/kib_rekap_skpd',$data) ;
        } 
    }
	
	public function rekap_kib_penyusutan()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$oto		= $this->session->userdata('otori');
		$thn  = $this->session->userdata('ta_simbakda');
        $konfig   	= $this->ambil_config();
		$kota  	  	= strtoupper($konfig['kota']);
		$nm_client  = strtoupper($konfig['nm_client']);
        $kdbid 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lctgl 		= $_REQUEST['tgl'];
        $lctgl_akhir = $_REQUEST['tgl_akhir'];
        $tahun_ini	= $_REQUEST['tahun_ini'];
        $kib 		= $_REQUEST['kib'];
        $nmkib 		= $_REQUEST['nmkib'];
        $jenis 		= $_REQUEST['jenis'];
        $nmjenis	= $_REQUEST['nmjenis'];
        $trkib		= $_REQUEST['trkib'];
        $tahun		= $_REQUEST['ctahun'];
        $iz 	  	= $_REQUEST['fa'];
		$nilai_eca	= "";
		if($trkib=='trkib_b'){
			$nilai_eca	= "and (nilai>=500000 or kd_riwayat='9')";
		}elseif($trkib=='trkib_c'){
			$nilai_eca	= "and (nilai>=10000000 or kd_riwayat='9')";
		}elseif($trkib=='trkib_d'){
			$nilai_eca	= "and (nilai>=10000000 or kd_riwayat='9')";
		}else{
			$nilai_eca	= "and (nilai>=500000 or kd_riwayat='9')";
		}
		
		
		$ckdskpd		="";
		if($kdbid<>''){
			$ckdskpd		="AND kd_skpd='$kdbid'";
		}
		$ctrkib		="";
		if($trkib<>''){
			$ctrkib		="$trkib";
		}
		$cjenis		="";
		if($jenis<>''){
			$cjenis		="AND LEFT(a.kd_brg,8)='$jenis'";
		}
		
		
		
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
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>REKAPITULASI PENYUSUTAN ASET TETAP</b></td>
            </tr>";
			if($kib<>''){
            $cRet .= " <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>".strtoupper($nmkib)."<br>Per TAHUN $tahun</b></td>
            </tr>";}
			if($jenis<>''){
            $cRet .= " <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>( ".strtoupper($nmjenis)." )</b></td>
            </tr>";}
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
			if($kdbid<>''){
            $cRet .= "<tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<b> $kdbid - $cnm_skpd </b></td>
            </tr>";
			}
            $cRet .= "<tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
        <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE JENIS/BARANG</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA JENIS/BARANG</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                <td colspan=\"4\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
			</tr>
			<tr>	
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Masa Manfaat</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7=5 + 6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8=4 - 7</td>
            </tr>
			</thead> ";
             if($jenis==''){
$csql = "SELECT kode,nama,umur,SUM(nilai) AS tot,SUM(tot_th_belum) AS a
,SUM(nil_th_ini) AS b
FROM (

SELECT c.kd_barang AS kode,c.nama,TRIM(c.umur) AS umur,a.nilai,
a.kd_brg,b.nm_brg,a.tahun,
if(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
END)) AS tot_th_belum, 

if(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
END)) AS nil_th_ini


FROM $ctrkib a
LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
WHERE kd_barang<>'' 
AND kd_skpd='$kdbid' AND tgl_reg<='$tahun-12-31' 
and kondisi<>'RB' and milik='12' $nilai_eca ORDER BY a.kd_brg,a.tahun

) aa GROUP BY kode";
             $hasil = $this->db->query($csql);
             $i 	= 1;
			 $nilai	=0;
			 $nilai2=0;
			 $nilai3=0;
			 $nilai4=0;
			 $nilai5=0;
             foreach ($hasil->result() as $row){
			 $c		= $row->a+$row->b;
			 $d		= $row->tot-$c;
			 $nilai	=$nilai+$row->tot;
			 $nilai2=$nilai2+$row->a;
			 $nilai3=$nilai3+$row->b;
			 $nilai4=$nilai4+$c;
			 $nilai5=$nilai5+$d;
              $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kode</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nama</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->tot)."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->a)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->b)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($c)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($d)."</td>
				</tr>";
            $i++;
             }
			 }else{
$csql = "SELECT c.`kd_barang` AS kode,c.`nama`,TRIM(c.umur) AS umur,a.`nilai`,
a.kd_brg,b.nm_brg,a.tahun,

if(a.tahun='$tahun',0,($tahun-a.tahun-1)) AS th_lalu,
(TRIM(c.umur)-($tahun-a.tahun-1)) AS masa_penyu,
(a.nilai/TRIM(c.umur)) AS penyusutan_pertahun,

if(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
END)) AS tot_th_belum, 

if(a.tahun='$tahun',0,(CASE 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
END)) AS nil_th_ini

 
FROM $ctrkib a
LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
WHERE kd_barang<>'' $ckdskpd $cjenis AND tgl_reg<='$tahun-12-31' and kondisi<>'RB' and milik='12' $nilai_eca  ORDER BY kd_brg,tahun";
             $hasil = $this->db->query($csql);
             $i = 0;
			 $nilai=0;
			 $nilai2=0;
			 $nilai3=0;
			 $nilai4=0;
			 $nilai5=0;
             foreach ($hasil->result() as $row){
			 $tot_th_ini	= $row->tot_th_belum+$row->nil_th_ini;
			 $tot_buku		= $row->nilai-$tot_th_ini;
			 $nilai=$nilai+$row->nilai;
			 $nilai2=$nilai2+$row->tot_th_belum;
			 $nilai3=$nilai3+$row->nil_th_ini;
			 $nilai4=$nilai4+$tot_th_ini;
			 $nilai5=$nilai5+$tot_buku;
				 
            $i++;
              $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nilai)."</td>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$row->umur</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->tot_th_belum)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->nil_th_ini)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_th_ini)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($tot_buku)."</td>
				</tr>";
             } 
			 }
			 
			$cRet .="
                 <tr>
                    <td colspan=\"3\" bgcolor=\"#ADFF2F\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"><b>TOTAL NILAI</b></td>
                    <td align=\"right\" bgcolor=\"#ADFF2F\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai)."</b></td>
                    <td align=\"center\" bgcolor=\"#ADFF2F\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai2)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai3)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai4)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai5)."</b></td>
				</tr>";
			 
            $cRet.="</table>";
                
				if($oto<>'01'){
            $cRet .="
			<br>
			<br>

			<table style=\"border-collapse:collapse;\" width=\"40%\" align=\"right\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			     
                    <tr>
                        
                        <td colspan =\"4\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        Bantaeng, ".$this->tanggal_indonesia($lctgl).",<br>KEPALA $cnm_skpd<br>&nbsp;<br>&nbsp;<br>
                        <u>$nm_tahu</u><br>Nip. $nip_tahu  
                        </td>
				</tr>";}
					
				$cRet .=" </table>";
		$data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'CETAK PENYUSUTAN PERALATAN DAN MESIN'); 
        $judul  = 'CETAK PENYUSUTAN PERALATAN DAN MESIN';	     
		switch($iz) {
        case 1;        
			 $this->mdata->_mpdf3('',$cRet,10,10,10,2,$kertas,3);      
             //$this->_mpdf('',$cRet,10,10,10,'1');
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
	
		public function rekap_kib_penyusutan_all()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$oto		= $this->session->userdata('otori');
		$thn  		= $this->session->userdata('ta_simbakda');
        $konfig   	= $this->ambil_config();
		$kota  	  	= strtoupper($konfig['kota']);
		$nm_client  = strtoupper($konfig['nm_client']);
        $lctgl 		= $_REQUEST['tgl'];
        $lctgl_akhir = $_REQUEST['tgl_akhir'];
        $tahun_ini	= $_REQUEST['tahun_ini'];
        $kib 		= $_REQUEST['kib'];
        $nmkib 		= $_REQUEST['nmkib'];
        $trkib		= $_REQUEST['trkib'];
        $tahun		= $_REQUEST['ctahun'];
        $iz 	  	= $_REQUEST['fa'];
		$nilai_eca	= "";
		if($trkib=='trkib_b'){
			$nilai_eca	= "and (nilai>=500000 or kd_riwayat='9')";
		}elseif($trkib=='trkib_c'){
			$nilai_eca	= "and (nilai>=10000000 or kd_riwayat='9')";
		}elseif($trkib=='trkib_d'){
			$nilai_eca	= "and (nilai>=10000000 or kd_riwayat='9')";
		}else{
			$nilai_eca	= "and (nilai>=500000 or kd_riwayat='9')";
		}
	
		
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>REKAPITULASI PENYUSUTAN ASET TETAP SELURUH SKPD</b></td>
            </tr>";
			if($kib<>''){
            $cRet .= " <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>( ".strtoupper($nmkib)." )<br>Per TAHUN $tahun</b></td>
            </tr>";}
			
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten/Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
			
            $cRet .= "<tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
        <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KODE SKPD</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA SKPD</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI PEROLEHAN</b></td>
                <td colspan=\"3\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>PENYUSUTAN</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NILAI BUKU</b></td>
			</tr>
			<tr>	
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Sebelumnya</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Tahun Ini</b></td>
				<td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>Akumulasi s/d Tahun Ini</b></td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
				<td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7=5 + 6</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8=4 - 7</td>
            </tr>
			</thead> ";
			$csql1 	= "select kd_skpd,nm_skpd from ms_skpd where kd_skpd<>'1.20.01.00' and kd_skpd<>'1.20.02.00' and kd_skpd<>'1.20.23.00' order by kd_skpd";
$hasil1 	= $this->db->query($csql1);
$i 		= 1;
$tot_b	= 0;
$tot_c	= 0;
$tot_d	= 0;
$tot_e	= 0;
							 $nilai	=0;
							 $nilai2=0;
							 $nilai3=0;
							 $nilai4=0;
							 $nilai5=0;
foreach ($hasil1->result() as $row){
$skpd 	  	= $row->kd_skpd;
$nm_skpd 	= $row->nm_skpd;

					$csql = "SELECT SUM(nilai) AS tot,SUM(tot_th_belum) AS a
					,SUM(nil_th_ini) AS b
					FROM (

					SELECT c.kd_barang AS kode,c.nama,TRIM(c.umur) AS umur,a.nilai,
					a.kd_brg,b.nm_brg,a.tahun,
					if(a.tahun='$tahun',0,(CASE 
					WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
					WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
					WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
					END)) AS tot_th_belum, 

					if(a.tahun='$tahun',0,(CASE 
					WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
					WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
					WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
					END)) AS nil_th_ini


					FROM $trkib a
					LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
					LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
					WHERE kd_barang<>'' 
					AND kd_skpd='$skpd' AND tgl_reg<='$tahun-12-31' 
					and kondisi<>'RB' and milik='12' $nilai_eca

					) aa ";//GROUP BY kode
							 $hasil = $this->db->query($csql);
							 //$i 	= 1;
							 foreach ($hasil->result() as $row){
							 $c		= $row->a+$row->b;
							 $d		= $row->tot-$c;
							 $nilai	=$nilai+$row->tot;
							 $nilai2=$nilai2+$row->a;
							 $nilai3=$nilai3+$row->b;
							 $nilai4=$nilai4+$c;
							 $nilai5=$nilai5+$d;
              $cRet .="
                 <tr>
                    <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">$skpd</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$nm_skpd</td>
                    <td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->tot)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->a)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($row->b)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($c)."</td>
					<td align=\"right\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($d)."</td>
				</tr>";
		}
            
				$i++;
		}
			$cRet .="
                 <tr>
                    <td colspan=\"3\" bgcolor=\"#ADFF2F\" align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"><b>TOTAL NILAI</b></td>
                    <td align=\"right\" bgcolor=\"#ADFF2F\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai2)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai3)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai4)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($nilai5)."</b></td>
				</tr>";
				
		$cRet .=" </table>";
		//$cRet .=" </table>";
		$data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'CETAK PENYUSUTAN PERALATAN DAN MESIN'); 
        $judul  = 'CETAK PENYUSUTAN PERALATAN DAN MESIN';	     
		switch($iz) {
        case 1;        
			 $this->mdata->_mpdf3('',$cRet,10,10,10,2,$kertas,3);      
             //$this->_mpdf('',$cRet,10,10,10,'1');
			 //echo $cRet;
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

		public function rekap_kib_akumulasi(){
		if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$oto		= $this->session->userdata('otori');
		$thn  		= $this->session->userdata('ta_simbakda');
        $konfig   	= $this->ambil_config();
		$kota  	  	= strtoupper($konfig['kota']);
		$nm_client  = strtoupper($konfig['nm_client']);
        $lctgl 		= $_REQUEST['tgl'];
        $tahun		= $_REQUEST['ctahun'];
        $iz 	  	= $_REQUEST['fa'];
 	
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>REKAPITULASI AKUMULASI PENYUSUTAN ASET TETAP <br/> Per TAHUN $tahun</b></td>
            </tr>";
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
            $cRet .= "<tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
        <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA SKPD</b></td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KIB B</b></td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KIB C</b></td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KIB D</b></td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KIB E</b></td>
			</tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
			</thead> ";
					$csql 	= "select kd_skpd,nm_skpd from ms_skpd order by kd_skpd";
					$hasil 	= $this->db->query($csql);
					$i 		= 1;
					$tot_b	= 0;
					$tot_c	= 0;
					$tot_d	= 0;
					$tot_e	= 0;
					foreach ($hasil->result() as $row){
					$skpd 	  	= $row->kd_skpd;
					$nm_skpd 	= $row->nm_skpd;

			 	$sqdetail1=" 
				select sum(a.nilai) as nilai,sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
				END))) AS tot_th_belum, 

				sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
				END))) AS nil_th_ini

				FROM trkib_b a
				LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
				WHERE kd_barang<>'' AND kd_skpd='$skpd' AND tahun<='$tahun' and (nilai>=500000 or kd_riwayat='9') and kondisi<>'RB'"; 
				$hasil1   = $this->db->query($sqdetail1);
				foreach ($hasil1->result() as $row)
				{
					
					$nilai1   = $row->nil_th_ini+$row->tot_th_belum;
					$tot_b   = $tot_b+$nilai1;
				}
				
				$sqdetail2="select sum(a.nilai) as nilai,sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
				END))) AS tot_th_belum, 

				sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
				END))) AS nil_th_ini


							FROM trkib_c a
							LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
							WHERE kd_barang<>'' AND kd_skpd='$skpd' AND tahun<='$tahun' and (nilai>=10000000 or kd_riwayat='9') and kondisi<>'RB'"; 
				$hasil2   = $this->db->query($sqdetail2);
				foreach ($hasil2->result() as $row)
				{
					$nilai2   	= $row->nil_th_ini+$row->tot_th_belum;
					$tot_c   	= $tot_c+$nilai2;
				}
				
				$sqdetail3="select sum(a.nilai) as nilai,sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
				END))) AS tot_th_belum, 

				sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
				END))) AS nil_th_ini


							FROM trkib_d a
							LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
							WHERE kd_barang<>'' AND kd_skpd='$skpd' AND tahun<='$tahun' and (nilai>=10000000 or kd_riwayat='9') and kondisi<>'RB'"; 
				$hasil3   = $this->db->query($sqdetail3);
				foreach ($hasil3->result() as $row)
				{
					$nilai3   = $row->nil_th_ini+$row->tot_th_belum;
					$tot_d    = $tot_d+$nilai3;
				}
				
				$sqdetail4="select sum(a.nilai) as nilai,sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
				END))) AS tot_th_belum, 

				sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
				END))) AS nil_th_ini


							FROM trkib_e a
							LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
							WHERE kd_barang<>'' AND kd_skpd='$skpd' AND tahun<='$tahun' and (nilai>=500000 or kd_riwayat='9') and kondisi<>'RB'"; 
				$hasil4   = $this->db->query($sqdetail4);
				foreach ($hasil4->result() as $row)
				{
					$nilai4   = $row->nil_th_ini+$row->tot_th_belum;
					$tot_e    = $tot_e+$nilai4;
				}
			 			 
              $cRet .="
                 <tr>
                    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$nm_skpd</td>
                    <td align=\"right\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai1)."</td>
                    <td align=\"right\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2)."</td>
                    <td align=\"right\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3)."</td>
					<td align=\"right\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4)."</td>
				</tr>";
            $i++;
            
			 }
			 
			$cRet .="
                 <tr>
                    <td colspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" width =\"35%\" style=\"font-size:10px; font-family:tahoma;\"><b>TOTAL NILAI</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($tot_b)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($tot_c)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($tot_d)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($tot_e)."</b></td>
				</tr>";
			 
        $cRet.="</table>";
		$data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'CETAK PENYUSUTAN PER SKPD'); 
        $judul  = 'CETAK PENYUSUTAN PER SKPD';	     
		switch($iz) {
        case 1;        
			 $this->mdata->_mpdf3('',$cRet,10,10,10,2,$kertas,3);      
             //$this->_mpdf('',$cRet,10,10,10,'1');
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

	
	public function rekap_kib_penyusutan_skpd()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$oto		= $this->session->userdata('otori');
		$thn  		= $this->session->userdata('ta_simbakda');
        $konfig   	= $this->ambil_config();
		$kota  	  	= strtoupper($konfig['kota']);
		$nm_client  = strtoupper($konfig['nm_client']);
        $lctgl 		= $_REQUEST['tgl'];
        $tahun		= $_REQUEST['ctahun'];
        $iz 	  	= $_REQUEST['fa'];
						
 	
		$cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px; font-family:tahoma;\"><b>REKAPITULASI NILAI ASET TETAP BERSIH <br/> Per TAHUN $tahun</b></td>
            </tr>";
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td width =\"85%\" align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nm_client</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kabupaten</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
            $cRet .= "<tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
			
        <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NO</b></td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>NAMA SKPD</b></td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KIB B</b></td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KIB C</b></td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KIB D</b></td>
                <td align=\"center\" bgcolor=\"#ADFF2F\" style=\"font-size:10px; font-family:tahoma;\"><b>KIB E</b></td>
			</tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
			</thead> ";
$csql 	= "select kd_skpd,nm_skpd from ms_skpd order by kd_skpd";
$hasil 	= $this->db->query($csql);
$i 		= 1;
$tot_b	= 0;
$tot_c	= 0;
$tot_d	= 0;
$tot_e	= 0;
foreach ($hasil->result() as $row){
$skpd 	  	= $row->kd_skpd;
$nm_skpd 	= $row->nm_skpd;

			 	$sqdetail1=" 
				select sum(a.nilai) as nilai,sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
				END))) AS tot_th_belum, 

				sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
				END))) AS nil_th_ini

							FROM trkib_b a
							LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
							WHERE kd_barang<>'' AND kd_skpd='$skpd' AND tahun<='$tahun'
							and (nilai>=500000 or kd_riwayat='9') and kondisi<>'RB'"; 
				$hasil1   = $this->db->query($sqdetail1);
				foreach ($hasil1->result() as $row)
				{
					
					$nilai1   = ($row->nilai-($row->nil_th_ini+$row->tot_th_belum));
					$tot_b   = $tot_b+$nilai1;
				}
				
				$sqdetail2="select sum(a.nilai) as nilai,sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
				END))) AS tot_th_belum, 

				sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
				END))) AS nil_th_ini


							FROM trkib_c a
							LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
							WHERE kd_barang<>'' AND kd_skpd='$skpd' AND tahun<='$tahun'
							 and (nilai>=10000000 or kd_riwayat='9') and kondisi<>'RB'"; 
				$hasil2   = $this->db->query($sqdetail2);
				foreach ($hasil2->result() as $row)
				{
					$nilai2   	= ($row->nilai-($row->nil_th_ini+$row->tot_th_belum));
					$tot_c   	= $tot_c+$nilai2;
				}
				
				$sqdetail3="select sum(a.nilai) as nilai,sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
				END))) AS tot_th_belum, 

				sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
				END))) AS nil_th_ini


							FROM trkib_d a
							LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
							WHERE kd_barang<>'' AND kd_skpd='$skpd' AND tahun<='$tahun'
							 and (nilai>=10000000 or kd_riwayat='9') and kondisi<>'RB'"; 
				$hasil3   = $this->db->query($sqdetail3);
				foreach ($hasil3->result() as $row)
				{
					$nilai3   = ($row->nilai-($row->nil_th_ini+$row->tot_th_belum));
					$tot_d    = $tot_d+$nilai3;
				}
				
				$sqdetail4="select sum(a.nilai) as nilai,sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai-(a.nilai/TRIM(c.umur))) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN a.nilai 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN ($tahun-a.tahun-1)*(a.nilai/TRIM(c.umur))
				END))) AS tot_th_belum, 

				sum(if(a.tahun='$tahun',0,(CASE 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))=1 THEN (a.nilai/TRIM(c.umur)) 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))<=0 THEN 0 
				WHEN (TRIM(c.umur)-($tahun-a.tahun-1))>1 THEN (a.nilai/TRIM(c.umur))
				END))) AS nil_th_ini


							FROM trkib_e a
							LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8) 
							WHERE kd_barang<>'' AND kd_skpd='$skpd' AND tahun<='$tahun'
							 and (nilai>=500000 or kd_riwayat='9') and kondisi<>'RB'"; 
				$hasil4   = $this->db->query($sqdetail4);
				foreach ($hasil4->result() as $row)
				{
					$nilai4   = ($row->nilai-($row->nil_th_ini+$row->tot_th_belum));
					$tot_e    = $tot_e+$nilai4;
				}
			 			 
              $cRet .="
                 <tr>
                    <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\">$nm_skpd</td>
                    <td align=\"right\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai1)."</td>
                    <td align=\"right\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai2)."</td>
                    <td align=\"right\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai3)."</td>
					<td align=\"right\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">".number_format($nilai4)."</td>
				</tr>";
            $i++;
            
			 }
			 
			$cRet .="
                 <tr>
                    <td colspan=\"2\" bgcolor=\"#ADFF2F\" align=\"center\" width =\"35%\" style=\"font-size:10px; font-family:tahoma;\"><b>TOTAL NILAI</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($tot_b)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($tot_c)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($tot_d)."</b></td>
					<td align=\"right\" bgcolor=\"#ADFF2F\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"><b>".number_format($tot_e)."</b></td>
				</tr>";
			 
        $cRet.="</table>";
		$data['prev']= $cRet;
		$kertas='A4';  
        $this->template->set('title', 'CETAK PENYUSUTAN PER SKPD'); 
        $judul  = 'CETAK PENYUSUTAN PER SKPD';	     
		switch($iz) {
        case 1;        
			 $this->mdata->_mpdf3('',$cRet,10,10,10,2,$kertas,3);      
             //$this->_mpdf('',$cRet,10,10,10,'1');
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
	function proses_penyusutan()
    {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $data['page_title']= 'PROSES PENYUSUTAN';
        $this->template->set('title', 'PROSES PENYUSUTAN');   
        $this->template->load('index','kebijakan/proses',$data) ;
        } 
    }
	function proses_susut(){
        $skpd   = $this->input->post('skpd');
        $unit   = $this->input->post('unit');
        $tahun  = $this->input->post('tahun');
        $tahun1 = $this->input->post('tahun1');
        $tahun2 = $this->input->post('tahun2');
        $last_update = date('Y-m-d H:i:s');
        $sql = "DELETE FROM susut_kib_b_tahun WHERE kd_skpd='$skpd' and thn_oleh BETWEEN '$tahun1' and '$tahun2'";
        $hs = $this->db->query($sql);
        $sql1="SELECT a.kd_skpd,a.kd_unit,a.id_barang,a.kd_brg,a.tahun,a.tgl_oleh,
                a.nilai,IF(a.tahun<2014,a.masa_manfaat,b.umur)AS umur,
                IF(a.tahun<2014,'',b.tahun_awal)AS tahun_awal,b.bulan_awal,
                IF(a.tahun<2014,'',b.tahun_akhir)AS tahun_akhir,
                b.bulan_akhir FROM trkib_b a INNER JOIN mbarang_umur b ON b.kd_barang=LEFT(a.kd_brg,8) WHERE a.kd_skpd='$skpd' and a.tahun BETWEEN '$tahun1' and '$tahun2' ";
        $hs1 = $this->db->query($sql1);
        $i=0;
        $selisih=0;
        $s='';
        foreach ($hs1->result() as $row)
                {
                    $kd_skpd = $row->kd_skpd;
                    $kd_unit = $row->kd_unit;
                    $idb = $row->id_barang;
                    $kd_brg = $row->kd_brg;
                    $tgl_oleh = $row->tgl_oleh;
                    $thn_oleh = $row->tahun;
                    $umur= $row->umur;
                    $nilai = $row->nilai;
                    $tahun_awal = $row->tahun_awal;
                    $tahun_akhir = $row->tahun_akhir;
                    $pakai = $tahun2-$thn_oleh;
                    $sisa_manfaat1=($umur-$pakai)-1;
                    $sisa_manfaat2 = $umur-$pakai;
                    if($sisa_manfaat1<0){
                        $sisa_pakai= $sisa_manfaat1*(-1);
                    }else{
                        $sisa_pakai = $sisa_manfaat1;
                    }
                    if($sisa_manfaat2<0){
                        $sisa_pakai2= $sisa_manfaat2*(-1);
                    }else{
                        $sisa_pakai2 = $sisa_manfaat2;
                    }
                    $sql2="INSERT INTO susut_kib_b_tahun(kd_skpd   ,kd_unit   ,id_barang,kd_brg  ,umur   ,tgl_posting,tgl_oleh   ,thn_oleh,nilai_oleh,tgl_update)
                                                   VALUE('$kd_skpd','$kd_unit','$idb',  '$kd_brg','$umur',''         ,'$tgl_oleh','$thn_oleh','$nilai','$last_update')";
                    $hs2 = $this->db->query($sql2);
                    for($i=1;$i<=$umur;$i++){
                        $s='s'.$i.'';
                        
                            $sql3 ="UPDATE susut_kib_b_tahun,
                            (SELECT kd_skpd AS skpd,id_barang AS id_brg, kd_brg AS brg,umur AS umr,CAST(CEIL(nilai_oleh)/umur AS DECIMAL(18,2))ss FROM susut_kib_b_tahun WHERE kd_skpd='$kd_skpd' and id_barang='$idb')npp 
                            SET $s=npp.ss 
                            WHERE id_barang=npp.id_brg AND kd_skpd='$kd_skpd'";
                            $hs3 = $this->db->query($sql3);
                        }
                        
                        $sql4=$this->db->query("SELECT IFNULL(SUM(c.tmbh_manfaat),0)AS tmbh_umur,IFNULL(SUM(b.nilai_kap),0)AS tmbh_nilai FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd='$kd_skpd' AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang='$idb'");
                        foreach ($sql4->result() as $rowx) {
                           $tmbh_umur = $rowx->tmbh_umur;
                           $tmbh_nilai= $rowx->tmbh_nilai;
                           $sd = $sisa_pakai2+$tmbh_umur;
                           $nilai_baru = (($nilai/$umur)*$tmbh_umur)-$tmbh_nilai;
                           $ns_baru = ($nilai-$nilai_baru)/$sd;

                           if($tmbh_nilai<>0){

                                for ($a=$sisa_pakai; $a <=$sd ; $a++) { 
                                    $sx='s'.$a.'';
                                   $sql5 ="UPDATE susut_kib_b_tahun SET $sx='$ns_baru' WHERE id_barang='$idb' AND kd_skpd='$kd_skpd'";
                                            $hs5 = $this->db->query($sql5);
                                }
                                
                           }
                        }
                         
                    }
                    
               // }
            echo '1';   
    }

function cetak_rekap_susut(){
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $data['page_title']= 'CETAK LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN';
        $this->template->set('title', 'CETAK LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN');   
        $this->template->load('index','kebijakan/rekap_nilai_susut',$data) ;
        } 
    }
function rekap_susut(){
        $cpilih = $_REQUEST['pilih'];
        $pilctk = $_REQUEST['pilctk'];
        $lctgl = $_REQUEST['lctgl'];
        $konfig     = $this->ambil_config();
        $tglcetak   = $this->tanggal_indonesia($lctgl);
        $kota       = ucfirst($konfig['kota']);
        

        if($pilctk=='1'){
            $tahun1  = $_REQUEST['tahun1'];
            $tahun2   = $_REQUEST['tahun2'];           
        }else{ 
            $kd_skpdx   = $_REQUEST['skpd'];
            $nmskpd     = $_REQUEST['nmskpd'];           
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun3'];
            $dcetak=$tahun."-".$bulan."-".'31';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));            
        }

        $cRet="";
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">";
          $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN</B></td>
            </tr><BR/><BR/><BR/></table>";
        
            if($pilctk=='2'){
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\"><b>&ensp;&ensp;PERIODE SAMPAI DENGAN</b></td>
                <td align=\"left\" style=\"font-size:13px;\"><b>: $periodbulan $tahun </b></td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\"><b>&ensp;&ensp;PERIODE</b></td>
                <td align=\"left\" style=\"font-size:13px;\"><b>:&ensp;$tahun1 s.d $tahun2 </b></td>
            </tr>";
            }
                 
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"2\" cellpadding=\"4\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>No</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"20%\" style=\"font-size:11px\"><b>OPD</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB A(Tanah)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB B(Peralatan dan Mesin)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB C(Gedung dan Bangunan)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB D(Jalan,Irigasi dan Jembatan)</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB E(Aset Tetap Lainnya)</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB F(KDP)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>JUMLAH KIB A,B,C,D,E dan F</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>JUMLAH PENYUSUTAN</b></td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                
            </tr>
             </thead>
             <tfoot>
                    <tr>
                        <td colspan=\"14\" style=\"border:solid 1px white;border-top:solid 1px black;\"></td>
                    </tr>
                </tfoot>
             
                ";
        if ($pilctk=='1'){    
            $sql = "SELECT kd_skpd,nm_skpd FROM ms_skpd ORDER BY kd_skpd";
            $hasil = $this->db->query($sql);
            $i=0;$jmlp=0;$jmlnb=0;$jmls=0;$jpa=0;$jpb=0;$jpc=0;$jpd=0;$jpe=0;$jpf=0;$jnbb=0;$jnbc=0;$jbnd=0;$X=0;//DIKURANGI 0.13 KARENA SELISIH DARI DATA BASRI YG SALAH SUM

            //$npb=0;$sptb=0;$stlb=0;$sthib=0;$nbb=0;  $npc=0;$sptc=0;$stlc=0;$sthic=0;$nbc=0;  $npd=0;$sptd=0;$stld=0;$sthid=0;$nbd=0;
            foreach ($hasil->result() as $row) {
                $i++;
                $skpd    = $row->kd_skpd;
                $nm_skpd = $row->nm_skpd;
                $npb=0;$sptb=0;$stlb=0;$sthib=0;$nbb=0;  $npc=0;$sptc=0;$stlc=0;$sthic=0;$nbc=0;  $npd=0;$sptd=0;$stld=0;$sthid=0;$nbd=0;
                $sqla=mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai_kib_a
                                   FROM trkib_a a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd='$skpd' 
                                   AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi) 
                                   AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah) 
                                   AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus)  
                                   AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat)");
                $ha=mysql_fetch_assoc($sqla);
                    $pa = $ha['nilai_kib_a'];

                $sqlb="SELECT IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))))*($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1
                            THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)
                            END),0)AS ada2_akm_thn_lalu,

                            IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1 
                            THEN 0 END),0)AS ada3_susut_per_thn,

                            (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                            CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,


                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN 0 END)
                            AS penyusutan_pertahun,
                            IF(a.tahun='$tahun2',0,(CASE 
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN a.nilai
                            END)) AS tot_th_belum

                            FROM trkib_b a
                            WHERE a.kd_skpd='$skpd' AND YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' 
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun2') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun2') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun2')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun2')";
                $hb = $this->db->query($sqlb);
                foreach ($hb->result() as $rowb) {

                    if($rowb->masa_manfaat_baru<>null){
                        $susut_per_tahun = $rowb->ada3_susut_per_thn;
                        $susut_thn_lalu = $rowb->ada2_akm_thn_lalu;
                        $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                        //$umur = $rowb->masa_manfaat_baru;
                        $nb = $rowb->nilai - $susut_thn_ini;
                    }else{
                        $susut_per_tahun = $rowb->penyusutan_pertahun;
                        $susut_thn_lalu = $rowb->tot_th_belum;
                        $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                        //$umur = $rowb->umur;
                        $nb = $rowb->nilai - $susut_thn_ini;
                    }

                    $npb    = $npb + $rowb->nilai;
                    $sptb   = $sptb + $susut_per_tahun;
                    $stlb   = $stlb + $susut_thn_lalu;
                    $sthib  = $sthib + $susut_thn_ini;
                    $nbb    = $nbb + $nb;
                }
                    

                $sqlc="SELECT IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))))*($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1
                            THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)
                            END),0)AS ada2_akm_thn_lalu,

                            IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1 
                            THEN 0 END),0)AS ada3_susut_per_thn,

                            (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                            CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                            
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN 0 END)AS penyusutan_pertahun,
                            IF(a.tahun='$tahun2',0,(CASE 
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN a.nilai END)) AS tot_th_belum

                            FROM trkib_c a
                            WHERE a.kd_skpd='$skpd' AND YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' 
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun2') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun2') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun2')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun2')";
                $hc = $this->db->query($sqlc);
                foreach ($hc->result() as $rowc) {

                    if($rowc->masa_manfaat_baru<>null){
                        $susut_per_tahun_c = $rowc->ada3_susut_per_thn;
                        $susut_thn_lalu_c = $rowc->ada2_akm_thn_lalu;
                        $susut_thn_ini_c = $susut_thn_lalu_c+$susut_per_tahun_c;
                        //$umur = $rowc->masa_manfaat_baru;
                        $nc = $rowc->nilai - $susut_thn_ini_c;
                    }else{
                        $susut_per_tahun_c = $rowc->penyusutan_pertahun;
                        $susut_thn_lalu_c = $rowc->tot_th_belum;
                        $susut_thn_ini_c = $susut_thn_lalu_c+$susut_per_tahun_c;
                        //$umur = $rowc->umur;
                        $nc = $rowc->nilai - $susut_thn_ini_c;
                    }

                    $npc    = $npc + $rowc->nilai;
                    $sptc   = $sptc + $susut_per_tahun_c;
                    $stlc   = $stlc + $susut_thn_lalu_c;
                    $sthic  = $sthic + $susut_thn_ini_c;
                    $nbc    = $nbc + $nc;
                }

                $sqld="SELECT IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))))*($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1
                            THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)
                            END),0)AS ada2_akm_thn_lalu,

                            IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1 
                            THEN 0 END),0)AS ada3_susut_per_thn,

                            (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                            CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,


                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN 0 END)AS penyusutan_pertahun,
                            IF(a.tahun='$tahun2',0,(CASE 
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN a.nilai END)) AS tot_th_belum

                            FROM trkib_d a
                            WHERE a.kd_skpd='$skpd' AND YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' 
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun2') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun2') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun2')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun2')";
                $hd = $this->db->query($sqld);
                foreach ($hd->result() as $rowd) {

                    if($rowd->masa_manfaat_baru<>null){
                        $susut_per_tahun_d = $rowd->ada3_susut_per_thn;
                        $susut_thn_lalu_d = $rowd->ada2_akm_thn_lalu;
                        $susut_thn_ini_d = $susut_thn_lalu_d+$susut_per_tahun_d;
                        //$umur = $rowd->masa_manfaat_baru;
                        $nd = $rowd->nilai - $susut_thn_ini_d;
                    }else{
                        $susut_per_tahun_d = $rowd->penyusutan_pertahun;
                        $susut_thn_lalu_d = $rowd->tot_th_belum;
                        $susut_thn_ini_d = $susut_thn_lalu_d+$susut_per_tahun_d;
                        //$umur = $rowd->umur;
                        $nd = $rowd->nilai - $susut_thn_ini_d;
                    }

                    $npd    = $npd + $rowd->nilai;
                    $sptd   = $sptd + $susut_per_tahun_d;
                    $stld   = $stld + $susut_thn_lalu_d;
                    $sthid  = $sthid + $susut_thn_ini_d;
                    $nbd    = $nbd + $nd;
                }

                $sqle=mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai_kib_e
                                   FROM trkib_e a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd='$skpd' 
                                   AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun2') 
                                   AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun2') 
                                   AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun2')  
                                   AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun2')");
                $he=mysql_fetch_assoc($sqle);

                $pe = $he['nilai_kib_e'];

                $sqlf=mysql_query("SELECT IFNULL(SUM(CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                   WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)
                                   +(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                   WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)
                                   +(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                   WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))),0) AS nilai_kib_f
                                   FROM trkib_f a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd='$skpd' 
                                   AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun2') 
                                   AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun2') 
                                   AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun2')  
                                   AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR YEAR(a.tgl_riwayat)>'$tahun2')
                                   AND (a.sts is null or a.sts='2' or(a.sts='1'and YEAR(a.tgl_riwayat) >'$tahun2'))");
                $hf=mysql_fetch_assoc($sqlf);
                $pf = $hf['nilai_kib_f'];

                /*$jp = $pa+$npb+$npc+$npd+$pe+$pf;
                $jnb = $pa+($npb-$sthib)+($npc-$sthic)+($npd-$sthid)+$pe+$pf;
                $js = $jp-$jnb;*/


                $jp = $pa+$npb+$npc+$npd+$pe+$pf;
                $jnb = $pa+$nbb+$nbc+$nbd+$pe+$pf;
                $js = $jp-$jnb;
                //$js = $nbb+$nbc+$nbd;

                $jpa = $jpa+$pa;
                $jpb = $jpb+$npb;
                $jpc = $jpc+$npc;
                $jpd = $jpd+$npd;
                $jpe = $jpe+$pe;
                $jpf = $jpf+$pf;

                $jnbb = $jnbb+$nbb;
                $jnbc = $jnbc+$nbc;
                $jbnd = $jbnd+$nbd;

                $jmlp=$jmlp+$jp;
                $jmlnb=$jmlnb+$jnb;
                $jmls=$jmls+$js;
                $cRet .="<tr>
                            <td align=\"center\" style=\"font-size:11px\">$i</td>
                            <td align=\"left\" style=\"font-size:11px\">$nm_skpd</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pa,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($npb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($npc,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbc,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($npd,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbd,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pe,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pf,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($jp,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($jnb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($js,2,',','.')."</td>
                        </tr>";

            }
        }else{
            $sql = "SELECT kd_skpd,nm_skpd FROM ms_skpd where kd_skpd='$kd_skpdx' ORDER BY kd_skpd";
            $hasil = $this->db->query($sql);
            $i=0;$jmlp=0;$jmlnb=0;$jmls=0;$jpa=0;$jpb=0;$jpc=0;$jpd=0;$jpe=0;$jpf=0;$jnbb=0;$jnbc=0;$jbnd=0;$X=0;//DIKURANGI 0.13 KARENA SELISIH DARI DATA BASRI YG SALAH SUM

            //$npb=0;$sptb=0;$stlb=0;$sthib=0;$nbb=0;  $npc=0;$sptc=0;$stlc=0;$sthic=0;$nbc=0;  $npd=0;$sptd=0;$stld=0;$sthid=0;$nbd=0;
            foreach ($hasil->result() as $row) {
                $i++;
                $skpd    = $row->kd_skpd;
                $nm_skpd = $row->nm_skpd;
                $npb=0;$sptb=0;$stlb=0;$sthib=0;$nbb=0;  $npc=0;$sptc=0;$stlc=0;$sthic=0;$nbc=0;  $npd=0;$sptd=0;$stld=0;$sthid=0;$nbd=0;
                $sqla=mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai_kib_a
                                   FROM trkib_a a WHERE YEAR(a.tgl_oleh) BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' 
                                   AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi) 
                                   AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah) 
                                   AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus)  
                                   AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat)");
                $ha=mysql_fetch_assoc($sqla);
                    $pa = $ha['nilai_kib_a'];

            //AWAL KIB B
            /*$sqlb="SELECT a.id_barang,a.kd_brg AS kode,
                IF(a.tahun='2015',1,(2015-a.tahun+1)) AS th_lalu,                    
                IF(a.tahun='2015',0,(CASE 
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))>1 THEN CAST((2015-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN a.nilai
                END)) AS tot_th_belum, 
                (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='2015' AND b.id_barang=a.id_barang))-(2015-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN 0 END)
                AS penyusutan_pertahun
                FROM trkib_b a
                LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                WHERE a.kd_skpd='$skpd' 
                AND kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '1945' AND '2015'
                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

             $hasilb = $this->db->query($sqlb);
             
             foreach ($hasilb->result() as $rowb)
            {                
                $cid_barang_b = $rowb->id_barang;
                $cth_lalu_b = $rowb->th_lalu * 12;                
                $susut_per_tahun_b = $rowb->penyusutan_pertahun;
                $susut_thn_lalu_b = $rowb->tot_th_belum;
                $susut_thn_ini_b = $susut_thn_lalu_b+$susut_per_tahun_b;
         
                $sqlbb = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                    IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                    (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))
                    ,0)AS umur_bulan_baru,

                    (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                    FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,
                    (SELECT (('$tahun'-YEAR(a.tgl_oleh)+1)*12) - (MONTH(a.tgl_reg)-'$bulan')) AS pake1, 

                    CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                    TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12)-1)
                    AS bulan_lalu,

                    TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12))
                    AS bulan_ini,

                    (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                    WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                    (CASE 
                    WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>=0 
                    THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-'2015')*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                    WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                    THEN a.nilai
                    END)
                    AS tot_bln_belum,

                    (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                    THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                    (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                    FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                    (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                    ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                    (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                    FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                    WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan

                    FROM trkib_b a
                    LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                    LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                    WHERE kd_barang<>'' AND a.tgl_reg<='$last' AND a.kd_skpd='$skpd' and a.id_barang='$cid_barang_b'
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
                   
                 $hasilbb = $this->db->query($sqlbb);                     
                 
                foreach ($hasilbb->result() as $rowbb)
                    {
                        $cpaket_b = $rowbb->pake;
                        if ($cpaket_b == NULL){
                        $cpake_b = $rowbb->pake1;
                        }else{
                        $cpake_b = $rowbb->pake;
                        }

                        $cbulan_pake_ini_b = $rowbb->bulan_lalu;
                        $cbulan_lalu_b = $cbulan_pake_ini_b + $cth_lalu_b;                            
                        
                        $cakum_penyusutan_bulan_b = $rowbb->akum_penyusutan_bulan;
                        $cpenyusutan_bulan_b = $rowbb->penyusutan_bulan;

                        $cumur_bulan_baru_b = $rowbb->umur_bulan_baru;
                        if($cumur_bulan_baru_b == 0){
                        $cumur_bulan_b = $rowbb->umur_bulan ;
                        }else{
                        $cumur_bulan_b = $rowbb->umur_bulan_baru ;
                        }

                        if($cbulan_lalu_b < $cumur_bulan_b){
                            if($cpake_b<=$cbulan_lalu_b)
                            { 
                                $bln_lalu_b = ($cpake_b*$cpenyusutan_bulan_b)+($cakum_penyusutan_bulan_b*($cbulan_lalu_b-$cpake_b)) ;
                                $bln_ini_b = $rowbb->akum_penyusutan_bulan + $bln_lalu_b;
                                $penyusutan_bulan_b = $rowbb->akum_penyusutan_bulan;
                            }else{
                                if($cumur_bulan_b>=$cbulan_lalu_b){
                                 $bln_lalu_b= $susut_thn_ini_b + $rowbb->tot_bln_belum ;    
                                }else{
                                 $bln_lalu_b= $rowbb->tot_bln_belum ;    
                                }                                                   
                                $bln_ini_b = $rowbb->penyusutan_bulan + $bln_lalu_b;                        
                                $penyusutan_bulan_b = $rowbb->penyusutan_bulan;
                            }
                        }else{
                            $bln_lalu_b= $rowbb->nilai ;
                            $bln_ini_b = 0 + $bln_lalu_b;
                            $penyusutan_bulan_b = 0;

                        }
                        $tot_bukub_b  = $rowbb->nilai-$bln_ini_b;
                        $npb    = $npb + $rowbb->nilai;
                        $sptb   = $sptb + $penyusutan_bulan_b;
                        $stlb   = $stlb + $bln_lalu_b;
                        $sthib  = $sthib + $bln_ini_b;
                        $nbb    = $nbb + $tot_bukub_b;
                    }
            }*/
            $sqlb="SELECT a.id_barang 
                FROM trkib_b a
                LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok
                WHERE a.kd_skpd='$skpd' 
                AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015'
                AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

             $hasilb = $this->db->query($sqlb);
             
             foreach ($hasilb->result() as $rowb)
            {                
                $cid_barang_b = $rowb->id_barang;
                $sqlbb ="SELECT a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),0)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok
                        
                        WHERE a.kd_skpd='$skpd' AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015' and a.id_barang='$cid_barang_b'
                        AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')order by a.kd_brg,a.tahun,a.no_reg";
                        $hasilbb = $this->db->query($sqlbb);                     
                 
                foreach ($hasilbb->result() as $rowbb)
                    {
                        if($rowbb->masa_manfaat_baru<>null){
                            $susut_per_tahun_b = $rowbb->ada3_susut_per_thn;
                            $susut_thn_lalu_b = $rowbb->ada2_akm_thn_lalu;
                            $susut_thn_ini_b = $susut_thn_lalu_b+$susut_per_tahun_b;
                            $umur = $rowbb->masa_manfaat_baru;
                            $nb = $rowbb->nilai - $susut_thn_ini_b;
                        }else{
                            $susut_per_tahun_b = $rowbb->penyusutan_pertahun;
                            $susut_thn_lalu_b = $rowbb->tot_th_belum;
                            $susut_thn_ini_b = $susut_thn_lalu_b+$susut_per_tahun_b;
                            $umur = $rowbb->umur;
                            $nb = $rowbb->nilai - $susut_thn_ini_b;
                        }
                        $tot_bukub_b  = $rowbb->nilai-$susut_thn_ini_b;
                        $npb    = $npb + $rowbb->nilai;
                        $sptb   = $sptb + $susut_per_tahun_b;
                        $stlb   = $stlb + $susut_thn_lalu_b;
                        $sthib  = $sthib + $susut_thn_ini_b;
                        $nbb    = $nbb + $tot_bukub_b;
                    }
            }
            //awal thn berjalan
            $sqlb_ini="SELECT a.id_barang,a.kd_brg AS kode,
                    IF(a.tahun='$tahun',1,('$tahun'-a.tahun+1)) AS th_lalu,                    
                    IF(a.tahun='$tahun',0,(CASE 
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))>1 THEN CAST(('$tahun'-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN a.nilai
                    END)) AS tot_th_belum, 
                    (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))-('$tahun'-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN 0 END)
                    AS penyusutan_pertahun
                    FROM trkib_b a
                    LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                    LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                    WHERE a.kd_skpd='$skpd' 
                    AND a.tgl_oleh BETWEEN '2016-01-01' AND '$last' 
                    AND IF('$last'>='2016-01-01',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')ORDER BY a.kd_brg,a.tahun,a.no_reg";

             $hasilb_ini = $this->db->query($sqlb_ini);
             
             foreach ($hasilb_ini->result() as $rowb_ini)
            {                
                $cid_barang_bb = $rowb_ini->id_barang;
                $cth_lalu_bb= $rowb_ini->th_lalu * 12;                
                $susut_per_tahun_bb= $rowb_ini->penyusutan_pertahun;
                $susut_thn_lalu_bb= $rowb_ini->tot_th_belum;
                $susut_thn_ini_bb = $susut_thn_lalu_bb+$susut_per_tahun_bb;
         
                $sqlbb_ini = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                    IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap BETWEEN '2016-01-01' AND '$last' GROUP BY id_barang),
                        (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))
                        ,0)AS umur_bulan_baru,

                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                        (SELECT (('$tahun'-YEAR(a.tgl_oleh))*12) - (MONTH(a.tgl_oleh)-'$bulan')+1) AS pake1, 

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-2016)*12))
                        AS bulan_lalu,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12))>=0 
                        THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-2016)*12))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan,
                        a.kondisi

                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                        WHERE a.kd_skpd='$skpd' AND a.id_barang ='$cid_barang_bb' 
                        AND a.tgl_oleh BETWEEN '2016-01-01' AND '$last'
                        AND IF('$last'>='2016-01-01',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR tgl_riwayat>='$last') ORDER BY a.kd_brg,a.tahun";
                   
                 $hasilbb_ini = $this->db->query($sqlbb_ini);                     
                 
                foreach ($hasilbb_ini->result() as $rowbb_ini)
                    {
                        $cpaket_bb = $rowbb_ini->pake;
                        if ($cpaket_bb == NULL){
                        $cpake_bb = $rowbb_ini->pake1;
                        }else{
                        $cpake_bb = $rowbb_ini->pake;
                        }

                        $cbulan_pake_ini_bb = $rowbb_ini->bulan_lalu;
                        $cbulan_lalu_bb = $cbulan_pake_ini_bb;                            
                        
                        $cakum_penyusutan_bulan_bb = $rowbb_ini->akum_penyusutan_bulan;
                        $cpenyusutan_bulan_bb = $rowbb_ini->penyusutan_bulan;

                        $cumur_bulan_baru_bb = $rowbb_ini->umur_bulan_baru;
                        if($cumur_bulan_baru_bb == 0){
                        $cumur_bulan_bb = $rowbb_ini->umur_bulan ;
                        }else{
                        $cumur_bulan_bb = $rowbb_ini->umur_bulan_baru ;
                        }

                        /*if($cbulan_lalu_bb < $cumur_bulan_bb){
                            if($cpake_bb<=$cbulan_lalu_bb)
                            { 
                                $bln_lalu_bb = ($cpake_bb*$cpenyusutan_bulan_bb)+($cakum_penyusutan_bulan_bb*($cbulan_lalu_bb-$cpake_bb)) ;
                                $bln_ini_bb = $rowbb_ini->akum_penyusutan_bulan + $bln_lalu_bb;
                                $penyusutan_bulan_bb = $rowbb_ini->akum_penyusutan_bulan;
                            }else{
                                $bln_lalu_bb= $rowbb_ini->tot_bln_belum ;                                                      
                                $bln_ini_bb = $rowbb_ini->penyusutan_bulan + $bln_lalu_bb;                        
                                $penyusutan_bulan_bb = $rowbb_ini->penyusutan_bulan;
                            }
                        }else{
                            $bln_lalu_bb= $rowbb_ini->nilai ;
                            $bln_ini_bb = 0 + $bln_lalu_bb;
                            $penyusutan_bulan_bb = 0;

                        }*/
                        if($cbulan_lalu_bb < $cumur_bulan_bb){
                                if($cpake_bb<=$cbulan_lalu_bb)
                                { 
                                    $bln_lalu_bb = ($cpake_bb*$cpenyusutan_bulan_bb)+($cakum_penyusutan_bulan_bb*($cbulan_lalu_bb-$cpake_bb)) ;
                                    $bln_ini_bb = $rowbb_ini->akum_penyusutan_bulan + $bln_lalu_bb;
                                    $penyusutan_bulan_bb = $rowbb_ini->akum_penyusutan_bulan;
                                }else{
                                    $bln_lalu_bb= $rowbb_ini->tot_bln_belum ;                                                   
                                     //kondisi untuk bulan penutupan,agar tidak ada sisa nilai buku koma                       
                                    if($cumur_bulan_bb==($cbulan_lalu_bb+1)){
                                        $penyusutan_bulan_bb = $rowbb_ini->nilai-$rowbb_ini->tot_bln_belum;
                                        $bln_ini_bb = $penyusutan_bulan_bb + $bln_lalu_bb;
                                    }else{
                                        $penyusutan_bulan_bb = $rowbb_ini->penyusutan_bulan;
                                        $bln_ini_bb = $rowbb_ini->penyusutan_bulan + $bln_lalu_bb;
                                    }

                                }
                            }else{
                                $bln_lalu_bb= $rowbb_ini->nilai ;
                                $bln_ini_bb = 0 + $bln_lalu_bb;
                                $penyusutan_bulan_bb = 0;

                            }
                        $tot_bukub_bb  = $rowbb_ini->nilai-$bln_ini_bb;
                        $npb    = $npb + $rowbb_ini->nilai;
                        $sptb   = $sptb + $penyusutan_bulan_bb;
                        $stlb   = $stlb + $bln_lalu_bb;
                        $sthib  = $sthib + $bln_ini_bb;
                        $nbb    = $nbb + $tot_bukub_bb;
                    }
            }
            //akhir thn berjalan 
            //AKHIR KIB B
                    

            //AWAL KIB C
            /*$sqlc="SELECT a.id_barang,a.kd_brg AS kode,
                IF(a.tahun='2015',1,(2015-a.tahun+1)) AS th_lalu,                    
                IF(a.tahun='2015',0,(CASE 
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))>1 THEN CAST((2015-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN a.nilai
                END)) AS tot_th_belum, 
                (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='2015' AND b.id_barang=a.id_barang))-(2015-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN 0 END)
                AS penyusutan_pertahun
                FROM trkib_c a
                LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                WHERE a.kd_skpd='$skpd' 
                AND kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '1945' AND '2015'
                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

             $hasilc = $this->db->QUERY($sqlc);
             
             foreach ($hasilc->result() AS $rowc)
            {                
                $cid_barang_c = $rowc->id_barang;
                $cth_lalu_c = $rowc->th_lalu * 12;                
                $susut_per_tahun_c = $rowc->penyusutan_pertahun;
                $susut_thn_lalu_c = $rowc->tot_th_belum;
                $susut_thn_ini_c = $susut_thn_lalu_c+$susut_per_tahun_c;
         
                $sqlcc ="SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                    IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                    (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))
                    ,0)AS umur_bulan_baru,

                    (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                    FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,
                    (SELECT (('$tahun'-YEAR(a.tgl_oleh)+1)*12) - (MONTH(a.tgl_reg)-'$bulan')) AS pake1,

                    CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                    TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12)-1)
                    AS bulan_lalu,

                    TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12))
                    AS bulan_ini,

                    (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                    WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                    (CASE 
                    WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>=0 
                    THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-'2015')*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                    WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                    THEN a.nilai
                    END)
                    AS tot_bln_belum,

                    (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                    THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                    (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                    FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                    (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                    ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                    (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                    FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                    WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan

                    FROM trkib_c a
                    LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                    LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                    WHERE kd_barang<>'' AND a.tgl_reg<='$last' AND a.kd_skpd='$skpd' and a.id_barang='$cid_barang_c'
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
                   
                 $hasilcc = $this->db->QUERY($sqlcc);                     
                 
                foreach ($hasilcc->result() AS $rowcc)
                    {
                        $cpaket_c = $rowcc->pake;
                        if ($cpaket_c == NULL){
                        $cpake_c = $rowcc->pake1;
                        }else{
                        $cpake_c = $rowcc->pake;
                        }

                        $cbulan_pake_ini_c = $rowcc->bulan_lalu;
                        $cbulan_lalu_c = $cbulan_pake_ini_c + $cth_lalu_c;                            
                        
                        $cakum_penyusutan_bulan_c = $rowcc->akum_penyusutan_bulan;
                        $cpenyusutan_bulan_c = $rowcc->penyusutan_bulan;

                        $cumur_bulan_baru_c = $rowcc->umur_bulan_baru;
                        if($cumur_bulan_baru_c == 0){
                        $cumur_bulan_c = $rowcc->umur_bulan ;
                        }else{
                        $cumur_bulan_c = $rowcc->umur_bulan_baru ;
                        }

                        if($cbulan_lalu_c < $cumur_bulan_c){
                            if($cpake_c<=$cbulan_lalu_c)
                            { 
                                $bln_lalu_c = ($cpake_c*$cpenyusutan_bulan_c)+($cakum_penyusutan_bulan_c*($cbulan_lalu_c-$cpake_c)) ;
                                $bln_ini_c = $rowcc->akum_penyusutan_bulan + $bln_lalu_c;
                                $penyusutan_bulan_c = $rowcc->akum_penyusutan_bulan;
                            }else{
                                if($cumur_bulan_c>=$cbulan_lalu_c){
                                 $bln_lalu_c= $susut_thn_ini_c + $rowcc->tot_bln_belum ;    
                                }else{
                                 $bln_lalu_c= $rowcc->tot_bln_belum ;    
                                }                                                   
                                $bln_ini_c = $rowcc->penyusutan_bulan + $bln_lalu_c;                        
                                $penyusutan_bulan_c = $rowcc->penyusutan_bulan;
                            }
                        }else{
                            $bln_lalu_c= $rowcc->nilai ;
                            $bln_ini_c = 0 + $bln_lalu_c;
                            $penyusutan_bulan_c = 0;

                        }
                        $tot_bukuc_c  = $rowcc->nilai-$bln_ini_c;
                        $npc    = $npc + $rowcc->nilai;
                        $sptc   = $sptc + $penyusutan_bulan_c;
                        $stlc   = $stlc + $bln_lalu_c;
                        $sthic  = $sthic + $bln_ini_c;
                        $nbc    = $nbc + $tot_bukuc_c;
                    }
            } */
            $sqlc="SELECT a.id_barang FROM trkib_c a LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok
                WHERE a.kd_skpd='$skpd' 
                AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015'
                AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

             $hasilc = $this->db->QUERY($sqlc);
             
             foreach ($hasilc->result() AS $rowc)
            {                
                $cid_barang_c = $rowc->id_barang;
                $sqlcc ="SELECT a.kd_brg AS kode,b.nm_brg,'' as merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),a.nilai/a.masa_manfaat)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                        WHERE a.kd_skpd='$skpd' AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015' and a.id_barang='$cid_barang_c'
                        AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')";
                        $hasilcc = $this->db->QUERY($sqlcc);                     
                 
                foreach ($hasilcc->result() AS $rowcc)
                    {
                        if($rowcc->masa_manfaat_baru<>null){
                            $susut_per_tahun_c = $rowcc->ada3_susut_per_thn;
                            $susut_thn_lalu_c = $rowcc->ada2_akm_thn_lalu;
                            $susut_thn_ini_c = $susut_thn_lalu_c+$susut_per_tahun_c;
                            $umur = $rowcc->masa_manfaat_baru;
                            //$nb = $rowcc->nilai - $susut_thn_ini_c;
                        }else{
                            $susut_per_tahun_c = $rowcc->penyusutan_pertahun;
                            $susut_thn_lalu_c = $rowcc->tot_th_belum;
                            $susut_thn_ini_c = $susut_thn_lalu_c+$susut_per_tahun_c;
                            $umur = $rowcc->umur;
                            //$nb = $rowcc->nilai - $susut_thn_ini_c;
                        }
                        $tot_bukuc_c  = $rowcc->nilai-$susut_thn_ini_c;
                        $npc    = $npc + $rowcc->nilai;
                        $sptc   = $sptc + $susut_per_tahun_c;
                        $stlc   = $stlc + $susut_thn_lalu_c;
                        $sthic  = $sthic + $susut_thn_ini_c;
                        $nbc    = $nbc + $tot_bukuc_c;
                    }
            }
            //awal kib c thn berjalan
            $sqlc_ini="SELECT a.id_barang,a.kd_brg AS kode,
                    IF(a.tahun='$tahun',1,('$tahun'-a.tahun+1)) AS th_lalu,                    
                    IF(a.tahun='$tahun',0,(CASE 
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))>1 THEN CAST(('$tahun'-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN a.nilai
                    END)) AS tot_th_belum, 
                    (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))-('$tahun'-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN 0 END)
                    AS penyusutan_pertahun
                    FROM trkib_c a
                    LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                    LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                    WHERE a.kd_skpd='$skpd' 
                    AND a.tgl_oleh BETWEEN '2016-01-01' AND '$last'
                    AND IF('$last'>='2016-01-01',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '') 
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')ORDER BY a.kd_brg,a.tahun,a.no_reg";

             $hasilc_ini = $this->db->QUERY($sqlc_ini);
             
             foreach ($hasilc_ini->result() AS $rowc_ini)
            {                
                $cid_barang_cc = $rowc_ini->id_barang;
                $cth_lalu_cc = $rowc_ini->th_lalu * 12;                
                $susut_per_tahun_cc = $rowc_ini->penyusutan_pertahun;
                $susut_thn_lalu_cc = $rowc_ini->tot_th_belum;
                $susut_thn_ini_cc = $susut_thn_lalu_cc+$susut_per_tahun_cc;
         
                $sqlcc_ini = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                    IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                    (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))
                    ,0)AS umur_bulan_baru,

                    IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap BETWEEN '2016-01-01' AND '$last' GROUP BY id_barang),
                        (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))
                        ,0)AS umur_bulan_baru,

                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                        (SELECT (('$tahun'-YEAR(a.tgl_oleh))*12) - (MONTH(a.tgl_oleh)-'$bulan')+1) AS pake1, 

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-2016)*12))
                        AS bulan_lalu,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12))>=0 
                        THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-2016)*12))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan,
                        a.kondisi

                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                        WHERE a.kd_skpd='$skpd' AND a.id_barang ='$cid_barang_cc' 
                        AND a.tgl_oleh BETWEEN '2016-01-01' AND '$last'
                        AND IF('$last'>='2016-01-01',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR tgl_riwayat>='$last') ORDER BY a.kd_brg,a.tahun";
                   
                 $hasilcc_ini = $this->db->QUERY($sqlcc_ini);                     
                 
                foreach ($hasilcc_ini->result() AS $rowcc_ini)
                    {
                        $cpaket_cc = $rowcc_ini->pake;
                        if ($cpaket_cc == NULL){
                        $cpake_cc = $rowcc_ini->pake1;
                        }else{
                        $cpake_cc = $rowcc_ini->pake;
                        }

                        $cbulan_pake_ini_cc = $rowcc_ini->bulan_lalu;
                        $cbulan_lalu_cc = $cbulan_pake_ini_cc;                            
                        
                        $cakum_penyusutan_bulan_cc = $rowcc_ini->akum_penyusutan_bulan;
                        $cpenyusutan_bulan_cc = $rowcc_ini->penyusutan_bulan;

                        $cumur_bulan_baru_cc = $rowcc_ini->umur_bulan_baru;
                        if($cumur_bulan_baru_cc == 0){
                        $cumur_bulan_cc = $rowcc_ini->umur_bulan ;
                        }else{
                        $cumur_bulan_cc = $rowcc_ini->umur_bulan_baru ;
                        }

                        /*if($cbulan_lalu_cc < $cumur_bulan_cc){
                            if($cpake_cc<=$cbulan_lalu_cc)
                            { 
                                $bln_lalu_cc = ($cpake_cc*$cpenyusutan_bulan_cc)+($cakum_penyusutan_bulan_cc*($cbulan_lalu_cc-$cpake_cc)) ;
                                $bln_ini_cc = $rowcc_ini->akum_penyusutan_bulan + $bln_lalu_cc;
                                $penyusutan_bulan_cc = $rowcc_ini->akum_penyusutan_bulan;
                            }else{
                                $bln_lalu_cc= $rowcc_ini->tot_bln_belum ;                                                  
                                $bln_ini_cc = $rowcc_ini->penyusutan_bulan + $bln_lalu_cc;                        
                                $penyusutan_bulan_cc = $rowcc_ini->penyusutan_bulan;
                            }
                        }else{
                            $bln_lalu_cc= $rowcc_ini->nilai ;
                            $bln_ini_cc = 0 + $bln_lalu_cc;
                            $penyusutan_bulan_cc = 0;

                        }*/
                        if($cbulan_lalu_cc < $cumur_bulan_cc){
                                if($cpake_cc<=$cbulan_lalu_cc)
                                { 
                                    $bln_lalu_cc = ($cpake_cc*$cpenyusutan_bulan_cc)+($cakum_penyusutan_bulan_cc*($cbulan_lalu_cc-$cpake_cc)) ;
                                    $bln_ini_cc = $rowcc_ini->akum_penyusutan_bulan + $bln_lalu_cc;
                                    $penyusutan_bulan_cc = $rowcc_ini->akum_penyusutan_bulan;
                                }else{
                                    $bln_lalu_cc= $rowcc_ini->tot_bln_belum ;                                                   
                                     //kondisi untuk bulan penutupan,agar tidak ada sisa nilai buku koma                       
                                    if($cumur_bulan_cc==($cbulan_lalu_cc+1)){
                                        $penyusutan_bulan_cc = $rowcc_ini->nilai-$rowcc_ini->tot_bln_belum;
                                        $bln_ini_cc = $penyusutan_bulan_cc + $bln_lalu_cc;
                                    }else{
                                        $penyusutan_bulan_cc = $rowcc_ini->penyusutan_bulan;
                                        $bln_ini_cc = $rowcc_ini->penyusutan_bulan + $bln_lalu_cc;
                                    }

                                }
                            }else{
                                $bln_lalu_cc= $rowcc_ini->nilai ;
                                $bln_ini_cc = 0 + $bln_lalu_cc;
                                $penyusutan_bulan_cc = 0;

                            }
                        $tot_bukuc_cc  = $rowcc_ini->nilai-$bln_ini_cc;
                        $npc    = $npc + $rowcc_ini->nilai;
                        $sptc   = $sptc + $penyusutan_bulan_cc;
                        $stlc   = $stlc + $bln_lalu_cc;
                        $sthic  = $sthic + $bln_ini_cc;
                        $nbc    = $nbc + $tot_bukuc_cc;
                    }
            } 
            //akir kib c thn berjalan
            //AKHIR KIB C

            //AWAL KIB D
            /*$sqld="SELECT a.id_barang,a.kd_brg AS kode,
                IF(a.tahun='2015',1,(2015-a.tahun+1)) AS th_lalu,                    
                IF(a.tahun='2015',0,(CASE 
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))>1 THEN CAST((2015-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN a.nilai
                END)) AS tot_th_belum, 
                (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='2015' AND b.id_barang=a.id_barang))-(2015-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN 0 END)
                AS penyusutan_pertahun
                FROM trkib_d a
                LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                WHERE a.kd_skpd='$skpd' 
                AND kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '1945' AND '2015'
                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

             $hasild = $this->db->QUERY($sqld);
             
             foreach ($hasild->result() AS $rowd)
            {                
                $cid_barang_d = $rowd->id_barang;
                $cth_lalu_d = $rowd->th_lalu * 12;                
                $susut_per_tahun_d = $rowd->penyusutan_pertahun;
                $susut_thn_lalu_d = $rowd->tot_th_belum;
                $susut_thn_ini_d = $susut_thn_lalu_d+$susut_per_tahun_d;
         
                $sqldd = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                    IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                    (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))
                    ,0)AS umur_bulan_baru,

                    (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                    FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,
                    (SELECT (('$tahun'-YEAR(a.tgl_oleh)+1)*12) - (MONTH(a.tgl_reg)-'$bulan')) AS pake1, 

                    CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                    TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12)-1)
                    AS bulan_lalu,

                    TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12))
                    AS bulan_ini,

                    (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                    WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                    (CASE 
                    WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>=0 
                    THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-'2015')*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                    WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                    THEN a.nilai
                    END)
                    AS tot_bln_belum,

                    (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                    THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                    (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                    FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                    (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                    ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                    (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                    FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                    WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan

                    FROM trkib_d a
                    LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                    LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                    WHERE kd_barang<>'' AND a.tgl_reg<='$last' AND a.kd_skpd='$skpd' and a.id_barang='$cid_barang_d'
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
                   
                 $hasildd = $this->db->QUERY($sqldd);                     
                 
                foreach ($hasildd->result() AS $rowdd)
                    {
                        $cpaket_d = $rowdd->pake;
                        if($cpaket_d == NULL){
                        $cpake_d = $rowdd->pake1;
                        }else{
                        $cpake_d = $rowdd->pake;
                        }

                        $cbulan_pake_ini_d = $rowdd->bulan_lalu;
                        $cbulan_lalu_d = $cbulan_pake_ini_d + $cth_lalu_d;                            
                        
                        $cakum_penyusutan_bulan_d = $rowdd->akum_penyusutan_bulan;
                        $cpenyusutan_bulan_d = $rowdd->penyusutan_bulan;

                        $cumur_bulan_baru_d = $rowdd->umur_bulan_baru;
                        if($cumur_bulan_baru_d == 0){
                        $cumur_bulan_d = $rowdd->umur_bulan ;
                        }else{
                        $cumur_bulan_d = $rowdd->umur_bulan_baru ;
                        }

                        if($cbulan_lalu_d < $cumur_bulan_d){
                            if($cpake_d<=$cbulan_lalu_d)
                            { 
                                $bln_lalu_d = ($cpake_d*$cpenyusutan_bulan_d)+($cakum_penyusutan_bulan_d*($cbulan_lalu_d-$cpake_d)) ;
                                $bln_ini_d = $rowdd->akum_penyusutan_bulan + $bln_lalu_d;
                                $penyusutan_bulan_d = $rowdd->akum_penyusutan_bulan;
                            }else{
                                if($cumur_bulan_d>=$cbulan_lalu_d){
                                 $bln_lalu_d= $susut_thn_ini_d + $rowdd->tot_bln_belum ;    
                                }else{
                                 $bln_lalu_d= $rowdd->tot_bln_belum ;    
                                }                                                   
                                $bln_ini_d = $rowdd->penyusutan_bulan + $bln_lalu_d;                        
                                $penyusutan_bulan_d = $rowdd->penyusutan_bulan;
                            }
                        }else{
                            $bln_lalu_d= $rowdd->nilai ;
                            $bln_ini_d = 0 + $bln_lalu_d;
                            $penyusutan_bulan_d = 0;

                        }
                        $tot_bukud_d  = $rowdd->nilai-$bln_ini_d;
                        $npd    = $npd + $rowdd->nilai;
                        $sptd   = $sptd + $penyusutan_bulan_d;
                        $stld   = $stld + $bln_lalu_d;
                        $sthid  = $sthid + $bln_ini_d;
                        $nbd    = $nbd + $tot_bukud_d;
                    }
            }*/
            $sqld="SELECT a.id_barang FROM trkib_d a LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                
                WHERE a.kd_skpd='$skpd' 
                AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015'
                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

             $hasild = $this->db->QUERY($sqld);
             
             foreach ($hasild->result() AS $rowd)
            {                
                $cid_barang_d = $rowd->id_barang;
                $sqldd="SELECT a.kd_brg AS kode,b.nm_brg,''as merek,a.tahun,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),a.nilai/a.masa_manfaat)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        
                        WHERE a.kd_skpd='$skpd' AND a.tahun BETWEEN '1945' AND '2015' and a.id_barang='$cid_barang_d'
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')";
                        $hasildd = $this->db->QUERY($sqldd);                     
                 
                foreach ($hasildd->result() AS $rowdd)
                    {
                        if($rowdd->masa_manfaat_baru<>null){
                            $susut_per_tahun_d = $rowdd->ada3_susut_per_thn;
                            $susut_thn_lalu_d = $rowdd->ada2_akm_thn_lalu;
                            $susut_thn_ini_d = $susut_thn_lalu_d+$susut_per_tahun_d;
                            $umur = $rowdd->masa_manfaat_baru;
                        }else{
                            $susut_per_tahun_d = $rowdd->penyusutan_pertahun;
                            $susut_thn_lalu_d = $rowdd->tot_th_belum;
                            $susut_thn_ini_d = $susut_thn_lalu_d+$susut_per_tahun_d;
                            $umur = $rowdd->umur;
                        }
                        $tot_bukud_d  = $rowdd->nilai-$susut_thn_ini_d;
                        $npd    = $npd + $rowdd->nilai;
                        $sptd   = $sptd + $susut_per_tahun_d;
                        $stld   = $stld + $susut_thn_lalu_d;
                        $sthid  = $sthid + $susut_thn_ini_d;
                        $nbd    = $nbd + $tot_bukud_d;
                    }
            }
            //awal kib d thn jln
            $sqld_ini="SELECT a.id_barang,a.kd_brg AS kode,
                    IF(a.tahun='$tahun',1,('$tahun'-a.tahun+1)) AS th_lalu,                    
                    IF(a.tahun='$tahun',0,(CASE 
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))>1 THEN CAST(('$tahun'-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN a.nilai
                    END)) AS tot_th_belum, 
                    (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                    WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang))-('$tahun'-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN 0 END)
                    AS penyusutan_pertahun
                    FROM trkib_d a
                    LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                    LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                    WHERE a.kd_skpd='$skpd' 
                    AND kd_barang<>'' AND a.tgl_oleh BETWEEN '2016-1-01' AND '$last' 
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')ORDER BY a.kd_brg,a.tahun,a.no_reg";

             $hasild_ini = $this->db->QUERY($sqld_ini);
             
             foreach ($hasild_ini->result() AS $rowd_ini)
            {                
                $cid_barang_dd = $rowd_ini->id_barang;
                $cth_lalu_dd = $rowd_ini->th_lalu * 12;                
                $susut_per_tahun_dd = $rowd_ini->penyusutan_pertahun;
                $susut_thn_lalu_dd = $rowd_ini->tot_th_belum;
                $susut_thn_ini_dd = $susut_thn_lalu_dd+$susut_per_tahun_dd;
         
                $sqldd_ini = "SELECT MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                    IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap BETWEEN '2016-1-01' AND '$last' GROUP BY id_barang),
                        (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang))
                        ,0)AS umur_bulan_baru,

                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                        (SELECT (('$tahun'-YEAR(a.tgl_oleh))*12) - (MONTH(a.tgl_oleh)-'$bulan')+1) AS pake1, 

                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                        TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-2016)*12))
                        AS bulan_lalu,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                        (CASE 
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12))>=0 
                        THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-2016)*12))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                        WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                        THEN a.nilai
                        END)
                        AS tot_bln_belum,

                        (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                        THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang))) / 
                        ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang) -
                        (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                        FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                        WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan,
                        a.kondisi

                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                        WHERE kd_barang<>'' and a.kd_skpd='$skpd' AND a.id_barang ='$cid_barang_dd' 
                        AND a.tgl_oleh BETWEEN '2016-1-01' AND '$last'
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR tgl_mutasi>='$last') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR tgl_pindah>='$last') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR tgl_hapus>='$last')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR tgl_riwayat>='$last') ORDER BY a.kd_brg,a.tahun";
                   
                 $hasildd_ini = $this->db->QUERY($sqldd_ini);                     
                 
                foreach ($hasildd_ini->result() AS $rowdd_ini)
                    {
                        $cpaket_dd = $rowdd_ini->pake;
                        if($cpaket_dd == NULL){
                        $cpake_dd = $rowdd_ini->pake1;
                        }else{
                        $cpake_dd = $rowdd_ini->pake;
                        }

                        $cbulan_pake_ini_dd = $rowdd_ini->bulan_lalu;
                        $cbulan_lalu_dd = $cbulan_pake_ini_dd;                            
                        
                        $cakum_penyusutan_bulan_dd = $rowdd_ini->akum_penyusutan_bulan;
                        $cpenyusutan_bulan_dd = $rowdd_ini->penyusutan_bulan;

                        $cumur_bulan_baru_dd = $rowdd_ini->umur_bulan_baru;
                        if($cumur_bulan_baru_dd == 0){
                        $cumur_bulan_dd = $rowdd_ini->umur_bulan ;
                        }else{
                        $cumur_bulan_dd = $rowdd_ini->umur_bulan_baru ;
                        }

                        /*if($cbulan_lalu_dd < $cumur_bulan_dd){
                            if($cpake_dd<=$cbulan_lalu_dd)
                            { 
                                $bln_lalu_dd = ($cpake_dd*$cpenyusutan_bulan_dd)+($cakum_penyusutan_bulan_dd*($cbulan_lalu_dd-$cpake_dd)) ;
                                $bln_ini_dd = $rowdd_ini->akum_penyusutan_bulan + $bln_lalu_dd;
                                $penyusutan_bulan_dd = $rowdd_ini->akum_penyusutan_bulan;
                            }else{
                                $bln_lalu_dd= $rowdd_ini->tot_bln_belum ;                                                   
                                $bln_ini_dd = $rowdd_ini->penyusutan_bulan + $bln_lalu_dd;                        
                                $penyusutan_bulan_dd = $rowdd_ini->penyusutan_bulan;
                            }
                        }else{
                            $bln_lalu_dd= $rowdd_ini->nilai ;
                            $bln_ini_dd = 0 + $bln_lalu_dd;
                            $penyusutan_bulan_dd = 0;

                        }*/
                        if($cbulan_lalu_dd < $cumur_bulan_dd){
                                if($cpake_dd<=$cbulan_lalu_dd)
                                { 
                                    $bln_lalu_dd = ($cpake_dd*$cpenyusutan_bulan_dd)+($cakum_penyusutan_bulan_dd*($cbulan_lalu_dd-$cpake_dd)) ;
                                    $bln_ini_dd = $rowdd_ini->akum_penyusutan_bulan + $bln_lalu_dd;
                                    $penyusutan_bulan_dd = $rowdd_ini->akum_penyusutan_bulan;
                                }else{
                                    $bln_lalu_dd= $rowdd_ini->tot_bln_belum ;                                                   
                                     //kondisi untuk bulan penutupan,agar tidak ada sisa nilai buku koma                       
                                    if($cumur_bulan_dd==($cbulan_lalu_dd+1)){
                                        $penyusutan_bulan_dd = $rowdd_ini->nilai-$rowdd_ini->tot_bln_belum;
                                        $bln_ini_dd = $penyusutan_bulan_dd + $bln_lalu_dd;
                                    }else{
                                        $penyusutan_bulan_dd = $rowdd_ini->penyusutan_bulan;
                                        $bln_ini_dd = $rowdd_ini->penyusutan_bulan + $bln_lalu_dd;
                                    }

                                }
                            }else{
                                $bln_lalu_dd= $rowdd_ini->nilai ;
                                $bln_ini_dd = 0 + $bln_lalu_dd;
                                $penyusutan_bulan_dd = 0;

                            }
                        $tot_bukud_dd  = $rowdd_ini->nilai-$bln_ini_dd;
                        $npd    = $npd + $rowdd_ini->nilai;
                        $sptd   = $sptd + $penyusutan_bulan_dd;
                        $stld   = $stld + $bln_lalu_dd;
                        $sthid  = $sthid + $bln_ini_dd;
                        $nbd    = $nbd + $tot_bukud_dd;
                    }
            } 
            //akhir kib d thn jln 
            //AKHIR KIB D

                $sqle=mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai_kib_e
                                   FROM trkib_e a WHERE YEAR(a.tgl_peroleh) BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' 
                                   AND IF('$tahun'>='2016',a.kondisi<>'RB',a.kondisi<> '')
                                   AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                                   AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                                   AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')  
                                   AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')");
                $he=mysql_fetch_assoc($sqle);

                $pe = $he['nilai_kib_e'];

                $sqlf=mysql_query("SELECT IFNULL(SUM(CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                   WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                                   +(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                   WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                                   +(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                   WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))),0) AS nilai_kib_f
                                   FROM trkib_f a WHERE YEAR(a.tgl_oleh) BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' 
                                   AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                                   AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                                   AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')  
                                   AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR YEAR(a.tgl_riwayat)>'$tahun')
                                   AND (a.sts is null or a.sts='2' or(a.sts='1'and YEAR(a.tgl_riwayat) >'$tahun'))");
                $hf=mysql_fetch_assoc($sqlf);
                $pf = $hf['nilai_kib_f'];

                $jp = $pa+$npb+$npc+$npd+$pe+$pf;
                $jnb = $pa+$nbb+$nbc+$nbd+$pe+$pf;
                $js = $jp-$jnb;

                $jpa = $jpa+$pa;
                $jpb = $jpb+$npb;
                $jpc = $jpc+$npc;
                $jpd = $jpd+$npd;
                $jpe = $jpe+$pe;
                $jpf = $jpf+$pf;

                $jnbb = $jnbb+$nbb;
                $jnbc = $jnbc+$nbc;
                $jbnd = $jbnd+$nbd;

                $jmlp=$jmlp+$jp;
                $jmlnb=$jmlnb+$jnb;
                $jmls=$jmls+$js;
                $cRet .="<tr>
                            <td align=\"center\" style=\"font-size:11px\">$i</td>
                            <td align=\"left\" style=\"font-size:11px\">$nm_skpd</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pa,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($npb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($npc,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbc,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($npd,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbd,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pe,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pf,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($jp,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($jnb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($js,2,',','.')."</td>
                        </tr>";

            }
        
        }
          $cRet .="<tr>
                            <td bgcolor=\"#CCCCCC\" colspan=\"2\" align=\"center\" style=\"font-size:11px\"><b>JUMLAH</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpa,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jnbb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpc,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jnbc,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpd,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jbnd,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpe,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpf,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jmlp-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jmlnb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jmls,2,',','.')."</b></td>
                        </tr>";
            
         $cRet .="</table>"; 

         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"><br></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>";
            
        $cRet .=       " </table>";
         
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', '');
        $skpdx = ucfirst(strtolower($test));
        $judul  ="LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN";
        $this->template->set('title', 'LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN');  
        switch($cpilih) {
        case 1;
             //$this->_mpdf('', $cRet, 10, 10, 10, '1','','');
            $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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
        case 4;
            echo $cRet;
        break;
                }
    }
    function rekap_susutxx(){
        $cpilih = $_REQUEST['pilih'];
        $tahun1 = $_REQUEST['tahun1'];
        $tahun2 = $_REQUEST['tahun2'];
        $lctgl = $_REQUEST['lctgl'];
        $konfig     = $this->ambil_config();
        $tglcetak   = $this->tanggal_indonesia($lctgl);
        $kota       = ucfirst($konfig['kota']);
        $cRet="";
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">";
          $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN</B></td>
            </tr><BR/><BR/><BR/></table>";
        
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"2\" cellpadding=\"4\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>No</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"20%\" style=\"font-size:11px\"><b>SKPD</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB A(Tanah)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB B(Peralatan dan Mesin)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB C(Gedung dan Bangunan)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB D(Jalan,Irigasi dan Jembatan)</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB E(Aset Tetap Lainnya)</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB F(KDP)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>JUMLAH KIB A,B,C,D,E dan F</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>JUMLAH PENYUSUTAN</b></td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                
            </tr>
             </thead>
             <tfoot>
                    <tr>
                        <td colspan=\"14\" style=\"border:solid 1px white;border-top:solid 1px black;\"></td>
                    </tr>
                </tfoot>
             
                ";
            
            $sql = "SELECT kd_skpd,nm_skpd FROM ms_skpd ORDER BY kd_skpd";
            $hasil = $this->db->query($sql);
            $i=0;$jmlp=0;$jmlnb=0;$jmls=0;$jpa=0;$jpb=0;$jpc=0;$jpd=0;$jpe=0;$jpf=0;$jnbb=0;$jnbc=0;$jbnd=0;$X='0.13';//DIKURANGI 0.13 KARENA SELISIH DARI DATA BASRI YG SALAH SUM

            //$npb=0;$sptb=0;$stlb=0;$sthib=0;$nbb=0;  $npc=0;$sptc=0;$stlc=0;$sthic=0;$nbc=0;  $npd=0;$sptd=0;$stld=0;$sthid=0;$nbd=0;
            foreach ($hasil->result() as $row) {
                $i++;
                $skpd    = $row->kd_skpd;
                $nm_skpd = $row->nm_skpd;
                $npb=0;$sptb=0;$stlb=0;$sthib=0;$nbb=0;  $npc=0;$sptc=0;$stlc=0;$sthic=0;$nbc=0;  $npd=0;$sptd=0;$stld=0;$sthid=0;$nbd=0;
                $sqla=mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai_kib_a
                                   FROM trkib_a a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd='$skpd' 
                                   AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun2') 
                                   AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun2') 
                                   AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun2')  
                                   AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun2')");
                $ha=mysql_fetch_assoc($sqla);
                    $pa = $ha['nilai_kib_a'];

                $sqlb="SELECT IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))))*($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1
                            THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)
                            END),0)AS ada2_akm_thn_lalu,

                            IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1 
                            THEN 0 END),0)AS ada3_susut_per_thn,

                            (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                            CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,


                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN 0 END)
                            AS penyusutan_pertahun,
                            IF(a.tahun='$tahun2',0,(CASE 
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN a.nilai
                            END)) AS tot_th_belum

                            FROM trkib_b a
                            WHERE a.kd_skpd='$skpd' AND YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' 
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun2') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun2') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun2')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun2')";
                $hb = $this->db->query($sqlb);
                foreach ($hb->result() as $rowb) {

                    if($rowb->masa_manfaat_baru<>null){
                        $susut_per_tahun = $rowb->ada3_susut_per_thn;
                        $susut_thn_lalu = $rowb->ada2_akm_thn_lalu;
                        $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                        //$umur = $rowb->masa_manfaat_baru;
                        $nb = $rowb->nilai - $susut_thn_ini;
                    }else{
                        $susut_per_tahun = $rowb->penyusutan_pertahun;
                        $susut_thn_lalu = $rowb->tot_th_belum;
                        $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                        //$umur = $rowb->umur;
                        $nb = $rowb->nilai - $susut_thn_ini;
                    }

                    $npb    = $npb + $rowb->nilai;
                    $sptb   = $sptb + $susut_per_tahun;
                    $stlb   = $stlb + $susut_thn_lalu;
                    $sthib  = $sthib + $susut_thn_ini;
                    $nbb    = $nbb + $nb;
                }
                    

                $sqlc="SELECT IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))))*($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1
                            THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)
                            END),0)AS ada2_akm_thn_lalu,

                            IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1 
                            THEN 0 END),0)AS ada3_susut_per_thn,

                            (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                            CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                            
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN 0 END)AS penyusutan_pertahun,
                            IF(a.tahun='$tahun2',0,(CASE 
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN a.nilai END)) AS tot_th_belum

                            FROM trkib_c a
                            WHERE a.kd_skpd='$skpd' AND YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' 
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun2') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun2') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun2')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun2')";
                $hc = $this->db->query($sqlc);
                foreach ($hc->result() as $rowc) {

                    if($rowc->masa_manfaat_baru<>null){
                        $susut_per_tahun_c = $rowc->ada3_susut_per_thn;
                        $susut_thn_lalu_c = $rowc->ada2_akm_thn_lalu;
                        $susut_thn_ini_c = $susut_thn_lalu_c+$susut_per_tahun_c;
                        //$umur = $rowc->masa_manfaat_baru;
                        $nc = $rowc->nilai - $susut_thn_ini_c;
                    }else{
                        $susut_per_tahun_c = $rowc->penyusutan_pertahun;
                        $susut_thn_lalu_c = $rowc->tot_th_belum;
                        $susut_thn_ini_c = $susut_thn_lalu_c+$susut_per_tahun_c;
                        //$umur = $rowc->umur;
                        $nc = $rowc->nilai - $susut_thn_ini_c;
                    }

                    $npc    = $npc + $rowc->nilai;
                    $sptc   = $sptc + $susut_per_tahun_c;
                    $stlc   = $stlc + $susut_thn_lalu_c;
                    $sthic  = $sthic + $susut_thn_ini_c;
                    $nbc    = $nbc + $nc;
                }

                $sqld="SELECT IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))))*($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1
                            THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)
                            END),0)AS ada2_akm_thn_lalu,

                            IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun2' GROUP BY id_barang),
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 
                            THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)-a.tahun))-
                            (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))<1 
                            THEN 0 END),0)AS ada3_susut_per_thn,

                            (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))+($tahun2-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                            CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,


                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang))-($tahun2-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN 0 END)AS penyusutan_pertahun,
                            IF(a.tahun='$tahun2',0,(CASE 
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<1 THEN a.nilai END)) AS tot_th_belum

                            FROM trkib_d a
                            WHERE a.kd_skpd='$skpd' AND YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' 
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun2') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun2') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun2')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun2')";
                $hd = $this->db->query($sqld);
                foreach ($hd->result() as $rowd) {

                    if($rowd->masa_manfaat_baru<>null){
                        $susut_per_tahun_d = $rowd->ada3_susut_per_thn;
                        $susut_thn_lalu_d = $rowd->ada2_akm_thn_lalu;
                        $susut_thn_ini_d = $susut_thn_lalu_d+$susut_per_tahun_d;
                        //$umur = $rowd->masa_manfaat_baru;
                        $nd = $rowd->nilai - $susut_thn_ini_d;
                    }else{
                        $susut_per_tahun_d = $rowd->penyusutan_pertahun;
                        $susut_thn_lalu_d = $rowd->tot_th_belum;
                        $susut_thn_ini_d = $susut_thn_lalu_d+$susut_per_tahun_d;
                        //$umur = $rowd->umur;
                        $nd = $rowd->nilai - $susut_thn_ini_d;
                    }

                    $npd    = $npd + $rowd->nilai;
                    $sptd   = $sptd + $susut_per_tahun_d;
                    $stld   = $stld + $susut_thn_lalu_d;
                    $sthid  = $sthid + $susut_thn_ini_d;
                    $nbd    = $nbd + $nd;
                }

                $sqle=mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai_kib_e
                                   FROM trkib_e a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd='$skpd' 
                                   AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun2') 
                                   AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun2') 
                                   AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun2')  
                                   AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun2')");
                $he=mysql_fetch_assoc($sqle);

                $pe = $he['nilai_kib_e'];

                $sqlf=mysql_query("SELECT IFNULL(SUM(CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                   WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)
                                   +(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                   WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang)
                                   +(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                   WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun2' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))),0) AS nilai_kib_f
                                   FROM trkib_f a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd='$skpd' 
                                   AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun2') 
                                   AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun2') 
                                   AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun2')  
                                   AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR YEAR(a.tgl_riwayat)>'$tahun2')");
                $hf=mysql_fetch_assoc($sqlf);
                $pf = $hf['nilai_kib_f'];

                /*$jp = $pa+$npb+$npc+$npd+$pe+$pf;
                $jnb = $pa+($npb-$sthib)+($npc-$sthic)+($npd-$sthid)+$pe+$pf;
                $js = $jp-$jnb;*/


                $jp = $pa+$npb+$npc+$npd+$pe+$pf;
                $jnb = $pa+$nbb+$nbc+$nbd+$pe+$pf;
                $js = $jp-$jnb;
                //$js = $nbb+$nbc+$nbd;

                $jpa = $jpa+$pa;
                $jpb = $jpb+$npb;
                $jpc = $jpc+$npc;
                $jpd = $jpd+$npd;
                $jpe = $jpe+$pe;
                $jpf = $jpf+$pf;

                $jnbb = $jnbb+$nbb;
                $jnbc = $jnbc+$nbc;
                $jbnd = $jbnd+$nbd;

                $jmlp=$jmlp+$jp;
                $jmlnb=$jmlnb+$jnb;
                $jmls=$jmls+$js;
                $cRet .="<tr>
                            <td align=\"center\" style=\"font-size:11px\">$i</td>
                            <td align=\"left\" style=\"font-size:11px\">$nm_skpd</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pa,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($npb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($npc,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbc,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($npd,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbd,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pe,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pf,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($jp,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($jnb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($js,2,',','.')."</td>
                        </tr>";

                

            }
                $cRet .="<tr>
                            <td bgcolor=\"#CCCCCC\" colspan=\"2\" align=\"center\" style=\"font-size:11px\"><b>JUMLAH</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpa,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jnbb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpc,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jnbc,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpd,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jbnd,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpe,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpf,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jmlp-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jmlnb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jmls,2,',','.')."</b></td>
                        </tr>";
            
         $cRet .="</table>"; 

         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"><br></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>";
            
        $cRet .=       " </table>";
         
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', '');
        $skpdx = ucfirst(strtolower($test));
        $judul  ="LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN";
        $this->template->set('title', 'LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN');  
        switch($cpilih) {
        case 1;
             //$this->_mpdf('', $cRet, 10, 10, 10, '1','','');
            $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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
        case 4;
            echo $cRet;
        break;
                }
    }

    function rekap_susut2(){
        $cpilih = $_REQUEST['pilih'];
        $tahun1 = $_REQUEST['tahun1'];
        $tahun2 = $_REQUEST['tahun2'];
        $lctgl = $_REQUEST['lctgl'];
        $konfig     = $this->ambil_config();
        $tglcetak   = $this->tanggal_indonesia($lctgl);
        $kota       = ucfirst($konfig['kota']);
        $cRet="";
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">";
          $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN</B></td>
            </tr><BR/><BR/><BR/></table>";
        
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"2\" cellpadding=\"4\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>No</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"20%\" style=\"font-size:11px\"><b>SKPD</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB A(Tanah)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB B(Peralatan dan Mesin)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB C(Gedung dan Bangunan)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB D(Jalan,Irigasi dan Jembatan)</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB E(Aset Tetap Lainnya)</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB F(KDP)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>JUMLAH KIB A,B,C,D,E dan F</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>JUMLAH PENYUSUTAN</b></td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                
            </tr>
             </thead>
             <tfoot>
                    <tr>
                        <td colspan=\"14\" style=\"border:solid 1px white;border-top:solid 1px black;\"></td>
                    </tr>
                </tfoot>
             
                ";
            
            $sql = "SELECT d.kd_skpd,d.nm_skpd,
                    (SELECT IFNULL(SUM(a.nilai),0)
                    FROM trkib_a a WHERE a.tahun BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd 
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9'))AS nilai_kib_a,

                    (SELECT IFNULL(SUM(a.nilai),0)
                    FROM trkib_b a WHERE a.tahun BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd 
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9'))AS nilai_kib_b,
                    (SELECT IFNULL(SUM(
                    IF(a.tahun='$tahun2',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                    WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<=1 THEN a.nilai
                    WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    END))),0) FROM trkib_b a WHERE a.tahun BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9'))AS akm_kib_b,
                    
                    (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_c a WHERE a.tahun BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd 
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9'))AS nilai_kib_c,
                    (SELECT IFNULL(SUM(IF(a.tahun='$tahun2',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                    WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<=1 THEN a.nilai
                    WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    END))),0) FROM trkib_c a WHERE a.tahun BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd 
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9'))AS akm_kib_c,
                    
                    (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_d a 
                    WHERE a.tahun BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd 
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9'))AS nilai_kib_d,
                    (SELECT IFNULL(SUM(IF(a.tahun='$tahun2',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                    WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<=1 THEN a.nilai 
                    WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                    END))),0) FROM trkib_d a WHERE a.tahun BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd 
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9'))AS akm_kib_d,

                    (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_e a 
                    WHERE a.tahun BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd 
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9'))AS nilai_kib_e,

                    (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_f a 
                    WHERE a.tahun BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd 
                    AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9'))AS nilai_kib_f
                    FROM ms_skpd d ORDER BY d.kd_skpd";
            $hasil = $this->db->query($sql);
            $i=0;$jmlp=0;$jmlnb=0;$jmls=0;$jpa=0;$jpb=0;$jpc=0;$jpd=0;$jpe=0;$jpf=0;$jnbb=0;$jnbc=0;$jbnd=0;$X='0.13';//DIKURANGI 0.13 KARENA SELISIH DARI DATA BASRI YG SALAH SUM
            foreach ($hasil->result() as $row) {
                $i++;
                $nm_skpd = $row->nm_skpd;
                $pa     = $row->nilai_kib_a;
                $pb     = $row->nilai_kib_b;
                $akmb   = $row->akm_kib_b;
                $pc     = $row->nilai_kib_c;
                $akmc   = $row->akm_kib_c;
                $pd     = $row->nilai_kib_d;
                $akmd   = $row->akm_kib_d;
                $pe     = $row->nilai_kib_e;
                $pf     = $row->nilai_kib_f;

                

                $nbb = $pb-$akmb;
                $nbc = $pc-$akmc;
                $nbd = $pd-$akmd;

                $jp = $pa+$pb+$pc+$pd+$pe+$pf;
                $jnb = $pa+($pb-$akmb)+($pc-$akmc)+($pd-$akmd)+$pe+$pf;
                $js = $jp-$jnb;
                //$js = $nbb+$nbc+$nbd;

                $jpa = $jpa+$pa;
                $jpb = $jpb+$pb;
                $jpc = $jpc+$pc;
                $jpd = $jpd+$pd;
                $jpe = $jpe+$pe;
                $jpf = $jpf+$pf;

                $jnbb = $jnbb+$nbb;
                $jnbc = $jnbc+$nbc;
                $jbnd = $jbnd+$nbd;

                $jmlp=$jmlp+$jp;
                $jmlnb=$jmlnb+$jnb;
                $jmls=$jmls+$js;

                $cRet .="<tr>
                            <td align=\"center\" style=\"font-size:11px\">$i</td>
                            <td align=\"left\" style=\"font-size:11px\">$nm_skpd</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pa,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pc,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbc,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pd,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($nbd,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pe,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($pf,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($jp,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($jnb,2,',','.')."</td>
                            <td align=\"right\" style=\"font-size:11px\">".number_format($js,2,',','.')."</td>
                        </tr>";

            }
                $cRet .="<tr>
                            <td bgcolor=\"#CCCCCC\" colspan=\"2\" align=\"center\" style=\"font-size:11px\"><b>JUMLAH</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpa,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jnbb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpc,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jnbc,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpd,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jbnd,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpe,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jpf,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jmlp-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jmlnb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px\"><b>".number_format($jmls,2,',','.')."</b></td>
                        </tr>";
            
         $cRet .="</table>"; 

         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"><br></td>
            </tr>
                
            <tr>
                <td width=\"35%\"></td>
                <td width=\"35%\"></td>
                <td align=\"center\" style=\"font-size:11px\">$kota, $tglcetak</td>
            </tr>";
            
        $cRet .=       " </table>";
         
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', '');
        $skpdx = ucfirst(strtolower($test));
        $judul  ="LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN";
        $this->template->set('title', 'LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN');  
        switch($cpilih) {
        case 1;
             //$this->_mpdf('', $cRet, 10, 10, 10, '1','','');
            $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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

    function rekap_susut_bidang()
    {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $data['page_title']= 'REKAP PENYUSUTAN BIDANG';
        $data['page_title']= 'REKAP PENYUSUTAN BIDANG';
        $this->template->set('title', 'REKAP PENYUSUTAN BIDANG');   
        $this->template->load('index','kebijakan/lap_susut_bidang',$data);
        } 
    }

function rekapitulasi_susut_bidang(){
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        $skpd       = $_REQUEST['skpd'];
        $nmskpd     = $_REQUEST['nmskpd'];
        $cpilih = $_REQUEST['pilih'];
        $blnthn = $_REQUEST['blnthn'];
        if($blnthn=='02'){
            $tahun1  = $_REQUEST['tahun1'];
            $tahun2   = $_REQUEST['tahun2'];
            
        }else{
            $bulan  = $_REQUEST['bulan'];
            $tahun  = $_REQUEST['tahun3'];
            $dcetak=$tahun."-".$bulan."-".'31';
            $last=date('Y-m-t',strtotime($dcetak));
            $periodbulan = strtoupper($this->getBulan($bulan));
        }
        $cRet="";
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">";
          $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN BIDANG</B></td>
            </tr><BR/><BR/><BR/></table>";
        
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          
 
        $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:12px;\" width =\"10%\" ><b>&ensp;&ensp;SKPD</b></td>
                <td align=\"left\" style=\"font-size:12px;\"><b>: $skpd  $nmskpd</b></td>
            </tr>";
        $cRet .="<tr>
                <td align=\"left\" style=\"font-size:12px;\"><b>&ensp;&ensp;KABUPATEN</b></td>
                <td align=\"left\" style=\"font-size:12px;\"><b>: $nmkab</b></td>
            </tr>";

        if($blnthn=='02'){
        $cRet .="<tr>
            <td align=\"left\" style=\"font-size:12px;\"><b>&ensp;&ensp;PERIODE</b></td>
            <td align=\"left\" style=\"font-size:12px;\"><b>: $tahun1 s.d $tahun2</b></td>
        </tr>";
        }else{
        $cRet .="<tr>
            <td align=\"left\" style=\"font-size:12px;\"><b>&ensp;&ensp;PERIODE</b></td>
            <td align=\"left\" style=\"font-size:12px;\"><b>: $periodbulan $tahun</b></td>
        </tr>";
        }

        $cRet .="</table>";

        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"2\" cellpadding=\"4\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>No</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"20%\" style=\"font-size:11px\"><b>BIDANG</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB A (Tanah)</b></td>
                <td colspan=\"3\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB B (Peralatan dan Mesin)</b></td>
                <td colspan=\"3\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB C (Gedung dan Bangunan)</b></td>
                <td colspan=\"3\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB D (Jalan,Irigasi dan Jembatan)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB E (Aset Tetap Lainnya)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB F (KDP)</b></td>
                <td colspan=\"3\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>JUMLAH KIB A,B,C,D,E dan F</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>JUMLAH PENYUSUTAN</b></td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>

                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>

                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>

                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>

                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                
            </tr>
             </thead>
             <tfoot>
                    <tr>
                        <td colspan=\"14\" style=\"border:solid 1px white;border-top:solid 1px black;\"></td>
                    </tr>
                </tfoot>
             
                ";
            if($blnthn=='02'){
                $csql = "SELECT * FROM mrekap_susut WHERE kd_brg <> '' ORDER BY no_urut"; 
                $chasil = $this->db->query($csql);
                $jmlp=0;$jmlnb=0;$jmls=0;$jpa=0;$jpb=0;$jpc=0;$jpd=0;$jpe=0;$jpf=0;$jnbb=0;$jnbc=0;$jbnd=0;$X='0';
                $jtota=0;$jtotb=0;$jtotc=0;$jtotd=0;$jtote=0;$jtotf=0;$jtotal=0;
                foreach ($chasil->result() as $rowc)
                {   
                $cgol = $rowc->gol;
                $cseq = $rowc->seq;
                $cnama = $rowc->nama;
                $ckd_brg = $rowc->kd_brg;

                    if(strlen($ckd_brg)==5)
                    {                                   
                        $sql = "SELECT d.kd_skpd,d.nm_skpd,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_a a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS jum_a,

                                (SELECT IFNULL(SUM(a.nilai),0)
                                FROM trkib_a a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_a,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_b a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS jum_b,

                                (SELECT IFNULL(SUM(a.nilai),0)
                                FROM trkib_b a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_b,
                                (SELECT IFNULL(SUM(
                                IF(a.tahun='$tahun2',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<=1 THEN a.nilai
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                                END))),0) FROM trkib_b a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS akm_kib_b,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_c a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS jum_c,

                                (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_c a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_c,
                                (SELECT IFNULL(SUM(IF(a.tahun='$tahun2',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<=1 THEN a.nilai
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                                END))),0) FROM trkib_c a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS akm_kib_c,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_d a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS jum_d,

                                (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_d a 
                                WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_d,
                                (SELECT IFNULL(SUM(IF(a.tahun='$tahun2',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<=1 THEN a.nilai 
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                                END))),0) FROM trkib_d a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS akm_kib_d,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_e a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS jum_e,

                                (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_e a 
                                WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_e,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_f a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND SUBSTR(a.kd_brg,1,5) = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS jum_f,

                                (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_f a 
                                WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and SUBSTR(a.kd_brg,1,5) = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_f
                            FROM ms_skpd d where d.kd_skpd = '$skpd' ORDER BY d.kd_skpd";
                        $hasil = $this->db->query($sql);
                        $i=0;//$jmlp=0;$jmlnb=0;$jmls=0;$jpa=0;$jpb=0;$jpc=0;$jpd=0;$jpe=0;$jpf=0;$jnbb=0;$jnbc=0;$jbnd=0;$X='0';//DIKURANGI 0.13 KARENA SELISIH DARI DATA BASRI YG SALAH SUM
                        foreach ($hasil->result() as $row) {
                            $i++;
                            $nm_skpd = $row->nm_skpd;
                            $pa     = $row->nilai_kib_a;
                            $pb     = $row->nilai_kib_b;
                            $akmb   = $row->akm_kib_b;
                            $pc     = $row->nilai_kib_c;
                            $akmc   = $row->akm_kib_c;
                            $pd     = $row->nilai_kib_d;
                            $akmd   = $row->akm_kib_d;
                            $pe     = $row->nilai_kib_e;
                            $pf     = $row->nilai_kib_f;
                            $cjum_a = $row->jum_a;
                            $cjum_b = $row->jum_b;
                            $cjum_c = $row->jum_c;
                            $cjum_d = $row->jum_d;
                            $cjum_e = $row->jum_e;
                            $cjum_f = $row->jum_f;
                            $jjumlah = $cjum_a+$cjum_b+$cjum_c+$cjum_d+$cjum_e+$cjum_f;

                            $jtota = $jtota + $cjum_a ;
                            $jtotb = $jtotb + $cjum_b ;
                            $jtotc = $jtotc + $cjum_c ;
                            $jtotd = $jtotd + $cjum_d ;
                            $jtote = $jtote + $cjum_e ;
                            $jtotf = $jtotf + $cjum_f ;
                            $jtotal = $jtota + $jtotb + $jtotc + $jtotd + $jtote + $jtotf ;

                            $nbb = $pb-$akmb;
                            $nbc = $pc-$akmc;
                            $nbd = $pd-$akmd;

                            $jp = $pa+$pb+$pc+$pd+$pe+$pf;
                            $jnb = $pa+($pb-$akmb)+($pc-$akmc)+($pd-$akmd)+$pe+$pf;
                            $js = $jp-$jnb;

                            $jpa = $jpa+$pa;
                            $jpb = $jpb+$pb;
                            $jpc = $jpc+$pc;
                            $jpd = $jpd+$pd;
                            $jpe = $jpe+$pe;
                            $jpf = $jpf+$pf;

                            $jnbb = $jnbb+$nbb;
                            $jnbc = $jnbc+$nbc;
                            $jbnd = $jbnd+$nbd;

                            $jmlp=$jmlp+$jp;
                            $jmlnb=$jmlnb+$jnb;
                            $jmls=$jmls+$js;

                        $cRet .="<tr>
                                    <td align=\"left\" style=\"font-size:12px\">$ckd_brg</td>
                                    <td align=\"left\" style=\"font-size:12px\">$cnama</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_a</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pa,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_b</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pb,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($nbb,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_c</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pc,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($nbc,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_d</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pd,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($nbd,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_e</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pe,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_f</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pf,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$jjumlah</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($jp,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($jnb,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($js,2,',','.')."</td>
                                </tr>";
                        }

                    }else{
                        $cRet .="<tr>
                                    <td align=\"left\" style=\"font-size:12px\"><b>$ckd_brg</b></td>
                                    <td align=\"left\" style=\"font-size:12px\"><b>$cnama</b></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                </tr>"; 
                    }                                   
                }
            }else{
                //Awal Konsep Bulan dan Tahun
                $csql = "SELECT * FROM mrekap_susut WHERE kd_brg <> '' ORDER BY no_urut"; 
                $chasil = $this->db->query($csql);

                $jmlp=0;$jmlnb=0;$jmls=0;$jpa=0;$jpb=0;$jpc=0;$jpd=0;$jpe=0;$jpf=0;$jnbb=0;$jnbc=0;$jbnd=0;$X='0';
                $jtota=0;$jtotb=0;$jtotc=0;$jtotd=0;$jtote=0;$jtotf=0;$jtotal=0;

                foreach ($chasil->result() as $row)
                {   
                $cgol = $row->gol;
                $cseq = $row->seq;
                $cnama = $row->nama;
                $ckd_brg = $row->kd_brg;

                    if(strlen($ckd_brg)==5)
                    {   
                        $npb=0;$sptb=0;$stlb=0;$sthib=0;$nbb=0;  $npc=0;$sptc=0;$stlc=0;$sthic=0;$nbc=0;  $npd=0;$sptd=0;$stld=0;$sthid=0;$nbd=0;
                        $jum_a=0;$njum_b=0;$njum_c=0;$njum_d=0;$jum_e=0;$jum_f=0; $nilaib=0;$nilaic=0;$nilaid=0;                    
                        // kib a                        
                        $sqla=mysql_query("SELECT d.kd_skpd,d.nm_skpd,
                        (SELECT IFNULL(SUM(a.jumlah),0)
                        FROM trkib_a a WHERE a.tgl_oleh <='$last' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi >='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah >='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus >='$last')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat >='$last'))AS jum_a,
                        (SELECT IFNULL(SUM(a.nilai),0)
                        FROM trkib_a a WHERE a.tgl_oleh <='$last' AND a.kd_skpd='$skpd' and a.kd_bidang = '$ckd_brg' 
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi >='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah >='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus >='$last')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat >='$last'))AS nilai_kib_a
                        FROM ms_skpd d where d.kd_skpd = '$skpd' ORDER BY d.kd_skpd");
                        $ha=mysql_fetch_assoc($sqla);
                        $kd_skpd = $ha['kd_skpd'];
                        $nm_skpd = $ha['nm_skpd'];
                        $jum_a = $ha['jum_a'];
                        $nilai_kib_a = $ha['nilai_kib_a'];
                        //kib a akhir

                        //kib b
                        /*$sqlb="SELECT a.id_barang,a.kd_brg AS kode,
                            IF(a.tahun='2015',1,(2015-a.tahun+1)) AS th_lalu,                    
                            IF(a.tahun='2015',0,(CASE 
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))>1 THEN CAST((2015-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN a.nilai
                            END)) AS tot_th_belum, 
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='2015' AND b.id_barang=a.id_barang))-(2015-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN 0 END)
                            AS penyusutan_pertahun
                            FROM trkib_b a
                            LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                            LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                            WHERE a.kd_skpd='$skpd' 
                            AND kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '1945' AND '2015' AND a.kd_bidang = '$ckd_brg' 
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

                         $hasilb = $this->db->query($sqlb);
                         
                         foreach ($hasilb->result() as $rowb)
                        {                
                            $cid_barang_b = $rowb->id_barang;
                            $cth_lalu_b = $rowb->th_lalu * 12;                
                            $susut_per_tahun_b = $rowb->penyusutan_pertahun;
                            $susut_thn_lalu_b = $rowb->tot_th_belum;
                            $susut_thn_ini_b = $susut_thn_lalu_b+$susut_per_tahun_b;
                     
                            $sqlbb = "SELECT (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_b a WHERE YEAR(a.tgl_reg) BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun'))AS jum_b,

                                MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                                IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                                (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))
                                ,0)AS umur_bulan_baru,

                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                                FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                                (SELECT (('$tahun'-YEAR(a.tgl_oleh)+1)*12) - (MONTH(a.tgl_reg)-'$bulan')) AS pake1,
                                CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                                TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12)-1)
                                AS bulan_lalu,

                                TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12))
                                AS bulan_ini,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                                (CASE 
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>=0 
                                THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-'2015')*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                                THEN a.nilai
                                END)
                                AS tot_bln_belum,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                                THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                                FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                                (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                                ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                                FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan

                                FROM trkib_b a
                                LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                                LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                                WHERE kd_barang<>'' AND a.tgl_reg<='$last' AND a.kd_skpd='$skpd' and a.id_barang='$cid_barang_b' AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
                               
                             $hasilbb = $this->db->query($sqlbb);                     
                             
                            foreach ($hasilbb->result() as $rowbb)
                                {
                                    $jum_b = $rowbb->jum_b;
                                    $cpaket_b = $rowbb->pake;
                                    if ($cpaket_b == NULL){
                                    $cpake_b = $rowbb->pake1;
                                    }else{
                                    $cpake_b = $rowbb->pake;
                                    }

                                    $cbulan_pake_ini_b = $rowbb->bulan_lalu;
                                    $cbulan_lalu_b = $cbulan_pake_ini_b + $cth_lalu_b;                            
                                    
                                    $cakum_penyusutan_bulan_b = $rowbb->akum_penyusutan_bulan;
                                    $cpenyusutan_bulan_b = $rowbb->penyusutan_bulan;

                                    $cumur_bulan_baru_b = $rowbb->umur_bulan_baru;
                                    if($cumur_bulan_baru_b == 0){
                                    $cumur_bulan_b = $rowbb->umur_bulan ;
                                    }else{
                                    $cumur_bulan_b = $rowbb->umur_bulan_baru ;
                                    }

                                    if($cbulan_lalu_b < $cumur_bulan_b){
                                        if($cpake_b<=$cbulan_lalu_b)
                                        { 
                                            $bln_lalu_b = ($cpake_b*$cpenyusutan_bulan_b)+($cakum_penyusutan_bulan_b*($cbulan_lalu_b-$cpake_b)) ;
                                            $bln_ini_b = $rowbb->akum_penyusutan_bulan + $bln_lalu_b;
                                            $penyusutan_bulan_b = $rowbb->akum_penyusutan_bulan;
                                        }else{
                                            if($cumur_bulan_b>=$cbulan_lalu_b){
                                             $bln_lalu_b= $susut_thn_ini_b + $rowbb->tot_bln_belum ;    
                                            }else{
                                             $bln_lalu_b= $rowbb->tot_bln_belum ;    
                                            }                                                   
                                            $bln_ini_b = $rowbb->penyusutan_bulan + $bln_lalu_b;                        
                                            $penyusutan_bulan_b = $rowbb->penyusutan_bulan;
                                        }
                                    }else{
                                        $bln_lalu_b= $rowbb->nilai ;
                                        $bln_ini_b = 0 + $bln_lalu_b;
                                        $penyusutan_bulan_b = 0;

                                    }
                                    $njum_b = $jum_b;
                                    $nilaib  = $nilaib + $rowbb->nilai;
                                    $sthib  = $sthib + $bln_ini_b;
                                }
                        }*/
                        $sqlb="SELECT a.id_barang,a.kd_brg AS kode FROM trkib_b a
                            LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok WHERE a.kd_skpd='$skpd' 
                            AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015' AND a.kd_bidang = '$ckd_brg' 
                            AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

                         $hasilb = $this->db->query($sqlb);
                         
                         foreach ($hasilb->result() as $rowb)
                        {                
                            $cid_barang_b = $rowb->id_barang;
                        $sqlbb="SELECT a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,
                        (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_b a LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok 
                                WHERE YEAR(a.tgl_oleh) BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                                AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun'))AS jum_b,
                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),0)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_b a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok 

                        WHERE a.kd_skpd='$skpd' AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015' AND a.kd_bidang = '$ckd_brg' and a.id_barang='$cid_barang_b'
                        AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')order by a.kd_brg,a.tahun,a.no_reg";
                        $hasilbb = $this->db->query($sqlbb);                     
                             $susut_thn_ini=0;
                            foreach ($hasilbb->result() as $rowbb)
                                {
                                    if($rowbb->masa_manfaat_baru<>null){
                                        $susut_per_tahun = $rowbb->ada3_susut_per_thn;
                                        $susut_thn_lalu = $rowbb->ada2_akm_thn_lalu;
                                        $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                                        $umur = $rowbb->masa_manfaat_baru;
                                        $nb = $rowbb->nilai - $susut_thn_ini;
                                        //$sthib  = $sthib + $susut_thn_ini;
                                    }else{
                                        $susut_per_tahun = $rowbb->penyusutan_pertahun;
                                        $susut_thn_lalu = $rowbb->tot_th_belum;
                                        $susut_thn_ini = $susut_thn_lalu+$susut_per_tahun;
                                        $umur = $rowbb->umur;
                                        $nb = $rowbb->nilai - $susut_thn_ini;
                                        
                                    }
                                    $jum_b = $rowbb->jum_b;
                                    $njum_b = $jum_b;
                                    $nilaib  = $nilaib + $rowbb->nilai;
                                    $sthib  = $sthib + $susut_thn_ini;
                                }
                        }
                        //awal kib b thn jln
                        $sqlb_ini="SELECT a.id_barang,a.kd_brg AS kode,
                            IF(a.tahun='$tahun',1,('$tahun'-a.tahun+1)) AS th_lalu,                    
                            IF(a.tahun='$tahun',0,(CASE 
                            WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))>1 THEN CAST(('$tahun'-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN a.nilai
                            END)) AS tot_th_belum, 
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))-('$tahun'-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN 0 END)
                            AS penyusutan_pertahun
                            FROM trkib_b a
                            LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                            LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                            WHERE a.kd_skpd='$skpd' 
                            AND a.tgl_oleh BETWEEN '2016-01-01' AND '$last' AND a.kd_bidang = '$ckd_brg' 
                            AND IF('$last'>='2016-01-01',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')ORDER BY a.kd_brg,a.tahun,a.no_reg";

                         $hasilb_ini = $this->db->query($sqlb_ini);
                         
                         foreach ($hasilb_ini->result() as $rowb)
                        {                
                            $cid_barang_bb = $rowb->id_barang;
                            $cth_lalu_bb = $rowb->th_lalu * 12;                
                            $susut_per_tahun_bb = $rowb->penyusutan_pertahun;
                            $susut_thn_lalu_bb = $rowb->tot_th_belum;
                            $susut_thn_ini_bb = $susut_thn_lalu_bb+$susut_per_tahun_bb;
                     
                            $sqlbb_ini = "SELECT (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_b a WHERE YEAR(a.tgl_oleh) BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun'))AS jum_b,

                                MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.merek,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                                IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap BETWEEN '2016-01-01' AND '$last' GROUP BY id_barang),
                                (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))
                                ,0)AS umur_bulan_baru,

                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                                FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                                (SELECT (('$tahun'-YEAR(a.tgl_oleh))*12) - (MONTH(a.tgl_oleh)-'$bulan')+1) AS pake1, 

                                CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                                TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-2016)*12))
                                AS bulan_lalu,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                                (CASE 
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12))>=0 
                                THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-2016)*12))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                                THEN a.nilai
                                END)
                                AS tot_bln_belum,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                                THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                                FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                                (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))) / 
                                ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                                FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan,
                                a.kondisi

                                FROM trkib_b a
                                LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                                LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok
                                WHERE a.kd_skpd='$skpd' AND a.id_barang ='$cid_barang_bb' 
                                AND a.tgl_oleh BETWEEN '2016-01-01' AND '$last'
                                AND IF('$last'>='2016-01-01',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR tgl_mutasi>='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR tgl_pindah>='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR tgl_hapus>='$last')
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR tgl_riwayat>='$last') ORDER BY a.kd_brg,a.tahun";
                               
                             $hasilbb_ini = $this->db->query($sqlbb_ini);                     
                             
                            foreach ($hasilbb_ini->result() as $rowbb)
                                {
                                    $cpaket_bb = $rowbb->pake;
                                    if ($cpaket_bb == NULL){
                                    $cpake_bb = $rowbb->pake1;
                                    }else{
                                    $cpake_bb = $rowbb->pake;
                                    }

                                    $cbulan_pake_ini_bb = $rowbb->bulan_lalu;
                                    $cbulan_lalu_bb = $cbulan_pake_ini_bb;                            
                                    
                                    $cakum_penyusutan_bulan_bb = $rowbb->akum_penyusutan_bulan;
                                    $cpenyusutan_bulan_bb = $rowbb->penyusutan_bulan;

                                    $cumur_bulan_baru_bb = $rowbb->umur_bulan_baru;
                                    if($cumur_bulan_baru_bb == 0){
                                    $cumur_bulan_bb = $rowbb->umur_bulan ;
                                    }else{
                                    $cumur_bulan_bb = $rowbb->umur_bulan_baru ;
                                    }

                                    /*if($cbulan_lalu_bb < $cumur_bulan_bb){
                                        if($cpake_bb<=$cbulan_lalu_bb)
                                        { 
                                            $bln_lalu_bb = ($cpake_bb*$cpenyusutan_bulan_bb)+($cakum_penyusutan_bulan_bb*($cbulan_lalu_bb-$cpake_bb)) ;
                                            $bln_ini_bb = $rowbb->akum_penyusutan_bulan + $bln_lalu_bb;
                                            $penyusutan_bulan_bb = $rowbb->akum_penyusutan_bulan;
                                        }else{
                                            $bln_lalu_bb= $rowbb->tot_bln_belum ;                                                  
                                            $bln_ini_bb = $rowbb->penyusutan_bulan + $bln_lalu_bb;                        
                                            $penyusutan_bulan_bb = $rowbb->penyusutan_bulan;
                                        }
                                    }else{
                                        $bln_lalu_bb= $rowbb->nilai ;
                                        $bln_ini_bb = 0 + $bln_lalu_bb;
                                        $penyusutan_bulan_bb = 0;

                                    }*/
                                    if($cbulan_lalu_bb < $cumur_bulan_bb){
                                        if($cpake_bb<=$cbulan_lalu_bb)
                                        { 
                                            $bln_lalu_bb = ($cpake_bb*$cpenyusutan_bulan_bb)+($cakum_penyusutan_bulan_bb*($cbulan_lalu_bb-$cpake_bb)) ;
                                            $bln_ini_bb = $rowbb->akum_penyusutan_bulan + $bln_lalu_bb;
                                            $penyusutan_bulan_bb = $rowbb->akum_penyusutan_bulan;
                                        }else{
                                            $bln_lalu_bb= $rowbb->tot_bln_belum ;                                                   
                                             //kondisi untuk bulan penutupan,agar tidak ada sisa nilai buku koma                       
                                            if($cumur_bulan_bb==($cbulan_lalu_bb+1)){
                                                $penyusutan_bulan_bb = $rowbb->nilai-$rowbb->tot_bln_belum;
                                                $bln_ini_bb = $penyusutan_bulan_bb + $bln_lalu_bb;
                                            }else{
                                                $penyusutan_bulan_bb = $rowbb->penyusutan_bulan;
                                                $bln_ini_bb = $rowbb->penyusutan_bulan + $bln_lalu_bb;
                                            }

                                        }
                                    }else{
                                        $bln_lalu_bb= $rowbb->nilai ;
                                        $bln_ini_bb = 0 + $bln_lalu_bb;
                                        $penyusutan_bulan_bb = 0;

                                    }
                                    $nilaib  = $nilaib + $rowbb->nilai;
                                    $sthib  = $sthib + $bln_ini_bb;
                                }
                        }
                        //akhir kib b thn jln
                        //kib b akhir

                        //kib c
                        /*$sqlc="SELECT a.id_barang,a.kd_brg AS kode,
                            IF(a.tahun='2015',1,(2015-a.tahun+1)) AS th_lalu,                    
                            IF(a.tahun='2015',0,(CASE 
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))>1 THEN CAST((2015-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN a.nilai
                            END)) AS tot_th_belum, 
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='2015' AND b.id_barang=a.id_barang))-(2015-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN 0 END)
                            AS penyusutan_pertahun
                            FROM trkib_c a
                            LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                            LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                            WHERE a.kd_skpd='$skpd' 
                            AND kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '1945' AND '2015' AND a.kd_bidang = '$ckd_brg' 
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

                         $hasilc = $this->db->query($sqlc);
                         
                         foreach ($hasilc->result() AS $rowc)
                        {                
                            $cid_barang_c = $rowc->id_barang;
                            $cth_lalu_c = $rowc->th_lalu * 12;                
                            $susut_per_tahun_c = $rowc->penyusutan_pertahun;
                            $susut_thn_lalu_c = $rowc->tot_th_belum;
                            $susut_thn_ini_c = $susut_thn_lalu_c+$susut_per_tahun_c;
                     
                            $sqlcc = "SELECT (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_c a WHERE a.tahun BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun'))AS jum_c,

                                MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                                IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                                (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))
                                ,0)AS umur_bulan_baru,

                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                                FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                                (SELECT (('$tahun'-YEAR(a.tgl_oleh)+1)*12) - (MONTH(a.tgl_reg)-'$bulan')) AS pake1, 
                                CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                                TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12)-1)
                                AS bulan_lalu,

                                TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12))
                                AS bulan_ini,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                                (CASE 
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>=0 
                                THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-'2015')*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                                THEN a.nilai
                                END)
                                AS tot_bln_belum,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                                THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                                FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                                (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                                ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                                FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan

                                FROM trkib_c a
                                LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                                LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                                WHERE kd_barang<>'' AND a.tgl_reg<='$last' AND a.kd_skpd='$skpd' and a.id_barang='$cid_barang_c' AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
                               
                             $hasilcc = $this->db->query($sqlcc);                     
                             
                            foreach ($hasilcc->result() AS $rowcc)
                                {
                                    $jum_c = $rowcc->jum_c;
                                    $cpaket_c = $rowcc->pake;
                                    if ($cpaket_c == NULL){
                                    $cpake_c = $rowcc->pake1;
                                    }else{
                                    $cpake_c = $rowcc->pake;
                                    }

                                    $cbulan_pake_ini_c = $rowcc->bulan_lalu;
                                    $cbulan_lalu_c = $cbulan_pake_ini_c + $cth_lalu_c;                            
                                    
                                    $cakum_penyusutan_bulan_c = $rowcc->akum_penyusutan_bulan;
                                    $cpenyusutan_bulan_c = $rowcc->penyusutan_bulan;

                                    $cumur_bulan_baru_c = $rowcc->umur_bulan_baru;
                                    if($cumur_bulan_baru_c == 0){
                                    $cumur_bulan_c = $rowcc->umur_bulan ;
                                    }else{
                                    $cumur_bulan_c = $rowcc->umur_bulan_baru ;
                                    }

                                    if($cbulan_lalu_c < $cumur_bulan_c){
                                        if($cpake_c<=$cbulan_lalu_c)
                                        { 
                                            $bln_lalu_c = ($cpake_c*$cpenyusutan_bulan_c)+($cakum_penyusutan_bulan_c*($cbulan_lalu_c-$cpake_c)) ;
                                            $bln_ini_c = $rowcc->akum_penyusutan_bulan + $bln_lalu_c;
                                            $penyusutan_bulan_c = $rowcc->akum_penyusutan_bulan;
                                        }else{
                                            if($cumur_bulan_c>=$cbulan_lalu_c){
                                             $bln_lalu_c= $susut_thn_ini_c + $rowcc->tot_bln_belum ;    
                                            }else{
                                             $bln_lalu_c= $rowcc->tot_bln_belum ;    
                                            }                                                   
                                            $bln_ini_c = $rowcc->penyusutan_bulan + $bln_lalu_c;                        
                                            $penyusutan_bulan_c = $rowcc->penyusutan_bulan;
                                        }
                                    }else{
                                        $bln_lalu_c= $rowcc->nilai ;
                                        $bln_ini_c = 0 + $bln_lalu_c;
                                        $penyusutan_bulan_c = 0;

                                    }
                                    $njum_c = $jum_c;
                                    $nilaic  = $nilaic + $rowcc->nilai;                                     
                                    $sthic  = $sthic + $bln_ini_c;
                                }
                        }*/
                        $sqlc="SELECT a.id_barang FROM trkib_c a
                            LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                            LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok
                            WHERE a.kd_skpd='$skpd' 
                            AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015' AND a.kd_bidang = '$ckd_brg' 
                            AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

                         $hasilc = $this->db->query($sqlc);
                         
                         foreach ($hasilc->result() AS $rowc)
                        {                
                            $cid_barang_c = $rowc->id_barang;
                            $sqlcc = "SELECT (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_c a LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok 
                                WHERE a.tahun BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                                AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun'))AS jum_c,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),a.nilai/a.masa_manfaat)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok
                        WHERE a.kd_skpd='$skpd' AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015' and a.id_barang='$cid_barang_c' AND a.kd_bidang = '$ckd_brg' 
                        AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')";
                        $hasilcc = $this->db->query($sqlcc);                     
                             
                            foreach ($hasilcc->result() AS $rowcc)
                                {
                                    if($rowcc->masa_manfaat_baru<>null){
                                        $susut_per_tahun_c = $rowcc->ada3_susut_per_thn;
                                        $susut_thn_lalu_c = $rowcc->ada2_akm_thn_lalu;
                                        $susut_thn_ini_c = $susut_thn_lalu_c+$susut_per_tahun_c;
                                        $umur = $rowcc->masa_manfaat_baru;
                                        $nb_c = $rowcc->nilai - $susut_thn_ini_c;
                                    }else{
                                        $susut_per_tahun_c = $rowcc->penyusutan_pertahun;
                                        $susut_thn_lalu_c = $rowcc->tot_th_belum;
                                        $susut_thn_ini_c = $susut_thn_lalu_c+$susut_per_tahun_c;
                                        $umur = $rowcc->umur;
                                        $nb_c = $rowcc->nilai - $susut_thn_ini_c;
                                    }
                                    $jum_c = $rowcc->jum_c;
                                    $njum_c = $jum_c;
                                    $nilaic  = $nilaic + $rowcc->nilai;                                     
                                    $sthic  = $sthic + $susut_thn_ini_c;
                                }
                        }
                        //awal kib c thn jln
                        $sqlc_ini="SELECT a.id_barang,a.kd_brg AS kode,
                        IF(a.tahun='$tahun',1,('$tahun'-a.tahun+1)) AS th_lalu,                    
                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))>1 THEN CAST(('$tahun'-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))-('$tahun'-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun
                        FROM trkib_c a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok

                        WHERE a.kd_skpd='$skpd' 
                        AND a.tgl_oleh BETWEEN '2016-01-01' AND '$last' AND a.kd_bidang = '$ckd_brg'
                        AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')ORDER BY a.kd_brg,a.tahun,a.no_reg";

                         $hasilc_ini = $this->db->query($sqlc_ini);
                         
                         foreach ($hasilc_ini->result() AS $rowc)
                        {                
                            $cid_barang_cc = $rowc->id_barang;
                            $cth_lalu_cc = $rowc->th_lalu * 12;                
                            $susut_per_tahun_cc = $rowc->penyusutan_pertahun;
                            $susut_thn_lalu_cc = $rowc->tot_th_belum;
                            $susut_thn_ini_cc = $susut_thn_lalu_cc+$susut_per_tahun_cc;
                     
                            $sqlcc_ini = "SELECT (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_c a LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok 
                                WHERE a.tahun BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                                AND IF('$tahun'>='2016',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun'))AS jum_c,

                                MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                                IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap BETWEEN '2016-01-01' AND '$last' GROUP BY id_barang),
                                (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))
                                ,0)AS umur_bulan_baru,

                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                                FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                                (SELECT (('$tahun'-YEAR(a.tgl_oleh))*12) - (MONTH(a.tgl_oleh)-'$bulan')+1) AS pake1, 

                                CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                                TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-2016)*12))
                                AS bulan_lalu,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                                (CASE 
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12))>=0 
                                THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-2016)*12))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                                THEN a.nilai
                                END)
                                AS tot_bln_belum,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                                THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                                FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                                (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang))) / 
                                ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-01-01' AND '$last' AND b.id_barang=a.id_barang) -
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                                FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan,
                                a.kondisi

                                FROM trkib_c a
                                LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                                LEFT JOIN ms_kapitalisasi c ON LEFT(a.kd_brg,8)=c.kd_kelompok 

                                WHERE a.kd_skpd='$skpd' AND a.id_barang ='$cid_barang_cc' 
                                AND a.tgl_oleh BETWEEN '2016-01-01' AND '$last'
                                AND IF('$last'>='2016-01-01',a.nilai>=c.nilai_kap AND a.kondisi<>'RB',a.nilai<> '' AND a.kondisi<> '')
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR tgl_mutasi>='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR tgl_pindah>='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR tgl_hapus>='$last')
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR tgl_riwayat>='$last') ORDER BY a.kd_brg,a.tahun";
                               
                             $hasilcc_ini = $this->db->query($sqlcc_ini);                     
                             
                            foreach ($hasilcc_ini->result() AS $rowcc)
                                {
                                    $cpaket_cc = $rowcc->pake;
                                    if ($cpaket_cc == NULL){
                                    $cpake_cc = $rowcc->pake1;
                                    }else{
                                    $cpake_cc = $rowcc->pake;
                                    }

                                    $cbulan_pake_ini_cc = $rowcc->bulan_lalu;
                                    $cbulan_lalu_cc = $cbulan_pake_ini_cc ;                            
                                    
                                    $cakum_penyusutan_bulan_cc = $rowcc->akum_penyusutan_bulan;
                                    $cpenyusutan_bulan_cc = $rowcc->penyusutan_bulan;

                                    $cumur_bulan_baru_cc = $rowcc->umur_bulan_baru;
                                    if($cumur_bulan_baru_cc == 0){
                                    $cumur_bulan_cc = $rowcc->umur_bulan ;
                                    }else{
                                    $cumur_bulan_cc = $rowcc->umur_bulan_baru ;
                                    }

                                    /*if($cbulan_lalu_cc < $cumur_bulan_cc){
                                        if($cpake_cc<=$cbulan_lalu_cc)
                                        { 
                                            $bln_lalu_cc = ($cpake_cc*$cpenyusutan_bulan_cc)+($cakum_penyusutan_bulan_cc*($cbulan_lalu_cc-$cpake_cc)) ;
                                            $bln_ini_cc = $rowcc->akum_penyusutan_bulan + $bln_lalu_cc;
                                            $penyusutan_bulan_cc = $rowcc->akum_penyusutan_bulan;
                                        }else{
                                            $bln_lalu_cc= $rowcc->tot_bln_belum ;                                                  
                                            $bln_ini_cc = $rowcc->penyusutan_bulan + $bln_lalu_cc;                        
                                            $penyusutan_bulan_cc = $rowcc->penyusutan_bulan;
                                        }
                                    }else{
                                        $bln_lalu_cc= $rowcc->nilai ;
                                        $bln_ini_cc = 0 + $bln_lalu_cc;
                                        $penyusutan_bulan_cc = 0;

                                    }*/
                                    if($cbulan_lalu_cc < $cumur_bulan_cc){
                                        if($cpake_cc<=$cbulan_lalu_cc)
                                        { 
                                            $bln_lalu_cc = ($cpake_cc*$cpenyusutan_bulan_cc)+($cakum_penyusutan_bulan_cc*($cbulan_lalu_cc-$cpake_cc)) ;
                                            $bln_ini_cc = $rowcc->akum_penyusutan_bulan + $bln_lalu_cc;
                                            $penyusutan_bulan_cc = $rowcc->akum_penyusutan_bulan;
                                        }else{
                                            $bln_lalu_cc= $rowcc->tot_bln_belum ;                                                   
                                             //kondisi untuk bulan penutupan,agar tidak ada sisa nilai buku koma                       
                                            if($cumur_bulan_cc==($cbulan_lalu_cc+1)){
                                                $penyusutan_bulan_cc = $rowcc->nilai-$rowcc->tot_bln_belum;
                                                $bln_ini_cc = $penyusutan_bulan_cc + $bln_lalu_cc;
                                            }else{
                                                $penyusutan_bulan_cc = $rowcc->penyusutan_bulan;
                                                $bln_ini_cc = $rowcc->penyusutan_bulan + $bln_lalu_cc;
                                            }

                                        }
                                    }else{
                                        $bln_lalu_cc= $rowcc->nilai ;
                                        $bln_ini_cc = 0 + $bln_lalu_cc;
                                        $penyusutan_bulan_cc = 0;

                                    }
                                    $nilaic  = $nilaic + $rowcc->nilai;                                     
                                    $sthic  = $sthic + $bln_ini_cc;
                                }
                        }
                        //akhir kib c thn jln
                        //kib c akhir

                        //kib  d
                        /*$sqld="SELECT a.id_barang,a.kd_brg AS kode,
                            IF(a.tahun='2015',1,(2015-a.tahun+1)) AS th_lalu,                    
                            IF(a.tahun='2015',0,(CASE 
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))>1 THEN CAST((2015-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN a.nilai
                            END)) AS tot_th_belum, 
                            (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                            WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='2015' AND b.id_barang=a.id_barang))-(2015-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                            WHEN (TRIM(a.masa_manfaat)-(2015-a.tahun))<1 THEN 0 END)
                            AS penyusutan_pertahun
                            FROM trkib_d a
                            LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                            LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                            WHERE a.kd_skpd='$skpd' 
                            AND kd_barang<>'' AND YEAR(a.tgl_reg) BETWEEN '1945' AND '2015' AND a.kd_bidang = '$ckd_brg' 
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

                         $hasild = $this->db->QUERY($sqld);
                         
                         foreach ($hasild->result() AS $rowd)
                        {                
                            $cid_barang_d = $rowd->id_barang;
                            $cth_lalu_d = $rowd->th_lalu * 12;                
                            $susut_per_tahun_d = $rowd->penyusutan_pertahun;
                            $susut_thn_lalu_d = $rowd->tot_th_belum;
                            $susut_thn_ini_d = $susut_thn_lalu_d+$susut_per_tahun_d;
                     
                            $sqldd = "SELECT (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_d a WHERE a.tahun BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun'))AS jum_d,
                                MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                                IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap<='$last' GROUP BY id_barang),
                                (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))
                                ,0)AS umur_bulan_baru,

                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                                FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                                (SELECT (('$tahun'-YEAR(a.tgl_oleh)+1)*12) - (MONTH(a.tgl_reg)-'$bulan')) AS pake1,

                                CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                                TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12)-1)
                                AS bulan_lalu,

                                TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-'2015')*12))
                                AS bulan_ini,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                                (CASE 
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12)-1)>=0 
                                THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-'2015')*12)-1)*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                                THEN a.nilai
                                END)
                                AS tot_bln_belum,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                                THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                                FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                                (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang))) / 
                                ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap <='$last' AND b.id_barang=a.id_barang) -
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_reg)-MONTH(c.tgl_kap)+1))
                                FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan

                                FROM trkib_d a
                                LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                                LEFT JOIN mbarang_umur c ON c.kd_barang=LEFT(a.kd_brg,8)

                                WHERE kd_barang<>'' AND a.tgl_reg<='$last' AND a.kd_skpd='$skpd' and a.id_barang='$cid_barang_d' AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$last')
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat>'$last') ORDER BY a.kd_brg,a.tahun";
                               
                             $hasildd = $this->db->query($sqldd);                     
                             
                            foreach ($hasildd->result() AS $rowdd)
                                {
                                    $jum_d = $rowdd->jum_d;
                                    $cpaket_d = $rowdd->pake;
                                    if($cpaket_d == NULL){
                                    $cpake_d = $rowdd->pake1;
                                    }else{
                                    $cpake_d = $rowdd->pake;
                                    }

                                    $cbulan_pake_ini_d = $rowdd->bulan_lalu;
                                    $cbulan_lalu_d = $cbulan_pake_ini_d + $cth_lalu_d;                            
                                    
                                    $cakum_penyusutan_bulan_d = $rowdd->akum_penyusutan_bulan;
                                    $cpenyusutan_bulan_d = $rowdd->penyusutan_bulan;

                                    $cumur_bulan_baru_d = $rowdd->umur_bulan_baru;
                                    if($cumur_bulan_baru_d == 0){
                                    $cumur_bulan_d = $rowdd->umur_bulan ;
                                    }else{
                                    $cumur_bulan_d = $rowdd->umur_bulan_baru ;
                                    }

                                    if($cbulan_lalu_d < $cumur_bulan_d){
                                        if($cpake_d<=$cbulan_lalu_d)
                                        { 
                                            $bln_lalu_d = ($cpake_d*$cpenyusutan_bulan_d)+($cakum_penyusutan_bulan_d*($cbulan_lalu_d-$cpake_d)) ;
                                            $bln_ini_d = $rowdd->akum_penyusutan_bulan + $bln_lalu_d;
                                            $penyusutan_bulan_d = $rowdd->akum_penyusutan_bulan;
                                        }else{
                                            if($cumur_bulan_d>=$cbulan_lalu_d){
                                             $bln_lalu_d= $susut_thn_ini_d + $rowdd->tot_bln_belum ;    
                                            }else{
                                             $bln_lalu_d= $rowdd->tot_bln_belum ;    
                                            }                                                   
                                            $bln_ini_d = $rowdd->penyusutan_bulan + $bln_lalu_d;                        
                                            $penyusutan_bulan_d = $rowdd->penyusutan_bulan;
                                        }
                                    }else{
                                        $bln_lalu_d= $rowdd->nilai ;
                                        $bln_ini_d = 0 + $bln_lalu_d;
                                        $penyusutan_bulan_d = 0;

                                    }
                                    $njum_d = $jum_d;
                                    $nilaid  = $nilaid + $rowdd->nilai;                                     
                                    $sthid  = $sthid + $bln_ini_d;
                                }
                        } */
                        $sqld="SELECT a.id_barang,a.kd_brg AS kode
                            FROM trkib_d a
                            LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                            WHERE a.kd_skpd='$skpd' 
                            AND YEAR(a.tgl_oleh) BETWEEN '1945' AND '2015' AND a.kd_bidang = '$ckd_brg' 
                            AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'2015') 
                            AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'2015') 
                            AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'2015')
                            AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'2015')ORDER BY a.kd_brg,a.tahun,a.no_reg";

                         $hasild = $this->db->QUERY($sqld);
                         
                         foreach ($hasild->result() AS $rowd)
                        {                
                            $cid_barang_d = $rowd->id_barang;
                            $sqldd ="SELECT a.kd_brg AS kode,b.nm_brg,''as merek,a.tahun,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_d a WHERE a.tahun BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun'))AS jum_d,
                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))*($tahun-a.tahun) AS DECIMAL(18,2))+    
                        CAST((((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))))AS DECIMAL(18,2))    
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),a.nilai/a.masa_manfaat) AS ada_akum_susut_sd_thn_ini,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 

                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))))*($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))AS DECIMAL(18,2))+CAST((a.nilai/TRIM(a.masa_manfaat)) *((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun) AS DECIMAL(18,2))

                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1
                        THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)
                        END),0)AS ada2_akm_thn_lalu,

                        IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND YEAR(tgl_kap)<='$tahun' GROUP BY id_barang),
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 
                        THEN CAST((((a.nilai-((a.nilai/(a.masa_manfaat)*((SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)-a.tahun))-
                        (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))/(((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)))))AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))<1 
                        THEN 0 END),a.nilai/a.masa_manfaat)AS ada3_susut_per_thn,

                        (((a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))+($tahun-(SELECT YEAR(c.tgl_kap) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))) AS masa_manfaat_baru,
                        CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,
                        TRIM(a.masa_manfaat) AS umur,
                        IF(a.tahun='$tahun',1,($tahun-a.tahun+1)) AS th_lalu,$tahun AS th_ini,

                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang))-($tahun-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun,


                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 

                        IF(a.tahun='$tahun',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))=1 THEN 0 
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))>1 THEN CAST(($tahun-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-($tahun-a.tahun))<1 THEN a.nilai
                        END)) AS nil_th_ini

                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        WHERE a.kd_skpd='$skpd' AND a.tahun BETWEEN '1945' AND '2015' AND a.id_barang='$cid_barang_d' AND a.kd_bidang = '$ckd_brg'
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')";
                            $hasildd = $this->db->query($sqldd);                     
                             
                            foreach ($hasildd->result() AS $rowdd)
                                {
                                    if($rowdd->masa_manfaat_baru<>null){
                                        $susut_per_tahun_d = $rowdd->ada3_susut_per_thn;
                                        $susut_thn_lalu_d = $rowdd->ada2_akm_thn_lalu;
                                        $susut_thn_ini_d = $susut_thn_lalu_d+$susut_per_tahun_d;
                                        $umur = $rowdd->masa_manfaat_baru;
                                        $nb_d = $rowdd->nilai - $susut_thn_ini_d;
                                    }else{
                                        $susut_per_tahun_d = $rowdd->penyusutan_pertahun;
                                        $susut_thn_lalu_d = $rowdd->tot_th_belum;
                                        $susut_thn_ini_d = $susut_thn_lalu_d+$susut_per_tahun_d;
                                        $umur = $rowdd->umur;
                                        $nb_d = $rowdd->nilai - $susut_thn_ini_d;
                                    }
                                    $jum_d = $rowdd->jum_d;
                                    $njum_d = $jum_d;
                                    $nilaid  = $nilaid + $rowdd->nilai;                                     
                                    $sthid  = $sthid + $susut_thn_ini_d;
                                }
                        }
                        //awal kib d thn jln
                        $sqld_ini="SELECT a.id_barang,a.kd_brg AS kode,
                        IF(a.tahun='$tahun',1,('$tahun'-a.tahun+1)) AS th_lalu,                    
                        IF(a.tahun='$tahun',0,(CASE 
                        WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))=1 THEN a.nilai-CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))>1 THEN CAST(('$tahun'-a.tahun)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN a.nilai
                        END)) AS tot_th_belum, 
                        (CASE WHEN (TRIM(a.masa_manfaat+(SELECT IFNULL(SUM(c.tmbh_manfaat),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang))-('$tahun'-a.tahun))>=1 THEN CAST((a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                        WHEN (TRIM(a.masa_manfaat)-('$tahun'-a.tahun))<1 THEN 0 END)
                        AS penyusutan_pertahun
                        FROM trkib_d a
                        LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                        

                        WHERE a.kd_skpd='$skpd' 
                        AND a.tgl_oleh BETWEEN '2016-1-01' AND '$last' AND a.kd_bidang = '$ckd_brg'
                        AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi)>'$tahun') 
                        AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah)>'$tahun') 
                        AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus)>'$tahun')
                        AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat)>'$tahun')ORDER BY a.kd_brg,a.tahun,a.no_reg";

                         $hasild_ini = $this->db->QUERY($sqld_ini);
                         
                         foreach ($hasild_ini->result() AS $rowd)
                        {                
                            $cid_barang_dd = $rowd->id_barang;
                            $cth_lalu_dd = $rowd->th_lalu * 12;                
                            $susut_per_tahun_dd = $rowd->penyusutan_pertahun;
                            $susut_thn_lalu_dd = $rowd->tot_th_belum;
                            $susut_thn_ini_dd = $susut_thn_lalu_dd+$susut_per_tahun_dd;
                     
                            $sqldd_ini = "SELECT (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_d a WHERE a.tahun BETWEEN '1945' AND '$tahun' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun'))AS jum_d,
                                MONTH(a.tgl_oleh)AS bln,a.kd_brg AS kode,b.nm_brg,a.tahun,TRIM(a.masa_manfaat) AS umur_tahun,TRIM(a.masa_manfaat*12)AS umur_bulan,

                                IF(a.id_barang=(SELECT DISTINCT(id_barang) FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd AND id_barang=a.id_barang AND tgl_kap BETWEEN '2016-1-01' AND '$last' GROUP BY id_barang),
                                (TRIM(a.masa_manfaat*12)+(SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang))
                                ,0)AS umur_bulan_baru,

                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                                FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang) AS pake,

                                (SELECT (('$tahun'-YEAR(a.tgl_oleh))*12) - (MONTH(a.tgl_oleh)-'$bulan')+1) AS pake1, 

                                CAST(a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang) AS DECIMAL(18,2))AS nilai,

                                TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-2016)*12))
                                AS bulan_lalu,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 THEN TRUNCATE(CAST((a.nilai/(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END)AS penyusutan_bulan,

                                (CASE 
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-YEAR(a.tgl_oleh))*12))>=0 
                                THEN TRUNCATE(CAST(TRIM('$bulan'-MONTH(a.tgl_oleh)+((('$tahun')-2016)*12))*(a.nilai/TRIM(a.masa_manfaat*12)) AS DECIMAL(18,9)),2)
                                WHEN TRIM(a.masa_manfaat*12)-TRIM('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))<0 
                                THEN a.nilai
                                END)
                                AS tot_bln_belum,

                                (CASE WHEN ((a.masa_manfaat*12)-(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))>=0 
                                THEN TRUNCATE(CAST((a.nilai-((a.nilai/(a.masa_manfaat*12))*
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                                FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang) -
                                (SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang))) / 
                                ((a.masa_manfaat*12) + (SELECT (IFNULL(SUM(c.tmbh_manfaat),0)*12) FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND c.tgl_kap BETWEEN '2016-1-01' AND '$last' AND b.id_barang=a.id_barang) -
                                (SELECT (((YEAR(c.tgl_kap)-YEAR(a.tgl_oleh)+1)*12)-(MONTH(a.tgl_oleh)-MONTH(c.tgl_kap)+1))
                                FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                                WHERE b.kd_skpd=a.kd_skpd AND b.kd_unit=a.kd_unit AND YEAR(c.tgl_kap)<='$tahun' AND b.id_barang=a.id_barang)) AS DECIMAL(18,9)),2)
                                WHEN (TRIM(a.masa_manfaat*12)-TRIM(('$bulan'-MONTH(a.tgl_oleh)+(('$tahun'-YEAR(a.tgl_oleh))*12))))<0 THEN 0 END) AS akum_penyusutan_bulan,
                                a.kondisi

                                FROM trkib_d a
                                LEFT JOIN mbarang b ON b.kd_brg=a.kd_brg 
                                

                                WHERE a.kd_skpd='$skpd' AND a.id_barang ='$cid_barang_dd' 
                                AND a.tgl_oleh BETWEEN '2016-1-01' AND '$last'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR tgl_mutasi>='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR tgl_pindah>='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR tgl_hapus>='$last')
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR tgl_riwayat>='$last') ORDER BY a.kd_brg,a.tahun";
                               
                             $hasildd_ini = $this->db->query($sqldd_ini);                     
                             
                            foreach ($hasildd_ini->result() AS $rowdd)
                                {
                                    $jum_dd = $rowdd->jum_d;
                                    $cpaket_dd = $rowdd->pake;
                                    if($cpaket_dd == NULL){
                                    $cpake_dd = $rowdd->pake1;
                                    }else{
                                    $cpake_dd = $rowdd->pake;
                                    }

                                    $cbulan_pake_ini_dd = $rowdd->bulan_lalu;
                                    $cbulan_lalu_dd = $cbulan_pake_ini_dd ;                            
                                    
                                    $cakum_penyusutan_bulan_dd = $rowdd->akum_penyusutan_bulan;
                                    $cpenyusutan_bulan_dd = $rowdd->penyusutan_bulan;

                                    $cumur_bulan_baru_dd = $rowdd->umur_bulan_baru;
                                    if($cumur_bulan_baru_dd == 0){
                                    $cumur_bulan_dd = $rowdd->umur_bulan ;
                                    }else{
                                    $cumur_bulan_dd = $rowdd->umur_bulan_baru ;
                                    }

                                    /*if($cbulan_lalu_dd < $cumur_bulan_dd){
                                        if($cpake_dd<=$cbulan_lalu_dd)
                                        { 
                                            $bln_lalu_dd = ($cpake_dd*$cpenyusutan_bulan_dd)+($cakum_penyusutan_bulan_dd*($cbulan_lalu_dd-$cpake_dd)) ;
                                            $bln_ini_dd = $rowdd->akum_penyusutan_bulan + $bln_lalu_dd;
                                            $penyusutan_bulan_dd = $rowdd->akum_penyusutan_bulan;
                                        }else{
                                            $bln_lalu_dd= $rowdd->tot_bln_belum ;                                            
                                            $bln_ini_dd = $rowdd->penyusutan_bulan + $bln_lalu_dd;                        
                                            $penyusutan_bulan_dd = $rowdd->penyusutan_bulan;
                                        }
                                    }else{
                                        $bln_lalu_dd= $rowdd->nilai ;
                                        $bln_ini_dd = 0 + $bln_lalu_dd;
                                        $penyusutan_bulan_dd = 0;

                                    }*/
                                    if($cbulan_lalu_dd < $cumur_bulan_dd){
                                if($cpake_dd<=$cbulan_lalu_dd)
                                { 
                                    $bln_lalu_dd = ($cpake_dd*$cpenyusutan_bulan_dd)+($cakum_penyusutan_bulan_dd*($cbulan_lalu_dd-$cpake_dd)) ;
                                    $bln_ini_dd = $rowdd->akum_penyusutan_bulan + $bln_lalu_dd;
                                    $penyusutan_bulan_dd = $rowdd->akum_penyusutan_bulan;
                                }else{
                                    $bln_lalu_dd= $rowdd->tot_bln_belum ;                                                   
                                     //kondisi untuk bulan penutupan,agar tidak ada sisa nilai buku koma                       
                                    if($cumur_bulan_dd==($cbulan_lalu_dd+1)){
                                        $penyusutan_bulan_dd = $rowdd->nilai-$rowdd->tot_bln_belum;
                                        $bln_ini_dd = $penyusutan_bulan_dd + $bln_lalu_dd;
                                    }else{
                                        $penyusutan_bulan_dd = $rowdd->penyusutan_bulan;
                                        $bln_ini_dd = $rowdd->penyusutan_bulan + $bln_lalu_dd;
                                    }

                                }
                            }else{
                                $bln_lalu_dd= $rowdd->nilai ;
                                $bln_ini_dd = 0 + $bln_lalu_dd;
                                $penyusutan_bulan_dd = 0;

                            }
                                    $nilaid  = $nilaid + $rowdd->nilai;                                     
                                    $sthid  = $sthid + $bln_ini_dd;
                                }
                        } 
                        //akhir kib d thn jln
                        //kib  d akhir

                        //kib  e
                        $sqle="SELECT (select IFNULL(SUM(a.jumlah),0)
                                FROM trkib_e a WHERE a.tgl_peroleh <='$last' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                                AND IF('$last'>='2016-01-01',a.kondisi<>'RB',a.kondisi<>'')
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi >='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah >='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus >='$last')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat >='$last'))AS jum_e,
                                (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_e a 
                                WHERE a.tgl_peroleh <='$last' AND a.kd_skpd='$skpd' AND a.kd_bidang = '$ckd_brg' 
                                AND IF('$last'>='2016-01-01',a.kondisi<>'RB',a.kondisi<>'')
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi >='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah >='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus >='$last')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat >='$last'))AS nilai_kib_e
                                FROM ms_skpd d where d.kd_skpd = '$skpd' ORDER BY d.kd_skpd";
                            $hasile = $this->db->query($sqle);
                            foreach ($hasile->result() as $rowe)
                            { 
                            $jum_e = $rowe->jum_e;
                            $nilai_kib_e = $rowe->nilai_kib_e;
                            }
                        //kib  e akhir

                        //kib  f
                        $sqlf="SELECT (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_f a WHERE a.tgl_oleh <='$last' AND a.kd_skpd='$skpd' AND left(a.kd_brg,5) = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi >='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah >='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus >='$last')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat >='$last'))AS jum_f,
                                (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_f a 
                                WHERE a.tgl_oleh <='$last' AND a.kd_skpd='$skpd' AND left(a.kd_brg,5) = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi >='$last') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah >='$last') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus >='$last')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR a.tgl_riwayat >='$last'))AS nilai_kib_f
                                FROM ms_skpd d where d.kd_skpd = '$skpd' ORDER BY d.kd_skpd";
                            $hasilf = $this->db->query($sqlf);
                            foreach ($hasilf->result() as $rowf)
                            { 
                            $jum_f = $rowf->jum_f;
                            $nilai_kib_f = $rowf->nilai_kib_f;
                            }
                        //kib  f akhir 

                            $pa     = $nilai_kib_a;
                            $pb     = $nilaib;
                            $akmb   = $sthib;
                            $pc     = $nilaic;
                            $akmc   = $sthic;
                            $pd     = $nilaid;
                            $akmd   = $sthid;
                            $pe     = $nilai_kib_e;
                            $pf     = $nilai_kib_f;
                            $cjum_a = $jum_a;
                            $cjum_b = $njum_b;
                            $cjum_c = $njum_c;
                            $cjum_d = $njum_d;
                            $cjum_e = $jum_e;
                            $cjum_f = $jum_f;
                            $jjumlah = $cjum_a+$cjum_b+$cjum_c+$cjum_d+$cjum_e+$cjum_f;

                            $jtota = $jtota + $cjum_a ;
                            $jtotb = $jtotb + $cjum_b ;
                            $jtotc = $jtotc + $cjum_c ;
                            $jtotd = $jtotd + $cjum_d ;
                            $jtote = $jtote + $cjum_e ;
                            $jtotf = $jtotf + $cjum_f ;
                            $jtotal = $jtota + $jtotb + $jtotc + $jtotd + $jtote + $jtotf ;

                            $nbb = $pb-$akmb;
                            $nbc = $pc-$akmc;
                            $nbd = $pd-$akmd;

                            $jp = $pa+$pb+$pc+$pd+$pe+$pf;
                            $jnb = $pa+($pb-$akmb)+($pc-$akmc)+($pd-$akmd)+$pe+$pf;
                            $js = $jp-$jnb;

                            $jpa = $jpa+$pa;
                            $jpb = $jpb+$pb;
                            $jpc = $jpc+$pc;
                            $jpd = $jpd+$pd;
                            $jpe = $jpe+$pe;
                            $jpf = $jpf+$pf;

                            $jnbb = $jnbb+$nbb;
                            $jnbc = $jnbc+$nbc;
                            $jbnd = $jbnd+$nbd;

                            $jmlp=$jmlp+$jp;
                            $jmlnb=$jmlnb+$jnb;
                            $jmls=$jmls+$js;

                            $cRet .="<tr>
                                    <td align=\"left\" style=\"font-size:12px\">$ckd_brg</td>
                                    <td align=\"left\" style=\"font-size:12px\">$cnama</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_a</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pa,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_b</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pb,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($nbb,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_c</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pc,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($nbc,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_d</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pd,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($nbd,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_e</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pe,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_f</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pf,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$jjumlah</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($jp,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($jnb,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($js,2,',','.')."</td>
                                </tr>";
                    }else{
                        $cRet .="<tr>
                                    <td align=\"left\" style=\"font-size:12px\"><b>$ckd_brg</b></td>
                                    <td align=\"left\" style=\"font-size:12px\"><b>$cnama</b></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                </tr>"; 
                    }                                   
                }
                //Akhir Konsep Bulan dan Tahun
            }
                $cRet .="<tr>
                            <td bgcolor=\"#CCCCCC\" colspan=\"2\" align=\"center\" style=\"font-size:12px\"><b>JUMLAH</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtota</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpa,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtotb</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jnbb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtotc</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpc,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jnbc,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtotd</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpd,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jbnd,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtote</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpe,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtotf</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpf,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtotal</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jmlp-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jmlnb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jmls,2,',','.')."</b></td>
                        </tr>";                 
            
         $cRet .="</table>"; 

         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"><br></td>
            </tr>";
            
        $cRet .=       " </table>";
         
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', '');
        $skpdx = ucfirst(strtolower($test));
        $judul  ="REKAP PEROLEHAN DAN PENYUSUTAN BIDANG";
        $this->template->set('title', 'REKAP PEROLEHAN DAN PENYUSUTAN BIDANG');  
        switch($cpilih) {
        case 1;
             //$this->_mpdf('', $cRet, 10, 10, 10, '1','','');
            $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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
        case 4;     
            echo $cRet;
        break;
        }
    }

    function rekapitulasi_susut_bidang2(){
        $konfig     = $this->ambil_config();
        $nmkab      = strtoupper($konfig['kabupaten']);
        //$logo       = $konfig['logo'];
        //$tampil     = $_REQUEST['tampil'];
        $skpd       = $_REQUEST['skpd'];
        $nmskpd     = $_REQUEST['nmskpd'];
        $cpilih = $_REQUEST['pilih'];
        $tahun1 = $_REQUEST['tahun1'];
        $tahun2 = $_REQUEST['tahun2'];
        //$konfig     = $this->ambil_config();
        //$kota       = strtoupper($konfig['kota']);
        $cRet="";
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">";
          $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN BIDANG</B></td>
            </tr><BR/><BR/><BR/></table>";
        
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          
 
        $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:12px;\" width =\"10%\" ><b>&ensp;&ensp;SKPD</b></td>
                <td align=\"left\" style=\"font-size:12px;\"><b>: $skpd  $nmskpd</b></td>
            </tr>";
        $cRet .="<tr>
                <td align=\"left\" style=\"font-size:12px;\"><b>&ensp;&ensp;KABUPATEN</b></td>
                <td align=\"left\" style=\"font-size:12px;\"><b>: $nmkab</b></td>
            </tr>";

        $cRet .="<tr>
            <td align=\"left\" style=\"font-size:12px;\"><b>&ensp;&ensp;PERIODE</b></td>
            <td align=\"left\" style=\"font-size:12px;\"><b>: $tahun1 s.d $tahun2</b></td>
        </tr>"; 
        $cRet .="</table>";

        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"2\" cellpadding=\"4\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>No</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"20%\" style=\"font-size:11px\"><b>BIDANG</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB A (Tanah)</b></td>
                <td colspan=\"3\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB B (Peralatan dan Mesin)</b></td>
                <td colspan=\"3\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB C (Gedung dan Bangunan)</b></td>
                <td colspan=\"3\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB D (Jalan,Irigasi dan Jembatan)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB E (Aset Tetap Lainnya)</b></td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>KIB F (KDP)</b></td>
                <td colspan=\"3\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>JUMLAH KIB A,B,C,D,E dan F</b></td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>JUMLAH PENYUSUTAN</b></td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>

                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>

                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>

                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>

                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"5%\" style=\"font-size:11px\"><b>UNIT</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI<br>PEROLEHAN</b></td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" width=\"10%\" style=\"font-size:11px\"><b>NILAI BUKU</b></td>
                
            </tr>
             </thead>
             <tfoot>
                    <tr>
                        <td colspan=\"14\" style=\"border:solid 1px white;border-top:solid 1px black;\"></td>
                    </tr>
                </tfoot>
             
                ";
                $csql = "SELECT * FROM mrekap_susut WHERE kd_brg <> '' ORDER BY no_urut"; 
                $chasil = $this->db->query($csql);
                $jmlp=0;$jmlnb=0;$jmls=0;$jpa=0;$jpb=0;$jpc=0;$jpd=0;$jpe=0;$jpf=0;$jnbb=0;$jnbc=0;$jbnd=0;$X='0';
                $jtota=0;$jtotb=0;$jtotc=0;$jtotd=0;$jtote=0;$jtotf=0;$jtotal=0;
                foreach ($chasil->result() as $rowc)
                {   
                $cgol = $rowc->gol;
                $cseq = $rowc->seq;
                $cnama = $rowc->nama;
                $ckd_brg = $rowc->kd_brg;

                    if(strlen($ckd_brg)==5)
                    {                                   
                        $sql = "SELECT d.kd_skpd,d.nm_skpd,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_a a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2')
                                )AS jum_a,

                                (SELECT IFNULL(SUM(a.nilai),0)
                                FROM trkib_a a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_a,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_b a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS jum_b,

                                (SELECT IFNULL(SUM(a.nilai),0)
                                FROM trkib_b a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_b,
                                (SELECT IFNULL(SUM(
                                IF(a.tahun='$tahun2',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<=1 THEN a.nilai
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                                END))),0) FROM trkib_b a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9'))AS akm_kib_b,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_c a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS jum_c,

                                (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_c a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_c,
                                (SELECT IFNULL(SUM(IF(a.tahun='$tahun2',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<=1 THEN a.nilai
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                                END))),0) FROM trkib_c a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS akm_kib_c,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_d a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS jum_d,

                                (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_d a 
                                WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_d,
                                (SELECT IFNULL(SUM(IF(a.tahun='$tahun2',CAST(a.nilai/TRIM(a.masa_manfaat)AS DECIMAL(18,2)),(CASE 
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))<=1 THEN a.nilai 
                                WHEN (TRIM(a.masa_manfaat)-($tahun2-a.tahun))>1 THEN CAST(($tahun2-a.tahun+1)*(a.nilai/TRIM(a.masa_manfaat)) AS DECIMAL(18,2))
                                END))),0) FROM trkib_d a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS akm_kib_d,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_e a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND a.kd_bidang = '$ckd_brg' 
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS jum_e,

                                (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_e a 
                                WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and a.kd_bidang = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_e,
                                (SELECT IFNULL(SUM(a.jumlah),0)
                                FROM trkib_f a WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd AND SUBSTR(a.kd_brg,1,5) = '$ckd_brg' 
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9'))AS jum_f,

                                (SELECT IFNULL(SUM(a.nilai),0)FROM trkib_f a 
                                WHERE YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun2' AND a.kd_skpd=d.kd_skpd and SUBSTR(a.kd_brg,1,5) = '$ckd_brg'
                                AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR YEAR(a.tgl_mutasi) >'$tahun2') 
                                AND (a.no_pindah IS NULL OR a.no_pindah='' OR YEAR(a.tgl_pindah) >'$tahun2') 
                                AND (a.no_hapus IS NULL OR a.no_hapus='' OR YEAR(a.tgl_hapus) >'$tahun2')  
                                AND (a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9' OR YEAR(a.tgl_riwayat) >'$tahun2'))AS nilai_kib_f
                            FROM ms_skpd d where d.kd_skpd = '$skpd' ORDER BY d.kd_skpd";
                        $hasil = $this->db->query($sql);
                        $i=0;//$jmlp=0;$jmlnb=0;$jmls=0;$jpa=0;$jpb=0;$jpc=0;$jpd=0;$jpe=0;$jpf=0;$jnbb=0;$jnbc=0;$jbnd=0;$X='0';//DIKURANGI 0.13 KARENA SELISIH DARI DATA BASRI YG SALAH SUM
                        foreach ($hasil->result() as $row) {
                            $i++;
                            $nm_skpd = $row->nm_skpd;
                            $pa     = $row->nilai_kib_a;
                            $pb     = $row->nilai_kib_b;
                            $akmb   = $row->akm_kib_b;
                            $pc     = $row->nilai_kib_c;
                            $akmc   = $row->akm_kib_c;
                            $pd     = $row->nilai_kib_d;
                            $akmd   = $row->akm_kib_d;
                            $pe     = $row->nilai_kib_e;
                            $pf     = $row->nilai_kib_f;
                            $cjum_a = $row->jum_a;
                            $cjum_b = $row->jum_b;
                            $cjum_c = $row->jum_c;
                            $cjum_d = $row->jum_d;
                            $cjum_e = $row->jum_e;
                            $cjum_f = $row->jum_f;
                            $jjumlah = $cjum_a+$cjum_b+$cjum_c+$cjum_d+$cjum_e+$cjum_f;

                            $jtota = $jtota + $cjum_a ;
                            $jtotb = $jtotb + $cjum_b ;
                            $jtotc = $jtotc + $cjum_c ;
                            $jtotd = $jtotd + $cjum_d ;
                            $jtote = $jtote + $cjum_e ;
                            $jtotf = $jtotf + $cjum_f ;
                            $jtotal = $jtota + $jtotb + $jtotc + $jtotd + $jtote + $jtotf ;

                            $nbb = $pb-$akmb;
                            $nbc = $pc-$akmc;
                            $nbd = $pd-$akmd;

                            $jp = $pa+$pb+$pc+$pd+$pe+$pf;
                            $jnb = $pa+($pb-$akmb)+($pc-$akmc)+($pd-$akmd)+$pe+$pf;
                            $js = $jp-$jnb;

                            $jpa = $jpa+$pa;
                            $jpb = $jpb+$pb;
                            $jpc = $jpc+$pc;
                            $jpd = $jpd+$pd;
                            $jpe = $jpe+$pe;
                            $jpf = $jpf+$pf;

                            $jnbb = $jnbb+$nbb;
                            $jnbc = $jnbc+$nbc;
                            $jbnd = $jbnd+$nbd;

                            $jmlp=$jmlp+$jp;
                            $jmlnb=$jmlnb+$jnb;
                            $jmls=$jmls+$js;

                        $cRet .="<tr>
                                    <td align=\"left\" style=\"font-size:12px\">$ckd_brg</td>
                                    <td align=\"left\" style=\"font-size:12px\">$cnama</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_a</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pa,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_b</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pb,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($nbb,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_c</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pc,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($nbc,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_d</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pd,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($nbd,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_e</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pe,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$cjum_f</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($pf,2,',','.')."</td>
                                    <td align=\"center\" style=\"font-size:12px\">$jjumlah</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($jp,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($jnb,2,',','.')."</td>
                                    <td align=\"right\" style=\"font-size:12px\">".number_format($js,2,',','.')."</td>
                                </tr>";
                        }

                    }else{
                        $cRet .="<tr>
                                    <td align=\"left\" style=\"font-size:12px\"><b>$ckd_brg</b></td>
                                    <td align=\"left\" style=\"font-size:12px\"><b>$cnama</b></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                    <td align=\"right\" style=\"font-size:12px\"></td>
                                </tr>"; 
                    }                                   
                }
                $cRet .="<tr>
                            <td bgcolor=\"#CCCCCC\" colspan=\"2\" align=\"center\" style=\"font-size:12px\"><b>JUMLAH</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtota</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpa,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtotb</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jnbb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtotc</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpc,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jnbc,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtotd</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpd,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jbnd,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtote</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpe,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtotf</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jpf,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\"><b>$jtotal</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jmlp-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jmlnb-$X,2,',','.')."</b></td>
                            <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:12px\"><b>".number_format($jmls,2,',','.')."</b></td>
                        </tr>";                 
            
         $cRet .="</table>"; 

         $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px\"><br></td>
            </tr>";
            
        $cRet .=       " </table>";
         
        $data['prev']= $cRet;
        //$kertas='LEGAL';  
        
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', '');
        $skpdx = ucfirst(strtolower($test));
        $judul  ="REKAP PEROLEHAN DAN PENYUSUTAN BIDANG";
        $this->template->set('title', 'REKAP PEROLEHAN DAN PENYUSUTAN BIDANG');  
        switch($cpilih) {
        case 1;
             //$this->_mpdf('', $cRet, 10, 10, 10, '1','','');
            $this->mlap->_mpdf('',$cRet,10,10,10,'1');
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