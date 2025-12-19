<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_lainnya extends CI_Controller {
        
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
/***************************ISI CONTROLLER*******************************************/		

	function lap_aset_lainnya()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK ASET TETAP LAINNYA';
        $data['page_title']= 'CETAK ASET TETAP LAINNYA';
        $this->template->set('title', 'CETAK ASET TETAP LAINNYA');   
        $this->template->load('index','laporan/laporan_lainnya/lap_aset_lainnya2',$data);
        } 
    }
	
	function lap_aset_hilang()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK ASET HILANG';
        $data['page_title']= 'CETAK ASET HILANG';
        $this->template->set('title', 'CETAK ASET HILANG');   
        $this->template->load('index','laporan/laporan_lainnya/lap_aset_hilang_dh',$data);
        } 
    }

    function lap_aset_hibah()
    {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $data['page_title']= 'CETAK ASET HIBAH';
        $data['page_title']= 'CETAK ASET HIBAH';
        $this->template->set('title', 'CETAK ASET HIBAH');   
        $this->template->load('index','laporan/laporan_lainnya/lap_aset_hibah_dh',$data);
        } 
    }
	
	function lap_aset_tdk_tau()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK ASET TIDAK TAU';
        $data['page_title']= 'CETAK ASET TIDAK TAU';
        $this->template->set('title', 'CETAK ASET TIDAK TAU');   
        $this->template->load('index','laporan/laporan_lainnya/lap_aset_tdk_tau_dh',$data);
        } 
    }

	function lap_aset_rusak_berat()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK ASET RUSAK BERAT';
        $data['page_title']= 'CETAK ASET RUSAK BERAT';
        $this->template->set('title', 'CETAK ASET RUSAK BERAT');   
        $this->template->load('index','laporan/laporan_lainnya/lap_aset_rusak_berat_dh',$data);
        } 
    }
	
	function lap_aset_pemanfaatan()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK ASET PEMANFAATAN';
        $data['page_title']= 'CETAK ASET PEMANFAATAN';
        $this->template->set('title', 'CETAK ASET PEMANFAATAN');   
        $this->template->load('index','laporan/laporan_lainnya/lap_aset_pemanfaatan',$data);
        } 
    }

	function lap_aset_lapuk()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK ASET LAPUK';
        $data['page_title']= 'CETAK ASET LAPUK';
        $this->template->set('title', 'CETAK ASET LAPUK');   
        $this->template->load('index','laporan/laporan_lainnya/lap_aset_lapuk',$data);
        } 
    }
	
	function lap_aset_dikuasai_lain()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK ASET DIKUASAI LAIN';
        $data['page_title']= 'CETAK ASET DIKUASAI LAIN';
        $this->template->set('title', 'CETAK ASET DIKUASAI LAIN');   
        $this->template->load('index','laporan/laporan_lainnya/lap_aset_dikuasai_lain',$data);
        } 
    }
	function rekapitulasi_aset_lainnya()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK ASET DIKUASAI LAIN';
        $data['page_title']= 'CETAK ASET DIKUASAI LAIN';
        $this->template->set('title', 'CETAK ASET DIKUASAI LAIN');   
        $this->template->load('index','laporan/laporan_lainnya/rekap_aset_lainnya_dh',$data);
        } 
    }    function cetak_lmb(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'LAPORAN LAPORAN MUTASI BARANG';
        $this->template->set('title', 'LAPORAN LAPORAN MUTASI BARANG');   
        $this->template->load('index','laporan/laporan_lainnya/lap_lmb_komp_lainnya',$data) ;
        } 
    }
	
	 function cetak_rekap_lmb()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK REKAP LAPORAN MUTASI BARANG';
        $this->template->set('title', 'CETAK REKAP LAPORAN MUTASI BARANG');   
        $this->template->load('index','laporan/laporan_lainnya/rekap_lmb_komp_lainnya',$data) ;
        } 
    }	
	
	function cetak_dmb(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK DAFTAR MUTASI BARANG';
        $this->template->set('title', 'CETAK DAFTAR MUTASI BARANG');   
        $this->template->load('index','laporan/laporan_lainnya/lap_dmb_komp_lainnya',$data) ;
        } 
    }
		
	function cetak_rekap_dmb(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
            $data['page_title']= 'CETAK REKAP MUTASI BARANG';
            $this->template->set('title', 'CETAK REKAP MUTASI BARANG');   
            $this->template->load('index','laporan/laporan_lainnya/rekap_dmb_komp_lainnya',$data) ;
        } 
    }
