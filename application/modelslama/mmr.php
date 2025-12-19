<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 
 */

class mmr extends CI_Model {

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
	
	 function cetak_mr($ctgl,$corder,$csort,$cspp){
		$sqlsc="SELECT tgl_rka,provinsi,kab_kota,daerah,thn_ang FROM sclient";
		$sqlsclient=$this->db->query($sqlsc);
		$cRet='';
		foreach ($sqlsclient->result() as $rowsc){
			$kab     = $rowsc->kab_kota;
			$daerah  = $rowsc->daerah;
		}
		
		if ($cspp==1){
			$spp="IN ('1','2')";
			$kspp='(UP/GU)';
		}else{
			$spp="='3'";
			$kspp='(TU)';
		}
		//$jangka=$this->left($crange,1);
		//$ini=substr($ctgl,5,2);	
		//$sel=$ini-$jangka;
		
        $cRet .="<table style=\"border-collapse:collapse;font-family:tahoma;font-size:12px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                    <tr>					
						<td align=\"center\" style=\"font-size:14px\"><strong>PEMERINTAH $kab</strong></td>
						
					</tr>
                    <tr>
						<td align=\"center\" style=\"font-size:14px;text-transform:uppercase\"><b>REKAPITULASI PERTANGGUNGJAWABAN SP2D BERDASARKAN SPJ</b></td>
						
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
						<td  colspan=\"3\" align=\"center\" height=\"1px\"  style=\"border-bottom:4px double black\"></td>
					</tr>
				</table>";

        $cRet .="<table style=\"border-collapse:collapse;font-family:tahoma;font-size:12px\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                    <thead>                       
                        <tr><td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>NO</b></td>                            
						<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"35%\" align=\"center\"><b>SKPD</b></td>
							<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>Jumlah SP2D <br> (Rp)</b></td>
							<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>Jumlah SPJ <br> (Rp)</b></td>
							<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>Jumlah Belum SPJ <br> (Rp)</b></td>
							<td colspan=\"3\" bgcolor=\"#CCCCCC\" width=\"45%\" align=\"center\"><b>Umur SP2D</b></td> 
						</tr>
                        <tr>
							<td bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>>180 Hari</b></td>
							<td bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>90 Hari</b></td>
							<td bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>30 Hari</b></td>
						</tr>
						<tr><td bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>1</b></td>                            
                            <td bgcolor=\"#CCCCCC\" width=\"35%\" align=\"center\"><b>2</b></td>
							<td bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>3</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>4</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>5</b></td> 
                            <td bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>6</b></td> 
							<td bgcolor=\"#CCCCCC\" width=\"15\" align=\"center\"><b>7</b></td> 
							<td bgcolor=\"#CCCCCC\" width=\"15\" align=\"center\"><b>8</b></td> 
						</tr>	
                    </thead>				
				
					<tfoot>
						<tr>
							 <td colspan=\"8\" style=\"border-bottom:none;border-left:none;border-right:none;\"></td>
						</tr>
					</tfoot>";


//DN == SILAHKAN DI SESUAIKAN DENGAN KONDISI DAERAH MASING-MASING...				
				 
// $sql = "SELECT kd_skpd,nm_skpd,SUM(nilai_sp2d)totsp2d,SUM(nilai01)tot01,SUM(nilai02)tot02,SUM(nilai03)tot03,SUM(tot)tot,SUM(selisih)selisih 
 // FROM(
  
 // SELECT kd_skpd,nm_skpd,no_sp2d,jns_spp,tgl_kas,keperluan,nilai_sp2d,nilai01,nilai02,nilai03,(IF(nilai01 IS NULL,(0),nilai01)+IF(nilai02 IS NULL,(0),nilai02)+IF(nilai03 IS NULL,(0),nilai03))AS tot,selisih
 // FROM(  
 // SELECT kd_skpd,nm_skpd,no_sp2d,jns_spp,tgl_kas,tgl_sekarang,selisih,keperluan,nilai_sp2d, 
 // CASE WHEN selisih > 180 THEN IF(nilai_sp2d IS NULL,(0),nilai_sp2d)- IF(spj IS NULL,(0),spj) END AS nilai01, 
 // CASE WHEN selisih <= 180 AND selisih >=90  THEN IF(nilai_sp2d IS NULL,(0),nilai_sp2d)- IF(spj IS NULL,(0),spj) END AS nilai02, 
 // CASE WHEN selisih < 90 THEN IF(nilai_sp2d IS NULL,(0),nilai_sp2d)- IF(spj IS NULL,(0),spj) END AS nilai03 
 // FROM( 
 // SELECT x.kd_skpd,x.nm_skpd,x.no_sp2d,x.jns_spp,x.tgl_kas,'$ctgl' 
 // AS tgl_sekarang,DATEDIFF('$ctgl',tgl_kas ) AS selisih, x.keperluan,nsp2d(x.kd_skpd,x.no_spp)AS nilai_sp2d, 
 // (SELECT SUM(e.nilai)AS nilai FROM trhtransout d INNER JOIN trdtransout e ON d.no_bukti=e.no_bukti 
 // WHERE d.kd_skpd=x.kd_skpd AND d.no_sp2d=x.no_sp2d AND d.tgl_kas<='$ctgl' AND d.jns_spp <>'1' AND d.kd_skpd=x.kd_skpd )AS spj FROM trhsp2d X 
 // WHERE x.status='1' AND jns_spp <>'1' AND x.tgl_kas<='$ctgl'  
 // )z
// UNION
 // SELECT kd_skpd,nm_skpd,no_sp2d,jns_spp,tgl_kas,tgl_sekarang,selisih,keperluan,nilai_sp2d, 
 // CASE WHEN selisih > 180 THEN IF(spj IS NULL,(0),spj) END AS nilai01, 
 // CASE WHEN selisih <= 180 AND selisih >=90 THEN IF(spj IS NULL,(0),spj) END AS nilai02, 
 // CASE WHEN selisih < 90 THEN IF(spj IS NULL,(0),spj) END AS nilai03 FROM( 
 // SELECT kd_skpd,nm_skpd,jns_spp,no_sp2d,tgl_kas,tgl_sekarang,selisih,keperluan,nilai_sp2d,(sp2dupgu-spjx)spj 
 // FROM( 
 // SELECT x.kd_skpd,x.nm_skpd,x.no_sp2d,x.jns_spp,x.tgl_kas,'$ctgl' AS tgl_sekarang,DATEDIFF('$ctgl',tgl_kas) AS selisih, 
 // x.keperluan,nsp2d(x.kd_skpd,x.no_spp)AS nilai_sp2d, 
 // (SELECT SUM(a.nilai)nilai FROM trdspp a INNER JOIN trhsp2d b 
 // ON a.no_spp=b.no_spp AND a.kd_skpd=b.kd_skpd WHERE a.kd_skpd=x.kd_skpd AND b.status='1' AND b.jns_spp IN(1,2) AND b.tgl_kas<='$ctgl' 
 // )AS sp2dupgu, ( SELECT SUM(e.nilai)AS nilai FROM trhtransout d INNER JOIN trdtransout 
 // e ON d.no_bukti=e.no_bukti WHERE d.jns_spp='1' AND d.tgl_kas<='$ctgl' AND d.kd_skpd=x.kd_skpd )AS spjx 
 // FROM trhsp2d X WHERE x.status='1' AND jns_spp ='1' AND x.tgl_kas<='$ctgl'  )Y )n 
 
 // )aa WHERE jns_spp<>'2' AND(nilai01<>0 OR nilai02<>0 OR nilai03<>0)
// )bb GROUP BY kd_skpd ORDER BY $corder $csort
 // ";
 
 $sql = "
 select * from (
 SELECT kd_skpd,nm_skpd,SUM(nilai_sp2d)AS totsp2d,SUM(spj)AS spj,SUM(nilai01)AS tot01,SUM(nilai_sp2d)-SUM(spj)as hh,SUM(nilai02)AS tot02,SUM(nilai03)AS tot03,selisih
from(
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
WHERE b.status='1' 
AND b.jns_spp $spp AND b.tgl_kas<='$ctgl' group by no_sp2d)v ORDER BY kd_skpd,no_sp2d DESC)z 

group by kd_skpd)xx where hh<>'0' order by $corder $csort
 "; 
 
