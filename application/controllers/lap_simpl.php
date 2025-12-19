

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//bayem
class Lap_simpl extends CI_Controller {
        
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
    
   function  tanggal_indonesia2($tgl)//>>tidak dipakai bayem
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
	
	function ambil_mhorganisasi(){
		$skpd = $this->session->userdata('skpd');
        $csql = " select * from mhorganisasi where kode='$skpd'";
        $query1 = $this->db->query($csql);  
        foreach($query1->result_array() as $resulte)
        { 
            $resulte = array(   
			'kode' 				=> $resulte['kode'],
			'nama' 				=> $resulte['nama'],
			'nama_skpd' 		=> $resulte['nama_skpd'],
			'jabatan_skpd' 		=> $resulte['jabatan_skpd'],
			'pangkat_skpd' 		=> $resulte['pangkat_skpd'],
			'nip_skpd' 			=> $resulte['nip_skpd'],
			'nama_ppk' 			=> $resulte['nama_ppk'],
			'jabatan_ppk' 		=> $resulte['jabatan_ppk'],
			'pangkat_ppk' 		=> $resulte['pangkat_ppk'],
			'nip_ppk' 			=> $resulte['nip_ppk'],
			'nama_bendout' 		=> $resulte['nama_bendout'],
			'jabatan_bendout' 	=> $resulte['jabatan_bendout'],
			'pangkat_bendout' 	=> $resulte['pangkat_bendout'],
			'nip_bendout' 		=> $resulte['nip_bendout'],
			'nama_bendin' 		=> $resulte['nama_bendin'],
			'jabatan_bendin' 	=> $resulte['jabatan_bendin'],
			'pangkat_bendin' 	=> $resulte['pangkat_bendin'],
			'nip_bendin' 		=> $resulte['nip_bendin'],
			'nama_ppb' 			=> $resulte['nama_ppb'],
			'jabatan_ppb' 		=> $resulte['jabatan_ppb'],
			'pangkat_ppb' 		=> $resulte['pangkat_ppb'],
			'nip_ppb' 			=> $resulte['nip_ppb'],
			'no_sk' 			=> $resulte['no_sk'],
			'tgl_sk' 			=> $resulte['tgl_sk'],
			'singkatan' 		=> $resulte['singkatan'],
			'alamat' 			=> $resulte['alamat'],
			'bank' 				=> $resulte['bank'],
			'rekening' 			=> $resulte['rekening'],
			'npwp' 				=> $resulte['npwp'],
			'bagian' 			=> $resulte['bagian']                                                                      					
                         );
        }
       $query1->free_result(); 
	   return $resulte;        	
	}
	
	

	
function lap_rencana_anggaran (){

		$thn  = $this->session->userdata('ta_simbakda');
		if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$total_baris = $_REQUEST['total_baris'];
        $konfig=$this->ambil_config();
        $logo = $konfig['logo'];
        //$pekerjaan = $_REQUEST['pekerjaan'];
        $kode = $_REQUEST['kode'];
		//$nama = $_REQUEST['nama'];
		//$jabatan_skpd = $_REQUEST['jabatan_skpd'];
		//$pangkat_skpd = $_REQUEST['pangkat_skpd'];
		//$nip_skpd = $_REQUEST['nip_skpd'];
		//$nama_bendout = $_REQUEST['nama_bendout'];
		//$jabatan_bendout = $_REQUEST['jabatan_bendout'];
		//$pangkat_bendout = $_REQUEST['pangkat_bendout'];
		//$nip_bendout = $_REQUEST['nip_bendout'];
		//$nama_ppb = $_REQUEST['nama_ppb'];
		//$jabatan_ppb = $_REQUEST['jabatan_ppb'];
		//$pangkat_ppb = $_REQUEST['pangkat_ppb'];
		//$nip_ppb = $_REQUEST['nip_ppb'];
		//$bagian = $_REQUEST['bagian'];
		//$alamat = $_REQUEST['alamat'];
		//$bank = $_REQUEST['bank'];
		//$rekening = $_REQUEST['rekening'];
		//$npwp = $_REQUEST['npwp'];
		$ctk = $_REQUEST['ctk'];
		//$nama_ppb = $_REQUEST['nama'];
		$csql = "SELECT * from plh_form_isian where no_transaksi='$kode'";
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row)
		$asql ="SELECT * from mpejabat where kode='02'";
						$hasila = $this->db->query($asql);
							$i = 0;
						foreach ($hasila->result() as $rowa)
		$bsql ="SELECT * from mpejabat where kode='04'";
						$hasilb = $this->db->query($bsql);
							$i = 0;
						foreach ($hasilb->result() as $rowb)
		$esql ="SELECT * from mpejabat where kode='11'";
						$hasile = $this->db->query($esql);
							$i = 0;
						foreach ($hasile->result() as $rowe)
						