/***************************END ISI CONTROLLER**************************************/	
	public function lap_aset_lainnya2()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu 	= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
        $riwayat	= $_REQUEST['riwayat'];
		$iz	 		= $_REQUEST['fa'];
        $oto  		= $this->session->userdata('otori');
		$skpd		= "";
		$unit		= "";
		$rwyt		= "";
		if($riwayat<>""){
		$rwyt		= "and a.kd_riwayat='$riwayat'";	
		};
		
		if($oto=='01'){
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}elseif($cskpd=='' && $cuskpd==''){
				$skpd="";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
			
		}else{
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
        }
        
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <th colspan=\"4\" align=\"center\" style=\"font-size:16px;\"><b>LAPORAN ASET LAINNYA</b></th>
			</tr>";
       if($cskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
	   if($cuskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;UNIT</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_uskpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Asal/Cara<br/>Perolehan<br/>Barang</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Satuan</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keadaan<br/>Barang</td>
				<td colspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Jumlah</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keterangan</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nomor<BR/>Urut</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Kode<br/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Register</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nama/Jenis<BR/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Merk<br/>Type</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Harga</td>
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
             
$csql = "SELECT * FROM 
(SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kondisi='RB'  $rwyt
and a.no_hapus is null and a.tgl_reg<='$sampai_tgl' $skpd $unit GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kondisi='RB'  $rwyt
and a.no_hapus is null and a.tgl_reg<='$sampai_tgl' $skpd $unit group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kondisi='RB'  $rwyt
and a.no_hapus is null and a.tgl_reg<='$sampai_tgl' $skpd $unit GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan) faiz  ORDER BY kd_brg,no_reg";
             $hasil = $this->db->query($csql);//and a.nilai>='100000'and a.nilai>='20000000'and a.nilai>='300000'
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
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row->nilai)."</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
				elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nilai</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
                $i++;    
              
             }//
			 if($iz=='1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
			 elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
            $cRet .="
			 <tr></tr>
			<br/>
			<!--table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\"-->
			     
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmbend )</u><br>NIP. $bend  
                        </td>
						
						<td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmtahu )</u><br>NIP. $tahu   
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
	
	function lap_aset_lainnya2x(){
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu		= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$riwayat	= $_REQUEST['riwayat'];
		$rwyt		= "";
		if($riwayat<>''){
			$rwyt="and a.kd_riwayat='$riwayat'";
		}
		
	// legal = 21.59 x 35.56 // 215 x 355
	define('FPDF_FONTPATH', $this->config->item('fonts_path'));

	$this->load->library('fpdf');

	$this->fpdf->FPDF($orientation='L', $unit='mm', $size='LEGAL');
	$this->fpdf->addPage();
	
	$this->fpdf->SetMargins($left = 10, $top = 10, $right = 10);

	// sisa panjang dalam = 215 - (10 + 10) = 195
	// $this->fpdf->SetFontSize(12);
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='LAPORAN ASET LAINNYA', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();

	$this->fpdf->Ln();
	if($cskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='SKPD ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_skpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}
	if($cuskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='UNIT ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_uskpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}

	$this->fpdf->Cell($w = 50, $h = 5, $txt='KOTA ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$kota, $border=0, $ln=0, $align='L', $fill=false, $link='');
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
	$this->fpdf->SetFont('times','B',8);
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
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell(37, $height_table, $txt='JUMLAH', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, $height_table, $txt='KET', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();	
	
	$height_table  = 7;
	$width_no_urut = 30;
	$width_rek     = 115;
	$width_nilai   = 15;
	
	$this->fpdf->SetFillColor(255,255,250);
	$this->fpdf->SetFont('times','B',8);
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
    
	if($cskpd<>'' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and a.kondisi='RB' and a.nilai>='300000' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt GROUP BY a.no_urut";  
	}elseif($cskpd<>'' && $cuskpd<>''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and a.tgl_reg<='$sampai_tgl' and a.kondisi='RB' and a.nilai>='300000' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt GROUP BY a.no_urut";  

	}elseif($cskpd=='' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kondisi='RB' and a.tgl_reg<='$sampai_tgl' and a.nilai>='300000' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt GROUP BY a.no_urut";  
	
	}else{
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and a.kondisi='RB' and a.nilai>='300000' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt GROUP BY a.no_urut";  

	}
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
		
	$this->fpdf->SetFont('times','',8);	
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
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.kondisi='RB' and a.tgl_reg<='$sampai_tgl' and a.nilai>='20000000' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and a.kondisi='RB' and a.tgl_reg<='$sampai_tgl' and a.nilai>='20000000' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd=='' && $cuskpd==''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kondisi='RB' and a.nilai>='20000000' and a.tgl_reg<='$sampai_tgl' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}else{
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.kondisi='RB' and a.tgl_reg<='$sampai_tgl' and a.nilai>='20000000' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.kondisi='RB' and a.tgl_reg<='$sampai_tgl' and a.nilai>='100000' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and a.kondisi='RB' and a.tgl_reg<='$sampai_tgl' and a.nilai>='100000' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}elseif($cskpd=='' && $cuskpd==''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kondisi='RB' and a.nilai>='100000' and a.tgl_reg<='$sampai_tgl' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}else{               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.kondisi='RB' and a.tgl_reg<='$sampai_tgl' and a.nilai>='100000' and a.no_hapus is null and a.no_pindah is null and a.no_mutasi is null $rwyt GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		
		$cRet="<tr>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				</tr>";
	
	$jumlahx = $jumlah2+$jumlah3+$jumlah5;
	$totalx  = $nilai2+$nilai3+$nilai5;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	
	$this->fpdf->SetFont('times','',11);$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
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
	$this->fpdf->Cell(130, 5, "(".$nmtahu.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "(".$nmbend.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$tahu, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$bend, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Output();

	$this->fpdf->Output();

}

	public function lap_hilang()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu 	= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
        $riwayat	= $_REQUEST['riwayat'];
		$iz	 		= $_REQUEST['fa'];
        $oto  		= $this->session->userdata('otori');
		$skpd		= "";
		$unit		= "";
		$rwyt		= "";
		if($riwayat<>""){
		$rwyt		= "and a.kd_riwayat='$riwayat'";	
		};
		
		if($oto=='01'){
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}elseif($cskpd=='' && $cuskpd==''){
				$skpd="";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
			
		}else{
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
        }
        
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <th colspan=\"4\" align=\"center\" style=\"font-size:16px;\"><b>LAPORAN ASET LAINNYA<br/>(HILANG)</b></th>
			</tr>";
       if($cskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
	   if($cuskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;UNIT</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_uskpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Asal/Cara<br/>Perolehan<br/>Barang</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Satuan</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keadaan<br/>Barang</td>
				<td colspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Jumlah</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keterangan</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nomor<BR/>Urut</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Kode<br/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Register</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nama/Jenis<BR/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Merk<br/>Type</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Harga</td>
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
             
$csql = "SELECT * FROM 
(SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $skpd $unit 
GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $skpd $unit 
group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $skpd $unit GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan) faiz  ORDER BY kd_brg,no_reg";
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
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row->nilai)."</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
				elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nilai</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
                $i++;    
              
             }//
			 if($iz=='1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
			 elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
            $cRet .="
			 <tr></tr>
			<br/>
			<!--table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\"-->
			     
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmbend )</u><br>NIP. $bend  
                        </td>
						
						<td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmtahu )</u><br>NIP. $tahu   
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

    public function lap_hilang_dh()
    {
    if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        
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
        
        
        $tglcetak   = $this->tanggal_indonesia($_REQUEST['tglcetak']);
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">

            <tr>
                <td></td>
                <td align=\"center\" colspan=\"13\" style=\"font-size:14px;border: solid 1px white;\"><B>LAPORAN ASET LAINNYA<br>(HILANG)</B></td>
            </tr><BR/><BR/><BR/>
            </table>";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"10%\" >&ensp;&ensp;OPD</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $skpd  $nmskpd</B></td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;UNIT</td>
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
                <td align=\"left\" style=\"font-size:13px;\">: $periodbulan  $tahun</td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s.d $tahun</td>
            </tr>";
            }
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";
            
           $cRet .="  <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Asal/Cara<br/>Perolehan<br/>Barang</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Satuan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keadaan<br/>Barang</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Jumlah</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nomor<BR/>Urut</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Kode<br/>Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Register</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nama/Jenis<BR/>Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Merk<br/>Type</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Harga</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">1</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">2</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">3</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">4</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">5</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">6</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">7</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">8</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">9</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">10</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">11</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">12</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">13</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">14</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">15</td>
            </tr>
            
            </thead>
            <tfoot>
                     <tr>
                        <td colspan=\"15\" style=\"border:solid 1px white;border-top:solid 1px black;\"></td>
                     </tr>
                     </tfoot>";
            if($blnthn=='01'){
                $tglriwayat = "a.tgl_riwayat<='$last'";
            }else{
                $tglriwayat = "YEAR(a.tgl_riwayat) BETWEEN '$tahun1' AND '$tahun'";
            }
            
            if($pilctk=='1'){
                $where="AND a.kd_skpd='$skpd'";
            }else{
                $where="AND a.kd_skpd='$skpd' AND a.kd_unit='$bidang'";
            }
                $csql = "SELECT * FROM 
                        (SELECT a.kd_brg,a.no_reg,a.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
                        a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_b a WHERE $tglriwayat and a.kd_riwayat='3' $where 
                        GROUP BY a.no_reg
                        UNION
                        SELECT a.kd_brg,a.no_reg,a.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
                        a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_c a WHERE $tglriwayat and a.kd_riwayat='3' $where 
                        group by a.no_reg
                        UNION
                        SELECT a.kd_brg,a.no_reg,a.nm_brg,'' AS merek,a.no_oleh AS gabung,a.konstruksi AS kd_bahan,a.no_urut,
                        a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_d a WHERE $tglriwayat AND a.kd_riwayat='3' $where 
                        GROUP BY a.no_reg 
                        UNION
                        SELECT a.kd_brg,a.no_reg,a.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
                        a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_e a WHERE $tglriwayat and a.kd_riwayat='3' $where GROUP BY a.no_reg) xx  ORDER BY kd_brg,no_reg";
             

             $hasil = $this->db->query($csql);
             $i = 0;
             $nilaix=0;
             $jml_brgx=0;
             foreach ($hasil->result() as $row)
             {  
                $jml_brgx = $row->jumlah+$jml_brgx;
                $nilaix = $row->nilai+$nilaix;
                //$total_nilai = $row->nilai;
                $tot = $row->jumlah * $row->nilai;
                $i++;
                $cRet .="<tr>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_brg</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->no_reg</td>
                            <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                            <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row->nilai,2,',','.')."</td>
                            <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                            
                        </tr>";
                }
                
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px;\"><b>TOTAL</b></td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px;border-right:none;\"><b>Rp. ".number_format($nilaix,2,',','.')."</b></td>
                    <td bgcolor=\"#CCCCCC\" align=\"LEFT\" style=\"font-size:11px;border-left:solid 0px grey;\"></td>
                </tr>";
            $cRet .="</table>";
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
                 
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>MENGETAHUI <BR/>KEPALA OPD<br>&nbsp;<br>&nbsp;<br>
                         <u>( $namapa )</u><br>NIP. $nippa 
                        </td>
                        
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, $tglcetak<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $namabk )</u><br>NIP. $nipbk   
                        </td>
                    </tr>
                    </table>";
        $data['prev']= $cRet;
        $kertas='LEGAL';  
        
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        $skpdx = ucfirst(strtolower($test));
        $judul  ="Laporan Aset Lainnya - Laporan Barang Hilang - $skpdx.pdf";
        $this->template->set('title', 'Laporan Aset Lainnya');  
        switch($pilih) {
        case 1;  
        //$this->mdata->_mpdf3('',$cRet,4,3,3,3,$kertas,1);   
        //echo $cRet; 
             $this->_mpdf('',$cRet,10,10,10,'1',$judul);
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
    }

    function lap_hibah_dh()
    {
    if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        
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
        
        
        $tglcetak   = $this->tanggal_indonesia($_REQUEST['tglcetak']);
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">

            <tr>
                <td></td>
                <td align=\"center\" colspan=\"13\" style=\"font-size:14px;border: solid 1px white;\"><B>LAPORAN ASET LAINNYA<br>(HIBAH)</B></td>
            </tr><BR/><BR/><BR/>
            </table>";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"10%\" >&ensp;&ensp;OPD</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $skpd  $nmskpd</B></td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;UNIT</td>
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
                <td align=\"left\" style=\"font-size:13px;\">: $periodbulan  $tahun</td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s.d $tahun</td>
            </tr>";
            }
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";
            
           $cRet .="  <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Asal/Cara<br/>Perolehan<br/>Barang</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Satuan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keadaan<br/>Barang</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Jumlah</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nomor<BR/>Urut</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Kode<br/>Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Register</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nama/Jenis<BR/>Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Merk<br/>Type</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Harga</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">1</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">2</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">3</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">4</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">5</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">6</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">7</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">8</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">9</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">10</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">11</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">12</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">13</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">14</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">15</td>
            </tr>
            
            </thead>
            <tfoot>
                     <tr>
                        <td colspan=\"15\" style=\"border:solid 1px white;border-top:solid 1px black;\"></td>
                     </tr>
                     </tfoot>";
            if($blnthn=='01'){
                $tglriwayat = "a.tgl_riwayat<='$last'";
            }else{
                $tglriwayat = "YEAR(a.tgl_riwayat) BETWEEN '$tahun1' AND '$tahun'";
            }
            if($pilctk=='1'){
                $where="AND a.kd_skpd='$skpd'";
            }else{
                $where="AND a.kd_skpd='$skpd' AND a.kd_unit='$bidang'";
            }
                $csql = "SELECT * FROM 
                        (SELECT a.kd_brg,a.no_reg,a.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
                        a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_b a WHERE $tglriwayat and a.kd_riwayat='7' $where 
                        GROUP BY a.no_reg
                        UNION
                        SELECT a.kd_brg,a.no_reg,a.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
                        a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_c a WHERE $tglriwayat and a.kd_riwayat='7' $where 
                        group by a.no_reg
                        UNION
                        SELECT a.kd_brg,a.no_reg,a.nm_brg,'' AS merek,a.no_oleh AS gabung,a.konstruksi AS kd_bahan,a.no_urut,
                        a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_d a WHERE $tglriwayat AND a.kd_riwayat='7' $where 
                        GROUP BY a.no_reg 
                        UNION
                        SELECT a.kd_brg,a.no_reg,a.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
                        a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_e a WHERE $tglriwayat and a.kd_riwayat='7' $where GROUP BY a.no_reg) xx  ORDER BY kd_brg,no_reg";
             

             $hasil = $this->db->query($csql);
             $i = 0;
             $nilaix=0;
             $jml_brgx=0;
             foreach ($hasil->result() as $row)
             {  
                $jml_brgx = $row->jumlah+$jml_brgx;
                $nilaix = $row->nilai+$nilaix;
                //$total_nilai = $row->nilai;
                $tot = $row->jumlah * $row->nilai;
                $i++;
                $cRet .="<tr>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_brg</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->no_reg</td>
                            <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                            <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row->nilai,2,',','.')."</td>
                            <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                            
                        </tr>";
                }
                
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px;\"><b>TOTAL</b></td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px;border-right:none;\"><b>Rp. ".number_format($nilaix,2,',','.')."</b></td>
                    <td bgcolor=\"#CCCCCC\" align=\"LEFT\" style=\"font-size:11px;border-left:solid 0px grey;\"></td>
                </tr>";
            $cRet .="</table>";
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
                 
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>MENGETAHUI <BR/>KEPALA OPD<br>&nbsp;<br>&nbsp;<br>
                         <u>( $namapa )</u><br>NIP. $nippa 
                        </td>
                        
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, $tglcetak<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $namabk )</u><br>NIP. $nipbk   
                        </td>
                    </tr>
                    </table>";
        $data['prev']= $cRet;
        $kertas='LEGAL';  
        
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        $skpdx = ucfirst(strtolower($test));
        $judul  ="Laporan Aset Lainnya - Laporan Barang Hibah - $skpdx.pdf";
        $this->template->set('title', 'Laporan Aset Lainnya');  
        switch($pilih) {
        case 1;  
        //$this->mdata->_mpdf3('',$cRet,4,3,3,3,$kertas,1);   
        //echo $cRet; 
             $this->_mpdf('',$cRet,10,10,10,'1',$judul);
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
    }

    public function lap_rusak_berat_dh()
    {
    if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        
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
        
        
        $tglcetak   = $this->tanggal_indonesia($_REQUEST['tglcetak']);
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">

            <tr>
                <td></td>
                <td align=\"center\" colspan=\"13\" style=\"font-size:14px;border: solid 1px white;\"><B>LAPORAN ASET LAINNYA<br>(RUSAK BERAT)</B></td>
            </tr><BR/><BR/><BR/>
            </table>";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"10%\" >&ensp;&ensp;OPD</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $skpd  $nmskpd</B></td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;UNIT</td>
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
                <td align=\"left\" style=\"font-size:13px;\">: $periodbulan  $tahun</td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s.d $tahun</td>
            </tr>";
            }
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";
            
           $cRet .="  <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Asal/Cara<br/>Perolehan<br/>Barang</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Satuan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keadaan<br/>Barang</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Jumlah</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Kode<br/>Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Register</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nama/Jenis<BR/>Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Merk<br/>Type</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Harga</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">1</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">2</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">3</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">4</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">5</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\" width=\"10%\">6</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">7</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">8</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">9</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">10</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">11</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">12</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">13</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\" width=\"12%\">14</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">15</td>
            </tr>
            
            </thead>
            <tfoot>
                     <tr>
                        <td colspan=\"15\" style=\"border:solid 1px white;border-top:solid 1px black;\"></td>
                     </tr>
                     </tfoot>";
            
            if($blnthn=='01'){
                $tglreg     = "a.tgl_reg<='$last'";
                $tglmutasi  = "a.tgl_mutasi>='$last'";
                $tglpindah  = "a.tgl_pindah>='$last'";
                $tglhapus   = "a.tgl_hapus>='$last'";
                $tglriwayat = "a.tgl_riwayat>='$last'";
            }else{
                $tglreg     = "YEAR(a.tgl_reg) BETWEEN '$tahun1' AND '$tahun'";
                $tglmutasi  = "YEAR(a.tgl_mutasi) >'$tahun'";
                $tglpindah  = "YEAR(a.tgl_pindah) >'$tahun'";
                $tglhapus   = "YEAR(a.tgl_hapus) >'$tahun'";
                $tglriwayat = "YEAR(a.tgl_riwayat) <='$tahun'";
            }
            if($pilctk=='1'){
                $where="AND a.kd_skpd='$skpd'";
            }else{
                $where="AND a.kd_skpd='$skpd' AND a.kd_unit='$bidang'";
            }

            $csql ="SELECT * FROM 
                    (SELECT '02'AS kd_brg,''AS no_reg,'KIB B' AS nm_brg,'' AS merek,''AS gabung,''AS kd_bahan,''AS no_urut,
                    ''AS asal,''AS tahun,''AS silinder,''AS kd_satuan,''AS kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,''AS keterangan 
                    FROM trkib_b a WHERE $tglreg AND (a.kondisi='RB' OR (a.kd_riwayat='1' AND $tglriwayat)) $where
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR $tglmutasi) 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR $tglpindah) 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR $tglhapus)  
                    UNION
                    SELECT a.kd_brg,a.no_reg,a.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
                    a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                    FROM trkib_b a WHERE $tglreg AND (a.kondisi='RB' OR (a.kd_riwayat='1' AND $tglriwayat)) $where
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR $tglmutasi) 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR $tglpindah) 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR $tglhapus)  
                    GROUP BY a.id_barang
                    
                    UNION
                    
                    SELECT '03'AS kd_brg,''AS no_reg,'KIB C' AS nm_brg,'' AS merek,''AS gabung,''AS kd_bahan,''AS no_urut,
                    ''AS asal,''AS tahun,''AS silinder,''AS kd_satuan,''AS kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,''AS keterangan 
                    FROM trkib_c a WHERE $tglreg AND (a.kondisi='RB' OR (a.kd_riwayat='1' AND $tglriwayat)) $where
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR $tglmutasi) 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR $tglpindah) 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR $tglhapus)  
                    UNION
                    SELECT a.kd_brg,a.no_reg,a.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
                    a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                    FROM trkib_c a WHERE $tglreg AND (a.kondisi='RB' OR (a.kd_riwayat='1' AND $tglriwayat)) $where
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR $tglmutasi) 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR $tglpindah) 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR $tglhapus)  
                    GROUP BY a.id_barang
                    
                    UNION
                    
                    SELECT '04'AS kd_brg,''AS no_reg,'KIB D' AS nm_brg,'' AS merek,''AS gabung,''AS kd_bahan,''AS no_urut,
                    ''AS asal,''AS tahun,''AS silinder,''AS kd_satuan,''AS kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,''AS keterangan 
                    FROM trkib_d a WHERE $tglreg AND (a.kondisi='RB' OR (a.kd_riwayat='1' AND $tglriwayat)) $where
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR $tglmutasi) 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR $tglpindah) 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR $tglhapus)  
                    UNION
                    SELECT a.kd_brg,a.no_reg,a.nm_brg,'' AS merek,a.no_oleh AS gabung,a.konstruksi AS kd_bahan,a.no_urut,
                    a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                    FROM trkib_d a WHERE $tglreg AND (a.kondisi='RB' OR (a.kd_riwayat='1' AND $tglriwayat)) $where
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR $tglmutasi) 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR $tglpindah) 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR $tglhapus)  
                    GROUP BY a.id_barang
                    
                    UNION
                    
                    SELECT '05'AS kd_brg,''AS no_reg,'KIB E' AS nm_brg,'' AS merek,''AS gabung,''AS kd_bahan,''AS no_urut,
                    ''AS asal,''AS tahun,''AS silinder,''AS kd_satuan,''AS kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,''AS keterangan 
                    FROM trkib_e a WHERE $tglreg AND (a.kondisi='RB' OR (a.kd_riwayat='1' AND $tglriwayat)) $where
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR $tglmutasi) 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR $tglpindah) 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR $tglhapus)  
                    UNION
                    SELECT a.kd_brg,a.no_reg,a.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
                    a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                    FROM trkib_e a WHERE $tglreg AND (a.kondisi='RB' OR (a.kd_riwayat='1' AND $tglriwayat)) $where
                    AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR $tglmutasi) 
                    AND (a.no_pindah IS NULL OR a.no_pindah='' OR $tglpindah) 
                    AND (a.no_hapus IS NULL OR a.no_hapus='' OR $tglhapus)  
                    GROUP BY a.id_barang
                    
                    ) xx  ORDER BY kd_brg,no_reg";
                
             

             $hasil = $this->db->query($csql);
             $i = 0;
             $nilaix=0;
             $jml_brgx=0;
             foreach ($hasil->result() as $row)
             {  
                
                //$total_nilai = $row->nilai;
                $tot = $row->jumlah * $row->nilai;
                $brg = $row->kd_brg;
                $nmbrg = $row->nm_brg;
                if(strlen($brg)==2 && $row->jumlah<>''){
                    $cRet .="<tr>
                            <td align=\"left\" colspan=\"12\" style=\"font-size:11px; border-bottom:solid 1px black;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><b>$brg  $nmbrg</b></i></td>
                            
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><i><b>$row->jumlah</b></i></td>
                            <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\"><i><b>".number_format($row->nilai,2,',','.')."</b></i></td>
                            <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\"></td>
                            
                        </tr>";
                }else if(strlen($brg)>2 && $row->jumlah<>''){
                   $i++;
                   $jml_brgx = $row->jumlah+$jml_brgx;
                   $nilaix = $row->nilai+$nilaix;
                $cRet .="<tr>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$brg</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->no_reg</td>
                            <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$nmbrg</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                            <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row->nilai,2,',','.')."</td>
                            <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                            
                        </tr>"; 
                }
                
                }
                
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px;\"><i><b>TOTAL</b></i></td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px;\"><i><b>$jml_brgx</b></i></td>
                    <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px;border-right:none;\"><i><b>Rp. ".number_format($nilaix,2,',','.')."</b></i></td>
                    <td bgcolor=\"#CCCCCC\" align=\"LEFT\" style=\"font-size:11px;border-left:solid 0px grey;\"></td>
                </tr>";
            $cRet .="</table>";
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
                 
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>MENGETAHUI <BR/>KEPALA OPD<br>&nbsp;<br>&nbsp;<br>
                        <u>( $namapa )</u><br>NIP. $nippa  
                        </td>
                        
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, $tglcetak<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $namabk )</u><br>NIP. $nipbk   
                        </td>
                    </tr>
                    </table>";
        $data['prev']= $cRet;
        $kertas='LEGAL';  
        
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        $skpdx = ucfirst(strtolower($test));
        $judul  ="Laporan Aset Lainnya - Laporan Barang Rusak Berat - $skpdx.pdf";
        $this->template->set('title', 'Laporan Aset Lainnya');  
        switch($pilih) {
        case 1;  
        //$this->mdata->_mpdf3('',$cRet,4,3,3,3,$kertas,1);   
        //echo $cRet; 
             $this->_mpdf('',$cRet,10,10,10,'1',$judul);
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
    }
	
	function lap_aset_hilangx(){
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu		= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$riwayat	= $_REQUEST['riwayat'];
		$rwyt		= "";
		if($riwayat<>''){
			$rwyt="and a.kd_riwayat='$riwayat'";
		}
		
	// legal = 21.59 x 35.56 // 215 x 355
	define('FPDF_FONTPATH', $this->config->item('fonts_path'));

	$this->load->library('fpdf');

	$this->fpdf->FPDF($orientation='L', $unit='mm', $size='LEGAL');
	$this->fpdf->addPage();
	
	$this->fpdf->SetMargins($left = 10, $top = 10, $right = 10);

	// sisa panjang dalam = 215 - (10 + 10) = 195
	// $this->fpdf->SetFontSize(12);
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='LAPORAN ASET LAINNYA', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();

	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='(HILANG)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	if($cskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='SKPD ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_skpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}
	if($cuskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='UNIT ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_uskpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}

	$this->fpdf->Cell($w = 50, $h = 5, $txt='KOTA ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$kota, $border=0, $ln=0, $align='L', $fill=false, $link='');
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
	$this->fpdf->SetFont('times','B',8);
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
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell(37, $height_table, $txt='JUMLAH', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, $height_table, $txt='KET', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();	
	
	$height_table  = 7;
	$width_no_urut = 30;
	$width_rek     = 115;
	$width_nilai   = 15;
	
	$this->fpdf->SetFillColor(255,255,250);
	$this->fpdf->SetFont('times','B',8);
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
    
	if($cskpd<>'' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt 
	GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	}elseif($cskpd<>'' && $cuskpd<>''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt 
	GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}elseif($cskpd=='' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt 
	GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	
	}else{
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt 
	GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}
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
		
	$this->fpdf->SetFont('times','',8);	
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
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt 
	group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt 
	group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd=='' && $cuskpd==''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt 
	group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}else{
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt 
	group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and  a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}elseif($cskpd=='' && $cuskpd==''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}else{               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and a.kd_riwayat='3' $rwyt GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}
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
		
	$this->fpdf->SetFont('times','',8);
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
		
		$cRet="<tr>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				</tr>";
	
	$jumlahx = $jumlah2+$jumlah3+$jumlah5;
	$totalx  = $nilai2+$nilai3+$nilai5;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	
	$this->fpdf->SetFont('times','',11);$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
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
	$this->fpdf->Cell(130, 5, "(".$nmtahu.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "(".$nmbend.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$tahu, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$bend, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Output();

	$this->fpdf->Output();

}
	public function lap_tdk_tau()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu 	= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
        $riwayat	= $_REQUEST['riwayat'];
		$iz	 		= $_REQUEST['fa'];
        $oto  		= $this->session->userdata('otori');
		$skpd		= "";
		$unit		= "";
		$rwyt		= "";
		if($riwayat<>""){
		$rwyt		= "and a.kd_riwayat='$riwayat'";	
		};
		
		if($oto=='01'){
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}elseif($cskpd=='' && $cuskpd==''){
				$skpd="";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
			
		}else{
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
        }
        
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <th colspan=\"4\" align=\"center\" style=\"font-size:16px;\"><b>LAPORAN ASET LAINNYA<br/>(TIDAK DIKETAHUI KEBERADAANNYA)</b></th>
			</tr>";
       if($cskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
	   if($cuskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;UNIT</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_uskpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Asal/Cara<br/>Perolehan<br/>Barang</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Satuan</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keadaan<br/>Barang</td>
				<td colspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Jumlah</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keterangan</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nomor<BR/>Urut</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Kode<br/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Register</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nama/Jenis<BR/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Merk<br/>Type</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Harga</td>
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
             
$csql = "SELECT * FROM 
(SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' $skpd $unit 
GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' $skpd $unit group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' $skpd $unit GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan) faiz  ORDER BY kd_brg,no_reg";
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
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row->nilai)."</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
				elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nilai</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
                $i++;    
              
             }//
			 if($iz=='1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
			 elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
            $cRet .="
			 <tr></tr>
			<br/>
			<!--table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\"-->
			     
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmbend )</u><br>NIP. $bend  
                        </td>
						
						<td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmtahu )</u><br>NIP. $tahu   
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

    public function lap_tdk_tau_dh()
    {
    if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        
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
        
        $tglcetak   = $this->tanggal_indonesia($_REQUEST['tglcetak']);
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">

            <tr>
                <td></td>
                <td align=\"center\" colspan=\"13\" style=\"font-size:14px;border: solid 1px white;\"><B>LAPORAN ASET LAINNYA<br/>(TIDAK DIKETAHUI KEBERADAANNYA)</B></td>
            </tr><BR/><BR/><BR/>
            </table>";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          
           if ($skpd <>''){ 
          $cRet .="
            <tr>
                <td align=\"left\" style=\"font-size:13px;\" width =\"10%\" >&ensp;&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:13px;\">:<B> $skpd  $nmskpd</B></td>
            </tr>";} 
          if ($pilctk=='2'){    
        $cRet .=" <tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;UNIT</td>
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
                <td align=\"left\" style=\"font-size:13px;\">: $periodbulan  $tahun</td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s.d $tahun</td>
            </tr>";
            }
        }else {
            $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s/d $tahun2</td>
            </tr>";
        }
           $cRet .="</table>";
            
           $cRet .="  <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Asal/Cara<br/>Perolehan<br/>Barang</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Satuan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keadaan<br/>Barang</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Jumlah</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nomor<BR/>Urut</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Kode<br/>Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Register</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nama/Jenis<BR/>Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Merk<br/>Type</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Barang</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Harga</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">1</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">2</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">3</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">4</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">5</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">6</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">7</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">8</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">9</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">10</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">11</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">12</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">13</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">14</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">15</td>
            </tr>
            
            </thead>
            <tfoot>
                     <tr>
                        <td colspan=\"15\" style=\"border:solid 1px white;border-top:solid 1px black;\"></td>
                     </tr>
                     </tfoot>";
            if($blnthn=='01'){
                $tglriwayat = "a.tgl_riwayat<='$last'";
            }else{
                $tglriwayat = "YEAR(a.tgl_riwayat) BETWEEN '$tahun1' AND '$tahun'";
            }
            

            if($pilctk=='1'){
                $where="AND a.kd_skpd='$skpd'";
            }else{
                $where="AND a.kd_skpd='$skpd' AND a.kd_unit='$bidang'";
            }
                $csql = "SELECT * FROM 
                        (SELECT a.kd_brg,a.no_reg,a.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
                        a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_b a WHERE $tglriwayat and a.kd_riwayat='4' $where 
                        GROUP BY a.no_reg
                        UNION
                        SELECT a.kd_brg,a.no_reg,a.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
                        a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_c a WHERE $tglriwayat and a.kd_riwayat='4' $where 
                        group by a.no_reg
                        UNION
                        SELECT a.kd_brg,a.no_reg,a.nm_brg,'' AS merek,a.no_oleh AS gabung,a.konstruksi AS kd_bahan,a.no_urut,
                        a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_d a WHERE $tglriwayat AND a.kd_riwayat='4' $where 
                        GROUP BY a.no_reg  
                        UNION
                        SELECT a.kd_brg,a.no_reg,a.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
                        a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,SUM(a.jumlah) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
                        FROM trkib_e a WHERE $tglriwayat and a.kd_riwayat='4' $where GROUP BY a.no_reg) xx  ORDER BY kd_brg,no_reg";
             

             $hasil = $this->db->query($csql);
             $i = 0;
             $nilaix=0;
             $jml_brgx=0;
             foreach ($hasil->result() as $row)
             {  
                $jml_brgx = $row->jumlah+$jml_brgx;
                $nilaix = $row->nilai+$nilaix;
                //$total_nilai = $row->nilai;
                $tot = $row->jumlah * $row->nilai;
                $i++;
                $cRet .="<tr>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_brg</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->no_reg</td>
                            <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                            <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                            <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row->nilai,2,',','.')."</td>
                            <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                            
                        </tr>";
                }
                
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px;\"><b>TOTAL</b></td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:11px;border-right:none;\"><b>Rp. ".number_format($nilaix,2,',','.')."</b></td>
                    <td bgcolor=\"#CCCCCC\" align=\"LEFT\" style=\"font-size:11px;border-left:solid 0px grey;\"></td>
                </tr>";
            $cRet .="</table>";
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
                 
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
                        <u>( $namapa )</u><br>NIP. $nippa  
                        </td>
                        
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, $tglcetak<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $namabk )</u><br>NIP. $nipbk   
                        </td>
                    </tr>
                    </table>";
        $data['prev']= $cRet;
        $kertas='LEGAL';  
        
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        $skpdx = ucfirst(strtolower($test));
        $judul  ="Laporan Aset Lainnya - Laporan Barang Tidak Diketahui Keberadaannya - $skpdx.pdf";
        $this->template->set('title', 'Laporan Aset Lainnya');  
        switch($pilih) {
        case 1;  
         
             $this->_mpdf('',$cRet,10,10,10,'1',$judul);
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
    }
	
	function lap_aset_tdk_taux(){
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu		= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$riwayat	= $_REQUEST['riwayat'];
		$rwyt		= "";
		if($riwayat<>''){
			$rwyt="and a.kd_riwayat='$riwayat'";
		}
		
	// legal = 21.59 x 35.56 // 215 x 355
	define('FPDF_FONTPATH', $this->config->item('fonts_path'));

	$this->load->library('fpdf');

	$this->fpdf->FPDF($orientation='L', $unit='mm', $size='LEGAL');
	$this->fpdf->addPage();
	
	$this->fpdf->SetMargins($left = 10, $top = 10, $right = 10);

	// sisa panjang dalam = 215 - (10 + 10) = 195
	// $this->fpdf->SetFontSize(12);
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='LAPORAN ASET LAINNYA', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='(TIDAK DIKETAHUI KEBERADAANNYA)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	if($cskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='SKPD ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_skpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}
	if($cuskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='UNIT ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_uskpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}

	$this->fpdf->Cell($w = 50, $h = 5, $txt='KOTA ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$kota, $border=0, $ln=0, $align='L', $fill=false, $link='');
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
	$this->fpdf->SetFont('times','B',8);
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
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell(37, $height_table, $txt='JUMLAH', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, $height_table, $txt='KET', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();	
	
	$height_table  = 7;
	$width_no_urut = 30;
	$width_rek     = 115;
	$width_nilai   = 15;
	
	$this->fpdf->SetFillColor(255,255,250);
	$this->fpdf->SetFont('times','B',8);
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
    
	if($cskpd<>'' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' 
	GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	}elseif($cskpd<>'' && $cuskpd<>''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' 
	GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}elseif($cskpd=='' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' 
	GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	
	}else{
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' 
	GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}
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
		
	$this->fpdf->SetFont('times','',8);	
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
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd=='' && $cuskpd==''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}else{
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}elseif($cskpd=='' && $cuskpd==''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}else{               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and kd_riwayat='4' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		
		$cRet="<tr>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				</tr>";
	
	$jumlahx = $jumlah2+$jumlah3+$jumlah5;
	$totalx  = $nilai2+$nilai3+$nilai5;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	
	$this->fpdf->SetFont('times','',11);$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
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
	$this->fpdf->Cell(130, 5, "(".$nmtahu.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "(".$nmbend.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$tahu, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$bend, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Output();

	$this->fpdf->Output();

}
	public function lap_rusak_berat()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu 	= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
        $riwayat	= $_REQUEST['riwayat'];
		$iz	 		= $_REQUEST['fa'];
        $oto  		= $this->session->userdata('otori');
		$skpd		= "";
		$unit		= "";
		$rwyt		= "";
		if($riwayat<>""){
		$rwyt		= "and a.kd_riwayat='$riwayat'";	
		};
		
		if($oto=='01'){
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}elseif($cskpd=='' && $cuskpd==''){
				$skpd="";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
			
		}else{
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
        }
        
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <th colspan=\"4\" align=\"center\" style=\"font-size:16px;\"><b>LAPORAN ASET LAINNYA<br/>(RUSAK BERAT)</b></th>
			</tr>";
       if($cskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
	   if($cuskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;UNIT</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_uskpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Asal/Cara<br/>Perolehan<br/>Barang</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Satuan</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keadaan<br/>Barang</td>
				<td colspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Jumlah</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keterangan</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nomor<BR/>Urut</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Kode<br/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Register</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nama/Jenis<BR/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Merk<br/>Type</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Harga</td>
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
             
$csql = "SELECT * FROM 
(SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') $skpd $unit GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') $skpd $unit group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') $skpd $unit GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan) faiz  ORDER BY kd_brg,no_reg";
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
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row->nilai)."</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
				elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nilai</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
                $i++;    
              
             }//
			 if($iz=='1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
			 elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
            $cRet .="
			 <tr></tr>
			<br/>
			<!--table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\"-->
			     
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmbend )</u><br>NIP. $bend  
                        </td>
						
						<td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmtahu )</u><br>NIP. $tahu   
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
	
	function lap_aset_rusak_beratx(){
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu		= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$riwayat	= $_REQUEST['riwayat'];
		$rwyt		= "";
		if($riwayat<>''){
			$rwyt="and a.kd_riwayat='$riwayat'";
		}
		
	// legal = 21.59 x 35.56 // 215 x 355
	define('FPDF_FONTPATH', $this->config->item('fonts_path'));

	$this->load->library('fpdf');

	$this->fpdf->FPDF($orientation='L', $unit='mm', $size='LEGAL');
	$this->fpdf->addPage();
	
	$this->fpdf->SetMargins($left = 10, $top = 10, $right = 10);

	// sisa panjang dalam = 215 - (10 + 10) = 195
	// $this->fpdf->SetFontSize(12);
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='LAPORAN ASET LAINNYA', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='(RUSAK BERAT)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	if($cskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='SKPD ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_skpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}
	if($cuskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='UNIT ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_uskpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}

	$this->fpdf->Cell($w = 50, $h = 5, $txt='KOTA ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$kota, $border=0, $ln=0, $align='L', $fill=false, $link='');
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
	$this->fpdf->SetFont('times','B',8);
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
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell(37, $height_table, $txt='JUMLAH', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, $height_table, $txt='KET', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();	
	
	$height_table  = 7;
	$width_no_urut = 30;
	$width_rek     = 115;
	$width_nilai   = 15;
	
	$this->fpdf->SetFillColor(255,255,250);
	$this->fpdf->SetFont('times','B',8);
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
    
	if($cskpd<>'' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') 
	GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	}elseif($cskpd<>'' && $cuskpd<>''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}elseif($cskpd=='' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	
	}else{
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}
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
		
	$this->fpdf->SetFont('times','',8);	
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
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd=='' && $cuskpd==''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}else{
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd'  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd'  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}elseif($cskpd=='' && $cuskpd==''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}else{               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and (a.kd_riwayat='1' or a.kondisi='RB') GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		
		$cRet="<tr>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				</tr>";
	
	$jumlahx = $jumlah2+$jumlah3+$jumlah5;
	$totalx  = $nilai2+$nilai3+$nilai5;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	
	$this->fpdf->SetFont('times','',11);$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
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
	$this->fpdf->Cell(130, 5, "(".$nmtahu.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "(".$nmbend.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$tahu, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$bend, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Output();

	$this->fpdf->Output();

}
	public function lap_pemanfaatan()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu 	= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
        $riwayat	= $_REQUEST['riwayat'];
		$iz	 		= $_REQUEST['fa'];
        $oto  		= $this->session->userdata('otori');
		$skpd		= "";
		$unit		= "";
		$rwyt		= "";
		if($riwayat<>""){
		$rwyt		= "and a.kd_riwayat='$riwayat'";	
		};
		
		if($oto=='01'){
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}elseif($cskpd=='' && $cuskpd==''){
				$skpd="";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
			
		}else{
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
        }
        
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <th colspan=\"4\" align=\"center\" style=\"font-size:16px;\"><b>LAPORAN ASET LAINNYA<BR/>(PEMANFAATAN)</b></th>
			</tr>";
       if($cskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
	   if($cuskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;UNIT</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_uskpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Asal/Cara<br/>Perolehan<br/>Barang</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Satuan</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keadaan<br/>Barang</td>
				<td colspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Jumlah</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keterangan</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nomor<BR/>Urut</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Kode<br/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Register</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nama/Jenis<BR/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Merk<br/>Type</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Harga</td>
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
             
$csql = "SELECT * FROM 
(SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' $skpd $unit GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' $skpd $unit group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' $skpd $unit GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan) faiz  ORDER BY kd_brg,no_reg";
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
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row->nilai)."</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
				elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nilai</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
                $i++;    
              
             }//
			 if($iz=='1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
			 elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
            $cRet .="
			 <tr></tr>
			<br/>
			<!--table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\"-->
			     
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmbend )</u><br>NIP. $bend  
                        </td>
						
						<td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmtahu )</u><br>NIP. $tahu   
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
	
	function lap_aset_pemanfaatanx(){
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu		= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$riwayat	= $_REQUEST['riwayat'];
		$rwyt		= "";
		if($riwayat<>''){
			$rwyt="and a.kd_riwayat='$riwayat'";
		}
		
	// legal = 21.59 x 35.56 // 215 x 355
	define('FPDF_FONTPATH', $this->config->item('fonts_path'));

	$this->load->library('fpdf');

	$this->fpdf->FPDF($orientation='L', $unit='mm', $size='LEGAL');
	$this->fpdf->addPage();
	
	$this->fpdf->SetMargins($left = 10, $top = 10, $right = 10);

	// sisa panjang dalam = 215 - (10 + 10) = 195
	// $this->fpdf->SetFontSize(12);
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='LAPORAN ASET LAINNYA', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='(PEMANFAATAN)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	if($cskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='SKPD ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_skpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}
	if($cuskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='UNIT ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_uskpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}

	$this->fpdf->Cell($w = 50, $h = 5, $txt='KOTA ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$kota, $border=0, $ln=0, $align='L', $fill=false, $link='');
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
	$this->fpdf->SetFont('times','B',8);
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
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell(37, $height_table, $txt='JUMLAH', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, $height_table, $txt='KET', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();	
	
	$height_table  = 7;
	$width_no_urut = 30;
	$width_rek     = 115;
	$width_nilai   = 15;
	
	$this->fpdf->SetFillColor(255,255,250);
	$this->fpdf->SetFont('times','B',8);
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
    
	if($cskpd<>'' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	}elseif($cskpd<>'' && $cuskpd<>''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}elseif($cskpd=='' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	
	}else{
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}
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
		
	$this->fpdf->SetFont('times','',8);	
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
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd=='' && $cuskpd==''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}else{
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}elseif($cskpd=='' && $cuskpd==''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}else{               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and a.tgl_reg<='$sampai_tgl' and kd_riwayat='8' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		
		$cRet="<tr>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				</tr>";
	
	$jumlahx = $jumlah2+$jumlah3+$jumlah5;
	$totalx  = $nilai2+$nilai3+$nilai5;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	
	$this->fpdf->SetFont('times','',11);$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
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
	$this->fpdf->Cell(130, 5, "(".$nmtahu.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "(".$nmbend.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$tahu, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$bend, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Output();

	$this->fpdf->Output();

}
	public function lap_lapuk()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu 	= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
        $riwayat	= $_REQUEST['riwayat'];
		$iz	 		= $_REQUEST['fa'];
        $oto  		= $this->session->userdata('otori');
		$skpd		= "";
		$unit		= "";
		$rwyt		= "";
		if($riwayat<>""){
		$rwyt		= "and a.kd_riwayat='$riwayat'";	
		};
		
		if($oto=='01'){
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}elseif($cskpd=='' && $cuskpd==''){
				$skpd="";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
			
		}else{
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
        }
        
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <th colspan=\"4\" align=\"center\" style=\"font-size:16px;\"><b>LAPORAN ASET LAINNYA<BR/>(LAPUK UMUR PENGGUNAAN)</b></th>
			</tr>";
       if($cskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
	   if($cuskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;UNIT</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_uskpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Asal/Cara<br/>Perolehan<br/>Barang</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Satuan</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keadaan<br/>Barang</td>
				<td colspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Jumlah</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keterangan</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nomor<BR/>Urut</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Kode<br/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Register</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nama/Jenis<BR/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Merk<br/>Type</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Harga</td>
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
             
$csql = "SELECT * FROM 
(SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' $skpd $unit GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' $skpd $unit group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' $skpd $unit GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan) faiz  ORDER BY kd_brg,no_reg";
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
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row->nilai)."</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
				elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nilai</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
                $i++;    
              
             }//
			 if($iz=='1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
			 elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
            $cRet .="
			 <tr></tr>
			<br/>
			<!--table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\"-->
			     
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmbend )</u><br>NIP. $bend  
                        </td>
						
						<td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmtahu )</u><br>NIP. $tahu   
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
	
	function lap_aset_lapukx(){
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu		= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$riwayat	= $_REQUEST['riwayat'];
		$rwyt		= "";
		if($riwayat<>''){
			$rwyt="and a.kd_riwayat='$riwayat'";
		}
		
	// legal = 21.59 x 35.56 // 215 x 355
	define('FPDF_FONTPATH', $this->config->item('fonts_path'));

	$this->load->library('fpdf');

	$this->fpdf->FPDF($orientation='L', $unit='mm', $size='LEGAL');
	$this->fpdf->addPage();
	
	$this->fpdf->SetMargins($left = 10, $top = 10, $right = 10);

	// sisa panjang dalam = 215 - (10 + 10) = 195
	// $this->fpdf->SetFontSize(12);
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='LAPORAN ASET LAINNYA', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='(LAPUK UMUR PENGGUNAAN)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	if($cskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='SKPD ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_skpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}
	if($cuskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='UNIT ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_uskpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}

	$this->fpdf->Cell($w = 50, $h = 5, $txt='KOTA ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$kota, $border=0, $ln=0, $align='L', $fill=false, $link='');
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
	$this->fpdf->SetFont('times','B',8);
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
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell(37, $height_table, $txt='JUMLAH', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, $height_table, $txt='KET', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();	
	
	$height_table  = 7;
	$width_no_urut = 30;
	$width_rek     = 115;
	$width_nilai   = 15;
	
	$this->fpdf->SetFillColor(255,255,250);
	$this->fpdf->SetFont('times','B',8);
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
    
	if($cskpd<>'' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	}elseif($cskpd<>'' && $cuskpd<>''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}elseif($cskpd=='' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	
	}else{
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}
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
		
	$this->fpdf->SetFont('times','',8);	
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
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd=='' && $cuskpd==''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}else{
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}elseif($cskpd=='' && $cuskpd==''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}else{               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='10' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		
		$cRet="<tr>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				</tr>";
	
	$jumlahx = $jumlah2+$jumlah3+$jumlah5;
	$totalx  = $nilai2+$nilai3+$nilai5;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	
	$this->fpdf->SetFont('times','',11);$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
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
	$this->fpdf->Cell(130, 5, "(".$nmtahu.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "(".$nmbend.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$tahu, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$bend, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Output();

	$this->fpdf->Output();

}
	public function lap_dikuasai_lain()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu 	= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
        $riwayat	= $_REQUEST['riwayat'];
		$iz	 		= $_REQUEST['fa'];
        $oto  		= $this->session->userdata('otori');
		$skpd		= "";
		$unit		= "";
		$rwyt		= "";
		if($riwayat<>""){
		$rwyt		= "and a.kd_riwayat='$riwayat'";	
		};
		
		if($oto=='01'){
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}elseif($cskpd=='' && $cuskpd==''){
				$skpd="";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
			
		}else{
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
        }
        
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <th colspan=\"4\" align=\"center\" style=\"font-size:16px;\"><b>LAPORAN ASET LAINNYA<br/>(DIKUASAI PIHAK LAIN)</b></th>
			</tr>";
       if($cskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_skpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
	   if($cuskpd<>''){
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;UNIT</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $cnm_uskpd</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
				<br/>
	   </tr>";}
            $cRet .= "<tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:12px;\">&ensp;KOTA</td>
                <td width =\"45%\" align=\"left\" style=\"font-size:12px;\">: $kota</td>
				<td width =\"30%\" align=\"left\" style=\"font-size:12px;\"></td>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">NOMOR</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Bahan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Asal/Cara<br/>Perolehan<br/>Barang</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Tahun<br/>Perolehan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Ukuran<br/>Barang<br/>Konstruksi<br/>PSD</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Satuan</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keadaan<br/>Barang</td>
				<td colspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Jumlah</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Keterangan</td>
			</tr>
			<tr>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nomor<BR/>Urut</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Kode<br/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Register</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Nama/Jenis<BR/>Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Merk<br/>Type</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">No. Sertifikat<br/>No. Pabrik<br/>No. Chasis<br/>No. Mesin</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Barang</td>
				<td align=\"center\" bgcolor=\"#CCCCCC\"  style=\"font-size:12px\">Harga</td>
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
             
$csql = "SELECT * FROM 
(SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' $skpd $unit GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' $skpd $unit group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan 
UNION
SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,a.keterangan 
FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' $skpd $unit GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan) faiz  ORDER BY kd_brg,no_reg";
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
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row->nilai)."</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
				elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->silinder</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kd_satuan</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->nilai</td>
                    <td align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row->keterangan</td>
                    
                </tr>";}
                $i++;    
              
             }//
			 if($iz=='1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
			 elseif($iz<>'1'){
                $cRet .="
                 <tr>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"12\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">TOTAL</td>
                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#CCCCCC\" COLSPAN=\"2\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>";}
            $cRet .="
			 <tr></tr>
			<br/>
			<!--table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\"-->
			     
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        <br>MENGETAHUI <BR/>KEPALA SKPD<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmbend )</u><br>NIP. $bend  
                        </td>
						
						<td colspan =\"8\" align=\"center\" style=\"font-size:12px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl)."<br>PENGURUS BARANG<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nmtahu )</u><br>NIP. $tahu   
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
	
	function lap_aset_dikuasai_lainx(){
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $tahu 		= $_REQUEST['tahu'];
        $bend 		= $_REQUEST['bend'];
        $nmtahu		= $_REQUEST['nmtahu'];
        $nmbend		= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$riwayat	= $_REQUEST['riwayat'];
		$rwyt		= "";
		if($riwayat<>''){
			$rwyt="and a.kd_riwayat='$riwayat'";
		}
		
	// legal = 21.59 x 35.56 // 215 x 355
	define('FPDF_FONTPATH', $this->config->item('fonts_path'));

	$this->load->library('fpdf');

	$this->fpdf->FPDF($orientation='L', $unit='mm', $size='LEGAL');
	$this->fpdf->addPage();
	
	$this->fpdf->SetMargins($left = 10, $top = 10, $right = 10);

	// sisa panjang dalam = 215 - (10 + 10) = 195
	// $this->fpdf->SetFontSize(12);
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='LAPORAN ASET LAINNYA', $border=0, $ln=0, $align='C', $fill=false, $link='');

	$this->fpdf->Ln();
	$this->fpdf->SetFont('times','B',12);
	$this->fpdf->Cell($w = 340, $h = 7, $txt='(DIKUASAI PIHAK LAIN)', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();

	$this->fpdf->Ln();
	if($cskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='SKPD ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_skpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}
	if($cuskpd<>''){
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='UNIT ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$cskpd." - ".$cnm_uskpd , $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();}

	$this->fpdf->Cell($w = 50, $h = 5, $txt='KOTA ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, ": ".$kota, $border=0, $ln=0, $align='L', $fill=false, $link='');
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
	$this->fpdf->SetFont('times','B',8);
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
	$this->fpdf->SetFont('times','B',10);
	$this->fpdf->Cell(37, $height_table, $txt='JUMLAH', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, $height_table, $txt='KET', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();	
	
	$height_table  = 7;
	$width_no_urut = 30;
	$width_rek     = 115;
	$width_nilai   = 15;
	
	$this->fpdf->SetFillColor(255,255,250);
	$this->fpdf->SetFont('times','B',8);
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
    
	if($cskpd<>'' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	}elseif($cskpd<>'' && $cuskpd<>''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}elseif($cskpd=='' && $cuskpd==''){
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  
	
	}else{
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' GROUP BY a.no_urut,a.nilai,a.no_polisi,a.tahun,a.kd_brg,a.keterangan";  

	}
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
		
	$this->fpdf->SetFont('times','',8);	
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
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}elseif($cskpd=='' && $cuskpd==''){
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}else{
		$sql1xx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,
	a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai3,count(nilai) as jumlah3,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' group by a.kd_brg,a.luas_tanah,a.luas_lantai,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		if($cskpd<>'' && $cuskpd==''){               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}elseif($cskpd<>'' && $cuskpd<>''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_unit='$cuskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}elseif($cskpd=='' && $cuskpd==''){
				$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  

		}else{               
	$sql1xxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.judul),15) as merek,a.spesifikasi AS gabung,a.kd_bahan,
	a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai5,count(nilai) as jumlah5,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' and  a.tgl_reg<='$sampai_tgl' and kd_riwayat='11' GROUP BY a.kd_brg,a.tahun,a.nilai,a.keterangan";  
		}
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
		
		
	$this->fpdf->SetFont('times','',8);
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
	
		
		$cRet="<tr>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				<td bgcolor=\"#CCCCCC\">sadas</td>
				</tr>";
	
	$jumlahx = $jumlah2+$jumlah3+$jumlah5;
	$totalx  = $nilai2+$nilai3+$nilai5;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();
	
	$this->fpdf->SetFont('times','',11);$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
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
	$this->fpdf->Cell(130, 5, "(".$nmtahu.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "(".$nmbend.")", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$tahu, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(40, 5,'', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(130, 5, "NIP. ".$bend, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Output();

	$this->fpdf->Output();

}

function rekap_aset_lainnya_dh(){
       
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
        
        
        $tglcetak   = $this->tanggal_indonesia($_REQUEST['tglcetak']);
        
        $cRet ='';
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          $cRet .="
            
            <tr>
                <td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>REKAPITULASI BUKU INVENTARIS BARANG<br>MILIK PEMERINTAH KABUPATEN $nmkab<br>TAHUN $tahun</B></td>
            </tr><BR/><BR/><BR/></table>";
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
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KOTA</td>
                <td align=\"left\" style=\"font-size:13px;\">: $kota</td>
            </tr>";
        if($pilctk=='1' || $pilctk=='2'){
            if($blnthn=='01'){
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $periodbulan  $tahun</td>
            </tr>";
            }else{
                $cRet .="<tr>
                <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
                <td align=\"left\" style=\"font-size:13px;\">: $tahun1 s.d $tahun</td>
            </tr>";
            }
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
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\">No Urut</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\">Gol</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\">Kode<br>Bidang<br>Barang</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\">Nama <br>Bidang Barang</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\">Jumlah Barang</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\">Jumlah Harga<br>(Rp)</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:12px\">Keterangan</td>
            </tr>
            <tr>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\">1</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\">2</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\">3</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\">4</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\">5</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\">6</td>
                <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\">7</td>
            </tr>
            
             </thead>

            <tfoot>
                     <tr>
                        <td colspan=\"7\" style=\"border:solid 1px white;border-top:solid 1px black;\"></td>
                     </tr>
                     </tfoot>
                ";

                $query = $this->db->query("SELECT no_urut,no,gol,kode,kd_brg,seq,nama FROM mrekap ORDER BY no_urut");
                
                $i      = 1;
                $cjumlah= 0;$where='';$where1='';
                if($tot=0){$tot=0;}else{$tot=$tot;}
                if($totn=0){$totn=0;}else{$totn=$totn;}
                
            foreach($query->result_array() as $res){
                $no     = $res['no'];
                $gol    = $res['gol'];
                $kode   = $res['kode'];
                $ckode  = $res['kd_brg'];
                $cnama  = $res['nama'];
                $no_urut= $res['no_urut'];
                $seq    = $res['seq'];

                if($blnthn=='01'){
                    $tglreg     = "tgl_reg<='$last'";
                    $tglmutasi  = "tgl_mutasi>='$last'";
                    $tglpindah  = "tgl_pindah>='$last'";
                    $tglhapus   = "tgl_hapus>='$last'";
                    $tglriwayat = "tgl_riwayat<='$last'";
                }else{
                    $tglreg     = "YEAR(tgl_reg) BETWEEN '$tahun1' AND '$tahun'";
                    $tglmutasi  = "YEAR(tgl_mutasi) BETWEEN '$tahun1' AND '$tahun'";
                    $tglpindah  = "YEAR(tgl_pindah) BETWEEN '$tahun1' AND '$tahun'";
                    $tglhapus   = "YEAR(tgl_hapus) BETWEEN '$tahun1' AND '$tahun'";
                    $tglriwayat = "YEAR(tgl_riwayat) BETWEEN '$tahun1' AND '$tahun'";
                }
            

                if($pilctk=='1'){
                $where1="kd_skpd='$skpd'";
                }else{
                    $where1="kd_skpd='$skpd' AND kd_unit='$bidang'";
                }
                if(strlen($ckode)==2){
                        $where="AND kd_golongan='$ckode'";
                    }else{
                        $where="AND kd_bidang='$ckode'";                        
                    }

                if($kode==01){
                    $tot1=0;$totn1=0;
                    $sql1 = $this->db->query("SELECT IFNULL(SUM(jumlah),0) AS jum_awal,IFNULL(SUM(nilai),0) AS nilai FROM trkib_a WHERE $where1 $where AND $tglriwayat 
                                                AND (no_mutasi IS NULL OR no_mutasi='' OR $tglmutasi) 
                                                AND (no_pindah IS NULL OR no_pindah='' OR $tglpindah) 
                                                AND (no_hapus IS NULL OR no_hapus='' OR $tglhapus)  
                                                AND kd_riwayat IN ('1','3','4')");
                        foreach($sql1->result() as $r1){
                            $jum_awal1  =$r1->jum_awal;
                            $nilai1     =number_format($r1->nilai,2,',','.');
                        }
                        if(strlen($ckode)==2){
                            $tot=$tot+$jum_awal1;
                            $totn=$totn+$r1->nilai;
                        }
                    
                    }
                else if($kode==02){
                    
                     $sql2 = $this->db->query("SELECT IFNULL(SUM(jumlah),0) AS jum_awal,IFNULL(SUM(nilai),0) AS nilai FROM trkib_b WHERE $where1 $where AND $tglriwayat 
                                                AND (no_mutasi IS NULL OR no_mutasi='' OR $tglmutasi) 
                                                AND (no_pindah IS NULL OR no_pindah='' OR $tglpindah) 
                                                AND (no_hapus IS NULL OR no_hapus='' OR $tglhapus)  
                                                AND kd_riwayat IN ('1','3','4')
                                                UNION
                                                SELECT IFNULL(SUM(jumlah),0) AS jum_awal,IFNULL(SUM(nilai),0) AS nilai FROM trkib_b WHERE $where1 $where AND $tglreg
                                                AND (no_mutasi IS NULL OR no_mutasi='' OR $tglmutasi) 
                                                AND (no_pindah IS NULL OR no_pindah='' OR $tglpindah) 
                                                AND (no_hapus IS NULL OR no_hapus='' OR $tglhapus)  
                                                AND kondisi='RB'");       
                        foreach($sql2->result() as $r2){
                            $jum_awal2  =$r2->jum_awal;
                            $nilai2     =number_format($r2->nilai,2,',','.');
                        }
                        if(strlen($ckode)==2){
                            $tot=$tot+$jum_awal2;
                            $totn=$totn+$r2->nilai;
                        }
                    
                    }
                else if($kode==03){
                     $sql3 = $this->db->query("SELECT IFNULL(SUM(jumlah),0) AS jum_awal,IFNULL(SUM(nilai),0) AS nilai FROM trkib_c WHERE $where1 $where AND $tglriwayat 
                                                AND (no_mutasi IS NULL OR no_mutasi='' OR $tglmutasi) 
                                                AND (no_pindah IS NULL OR no_pindah='' OR $tglpindah) 
                                                AND (no_hapus IS NULL OR no_hapus='' OR $tglhapus)  
                                                AND kd_riwayat IN ('1','3','4')
                                                UNION
                                                SELECT IFNULL(SUM(jumlah),0) AS jum_awal,IFNULL(SUM(nilai),0) AS nilai FROM trkib_c WHERE $where1 $where AND $tglreg 
                                                AND (no_mutasi IS NULL OR no_mutasi='' OR $tglmutasi) 
                                                AND (no_pindah IS NULL OR no_pindah='' OR $tglpindah) 
                                                AND (no_hapus IS NULL OR no_hapus='' OR $tglhapus)  
                                                AND kondisi='RB'");       
                       foreach($sql3->result() as $r3){
                            $jum_awal3  =$r3->jum_awal;
                            $nilai3     =number_format($r3->nilai,2,',','.');
                        }
                      if(strlen($ckode)==2){
                            $tot=$tot+$jum_awal3;
                            $totn=$totn+$r3->nilai;
                        }
                    }
                else if($kode==04){
                     $sql4 = $this->db->query("SELECT IFNULL(SUM(jumlah),0) AS jum_awal,IFNULL(SUM(nilai),0) AS nilai FROM trkib_d WHERE $where1 $where AND $tglriwayat 
                                                AND (no_mutasi IS NULL OR no_mutasi='' OR $tglmutasi) 
                                                AND (no_pindah IS NULL OR no_pindah='' OR $tglpindah) 
                                                AND (no_hapus IS NULL OR no_hapus='' OR $tglhapus)  
                                                AND kd_riwayat IN ('1','3','4')
                                                UNION
                                                SELECT IFNULL(SUM(jumlah),0) AS jum_awal,IFNULL(SUM(nilai),0) AS nilai FROM trkib_d WHERE $where1 $where AND $tglreg 
                                                AND (no_mutasi IS NULL OR no_mutasi='' OR $tglmutasi) 
                                                AND (no_pindah IS NULL OR no_pindah='' OR $tglpindah) 
                                                AND (no_hapus IS NULL OR no_hapus='' OR $tglhapus)  
                                                AND kondisi='RB'");       
                       foreach($sql4->result() as $r4){
                            $jum_awal4  =$r4->jum_awal;
                            $nilai4     =number_format($r4->nilai,2,',','.');
                        }
                         if(strlen($ckode)==2){
                            $tot=$tot+$jum_awal4;
                            $totn=$totn+$r4->nilai;
                        } 
                    }
                else if($kode==05){
                     $sql5 = $this->db->query("SELECT IFNULL(SUM(jumlah),0) AS jum_awal,IFNULL(SUM(nilai),0) AS nilai FROM trkib_e WHERE $where1 $where AND $tglriwayat 
                                                AND (no_mutasi IS NULL OR no_mutasi='' OR $tglmutasi) 
                                                AND (no_pindah IS NULL OR no_pindah='' OR $tglpindah) 
                                                AND (no_hapus IS NULL OR no_hapus='' OR $tglhapus)  
                                                AND kd_riwayat IN ('1','3','4')
                                                UNION
                                                SELECT IFNULL(SUM(jumlah),0) AS jum_awal,IFNULL(SUM(nilai),0) AS nilai FROM trkib_e WHERE $where1 $where AND $tglreg 
                                                AND (no_mutasi IS NULL OR no_mutasi='' OR $tglmutasi) 
                                                AND (no_pindah IS NULL OR no_pindah='' OR $tglpindah) 
                                                AND (no_hapus IS NULL OR no_hapus='' OR $tglhapus)  
                                                AND kondisi='RB'");       
                       foreach($sql5->result() as $r5){
                            $jum_awal5  =$r5->jum_awal;
                            $nilai5     =number_format($r5->nilai,2,',','.');
                        } 
                       if(strlen($ckode)==2){
                            $tot=$tot+$jum_awal5;
                            $totn=$totn+$r5->nilai;
                        }
                    }
                else if($kode==06){
                     $sql6 = $this->db->query("SELECT IFNULL(SUM(jumlah),0) AS jum_awal,IFNULL(SUM(nilai),0) AS nilai FROM trkib_a WHERE $where1 AND LEFT(kd_brg,5)='$ckode' AND $tglriwayat 
                                                AND (no_mutasi IS NULL OR no_mutasi='' OR $tglmutasi) 
                                                AND (no_pindah IS NULL OR no_pindah='' OR $tglpindah) 
                                                AND (no_hapus IS NULL OR no_hapus='' OR $tglhapus)  
                                                AND kd_riwayat IN ('1','3','4')");       
                       foreach($sql6->result() as $r6){
                            $jum_awal6  =$r6->jum_awal;
                            $nilai6     =number_format($r6->nilai,2,',','.');
                        } 
                        if(strlen($ckode)==2){
                            $tot=$tot+$jum_awal6;
                            $totn=$totn+$r6->nilai;
                        }
                    }
                else if($kode==07){
                     $sql7 = $this->db->query("SELECT IFNULL(SUM(jumlah),0) AS jum_awal,IFNULL(SUM(nilai),0) AS nilai FROM trkib_g WHERE $where1 $where AND $tglriwayat 
                                                AND (no_mutasi IS NULL OR no_mutasi='' OR $tglmutasi) 
                                                AND (no_pindah IS NULL OR no_pindah='' OR $tglpindah) 
                                                AND (no_hapus IS NULL OR no_hapus='' OR $tglhapus)  
                                                AND kd_riwayat IN ('1','3','4')");       
                       foreach($sql7->result() as $r7){
                            $jum_awal7  =$r7->jum_awal;
                            $nilai7     =number_format($r7->nilai,2,',','.');
                        }
                         if(strlen($ckode)==2){
                            $tot=$tot+$jum_awal7;
                            $totn=$totn+$r7->nilai;
                        } 
                    }    

                switch ($seq) {
                    case 5:
                        $cRet .="<tr>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$no</b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$gol</b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$ckode</b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"left\" style=\"font-size:11px\"><b>$cnama</b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$jum_awal1</b></td>     
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\"><b>$nilai1</b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\">&nbsp; </td>
                                </tr>";
                        break;
                        case (($seq==10)||($seq==65)||($seq==85)||($seq==115)||($seq==140)||($seq==150)):
                        $cRet .="<tr>
                                    <td style=\"font-size:10px\"></td>
                                    <td style=\"font-size:10px\"></td>
                                    <td style=\"font-size:10px\"></td>
                                    <td style=\"font-size:10px\"></td>
                                    <td style=\"font-size:10px\">&nbsp;</td>     
                                    <td style=\"font-size:10px\"></td>
                                    <td style=\"font-size:10px\"></td>
                                </tr>";
                        break;
                        case 15:
                        $cRet .="<tr>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$no <b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$gol <b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$ckode <b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"left\" style=\"font-size:11px\"><b>$cnama <b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$jum_awal2 <b></td>     
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\"><b>$nilai2<b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\">&nbsp; </td>
                                </tr>";
                        break;
                        case 70:
                        $cRet .="<tr>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$no </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$gol </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$ckode </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"left\" style=\"font-size:11px\"><b>$cnama </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$jum_awal3</b></td>     
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\"><b>$nilai3</b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\"><b>&nbsp; </td>
                                </tr>";
                        break;
                        case 90:
                        $cRet .="<tr>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b> $no</b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b> $gol</b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b> $ckode</b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"left\" style=\"font-size:11px\"><b> $cnama</b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b> $jum_awal4</b></td>     
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\"><b>$nilai4 </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\"><b> &nbsp; </b></td>
                                </tr>";
                        break;
                        case 120:
                        $cRet .="<tr>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b> $no </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b> $gol </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b> $ckode </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"left\" style=\"font-size:11px\"><b> $cnama </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b> $jum_awal5 </b></td>     
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\"><b> $nilai5 </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\">&nbsp; </td>
                                </tr>";
                        break;
                        case 145:
                        $cRet .="<tr>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$no </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$gol </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$ckode </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"left\" style=\"font-size:11px\"><b>$cnama </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$jum_awal6 </b></td>     
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\"><b>$nilai6 </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\">&nbsp; </td>
                                </tr>";
                        break;
                        case 155:
                        $cRet .="<tr>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$no </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$gol </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$ckode </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"left\" style=\"font-size:11px\"><b>$cnama </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"center\" style=\"font-size:11px\"><b>$jum_awal7 </b></td>     
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\"><b>$nilai7 </b></td>
                                    <td bgcolor=\"#eeebeb\" align=\"right\" style=\"font-size:11px\">&nbsp; </td>
                                </tr>";
                        break;
                    
                    default:
                        if($seq>=20 && $seq<=60)
                        $cRet .="<tr>
                                <td align=\"center\" style=\"font-size:10px\">$no</td>
                                <td align=\"center\" style=\"font-size:10px\">$gol</td>
                                <td align=\"center\" style=\"font-size:10px\">$ckode</td>
                                <td align=\"left\" style=\"font-size:10px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cnama</td>
                                <td align=\"center\" style=\"font-size:10px\">$jum_awal2</td>     
                                <td align=\"right\" style=\"font-size:10px\">$nilai2</td>
                                <td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
                            </tr>";
                        if($seq==75 || $seq==80)
                            $cRet .="<tr>
                                <td align=\"center\" style=\"font-size:10px\">$no</td>
                                <td align=\"center\" style=\"font-size:10px\">$gol</td>
                                <td align=\"center\" style=\"font-size:10px\">$ckode</td>
                                <td align=\"left\" style=\"font-size:10px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cnama</td>
                                <td align=\"center\" style=\"font-size:10px\">$jum_awal3</td>     
                                <td align=\"right\" style=\"font-size:10px\">$nilai3</td>
                                <td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
                            </tr>";
                            if($seq>=95 && $seq<=110)
                            $cRet .="<tr>
                                <td align=\"center\" style=\"font-size:10px\">$no</td>
                                <td align=\"center\" style=\"font-size:10px\">$gol</td>
                                <td align=\"center\" style=\"font-size:10px\">$ckode</td>
                                <td align=\"left\" style=\"font-size:10px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cnama</td>
                                <td align=\"center\" style=\"font-size:10px\">$jum_awal4</td>     
                                <td align=\"right\" style=\"font-size:10px\">$nilai4</td>
                                <td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
                            </tr>";
                            if($seq>=125 && $seq<=135)
                            $cRet .="<tr>
                                <td align=\"center\" style=\"font-size:10px\">$no</td>
                                <td align=\"center\" style=\"font-size:10px\">$gol</td>
                                <td align=\"center\" style=\"font-size:10px\">$ckode</td>
                                <td align=\"left\" style=\"font-size:10px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cnama</td>
                                <td align=\"center\" style=\"font-size:10px\">$jum_awal5</td>     
                                <td align=\"right\" style=\"font-size:10px\"> $nilai5</td>
                                <td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
                            </tr>";
                            if($seq==160)
                            $cRet .="<tr>
                                <td align=\"center\" style=\"font-size:10px\">$no</td>
                                <td align=\"center\" style=\"font-size:10px\">$gol</td>
                                <td align=\"center\" style=\"font-size:10px\">$ckode</td>
                                <td align=\"left\" style=\"font-size:10px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cnama</td>
                                <td align=\"center\" style=\"font-size:10px\">$jum_awal7</td>     
                                <td align=\"right\" style=\"font-size:10px\"> $nilai7</td>
                                <td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
                            </tr>";
                            if($seq==165)
                                $cRet .="<tr>
                                    <td bgcolor=\"#CCCCCC\" colspan=\"4\" align=\"center\" style=\"font-size:10px\"><b>JUMLAH</b></td>
                                    
                                    <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$tot</b></td>     
                                    <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>".number_format($totn,2,',','.')."</b></td>
                                    <td bgcolor=\"#CCCCCC\" style=\"font-size:10px\"></td>
                                </tr>";
                        break;
                }
               
                }
             //  }     
            
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
        
        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nmskpd);
        $skpdx = ucfirst(strtolower($test));
        $judul  ="Rekap Aset Lainnya - $skpdx.pdf";
        $this->template->set('title', 'REKAP ASET LAINNYA');  
        switch($pilih) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1',$judul);
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

	function rekap_aset_lainnya(){
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
		$cskpd 		= $_REQUEST['kd_skpd'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
		$cuskpd 	= $_REQUEST['kd_bid'];
        $cnm_uskpd 	= $_REQUEST['nm_bid'];
		$lctahu 	= $_REQUEST['lctahu'];
		$lcbend 	= $_REQUEST['lcbend'];
		$cnmbend 	= $_REQUEST['cnmbend'];
		$cnmtahu 	= $_REQUEST['cnmtahu'];
		//$lctgl	 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$lctgl	 	= $_REQUEST['lctgl2'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
        $oto  		= $this->session->userdata('otori');
		$skpd		= "";
		$unit		= "";
		if($oto=='01'){
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}elseif($cskpd=='' && $cuskpd==''){
				$skpd="";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
			
		}else{
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
        }
       
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
                <td width=\"10%\"align=\"left\" style=\"font-size:12px;\"></td>
				<th width =\"80%\" align=\"center\" style=\"font-size:12px;\">REKAPITULASI ASET LAINNYA<br>MILIK PEMERINTAH KOTA $kota<br>PER TANGGAL ".$this->tanggal_indonesia($lctgl)."<br><b>TAHUN $thn</b></th>
				<td width=\"10%\"align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";
			if($cskpd<>''){
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;\">: $cnm_skpd</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";}
			if($cuskpd<>''){
				$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\">&ensp;UNIT</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;\">: $cnm_uskpd</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";}
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
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
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">1</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">2</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">3</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">4</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">5</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">6</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">7</td>
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
		$csql = "SELECT '' as jumlah FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $jml1 = $row->jumlah;
			 
			 }
			
			$csql = "SELECT '' as nilai FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $hrg1 = $row->nilai;
			 }
		}
			
		if ($ckode=='02'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		and kondisi='RB' and nilai>='300000'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $jml2 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		and kondisi='RB' and nilai>='300000'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $hrg2 = $row->nilai;
			 }
		}
			
		if ($ckode=='03'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		and kondisi='RB' and nilai>='20000000'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $jml3 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit 
			AND tgl_reg<='$sampai_tgl' 
			and kondisi='RB' and nilai>='20000000'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $hrg3 = $row->nilai;
			 }
			
		}
			
		if ($ckode=='04'){
		$csql = "SELECT '' as jumlah FROM trkib_d WHERE left(kd_brg,2)='$ckode' 
		$skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9') GROUP BY kd_skpd";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $jml4 = $row->jumlah;
			 }
			
			$csql = "SELECT '' as nilai FROM trkib_d WHERE left(kd_brg,2)='$ckode' 
		$skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9') GROUP BY kd_skpd";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $hrg4 = $row->nilai;
			 }
		}
			
		if ($ckode=='05'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		and kondisi='RB' and nilai>='100000'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $jml5 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		and kondisi='RB' and nilai>='100000'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $hrg5 = $row->nilai;
			 }
		}
			
		if ($ckode=='06'){
		$csql = "SELECT '' as jumlah FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah  = $row->jumlah;
             $jml6 = $row->jumlah;
			 }
			
			$csql = "SELECT '' as nilai FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $hrg6 = $row->nilai;
			 }
			
			$jml 	=  $jml1+$jml2+$jml3+0+$jml5+0;
			$hrgx 	=  $hrg1+$hrg2+$hrg3+0+$hrg5+0;
		}
			
	$cRet .="<tr>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"left\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
        	</tr>";				
			if($iz=='1'){
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"><b>$no</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$gol</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$kode</b></td>
                        <td bgcolor=\"#80FE80\" align=\"left\" style=\"font-size:10px\"><b>$cnama</b></td>
                        <td bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#80FE80\" align=\"right\" style=\"font-size:10px\"><b>".number_format($charga)."</b></td>
                        <td align=\"right\" style=\"font-size:10px\"></td>
        		</tr>";}		
			elseif($iz<>'1'){
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"><b>$no</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$gol</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$kode</b></td>
                        <td bgcolor=\"#80FE80\" align=\"left\" style=\"font-size:10px\"><b>$cnama</b></td>
                        <td bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#80FE80\" align=\"right\" style=\"font-size:10px\"><b>$charga</b></td>
                        <td align=\"right\" style=\"font-size:10px\"></td>
        		</tr>";}
					
					if ($ckode=='06'){
					
							$cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"left\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"right\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
        		</tr>
        			";
					
					}
					
        		$i++; 
				
				
		$csql="SELECT left(kd_brg,2)as xkode,gol,kode,kd_brg,nama FROM mrekap WHERE LENGTH(kd_brg)='5' AND LEFT(kd_brg,2)='$ckode'";
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
			$csql = "SELECT '' as jumlah FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah2 = $row->jumlah;
			}
			$csql = "SELECt '' as nilai FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}					
		}
			
		if ($ckodex=='02'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		and kondisi='RB' and nilai>='300000'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		and kondisi='RB' and nilai>='300000'";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		and kondisi='RB' and nilai>='20000000'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		and kondisi='RB' and nilai>='20000000'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT '' as jumlah FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt '' as nilai FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
			if ($ckodex=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		and kondisi='RB' and nilai>='100000'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit 
		AND tgl_reg<='$sampai_tgl' 
		and kondisi='RB' and nilai>='100000'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT '' as jumlah FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt '' as nilai FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			if($iz=='1'){
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\">$kode2</td>
                        <td align=\"left\" 	 style=\"font-size:10px\">$cnama2</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah2</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($charga2)."</td>
                        <td align=\"right\"  style=\"font-size:10px\"></td>
					</tr>
        			";}
			elseif($iz<>'1'){
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\">$kode2</td>
                        <td align=\"left\" 	 style=\"font-size:10px\">$cnama2</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah2</td>
                        <td align=\"right\"  style=\"font-size:10px\">$charga2</td>
                        <td align=\"right\"  style=\"font-size:10px\"></td>
					</tr>
        			";}
        		$i++; 
				 }
		}
			if($iz=='1'){
			$cRet .="<tr>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jml</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. ".number_format($hrgx)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
			</tr>";
		   }elseif($iz<>'1'){
			$cRet .="<tr>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jml</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. $hrgx</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
			</tr>";
		   }
		   
		   
            $cRet .="</table>";
           
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
		
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\"></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Mengetahui,<br>Kepala SKPD<br><br><br><br></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;\">Pengurus Barang<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">(<u>$lctahu</u>)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">(<u>$lcbend</u>)</td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Nip. $cnmtahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Nip. $cnmbend</td>					
					</tr>";
		$cRet .= " </table>";
		
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'REKAP BUKU INVENTARIS BARANG';
        $this->template->set('title', 'REKAP BUKU INVENTARIS BARANG');  
        switch($iz) {
        case 1;
             //$this->_mpdf('',$cRet,5,5,5,'1');
            $this->_mpdfaiz('',$cRet,'10','10',12,'1');
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
	
	
	public function lap_mutasi_barang_lainnya()
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
        $nmtahu 	= $_REQUEST['nmtahu'];
        $nmbend 	= $_REQUEST['nmbend'];
        $lctgl 		= $_REQUEST['tgl'];
        $tgl_awal 	= $_REQUEST['tgl_awal'];
        $tgl_akhir	= $_REQUEST['tgl_akhir'];
        $tahun 		= $_REQUEST['tahun'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
        
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
        
   /*      if($lcbend==''){
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
                <td width=\"15%\"align=\"left\" style=\"font-size:14px;\"></td>
				<th width =\"60%\" align=\"center\" style=\"font-size:14px;\">LAPORAN MUTASI BARANG LAINNYA<br>KOTA $kota<br>TAHUN ANGGARAN $thn</th>
				<td width=\"15%\"align=\"left\" style=\"font-size:14px;\"></td>
            </tr>
			<BR/>
			
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;\">&ensp;SKPD</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;\">: $cnm_skpd</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;\">Kode Lokasi : $cskpd</td>
            </tr>
			
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;\">&ensp;KOTA</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;\">: $kota</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;\"></td>
            </tr>	
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;\">&ensp;PROVINSI</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;\">: $prov</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;\"></td>
            </tr>			
            </table>
			<BR/>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td colspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px\">NOMOR</td>
                <td colspan='4' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px\">Asal / Cara<br>Perolehan<br>Barang</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px\">Tahun<br>Beli/<br>Perolehan</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Ukuran<br>Barang/<br>Konstruksi<br>(P,SP,D)</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Satuan</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Kondisi<br>(B, RR, RB)</td>
				<td colspan='2' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Jumlah<br>(Awal)</td>
				<td colspan='4' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Mutasi / Perubahan</td>
				<td colspan='2' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Jumlah<br>(Akhir)</td>
				<td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Ket</td>

			</tr>
			

			<tr>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">No.Urut</td>
                <td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Kode Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Register</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Nama/<br>Jenis<br>Barang</td>
                <td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Merk<br>Type</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">No Sertifikat<br>No Pabrik<br>No.Chasis/<br>Mesin</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Bahan</td>				
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Harga</td>	
				<td colspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Berkurang</td>
				<td colspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Bertambah</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Harga</td>									
			</tr>
			
			<tr>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px\">Jumlah Barang</td>
                <td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px\">Jumlah Harga</td>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px\">Jumlah Barang</td>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px\">Jumlah Harga</td>
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
            
            
             $csql = "SELECT * FROM(
						SELECT a.nilai,a.no_urut,a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						a.nm_brg,a.merek,CONCAT(a.no_mesin,'/',a.no_polisi) AS spek,
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
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and a.nilai>=300000 and a.kondisi='RB'
						GROUP BY a.no_urut,a.nilai,a.kd_unit,a.no_polisi,kd_brg,merek,nm_brg,spek,bahan,tahun,ukuran,satuan 

						UNION

						SELECT a.nilai,a.no_urut,a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						a.nm_brg,'-' AS merek,'-' AS spek,
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
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and a.nilai>=20000000 and a.kondisi='RB'
						GROUP BY a.no_urut,a.nilai

						UNION

						SELECT a.nilai,a.no_urut,a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						a.nm_brg,a.judul AS merek,spesifikasi AS spek,
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
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and a.nilai>=100000 and a.kondisi='RB'
						GROUP BY a.no_urut,a.nilai
						) faiz ORDER BY kd_brg,tahun;


						";//group by nilai,no_urut,kd_brg,merek,nm_brg,spek,bahan,tahun,ukuran,satuan 
                    
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
                                <td align=\"center\" style=\"font-size:10px\">$i</td>
                                <td align=\"center\" style=\"font-size:10px\">$kd_brg</td>
                                <td align=\"center\" style=\"font-size:10px\">$no_reg</td>
                                <td align=\"left\"   style=\"font-size:10px\">$nm_brg</td>
                                <td align=\"center\" style=\"font-size:10px\">$merek</td>
                                <td align=\"center\" style=\"font-size:10px\">$spek</td>
                                <td align=\"center\" style=\"font-size:10px\">$bahan</td>
                                <td align=\"center\" style=\"font-size:10px\">$asal</td>
                				<td align=\"center\" style=\"font-size:10px\">$tahun</td>
                				<td align=\"center\" style=\"font-size:10px\">$ukuran</td>
                                <td align=\"center\" style=\"font-size:10px\">$satuan</td>
                                <td align=\"center\" style=\"font-size:10px\">$kondisi</td>
                				<td align=\"center\" style=\"font-size:10px\">$jml_awal</td>
                                <td align=\"right\" style=\"font-size:10px\">".number_format($awal)."</td>
                                <td align=\"center\" style=\"font-size:10px\">$jml_kurang</td>
                				<td align=\"right\" style=\"font-size:10px\">".number_format($kurang)."</td>
                                <td align=\"center\" style=\"font-size:10px\">$jml_tambah</td>
                                <td align=\"right\" style=\"font-size:10px\">".number_format($tambah)."</td>
                				<td align=\"center\" style=\"font-size:10px\">$jml_akhir</td>
                                <td align=\"right\" style=\"font-size:10px\">".number_format($akhir)."</td>
                                <td align=\"left\" style=\"font-size:10px\">$keterangan</td>                
                		     </tr>";
                   
                 $i++;
                              
                   }
                    
                          $cRet .="
                            <tr>
                                <td bgcolor=\"#80FE80\" colspan=\"12\" align=\"center\" style=\"font-size:10px\"><b>JUMLAH TOTAL</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px\"><b>$jmla_awal</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px\"><b>".number_format($tot_awal)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px\"><b>$jmla_kurang</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px\"><b>".number_format($tot_kurang)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px\"><b>$jmla_tambah</td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px\"><b>".number_format($tot_tambah)."</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px\"><b>$jmla_akhir</td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px\"><b>".number_format($tot_akhir)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"left\" style=\"font-size:10px\"></td>                
                		     </tr>";
    		$cRet .="</table><br/><br/>";
    		if($lctahu<>''){
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Mengetahui,</td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Kepala SKPD<br><br><br><br></td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Pengurus Barang<br><br><br><br></td>
					</tr>					
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">(<u>$nmtahu</u>)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">(<u>$nmbend</u>)</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Nip.$lctahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Nip.$lcbend</td>
					</tr>";
				$cRet .=" </table>";}
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'LAPORAN MUTASI BARANG (KOMPILASI)';
        $this->template->set('title', 'LAPORAN MUTASI BARANG (KOMPILASI)');  
        switch($iz) {
        case 1;
            $this->_mpdf('',$cRet,5,5,5,'1');
            //$this->_mpdfaiz('',$cRet,'10','10',12,'1');
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

	function rekap_lmb_komp_lainnya(){
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
		$cskpd 		= $_REQUEST['kd_skpd'];
		$cnm_skpd 	= $_REQUEST['nm_skpd'];
		$cuskpd 	= $_REQUEST['kd_bid'];
		$cnm_uskpd 	= $_REQUEST['nm_bid'];
		$tahu 		= $_REQUEST['lctahu'];
		$bend 		= $_REQUEST['lcbend'];
		$nm_bend 	= $_REQUEST['cnmbend'];
		$nm_tahu 	= $_REQUEST['cnmtahu'];
		$tgl_awal 	= $_REQUEST['tgl_awal'];
		$tgl_akhir 	= $_REQUEST['tgl_akhir'];
		$tahun		= substr($tgl_akhir,0,3);
		$lctgl	 	= $_REQUEST['lctgl2'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
        $oto  		= $this->session->userdata('otori');
		$skpd		= "";
		$unit		= "";
		if($oto=='01'){
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}elseif($cskpd=='' && $cuskpd==''){
				$skpd="";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
			
		}else{
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
        }
		
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
                <td width=\"10%\"align=\"left\" style=\"font-size:12px;\"></td>
				<th width =\"80%\" align=\"center\" style=\"font-size:12px;\">REKAPITULASI LAPORAN MUTASI BARANG LAINNYA<br>MILIK PEMERINTAH KOTA $kota<br><b>TAHUN $tahun</b></th>
				<td width=\"10%\"align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";
			if($cskpd){
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;\">: $cnm_skpd</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";}
			if($cuskpd){
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\">&ensp;UNIT</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;\">: $cnm_uskpd</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";}
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table><br/>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px\">NO URUT</td>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px\">GOL</td>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px\">KODE<br>BIDANG<br>BARANG</td>
                <td rowspan=\"3\" width=\"30%\" align=\"center\" style=\"font-size:12px\">NAMA <br>BIDANG BARANG</td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">KEADAAN PER <br>".$this->tanggal_indonesia($tgl_awal)."</td>
				<td colspan=\"4\" width=\"10%\" align=\"center\" style=\"font-size:12px\">MUTASI PERUBAHAN SELAMA<br>".$this->tanggal_indonesia($tgl_awal)." S/D ".$this->tanggal_indonesia($tgl_akhir)."</td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">KEADAAN PER <br>".$this->tanggal_indonesia($tgl_akhir)."</td>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px\">KET</td>
			</tr>
			<tr>	
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH BARANG</td>
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH HARGA DALAM RIBUAN</td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">BERKURANG</td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">BERTAMBAH</td>
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH BARANG <br>(5-7+9)</td>
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH HARGA DALAM RIBUAN <br>(6-8+10)</td>
            </tr>
			<tr>	
				<td width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH BARANG</td>
				<td width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH HARGA DALAM RIBUAN</td>
				<td width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH BARANG</td>
				<td width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH HARGA DALAM RIBUAN</td>
			</tr>
			<tr>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">1</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">2</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">3</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">4</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">5</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">6</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">7</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">8</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">9</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">10</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">11</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">12</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">13</td>
			</tr>
            </thead> ";
            
			$csql 	= "SELECT no,gol,kode,kd_brg,nama FROM mrekap WHERE LENGTH(kd_brg)=2";
			$hasil 	= $this->db->query($csql);
			$i 		= 1;
			$cjumlah= 0;
			foreach ($hasil->result() as $row){
				$no		= $row->no;
				$gol	= $row->gol;
				$kode	= $row->kode;
				$ckode	= $row->kd_brg;
				$cnama	= $row->nama;
						
			if ($ckode=='01'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit
					AND tgl_reg<='$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml1 = $row->jumlah;
				 
				 }
				
				$csql = "SELECT count(nilai) as nilai FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND tgl_reg<='$tgl_awal' and nilai='1'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg1 = $row->nilai;
				 }
			}
			
			if ($ckode=='02'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=300000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml2 = $row->jumlah;
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=300000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg2 = $row->nilai;
				 }
			}
			
			if ($ckode=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=20000000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml3 = $row->jumlah;
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=20000000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg3 = $row->nilai;
				 }
				
			}
			
			if ($ckode=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit
					AND tgl_reg<='$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml4 = $row->jumlah;
				 }
				
				$csql = "SELECT count(nilai) as nilai FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit
					AND tgl_reg<='$tgl_awal' and nilai='1'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg4 = $row->nilai;
				 }
			}
			
			if ($ckode=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=100000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml5 = $row->jumlah;
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=100000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg5 = $row->nilai;
				 }
			}
			
			if ($ckode=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit
					AND tgl_reg<='$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml6 = $row->jumlah;
				 }
				
				$csql = "SELECT count(nilai) as nilai FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit
					AND tgl_reg<='$tgl_awal' and nilai='1'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg6 = $row->nilai;
				 }
				
				$jml 	= $jml1+$jml2+$jml3+$jml4+$jml5+$jml6;
				$hargax = $hrg1+$hrg2+$hrg3+$hrg4+$hrg5+$hrg6;
				
				$jmlz    = $jml1+$jml2+$jml3+$jml4+$jml5+$jml6;
				$hargaxz = $hrg1+$hrg2+$hrg3+$hrg4+$hrg5+$hrg6;
			}
				
		/*BERKURANG*/
		if ($ckode=='01'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah1x = $row->jumlah;
			 
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga1x = $row->nilai;
			 }
		}
			
		if ($ckode=='02'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=20000000 and kondisi='RB'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah2x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga2x = $row->nilai;
			 }
		}
			
		if ($ckode=='03'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=20000000 and kondisi='RB'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah3x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga3x = $row->nilai;
			 }
			
		}
			
		if ($ckode=='04'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah4x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga4x = $row->nilai;
			 }
		}
			
		if ($ckode=='05'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=100000 and kondisi='RB'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah5x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga5x = $row->nilai;
			 }
		}
			
		if ($ckode=='06'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah6x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga6x = $row->nilai;
			 }
			
			$jmlx = $cjumlah1x+$cjumlah2x+$cjumlah3x+$cjumlah4x+$cjumlah5x+$cjumlah6x;
			$hargaxx =  $charga1x+$charga2x+$charga3x+$charga4x+$charga5x+$charga6x;
			
			$jmlxz = $cjumlah1x+$cjumlah2x+$cjumlah3x+$cjumlah4x+$cjumlah5x+$cjumlah6x;
			$hargaxxz =  $charga1x+$charga2x+$charga3x+$charga4x+$charga5x+$charga6x;
		}
		/*END BERKURANG*/
		
		/*BERTAMBAH*/
		if ($ckode=='01'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah1xx = $row->jumlah;
			 
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_a WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga1xx = $row->nilai;
			 }
		}
			
		if ($ckode=='02'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=300000 and kondisi='RB' ";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah2xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga2xx = $row->nilai;
			 }
		}
			
		if ($ckode=='03'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=20000000 and kondisi='RB'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah3xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga3xx = $row->nilai;
			 }
			
		}
			
		if ($ckode=='04'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah4xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_d WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga4xx = $row->nilai;
			 }
		}
			
		if ($ckode=='05'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=100000 and kondisi='RB'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah5xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga5xx = $row->nilai;
			 }
		}
			
		if ($ckode=='06'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah6xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_f WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga6xx = $row->nilai;
			 }
			
			$jmlxx 		= $cjumlah1xx+$cjumlah2xx+$cjumlah3xx+$cjumlah4xx+$cjumlah5xx+$cjumlah6xx;
			$hargaxxx 	=  $charga1xx+$charga2xx+$charga3xx+$charga4xx+$charga5xx+$charga6xx;
			
			$jmlxxz 	 = $cjumlah1xx+$cjumlah2xx+$cjumlah3xx+$cjumlah4xx+$cjumlah5xx+$cjumlah6xx;
			$hargaxxxz 	=  $charga1xx+$charga2xx+$charga3xx+$charga4xx+$charga5xx+$charga6xx;
				
		}
		
		$jmlxxxz		= $cjumlah-$cjumlahx+$cjumlahxx;
		$hargaxxxxz		= $charga-$chargax+$chargaxx;
		/*END BERTAMBAH*/
		
	$cRet .="<tr>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"left\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"left\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
        	</tr>";				
			if($iz=='1'){
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"><b>$no</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$gol</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$kode</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:10px\"><b>$cnama</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>".number_format($charga)."</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlahx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>".number_format($chargax)."</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlahxx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>".number_format($chargaxx)."</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$jmlxxxz</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>".number_format($hargaxxxxz)."</b></td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
					</tr>";}		
			elseif($iz<>'1'){
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"><b>$no</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$gol</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$kode</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:10px\"><b>$cnama</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>$charga</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlahx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>$chargax</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlahxx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>$chargaxx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$jmlxxxz</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>$hargaxxxxz</b></td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
					</tr>";}
					
					if ($ckode=='06'){
					
							$cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"left\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"right\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
						<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
						<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
						<td align=\"left\" style=\"font-size:10px\">&nbsp;</td>
						<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp;</td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
        		</tr>
        			";
					
					}
					
        		$i++; 
				
				
		$csql="SELECT left(kd_brg,2)as xkode,gol,kode,kd_brg,nama FROM mrekap WHERE LENGTH(kd_brg)='5' AND LEFT(kd_brg,2)='$ckode'";
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
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah2 = $row->jumlah;
			}
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}					
		}
			
		if ($ckodex=='02'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			
			}
			
			if ($ckodex=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
			/*START BERKURANG*/
			$cjumlah3=0;
			$charga3=0;
			
		if ($ckodex=='01'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah3 = $row->jumlah;
			}
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $charga3 = $row->nilai;
			}					
		}
			
		if ($ckodex=='02'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga3 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			
			}
			
			if ($ckodex=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			}			
			
			/*START BETAMBAH*/
			$cjumlah4=0;
			$charga4=0;
			
		if ($ckodex=='01'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah4 = $row->jumlah;
			}
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_a WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $charga4 = $row->nilai;
			}					
		}
			
		if ($ckodex=='02'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga4 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga4 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_d WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga4 = $row->nilai;
			 }
			
			}
			
			if ($ckodex=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga4 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_f WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga4 = $row->nilai;
			 }
			}		
			
			 $cjumlah5= $cjumlah2-$cjumlah3+$cjumlah4;
			 $charga5 = $charga2-$charga3+$charga4;	
				if($iz=='1') {
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\">$kode2</td>
                        <td align=\"left\" 	 style=\"font-size:10px\">$cnama2</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah2</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($charga2)."</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah3</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($charga3)."</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah4</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($charga4)."</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah5</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($charga5)."</td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
					</tr>
        			";}	elseif($iz<>'1') {
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\">$kode2</td>
                        <td align=\"left\" 	 style=\"font-size:10px\">$cnama2</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah2</td>
                        <td align=\"right\"  style=\"font-size:10px\">$charga2</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah3</td>
                        <td align=\"right\"  style=\"font-size:10px\">$charga3</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah4</td>
                        <td align=\"right\"  style=\"font-size:10px\">$charga4</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah5</td>
                        <td align=\"right\"  style=\"font-size:10px\">$charga5</td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
					</tr>
        			";}
        		$i++; 
				 }
				 
}
				 $tot_jum = $jml-$jmlx+$jmlxx;
				 $tot_har = $hargax-$hargaxx+$hargaxxx;
			if($iz=='1') {
	$cRet .="<tr>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jml</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. ".number_format($hargax)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jmlx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. ".number_format($hargaxx)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jmlxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. ".number_format($hargaxxx)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$tot_jum</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. ".number_format($tot_har)."</b></td>
				<td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\">&nbsp; </td>
			</tr>";}
		elseif($iz<>'1') {
	$cRet .="<tr>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jml</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. $hargax</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jmlx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. $hargaxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jmlxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. $hargaxxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$tot_jum</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. $tot_har</b></td>
				<td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\">&nbsp; </td>
			</tr>";}
		   
            $cRet .="</table><br/>";
           
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\"></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Mengetahui,<br>Kepala SKPD<br><br><br><br></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;\">Pengurus Barang<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">(<u>$nm_tahu</u>)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">(<u>$nm_bend</u>)</td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Nip. $tahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Nip. $bend</td>					
					</tr>";
		$cRet .= " </table>";
	
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'REKAP LAPORAN MUTASI BARANG';
        $this->template->set('title', 'REKAP LAPORAN MUTASI BARANG');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,5,5,5,'1');
            //$this->_mpdfaiz('',$cRet,'10','10',12,'1');
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

	public function daf_mutasi_barang_lainnya()
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
			<tr>
                <td width=\"15%\"align=\"left\" style=\"font-size:14px;\"></td>
				<th width =\"60%\" align=\"center\" style=\"font-size:14px;\">DAFTAR MUTASI BARANG LAINNYA<br>KOTA $kota<br>TAHUN ANGGARAN $thn</th>
				<td width=\"15%\"align=\"left\" style=\"font-size:14px;\"></td>
            </tr>
			<BR/>
			
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;\">&ensp;SKPD</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;\">: $cnm_skpd</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;\">Kode Lokasi : $cskpd</td>
            </tr>
			
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;\">&ensp;KOTA</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;\">: $kota</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;\"></td>
            </tr>	
            <tr>
                <td width =\"15%\" align=\"left\" style=\"font-size:14px;\">&ensp;PROVINSI</td>
                <td width =\"60%\" align=\"left\" style=\"font-size:14px;\">: $prov</td>
				<td width =\"15%\" align=\"left\" style=\"font-size:14px;\"></td>
            </tr>			
            </table>
			<BR/>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td colspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px\">NOMOR</td>
                <td colspan='4' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px\">SPESIFIKASI BARANG</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px\">Asal / Cara<br>Perolehan<br>Barang</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"9%\" align=\"center\" style=\"font-size:12px\">Tahun<br>Beli/<br>Perolehan</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Ukuran<br>Barang/<br>Konstruksi<br>(P,SP,D)</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Satuan</td>
                <td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Kondisi<br>(B, RR, RB)</td>
				<td colspan='2' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Jumlah<br>(Awal)</td>
				<td colspan='4' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Mutasi / Perubahan</td>
				<td colspan='2' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Jumlah<br>(Akhir)</td>
				<td rowspan='3' bgcolor=\"#80FE80\" width=\"8%\" align=\"center\" style=\"font-size:12px\">Ket</td>

			</tr>
			

			<tr>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">No.Urut</td>
                <td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Kode Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Register</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Nama/<br>Jenis<br>Barang</td>
                <td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Merk<br>Type</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">No Sertifikat<br>No Pabrik<br>No.Chasis/<br>Mesin</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Bahan</td>				
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Harga</td>	
				<td colspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Berkurang</td>
				<td colspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Bertambah</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Barang</td>
				<td rowspan='2' bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px\">Harga</td>									
			</tr>
			
			<tr>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px\">Jumlah Barang</td>
                <td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px\">Jumlah Harga</td>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px\">Jumlah Barang</td>
				<td align=\"center\" bgcolor=\"#80FE80\" style=\"font-size:12px\">Jumlah Harga</td>
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
            
            
             $csql = "	SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						a.nm_brg,a.merek,CONCAT(a.no_mesin,'/',a.no_polisi) AS spek,
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
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and a.nilai>='300000' and a.kondisi='RB'
						GROUP BY a.no_urut,a.nilai,a.kd_unit,a.no_polisi

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						a.nm_brg,'-' AS merek,'-' AS spek,
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
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and a.nilai>='20000000' and a.kondisi='RB'
						GROUP BY a.no_urut,a.nilai

						UNION

						SELECT a.kd_brg,
						IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,
						a.nm_brg,a.judul AS merek,spesifikasi AS spek,
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
						WHERE a.kd_skpd='$cskpd' 
						AND (a.tgl_reg BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR a.kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and a.nilai>='100000' and a.kondisi='RB'
						GROUP BY a.no_urut,a.nilai

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
                                <td align=\"center\" style=\"font-size:10px\">$i</td>
                                <td align=\"center\" style=\"font-size:10px\">$kd_brg</td>
                                <td align=\"center\" style=\"font-size:10px\">$no_reg</td>
                                <td align=\"left\"   style=\"font-size:10px\">$nm_brg</td>
                                <td align=\"center\" style=\"font-size:10px\">$merek</td>
                                <td align=\"center\" style=\"font-size:10px\">$spek</td>
                                <td align=\"center\" style=\"font-size:10px\">$bahan</td>
                                <td align=\"center\" style=\"font-size:10px\">$asal</td>
                				<td align=\"center\" style=\"font-size:10px\">$tahun</td>
                				<td align=\"center\" style=\"font-size:10px\">$ukuran</td>
                                <td align=\"center\" style=\"font-size:10px\">$satuan</td>
                                <td align=\"center\" style=\"font-size:10px\">$kondisi</td>
                				<td align=\"center\" style=\"font-size:10px\">$jml_awal</td>
                                <td align=\"right\" style=\"font-size:10px\">".number_format($awal)."</td>
                                <td align=\"center\" style=\"font-size:10px\">$jml_kurang</td>
                				<td align=\"right\" style=\"font-size:10px\">".number_format($kurang)."</td>
                                <td align=\"center\" style=\"font-size:10px\">$jml_tambah</td>
                                <td align=\"right\" style=\"font-size:10px\">".number_format($tambah)."</td>
                				<td align=\"center\" style=\"font-size:10px\">$jml_akhir</td>
                                <td align=\"right\" style=\"font-size:10px\">".number_format($akhir)."</td>
                                <td align=\"left\" style=\"font-size:10px\">$keterangan</td>                
                		     </tr>";
                   
                 $i++;
                              
                   }
                    
                          $cRet .="
                            <tr>
                                <td bgcolor=\"#80FE80\" colspan=\"12\" align=\"center\" style=\"font-size:10px\"><b>JUMLAH TOTAL</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px\"><b>$jmla_awal</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px\"><b>".number_format($tot_awal)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px\"><b>$jmla_kurang</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px\"><b>".number_format($tot_kurang)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px\"><b>$jmla_tambah</td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px\"><b>".number_format($tot_tambah)."</b></td>
                				<td bgcolor=\"#80FE80\"  align=\"center\" style=\"font-size:10px\"><b>$jmla_akhir</td>
                                <td bgcolor=\"#80FE80\"  align=\"right\" style=\"font-size:10px\"><b>".number_format($tot_akhir)."</b></td>
                                <td bgcolor=\"#80FE80\"  align=\"left\" style=\"font-size:10px\"></td>                
                		     </tr>";
    		$cRet .="</table><br/><br/>";
    		
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Mengetahui,</td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Kepala SKPD<br><br><br><br></td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Pengurus Barang<br><br><br><br></td>
					</tr>					
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">(<u>$nm_tahu</u>)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">(<u>$nm_bend</u>)</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Nip.$lctahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Nip.$lcbend</td>
					</tr>";
				$cRet .=" </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'DAFTAR MUTASI BARANG (KOMPILASI)';
        $this->template->set('title', 'DAFTAR MUTASI BARANG (KOMPILASI)');  
        switch($iz) {
        case 1;
            $this->_mpdf('',$cRet,5,5,5,'1');
            //$this->_mpdfaiz('',$cRet,'10','10',12,'1');
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
	
	function rekap_dmb_komp_lainnya(){
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
		$cskpd 		= $_REQUEST['kd_skpd'];
		$cnm_skpd 	= $_REQUEST['nm_skpd'];
		$cuskpd 	= $_REQUEST['kd_bid'];
		$cnm_uskpd 	= $_REQUEST['nm_bid'];
		$tahu 		= $_REQUEST['lctahu'];
		$bend 		= $_REQUEST['lcbend'];
		$nm_bend 	= $_REQUEST['cnmbend'];
		$nm_tahu 	= $_REQUEST['cnmtahu'];
		$tgl_awal 	= $_REQUEST['tgl_awal'];
		$tgl_akhir 	= $_REQUEST['tgl_akhir'];
		$tahun		= substr($tgl_akhir,0,3);
		$lctgl	 	= $_REQUEST['lctgl2'];
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
        $oto  		= $this->session->userdata('otori');
		$skpd		= "";
		$unit		= "";
		if($oto=='01'){
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}elseif($cskpd=='' && $cuskpd==''){
				$skpd="";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
			
		}else{
			if($cskpd<>'' && $cuskpd==''){
				$skpd="and kd_skpd='$cskpd'";
			}elseif($cskpd<>'' && $cuskpd<>''){
				$unit="and kd_unit='$cuskpd'";
			}else{
				$skpd="and kd_skpd='$cskpd'";
			}
        }
		
        $cRet ="";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			
			<tr>
                <td width=\"10%\"align=\"left\" style=\"font-size:12px;\"></td>
				<th width =\"80%\" align=\"center\" style=\"font-size:12px;\">REKAPITULASI DAFTAR MUTASI BARANG LAINNYA<br>MILIK PEMERINTAH KOTA $kota<br><b>TAHUN $tahun</b></th>
				<td width=\"10%\"align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";
			if($cskpd){
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;\">: $cnm_skpd</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";}
			if($cuskpd){
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\">&ensp;UNIT</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;\">: $cnm_uskpd</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";}
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table><br/>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px\">NO URUT</td>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px\">GOL</td>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px\">KODE<br>BIDANG<br>BARANG</td>
                <td rowspan=\"3\" width=\"30%\" align=\"center\" style=\"font-size:12px\">NAMA <br>BIDANG BARANG</td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">KEADAAN PER <br>".$this->tanggal_indonesia($tgl_awal)."</td>
				<td colspan=\"4\" width=\"10%\" align=\"center\" style=\"font-size:12px\">MUTASI PERUBAHAN SELAMA<br>".$this->tanggal_indonesia($tgl_awal)." S/D ".$this->tanggal_indonesia($tgl_akhir)."</td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">KEADAAN PER <br>".$this->tanggal_indonesia($tgl_akhir)."</td>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px\">KET</td>
			</tr>
			<tr>	
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH BARANG</td>
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH HARGA DALAM RIBUAN</td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">BERKURANG</td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">BERTAMBAH</td>
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH BARANG <br>(5-7+9)</td>
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH HARGA DALAM RIBUAN <br>(6-8+10)</td>
            </tr>
			<tr>	
				<td width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH BARANG</td>
				<td width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH HARGA DALAM RIBUAN</td>
				<td width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH BARANG</td>
				<td width=\"10%\" align=\"center\" style=\"font-size:12px\">JUMLAH HARGA DALAM RIBUAN</td>
			</tr>
			<tr>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">1</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">2</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">3</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">4</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">5</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">6</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">7</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">8</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">9</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">10</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">11</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">12</td>
                <td bgcolor=\"#2424FC\" align=\"center\" style=\"font-size:10px\">13</td>
			</tr>
            </thead> ";
            
			$csql 	= "SELECT no,gol,kode,kd_brg,nama FROM mrekap WHERE LENGTH(kd_brg)=2";
			$hasil 	= $this->db->query($csql);
			$i 		= 1;
			$cjumlah= 0;
			foreach ($hasil->result() as $row){
				$no		= $row->no;
				$gol	= $row->gol;
				$kode	= $row->kode;
				$ckode	= $row->kd_brg;
				$cnama	= $row->nama;
						
			if ($ckode=='01'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit
					AND tgl_reg<='$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml1 = $row->jumlah;
				 
				 }
				
				$csql = "SELECT count(nilai) as nilai FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND tgl_reg<='$tgl_awal' and nilai='1'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg1 = $row->nilai;
				 }
			}
			
			if ($ckode=='02'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=300000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml2 = $row->jumlah;
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=300000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg2 = $row->nilai;
				 }
			}
			
			if ($ckode=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=20000000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml3 = $row->jumlah;
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=20000000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg3 = $row->nilai;
				 }
				
			}
			
			if ($ckode=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit
					AND tgl_reg<='$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml4 = $row->jumlah;
				 }
				
				$csql = "SELECT count(nilai) as nilai FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit
					AND tgl_reg<='$tgl_awal' and nilai='1'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg4 = $row->nilai;
				 }
			}
			
			if ($ckode=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=100000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml5 = $row->jumlah;
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit
					and nilai>=100000 and kondisi='RB' AND tgl_reg<='$tgl_awal'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg5 = $row->nilai;
				 }
			}
			
			if ($ckode=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit
					AND tgl_reg<='$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml6 = $row->jumlah;
				 }
				
				$csql = "SELECT count(nilai) as nilai FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit
					AND tgl_reg<='$tgl_awal' and nilai='1'";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg6 = $row->nilai;
				 }
				
				$jml 	= $jml1+$jml2+$jml3+$jml4+$jml5+$jml6;
				$hargax = $hrg1+$hrg2+$hrg3+$hrg4+$hrg5+$hrg6;
				
				$jmlz    = $jml1+$jml2+$jml3+$jml4+$jml5+$jml6;
				$hargaxz = $hrg1+$hrg2+$hrg3+$hrg4+$hrg5+$hrg6;
			}
				
		/*BERKURANG*/
		if ($ckode=='01'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah1x = $row->jumlah;
			 
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga1x = $row->nilai;
			 }
		}
			
		if ($ckode=='02'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=300000 and kondisi='RB'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah2x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga2x = $row->nilai;
			 }
		}
			
		if ($ckode=='03'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=20000000 and kondisi='RB'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah3x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga3x = $row->nilai;
			 }
			
		}
			
		if ($ckode=='04'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah4x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga4x = $row->nilai;
			 }
		}
			
		if ($ckode=='05'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=100000 and kondisi='RB'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah5x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga5x = $row->nilai;
			 }
		}
			
		if ($ckode=='06'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah6x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit
						AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
						OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga6x = $row->nilai;
			 }
			
			$jmlx = $cjumlah1x+$cjumlah2x+$cjumlah3x+$cjumlah4x+$cjumlah5x+$cjumlah6x;
			$hargaxx =  $charga1x+$charga2x+$charga3x+$charga4x+$charga5x+$charga6x;
			
			$jmlxz = $cjumlah1x+$cjumlah2x+$cjumlah3x+$cjumlah4x+$cjumlah5x+$cjumlah6x;
			$hargaxxz =  $charga1x+$charga2x+$charga3x+$charga4x+$charga5x+$charga6x;
		}
		/*END BERKURANG*/
		
		/*BERTAMBAH*/
		if ($ckode=='01'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah1xx = $row->jumlah;
			 
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_a WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga1xx = $row->nilai;
			 }
		}
			
		if ($ckode=='02'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=300000 and kondisi='RB'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah2xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga2xx = $row->nilai;
			 }
		}
			
		if ($ckode=='03'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=20000000 and kondisi='RB'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah3xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga3xx = $row->nilai;
			 }
			
		}
			
		if ($ckode=='04'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah4xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_d WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga4xx = $row->nilai;
			 }
		}
			
		if ($ckode=='05'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=100000 and kondisi='RB'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah5xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga5xx = $row->nilai;
			 }
		}
			
		if ($ckode=='06'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah6xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_f WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga6xx = $row->nilai;
			 }
			
			$jmlxx 		= $cjumlah1xx+$cjumlah2xx+$cjumlah3xx+$cjumlah4xx+$cjumlah5xx+$cjumlah6xx;
			$hargaxxx 	=  $charga1xx+$charga2xx+$charga3xx+$charga4xx+$charga5xx+$charga6xx;
			
			$jmlxxz 	 = $cjumlah1xx+$cjumlah2xx+$cjumlah3xx+$cjumlah4xx+$cjumlah5xx+$cjumlah6xx;
			$hargaxxxz 	=  $charga1xx+$charga2xx+$charga3xx+$charga4xx+$charga5xx+$charga6xx;
				
		}
		
		$jmlxxxz		= $cjumlah-$cjumlahx+$cjumlahxx;
		$hargaxxxxz		= $charga-$chargax+$chargaxx;
		/*END BERTAMBAH*/
		
	$cRet .="<tr>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"left\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"left\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px\">&nbsp;</td>
				<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
        	</tr>";				
			if($iz=='1'){
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"><b>$no</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$gol</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$kode</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:10px\"><b>$cnama</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>".number_format($charga)."</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlahx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>".number_format($chargax)."</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlahxx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>".number_format($chargaxx)."</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$jmlxxxz</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>".number_format($hargaxxxxz)."</b></td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
					</tr>";}		
			elseif($iz<>'1'){
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"><b>$no</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$gol</b></td>
                        <td align=\"center\" style=\"font-size:10px\"><b>$kode</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:10px\"><b>$cnama</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>$charga</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlahx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>$chargax</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$cjumlahxx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>$chargaxx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px\"><b>$jmlxxxz</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px\"><b>$hargaxxxxz</b></td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
					</tr>";}
					
					if ($ckode=='06'){
					
							$cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"left\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"right\" style=\"font-size:10px\">&nbsp;</td>
                        <td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
						<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
						<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
						<td align=\"left\" style=\"font-size:10px\">&nbsp;</td>
						<td align=\"center\" style=\"font-size:10px\">&nbsp;</td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp;</td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
        		</tr>
        			";
					
					}
					
        		$i++; 
				
				
		$csql="SELECT left(kd_brg,2)as xkode,gol,kode,kd_brg,nama FROM mrekap WHERE LENGTH(kd_brg)='5' AND LEFT(kd_brg,2)='$ckode'";
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
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah2 = $row->jumlah;
			}
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}					
		}
			
		if ($ckodex=='02'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			
			}
			
			if ($ckodex=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			and tgl_reg<'$tgl_awal' and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
			/*START BERKURANG*/
			$cjumlah3=0;
			$charga3=0;
			
		if ($ckodex=='01'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah3 = $row->jumlah;
			}
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $charga3 = $row->nilai;
			}					
		}
			
		if ($ckodex=='02'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga3 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			
			}
			
			if ($ckodex=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit
			AND (tgl_mutasi BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_pindah BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR tgl_hapus BETWEEN '$tgl_awal' AND '$tgl_akhir'
			OR kd_riwayat BETWEEN '$tgl_awal' AND '$tgl_akhir') and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			}			
			
			/*START BETAMBAH*/
			$cjumlah4=0;
			$charga4=0;
			
		if ($ckodex=='01'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah4 = $row->jumlah;
			}
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_a WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $charga4 = $row->nilai;
			}					
		}
			
		if ($ckodex=='02'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=300000 and kondisi='RB'";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga4 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=20000000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga4 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_d WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga4 = $row->nilai;
			 }
			
			}
			
			if ($ckodex=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai>=100000 and kondisi='RB'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga4 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_f WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit and nilai='1'";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga4 = $row->nilai;
			 }
			}		
			
			 $cjumlah5= $cjumlah2-$cjumlah3+$cjumlah4;
			 $charga5 = $charga2-$charga3+$charga4;	
				if($iz=='1') {
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\">$kode2</td>
                        <td align=\"left\" 	 style=\"font-size:10px\">$cnama2</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah2</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($charga2)."</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah3</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($charga3)."</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah4</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($charga4)."</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah5</td>
                        <td align=\"right\"  style=\"font-size:10px\">".number_format($charga5)."</td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
					</tr>
        			";}	elseif($iz<>'1') {
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\">$kode2</td>
                        <td align=\"left\" 	 style=\"font-size:10px\">$cnama2</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah2</td>
                        <td align=\"right\"  style=\"font-size:10px\">$charga2</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah3</td>
                        <td align=\"right\"  style=\"font-size:10px\">$charga3</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah4</td>
                        <td align=\"right\"  style=\"font-size:10px\">$charga4</td>
                        <td align=\"center\" style=\"font-size:10px\">$cjumlah5</td>
                        <td align=\"right\"  style=\"font-size:10px\">$charga5</td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
					</tr>
        			";}
        		$i++; 
				 }
				 
}
				 $tot_jum = $jml-$jmlx+$jmlxx;
				 $tot_har = $hargax-$hargaxx+$hargaxxx;
			if($iz=='1') {
	$cRet .="<tr>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jml</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. ".number_format($hargax)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jmlx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. ".number_format($hargaxx)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jmlxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. ".number_format($hargaxxx)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$tot_jum</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. ".number_format($tot_har)."</b></td>
				<td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\">&nbsp; </td>
			</tr>";}
		elseif($iz<>'1') {
	$cRet .="<tr>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jml</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. $hargax</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jmlx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. $hargaxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$jmlxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. $hargaxxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"><b>$tot_jum</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\"><b>Rp. $tot_har</b></td>
				<td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\">&nbsp; </td>
			</tr>";}
		   
            $cRet .="</table><br/>";
           
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\"></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Mengetahui,<br>Kepala SKPD<br><br><br><br></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;\">Pengurus Barang<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">(<u>$nm_tahu</u>)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">(<u>$nm_bend</u>)</td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Nip. $tahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\">Nip. $bend</td>					
					</tr>";
		$cRet .= " </table>";
	
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'REKAP DAFTAR MUTASI BARANG';
        $this->template->set('title', 'REKAP DAFTAR MUTASI BARANG');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,5,5,5,'1');
            //$this->_mpdfaiz('',$cRet,'10','10',12,'1');
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
	} }