        $query1 = $this->db->query($sql);  
		
		$lcno = 0;	
		$nilai = 0;
		$nilai_ubah =0;
		$realisasi	=0;	
		$spj =0;
		
 		$txnilai = 0;		
		$trealisasi	=0;	
		$tspj =0;
        $tselisih =0;	 
		
		$total_sp2d = 0;	
		$total_spj = 0;	
		$total_sisa = 0;	
		$total180 = 0;
		$total90 =0;
		$total30	=0; 
		
		foreach ($query1->result() as $row){   
			$lcno = $lcno + 1;
			
			$kd_skpd=$row->kd_skpd;
			$nm_skpd=$row->nm_skpd;
			$nilai_sp2d=$row->totsp2d;
			$nilai_spj=$row->spj;
			$nilai_sisa=$row->hh;
			$u180=$row->tot01;
			$u90=$row->tot02;
			$u30=$row->tot03;

	$total_sp2d=$nilai_sp2d+$total_sp2d;
	$total_spj=$nilai_spj+$total_spj;
	$total_sisa=$nilai_sisa+$total_sisa;
	$total180=$u180+$total180;
	$total90=$u90+$total90;
	$total30=$u30+$total30;		
				
			$fnilai=number_format($nilai_sp2d,"2",",",".");
			$fnilais=number_format($nilai_spj,"2",",",".");
			$fnilaisi=number_format($nilai_sisa,"2",",",".");
			$umur180=number_format($u180,"2",",",".");	
			$umur90=number_format($u90,"2",",",".");		
			$umur30=number_format($u30,"2",",",".");
			
												
			$cRet .="<tr>	
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$lcno</td>  
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\">$kd_skpd - $nm_skpd</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$fnilai</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$fnilais</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$fnilaisi</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$umur180</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$umur90</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$umur30</td>
				</tr>";				
															
		
}
      
			$ftotal_sp2d=number_format($total_sp2d,"2",",",".");
			$ftotal_spj=number_format($total_spj,"2",",",".");
			$ftotal_sisa=number_format($total_sisa,"2",",",".");
			$ftotal180=number_format($total180,"2",",",".");	
			$ftotal90=number_format($total90,"2",",",".");		
			$ftotal30=number_format($total30,"2",",",".");

		
			$cRet .="<tr>	
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\"  align=\"center\" colspan=\"2\"><b>TOTAL</b></td>  
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal_sp2d</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal_spj</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal_sisa</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal180</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal90</b></td>						
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$ftotal30</b></td>						
					</tr>";
		
		$cRet .="</table>";
		return $cRet;
		 
	 }

}

