<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 
 */

class Mrealisasi extends CI_Model {

    function __construct()
    {
        parent::__construct();
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
	
	 function cetak_realisasi_apbd($ctgl,$capbd){
		$sqlsc="SELECT tgl_rka,provinsi,kab_kota,daerah,thn_ang FROM sclient";
		$sqlsclient=$this->db->query($sqlsc);
		$cRet='';
		foreach ($sqlsclient->result() as $rowsc){
			$kab     = $rowsc->kab_kota;
			$daerah  = $rowsc->daerah;
		}
		
        $cRet .="<table style=\"border-collapse:collapse;font-family:tahoma;font-size:12px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                    <tr>					
						<td align=\"center\" style=\"font-size:14px\"><strong>PEMERINTAH $kab</strong></td>
						
					</tr>
                    <tr>
						<td align=\"center\" style=\"font-size:14px;text-transform:uppercase\"><b>REALISASI DATA APBD (UP, GU, TU, LS)</b></td>
						
					</tr>                            
                    <tr>	
						<td align=\"center\" style=\"font-size:14px\">PERIODE 1 Januari s/d ".$this->tukd_model->tanggal_format_indonesia($ctgl)."</td>
						
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
                        <tr><td bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>NO</b></td>                            
                            <td bgcolor=\"#CCCCCC\" width=\"8%\" align=\"center\"><b>Kode SKPD</b></td>
							<td bgcolor=\"#CCCCCC\" width=\"37%\" align=\"center\"><b>NAMA SKPD</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>APBD/APBD-P</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>REALISASI SP2D</b></td> 
							<td bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>%</b></td> 
							<td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>SPJ</b></td> 
							<td bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>%</b></td>
							<td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>SELISIH</b></td> 							
						</tr>
						
						<tr><td bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>1</b></td>                            
                            <td bgcolor=\"#CCCCCC\" width=\"8%\" align=\"center\"><b>2</b></td>
							<td bgcolor=\"#CCCCCC\" width=\"37%\" align=\"center\"><b>3</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>4</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>5</b></td> 
							<td bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>6</b></td> 
							<td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>7</b></td> 
							<td bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>8</b></td>
							<td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>9 (5-7)</b></td> 							
						</tr>	
                    </thead>				
				
					<tfoot>
						<tr>
							 <td colspan=\"9\" style=\"border-bottom:none;border-left:none;border-right:none;\"></td>
						</tr>
					</tfoot>";
					
					
//DN == SILAHKAN DI SESUAIKAN DENGAN KONDISI DAERAH MASING-MASING...	 
				
		$sql = " SELECT kd_Skpd,nm_skpd,
(SELECT SUM(nilai) FROM trdrka a WHERE a.kd_skpd=z.kd_skpd AND (LEFT(kd_rek5,1)='5' OR LEFT(kd_rek5,2)='62')) AS nilai, 
(SELECT SUM(nilai_ubah) FROM trdrka a WHERE a.kd_skpd=z.kd_skpd AND (LEFT(kd_rek5,1)='5' OR LEFT(kd_rek5,2)='62')) AS nilai_ubah,
(SELECT SUM(a.nilai) FROM trdspp a INNER JOIN trhsp2d b ON a.no_spp=b.no_spp WHERE a.kd_skpd=z.kd_skpd AND no_kas_bud<>'' and tgl_kas_bud<='$ctgl') AS realisasi,
(SELECT IFNULL(SUM(a.nilai),0) FROM trdspp a INNER JOIN trhsp2d b ON a.no_spp=b.no_spp WHERE a.kd_skpd=z.kd_skpd 
AND no_kas_bud<>'' AND jns_spp IN ('4','5','6') and b.tgl_kas_bud<='$ctgl')+
(SELECT IFNULL(SUM(a.nilai),0) FROM trdtransout a INNER JOIN trhtransout b ON a.no_bukti=b.no_bukti WHERE b.kd_skpd=z.kd_skpd AND jns_spp IN 
('1','2','3','7') and tgl_kas<='$ctgl') AS spj
FROM ms_skpd z";
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
		
		foreach ($query1->result() as $row){   
			$lcno = $lcno + 1;
			
			$kd_skpd=$row->kd_Skpd;
			$nm_skpd=$row->nm_skpd;
			$nilai=$row->nilai;
			$nilai_ubah=$row->nilai_ubah;
			$realisasi=$row->realisasi;
			$spj=$row->spj;

			if($capbd=='1'){				
				$xnilai=$nilai;
			}else{
				$xnilai=$nilai_ubah;					
			}
					
			
			$selisih=$realisasi-$spj;
			
			if ($selisih < 0){
                        $x1="("; $selisih=$selisih*-1; $y1=")";}
                    else {
                        $x1=""; $y1="";}
                    $n_selisih = number_format($selisih,"2",",",".");

                    if($xnilai != 0){
                        $pers   = ($realisasi!=0)?($realisasi/$xnilai) * 100:0; 
						$perss=($spj!=0)?($spj/$realisasi) * 100:0; 
                    // }else if($bini != 0 and $blalu ==0){
                        // $pers=100;
                    // }
					}else{
                        $perss=0;
                        $pers=0;
					}
			
			$persen1= number_format($pers,"2",".",",");
			$persen2= number_format($perss,"2",".",",");
			
			// $persen1=($realisasi/$xnilai)*100;
			// $persen2=($spj/$realisasi)*100;
			
			$txnilai=$xnilai+$txnilai;
			$trealisasi=$realisasi+$trealisasi;
			$tspj=$spj+$tspj;
			$tselisih=$selisih+$tselisih;
			
			if ($selisih < 0){
				$x="("; $xselisih=$selisih*-1;
				$y=")";}
			else {
				$xselisih=$selisih;
				$x=""; $y="";				
			}
			
				
			$fnilai=number_format($xnilai,"2",",",".");
			$fsp2d=number_format($realisasi,"2",",",".");
			$fspj=number_format($spj,"2",",",".");	
			$fselisih=number_format($xselisih,"2",",",".");		
			$fpersen1=number_format($persen1,"2",",",".");
			$fpersen2=number_format($persen2,"2",",",".");
												
			$cRet .="<tr>	
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"5%\" align=\"center\">$lcno</td>  
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"8%\" align=\"left\">$kd_skpd</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"37%\" align=\"left\">$nm_skpd</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$fnilai</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$fsp2d</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"5%\" align=\"right\">$fpersen1</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$fspj</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"5%\" align=\"right\">$fpersen2</td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$x$fselisih$y</td>
						
					</tr>";				
															
		}

			
			
			
			$tpersen1=($trealisasi/$txnilai)*100;
			$tpersen2=($tspj/$trealisasi)*100;	
			if ($tselisih < 0){
				$tx="("; $txselisih=$tselisih*-1;
				$ty=")";}
			else {
				$txselisih=$tselisih;
				$tx=""; $ty="";				
			}
	
		
			$ftnilai=number_format($txnilai,"2",",",".");
			$ftsp2d=number_format($trealisasi,"2",",",".");
			$ftspj=number_format($tspj,"2",",",".");	
			$ftselisih=number_format($txselisih,"2",",",".");		
			$ftpersen1=number_format($tpersen1,"2",",",".");
			$ftpersen2=number_format($tpersen2,"2",",",".");
		
			$cRet .="<tr>	
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"5%\" align=\"center\" colspan=\"3\"><b>JUMLAH</b></td>  
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$ftnilai</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$ftsp2d</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"5%\" align=\"right\"><b>$ftpersen1</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$ftspj</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"5%\" align=\"right\"><b>$ftpersen2</b></td>
						<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$tx$ftselisih$ty</b></td>
						
					</tr>";
	
		$cRet .="</table>";
		return $cRet;
		 
	 }

}