/*********************************KOMPONEN PENDUKUNG*******************************/
    function _mpdf($judul='',$isi='',$lMargin=10,$rMargin=10,$font=10,$orientasi='',$judul2='') {
        
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
        //$this->mpdf->SetHeader('SIMBAKDA||');
        //$jam = date("H:i:s");
        //$this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |SIMBAKDA| Page {PAGENO} of {nb}');
        //$this->mpdf->SetFooter('Page {PAGENO} ');
        $this->mpdf->SetFooter('Printed Simbakda on @ {DATE j-m-Y H:i:s} || Page {PAGENO} of {nb}');
  
        $this->mpdf->AddPage($orientasi);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output($judul2,'I');
               
    }

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
	
	    
    function  tanggal_indonesia($tgl)
    {
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this-> getBulan($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2].' '.$bulan.' '.$tahun;
        
    }
    
     function  tanggal_indonesia1($tgl)
    {
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this-> getBulan($tanggal[1]);
        $tahun  =  $tanggal[2];
        return  $tanggal[0].' '.$bulan.' '.$tahun;
        
    }
    
    function  tanggal_indonesia2($tgl)
    {
        //$tgl = '13-8-2013';
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this-> getBulan($tanggal[1]);
        $tahun  = $this->terbilang($tanggal[2]);
        $lctgl = $this->terbilang($tanggal[0]);
        
        return  $lctgl.' '.$bulan.' '.$tahun;
        //echo  $lctgl.' '.$bulan.' '.$tahun;
        
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
                return  "Maret";
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
                         'kabupaten' =>$resulte['kabupaten']                                                                       					
                         );
        }
	   
       $query1->free_result(); 
	   return $resulte;        	
	}	
   function terbilang($number) {
    
    $hyphen      = ' ';
    $conjunction = ' ';
    $separator   = ' ';
    $negative    = 'minus ';
    $decimal     = ' koma ';
    $dictionary  = array(0 => 'nol',1 => 'Satu',2 => 'Dua',3 => 'Tiga',4 => 'Empat',5 => 'Lima',6 => 'Enam',7 => 'Tujuh',
        8 => 'Delapan',9 => 'Sembilan',10 => 'Sepuluh',11  => 'Sebelas',12 => 'Dua Belas',13 => 'Tiga Belas',14 => 'Empat Belas',
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
    

}
