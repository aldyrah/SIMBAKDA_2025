<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Akuntansi_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
	
	function get_nama($kode,$hasil,$tabel,$field){
		$this->db->select($hasil);
		$this->db->where($field, $kode);
		$q = $this->db->get($tabel);
		$data  = $q->result_array();
		$baris = $q->num_rows();
		return $data[0][$hasil];
	}

	function get_rek64($kode,$hasil){
		$qry	= "select * from (
					SELECT kd_rek64 kd_rek,nm_rek64 nm_rek FROM ms_rek5 union 
					select kd_rek4_64 kd_rek, nm_rek4_64 nm_rek from ms_rek4_64 UNION
					select kd_rek3 kd_rek, nm_rek3 nm_rek from ms_rek3_64 union 
					select kd_rek2 kd_rek, nm_rek2 nm_rek from ms_rek2_64 UNION
					select kd_rek1 kd_rek, nm_rek1 nm_rek from ms_rek1_64
					) a where kd_rek='$kode' ";
		$data	= $this->db->query($qry)->result_array();
		return	$data[0][$hasil];
	}
	
	function get_sclient($apa){
		$hasil	= $this->db->query("select $apa from sclient ")->row($apa);
		return $hasil;
	}
	
	function jurnal_akt(){
		$ppkd	= "1.20.05.01";
		$sql	= "	DELETE FROM trhju_ppkd WHERE ifnull(tabel,'')!='1';
					DELETE FROM trdju_ppkd WHERE ifnull(tabel,'')!='1';

				/*SILPA*/
					#Header Silpa
					insert into trhju_ppkd 
					SELECT CONCAT(a.no_sts,'/SILPA'),tgl_sts,a.kd_skpd,'PPKD' nm_skpd,a.keterangan,NULL,'ATT',NULL,NULL,NULL,total,total,'SILPA'
					FROM trhkasin_ppkd a join trdkasin_ppkd b on a.kd_skpd=b.kd_skpd and a.no_sts=b.no_sts
					and a.jns_trans='61' and left(b.kd_rek5,2)=61;

					#Detail Silpa Debet
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					select CONCAT(a.no_sts,'/SILPA'),'','','0000000','Perubahan SAL',SUM(b.rupiah),0,'D','1',NULL,NULL,1,1,a.kd_skpd
					FROM trhkasin_ppkd a join trdkasin_ppkd b on a.kd_skpd=b.kd_skpd and a.no_sts=b.no_sts
					join ms_rek5 c on b.kd_rek5=c.kd_rek5
					and a.jns_trans='61' and left(b.kd_rek5,2)=61;

					#Detail Silpa Kredit
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					select CONCAT(a.no_sts,'/SILPA'),'','',kd_rek64,nm_rek64,0,SUM(b.rupiah),'K','1',NULL,NULL,1,1,a.kd_skpd 
					FROM trhkasin_ppkd a join trdkasin_ppkd b on a.kd_skpd=b.kd_skpd and a.no_sts=b.no_sts
					join ms_rek5 c on b.kd_rek5=c.kd_rek5
					and a.jns_trans='61' and left(b.kd_rek5,2)=61;

				/*	Pencairan SP2D SKPD	*/
					#Header Pencairan SP2D SKPD
					insert INTO trhju_ppkd
					SELECT 
					CONCAT(no_sp2d,'/',kd_skpd,'/SP2D_SKPD') no_voucher,tgl_sp2d,kd_skpd,nm_skpd,CONCAT('Pencairan SP2D No: ',no_sp2d)ket,NULL,
					username,NULL,NULL,NULL,nilai,nilai,'trhsp2d'
					FROM trhsp2d WHERE  kd_skpd!='$ppkd' and status_bud=1
					GROUP BY no_sp2d,kd_skpd;

					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT
					CONCAT(no_sp2d,'/',kd_skpd,'/SP2D_SKPD') no_voucher,'','','1180101','RK SKPD',SUM(nilai),0,'D','1',NULL,NULL,1,1,a.kd_skpd 
					FROM trhsp2d a WHERE kd_skpd!='$ppkd' and status_bud=1
					GROUP BY no_sp2d,kd_skpd;

					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT 
					CONCAT(no_sp2d,'/',kd_skpd,'/SP2D_SKPD') no_voucher,'','','1110101','KAS DI KASDA',0,SUM(nilai),'K','1',NULL,NULL,1,1,a.kd_skpd 
					FROM trhsp2d a WHERE kd_skpd!='$ppkd' and status_bud=1
					GROUP BY no_sp2d,kd_skpd;

				/*	Pencairan SP2D PPKD	*/
					#Header Pencairan SP2D PPKD
					insert INTO trhju_ppkd
					SELECT 
					CONCAT(no_sp2d,'/',a.kd_skpd,'/SP2D_PKD')no_voucher,tgl_kas_bud tgl_voucher,kd_skpd,nm_skpd,CONCAT('Pencairan SP2D No: ',no_sp2d) ket,
					NULL,username,NULL,NULL,NULL,nilai,nilai,'trhsp2d'
					FROM trhsp2d a WHERE  status_bud=1 and kd_skpd='$ppkd'
					GROUP BY no_sp2d,no_kas_bud,tgl_kas_bud,kd_skpd;

					#BEBAN
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT 
					CONCAT(no_sp2d,'/',a.kd_skpd,'/SP2D_PKD')no_voucher,'','',map_lo kd_rek5,
					concat(replace(nm_rek64,'Belanja','Beban'),' - LO') nm_rek5
					,SUM(b.nilai) debet,0 kredit,'D' rk,'1',NULL,NULL,1,1,a.kd_skpd 
					FROM trhsp2d a JOIN trdspp b ON a.no_spp=b.no_spp AND a.kd_skpd='$ppkd' and b.kd_skpd='$ppkd' JOIN ms_rek5 c ON b.kd_rek5=c.kd_rek5 
					WHERE a.status_bud=1
					GROUP BY no_sp2d,no_kas_bud,a.kd_skpd;

					#KAS DI KASDA
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT 
					CONCAT(no_sp2d,'/',a.kd_skpd,'/SP2D_PKD')no_voucher,'','','1110101'kd_rek5,'KAS DI KASDA'nm_rek5,0 debet,SUM(nilai)kredit,'K' rk,'1',NULL,NULL,1,1,a.kd_skpd 
					FROM trhsp2d a 
					WHERE status_bud=1 and a.kd_skpd='$ppkd'
					GROUP BY no_sp2d,no_kas_bud,a.kd_skpd;

					#BELANJA
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT 
					CONCAT(no_sp2d,'/',a.kd_skpd,'/SP2D_PKD')no_voucher,'','',c.kd_rek64,c.nm_rek64,SUM(b.nilai) debet,0 kredit,'D' rk,'1',NULL,NULL,1,1,a.kd_skpd 
					FROM trhsp2d a JOIN trdspp b ON a.no_spp=b.no_spp AND a.kd_skpd='$ppkd' and b.kd_skpd='$ppkd' JOIN ms_rek5 c ON b.kd_rek5=c.kd_rek5 
					WHERE status_bud=1
					GROUP BY no_sp2d,no_kas_bud,a.kd_skpd,c.kd_rek64;

					#PERUBAHAN SAL
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT 
					CONCAT(no_sp2d,'/',a.kd_skpd,'/SP2D_PKD')no_voucher,'','','0000000'kd_rek5,'Perubahan SAL'nm_rek5,0 debet,SUM(nilai)kredit,'K','1',NULL,NULL,1,1,a.kd_skpd 
					FROM trhsp2d a 
					WHERE status_bud=1 and a.kd_skpd='$ppkd'
					GROUP BY no_sp2d,a.kd_skpd;

				/* Jurnal Penerimaan Pendapatan PPKD*/
					#Header Jurnal Pendapatan PPKD
					insert INTO trhju_ppkd
					SELECT DISTINCT CONCAT(no_terima,'/',ifnull(no_kas,''),'/',a.kd_rek5,'/Terima'),tgl_terima,kd_skpd,'',keterangan,NULL,NULL,NULL,NULL,NULL,nilai,nilai,'1tr_terima_ppkd'
					FROM tr_terima_ppkd a
					GROUP BY a.no_terima,a.no_kas,a.kd_rek5,a.nilai;

					#Detail Jurnal Pendapatan PPKD Kas di Kasda
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd,tabel)
					SELECT DISTINCT CONCAT(no_terima,'/',ifnull(a.no_kas,''),'/',a.kd_rek5,'/Terima'),'','','1110101','KAS DI KASDA',nilai,0,'D','1',NULL,NULL,1,1,a.kd_skpd,'tr_terima'
					FROM tr_terima_ppkd a WHERE a.kd_skpd='$ppkd'
					GROUP BY a.no_terima,a.kd_skpd,a.kd_rek5,a.nilai;

					#Detail Jurnal Pendapatan-LO PPKD Dengan Penetapan
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT DISTINCT CONCAT(no_terima,'/',ifnull(a.no_kas,''),'/',a.kd_rek5,'/Terima'),'','',kd_rek_lo,nm_rek64,0,nilai,'K','2',NULL,NULL,2,1,a.kd_skpd 
					FROM tr_terima_ppkd a JOIN ms_rek5 b ON a.kd_rek_lo=b.kd_rek5 WHERE a.kd_skpd='$ppkd'  AND ifnull(no_tetap,'')=''
					GROUP BY a.no_terima,a.kd_skpd,a.kd_rek5,a.nilai;

					#Detail Jurnal Pendapatan-LO PPKD Tanpa Penetapan
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT DISTINCT CONCAT(no_terima,'/',no_kas,'/',a.kd_rek5,'/Terima'),'','',piutang_utang,'',0,nilai,'K','2',NULL,NULL,2,1,a.kd_skpd 
					FROM tr_terima_ppkd a JOIN ms_rek5 b ON a.kd_rek5=b.kd_rek5 WHERE a.kd_skpd='$ppkd'  AND ifnull(no_tetap,'')<>''
					GROUP BY a.no_terima,a.kd_skpd,a.kd_rek5,a.nilai;

					#Detail Jurnal Pendapatan PPKD Perubahan SAL
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT DISTINCT CONCAT(no_terima,'/',ifnull(a.no_kas,''),'/',a.kd_rek5,'/Terima'),'','','0000000','Perubahan SAL',nilai,0,'D','3',NULL,NULL,3,1,a.kd_skpd 
					FROM tr_terima_ppkd a WHERE a.kd_skpd='$ppkd' 
					GROUP BY a.no_terima,a.kd_skpd,a.kd_rek5,a.nilai;

					#Detail Jurnal Pendapatan PPKD Pendapatan-LRA
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT DISTINCT CONCAT(no_terima,'/',ifnull(a.no_kas,''),'/',a.kd_rek5,'/Terima'),'','',kd_rek64,nm_rek64,0,nilai,'K','4',NULL,NULL,4,1,a.kd_skpd 
					FROM tr_terima_ppkd a JOIN ms_rek5 b ON a.kd_rek5=b.kd_rek5 WHERE a.kd_skpd='$ppkd' 
					GROUP BY a.no_terima,a.kd_skpd,a.kd_rek5,a.nilai;

				/* Jurnal Pengembalian dari SKPD*/
					#Header Jurnal Pengembalian dari SKPD
					insert INTO trhju_ppkd
					SELECT DISTINCT CONCAT(no_sts,'/',kd_skpd,'/CP_SKPD'),tgl_sts,kd_skpd,'',keterangan,NULL,'ATT',NULL,NULL,NULL,total,total,'2trhkasin_ppkd' 
					FROM trhkasin_ppkd where no_cek='skpd'
					GROUP BY no_sts,kd_skpd;

					#Detail Jurnal Pengembalian dari SKPD Kas di Kasda
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT DISTINCT CONCAT(a.no_sts,'/',a.kd_skpd,'/CP_SKPD'),'','','1110101','KAS DI KASDA',SUM(b.rupiah),0,'D','1',NULL,NULL,1,1,a.kd_skpd 
					FROM trhkasin_ppkd a JOIN trdkasin_ppkd b ON a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd and a.no_cek='skpd'
					GROUP BY a.no_sts,a.kd_skpd;

					#Detail Jurnal Pengembalian dari SKPD RK SKPD
					insert into trdju_ppkd (no_voucher,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,kd_skpd)
					SELECT DISTINCT CONCAT(a.no_sts,'/',a.kd_skpd,'/CP_SKPD'),'','','1180101','RK SKPD',0,SUM(b.rupiah),'D','1',NULL,NULL,2,1,a.kd_skpd 
					FROM trhkasin_ppkd a JOIN trdkasin_ppkd b ON a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd and a.no_cek='skpd'
					GROUP BY a.no_sts,a.kd_skpd	";

		$area	= explode(';',$sql);
		foreach ($area as $line){
			if (substr($line,0,2)=='--'||$line=='')continue;
			$this->db->query($line);
		}
		
		#$this->db->query("update trdju_ppkd a join ms_rek5 b on a.kd_rek5=b.kd_rek64 set a.nm_rek5=b.nm_rek64 where a.kd_skpd='$skpd' and a.nm_rek5=''");
		return true;
	}

	function jurnal_sp2d_bud(){
	$sql11 = "SELECT DISTINCT d.no_sp2d FROM trdspp a 
			 LEFT JOIN trhspp b ON a.no_spp=b.no_spp
			 LEFT JOIN trhspm c ON c.no_spp=b.no_spp
			 LEFT JOIN trhsp2d d ON d.no_spm=c.no_spm
			 WHERE d.status_bud='1' ";
		$query11 = $this->db->query($sql11);
		foreach($query11->result_array() as $resulte11){
			$sp2d2 = $resulte11['no_sp2d'];

			$sql = "SELECT a.no_spp,a.kd_skpd,a.kd_kegiatan,a.kd_rek5,a.nilai,b.bulan,c.no_spm,d.no_sp2d,b.sts_tagih,d.keperluan as ket,d.username,
				d.no_kas_bud,d.tgl_kas_bud,d.nm_skpd,d.last_update AS tgl_update FROM trdspp a 
				 LEFT JOIN trhspp b ON a.no_spp=b.no_spp
				 LEFT JOIN trhspm c ON c.no_spp=b.no_spp
				 LEFT JOIN trhsp2d d ON d.no_spm=c.no_spm
				 WHERE d.status_bud='1' and d.no_sp2d='$sp2d2'";
	        	$query1 = $this->db->query($sql);  
	        	$ii = 0;
	        	$jum=0;
	        	foreach($query1->result_array() as $resulte){																
		            $sp2d = $resulte['no_sp2d'];
		            $skpd = '1.20.05.01';
		            $giat = $resulte['kd_kegiatan'];
		            $rek5 = $resulte['kd_rek5'];
		            $nokas = $resulte['no_kas_bud'];
		            $tglkas = $resulte['tgl_kas_bud'];
		            $nmskpd = $resulte['nm_skpd'];
		            $last_update = $resulte['tgl_update'];
		            $ket = $resulte['ket'];
		            $username = $resulte['username'];
		            
		            $rek9  = $this->tukd_model->get_nama($rek5,'map_lo','ms_rek5','kd_rek5');
		            $nmrek9= $this->tukd_model->get_nama($rek9,'nm_rek5','ms_rek5','kd_rek5');
		            
		            $rek64  = $this->tukd_model->get_nama($rek5,'kd_rek64','ms_rek5','kd_rek5');
		            $nmrek64= $this->tukd_model->get_nama($rek64,'nm_rek64','ms_rek5','kd_rek64');

		            $nilai = $resulte['nilai'];
		            $tagih = $resulte['sts_tagih'];

		            $jum=$jum+$nilai;

		            $rekutang=$this->tukd_model->get_nama($rek64,'piutang_utang','ms_rek5','kd_rek64');
		            $nmskpd=$this->tukd_model->get_nama($skpd,'nm_skpd','ms_skpd','kd_skpd');
		            $nmgiat=$this->tukd_model->get_nama($giat,'nm_kegiatan','trskpd','kd_kegiatan');
		            $nmrek5=$this->tukd_model->get_nama($rek5,'nm_rek5','ms_rek5','kd_rek5');
		            $nmrekutang=$this->tukd_model->get_nama($rekutang,'nm_rek5','ms_rek5','kd_rek5'); 													
        		}       

			        $sql10 = $this->db->query("delete from trhju_pkd where no_voucher='$nokas' and kd_skpd='$skpd'");
			        $sql10 = $this->db->query("delete from trdju_pkd where no_voucher='$nokas' and kd_skpd='$skpd'");

			        $sql2 = "insert into trhju_pkd(no_voucher,tgl_voucher,kd_skpd,nm_skpd,ket,tgl_update,username,total_d,total_k,tabel) 
			        values('$nokas','$tglkas','$skpd','$nmskpd','$ket','$last_update','$username','$jum','$jum','cairbud')";
			        $asg1 = $this->db->query($sql2);
			        
			       $this->db->query("insert trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
			                    values('$nokas','$skpd','','','1180101','RK SKPD','$jum','0','D','','','','1','1','cairbud') ");     
			       $this->db->query("insert trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
			                     values('$nokas','$skpd','','','1110101','Kas di Kas Daerah','0','$jum','K','','','','2','1','cairbud') ");
   	
		}

		$area1	= explode(';',$sql11);
		foreach ($area1 as $line){
			if (substr($line,0,2)=='--'||$line=='')continue;
			$this->db->query($line);
		}
		return true;
	}

	function jurnal_sp2d_skpd(){
	$sql11 = "SELECT DISTINCT d.no_sp2d FROM trdspp a 
			 LEFT JOIN trhspp b ON a.no_spp=b.no_spp
			 LEFT JOIN trhspm c ON c.no_spp=b.no_spp
			 LEFT JOIN trhsp2d d ON d.no_spm=c.no_spm
			 WHERE d.status='1'  ";
		$query11 = $this->db->query($sql11);
		foreach($query11->result_array() as $resulte11){
			$sp2d2 = $resulte11['no_sp2d'];

			$sql = "SELECT a.no_spp,a.kd_skpd,a.kd_kegiatan,a.kd_rek5,a.nilai,b.bulan,c.no_spm,d.no_sp2d,d.jns_spp,d.keperluan as ket,d.username,
				d.no_kas,d.tgl_kas,d.nm_skpd,d.last_update AS tgl_update FROM trdspp a 
				 LEFT JOIN trhspp b ON a.no_spp=b.no_spp
				 LEFT JOIN trhspm c ON c.no_spp=b.no_spp
				 LEFT JOIN trhsp2d d ON d.no_spm=c.no_spm
				 WHERE d.status='1' and d.no_sp2d='$sp2d2'";
	        	$query1 = $this->db->query($sql);  
	        	$ii = 0;
	        	$jum=0;
	        	foreach($query1->result_array() as $resulte){																
		            $sp2d = $resulte['no_sp2d'];
		            $skpd = $resulte['kd_skpd'];
		            $giat = $resulte['kd_kegiatan'];
		            $rek5 = $resulte['kd_rek5'];
		            $nokas = $resulte['no_kas'];
		            $tglkas = $resulte['tgl_kas'];
		            $nmskpd = $resulte['nm_skpd'];
		            $last_update = $resulte['tgl_update'];
		            $ket = $resulte['ket'];
		            $username = $resulte['username'];
		            $jns = $resulte['jns_spp'];
		            
		            $kdrek4=$this->tukd_model->get_nama($kdrek5,'kd_rek4','ms_rek5','kd_rek5');
					$rek9=$this->tukd_model->get_nama($rek5,'map_lo','ms_rek5','kd_rek5');
					$nmrek9=$this->tukd_model->get_nama($rek9,'nm_rek5','ms_rek5','kd_rek5');            
		            $rek64=$this->tukd_model->get_nama($rek5,'kd_rek64','ms_rek5','kd_rek5');
					$nmrek64=$this->tukd_model->get_nama($rek64,'nm_rek64','ms_rek5','kd_rek64');

		            $nilai = $resulte['nilai'];

		            $jum=$jum+$nilai;

		            $rekutang=$this->tukd_model->get_nama($rek64,'piutang_utang','ms_rek5','kd_rek64');
					$nmskpd=$this->tukd_model->get_nama($skpd,'nm_skpd','ms_skpd','kd_skpd');
					$nmgiat=$this->tukd_model->get_nama($giat,'nm_kegiatan','trskpd','kd_kegiatan');
					$nmrek5=$this->tukd_model->get_nama($rek5,'nm_rek5','ms_rek5','kd_rek5');
					$nmrekutang=$this->tukd_model->get_nama($rekutang,'nm_rek5','ms_rek5','kd_rek5');

					if($kdrek4=='52201' || $kdrek4=='52201' ){
	                $kdrek_p=$this->tukd_model->get_nama($kdrek5,'persed_kdp','ms_rek5','kd_rek5');
	                $nmrek_p=$this->tukd_model->get_nama($kdrek_p,'nm_rek5','ms_rek5','kd_rek5');
	            	}

			        if (($jns=='4') or ($jns=='5') or ($jns=='6')  ){		    
		    			
	    				if ($jns!='1') {	                
	    					$this->db->query("insert trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
	    									  values('$nokas','$skpd','$giat','$nmgiat','$rek64','$nmrek64',$nilai,'0','D','$jns','3','1','cairskpd') ");             
	    					$this->db->query("insert trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
	    									  values('$nokas','$skpd','$giat','$nmgiat','$rek9','$nmrek9',$nilai,'0','D','$jns','5','1','cairskpd') ");

	                        if($kdrek4=='52201' || $kdrek4=='52201' ){
	                                $this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
												     values('$nokas','$skpd','$giat','$nmgiat','$kdrek_p','$nmrek_p',$nilai,'0','D','$beban','7','1','cairskpd') ");       			
	                                $this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
	    											 values('$nokas','$skpd','','','1110301','Kas di Bendahara Pengeluaran','0','$nilai','K','','8','1','cairskpd') ");     
	                           }             				
	    				}
		    			
		            }    
            	}

				if (($jns=='1') or ($jns=='2') or ($jns=='3') or ($jns=='7') ){
					$this->db->query("insert trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
									  values('$nokas','$skpd','','','1110301','Kas di Bendahara Pengeluaran','$jum','0','D','','1','1','cairskpd') ");		
					$this->db->query("insert trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
									  values('$nokas','$skpd','','','3130101','RK PPKD','0','$jum','K','','2','1','cairskpd') ");		
				}else{
					$this->db->query("insert trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
									  values('$nokas','$skpd','','','0000000','Perubahan SAL','0','$jum','K','','4','0','cairskpd') ");
					$this->db->query("insert trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
									  values('$nokas','$skpd','','','3130101','RK PPKD','0','$jum','K','','6','1','cairskpd') ");		
				}
			
		        $sql3 = " insert into trhju_pkd(no_voucher,tgl_voucher,ket,username,tgl_update,kd_skpd,nm_skpd,total_d,total_k,tabel) 
              	values('$nokas','$tglkas','$ket','$username','$last_update','$skpd','$nmskpd','$jum','$jum','cairskpd')";
    			$asg3 = $this->db->query($sql3);
   	
		}

		$area1	= explode(';',$sql11);
		foreach ($area1 as $line){
			if (substr($line,0,2)=='--'||$line=='')continue;
			$this->db->query($line);
		}
		return true;
	}

	function jurnal_spj_skpd(){
		//$sql11 = "select no_bukti, tgl_bukti, ket, username,'' as tgl_update, kd_skpd,nm_skpd, total from trhtransout WHERE jns_spp IN ('1','3')";
		$sql11 = "select no_bukti, tgl_bukti, ket, username,'' as tgl_update, kd_skpd,nm_skpd, total from trhtransout WHERE  jns_spp IN ('1','2','3','7') ";
		$query11 = $this->db->query($sql11);
		foreach($query11->result_array() as $resulte11){
			$nomor = $resulte11['no_bukti'];
			$tgl = $resulte11['tgl_bukti'];
			$ket = $resulte11['ket'];
			$usernm = $resulte11['username'];
			$update = $resulte11['tgl_update'];
			$skpd = $resulte11['kd_skpd'];
			$nmskpd = $resulte11['nm_skpd'];
			$total = $resulte11['total'];

			// Simpan Header //
				$sql3 = " insert into trhju_pkd(no_voucher,tgl_voucher,ket,username,tgl_update,kd_skpd,nm_skpd,total_d,total_k,tabel) 
						  values('$nomor','$tgl','$ket','$usernm','$update','$skpd','$nmskpd','$total','$total','spjskpd')";
				$asg3 = $this->db->query($sql3);
	            
	            // Simpan Detail //  
	            $hasil=$this->db->query(" SELECT a.*,SUBSTR(kd_kegiatan,6,10) AS kd_skpd FROM trdtransout a where substr(a.kd_kegiatan,6,10)='$skpd' and a.no_bukti='$nomor' ");  
	                $kredit=0;	
					foreach ($hasil->result_array() as $row){
						$no	   =$row['no_bukti'];	
						$sp2d  =$row['no_sp2d'];	
						$kdgiat=$row['kd_kegiatan'];	
						$nmgiat=$row['nm_kegiatan'];	
						$kdrek5=$row['kd_rek5'];	
						$nmrek5=$row['nm_rek5'];	
						$nilai =$row['nilai'];
						$skpd =$row['kd_skpd'];	
		  			    $kredit=$kredit+$nilai;
	                    
	                    $kdrek4=$this->tukd_model->get_nama($kdrek5,'kd_rek4','ms_rek5','kd_rek5');
						$kdrek9=$this->tukd_model->get_nama($kdrek5,'map_lo','ms_rek5','kd_rek5');
						$nmrek9=$this->tukd_model->get_nama($kdrek9,'nm_rek5','ms_rek5','kd_rek5');
	                    $kdrek64=$this->tukd_model->get_nama($kdrek5,'kd_rek64','ms_rek5','kd_rek5');
						$nmrek64=$this->tukd_model->get_nama($kdrek64,'nm_rek64','ms_rek5','kd_rek64');
						$rek3=substr($kdrek5,0,3);
		  			    $rekutang=$this->tukd_model->get_nama($kdrek64,'piutang_utang','ms_rek5','kd_rek64');
						$nmrekutang=$this->tukd_model->get_nama($rekutang,'nm_rek5','ms_rek5','kd_rek5');
	                    if($kdrek4=='52201' || $kdrek4=='52201' ){
	                        $kdrek_p=$this->tukd_model->get_nama($kdrek5,'persed_kdp','ms_rek5','kd_rek5');
	                        $nmrek_p=$this->tukd_model->get_nama($kdrek_p,'nm_rek5','ms_rek5','kd_rek5');    
	                    }
							
					    //permen 64
					   	$this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
										 values('$no','$skpd','$kdgiat','$nmgiat','$kdrek9','$nmrek9',$nilai,'0','D','','1','1','spjskpd') ");       			

					   	$this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
										 values('$no','$skpd','$kdgiat','$nmgiat','$kdrek64','$nmrek64',$nilai,'0','D','','3','1','spjskpd') ");
					}            						
				       //permen 64            						       			
					   $this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
										 values('$no','$skpd','','','1110301','Kas di Bendahara Pengeluaran','0','$kredit','K','','2','1','spjskpd') ");		

					      			
					   $this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
										 values('$no','$skpd','','','0000000','Perubahan SAL','0','$kredit','K','','4','0','spjskpd') ");	        		
	    }    
		$area1	= explode(';',$sql11);
		foreach ($area1 as $line){
			if (substr($line,0,2)=='--'||$line=='')continue;
			$this->db->query($line);
		}
		return true;
	}

	function jurnal_trmpjk_skpd(){
		$sql11 = "select no_bukti, tgl_bukti, ket, username,'' as tgl_update, kd_skpd,nm_skpd, nilai as total from trhtrmpot ";
		$query11 = $this->db->query($sql11);
		foreach($query11->result_array() as $resulte11){
			$nomor = $resulte11['no_bukti'];
			$tgl = $resulte11['tgl_bukti'];
			$ket = $resulte11['ket'];
			$usernm = $resulte11['username'];
			$update = $resulte11['tgl_update'];
			$skpd = $resulte11['kd_skpd'];
			$nmskpd = $resulte11['nm_skpd'];
			$total = $resulte11['total'];

			// Simpan Header //
				$sql3 = " insert into trhju_pkd(no_voucher,tgl_voucher,ket,username,tgl_update,kd_skpd,nm_skpd,total_d,total_k,tabel) 
						  values('$nomor','$tgl','$ket','$usernm','$update','$skpd','$nmskpd','$total','$total','trmpjk')";
				$asg3 = $this->db->query($sql3);
	            
	            // Simpan Detail //  
	            $hasil=$this->db->query(" SELECT * FROM trdtrmpot where kd_skpd='$skpd' and no_bukti='$nomor' ");  
	                $kredit=0;	
					foreach ($hasil->result_array() as $row){
						$no	   =$row['no_bukti'];
						$kdrek5=$row['kd_rek5'];	
						$nmrek5=$row['nm_rek5'];	
						$nilai =$row['nilai'];
						$skpd =$row['kd_skpd'];	
		  			    $kredit=$kredit+$nilai;
	                    
	                    //permen 64
					   	$this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
										 values('$no','$skpd','','','$kdrek5','$nmrek5','0','$nilai','K','','1','1','trmpjk') ");  
					}            						
				       //permen 64            						       			
					   $this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
										 values('$no','$skpd','','','1110301','Kas di Bendahara Pengeluaran','$kredit','0','D','','2','1','trmpjk') ");		
		}

		$area1	= explode(';',$sql11);
		foreach ($area1 as $line){
			if (substr($line,0,2)=='--'||$line=='')continue;
			$this->db->query($line);
		}
		return true;
	}


	function jurnal_strpjk_skpd(){
		$sql11 = "select no_bukti, tgl_bukti, ket, username,'' as tgl_update, kd_skpd,nm_skpd, nilai as total from trhstrpot  ";
		$query11 = $this->db->query($sql11);
		foreach($query11->result_array() as $resulte11){
			$nomor = $resulte11['no_bukti'];
			$tgl = $resulte11['tgl_bukti'];
			$ket = $resulte11['ket'];
			$usernm = $resulte11['username'];
			$update = $resulte11['tgl_update'];
			$skpd = $resulte11['kd_skpd'];
			$nmskpd = $resulte11['nm_skpd'];
			$total = $resulte11['total'];

			// Simpan Header //
				$sql3 = " insert into trhju_pkd(no_voucher,tgl_voucher,ket,username,tgl_update,kd_skpd,nm_skpd,total_d,total_k,tabel) 
						  values('$nomor','$tgl','$ket','$usernm','$update','$skpd','$nmskpd','$total','$total','strpjk')";
				$asg3 = $this->db->query($sql3);
	            
	            // Simpan Detail //  
	            $hasil=$this->db->query(" SELECT * FROM trdstrpot where kd_skpd='$skpd' and no_bukti='$nomor' ");  
	                $kredit=0;	
					foreach ($hasil->result_array() as $row){
						$no	   =$row['no_bukti'];
						$kdrek5=$row['kd_rek5'];	
						$nmrek5=$row['nm_rek5'];	
						$nilai =$row['nilai'];
						$skpd =$row['kd_skpd'];	
		  			    $kredit=$kredit+$nilai;
	                    
	                    //permen 64
					   	$this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
										 values('$no','$skpd','','','$kdrek5','$nmrek5','$nilai','0','D','','1','1','strpjk') ");  
					}            						
				       //permen 64            						       			
					   $this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
										 values('$no','$skpd','','','1110301','Kas di Bendahara Pengeluaran','0','$kredit','K','','2','1','strpjk') ");		
		}

		$area1	= explode(';',$sql11);
		foreach ($area1 as $line){
			if (substr($line,0,2)=='--'||$line=='')continue;
			$this->db->query($line);
		}
		return true;
	}

	function jurnal_pend_skpd(){
		//Penerimaan Pendapatan
		$sql11 = "SELECT a.no_sts AS no_bukti,CONCAT(a.no_sts,'/TRM-PEND') AS no_bukti_copy,a.tgl_sts AS tgl_bukti,a.keterangan AS ket,'' AS username,'' AS tgl_update,a.kd_skpd,
				(SELECT nm_skpd FROM ms_Skpd WHERE kd_skpd=a.kd_Skpd) AS nm_skpd,SUM(b.rupiah) AS total FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_sts=b.no_sts
				WHERE LEFT(b.kd_rek5,2)='41'  GROUP BY a.no_sts";
		$query11 = $this->db->query($sql11);
		foreach($query11->result_array() as $resulte11){
			$nomor = $resulte11['no_bukti'];
			$no_bukti_copy = $resulte11['no_bukti_copy'];
			$tgl = $resulte11['tgl_bukti'];
			$ket = $resulte11['ket'];
			$usernm = $resulte11['username'];
			$update = $resulte11['tgl_update'];
			$skpd = $resulte11['kd_skpd'];
			$nmskpd = $resulte11['nm_skpd'];
			$total = $resulte11['total'];

			// Simpan Header //
				$sql3 = " insert into trhju_pkd(no_voucher,tgl_voucher,ket,username,tgl_update,kd_skpd,nm_skpd,total_d,total_k,tabel) 
						  values('$no_bukti_copy','$tgl','$ket','$usernm','$update','$skpd','$nmskpd','$total','$total','trmpend')";
				$asg3 = $this->db->query($sql3);
	            
	            // Simpan Detail //  
	            $hasil=$this->db->query("SELECT CONCAT(a.no_sts,'/TRM-PEND') AS no_bukti,a.kd_kegiatan,(SELECT nm_kegiatan FROM trskpd WHERE kd_kegiatan=a.kd_kegiatan) AS nm_kegiatan,
					a.kd_rek5,(SELECT nm_rek5 FROM ms_rek5 WHERE kd_rek5=a.kd_rek5) AS nm_rek5,a.rupiah AS nilai,a.kd_skpd   
					FROM trdkasin_ppkd a WHERE LEFT(a.kd_rek5,2)='41' and a.no_sts='$nomor'");  
	                $kredit=0;	
					foreach ($hasil->result_array() as $row){
						$no	   =$row['no_bukti'];	
						$kdgiat=$row['kd_kegiatan'];	
						$nmgiat=$row['nm_kegiatan'];	
						$kdrek5=$row['kd_rek5'];	
						$nmrek5=$row['nm_rek5'];	
						$nilai =$row['nilai'];
						$skpd =$row['kd_skpd'];	
		  			    $kredit=$kredit+$nilai;
	                    
	                    $nm_rekening = $this->tukd_model->get_nama($kdrek5,'nm_rek5','ms_rek5','kd_rek5');
			            $kd_rek64    = $this->tukd_model->get_nama($kdrek5,'kd_rek64','ms_rek5','kd_rek5');
			            $nmrek64     = $this->tukd_model->get_nama($kdrek5,'nm_rek64','ms_rek5','kd_rek5');
			            $kd_lo    = $this->tukd_model->get_nama($kdrek5,'map_lo','ms_rek5','kd_rek5');
			            $nmreklo    = $this->tukd_model->get_nama($kd_lo,'nm_rek5','ms_rek5','kd_rek5');
			            $rekutang = $this->tukd_model->get_nama($kdrek5,'piutang_utang','ms_rek5','kd_rek5');
			            $nmrekutang = $this->tukd_model->get_nama($rekutang,'nm_rek5','ms_rek5','kd_rek5');
							
					    //permen 64
					   	$sql2 = "insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
			            values('$no','$skpd','','','0000000','Perubahan SAL',$nilai,0,'D','','','','1','0','trmpend')";
			            $asg2 = $this->db->query($sql2);
			            $sql3 = "insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
			            values('$no','$skpd','$kdgiat','$nmgiat','$kd_rek64','$nmrek64',0,$nilai,'K','','','$kdrek5','2','1','trmpend')";
			            $asg3 = $this->db->query($sql3);

			            $sql4 = "insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
			            values('$no','$skpd','','','1110201','Kas di Bendahara Penerimaan',$nilai,0,'D','','','','3','1','trmpend')";
			            $asg4 = $this->db->query($sql4);
			            $sql5 = "insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
			            values('$no','$skpd','$kdgiat','$nmgiat','$kd_lo','$nmreklo',0,$nilai,'K','','','','4','1','trmpend')";
			            $asg5 = $this->db->query($sql5);
					} 
		}

		//Penyetoran Pendapatan
		$sql22 = "SELECT a.no_sts AS no_bukti,CONCAT(a.no_sts,'/STR-PEND') AS no_bukti_copy,a.tgl_sts AS tgl_bukti,a.keterangan AS ket,'' AS username,'' AS tgl_update,a.kd_skpd,
				(SELECT nm_skpd FROM ms_Skpd WHERE kd_skpd=a.kd_Skpd) AS nm_skpd,SUM(b.rupiah) AS total FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_sts=b.no_sts
				WHERE LEFT(b.kd_rek5,2)='41'  GROUP BY a.no_sts";
		$query22 = $this->db->query($sql22);
		foreach($query22->result_array() as $resulte22){
			$nomor2 = $resulte22['no_bukti'];
			$no_bukti_copy2 = $resulte22['no_bukti_copy'];
			$tgl2 = $resulte22['tgl_bukti'];
			$ket2 = $resulte22['ket'];
			$usernm2 = $resulte22['username'];
			$update2 = $resulte22['tgl_update'];
			$skpd2 = $resulte22['kd_skpd'];
			$nmskpd2 = $resulte22['nm_skpd'];
			$total2 = $resulte22['total'];

			// Simpan Header //
				$sql1 = "insert into trhju_pkd(no_voucher,tgl_voucher,kd_skpd,nm_skpd,ket,tgl_update,username,total_d,total_k,tabel) 
	            values('$no_bukti_copy2','$tgl2','$skpd2','$nmskpd2','$ket2','$update2','$usernm2',$total2,$total2,'strpend')";
	            $asg1 = $this->db->query($sql1);
	            
	            // Simpan Detail //  
	            $hasil2=$this->db->query("SELECT CONCAT(a.no_sts,'/STR-PEND') AS no_bukti,a.kd_kegiatan,(SELECT nm_kegiatan FROM trskpd WHERE kd_kegiatan=a.kd_kegiatan) AS nm_kegiatan,
					a.kd_rek5,(SELECT nm_rek5 FROM ms_rek5 WHERE kd_rek5=a.kd_rek5) AS nm_rek5,a.rupiah AS nilai,a.kd_skpd   
					FROM trdkasin_ppkd a WHERE LEFT(a.kd_rek5,2)='41' and a.no_sts='$nomor2'");  
	                $kredit2=0;	
					foreach ($hasil2->result_array() as $row2){
						$no2	   =$row2['no_bukti'];	
						$kdgiat2=$row2['kd_kegiatan'];	
						$nmgiat2=$row2['nm_kegiatan'];	
						$kdrek52=$row2['kd_rek5'];	
						$nmrek52=$row2['nm_rek5'];	
						$nilai2 =$row2['nilai'];
						$skpd2 =$row2['kd_skpd'];	
		  			    $kredit2=$kredit2+$nilai2;
							
					    //permen 64
					   	$sql22 = "insert into trdju_pkd(no_voucher,kd_skpd,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
					    values('$no2','$skpd2','3130101','RK PPKD',$nilai2,0,'D','','1','1','strpend')";
					    $asg22 = $this->db->query($sql22);
					    $sql33 = "insert into trdju_pkd(no_voucher,kd_skpd,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos,tabel) 
					    values('$no2','$skpd2','1110201','Kas di Bendahara Penerimaan',0,$nilai2,'K','','2','1','strpend')";
					    $asg33 = $this->db->query($sql33);
					} 
		}


		//Penerimaan Pendapatan BUD
		$sql33 = "SELECT a.no_sts AS no_bukti,CONCAT(a.no_sts,'/TRM-PEND-BUD') AS no_bukti_copy,a.tgl_sts AS tgl_bukti,a.keterangan AS ket,'' AS username,'' AS tgl_update,a.kd_skpd,
				(SELECT nm_skpd FROM ms_Skpd WHERE kd_skpd=a.kd_Skpd) AS nm_skpd,SUM(b.rupiah) AS total FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_sts=b.no_sts
				WHERE LEFT(b.kd_rek5,2)='41' GROUP BY a.no_sts";
		$query33 = $this->db->query($sql33);
		foreach($query33->result_array() as $resulte33){
			$nomor3 = $resulte33['no_bukti'];
			$no_bukti_copy3 = $resulte33['no_bukti_copy'];
			$tgl3 = $resulte33['tgl_bukti'];
			$ket3 = $resulte33['ket'];
			$usernm3 = $resulte33['username'];
			$update3 = $resulte33['tgl_update'];
			$skpd3 = $resulte33['kd_skpd'];
			$nmskpd3 = $resulte33['nm_skpd'];
			$total3 = $resulte33['total'];

			// Simpan Header //
				$sql1 = "insert into trhju_pkd(no_voucher,tgl_voucher,kd_skpd,nm_skpd,ket,tgl_update,username,total_d,total_k,tabel) 
				values('$no_bukti_copy3','$tgl3','$skpd3','$nmskpd3','$ket3','','$usernm3','$total3','$total3','trmpendbud')";
				$asg1 = $this->db->query($sql1);
	            
	            // Simpan Detail //  
	            $hasil3=$this->db->query("SELECT CONCAT(a.no_sts,'/TRM-PEND-BUD') AS no_bukti,a.kd_kegiatan,(SELECT nm_kegiatan FROM trskpd WHERE kd_kegiatan=a.kd_kegiatan) AS nm_kegiatan,
					a.kd_rek5,(SELECT nm_rek5 FROM ms_rek5 WHERE kd_rek5=a.kd_rek5) AS nm_rek5,a.rupiah AS nilai,a.kd_skpd   
					FROM trdkasin_ppkd a WHERE LEFT(a.kd_rek5,2)='41' and a.no_sts='$nomor3'");  
	                $kredit3=0;	
					foreach ($hasil3->result_array() as $row3){
						$no3	   =$row3['no_bukti'];	
						$kdgiat3=$row3['kd_kegiatan'];	
						$nmgiat3=$row3['nm_kegiatan'];	
						$kdrek53=$row3['kd_rek5'];	
						$nmrek53=$row3['nm_rek5'];	
						$nilai3 =$row3['nilai'];
						$skpd3 =$row3['kd_skpd'];	
		  			    $kredit3=$kredit3+$nilai3;
							
					    //permen 64
					  $this->db->query("insert trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
					  values('$no3','$skpd3','','','1110101','Kas di Kas Daerah','$nilai3',0,'D','4','','','1','1','trmpendbud') ");				
					  $this->db->query("insert trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
					  values('$no3','$skpd3','','','1180101','RK SKPD',0,'$nilai3','K','4','','','2','1','trmpendbud') ");  
					} 
		} 


		$area1	= explode(';',$sql11);
		foreach ($area1 as $line){
			if (substr($line,0,2)=='--'||$line=='')continue;
			$this->db->query($line);
		}
		return true;
	}

	function jurnal_pend_bud(){
		//Penerimaan Pendapatan PPKD
		$sql11 = "SELECT a.no_sts AS no_bukti,CONCAT(a.no_sts,'/PEND/PPKD') AS no_bukti_copy,a.tgl_sts AS tgl_bukti,a.keterangan AS ket,'' AS username,'' AS tgl_update,a.kd_skpd,
			(SELECT nm_skpd FROM ms_Skpd WHERE kd_skpd=a.kd_Skpd) AS nm_skpd,SUM(b.rupiah) AS total FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_sts=b.no_sts
			WHERE LEFT(b.kd_rek5,2)<>'41'  GROUP BY a.no_sts ORDER BY a.no_sts";
		$query11 = $this->db->query($sql11);
		foreach($query11->result_array() as $resulte11){
			$nomor = $resulte11['no_bukti'];
			$no_bukti_copy = $resulte11['no_bukti_copy'];
			$tgl = $resulte11['tgl_bukti'];
			$ket = $resulte11['ket'];
			$usernm = $resulte11['username'];
			$update = $resulte11['tgl_update'];
			$skpd = $resulte11['kd_skpd'];
			$nmskpd = $resulte11['nm_skpd'];
			$total = $resulte11['total'];

			// Simpan Header //
				$sql3 = " insert into trhju_pkd(no_voucher,tgl_voucher,ket,username,tgl_update,kd_skpd,nm_skpd,total_d,total_k,tabel) 
						  values('$no_bukti_copy','$tgl','$ket','$usernm','$update','$skpd','$nmskpd','$total','$total','trmppkd')";
				$asg3 = $this->db->query($sql3);
	            
	            // Simpan Detail //  
	            $hasil=$this->db->query("SELECT CONCAT(a.no_sts,'/PEND/PPKD') AS no_bukti,a.kd_kegiatan,(SELECT nm_kegiatan FROM trskpd WHERE kd_kegiatan=a.kd_kegiatan) AS nm_kegiatan,
					a.kd_rek5,(SELECT map_lo FROM ms_rek5 WHERE kd_rek5=a.kd_rek5) AS kd_rek_lo,(SELECT nm_rek5 FROM ms_rek5 WHERE kd_rek5=a.kd_rek5) AS nm_rek5,a.rupiah AS nilai,a.kd_skpd   
					FROM trdkasin_ppkd a WHERE LEFT(a.kd_rek5,2)<>'41' and a.no_sts='$nomor' ");  
	                $kredit=0;	
					foreach ($hasil->result_array() as $row){
						$no	   =$row['no_bukti'];	
						$kegiatan=$row['kd_kegiatan'];	
						$nmkeg=$row['nm_kegiatan'];	
						$kd_rek_lo=$row['kd_rek_lo'];
						$kd_rek5=$row['kd_rek5'];	
						$nmrek5=$row['nm_rek5'];	
						$lnil_rek =$row['nilai'];
						$skpd =$row['kd_skpd'];	
		  			    $kredit=$kredit+$lnil_rek;
	                    
	                    $tes_toh    = $this->tukd_model->get_nama($kd_rek_lo,'kd_rek64','ms_rek5','kd_rek5');
				        $nmskpd     = $this->tukd_model->get_nama($skpd,'nm_skpd','ms_skpd','kd_skpd');
				        $nmkeg      = $this->tukd_model->get_nama($kegiatan,'nm_kegiatan','trskpd','kd_kegiatan');
				        $nmrek_lo   = $this->tukd_model->get_nama($kd_rek5,'nm_rek5','ms_rek5','kd_rek5');
				        $nmrek      = $this->tukd_model->get_nama($kd_rek_lo,'nm_rek5','ms_rek5','kd_rek5');
				        $kd_rek64   = $this->tukd_model->get_nama($kd_rek5,'kd_rek64','ms_rek5','kd_rek5');
				        $nmrek64    = $this->tukd_model->get_nama($kd_rek5,'nm_rek64','ms_rek5','kd_rek5');
				        $kdrek_p    = $this->tukd_model->get_nama($kd_rek_lo,'piutang_utang','ms_rek5','kd_rek5');
				        $nmrek_p    = $this->tukd_model->get_nama($kdrek_p,'nm_rek5','ms_rek5','kd_rek5'); 
							
					    //permen 64						
			            $sql11 = $this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
			            values('$no','$skpd','','','1110101','Kas di Kas Daerah','$lnil_rek',0,'D','4','','','1','1','trmppkd')");
			            $sql12 = $this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
			            values('$no','$skpd','','','$kd_rek64','$nmrek64',0,'$lnil_rek','K','4','','','2','1','trmppkd')");
			            $sql13 = $this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
			            values('$no','$skpd','','','0000000','Perubahan SAL','$lnil_rek',0,'D','4','','','3','1','trmppkd')");
			            $sql14 = $this->db->query("insert into trdju_pkd(no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,kd_unit,map_real,urut,pos,tabel) 
			            values('$no','$skpd','$kegiatan','$nmkeg','$tes_toh','$nmrek',0,'$lnil_rek','K','4','','$kd_rek_lo','4','1','trmppkd')");
					} 
		}

		//$area1	= explode(';',$sql11);
		//foreach ($area1 as $line){
		//	if (substr($line,0,2)=='--'||$line=='')continue;
		//	$this->db->query($line);
		//}
		return true;
	}




}