        $cRet  = '';
if($ctk=='1'){
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$iduser			= $this->session->userdata('iduser');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
        $logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
		$ckeg           = "SELECT a.bagian FROM m_kegiatan a INNER JOIN plh_form_isian b ON b.kegiatan=a.kode WHERE b.no_transaksi='$no' AND b.kd_uskpd='$skpd'";
		$hasilkeg = $this->db->query($ckeg);
						$i = 0;
					foreach ($hasilkeg->result() as $rowkeg)
					
		$ckeg1 = $rowkeg->bagian;
		
		if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00' or $skpd=='1.03.01.00'){
			if($ckeg1<>''){
						/* 	$csql 		= "SELECT a.kd_uskpd,a.kegiatan,
										CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
										a.nm_kegiatan,a.keterangan,a.rekanan,
										(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
										(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
										(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat,
										(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
										(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
										(SELECT ifnull(tgl_rab,0) as tgl_rab FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_rab,
										(SELECT ifnull(nama,0) as nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS staf_penerima,
										(SELECT ifnull(jabatan,0) as jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS jabatan_penerima,
										(SELECT ifnull(nama_singkat,0) as nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nama_singkat_penerima, 
										(SELECT ifnull(pangkat,0) as pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS pangkat_penerima,
										(SELECT ifnull(nip,0) as nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nip_penerima,
										(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS ketua, 
										(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS jabatan_ketua,
										(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nama_singkat_ketua, 
										(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS pangkat_ketua,
										(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nip_ketua,
										(SELECT SUM(jumlah) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
										FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'"; */
										$csql="SELECT a.kd_uskpd,a.kegiatan,CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
												a.nm_kegiatan,a.keterangan,a.rekanan,b.nama,b.jabatan,b.nama_singkat,b.pangkat,b.nip,IFNULL(c.tgl_rab,0) AS tgl_rab,d.nama AS staf_penerima,d.jabatan AS jabatan_penerima,
												d.nama_singkat AS nama_singkat_penerima,d.pangkat AS pangkat_penerima,d.nip AS nip_penerima,
												(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' AND b.kd_skpd=a.kd_uskpd) AS ketua, 
												(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' AND b.kd_skpd=a.kd_uskpd) AS jabatan_ketua,
												(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' AND b.kd_skpd=a.kd_uskpd) AS nama_singkat_ketua, 
												(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' AND b.kd_skpd=a.kd_uskpd) AS pangkat_ketua,
												(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' AND b.kd_skpd=a.kd_uskpd) AS nip_ketua
												,(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KTU' AND b.kd_skpd=a.kd_uskpd) AS ketua_ktu, 
												(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KTU' AND b.kd_skpd=a.kd_uskpd) AS jabatan_ktu,
												(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KTU' AND b.kd_skpd=a.kd_uskpd) AS singkat_ktu, 
												(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KTU' AND b.kd_skpd=a.kd_uskpd) AS pangkat_ktu,
												(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KTU' AND b.kd_skpd=a.kd_uskpd) AS nip_ktu,
												SUM(f.jumlah) AS tot
												FROM plh_form_isian a 
												LEFT JOIN mpejabat b ON a.pptk=b.kode AND a.kd_uskpd=b.kd_skpd
												LEFT JOIN pl_lengkap c ON c.no_transaksi=a.no_transaksi AND c.kd_skpd=a.kd_uskpd
												LEFT JOIN mpejabat d ON a.kd_uskpd=d.kd_skpd AND d.kode=a.anggota_satu
												LEFT JOIN pld_form_isian f ON f.no_transaksi=a.no_transaksi AND f.unit_skpd=a.kd_uskpd
												WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'"; 
					}
					else {
						/* 	$csql = "SELECT a.kd_uskpd,a.kegiatan,
										 CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
										 a.nm_kegiatan,a.keterangan,a.rekanan,
										(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
										(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
										(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat,
										(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
										(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
										(SELECT ifnull(tgl_rab,00) as tgl_rab FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_rab,
										(SELECT ifnull(nama,0) as nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS staf_penerima,
										(SELECT ifnull(jabatan,0) as jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS jabatan_penerima,
										(SELECT ifnull(nama_singkat,0) as nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nama_singkat_penerima, 
										(SELECT ifnull(pangkat,0) as pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS pangkat_penerima,
										(SELECT ifnull(nip,0) as nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nip_penerima,
										(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
										(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua,
										(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua, 
										(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua,
										(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua,
										(SELECT SUM(jumlah) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
										FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'"; */
										$csql="SELECT a.kd_uskpd,a.kegiatan,CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
												a.nm_kegiatan,a.keterangan,a.rekanan,b.nama,b.jabatan,b.nama_singkat,b.pangkat,b.nip,IFNULL(c.tgl_rab,0) AS tgl_rab,d.nama AS staf_penerima,d.jabatan AS jabatan_penerima,
												d.nama_singkat AS nama_singkat_penerima,d.pangkat AS pangkat_penerima,d.nip AS nip_penerima,e.nama AS ketua, 
												e.jabatan AS jabatan_ketua,e.nama_singkat AS nama_singkat_ketua, e.pangkat AS pangkat_ketua,
												e.nip AS nip_ketua,SUM(f.jumlah) AS tot
												FROM plh_form_isian a 
												LEFT JOIN mpejabat b ON a.pptk=b.kode AND a.kd_uskpd=b.kd_skpd
												LEFT JOIN pl_lengkap c ON c.no_transaksi=a.no_transaksi AND c.kd_skpd=a.kd_uskpd
												LEFT JOIN mpejabat d ON a.kd_uskpd=d.kd_skpd AND d.kode=a.anggota_satu
												LEFT JOIN mpejabat e ON a.kd_uskpd=e.kd_skpd AND e.singkat='PA'
												LEFT JOIN pld_form_isian f ON f.no_transaksi=a.no_transaksi AND f.unit_skpd=a.kd_uskpd
												WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
					}
         }  else {
							/* $csql		= "SELECT a.kd_uskpd,a.kegiatan,
								CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
								a.nm_kegiatan,a.keterangan,a.rekanan,
								(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
								(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
								(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat,
								(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
								(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
								(SELECT ifnull(tgl_rab,0) as tgl_rab FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_rab,
								(SELECT ifnull(nama,0) as nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS staf_penerima,
								(SELECT ifnull(jabatan,0) as jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS jabatan_penerima,
								(SELECT ifnull(nama_singkat,0) as nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nama_singkat_penerima, 
								(SELECT ifnull(pangkat,0) as pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS pangkat_penerima,
								(SELECT ifnull(nip,0) as nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nip_penerima,
								(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
								(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua,
								(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua, 
								(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua,
								(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua,
								(SELECT SUM(jumlah) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
								FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
			*/	
											$csql="SELECT a.kd_uskpd,a.kegiatan,CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
												a.nm_kegiatan,a.keterangan,a.rekanan,b.nama,b.jabatan,b.nama_singkat,b.pangkat,b.nip,IFNULL(c.tgl_rab,0) AS tgl_rab,d.nama AS staf_penerima,d.jabatan AS jabatan_penerima,
												d.nama_singkat AS nama_singkat_penerima,d.pangkat AS pangkat_penerima,d.nip AS nip_penerima,e.nama AS ketua, 
												e.jabatan AS jabatan_ketua,e.nama_singkat AS nama_singkat_ketua, e.pangkat AS pangkat_ketua,
												e.nip AS nip_ketua,SUM(f.jumlah) AS tot
												FROM plh_form_isian a 
												LEFT JOIN mpejabat b ON a.pptk=b.kode AND a.kd_uskpd=b.kd_skpd
												LEFT JOIN pl_lengkap c ON c.no_transaksi=a.no_transaksi AND c.kd_skpd=a.kd_uskpd
												LEFT JOIN mpejabat d ON a.kd_uskpd=d.kd_skpd AND d.kode=a.anggota_satu
												LEFT JOIN mpejabat e ON a.kd_uskpd=e.kd_skpd AND e.singkat='PA'
												LEFT JOIN pld_form_isian f ON f.no_transaksi=a.no_transaksi AND f.unit_skpd=a.kd_uskpd
												WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";			
		 }
		 /****NAMA DAN KODEREK***/
		 $csqlku="SELECT
a.kode,a.nama,
CONCAT(SUBSTR(b.kodegiat,1,1),'.',SUBSTR(b.kodegiat,2,2),'.',SUBSTR(b.kodegiat,4,2),'.',SUBSTR(b.kodegiat,6,2),'.',SUBSTR(b.kodegiat,8,2),'.',SUBSTR(b.kode,1,1),'.',SUBSTR(b.kode,2,1),'.',SUBSTR(b.kode,3,1),'.',SUBSTR(b.kode,4,2),'.',SUBSTR(b.kode,6,2)) AS rekening
FROM m_rekening a
LEFT JOIN pld_form_isian b ON a.kode=b.kode 
WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
							$hasil = $this->db->query($csqlku);
							$namax="";
							$kodex="";
							foreach ($hasil->result() as $rowkode){
								$nom 	 = $rowkode->kode;
								$gabung  = $rowkode->nama;
								$namarek = $rowkode->rekening;
								if($gabung==1){
								$namax	= ($gabung);
								}else{
								$namax	= ($gabung.",".$namax);
								}
								if($namarek==1){
								$kodex	= ($namarek);
								}else{
								$kodex	= ($namarek.",".$kodex);
								}
								}
		 
		 //$keterangan
	   $hasil = $this->db->query($csql);
	   $i 	  = 0;
	   foreach ($hasil->result() as $rowi){
	   $cRet  = '';
	   $keterangan = $rowi->keterangan;
	   $nm_kegiatan= $rowi->nm_kegiatan;
	   $kegiatan   = $rowi->kodegiat;
	   $jumlahtot  = $rowi->tot;
	   $ctgl	   = $rowi->tgl_rab;
	   $ctanggal=$this->tanggal_indonesia($ctgl); 
	 
	   
          $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">

                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\"><b>PEMERINTAH KOTA $kota2</b></td>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:14px;\" align=\"center\">
                                <b><u>RENCANA ANGGARAN BIAYA</u></b>
                                <br>&nbsp;
                            </td>
                        </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Pekerjaan
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$namax
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Kegiatan
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$nm_kegiatan
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Tahun Anggaran
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$thn
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Kode Rekening 
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$kegiatan
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Sumber Dana
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">APBD Kota Makassar Tahun Anggaran $thn
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>";//}
                         $cRet .="<tr>
                           <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                                    <tr>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>NO</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>URAIAN</b></td>
                                        <td bgcolor=\"#CCCCCC\"  align=\"center\" style=\"font-size:13px;\"><b>SATUAN</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>KUANTITAS</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>HARGA SATUAN (Rp)</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>JUMLAH (Rp)</b></td>
                                    </tr>
									<tr>
                                        <td align=\"center\" style=\"font-size:13px;\">1</td>
                                        <td align=\"center\" style=\"font-size:13px;\">2</td>
                                        <td align=\"center\" style=\"font-size:13px;\">3</td>
                                        <td align=\"center\" style=\"font-size:13px;\">4</td>
                                        <td align=\"center\" style=\"font-size:13px;\">5</td>
                                        <td align=\"center\" style=\"font-size:13px;\">6=5x4</td>
                                    </tr>";
							  //$sql="select no_transaksi,kd_uskpd,nm_kegiatan from plh_form_isian where no_transaksi='$no' and kd_uskpd='$skpd'";
							  $sql="SELECT a.kode,a.nama,b.no_transaksi,b.unit_skpd,CONCAT(b.kode,b.no) AS rekening,sum(b.jumlah) as jml1,ifnull(sum(c.jumlah),0) as jml2
							  FROM m_rekening a 
							  LEFT JOIN pld_form_isian b ON a.kode=b.kode 
							  left join pld_form_rincian c on b.no_transaksi=c.no_transaksi and b.kode=c.kode and b.kodegiat=c.kodegiat and b.unit_skpd=c.kd_skpd and b.tahun=c.tahun
							  WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
							  $hsql=$this->db->query($sql);
								$jumlahxa  = 0;
								$jumlahxz = 0;
								
							//(SELECT SUM(jumlah) FROM pld_form_isian WHERE unit_skpd='$skpd' AND no_transaksi='$no') AS jml1, 
							//(SELECT SUM(jumlah) FROM pld_form_rincian WHERE kd_skpd='$skpd' AND no_transaksi='$no') AS jml2 
							  foreach ($hsql->result() as $row)
								{
									$i++; 
									$no_trans   =$row->no_transaksi;
									$nmkegiatan =$row->nama;
									$kd_skpd    =$row->unit_skpd;
									$ckoderek   =$row->kode;
									$jml   		=$row->jml1+$row->jml2;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\">$i</td>
                                        <td align=\"left\" style=\"font-size:13px;\"><b>$nmkegiatan</b></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                    </tr>";
                                    
                              //$csql = "SELECT b.uraian,b.satuan,b.vol,b.harga,b.jumlah,a.total as jumlahxxx FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' and b.unit_skpd='$kd_skpd' group by kode";
							  //$csql = "SELECT CONCAT(b.kode,b.no) AS rekening,b.uraian,b.satuan,b.vol,b.harga,b.jumlah FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' AND b.unit_skpd='$kd_skpd' and GROUP BY rekening  ORDER BY rekening";
							 $csql = "SELECT * FROM (
									   SELECT CONCAT(kode,NO) AS rekening,no_transaksi,kode,kodegiat,no,unit_skpd,tahun,uraian,satuan,vol,ifnull((harga),0) 
									   as harga,ifnull((jumlah),0) as jumlah FROM pld_form_isian 
									   WHERE no_transaksi='$no_trans' AND unit_skpd='$kd_skpd')a WHERE LEFT(rekening,7)=$ckoderek  ORDER BY kode,no"; 
								/* $csql = "SELECT CONCAT(kode,NO) AS rekening,no_transaksi,kode,kodegiat,no,unit_skpd,tahun,uraian,satuan,vol,IFNULL(harga,0) AS harga,IFNULL(jumlah,0) AS jumlah FROM pld_form_isian 
								WHERE no_transaksi='$no_trans' AND unit_skpd='$kd_skpd' and kode='$ckoderek' ORDER BY rekening"; */
							  $hasil = $this->db->query($csql);
								foreach ($hasil->result() as $row)
								{
									$no_transaksi  	=$row->no_transaksi;
									$unit_skpd 		=$row->unit_skpd;
									$kode 			=$row->kode;
									$kodegiat		=$row->kodegiat;
									$no				=$row->no;
									$tahun			=$row->tahun;
									$uraian			=$row->uraian;
									$jumlahxxs  	=$row->jumlah;
									$jumlahxa 		=$jumlahxa+$jumlahxxs;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">$row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol==0){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}
										if($row->harga==0){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>";}
										if($row->jumlah==0){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";}
                                    $cRet .="</tr>";
										
								$csq2 = "SELECT CONCAT(a.kode,a.NO) AS rekening,a.uraian,a.satuan,a.vol,a.harga,a.jumlah FROM pld_form_rincian a 
										INNER JOIN pld_form_isian b ON a.`no_transaksi`=b.`no_transaksi` AND a.`kode`=a.`kode` AND a.`kodegiat`=b.`kodegiat`
										AND a.`no`=a.`no` AND a.`uraian_header`=b.`uraian` AND a.`tahun`=b.`tahun`
									    WHERE b.no_transaksi='$no_transaksi' AND b.unit_skpd='$unit_skpd' 
										and b.kode='$kode' and b.kodegiat='$kodegiat' and b.no='$no' and b.uraian='$uraian' and b.tahun='$tahun' ORDER BY a.kode,a.no,a.no_urut";
								$hasi2 = $this->db->query($csq2);
								
								foreach ($hasi2->result() as $row)
								{
									$jumlahxxd  =$row->jumlah;
									$jumlahxz =$jumlahxz+$jumlahxxd;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">- $row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol==0){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}
										if($row->harga==0){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>";}
										if($row->jumlah==0){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";}
                                    $cRet .="</tr>";
                                    }
                                }	
							}
							if($unit_skpd=='1.18.01.00' && $kegiatan=='1.18.01.12.03'){
							  $tott = $jumlahxa+$jumlahxz;
							  $ppn	= (($tott*10)/100);
							  $totppn = $tott+$ppn;
                              $cRet .="<tr>
                                        <td align=\"right\" colspan=\"5\" style=\"font-size:13px;\"><b>TOTAL</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr>
									<tr>
                                        <td align=\"right\" colspan=\"5\" style=\"font-size:13px;\"><b>PPN 10%</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($ppn)."</b></td>
                                    </tr>
									<tr>
                                        <td align=\"right\" colspan=\"5\" style=\"font-size:13px;\"><b>JUMLAH TOTAL</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format(round($tott+$ppn))."</b></td>
                                    </tr>
                                </table>";
								
								}else{
							  $tott = $jumlahxa+$jumlahxz;
                              $cRet .="<tr>
                                        <td align=\"center\" colspan=\"5\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr>
                                </table>";
								
								}
                  $cRet .="</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				  <table border=\"0\" width=\"100%\" style=\"font-size:13px;\">";
				if($unit_skpd=='1.18.01.00' && $kegiatan=='1.18.01.12.03'){
                   $cRet .="<tr><td width=\"5%\"></td><td align=\"left\" colspan=\"3\"><b>Terbilang : ".$this->mdata2->terbilang(round($tott+$ppn))." Rupiah</b></td></tr>";}else{
                   $cRet .="<tr><td width=\"5%\"></td><td align=\"left\" colspan=\"3\"><b>Terbilang : ".$this->mdata2->terbilang($tott)." Rupiah</b></td></tr>";}
				   $cRet .="<tr><td width=\"5%\"></td><td align=\"left\" colspan=\"3\"><i>Harga Telah Termasuk Kewajiban Pajak</i></td></tr>
				  </table><br/><br/>
				  <table border=\"0\" width=\"94%\" style=\"font-size:12px;\">
                       <tr>
                            <td colspan=\"2\" align=\"right\">
								Makassar, $ctanggal
                            </td>
                       </tr> 
                  </table>
                <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr>";
											if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00'){
											$cRet.="<td></td>
                                            <td align=\"center\">Mengetahui<br>
                                            <b>$rowi->jabatan_ketua</b><br>Selaku Pejabat Pembuat Komitmen<br><br><br><br><br>
                                            <b><u>$rowi->ketua</u></b><br>Pangkat: $rowi->pangkat_ketua<br>Nip. $rowi->nip_ketua
                                            </td>";}
											elseif($skpd=='1.03.01.00'){
											$cRet.="<td></td>
                                            <td align=\"center\">Mengetahui<br>
                                            <b>$rowi->jabatan_ketua</b><br>Selaku Kuasa Pengguna Anggaran<br><br><br><br><br>
                                            <b><u>$rowi->ketua</u></b><br>Pangkat: $rowi->pangkat_ketua<br>Nip. $rowi->nip_ketua
                                            </td>";}
											else{
											$cRet.="<td></td>
                                            <td align=\"center\">Mengetahui<br>
                                            <b>$rowi->jabatan_ketua</b><br>Selaku $rowi->nama_singkat_ketua<br><br><br><br><br>
                                            <b><u>$rowi->ketua</u></b><br>Pangkat: $rowi->pangkat_ketua<br>Nip. $rowi->nip_ketua
                                            </td>";}
                                       $cRet.="</tr>
                                    </table>
                                </td>
                                <td width=\"10%\">
                                </td>
                                <td width=\"60%\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">";
                                        if($skpd=='1.02.01.00' && $iduser=='842'){
										$cRet.="<tr>
                                            <td></td>
                                            <td align=\"center\"><br><b>$rowi->jabatan_ktu</b><br>
                                            <b>$nama</b><br>SELAKU $rowi->singkat_ktu<br><br><br><br>
                                            <b><u>$rowi->ketua_ktu</br></u></b>Pangkat: $rowi->pangkat_ktu<br>Nip. $rowi->nip_ktu
                                            </td>
                                        </tr>";
										}else{$cRet.="<tr>
                                            <td></td>
                                            <td align=\"center\"><br><b>$rowi->jabatan</b><br>
                                            <b>$nama</b><br>SELAKU $rowi->nama_singkat<br><br><br><br>
                                            <b><u>$rowi->nama</br></u></b>Pangkat: $rowi->pangkat<br>Nip. $rowi->nip
                                            </td>
                                        </tr>";} 
                                    $cRet.="</table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                </table>";
        }
         echo $cRet;
		 }    
	
	 if($ctk=='2')
		{
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
		$ckeg           = "SELECT a.bagian FROM m_kegiatan a INNER JOIN plh_form_isian b ON b.kegiatan=a.kode WHERE b.no_transaksi='$no' AND b.kd_uskpd='$skpd'";
		$hasilkeg = $this->db->query($ckeg);
						$i = 0;
					foreach ($hasilkeg->result() as $rowkeg)
					
		$ckeg1 = $rowkeg->bagian;
		
		if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00' or $skpd=='1.03.01.00'){
			if($ckeg1<>''){
							$csql 		= "SELECT a.kd_uskpd,a.kegiatan,
										CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
										a.nm_kegiatan,a.keterangan,a.rekanan,
										(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
										(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
										(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat,
										(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
										(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
										(SELECT ifnull(tgl_hps,0) as tgl_hps FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_rab,
										(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS staf_penerima,
										(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS jabatan_penerima,
										(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nama_singkat_penerima, 
										(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS pangkat_penerima,
										(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nip_penerima,
										(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS ketua, 
										(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS jabatan_ketua,
										(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nama_singkat_ketua, 
										(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS pangkat_ketua,
										(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nip_ketua,
										(SELECT SUM(jml_hps) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
										FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
					} else {
							$csql 		= "SELECT a.kd_uskpd,a.kegiatan,
										CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
										a.nm_kegiatan,a.keterangan,a.rekanan,
										(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
										(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
										(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat,
										(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
										(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
										(SELECT ifnull(tgl_hps,0) as tgl_hps FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_rab,
										(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='P_ADA') AS staf_penerima,
										(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='P_ADA') AS jabatan_penerima,
										(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='P_ADA') AS nama_singkat_penerima, 
										(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='P_ADA') AS pangkat_penerima,
										(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='P_ADA') AS nip_penerima,
										(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
										(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua,
										(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua, 
										(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua,
										(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua,
										(SELECT SUM(jml_hps) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
										FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
					} 
				} else {
							$csql 		= "SELECT a.kd_uskpd,a.kegiatan,
										CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
										a.nm_kegiatan,a.keterangan,a.rekanan,
										(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
										(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
										(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat,
										(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
										(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
										(SELECT ifnull(tgl_hps,0) as tgl_hps FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_rab,
										(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='P_ADA') AS staf_penerima,
										(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='P_ADA') AS jabatan_penerima,
										(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='P_ADA') AS nama_singkat_penerima, 
										(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='P_ADA') AS pangkat_penerima,
										(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='P_ADA') AS nip_penerima,
										(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
										(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua,
										(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua, 
										(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua,
										(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua,
										(SELECT SUM(jml_hps) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
										FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
					
                 }      
	   $hasil = $this->db->query($csql);
	   $i 	  = 0;
	   foreach ($hasil->result() as $rowi){
	   $cRet  = '';
	   $keterangan = $rowi->keterangan;
	   $nm_kegiatan= $rowi->nm_kegiatan;
	   $kegiatan   = $rowi->kodegiat;
	   $ctgl       = $rowi->tgl_rab;
	   $jumlahtot  = $rowi->tot;
	   $ctanggal=$this->tanggal_indonesia($ctgl); 
	   
	   	 /****NAMA DAN KODEREK***/
		 $csqlku="SELECT
a.kode,a.nama,
CONCAT(SUBSTR(b.kodegiat,1,1),'.',SUBSTR(b.kodegiat,2,2),'.',SUBSTR(b.kodegiat,4,2),'.',SUBSTR(b.kodegiat,6,2),'.',SUBSTR(b.kodegiat,8,2),'.',SUBSTR(b.kode,1,1),'.',SUBSTR(b.kode,2,1),'.',SUBSTR(b.kode,3,1),'.',SUBSTR(b.kode,4,2),'.',SUBSTR(b.kode,6,2)) AS rekening
FROM m_rekening a
LEFT JOIN pld_form_isian b ON a.kode=b.kode 
WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
							$hasil = $this->db->query($csqlku);
							$namax="";
							$kodex="";
							foreach ($hasil->result() as $rowkode){
								$nom 	 = $rowkode->kode;
								$gabung  = $rowkode->nama;
								$namarek = $rowkode->rekening;
								if($gabung==1){
								$namax	= ($gabung);
								}else{
								$namax	= ($gabung.",".$namax);
								}
								if($namarek==1){
								$kodex	= ($namarek);
								}else{
								$kodex	= ($namarek.",".$kodex);
								}
								}
	   
          $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">

                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                        <tr><td></td>
                            <td colspan=\"2\" style=\"font-size:14px;\" align=\"center\">
                                <b><u>HARGA PERKIRAAN SENDIRI</u></b>
                                <br>&nbsp;
                            </td>
                        </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Pekerjaan
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$namax
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Kegiatan
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$nm_kegiatan
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Tahun Anggaran
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$thn
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Kode Rekening 
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$kegiatan
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Sumber Dana
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">APBD Kota Makassar Tahun Anggaran $thn
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>";//}
                         $cRet .="<tr>
                           <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                                    <tr>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>NO</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>URAIAN</b></td>
                                        <td bgcolor=\"#CCCCCC\"  align=\"center\" style=\"font-size:13px;\"><b>SATUAN</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>KUANTITAS</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>HARGA SATUAN (Rp)</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>JUMLAH (Rp)</b></td>
                                    </tr>
									<tr>
                                        <td align=\"center\" style=\"font-size:13px;\">1</td>
                                        <td align=\"center\" style=\"font-size:13px;\">2</td>
                                        <td align=\"center\" style=\"font-size:13px;\">3</td>
                                        <td align=\"center\" style=\"font-size:13px;\">4</td>
                                        <td align=\"center\" style=\"font-size:13px;\">5</td>
                                        <td align=\"center\" style=\"font-size:13px;\">6=5x4</td>
                                    </tr>";
							$sql="SELECT a.kode,a.nama,b.no_transaksi,b.unit_skpd,CONCAT(b.kode,b.no) AS rekening FROM m_rekening a 
									LEFT JOIN pld_form_isian b ON a.kode=b.kode WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
							  $hsql=$this->db->query($sql);
								$jumlahxa  = 0;
								$jumlahxz = 0;
							  foreach ($hsql->result() as $row)
								{
									$i++; 
									$no_trans   =$row->no_transaksi;
									$nmkegiatan =$row->nama;
									$kd_skpd    =$row->unit_skpd; 
									$ckoderek   =$row->kode;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"><b>$i</b></td>
                                        <td align=\"left\" style=\"font-size:13px;\"><b>$nmkegiatan</b></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                    </tr>";
							    $csql = "SELECT * FROM (
									   SELECT CONCAT(kode,NO) AS rekening,no_transaksi,kode,kodegiat,no,unit_skpd,tahun,satuan,uraian,vol,harga_hps as harga,jml_hps as jumlah FROM pld_form_isian 
									   WHERE no_transaksi='$no_trans' AND unit_skpd='$kd_skpd')a WHERE LEFT(rekening,7)=$ckoderek  ORDER BY kode,no";
								$hasil = $this->db->query($csql);
								foreach ($hasil->result() as $row)
								{
									$no_transaksi  	=$row->no_transaksi;
									$unit_skpd 		=$row->unit_skpd;
									$kode 			=$row->kode;
									$kodegiat		=$row->kodegiat;
									$no				=$row->no;
									$tahun			=$row->tahun;
									$uraian			=$row->uraian;
									$jumlahxxs  	=$row->jumlah;
									$jumlahxa 		=$jumlahxa+$jumlahxxs;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">$row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol=='0'){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}
										if($row->harga=='0'){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>";}
										if($row->jumlah=='0'){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";}
                                    $cRet .="</tr>";
										
								$csq2 = "SELECT CONCAT(a.kode,a.NO) AS rekening,a.uraian,a.satuan,a.vol,a.harga_hps as harga,a.jml_hps as jumlah FROM pld_form_rincian a 
										INNER JOIN pld_form_isian b ON a.`no_transaksi`=b.`no_transaksi` AND a.`kode`=a.`kode` AND a.`kodegiat`=b.`kodegiat`
										AND a.`no`=a.`no` AND a.`uraian_header`=b.`uraian` AND a.`tahun`=b.`tahun`
									    WHERE b.no_transaksi='$no_transaksi' AND b.unit_skpd='$unit_skpd' 
										and b.kode='$kode' and b.kodegiat='$kodegiat' and b.no='$no' and b.uraian='$uraian' and b.tahun='$tahun' ORDER BY a.kode,a.no,a.no_urut";
								$hasi2 = $this->db->query($csq2);
								
								foreach ($hasi2->result() as $row)
								{
									$jumlahxxd  =$row->jumlah;
									$jumlahxz =$jumlahxz+$jumlahxxd;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">- $row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol=='0'){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}
										if($row->harga=='0'){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>";}
										if($row->jumlah=='0'){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";}
                                    $cRet .="</tr>";
                                    }
								   }
								   
								   }
							if($unit_skpd=='1.18.01.00' && $kegiatan=='1.18.01.12.03'){
							  $tott = $jumlahxa+$jumlahxz;
							  $ppn	= (($tott*10)/100);
                              $cRet .="<tr>
                                        <td align=\"right\" colspan=\"5\" style=\"font-size:13px;\"><b>TOTAL</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr>
									<tr>
                                        <td align=\"right\" colspan=\"5\" style=\"font-size:13px;\"><b>PPN 10%</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($ppn)."</b></td>
                                    </tr>
									<tr>
                                        <td align=\"right\" colspan=\"5\" style=\"font-size:13px;\"><b>JUMLAH TOTAL</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format(round($tott+$ppn))."</b></td>
                                    </tr>
                                </table>";
								
								}else{
							  $tott = $jumlahxa+$jumlahxz;
                              $cRet .="<tr>
                                        <td align=\"center\" colspan=\"5\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr>
                                </table>";}
                  $cRet .="</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				  <table border=\"0\" width=\"100%\" style=\"font-size:13px;\">";
				  if($unit_skpd=='1.18.01.00' && $kegiatan=='1.18.01.12.03'){
                  $cRet .="<tr><td width=\"5%\"></td><td align=\"left\" colspan=\"3\"><b>Terbilang : ".$this->mdata2->terbilang(round($tott+$ppn))." Rupiah</b></td></tr>";}else{
                  $cRet .="<tr><td width=\"5%\"></td><td align=\"left\" colspan=\"3\"><b>Terbilang : ".$this->mdata2->terbilang($tott)." Rupiah</b></td></tr>";}
				  $cRet .="<tr><td width=\"5%\"></td><td align=\"left\" colspan=\"3\"><i>Harga Telah Termasuk Kewajiban Pajak</i></td></tr>
				  </table><br/><br/>
				  <table border=\"0\" width=\"94%\" style=\"font-size:12px;\">
                       <tr>
                            <td colspan=\"2\" align=\"right\">
								Makassar, $ctanggal
                            </td>
                       </tr> 
                  </table>
                 <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                  <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr>";
								/* 		if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00'){
											$cRet.="<td></td>
                                            <td align=\"center\">Mengetahui<br>
                                            <b>$rowi->jabatan_ketua</b><br>Selaku Pejabat Pembuat Komitmen<br><br><br><br><br>
                                            <b><u>$rowi->ketua</u></b><br>Pangkat: $rowi->pangkat_ketua<br>Nip. $rowi->nip_ketua
                                            </td>";}elseif($skpd=='1.03.01.00'){
											$cRet.="<td></td>
                                            <td align=\"center\">Mengetahui<br>
                                            <b>$rowi->jabatan_ketua</b><br>Selaku Kuasa Pengguna Anggaran<br><br><br><br><br>
                                            <b><u>$rowi->ketua</u></b><br>Pangkat: $rowi->pangkat_ketua<br>Nip. $rowi->nip_ketua
                                            </td>";}else{
											$cRet.="<td></td>
                                            <td align=\"center\">Mengetahui<br>
                                            <b>$rowi->jabatan_ketua</b><br>Selaku $rowi->nama_singkat_ketua<br><br><br><br><br>
                                            <b><u>$rowi->ketua</u></b><br>Pangkat: $rowi->pangkat_ketua<br>Nip. $rowi->nip_ketua
                                            </td>";
											} */ 
											$cRet.="<td></td>
                                            <td align=\"center\"><br>
                                            <b></b><br><br><br><br><br><br>
                                            <b><u></u></b><br>
                                            </td>";
											//ketua,jabatan_ketua,nama_singkat_ketua,pangkat_ketua,nip_ketua
                                        $cRet.="</tr>
                                    </table>
                                </td>
                                <td width=\"10%\">
                                </td>
                                <td width=\"60%\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr>
                                            <td></td>
                                            <td align=\"center\"><br><b>".strtoupper($rowi->nama_singkat_ketua)."</b><br>
                                            <b>$nama</b><br><br><br><br>
                                            <b><u>$rowi->ketua</br></u></b>Pangkat: $rowi->pangkat_ketua<br>Nip. $rowi->nip_ketua
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                </table>";
        }
         echo $cRet;
         
		 
		 }  
	if($ctk=='3')
        {
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$iduser			= $this->session->userdata('iduser');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$nama1  		= $mhorganisasi['nama'];
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
		
		$csql = "SELECT b.*,a.*,(SELECT nama FROM mrekanan WHERE kd_skpd=b.kd_uskpd AND kode=b.rekanan)AS nama_rekanan
				FROM plh_form_isian b LEFT JOIN pl_lengkap a ON a.kd_skpd=b.kd_uskpd 
				WHERE b.no_transaksi='$kode' and a.no_transaksi='$kode' AND b.kd_uskpd='$skpd'";
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row){
						$tgl= $this->tanggal_indonesia($row->tgl_upl);
						$tgl1= $this->tanggal_indonesia($row->tgl_spr);
						$tglfix = date("d/m/Y",strtotime("$row->tgl_spr"));
						
							$tanggalx = $row->tgl_spr; 
							$query = "SELECT datediff('$tanggalx', CURDATE()) as selisih";
							$hasil = mysql_query($query);
							$data  = mysql_fetch_array($hasil);
							$selisih = $data['selisih'];
							$x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y"));
							$namahari = date("l", $x);
								 if ($namahari == "Sunday") $namahari = "Minggu";
							else if ($namahari == "Monday") $namahari = "Senin";
							else if ($namahari == "Tuesday") $namahari = "Selasa";
							else if ($namahari == "Wednesday") $namahari = "Rabu";
							else if ($namahari == "Thursday") $namahari = "Kamis";
							else if ($namahari == "Friday") $namahari = "Jumat";
							else if ($namahari == "Saturday") $namahari = "Sabtu";
							}
						
						
						
					if($skpd=='1.02.01.00' && $iduser=='842'){ 
						$bsql ="SELECT c.jabatan,c.nama,c.nama_singkat,
								c.pangkat,c.nip 
								FROM plh_form_isian a 
								LEFT JOIN m_kegiatan b ON b.kode=a.kegiatan
								LEFT JOIN mpejabat c ON c.bagian=b.bagian
								WHERE a.kd_uskpd='$skpd' AND a.no_transaksi='$kode' AND c.singkat='PBA'";
						$hasilb = $this->db->query($bsql);
							$i = 0;
						foreach ($hasilb->result() as $rowb){
							$nama_singkat	=$rowb->nama_singkat;
							$nama			=$rowb->nama;
							$pangkat		=$rowb->pangkat;
							$nip			=$rowb->nip;
							$jabatan		=$rowb->jabatan;
						}
						}
					else{
						$bsql ="SELECT a.* from mpejabat a 
						left join plh_form_isian b on a.kode=b.anggota_satu 
						and a.kd_skpd=b.kd_uskpd where b.kd_uskpd='$skpd' and b.no_transaksi='$kode'";
						$hasilb = $this->db->query($bsql);
							$i = 0;
						foreach ($hasilb->result() as $rowb){
							$nama_singkat	=$rowb->nama_singkat;
							$nama			=$rowb->nama;
							$pangkat		=$rowb->pangkat;
							$nip			=$rowb->nip;
						}
						} 
		 $cRet = "<table width=\"100%\" border=\"0\" align=\"center\" >";
                        $cRet .=" 
                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                     <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                    </table>
					</td>
                  </tr>
				  <table border=\"0\" width=\"100%\" align=\"center\" style=\"font-size:14px;\" >
					<tr>
						<td width=\"70%\" colspan=\"4\"></td>
						<td>Makassar, $tgl</td>
					</tr>
					<tr>
						<td width=\"70%\" colspan=\"4\"></td>
						<td>Kepada<br/>Yth. $row->nama_rekanan<br/>di -<br/>  Makassar</td>
					</tr>
				  </table>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" align=\"center\" style=\"padding-left:5%;padding-right:2%;\" style=\"font-size:14px;\">
						 <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Nomor
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$row->no_upl
                            </td>
                         </tr>
                         <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Lampiran
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">-
                            </td>
                         </tr>
                         <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Perihal
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\"><i><u>Undangan Permintaan Penawaran</u></i>
                            </td>
                         </tr>
                    </table>
                    </td>
                  </tr>";
                        $cRet .="  
						<tr>
                            <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"80%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
                                    <tr>
                                        <td align=\"left\" colspan=\"3\" style=\"font-size:14px;\">Bahwa dalam rangka pelaksanaan proses pengadaan langsung, untuk :</td>
                                    </tr>
                                    <tr>
                                        <td align=\"left\" style=\"font-size:14px;\">Paket Pekerjaan</td>
										<td style=\"font-size:14px;\">:</td>
										<td style=\"font-size:14px;\">$row->keterangan</td>
                                    </tr>
									 <tr>
                                        <td align=\"left\" style=\"font-size:14px;\">Kegiatan</td>
										<td style=\"font-size:14px;\">:</td>
										<td style=\"font-size:14px;\">$row->nm_kegiatan</td>
                                    </tr> 
									<tr>
                                        <td align=\"left\" style=\"font-size:14px;\">Sumber Dana</td>
										<td style=\"font-size:14px;\">:</td>
										<td style=\"font-size:14px;\">APBD Kota Makassar Tahun Anggaran $thn</td>
                                    </tr>
									<tr>
                                        <td align=\"left\" colspan=\"3\" style=\"font-size:14px;\">Diharapkan Saudara untuk menyampaikan dokumen penawaran paling lambat pada :</td>
                                    </tr>
									<tr>
                                        <td align=\"left\" style=\"font-size:14px;\">Hari/Tanggal</td>
										<td style=\"font-size:14px;\">:</td>
										<td style=\"font-size:14px;\">$namahari/($tglfix)</td>
                                    </tr>
									<tr>
                                        <td align=\"left\" style=\"font-size:14px;\">Jam</td>
										<td style=\"font-size:14px;\">:</td>
										<td style=\"font-size:14px;\">15.00 WITA</td>
                                    </tr> 
									<tr>
                                        <td align=\"left\" style=\"font-size:14px;\">Tempat</td>
										<td style=\"font-size:14px;\">:</td>
										<td style=\"font-size:14px;\">Ruang Rapat $nama1</td>
                                    </tr>
									<tr>
                                        <td align=\"left\" colspan=\"3\" style=\"font-size:14px;\"><j>Sebelum batas waktu penyampaian dokumen penawaran apabila dalam dokumen Pengadaan Langsung sebagaimana terlampir terdapat hal yang tidak jelas atau perlu penjelasan maka dapat ditanyakan kepada Pejabat Pengadaan.</j></td>
                                    </tr><br/>
									<tr><td colspan=\"3\" style=\"font-size:14px;\"></td></tr>
									<tr>
                                        <td align=\"left\" colspan=\"3\" style=\"font-size:14px;\"><j>Demikian disampaikan, atas perhatian dan pertisipasi saudara diucapkan terima kasih.</j></td>
                                    </tr>
                                </table>
                            </td></tr>";
                    
                $cRet .="  <br/> <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" align=\"center\" style=\"font-size:12px;\">
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" align=\"center\" style=\"font-size:12px;\">
                                        <tr><td></td>
                                            <td align=\"center\"></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"10%\">
                                </td>
                                <td width=\"60%\">";
								if($skpd=='1.03.01.00'){
                                    $cRet.="<table border=\"0\" width=\"100%\" align=\"center\" style=\"font-size:12px;\">
                                        <tr><td align=\"center\"><b>$nama_singkat</b></td></tr><br/>
										<tr><td height=\"60px\" ></td></tr>
										<tr><td align=\"center\"><b><u>$nama</u></b><br>Pangkat: $pangkat<br>Nip. $nip</td></tr>";}
										/* elseif($skpd=='1.02.01.00' && $iduser=='842'){{
										$cRet.="<table border=\"0\" width=\"100%\" align=\"center\" style=\"font-size:12px;\">
                                        <tr><td align=\"center\"><b>$nama_singkat</b></td></tr><br/>
										<tr><td height=\"60px\" ></td></tr>
										<tr><td align=\"center\"><b><u>$nama</u></b><br>Pangkat: $pangkat<br>Nip. $nip</td></tr>";}}
										 */else{
                                    $cRet.="<table border=\"0\" width=\"100%\" align=\"center\" style=\"font-size:12px;\">
                                        <tr><td align=\"center\"><b>$nama_singkat</b></td></tr><br/>
										<tr><td height=\"60px\" ></td></tr>
										<tr><td align=\"center\"><b><u>$nama</u></b><br>Pangkat: $pangkat<br>Nip. $nip</td></tr>";}
                                    $cRet.="</table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>";
        
         echo $cRet;
    }
	if($ctk=='4')
       {
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$iduser			= $this->session->userdata('iduser');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$no 			= $_REQUEST['kode'];
		
		if($skpd=='1.02.01.00' && $iduser=='842'){
		$csql 			= "SELECT a.kd_uskpd,a.kegiatan,
					CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
					a.nm_kegiatan,a.keterangan,a.rekanan,
					(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
					(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
					(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat,
					(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
					(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
					(SELECT ifnull(no_upl,0) as no_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_upl,
					(SELECT ifnull(tgl_upl,0) as tgl_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_upl,
					
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS staf_penerima, 
					(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS jabatan_penerima,
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nama_singkat_penerima, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS pangkat_penerima,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nip_penerima,
	
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
					(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua,
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua, 
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua,
					(SELECT SUM(jumlah) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
					FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";}
					else{
		$csql 			= "SELECT a.kd_uskpd,a.kegiatan,
					CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
					a.nm_kegiatan,a.keterangan,a.rekanan,
					(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
					(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
					(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat,
					(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
					(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
					(SELECT ifnull(no_upl,0) as no_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_upl,
					(SELECT ifnull(tgl_upl,0) as tgl_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_upl,
					(SELECT nama FROM mpejabat WHERE kode=a.anggota_satu AND a.kd_uskpd=kd_skpd) AS staf_penerima,
					(SELECT jabatan FROM mpejabat WHERE kode=a.anggota_satu AND a.kd_uskpd=kd_skpd) AS jabatan_penerima,
					(SELECT nama_singkat FROM mpejabat WHERE kode=a.anggota_satu AND a.kd_uskpd=kd_skpd) AS nama_singkat_penerima, 
					(SELECT pangkat FROM mpejabat WHERE kode=a.anggota_satu AND a.kd_uskpd=kd_skpd) AS pangkat_penerima,
					(SELECT nip FROM mpejabat WHERE kode=a.anggota_satu AND a.kd_uskpd=kd_skpd) AS nip_penerima,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
					(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua,
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua, 
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua,
					(SELECT SUM(jumlah) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
					FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
					}
                           
	   $hasil = $this->db->query($csql);
	   $i 	  = 0;
	   foreach ($hasil->result() as $rowi){
	   $cRet  = '';
	   $keterangan = $rowi->keterangan;
	   $nm_kegiatan= $rowi->nm_kegiatan;
	   $kegiatan   = $rowi->kegiatan;
	   $noupl      = $rowi->no_upl;
	   
	   $ctgl=$rowi->tgl_upl;
	   $ctanggal=$this->tanggal_indonesia($ctgl); 
	   
          $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                           
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b></b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b></b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            
                        </tr>
                    </table>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" align=\"center\" style=\"padding-left:5%;padding-right:2%;\" style=\"font-size:14px;\">
						 <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Lampiran
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">UNDANGAN PERMINTAAN PENAWARAN HARGA BARANG/JASA
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Nomor
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$noupl
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Tanggal
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$ctanggal
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Pekerjaan
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$keterangan
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Kegiatan
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$nm_kegiatan
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>";//}
                         $cRet .="<tr>
                           <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                                    <tr>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>NO</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>URAIAN</b></td>
                                        <td bgcolor=\"#CCCCCC\"  align=\"center\" style=\"font-size:13px;\"><b>SATUAN</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>KUANTITAS</b></td>
                                    </tr>
									<tr>
                                        <td align=\"center\" style=\"font-size:13px;\">1</td>
                                        <td align=\"center\" style=\"font-size:13px;\">2</td>
                                        <td align=\"center\" style=\"font-size:13px;\">3</td>
                                        <td align=\"center\" style=\"font-size:13px;\">4</td>
                                    </tr>";
							  $sql="SELECT a.kode,a.nama,b.no_transaksi,b.unit_skpd,CONCAT(b.kode,b.no) AS rekening FROM m_rekening a 
									LEFT JOIN pld_form_isian b ON a.kode=b.kode WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
							  $hsql=$this->db->query($sql);
								$jumlahxa  = 0;
								$jumlahxz = 0;
							  foreach ($hsql->result() as $row)
								{
									$i++; 
									$no_trans   =$row->no_transaksi;
									$nmkegiatan =$row->nama;
									$kd_skpd    =$row->unit_skpd;  						
							        $ckoderek   =$row->kode;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"><b>$i</b></td>
                                        <td align=\"left\" style=\"font-size:13px;\"><b>$nmkegiatan</b></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                    </tr>";
                                    
                             // $csql = "SELECT b.uraian,b.satuan,b.vol,b.harga,b.jumlah,a.total as jumlahxxx FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' and b.unit_skpd='$kd_skpd' group by kode";
							 // $csql = "SELECT CONCAT(b.kode,b.no) AS rekening,b.uraian,b.satuan,b.vol,b.harga,b.jumlah FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' AND b.unit_skpd='$kd_skpd' GROUP BY rekening  ORDER BY rekening";
							 $csql = "SELECT * FROM (
									  SELECT CONCAT(kode,NO) AS rekening,no_transaksi,kode,kodegiat,no,unit_skpd,tahun,uraian,satuan,vol,harga,jumlah FROM pld_form_isian 
								      WHERE no_transaksi='$no_trans' AND unit_skpd='$kd_skpd')a WHERE LEFT(rekening,7)=$ckoderek  ORDER BY kode,no";
							 $hasil = $this->db->query($csql);
							  
								
								foreach ($hasil->result() as $row)
								{
									$no_transaksi  	=$row->no_transaksi;
									$unit_skpd 		=$row->unit_skpd;
									$kode 			=$row->kode;
									$kodegiat		=$row->kodegiat;
									$no				=$row->no;
									$tahun			=$row->tahun;
									$uraian			=$row->uraian;
									$jumlahxx  =$row->jumlah;
									$jumlahxa =$jumlahxa+$jumlahxx;
                           $cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">$row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol<>0){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}
                                    $cRet .="</tr>";
								$csq2 = "SELECT CONCAT(a.kode,a.NO) AS rekening,a.uraian,a.satuan,a.vol,a.harga,a.jumlah FROM pld_form_rincian a 
										INNER JOIN pld_form_isian b ON a.`no_transaksi`=b.`no_transaksi` AND a.`kode`=a.`kode` AND a.`kodegiat`=b.`kodegiat`
										AND a.`no`=a.`no` AND a.`uraian_header`=b.`uraian` AND a.`tahun`=b.`tahun`
									    WHERE b.no_transaksi='$no_transaksi' AND b.unit_skpd='$unit_skpd' 
										and b.kode='$kode' and b.kodegiat='$kodegiat' and b.no='$no' and b.uraian='$uraian' and b.tahun='$tahun' ORDER BY a.kode,a.no,a.no_urut";
								$hasi2 = $this->db->query($csq2);
                                    
								foreach ($hasi2->result() as $row)
								{
									$jumlahxxd  =$row->jumlah;
									$jumlahxz =$jumlahxz+$jumlahxxd;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">- $row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol<>0){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}
                                    $cRet .="</tr>";
									
                                    }
									
									}
									
									
									}
                              $cRet .="<tr>
                                        
                                    </tr>
                                </table>";
                  $cRet .="</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				  <table border=\"0\" width=\"100%\" style=\"font-size:13px;\">
				  </table><br/><br/>
				  <table border=\"0\" width=\"100%\" style=\"font-size:12px;\" align=\"center\">
                       <tr>
							<td colspan=\"2\" align=\"center\" width=\"60%\">
                            </td>
							<td colspan=\"2\" align=\"center\" width=\"30%\">
								Makassar, $ctanggal
                            </td>
                            <td colspan=\"2\" align=\"center\" width=\"10%\">
                            </td>
                       </tr> 
                  </table>
				  <table border=\"0	\" width=\"100%\" style=\"font-size:12px;\" align=\"center\">
                       <tr>
							<td colspan=\"2\" align=\"center\" width=\"60%\">
                            </td>
							<td colspan=\"2\" align=\"center\" width=\"30%\">
                                    <b>$rowi->nama_singkat_penerima</b><br><br><br><br><br>
									<b><u>$rowi->staf_penerima</u></b><br>Nip. $rowi->nip_penerima
                            </td>
                            <td colspan=\"2\" align=\"center\" width=\"10%\">
                            </td>
                        </tr> 
                  </table>
                  <tr>
					<td align=\"center\" >
                                   
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                </table>";
        }
         echo $cRet;
         
		 
		 } 		
	if($ctk=='5')
	{
        $konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$no 			= $_REQUEST['kode'];
		$kop 			= $_REQUEST['kop'];
		$csql 			= "SELECT a.kd_uskpd,a.kegiatan,
							CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
							a.nm_kegiatan,a.keterangan,
							(SELECT nama FROM mrekanan WHERE a.rekanan=kode AND kd_skpd=a.kd_uskpd) AS nama_rekanan,
							(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
							(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
							(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat, 
							(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
							(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
							(SELECT kantor FROM mrekanan WHERE a.rekanan=kode AND kd_skpd=a.kd_uskpd)AS alamat_rekanan,
							(SELECT pimpinan FROM mrekanan WHERE a.rekanan=kode AND kd_skpd=a.kd_uskpd)AS pimpinan,
							(SELECT jabatan FROM mrekanan WHERE a.rekanan=kode AND kd_skpd=a.kd_uskpd)AS jabatan_pimpinan,
							(SELECT ifnull(no_upl,0) as no_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_upl,
							(SELECT ifnull(tgl_upl,0) as tgl_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_upl,
							(SELECT ifnull(no_spr,0) as no_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spr,
							(SELECT ifnull(tgl_spr,0) as tgl_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spr,
							(SELECT ifnull(spbj,0) as spbj FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS spbj,
							(SELECT nama FROM mpejabat WHERE singkat='P_TRM' AND a.kd_uskpd=kd_skpd) AS staf_penerima,
							(SELECT jabatan FROM mpejabat WHERE singkat='P_TRM' AND a.kd_uskpd=kd_skpd) AS jabatan_penerima,
							(SELECT nama_singkat FROM mpejabat WHERE singkat='P_TRM' AND a.kd_uskpd=kd_skpd) AS nama_singkat_penerima, 
							(SELECT pangkat FROM mpejabat WHERE singkat='P_TRM' AND a.kd_uskpd=kd_skpd) AS pangkat_penerima,
							(SELECT nip FROM mpejabat WHERE singkat='P_TRM' AND a.kd_uskpd=kd_skpd) AS nip_penerima,
							(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
							(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua,
							(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua, 
							(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua,
							(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua,
							(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
					FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
		                   
	   $hasil = $this->db->query($csql);
	   $i 	  = 0;
	   foreach ($hasil->result() as $rowi){
	   $cRet  = '';
	   $keterangan = $rowi->keterangan;
	   $nm_kegiatan= $rowi->nm_kegiatan;
	   $kegiatan   = $rowi->kegiatan;
	   $ctgl=$rowi->tgl_spr;
	   $ctgl1=$rowi->tgl_upl;
	   $ctanggal=$this->tanggal_indonesia($ctgl); 
	   $ctanggal1=$this->tanggal_indonesia($ctgl1); 
	   $rekanan   = $rowi->nama_rekanan;
	   $alamat_rekanan   = $rowi->alamat_rekanan;
	   $jumtot = $rowi->tot;
	  
	   $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\" >";
			if($kop=='1'){
                  $cRet .="<tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\" >
					<table border=\"0\" width=\"100%\" align=\"center\" style=\"padding-left:5%;padding-right:2%;\">
                        <tr>
                            <td width=\"100%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>$rowi->nama_rekanan</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat_rekanan
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 5px white;\">
                                <hr/>
                            </td>
                        </tr>
                    </table>
                    </td>
                  </tr>";}else{
				  $cRet .="<tr></tr>";
				  }
				 $cRet .="<table border=\"0\" width=\"100%\" align=\"center\" style=\"font-size:14px;\" >
					<tr>
						<td width=\"70%\" colspan=\"4\"></td>
						<td>Makassar, $ctanggal</td>
					</tr>
				  </table>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" align=\"center\" style=\"padding-left:5%;padding-right:2%;\" style=\"font-size:14px;\" >
						 <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" >Nomor
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">: $rowi->no_spr
                            </td>
                            <td  width=\"1%\" style=\"font-size:14px;\">
                            </td>
                         </tr>
                         <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Lampiran
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">: -
                            </td>
                         </tr>
						<tr>
							<td width=\"30%\" style=\"font-size:14px;\">Kepada Yth. <br><b>Pejabat Pengadaan <br> $nama</b><br/>di -<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Makassar</td>
							<td width=\"70%\" style=\"font-size:14px;\"></td>
						</tr>
                    </table>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" align=\"center\" style=\"padding-left:5%;padding-right:2%;\" style=\"font-size:14px;\">
                        <tr>
                            <td width=\"30%\" style=\"font-size:14px;\" valign=\"top\">Perihal
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:
                            </td>
                            <td  width=\"70%\" style=\"font-size:14px;\" valign=\"top\">Penawaran Pekerjaan $keterangan
                            </td>
                        </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
						<tr>
                            <td colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Sehubungan dengan undangan Pengadaan Langsung Nomor :  $rowi->no_upl  Tanggal  $ctanggal1 dan setelah kami pelajari dengan seksama Dokumen Pengadaan, dengan ini kami mengajukan penawaran untuk Pekerjaan $keterangan sebesar Rp. ".number_format($rowi->tot)."  (".$this->mdata2->terbilang($rowi->tot)." Rupiah).</td>
						</tr>
						<tr>
                            <td colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Adapun rincin penawaran kami sebagai berikut:</td>
						</tr>
                        <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>";//}
                         $cRet .="<tr>
                           <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                                    <tr>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>NO</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>URAIAN</b></td>
                                        <td bgcolor=\"#CCCCCC\"  align=\"center\" style=\"font-size:13px;\"><b>SATUAN</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>KUANTITAS</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>HARGA SATUAN (Rp)</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>JUMLAH (Rp)</b></td>
                                    </tr>
									<tr>
                                        <td align=\"center\" style=\"font-size:13px;\">1</td>
                                        <td align=\"center\" style=\"font-size:13px;\">2</td>
                                        <td align=\"center\" style=\"font-size:13px;\">3</td>
                                        <td align=\"center\" style=\"font-size:13px;\">4</td>
                                        <td align=\"center\" style=\"font-size:13px;\">5</td>
                                        <td align=\"center\" style=\"font-size:13px;\">6=5x4</td>
                                    </tr>";
							$sql="SELECT a.kode,a.nama,b.no_transaksi,b.unit_skpd,CONCAT(b.kode,b.no) AS rekening FROM m_rekening a 
									LEFT JOIN pld_form_isian b ON a.kode=b.kode WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
							  $hsql=$this->db->query($sql);
							  $jumlahx = 0;
							  foreach ($hsql->result() as $row)
								{
									$i++; 
									$no_trans   =$row->no_transaksi;
									$nmkegiatan =$row->nama;
									$kd_skpd    =$row->unit_skpd; 
									$ckoderek   =$row->kode;									
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"><b>$i</b></td>
                                        <td align=\"left\" style=\"font-size:13px;\"><b>$nmkegiatan</b></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                    </tr>";
                                    
                             // $csql = "SELECT b.uraian,b.satuan,b.vol,b.harga,b.jumlah,a.total as jumlahxxx FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' and b.unit_skpd='$kd_skpd' group by kode";
							 // $csql = "SELECT CONCAT(b.kode,b.no) AS rekening,b.uraian,b.satuan,b.vol,b.harga,b.jumlah FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' AND b.unit_skpd='$kd_skpd' GROUP BY rekening  ORDER BY rekening";
							    $csql = "SELECT * FROM (
											SELECT CONCAT(kode,NO) AS rekening,uraian,satuan,vol,harga_akhir as harga,jml_akhir as jumlah FROM pld_form_isian 
											WHERE no_transaksi='$no_trans' AND unit_skpd='$kd_skpd')a WHERE LEFT(rekening,7)=$ckoderek  ORDER BY rekening";
							  $hasil = $this->db->query($csql);
							  
								
								foreach ($hasil->result() as $row)
								{
									$jumlahxx  =$row->jumlah;
									$jumlahxxx =$jumlahx+$jumlahxx;
                           $cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">$row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol=='0'){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}
										if($row->harga=='0'){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>";}
										if($row->jumlah=='0'){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";}
                                    $cRet .="</tr>";
                                    }}
                              $cRet .="<tr>
                                        <td align=\"center\" colspan=\"5\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($jumtot)."</b></td>
                                    </tr>
                                </table>";
                  $cRet .="</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				  <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
				  <table border=\"0\" width=\"100%\" align=\"center\" style=\"padding-left:5%;padding-right:2%;\" style=\"font-size:14px;\">
				  <tr>
                       <td colspan=\"3\" style=\"font-size:14px;\">Penawaran ini sudah memperhatikan ketentuan dan persyaratan yang tercantum dalam Dokumen Pengadaan Langsung untuk melaksanakan pekerjaan tersebut di atas.</td>
				  </tr>
				    <tr>
                            <td colspan=\"2\">&nbsp;
                            <td>
                        </tr>
				  <tr>
                       <td colspan=\"3\" style=\"font-size:14px;\">Kami akan melaksanakan pekerjaan tesebut dengan jangka waktu pelaksanaan pekerjaan selama $rowi->spbj (".$this->mdata2->terbilang($rowi->spbj).") hari kalender.</td>
				  </tr>
				    <tr>
                            <td colspan=\"2\">&nbsp;
                            <td>
                        </tr>
				  <tr>
                       <td colspan=\"3\" style=\"font-size:14px;\">Penawaran ini berlaku selama $rowi->spbj (".$this->mdata2->terbilang($rowi->spbj).") hari kalender sejak tanggal surat penawaran ini.</td>
				  </tr>
				    <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
				  <tr>
                       <td colspan=\"3\" style=\"font-size:14px;\">Surat Penawaran beserta lampirannya kami sampaikan sebanyak 1 (satu) rangkap dokumen asli.</td>
				  </tr>
				    <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
				  <tr>
                       <td colspan=\"3\" style=\"font-size:14px;\">Dengan disampaikannya Surat Penawaran ini, maka kami menyatakan sanggup dan akan tunduk pada semua ketentuan yang tercantum dalam Dokumen Pengadaan.</td>
				  </tr>
				  </table>
                <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr><td></td>
                                            
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"10%\">
                                </td>
                                <td width=\"60%\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">
                                                <b>$rowi->nama_rekanan</b><br><br><br><br><br>
												<b><u>$rowi->pimpinan</u></b><br>$rowi->jabatan_pimpinan
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                  <tr>
					<td align=\"center\" >
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr><td></td>
                        
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                </table>";
        }
         echo $cRet;
         
		 
		 }
    
	if($ctk=='6')
         {
		$skpd = $this->session->userdata('skpd');
		$csql = "SELECT a.keterangan,
				(SELECT nama FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS rekanan,
				(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS pimpinan_rekanan,
				(SELECT ktp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS ktp,
				(SELECT rumah FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS alamat_rekanan,
				(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
				(SELECT tgl_pi FROM pl_lengkap WHERE a.no_transaksi=no_transaksi AND a.kd_uskpd=kd_skpd) AS tgl_pi
				FROM plh_form_isian a 
				WHERE a.no_transaksi='$kode' and kd_uskpd='$skpd'";
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row){
						$tgl= $this->tanggal_indonesia($row->tgl_pi);
		 $cRet = "<table width=\"100%\" border=\"0\" >
		
                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                   <table border=\"0\" width=\"100%\" align=\"center\" style=\"padding-left:5%;padding-right:2%;\" style=\"font-size:14px;\">
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b><u>PAKTA INTEGRITAS</u></b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						<tr>
                            <td colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Saya yang bertanda tangan di bawah ini, dalam rangka Pekerjaan $row->keterangan ini menyatakan bahwa saya :</td>
                        </tr>
                    </table>
                    </td>
                         
                        
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$row->pimpinan_rekanan</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">No. Indentitas</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$row->ktp</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Alamat</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\">$row->alamat_rekanan</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Jabatan</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\"><b>$row->jabatan_rekanan $row->rekanan</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Bertindak untuk dan atas nama</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$row->rekanan</td>
                        </tr>
                        <tr>
                            <td colspan=\"3\">&nbsp;<td>
                        </tr>
						<table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
						 <tr>
                            <td width=\"2%\" style=\"font-size:14px;\" >1.</td>
                            <td  width=\"100%\" colspan=\"2\" style=\"font-size:14px;\"><j>Tidak Akan melakukan praktek KKN;</j></td>
                        </tr>
                        <tr>
                            <td width=\"2%\" style=\"font-size:14px;\" valign=\"top\">2.</td>
                            <td  width=\"100%\" colspan=\"2\" style=\"font-size:14px;\"><j>Akan melaporkan kepada pihak yang berwajib/berwenang apabila mengetahui ada indikasi KKN di dalam proses pengadaan ini;</j></td>
                        </tr>
                        <tr>
                            <td width=\"2%\" style=\"font-size:14px;\" valign=\"top\">3.</td>
                            <td  width=\"100%\" colspan=\"2\" style=\"font-size:14px;\"><j>Akan mengikuti proses pengadaan secara bersih, transparan, dan profesional untuk memberikan hasil kerja terbaik sesuai ketentuan peraturan perundang-undangan;</j></td>
                        </tr>
                        <tr>
                            <td width=\"2%\" style=\"font-size:14px;\" valign=\"top\">4.</td>
                            <td width=\"100%\" colspan=\"2\" style=\"font-size:14px;\"><j>Apabila melanggar hal-hal yang dinyatakan dalam PAKTA INTEGRITAS ini, bersedia menerima sangsi administratif, menerima sanksi pencantuman dalam daftar hitam, digugat secara perdata dan atau dilaporkan secara pidana.</j></td>
                        </tr>
                        <tr>
                            <td colspan=\"3\">&nbsp;<td>
                        </tr></table>";
           $cRet .="<table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                                        <tr><td></td>
                                            <td align=\"center\"></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"10%\">
                                </td>
                                <td width=\"60%\">
                                    <table border=\"0\" width=\"80%\" style=\"font-size:14px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">
											 Makassar, $tgl<br/><br>Penyedia Barang / Jasa <br>
                                                <b>$row->rekanan</b><br><br><br>
												<b><u>$row->pimpinan_rekanan</u></b><br>$row->jabatan_rekanan
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>";}
         echo $cRet;
    }
	if($ctk=='7')
    {
		$kd_skpd = $this->session->userdata('skpd');
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');		
		$iduser			= $this->session->userdata('iduser');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$no_sk			= $mhorganisasi['no_sk'];
		$tgl_sk			= $mhorganisasi['tgl_sk'];
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
		if($kd_skpd=='1.02.01.00' && $iduser=='842'){
		$csql = "SELECT a.keterangan,a.nm_kegiatan,a.total,a.kegiatan,
					(SELECT CONCAT(SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,4,2),'.',SUBSTR(kodegiat,6,2),'.',SUBSTR(kodegiat,8,2),'.',SUBSTR(kode,1,1),'.',SUBSTR(kode,2,1),'.',SUBSTR(kode,3,1),'.',SUBSTR(kode,4,2),'.',SUBSTR(kode,6,2)) AS rek FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd GROUP BY kodegiat) AS kd_rekening,
					(select ifnull(tgl_bappd,0) as tgl_bappd from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as tgl_bappd,
					(select ifnull(no_bappd,0) as no_bappd from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as no_bappd,
					(SELECT nama FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS rekanan,
					(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS pimpinan_rekanan,
					(SELECT ktp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS ktp,
					(SELECT rumah FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS alamat_rekanan,
					(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
					(SELECT npwp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS npwp,
					(SELECT SUM(jml_hps) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_hps) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS totx,
					(SELECT SUM(jml_tawar) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot1,
					(SELECT SUM(jml_tawar) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot1x,
					
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nama, 
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS jabatan, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS pangkat,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nip,
					
					(SELECT nama FROM m_rekening b inner join pld_form_isian c on b.kode=c.kode where c.no_transaksi=a.no_transaksi AND c.unit_skpd=a.kd_uskpd group by c.kodegiat) AS rekening
				FROM plh_form_isian a   
			    WHERE a.no_transaksi='$kode' AND kd_uskpd='$kd_skpd'";}else{
				$csql = "SELECT a.keterangan,a.nm_kegiatan,a.total,a.kegiatan,
					(SELECT CONCAT(SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,4,2),'.',SUBSTR(kodegiat,6,2),'.',SUBSTR(kodegiat,8,2),'.',SUBSTR(kode,1,1),'.',SUBSTR(kode,2,1),'.',SUBSTR(kode,3,1),'.',SUBSTR(kode,4,2),'.',SUBSTR(kode,6,2)) AS rek FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd GROUP BY kodegiat) AS kd_rekening,
					(select ifnull(tgl_bappd,0) as tgl_bappd from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as tgl_bappd,
					(select ifnull(no_bappd,0) as no_bappd from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as no_bappd,
					(SELECT nama FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS rekanan,
					(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS pimpinan_rekanan,
					(SELECT ktp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS ktp,
					(SELECT rumah FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS alamat_rekanan,
					(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
					(SELECT npwp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS npwp,
					(SELECT SUM(jml_hps) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_hps) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS totx,
					(SELECT SUM(jml_tawar) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot1,
					(SELECT SUM(jml_tawar) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot1x,
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS jabatan,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nama,
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS pangkat,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nip,
					(SELECT nama FROM m_rekening b inner join pld_form_isian c on b.kode=c.kode where c.no_transaksi=a.no_transaksi AND c.unit_skpd=a.kd_uskpd group by c.kodegiat) AS rekening
				FROM plh_form_isian a   
			    WHERE a.no_transaksi='$kode' AND kd_uskpd='$kd_skpd'";
				}
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row){
						$tgl= $this->tanggal_indonesia($row->tgl_bappd);
						$ket= $row->keterangan;
						$tgl1= $row->tgl_bappd;
						$kegiatan= $row->kegiatan;
						$tahun= substr($tgl1,0,4);
						$bulan= substr($tgl1,5,2);
						$tanggal= substr($tgl1,8,2);
						$jumtot= $row->tot+$row->totx;
						$jumtot1= $row->tot1+$row->tot1x;
						$tglfix = date("d/m/Y",strtotime("$row->tgl_bappd"));
						
							$tanggalx = $tgl1; 
							$query = "SELECT datediff('$tanggalx', CURDATE()) as selisih";
							$hasil = mysql_query($query);
							$data  = mysql_fetch_array($hasil);
							$selisih = $data['selisih'];
							$x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y"));
							$namahari = date("l", $x);
								 if ($namahari == "Sunday") $namahari = "Minggu";
							else if ($namahari == "Monday") $namahari = "Senin";
							else if ($namahari == "Tuesday") $namahari = "Selasa";
							else if ($namahari == "Wednesday") $namahari = "Rabu";
							else if ($namahari == "Thursday") $namahari = "Kamis";
							else if ($namahari == "Friday") $namahari = "Jumat";
							else if ($namahari == "Saturday") $namahari = "Sabtu";
						
													$csqlku="SELECT
a.kode,a.nama,
CONCAT(SUBSTR(b.kodegiat,1,1),'.',SUBSTR(b.kodegiat,2,2),'.',SUBSTR(b.kodegiat,4,2),'.',SUBSTR(b.kodegiat,6,2),'.',SUBSTR(b.kodegiat,8,2),'.',SUBSTR(b.kode,1,1),'.',SUBSTR(b.kode,2,1),'.',SUBSTR(b.kode,3,1),'.',SUBSTR(b.kode,4,2),'.',SUBSTR(b.kode,6,2)) AS rekening
FROM m_rekening a
LEFT JOIN pld_form_isian b ON a.kode=b.kode 
WHERE b.no_transaksi='$kode' AND b.unit_skpd='$kd_skpd' GROUP BY kode";
							$hasil = $this->db->query($csqlku);
							$kodex="";
							$namax="";
							foreach ($hasil->result() as $rowkode){
								$nom 	 = $rowkode->kode;
								$gabung  = $rowkode->nama;
								$namarek = $rowkode->rekening;
								if($gabung==1){
								$namax	= ($gabung);
								}else{
								$namax	= ($gabung.",".$namax);
								}
								if($namarek==1){
								$kodex	= ($namarek);
								}else{
								$kodex	= ($namarek.",".$kodex);
								}
								}
						//$row->kd_rekening,$row->rekening
		 $cRet = "<table width=\"100%\" border=\"0\" >
                  <tr>
                    <td colspan=\"1\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                         <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td><td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
						<table border=\"2\" width=\"80%\" align=\"center\" bordercolor=\"black\">
							<tr><td align=\"center\" colspan=\"2\" style=\"font-size:18px;\" ><b>BERITA ACARA PENERIMAAN DAN PEMBUKAAN DOKUMEN PENAWARAN</b></td></tr>
							<tr><td style=\"font-size:14px;\" valign=\"top\" width=\"50%\">Nomor &nbsp;&nbsp;&nbsp;: $row->no_bappd<br/>Tanggal &nbsp;: $tgl</td>
								<td valign=\"top\" style=\"font-size:14px;\">Pekerjaan &nbsp;: $row->keterangan</td></tr>
							<tr><td align=\"center\" style=\"font-size:14px;\"><b>Tahun Anggaran</b></td>
						        <td rowspan=\"2\" valign=\"top\" style=\"font-size:14px;\">Kegiatan &nbsp;: $row->nm_kegiatan</td></tr>
							<tr><td align=\"center\" style=\"font-size:15px;\"><h1>$thn</h1></td></tr>
						</table>
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 <tr>
                            <td width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Pada Hari ini $namahari, Tanggal ".$this->mdata2->terbilang($tanggal)." Bulan ".$this->mdata2->getBulan($bulan)." Tahun ".$this->mdata2->terbilang($tahun)." ($tglfix), Kami yang bertanda tangan
							di bawah ini Pejabat Pengadaan $nama Kota Makassar yang dibentuk melalui Surat Keputusan Nomor : $no_sk, melaksanakan Penerimaan dan Pembukaan
							Dokumen Penawaran Pekerjaan $ket Tahun Anggaran $thn pada DPA SKPD $nama Kota Makassar dengan Nomor Rekening $kodex ($namax).</td>
						 </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;<td>
                         </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\" >Rapat ini dihadiri oleh $row->jabatan, serta calon Penyedia Barang dan Jasa yang diundang dengan rincian sebagai berikut:</td>
                        </tr>
                       </table>
                    </table>
                    </td>
                         
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">";
						if($kd_skpd=='1.18.01.00' && $kegiatan=='118011203'){
						$ppn = (($jumtot*10)/100);
                        $cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Perkiraan Sendiri</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format(round($jumtot+$ppn))."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang(round($jumtot+$ppn))." Rupiah</i></td>
                        </tr>";}else{
                        $cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Perkiraan Sendiri</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format($jumtot)."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang($jumtot)." Rupiah</i></td>
                        </tr>";}
                        $cRet.=" <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama Calon Penyedia</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\"><b>$row->rekanan</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Alamat</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$row->alamat_rekanan</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">NPWP</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$row->npwp</td>
                        </tr>
						   <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Surat Penawaran</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">Ada/Memenuhi</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Daftar Kuantitas Harga</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">Ada/Memenuhi</td>
                        </tr>";
						if($kd_skpd=='1.18.01.00' && $kegiatan=='118011203'){
						$ppn = (($jumtot*10)/100);
                         $cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Penawaran</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format(round($jumtot1+$ppn))."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang(round($jumtot1+$ppn))." Rupiah</i></td>
                        </tr>";}else{
                         $cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Penawaran</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format($jumtot1)."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang($jumtot1)." Rupiah</i></td>
                        </tr>";}
                         $cRet.="<tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
						 </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\"><j>Demikian Berita Acara ini dibuat untuk dipergunakan sebagai bahan pertimbangan dalam pelaksanaan pengadaan langsung.</j></td>
                        </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    </td>
                  </tr>";
                  $cRet .="<tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:12px;\" align=\"center\" >
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr><td></td>
                                            <td align=\"center\"><b>$row->rekanan</b><br><br><br><br><br><br>
                                            <b><u>$row->pimpinan_rekanan</u></b><br>$row->jabatan_rekanan
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"10%\">
                                </td>
                                <td width=\"60%\">
                                    <table border=\"0\" width=\"80%\" style=\"font-size:12px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">
											 <b>$row->jabatan</b><br><br><br><br><br><br>
												<b><u>$row->nama</u></b><br>Pangkat: $row->pangkat<br>Nip. $row->nip
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                        </table>
                    </td>
                  </tr>
                </table>";}
        
         echo $cRet;
    }
	if($ctk=='8')
       {
		$kd_skpd = $this->session->userdata('skpd');
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');		
		$iduser			= $this->session->userdata('iduser');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$no_sk			= $mhorganisasi['no_sk'];
		$tgl_sk			= $mhorganisasi['tgl_sk'];
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
		if($skpd=='1.02.01.00' && $iduser=='842'){
		$csql = "SELECT a.keterangan,a.nm_kegiatan,a.total,a.kegiatan,
					(SELECT CONCAT(SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,4,2),'.',SUBSTR(kodegiat,6,2),'.',SUBSTR(kodegiat,8,2),'.',SUBSTR(kode,1,1),'.',SUBSTR(kode,2,1),'.',SUBSTR(kode,3,1),'.',SUBSTR(kode,4,2),'.',SUBSTR(kode,6,2)) AS rek FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd GROUP BY kodegiat) AS kd_rekening,
					(select ifnull(tgl_baek,0) as tgl_baek from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as tgl_baek,
					(select ifnull(no_baek,0) as no_baek from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as no_baek,
					(select ifnull(spbj,0) as spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as spbj,
					(select ifnull(ket_spbj,0) as ket_spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as ket_spbj,
					(SELECT nama FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS rekanan,
					(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS pimpinan_rekanan,
					(SELECT ktp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS ktp,
					(SELECT rumah FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS alamat_rekanan,
					(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
					(SELECT npwp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS npwp,
					(SELECT SUM(jml_hps) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_hps) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS totx,
					(SELECT SUM(jml_tawar) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot11,
					(SELECT SUM(jml_tawar) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot11x,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot2,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2x,
					
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nama, 
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS jabatan, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS pangkat,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nip,
					
					(SELECT nama FROM m_rekening b inner join pld_form_isian c on b.kode=c.kode where c.no_transaksi=a.no_transaksi AND c.unit_skpd=a.kd_uskpd group by c.kodegiat) AS rekening
				FROM plh_form_isian a   
			    WHERE a.no_transaksi='$kode' AND kd_uskpd='$kd_skpd'";}else{
		$csql = "SELECT a.keterangan,a.nm_kegiatan,a.total,a.kegiatan,
					(SELECT CONCAT(SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,4,2),'.',SUBSTR(kodegiat,6,2),'.',SUBSTR(kodegiat,8,2),'.',SUBSTR(kode,1,1),'.',SUBSTR(kode,2,1),'.',SUBSTR(kode,3,1),'.',SUBSTR(kode,4,2),'.',SUBSTR(kode,6,2)) AS rek FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd GROUP BY kodegiat) AS kd_rekening,
					(select ifnull(tgl_baek,0) as tgl_baek from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as tgl_baek,
					(select ifnull(no_baek,0) as no_baek from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as no_baek,
					(select ifnull(spbj,0) as spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as spbj,
					(select ifnull(ket_spbj,0) as ket_spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as ket_spbj,
					(SELECT nama FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS rekanan,
					(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS pimpinan_rekanan,
					(SELECT ktp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS ktp,
					(SELECT rumah FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS alamat_rekanan,
					(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
					(SELECT npwp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS npwp,
					(SELECT SUM(jml_hps) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_hps) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS totx,
					(SELECT SUM(jml_tawar) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot11,
					(SELECT SUM(jml_tawar) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot11x,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot2,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2x,
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS jabatan,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nama,
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS pangkat,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nip,
					(SELECT nama FROM m_rekening b inner join pld_form_isian c on b.kode=c.kode where c.no_transaksi=a.no_transaksi AND c.unit_skpd=a.kd_uskpd group by c.kodegiat) AS rekening
				FROM plh_form_isian a   
			    WHERE a.no_transaksi='$kode' AND kd_uskpd='$kd_skpd'";
				}
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row){
						$tgl= $this->tanggal_indonesia($row->tgl_baek);
						$ket= $row->keterangan;
						$tgl1= $row->tgl_baek;
						$kegiatan= $row->kegiatan;
						$tahun= substr($tgl1,0,4);
						$bulan= substr($tgl1,5,2);
						$tanggal= substr($tgl1,8,2);
						$jumtot= $row->tot+$row->totx;
						$jumtot11= $row->tot11+$row->tot11x;
						$jumtot2= $row->tot2+$row->tot2x;
						$tglfix = date("d/m/Y",strtotime("$row->tgl_baek"));
							$tanggalx = $tgl1; 
							$query = "SELECT datediff('$tanggalx', CURDATE()) as selisih";
							$hasil = mysql_query($query);
							$data  = mysql_fetch_array($hasil);
							$selisih = $data['selisih'];
							$x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y"));
							$namahari = date("l", $x);
								 if ($namahari == "Sunday") $namahari = "Minggu";
							else if ($namahari == "Monday") $namahari = "Senin";
							else if ($namahari == "Tuesday") $namahari = "Selasa";
							else if ($namahari == "Wednesday") $namahari = "Rabu";
							else if ($namahari == "Thursday") $namahari = "Kamis";
							else if ($namahari == "Friday") $namahari = "Jumat";
							else if ($namahari == "Saturday") $namahari = "Sabtu";
							
								$csqlku="SELECT
a.kode,a.nama,
CONCAT(SUBSTR(b.kodegiat,1,1),'.',SUBSTR(b.kodegiat,2,2),'.',SUBSTR(b.kodegiat,4,2),'.',SUBSTR(b.kodegiat,6,2),'.',SUBSTR(b.kodegiat,8,2),'.',SUBSTR(b.kode,1,1),'.',SUBSTR(b.kode,2,1),'.',SUBSTR(b.kode,3,1),'.',SUBSTR(b.kode,4,2),'.',SUBSTR(b.kode,6,2)) AS rekening
FROM m_rekening a
LEFT JOIN pld_form_isian b ON a.kode=b.kode 
WHERE b.no_transaksi='$kode' AND b.unit_skpd='$kd_skpd' GROUP BY kode";
							$hasil = $this->db->query($csqlku);
							$kodex="";
							$namax="";
							foreach ($hasil->result() as $rowkode){
								$nom 	 = $rowkode->kode;
								$gabung  = $rowkode->nama;
								$namarek = $rowkode->rekening; 
								if($gabung==1){
								$namax	= ($gabung);
								}else{
								$namax	= ($gabung.",".$namax);
								}
								if($namarek==1){
								$kodex	= ($namarek);
								}else{
								$kodex	= ($namarek.",".$kodex);
								}
								}
						//$row->kd_rekening,$row->rekening
							
		 $cRet = "<table width=\"100%\" border=\"0\" >
                  <tr>
                    <td colspan=\"1\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                         <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
						<table border=\"1\" width=\"80%\" align=\"center\">
						<tr><td align=\"center\" colspan=\"2\" style=\"font-size:18px;\" ><b>BERITA ACARA EVALUASI, KLARIFIKASI DAN NEGOSIASI</b></td></tr>
						<tr><td style=\"font-size:14px;\" width=\"50%\" >Nomor &nbsp;&nbsp;&nbsp;: $row->no_baek<br/>Tanggal &nbsp;: $tgl</td>
						<td valign=\"top\" style=\"font-size:14px;\">Pekerjaan &nbsp;: $row->keterangan</td></tr>
						<tr><td align=\"center\" style=\"font-size:14px;\"><b>Tahun Anggaran</b></td>
						<td rowspan=\"2\" valign=\"top\" style=\"font-size:14px;\">Kegiatan &nbsp;: $row->nm_kegiatan</td></tr>
						<tr><td align=\"center\" style=\"font-size:15px;\"><h1>$thn</h1></td></tr>
						</table>
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 <tr>
                            <td width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Pada Hari ini $namahari, Tanggal ".$this->mdata2->terbilang($tanggal)." Bulan ".$this->mdata2->getBulan($bulan)." Tahun ".$this->mdata2->terbilang($tahun)." ($tglfix), Kami yang bertanda tangan
							di bawah ini Pejabat Pengadaan $nama Kota Makassar yang dibentuk melalui Surat Keputusan Nomor : $no_sk, Melaksanakan Berita Acara Evaluasi, Klarifikasi dan Negoisasi $ket Tahun Anggaran $thn pada DPA SKPD $nama Kota Makassar dengan Nomor Rekening $kodex ($namax).</td>
						 </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\" >Rapat ini dihadiri oleh $row->jabatan, serta calon Penyedia Barang dan Jasa yang diundang dengan rincian sebagai berikut:</td>
                        </tr>
                       </table>
                    </table>
                    </td>
                         
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">";
                        if($kd_skpd=='1.18.01.00' && $kegiatan=='118011203'){
						$ppn=(($jumtot*10)/100);
						$cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Perkiraan Sendiri</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format(round($jumtot+$ppn))."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang(round($jumtot+$ppn))." Rupiah</i></td>
                        </tr>";}else{
						$cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Perkiraan Sendiri</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format($jumtot)."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang($jumtot)." Rupiah</i></td>
                        </tr>";
						}
                        $cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama Calon Penyedia</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\"><b>$row->rekanan</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Alamat</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$row->alamat_rekanan</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">NPWP</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$row->npwp</td>
                        </tr>";
						if($kd_skpd=='1.18.01.00' && $kegiatan=='118011203'){
						$ppn=(($jumtot*10)/100);
						$cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Penawaran</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format(round($jumtot11+$ppn))."</b></td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang(round($jumtot11+$ppn))." Rupiah</i></td>
                        </tr>";}else{
						$cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Penawaran</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format($jumtot11)."</b></td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang($jumtot11)." Rupiah</i></td>
                        </tr>";
						}
						
						$cRet.="</tr>
						 <tr>
						 <td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\"><j>Dalam pelaksanaan evaluasi dan klarifikasi terhadap harga penawaran tersebut
																						dinyatakan memenuhi persyaratan dan selanjutnya dilakukan proses negosiasi 
																						terhadap harga penawaran tersebut dengan rincian sebagai berikut : </j></td>
						</tr>";
						if($kd_skpd=='1.18.01.00' && $kegiatan=='118011203'){
						$ppn=(($jumtot*10)/100);
						$cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Negosiasi</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format(round($jumtot2+$ppn))."</b></td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang(round($jumtot2+$ppn))." Rupiah</i></td>
                        </tr>";}else{
						$cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Negosiasi</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format($jumtot2)."</b></td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang($jumtot2)." Rupiah</i></td>
                        </tr>";
						}
						
						$cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Jangka Waktu Pelaksanaan</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\">$row->spbj (".$this->mdata2->terbilang($row->spbj)." ) $row->ket_spbj</td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
						 </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\"><j>Demikian Berita Acara ini dibuat untuk dipergunakan sebagai bahan pertimbangan dalam pelaksanaan pengadaan langsung.</j></td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    </td>
                  </tr>";
                  $cRet .="<tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:12px;\" align=\"center\" >
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr><td></td>
                                            <td align=\"center\"><b>$row->rekanan</b><br><br><br><br><br><br>
                                            <b><u>$row->pimpinan_rekanan</u></b><br>$row->jabatan_rekanan
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"10%\">
                                </td>
                                <td width=\"60%\">
                                    <table border=\"0\" width=\"80%\" style=\"font-size:12px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">
											 <b>$row->jabatan</b><br><br><br><br><br><br>
												<b><u>$row->nama</u></b><br>Pangkat:$row->pangkat<br>Nip.$row->nip
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                        </table>
                    </td>
                  </tr>
                </table>";}
        
         echo $cRet;
    }
	if($ctk=='9')
        {
		$kd_skpd = $this->session->userdata('skpd');
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$iduser			= $this->session->userdata('iduser');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$no 			= $_REQUEST['kode'];		

		if($skpd=='1.02.01.00' && $iduser=='842'){
		$csql = "SELECT a.keterangan,a.kegiatan,a.nm_kegiatan,a.total,
					(SELECT ifnull(tgl_baek,0) as tgl_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_baek,
					(SELECT ifnull(no_baek,0) as no_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_baek,
					(SELECT nama FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS rekanan,
					(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS pimpinan_rekanan,
					(SELECT ktp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS ktp,
					(SELECT rumah FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS alamat_rekanan,
					(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
					(SELECT npwp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS npwp,
					
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nama, 
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS jabatan, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS pangkat,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nip,
					
					(SELECT nama FROM m_rekening a LEFT JOIN pld_form_isian b ON b.kode=a.kode WHERE b.no_transaksi='$kode' AND b.unit_skpd='$skpd' GROUP BY b.kodegiat)AS rekening,
					(SELECT SUM(jml_hps) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_tawar) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot1,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot2
					FROM plh_form_isian a WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$skpd'";}else{
		$csql = "SELECT a.keterangan,a.kegiatan,a.nm_kegiatan,a.total,
					(SELECT ifnull(tgl_baek,0) as tgl_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_baek,
					(SELECT ifnull(no_baek,0) as no_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_baek,
					(SELECT nama FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS rekanan,
					(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS pimpinan_rekanan,
					(SELECT ktp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS ktp,
					(SELECT rumah FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS alamat_rekanan,
					(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
					(SELECT npwp FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS npwp,
					
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS jabatan,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nama,
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS pangkat,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nip,
					
					(SELECT nama FROM m_rekening a LEFT JOIN pld_form_isian b ON b.kode=a.kode WHERE b.no_transaksi='$kode' AND b.unit_skpd='$skpd' GROUP BY b.kodegiat)AS rekening,
					(SELECT SUM(jml_hps) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_tawar) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot1,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot2
					FROM plh_form_isian a WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$skpd'";
					}
                           
	   $hasil = $this->db->query($csql);
	   $i 	  = 0;
	   foreach ($hasil->result() as $rowi){
	   $cRet  = '';
	   $keterangan = $rowi->keterangan;
	   $nm_kegiatan= $rowi->nm_kegiatan;
	   $kegiatan   = $rowi->kegiatan;
	   $noupl      = $rowi->no_baek;
	   $jumtot     = $rowi->tot;
	   $jumtot1    = $rowi->tot1;
	   $jumtot2    = $rowi->tot2;
	   
	   $ctgl=$rowi->tgl_baek;
	   $ctanggal=$this->tanggal_indonesia($ctgl); 
	   
          $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				  <tr>
					<td colspan=\"3\">&nbsp;<td>
                  </tr>
				   <tr>
                    <td colspan=\"3\">&nbsp;<td>
                   </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
						 <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Lampiran
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">BERITA ACARA EVALUASI, KLARIFIKASI DAN NEGOSIASI
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Nomor
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$noupl
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Tanggal
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$ctanggal
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Pekerjaan
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$keterangan
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Kegiatan
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$nm_kegiatan
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>";//}
                         $cRet .="<tr>
                           <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                                    <tr>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\" rowspan=\"2\"><b>NO</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\" rowspan=\"2\"><b>URAIAN</b></td>
                                        <td bgcolor=\"#CCCCCC\"  align=\"center\" style=\"font-size:13px;\" rowspan=\"2\"><b>SATUAN</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\" rowspan=\"2\"><b>KUANTITAS</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\" colspan=\"2\"><b>HARGA PERKIRAAN SENDIRI</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\" colspan=\"2\"><b>PENAWARAN</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\" colspan=\"2\"><b>NEGOSIASI</b></td>
                                    </tr>
									<tr>
										<td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>HARGA SATUAN</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>HARGA SATUAN</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>HARGA SATUAN</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
										
                                    </tr>
									<tr>
                                        <td align=\"center\" style=\"font-size:13px;\">1</td>
                                        <td align=\"center\" style=\"font-size:13px;\">2</td>
                                        <td align=\"center\" style=\"font-size:13px;\">3</td>
                                        <td align=\"center\" style=\"font-size:13px;\">4</td>
										<td align=\"center\" style=\"font-size:13px;\">5</td>
										<td align=\"center\" style=\"font-size:13px;\">6=(5x4)</td>
										<td align=\"center\" style=\"font-size:13px;\">7</td>
										<td align=\"center\" style=\"font-size:13px;\">8=(7x4)</td>
										<td align=\"center\" style=\"font-size:13px;\">9</td>
										<td align=\"center\" style=\"font-size:13px;\">10=(9x4)</td>
                                    </tr>";
							  		$sql="SELECT a.kode,a.nama,b.no_transaksi,b.unit_skpd,CONCAT(b.kode,b.no) AS rekening FROM m_rekening a 
									LEFT JOIN pld_form_isian b ON a.kode=b.kode WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
									
							  $hsql=$this->db->query($sql);
								$jumlahxa  	= 0;
								$jumlahxz 	= 0;
								$jumlahxa1  = 0;
								$jumlahxz1 	= 0;
								$jumlahxa2  = 0;
								$jumlahxz2 	= 0;
							  foreach ($hsql->result() as $row)
								{
									$i++; 
									$no_trans   =$row->no_transaksi;
									$nmkegiatan =$row->nama;
									$kd_skpd    =$row->unit_skpd;
									$ckoderek   =$row->kode;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\">$i</td>
                                        <td align=\"left\" style=\"font-size:13px;\">$nmkegiatan</td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
										<td align=\"center\" style=\"font-size:13px;\"></td>
										<td align=\"center\" style=\"font-size:13px;\"></td>
										<td align=\"center\" style=\"font-size:13px;\"></td>
										<td align=\"center\" style=\"font-size:13px;\"></td>
										<td align=\"center\" style=\"font-size:13px;\"></td>
										<td align=\"center\" style=\"font-size:13px;\"></td>
                                    </tr>";
                                    
                             // $csql = "SELECT b.uraian,b.satuan,b.vol,b.harga,b.jumlah,a.total as jumlahxxx FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' and b.unit_skpd='$kd_skpd' group by kode";
							  // $csql = "SELECT CONCAT(b.kode,b.no) AS rekening,b.uraian,b.satuan,b.vol,b.harga,b.jumlah FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' AND b.unit_skpd='$kd_skpd' GROUP BY rekening  ORDER BY rekening";
							 $csql = "SELECT * FROM (
										SELECT kode,no_transaksi,unit_skpd,CONCAT(kode,NO) AS rekening,kodegiat,no,tahun,uraian,satuan,vol,jumlah,harga_hps,harga_tawar,harga_akhir,jml_hps,jml_tawar,jml_akhir FROM pld_form_isian 
										WHERE no_transaksi='$no_trans' AND unit_skpd='$kd_skpd')a WHERE LEFT(rekening,7)=$ckoderek  ORDER BY kode,no";
							  $hasil = $this->db->query($csql);
								foreach ($hasil->result() as $row)
								{
									$no_transaksi  	=$row->no_transaksi;
									$unit_skpd 		=$row->unit_skpd;
									$kode 			=$row->kode;
									$kodegiat		=$row->kodegiat;
									$no				=$row->no;
									$tahun			=$row->tahun;
									$uraian			=$row->uraian;
									$jumlahxx  		=$row->jml_hps;
									$jumlahxx1  	=$row->jml_tawar;
									$jumlahxx2  	=$row->jml_akhir;
									$jumlahxa  		=$jumlahxa+$jumlahxx;
									$jumlahxa1 		=$jumlahxa1+$jumlahxx1;
									$jumlahxa2 		=$jumlahxa2+$jumlahxx2;
                           $cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">$row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol<>0){
                                        $cRet.="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->harga_hps<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga_hps)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->jml_hps<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jml_hps)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->harga_tawar<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga_tawar)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->jml_tawar<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jml_tawar)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->harga_akhir<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga_akhir)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->jml_akhir<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jml_akhir)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
                                    $cRet.="</tr>";
								$csq2 = "SELECT a.no_transaksi,a.kd_skpd,CONCAT(a.kode,a.NO) AS rekening,a.uraian,a.satuan,a.vol,a.harga,a.jumlah,a.harga_hps,a.jml_hps,a.harga_tawar,a.jml_tawar,a.harga_akhir,a.jml_akhir FROM pld_form_rincian a 
										INNER JOIN pld_form_isian b ON a.`no_transaksi`=b.`no_transaksi` AND a.`kode`=a.`kode` AND a.`kodegiat`=b.`kodegiat`
										AND a.`no`=a.`no` AND a.`uraian_header`=b.`uraian` AND a.`tahun`=b.`tahun`
									    WHERE b.no_transaksi='$no_transaksi' AND b.unit_skpd='$unit_skpd' 
										and b.kode='$kode' and b.kodegiat='$kodegiat' and b.no='$no' and b.uraian='$uraian' and b.tahun='$tahun' ORDER BY a.kode,a.no,a.no_urut";
								$hasi2 = $this->db->query($csq2);
								
								foreach ($hasi2->result() as $row)
								{
									$jumlahxxd  =$row->jml_hps;
									$jumlahxxd1  =$row->jml_tawar;
									$jumlahxxd2  =$row->jml_akhir;
									$jumlahxz 	=$jumlahxz+$jumlahxxd;
									$jumlahxz1 	=$jumlahxz1+$jumlahxxd1;
									$jumlahxz2 	=$jumlahxz2+$jumlahxxd2;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">- $row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol<>0){
                                        $cRet.="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->harga_hps<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga_hps)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->jml_hps<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jml_hps)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->harga_tawar<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga_tawar)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->jml_tawar<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jml_tawar)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->harga_akhir<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga_akhir)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->jml_akhir<>0){
										$cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jml_akhir)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
                                    $cRet.="</tr>";
								}	
                                    
									}}
								if($unit_skpd=='1.18.01.00' && $kegiatan=='118011203'){	
							  $tott = $jumlahxa+$jumlahxz;
							  $tott1 = $jumlahxa1+$jumlahxz1;
							  $tott2 = $jumlahxa2+$jumlahxz2;
							  $ppn1	= (($tott*10)/100);
							  $ppn2	= (($tott1*10)/100);
							  $ppn3	= (($tott2*10)/100);
                              $cRet .="<tr>
                                        <td align=\"right\" colspan=\"4\" style=\"font-size:13px;\"><b>TOTAL</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott1)."</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott2)."</b></td>
                                    </tr><tr>
                                        <td align=\"right\" colspan=\"4\" style=\"font-size:13px;\"><b>PPN 10%</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($ppn1)."</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($ppn2)."</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($ppn3)."</b></td>
                                    </tr><tr>
                                        <td align=\"right\" colspan=\"4\" style=\"font-size:13px;\"><b>JUMLAH TOTAL</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format(round($tott+$ppn1))."</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format(round($tott1+$ppn2))."</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format(round($tott2+$ppn3))."</b></td>
                                    </tr>
                                </table>";}else{
							  $tott = $jumlahxa+$jumlahxz;
							  $tott1 = $jumlahxa1+$jumlahxz1;
							  $tott2 = $jumlahxa2+$jumlahxz2;
                              $cRet .="<tr>
                                        <td align=\"center\" colspan=\"4\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott1)."</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:13px;\"><b></b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott2)."</b></td>
                                    </tr>
                                </table>";
								}
						if($unit_skpd=='1.18.01.00' && $kegiatan=='118011203'){		
						$cRet .="<table>
									<tr>
										<td colspan=\"2\">&nbsp;<td>
									</tr>
									<tr>
										<td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Negosiasi</td>
										<td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
										<td width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format(round($tott2+$ppn3))."</b></td>
									</tr>
									<tr>
										<td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
										<td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
										<td width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang(round($tott2+$ppn3))." Rupiah</i></td>
									</tr>
								</table>";
								}else{	
						$cRet .="<table>
									<tr>
										<td colspan=\"2\">&nbsp;<td>
									</tr>
									<tr>
										<td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Negosiasi</td>
										<td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
										<td width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format($tott2)."</b></td>
									</tr>
									<tr>
										<td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
										<td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
										<td width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang($tott2)." Rupiah</i></td>
									</tr>
									
								</table>";
								}
								$cRet .="<table>
										<tr>
											<td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga negosiasi ini telah termasuk segala kewajiban pajak</td>
										</tr>
								</table>";
							
                 $cRet .="<tr>
				  <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
					 
                        <table border=\"0\" width=\"500%\" style=\"font-size:12px;\" align=\"center\" >
                            <tr>
                                <td width=\"40%\" valign=\"top\" align=\"rigth\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\" >
                                        <tr><td></td>
                                            <td align=\"center\">Untuk dan Atas Nama<br><b>$rowi->rekanan</b><br><br><br><br><br><br>
                                            <u><b>$rowi->pimpinan_rekanan</b></u><br>$rowi->jabatan_rekanan
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"15%\">
                                </td>
                                <td width=\"55%\">
                                    <table border=\"0\" width=\"80%\" style=\"font-size:12px;\" align=\"center\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\" width=\"40%\">
											 <b>$rowi->jabatan</b><br><br><br><br><br><br><br>
												<u><b>$rowi->nama</b></u><br>Pangkat:$rowi->pangkat<br>Nip.$rowi->nip
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                       
                    </td>
                  </tr>
                </table>";}
        
         echo $cRet;
    }		
	if($ctk=='10')
          {
			$kd_skpd = $this->session->userdata('skpd');
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$iduser			= $this->session->userdata('iduser');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];		

		if($kd_skpd=='1.02.01.00' && $iduser=='842'){
		$csql = "SELECT a.keterangan,a.nm_kegiatan,a.total,a.kegiatan,
					(SELECT CONCAT(SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,4,2),'.',SUBSTR(kodegiat,6,2),'.',SUBSTR(kodegiat,8,2),'.',SUBSTR(kode,1,1),'.',SUBSTR(kode,2,1),'.',SUBSTR(kode,3,1),'.',SUBSTR(kode,4,2),'.',SUBSTR(kode,6,2)) AS rek FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd GROUP BY kodegiat) AS kd_rekening,
					(SELECT ifnull(tgl_bahp,0) as tgl_bahp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_bahp,
					(SELECT ifnull(no_bahp,0) as no_bahp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_bahp,
					(SELECT ifnull(spbj,0) as spbj FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS spbj,
					(select ifnull(ket_spbj,0) as ket_spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as ket_spbj,
					(SELECT nama FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS rekanan,
					(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS pimpinan_rekanan,
					(SELECT ktp FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS ktp,
					(SELECT rumah FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS alamat_rekanan,
					(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
					(SELECT npwp FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS npwp,
					(SELECT SUM(jumlah) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jumlah) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS totx,
					(SELECT SUM(jml_hps) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot1,
					(SELECT SUM(jml_hps) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot1x,
					(SELECT SUM(jml_tawar) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot2,
					(SELECT SUM(jml_tawar) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2x,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot3,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot3x,
					
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nama, 
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS jabatan, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS pangkat,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nip,
					
					(SELECT nama FROM m_rekening b inner join pld_form_isian c on b.kode=c.kode where c.no_transaksi=a.no_transaksi AND c.unit_skpd=a.kd_uskpd group by c.kodegiat) AS rekening
				FROM plh_form_isian a 
			    WHERE a.no_transaksi='$kode' AND kd_uskpd='$kd_skpd'";}else{$csql = "SELECT a.keterangan,a.nm_kegiatan,a.total,a.kegiatan,
					(SELECT CONCAT(SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,1,1),'.',SUBSTR(kodegiat,2,2),'.',SUBSTR(kodegiat,4,2),'.',SUBSTR(kodegiat,6,2),'.',SUBSTR(kodegiat,8,2),'.',SUBSTR(kode,1,1),'.',SUBSTR(kode,2,1),'.',SUBSTR(kode,3,1),'.',SUBSTR(kode,4,2),'.',SUBSTR(kode,6,2)) AS rek FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd GROUP BY kodegiat) AS kd_rekening,
					(SELECT ifnull(tgl_bahp,0) as tgl_bahp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_bahp,
					(SELECT ifnull(no_bahp,0) as no_bahp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_bahp,
					(SELECT ifnull(spbj,0) as spbj FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS spbj,
					(select ifnull(ket_spbj,0) as ket_spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as ket_spbj,
					(SELECT nama FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS rekanan,
					(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS pimpinan_rekanan,
					(SELECT ktp FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS ktp,
					(SELECT rumah FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS alamat_rekanan,
					(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
					(SELECT npwp FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS npwp,
					(SELECT SUM(jumlah) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jumlah) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS totx,
					(SELECT SUM(jml_hps) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot1,
					(SELECT SUM(jml_hps) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot1x,
					(SELECT SUM(jml_tawar) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot2,
					(SELECT SUM(jml_tawar) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2x,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot3,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot3x,
					
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS jabatan,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nama,
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS pangkat,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND kode=a.anggota_satu) AS nip,
					
					(SELECT nama FROM m_rekening b inner join pld_form_isian c on b.kode=c.kode where c.no_transaksi=a.no_transaksi AND c.unit_skpd=a.kd_uskpd group by c.kodegiat) AS rekening
				FROM plh_form_isian a 
			    WHERE a.no_transaksi='$kode' AND kd_uskpd='$kd_skpd'";
				}
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row){
						$tgl= $this->tanggal_indonesia($row->tgl_bahp);
						$ket= $row->keterangan;
						$kegiatan= $row->kegiatan;
						$jumtot  =$row->tot+$row->totx;
						$jumtot1 =$row->tot1+$row->tot1x;
						$jumtot2 =$row->tot2+$row->tot2x;
						$jumtot3 =$row->tot3+$row->tot3x;
						$tahun= substr($row->tgl_bahp,0,4);
						$bulan= substr($row->tgl_bahp,5,2);
						$tanggal= substr($row->tgl_bahp,8,2);
						$tglfix = date("d/m/Y",strtotime("$row->tgl_bahp"));
							$tanggalx = $row->tgl_bahp; 
							$query = "SELECT datediff('$tanggalx', CURDATE()) as selisih";
							$hasil = mysql_query($query);
							$data  = mysql_fetch_array($hasil);
							$selisih = $data['selisih'];
							$x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y"));
							$namahari = date("l", $x);
								 if ($namahari == "Sunday") $namahari = "Minggu";
							else if ($namahari == "Monday") $namahari = "Senin";
							else if ($namahari == "Tuesday") $namahari = "Selasa";
							else if ($namahari == "Wednesday") $namahari = "Rabu";
							else if ($namahari == "Thursday") $namahari = "Kamis";
							else if ($namahari == "Friday") $namahari = "Jumat";
							else if ($namahari == "Saturday") $namahari = "Sabtu";
		 $cRet = "<table width=\"100%\" border=\"0\" >
                  <tr>
                    <td colspan=\"1\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                         <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
						<table border=\"1\" width=\"80%\" align=\"center\">
						<tr><td align=\"center\" colspan=\"2\" style=\"font-size:18px;\" ><b>BERITA ACARA HASIL PENGADAAN LANGSUNG</b></td></tr>
						<tr><td style=\"font-size:14px;\" width=\"50%\" >Nomor &nbsp;&nbsp;&nbsp;: $row->no_bahp<br/>Tanggal &nbsp;: $tgl</td>
						<td valign=\"top\" style=\"font-size:14px;\">Pekerjaan &nbsp;: $row->keterangan</td></tr>
						<tr><td align=\"center\" style=\"font-size:14px;\"><b>Tahun Anggaran</b></td>
						<td rowspan=\"2\" valign=\"top\" style=\"font-size:14px;\">Kegiatan &nbsp;: $row->nm_kegiatan</td></tr>
						<tr><td align=\"center\" style=\"font-size:15px;\"><h1>$thn</h1></td></tr>
						</table>
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 <tr>
                            <td width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Pada Hari ini $namahari, Tanggal ".$this->mdata2->terbilang($tanggal)." Bulan ".$this->mdata2->getBulan($bulan)." Tahun ".$this->mdata2->terbilang($tahun)."  ($tglfix), bertempat
							di $nama Kota Makassar, telah selesai dilaksanakan proses Pengadaan Langsung Pekerjaan $ket dengan rincian sebagai berikut : </td>
						 </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
                       </table>
                    </table>
                    </td>
                         
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">";
						if($kd_skpd=='1.18.01.00' && $kegiatan=='118011203'){
						$ppn=(($jumtot*10)/100);
						$ppn1=(($jumtot1*10)/100);
                        $cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">PAGU Anggaran</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format(round($jumtot+$ppn))."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang(round($jumtot+$ppn))." Rupiah</i></td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Perkiraan Sendiri</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format(round($jumtot1+$ppn1))."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang(round($jumtot1+$ppn1))." Rupiah</i></td>
                        </tr>";
						}else{
                        $cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">PAGU Anggaran</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format($jumtot)."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang($jumtot)." Rupiah</i></td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Perkiraan Sendiri</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format($jumtot1)."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang($jumtot1)." Rupiah</i></td>
                        </tr>";}
						
                        $cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama Calon Penyedia</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\"><b>$row->rekanan</b></td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Alamat</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$row->alamat_rekanan</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">NPWP</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$row->npwp</td>
                        </tr>";
						
						if($kd_skpd=='1.18.01.00' && $kegiatan=='118011203'){
						$ppn2=(($jumtot2*10)/100);
						$ppn3=(($jumtot3*10)/100);
						$cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Penawaran</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format(round($jumtot2+$ppn2))."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang(round($jumtot2+$ppn2))." Rupiah</i></td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Negosiasi</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format(round($jumtot3+$ppn3))."</b></td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang(round($jumtot3+$ppn3))." Rupiah</i></td>
                        </tr>";}else{$cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Penawaran</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format($jumtot2)."</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang($jumtot2)." Rupiah</i></td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Harga Negosiasi</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><b>Rp. ".number_format($jumtot3)."</b></td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terbilang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"><i>".$this->mdata2->terbilang($jumtot3)." Rupiah</i></td>
                        </tr>";
						}
						
						
						$cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Jangka Waktu Pelaksanaan Pekerjaan</td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" valign=\"top\"> $row->spbj $row->ket_spbj</td>
                        </tr>
						</tr>
						 <tr>
						 <td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\"><j>Unsur - unsur yang dievaluasi sebagai berikut : </j></td>
						</tr>
						<tr>
						 <td  align=\"left\" width=\"20%\" colspan=\"3\" style=\"font-size:14px;\"><j>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Surat Penawaran    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Memenuhi Persyaratan</j></td>
						</tr>
						<tr>
						 <td  align=\"left\" width=\"20%\" colspan=\"3\" style=\"font-size:14px;\"><j>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Harga Penawaran    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Memenuhi Persyaratan</j></td>
						</tr>
						<tr>
						 <td  align=\"left\" width=\"20%\" colspan=\"3\" style=\"font-size:14px;\"><j>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Jangka Pelaksanaan &nbsp;&nbsp; : Memenuhi Persyaratan</j></td>
						</tr>
						 </tr>
						  <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\"><j>Demikian Berita Acara ini dibuat untuk dipergunakan sebagai bahan pertimbangan dalam pelaksanaan pengadaan langsung.</j></td>
                        </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    </td>
                  </tr>";
                  $cRet .="<tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:12px;\" align=\"center\" >
                            <tr>
                                <td width=\"20%\" valign=\"top\">
                                </td>
                                <td width=\"30%\">
                                </td>
                                <td width=\"50%\">
                                     <table border=\"0\" width=\"80%\" style=\"font-size:12px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">
											  <b>$row->jabatan</b><br><br><br><br><br>
												<b><u>$row->nama</u></b><br>Pangkat:$row->pangkat<br>Nip.$row->nip
                                             </td>
                                         </tr> 
                                     </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                        </table>
                    </td>
                  </tr>
                </table>";}
        
         echo $cRet;
    }
	if($ctk=='11')
        {
		$kd_skpd = $this->session->userdata('skpd');
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
		$ckeg           = "SELECT a.bagian FROM m_kegiatan a INNER JOIN plh_form_isian b ON b.kegiatan=a.kode WHERE b.no_transaksi='$no' AND b.kd_uskpd='$skpd'";
		$hasilkeg = $this->db->query($ckeg);
						$i = 0;
					foreach ($hasilkeg->result() as $rowkeg)
					
		$ckeg1 = $rowkeg->bagian;
		
		if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00' or $skpd=='1.03.01.00'){
			if($ckeg1<>''){
		$csql = "SELECT a.keterangan,a.nm_kegiatan AS nama_kegiatan,a.kegiatan,
					(SELECT nama FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS nama_rekanan,		
					(SELECT tgl_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS tanggal_sppbj, 
					(SELECT no_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_sppbj,
					(SELECT tgl_spr FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS tanggal_spr, 
					(SELECT no_spr FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_spr, 
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2,
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS ketua, 
					(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS jabatan_ketua,
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nama_singkat_ketua, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS pangkat_ketua,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nip_ketua
					FROM plh_form_isian a WHERE a.no_transaksi='$kode' AND a.`kd_uskpd`='$skpd'";
					}
					else {
		$csql = "SELECT a.keterangan,a.nm_kegiatan AS nama_kegiatan,a.kegiatan,
					(SELECT nama FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS nama_rekanan,		
					(SELECT tgl_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS tanggal_sppbj, 
					(SELECT no_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_sppbj,
					(SELECT tgl_spr FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS tanggal_spr, 
					(SELECT no_spr FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_spr, 
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
					(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua, 
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua,
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua, 
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua 
					FROM plh_form_isian a WHERE a.no_transaksi='$kode' AND a.`kd_uskpd`='$skpd'";
				}
			}
					else {
			$csql = "SELECT a.keterangan,a.nm_kegiatan AS nama_kegiatan,a.kegiatan,
					(SELECT nama FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS nama_rekanan,		
					(SELECT tgl_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS tanggal_sppbj, 
					(SELECT no_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_sppbj,
					(SELECT tgl_spr FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS tanggal_spr, 
					(SELECT no_spr FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_spr, 
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
					(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua, 
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua,
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua, 
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua 
					FROM plh_form_isian a WHERE a.no_transaksi='$kode' AND a.`kd_uskpd`='$skpd'";
			}
					
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row){
						$tgl= $this->tanggal_indonesia($row->tanggal_sppbj);
						$tgl1= $this->tanggal_indonesia($row->tanggal_spr);
						$nmsngkat = $row->nama_singkat_ketua;
		 $cRet = "<table width=\"100%\" border=\"0\" >
                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                      <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                        <tr><td></td>
                            <td colspan=\"2\" style=\"font-size:16px;\" align=\"center\">
                                <b><u>SURAT PENUNJUKAN PENYEDIAAN BARANG/JASA (SPPBJ)</u></b>
                                <br>&nbsp;
                            </td>
                        </tr>
                    </table>
						</table>
						<table border=\"0\" width=\"100%\">
						<tr>
						<td width=\"66%\" ></td>
						<td style=\"font-size:14px;\">Makassar, $tgl</td>
						</tr>
						
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" align=\"center\" style=\"padding-left:5%;padding-right:2%;\" style=\"font-size:14px;\">
						
                        <tr>
                            <td width=\"3%\" style=\"font-size:14px;\" valign=\"top\">Nomor
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:
                            </td>
                            <td  width=\"30%\" style=\"font-size:14px;\" valign=\"top\">$row->no_sppbj
                            </td>
							<td width=\"30%\" style=\"font-size:14px;\">
                            </td>
							<td width=\"60%\" style=\"font-size:14px;\" valign=\"top\">Kepada</td>
							</td>	
                        </tr>
                        <tr>
                            <td width=\"3%\" style=\"font-size:14px;\" valign=\"top\">Lampiran
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:
                            </td>
                            <td  width=\"30%\" style=\"font-size:14px;\" valign=\"top\">-
							<td width=\"30%\" style=\"font-size:14px;\">
                            </td>
							<td width=\"60%\" style=\"font-size:14px;\" valign=\"top\">Yth. <b>Pimpinan/Direktur</b><br>$row->nama_rekanan</td>
                        </tr>
                        <tr>
                            <td width=\"3%\" style=\"font-size:14px;\" valign=\"top\">Perihal
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\" valign=\"top\">:
                            </td>
                            <td align=\"justify\" width=\"30%\" style=\"font-size:13px;\" valign=\"top\">Penunjukan Penyediaan Barang/Jasa untuk Pelaksanaan Pekerjaan $row->keterangan pada Kegiatan $row->nama_kegiatan.
                            </td>
							<td width=\"30%\" style=\"font-size:13px;\">
                            </td>
							<td width=\"60%\" style=\"font-size:13px;\" valign=\"top\">di -<br/>&nbsp;&nbsp;&nbsp;Makassar</td>
                        </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
                    <table border=\"0\" width=\"100%\" align=\"center\" style=\"padding-left:5%;padding-right:2%;\" style=\"font-size:14px;\">
							
							<tr>
								<td width=\"70%\" colspan=\"5\" align=\"justify\" style=\"font-size:14px;\">Dengan ini kami beritahukan bahwa penawaran Saudara Nomor: $row->no_spr Tanggal $tgl1 tentang $row->keterangan pada Kegiatan $row->nama_kegiatan dengan Hasil Negoisasi harga sebesar Rp. ".number_format($row->tot+$row->tot2)." (".$this->mdata2->terbilang($row->tot+$row->tot2)." Rupiah) kami nyatakan diterima/disetujui.</td>
							</tr>
							 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
							</tr>
							<tr>
								<td width=\"70%\" colspan=\"5\" align=\"justify\" style=\"font-size:14px;\">Sebagai tindak lanjut dari Surat Penunjukan Penyedia Barang/Jasa (SPPBJ) ini saudara diharuskan (menyerahkan jaminan pelaksanaan dan untuk nilai paket di atas 200 juta) menandatangani (Surat Perjanjian/Surat Perintah Kerja (SPK)) paling lambat 14 (empat belas) hari kerja setelah diterbitkan SPPBJ. Kegagalan Saudara untuk menerima penunjukan ini yang disusun berdasarkan evaluasi terhadap penawaran evaluasi terhadap penawaran saudara, akan dikenakan sanksi sesuai ketentuan dalam Peraturan Presiden No. 70 Tahun 2012 beserta petunjuk teknisnya.</td>
							</tr>
					</table>
					 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
					<tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
                       ";                                    
                              $cRet .="
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                            <tr>
                                <td width=\"30%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                                        <tr><td></td>
                                            <td align=\"center\"></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"15%\">
                                </td>
                                <td width=\"65%\">
                                    <table border=\"0\" width=\"80%\" style=\"font-size:14px;\">
									<tr>";
											if($skpd=='1.02.01.00'){
											$cRet.="
                                            <td colspan=\"2\" align=\"center\"><br>
											KUASA PENGGUNA ANGGARAN<BR>
											Selaku Pejabat Pembuat Komitmen<br><br><br><br><b><u>$row->ketua</u></b><br>
											Pangkat: $row->pangkat_ketua<br>Nip.$row->nip_ketua
                                            </td>";
											}elseif($skpd=='1.03.01.00'){
											$cRet.="<td></td>
                                            <td align=\"center\">Mengetahui<br>
                                            <b>$row->jabatan_ketua</b><br>Selaku Kuasa Pengguna Anggaran<br><br><br><br><br>
                                            <b><u>$row->ketua</u></b><br>Pangkat: $row->pangkat_ketua<br>Nip. $row->nip_ketua
                                            </td>";}
											elseif($skpd=='2.05.01.00'){
											$cRet.="
                                            <td colspan=\"2\" align=\"center\"><br>
											KEPALA ".strtoupper($nama)." <br>
											Selaku $nmsngkat<br><br><br><br><b><u>$row->ketua</u></b><br>
												Pangkat: $row->pangkat_ketua<br>Nip.$row->nip_ketua
                                            </td>";}
											else{$cRet.="
												<td colspan=\"2\" align=\"center\">
												<b>$row->nama_singkat_ketua</b><br>Selaku Pejabat Pembuat Komitmen<br><br><br><br><b><u>$row->ketua</u></b><br>
												Pangkat: $row->pangkat_ketua<br>Nip.$row->nip_ketua
                                            </td>";}
                                        $cRet.="</tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                        </table>
						<table border=\"0\" width=\"100%\" align=\"center\" style=\"padding-left:5%;padding-right:2%;\" style=\"font-size:13px;\">
						<tr><td style=\"font-size:14px;\">Tembusan Yth:</td></tr>
						<tr><td style=\"font-size:14px;\">1. Inspektorat Daerah</td></tr>
						<tr><td style=\"font-size:14px;\">2. Unit Pelayanan Pengadaan</td></tr>
						</table>
                    </td>
                  </tr>
                </table>";}
        
         echo $cRet;
    }
		
	if($ctk=='12')
       {
	    $kd_skpd = $this->session->userdata('skpd');
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
			$ckeg           = "SELECT a.bagian FROM m_kegiatan a INNER JOIN plh_form_isian b ON b.kegiatan=a.kode WHERE b.no_transaksi='$no' AND b.kd_uskpd='$skpd'";
		$hasilkeg = $this->db->query($ckeg);
						$i = 0;
					foreach ($hasilkeg->result() as $rowkeg)
					
		$ckeg1 = $rowkeg->bagian;
		
		if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00' or $skpd=='1.03.01.00'){
			if($ckeg1<>''){
				$csql = "SELECT a.total AS tot,a.keterangan,a.nm_kegiatan,a.kegiatan,
					(SELECT tgl_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_upl,
					(SELECT no_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_upl,
					(SELECT tgl_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spr,
					(SELECT no_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spr,
					(SELECT tgl_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_baek,
					(SELECT no_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_baek,
					(SELECT tgl_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_baek,
					(SELECT no_bahp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_bahp,
					(SELECT tgl_bahp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_bahp,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spk,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spk,
					(SELECT spbj FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS spbj,
					(SELECT nama from mrekanan where kode=a.rekanan and kd_skpd=a.kd_uskpd) as nama_rekanan,
					(SELECT pimpinan from mrekanan where kode=a.rekanan and kd_skpd=a.kd_uskpd) as pimpinan,
					(SELECT jabatan from mrekanan where kode=a.rekanan and kd_skpd=a.kd_uskpd) as jabatan,
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nama_pejabat, 
					(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS jabatan2,
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nama_singkat_ketua, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS pangkat_pejabat,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nip_pejabat,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
					FROM plh_form_isian a 
					WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";
					} else {
				$csql = "SELECT a.total AS tot,a.keterangan,a.nm_kegiatan,a.kegiatan,
					(SELECT tgl_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_upl,
					(SELECT no_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_upl,
					(SELECT tgl_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spr,
					(SELECT no_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spr,
					(SELECT tgl_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_baek,
					(SELECT no_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_baek,
					(SELECT tgl_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_baek,
					(SELECT no_bahp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_bahp,
					(SELECT tgl_bahp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_bahp,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spk,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spk,
					(SELECT spbj FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS spbj,
					(SELECT nama from mrekanan where kode=a.rekanan and kd_skpd=a.kd_uskpd) as nama_rekanan,
					(SELECT pimpinan from mrekanan where kode=a.rekanan and kd_skpd=a.kd_uskpd) as pimpinan,
					(SELECT jabatan from mrekanan where kode=a.rekanan and kd_skpd=a.kd_uskpd) as jabatan,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd='$kd_skpd' AND singkat='PA') AS jabatan2,
					(SELECT nama FROM mpejabat WHERE kd_skpd='$kd_skpd' AND singkat='PA') AS nama_pejabat, 
					(SELECT pangkat FROM mpejabat WHERE kd_skpd='$kd_skpd' AND singkat='PA') AS pangkat_pejabat, 
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd='$kd_skpd' AND singkat='PA') AS nama_singkat_ketua, 
					(SELECT nip FROM mpejabat WHERE kd_skpd='$kd_skpd' AND singkat='PA') AS nip_pejabat,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
					FROM plh_form_isian a 
					WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";
			} 
		} else {
			$csql = "SELECT a.total AS tot,a.keterangan,a.nm_kegiatan,a.kegiatan,
					(SELECT tgl_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_upl,
					(SELECT no_upl FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_upl,
					(SELECT tgl_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spr,
					(SELECT no_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spr,
					(SELECT tgl_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_baek,
					(SELECT no_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_baek,
					(SELECT tgl_baek FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_baek,
					(SELECT no_bahp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_bahp,
					(SELECT tgl_bahp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_bahp,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spk,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spk,
					(SELECT spbj FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS spbj,
					(SELECT nama from mrekanan where kode=a.rekanan and kd_skpd=a.kd_uskpd) as nama_rekanan,
					(SELECT pimpinan from mrekanan where kode=a.rekanan and kd_skpd=a.kd_uskpd) as pimpinan,
					(SELECT jabatan from mrekanan where kode=a.rekanan and kd_skpd=a.kd_uskpd) as jabatan,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd='$kd_skpd' AND singkat='PA') AS jabatan2,
					(SELECT nama FROM mpejabat WHERE kd_skpd='$kd_skpd' AND singkat='PA') AS nama_pejabat, 
					(SELECT pangkat FROM mpejabat WHERE kd_skpd='$kd_skpd' AND singkat='PA') AS pangkat_pejabat, 
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd='$kd_skpd' AND singkat='PA') AS nama_singkat_ketua, 
					(SELECT nip FROM mpejabat WHERE kd_skpd='$kd_skpd' AND singkat='PA') AS nip_pejabat,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
					FROM plh_form_isian a 
					WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";
				}
					
				$hasil = $this->db->query($csql);
				$i = 0; 
						foreach ($hasil->result() as $row){
						$tgl= $this->tanggal_indonesia($row->tgl_upl);
						$tgl1= $this->tanggal_indonesia($row->tgl_spr);
						$tgl2= $this->tanggal_indonesia($row->tgl_baek);
						$tgl3= $this->tanggal_indonesia($row->tgl_bahp);
						$tgl4= $this->tanggal_indonesia($row->tgl_spk);
						$nama_pejabat = $row->nama_pejabat;
						$kegiatan=$row->kegiatan;
						$jabatan2 = $row->jabatan2;
						$pangkat_pejabat = $row->pangkat_pejabat;
						$nip_pejabat = $row->nip_pejabat;
						$nama1 = $row->nama_rekanan;
						$pimpinan = $row->pimpinan;
						$jabatan = $row->jabatan;
						$nama_singkat = $row->nama_singkat_ketua;
						$tot = $row->tot;
		 $cRet = "<table width=\"105%\" border=\"0\" align=\"center\">
                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                     <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"75%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"25%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                    </table>
                    </td> 
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:2%;padding-right:2%;\">
					  <table border=\"1\" width=\"95%\" align=\"center\">
						<tr>
							<td align=\"center\" style=\"font-size:16px;\" rowspan=\"2\"><b>SURAT PERINTAH KERJA (SPK)</b></td>
							<td valign=\"top\"  style=\"font-size:15px;\">Kegiatan: $row->nm_kegiatan</td>
						</tr>
						<tr>
							<td align=\"center\" style=\"font-size:13px;\"><b>NOMOR DAN TANGGAL SURAT PERINTAH KERJA (SPK)</b><br> $row->no_spk Tanggal $tgl4</td>
						</tr>
						<tr>
							<td align=\"center\"  style=\"font-size:14px;\"><b>Halaman 1 dari 1</b></td>
							<td valign=\"top\"></td>
						</tr>
						<tr>
							<td align=\"justify\" valign=\"top\" style=\"font-size:12px;\">PAKET PEKERJAAN: $row->keterangan</td>
							<td align=\"left\" style=\"font-size:13px;\"><b>NOMOR DAN TANGGAL SURAT UNDANGAN PEMASUKAN PENAWARAN</b> <BR> $row->no_upl Tanggal $tgl<br>
							<B>NOMOR DAN TANGGAL PENAWARAN PENYEDIAAN BARANG/JASA</B><br>$row->no_spr Tanggal $tgl1<br>
							<B>NOMOR DAN TANGGAL BERITA ACARA EVALUASI, KLARIFIKASI, DAN NEGOSIASI</B><br>$row->no_baek Tanggal $tgl2 <br>
							<B>NOMOR DAN TANGGAL BERITA ACARA HASIL PENGADAAN LANGSUNG</B><br>$row->no_bahp Tanggal $tgl3</td>
						</tr>
						
						<tr><td colspan=\"2\" style=\"font-size:13px;\">SUMBER DANA: APBD KOTA MAKASSAR</td></tr>
						<tr><td colspan=\"2\" style=\"font-size:13px;\">Waktu Pelaksanaan Pekerjaan: $row->spbj  (".$this->mdata2->terbilang($row->spbj).") hari kalender</td></tr>
						<tr><td align=\"center\" colspan=\"2\">NILAI PEKERJAAN</td></tr>
                            <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" style=\"padding-left:2%;padding-right:2%;\">
                                    <tr>
                                        <td align=\"center\" rowspan=\"2\">NO</td>
                                        <td align=\"center\" rowspan=\"2\">URAIAN</td>
                                        <td align=\"center\" rowspan=\"2\">KUANTITAS</td>
                                        <td align=\"center\" rowspan=\"2\">SATUAN</td>
                                        <td align=\"center\" colspan=\"2\">HARGA SATUAN (Rp)</td>
                                        <td align=\"center\" colspan=\"2\">SUB TOTAL (Rp)</td>
                                        <td align=\"center\" rowspan=\"2\">TOTAL</td>
                                    </tr>
									<tr>
									 <td align=\"center\">Material</td>
                                     <td align=\"center\">Upah</td>
									 <td align=\"center\">Material</td>
                                     <td align=\"center\">Upah</td>
									</tr>";
									
                             // $csql = "SELECT b.uraian,b.satuan,b.vol,b.harga,b.jumlah FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE a.no_transaksi = '$kode'";
                            // $sql="SELECT a.kode,a.nama,b.no_transaksi,b.unit_skpd,CONCAT(b.kode,b.no) AS rekening FROM m_rekening a 
									//LEFT JOIN pld_form_isian b ON a.kode=b.kode WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
							$csql = "SELECT CONCAT(b.kode,b.no) AS rekening,b.no_transaksi,b.unit_skpd,b.kodegiat,b.kode,b.no,b.tahun,b.uraian,b.satuan,b.vol,ifnull(b.harga_akhir,0) as harga,ifnull(b.jml_akhir,0) as jumlah FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$kode' AND b.unit_skpd='$kd_skpd' GROUP BY rekening  ORDER BY kode,no";
							  $hasil = $this->db->query($csql);
								$i = 0;
								$jumlahxa  = 0;
								$jumlahxz = 0;
								foreach ($hasil->result() as $row)
								{
									$no_transaksi  	=$row->no_transaksi;
									$unit_skpd 		=$row->unit_skpd;
									$kode 			=$row->kode;
									$kodegiat		=$row->kodegiat;
									$no				=$row->no;
									$tahun			=$row->tahun;
									$uraian			=$row->uraian;
									$jumlahxxs  	=$row->jumlah;
									$jumlahxa 		=$jumlahxa+$jumlahxxs;
									$i++;
									$cRet .="       
                                    <tr>
                                        <td align=\"center\" style=\"font-size:13px;\">$i</td>
                                        <td align=\"left\" style=\"font-size:13px;\">$row->uraian</td>";
										if($row->vol==0){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->harga==0){
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\"></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>";}else{
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>
										<td align=\"center\" style=\"font-size:13px;\"></td>";}
										if($row->harga==0){
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\"></td>
										<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>
										<td align=\"center\" style=\"font-size:13px;\"></td>";}
										if($row->jumlah==0){
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";
										}
									$cRet.="</tr>";
											
								$csq2 = "SELECT CONCAT(a.kode,a.NO) AS rekening,a.uraian,a.satuan,a.vol,ifnull(a.harga_akhir,0) as harga,ifnull(a.jml_akhir,0) as jumlah FROM pld_form_rincian a 
										INNER JOIN pld_form_isian b ON a.`no_transaksi`=b.`no_transaksi` AND a.`kode`=a.`kode` AND a.`kodegiat`=b.`kodegiat`
										AND a.`no`=a.`no` AND a.`uraian_header`=b.`uraian` AND a.`tahun`=b.`tahun`
									    WHERE b.no_transaksi='$no_transaksi' AND b.unit_skpd='$unit_skpd' 
										and b.kode='$kode' and b.kodegiat='$kodegiat' and b.no='$no' and b.uraian='$uraian' and b.tahun='$tahun' ORDER BY a.kode,a.no,a.no_urut";
								$hasi2 = $this->db->query($csq2);
								
								foreach ($hasi2->result() as $row)
								{
									$jumlahxxd  =$row->jumlah;
									$jumlahxz =$jumlahxz+$jumlahxxd;
									$cRet .="       
                                    <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">$row->uraian</td>";
										if($row->vol==0){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->harga==0){
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\"></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>";}else{
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>
										<td align=\"center\" style=\"font-size:13px;\"></td>";}
										if($row->harga==0){
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\"></td>
										<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>
										<td align=\"center\" style=\"font-size:13px;\"></td>";}
										if($row->jumlah==0){
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";
										}
									$cRet.="</tr>";
								}
									
									
								}
                                if($unit_skpd=='1.18.01.00' && $kegiatan=='118011203'){    
							  $tott = $jumlahxa+$jumlahxz;
							  $ppn	= (($tott*10)/100);
                              $cRet .="
									<tr>
                                        <td align=\"right\" colspan=\"8\" style=\"font-size:13px;\"><b>TOTAL</b></td>
                                        <td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr>
									<tr>
                                        <td align=\"right\" colspan=\"8\" style=\"font-size:13px;\"><b>PPN 10%</b></td>
                                        <td align=\"right\" style=\"font-size:13px;\"><b>".number_format($ppn)."</b></td>
                                    </tr>
									<tr>
                                        <td align=\"right\" colspan=\"8\" style=\"font-size:13px;\"><b>JUMLAH TOTAL</b></td>
                                        <td align=\"right\" style=\"font-size:13px;\"><b>".number_format(round($tott+$ppn))."</b></td>
                                    </tr>
									<tr>
                                        <td align=\"left\" colspan=\"9\" style=\"font-size:14px;\">Terbilang : <i>".$this->mdata2->terbilang(round($tott+$ppn))." Rupiah</i></td>
                                    </tr>";}else{
							  $tott = $jumlahxa+$jumlahxz;
									$cRet .="
									<tr>
                                        <td align=\"center\" colspan=\"8\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
                                        <td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr>
									<tr>
                                        <td align=\"left\" colspan=\"9\" style=\"font-size:14px;\">Terbilang : <i>".$this->mdata2->terbilang($tott)." Rupiah</i></td>
                                    </tr>";
									}
									$cRet .="<tr>
                                        <td align=\"JUSTIFY\" colspan=\"9\" style=\"font-size:14px;\">INSTRUKSI KEPADA PENYEDIA BARANG : Penagihan hanya dapat dilakukan setelah penyelesaian pengadaan yang
											diperintahkan dalam SPK ini dan dibuktikan dengan Berita Acara Serah Terima Pekerjaan. Jika pengadaan tidak dapat
											diselesaikan dalam jangka waktu yang sudah ditentukan karena kesalahan atau kelalaian penyedia barang dan jasa maka
											penyedia barang dan jasa berkewajiban untuk membayar denda kepada PPK sebesar :<BR> a.<FJ>&nbsp;&nbsp;1/1000 (satu per seribu) dari bagian nilai kontrak / SPK sebelum PPN yang belum dikerjakan setiap hari kalender
											keterlambatan (apabila output dapat dipecah (bukan satu kesatuan sistem) dan dapat berfungsi secara sendiri-sendiri). <br><br>b.&nbsp;&nbsp;1/1000 (satu per seribu) dari total nilai kontrak / SPK sebelum PPN setiap hari kalender keterlambatan (apabila
											output tidak dapat dipecah karena satu kesatuan sistem dan tidak dapat berfungsi secara sendiri-sendiri). <br> Selain tunduk kepada ketentuan dalam SPK ini, penyedia berkewajiban untuk mematuhi Standar Ketentuan dan Syarat
											Umum SPK Terlampir.
										</td>
                                    </tr>
                                </table>
                            </td>
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr>";
										if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00'){
										$cRet.="<td></td>
                                            <td align=\"center\"><b>Untuk dan Atas nama<br>
                                            $jabatan2<br>Selaku Pejabat Pembuat Komitnen</b><br><br><br><br><br>
                                            <b><u>$nama_pejabat</u></b><br>Pangkat: $pangkat_pejabat<br>Nip. $nip_pejabat
                                            </td>";}elseif($skpd=='2.05.01.00'){
										$cRet.="<td></td>
                                            <td align=\"center\"><b>Untuk dan Atas nama<br>
                                            $jabatan2<br>Selaku $nama_singkat</b><br><br><br><br><br>
                                            <b><u>$nama_pejabat</u></b><br>Pangkat: $pangkat_pejabat<br>Nip. $nip_pejabat
                                            </td>";}elseif($skpd=='1.03.01.00'){
										$cRet.="<td></td>
                                            <td align=\"center\"><b>Mengetahui<br>
                                            $jabatan2<br>Selaku Kuasa Pengguna Anggaran<br></b><br><br><br><br><br>
                                            <b><u>$nama_pejabat</u></b><br>Pangkat: $pangkat_pejabat<br>Nip. $nip_pejabat
                                            </td>";}else{
										$cRet.="<td></td>
                                            <td align=\"center\"><b>Untuk dan Atas nama<br>
                                            $jabatan2<br>Selaku $nama_singkat / Pejabat Pembuat Komitnen</b><br><br><br><br><br>
                                            <b><u>$nama_pejabat</u></b><br>Pangkat: $pangkat_pejabat<br>Nip. $nip_pejabat
                                            </td>";}
                                        $cRet.="</tr>
                                    </table>
                                </td>
                                <td width=\"40%\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">
											 <b>Untuk dan atas nama Penyedia Barang<br>
                                                $nama1</b><br><br><br><br><br>
												<b><u>$pimpinan</u></b><br>$jabatan
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                           </table>
                          </td>
						 </tr>
                  
                </table>";}
        
         echo $cRet;
    }
	if($ctk=='13')
         {
		$kd_skpd = $this->session->userdata('skpd');
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$kantor  = $mhorganisasi['alamat'];
		$ckeg           = "SELECT a.bagian FROM m_kegiatan a INNER JOIN plh_form_isian b ON b.kegiatan=a.kode WHERE b.no_transaksi='$no' AND b.kd_uskpd='$skpd'";
		$hasilkeg = $this->db->query($ckeg);
						$i = 0;
					foreach ($hasilkeg->result() as $rowkeg)
					
		$ckeg1 = $rowkeg->bagian;
		
		if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00' or $skpd=='1.03.01.00'){
			if($ckeg1<>''){
						$csql = "SELECT a.keterangan,a.kegiatan, 
								 (SELECT nama FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS nama, 
								 (SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS pimpinan, 
								 (SELECT jabatan FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS jabatan, 
								 (SELECT kantor FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS kantor, 
								 (SELECT tgl_sp FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS tanggal_sp, 
								 (SELECT no_sp FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_sp, 
								 (SELECT tgl_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS tanggal_sppjb, 
								 (SELECT no_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_sppjb, 
								 (SELECT spbj FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS spbj,
								 (SELECT tgl_spbj FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS tgl_spbj,
								 (select ket_spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as ket_spbj,
								 (SELECT no_bapb2 FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS no_bapb2,
								 (select tgl_bapb2 from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as tgl_bapb2,
								 (SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
								 (SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS ketua, 
								 (SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS jabatan_ketua, 
								 (SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nama_singkat_ketua,
								 (SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS pangkat_ketua, 
								 (SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nip_ketua ,
								 (SELECT b.alamat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS alamat_ketua 
								 FROM plh_form_isian a
								WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";
				} else {
						$csql = "SELECT a.keterangan,a.kegiatan, 
						 (SELECT nama FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS nama, 
						 (SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS pimpinan, 
						 (SELECT jabatan FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS jabatan, 
						 (SELECT kantor FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS kantor, 
						 (SELECT tgl_sp FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS tanggal_sp, 
						 (SELECT no_sp FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_sp, 
						 (SELECT tgl_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS tanggal_sppjb, 
						 (SELECT no_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_sppjb, 
						 (SELECT spbj FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS spbj,
						 (SELECT tgl_spbj FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS tgl_spbj,
						 (select ket_spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as ket_spbj,
								 (SELECT no_bapb2 FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS no_bapb2,
								 (select tgl_bapb2 from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as tgl_bapb2,
						 (SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
						 (SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
						 (SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua, 
						 (SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua,
						 (SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua, 
						 (SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua,
								 (SELECT b.alamat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS alamat_ketua  
						 FROM plh_form_isian a
						WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";
				}
			} else {
						$csql = "SELECT a.keterangan,a.kegiatan, 
						 (SELECT nama FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS nama, 
						 (SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS pimpinan, 
						 (SELECT jabatan FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS jabatan, 
						 (SELECT kantor FROM mrekanan WHERE kode=a.rekanan and kd_skpd=a.kd_uskpd) AS kantor, 
						 (SELECT tgl_sp FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS tanggal_sp, 
						 (SELECT no_sp FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_sp, 
						 (SELECT tgl_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS tanggal_sppjb, 
						 (SELECT no_sppjb FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND b.kd_skpd=a.kd_uskpd) AS no_sppjb, 
						 (SELECT spbj FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS spbj,
						 (SELECT tgl_spbj FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS tgl_spbj,
						 (select ket_spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as ket_spbj,
								 (SELECT no_bapb2 FROM pl_lengkap b WHERE b.no_transaksi=a.no_transaksi AND  b.kd_skpd=a.kd_uskpd) AS no_bapb2,
								 (select tgl_bapb2 from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as tgl_bapb2,
						 (SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
						 (SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
						 (SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua, 
						 (SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua,
						 (SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua, 
						 (SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua,
						(SELECT b.alamat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS alamat_ketua  
						 FROM plh_form_isian a
						WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";
			}
				
						$hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row){
						$tgl			= $this->tanggal_indonesia($row->tanggal_sp);
						$tgl2			= $this->tanggal_indonesia($row->tanggal_sppjb);
						$tgl3 			= $this->tanggal_indonesia($row->tgl_spbj);
						$tgl4 			= $this->tanggal_indonesia($row->tgl_bapb2);
						//$tgl1= $this->tanggal_indonesia($row->tgl_spk);
						$no_bapb2		= $row->no_bapb2;
						$tot 			= $row->tot;
						$jabatan1 		= $row->jabatan_ketua;
						$kegiatan		=$row->kegiatan;
						$nama_pejabat 	= $row->ketua;
						$pangkat_pejabat = $row->pangkat_ketua;
						$nip_pejabat 	= $row->nip_ketua;
						$alamat_pejabat = $row->alamat_ketua;
						$nama1 			= $row->nama;
						$ket_spbj		= $row->ket_spbj;
						$jabatan 		= $row->jabatan;
						$pimpinan 		= $row->pimpinan;
						$hari 			= $row->spbj;
						$nmsngkat 		= $row->nama_singkat_ketua;
		 $cRet = "<table width=\"100%\" border=\"0\" >
		 <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:13px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"25%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat</td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\"></td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:8px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                        <tr><td></td>
                            <td colspan=\"2\" style=\"font-size:15px;\" align=\"center\">
                                <b><u>SURAT PESANAN</u></b>
                                <br>Nomor: $row->no_sp
                            </td>
                        </tr>
                    </table>
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr><td style=\"font-size:14px;\" align=\"left\" colspan=\"2\" valign=\"top\"><b>Pekerjaan : $row->keterangan</b></td></tr>
						</table>
						<table border=\"0\" width=\"80%\" align=\"center\" style=\"font-size:14px;\">
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Yang bertanda Tangan dibawah ini:</td>
                        </tr>
                       </table>
                    </table>
                    </td>
                         
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\"><b>$row->ketua</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Jabatan</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\"><b>$row->jabatan_ketua</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Alamat</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$alamat</td>
                        </tr>";
						if($skpd=='2.05.01.00'){
						 $cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" colspan=\"3\">Selanjutnya disebut sebagai Pengguna Anggaran ".strtoupper($nama)."</td>
                        </tr>";}else{
						 $cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" colspan=\"3\">Selanjutnya disebut sebagai Kuasa Pengguna Anggaran / Pejabat Pembuat Komitmen ".strtoupper($nama)."</td>
                        </tr>";
						}
						 $cRet.="<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" colspan=\"3\">Berdasarkan Surat Penunjukan Penyedia Barang/Jasa (SPPBJ) Nomor : $row->no_sppjb
								Tanggal $tgl2, bersama ini memerintahkan :</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\"><b>$row->pimpinan</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Jabatan</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\"><b>$row->jabatan</b></td>
                        </tr>
						 <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama Perusahaan</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\"><b>$row->nama</b></td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Alamat</td>
                            <td width=\"1%\" style=\"font-size:14px;\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$row->kantor</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" colspan=\"3\" align=\"justify\" >Selanjutnya disebut sebagai Penyedia Barang untuk mengirimkan barang dengan memperhatikan ketentuan-ketentuan sebagai berikut :</td>
                        </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;<td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" colspan=\"3\">1. Rincian Barang</td>
                        </tr>
						 </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>";//}
                         $cRet .="<tr>
                           <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                                    <tr>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>NO</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>URAIAN</b></td>
                                        <td bgcolor=\"#CCCCCC\"  align=\"center\" style=\"font-size:13px;\"><b>SATUAN</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>KUANTITAS</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>HARGA SATUAN (Rp)</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>JUMLAH (Rp)</b></td>
                                    </tr>
									<tr>
                                        <td align=\"center\" style=\"font-size:13px;\">1</td>
                                        <td align=\"center\" style=\"font-size:13px;\">2</td>
                                        <td align=\"center\" style=\"font-size:13px;\">3</td>
                                        <td align=\"center\" style=\"font-size:13px;\">4</td>
                                        <td align=\"center\" style=\"font-size:13px;\">5</td>
                                        <td align=\"center\" style=\"font-size:13px;\">6=5x4</td>
                                    </tr>";
							  //$sql="select no_transaksi,kd_uskpd,nm_kegiatan from plh_form_isian where no_transaksi='$no' and kd_uskpd='$skpd'";
							  $sql="SELECT a.kode,a.nama,b.no_transaksi,b.unit_skpd,CONCAT(b.kode,b.no) AS rekening FROM m_rekening a 
									LEFT JOIN pld_form_isian b ON a.kode=b.kode WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
							  $hsql=$this->db->query($sql);
							 $jumlahxa  = 0;
								$jumlahxz = 0;
							  foreach ($hsql->result() as $row)
								{
									$i++; 
									$no_trans   =$row->no_transaksi;
									$nmkegiatan =$row->nama;
									$kd_skpd    =$row->unit_skpd;
									$ckoderek   =$row->kode;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\">$i</td>
                                        <td align=\"left\" style=\"font-size:13px;\"><b>$nmkegiatan</b></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                    </tr>";
                                    
                              //$csql = "SELECT b.uraian,b.satuan,b.vol,b.harga,b.jumlah,a.total as jumlahxxx FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' and b.unit_skpd='$kd_skpd' group by kode";
							  //$csql = "SELECT CONCAT(b.kode,b.no) AS rekening,b.uraian,b.satuan,b.vol,b.harga,b.jumlah FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' AND b.unit_skpd='$kd_skpd' and GROUP BY rekening  ORDER BY rekening";
							 $csql = "SELECT * FROM (
									   SELECT CONCAT(kode,NO) AS rekening,no_transaksi,kode,kodegiat,no,unit_skpd,tahun,uraian,satuan,vol,ifnull((harga_akhir),0) 
									   as harga,ifnull((jml_akhir),0) as jumlah FROM pld_form_isian 
									   WHERE no_transaksi='$no_trans' AND unit_skpd='$kd_skpd')a WHERE LEFT(rekening,7)=$ckoderek  ORDER BY kode,no"; 
								/* $csql = "SELECT CONCAT(kode,NO) AS rekening,no_transaksi,kode,kodegiat,no,unit_skpd,tahun,uraian,satuan,vol,IFNULL(harga,0) AS harga,IFNULL(jumlah,0) AS jumlah FROM pld_form_isian 
								WHERE no_transaksi='$no_trans' AND unit_skpd='$kd_skpd' and kode='$ckoderek' ORDER BY rekening"; */
							  $hasil = $this->db->query($csql);
								foreach ($hasil->result() as $row)
								{
									$no_transaksi  	=$row->no_transaksi;
									$unit_skpd 		=$row->unit_skpd;
									$kode 			=$row->kode;
									$kodegiat		=$row->kodegiat;
									$no				=$row->no;
									$tahun			=$row->tahun;
									$uraian			=$row->uraian;
									$jumlahxxs  	=$row->jumlah;
									$jumlahxa 		=$jumlahxa+$jumlahxxs;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">$row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol<>0){
                                        $cRet.="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->harga<>0){
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->jumlah<>0){
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
                                    $cRet.="</tr>";
										
								$csq2 = "SELECT CONCAT(a.kode,a.NO) AS rekening,a.uraian,a.satuan,a.vol,a.harga_akhir as harga,a.jml_akhir as jumlah FROM pld_form_rincian a 
										INNER JOIN pld_form_isian b ON a.`no_transaksi`=b.`no_transaksi` AND a.`kode`=a.`kode` AND a.`kodegiat`=b.`kodegiat`
										AND a.`no`=a.`no` AND a.`uraian_header`=b.`uraian` AND a.`tahun`=b.`tahun`
									    WHERE b.no_transaksi='$no_transaksi' AND b.unit_skpd='$unit_skpd' 
										and b.kode='$kode' and b.kodegiat='$kodegiat' and b.no='$no' and b.uraian='$uraian' and b.tahun='$tahun' ORDER BY a.kode,a.no,a.no_urut";
								$hasi2 = $this->db->query($csq2);
								
								foreach ($hasi2->result() as $row)
								{
									$jumlahxxd  =$row->jumlah;
									$jumlahxz =$jumlahxz+$jumlahxxd;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">- $row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol<>0){
                                        $cRet.="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->harga<>0){
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
										if($row->jumlah<>0){
                                        $cRet.="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";}else{
										$cRet.="<td align=\"center\" style=\"font-size:13px;\"></td>";
										}
                                    $cRet.="</tr>";
                                    }
                                }	
							}
							if($unit_skpd=='1.18.01.00' && $kegiatan=='118011203'){
							  $tott = $jumlahxa+$jumlahxz;
							  $ppn = (($tott*10)/100);
                            $cRet .="<tr>
                                        <td align=\"right\" colspan=\"5\" style=\"font-size:13px;\"><b>TOTAL</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr><tr>
                                        <td align=\"right\" colspan=\"5\" style=\"font-size:13px;\"><b>PPN 10%</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($ppn)."</b></td>
                                    </tr><tr>
                                        <td align=\"right\" colspan=\"5\" style=\"font-size:13px;\"><b>JUMLAH TOTAL</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format(round($tott+$ppn))."</b></td>
                                    </tr>
									
                                </table>";}else{
							  $tott = $jumlahxa+$jumlahxz;
                              $cRet .="<tr>
                                        <td align=\"center\" colspan=\"5\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr>
                                </table>";
								}
								
                  $cRet .="</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				  <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">";
				  if($unit_skpd=='1.18.01.00' && $kegiatan=='118011203'){
                   $cRet .="<tr><td width=\"10%\"></td><td align=\"left\" colspan=\"2\"><b><i>Terbilang : ".$this->mdata2->terbilang(round($tott+$ppn))." Rupiah</i></b></td></tr>";}
				   else{
                   $cRet .="<tr><td width=\"10%\"></td><td align=\"left\" colspan=\"2\"><b><i>Terbilang : ".$this->mdata2->terbilang($tott)." Rupiah</i></b></td></tr>";}
				  $cRet .="</table><br/>
				    <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
						  <tr><td width=\"11%\" align=\"right\" valign=\"top\">2.</td><td align=\"left\" colspan=\"2\">&nbsp;Tanggal barang diterima $tgl3;</td></tr>
						  <tr><td width=\"11%\" align=\"right\" valign=\"top\">3.</td><td align=\"left\" colspan=\"2\">&nbsp;Syarat-syarat Pekerjaan : Sesuai dengan persyaratan dan ketentuan Surat Pesanan;</td></tr>";
						 if($tgl4=='' && $no_bapb2==''){	  
			     $cRet .="<tr><td width=\"11%\" align=\"right\" valign=\"top\">4.</td><td align=\"left\" colspan=\"2\">&nbsp;Waktu Penyelesaian : Selama $hari (".$this->mdata2->terbilang($hari).") $ket_spbj dan pekerjaan harus sudah selesai pada tanggal $tgl3;</td></tr>
						  <tr><td width=\"11%\" align=\"right\" valign=\"top\">5.</td><td align=\"left\" colspan=\"2\">&nbsp;Alamat Pengiriman Barang : $alamat;</td></tr>";
						 }elseif($tgl4=='' && $no_bapb2<>''){	  
			     $cRet .="<tr><td width=\"11%\" align=\"right\" valign=\"top\">4.</td><td align=\"left\" colspan=\"2\">&nbsp;Waktu Penyelesaian : Selama $hari (".$this->mdata2->terbilang($hari).") $ket_spbj dan pekerjaan harus sudah selesai pada tanggal $tgl3;</td></tr>
						  <tr><td width=\"11%\" align=\"right\" valign=\"top\">5.</td><td align=\"left\" colspan=\"2\">&nbsp;Alamat Pengiriman Barang : $no_bapb2;</td></tr>";
						 }elseif($tgl4<>'' && $no_bapb2==''){	  
			     $cRet .="<tr><td width=\"11%\" align=\"right\" valign=\"top\">4.</td><td align=\"left\" colspan=\"2\">&nbsp;Waktu Penyelesaian : Selama $hari (".$this->mdata2->terbilang($hari).") $ket_spbj dan pekerjaan harus sudah selesai pada tanggal $tgl4;</td></tr>
						  <tr><td width=\"11%\" align=\"right\" valign=\"top\">5.</td><td align=\"left\" colspan=\"2\">&nbsp;Alamat Pengiriman Barang : $alamat;</td></tr>";
						 }else{	  
			     $cRet .="<tr><td width=\"11%\" align=\"right\" valign=\"top\">4.</td><td align=\"left\" colspan=\"2\">&nbsp;Waktu Penyelesaian : Selama $hari (".$this->mdata2->terbilang($hari).") $ket_spbj dan pekerjaan harus sudah selesai pada tanggal $tgl4;</td></tr>
						  <tr><td width=\"11%\" align=\"right\" valign=\"top\">5.</td><td align=\"left\" colspan=\"2\">&nbsp;Alamat Pengiriman Barang : $no_bapb2;</td></tr>";
						 } 
						  $cRet .="
						  <tr><td width=\"11%\" align=\"right\" valign=\"top\">6.</td><td align=\"left\" colspan=\"2\">&nbsp;Denda : Terhadap setiap hari keterlambatan penyelesaian pekerjaan Penyedia Barang/jasa akan dikenakan
																						 denda keterlambatan 1/1000 (satu per seribu) dari Nilai Surat Pesanan atau bagian tertentu dari Nilai Surat Pesanan
																						 sebelum PPN sesuai dengan persyaratan dan ketentuan Surat Pesanan.</td></tr>
					</table><br/>
				  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:13px;\" align=\"center\" >
                            <tr>
                                <td width=\"50%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
										<tr>";
							if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00'){
                                $cRet .="<td width=\"50%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
										<tr>
                                            <td colspan=\"2\" align=\"center\">
											 Untuk dan atas nama <br><b>$jabatan1</b><br><b>Selaku Pejabat Pembuat Komitmen</b><br><br><br><br><br>
												<u><b>$nama_pejabat</b></u><br>Pangkat:$pangkat_pejabat<br>Nip. $nip_pejabat
                                            </td>
                                        </tr> 
                                    </table>
                                </td>";
								}elseif($skpd=='2.05.01.00'){
                                $cRet .="<td width=\"50%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
										<tr>
                                            <td colspan=\"2\" align=\"center\">
											 Untuk dan atas nama <br><b>$jabatan1</b><br><b>Selaku $nmsngkat</b><br><br><br><br><br>
												<u><b>$nama_pejabat</b></u><br>Pangkat:$pangkat_pejabat<br>Nip. $nip_pejabat
                                            </td>
                                        </tr> 
                                    </table>
                                </td>";
								}elseif($skpd=='1.03.01.00'){
                                $cRet .="<td width=\"50%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
										<tr>
                                            <td colspan=\"2\" align=\"center\">
											 Mengetahui <br><b>$jabatan1</b><br><b>Selaku Kuasa Pengguna Anggaran<br></b><br><br><br><br>
												<u><b>$nama_pejabat</b></u><br>Pangkat:$pangkat_pejabat<br>Nip. $nip_pejabat
                                            </td>
                                        </tr> 
                                    </table>
                                </td>";
								}else{
                                $cRet .="<td width=\"50%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
										<tr>
                                            <td colspan=\"2\" align=\"center\">
											 Untuk dan atas nama <br><b>$jabatan1</b><br><b>$nmsngkat<br>Selaku Pejabat Pembuat Komitmen</b><br><br><br><br><br>
												<u><b>$nama_pejabat</b></u><br>Pangkat:$pangkat_pejabat<br>Nip. $nip_pejabat
                                            </td>
                                        </tr> 
                                    </table>
                                </td>";}
                                $cRet.="
                                        </tr> 
                                    </table>
                                </td>
                                <td width=\"50%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:13px;\">
                                            <td colspan=\"2\" align=\"center\" style=\"font-size:14px;\">Makassar, $tgl<br>Menerima dan Menyetujui<br><b>Untuk dan atas nama $nama1</b><br><br><br><br><br>
                                            <u><b>$pimpinan</b></u><br>$jabatan
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                        </table>
                    </td>
                  </tr>
                </table>";}
         echo $cRet;
    }
	if($ctk=='14')
        {
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
		$csql 			= "SELECT a.kd_uskpd,a.kegiatan,
					CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
					a.nm_kegiatan,a.keterangan,
					(select nama from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd) as nama_rekanan,
					(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
					(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
					(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat,
					(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
					(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
					(SELECT tgl_bapb2 FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_bapb,
					(SELECT no_bapb2 FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_bapb,
					(SELECT tgl_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_sp,
					(SELECT no_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_sp,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spk,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spk,
					(SELECT nama FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS staf_penerima,
					(SELECT jabatan FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS jabatan_penerima,
					(SELECT nama_singkat FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS nama_singkat_penerima, 
					(SELECT pangkat FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS pangkat_penerima,
					(SELECT nip FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS nip_penerima,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND a.ketua=kode) AS pphp, 
					(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND a.ketua=kode) AS jabatan_pphp,
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND a.ketua=kode) AS nama_singkat_pphp, 
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND a.ketua=kode) AS pangkat_pphp,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND a.ketua=kode) AS nip_pphp,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PSB') AS psb, 
					(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PSB') AS jabatan_psb,
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PSB') AS nama_singkat_psb, 
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PSB') AS pangkat_psb,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PSB') AS nip_psb,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
					FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
					
                           
	   $hasil = $this->db->query($csql);
	   $i 	  = 0;
	   foreach ($hasil->result() as $rowi){
	   $cRet  = '';
	   $keterangan = $rowi->keterangan;
	   $nm_kegiatan= $rowi->nm_kegiatan;
	   $kegiatan   = $rowi->kodegiat;
	   $jumlahtot = $rowi->tot;
	   $ctgl=$rowi->tgl_bapb;
	   $ctanggal=$this->tanggal_indonesia($ctgl); 
	   $cnosp =$rowi->no_sp;
	   $ctgl1=$rowi->tgl_sp;
	   $ctanggal1=$this->tanggal_indonesia($ctgl1); 
	   $cnospk =$rowi->no_spk;
	   $ctgl11=$rowi->tgl_spk;
	   $ctanggal11=$this->tanggal_indonesia($ctgl11); 
	   $tgl1= $rowi->tgl_bapb;
	   $tahun= substr($tgl1,0,4);
	   $bulan= substr($tgl1,5,2);
	   $tanggal= substr($tgl1,8,2);
	   $tglfix1 = date("d/m/Y",strtotime("$tgl1"));
	   
	   	if ($cnospk==""){
										$nofix=$cnosp;
										$tglfix=$ctanggal1;
										$x="Surat Pesanan (SP)";
									
										}
										else{ 
										$nofix=$cnospk;
										$tglfix=$ctanggal11;
										$x="Surat Perintah Kerja (SPK)";
									}
	   
          $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">

                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"25%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                        <tr><td></td>
                            <td colspan=\"2\" style=\"font-size:14px;\" align=\"center\">
                                <b><u>BERITA ACARA PENERIMAAN BARANG / JASA</u></b>
                                <br>NOMOR : $rowi->no_bapb &nbsp;
                            </td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				   <tr>
                        <td colspan=\"3\">&nbsp;
                        <td>
                    </tr>
                  <tr>
				  <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
						<tr>
							<td width=\"24%\" style=\"font-size:14px;\">Pada Hari ini, Tanggal ".$this->mdata2->terbilang($tanggal)."  ".$this->mdata2->getBulan($bulan)." ".$this->mdata2->terbilang($tahun)."  ($tglfix1) Pukul 10.00 WITA, Kami yang bertanda tangan
							di bawah ini : 
                            </td>
						</tr>
				     </table>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$rowi->pphp
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Jabatan
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$rowi->jabatan_pphp
                            </td>
                        </tr>
						 <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
						<tr>
							<td width=\"24%\" style=\"font-size:14px;\">Telah menerima barang / jasa yang diserahkan oleh $rowi->nama_rekanan berdasarkan $x Nomor : $nofix
                            Tanggal $tglfix dengan perincian sebagai berikut :</td>
						</tr>
				     </table>
                        <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>";//}
                         $cRet .="<tr>
                           <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                                    <tr>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>NO</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>URAIAN</b></td>
                                        <td bgcolor=\"#CCCCCC\"  align=\"center\" style=\"font-size:13px;\"><b>SATUAN</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>KUANTITAS</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>HARGA SATUAN (Rp)</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>Biaya Transportasi/Asuransi/Jasa <br>Lainnya (Jika Ada) Sampai Ke<br> Tempat Tujuan Akhir</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>JUMLAH (Rp)</b></td>
                                    </tr>
									<tr>
                                        <td align=\"center\" style=\"font-size:13px;\">1</td>
                                        <td align=\"center\" style=\"font-size:13px;\">2</td>
                                        <td align=\"center\" style=\"font-size:13px;\">3</td>
                                        <td align=\"center\" style=\"font-size:13px;\">4</td>
                                        <td align=\"center\" style=\"font-size:13px;\">5</td>
										<td align=\"center\" style=\"font-size:13px;\">6</td>
                                        <td align=\"center\" style=\"font-size:13px;\">7=5x4</td>
                                    </tr>";
							  //$sql="select no_transaksi,kd_uskpd,nm_kegiatan from plh_form_isian where no_transaksi='$no' and kd_uskpd='$skpd'";
							  $sql="SELECT a.kode,a.nama,b.no_transaksi,b.unit_skpd,CONCAT(b.kode,b.no) AS rekening FROM m_rekening a 
									LEFT JOIN pld_form_isian b ON a.kode=b.kode WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
							  $hsql=$this->db->query($sql);
								$jumlahxa  = 0;
								$jumlahxz = 0;
							  foreach ($hsql->result() as $row)
								{
									$i++; 
									$no_trans   =$row->no_transaksi;
									$nmkegiatan =$row->nama;
									$kd_skpd    =$row->unit_skpd;
									$ckoderek   =$row->kode;									
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\">$i</td>
                                        <td align=\"left\" style=\"font-size:13px;\"><b>$nmkegiatan</b></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                    </tr>";
                                    
                              //$csql = "SELECT b.uraian,b.satuan,b.vol,b.harga,b.jumlah,a.total as jumlahxxx FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' and b.unit_skpd='$kd_skpd' group by kode";
							 // $csql = "SELECT CONCAT(b.kode,b.no) AS rekening,b.uraian,b.satuan,b.vol,b.harga,b.jumlah FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' AND b.unit_skpd='$kd_skpd' GROUP BY rekening  ORDER BY rekening";
							  $csql = "SELECT * FROM (
										SELECT CONCAT(kode,NO) AS rekening,no_transaksi,kode,kodegiat,no,unit_skpd,tahun,uraian,satuan,vol,harga_akhir as harga,jml_akhir as jumlah FROM pld_form_isian 
										WHERE no_transaksi='$no_trans' AND unit_skpd='$kd_skpd')a WHERE LEFT(rekening,7)=$ckoderek  ORDER BY rekening";
							  $hasil = $this->db->query($csql);
							  
								
								foreach ($hasil->result() as $row)
								{
									$no_transaksi  	=$row->no_transaksi;
									$unit_skpd 		=$row->unit_skpd;
									$kode 			=$row->kode;
									$kodegiat		=$row->kodegiat;
									$no				=$row->no;
									$tahun			=$row->tahun;
									$uraian			=$row->uraian;
									$jumlahxx  =$row->jumlah;
									$jumlahxa =$jumlahxa+$jumlahxx;
                           $cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">$row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->vol</td>
                                        <td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>
										 <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>
                                    </tr>";
                                    					
								$csq2 = "SELECT CONCAT(a.kode,a.NO) AS rekening,a.uraian,a.satuan,a.vol,a.harga,a.jumlah FROM pld_form_rincian a 
										INNER JOIN pld_form_isian b ON a.`no_transaksi`=b.`no_transaksi` AND a.`kode`=a.`kode` AND a.`kodegiat`=b.`kodegiat`
										AND a.`no`=a.`no` AND a.`uraian_header`=b.`uraian` AND a.`tahun`=b.`tahun`
									    WHERE b.no_transaksi='$no_transaksi' AND b.unit_skpd='$unit_skpd' 
										and b.kode='$kode' and b.kodegiat='$kodegiat' and b.no='$no' and b.uraian='$uraian' and b.tahun='$tahun' ORDER BY rekening";
								$hasi2 = $this->db->query($csq2);
								
								foreach ($hasi2->result() as $row)
								{
									$jumlahxxd  =$row->jumlah;
									$jumlahxz =$jumlahxz+$jumlahxxd;
								$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">- $row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->vol</td>
                                        <td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>
										 <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>
                                    </tr>";}
									
									}}
							  $tott = $jumlahxa+$jumlahxz;
                              $cRet .="<tr>
                                        <td align=\"center\" colspan=\"6\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr>
                                </table>";
                  $cRet .="</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				  <table border=\"0\" width=\"100%\" style=\"font-size:13px;\">
                  <tr><td width=\"2%\"></td><td align=\"left\" colspan=\"3\"><b>Terbilang : <i>".$this->mdata2->terbilang($jumlahtot)." Rupiah</i></b></td></tr>
				  </table><br/><br/>
                <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr><td></td>
                                            <td align=\"center\">Yang Menerima<br><b>$rowi->jabatan_psb</b><br>
                                            <br><br><br><br>
                                            <b><u>$rowi->psb</br></u></b>Pangkat: $rowi->pangkat_psb<br>Nip. $rowi->nip_psb
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"30%\">
                                </td>
                                <td width=\"40%\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:13px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">Yang Menyerahkan<br>
                                                <br><br><br><br><br><br>
												<b><u>$rowi->pphp</u></b><br>Pangkat: $rowi->pangkat_pphp<br>Nip. $rowi->nip_pphp
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                  <tr>
					<td align=\"center\" >
                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                </table>";
        }
         echo $cRet;
         
		 
		 } 
		
	if($ctk=='15')
              {
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
		$csql 			= "SELECT a.kd_uskpd,a.kegiatan,
					CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
					a.nm_kegiatan,a.keterangan,
					(select nama from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd) as nama_rekanan,
					(select pimpinan from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd) as pimpinan,
					(select jabatan from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd) as jabatan_pimpinan,
					(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
					(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
					(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat,
					(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
					(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
					(SELECT tgl_bapb1 FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_bapb,
					(SELECT no_bapb1 FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_bapb,
					(SELECT tgl_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_sp,
					(SELECT no_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_sp,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spk,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spk,
					(SELECT nama FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS staf_penerima,
					(SELECT jabatan FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS jabatan_penerima,
					(SELECT nama_singkat FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS nama_singkat_penerima, 
					(SELECT pangkat FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS pangkat_penerima,
					(SELECT nip FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS nip_penerima,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND a.ketua=kode) AS pphp, 
					(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND a.ketua=kode) AS jabatan_pphp,
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND a.ketua=kode) AS nama_singkat_pphp, 
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND a.ketua=kode) AS pangkat_pphp,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND a.ketua=kode) AS nip_pphp,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PSB') AS psb, 
					(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PSB') AS jabatan_psb,
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PSB') AS nama_singkat_psb, 
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PSB') AS pangkat_psb,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PSB') AS nip_psb,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot
					FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
					
                           
					   $hasil = $this->db->query($csql);
					   $i 	  = 0;
					   foreach ($hasil->result() as $rowi){
					   $cRet  = '';
					   $keterangan = $rowi->keterangan;
					   $nm_kegiatan= $rowi->nm_kegiatan;
					   $kegiatan   = $rowi->kodegiat;
					   $jumlahtot = $rowi->tot;
					   $ctgl=$rowi->tgl_bapb;
					   $ctanggal=$this->tanggal_indonesia($ctgl);
					   $nosp = $rowi->no_sp;					   
					   $ctgl1=$rowi->tgl_sp;
					   $ctanggal1=$this->tanggal_indonesia($ctgl1); 
					   $nospk = $rowi->no_spk;
					   $ctgl11=$rowi->tgl_spk;
					   $ctanggal11=$this->tanggal_indonesia($ctgl11); 
					   $tgl1= $rowi->tgl_bapb;
					   $tahun= substr($tgl1,0,4);
					   $bulan= substr($tgl1,5,2);
					   $tanggal= substr($tgl1,8,2);
					   $tglfix1 = date("d/m/Y",strtotime("$tgl1"));
	   
							if ($nospk==0){
										$nofix=$nosp;
										$tglfix=$ctanggal1;
										$x="Surat Pesanan (SP)";
									
										}
										else{ 
										$nofix=$nospk;
										$tglfix=$ctanggal11;
										$x="Surat Perintah Kerja (SPK)";
									}
	   
          $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">

                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"25%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                        <tr><td></td>
                            <td colspan=\"2\" style=\"font-size:14px;\" align=\"center\">
                                <b><u>BERITA ACARA PEMERIKSAAN BARANG / JASA</u></b>
                                <br>NOMOR : $rowi->no_bapb &nbsp;
                            </td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				   <tr>
                        <td colspan=\"3\">&nbsp;
                        <td>
                    </tr>
                  <tr>
				  <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
						<tr>
							<td width=\"24%\" style=\"font-size:14px;\">Pada Hari ini, Tanggal ".$this->mdata2->terbilang($tanggal)."  ".$this->mdata2->getBulan($bulan)." ".$this->mdata2->terbilang($tahun)."  ($tglfix1) Pukul 10.00 WITA, Kami yang bertanda tangan
							di bawah ini : 
                            </td>
						</tr>
				     </table>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\">1
                            </td>
                            <td width=\"1%\" style=\"font-size:14px;\">.
                            </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$rowi->pphp
                            </td>
                        </tr>
						 <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
						<tr>
							<td width=\"24%\" style=\"font-size:14px;\">Telah menerima barang / jasa yang diserahkan oleh $rowi->nama_rekanan berdasarkan $x Nomor : $nofix
                            Tanggal $tglfix dengan perincian sebagai berikut :</td>
						</tr>
				     </table>
                        <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>";//}
                         $cRet .="<tr>
                           <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                                    <tr>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>NO</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>URAIAN</b></td>
                                        <td bgcolor=\"#CCCCCC\"  align=\"center\" style=\"font-size:13px;\"><b>SATUAN</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>KUANTITAS</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>HARGA SATUAN (Rp)</b></td>
										<td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>Biaya Transportasi/Asuransi/Jasa <br>Lainnya (Jika Ada) Sampai Ke<br> Tempat Tujuan Akhir</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>JUMLAH (Rp)</b></td>
                                    </tr>
									<tr>
                                        <td align=\"center\" style=\"font-size:13px;\">1</td>
                                        <td align=\"center\" style=\"font-size:13px;\">2</td>
                                        <td align=\"center\" style=\"font-size:13px;\">3</td>
                                        <td align=\"center\" style=\"font-size:13px;\">4</td>
                                        <td align=\"center\" style=\"font-size:13px;\">5</td>
										<td align=\"center\" style=\"font-size:13px;\">6</td>
                                        <td align=\"center\" style=\"font-size:13px;\">7=5x4</td>
                                    </tr>";
							  //$sql="select no_transaksi,kd_uskpd,nm_kegiatan from plh_form_isian where no_transaksi='$no' and kd_uskpd='$skpd'";
							  $sql="SELECT a.kode,a.nama,b.no_transaksi,b.unit_skpd,CONCAT(b.kode,b.no) AS rekening FROM m_rekening a 
									LEFT JOIN pld_form_isian b ON a.kode=b.kode WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
							  $hsql=$this->db->query($sql);
								$jumlahxa  = 0;
								$jumlahxz  = 0;
							  foreach ($hsql->result() as $row)
								{
									$i++; 
									$no_trans   =$row->no_transaksi;
									$nmkegiatan =$row->nama;
									$kd_skpd    =$row->unit_skpd;
									$ckoderek   =$row->kode;									
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\">$i</td>
                                        <td align=\"left\" style=\"font-size:13px;\"><b>$nmkegiatan</b></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                    </tr>";
                                    
                              //$csql = "SELECT b.uraian,b.satuan,b.vol,b.harga,b.jumlah,a.total as jumlahxxx FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' and b.unit_skpd='$kd_skpd' group by kode";
							 // $csql = "SELECT CONCAT(b.kode,b.no) AS rekening,b.uraian,b.satuan,b.vol,b.harga,b.jumlah FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' AND b.unit_skpd='$kd_skpd' GROUP BY rekening  ORDER BY rekening";
							  $csql = "SELECT * FROM (
										SELECT CONCAT(kode,NO) AS rekening,no_transaksi,kode,kodegiat,no,unit_skpd,tahun,uraian,satuan,vol,harga_akhir as harga,jml_akhir as jumlah FROM pld_form_isian 
										WHERE no_transaksi='$no_trans' AND unit_skpd='$kd_skpd')a WHERE LEFT(rekening,7)=$ckoderek  ORDER BY rekening";
							  $hasil = $this->db->query($csql);
								foreach ($hasil->result() as $row)
								{
									$no_transaksi  	=$row->no_transaksi;
									$unit_skpd 		=$row->unit_skpd;
									$kode 			=$row->kode;
									$kodegiat		=$row->kodegiat;
									$no				=$row->no;
									$tahun			=$row->tahun;
									$uraian			=$row->uraian;
									$jumlahxx  =$row->jumlah;
									$jumlahxa =$jumlahxa+$jumlahxx;
                           $cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">$row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->vol</td>
                                        <td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>
										 <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>
                                    </tr>";
                                    		
								$csq2 = "SELECT CONCAT(a.kode,a.NO) AS rekening,a.uraian,a.satuan,a.vol,a.harga,a.jumlah FROM pld_form_rincian a 
										INNER JOIN pld_form_isian b ON a.`no_transaksi`=b.`no_transaksi` AND a.`kode`=a.`kode` AND a.`kodegiat`=b.`kodegiat`
										AND a.`no`=a.`no` AND a.`uraian_header`=b.`uraian` AND a.`tahun`=b.`tahun`
									    WHERE b.no_transaksi='$no_transaksi' AND b.unit_skpd='$unit_skpd' 
										and b.kode='$kode' and b.kodegiat='$kodegiat' and b.no='$no' and b.uraian='$uraian' and b.tahun='$tahun' ORDER BY rekening";
								$hasi2 = $this->db->query($csq2);
								
								foreach ($hasi2->result() as $row)
								{
									$jumlahxxd  =$row->jumlah;
									$jumlahxz =$jumlahxz+$jumlahxxd;
									
								$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">- $row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->vol</td>
                                        <td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>
										 <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>
                                    </tr>";
									}
									}}
							  $tott = $jumlahxa+$jumlahxz;
                              $cRet .="<tr>
                                        <td align=\"center\" colspan=\"6\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr>
                                </table>";
                  $cRet .="</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				  <table border=\"0\" width=\"100%\" style=\"font-size:13px;\">
                  <tr><td width=\"2%\"></td><td align=\"left\" colspan=\"3\"><b>Terbilang : ".$this->mdata2->terbilang($jumlahtot)." Rupiah</b></td></tr>
				  </table><br/><br/>
                <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr><td></td>
                                            <td align=\"center\">Yang Menyerahkan<br><b>$rowi->nama_rekanan</b><br>
                                            <br><br><br><br>
                                            <b><u>$rowi->pimpinan</br></u></b>Pangkat: $rowi->jabatan_pimpinan
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"30%\">
                                </td>
                                <td width=\"40%\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:13px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">Yang Menerima<br>
                                                <br><br><br><br><br><br>
												<b><u>$rowi->pphp</u></b><br>Pangkat: $rowi->pangkat_pphp<br>Nip. $rowi->nip_pphp
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                  <tr>
					<td align=\"center\" >
                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                </table>";
        }
         echo $cRet;
    } 
		
	if($ctk=='16')
        {
		$kd_skpd = $this->session->userdata('skpd');
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$iduser			= $this->session->userdata('iduser');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$nama1  		= $mhorganisasi['nama'];
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
	/* 	
		$csql = "SELECT a.ppn AS cppn,a.pph1 AS cpph1,a.pph2 AS cpph2,a.total AS tot,a.nm_kegiatan,
					(SELECT b.nama FROM pld_form_isian a INNER JOIN m_rekening b ON a.kode=b.kode WHERE a.unit_skpd='$skpd' AND no_transaksi='$kode' GROUP BY a.no_transaksi)AS nm_rekening,
					(SELECT pimpinan FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS pimpinan,
					(SELECT jabatan FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS jabatan,
					(SELECT rumah FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS rumah,
					(SELECT nama FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS nama,
					(SELECT npwp FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS npwp,
					(SELECT kantor FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS kantor,
					(SELECT no_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_sp,
					(SELECT no_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_bapb,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_spk,
					(SELECT tgl_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS ctgl_sp,
					(SELECT tgl_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS ctgl_bapb,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS ctgl_spk,
					(SELECT nama FROM mbank WHERE kode = '01') AS nama_bank,
					(SELECT nama FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND a.ketua=kode) AS nama_pejabat,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND a.ketua=kode) AS jabatan_pejabat,
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND a.ketua=kode) AS nama_singkat,
					(SELECT pangkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND a.ketua=kode) AS pangkat_pejabat,
					(SELECT nip FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND a.ketua=kode) AS nip_pejabat
					FROM plh_form_isian a 
					WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'"; */
					if($kd_skpd=='1.02.01.00' && $iduser=='842'){	
					$csql="SELECT a.ppn AS cppn,a.pph1 AS cpph1,a.pph2 AS cpph2,a.total AS tot,a.nm_kegiatan,b.pimpinan,
					b.jabatan,b.rumah,b.nama,b.npwp,b.kantor,c.no_sp,c.no_bast AS no_bapb,c.no_spk,c.tgl_sp AS ctgl_sp,c.tgl_bast AS ctgl_bapb,
					c.tgl_spk AS ctgl_spk,(SELECT nama FROM mbank WHERE kode = '01') AS nama_bank,
					
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nama_pejabat, 
					(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS jabatan_pejabat, 
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nama_singkat, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS pangkat_pejabat,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nip_pejabat

					FROM plh_form_isian a 
					LEFT JOIN mrekanan b ON b.kd_skpd=a.kd_uskpd AND b.kode=a.rekanan
					LEFT JOIN pl_lengkap c ON c.no_transaksi=a.no_transaksi AND c.kd_skpd=a.kd_uskpd
					LEFT JOIN mpejabat d ON d.kd_skpd=a.kd_uskpd AND a.ketua=d.kode
					WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";}else{
					$csql="SELECT a.ppn AS cppn,a.pph1 AS cpph1,a.pph2 AS cpph2,a.total AS tot,a.nm_kegiatan,b.pimpinan,
					b.jabatan,b.rumah,b.nama,b.npwp,b.kantor,c.no_sp,c.no_bast AS no_bapb,c.no_spk,c.tgl_sp AS ctgl_sp,c.tgl_bast AS ctgl_bapb,
					c.tgl_spk AS ctgl_spk,(SELECT nama FROM mbank WHERE kode = '01') AS nama_bank,d.nama AS nama_pejabat,
					d.jabatan AS jabatan_pejabat,d.nama_singkat AS nama_singkat,d.pangkat AS pangkat_pejabat,d.nip AS nip_pejabat
					FROM plh_form_isian a 
					LEFT JOIN mrekanan b ON b.kd_skpd=a.kd_uskpd AND b.kode=a.rekanan
					LEFT JOIN pl_lengkap c ON c.no_transaksi=a.no_transaksi AND c.kd_skpd=a.kd_uskpd
					LEFT JOIN mpejabat d ON d.kd_skpd=a.kd_uskpd AND a.ketua=d.kode
					WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";
					}
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row)
						//$jumlah_cp = $row->tot - ($row->cppn+$row->cpph1+$row->cpph2);
						//$jumlah_ppn = $row->tot / $row->cppn;
						//$jumlah_pph = $row->tot+($row->tot / $row->cppn);
						//$jumlahall = $jumlah_cp + $jumlah_ppn + $jumlah_pph;
						//$tgl  = $this->tanggal_indonesia($row->ctgl_sk);
						$ctgl1 = $row->ctgl_sp;
						$ctanggal1=$this->tanggal_indonesia($ctgl1); 
						$nosp = $row->no_sp;
						$ctgl2 = $row->ctgl_spk;
						$ctanggal2=$this->tanggal_indonesia($ctgl2); 
						$nospk = $row->no_spk;
						$tgl1= $row->ctgl_bapb;
						$tahun= substr($tgl1,0,4);
						$bulan= substr($tgl1,5,2);
						$tanggal= substr($tgl1,8,2);
						$tglfix1 = date("d/m/Y",strtotime("$tgl1"));
							$tanggalx = $tgl1; 
							$query = "SELECT datediff('$tanggalx', CURDATE()) as selisih";
							$hasil = mysql_query($query);
							$data  = mysql_fetch_array($hasil);
							$selisih = $data['selisih'];
							$x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y"));
							$namahari = date("l", $x);
								 if ($namahari == "Sunday") $namahari = "Minggu";
							else if ($namahari == "Monday") $namahari = "Senin";
							else if ($namahari == "Tuesday") $namahari = "Selasa";
							else if ($namahari == "Wednesday") $namahari = "Rabu";
							else if ($namahari == "Thursday") $namahari = "Kamis";
							else if ($namahari == "Friday") $namahari = "Jumat";
							else if ($namahari == "Saturday") $namahari = "Sabtu";
						
						 if ($nospk==0){
								$nofix=$nosp;
								$tglfix=$ctanggal1;
								$x="Surat Pesanan (SP)";
							
								}
								else{ 
								$nofix=$nospk;
								$tglfix=$ctanggal2;
								$x="Surat Perintah Kerja (SPK)";
							}
							
							$csqlku="SELECT
a.kode,a.nama,
CONCAT(SUBSTR(b.kodegiat,1,1),'.',SUBSTR(b.kodegiat,2,2),'.',SUBSTR(b.kodegiat,4,2),'.',SUBSTR(b.kodegiat,6,2),'.',SUBSTR(b.kodegiat,8,2),'.',SUBSTR(b.kode,1,1),'.',SUBSTR(b.kode,2,1),'.',SUBSTR(b.kode,3,1),'.',SUBSTR(b.kode,4,2),'.',SUBSTR(b.kode,6,2)) AS rekening
FROM m_rekening a
LEFT JOIN pld_form_isian b ON a.kode=b.kode 
WHERE b.no_transaksi='$kode' AND b.unit_skpd='$kd_skpd' GROUP BY kode";
							$hasil = $this->db->query($csqlku);
							$kodex="";
							$namax="";
							foreach ($hasil->result() as $rowkode){
								$nom 	 = $rowkode->kode;
								$gabung  = $rowkode->nama;
								$namarek = $rowkode->rekening;
								if($gabung==1){
								$namax	= ($gabung);
								}else{
								$namax	= ($gabung.",".$namax);
								}
								if($namarek==1){
								$kodex	= ($namarek);
								}else{
								$kodex	= ($namarek.",".$kodex);
								}
								}
							//$row->nm_rekening
		 $cRet = "<table width=\"100%\" border=\"0\" >
		<tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"25%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\"></td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
						<tr><td align=\"center\" colspan=\"3\" valign=\"bottom\" style=\"font-size:18px;\" ><b><u>BERITA ACARA SERAH TERIMA HASIL PEKERJAAN</u></b></td>
						</tr>
						<tr><td align=\"center\" colspan=\"3\" valign=\"bottom\" style=\"font-size:15px;\" >NOMOR : $row->no_bapb</td>
						</tr>
						</table>
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 <tr>
                            <td width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Pada Hari ini $namahari Tanggal ".$this->mdata2->terbilang($tanggal)." Bulan ".$this->mdata2->getBulan($bulan)." Tahun ".$this->mdata2->terbilang($tahun)."  ($tglfix1), Kami yang bertanda tangan di bawah ini masing - masing : </td>
						 </tr>
                       </table>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">:<b> $row->nama_pejabat</b></td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Jabatan</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">:<b> $row->jabatan_pejabat</b></td>
                        </tr>
						<tr>
                            <td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Selaku</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">:<b> $row->nama_singkat</b></td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Alamat</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">: $alamat</td>
                        </tr>
						 <tr>
							<td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\" colspan=\"2\">Selanjutnya disebut <b>PIHAK PERTAMA</b></td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">:<b> $row->pimpinan</b></td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">NPWP</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">: $row->npwp</td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Alamat</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">: $row->kantor</td>
                        </tr>
						 <tr>
							<td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\" colspan=\"2\">Selanjutnya disebut <b>PIHAK KEDUA</b></td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" align=\"justify\" style=\"font-size:14px;\">PIHAK PERTAMA dengan ini menyatakan bahwa pelaksanaan pekerjaan
							$namax pada $nama1 Kota Makassar Tahun Anggaran $thn telah selesai dilaksanakan sesuai kesepakatan dalam Surat Pesanan (SP) dan/atau 
							Surat Perintah Kerja (SPK), maka dengan ini PIHAK KEDUA menyerahkan kepada PIHAK PERTAMA hasil pekerjaan tersebut di atas, PIHAK PERTAMA telah menerima dengan baik sesuai $x 
							 : $nofix, Tanggal : $tglfix .
							</td>
                        </tr>
						<tr><td  width=\"100%\" colspan=\"3\" align=\"justify\" style=\"font-size:14px;\">Demikian Berita Acara Serah Terima ini kami buat untuk dapat dipergunakan dengan sebagaimana mestinya.
							</td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				 
				  <tr>
					<td>
						<table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">
                        </tr>
                                </table>
                            </td>
                        </tr>";
                  $cRet .="<tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:12px;\" align=\"center\" >
                            <tr>
                                <td align=\"center\" width=\"40%\">PIHAK KEDUA<br>
											 <b>$row->nama</b><br><br><br><br><br>
												<b><u>$row->pimpinan</u></b><br>$row->jabatan
                                    </td>
								<td align=\"center\" width=\"10%\" ></td>
								<td align=\"center\" width=\"50%\"><br>PIHAK PERTAMA<br>
											 <b>$row->nama_singkat</b><br><br><br><br><br>
												<b><u>$row->nama_pejabat</u></b><br>Pangkat : $row->pangkat_pejabat<br>Nip : $row->nip_pejabat
                                   </td>
                            </tr> 
                        </table>
        
                    </td>
                  </tr>
                        </table>
                    </td>
                  </tr>
                </table>";
        
         echo $cRet;
    }
	if($ctk=='17')
        {
		$kd_skpd = $this->session->userdata('skpd');
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$nama1  		= $mhorganisasi['nama'];
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
		$ckeg           = "SELECT a.bagian FROM m_kegiatan a INNER JOIN plh_form_isian b ON b.kegiatan=a.kode WHERE b.no_transaksi='$no' AND b.kd_uskpd='$skpd'";
		$hasilkeg = $this->db->query($ckeg);
						$i = 0;
					foreach ($hasilkeg->result() as $rowkeg)
					
		$ckeg1 = $rowkeg->bagian;
		
		if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00' or $skpd=='1.03.01.00'){
			if($ckeg1<>''){
		$csql = " SELECT a.no_transaksi,c.kd_uskpd,a.no_spk,a.tgl_bast,a.no_bast,a.no_bapp,a.tgl_bapp,a.no_spk,a.tgl_spk,a.no_sp,a.tgl_sp,c.kegiatan,
					(select nama from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as nama,
					(select jabatan from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as jabatan,
					(select pimpinan from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as pimpinan,
					(select rumah from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as rumah,
					(select notaris from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as notaris,
					(select no_notaris from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as no_notaris,
					(select tgl_notaris from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as tgl_notaris,
					(SELECT keterangan FROM plh_form_isian WHERE no_transaksi=a.no_transaksi AND kd_uskpd=a.kd_skpd) AS keterangan,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE a.no_transaksi=no_transaksi AND unit_skpd=a.`kd_skpd`) AS tot,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=c.kd_uskpd)AS tot2,
					(SELECT nm_kegiatan FROM plh_form_isian WHERE no_transaksi =a.`no_transaksi` AND kd_uskpd=a.`kd_skpd`) AS nama_kegiatan,
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=c.kegiatan AND b.singkat='KPA' and b.kd_skpd=c.kd_uskpd) AS nama_pejabat, 
					(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=c.kegiatan AND b.singkat='KPA' and b.kd_skpd=c.kd_uskpd) AS jabatan_pejabat, 
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=c.kegiatan AND b.singkat='KPA' and b.kd_skpd=c.kd_uskpd) AS nama_singkat,
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=c.kegiatan AND b.singkat='KPA' and b.kd_skpd=c.kd_uskpd) AS pangkat_pejabat, 
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=c.kegiatan AND b.singkat='KPA' and b.kd_skpd=c.kd_uskpd) AS nip_pejabat 
					FROM pl_lengkap a INNER JOIN
					plh_form_isian c ON a.no_transaksi=c.no_transaksi  INNER JOIN  
					mrekanan b ON c.rekanan=b.kode WHERE c.no_transaksi='$kode' AND a.no_transaksi='$kode' AND c.kd_uskpd='$skpd' AND a.kd_skpd='$skpd'";
				} else {
		$csql = " SELECT a.no_transaksi,c.kd_uskpd,a.no_spk,a.tgl_bast,a.no_bast,a.no_bapp,a.tgl_bapp,a.no_spk,a.tgl_spk,a.no_sp,a.tgl_sp,c.kegiatan,
					(select nama from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as nama,
					(select jabatan from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as jabatan,
					(select pimpinan from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as pimpinan,
					(select rumah from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as rumah,
					(select notaris from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as notaris,
					(select no_notaris from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as no_notaris,
					(select tgl_notaris from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as tgl_notaris,
					(SELECT keterangan FROM plh_form_isian WHERE no_transaksi=a.no_transaksi AND kd_uskpd=a.kd_skpd) AS keterangan,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE a.no_transaksi=no_transaksi AND unit_skpd=a.`kd_skpd`) AS tot,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=c.kd_uskpd)AS tot2,
					(SELECT nm_kegiatan FROM plh_form_isian WHERE no_transaksi =a.`no_transaksi` AND kd_uskpd=a.`kd_skpd`) AS nama_kegiatan,
					(SELECT jabatan FROM mpejabat WHERE singkat='PA' AND kd_skpd=a.kd_skpd) AS jabatan_pejabat,
					(SELECT nama FROM mpejabat WHERE singkat='PA' AND kd_skpd=a.kd_skpd) AS nama_pejabat, 
					(SELECT nama_singkat FROM mpejabat WHERE singkat='PA' AND kd_skpd=a.kd_skpd) AS nama_singkat, 
					(SELECT pangkat FROM mpejabat WHERE singkat='PA' AND kd_skpd=a.kd_skpd) AS pangkat_pejabat, 
					(SELECT nip FROM mpejabat WHERE singkat='PA' AND kd_skpd=a.kd_skpd) AS nip_pejabat 
					FROM pl_lengkap a INNER JOIN
					plh_form_isian c ON a.no_transaksi=c.no_transaksi  INNER JOIN  
					mrekanan b ON c.rekanan=b.kode WHERE c.no_transaksi='$kode' AND a.no_transaksi='$kode' AND c.kd_uskpd='$skpd' AND a.kd_skpd='$skpd'";
				}
			} else {
		$csql = " SELECT a.no_transaksi,c.kd_uskpd,a.no_spk,a.tgl_bast,a.no_bast,a.no_bapp,a.tgl_bapp,a.no_spk,a.tgl_spk,a.no_sp,a.tgl_sp,c.kegiatan,
						(select nama from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as nama,
						(select jabatan from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as jabatan,
						(select pimpinan from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as pimpinan,
						(select rumah from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as rumah,
						(select notaris from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as notaris,
						(select no_notaris from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as no_notaris,
						(select tgl_notaris from mrekanan where kode=c.rekanan and kd_skpd=c.kd_uskpd) as tgl_notaris,
						(SELECT keterangan FROM plh_form_isian WHERE no_transaksi=a.no_transaksi AND kd_uskpd=a.kd_skpd) AS keterangan,
						(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE a.no_transaksi=no_transaksi AND unit_skpd=a.`kd_skpd`) AS tot,
						(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=c.kd_uskpd)AS tot2,
						(SELECT nm_kegiatan FROM plh_form_isian WHERE no_transaksi =a.`no_transaksi` AND kd_uskpd=a.`kd_skpd`) AS nama_kegiatan,
						(SELECT jabatan FROM mpejabat WHERE singkat='PA' AND kd_skpd=a.kd_skpd) AS jabatan_pejabat,
						(SELECT nama FROM mpejabat WHERE singkat='PA' AND kd_skpd=a.kd_skpd) AS nama_pejabat, 
						(SELECT nama_singkat FROM mpejabat WHERE singkat='PA' AND kd_skpd=a.kd_skpd) AS nama_singkat, 
						(SELECT pangkat FROM mpejabat WHERE singkat='PA' AND kd_skpd=a.kd_skpd) AS pangkat_pejabat, 
						(SELECT nip FROM mpejabat WHERE singkat='PA' AND kd_skpd=a.kd_skpd) AS nip_pejabat 
						FROM pl_lengkap a INNER JOIN
						plh_form_isian c ON a.no_transaksi=c.no_transaksi  INNER JOIN  
						mrekanan b ON c.rekanan=b.kode WHERE c.no_transaksi='$kode' AND a.no_transaksi='$kode' AND c.kd_uskpd='$skpd' AND a.kd_skpd='$skpd'";
		}

				
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row){
						$tgl  = $this->tanggal_indonesia($row->tgl_bast);
						$tgl1 = $this->tanggal_indonesia($row->tgl_spk);
						$tgl11 = $this->tanggal_indonesia($row->tgl_sp);
						$nospk = $row->no_spk;
						$nosp = $row->no_sp;
						$kegiatan=$row->kegiatan;
						$tglnotaris = $row->tgl_notaris;
						$tgl4 = $this->tanggal_indonesia($tglnotaris);		
						$jabatan_pejabat = $row->jabatan_pejabat;
						$nama_pejabat = $row->nama_pejabat;
						$nip_pejabat = $row->nip_pejabat;
						$nama_singkat = $row->nama_singkat;
						$pangkat_pejabat = $row->pangkat_pejabat;
						$nama = $row->nama;
						$nama_kegiatan = $row->nama_kegiatan;
						$jabatan = $row->jabatan;
						$pimpinan = $row->pimpinan;
						$rumah = $row->rumah;
						$keterangan = $row->keterangan;
						$notaris = $row->notaris;
						$no_notaris = $row->no_notaris;
						$tot = $row->tot+$row->tot2;
						$tglbapp= $row->tgl_bapp;
						$tahun= substr($tglbapp,0,4);
						$bulan= substr($tglbapp,5,2);
						$tanggal= substr($tglbapp,8,2);
						$tglfix1 = date("d/m/Y",strtotime("$tglbapp"));
						
							$tanggalx = $tglbapp; 
							$query = "SELECT datediff('$tanggalx', CURDATE()) as selisih";
							$hasil = mysql_query($query);
							$data  = mysql_fetch_array($hasil);
							$selisih = $data['selisih'];
							$x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y"));
							$namahari = date("l", $x);
								 if ($namahari == "Sunday") $namahari = "Minggu";
							else if ($namahari == "Monday") $namahari = "Senin";
							else if ($namahari == "Tuesday") $namahari = "Selasa";
							else if ($namahari == "Wednesday") $namahari = "Rabu";
							else if ($namahari == "Thursday") $namahari = "Kamis";
							else if ($namahari == "Friday") $namahari = "Jumat";
							else if ($namahari == "Saturday") $namahari = "Sabtu";
						
						 if ($nospk==0){
								$nofix=$nosp;
								$tglfix=$tgl11;
								$x="Surat Pesanan (SP)";
							
								}
								else{ 
								$nofix=$nospk;
								$tglfix=$tgl1;
								$x="Surat Perintah Kerja (SPK)";
							}
		 $cRet = "<table width=\"100%\" border=\"0\" >
		 <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"25%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama1)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
						<tr><td align=\"center\" colspan=\"2\" valign=\"bottom\" style=\"font-size:18px;\" ><b><u>BERITA ACARA PEMBAYARAN</u></b></td>
						</tr>
						<tr><td align=\"center\" colspan=\"2\" valign=\"bottom\" style=\"font-size:15px;\" >NOMOR : $row->no_bapp</td>
						</tr>
                    <table border=\"0\" width=\"100%\">
					<table border=\"0\" width=\"80%\" align=\"center\">
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 <tr>
                            <td width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Pada Hari ini $namahari, Tanggal ".$this->mdata2->terbilang($tanggal)." Bulan ".$this->mdata2->getBulan($bulan)." Tahun ".$this->mdata2->terbilang($tahun)."  ($tglfix1), Kami yang bertandatangan di bawah ini : </td>
						 </tr>
                       </table>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:12px;\" align=\"center\">
                        <tr>
                            <td width=\"1%\" style=\"font-size:13px;\" align=\"right\">1.</td>
                            <td width=\"24%\" style=\"font-size:13px;\">NAMA</td>
                            <td  width=\"75%\" style=\"font-size:13px;\">: $nama_pejabat</td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:13px;\" align=\"right\"></td>
                            <td width=\"24%\" style=\"font-size:13px;\">JABATAN</td>
                            <td  width=\"75%\" style=\"font-size:13px;\">: $jabatan_pejabat</td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:13px;\"></td>
                            <td width=\"24%\" style=\"font-size:13px;\">ALAMAT</td>
                            <td  width=\"75%\" style=\"font-size:13px;\">: $alamat</td>
                        </tr>
						 <tr>
							<td width=\"1%\" style=\"font-size:13px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\" colspan=\"2\">Untuk selanjutnya disebut <b>PIHAK PERTAMA</b></td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:13px;\" align=\"right\">2.</td>
                            <td width=\"24%\" style=\"font-size:13px;\">NAMA</td>
                            <td  width=\"75%\" style=\"font-size:13px;\">: $pimpinan</td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:13px;\"></td>
                            <td width=\"24%\" style=\"font-size:13px;\">JABATAN</td>
                            <td  width=\"75%\" style=\"font-size:13px;\">: $jabatan</td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:13px;\"></td>
                            <td width=\"24%\" style=\"font-size:13px;\">ALAMAT</td>
                            <td  width=\"75%\" style=\"font-size:13px;\">: $rumah</td>
                        </tr>
                        <tr>
							<td width=\"1%\" style=\"font-size:13px;\"></td>
                            <td width=\"100%\" style=\"font-size:14px;\" colspan=\"2\">Untuk selanjutnya disebut <b>PIHAK KEDUA</b></td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" align=\"justify\" style=\"font-size:14px;\">Yang berwenang dalam hal ini bertindak untuk dan atas nama $nama,
						 untuk melaksanakan Pekerjaan $keterangan, pada Kegiatan $nama_kegiatan pada PEMERINTAH KOTA MAKASSAR Tahun Anggaran $thn.</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				  <tr>
					<td>";
					if($skpd=='1.18.01.00' && $kegiatan=='118011203'){
					$ppn = (($tot*10)/100);
						$cRet.="<table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">
						<tr>
                            <td width=\"70%\" colspan=\"2\">Dengan nilai pekerjaan sebesar</td>
							<td width=\"20%\"><b>Rp. ".number_format(round($tot+$ppn))."</b></td>
                        </tr>
						<tr>
                            <td colspan=\"3\">Berdasarkan :</td>
                        </tr>
						 </table>";
						 }else{
						$cRet.="<table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">
						<tr>
                            <td width=\"70%\" colspan=\"2\">Dengan nilai pekerjaan sebesar</td>
							<td width=\"20%\"><b>Rp. ".number_format($tot)."</b></td>
                        </tr>
						<tr>
                            <td colspan=\"3\">Berdasarkan :</td>
                        </tr>
						 </table>";
						 }
                    $cRet.="</td>
                  </tr>
				  <tr>
					<td>
						<table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">
						<tr>
                            <td width=\"60%\" >1. $x</td>
							<td colspan=\"2\" align=\"left\" width=\"80%\" valign=\"top\">No. $nofix Tanggal $tglfix</td>
                        </tr>
						<tr>
                            <td width=\"60%\" >2. Berita Acara Serah Terima Pekerjaan</td>
							<td colspan=\"2\" width=\"80%\" valign=\"top\">No. $row->no_bast Tanggal $tgl</td>
                        </tr>
						</tr>
						 <tr><td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Maka PIHAK KEDUA berhak menerima Pembayaran dengan rincian :</td>
                        </tr>";
					if($skpd=='1.18.01.00' && $kegiatan=='118011203'){
					$ppn = (($tot*10)/100);
						$cRet.="<tr>
                            <td colspan=\"2\" width=\"80%\" >1. Jumlah Pembayaran sampai dengan Angsuran ini</td>
							<td  align=\"left\" width=\"20%\" >Rp. ".number_format(round($tot+$ppn))."</td>
                        </tr>
						<tr>
							<td colspan=\"2\" width=\"80%\" >2. Jumlah Pembayaran sampai dengan yang lalu</td>
                            <td width=\"20%\" >Rp.______________________</td>
                        </tr>
						<tr>
							<td colspan=\"2\" align=\"left\" width=\"80%\" ><b>3. Jumlah Pembayaran Angsuran sekarang sebelum Pemotongan</b></td>
                            <td width=\"20%\" ><b>Rp. ".number_format(round($tot+$ppn))."</b></td>
                        </tr>";}else{
						$cRet.="<tr>
                            <td colspan=\"2\" width=\"80%\" >1. Jumlah Pembayaran sampai dengan Angsuran ini</td>
							<td  align=\"left\" width=\"20%\" >Rp. ".number_format($tot)."</td>
                        </tr>
						<tr>
							<td colspan=\"2\" width=\"80%\" >2. Jumlah Pembayaran sampai dengan yang lalu</td>
                            <td width=\"20%\" >Rp.______________________</td>
                        </tr>
						<tr>
							<td colspan=\"2\" align=\"left\" width=\"80%\" ><b>3. Jumlah Pembayaran Angsuran sekarang sebelum Pemotongan</b></td>
                            <td width=\"20%\" ><b>Rp. ".number_format($tot)."</b></td>
                        </tr>";
						}
						
						$cRet.="<tr>
                            <td colspan=\"2\" width=\"80%\"  >4. Jumlah Potongan - potongan</td>
							<td width=\"20%\"></td>
                        </tr>
						<tr>
                            <td colspan=\"2\" align=\"left\" width=\"80%\"  >   - Pengembalian Retensi / J. Pemeliharaan 5%</td>
							<td width=\"20%\">Rp.</td>
                        </tr>
						<tr>
                            <td colspan=\"2\" width=\"80%\" >   - Pengembalian Uang Muka</td>
							<td  width=\"20%\">Rp.______________________</td>
                        </tr>
						<tr>
                            <td colspan=\"2\" align=\"left\" width=\"80%\"  ></td>
							<td width=\"20%\"><b>Jumlah Potongan 	Rp. </b></td>
                        </tr>";
					if($skpd=='1.18.01.00' && $kegiatan=='118011203'){
					$ppn = (($tot*10)/100);
						$cRet.="<tr>
							<td  colspan=\"2\" width=\"80%\">5. Jumlah Pembayaran Sekarang (setelah dikurangi Pemotongan)</td>
                            <td  width=\"20%\">Rp. ".number_format(round($tot+$ppn))."</td>
                        </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\"><b>REKAPITULASI PEMBAYARAN</b></td>
                        </tr>
						<tr>
                            <td colspan=\"2\" align=\"left\" width=\"80%\" >1. Nilai Kontrak Awal</td>
							<td width=\"20%\" >Rp. ".number_format(round($tot+$ppn))."</td>
                        </tr>
						<tr>
                            <td colspan=\"2\" width=\"80%\">2. Telah diterima Uang Muka sebesar</td>
							<td width=\"20%\"  >Rp.</td>
                        </tr>
						<tr>
                            <td colspan=\"2\" align=\"left\" width=\"80%\" >3. Telah diterima Angsuran Pertama % sebesar</td>
							<td  width=\"20%\">Rp. </td>
                        </tr>
						<tr>
                            <td colspan=\"2\" width=\"80%\" >4. Telah diterima Angsuran Kedua  % sebesar</td>
							<td width=\"20%\" >Rp. </td>
                        </tr>
						<tr>
                            <td colspan=\"2\" align=\"left\" width=\"80%\">5. Telah diterima Angsuran Ketiga   % sebesar</td>
							<td  width=\"20%\" >Rp. </td>
                        </tr>
						<tr>
                            <td colspan=\"2\" width=\"80%\" ><b>6. Diminta Sekarang</b></td>
							<td width=\"20%\" ><b>Rp. ".number_format(round($tot+$ppn))."</b></td>
                        </tr>
						<tr>
                            <td colspan=\"2\" align=\"left\" width=\"80%\" ><b>7. Jumlah</b></td>
							<td width=\"20%\" ><b><u>Rp. ".number_format(round($tot+$ppn))."</u></b></td>
                        </tr>";}else{
						$cRet.="<tr>
							<td  colspan=\"2\" width=\"80%\">5. Jumlah Pembayaran Sekarang (setelah dikurangi Pemotongan)</td>
                            <td  width=\"20%\">Rp. ".number_format($tot)."</td>
                        </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\"><b>REKAPITULASI PEMBAYARAN</b></td>
                        </tr>
						<tr>
                            <td colspan=\"2\" align=\"left\" width=\"80%\" >1. Nilai Kontrak Awal</td>
							<td width=\"20%\" >Rp. ".number_format($tot)."</td>
                        </tr>
						<tr>
                            <td colspan=\"2\" width=\"80%\">2. Telah diterima Uang Muka sebesar</td>
							<td width=\"20%\"  >Rp.</td>
                        </tr>
						<tr>
                            <td colspan=\"2\" align=\"left\" width=\"80%\" >3. Telah diterima Angsuran Pertama % sebesar</td>
							<td  width=\"20%\">Rp. </td>
                        </tr>
						<tr>
                            <td colspan=\"2\" width=\"80%\" >4. Telah diterima Angsuran Kedua  % sebesar</td>
							<td width=\"20%\" >Rp. </td>
                        </tr>
						<tr>
                            <td colspan=\"2\" align=\"left\" width=\"80%\">5. Telah diterima Angsuran Ketiga   % sebesar</td>
							<td  width=\"20%\" >Rp. </td>
                        </tr>
						<tr>
                            <td colspan=\"2\" width=\"80%\" ><b>6. Diminta Sekarang</b></td>
							<td width=\"20%\" ><b>Rp. ".number_format($tot)."</b></td>
                        </tr>
						<tr>
                            <td colspan=\"2\" align=\"left\" width=\"80%\" ><b>7. Jumlah</b></td>
							<td width=\"20%\" ><b><u>Rp. ".number_format($tot)."</u></b></td>
                        </tr>";
						}
						
						
						$cRet.="<tr>
                            <td colspan=\"2\" width=\"80%\" ><b>8. Sisa Kontrak</b></td>
							<td width=\"20%\" ><b>Rp. NIHIL</b></td>
                        </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Demikian Berita Acara ini dibuat dengan sebenarnya dan menjadi Sah setelah ditandatangani kedua belah pihak.</td>
                        </tr>
                                </table>
                            </td>
                        </tr>";
                  $cRet .="<tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\" >
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                                        <tr><td></td>
                                            <td align=\"center\"><b>PIHAK KEDUA<br>$row->nama<br><br><br><br><br>
                                            <u>$row->pimpinan</u><br>$row->jabatan
                                            </b></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"10%\">
                                </td>";
								if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00'){
                                $cRet.="<td width=\"60%\">
                                    <table border=\"0\" width=\"90%\" style=\"font-size:14px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\"><b>PIHAK PERTAMA<br>
											 $nama_singkat<br>Selaku Pejabat Pembuat Komitmen<br><br><br><br>
												<u>$nama_pejabat</u><br>Pangkat:$pangkat_pejabat<br>Nip. $nip_pejabat</b>
                                            </td>
                                        </tr> 
                                    </table>
                                </td>";}elseif($skpd=='1.03.01.00'){
                                $cRet.="<td width=\"60%\">
                                    <table border=\"0\" width=\"90%\" style=\"font-size:14px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\"><b>PIHAK PERTAMA<br>
											 $nama_singkat<br><br><br><br><br>
												<u>$nama_pejabat</u><br>Pangkat:$pangkat_pejabat<br>Nip. $nip_pejabat</b>
                                            </td>
                                        </tr> 
                                    </table>
                                </td>";
								
								}else{
                                $cRet.="<td width=\"60%\">
                                    <table border=\"0\" width=\"90%\" style=\"font-size:14px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\"><b>PIHAK PERTAMA<br>
											 $nama_singkat<br><br><br><br><br>
												<u>$nama_pejabat</u><br>Pangkat:$pangkat_pejabat<br>Nip. $nip_pejabat</b>
                                            </td>
                                        </tr> 
                                    </table>
                                </td>";
								
								}
                            $cRet.="</tr>
                        </table>
                    </td>
                  </tr>
                        </table>
                    </td>
                  </tr>
                </table>";}
        
         echo $cRet;
    }
	if($ctk=='18')
      {
		$kd_skpd = $this->session->userdata('skpd');
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$nama1  		= $mhorganisasi['nama'];
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$no 			= $_REQUEST['kode'];
		$csql = "SELECT a.jml_ppn AS cppn,a.jml_pph1 AS cpph1,a.jml_pph2 AS cpph2,a.kegiatan, 
					(SELECT pimpinan FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS pimpinan,
					(SELECT jabatan FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS jabatan,
					(SELECT rumah FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS rumah,
					(SELECT nama FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS nama,
					(SELECT npwp FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS npwp,
					(SELECT kantor FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS kantor,
					(SELECT c.nama FROM mrekanan b inner join mbank c on b.bank=c.kode WHERE b.kd_skpd=a.kd_uskpd AND b.kode=a.rekanan) AS bank,
					(SELECT tgl_sk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS ctgl_sk,
					(SELECT b.nama FROM mbank b inner join mrekanan c on c.bank=b.kode where c.kode=a.rekanan and c.kd_skpd=a.kd_uskpd group by c.bank) AS nama_bank,
					(SELECT rekening FROM mrekanan where kode=a.rekanan and kd_skpd=a.kd_uskpd) AS rekening,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS jabatan_pejabat,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_akhir) FROM plh_form_isian WHERE no_transaksi=a.no_transaksi AND kd_uskpd=a.kd_uskpd)AS tot2,
					(SELECT nama_perantara FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS nama_perantara,
					(SELECT pimpinan_perantara FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS pimpinan_perantara,
					(SELECT jabat_perantara FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS jabat_perantara,
					(SELECT b.nama FROM mpajak b LEFT JOIN plh_form_isian a ON b.kode=a.ppn WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd' AND a.ppn<>'00') AS nama_ppn,
					(SELECT b.nama FROM mpajak b LEFT JOIN plh_form_isian a ON b.kode=a.pph1 WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd' AND a.pph1<>'00') AS nama_pph1,
					(SELECT b.nama FROM mpajak b LEFT JOIN plh_form_isian a ON b.kode=a.pph2 WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd' AND a.pph2<>'00') AS nama_pph2
					FROM plh_form_isian a 
					WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row)
						$kegiatan=$row->kegiatan;
						$Ppn    = $row->cppn;
						$nm_ppn = $row->nama_ppn;
						$Pph1   = $row->cpph1;
						$nm_pph1 = $row->nama_pph1;
						$Pph2   = $row->cpph2;
						$nm_pph2 = $row->nama_pph2;
						$jumtot = $row->tot2;
						$Pphtot = $Pph1+$Pph2;
						$total  = $jumtot-$Pph2-$Pph1-$Ppn;
						//$jumlah_cp = $row->tot - ($row->cppn+$row->cpph1+$row->cpph2);
						//$jumlah_ppn = $row->tot / $row->cppn;
						//$jumlah_pph = $row->tot+($row->tot / $row->cppn);
						//$jumlahall = $jumlah_cp + $jumlah_ppn + $jumlah_pph;
						$tgl  = $this->tanggal_indonesia($row->ctgl_sk);
		 $cRet = "<table width=\"100%\" border=\"0\" >
		<tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr><td align=\"center\" colspan=\"2\" valign=\"bottom\" style=\"font-size:23px;\" ><b><u>SURAT KUASA</u></b></td>
						</tr>
						</table>
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 <tr>
                            <td width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Yang bertanda tangan di bawah ini:</td>
						 </tr>
                       </table>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama Lengkap</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">:<b> $row->pimpinan</b></td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Jaatan</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">: $row->jabatan</td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Alamat</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">: $row->rumah</td>
                        </tr>
						 <tr>
							<td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\" colspan=\"2\">Dalam hal ini bertindak untuk dan atas nama:</td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">:<b> $row->nama</b></td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">NPWP</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">: $row->npwp</td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Alamat</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">: $row->kantor</td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" align=\"justify\" style=\"font-size:14px;\">Memberikan Kuasa kepada Bendahara Umum Daerah dan / atau
							Pejabat lain yang ditunjuk oleh Walikota Makassar sebagai Ordonateur untuk memindahbukukan dana
							dari SPM atas nama kami ke dalam Rekening, sebagai berikut :
							</td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				 
				  <tr>
					<td>
						<table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">
						<tr>
                            <td colspan=\"2\" width=\"93%\" >I. Rek.&nbsp;&nbsp;&nbsp;&nbsp;$row->rekening &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row->bank</td>
							<td width=\"7%\" ></td>
							<td  align=\"right\" width=\"7%\" > ".number_format($total)."</td>
                        </tr>
						<tr>
							<td colspan=\"2\" width=\"93%\" >II. Rek.&nbsp;&nbsp;&nbsp;130.002.020423.2 (PPN) $nm_ppn</td>
							<td width=\"7%\" ></td>
                            <td align=\"right\" width=\"7%\" > ".number_format($Ppn)."</td>
                        </tr>
						<tr>";
						
					/* 	if($nm_pph1<>"" && $nm_pph2==""){
							$cRet.="<td colspan=\"2\" align=\"left\" width=\"93%\" >III. Rek. 130.002.020423.2 (PPH) $nm_pph1</td>";}
							elseif($nm_pph1=="" && $nm_pph2<>""){
							$cRet.="<td colspan=\"2\" align=\"left\" width=\"93%\" >III. Rek. 130.002.020423.2 (PPH) $nm_pph2</td>";}
							elseif($nm_pph1<>"" && $nm_pph2<>""){
							$cRet.="<td colspan=\"2\" align=\"left\" width=\"93%\" >III. Rek. 130.002.020423.2 (PPH) $nm_pph1 
							<br>IV. Rek. 130.002.020423.2 (PPH) $nm_pph2</td>";
							
							}
							else{
							$cRet.="<td colspan=\"2\" align=\"left\" width=\"93%\" >III. Rek. 130.002.020423.2 (PPH)</td>
							
							<td width=\"7%\" ></td>
                            <td align=\"right\" width=\"7%\" > ".number_format($Pph1)." <br> ".number_format($Pph2)."</td>";} */
						if($nm_pph1<>"" && $nm_pph2==""){
							$cRet.="<td colspan=\"2\" align=\"left\" width=\"93%\" >III. Rek. 130.002.020423.2 (PPH) $nm_pph1</td>
							<td width=\"7%\" ></td>
                            <td align=\"right\" width=\"7%\" > ".number_format($Pph1)."</td></tr>";
							}
						elseif($nm_pph1=="" && $nm_pph2<>""){
							$cRet.="<td colspan=\"2\" align=\"left\" width=\"93%\" >III. Rek. 130.002.020423.2 (PPH) $nm_pph2</td>
							<td width=\"7%\" ></td>
                            <td align=\"right\" width=\"7%\" > ".number_format($Pph2)."</td></tr>";
							}
						elseif($nm_pph1<>"" && $nm_pph2<>""){
						$cRet.="
						<tr>
							<td colspan=\"2\" width=\"93%\" >III. Rek. 130.002.020423.2 (PPH) $nm_pph1</td>
							<td width=\"7%\" ></td>
                            <td align=\"right\" width=\"7%\" > ".number_format($Pph1)."</td>
						</tr>
						<tr>
							<td colspan=\"2\" width=\"93%\" >IV. Rek. 130.002.020423.2 (PPH) $nm_pph2</td>
							<td width=\"7%\" ></td>
                            <td align=\"right\" width=\"7%\" > ".number_format($Pph2)."</td>
						</tr>";
							}	
							
                $cRet.="
						<tr>
							<td colspan=\"2\" align=\"left\" width=\"93%\" ></td>
							<td width=\"7%\" ></td>
                            <td width=\"7%\" >____________________</td>
                        </tr>
						<tr>
							<td colspan=\"2\" align=\"center\" width=\"80%\" ><b>JUMLAH</b></td>
							<td width=\"7%\" align=\"right\">Rp :</td>
                            <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"right\"><b> ".number_format($jumtot)."</b></td>
							
                        </tr>
						 <tr><td  width=\"100%\"  colspan=\"3\" style=\"font-size:14px;\" align=\"justify\"><b>Terbilang: <i>(".$this->mdata2->terbilang($jumtot)." Rupiah)</b></i></td>
                        </tr>
                                </table>
                            </td>
                        </tr>";
                  $cRet .="<tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:12px;\" align=\"center\" >
                            <tr>";
							if($row->nama_perantara<>''){
                                $cRet.="<td width=\"30%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\"><br> Yang Menerima Kuasa<br>
											 <b>An. $row->nama_perantara</b><br><br><br><br><br>
												<b><u>$row->pimpinan_perantara</u></b><br>$row->jabat_perantara
                                            </td>
                                        </tr>
                                    </table>
                                </td>";}else{
								 $cRet.="<td width=\"30%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\"><br><br>
											 <b></b><br><br><br><br><br>
												<b><u></u></b><br>
                                            </td>
                                        </tr>
                                    </table>
                                </td>";
								}
                               $cRet.=" <td width=\"30%\">
                                </td>
                                <td width=\"40%\">
                                    <table border=\"0\" width=\"80%\" style=\"font-size:14px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">Makassar, $tgl<br> Yang Memberi Kuasa<br>
											 <b>An. $row->nama</b><br><br><br><br><br>
												<b><u>$row->pimpinan</u></b><br>$row->jabatan
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                        </table>
                    </td>
                  </tr>
                </table>";
        
         echo $cRet;
    }
	if($ctk=='19')
               {
			   $kd_skpd = $this->session->userdata('skpd');
				$konfig 		= $this->ambil_config();
				$mhorganisasi 	= $this->ambil_mhorganisasi();
				$thn  			= $this->session->userdata('ta_simbakda');
				$nm_skpd		= $this->session->userdata('nama_simbakda');		
				$iduser			= $this->session->userdata('iduser');

				$skpd			= $this->session->userdata('skpd');
				$skpdx			= $this->session->userdata('skpd');
				$kota  			= $konfig['kota'];
				$nama  			= strtoupper($mhorganisasi['nama']);
				$nama1  		= $mhorganisasi['nama'];
				$alamat			= $mhorganisasi['alamat'];
				$nm_skpd		= $mhorganisasi['nama_skpd'];
				$nip_ketua	    = $mhorganisasi['nip_skpd'];
				$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
				//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
				$kota2 			= strtoupper($konfig['kota']);
				$konfig			= $this->ambil_config();
				//$nmkab=strtoupper($konfig['nm_client']);
				$logo 			= $konfig['logo'];
				$no 			= $_REQUEST['kode'];
				/* 
				$ckeg           = "SELECT a.bagian,c.`singkatan` FROM m_kegiatan a INNER JOIN plh_form_isian b 
									ON b.kegiatan=a.kode JOIN mbagian_bidang c ON c.kode=a.bagian AND c.`kd_skpd`=a.organisasi 
									WHERE b.no_transaksi='$no' AND b.kd_uskpd='$skpd'"; */
				$ckeg     = "SELECT a.bagian FROM m_kegiatan a INNER JOIN plh_form_isian b ON b.kegiatan=a.kode WHERE b.no_transaksi='$no' AND b.kd_uskpd='$skpd'";
				$hasilkeg = $this->db->query($ckeg);
						$i = 0;
					foreach ($hasilkeg->result() as $rowkeg)
				$ckeg1  = $rowkeg->bagian;
				//$csing1 =  $rowkeg->singkatan;
		if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00' or $skpd=='1.03.01.00'){
			if($ckeg1<>''){
		$csql = "SELECT CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
					a.keterangan,a.nm_kegiatan AS nama_kegiatan,a.kegiatan,
					(SELECT CONCAT(SUBSTR(kode,1,1),'.',SUBSTR(kode,2,1),'.',SUBSTR(kode,3,1),'.',SUBSTR(kode,4,2),'.',SUBSTR(kode,6,2)) AS rek FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd GROUP BY kodegiat) AS koderek,
					(select nama from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as rekanan,
					(SELECT no_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_sp,
					(SELECT tgl_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_sp,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_spk,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_spk,
					(SELECT no_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_bast,
					(SELECT tgl_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_bast,
					(SELECT tgl_bapp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_bapp,
					(SELECT tgl_kuitansi FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_kuitansi,
					(SELECT no_bapp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_bapp,
					(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS pimpinan,
					(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
					(SELECT nama FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS nama3,
					(SELECT nip FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS nip3,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS jabatan_pejabat,
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS singkat3,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS jabatan3,
					(SELECT pangkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS pangkat3,
					
										
					(SELECT nama FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='KTU') AS nama4,
					(SELECT nip FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='KTU') AS nip4,
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='KTU') AS singkat4,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='KTU') AS jabatan4,
					(SELECT pangkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='KTU') AS pangkat4,

					
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nama1, 
					(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS jabatan1,
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS singkat1, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA'and b.kd_skpd=a.kd_uskpd) AS pangkat1,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nip1,
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='BPP' and b.kd_skpd=a.kd_uskpd) AS nama2, 
					(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='BPP' and b.kd_skpd=a.kd_uskpd) AS jabatan2,
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='BPP' and b.kd_skpd=a.kd_uskpd) AS singkat2, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='BPP'and b.kd_skpd=a.kd_uskpd) AS pangkat2,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='BPP' and b.kd_skpd=a.kd_uskpd) AS nip2,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT ifnull(SUM(jml_akhir),0) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2,
				a.jml_ppn AS cppn,a.jml_pph1 AS cpph1,a.jml_pph2 AS cpph2
				FROM plh_form_isian a  
				 WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'"; } //SELECT *,SUM(jumlah) FROM pld_form_isian WHERE unit_skpd='1.05.01.00' AND no_transaksi='0018'
				 //					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
				 else {
				 $csql = "SELECT CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
					a.keterangan,a.nm_kegiatan AS nama_kegiatan,a.kegiatan,
					(SELECT CONCAT(SUBSTR(kode,1,1),'.',SUBSTR(kode,2,1),'.',SUBSTR(kode,3,1),'.',SUBSTR(kode,4,2),'.',SUBSTR(kode,6,2)) AS rek FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd GROUP BY kodegiat) AS koderek,
					(select nama from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as rekanan,
					(SELECT no_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_sp,
					(SELECT tgl_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_sp,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_spk,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_spk,
					(SELECT no_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_bast,
					(SELECT tgl_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_bast,
					(SELECT tgl_bapp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_bapp,
					(SELECT tgl_kuitansi FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_kuitansi,
					(SELECT no_bapp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_bapp,
					(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS pimpinan,
					(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
					(SELECT nama FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS nama1,
					(SELECT nip FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS nip1,
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS singkat1,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS jabatan1,
					(SELECT pangkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS pangkat1,
					(SELECT nama FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='BENDP') AS nama2,
					(SELECT nip FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='BENDP') AS nip2,
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='BENDP') AS singkat2,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='BENDP') AS jabatan2,
					(SELECT pangkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='BENDP') AS pangkat2,
					(SELECT nama FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS nama3,
					(SELECT nip FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS nip3,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS jabatan_pejabat,
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS singkat3,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS jabatan3,
					(SELECT pangkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS pangkat3,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT ifnull(SUM(jml_akhir),0) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2,
				a.jml_ppn AS cppn,a.jml_pph1 AS cpph1,a.jml_pph2 AS cpph2
				FROM plh_form_isian a  
				 WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";
				}
			} else { 
			$csql = "SELECT CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
					a.keterangan,a.nm_kegiatan AS nama_kegiatan,a.kegiatan,
					(SELECT CONCAT(SUBSTR(kode,1,1),'.',SUBSTR(kode,2,1),'.',SUBSTR(kode,3,1),'.',SUBSTR(kode,4,2),'.',SUBSTR(kode,6,2)) AS rek FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd GROUP BY kodegiat) AS koderek,
					(select nama from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as rekanan,
					(SELECT no_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_sp,
					(SELECT tgl_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_sp,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_spk,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_spk,
					(SELECT no_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_bast,
					(SELECT tgl_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_bast,
					(SELECT tgl_bapp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_bapp,
					(SELECT tgl_kuitansi FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS tgl_kuitansi,
					(SELECT no_bapp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_bapp,
					(SELECT pimpinan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS pimpinan,
					(SELECT jabatan FROM mrekanan WHERE kode=a.rekanan AND kd_skpd=a.kd_uskpd) AS jabatan_rekanan,
					
					(SELECT nama FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS nama1,
					(SELECT nip FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS nip1,
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS singkat1,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS jabatan1,
					(SELECT pangkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS pangkat1,
					
					(SELECT nama FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='BENDP') AS nama2,
					(SELECT nip FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='BENDP') AS nip2,
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='BENDP') AS singkat2,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='BENDP') AS jabatan2,
					(SELECT pangkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='BENDP') AS pangkat2,
					(SELECT nama FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS nama3,
					(SELECT nip FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS nip3,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND singkat='PA') AS jabatan_pejabat,
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS singkat3,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS jabatan3,
					(SELECT pangkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND kode=a.pptk) AS pangkat3,

					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS ketua, 
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT ifnull(SUM(jml_akhir),0) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2,
				a.jml_ppn AS cppn,a.jml_pph1 AS cpph1,a.jml_pph2 AS cpph2
				FROM plh_form_isian a  
				 WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";
				}
				 
				 
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row)
						$tgl  = $this->tanggal_indonesia($row->tgl_sp);
						$nm_kegiatan= $row->nama_kegiatan;
						$tgl11  = $this->tanggal_indonesia($row->tgl_spk);
						$kegiatan=$row->kegiatan;
						$nosp = $row->no_sp;
						$nospk = $row->no_spk;
						$tgl1  = $this->tanggal_indonesia($row->tgl_bast);
						$tgl2  = $this->tanggal_indonesia($row->tgl_bapp);
						$tgl3  = $this->tanggal_indonesia($row->tgl_kuitansi);
						$jumtot = $row->tot+$row->tot2;
						//$jumlah_cp = $row->tot - ($row->cppn+$row->cpph1+$row->cpph2);
						//$jumlah_ppn = $row->cppn;
						//$jumlah_pph = $row->tot+($row->tot / $row->cppn);
						$jumlahall = $jumtot;
						//$jumlah_cp + $jumlah_ppn + $jumlah_pph;
						   if ($nospk==0){
								$nofix=$nosp;
								$tglfix=$tgl;
								$x="Surat Pesanan Nomor";
							
								}
								else{ 
								$nofix=$nospk;
								$tglfix=$tgl11;
								$x="SPK Nomor";
							}
							
							$csqlku="SELECT
a.kode,a.nama,
CONCAT(SUBSTR(b.kodegiat,1,1),'.',SUBSTR(b.kodegiat,2,2),'.',SUBSTR(b.kodegiat,4,2),'.',SUBSTR(b.kodegiat,6,2),'.',SUBSTR(b.kodegiat,8,2),'.',SUBSTR(b.kode,1,1),'.',SUBSTR(b.kode,2,1),'.',SUBSTR(b.kode,3,1),'.',SUBSTR(b.kode,4,2),'.',SUBSTR(b.kode,6,2)) AS rekening
FROM m_rekening a
LEFT JOIN pld_form_isian b ON a.kode=b.kode 
WHERE b.no_transaksi='$kode' AND b.unit_skpd='$kd_skpd' GROUP BY kode";
							$hasil = $this->db->query($csqlku);
							$namax="";
							$kodex="";
							foreach ($hasil->result() as $rowkode){
								$nom 	 = $rowkode->kode;
								$gabung  = $rowkode->nama;
								$namarek = $rowkode->rekening;
								if($gabung==1){
								$namax	= ($gabung);
								}else{
								$namax	= ($gabung.",".$namax);
								}
								if($namarek==1){
								$kodex	= ($namarek);
								}else{
								$kodex	= ($namarek.",".$kodex);
								}
								}
							//$row->kodegiat.$row->koderek
							//$row->nama_kegiatan
		 $cRet = "<table width=\"100%\" border=\"0\" >
		<tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr><td align=\"center\" colspan=\"2\" valign=\"bottom\"><h1><b><u>K W I T A N S I</u></b></h1></td>
						</tr>
						</table>
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 <tr>
                            <td width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Yang bertanda tangan di bawah ini :</td>
						 </tr>
                       </table>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Kode Rekening</td>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">$kodex</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Buku Kas No</td>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">...........................</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\">Tanggal</td>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">...........................</td>
                        </tr>
						<tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Terima dari</td>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\" valign=\"top\">:</td>";
							if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00'){
                            $cRet.="<td  width=\"75%\" style=\"font-size:14px;\">$row->jabatan1</td>";}else{
							$cRet.="<td  width=\"75%\" style=\"font-size:14px;\">$row->jabatan1 selaku $row->singkat1</td>";
							}// $row->keterangan 
				if($kd_skpd=='1.18.01.00' && $kegiatan=='118011203'){		
					$ppn=(($jumlahall*10)/100);
                $cRet.="</tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Banyak Uang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:15px;\">=== ".$this->mdata2->terbilang(round($jumlahall+$ppn))." Rupiah ===</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Untuk Pembayaran</td>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" align=\"justify\"> $namax 
									Pada Kegiatan $nm_kegiatan Sesuai $x &nbsp; : $nofix Tanggal : $tglfix, BA. Serah Terima
									Hasil Pekerjaan Nomor : $row->no_bast Tanggal $tgl1, BA.
									Pembayaran Nomor : $row->no_bapp Tanggal $tgl2</td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr></tr>
						<table border=\"1\" width=\"40%\" style=\"font-size:15px;\" align=\"center\">
							<tr><td><i><b>Terbilang Rp.</b></i></td>
							<td bgcolor=\"#CCCCCC\"><b>&nbsp;&nbsp;&nbsp;&nbsp;".number_format(round($jumlahall+$ppn)).",-</b></td></tr>
						</table>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
                    </table>
                    </td>
                  </tr>";}else{		
                $cRet.="</tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Banyak Uang</td>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:15px;\">=== ".$this->mdata2->terbilang($jumlahall)." Rupiah ===</td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:14px;\" valign=\"top\">Untuk Pembayaran</td>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\" valign=\"top\">:</td>
                            <td  width=\"75%\" style=\"font-size:14px;\" align=\"justify\"> $namax 
									Pada Kegiatan $nm_kegiatan Sesuai $x &nbsp; : $nofix Tanggal : $tglfix, BA. Serah Terima
									Hasil Pekerjaan Nomor : $row->no_bast Tanggal $tgl1, BA.
									Pembayaran Nomor : $row->no_bapp Tanggal $tgl2</td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr></tr>
						<table border=\"1\" width=\"40%\" style=\"font-size:15px;\" align=\"center\">
							<tr><td><i><b>Terbilang Rp.</b></i></td>
							<td bgcolor=\"#CCCCCC\"><b>&nbsp;&nbsp;&nbsp;&nbsp;".number_format($jumlahall).",-</b></td></tr>
						</table>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
                    </table>
                    </td>
                  </tr>";
				  }
                  $cRet .="<tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\" >
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"80%\" style=\"font-size:13px;\">
                                        <tr>";
										if($skpdx=='1.01.01.00' or $skpdx=='1.02.01.00' or $skpdx=='1.20.03.00'){
											$cRet.="<td align=\"center\">DIKETAHUI / DISETUJUI<br><b>$row->jabatan1<br><b>Selaku Pejabat Pembuat Komitmen</b><br><br><br><br><br>
                                           <u>$row->nama1</u> <br>NIP. $row->nip1</td>";
                                        }else{
											$cRet.="<td align=\"center\">DIKETAHUI / DISETUJUI<br><b>$row->jabatan1<br>selaku <b>$row->singkat1</b><br><br><br><br><br>
                                           <u>$row->nama1</u> <br>NIP. $row->nip1</td>";
										}
										$cRet.="</tr>
                                    </table>
                                </td>
                                <td width=\"40%\">
                                    <table border=\"0\" width=\"80%\" style=\"font-size:13px;\">";
									if($skpdx=='1.02.01.00' && $iduser=='842'){
                                        $cRet.="<tr>
                                            <td colspan=\"2\" align=\"center\"><b>$row->jabatan4<br> SELAKU <b>$row->singkat4</b><br>
											 <br><br><br><br><br>
												<b><u>$row->nama4</u></b><br>NIP. $row->nip4
                                            </td>
                                        </tr>"; }else{  $cRet.="<tr>
                                            <td colspan=\"2\" align=\"center\"><b>$row->jabatan3<br> SELAKU <b>$row->singkat3</b><br>
											 <br><br><br><br><br>
												<b><u>$row->nama3</u></b><br>NIP. $row->nip3
                                            </td>
                                        </tr>"; }
                                    $cRet.="</table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
				  <table border=\"0\" width=\"100%\" style=\"font-size:13px;\">
                                        <tr>
										<td colspan=\"2\" align=\"center\" width=\"33%\"><br> 
                                            </td>
                                            <td colspan=\"2\" align=\"center\" width=\"67%\">Makassar, $tgl3<br> 
                                            </td>
                                        </tr> 
                                    </table>
				  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:13px;\" align=\"center\" >
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"80%\" style=\"font-size:13px;\">";
									if($skpd=='1.02.01.00' && $ckeg1=='01'){
                                        $cRet.="<tr>
											<td align=\"center\"><b>BENDAHARA PENGELUARAN<br><br><br><br><br><br>
                                            <u>$row->nama2</u><br>Nip. $row->nip2</b></td>
                                        </tr>";}else{ 
										$cRet.="<tr>
											<td align=\"center\"><b>$row->jabatan2<br><br><br><br><br><br>
                                            <u>$row->nama2</u><br>Nip. $row->nip2</b></td>
                                        </tr>";
										}
                                   $cRet.=" </table>
                                </td>
                                <td width=\"40%\">
                                    <table border=\"0\" width=\"80%\" style=\"font-size:13px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">Yang Menerima<br>
											 <b>An. $row->rekanan</b><br><br><br><br><br>
												<b><u>$row->pimpinan</u></b><br>$row->jabatan_rekanan
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                        </table>
                    </td>
                  </tr>
                </table>";
        
         echo $cRet;
    }
	if($ctk=='20'){

        $konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
		$ckeg           = "SELECT a.bagian FROM m_kegiatan a INNER JOIN plh_form_isian b ON b.kegiatan=a.kode WHERE b.no_transaksi='$no' AND b.kd_uskpd='$skpd'";
		$hasilkeg = $this->db->query($ckeg);
						$i = 0;
					foreach ($hasilkeg->result() as $rowkeg)
					
		$ckeg1 = $rowkeg->bagian;
		
		if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00' or $skpd=='1.03.01.00'){
			if($ckeg1<>''){
		
		$csql 		= "SELECT a.kd_uskpd,a.kegiatan,
					CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
					a.nm_kegiatan,a.keterangan,a.rekanan,
					(select nama from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd) as nama_rekanan,
					(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
					(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
					(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat, 
					(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
					(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
					(select kantor from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as alamat_rekanan,
					(select pimpinan from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as pimpinan,
					(select jabatan from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as jabatan_pimpinan,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spk,
					(SELECT no_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_sp,
					(SELECT tgl_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_sp,
					(SELECT no_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_bast,
					(SELECT tgl_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_bast,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spk,
					(SELECT no_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spr,
					(SELECT tgl_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spr,
					(SELECT tgl_ssp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_ssp,
					(SELECT spbj FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS spbj,
					(SELECT wkt_pel FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS wkt_pel,
					(SELECT jns_pem FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS jns_pem,
					(select ket_spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as ket_spbj,
					(SELECT tgl_rngks_kntrk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_rk,
					(SELECT nama FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS staf_penerima,
					(SELECT jabatan FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS jabatan_penerima,
					(SELECT nama_singkat FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS nama_singkat_penerima, 
					(SELECT pangkat FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS pangkat_penerima,
					(SELECT nip FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS nip_penerima,
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS ketua, 
					(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS jabatan_ketua,
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nama_singkat_ketua, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA'and b.kd_skpd=a.kd_uskpd) AS pangkat_ketua,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='KPA' and b.kd_skpd=a.kd_uskpd) AS nip_ketua,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2
					FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
		            }
					else {
		$csql 		= "SELECT a.kd_uskpd,a.kegiatan,
					CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
					a.nm_kegiatan,a.keterangan,a.rekanan,
					(select nama from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd) as nama_rekanan,
					(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
					(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
					(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat, 
					(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
					(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
					(select kantor from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as alamat_rekanan,
					(select pimpinan from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as pimpinan,
					(select jabatan from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as jabatan_pimpinan,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spk,
					(SELECT no_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_sp,
					(SELECT no_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_bast,
					(SELECT tgl_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_bast,
					(SELECT tgl_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_sp,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spk,
					(SELECT no_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spr,
					(SELECT tgl_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spr,
					(SELECT tgl_ssp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_ssp,
					(SELECT spbj FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS spbj,
					(select ket_spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as ket_spbj,
					(SELECT wkt_pel FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS wkt_pel,
					(SELECT tgl_rngks_kntrk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_rk,
					(SELECT nama FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS staf_penerima,
					(SELECT jabatan FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS jabatan_penerima,
					(SELECT nama_singkat FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS nama_singkat_penerima, 
					(SELECT pangkat FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS pangkat_penerima,
					(SELECT nip FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS nip_penerima,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
					(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua,
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua, 
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2
					FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
					}
				}   else {
				$csql 		= "SELECT a.kd_uskpd,a.kegiatan,
					CONCAT(SUBSTR(a.kegiatan,1,1),'.',SUBSTR(a.kegiatan,2,2),'.',SUBSTR(a.kegiatan,4,2),'.',SUBSTR(a.kegiatan,6,2),'.',SUBSTR(a.kegiatan,8,2)) AS kodegiat,
					a.nm_kegiatan,a.keterangan,a.rekanan,
					(select nama from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd) as nama_rekanan,
					(SELECT nama FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama,
					(SELECT jabatan FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS jabatan,
					(SELECT nama_singkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nama_singkat, 
					(SELECT pangkat FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS pangkat,
					(SELECT nip FROM mpejabat WHERE a.pptk=kode AND a.kd_uskpd=kd_skpd)AS nip,
					(select kantor from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as alamat_rekanan,
					(select pimpinan from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as pimpinan,
					(select jabatan from mrekanan where a.rekanan=kode and kd_skpd=a.kd_uskpd)as jabatan_pimpinan,
					(SELECT no_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_bast,
					(SELECT tgl_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_bast,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spk,
					(SELECT no_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_sp,
					(SELECT tgl_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_sp,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spk,
					(SELECT no_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS no_spr,
					(SELECT tgl_spr FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_spr,
					(SELECT tgl_ssp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_ssp,
					(SELECT spbj FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS spbj,
					(select ket_spbj from pl_lengkap where kd_skpd=a.kd_uskpd and no_transaksi=a.no_transaksi) as ket_spbj,
					(SELECT wkt_pel FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS wkt_pel,
					(SELECT jns_pem FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS jns_pem,
					(SELECT tgl_rngks_kntrk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tgl_rk,
					(SELECT nama FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS staf_penerima,
					(SELECT jabatan FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS jabatan_penerima,
					(SELECT nama_singkat FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS nama_singkat_penerima, 
					(SELECT pangkat FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS pangkat_penerima,
					(SELECT nip FROM mpejabat WHERE a.staf_penerima=kode AND a.kd_uskpd=kd_skpd) AS nip_penerima,
					(SELECT nama FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS ketua, 
					(SELECT jabatan FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS jabatan_ketua,
					(SELECT nama_singkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nama_singkat_ketua, 
					(SELECT pangkat FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS pangkat_ketua,
					(SELECT nip FROM mpejabat WHERE a.kd_uskpd=kd_skpd AND singkat='PA') AS nip_ketua,
					(SELECT SUM(jml_akhir) FROM pld_form_isian WHERE no_transaksi=a.no_transaksi AND unit_skpd=a.kd_uskpd)AS tot,
					(SELECT SUM(jml_akhir) FROM pld_form_rincian WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd)AS tot2
					FROM plh_form_isian a WHERE a.no_transaksi='$no' AND a.kd_uskpd='$skpd'";
				}
	   $hasil = $this->db->query($csql);
	   $i 	  = 0;
	   foreach ($hasil->result() as $rowi){
	   $cRet  = '';
	   $keterangan = $rowi->keterangan;
	   $nm_kegiatan= $rowi->nm_kegiatan;
	   $kegiatan   = $rowi->kegiatan;
	   $ctgl=$rowi->tgl_rk;
	   $ctgl1=$rowi->tgl_ssp;
	   $ctgl11=$rowi->tgl_bast;
	   $ctanggal=$this->tanggal_indonesia($ctgl); 
	   $ctanggal1=$this->tanggal_indonesia($ctgl1); 
	   $ctanggal11=$this->tanggal_indonesia($ctgl11);
	   $rekanan   = $rowi->rekanan;
	   $alamat_rekanan   = $rowi->alamat_rekanan;
	   $jumtot = $rowi->tot+$rowi->tot2;
	   $nospk = $rowi->no_spk;
	   $tglspk = $rowi->tgl_spk;
	   $tglspk1=$this->tanggal_indonesia($tglspk); 
	   $nosp = $rowi->no_sp;
	   $tglsp = $rowi->tgl_sp;
	   $ket_spbj = $rowi->ket_spbj;
	   $tglsp1=$this->tanggal_indonesia($tglsp); 
	   $pelihara =$rowi->wkt_pel;
	   if ($nospk==0){
			$nofix=$nosp;
			$tglfix=$tglsp1;
			}
			else{ 
			$nofix=$nospk;
			$tglfix=$tglspk1;
		}
		
		if ($pelihara==0){
			$peliharafix='-';
			//$tglpelihara='-';
			}
			else{
			$peliharafix=$pelihara." Hari Kalender";
			//$tglpelihara=$ctanggal;
		}
	
          $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">

                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\" align=\"center\">
                  <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"25%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                        <tr><td></td>
                            <td colspan=\"2\" style=\"font-size:14px;\" align=\"center\">
                                <b><u>RINGKASAN KONTRAK</u></b>
                                <br>&nbsp;
                            </td>
                        </tr>
                    </table>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                        <tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\">1. &nbsp;&nbsp;&nbsp;Nama Kegiatan 
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">$nm_kegiatan
                            </td>
                        </tr>
						<tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\">2. &nbsp;&nbsp;&nbsp;Nomor dan Tanggal SP/SPK/KONTRAK
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">$nofix &nbsp;&nbsp;&nbsp;Tanggal : $tglfix
                            </td>
                        </tr>
						<tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\">3. &nbsp;&nbsp;&nbsp;Nama Perusahaan
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">$rowi->nama_rekanan
                            </td>
                        </tr>
						<tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\">4. &nbsp;&nbsp;&nbsp;Nama Pimpinan
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">$rowi->pimpinan
                            </td>
                        </tr>";
						if($skpd=='1.18.01.00' && $kegiatan=='118011203'){
						$ppn	= (($jumtot*10)/100);
						$cRet.="<tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\">5. &nbsp;&nbsp;&nbsp;Nilai SP/SPK/Kontrak
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">Rp. ".number_format(round($jumtot+$ppn))."
                            </td>
                        </tr>";}else{
						$cRet.="<tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\">5. &nbsp;&nbsp;&nbsp;Nilai SP/SPK/Kontrak
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">Rp. ".number_format($jumtot)."
                            </td>
                        </tr>";
						}
						
						$cRet.="<tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\">6. &nbsp;&nbsp;&nbsp;Uraian dan Volume
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">$keterangan
                            </td>
                        </tr>
						 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
                        <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>";//}
                         $cRet .="<tr>
                           <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                                    <tr>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>NO</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>URAIAN</b></td>
                                        <td bgcolor=\"#CCCCCC\"  align=\"center\" style=\"font-size:13px;\"><b>SATUAN</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>KUANTITAS</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>HARGA SATUAN (Rp)</b></td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:13px;\"><b>JUMLAH (Rp)</b></td>
                                    </tr>
									<tr>
                                        <td align=\"center\" style=\"font-size:13px;\">1</td>
                                        <td align=\"center\" style=\"font-size:13px;\">2</td>
                                        <td align=\"center\" style=\"font-size:13px;\">3</td>
                                        <td align=\"center\" style=\"font-size:13px;\">4</td>
                                        <td align=\"center\" style=\"font-size:13px;\">5</td>
                                        <td align=\"center\" style=\"font-size:13px;\">6=5x4</td>
                                    </tr>";
							$sql="SELECT a.kode,a.nama,b.no_transaksi,b.unit_skpd,CONCAT(b.kode,b.no) AS rekening FROM m_rekening a 
									LEFT JOIN pld_form_isian b ON a.kode=b.kode WHERE b.no_transaksi='$no' AND b.unit_skpd='$skpd' GROUP BY kode";
							  $hsql=$this->db->query($sql);
								$jumlahxa  = 0;
								$jumlahxz = 0;
							  foreach ($hsql->result() as $row)
								{
									$i++; 
									$no_trans   =$row->no_transaksi;
									$nmkegiatan =$row->nama;
									$kd_skpd    =$row->unit_skpd; 								
									$ckoderek   =$row->kode;
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"><b>$i</b></td>
                                        <td align=\"left\" style=\"font-size:13px;\"><b>$nmkegiatan</b></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                        <td align=\"right\" style=\"font-size:13px;\"></td>
                                    </tr>";
                                    
                             // $csql = "SELECT b.uraian,b.satuan,b.vol,b.harga,b.jumlah,a.total as jumlahxxx FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' and b.unit_skpd='$kd_skpd' group by kode";
							 // $csql = "SELECT CONCAT(b.kode,b.no) AS rekening,b.uraian,b.satuan,b.vol,b.harga,b.jumlah FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE b.no_transaksi='$no_trans' AND b.unit_skpd='$kd_skpd' GROUP BY rekening  ORDER BY rekening";
							  $csql = "SELECT * FROM (
										SELECT CONCAT(kode,NO) AS rekening,no_transaksi,kode,kodegiat,no,unit_skpd,tahun,uraian,satuan,vol,harga_akhir as harga,jml_akhir as jumlah FROM pld_form_isian 
										WHERE no_transaksi='$no_trans' AND unit_skpd='$kd_skpd')a WHERE LEFT(rekening,7)=$ckoderek  ORDER BY kode,no";
							  $hasil = $this->db->query($csql);
							  
								
								foreach ($hasil->result() as $row)
								{
									$no_transaksi  	=$row->no_transaksi;
									$unit_skpd 		=$row->unit_skpd;
									$kode 			=$row->kode;
									$kodegiat		=$row->kodegiat;
									$no				=$row->no;
									$tahun			=$row->tahun;
									$uraian			=$row->uraian;
									$jumlahxx  =$row->jumlah;
									$jumlahxa =$jumlahxa+$jumlahxx;
                           $cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">$row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol==0){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}
										if($row->harga==0){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>";}
										if($row->jumlah==0){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";}
                                    $cRet .="</tr>";
										$csq2 = "SELECT CONCAT(a.kode,a.NO) AS rekening,a.uraian,a.satuan,a.vol,a.harga_akhir as harga,a.jml_akhir as jumlah FROM pld_form_rincian a 
										INNER JOIN pld_form_isian b ON a.`no_transaksi`=b.`no_transaksi` AND a.`kode`=a.`kode` AND a.`kodegiat`=b.`kodegiat`
										AND a.`no`=a.`no` AND a.`uraian_header`=b.`uraian` AND a.`tahun`=b.`tahun`
									    WHERE b.no_transaksi='$no_transaksi' AND b.unit_skpd='$unit_skpd' 
										and b.kode='$kode' and b.kodegiat='$kodegiat' and b.no='$no' and b.uraian='$uraian' and b.tahun='$tahun' ORDER BY a.kode,a.no,a.no_urut";
								$hasi2 = $this->db->query($csq2);
								
								foreach ($hasi2->result() as $row)
								{
									$jumlahxxd  =$row->jumlah;
									$jumlahxz =$jumlahxz+$jumlahxxd;
									/* $cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">- $row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";
										if($row->vol==0){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}
										if($row->harga==0){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>";}
										if($row->jumlah==0){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";}
                                    $cRet .="</tr>"; */
									$cRet .=" <tr>
                                        <td align=\"center\" style=\"font-size:13px;\"></td>
                                        <td align=\"left\" style=\"font-size:13px;\">- $row->uraian</td>
                                        <td align=\"center\" style=\"font-size:13px;\">$row->satuan</td>";
										if($row->vol==0){
                                        $cRet .="<td align=\"center\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"center\" style=\"font-size:13px;\">$row->vol</td>";}
										if($row->harga==0){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->harga)."</td>";}
										if($row->jumlah==0){
                                        $cRet .="<td align=\"right\" style=\"font-size:13px;\"></td>";}else{
										$cRet .="<td align=\"right\" style=\"font-size:13px;\">".number_format($row->jumlah)."</td>";}
                                    $cRet .="</tr>";
									
								}
									
                                    }}
							if($skpd=='1.18.01.00' && $kegiatan=='118011203'){		
							  $tott = $jumlahxa+$jumlahxz;
							  $ppn	= (($tott*10)/100);
                              $cRet .="<tr>
                                        <td align=\"RIGHT\" colspan=\"5\" style=\"font-size:13px;\"><b>TOTAL</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr>
									<tr>
                                        <td align=\"RIGHT\" colspan=\"5\" style=\"font-size:13px;\"><b>PPN 10%</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($ppn)."</b></td>
                                    </tr>
									<tr>
                                        <td align=\"RIGHT\" colspan=\"5\" style=\"font-size:13px;\"><b>JUMLAH TOTAL</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott+$ppn)."</b></td>
                                    </tr>
                                </table>";}else{	
							  $tott = $jumlahxa+$jumlahxz;
                              $cRet .="<tr>
                                        <td align=\"center\" colspan=\"5\" style=\"font-size:13px;\"><b>JUMLAH</b></td>
										<td align=\"right\" style=\"font-size:13px;\"><b>".number_format($tott)."</b></td>
                                    </tr>
                                </table>";
								
								}
                  $cRet .="</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				  <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
				 <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:14px;\">
                        <tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\">7. &nbsp;&nbsp;&nbsp;Cara Pembayaran 
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">$rowi->jns_pem
                            </td>
                        </tr>
						<tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\">8. &nbsp;&nbsp;&nbsp;Jangka Waktu Pelaksanaan
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">$rowi->spbj $ket_spbj
                            </td>
                        </tr>
						<tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\">9. &nbsp;&nbsp;&nbsp;Tanggal Penyelesaian Pekerjaan 
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">$ctanggal11
                            </td>
                        </tr>
						<tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\">10. &nbsp;&nbsp;Jangka Waktu Pemeliharaan
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">$peliharafix
                            </td>
                        </tr>
						<tr>
                            <td width=\"40%\" valign=\"top\" style=\"font-size:14px;\" >11. &nbsp;&nbsp;Ketentuan atau Sanksi
                            </td>
                            <td width=\"1%\" valign=\"top\" style=\"font-size:14px;\">:
                            </td>
                            <td  width=\"70%\" valign=\"top\" style=\"font-size:14px;\">Jika Pekerjaan tidak dapat diselesaikan dalam jangka waktu pelaksanaan pekerjaan karena
							 kesalahan atau kelalaian Penyedia maka Penyedia berkewajiban untuk membayar denda kepada
							 Pengguna Anggaran / Kuasa Pengguna Anggaran sebesar 1/1000 (Satu Per Seribu) dari nilai 
							 SP/SPK/Kontrak atau nilai bagian SP/SPK/Kontrak untuk setiap hari keterlambatan.
                            </td>
                        </tr>

						 <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
                     </table>
                <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr><td></td>
                                            
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"10%\">
                                </td>
                                <td width=\"60%\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr>";
                                            if($skpd=='1.01.01.00' or $skpd=='1.02.01.00' or $skpd=='1.20.03.00'){
											$cRet.="<td colspan=\"2\" align=\"center\">
												Makassar,  $ctanggal<br>
                                                <b>$rowi->jabatan_ketua</b><br>Selaku Pejabat Pembuat Komitmen<br><br><br><br><br>
												<b><u>$rowi->ketua</u></b><br>Pangkat : $rowi->pangkat_ketua<br>Nip. : $rowi->nip_ketua
                                            </td>";}elseif($skpd=='1.03.01.00' ){
											$cRet.="<td colspan=\"2\" align=\"center\">
												Makassar,  $ctanggal<br>
                                                <b>$rowi->jabatan_ketua</b><br>Selaku Kuasa Pengguna Anggaran<br><br><br><br><br>
												<b><u>$rowi->ketua</u></b><br>Pangkat : $rowi->pangkat_ketua<br>Nip. : $rowi->nip_ketua
                                            </td>";}else{
											$cRet.="<td colspan=\"2\" align=\"center\">
												Makassar,  $ctanggal<br>
                                                <b>$rowi->jabatan_ketua</b><br>Selaku $rowi->nama_singkat_ketua<br><br><br><br><br>
												<b><u>$rowi->ketua</u></b><br>Pangkat : $rowi->pangkat_ketua<br>Nip. : $rowi->nip_ketua
                                            </td>";
											}
                                        $cRet.="</tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                  <tr>
					<td align=\"center\" >
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr><td></td>
                        
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                </table>";
        }
         echo $cRet;
         
		 
		}
		
		if($ctk=='21')
        {
		$kd_skpd = $this->session->userdata('skpd');
		$konfig 		= $this->ambil_config();
		$mhorganisasi 	= $this->ambil_mhorganisasi();
		$thn  			= $this->session->userdata('ta_simbakda');
		$nm_skpd		= $this->session->userdata('nama_simbakda');
		$skpd			= $this->session->userdata('skpd');
		$iduser			= $this->session->userdata('iduser');
		$kota  			= $konfig['kota'];
		$nama  			= strtoupper($mhorganisasi['nama']);
		$nama1  		= $mhorganisasi['nama'];
		$alamat			= $mhorganisasi['alamat'];
		$nm_skpd		= $mhorganisasi['nama_skpd'];
		$nip_ketua	    = $mhorganisasi['nip_skpd'];
		$pangkat_ketuax  =$mhorganisasi['pangkat_skpd'];
		//$nama_singkat  = strtoupper($mhorganisasi['nama_singkat']);
		$kota2 			= strtoupper($konfig['kota']);
        $konfig			= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 			= $konfig['logo'];
		$logo2 			= $konfig['logo2'];
		$no 			= $_REQUEST['kode'];
	/* 	
		$csql = "SELECT a.ppn AS cppn,a.pph1 AS cpph1,a.pph2 AS cpph2,a.total AS tot,a.nm_kegiatan,
					(SELECT b.nama FROM pld_form_isian a INNER JOIN m_rekening b ON a.kode=b.kode WHERE a.unit_skpd='$skpd' AND no_transaksi='$kode' GROUP BY a.no_transaksi)AS nm_rekening,
					(SELECT pimpinan FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS pimpinan,
					(SELECT jabatan FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS jabatan,
					(SELECT rumah FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS rumah,
					(SELECT nama FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS nama,
					(SELECT npwp FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS npwp,
					(SELECT kantor FROM mrekanan WHERE kd_skpd=a.kd_uskpd AND kode=a.rekanan) AS kantor,
					(SELECT no_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_sp,
					(SELECT no_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_bapb,
					(SELECT no_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS no_spk,
					(SELECT tgl_sp FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS ctgl_sp,
					(SELECT tgl_bast FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS ctgl_bapb,
					(SELECT tgl_spk FROM pl_lengkap WHERE no_transaksi=a.no_transaksi AND kd_skpd=a.kd_uskpd) AS ctgl_spk,
					(SELECT nama FROM mbank WHERE kode = '01') AS nama_bank,
					(SELECT nama FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND a.ketua=kode) AS nama_pejabat,
					(SELECT jabatan FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND a.ketua=kode) AS jabatan_pejabat,
					(SELECT nama_singkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND a.ketua=kode) AS nama_singkat,
					(SELECT pangkat FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND a.ketua=kode) AS pangkat_pejabat,
					(SELECT nip FROM mpejabat WHERE kd_skpd=a.kd_uskpd AND a.ketua=kode) AS nip_pejabat
					FROM plh_form_isian a 
					WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'"; */
					if($kd_skpd=='1.02.01.00' && $iduser=='842'){	
					$csql="SELECT a.ppn AS cppn,a.pph1 AS cpph1,a.pph2 AS cpph2,a.total AS tot,a.nm_kegiatan,b.pimpinan,
					b.jabatan,b.rumah,b.nama,b.npwp,b.kantor,c.no_sp,c.no_bast AS no_bapb,c.no_spk,c.tgl_sp AS ctgl_sp,c.tgl_bast AS ctgl_bapb,
					c.tgl_spk AS ctgl_spk,(SELECT nama FROM mbank WHERE kode = '01') AS nama_bank,
					
					(SELECT b.nama FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nama_pejabat, 
					(SELECT b.jabatan FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS jabatan_pejabat, 
					(SELECT b.nama_singkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nama_singkat, 
					(SELECT b.pangkat FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS pangkat_pejabat,
					(SELECT b.nip FROM mpejabat b INNER JOIN m_kegiatan c ON b.bagian=c.bagian WHERE c.kode=a.kegiatan AND b.singkat='PBA' AND b.kd_skpd=a.kd_uskpd) AS nip_pejabat

					FROM plh_form_isian a 
					LEFT JOIN mrekanan b ON b.kd_skpd=a.kd_uskpd AND b.kode=a.rekanan
					LEFT JOIN pl_lengkap c ON c.no_transaksi=a.no_transaksi AND c.kd_skpd=a.kd_uskpd
					LEFT JOIN mpejabat d ON d.kd_skpd=a.kd_uskpd AND a.ketua=d.kode
					WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";}else{
					$csql="SELECT a.ppn AS cppn,a.pph1 AS cpph1,a.pph2 AS cpph2,a.total AS tot,a.nm_kegiatan,b.pimpinan,
					b.jabatan,b.rumah,b.nama,b.npwp,b.kantor,c.no_sp,c.no_bast AS no_bapb,c.no_spk,c.tgl_sp AS ctgl_sp,c.tgl_bast AS ctgl_bapb,
					c.tgl_spk AS ctgl_spk,(SELECT nama FROM mbank WHERE kode = '01') AS nama_bank,d.nama AS nama_pejabat,
					d.jabatan AS jabatan_pejabat,d.nama_singkat AS nama_singkat,d.pangkat AS pangkat_pejabat,d.nip AS nip_pejabat
					FROM plh_form_isian a 
					LEFT JOIN mrekanan b ON b.kd_skpd=a.kd_uskpd AND b.kode=a.rekanan
					LEFT JOIN pl_lengkap c ON c.no_transaksi=a.no_transaksi AND c.kd_skpd=a.kd_uskpd
					LEFT JOIN mpejabat d ON d.kd_skpd=a.kd_uskpd AND a.ketua=d.kode
					WHERE a.no_transaksi='$kode' AND a.kd_uskpd='$kd_skpd'";
					}
                            $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $row)
						//$jumlah_cp = $row->tot - ($row->cppn+$row->cpph1+$row->cpph2);
						//$jumlah_ppn = $row->tot / $row->cppn;
						//$jumlah_pph = $row->tot+($row->tot / $row->cppn);
						//$jumlahall = $jumlah_cp + $jumlah_ppn + $jumlah_pph;
						//$tgl  = $this->tanggal_indonesia($row->ctgl_sk);
						$ctgl1 = $row->ctgl_sp;
						$ctanggal1=$this->tanggal_indonesia($ctgl1); 
						$nosp = $row->no_sp;
						$ctgl2 = $row->ctgl_spk;
						$ctanggal2=$this->tanggal_indonesia($ctgl2); 
						$nospk = $row->no_spk;
						$tgl1= $row->ctgl_bapb;
						$tahun= substr($tgl1,0,4);
						$bulan= substr($tgl1,5,2);
						$tanggal= substr($tgl1,8,2);
						$tglfix1 = date("d/m/Y",strtotime("$tgl1"));
							$tanggalx = $tgl1; 
							$query = "SELECT datediff('$tanggalx', CURDATE()) as selisih";
							$hasil = mysql_query($query);
							$data  = mysql_fetch_array($hasil);
							$selisih = $data['selisih'];
							$x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y"));
							$namahari = date("l", $x);
								 if ($namahari == "Sunday") $namahari = "Minggu";
							else if ($namahari == "Monday") $namahari = "Senin";
							else if ($namahari == "Tuesday") $namahari = "Selasa";
							else if ($namahari == "Wednesday") $namahari = "Rabu";
							else if ($namahari == "Thursday") $namahari = "Kamis";
							else if ($namahari == "Friday") $namahari = "Jumat";
							else if ($namahari == "Saturday") $namahari = "Sabtu";
						
						 if ($nospk==0){
								$nofix=$nosp;
								$tglfix=$ctanggal1;
								$x="Surat Pesanan (SP)";
							
								}
								else{ 
								$nofix=$nospk;
								$tglfix=$ctanggal2;
								$x="Surat Perintah Kerja (SPK)";
							}
							
							$csqlku="SELECT
a.kode,a.nama,
CONCAT(SUBSTR(b.kodegiat,1,1),'.',SUBSTR(b.kodegiat,2,2),'.',SUBSTR(b.kodegiat,4,2),'.',SUBSTR(b.kodegiat,6,2),'.',SUBSTR(b.kodegiat,8,2),'.',SUBSTR(b.kode,1,1),'.',SUBSTR(b.kode,2,1),'.',SUBSTR(b.kode,3,1),'.',SUBSTR(b.kode,4,2),'.',SUBSTR(b.kode,6,2)) AS rekening
FROM m_rekening a
LEFT JOIN pld_form_isian b ON a.kode=b.kode 
WHERE b.no_transaksi='$kode' AND b.unit_skpd='$kd_skpd' GROUP BY kode";
							$hasil = $this->db->query($csqlku);
							$kodex="";
							$namax="";
							foreach ($hasil->result() as $rowkode){
								$nom 	 = $rowkode->kode;
								$gabung  = $rowkode->nama;
								$namarek = $rowkode->rekening;
								if($gabung==1){
								$namax	= ($gabung);
								}else{
								$namax	= ($gabung.",".$namax);
								}
								if($namarek==1){
								$kodex	= ($namarek);
								}else{
								$kodex	= ($namarek.",".$kodex);
								}
								}
							//$row->nm_rekening
		 $cRet = "<table width=\"100%\" border=\"0\" >
		<tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:18px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA $kota2</b>
                            </td>
							<td rowspan=\"4\" width=\"25%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo2\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:16px;border: solid 1px white\"><b>".strtoupper($nama)."</b></td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:14px;border: solid 1px white;\">$alamat
                            </td>
                        </tr><br/>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\"></td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"font-size:12px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
						<tr><td align=\"center\" colspan=\"3\" valign=\"bottom\" style=\"font-size:18px;\" ><b><u>BERITA ACARA PEMBAYARAN PEKERJAAN</u></b></td>
						</tr>
						<tr><td align=\"center\" colspan=\"3\" valign=\"bottom\" style=\"font-size:15px;\" >NOMOR : $row->no_bapb</td>
						</tr>
						</table>
						<table border=\"0\" width=\"80%\" align=\"center\">
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 <tr>
                            <td width=\"100%\" colspan=\"3\" style=\"font-size:14px;\" align=\"justify\">Pada Hari ini $namahari Tanggal ".$this->mdata2->terbilang($tanggal)." Bulan ".$this->mdata2->getBulan($bulan)." Tahun ".$this->mdata2->terbilang($tahun)."  ($tglfix1), Kami yang bertanda tangan di bawah ini masing - masing : </td>
						 </tr>
                       </table>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama </td>
                            <td  width=\"75%\" style=\"font-size:14px;\">:<b> $row->nama_pejabat</b></td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Jabatan</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">:<b> $row->jabatan_pejabat</b></td>
                        </tr>
						<tr>
                            <td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Selaku</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">:<b> $row->nama_singkat</b></td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Alamat</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">: $alamat</td>
                        </tr>
						 <tr>
							<td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\" colspan=\"2\">Selanjutnya disebut <b>PIHAK PERTAMA</b></td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\" align=\"right\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Nama</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">:<b> $row->pimpinan</b></td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">NPWP</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">: $row->npwp</td>
                        </tr>
                        <tr>
                            <td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\">Alamat</td>
                            <td  width=\"75%\" style=\"font-size:14px;\">: $row->kantor</td>
                        </tr>
						 <tr>
							<td width=\"1%\" style=\"font-size:14px;\"></td>
                            <td width=\"24%\" style=\"font-size:14px;\" colspan=\"2\">Selanjutnya disebut <b>PIHAK KEDUA</b></td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
						 </tr>
						 <tr><td  width=\"100%\" colspan=\"3\" align=\"justify\" style=\"font-size:14px;\">
						 PIHAK PERTAMA dengan ini menyatakan bahwa pelaksanaan pekerjaan
							$namax pada $nama1 Kota Makassar Tahun Anggaran $thn telah selesai dilaksanakan sesuai kesepakatan dalam Surat Pesanan (SP) dan/atau 
							Surat Perintah Kerja (SPK), maka dengan ini PIHAK KEDUA menyerahkan kepada PIHAK PERTAMA hasil pekerjaan tersebut di atas, PIHAK PERTAMA telah menerima dengan baik sesuai $x 
							 : $nofix, Tanggal : $tglfix .
							</td>
                        </tr>
						<tr><td  width=\"100%\" colspan=\"3\" align=\"justify\" style=\"font-size:14px;\">Demikian Berita Acara Serah Terima ini kami buat untuk dapat dipergunakan dengan sebagaimana mestinya.
							</td>
                        </tr>
						<tr>
                            <td colspan=\"3\">&nbsp;</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				 
				  <tr>
					<td>
						<table border=\"0\" width=\"80%\" style=\"font-size:14px;\" align=\"center\">
                        </tr>
                                </table>
                            </td>
                        </tr>";
                  $cRet .="<tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"80%\" style=\"font-size:12px;\" align=\"center\" >
                            <tr>
                                <td align=\"center\" width=\"40%\">PIHAK KEDUA<br>
											 <b>$row->nama</b><br><br><br><br><br>
												<b><u>$row->pimpinan</u></b><br>$row->jabatan
                                    </td>
								<td align=\"center\" width=\"10%\" ></td>
								<td align=\"center\" width=\"50%\"><br>PIHAK PERTAMA<br>
											 <b>$row->nama_singkat</b><br><br><br><br><br>
												<b><u>$row->nama_pejabat</u></b><br>Pangkat : $row->pangkat_pejabat<br>Nip : $row->nip_pejabat
                                   </td>
                            </tr> 
                        </table>
        
                    </td>
                  </tr>
                        </table>
                    </td>
                  </tr>
                </table>";
        
         echo $cRet;
    }
		
		
	}
	}
	
public function lap_realisasi()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $konfig   = $this->ambil_config();
		$kota  	  = strtoupper($konfig['kota']);
        $thn  	  = $this->session->userdata('ta_simbakda');
        $cskpd    = $_REQUEST['kd_skpd'];
        $cnm_skpd = $_REQUEST['nm_skpd'];
        $lctahu   = $_REQUEST['tahu'];
        $lcbend   = $_REQUEST['bend'];
        $lctgl    = $_REQUEST['tgl'];
        
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
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
           
            <tr>
                <td colspan=\"2\"  align=\"left\" style=\"font-size:12px;\">&ensp;REALISASI BELANJA MODAL</td>
            </tr>
            <tr>
                <td colspan=\"2\" align=\"left\" style=\"font-size:12px;\">&ensp;TAHUN ANGGARAN $thn</td>
            </tr>
            <tr>
                <td colspan=\"2\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD: $cskpd - $cnm_skpd </td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">No</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Nama Kegiatan</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Nama PPTK</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Sumber Dana</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Nilai Anggaran</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Jenis Aset</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">HPS</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">No. Kontrak</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Nilai Kontrak</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Nama Rekanan</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Tgl. Nilai Kontrak</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Tgl. Selesai Kontrak</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Realisasi Keuangan</td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Berita acara Pemerikasaan Barang</td>
                <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">Berita Acara Serah Terima</td>
            </tr>
			<tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">No. SP2D</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">NOMOR</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">TANGGAL</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">NOMOR</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px\">TANGGAL</td>
			</tr>";
             
             $joss = "SELECT a.nm_kegiatan,d.nama_singkat,e.jumlah,b.uraian,
					harga_hps,b.harga,a.rekanan,c.tgl_spk,c.no_spk,
					c.tgl_sp,4,c.no_bapb1,c.tgl_bapb1,c.no_bast,c.tgl_bast FROM plh_form_isian a 
					INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi LEFT JOIN pl_lengkap c
					ON b.no_transaksi=c.no_transaksi LEFT JOIN mpejabat d ON d.kode=a.pptk LEFT JOIN rinci_rkaskpd e
					ON b.kode=e.koderek AND e.no=b.no AND e.organisasi=b.unit_skpd AND e.kodegiat=b.kodegiat";
                         
             $yeye = $this->db->query($joss);
             $i = 0;
             foreach ($yeye->result() as $row)
             {
			 $i++; 
               $cRet .="<tr>
                    <td align=\"center\" style=\"font-size:10px\">$i</td>
                    <td align=\"left\" style=\"font-size:10px\">$row->nm_kegiatan</td>
                    <td align=\"left\" style=\"font-size:10px\">$row->nama_singkat</td>
                    <td align=\"center\" style=\"font-size:10px\">APBD</td>
                    <td align=\"right\" style=\"font-size:10px\">".number_format($row->jumlah)."</td>
                    <td align=\"left\" style=\"font-size:10px\">$row->uraian</td>
                    <td align=\"right\" style=\"font-size:10px\">$row->harga_hps</td>
                    <td align=\"center\" style=\"font-size:10px\">$row->no_spk</td>
                    <td align=\"right\" style=\"font-size:10px\">".number_format($row->harga)."</td>
                    <td align=\"left\" style=\"font-size:10px\">$row->rekanan</td>
                    <td align=\"center\" style=\"font-size:10px\">$row->tgl_spk</td>
                    <td align=\"center\" style=\"font-size:10px\">$row->tgl_sp</td>
                    <td align=\"center\" style=\"font-size:10px\"></td>
                    <td align=\"center\" style=\"font-size:10px\">$row->no_bapb1</td>
                    <td align=\"center\" style=\"font-size:10px\">$row->tgl_bapb1</td>
                    <td align=\"center\" style=\"font-size:10px\">$row->no_bast</td>
                    <td align=\"center\" style=\"font-size:10px\">$row->tgl_bast</td>
                </tr>";
             }
            
            $cRet .="<tr>
                        <td height=\"60\" colspan =\"8\" align=\"center\" style=\"font-size:10px;border: solid 1px white;border-top:solid 1px black;\">&nbsp;</td>
                        </td>
                    </tr>                    
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:10px;border: solid 1px white;\">
                        Mengetahui,<br>$jbt_tahu<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_tahu )</u><br>NIP. $nip_tahu                        
                        </td><td align=\"center\" style=\"font-size:10px;border: solid 1px white;\"></td>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:10px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl).",<br>$jbt_bend<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_bend )</u><br>NIP. $nip_bend  
                        </td>
                    </tr>";
			$cRet .=" </table>";
			echo ($cRet);
       // $data['prev']= $cRet;
        //$this->template->set('title', '');        
        //$this->_mpdf('',$cRet,5,5,5,1);
         } 
	}
	
public function lap_realisasi_lain()
	{
	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $unit_skpd  	  = $this->session->userdata('unit_skpd');
        $konfig   = $this->ambil_config();
		$kota  	  = strtoupper($konfig['kota']);
        $thn  	  = $this->session->userdata('ta_simbakda');
        $cskpd    = $_REQUEST['kd_skpd'];
        $cnm_skpd = $_REQUEST['nm_skpd'];
        $lctahu   = $_REQUEST['tahu'];
        $lcbend   = $_REQUEST['bend'];
        $lctgl    = $_REQUEST['tgl'];
        
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
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
           
            <tr>
                <td colspan=\"2\"  align=\"left\" style=\"font-size:12px;\">&ensp;REALISASI BELANJA MODAL DAN LAINNYA</td>
            </tr>
            <tr>
                <td colspan=\"2\" align=\"left\" style=\"font-size:12px;\">&ensp;TAHUN ANGGARAN $thn</td>
            </tr>
            <tr>
                <td colspan=\"2\" align=\"left\" style=\"font-size:12px;\">&ensp;SKPD: $cskpd - $cnm_skpd </td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            </table>";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">No</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">NO. REK</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">URAIAN</td>
                <td COLSPAN=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">BERITA ACARA HASIL PENGADAAN</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">JUMALAH</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">HARGA SAT.</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">JUMLAH</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">HPS</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">PENAWARAN</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">NEGOISASI</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">SISA ANGGARAN</td>
                <td rowspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">REKANAN</td>
			</tr>
			<tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">TANGGAL</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px\">NOMOR</td>
			</tr>";
           	
		$csql1 = "SELECT distinct kegiatan,nm_kegiatan FROM plh_form_isian WHERE kd_uskpd ='$unit_skpd' ORDER BY no_transaksi";
        $hasil1 = $this->db->query($csql1);
        foreach ($hasil1->result_array() as $row)
          { 
		$kegiatan 			= $row['kegiatan']; 
		$nm_kegiatan 		= $row['nm_kegiatan']; 
		$cRet .=
		"<tr>
                <td align=\"left\" colspan=\"13\" style=\"font-size:12px\"><b>Kegiatan: $nm_kegiatan</b></td>
		</tr>";
			$csql2 = "SELECT no_transaksi FROM plh_form_isian where kegiatan='$kegiatan' ORDER BY no_transaksi";
            $hasil2 = $this->db->query($csql2);
			foreach ($hasil2->result_array() as $row1)
             {
				$no_transaksi 		= $row1['no_transaksi'];
				
				$csql3 = "SELECT b.uraian,b.kode,c.tgl_bahp,c.no_bahp,b.vol,b.satuan,b.harga,b.jumlah,b.harga_hps,b.harga_tawar,b.harga_akhir,a.rekanan 
				FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi
				LEFT JOIN pl_lengkap c ON a.no_transaksi=c.no_transaksi WHERE a.no_transaksi ='$no_transaksi' and a.kd_uskpd ='$unit_skpd' order by a.no_transaksi";
				$hasil3 = $this->db->query($csql3);
				$i=1; foreach ($hasil3->result_array() as $row2)
				{
				
					$uraian			= $row2['uraian'];
					$kode			= $row2['kode'];
					$tgl_bahp		= $row2['tgl_bahp'];
					$no_bahp		= $row2['no_bahp'];
					$vol			= $row2['vol'];
					$satuan			= $row2['satuan'];
					$harga			= $row2['harga'];
					$jumlah			= $row2['jumlah'];
					$harga_hps		= $row2['harga_hps'];
					$harga_tawar	= $row2['harga_tawar'];
					$harga_akhir	= $row2['harga_akhir'];
					$rekanan		= $row2['rekanan'];
						       
							   
				$cRet .=" <tr>
                    <td align=\"center\" style=\"font-size:10px\">$i</td>
                    <td align=\"center\" style=\"font-size:10px\">$kode	</td>
                    <td align=\"left\" style=\"font-size:10px\">$uraian	</td>
                    <td align=\"center\" style=\"font-size:10px\">$tgl_bahp </td>
                    <td align=\"center\" style=\"font-size:10px\">$no_bahp</td>
                    <td align=\"center\" style=\"font-size:10px\">$vol</td>
                    <td align=\"center\" style=\"font-size:10px\">$satuan</td>
                    <td align=\"right\" style=\"font-size:10px\">".number_format($harga)."</td>
                    <td align=\"center\" style=\"font-size:10px\">$jumlah</td>
                    <td align=\"right\" style=\"font-size:10px\">".number_format($harga_hps)."</td>
                    <td align=\"right\" style=\"font-size:10px\">".number_format($harga_tawar)."</td>
                    <td align=\"right\" style=\"font-size:10px\">".number_format($harga_akhir)."</td> 
                    <td align=\"left\" style=\"font-size:10px\">$rekanan</td>                                    
                </tr>";  $i++;
			 }
			}
          }
            $cRet .="
                    <tr>
                        <td height=\"60\" colspan =\"8\" align=\"center\" style=\"font-size:10px;border: solid 1px white;border-top:solid 1px black;\">&nbsp;</td>
                        </td>
                    </tr>                    
                    <tr>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:10px;border: solid 1px white;\">
                        Mengetahui,<br>$jbt_tahu<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_tahu )</u><br>NIP. $nip_tahu                        
                        </td><td align=\"center\" style=\"font-size:10px;border: solid 1px white;\"></td>
                        <td colspan =\"8\" align=\"center\" style=\"font-size:10px;border: solid 1px white;\">
                        $kota, ".$this->tanggal_indonesia($lctgl).",<br>$jbt_bend<br>&nbsp;<br>&nbsp;<br>
                        <u>( $nm_bend )</u><br>NIP. $nip_bend  
                        </td>
                    </tr>";
			$cRet .=" </table>";
			echo ($cRet);
       // $data['prev']= $cRet;
        //$this->template->set('title', '');        
        //$this->_mpdf('',$cRet,5,5,5,1);
	}}
	

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
	
	    function _mpdf($judul='',$isi='',$lMargin=10,$rMargin=10,$font=10,$orientasi='') {
        
        ini_set("memory_limit","-1");
        $this->load->library('mpdf');
        
        /*
        $this->mpdf->progbar_altHTML = '<html><body>
	                                    <div style="margin-top: 5em; text-align: center; font-family: Verdana; font-size: 12px;"><img style="vertical-align: middle" src="'.base_url().'images/loading.gif" /> Creating PDF file. Please wait...</div>';        
        $this->mpdf->StartProgressBarOutput();
        */
        
        $this->mpdf->defaultheaderfontsize = 6;	/* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 6;	/* in pts */
        $this->mpdf->defaultfooterfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 1; 
        //$this->mpdf->_setPageSize('','');
        //$this->mpdf->SetHeader('SIMAKDA||');
        //$jam = date("H:i:s");
        //$this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Simakda| Page {PAGENO} of {nb}');
        //$this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Halaman {PAGENO} / {nb}| ');
        
        $this->mpdf->AddPage($orientasi);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output();
               
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