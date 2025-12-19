<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 
 */

class mmr_skpd extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function  get_range($range){
        switch  ($range){
        case  1:
        return  "1 Bulan";
        break;
        case  2:
        return  "3 Bulan";
        break;
		case 3:
        return  "6 Bulan";
        break;

    }
    }
	
    function _mpdf($judul='',$isi='',$lMargin='',$rMargin='',$font=0,$orientasi='') {
        
        ini_set("memory_limit","512M");
        $this->load->library('mpdf');
        
        /*
        $this->mpdf->progbar_altHTML = '<html><body>
	                                    <div style="margin-top: 5em; text-align: center; font-family: Verdana; font-size: 12px;"><img style="vertical-align: middle" src="'.base_url().'images/loading.gif" /> Creating PDF file. Please wait...</div>';        
        $this->mpdf->StartProgressBarOutput();
        */
        
        $this->mpdf->defaultheaderfontsize = 6;	/* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 8;	/* in pts */
        $this->mpdf->defaultfooterfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 0; 
        $this->mpdf->SetLeftMargin = $lMargin;
        $this->mpdf->SetRightMargin = $rMargin;
        //$this->mpdf->SetHeader('SIMAKDA||');
        $jam = date("H:i:s");
        //$this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Simakda| Page {PAGENO} of {nb}');
        $this->mpdf->SetFooter('printed by SIMAKDA||Halaman {PAGENO}');
        
        $this->mpdf->AddPage($orientasi,'','','','',$lMargin,$rMargin);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output();
               
    }
    function left($string, $count){
    return substr($string, 0, $count);
    }
	
	 function cetak_mr($ctgl,$cskpd,$corder,$csort,$csppp){
		ini_set("memory_limit","512M");		
		$sqlsc="SELECT tgl_rka,provinsi,kab_kota,daerah,thn_ang FROM sclient";
		$sqlsclient=$this->db->query($sqlsc);
		$cRet='';
		foreach ($sqlsclient->result() as $rowsc){
			$kab     = $rowsc->kab_kota;
			$daerah  = $rowsc->daerah;
		}
		$sqlskpd="SELECT distinct kd_skpd,nm_skpd from ms_skpd where kd_skpd='$cskpd'";
		$sqlscskpd=$this->db->query($sqlskpd);
		$cRet='';
		foreach ($sqlscskpd->result() as $rowsss){
			$skpd     = $rowsss->kd_skpd;
			$nm_skpd  = $rowsss->nm_skpd;
		}
		
		if ($csppp==1){
			$spp="IN ('1','2')";
			$kspp='(UP/GU)';
		}else{
			$spp="='3'";
			$kspp='(TU)';
		}
        $cRet .="<table style=\"border-collapse:collapse;font-family:tahoma;font-size:12px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                    <tr>					
						<td align=\"center\" style=\"font-size:14px\"><strong>PEMERINTAH $kab</strong></td>
						
					</tr>
                    <tr>
						<td align=\"center\" style=\"font-size:14px;text-transform:uppercase\"><b>LAPORAN RINCIAN PERTANGGUNGJAWABAN SP2D BERDASARKAN SPJ </b></td>
						
					</tr>
					<tr>
						<td align=\"center\" style=\"font-size:14px;text-transform:uppercase\"><b>$kspp</b></td>
						
					</tr>                                                         
                    <tr>	
						
						<td align=\"center\" style=\"font-size:14px\">PERIODE 1 Januari s/d ".$this->tukd_model->tanggal_format_indonesia($ctgl)." </td>
						
					</tr>
                    <tr>
						<td align=\"center\" ></td>
						
					</tr>
					<tr>
						<td  colspan=\"3\" align=\"left\" height=\"1px\"  style=\"border-bottom:4px double black\"> SKPD : $skpd - $nm_skpd</td>
					</tr>
				</table>";

        $cRet .="<table style=\"border-collapse:collapse;font-family:tahoma;font-size:12px\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                    <thead>                       
                        <tr><td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"3%\" align=\"center\"><b>NO</b></td>                           
							<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>No. SP2D</b></td>
							<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"7%\" align=\"center\"><b>Tanggal SP2D Cair</b></td>
							<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"25%\" align=\"center\"><b>Keperluan</b></td>
							<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>Nilai SP2D</b></td>
							<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>Nilai SPJ</b></td>
							<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>Nilai Belum SPJ</b></td>
							<td colspan=\"3\" bgcolor=\"#CCCCCC\" width=\"30%\" align=\"center\"><b>Umur SP2D</b></td>
							
 
						</tr>
                        <tr>
							<td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b> > 180 Hari</b></td>
							<td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>90 Hari</b></td>
							<td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>30 Hari</b></td>
						</tr>
						<tr><td bgcolor=\"#CCCCCC\" width=\"3%\" align=\"center\"><b>1</b></td>                            
                            <td bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>2</b></td>
							<td bgcolor=\"#CCCCCC\" width=\"7%\" align=\"center\"><b>3</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"25%\" align=\"center\"><b>4</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>5</b></td> 
							<td bgcolor=\"#CCCCCC\" width=\"10\" align=\"center\"><b>6</b></td> 
                            <td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>7</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>8</b></td> 
                            <td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>9</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>10</b></td>  
							
						</tr>	
                    </thead>				
				
					<tfoot>
						<tr>
							 <td colspan=\"10\" style=\"border-bottom:none;border-left:none;border-right:none;\"></td>
						</tr>
					</tfoot>";
	 
//DN == SILAHKAN DI SESUAIKAN DENGAN KONDISI DAERAH MASING-MASING...			
 
	// $sql = "SELECT kd_skpd,no_sp2d,jns_spp,tgl_kas,keperluan,nilai_sp2d,nilai01,nilai02,nilai03,(IF(nilai01 IS NULL,(0),nilai01)+IF(nilai02 IS NULL,(0),nilai02)+IF(nilai03 IS NULL,(0),nilai03))as tot,selisih
 // FROM(  
 // SELECT kd_skpd,nm_skpd,no_sp2d,jns_spp,tgl_kas,tgl_sekarang,selisih,keperluan,nilai_sp2d, 
 // CASE WHEN selisih > 180 THEN IF(nilai_sp2d IS NULL,(0),nilai_sp2d)- IF(spj IS NULL,(0),spj) END AS nilai01, 
 // CASE WHEN selisih <= 180 AND selisih >=90  THEN IF(nilai_sp2d IS NULL,(0),nilai_sp2d)- IF(spj IS NULL,(0),spj) END AS nilai02, 
 // CASE WHEN selisih < 90 THEN IF(nilai_sp2d IS NULL,(0),nilai_sp2d)- IF(spj IS NULL,(0),spj) END AS nilai03 FROM( 
 // SELECT x.kd_skpd,x.nm_skpd,x.no_sp2d,x.jns_spp,x.tgl_kas,'$ctgl' 
 // AS tgl_sekarang,DATEDIFF('$ctgl',tgl_kas ) AS selisih, x.keperluan,nsp2d(x.kd_skpd,x.no_spp)AS nilai_sp2d, 
 // ( SELECT SUM(e.nilai)AS nilai FROM trhtransout d INNER JOIN trdtransout e ON d.no_bukti=e.no_bukti 
 // WHERE d.kd_skpd=x.kd_skpd AND d.no_sp2d=x.no_sp2d AND d.tgl_kas<='$ctgl' AND d.jns_spp <>'1')AS spj FROM trhsp2d X 
 // WHERE x.status='1' AND jns_spp <>'1' AND x.tgl_kas<='$ctgl' AND x.kd_skpd='$skpd' 
 // )z
// UNION
 // SELECT kd_skpd,nm_skpd,no_sp2d,jns_spp,tgl_kas,tgl_sekarang,selisih,keperluan,nilai_sp2d, 
 // CASE WHEN selisih > 180 THEN IF(spj IS NULL,(0),spj) END AS nilai01, 
 // CASE WHEN selisih <= 180 AND selisih >=90 THEN IF(spj IS NULL,(0),spj) END AS nilai02, 
 // CASE WHEN selisih < 90 THEN IF(spj IS NULL,(0),spj) END AS nilai03 FROM( 
 // SELECT kd_skpd,nm_skpd,jns_spp,no_sp2d,tgl_kas,tgl_sekarang,selisih,keperluan,nilai_sp2d,(sp2dupgu-spjx)spj 
 // FROM( SELECT x.kd_skpd,x.nm_skpd,x.no_sp2d,x.jns_spp,x.tgl_kas,'$ctgl' AS tgl_sekarang,DATEDIFF('$ctgl',tgl_kas) AS selisih, 
 // x.keperluan,nsp2d(x.kd_skpd,x.no_spp)AS nilai_sp2d, (SELECT SUM(a.nilai)nilai FROM trdspp a INNER JOIN trhsp2d b 
 // ON a.no_spp=b.no_spp AND a.kd_skpd=b.kd_skpd WHERE b.status='1' AND b.jns_spp IN(1,2) AND b.tgl_kas<='$ctgl' 
 // AND b.kd_skpd='$skpd' )AS sp2dupgu, ( SELECT SUM(e.nilai)AS nilai FROM trhtransout d INNER JOIN trdtransout 
 // e ON d.no_bukti=e.no_bukti WHERE d.kd_skpd='$skpd' AND d.jns_spp='1' AND d.tgl_kas<='$ctgl' )AS spjx 
 // FROM trhsp2d X WHERE x.status='1' AND jns_spp ='1' AND x.tgl_kas<='$ctgl' AND x.kd_skpd='$skpd' )Y )n 
 // )aa where jns_spp<>'2' and(nilai01<>0 or nilai02<>0 or nilai03<>0) ORDER BY $corder $csort"; 
	// $sql = "select * from(SELECT kd_skpd,nm_skpd,no_sp2d,jns_spp,tgl_kas,tgl_sekarang,selisih,keperluan,nilai_sp2d, 
 // CASE WHEN selisih > 180 THEN IFnull(nilai_sp2d,0)- IFnull(spj,0) END AS nilai01,  
 // CASE WHEN selisih <= 180 AND selisih >=90  THEN IFnull(nilai_sp2d,0)- IFnull(spj,0) END AS nilai02, 
 // CASE WHEN selisih < 90 THEN IFnull(nilai_sp2d,0)- IFnull(spj,0) END AS nilai03 
 // FROM(
// select b.kd_skpd,b.nm_skpd,b.no_sp2d,b.jns_spp,b.tgl_kas,
// '$ctgl'AS tgl_sekarang, DATEDIFF('$ctgl',b.tgl_kas )AS selisih,
// b.keperluan,ifnull(sum(a.nilai),0) as nilai_sp2d,
// (SELECT ifnull(SUM(d.nilai),0)AS nilai FROM trhtransout c INNER JOIN trdtransout d ON c.no_bukti=d.no_bukti 
// WHERE c.kd_skpd=b.kd_skpd AND d.no_sp2d=b.no_sp2d AND c.tgl_kas<='$ctgl') as spj
// from trdspp a join trhsp2d b on a.no_spp=b.no_spp 
// WHERE b.status='1' AND b.jns_spp not in('4','5','6') AND b.tgl_kas<='$ctgl' AND b.kd_skpd='$skpd'
// group by b.no_sp2d )z )j where jns_spp<>'2' and (nilai01<>0 or nilai02<>0 or nilai03<>0) ORDER BY $corder $csort"; 

$sql = "

select*,ifnull(nilai_sp2d,0)-ifnull(spj,0)as bspj from(
select *,
CASE WHEN selisih > 180 THEN IFNULL(nilai_sp2d,0)- IFNULL(spj,0) END AS nilai01,  
CASE WHEN selisih <= 180 AND selisih >=90  THEN IFNULL(nilai_sp2d,0)- IFNULL(spj,0) END AS nilai02, 
CASE WHEN selisih < 90 THEN IFNULL(nilai_sp2d,0)- IFNULL(spj,0) END AS nilai03  
from (
SELECT b.kd_skpd,b.nm_skpd,b.no_sp2d,
b.jns_spp,b.tgl_kas,'$ctgl' 
AS tgl_sekarang,
DATEDIFF('$ctgl',tgl_kas ) AS selisih, b.keperluan,
SUM(a.nilai)AS nilai_sp2d,
(SELECT IFNULL(SUM(d.nilai),0) FROM trdtransout d INNER JOIN trhtransout e ON d.no_bukti=e.no_bukti 
WHERE e.kd_skpd=b.kd_skpd AND e.jns_spp $spp and d.no_sp2d=b.no_sp2d) AS spj
FROM trdspp a INNER JOIN trhsp2d b ON a.no_spp=b.no_spp 
WHERE b.kd_skpd='$skpd' and b.status='1' 
AND b.jns_spp $spp AND b.tgl_kas<='$ctgl'  group by no_sp2d)v)ff WHERE (nilai01<>0 OR nilai02<>0 OR nilai03<>0)ORDER BY $corder $csort"; 
        $query1 = $this->db->query($sql);  
		
		$lcno = 0;	
		$nilai = 0;
		
 		$txnilai = 0;		
		$trealisasi	=0;	
		$tspj =0;
		$tbspj =0;
        $tselisih =0;	 
		
		$total_sp2d = 0;	
		$total180 = 0;
		$total90 =0;
		$total30	=0; 
		$totalumr	=0; 
		$total_spj	=0; 
		$total_bspj	=0; 
		

		$lcno=0;
		foreach ($query1->result() as $row){   
			$lcno = $lcno + 1;
			
			$kd_skpd=$row->kd_skpd;   
			$no_sp2d=$row->no_sp2d;
			$nilai_sp2d=$row->nilai_sp2d;
			$nilai_spj=$row->spj;
			$nilai_bspj=$row->bspj;
			$tgl_kas=$row->tgl_kas;
			$keperluan=$row->keperluan;
			$u180=$row->nilai01;
			$u90=$row->nilai02;
			$u30=$row->nilai03;


	$total_umur=$u180+$u90+$u30;
	$selisihnya=$nilai_sp2d-$total_umur;

	$total_sp2d=$nilai_sp2d+$total_sp2d;
	$total_spj=$nilai_spj+$total_spj;
	$total_bspj=$nilai_bspj+$total_bspj;
	$total180=$u180+$total180;
	$total90=$u90+$total90;
	$total30=$u30+$total30;	
	$total_umurnya=	$total180+$total90+$total30;

					
	$fnilai=number_format($nilai_sp2d,"2",",",".");
	$fspj=number_format($nilai_spj,"2",",",".");
	$fbspj=number_format($nilai_bspj,"2",",",".");
	$umur180=number_format($u180,"2",",",".");	
	$umur90=number_format($u90,"2",",",".");		
	$umur30=number_format($u30,"2",",",".");
	$selisih=number_format($selisihnya,"2",",",".");
	$ftotal_umurnya=number_format($total_umurnya,"2",",",".");
	
	$ftotal_sp2d=number_format($total_sp2d,"2",",",".");
	$ftotal_spj=number_format($total_spj,"2",",",".");
	$ftotal_bspj=number_format($total_bspj,"2",",",".");
	$ftotal180=number_format($total180,"2",",",".");
	$ftotal90=number_format($total90,"2",",",".");
	$ftotal30=number_format($total30,"2",",",".");
	$fselisihnya=number_format($total_umurnya,"2",",",".");	



	
			$cRet .="<tr>	
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$lcno</td>  
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\">$no_sp2d </td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$tgl_kas</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\">$keperluan</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$fnilai</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$fspj</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$fbspj</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$umur180</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$umur90</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$umur30</td>
						
				</tr>";				
																	
}
  if($lcno==0){
	$cRet .="<tr>	
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\"  align=\"right\" colspan=\"3\"><b>TOTAL (7+8+9)&nbsp; </b></td>  
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\" ><b>&nbsp; 00</b></td>
						
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>00</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>00</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>00</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>00</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>00</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>00</b></td>
												
					</tr>";  
	  
  }  else { 
			$cRet .="<tr>	
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\"  align=\"center\" colspan=\"4\"><b>TOTAL&nbsp; </b></td>  
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal_sp2d</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal_spj</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal_bspj</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal180</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal90</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal30</b></td>
												
					</tr>";
		}
	
		$cRet .="</table>";
		return $cRet;
		 
	 }

}

