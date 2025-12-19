<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
        
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
    
    function lap_menu()
    {
      if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'MENU LAPORAN';
        $this->template->set('title', 'MENU LAPORAN');   
        $this->template->load('index','laporan/lap_menu',$data) ;
        }   
    }
    
    
    function cetak_lap_rencana()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN RENCANA PENGADAAN BARANG';
        $this->template->set('title', 'CETAK LAPORAN RENCANA PENGADAAN BARANG');   
        $this->template->load('index','laporan/rencana_ada_brg',$data) ;
        } 
    }
	
	function cetak_lap_pengadaan_barang()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN RENCANA PENGADAAN BARANG';
        $this->template->set('title', 'CETAK LAPORAN RENCANA PENGADAAN BARANG');   
        $this->template->load('index','laporan/rencana_pengadaan',$data) ;
        } 
    }
    
    function cetak_lap_kib_a()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN KIB A';
        $this->template->set('title', 'CETAK LAPORAN KIB A');   
        $this->template->load('index','laporan/lap_kib_a',$data) ;
        } 
    }
    function cetak_lap_kib_b()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN KIB B';
        $this->template->set('title', 'CETAK LAPORAN KIB B');   
        $this->template->load('index','laporan/lap_kib_b',$data) ;
        } 
    }
    function cetak_lap_kib_c()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN KIB C';
        $this->template->set('title', 'CETAK LAPORAN KIB C');   
        $this->template->load('index','laporan/lap_kib_c',$data) ;
        } 
    }
    function cetak_lap_kib_d()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN KIB D';
        $this->template->set('title', 'CETAK LAPORAN KIB D');   
        $this->template->load('index','laporan/lap_kib_d',$data) ;
        } 
    }
    function cetak_lap_kib_e()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN KIB E';
        $this->template->set('title', 'CETAK LAPORAN KIB E');   
        $this->template->load('index','laporan/lap_kib_e',$data) ;
        } 
    }
    
    function cetak_lap_kib_f()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN KIB F';
        $this->template->set('title', 'CETAK LAPORAN KIB F');   
        $this->template->load('index','laporan/lap_kib_f',$data) ;
        } 
    }    
	
	function cetak_lap_kib_g()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN KIB G';
        $this->template->set('title', 'CETAK LAPORAN KIB G');   
        $this->template->load('index','laporan/lap_kib_g',$data) ;
        } 
    }
	
	 function cetak_lap_perjenis()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN PER JENIS KIB';
        $this->template->set('title', 'CETAK LAPORAN PER JENIS KIB');   
        $this->template->load('index','laporan/lap_kib_perjenis',$data) ;
        } 
    }
	 function cetak_tnh_bgn()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK SINGKRONISASI TANAH DAN BANGUNAN';
        $this->template->set('title', 'CETAK SINGKRONISASI TANAH DAN BANGUNAN');   
        $this->template->load('index','laporan/lap_kib_tnhbgn',$data) ;
        } 
    }
	
	function cetak_rekap_kib()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN REKAPITULASI KIB';
        $this->template->set('title', 'CETAK LAPORAN REKAPITULASI KIB');   
        $this->template->load('index','laporan/lap_rekap_kib',$data) ;
        } 
    }
	
	function cetak_rekap_inventaris()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN REKAPITULASI KIB';
        $this->template->set('title', 'CETAK LAPORAN REKAPITULASI KIB');   
        $this->template->load('index','laporan/lap_rekap_inventaris',$data) ;
        } 
    }
    
	function cetak_rekap_rkbu()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN REKAPITULASI RKBU';
        $this->template->set('title', 'CETAK LAPORAN REKAPITULASI RKBU');   
        $this->template->load('index','laporan/lap_rekap_rkbu',$data) ;
        } 
    }
	
    function cetak_penjelasan_aset()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN PENJELASAN ASET';
        $this->template->set('title', 'CETAK LAPORAN PENJELASAN ASET');   
        $this->template->load('index','laporan/penjelasan_aset',$data) ;
        } 
    }
	
	function cetak_rkpbu()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK DAFTAR RKPBU';
        $this->template->set('title', 'CETAK DAFTAR RKPBU');   
        $this->template->load('index','laporan/lap_rkpbu',$data) ;
        } 
    }
    
	function cetak_pb()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK BUKU PENERIMAAN BARANG';
        $this->template->set('title', 'CETAK BUKU PENERIMAAN BARANG');   
        $this->template->load('index','laporan/lap_pb',$data) ;
        } 
    }
	
	function cetak_pengeluaran_barang()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN PENGELUARAN BARANG';
        $this->template->set('title', 'CETAK LAPORAN PENGELUARAN BARANG');   
        $this->template->load('index','laporan/lap_pengeluaran_barang',$data);
        } 
    }
	
	function cetak_bbi()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN BUKU BARANG INVENTARIS';
        $this->template->set('title', 'CETAK LAPORAN BUKU BARANG INVENTARIS');   
        $this->template->load('index','laporan/lap_bbi',$data);
        } 
    }

	function cetak_kartu_barang()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN KARTU BARANG';
        $this->template->set('title', 'CETAK LAPORAN KARTU BARANG');   
        $this->template->load('index','laporan/lap_kb',$data);
        } 
    }
	    
	function cetak_lap_sbi()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN SEMENTARA BARANG INVENTARIS';
        $data['page_title']= 'CETAK LAPORAN SEMENTARA BARANG INVENTARIS';
        $this->template->set('title', 'CETAK LAPORAN SEMENTARA BARANG INVENTARIS');   
        $this->template->load('index','laporan/lap_sbi',$data);
        } 
    }
	
	function cetak_lap_sbph()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN SEMENTARA BARANG INVENTARIS';
        $data['page_title']= 'CETAK LAPORAN SEMENTARA BARANG INVENTARIS';
        $this->template->set('title', 'CETAK LAPORAN SEMENTARA BARANG INVENTARIS');   
        $this->template->load('index','laporan/lap_sbph',$data);
        } 
    }
	
	function cetak_kir()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK KARTU INVENTARIS RUANGAN';
        $data['page_title']= 'CETAK KARTU INVENTARIS RUANGAN';
        $this->template->set('title', 'CETAK KARTU INVENTARIS RUANGAN');   
        $this->template->load('index','laporan/lap_kir',$data);
        } 
    }
	
	function cetak_buku_inventaris()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK BUKU INVENTARIS';
        $data['page_title']= 'CETAK BUKU INVENTARIS';
        $this->template->set('title', 'CETAK BUKU INVENTARIS');   
        $this->template->load('index','laporan/lap_inventaris',$data);
        } 
    }
	
	function cetak_eca()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK ECA';
        $data['page_title']= 'CETAK ECA';
        $this->template->set('title', 'CETAK ECA');   
        $this->template->load('index','laporan/lap_eca',$data);
        } 
    }
		
	function cetak_eca_rekap()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK REKAP ECA';
        $data['page_title']= 'CETAK REKAP ECA';
        $this->template->set('title', 'CETAK REKAP ECA');   
        $this->template->load('index','laporan/lap_eca_rekap',$data);
        } 
    }
	
	function lap_aset_lainnya()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK ASET TETAP LAINNYA';
        $data['page_title']= 'CETAK ASET TETAP LAINNYA';
        $this->template->set('title', 'CETAK ASET TETAP LAINNYA');   
        $this->template->load('index','laporan/lap_aset_lainnya2',$data);
        } 
    }
	function lap_aset_lainnya_rekap()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK REKAP ASET TETAP LAINNYA';
        $data['page_title']= 'CETAK REKAP ASET TETAP LAINNYA';
        $this->template->set('title', 'CETAK ASET TETAP LAINNYA');   
        $this->template->load('index','laporan/lap_aset_lainnya2_rekap',$data);
        } 
    }
		function cetak_label()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LABEL';
        $data['page_title']= 'CETAK ALABEL';
        $this->template->set('title', 'CETAK ALABEL');   
        $this->template->load('index','laporan/lap_label',$data);
        } 
    }


    function cetak_buku_invent()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK BUKU INVENTARIS BARANG';
        $this->template->set('title', 'CETAK BUKU INVENTARIS BARANG');   
        $this->template->load('index','laporan/rekap_buku_invent',$data) ;
        } 
    }
	
	 function cetak_daftar_mutasi()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK REKAP MUTASI BARANG';
        $this->template->set('title', 'CETAK REKAP MUTASI BARANG');   
        $this->template->load('index','laporan/rekap_daftar_mutasi',$data) ;
        } 
    }
	
    function cetak_rekap_bi(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'REKAPITULASI BUKU INVENTARIS';
        $this->template->set('title', 'REKAPITULASI BUKU INVENTARIS');   
        $this->template->load('index','laporan/lap_buku_inventaris',$data) ;
        } 
    }	

    function cetak_lap_mutasi(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'LAPORAN MUTASI BARANG';
        $this->template->set('title', 'LAPORAN MUTASI BARANG');   
        $this->template->load('index','laporan/lap_mutasi',$data) ;
        } 
    }
	
	function cetak_mutasi_barang(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK DAFTAR MUTASI BARANG';
        $this->template->set('title', 'CETAK DAFTAR MUTASI BARANG');   
        $this->template->load('index','laporan/lap_mutasi_barang',$data) ;
        } 
    }
	
	function cetak_rkp_mutasi_barang(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
            $data['page_title']= 'CETAK REKAP MUTASI BARANG';
            $this->template->set('title', 'CETAK REKAP MUTASI BARANG');   
            $this->template->load('index','laporan/lap_rkp_mutasi_barang',$data) ;
        } 
    }

    function cetak_usulan_barang_hapus(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
            $data['page_title']= 'CETAK DAFTAR USULAN BARANG YANG AKAN DIHAPUS';
            $this->template->set('title', 'CETAK DAFTAR USULAN BARANG YANG AKAN DIHAPUS');   
            $this->template->load('index','laporan/lap_usulan_barang_hapus_dh',$data) ;
        } 
    }

    function cetak_daftar_barang_hapus(){
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
            $data['page_title']= 'CETAK DAFTAR BARANG YANG DIHAPUS';
            $this->template->set('title', 'CETAK DAFTAR BARANG YANG DIHAPUS');   
            $this->template->load('index','laporan/lap_daftar_barang_hapus_dh',$data) ;
        } 
    }

    function cetak_pemeliharaan_barang(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK KARTU PEMELIHARAAN BARANG';
        $this->template->set('title', 'CETAK KARTU PEMELIHARAAN BARANG');   
        $this->template->load('index','laporan/lap_pemeliharan_barang',$data) ;
        } 
    }
	
	function cetak_laporan_riwayat(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN RIWAYAT';
        $this->template->set('title', 'CETAK LAPORAN RIWAYAT');   
        $this->template->load('index','laporan/lap_riwayat',$data) ;
        } 
    }
	
	function ambil_halaman(){

        $csql = " select *,'1' as fa from config ";
        $query1 = $this->db->query($csql); 
		$fa=0;		
        foreach($query1->result_array() as $resulte)
        { 
            $resulte = array(  
			
						 'fa' => $resulte['fa'],
                         'nm_client' => $resulte['nm_client']                                                                      					
                         );
						 //$fa 
       $fa++; }
	   
       $query1->free_result(); 
	   return $resulte;        	
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
    
    
    function ctk_bap (){
        $konfig=$this->ambil_config();
		$nmkab=strtoupper($konfig['nm_client']);
        $logo = $konfig['logo'];
        
        $cskpd = $_REQUEST['nmunit'];
        $comp = $_REQUEST['comp'];
        
        $csql = "SELECT kd_uskpd, nm_uskpd FROM unit_skpd where upper(kd_uskpd) = '$cskpd'";
        $hsl = $this->db->query($csql);
        $hsl_skpd = $hsl->row();
        $cskpd = strtoupper($hsl_skpd->nm_uskpd);
        
        $csql = "select * from mcompany where kd_comp = '$comp'";
        $hslcom = $this->db->query($csql);
        $hsl_com = $hslcom->row();
        $lccomp = strtoupper($hsl_com->nm_comp);
        $almt_comp = $hsl_com->alamat; 
        
        $tgl_cetak = $_REQUEST['tgl_cetak'];
        $lctgl_cetak = strtolower($this->tanggal_indonesia2($tgl_cetak));
        
        
        $hari = $_REQUEST['hari'];
        $cpekerjaan = $_REQUEST['pekerjaan']; //"PENGURUGAN HUTAN";
        $lcgiat = $_REQUEST['kegiatan'];//"BANTUAN DARI PEMERINTAH PUSAT";
        $nama1 = $_REQUEST['pengawas1'];//'JUJUN JUNAEDI';
        $jabat1 = $_REQUEST['jabat1'];//'Ketua';    
        $nama2 = $_REQUEST['pengawas2'];//'BADRUN SUHERMAN';
        $jabat2 = $_REQUEST['jabat2'];//'Sekretaris';
        $nama3 = $_REQUEST['pengawas3'];//'JAJANG SODIKIN';
        $jabat3 = $_REQUEST['jabat3'];//'Anggota';
        $nama4 = $_REQUEST['pengawas4'];//'DIDIN SURIDIN';
        $jabat4 = $_REQUEST['jabat4'];//'Anggota';
        $nama5 = $_REQUEST['pengawas5'];//'SAMSON IRAWAN';
        $jabat5 = $_REQUEST['jabat5'];//'Anggota';
        $nama6 = $_REQUEST['pengawas6'];//'BURHAN SUPENDI';
        $jabat6 = $_REQUEST['jabat6'];//'Anggota';
        $nama7 = $_REQUEST['pengawas7'];//'IWAN NURJAMAN';
        $jabat7 = $_REQUEST['jabat7'];//'Anggota';
        $nokontrak  = $_REQUEST['kontrak'];//'13/SP-KONSUL/DISHUB/KPRPG/IJ/2012';
        $tgl_kontrak = $this->tanggal_indonesia($_REQUEST['tgl_kontrak']);//'24 Maret 2012';
        $noberita = $_REQUEST['no_bap'];//'12345';
        
        $cRet  = '';
        $cRet = "<table width=\"100%\" border=\"0\" >
                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\" align=\"center\">
                    <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:14px;border: solid 1px white\">
                            <b>$nmkab</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;border: solid 1px white\"><b>DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;border: solid 1px white\"><b>PANITIA PEMERIKSA PENGADAAN BARANG /JASA DAERAH</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:8px;border: solid 1px white;\">Jl Melabu Raya no 10
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" style=\"font-size:8px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" style=\"font-size:14px;\" align=\"center\">
                                <b><u>BERITA ACARA PEMERIKSAAN BARANG/JASA</u></b>
                                <br>NO:$noberita<br>&nbsp;
                            </td>
                        </tr>
                    </table>
                    </td>
                         
                        
                  </tr>
                  <tr>
                    <td colspan=\"2\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                        <tr>
                            <td align=\"justify\" >
                            Pada hari ini $hari tanggal $lctgl_cetak bertempat di kabupaten berdasarkan surat keputusan 
                            bupati $nmkab nomor 56 tahun 2011 tanggal 08 Agustus 2011 
                            yang bertanda tangan di bawah ini
                            </td>
                        </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                        <td colspan=\"2\" align=\"center\">
                            <table border=\"0\" width=\"80%\">";
                            for($i=1;$i<8;$i++){
                                $lcnama = 'nama'.$i;
                                $lcjabat = 'jabat'.$i;
                                if($i==1){
                              $cRet .="<tr>
                                        <td width=\"10%\" style=\"font-size:12px;\">Nama
                                        </td>
                                        <td width=\"1%\" style=\"font-size:12px;\">:$i.
                                        </td>
                                        <td width=\"35%\" style=\"font-size:12px;\">".$$lcnama."
                                        </td>
                                        <td width=\"8%\">&nbsp
                                        </td>
                                        <td width=\"10%\" style=\"font-size:12px;\">Jabatan
                                        </td>
                                        <td width=\"1%\">:
                                        </td>
                                        <td width=\"35%\" style=\"font-size:12px;\">".$$lcjabat."
                                        </td>
                                    </tr>";
                                    }else{
                                       $cRet .="  <tr>
                                            <td>
                                            </td>
                                            <td style=\"font-size:12px;\">&nbsp;$i.
                                            </td>
                                            <td style=\"font-size:12px;\">".$$lcnama."
                                            </td>
                                            <td>&nbsp
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                            </td>
                                            <td style=\"font-size:12px;\">".$$lcjabat."
                                            </td>
                                        </tr>";
                                    }
                                    
                            }
                               
                          $cRet .="  </table>
                        </td>
                    </tr>
                    <tr>
                    <td colspan=\"2\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                        <tr>
                            <td align=\"justify\" >
                            Masing-masing kerena jabatannya, dengan ini menyatakan, bahwa dengan sebenarnya telah melaksanakan 
                            pemerikasaan terhadap Barang/Jasa pada $cskpd atas pekerjaan $cpekerjaan dari Kegiatan $lcgiat
                            yang di pesan dari : 
                            </td>
                            </tr>
                        </table>
                               
                    </td>
                  </tr>
                  <tr>
                        <td colspan=\"2\" align=\"LEFT\">
                            <table border=\"0\" width=\"80%\">
                                <tr>
                                    <td width=\"45%\" style=\"font-size:12px;\">NAMA PERUSAHAAN</td>
                                    <td width=\"1%\" style=\"font-size:12px;\">:</td>
                                    <td width=\"54%\" style=\"font-size:12px;\">&nbsp $lccomp</td>
                                </tr>
                                <tr> 
                                    <td style=\"font-size:12px;\">ALAMAT PERUSAHAAN</td>
                                    <td style=\"font-size:12px;\">:</td>
                                    <td style=\"font-size:12px;\">&nbsp $almt_comp</td>
                                </tr>      
                            </table>
                        </td>
                    
                  </tr>
                  <tr>
                    <td colspan=\"2\">
                        <table border=\"0\" width=\"100%\">
                            <tr>
                                <td style=\"font-size:12px; text-align:justify\">
                                    Sebagai realisasi Surat Pesanan / Kontrak Nomor ".$nokontrak." ".$tgl_kontrak." dengan jumlah/jenis 
                                    barang sesuai daftar terlampir<br>
                                    <br>Hasil Pemeriksaan dinyatakan:<br>
                                    a.) Baik<br>
                                    b.) Kurang/tidak baik.<br>
                                    yang selanjutnya akan diserahkan oleh penyedia barang/jasa pada penyimpanan barang. Demikian secara 
                                    Berita Acara ini dibuat dalam rangkap 8 (delapan) untuk dipergunakan sebagaimana mestinya.
                                </td>
                            </tr>
                        </table>         
                    </td>
                  </tr>
                    
                </table>";
        
           
         
         echo $cRet;
         
        // $data['prev']= $cRet;    
//         $this->_mpdf('',$cRet,'10','10',12,'1');
        
    }
    
   
	
    function ctk_bap1 (){
        $total_baris = $_REQUEST['total_baris'];
   //faiz
        $konfig=$this->ambil_config();
		$nmkab=strtoupper($konfig['nm_client']);
        $logo = $konfig['logo'];
        
        $cskpd = $_REQUEST['nmunit'];
        $comp = $_REQUEST['comp'];
        //SELECT kd_lokasi, nm_lokasi FROM mlokasi WHERE UPPER(kd_lokasi)= '
        $csql = "SELECT kd_lokasi, nm_lokasi FROM mlokasi WHERE UPPER(nm_lokasi)= '$cskpd'";
        $hsl = $this->db->query($csql);
        /*$hsl_skpd = $hsl->row();
        $cskpd = strtoupper($hsl_skpd->nm_lokasi);*/
        foreach ($hsl->result() as $row) {
          $cskpd=$row->nm_lokasi;
        }
        
        $csql = "select * from mcompany where kd_comp = '$comp'";
        $hslcom = $this->db->query($csql);
        $hsl_com = $hslcom->row();
        $nm_perusahaan = strtoupper($hsl_com->nm_comp);//ini
        $almt_usaha = $hsl_com->alamat; //ini
        
        $tgl_cetak = $_REQUEST['tgl_cetak'];
        $lctgl_cetak = strtolower($this->tanggal_indonesia2($tgl_cetak));
        $tlg_bap = $this->tanggal_indonesia1($_REQUEST['tgl_bap']);
        
        $hari = $_REQUEST['hari'];
        $cpekerjaan = $_REQUEST['pekerjaan']; //"PENGURUGAN HUTAN";
        $lcgiat = $_REQUEST['kegiatan'];//"BANTUAN DARI PEMERINTAH PUSAT";
        $nama1 = $_REQUEST['pengawas1'];//'JUJUN JUNAEDI';
        $jabat1 = $_REQUEST['jabat1'];//'Ketua';    
        $nama2 = $_REQUEST['pengawas2'];//'BADRUN SUHERMAN';
        $jabat2 = $_REQUEST['jabat2'];//'Sekretaris';
        $nama3 = $_REQUEST['pengawas3'];//'JAJANG SODIKIN';
        $jabat3 = $_REQUEST['jabat3'];//'Anggota';
        $nama4 = $_REQUEST['pengawas4'];//'DIDIN SURIDIN';
        $jabat4 = $_REQUEST['jabat4'];//'Anggota';
        $nama5 = $_REQUEST['pengawas5'];//'SAMSON IRAWAN';
        $jabat5 = $_REQUEST['jabat5'];//'Anggota';
        $nama6 = $_REQUEST['pengawas6'];//'BURHAN SUPENDI';
        $jabat6 = $_REQUEST['jabat6'];//'Anggota';
        $nama7 = $_REQUEST['pengawas7'];//'IWAN NURJAMAN';
        $jabat7 = $_REQUEST['jabat7'];//'Anggota';
        $nokontrak  = $_REQUEST['kontrak'];//'13/SP-KONSUL/DISHUB/KPRPG/IJ/2012';
        $tgl_kontrak = $this->tanggal_indonesia($_REQUEST['tgl_kontrak']);//'24 Maret 2012';
        $noberita = $_REQUEST['no_bap'];//'12345';
        
     
        
        $cRet  = '';
        $cRet = "<table width=\"100%\" border=\"0\" >
                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:14px;border: solid 1px white\">
                            <b>PEMERINTAH KOTA MAKASSAR</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;border: solid 1px white\"><b>DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;border: solid 1px white\"><b>PANITIA PEMERIKSA PENGADAAN BARANG /JASA DAERAH</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:10px;border: solid 1px white;\">Jl Jendral Achmad Yani No.2 Makassar
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" style=\"font-size:8px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" style=\"font-size:14px;\" align=\"center\">
                                <b><u>LAMPIRAN BERITA ACARA PEMERIKSAAN BARANG/JASA</u></b>
                                <br>&nbsp;
                            </td>
                        </tr>
                    </table>
                    </td>
                         
                        
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                        <tr>
                            <td width=\"24%\" style=\"font-size:12px;\">NO BAP
                            </td>
                            <td width=\"1%\" style=\"font-size:12px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:12px;\">$noberita
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:12px;\">TANGGAL
                            </td>
                            <td width=\"1%\" style=\"font-size:12px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:12px;\">$tlg_bap
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:12px;\">NAMA PERSUSAHAAN
                            </td>
                            <td width=\"1%\" style=\"font-size:12px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:12px;\">$nm_perusahaan
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:12px;\">ALAMAT PERUSAHAAN 
                            </td>
                            <td width=\"1%\" style=\"font-size:12px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:12px;\">$almt_usaha
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:12px;\">SKPD
                            </td>
                            <td width=\"1%\" style=\"font-size:12px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:12px;\">$cskpd
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\">&nbsp;
                            <td>
                        </tr>
                        <tr>
                            <td colspan=\"3\">
                                <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                                    <tr>
                                        <td align=\"center\">NO</td>
                                        <td align=\"center\">NAMA BARANG</td>
                                        <td align=\"center\">VOLUME</td>
                                        <td align=\"center\">MEREK</td>
                                        <td align=\"center\">HARGA SATUAN </td>
                                        <td align=\"center\">TOTAL</td>
                                    </tr>
                                    ";
                                    
                             for($i=1;$i<$total_baris+1;$i++){
                                    $lcnm = $_REQUEST['nmbar'.$i];
                                    $lcvol = $_REQUEST['vol'.$i];
                                    $lnharga = $_REQUEST['harga'.$i];
                                    $lntot = $_REQUEST['total'.$i];
                             $cRet .="       
                                    <tr>
                                        <td align=\"center\">$i</td>
                                        <td>$lcnm</td>
                                        <td align=\"center\">$lcvol</td>
                                        <td></td>
                                        <td align=\"right\">$lnharga&nbsp;</td>
                                        <td align=\"right\">$lntot&nbsp;</td>
                                    </tr>";
                                    }
                                    
                              $cRet .="<tr>
                                        <td align=\"center\" colspan=\"5\">Total</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                            <tr>
                                <td width=\"30%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr>
                                            <td align=\"center\">Penyedia Barang/Jasa<br>
                                            $nm_perusahaan<br><br><br><br><br>
                                            DIREKTUR
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"30%\">
                                </td>
                                <td width=\"40%\">
                                    <table border=\"0\" width=\"80%\" style=\"font-size:12px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">
                                                PANITIA PEMERIKSA BARANG/JASA
                                            </td>
                                        </tr>";
                                        for($i=1;$i<8;$i++){
                                            $lcnama='nama'.$i;
                                            $cRet .="<tr>
                                                        <td>$i.
                                                        </td>
                                                        <td>Nama : ".$$lcnama."
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=\"2\">
                                                            &nbsp;<br><br>
                                                            TANDA TANGAN (............................)
                                                        </td>
                                                    </tr>";
                                        }
                                      $cRet .="  
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                  
                  
                    
                </table>";
        
           
         
         echo $cRet;
         
        // $data['prev']= $cRet;    
		//$this->_mpdf('',$cRet,'10','10',12,'1');
        
    }


    function lap_kib_a(){
          if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$konfig		= $this->ambil_config();
		$nmkab		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$lctahu 	= $_REQUEST['lctahu'];
		$lcbend 	= $_REQUEST['lcbend'];
		$cnmbend 	= $_REQUEST['cnmbend'];
		$cnmtahu 	= $_REQUEST['cnmtahu'];
		$ctahun		= $_REQUEST['tahun'];
		$ckondisi	= $_REQUEST['kondisi'];
		$pnilai		= $_REQUEST['pnilai'];
		$lctgl2 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$cini		= $_REQUEST['ini'];
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		}	
		$kon		= "";
        if($ckondisi<>''){
		$kon ="and a.kondisi='$ckondisi'";
		}
		$cmilik		= $_REQUEST['milik'];
		$mil		= "";
        if($cmilik<>''){
		$mil ="and a.milik='$cmilik'";
		}
          
		  $cRet = "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          if($iz=='4'){
		  $cRet .="
			<tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"5\" style=\"font-size:14px;  border: solid 1px white;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) A<br>TANAH</B></font></td>
		  <td width=\"20%\"></td></tr>";}else{
		  $cRet .="
			<tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px; \">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"5\" style=\"font-size:14px;  border: solid 1px white;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) A<br>TANAH</B></font></td>
		  <td width=\"20%\"></td></tr>";
		  }
           if ($cbid ==''){ 
          $cRet .="
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
            </tr>";} 
			else if ($cbid <>''){ 
          $cRet .="
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
            </tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnm_bid</B></td>
            </tr>";}
		  $cRet .="<tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
                    
             $cRet .="
            </table>
            
            <table style=\"border-collapse:collapse\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"left\" colspan=\"14\" style=\"font-size:12px;border: solid 1px white;border-bottom:solid 1px black;\">&ensp;</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">No</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Jenis Barang/<br>Nama Barang</td>
                <td align=\"center\" bgcolor=\"#FFD700\" colspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Luas(m2)</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Tahun</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Letak / Alamat</td>
                <td align=\"center\" bgcolor=\"#FFD700\" colspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Status Tanah</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Penggunaan</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Asal Usul</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Harga</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Kode Barang</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Register</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Hak</td>
                <td align=\"center\" bgcolor=\"#FFD700\" colspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Sertifikat</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\" bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"3%\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">12</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">13</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">14</td>
            </tr>
            </thead>";
			
	if($cbid=='' && $cini =='iz'){
		$csql = "SELECT DISTINCT a.kd_lokasi,a.nm_lokasi FROM mlokasi a LEFT JOIN trkib_a b
				 ON a.kd_lokasi=b.kd_unit WHERE b.kd_skpd='$cskpd' order by kd_lokasi";
		$hasil = $this->db->query($csql);
		$i		=1;
		$totalx	=0;
		$ntotal	=0;
		foreach ($hasil->result() as $fa){
			$kd_lokasi	= $fa->kd_lokasi;
			$nm_lokasi	= strtoupper($fa->nm_lokasi);
			//$kd_skpd	= $fa->kd_skpd;

				$cRet .="
                <tr>
                    <td bgcolor=\"#CCCCCC\" colspan=\"14\" align=\"left\" style=\"font-size:11px; font-family:tahoma;\"><b>$nm_lokasi</b></td>
                </tr>";	 
	
                    $csql = "SELECT b.nm_brg,a.kd_brg,a.no_reg,a.luas,a.tahun,a.alamat1,
							a.status_tanah,a.tgl_sertifikat,a.total as nil_baru,
							a.no_sertifikat,a.penggunaan,a.asal,a.nilai,sum(a.nilai) as total,a.keterangan FROM 
							trkib_a a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
							WHERE a.kd_unit='$kd_lokasi' $th $kon $mil 
							AND a.tgl_reg<='$sampai_tgl' 
							AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
							AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
							AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
							AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
							GROUP BY b.nm_brg,a.kd_brg,a.luas,a.tahun,a.alamat1,a.status_tanah,a.tgl_sertifikat,a.no_sertifikat,
							a.penggunaan,a.asal,a.nilai,a.keterangan 
							ORDER BY tahun,kd_brg,no_reg";
							 $hasil = $this->db->query($csql);
							 //$i = 0;
							 //$totalx=0;
							 foreach ($hasil->result() as $row)
							 {
								$totalx = $row->total+$totalx;
								$ntotal	= $row->nil_baru+$ntotal;
								if($iz=='2'){
								$cRet .="
								<tr>
									<td valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
									<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_brg</td>
									<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">'$row->no_reg</td>
									<td valign=\"top\" align=\"center\" width =\"3%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->luas)."</td>
									<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
									<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_sertifikat</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->no_sertifikat</td>
									<td valign=\"top\" align=\"left\" width =\"10%\" style=\"font-size:11px; font-family:tahoma;\">$row->penggunaan</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
								</tr>
								";}
								else{
								$cRet .="
								<tr>
									<td valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
									<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
									<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
									<td valign=\"top\" align=\"center\" width =\"3%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->luas)."</td>
									<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
									<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_sertifikat</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->no_sertifikat</td>
									<td valign=\"top\" align=\"left\" width =\"10%\" style=\"font-size:11px; font-family:tahoma;\">$row->penggunaan</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
								</tr>
								";}
								$i++;
						}
				} 
			}
			
				
	elseif($cbid=='' && $cini =='fa'){
		$csql = "SELECT b.nm_brg,a.kd_brg,a.no_reg,a.luas,a.tahun,a.alamat1,
		a.status_tanah,a.tgl_sertifikat,a.total as nil_baru,
		a.no_sertifikat,a.penggunaan,a.asal,a.nilai,sum(a.nilai) as total,a.keterangan FROM 
		trkib_a a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
		WHERE a.kd_skpd='$cskpd' $th $kon $mil 
		AND a.tgl_reg<='$sampai_tgl' 
		AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
		AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
		AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
		AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
		GROUP BY b.nm_brg,a.kd_brg,a.luas,a.tahun,a.alamat1,
		a.status_tanah,a.tgl_sertifikat,a.no_sertifikat,a.penggunaan,a.asal,a.nilai,a.keterangan 
		ORDER BY tahun,kd_brg,no_reg";
			 $hasil = $this->db->query($csql);
			 $i = 1;
			 $totalx=0;
			 $ntotal=0;
			 foreach ($hasil->result() as $row)
							 {
								$totalx = $row->total+$totalx;
								$ntotal	= $row->nil_baru+$ntotal;
								if($iz=='2'){
								$cRet .="
								<tr>
									<td valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
									<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_brg</td>
									<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">'$row->no_reg</td>
									<td valign=\"top\" align=\"center\" width =\"3%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->luas)."</td>
									<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
									<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_sertifikat</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->no_sertifikat</td>
									<td valign=\"top\" align=\"left\" width =\"10%\" style=\"font-size:11px; font-family:tahoma;\">$row->penggunaan</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
								</tr>
								";}
								else{
								$cRet .="
								<tr>
									<td valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
									<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
									<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
									<td valign=\"top\" align=\"center\" width =\"3%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->luas)."</td>
									<td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
									<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_sertifikat</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->no_sertifikat</td>
									<td valign=\"top\" align=\"left\" width =\"10%\" style=\"font-size:11px; font-family:tahoma;\">$row->penggunaan</td>
									<td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
								</tr>
								";}
								$i++;
				} 
			}
			
	elseif($cbid<>'') {
				            $csql = "SELECT b.nm_brg,a.kd_brg,
							a.no_reg,a.luas,a.tahun,a.alamat1,
							a.status_tanah,a.tgl_sertifikat,a.total as nil_baru,
							a.no_sertifikat,a.penggunaan,a.asal,a.nilai,sum(a.nilai) as total,a.keterangan FROM 
							trkib_a a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
							WHERE a.kd_unit= '$cbid' $th $kon $mil 
							AND a.tgl_reg<='$sampai_tgl' 
							AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
							AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
							AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
							AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
							GROUP BY b.nm_brg,a.kd_brg,a.luas,a.tahun,a.alamat1,
							a.status_tanah,a.tgl_sertifikat,
							a.no_sertifikat,a.penggunaan,a.asal,a.nilai,a.keterangan 
							ORDER BY tahun,kd_brg,no_reg";

             $hasil = $this->db->query($csql);
             $i = 0;
			 $totalx=0;
			 $ntotal=0;
             foreach ($hasil->result() as $row)
             {
				$totalx = $row->total+$totalx;
				$ntotal	= $row->nil_baru+$ntotal;
                $i++;
				if($iz=='2'){
                $cRet .="
                <tr>
                    <td valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_brg</td>
                    <td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">'$row->no_reg</td>
                    <td valign=\"top\" align=\"center\" width =\"3%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->luas)."</td>
                    <td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_sertifikat</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->no_sertifikat</td>
                    <td valign=\"top\" align=\"left\" width =\"10%\" style=\"font-size:11px; font-family:tahoma;\">$row->penggunaan</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>
				";}
				else{
                $cRet .="
                <tr>
                    <td valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
                    <td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
                    <td valign=\"top\" align=\"center\" width =\"3%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->luas)."</td>
                    <td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_sertifikat</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->no_sertifikat</td>
                    <td valign=\"top\" align=\"left\" width =\"10%\" style=\"font-size:11px; font-family:tahoma;\">$row->penggunaan</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>
				";}
            
			}
		}	
			if($pnilai=='1'){
			if($iz=='1'){
            $cRet .="
			<tr>
				<td colspan=\"12\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
				<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"right\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($totalx)."</td>
				<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
			elseif($iz<>'1'){
            $cRet .="
			<tr>
				<td colspan=\"12\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
				<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"right\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($totalx)."</td>
				<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}

			}else{
			if($iz=='1'){
            $cRet .="
			<tr>
				<td colspan=\"12\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
				<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"right\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
				<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
			elseif($iz<>'1'){
            $cRet .="
			<tr>
				<td colspan=\"12\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
				<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"right\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
				<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}

			}
			
			
			$cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
				<td><td>
				<td align=\"center\" colspan=\"7\" style=\"font-size:10px; font-family:tahoma;\"></td>
			</tr>
				<br/><br/>
			<tr>
				<td><td>
				<td colspan=\"5\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$kota, $lctgl2</td>
			</tr>
			<tr>
				<td><td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;MENGETAHUI</td>
				<td colspan=\"2\"></td>
				<td colspan=\"3\"></td>
			</tr>
				<Tr></Tr><Tr></Tr>
			<tr>
				<td><td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;KEPALA $cnm_bid</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">PENGURUS BARANG</td>			
			</tr>
			<tr>
				<td><td>
				<td align=\"center\" colspan=\"7\" style=\"font-size:11px; font-family:tahoma;\" height=\"50\"></td>
			</tr>
			<tr>
				<td><td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;(<u> $cnmtahu </u>)</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">(<u> $cnmbend </u>)</td>
			</tr>
			<tr>
				<td><td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;NIP. $lctahu</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;NIP. $lcbend</td>
			</tr>";
			
		$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan KIB A';
        $this->template->set('title', 'Laporan KIB A');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
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
    }
	
	function lap_kib_b(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		
        $halax	  = $this->ambil_halaman();
		$hala	  = $halax['fa'];
		
		$konfig		= $this->ambil_config();
		$nmkab		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$lctahu 	= $_REQUEST['lctahu'];
		$lcbend 	= $_REQUEST['lcbend'];
		$cnmbend 	= $_REQUEST['cnmbend'];
		$cnmtahu 	= $_REQUEST['cnmtahu'];
		$ctahun		= $_REQUEST['tahun'];
		$ckondisi	= $_REQUEST['kondisi'];
		$pnilai		= $_REQUEST['pnilai'];
		$lctgl2 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa']; 
		$jenis 		= $_REQUEST['jenis'];
		$nmjenis 	= $_REQUEST['nmjenis'];
		$cini	 	= $_REQUEST['ini'];
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		}	
		$kon		= "";
        if($ckondisi<>''){
		$kon ="and a.kondisi='$ckondisi'";
		}
		$cmilik		= $_REQUEST['milik'];
		$mil		= "";
        if($cmilik<>''){
		$mil ="and a.milik='$cmilik'";
		}
		
		if ($cbid==''){ 
        $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
                 if($iz=='4'){

		$cRet .="
            <tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"11\" style=\"font-size:14px;border: solid 1px white;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) B<br>PERALATAN DAN MESIN</B></font></td>
				<td width=\"20%\"></td>
			</tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
				 </tr>";}else{

		$cRet .="
            <tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"11\" style=\"font-size:14px;border: solid 1px white;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) B<br>PERALATAN DAN MESIN</B></font></td>
				<td width=\"20%\"></td>
			</tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
				 </tr>";
					 
				 }
			
			}
          
		else if ($cbid<>''){ 
        $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
        $cRet .="
            <tr>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;\"><B>KARTU INVENTARIS BARANG (KIB) B<br>PERALATAN DAN MESIN</B></td>
            </tr><BR/><BR/>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
            </tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnm_bid</B></td>
            </tr>";}
			
			$cRet .="<tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
			
            $cRet .="
            </table>
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">No</td>
				<td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Kode Barang</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Nama Barang</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">No. Register</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Merek/Tipe</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Ukuran/<br>CC</td>
				<td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Bahan</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Tahun</td>
                <td align=\"center\" bgcolor=\"#FFD700\" colspan=\"5\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Asal Usul<br>Perolehan</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Harga</td>
                <td align=\"center\" bgcolor=\"#FFD700\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Keterangan</td>
            </tr>
            
            <tr>
                <td align=\"center\" bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Pabrik</td>
                <td align=\"center\" bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Rangka</td>
                <td align=\"center\" bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Mesin</td>
                <td align=\"center\" bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Polisi</td>
                <td align=\"center\" bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">BPKB</td>
            </tr>
            
            <tr>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">6</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">12</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">13</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">14</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">15</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"13%\" style=\"font-size:10px; font-family:tahoma;\">16</td>
            </tr>
             </thead>";
            
if ($cbid == '' && $cini =='iz'){
 
$csql = "SELECT DISTINCT a.kd_lokasi,a.nm_lokasi FROM mlokasi a LEFT JOIN trkib_b b
				 ON a.kd_lokasi=b.kd_unit WHERE b.kd_skpd='$cskpd' order by kd_lokasi";
$hasil = $this->db->query($csql);
		$i=1;
		$totalx=0;
		$ntotal=0;
foreach ($hasil->result() as $fa){
	$kd_lokasi	= $fa->kd_lokasi;
	$nm_lokasi	= strtoupper($fa->nm_lokasi);
	$cRet .="
                <tr>
                    <td bgcolor=\"#CCCCCC\" colspan=\"16\" align=\"left\" style=\"font-size:11px; font-family:tahoma;\"><b>$nm_lokasi</b></td>
                </tr>";	
	
	$csql = "SELECT a.kd_unit,b.nm_brg,a.kd_brg,
			IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS reg,
			a.merek, a.silinder,a.tahun,a.kd_warna,a.total as nil_baru,
			a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai,sum(a.nilai) as total, a.keterangan FROM trkib_b a 
			INNER JOIN mbarang b ON a.kd_brg=b.kd_brg
			WHERE a.kd_unit='$kd_lokasi' $th $kon $mil and (a.nilai >=500000 OR a.kd_riwayat='9') and a.kd_brg like '$jenis%' 
			AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
			GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek,
			a.silinder,a.tahun,a.kd_warna,a.kd_bahan,a.asal,a.pabrik,a.no_rangka,
			a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai,a.keterangan 
			ORDER BY tahun,kd_brg,no_reg ";
		
		$hasil = $this->db->query($csql);
		foreach ($hasil->result() as $iza){
		
					$totalx 	= $iza->total+$totalx;
					$ntotal		= $iza->nil_baru+$ntotal;
					$total 		= $iza->total;
					$nil_baru	= $iza->nil_baru;
                    $kd_brg 	= $iza->kd_brg;
                    $nm_brg 	= $iza->nm_brg;
                    $reg 		= $iza->reg;
                    $merek 		= $iza->merek;
                    $silinder 	= $iza->silinder;
                    $kd_bahan	= $iza->kd_bahan;
                    $tahun 		= $iza->tahun;
                    $pabrik 	= $iza->pabrik;
                    $no_rangka 	= $iza->no_rangka;
                    $no_mesin 	= $iza->no_mesin;
                    $no_polisi 	= $iza->no_polisi;
                    $no_bpkb 	= $iza->no_bpkb;
                    $asal 		= $iza->asal;
                    $nilai 		= $iza->nilai;
                    $keterangan = $iza->keterangan;
	
			if($iz=='2'){
			$cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$merek</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$silinder</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$pabrik</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_rangka</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_mesin</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_polisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_bpkb</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$keterangan</td>
                </tr>";}
			else{
			$cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$merek</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$silinder</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$pabrik</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_rangka</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_mesin</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_polisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_bpkb</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$keterangan</td>
                </tr>";}
			$i++;
		}	
}
}

elseif ($cbid == '' && $cini =='fa'){

	$csql = "SELECT a.kd_unit,b.nm_brg,a.kd_brg,
			IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS reg,
			a.merek, a.silinder,a.tahun,a.kd_warna,a.total as nil_baru,
			a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai,sum(a.nilai) as total, a.keterangan FROM trkib_b a 
			INNER JOIN mbarang b ON a.kd_brg=b.kd_brg
			WHERE a.kd_skpd='$cskpd' $th $kon $mil and a.kd_brg like '$jenis%' and (a.nilai >=500000 OR a.kd_riwayat='9') 
			AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
			GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek, a.silinder,a.tahun,a.kd_warna,
			a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai,a.keterangan
			ORDER BY tahun,kd_brg,no_reg";// a.no_urut,
		$totalx=0;
		$ntotal=0;
			$i=1;
		$hasil = $this->db->query($csql);
		foreach ($hasil->result() as $iza){
		
					$totalx 	= $iza->total+$totalx;
					$ntotal		= $iza->nil_baru+$ntotal;
					$total 		= $iza->total;
					$nil_baru	= $iza->nil_baru;
                    $kd_brg 	= $iza->kd_brg;
                    $nm_brg 	= $iza->nm_brg;
                    $reg 		= $iza->reg;
                    $merek 		= $iza->merek;
                    $silinder 	= $iza->silinder;
                    $kd_bahan	= $iza->kd_bahan;
                    $tahun 		= $iza->tahun;
                    $pabrik 	= $iza->pabrik;
                    $no_rangka 	= $iza->no_rangka;
                    $no_mesin 	= $iza->no_mesin;
                    $no_polisi 	= $iza->no_polisi;
                    $no_bpkb 	= $iza->no_bpkb;
                    $asal 		= $iza->asal;
                    $nilai 		= $iza->nilai;
                    $keterangan = $iza->keterangan;
	
			if($iz=='2'){
			$cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$merek</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$silinder</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$pabrik</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_rangka</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_mesin</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_polisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_bpkb</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$keterangan</td>
                </tr>";}
			else{
			$cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$merek</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$silinder</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$pabrik</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_rangka</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_mesin</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_polisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_bpkb</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$keterangan</td>
                </tr>";}
$i++;
		}	
}
/*
$csql = "SELECT * FROM(
SELECT a.kd_unit,'2' AS tipe,b.nm_brg,CONCAT(SUBSTRING(a.kd_brg,1,2),'.',SUBSTRING(a.kd_brg,3,2),'.',SUBSTRING(a.kd_brg,5,2),'.',SUBSTRING(a.kd_brg,7,2),'.',SUBSTRING(a.kd_brg,9,10))AS kd_brg,
IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS reg,
a.merek, a.silinder,a.tahun,a.kd_warna,
a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,(SELECT COUNT(a.nilai)*a.nilai)AS nilai,a.keterangan FROM trkib_b a 
INNER JOIN mbarang b ON a.kd_brg=b.kd_brg
WHERE a.kd_skpd='$cskpd' and kondisi<>'RB' and a.kd_brg like '$jenis%' GROUP BY a.no_urut,a.nilai,a.kd_brg,kd_unit

UNION

SELECT kd_lokasi AS kd_unit,'1' AS tipe,nm_lokasi AS nm_brg,'' AS kd_brg,'' AS reg,
'' AS merek,'' AS silinder,'' AS tahun,'' AS kd_warna,
'' AS kd_bahan,'' AS asal,'' AS pabrik,'' AS no_rangka,
'' AS no_mesin,'' AS no_polisi,'' AS no_bpkb,
'' AS nilai,'' AS keterangan
FROM mlokasi WHERE kd_skpd='$cskpd') a ORDER BY kd_unit,tipe,a.kd_brg,a.tahun,reg";}
*/

	else if ($cbid <> ''){
	$csql = " SELECT a.kd_unit,b.nm_brg,a.kd_brg,
	IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS reg,
	a.merek, a.silinder,a.tahun,a.kd_warna,a.total as nil_baru,
	a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai,sum(a.nilai)as total,a.keterangan FROM trkib_b a 
	INNER JOIN mbarang b ON a.kd_brg=b.kd_brg
	WHERE a.kd_unit='$cbid' $th $kon $mil and a.kd_brg like '$jenis%' and (a.nilai >=500000 OR a.kd_riwayat='9') AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
			GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek, a.silinder,a.tahun,a.kd_warna,
			a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai,a.keterangan 
			ORDER BY tahun,kd_brg,no_reg";
		$hasil = $this->db->query($csql);
		$i = 1;
		$totalx=0;
		$ntotal=0;
		foreach ($hasil->result() as $iza){
		
					$totalx 	= $iza->total+$totalx;
					$ntotal		= $iza->nil_baru+$ntotal;
					$total 		= $iza->total;
					$nil_baru	= $iza->nil_baru;
                    $kd_brg 	= $iza->kd_brg;
                    $nm_brg 	= $iza->nm_brg;
                    $reg 		= $iza->reg;
                    $merek 		= $iza->merek;
                    $silinder 	= $iza->silinder;
                    $kd_bahan	= $iza->kd_bahan;
                    $tahun 		= $iza->tahun;
                    $pabrik 	= $iza->pabrik;
                    $no_rangka 	= $iza->no_rangka;
                    $no_mesin 	= $iza->no_mesin;
                    $no_polisi 	= $iza->no_polisi;
                    $no_bpkb 	= $iza->no_bpkb;
                    $asal 		= $iza->asal;
                    $nilai 		= $iza->nilai;
                    $keterangan = $iza->keterangan;

			
			if($iz=='2'){
				$cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$merek</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$silinder</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$pabrik</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_rangka</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_mesin</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_polisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_bpkb</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$keterangan</td>
                </tr>";}else{
				$cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$merek</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$silinder</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$pabrik</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_rangka</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_mesin</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_polisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_bpkb</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$keterangan</td>
                </tr>";}
$i++;

 }}
 if($pnilai=='1'){
			if($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($totalx)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
		elseif($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($totalx)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
			

}else{

			if($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
		elseif($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
			
}
 
			$cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"15\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
				<br/><br/>
			<tr>
				<td colspan=\"2\"></td>
				<td colspan=\"5\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$kota, $lctgl2</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;MENGETAHUI</td>
				<td colspan=\"2\"></td>
				<td colspan=\"3\"></td>
			</tr>
				<Tr></Tr><Tr></Tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;KEPALA $cnm_bid</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">PENGURUS BARANG</td>			
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"7\" style=\"font-size:11px; font-family:tahoma;\" height=\"50\"></td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;(<u> $cnmtahu </u>)</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">(<u> $cnmbend </u>)</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;NIP. $lctahu</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;NIP. $lcbend</td>
			</tr>";
			
		$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan KIB B';
        $this->template->set('title', 'Laporan KIB B');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
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
    }
    
    function lap_kib_c(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$konfig		= $this->ambil_config();
		$nmkab		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$lctahu 	= $_REQUEST['lctahu'];
		$lcbend 	= $_REQUEST['lcbend'];
		$cnmbend 	= $_REQUEST['cnmbend'];
		$cnmtahu 	= $_REQUEST['cnmtahu'];
		$ctahun		= $_REQUEST['tahun'];
		$ckondisi	= $_REQUEST['kondisi'];
		$pnilai		= $_REQUEST['pnilai'];
		$lctgl2 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$jenis 		= $_REQUEST['jenis'];
		$nmjenis 	= $_REQUEST['nmjenis'];
		$cini	 	= $_REQUEST['ini'];
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		}	
		$kon		= "";
        if($ckondisi<>''){
		$kon ="and a.kondisi='$ckondisi'";
		}
		$cmilik		= $_REQUEST['milik'];
		$mil		= "";
        if($cmilik<>''){
		$mil ="and a.milik='$cmilik'";
		}
         
		if ($cbid==''){ 
				                 if($iz=='4'){
        $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
            <tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"12\" style=\"font-size:14px;border: solid 1px white;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) C<br>GEDUNG DAN BANGUNAN</B></font></td>
				<td width=\"20%\">
			</tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
								 </tr>";}else{
									  $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
            <tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"12\" style=\"font-size:14px;border: solid 1px white;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) C<br>GEDUNG DAN BANGUNAN</B></font></td>
				<td width=\"20%\">
			</tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
								 </tr>";
								 }
			
			}
			
		if ($cbid<>''){ 
        $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"17\" style=\"font-size:14px;border: solid 1px white;\"><B>KARTU INVENTARIS BARANG (KIB) C<br>GEDUNG DAN BANGUNAN<br></B></td>
            </tr><BR/><BR/>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
            </tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnm_bid</B></td>
            </tr>";}
			 $cRet .="<tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
			
            $cRet .="
            </table>
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">No</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Jenis Barang<br>Nama Barang</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Kondisi<br/>(B,KB,RB)</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Konstruksi Gedung/<br>Bangunan</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Luas/<br>Lantai<br>(m2)</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Letak/Lokasi<br>Alamat</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Dokumen Gedung</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Luas<br>(m2)</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Status<br>Tanah</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nomor Kode<br>Tanah</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Asal Usul</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Harga</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Kode Barang</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Register</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Bertingkat/<br>Tidak</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Beton/<br>Tidak</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
            </tr>            
            <tr>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td bgcolor=\"#a2c8fb\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">12</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">13</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">14</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">15</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">16</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">17</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"3%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"16%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>";
			
	if ($cbid =='' && $cini =='iz'){ 
		$csql ="SELECT DISTINCT a.kd_lokasi,a.nm_lokasi FROM mlokasi a LEFT JOIN trkib_c b
				 ON a.kd_lokasi=b.kd_unit WHERE b.kd_skpd='$cskpd' order by kd_lokasi";
		$hasil = $this->db->query($csql);
        $i 		= 1;
		$totalx	= 0;  
		$ntotal =0;
	foreach($hasil->result() as $fa){
		 $kd_lokasi	= $fa->kd_lokasi;
		 $nm_lokasi	= strtoupper($fa->nm_lokasi);
			
			$cRet .="<tr><td bgcolor=\"#CCCCCC\" colspan=\"17\" align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$nm_lokasi</td></tr>";
			
			$csql = "SELECT a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.total as nil_baru,
			IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,a.kondisi,a.konstruksi,a.jenis_gedung,
			a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,
			sum(a.nilai) as total,a.nilai,a.keterangan 
			FROM trkib_c a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_unit='$kd_lokasi' $th $kon $mil 
			and a.kd_brg like '$jenis%' and (a.nilai >=10000000 OR a.kd_riwayat='9')
			AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
			GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
			a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai,a.keterangan 
			ORDER BY tahun,kd_brg,no_reg";
					
             $hasil = $this->db->query($csql);
           foreach ($hasil->result() as $row){
			 $totalx 	= $row->total+$totalx;
			 $ntotal	= $row->nil_baru+$ntotal;
			 $total 	= $row->total;
			 $nil_baru 	= $row->nil_baru;
			 $nm_brg	= $row->nm_brg;
			 $kd_brg	= $row->kd_brg;
			 $no_reg	= $row->no_reg;
			 $kondisi	= $row->kondisi;
			 $konstruksi= $row->konstruksi;
			 $jenis_gedung= $row->jenis_gedung;
			 $luas_lantai= $row->luas_lantai;
			 $alamat1	= $row->alamat1;
			 $tgl_dok	= $row->tahun;
			 $no_dok	= $row->no_dok;
			 $luas_tanah= $row->luas_tanah;
			 $status_tanah= $row->status_tanah;
			 $kd_tanah	= $row->kd_tanah;
			 $asal	= $row->asal;
			 $nilai	= $row->nilai;
			 $keterangan	= $row->keterangan;
			 
			if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$konstruksi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$jenis_gedung</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$luas_lantai</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$alamat1</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$tgl_dok</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_dok</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$luas_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$kd_tanah</td> 
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$keterangan</td>
                </tr>";}else{
			$cRet .="<tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$konstruksi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$jenis_gedung</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$luas_lantai</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$alamat1</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$tgl_dok</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$no_dok</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$luas_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$kd_tanah</td> 
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$keterangan</td>
                </tr>";
			}
                $i++;
				}
			}
		}elseif ($cbid == '' && $cini=='fa'){ 
				$csql = "SELECT a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.total as nil_baru,
				IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,a.kondisi,a.konstruksi,a.jenis_gedung,
				a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,
				sum(a.nilai) as total,a.nilai,a.keterangan 
				FROM trkib_c a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' $th $kon $mil and a.kd_brg like '$jenis%'
				and (a.nilai >=10000000 OR a.kd_riwayat='9') AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
				GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
			a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai,a.keterangan
			ORDER BY tahun,kd_brg,no_reg";
					
             $hasil = $this->db->query($csql);
             $i = 1;
			 $totalx=0;
			 $ntotal=0;
             foreach ($hasil->result() as $row)
             {
			 $totalx 	= $row->total+$totalx;
			$ntotal		= $row->nil_baru+$ntotal;
            
			if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis_gedung</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->luas_lantai</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_dok</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->luas_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_tanah</td> 
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}else{
			$cRet .="<tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis_gedung</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->luas_lantai</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_dok</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->luas_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_tanah</td> 
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";
			}
                $i++;
				}
 		}elseif ($cbid <> ''){ 
					$csql = "SELECT a.kd_unit,'1' AS tipe,b.nm_brg,a.kd_brg,a.tahun,a.total as nil_baru,
					IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,a.kondisi,a.konstruksi,a.jenis_gedung,
					a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,
					sum(a.nilai) as total,a.nilai,a.keterangan 
					FROM trkib_c a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_unit='$cbid' $th $kon $mil 
					 and a.kd_brg like '$jenis%' and (a.nilai >=10000000 OR a.kd_riwayat='9') AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
					GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
			a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai,a.keterangan
			ORDER BY tahun,kd_brg,no_reg";
             $hasil = $this->db->query($csql);
             $i 		= 1;
			 $totalx	= 0;
			 $ntotal	= 0;
             foreach ($hasil->result() as $row){
			 $totalx 	= $row->total+$totalx;
			 $ntotal	= $row->nil_baru+$ntotal;
			 
			if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis_gedung</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->luas_lantai</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_dok</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->luas_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_tanah</td> 
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}else{
			$cRet .="<tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis_gedung</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->luas_lantai</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_dok</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->luas_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_tanah</td> 
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";
			}
				$i++;
				}
			 }
			 
			 if($pnilai=='1'){
			if ($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"15\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"right\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($totalx)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
				elseif ($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"15\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"right\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($totalx)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}

}else{
			if ($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"15\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"right\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
				elseif ($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"15\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"right\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}

}
			$cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"16\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
				<br/><br/>
			<tr>
				<td colspan=\"2\"></td>
				<td colspan=\"5\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$kota, $lctgl2</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;MENGETAHUI</td>
				<td colspan=\"2\"></td>
				<td colspan=\"3\"></td>
			</tr>
				<Tr></Tr><Tr></Tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;KEPALA $cnm_bid</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">PENGURUS BARANG</td>			
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"7\" style=\"font-size:11px; font-family:tahoma;\" height=\"50\"></td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;(<u> $cnmtahu </u>)</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">(<u> $cnmbend </u>)</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;NIP. $lctahu</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;NIP. $lcbend</td>
			</tr>";
			
		$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan KIB C';
        $this->template->set('title', 'Laporan KIB C');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
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
    }
    
    function lap_kib_d(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$konfig		= $this->ambil_config();
		$nmkab		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$lctahu 	= $_REQUEST['lctahu'];
		$lcbend 	= $_REQUEST['lcbend'];
		$cnmbend 	= $_REQUEST['cnmbend'];
		$cnmtahu 	= $_REQUEST['cnmtahu'];
		$ctahun		= $_REQUEST['tahun'];
		$ckondisi	= $_REQUEST['kondisi'];
		$pnilai		= $_REQUEST['pnilai'];
		$lctgl2 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$jenis 		= $_REQUEST['jenis'];
		$nmjenis 	= $_REQUEST['nmjenis'];
		$cini		= $_REQUEST['ini'];
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		}	
		$kon		= "";
        if($ckondisi<>''){
		$kon ="and a.kondisi='$ckondisi'";
		}
		$cmilik		= $_REQUEST['milik'];
		$mil		= "";
        if($cmilik<>''){
		$mil ="and a.milik='$cmilik'";
		}
		
         if ($cbid==''){
				                 if($iz=='4'){
		  $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
				<td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"11\" style=\"font-size:14px;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) D<br>JALAN, JEMBATAN, IRIGASI DAN JARINGAN</B></font></td>
				<td width=\"20%\"></td>
			</tr>
			
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
								 </tr>";}else{
		  $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
				<td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\"width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"11\" style=\"font-size:14px;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) D<br>JALAN, JEMBATAN, IRIGASI DAN JARINGAN</B></font></td>
				<td width=\"20%\"></td>
			</tr>
			
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
								 </tr>";
									 
								 }
		 }else if($cbid<>''){
        $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
				<td></td>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;\"><B>KARTU INVENTARIS BARANG (KIB) D<br>JALAN, JEMBATAN, IRIGASI DAN JARINGAN<br></B></td>
            </tr><BR/><BR/>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
            </tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnm_bid</B></td>
            </tr>";}
			 $cRet .="<tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
			
            $cRet .="
            
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            
            <tr>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">No</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Jenis Barang/<br>Nama Barang</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Konstruksi</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Panjang<br>(Km)</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Lebar<br>(M)</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Luas<br>(m2)</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Letak/<br>Lokasi</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Dokumen</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Status<br>Tanah</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nomor Kode<br>Tanah</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Asal Usul</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Harga</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Kode Barang</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Register</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">12</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">13</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">14</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">15</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">16</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"17\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>";
			
	if ($cbid == '' && $cini =='iz'){
	$csqlx = "SELECT DISTINCT a.kd_lokasi,a.nm_lokasi FROM mlokasi a LEFT JOIN trkib_d b
			 ON a.kd_lokasi=b.kd_unit WHERE b.kd_skpd='$cskpd' order by kd_lokasi";
	$hasilx = $this->db->query($csqlx);
	$i=1;
	$nilaix=0;
	$ntotal=0;
	foreach ($hasilx->result() as $fa){
		$kd_lokasi	= $fa->kd_lokasi;
		$nm_lokasi	= strtoupper($fa->nm_lokasi);
		$cRet .="
		<tr>
			<td bgcolor=\"#CCCCCC\" colspan=\"16\" align=\"left\" style=\"font-size:11px; font-family:tahoma;\"><b>$nm_lokasi</b></td>
		</tr>";	
	
             $csql ="SELECT a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.total as nil_baru,
					IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,a.konstruksi,a.panjang,a.lebar,a.luas,a.alamat1,
					a.tgl_dok,a.kd_tanah,a.no_dok,a.status_tanah,a.asal,sum(a.nilai) as total,a.nilai,a.kondisi,a.keterangan FROM trkib_d a 
					INNER JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_unit='$kd_lokasi' $th $kon $mil and a.kd_brg like '$jenis%' 
					and (a.nilai >=10000000 OR a.kd_riwayat='9') AND a.kondisi<>'RB'
					AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
					AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
					AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
					AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
					AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
					GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,
					a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan 
					ORDER BY tahun,kd_brg,no_reg";
			$hasil = $this->db->query($csql);
			$i=1;
			foreach ($hasil->result() as $row)
             {
			 $nilaix 	= $row->total+$nilaix;
			 $ntotal	= $row->nil_baru+$ntotal;
			 
			if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->panjang</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->lebar</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_dok</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}
			else{
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->panjang</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->lebar</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_dok</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";
				}
              $i++;
			}		
		}			
	}
	elseif ($cbid == '' && $cini =='fa'){
             $csql ="SELECT a.kd_unit,b.nm_brg,a.tahun,a.kd_brg,a.total as nil_baru,
					IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,a.konstruksi,a.panjang,a.lebar,a.luas,a.alamat1,
					a.tgl_dok,a.kd_tanah,a.no_dok,a.status_tanah,a.asal,sum(a.nilai) as total,a.nilai,a.kondisi,a.keterangan FROM trkib_d a 
					INNER JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' $th $kon $mil 
					 and a.kd_brg like '$jenis%' and (a.nilai >=10000000 OR a.kd_riwayat='9') AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
					GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,
					a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan 
					ORDER BY tahun,kd_brg,no_reg";
			$hasil = $this->db->query($csql);
			$nilaix = 0;
			$ntotal =0;
			$i		= 1;
			foreach ($hasil->result() as $row)
             {
			 $nilaix 	= $row->total+$nilaix;
			 $ntotal	= $row->nil_baru+$ntotal;
			if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->panjang</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->lebar</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_dok</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}else{
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->panjang</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->lebar</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_dok</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";
				}
              $i++;
		}			
	}
			
	elseif ($cbid <> ''){
	 $csql = "SELECT a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.total as nil_baru,
			IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,a.konstruksi,a.panjang,a.lebar,a.luas,a.alamat1,
			a.tgl_dok,a.kd_tanah,a.no_dok,a.status_tanah,a.asal,sum(a.nilai) as total,a.nilai,a.kondisi,a.keterangan FROM trkib_d a 
			INNER JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE a.kd_unit='$cbid' $th $kon $mil 
			 and a.kd_brg like '$jenis%' and (a.nilai >=10000000 OR a.kd_riwayat='9') AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
			GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan 
					ORDER BY tahun,kd_brg,no_reg";
                   
            $hasil = $this->db->query($csql);
             $i = 1;
			 $nilaix=0;
			 $ntotal=0;
             foreach ($hasil->result() as $row)
             {
			 $nilaix 	= $row->total+$nilaix;
			 $ntotal	= $row->nil_baru+$ntotal;
				if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->panjang</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->lebar</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_dok</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";
				}else{
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->panjang</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->lebar</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->no_dok</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";
				}
				$i++;
            }}
			if($pnilai=='1'){
			if($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($nilaix)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
			elseif($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($nilaix)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}

}else{
			if($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
			elseif($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}

}
			
			$cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"7\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
				<br/><br/>
			<tr>
				<td colspan=\"2\"></td>
				<td colspan=\"5\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$kota, $lctgl2</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;MENGETAHUI</td>
				<td colspan=\"2\"></td>
				<td colspan=\"3\"></td>
			</tr>
				<Tr></Tr><Tr></Tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;KEPALA $cnm_bid</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">PENGURUS BARANG</td>			
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"7\" style=\"font-size:11px; font-family:tahoma;\" height=\"50\"></td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;(<u> $cnmtahu </u>)</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">(<u> $cnmbend </u>)</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;NIP. $lctahu</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;NIP. $lcbend</td>
			</tr>";
			
		$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas ='LEGAL';   
        $judul  = 'Laporan KIB D';
        $this->template->set('title', 'Laporan KIB D');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
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
    }
    
    
	 function lap_kib_e(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$konfig		= $this->ambil_config();
		$nmkab		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$lctahu 	= $_REQUEST['lctahu'];
		$lcbend 	= $_REQUEST['lcbend'];
		$cnmbend 	= $_REQUEST['cnmbend'];
		$cnmtahu 	= $_REQUEST['cnmtahu'];
		$ctahun		= $_REQUEST['tahun'];
		$ckondisi	= $_REQUEST['kondisi'];
		$pnilai		= $_REQUEST['pnilai'];
		$lctgl2 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$jenis 		= $_REQUEST['jenis'];
		$nmjenis 	= $_REQUEST['nmjenis'];
		$cini 		= $_REQUEST['ini'];
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		}	
		$kon		= "";
        if($ckondisi<>''){
		$kon ="and a.kondisi='$ckondisi'";
		}
		$cmilik		= $_REQUEST['milik'];
		$mil		= "";
        if($cmilik<>''){
		$mil ="and a.milik='$cmilik'";
		}
         
		if ($cbid==''){ 
				                 if($iz=='4'){
         $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"11\" style=\"font-size:14px;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) E<br>ASET TETAP LAINNYA</B></font></td>
				<td width=\"20%\"></td>
			</tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
								 </tr>";}else{ $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"11\" style=\"font-size:14px;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) E<br>ASET TETAP LAINNYA</B></font></td>
				<td width=\"20%\"></td>
			</tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
								 </tr>";
									 
								 }
			
			}
         
		 if ($cbid<>''){ 
         $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;\"><B>KARTU INVENTARIS BARANG (KIB) E<br>ASET TETAP LAINNYA<br></B></td>
            </tr><BR/><BR/><BR/>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
            </tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnm_bid</B></td>
            </tr>";}
			$cRet .="<tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
			
            $cRet .="
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">No</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nama Barang</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Buku/Perpustakaan</td>
                <td colspan=\"3\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Barang Bercorak Kesenian/Kebudayaan</td>
				<td colspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Hewan/Ternak dan Tumbuhan</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Tahun Pembelian</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Asal Usul<br>Perolehan</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Harga</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Kode Barang</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Register</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Judul/Pencipta</td>
                <!--td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Tahun</td-->
                <!--td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Penerbit</td-->
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Spesifikasi</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Asal Daerah</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Pencipta</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Bahan</td>
				<td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Jenis</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Ukuran</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td-->
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td-->
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">12</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">13</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">14</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">15</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">16</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">17</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">18</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"20%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <!--td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <!--td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"17%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>";
			
	if ($cbid == '' && $cini=='iz'){ 
	$csql = "SELECT DISTINCT a.kd_lokasi,a.nm_lokasi FROM mlokasi a LEFT JOIN trkib_e b
				 ON a.kd_lokasi=b.kd_unit WHERE b.kd_skpd='$cskpd' order by kd_lokasi";
	$hasil = $this->db->query($csql);
		$i=1;
		$totalx=0;
		$ntotal=0;
		foreach ($hasil->result() as $fa){
			$kd_lokasi	= $fa->kd_lokasi;
			$nm_lokasi	= strtoupper($fa->nm_lokasi);
			$cRet .="
                <tr>
                    <td bgcolor=\"#CCCCCC\" colspan=\"18\" align=\"left\" style=\"font-size:11px; font-family:tahoma;\"><b>$nm_lokasi</b></td>
                </tr>";	
	$csql = "SELECT a.kd_unit,b.nm_brg,a.kd_brg,
			IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,
			CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,a.total as nil_baru,a.judul,a.spesifikasi,a.asal,a.cipta,
			a.kd_bahan,a.jenis,a.tipe,COUNT(a.jumlah) AS jumlah,a.tahun,
			a.peroleh,SUM(a.nilai) AS total,COALESCE((a.nilai),0) as nilai,a.keterangan 
			FROM trkib_e a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE kd_skpd='$cskpd' $th $kon $mil 
			and a.kd_brg like '$jenis%' and (a.nilai >=500000 OR a.kd_riwayat='9')
			AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
			GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tipe,a.nilai,a.keterangan,a.tahun  
			ORDER BY tahun,kd_brg,no_reg";
			$hasil = $this->db->query($csql);
             foreach ($hasil->result() as $row){
			 $totalx 	= $row->total+$totalx;
			 $ntotal	= $row->nil_baru+$ntotal;
			
			if($iz=='2'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"lrft\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->judul</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->spesifikasi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->cipta</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tipe</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->peroleh</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";	}else{
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"lrft\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->judul</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->spesifikasi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->cipta</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tipe</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->peroleh</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}
				
				$i++;
			}
			}	
		}
	elseif ($cbid == '' && $cini=='fa'){ 
			$csql = "SELECT a.kd_unit,b.nm_brg,a.kd_brg,
			IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,
			CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,a.total as nil_baru,a.judul,a.spesifikasi,a.asal,a.cipta,
			a.kd_bahan,a.jenis,a.tipe,COUNT(a.jumlah) AS jumlah,a.tahun,
			a.peroleh,SUM(a.nilai) AS total,COALESCE((a.nilai),0) as nilai,a.keterangan 
			FROM trkib_e a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE kd_skpd='$cskpd' $th $kon $mil 
			and a.kd_brg like '$jenis%' and (a.nilai >=500000 OR a.kd_riwayat='9')
			AND a.kondisi<>'RB' AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
			GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tipe,a.nilai,a.keterangan,a.tahun  
			ORDER BY tahun,kd_brg,no_reg";
			$hasil = $this->db->query($csql);
             $i 	= 1;
			 $totalx=0;
			 $ntotal=0;
             foreach ($hasil->result() as $row){
			 $totalx 	= $row->total+$totalx;
				if($iz=='2'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"lrft\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->judul</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->spesifikasi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->cipta</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tipe</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->peroleh</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";	}
			else{
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"lrft\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->judul</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->spesifikasi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->cipta</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tipe</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->peroleh</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}
					$i++;
				}	
             }
			elseif ($cbid <> ''){ 
		  $csql = " SELECT a.kd_unit,b.nm_brg,a.kd_brg,a.total as nil_baru,
					IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,a.judul,a.spesifikasi,a.asal,a.cipta,
					a.kd_bahan,a.jenis,a.tipe,COUNT(a.jumlah) AS jumlah,a.tahun,a.peroleh,SUM(a.nilai) AS total,COALESCE((a.nilai),0) as nilai,a.keterangan 
					FROM trkib_e a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg WHERE kd_unit='$cbid' $th $kon $mil 
					 and a.kd_brg like '$jenis%' and (a.nilai >=500000 OR a.kd_riwayat='9') AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' and kd_pemilik='12'
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
					GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tipe,a.nilai,a.keterangan,a.tahun   
			ORDER BY tahun,kd_brg,no_reg";               
            $hasil = $this->db->query($csql);
             $i 	= 1;
			 $totalx=0;
			 $ntotal=0;
             foreach ($hasil->result() as $row)
             {
			 $totalx 	= $row->total+$totalx;
			 $ntotal	= $row->nil_baru+$ntotal;
			
				if($iz=='2'){
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"lrft\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->judul</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->spesifikasi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->cipta</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tipe</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->peroleh</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";
				}else{
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"lrft\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->judul</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->spesifikasi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->cipta</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tipe</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->peroleh</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}
                $i++;
				}
              }
			  if($pnilai=='1'){
			if($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($totalx)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
				elseif($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($totalx)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}

}else{
			if($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
				elseif($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"14\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}

}
			$cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"7\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
				<br/><br/>
			<tr>
				<td colspan=\"2\"></td>
				<td colspan=\"5\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$kota, $lctgl2</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;MENGETAHUI</td>
				<td colspan=\"2\"></td>
				<td colspan=\"3\"></td>
			</tr>
				<Tr></Tr><Tr></Tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;$cnm_bid</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">PENGURUS BARANG</td>			
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"7\" style=\"font-size:11px; font-family:tahoma;\" height=\"50\"></td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;(<u> $cnmtahu </u>)</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">(<u> $cnmbend </u>)</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;NIP. $lctahu</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;NIP. $lcbend</td>
			</tr>";
			
		$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan KIB E';
        $this->template->set('title', 'Laporan KIB E');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
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
    }
	
	function lap_kib_f(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$konfig		= $this->ambil_config();
		$nmkab		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$lctahu 	= $_REQUEST['lctahu'];
		$lcbend 	= $_REQUEST['lcbend'];
		$cnmbend 	= $_REQUEST['cnmbend'];
		$cnmtahu 	= $_REQUEST['cnmtahu'];
		$ctahun		= $_REQUEST['tahun'];
		$ckondisi	= $_REQUEST['kondisi'];
		$pnilai		= $_REQUEST['pnilai'];
		$lctgl2 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$jenis 		= $_REQUEST['jenis'];
		$nmjenis 	= $_REQUEST['nmjenis'];
		$cini 		= $_REQUEST['ini'];
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		} 	
		$kon		= "";
        if($ckondisi<>''){
		$kon ="and a.kondisi='$ckondisi'";
		}
		$cmilik		= $_REQUEST['milik'];
		$mil		= "";
        if($cmilik<>''){
		$mil ="and a.milik='$cmilik'";
		}
		if ($cbid==''){ 
				                 if($iz=='4'){
         $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"8\" style=\"font-size:14px;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) F<br>KONSTRUKSI DALAM PENGERJAAN</B></font></td>
				<td width=\"20%\"></td>
			</tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
								 </tr>";}else{$cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"8\" style=\"font-size:14px;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) F<br>KONSTRUKSI DALAM PENGERJAAN</B></font></td>
				<td width=\"20%\"></td>
			</tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
								 </tr>";
									 
								 }
			
			}
         
		 if ($cbid<>''){ 
         $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
                <td align=\"center\" colspan=\"12\" style=\"font-size:14px;\"><B>KARTU INVENTARIS BARANG (KIB) F<br>KONSTRUKSI DALAM PENGERJAAN</B></td>
            </tr><BR/><BR/><BR/>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
            </tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnm_bid</B></td>
            </tr>";}
			$cRet .="<tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
			
            $cRet .="
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            
            <tr>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">No</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Jenis Barang/<br>Nama Barang</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Bangunan (P.SP.D)</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Konstruksi</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Luas<br>(m2)</td>
                <!--td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Konstruksi</td-->
                <!--td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Panjang<br>(Km)</td-->
                <!--td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Lebar<br>(M)</td-->
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Letak/<br>Lokasi</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Dokumen</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Tgl,Bln,Thn,Mulai</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Status<br>Tanah</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nomor Kode<br>Tanah</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Asal Usul</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nilai Kontrak</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Bertingkat/tidak</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Beton/tidak</td>
				<td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td-->
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td-->
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">8</td-->
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">12</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">13</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">14</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">15</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <!--td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <!--td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <!--td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"17\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"17\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>";
			
		if($cbid=='' && $cini=='iz'){
		$csql	= "SELECT DISTINCT a.kd_lokasi,a.nm_lokasi FROM mlokasi a LEFT JOIN trkib_f b
				 ON a.kd_lokasi=b.kd_unit WHERE b.kd_skpd='$cskpd' order by kd_lokasi";
		$hasil 	= $this->db->query($csql);
		$i		=1;
		$totalx	=0;
		$nilaix =0;
		$ntotal =0;
		foreach ($hasil->result() as $fa){
			$kd_lokasi	= $fa->kd_lokasi;
			$nm_lokasi	= strtoupper($fa->nm_lokasi);
			$cRet .="
                <tr>
                    <td bgcolor=\"#CCCCCC\" colspan=\"15\" align=\"left\" style=\"font-size:11px; font-family:tahoma;\"><b>$nm_lokasi</b></td>
                </tr>";	
		
		$csql = "SELECT b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.total as nil_baru,
		a.luas,a.alamat1,a.tgl_reg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,
		CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS reg,a.tgl_awal_kerja,
		a.bangunan,a.kd_tanah,a.tahun,a.asal,sum(a.nilai)as total,a.nilai,a.keterangan FROM trkib_f a 
		INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
		WHERE a.kd_unit='$kd_lokasi' $th $kon $mil AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
		GROUP BY b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.bangunan,a.kd_tanah,
		a.tahun,a.asal,a.nilai,a.keterangan,a.kd_brg
		ORDER BY a.tahun,a.kd_brg,no_reg";
			$hasil = $this->db->query($csql);
             $i = 1;
			 $nilaix=0;
			 $ntotal=0;
             foreach ($hasil->result() as $row)
             {
				$nilaix 	= $row->total+$nilaix;
				$ntotal		= $row->nil_baru+$ntotal;
				
				if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->bangunan</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";} else{
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->bangunan</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}
				$i++;
				}
			}
			}
				
		elseif($cbid=='' && $cini=='fa'){
		$csql = "SELECT b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.total as nil_baru,
		a.luas,a.alamat1,a.tahun,a.tgl_reg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,
		CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS reg,a.tgl_awal_kerja,
		a.bangunan,a.kd_tanah,a.asal,sum(a.nilai)as total,a.nilai,a.keterangan FROM trkib_f a 
		INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
		WHERE a.kd_skpd='$cskpd' $th $kon $mil AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
		GROUP BY b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.bangunan,a.kd_tanah,a.tahun,a.asal,a.nilai,a.keterangan,a.kd_brg
		ORDER BY a.tahun,a.kd_brg,no_reg";
			$hasil = $this->db->query($csql);
             $i 	= 1;
			 $nilaix= 0;
			 $totalx	=0;
			 $ntotal=0;
             foreach ($hasil->result() as $row){
				$nilaix 	= $row->total+$nilaix;
				$ntotal		= $row->nil_baru+$ntotal;
				if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->bangunan</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}else{
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->bangunan</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}
                $i++;
				}
			}
			else if($cbid <> ''){
			$csql = "SELECT b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.total as nil_baru,
			a.luas,a.alamat1,a.tahun,a.tgl_reg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,
			CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS reg,a.tgl_awal_kerja,
			a.bangunan,a.kd_tanah,a.asal,sum(a.nilai)as total,a.nilai,a.keterangan FROM trkib_f a 
			INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
			WHERE kd_skpd='$cskpd' $th $kon $mil AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
			GROUP BY b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.bangunan,a.kd_tanah,a.tahun,a.asal,a.nilai,a.keterangan,a.kd_brg
			ORDER BY a.tahun,a.kd_brg,no_reg";
            $hasil = $this->db->query($csql);
             $i 	= 1;
			 $nilaix=0;
			 $totalx=0;
			 $ntotal=0;
             foreach ($hasil->result() as $row){
				$nilaix 	= $row->total+$nilaix;
				$ntotal		= $row->nil_baru+$ntotal;
				
				if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->bangunan</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">'$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}else{
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->bangunan</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->konstruksi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jenis</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->luas</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->status_tanah</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_tanah</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}
                $i++;
				}
            }
		if($pnilai=='1'){
		 if($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"13\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($nilaix)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
         if($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"13\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($nilaix)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
		</table>";}
		
		}else{
          if($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"13\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
         if($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"13\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
		</table>";}
		}
			
			$cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"10\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
				<br/><br/>
			<tr>
				<td colspan=\"2\"></td>
				<td colspan=\"5\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$kota, $lctgl2</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;MENGETAHUI</td>
				<td colspan=\"2\"></td>
				<td colspan=\"3\"></td>
			</tr>
				<Tr></Tr><Tr></Tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;KEPALA $cnm_bid</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">PENGURUS BARANG</td>			
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"7\" style=\"font-size:11px; font-family:tahoma;\" height=\"50\"></td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;( $cnmtahu )</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">( $cnmbend )</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;NIP. $lctahu</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;NIP. $lcbend</td>
			</tr>";
			
		$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan KIB F';
        $this->template->set('title', 'Laporan KIB F');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
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
    }
	
	function lap_kib_g(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$konfig		= $this->ambil_config();
		$nmkab		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cskpd 		= $_REQUEST['cskpd'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$cnmskpd 	= $_REQUEST['cnmskpd'];
		$lctahu 	= $_REQUEST['lctahu'];
		$lcbend 	= $_REQUEST['lcbend'];
		$cnmbend 	= $_REQUEST['cnmbend'];
		$cnmtahu 	= $_REQUEST['cnmtahu'];
		$ctahun		= $_REQUEST['tahun'];
		$ckondisi	= $_REQUEST['kondisi'];
		$pnilai		= $_REQUEST['pnilai'];
		$lctgl2 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		$jenis 		= $_REQUEST['jenis'];
		$nmjenis 	= $_REQUEST['nmjenis'];
		$cini 		= $_REQUEST['ini'];
		$th			= "";
        if($ctahun<>''){
		$th ="and a.tahun='$ctahun'";
		} 	
		$kon		= "";
        if($ckondisi<>''){
		$kon ="and a.kondisi='$ckondisi'";
		}
		$cmilik		= $_REQUEST['milik'];
		$mil		= "";
        if($cmilik<>''){
		$mil ="and a.milik='$cmilik'";
		}
		
		if ($cbid==''){ 
				                 if($iz=='4'){
         $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".base_url()."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"12\" style=\"font-size:14px;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) G<br>ASET TAK BERWUJUD</B></font></td>
				<td width=\"20%\"></td>
			</tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
								 </tr>";}else{$cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr><td width=\"5%\"></td>
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
                <td align=\"center\" colspan=\"12\" style=\"font-size:14px;\"><font face=\"tahoma\"><B>KARTU INVENTARIS BARANG (KIB) G<br>ASET TAK BERWUJUD</B></font></td>
				<td width=\"20%\"></td>
			</tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
								 </tr>";
									 
								 }
			
			}

         
		 if ($cbid<>''){ 
         $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
                <td align=\"center\" colspan=\"12\" style=\"font-size:14px;\"><B>KARTU INVENTARIS BARANG (KIB) G<br>ASET TAK BERWUJUD</B></td>
            </tr><BR/><BR/><BR/>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnmskpd</B></td>
            </tr>
            <tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;UNIT</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnm_bid</B></td>
            </tr>";}
			$cRet .="<tr>
				<td></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;KABUPATEN</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>";
			
            $cRet .="
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            
            <tr>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">No</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Jenis Barang/<br>Nama Barang</td>
                <!--td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Konstruksi</td-->
                <!--td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Panjang<br>(Km)</td-->
                <!--td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Lebar<br>(M)</td-->
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Letak/<br>Lokasi</td>
                <td colspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Dokumen</td>
				<td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Tgl,Bln,Thn,Mulai</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Kondisi</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Asal Usul</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nilai Kontrak</td>
                <td rowspan=\"2\" align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Keterangan</td>
            </tr>
            <tr>
				<td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\"  bgcolor=\"#FFD700\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td-->
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td-->
                <!--td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td-->
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">8</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">9</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">10</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <!--td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <!--td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <!--td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td-->
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"17\" style=\"font-size:10px; font-family:tahoma;\"></td>
				<td align=\"center\" width =\"17\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>";
			
		if($cbid=='' && $cini=='iz'){
		$csql	= "SELECT DISTINCT a.kd_lokasi,a.nm_lokasi FROM mlokasi a LEFT JOIN trkib_g b
				 ON a.kd_lokasi=b.kd_unit WHERE b.kd_skpd='$cskpd' order by kd_lokasi";
		$hasil 	= $this->db->query($csql);
		$i		=1;
		$totalx	=0;
		$nilaix =0;
		$ntotal =0;
		foreach ($hasil->result() as $fa){
			$kd_lokasi	= $fa->kd_lokasi;
			$nm_lokasi	= strtoupper($fa->nm_lokasi);
			$cRet .="
                <tr>
                    <td bgcolor=\"#CCCCCC\" colspan=\"15\" align=\"left\" style=\"font-size:11px; font-family:tahoma;\"><b>$nm_lokasi</b></td>
                </tr>";	
		
		$csql = "SELECT b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.total as nil_baru,
		a.luas,a.alamat1,a.tgl_reg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,
		CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS reg,a.tgl_awal_kerja,
		a.bangunan,a.kd_tanah,a.tahun,a.asal,sum(a.nilai)as total,a.nilai,a.kondisi,a.keterangan FROM trkib_g a 
		INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
		WHERE a.kd_unit='$kd_lokasi' $th $kon $mil AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
		GROUP BY b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.bangunan,a.kd_tanah,
		a.tahun,a.asal,a.nilai,a.keterangan,a.kd_brg
		ORDER BY a.tahun,a.kd_brg,no_reg";
			$hasil = $this->db->query($csql);
             $i = 1;
			 $nilaix=0;
			 $ntotal=0;
             foreach ($hasil->result() as $row)
             {
				$nilaix 	= $row->total+$nilaix;
				$ntotal		= $row->nil_baru+$ntotal;
				
				if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";} else{
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}
				$i++;
				}
			}
			}
				
		elseif($cbid=='' && $cini=='fa'){
		$csql = "SELECT b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.total as nil_baru,
		a.luas,a.alamat1,a.tahun,a.tgl_reg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,
		CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS reg,a.tgl_awal_kerja,
		a.bangunan,a.kd_tanah,a.asal,sum(a.nilai)as total,a.nilai,a.kondisi,a.keterangan FROM trkib_g a 
		INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
		WHERE a.kd_skpd='$cskpd' $th $kon $mil AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
		GROUP BY b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.bangunan,a.kd_tanah,a.tahun,a.asal,a.nilai,a.keterangan,a.kd_brg
		ORDER BY a.tahun,a.kd_brg,no_reg";
			$hasil = $this->db->query($csql);
             $i 	= 1;
			 $nilaix= 0;
			 $totalx	=0;
			 $ntotal=0;
             foreach ($hasil->result() as $row){
				$nilaix 	= $row->total+$nilaix;
				$ntotal		= $row->nil_baru+$ntotal;
				if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}else{
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}
                $i++;
				}
			}
			else if($cbid <> ''){
			$csql = "SELECT b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.total as nil_baru,
			a.luas,a.alamat1,a.tahun,a.tgl_reg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,
			CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS reg,a.tgl_awal_kerja,
			a.bangunan,a.kd_tanah,a.asal,sum(a.nilai)as total,a.kondisi,a.nilai,a.keterangan FROM trkib_g a 
			INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
			WHERE kd_skpd='$cskpd' $th $kon $mil AND a.kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat>'$sampai_tgl' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_riwayat='9')
			GROUP BY b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.bangunan,a.kd_tanah,a.tahun,a.asal,a.nilai,a.keterangan,a.kd_brg
			ORDER BY a.tahun,a.kd_brg,no_reg";
            $hasil = $this->db->query($csql);
             $i 	= 1;
			 $nilaix=0;
			 $totalx=0;
			 $ntotal=0;
             foreach ($hasil->result() as $row){
				$nilaix 	= $row->total+$nilaix;
				$ntotal		= $row->nil_baru+$ntotal;
				
				if($iz=='2'){
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">'$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->total</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->nil_baru</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}else{
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
					<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->reg</td>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_awal_kerja</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kondisi</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>";
									if($pnilai=='1'){
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->total)."</td>";
									}else{
									$cRet .="<td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nil_baru)."</td>";
									}
									$cRet .="<td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>";}
                $i++;
				}
            }
		if($pnilai=='1'){
		 if($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"8\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($nilaix)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
         if($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"8\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($nilaix)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
		</table>";}
		
		}else{
          if($iz=='1'){
            $cRet .="
			<tr>
			<td colspan=\"8\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
         if($iz<>'1'){
            $cRet .="
			<tr>
			<td colspan=\"8\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">Jumlah</td>
			<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($ntotal)."</td>
			<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
		</table>";}
		}
			
			$cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"8\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
				<br/><br/>
			<tr>
				<td colspan=\"2\"></td>
				<td colspan=\"5\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$kota, $lctgl2</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;MENGETAHUI</td>
				<td colspan=\"2\"></td>
				<td colspan=\"3\"></td>
			</tr>
				<Tr></Tr><Tr></Tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;KEPALA $cnm_bid</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">PENGURUS BARANG</td>			
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" colspan=\"7\" style=\"font-size:11px; font-family:tahoma;\" height=\"50\"></td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;( $cnmtahu )</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">( $cnmbend )</td>
			</tr>
			<tr>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;NIP. $lctahu</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;NIP. $lcbend</td>
			</tr>";
			
		$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan KIB F';
        $this->template->set('title', 'Laporan KIB F');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
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
    }

	
	function lap_rekap_kib(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$konfig		= $this->ambil_config();
		$nmkab		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$tahun	 	= $_REQUEST['tahun'];
		$tahun2 	= $_REQUEST['tahun2'];
		$lctgl2 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$sampai_tgl	= $_REQUEST['tgl_reg'];
		$iz	 		= $_REQUEST['fa'];
		 $lutji="";
         if ($tahun<>'' && $tahun2<>''){
		 $lutji="and a.tahun between '$tahun' and '$tahun2'";
		 }
		 
		 //$this->db->query("call mr ('$tahun','$kota') ")
		 
         $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
                <td align=\"center\" colspan=\"5\" style=\"font-size:14px;\"><B>LAPORAN REKAPITULASI KARTU INVENTARIS BARANG</B></td>
            </tr><BR/><BR/><BR/>";
         
			$cRet .="
			<tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nmkab</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>";
			
            $cRet .="
            
            <tr>
                <td align=\"left\"  colspan=\"5\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            
            <tr>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">No</td>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">SKPD</td>
				<td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB A</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB B</td>
				<td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB C</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB D</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB E</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB F</td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">12</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">13</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">14</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>";
			
			$sqlhead ="select kd_skpd,nm_skpd from ms_skpd order by kd_skpd";
            $hasilx   = $this->db->query($sqlhead);
					$i		 = 1;
					$jml1x 	  = 0;
					$nilai1x  = 0;
					$jml2x 	  = 0;
					$nilai2x  = 0;
					$jml3x 	  = 0;
					$nilai3x  = 0;
					$jml4x 	  = 0;
					$nilai4x  = 0;
					$jml5x 	  = 0;
					$nilai5x  = 0;
					$jml6x 	  = 0;
					$nilai6x  = 0;
			foreach ($hasilx->result() as $row)
             {
			 $skpd 	  = $row->kd_skpd;
			 $nm_skpd = $row->nm_skpd;
				
				$sqdetail1="SELECT ifnull((sum(a.nilai)),0) as nilai1,ifnull((count(a.nilai)),0) as jumlah1 FROM 
							trkib_a a WHERE a.kd_skpd='$skpd' $lutji"; 
				$hasil1   = $this->db->query($sqdetail1);
				foreach ($hasil1->result() as $row)
				{
					$jml1 	  = $row->jumlah1;
					$nilai1   = $row->nilai1;
					$jml1x 	  = $row->jumlah1+$jml1x;
					$nilai1x  = $row->nilai1+$nilai1x;
				}
				$sqdetail2="SELECT ifnull((sum(a.nilai)),0) as nilai2,ifnull((count(a.nilai)),0) as jumlah2 FROM 
							trkib_b a WHERE a.kd_skpd='$skpd' AND a.tgl_reg<='$sampai_tgl' AND a.kd_pemilik='12' 
							AND a.kondisi<>'RB' AND (a.nilai>='500000' or a.kd_riwayat='9') $lutji"; 
				$hasil2   = $this->db->query($sqdetail2);
				foreach ($hasil2->result() as $row)
				{
					$jml2 	  = $row->jumlah2;
					$nilai2   = $row->nilai2;
					$jml2x 	  = $row->jumlah2+$jml2x;
					$nilai2x  = $row->nilai2+$nilai2x;
				}
				$sqdetail3="SELECT ifnull((sum(a.nilai)),0) as nilai3,ifnull((count(a.nilai)),0) as jumlah3 FROM 
							trkib_c a WHERE a.kd_skpd='$skpd' AND a.tgl_reg<='$sampai_tgl' AND a.kd_pemilik='12' 
							AND a.kondisi<>'RB' AND (a.nilai>='10000000' or a.kd_riwayat='9') $lutji"; 
				$hasil3   = $this->db->query($sqdetail3);
				foreach ($hasil3->result() as $row)
				{
					$jml3 	  = $row->jumlah3;
					$nilai3   = $row->nilai3;
					$jml3x 	  = $row->jumlah3+$jml3x;
					$nilai3x   = $row->nilai3+$nilai3x;
				}
				$sqdetail4="SELECT ifnull((sum(a.nilai)),0) as nilai4,ifnull((count(a.nilai)),0) as jumlah4 FROM 
							trkib_d a WHERE a.kd_skpd='$skpd' AND a.tgl_reg<='$sampai_tgl' AND a.kd_pemilik='12' 
							AND a.kondisi<>'RB' AND (a.nilai>='10000000' or a.kd_riwayat='9') $lutji"; 
				$hasil4   = $this->db->query($sqdetail4);
				foreach ($hasil4->result() as $row)
				{
					$jml4 	  = $row->jumlah4;
					$nilai4   = $row->nilai4;
					$jml4x 	  = $row->jumlah4+$jml4x;
					$nilai4x  = $row->nilai4+$nilai4x;
				}
				$sqdetail5="SELECT ifnull((sum(a.nilai)),0) as nilai5,ifnull((count(a.nilai)),0) as jumlah5 FROM 
							trkib_e a WHERE a.kd_skpd='$skpd' AND a.tgl_reg<='$sampai_tgl' AND a.kd_pemilik='12' 
							AND a.kondisi<>'RB' AND (a.nilai>='500000' or a.kd_riwayat='9') $lutji"; 
				$hasil5   = $this->db->query($sqdetail5);
				foreach ($hasil5->result() as $row)
				{
					$jml5 	  = $row->jumlah5;
					$nilai5   = $row->nilai5;
					$jml5x 	  = $row->jumlah5+$jml5x;
					$nilai5x  = $row->nilai5+$nilai5x;
				}
				$sqdetail6="SELECT ifnull((sum(a.nilai)),0) as nilai6,ifnull((count(a.nilai)),0) as jumlah6 FROM 
							trkib_f a WHERE a.kd_skpd='$skpd' and a.kondisi<>'RB' $lutji"; 
				$hasil6   = $this->db->query($sqdetail6);
				foreach ($hasil6->result() as $row)
				{
					$jml6 	  = $row->jumlah6;
					$nilai6   = $row->nilai6;
					$jml6x 	  = $row->jumlah6+$jml6x;
					$nilai6x  = $row->nilai6+$nilai6x;
				}
					if($iz=='1'){			
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">$nm_skpd</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml1</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai1)."</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml2</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai2)."</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml3</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai3)."</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml4</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai4)."</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml5</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai5)."</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml6</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai6)."</td>
                </tr>";}
				//$i++;
				if($iz<>'1'){
				 $cRet .="<tr>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">$nm_skpd</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml1</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai1</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml2</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai2</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml3</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai3</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml4</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai4</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml5</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai5</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml6</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai6</td>
                </tr>";}
				$i++;
            }
			
			 if($iz=='1'){
            $cRet .="
			<tr>
                    <td bgcolor=\"#fce5e7\" colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">JUMLAH</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml1x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai1x)."</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml2x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai2x)."</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml3x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai3x)."</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml4x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai4x)."</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml5x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai5x)."</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml6x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai6x)."</td>
                </tr></table>";}
			if($iz<>'1'){
			 $cRet .="
			<tr>
                    <td bgcolor=\"#fce5e7\" colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">JUMLAH</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml1x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai1x</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml2x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai2x</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml3x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai3x</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml4x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai4x</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml5x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai5x</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml6x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai6x</td>
                </tr><br/><br/><br/></table>";
			
			}
			$cRet .="
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr><td colspan=\"14\"></td></tr>
			<tr><td colspan=\"14\"></td></tr>
			<tr><td colspan=\"14\"></td></tr>
			<tr><td colspan=\"14\"></td></tr>
			<tr><td colspan=\"14\"></td></tr>
			<tr>
				<td colspan=\"11\"></td>
				<td colspan=\"2\" align=\"right\" style=\"font-size:11px; font-family:tahoma;\"><b>$kota, $lctgl2</b></td>
				<td></td>
			</tr>";
			
		$cRet .="</table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan Rekap KIB';
        $this->template->set('title', 'Laporan Rekap KIB');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
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
	
	function lap_rekap_inventaris(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$konfig		= $this->ambil_config();
		$nmkab		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$tahun	 	= $_REQUEST['tahun'];
		$tahun2 	= $_REQUEST['tahun2'];
		$lctgl2 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$iz	 		= $_REQUEST['fa'];
		 $lutji="";
         if ($tahun<>'' && $tahun2<>''){
		 $lutji="and a.tahun between '$tahun' and '$tahun2'";
		 }
		 
         $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
                <td align=\"center\" colspan=\"5\" style=\"font-size:14px;\"><B>LAPORAN REKAPITULASI BUKU INVENTARIS BARANG</B></td>
            </tr><BR/><BR/><BR/>";
         
			$cRet .="
			<tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nmkab</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>";
			
            $cRet .="
            
            <tr>
                <td align=\"left\"  colspan=\"5\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            
            <tr>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">No</td>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">SKPD</td>
				<td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB A</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB B</td>
				<td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB C</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB D</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB E</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">KIB F</td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nilai</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">12</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">13</td>
				<td align=\"center\" bgcolor=\"#a2c8fb\" style=\"font-size:10px; font-family:tahoma;\">14</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"30%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>";
			
			$sqlhead ="select kd_skpd,nm_skpd from ms_skpd order by nm_skpd";
            $hasilx   = $this->db->query($sqlhead);
			$i		 = 1;
					$jml1x 	  = 0;
					$nilai1x  = 0;
					$jml2x 	  = 0;
					$nilai2x  = 0;
					$jml3x 	  = 0;
					$nilai3x  = 0;
					$jml4x 	  = 0;
					$nilai4x  = 0;
					$jml5x 	  = 0;
					$nilai5x  = 0;
					$jml6x 	  = 0;
					$nilai6x  = 0;
			foreach ($hasilx->result() as $row)
             {
			 $skpd 	  = $row->kd_skpd;
			 $nm_skpd = $row->nm_skpd;
				
				$sqdetail1="SELECT ifnull((sum(a.nilai)),0) as nilai1,ifnull((count(a.nilai)),0) as jumlah1 FROM 
							trkib_a a WHERE a.kd_skpd='$skpd' $lutji"; 
				$hasil1   = $this->db->query($sqdetail1);
				foreach ($hasil1->result() as $row)
				{
					$jml1 	  = $row->jumlah1;
					$nilai1   = $row->nilai1;
					$jml1x 	  = $row->jumlah1+$jml1x;
					$nilai1x  = $row->nilai1+$nilai1x;
				}
				$sqdetail2="SELECT ifnull((sum(a.nilai)),0) as nilai2,ifnull((count(a.nilai)),0) as jumlah2 FROM 
							trkib_b a WHERE a.kd_skpd='$skpd' $lutji"; 
				$hasil2   = $this->db->query($sqdetail2);
				foreach ($hasil2->result() as $row)
				{
					$jml2 	  = $row->jumlah2;
					$nilai2   = $row->nilai2;
					$jml2x 	  = $row->jumlah2+$jml2x;
					$nilai2x  = $row->nilai2+$nilai2x;
				}
				$sqdetail3="SELECT ifnull((sum(a.nilai)),0) as nilai3,ifnull((count(a.nilai)),0) as jumlah3 FROM 
							trkib_c a WHERE a.kd_skpd='$skpd' $lutji"; 
				$hasil3   = $this->db->query($sqdetail3);
				foreach ($hasil3->result() as $row)
				{
					$jml3 	  = $row->jumlah3;
					$nilai3   = $row->nilai3;
					$jml3x 	  = $row->jumlah3+$jml3x;
					$nilai3x   = $row->nilai3+$nilai3x;
				}
				$sqdetail4="SELECT ifnull((sum(a.nilai)),0) as nilai4,ifnull((count(a.nilai)),0) as jumlah4 FROM 
							trkib_d a WHERE a.kd_skpd='$skpd' $lutji"; 
				$hasil4   = $this->db->query($sqdetail4);
				foreach ($hasil4->result() as $row)
				{
					$jml4 	  = $row->jumlah4;
					$nilai4   = $row->nilai4;
					$jml4x 	  = $row->jumlah4+$jml4x;
					$nilai4x  = $row->nilai4+$nilai4x;
				}
				$sqdetail5="SELECT ifnull((sum(a.nilai)),0) as nilai5,ifnull((count(a.nilai)),0) as jumlah5 FROM 
							trkib_e a WHERE a.kd_skpd='$skpd' $lutji"; 
				$hasil5   = $this->db->query($sqdetail5);
				foreach ($hasil5->result() as $row)
				{
					$jml5 	  = $row->jumlah5;
					$nilai5   = $row->nilai5;
					$jml5x 	  = $row->jumlah5+$jml5x;
					$nilai5x  = $row->nilai5+$nilai5x;
				}
				$sqdetail6="SELECT ifnull((sum(a.nilai)),0) as nilai6,ifnull((count(a.nilai)),0) as jumlah6 FROM 
							trkib_f a WHERE a.kd_skpd='$skpd' $lutji"; 
				$hasil6   = $this->db->query($sqdetail6);
				foreach ($hasil6->result() as $row)
				{
					$jml6 	  = $row->jumlah6;
					$nilai6   = $row->nilai6;
					$jml6x 	  = $row->jumlah6+$jml6x;
					$nilai6x  = $row->nilai6+$nilai6x;
				}
					if($iz=='1'){			
                $cRet .="
                <tr>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">$nm_skpd</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml1</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai1)."</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml2</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai2)."</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml3</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai3)."</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml4</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai4)."</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml5</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai5)."</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml6</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai6)."</td>
                </tr>";
				$i++;}
				if($iz<>'1'){
				 $cRet .="<tr>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">$nm_skpd</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml1</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai1</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml2</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai2</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml3</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai3</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml4</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai4</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml5</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai5</td>
                    <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml6</td>
					<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai6</td>
                </tr>";
				$i++;}
            }
			
			 if($iz=='1'){
            $cRet .="
			<tr>
                    <td bgcolor=\"#fce5e7\" colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">JUMLAH</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml1x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai1x)."</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml2x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai2x)."</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml3x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai3x)."</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml4x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai4x)."</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml5x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai5x)."</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml6x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai6x)."</td>
                </tr></table>";}
			if($iz<>'1'){
			 $cRet .="
			<tr>
                    <td bgcolor=\"#fce5e7\" colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">JUMLAH</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml1x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai1x</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml2x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai2x</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml3x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai3x</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml4x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai4x</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml5x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai5x</td>
                    <td bgcolor=\"#fce5e7\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml6x</td>
					<td bgcolor=\"#fce5e7\" align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai6x</td>
                </tr><br/><br/><br/></table>";
			
			}
			$cRet .="
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr><td colspan=\"14\"></td></tr>
			<tr><td colspan=\"14\"></td></tr>
			<tr><td colspan=\"14\"></td></tr>
			<tr><td colspan=\"14\"></td></tr>
			<tr><td colspan=\"14\"></td></tr>
			<tr>
				<td colspan=\"11\"></td>
				<td colspan=\"2\" align=\"right\" style=\"font-size:11px; font-family:tahoma;\"><b>$kota, $lctgl2</b></td>
				<td></td>
			</tr>";
			
		$cRet .="</table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan Rekap KIB';
        $this->template->set('title', 'Laporan Rekap KIB');  
        switch($iz) {
        case 1;
             $this->_mpdf('',$cRet,10,10,10,'1');
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

    function lap_rekap_rkbu(){
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
    $konfig   = $this->ambil_config();
    $nmkab    = strtoupper($konfig['nm_client']);
        $kota     = strtoupper($konfig['kota']);
        $logo     = $konfig['logo'];
    $thn      = $this->session->userdata('ta_simbakda');
    $unit_skpd  = $this->session->userdata('unit_skpd');
    $tah      = $this->session->userdata('ta_simbakda');
    $tahun    = $_REQUEST['tahun'];
    $tahun2   = $_REQUEST['tahun2'];
    $lctgl2   = $this->tanggal_indonesia($_REQUEST['lctgl2']);
    $iz     = $_REQUEST['fa'];
    $cskpd    = $_REQUEST['kd_skpd'];
    $lctahu   = $_REQUEST['tahu'];
        $lcbend   = $_REQUEST['bend'];
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

        // if($key=='PA')
        // {
        //   $jabat='KEPALA DINAS';
        // }else {
        //   $jabat='BENDAHARA BARANG';
        // }
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


    $lutji="";
         if ($tahun<>'' && $tahun2<>''){
     $lutji="and b.tahun between '$tahun' and '$tahun2'";
     }
     
         $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
            <tr>
                <td align=\"center\" colspan=\"5\" style=\"font-size:14px;\"><B>LAPORAN REKAPITULASI RENCANA KEBUTUHAN BARANG UNIT (RKBU)</B></td>
            </tr><BR/><BR/>";
         
      $cRet .="
      <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nmkab</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"4\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>";
      $cRet .=" <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px; font-family:tahoma;\">No</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px; font-family:tahoma;\">Organisasi Perangkat Daerah</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px; font-family:tahoma;\">JUMLAH BARANG</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px; font-family:tahoma;\">NIILAI</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">4</td>
            </tr>
            </thead>";
      
      $sqlhead ="select kd_skpd,nm_skpd from ms_skpd where kd_skpd='$cskpd'";
            $hasilx  = $this->db->query($sqlhead);
      $i     = 1;
      $jml2  = 0;
      $nilai2  = 0;
    foreach ($hasilx->result() as $row)
             {
       $skpd    = $row->kd_skpd;
       $nm_skpd = $row->nm_skpd;
        
        $sqdetail1="SELECT ifnull((sum(a.total)),0) as nilai1,ifnull((SUM(a.jumlah)),0) as jumlah1 FROM 
              trd_planbrg a join trh_planbrg b on a.no_dokumen=b.no_dokumen WHERE b.kd_uskpd='$cskpd' $lutji"; 
        $hasil1   = $this->db->query($sqdetail1);
        foreach ($hasil1->result() as $row)
        {
          $jml2   = $row->jumlah1+$jml2;
          $nilai2   = $row->nilai1+$nilai2;
          $jml1     = $row->jumlah1;
          $nilai1   = $row->nilai1;
        }
        
        if($iz=='1'){     
          $cRet .="
              <tr>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$i</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">$nm_skpd</td>
                <td align=\"center\" style=\"font-size:12px; width=\"15%\" font-family:tahoma;\">$jml1</td>
                <td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai1,2,',','.')."</td>
              </tr>";
        $i++;}
        elseif($iz<>'1'){
          $cRet .="<tr>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$i</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">$nm_skpd</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml1</td>
                <td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai1</td>
              </tr>";
        $i++;}
            }
          $cRet .="<tr>
                <td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"><b>TOTAL</b></td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\"><b>$jml2</b></td>
                <td align=\"right\" style=\"font-size:12px; font-family:tahoma;\"><b>".number_format($nilai2,2,',','.')."</b></td>
              </tr>";
      $cRet .="</table>";
    //   $cRet .="
    //          <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
    //   <tr><td colspan=\"4\"></td></tr>
    //   <tr><td colspan=\"4\"></td></tr>
    //   <tr><td colspan=\"4\"></td></tr>
    //   <tr><td colspan=\"4\"></td></tr>
    //   <tr><td colspan=\"4\"></td></tr>
    //   <tr>
    //     <td colspan=\"3\"></td>
    //     <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"><b>$kota, $lctgl2</b></td>
    //     <td></td>
    //   </tr>
    //   <tr>
    //     <td colspan=\"3\"></td>
    //     <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"><b>$pkt_tahu</b></td>
    //     <td></td>
    //   </tr>
    //   <tr>
    //     <td colspan=\"3\"></td>
    //     <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"><b></b></td>
    //     <td></td>
    //   </tr>
    //    <tr>
    //     <td colspan=\"3\"></td>
    //     <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"><b></b></td>
    //     <td></td>
    //   </tr>
    //    <tr>
    //     <td colspan=\"3\"></td>
    //     <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"><b></b></td>
    //     <td></td>
    //   </tr>
    //    <tr>
    //     <td colspan=\"3\"></td>
    //     <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"><b><br><br>&nbsp;</b></td>
    //     <td></td>
    //   </tr>
    //   <tr>
    //     <td colspan=\"3\"></td>
    //     <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"><b>(<u>$nm_tahu</u>)<br>NIP. $nip_tahu</b></td>
    //     <td></td>
    //   </tr>";
      
    // $cRet .="</table>";
      $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\">&nbsp;</td></tr>
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\" style=\"font-size:12px; font-family:tahoma;\">$kota , $lctgl2</td></tr>
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\" style=\"font-size:12px; font-family:tahoma;\">$jabat $nm_skpd</td></tr>
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\">&nbsp;</td></tr>                              
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\">&nbsp;</td></tr>
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\" style=\"font-size:12px; font-family:tahoma;\">$nm_tahu</td></tr>                              
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\" style=\"font-size:12px; font-family:tahoma;\">$pkt_tahu</td></tr>
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\" style=\"font-size:12px; font-family:tahoma;\">NIP. $nip_tahu</td>
                  </table>";

        $data['prev']= $cRet;
    $kertas='LEGAL';  
        $judul  = 'Laporan Rekap RKBU';
        $this->template->set('title', 'Laporan Rekap RKBU');  
        switch($iz) {
        case 1;
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
	
	// function lap_rekap_rkbu(){
 //        if($this->auth->is_logged_in() == false){
 //           	redirect(site_url().'/welcome/login');
 //      	}else{
	// 	$konfig		= $this->ambil_config();
	// 	$nmkab		= strtoupper($konfig['nm_client']);
 //        $kota 		= strtoupper($konfig['kota']);
 //        $logo 		= $konfig['logo'];
	// 	$thn  		= $this->session->userdata('ta_simbakda');
	// 	$unit_skpd  = $this->session->userdata('unit_skpd');
	// 	$tah  		= $this->session->userdata('ta_simbakda');
	// 	$tahun	 	= $_REQUEST['tahun'];
	// 	$tahun2 	= $_REQUEST['tahun2'];
	// 	$lctgl2 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
	// 	$iz	 		= $_REQUEST['fa'];
	// 	$lutji="";
 //         if ($tahun<>'' && $tahun2<>''){
	// 	 $lutji="and b.tahun between '$tahun' and '$tahun2'";
	// 	 }
		 
 //         $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
 //            <tr>
 //                <td align=\"center\" colspan=\"5\" style=\"font-size:14px;\"><B>LAPORAN REKAPITULASI RENCANA KEBUTUHAN BARANG UNIT (RKBU)</B></td>
 //            </tr><BR/><BR/>";
         
	// 		$cRet .="
	// 		<tr>
 //                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
 //                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kota</td>
 //                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
 //                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
 //                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
 //            </tr>
 //            <tr>
 //                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
 //                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
 //                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nmkab</td>
 //                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
 //                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\"></td>
 //            </tr>
 //            <tr>
 //                <td align=\"left\"  colspan=\"4\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
 //            </tr>
            
 //            </table>";
 //      $cRet .=" <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
 //            <thead>
 //            <tr>
 //                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px; font-family:tahoma;\">No</td>
 //                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px; font-family:tahoma;\">Organisasi Perangkat Daerah</td>
	// 			        <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px; font-family:tahoma;\">JUMLAH BARANG</td>
 //                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px; font-family:tahoma;\">NIILAI</td>
 //            </tr>
 //            <tr>
 //                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">1</td>
 //                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">2</td>
 //                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">3</td>
 //                <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:10px; font-family:tahoma;\">4</td>
 //            </tr>
 //            </thead>";
			
	// 		$sqlhead ="select kd_skpd,nm_skpd from ms_skpd order by kd_skpd";
 //            $hasilx  = $this->db->query($sqlhead);
	// 		$i		 = 1;
	// 		$jml2	 = 0;
	// 		$nilai2	 = 0;
	// 	foreach ($hasilx->result() as $row)
 //             {
	// 		 $skpd 	  = $row->kd_skpd;
	// 		 $nm_skpd = $row->nm_skpd;
				
	// 			$sqdetail1="SELECT ifnull((sum(a.total)),0) as nilai1,ifnull((SUM(a.jumlah)),0) as jumlah1 FROM 
	// 						trd_planbrg a join trh_planbrg b on a.no_dokumen=b.no_dokumen and a.kd_uskpd=b.kd_uskpd WHERE a.kd_uskpd='$skpd' $lutji"; 
	// 			$hasil1   = $this->db->query($sqdetail1);
	// 			foreach ($hasil1->result() as $row)
	// 			{
	// 				$jml2	  = $row->jumlah1+$jml2;
	// 				$nilai2   = $row->nilai1+$nilai2;
	// 				$jml1 	  = $row->jumlah1;
	// 				$nilai1   = $row->nilai1;
	// 			}
				
	// 			if($iz=='1'){			
	// 				$cRet .="
	// 						<tr>
	// 							<td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$i</td>
	// 							<td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">$nm_skpd</td>
	// 							<td align=\"center\" style=\"font-size:12px; width=\"15%\" font-family:tahoma;\">".number_format($jml1,2,',','.')."</td>
	// 							<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">".number_format($nilai1,2,',','.')."</td>
	// 						</tr>";
	// 			$i++;}
	// 			elseif($iz<>'1'){
	// 				$cRet .="<tr>
	// 							<td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$i</td>
	// 							<td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">$nm_skpd</td>
	// 							<td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">$jml1</td>
	// 							<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\">$nilai1</td>
	// 						</tr>";
	// 			$i++;}
 //            }
	// 				$cRet .="<tr>
	// 							<td colspan=\"2\" align=\"center\" style=\"font-size:12px; font-family:tahoma;\"><b>TOTAL</b></td>
	// 							<td align=\"center\" style=\"font-size:12px; font-family:tahoma;\"><b>".number_format($jml2,2,',','.')."</b></td>
	// 							<td align=\"right\" style=\"font-size:12px; font-family:tahoma;\"><b>".number_format($nilai2,2,',','.')."</b></td>
	// 						</tr>";
	// 		$cRet .="</table>";
	// 		$cRet .="
 //             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
	// 		<tr><td colspan=\"4\"></td></tr>
	// 		<tr><td colspan=\"4\"></td></tr>
	// 		<tr><td colspan=\"4\"></td></tr>
	// 		<tr><td colspan=\"4\"></td></tr>
	// 		<tr><td colspan=\"4\"></td></tr>
	// 		<tr>
	// 			<td colspan=\"3\"></td>
	// 			<td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"><b>$kota, $lctgl2</b></td>
	// 			<td></td>
	// 		</tr>";
			
	// 	$cRet .="</table>";
 //        $data['prev']= $cRet;
	// 	$kertas='LEGAL';  
 //        $judul  = 'Laporan Rekap RKBU';
 //        $this->template->set('title', 'Laporan Rekap RKBU');  
 //        switch($iz) {
 //        case 1;
 //            $this->_mpdfaiz('',$cRet,'10','10',12,'1');
 //        break;
 //        case 2;        
 //            header("Cache-Control: no-cache, no-store, must-revalidate");
 //            header("Content-Type: application/vnd.ms-excel");
 //            header("Content-Disposition: attachment; filename= $judul.xls");
            
 //            $this->load->view('transaksi/excel', $data);
 //        break;
 //        case 3;     
 //            header("Cache-Control: no-cache, no-store, must-revalidate");
 //            header("Content-Type: application/vnd.ms-word");
 //            header("Content-Disposition: attachment; filename= $judul.doc");
 //           $this->load->view('transaksi/excel', $data);
 //        break;
 //        }   
         
	// 	 } 
 //    }
	
	function lap_daftar_mutasi(){
          if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$konfig		= $this->ambil_config();
		$nmkab		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$thn  		= $this->session->userdata('ta_simbakda');
		$unit_skpd  = $this->session->userdata('unit_skpd');
		$tah  		= $this->session->userdata('ta_simbakda');
		$cbid 		= $_REQUEST['cbid'];
		$cnm_bid 	= $_REQUEST['cnm_bid'];
		$lctahu 	= $_REQUEST['lctahu'];
		$lcbend 	= $_REQUEST['lcbend'];
		$cnmbend 	= $_REQUEST['cnmbend'];
		$cnmtahu 	= $_REQUEST['cnmtahu'];
		$lctgl2 	= $this->tanggal_indonesia($_REQUEST['lctgl2']);
		$iz	 		= $_REQUEST['fa'];
          
		  $cRet = "<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          $cRet .="
            
            <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px;border: solid 1px white;\"><B>KARTU INVENTARIS BARANG (KIB) A<br>TANAH</B></td>
            </tr><BR/><BR/><BR/>";
            
          $cRet .="
            <tr>
                        <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\" width =\"15%\" >&ensp;SKPD</td>
                        <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">:<B> $cnm_bid</B></td>
            </tr>
			<tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Kota</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $kota</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">&ensp;Provinsi</td>
                <td align=\"left\" style=\"font-size:12px; font-family:tahoma;\">: $nmkab</td>
            </tr>";
                    
             $cRet .="
            </table>
            
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td align=\"left\" colspan=\"14\" style=\"font-size:12px;border: solid 1px white;border-bottom:solid 1px black;\">&ensp;</td>
            </tr>
            </thead>
            <tr>
                <td align=\"center\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">No</td>
                <td align=\"center\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Jenis Barang/<br>Nama Barang</td>
                <td align=\"center\" colspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
                <td align=\"center\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Luas(m2)</td>
                <td align=\"center\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Tahun</td>
                <td align=\"center\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Letak / Alamat</td>
                <td align=\"center\" colspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Status Tanah</td>
                <td align=\"center\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Penggunaan</td>
                <td align=\"center\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Asal Usul</td>
                <td align=\"center\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Harga</td>
                <td align=\"center\" rowspan=\"3\" style=\"font-size:12px; font-family:tahoma;\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Kode Barang</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Register</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Hak</td>
                <td align=\"center\" colspan=\"2\" style=\"font-size:12px; font-family:tahoma;\">Sertifikat</td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\" style=\"font-size:12px; font-family:tahoma;\">Nomor</td>
            </tr>
            <tr>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"3%\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">12</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">13</td>
                <td align=\"center\" bgcolor=\"#a2c8fb\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">14</td>
            </tr>";
			
                    $csql = "SELECT b.nm_brg,a.kd_brg,a.no_reg,a.luas,a.tahun,a.alamat1,
							IF(status_tanah=1,'Hak Pakai','Hak Pengelola') AS hak,a.tgl_sertifikat,
							a.no_sertifikat,a.penggunaan,a.asal,a.nilai,a.keterangan FROM 
							trkib_a a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
							WHERE a.kd_unit = '$cbid' GROUP BY kd_brg,nilai ORDER BY a.kd_brg";
                
             $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {
                $i++;
                $cRet .="
                <tr>
                    <td valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
                    <td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->no_reg</td>
                    <td valign=\"top\" align=\"center\" width =\"3%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->luas)."</td>
                    <td valign=\"top\" align=\"center\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->alamat1</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->hak</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->tgl_sertifikat</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->no_sertifikat</td>
                    <td valign=\"top\" align=\"left\" width =\"10%\" style=\"font-size:11px; font-family:tahoma;\">$row->penggunaan</td>
                    <td valign=\"top\" align=\"left\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>
                    <td valign=\"top\" align=\"right\" width =\"5%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nilai)."</td>
                    <td valign=\"top\" align=\"left\" width =\"15%\" style=\"font-size:11px; font-family:tahoma;\">$row->keterangan</td>
                </tr>
				";
            }
			  $where = "where kd_unit='$cbid'";
			  $cquery = "select sum(nilai) as fa from trkib_a $where";
			  $cquery1= $this->db->query($cquery);
			  foreach ($cquery1->result() as $faiz)
			  { 
            $cRet .="
			<tr>
				<td colspan=\"12\" bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:12px; font-family:tahoma;\">Jumlah</td>
				<td valign=\"top\" bgcolor=\"#fce5e7\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\">".number_format($faiz->fa)."</td>
				<td bgcolor=\"#fce5e7\" valign=\"top\" align=\"center\" width =\"2%\" style=\"font-size:11px; font-family:tahoma;\"></td>
			</tr>
			</table>";}
			$cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
				<td align=\"center\" colspan=\"7\" style=\"font-size:10px; font-family:tahoma;\"></td>
			</tr>
				<br/><br/>
			<tr>
				<td colspan=\"5\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$kota, $lctgl2</td>
			</tr>
			<tr>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;MENGETAHUI</td>
				<td colspan=\"2\"></td>
				<td colspan=\"3\"></td>
			</tr>
				<Tr></Tr><Tr></Tr>
			<tr>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;KEPALA $cnm_bid</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">PENGURUS BARANG</td>			
			</tr>
			<tr>
				<td align=\"center\" colspan=\"7\" style=\"font-size:11px; font-family:tahoma;\" height=\"50\"></td>
			</tr>
			<tr>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;(<u> $cnmtahu </u>)</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">(<u> $cnmbend </u>)</td>
			</tr>
			<tr>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;&ensp;&ensp;&ensp;&ensp;NIP. $lctahu</td>
				<td colspan=\"2\"></td>
				<td colspan=\"2\"></td>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">&ensp;NIP. $lcbend</td>
			</tr>";
			
		$cRet .=       " </table>";
        $data['prev']= $cRet;
		$kertas='LEGAL';  
        $judul  = 'Laporan KIB A';
        $this->template->set('title', 'Laporan KIB A');  
        switch($iz) {
        case 1;
		 $this->mdata->_mpdf3('',$cRet,4,4,12,'L',$kertas,3);
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
    

	function lap_buku_invent(){
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
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px; \">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
				<th width =\"60%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">REKAPITULASI BUKU INVENTARIS BARANG<br>MILIK PEMERINTAH $kota<br>PER TANGGAL ".$this->tanggal_indonesia($lctgl)."<br><b>TAHUN $thn</b></th>
				<td width=\"10%\"align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";
			if($cskpd<>''){
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $cnm_skpd</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";}
			if($cuskpd<>''){
				$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;UNIT</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $cnm_uskpd</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";}
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">No Urut</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Gol</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Kode<br>Bidang<br>Barang</td>
                <td width=\"30%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nama <br>Bidang Barang</td>
                <td width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Barang</td>
                <td width=\"40%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Jumlah Harga<br>(Rp)</td>
                <td width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Keterangan</td>
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
		$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit 
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
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
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
		$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $jml2 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $hrg2 = $row->nilai;
			 }
		}
			
		if ($ckode=='03'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $jml3 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $hrg3 = $row->nilai;
			 }
			
		}
			
		if ($ckode=='04'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $jml4 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $hrg4 = $row->nilai;
			 }
		}
			
		if ($ckode=='05'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah = $row->jumlah;
             $jml5 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $hrg5 = $row->nilai;
			 }
		}
			
		if ($ckode=='06'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah  = $row->jumlah;
             $jml6 = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga = $row->nilai;
             $hrg6 = $row->nilai;
			 }
			
			$jml 	=  $jml1+$jml2+$jml3+$jml4+$jml5+$jml6;
			$hrgx 	=  $hrg1+$hrg2+$hrg3+$hrg4+$hrg5+$hrg6;
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
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$no</b></td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$gol</b></td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$kode</b></td>
                        <td bgcolor=\"#80FE80\" align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$cnama</b></td>
                        <td bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#80FE80\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($charga)."</b></td>
                        <td align=\"right\" style=\"font-size:10px\"></td>
        		</tr>";}		
			elseif($iz<>'1'){
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$no</b></td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$gol</b></td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$kode</b></td>
                        <td bgcolor=\"#80FE80\" align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$cnama</b></td>
                        <td bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#80FE80\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>$charga</b></td>
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
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah2 = $row->jumlah;
			}
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
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
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
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
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
		AND (no_mutasi IS NULL OR no_mutasi='' OR tgl_mutasi>='$sampai_tgl') 
		AND (no_pindah IS NULL OR no_pindah='' OR tgl_pindah>='$sampai_tgl') 
		AND (no_hapus IS NULL OR no_hapus='' OR tgl_hapus>='$sampai_tgl')  
		AND (tgl_riwayat>='$sampai_tgl' OR kd_riwayat IS NULL OR kd_riwayat='' OR kd_riwayat='9')";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit AND tgl_reg<='$sampai_tgl' 
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
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$kode2</td>
                        <td align=\"left\" 	 style=\"font-size:10px;font-family: tahoma;\">$cnama2</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$cjumlah2</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">".number_format($charga2)."</td>
                        <td align=\"right\"  style=\"font-size:10px\"></td>
					</tr>
        			";}
			elseif($iz<>'1'){
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$kode2</td>
                        <td align=\"left\" 	 style=\"font-size:10px;font-family: tahoma;\">$cnama2</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$cjumlah2</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">$charga2</td>
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
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jml</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>Rp. ".number_format($hrgx)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
			</tr>";
		   }elseif($iz<>'1'){
			$cRet .="<tr>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jml</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>Rp. $hrgx</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
			</tr>";
		   }
		   
		   
            $cRet .="</table>";
           
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
		
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\"></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Mengetahui,<br>Kepala SKPD<br><br><br><br></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Pengurus Barang<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">(<u>$lctahu</u>)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">(<u>$lcbend</u>)</td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nip. $cnmtahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nip. $cnmbend</td>					
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
    
function lap_buku_mutasi(){
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
		$lctgl	 	= $_REQUEST['lctgl2'];
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
				<td  width=\"20%\" align=\"center\" style=\"font-size:11px;\">
				<img src=\"".FCPATH."/data/100.jpg\" width=\"70px\" height=\"70px\" alt=\"\" /></td>
				<th width =\"80%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">REKAPITULASI DAFTAR MUTASI BARANG<br>MILIK PEMERINTAH KOTA $kota<br><b>TAHUN $thn</b></th>
				<td width=\"10%\"align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";
			if($cskpd){
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;SKPD</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $cnm_skpd</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";}
			if($cuskpd){
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;UNIT</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $cnm_uskpd</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>";}
			$cRet .= "<tr>
                <td width =\"10%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">&ensp;KOTA</td>
                <td width =\"80%\" align=\"left\" style=\"font-size:12px;font-family: tahoma;\">: $kota</td>
				<td width =\"10%\" align=\"left\" style=\"font-size:12px;\"></td>
            </tr>
            </table><br/>
			
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
			<tr>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">NO URUT</td>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">GOL</td>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">KODE<br>BIDANG<br>BARANG</td>
                <td rowspan=\"3\" width=\"30%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">NAMA <br>BIDANG BARANG</td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">KEADAAN PER <br>".$this->tanggal_indonesia($tgl_awal)."</td>
				<td colspan=\"4\" width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">MUTASI PERUBAHAN SELAMA<br>".$this->tanggal_indonesia($tgl_awal)." S/D ".$this->tanggal_indonesia($tgl_akhir)."</td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">KEADAAN PER <br>".$this->tanggal_indonesia($tgl_akhir)."</td>
                <td rowspan=\"3\" width=\"5%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">KET</td>
			</tr>
			<tr>	
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">JUMLAH BARANG</td>
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">JUMLAH HARGA </td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">BERKURANG</td>
				<td colspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">BERTAMBAH</td>
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">JUMLAH BARANG <br>(5-7+9)</td>
				<td rowspan=\"2\" width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">JUMLAH HARGA  <br>(6-8+10)</td>
            </tr>
			<tr>	
				<td width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">JUMLAH BARANG</td>
				<td width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">JUMLAH HARGA </td>
				<td width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">JUMLAH BARANG</td>
				<td width=\"10%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">JUMLAH HARGA </td>
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
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml1 = $row->jumlah;
				 
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_a WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg1 = $row->nilai;
				 }
			}
			
			if ($ckode=='02'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml2 = $row->jumlah;
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg2 = $row->nilai;
				 }
			}
			
			if ($ckode=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml3 = $row->jumlah;
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg3 = $row->nilai;
				 }
				
			}
			
			if ($ckode=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml4 = $row->jumlah;
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_d WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg4 = $row->nilai;
				 }
			}
			
			if ($ckode=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml5 = $row->jumlah;
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
				$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $charga = $row->nilai;
				 $hrg5 = $row->nilai;
				 }
			}
			
			if ($ckode=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
				 
				 foreach ($hasil->result() as $row){
				 $cjumlah = $row->jumlah;
				 $jml6 = $row->jumlah;
				 }
				
				$csql = "SELECT sum(nilai) as nilai FROM trkib_f WHERE left(kd_brg,2)='$ckode' and tgl_reg <='$tgl_awal' $skpd $unit";
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
		$csql = "SELECT count(no_hapus) as jumlah FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah1x = $row->jumlah;
			 
			 }
			
			$csql = "SELECT sum(no_hapus) as nilai FROM trkib_a WHERE left(kd_brg,2)='$ckode' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga1x = $row->nilai;
			 }
		}
			
		if ($ckode=='02'){
		$csql = "SELECT count(no_hapus) as jumlah FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah2x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(no_hapus) as nilai FROM trkib_b WHERE left(kd_brg,2)='$ckode' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga2x = $row->nilai;
			 }
		}
			
		if ($ckode=='03'){
		$csql = "SELECT count(no_hapus) as jumlah FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah3x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(no_hapus) as nilai FROM trkib_c WHERE left(kd_brg,2)='$ckode' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga3x = $row->nilai;
			 }
			
		}
			
		if ($ckode=='04'){
		$csql = "SELECT count(no_hapus) as jumlah FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah4x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(no_hapus) as nilai FROM trkib_d WHERE left(kd_brg,2)='$ckode' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga4x = $row->nilai;
			 }
		}
			
		if ($ckode=='05'){
		$csql = "SELECT count(no_hapus) as jumlah FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah5x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(no_hapus) as nilai FROM trkib_e WHERE left(kd_brg,2)='$ckode' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargax = $row->nilai;
             $charga5x = $row->nilai;
			 }
		}
			
		if ($ckode=='06'){
		$csql = "SELECT count(no_hapus) as jumlah FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahx = $row->jumlah;
             $cjumlah6x = $row->jumlah;
			 }
			
			$csql = "SELECT sum(no_hapus) as nilai FROM trkib_f WHERE left(kd_brg,2)='$ckode' $skpd $unit";
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
		$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah1xx = $row->jumlah;
			 
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_a WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga1xx = $row->nilai;
			 }
		}
			
		if ($ckode=='02'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah2xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_b WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga2xx = $row->nilai;
			 }
		}
			
		if ($ckode=='03'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah3xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_c WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga3xx = $row->nilai;
			 }
			
		}
			
		if ($ckode=='04'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah4xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_d WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga4xx = $row->nilai;
			 }
		}
			
		if ($ckode=='05'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah5xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_e WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $chargaxx = $row->nilai;
             $charga5xx = $row->nilai;
			 }
		}
			
		if ($ckode=='06'){
		$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
		$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlahxx = $row->jumlah;
             $cjumlah6xx = $row->jumlah;
			 }
			
			$csql = "SELECT sum(nilai) as nilai FROM trkib_f WHERE left(kd_brg,2)='$ckode' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
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
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$no</b></td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$gol</b></td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$kode</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$cnama</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($charga)."</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlahx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($chargax)."</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlahxx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($chargaxx)."</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmlxxxz</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>".number_format($hargaxxxxz)."</b></td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
					</tr>";}		
			elseif($iz<>'1'){
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$no</b></td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$gol</b></td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$kode</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"left\" style=\"font-size:10px;font-family: tahoma;\"><b>$cnama</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlah</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>$charga</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlahx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>$chargax</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$cjumlahxx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>$chargaxx</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmlxxxz</b></td>
                        <td bgcolor=\"#CCCCCC\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>$hargaxxxxz</b></td>
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
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah2 = $row->jumlah;
			}
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_a WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}					
		}
			
		if ($ckodex=='02'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga2 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_d WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			
			}
			
			if ($ckodex=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah2 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_f WHERE left(kd_brg,5)='$ckode2' and tgl_reg<='$tgl_awal' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga2 = $row->nilai;
			 }
			}
			
			
			/*START BERKURANG*/
			$cjumlah3=0;
			$charga3=0;
			
		if ($ckodex=='01'){
			$csql = "SELECT count(no_hapus) as jumlah FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah3 = $row->jumlah;
			}
			$csql = "SELECt ifnull (sum(no_hapus),0) as nilai FROM trkib_a WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $charga3 = $row->nilai;
			}					
		}
			
		if ($ckodex=='02'){
			$ccsql = "SELECT count(no_hapus) as jumlah FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(no_hapus),0) as nilai FROM trkib_b WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga3 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(no_hapus) as jumlah FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(no_hapus),0) as nilai FROM trkib_c WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT count(no_hapus) as jumlah FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(no_hapus),0) as nilai FROM trkib_d WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			
			}
			
			if ($ckodex=='05'){
			$csql = "SELECT count(no_hapus) as jumlah FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(no_hapus),0) as nilai FROM trkib_e WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT count(no_hapus) as jumlah FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah3 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(no_hapus),0) as nilai FROM trkib_f WHERE left(kd_brg,5)='$ckode2' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga3 = $row->nilai;
			 }
			}			
			
			/*START BETAMBAH*/
			$cjumlah4=0;
			$charga4=0;
			
		if ($ckodex=='01'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_a WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
		  foreach ($hasil->result() as $row){
            $cjumlah4 = $row->jumlah;
			}
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_a WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
            $charga4 = $row->nilai;
			}					
		}
			
		if ($ckodex=='02'){
			$ccsql = "SELECT count(nilai) as jumlah FROM trkib_b WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($ccsql);
		  foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			}
			$ccsql = "SELECT ifnull (sum(nilai),0) as nilai FROM trkib_b WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($ccsql);
			foreach ($hasil->result() as $row){
            $charga4 = $row->nilai;
			}
		}
			
		if ($ckodex=='03'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_c WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_c WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga4 = $row->nilai;
			 }
			}
			
			if ($ckodex=='04'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_d WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_d WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga4 = $row->nilai;
			 }
			
			}
			
			if ($ckodex=='05'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_e WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_e WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $charga4 = $row->nilai;
			 }
			}
			
				if ($ckodex=='06'){
			$csql = "SELECT count(nilai) as jumlah FROM trkib_f WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
			$hasil = $this->db->query($csql);
			 
			 foreach ($hasil->result() as $row){
             $cjumlah4 = $row->jumlah;
			 }
			
			$csql = "SELECt ifnull (sum(nilai),0) as nilai FROM trkib_f WHERE left(kd_brg,5)='$ckode2' and tgl_reg between '$tgl_awal' and '$tgl_akhir' $skpd $unit";
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
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$kode2</td>
                        <td align=\"left\" 	 style=\"font-size:10px;font-family: tahoma;\">$cnama2</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$cjumlah2</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">".number_format($charga2)."</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$cjumlah3</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">".number_format($charga3)."</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$cjumlah4</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">".number_format($charga4)."</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$cjumlah5</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">".number_format($charga5)."</td>
						<td align=\"right\" style=\"font-size:10px\">&nbsp; </td>
					</tr>
        			";}	elseif($iz<>'1') {
        	  $cRet .="	
                    <tr>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px\"></td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$kode2</td>
                        <td align=\"left\" 	 style=\"font-size:10px;font-family: tahoma;\">$cnama2</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$cjumlah2</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">$charga2</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$cjumlah3</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">$charga3</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$cjumlah4</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">$charga4</td>
                        <td align=\"center\" style=\"font-size:10px;font-family: tahoma;\">$cjumlah5</td>
                        <td align=\"right\"  style=\"font-size:10px;font-family: tahoma;\">$charga5</td>
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
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>Rp. ".number_format($hargax)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmlx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>Rp. ".number_format($hargaxx)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmlxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>Rp. ".number_format($hargaxxx)."</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$tot_jum</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>Rp. ".number_format($tot_har)."</b></td>
				<td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\">&nbsp; </td>
			</tr>";}
		elseif($iz<>'1') {
	$cRet .="<tr>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px\"></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jml</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>Rp. $hargax</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmlx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>Rp. $hargaxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$jmlxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>Rp. $hargaxxx</b></td>
                <td bgcolor=\"#FCED72\" align=\"center\" style=\"font-size:10px;font-family: tahoma;\"><b>$tot_jum</b></td>
                <td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px;font-family: tahoma;\"><b>Rp. $tot_har</b></td>
				<td bgcolor=\"#FCED72\" align=\"right\" style=\"font-size:10px\">&nbsp; </td>
			</tr>";}
		   
            $cRet .="</table><br/>";
           
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
					<br/>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;\"></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Mengetahui,<br>Kepala SKPD<br><br><br><br></td>
						<td width=\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Pengurus Barang<br><br><br><br></td>
					</tr>
					
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">(<u>$nm_tahu</u>)</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">(<u>$nm_bend</u>)</td>					
					</tr>
					<tr>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nip. $tahu</td>
						<td width =\"50%\" align=\"center\" style=\"font-size:12px;font-family: tahoma;\">Nip. $bend</td>					
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
	
    function lap_kib_e_hewan(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{ 
      	 $cnm_skpd = $_REQUEST['nm_skpd'];
        $cskpd = $_REQUEST['kd_skpd'];
        $cnm_skpd = $_REQUEST['nm_skpd'];
        $cbid = $_REQUEST['kd_bid'];
        $cnm_bid = $_REQUEST['nm_bid'];
        $lctahu = $_REQUEST['tahu'];
        $lcbend = $_REQUEST['bend'];
        $lctgl = $_REQUEST['tgl'];
        $cpilih = $_REQUEST['cpilih'];
        $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"2\" style=\"font-size:14px;\">KARTU INVENTARIS BARANG (KIB) E<br>ASSET TETAP LAINNYA</td>
            </tr>
            
            
            <tr>
                <td align=\"left\" width=\"15%\" style=\"font-size:12px;\">&ensp;Kabupaten / Kota</td>
                <td align=\"left\" width=\"85%\" style=\"font-size:12px;\">:</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px;\">&ensp;Kode Provinsi</td>
                <td align=\"left\" style=\"font-size:12px;\">:</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px;\">&ensp;Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px;\">:</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px;\">&ensp;Kode Satuan Kerja</td>
                <td align=\"left\" style=\"font-size:12px;\">:</td>
            </tr>
            
            <tr>
                <td align=\"left\" style=\"font-size:12px;border: solid 1px white;\">&ensp;Golongan Barang</td>
                <td align=\"left\" style=\"font-size:12px;border: solid 1px white;\">: 05</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px;border: solid 1px white;\">&ensp;Bidang Barang</td>
                <td align=\"left\" style=\"font-size:12px;border: solid 1px white;\">: 05.19</td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px;border: solid 1px white;\">&ensp;Nama Bidang Barang</td>
                <td align=\"left\" style=\"font-size:12px;border: solid 1px white;\">: Hewan Ternak dan Tumbuhan</td>
            </tr>
            <tr>
                <td align=\"left\"  colspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&ensp;</td>
            </tr>
            
            </table>
             <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">No</td>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nama Barang</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nomor</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Spesifikasi</td>
                <td colspan=\"4\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Quantity</td>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tahun Perolehan</td>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Asal Usul<br>Perolehan</td>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Kode Barang</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Register</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tipe</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jenis Kelamin</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah Barang</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Harga Satuan</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah Harga</td>
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
            </thead>
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"20%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"9%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"17\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>";
            switch  ($cpilih){
                case  1:
                    $csql = "SELECT (SELECT nm_brg FROM mbarang WHERE kd_brg = a.kd_brg) AS nm_barang, 
                            a.kd_brg,a.no_reg,a.cipta,a.tahun_terbit,a.penerbit,a.asal,a.jumlah,
                            (SELECT nm_satuan FROM msatuan WHERE kd_satuan=a.kd_satuan) AS satuan,
                            a.nilai DIV a.jumlah AS harga_sat,a.nilai,a.tahun,c.nm_sumberdana FROM 
                            trkib_e a INNER JOIN trd_isianbrg b ON a.no_dokumen = b.no_dokumen AND a.kd_brg = b.kd_brg 
                            LEFT JOIN mdana c ON b.s_dana = c.KD_SUMBERDANA  LEFT JOIN 
                            trh_isianbrg d ON b.no_dokumen = d.no_dokumen
                            WHERE d.kd_unit in(SELECT a.kd_uskpd FROM unit_skpd a LEFT JOIN 
                            mbidskpd b ON a.kd_bidskpd=b.kd_bidskpd
                            WHERE b.kd_skpd = '$cskpd') and left(a.kd_brg,4)='0519'";
                    break;
                case  2:
                    $csql = "SELECT (SELECT nm_brg FROM mbarang WHERE kd_brg = a.kd_brg) AS nm_barang, 
                            a.kd_brg,a.no_reg,a.cipta,a.tahun_terbit,a.penerbit,a.asal,a.jumlah,
                            (SELECT nm_satuan FROM msatuan WHERE kd_satuan=a.kd_satuan) AS satuan,
                            a.nilai DIV a.jumlah AS harga_sat,a.nilai,a.tahun,c.nm_sumberdana FROM 
                            trkib_e a INNER JOIN trd_isianbrg b ON a.no_dokumen = b.no_dokumen AND a.kd_brg = b.kd_brg 
                            LEFT JOIN mdana c ON b.s_dana = c.KD_SUMBERDANA  LEFT JOIN 
                            trh_isianbrg d ON b.no_dokumen = d.no_dokumen
                            WHERE d.kd_unit = '$cbid' and left(a.kd_brg,4)='0519'";
                    break;
                case  3:
                    $csql = "SELECT (SELECT nm_brg FROM mbarang WHERE kd_brg = a.kd_brg) AS nm_barang, 
                            a.kd_brg,a.no_reg,a.cipta,a.tahun_terbit,a.penerbit,a.asal,a.jumlah,
                            (SELECT nm_satuan FROM msatuan WHERE kd_satuan=a.kd_satuan) AS satuan,
                            a.nilai DIV a.jumlah AS harga_sat,a.nilai,a.tahun,c.nm_sumberdana FROM 
                            trkib_e a INNER JOIN trd_isianbrg b ON a.no_dokumen = b.no_dokumen AND a.kd_brg = b.kd_brg 
                            LEFT JOIN mdana c ON b.s_dana = c.KD_SUMBERDANA  LEFT JOIN 
                            trh_isianbrg d ON b.no_dokumen = d.no_dokumen  and left(a.kd_brg,4)='0519'";
                    break;
            }
            
            $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
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
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                </tr>";
            }
            
            $cRet .="</table>";
         
         $data['prev']= $cRet;    
         $this->_mpdf('',$cRet,'5','5',5,'1');  
         }
    }
    
     function lap_rkbu(){
        $this->mlap->lap_rkbu();
    }
	
	function lap_rkpbu(){
        $this->mlap->lap_rkpbu();
    }
	
	function lap_pb(){
        $this->mlap->lap_pb();
    }
	
	function lap_pengeluaran_barang(){
        $this->mlap->lap_pengeluaran_barang();
    }
	
	function lap_bbi(){
        $this->mlap->lap_bbi();
    }
	
	function lap_kb(){
        $this->mlap->lap_kb();
    }
		
	function lap_sbi(){
        $this->mlap->lap_sbi();
    }

	function lap_sbph(){
        $this->mlap->lap_sbph();
    }
	
	function lap_kir(){
        $this->mlap->lap_kir();
    }
	
	function lap_inventaris(){
        $this->mlap->lap_inventaris();
    }
	
	function lap_eca(){
        $this->mlap->lap_eca();
    }
	function lap_eca_rekap(){
        $this->mlap->lap_eca_rekap();
    }
	function lap_ecax(){
        $this->mlap->lap_ecax();
    }
	function lap_aset_lainnya2(){
        $this->mlap->lap_aset_lainnya2();
    }
	function lap_aset_lainnya2x(){
        $this->mlap->lap_aset_lainnya2x();
    }
	function lap_lainnya_rekap(){
        $this->mlap->lap_lainnya_rekap();
    }
	function lap_buku_inventaris(){
		$this->mlap->lap_buku_inventaris();
	}

	function lap_buku_inventaris2(){
		$this->mlap->lap_buku_inventaris2();
	}
			
	function lap_mutasi(){
		$this->mlap->lap_mutasi();
	}
	
	function lap_mutasi_barang(){
		$this->mlap->lap_mutasi_barang();
	}
	
	function lap_rkp_mutasi_barang(){
		$this->mlap->lap_rkp_mutasi_barang();
	}
	
	function lap_usulan_barang_hapus(){
		$this->mlap->lap_usulan_barang_hapus();
	}

  function lap_daftar_barang_hapus(){
    $this->mlap->lap_daftar_barang_hapus_dh();
  }

  function lap_usulan_barang_hapus_dh(){
    $this->mlap->lap_usulan_barang_hapus_dh();
  }
	
	function lap_pemeliharaan_barang(){
		$this->mlap->lap_pemeliharaan_barang();
	}
	
	function cetak_riwayat(){
		$this->mlap->cetak_riwayat();
	}
	function rencana_pengadaan(){
		$this->mlap->rencana_pengadaan();
	}
	
	function ctk_label(){
        $this->mlap->ctk_label();
    }
	/**FPDF**/
	/**PERJENIS KIB**/
	function kib_jenisb(){
        $this->mdata2->kib_jenisb();
    }
	function kib_jenisc(){
        $this->mdata2->kib_jenisc();
    }
	function kib_jenisd(){
        $this->mdata2->kib_jenisd();
    }
	function kib_jenise(){
        $this->mdata2->kib_jenise();
    }
	function kib_kibab(){
        $this->mdata2->kib_kibab();
    }
	/**END PERJENIS KIB**/
function header_fpdf(){

	$id           = $this->uri->segment(3);
	$cetak        = $this->uri->segment(4);
	$halaman_awal = $this->uri->segment($this->uri->total_segments());
	// legal = 21.59 x 35.56 // 215 x 355
	define('FPDF_FONTPATH', $this->config->item('fonts_path'));

	$this->load->library('fpdf');

	$this->fpdf->FPDF($orientation='L', $unit='mm', $size='LETTER');
	$this->fpdf->addPage();
	
	$this->fpdf->SetMargins($left = 10, $top = 10, $right = 10);


	// sisa panjang dalam = 215 - (10 + 10) = 195
	// $this->fpdf->SetFontSize(12);

		$this->fpdf->Setx(3.5);
		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(0.75,0.5,'','TLR',0,'C');
		$this->fpdf->Cell(4,0.5,'','TLR',0,'C');
		$this->fpdf->Cell(3.5,0.5,'','TLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'','TLR',0,'C');
		$this->fpdf->Cell(2.75,0.5,'PANGKAT','TLR',0,'C');
		$this->fpdf->Cell(5,0.5,'JABATAN','TLR',0,'C');
		$this->fpdf->Cell(1.5,0.5,'MASA','TLR',0,'C');
		$this->fpdf->Cell(6.5,0.5,'DIKLAT / KURSUS','TLR',0,'C');
		$this->fpdf->Cell(6.5,0.5,'PENDIDIKAN','TLR',0,'C');
		$this->fpdf->Cell(2,0.5,'TGL LAHIR','TLR',0,'C');
		$this->fpdf->Cell(4,0.5,'DATA','TLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'','TLR',0,'C');
		$this->fpdf->Cell(1,0.5,'','TLR',0,'C');
		$this->fpdf->Ln();
		
		$this->fpdf->Setx(3.5);
		$this->fpdf->Cell(0.75,0.5,'NO','LR',0,'C');
		$this->fpdf->Cell(4,0.5,'NAMA','LR',0,'C');
		$this->fpdf->Cell(3.5,0.5,'NIP','LR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'TMT','LR',0,'C');
		$this->fpdf->Cell(1,0.5,'Gol','TLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'TMT','TLR',0,'C');
		$this->fpdf->Cell(3.25,0.5,'NAMA','TLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'TMT','TLR',0,'C');
		$this->fpdf->Cell(1.5,0.5,'KERJA','BLR',0,'C');
		$this->fpdf->Cell(4.5,0.5,'','TLR',0,'C');
		$this->fpdf->Cell(1,0.5,'','TLR',0,'C');
		$this->fpdf->Cell(1,0.5,'JML','TLR',0,'C');
		$this->fpdf->Cell(3.5,0.5,'','TLR',0,'C');
		$this->fpdf->Cell(1,0.5,'LU','TLR',0,'C');
		$this->fpdf->Cell(2,0.5,'IJAZAH','TLR',0,'C');
		$this->fpdf->Cell(2,0.5,'USIA','LR',0,'C');
		$this->fpdf->Cell(4,0.5,'MUTASI UNIT','LR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'TMT','LR',0,'C');
		$this->fpdf->Cell(1,0.5,'KET.','LR',0,'C');
		$this->fpdf->Ln();

		$this->fpdf->Setx(3.5);
		$this->fpdf->Cell(0.75,0.5,'','BLR',0,'C');
		$this->fpdf->Cell(4,0.5,'','BLR',0,'C');
		$this->fpdf->Cell(3.5,0.5,'','BLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'CPNS','BLR',0,'C');
		$this->fpdf->Cell(1,0.5,'RNG','BLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'','BLR',0,'C');
		$this->fpdf->Cell(3.25,0.5,'','BLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'','BLR',0,'C');
		$this->fpdf->Cell(0.75,0.5,'THN','BLR',0,'C');
		$this->fpdf->Cell(0.75,0.5,'BLN','BLR',0,'C');
		$this->fpdf->Cell(4.5,0.5,'NAMA','BLR',0,'C');
		$this->fpdf->Cell(1,0.5,'THN','BLR',0,'C');
		$this->fpdf->Cell(1,0.5,'JAM','BLR',0,'C');
		$this->fpdf->Cell(3.5,0.5,'NAMA','BLR',0,'C');
		$this->fpdf->Cell(1,0.5,'LUS','BLR',0,'C');
		$this->fpdf->Cell(2,0.5,'JURUSAN','BLR',0,'C');
		$this->fpdf->Cell(2,0.5,'(THN)','BLR',0,'C');
		$this->fpdf->Cell(4,0.5,'PEGAWAI','BLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'PENSIUN','BLR',0,'C');
		$this->fpdf->Cell(1,0.5,'','BLR',0,'C');
		$this->fpdf->Ln();
		
		$this->fpdf->Setx(3.5);
		$this->fpdf->Cell(0.75,0.5,'1','TBLR',0,'C');
		$this->fpdf->Cell(4,0.5,'2','TBLR',0,'C');
		$this->fpdf->Cell(3.5,0.5,'3','TBLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'4','TBLR',0,'C');
		$this->fpdf->Cell(1,0.5,'5','TBLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'6','TBLR',0,'C');
		$this->fpdf->Cell(3.25,0.5,'7','TBLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'8','TBLR',0,'C');
		$this->fpdf->Cell(0.75,0.5,'9','TBLR',0,'C');
		$this->fpdf->Cell(0.75,0.5,'10','TBLR',0,'C');
		$this->fpdf->Cell(4.5,0.5,'11','TBLR',0,'C');
		$this->fpdf->Cell(1,0.5,'12','TBLR',0,'C');
		$this->fpdf->Cell(1,0.5,'13','TBLR',0,'C');
		$this->fpdf->Cell(3.5,0.5,'14','TBLR',0,'C');
		$this->fpdf->Cell(1,0.5,'15','TBLR',0,'C');
		$this->fpdf->Cell(2,0.5,'16','TBLR',0,'C');
		$this->fpdf->Cell(2,0.5,'17','TBLR',0,'C');
		$this->fpdf->Cell(4,0.5,'18','TBLR',0,'C');
		$this->fpdf->Cell(1.75,0.5,'19','TBLR',0,'C');
		$this->fpdf->Cell(1,0.5,'20','TBLR',0,'C');
		$this->fpdf->Ln();

		$this->fpdf->Setx(3.5);
		$this->fpdf->Cell(0.75,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(4,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(3.5,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(1.75,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(1,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(1.75,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(3.25,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(1.75,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(0.75,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(0.75,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(4.5,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(1,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(1,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(3.5,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(1,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(2,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(2,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(4,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(1.75,0.1,'','TLR',0,'C');
		$this->fpdf->Cell(1,0.1,'','TLR',0,'C');
		$this->fpdf->Ln();
		
	$this->fpdf->Output();
}
	
function preview_inventaris(){
		$konfig	 	= $this->ambil_config();
		$kota  		= strtoupper($konfig['kota']);
		$prov  		= strtoupper($konfig['nm_client']);
        $cskpd 		= $_REQUEST['kd_skpd'];
        //$mengetahui	= $_REQUEST['mengetahui'];
        $cnm_skpd 	= $_REQUEST['nm_skpd'];
        $lctahu 	= $_REQUEST['tahu'];
        $lcbend 	= $_REQUEST['bend'];
        $lctgl 		= $_REQUEST['tgl'];
		$iz	 		= $_REQUEST['fa'];
		$tahun	 	= $_REQUEST['tahun'];
		$th			= "";
        if($tahun<>''){
		$th			= "and a.tahun='$tahun'";		
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
	$this->fpdf->Cell($w = 340, $h = 7, $txt='BUKU INVENTARIS', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();

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
    
	$sql1="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,'-' AS merek,a.no_sertifikat AS gabung,'-' AS kd_bahan,
	a.asal,a.tahun,a.luas AS silinder,'-' kd_satuan,'-' AS kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai1,count(nilai) as jumlah1,LEFT(RTRIM(a.keterangan),25) AS keterangan 
	FROM trkib_a a left join mbarang b on a.kd_brg=b.kd_brg WHERE a.kd_skpd='$cskpd' $th GROUP BY b.nm_brg,a.kd_brg,a.luas,a.tahun,a.alamat1,
		a.status_tanah,a.tgl_sertifikat,a.no_sertifikat,a.penggunaan,a.asal,a.nilai,a.keterangan 
		ORDER BY tahun,kd_brg,no_reg";  
	  
    $query = $this->db->query($sql1);
	$this->fpdf->SetFont('helvetica','',9);  
	$height_table = 5;
	$i=1;
	$nilai1=0;
	$jumlah1=0;
    foreach ($query->result() as $row){
		$nilai1 = $row->nilai1+$nilai1;
		$jumlah1 = $row->jumlah1+$jumlah1;
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
	
	$sql1x="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,LEFT(RTRIM(a.merek),15) as merek,LEFT(RTRIM(CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin)),11) AS gabung,a.kd_bahan,
	a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai2,count(nilai) as jumlah2,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg  WHERE a.kd_skpd='$cskpd' $th GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.merek, a.silinder,a.tahun,a.kd_warna,
			a.kd_bahan,a.asal,a.pabrik,a.no_rangka,a.no_mesin,a.no_polisi,a.no_bpkb,a.nilai,a.keterangan
			ORDER BY tahun,kd_brg,no_reg";  
	  
    $query = $this->db->query($sql1x);
    

	$this->fpdf->SetFont('helvetica','',9);  
	$height_table = 5;
	$nilai2=0;
	$jumlah2=0;
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
	FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg  WHERE a.kd_skpd='$cskpd' $th 
	GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.kondisi,a.konstruksi,a.jenis_gedung,
			a.luas_lantai,a.alamat1,a.kd_tanah,a.tgl_dok,a.no_dok,a.luas_tanah,a.status_tanah,a.asal,a.nilai,a.keterangan 
			ORDER BY tahun,kd_brg,no_reg";  
	  
    $query = $this->db->query($sql1xx);
    

	$this->fpdf->SetFont('helvetica','',9);  
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
	
	$sql1xxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,a.panjang AS merek,a.luas AS gabung,'' AS kd_bahan,
	a.asal,a.tahun,a.lebar AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai4,count(nilai) as jumlah4,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_d a left join mbarang b on a.kd_brg=b.kd_brg  WHERE a.kd_skpd='$cskpd' $th 
	GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.tahun,a.konstruksi,a.panjang,
					a.lebar,a.luas,a.alamat1, a.nilai,a.kondisi,a.keterangan 
					ORDER BY tahun,kd_brg,no_reg";  
	  
    $query = $this->db->query($sql1xxx);
    

	$this->fpdf->SetFont('helvetica','',9);  
	$height_table = 5;
	$nilai4=0;
	$jumlah4=0;
    foreach ($query->result() as $row){
		$nilai4 = $row->nilai4+$nilai4;
		$jumlah4 = $row->jumlah4+$jumlah4;
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
	FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg  WHERE a.kd_skpd='$cskpd' $th 
	GROUP BY a.kd_unit,b.nm_brg,a.kd_brg,a.kd_bahan,a.jenis,a.tahun,a.tipe,a.nilai,a.keterangan  
			ORDER BY tahun,kd_brg,no_reg";  
	  
    $query = $this->db->query($sql1xxxx);
	$this->fpdf->SetFont('helvetica','',9);  
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
	
	$sql1xxxxx="SELECT a.kd_brg,IF(MAX(a.no_reg)=MIN(a.no_reg),a.no_reg,CONCAT(MIN(a.no_reg),'-',MAX(a.no_reg)))AS no_reg,LEFT(RTRIM(b.nm_brg),36) AS nm_brg,'' AS merek,a.luas AS gabung,'' AS kd_bahan,
	a.asal,a.tahun,'' AS silinder,'' AS kd_satuan,a.kondisi,COUNT(a.nilai) AS jumlah,IFNULL(SUM(a.nilai),0) AS nilai,sum(nilai) as nilai6,count(nilai) as jumlah6,LEFT(RTRIM(a.keterangan),25) AS keterangan
	FROM trkib_f a left join mbarang b on a.kd_brg=b.kd_brg  WHERE a.kd_skpd='$cskpd' $th 
	GROUP BY b.nm_brg,a.status_tanah,a.konstruksi,a.jenis,a.bangunan,a.kd_tanah,
		a.tahun,a.asal,a.nilai,a.keterangan,a.kd_brg
		ORDER BY a.tahun,a.kd_brg,no_reg";  
	  
    $query = $this->db->query($sql1xxxxx);
	$this->fpdf->SetFont('helvetica','',9);  
	$height_table = 5;
	$nilai6=0;
	$jumlah6=0;
    foreach ($query->result() as $row){
		$nilai6 = $row->nilai6+$nilai6;
		$jumlah6 = $row->jumlah6+$jumlah6;
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
	}
	$jumlahx = $jumlah1+$jumlah2+$jumlah3+$jumlah4+$jumlah5+$jumlah6;
	$totalx  = $nilai1+$nilai2+$nilai3+$nilai4+$nilai5+$nilai6;
	$totalxx = number_format($totalx,"2",".",",");
	$this->fpdf->Cell(263, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(10, 5, $jumlahx, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $totalxx, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(40, 5, $text='', $border=1, $ln=0, $align='L', $fill=false, $link='');

	$this->fpdf->Output();

}
	/*END FPDF*/	
	
    function lap_ada_brg(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
         
        $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" style=\"font-size:14px\">
                    DAFTAR PEGADAAN BARANG DAERAH<br>TAHUN ANGGARAN
                </td>            
            </tr>
            </table>
            <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
                <td colspan=\"2\" align=\"left\" style=\"font-size:10px;border: solid 1px white;\">SKPD</td>
                <td colspan=\"14\" align=\"left\" style=\"font-size:10px;border: solid 1px white;\">:</td>
            </tr>
            <tr>
                <td colspan=\"2\" align=\"left\" style=\"font-size:10px;border: solid 1px white;\">Jenis Barang Daerah</td>
                <td colspan=\"14\" align=\"left\" style=\"font-size:10px;border: solid 1px white;\">:</td>
            </tr>
            <tr>
                <td colspan=\"2\" align=\"left\" style=\"font-size:10px;border: solid 1px white;border-bottom:solid 1px black;\">&nbsp;</td>
                <td colspan=\"14\" align=\"left\" style=\"font-size:10px;border: solid 1px white;border-bottom:solid 1px black;\"></td>
            </tr>
            <tr>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">No</td>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Kode<br>Rekening</td>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Uraian Barang</td>
                <td colspan=\"3\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah</td>
                <td colspan=\"3\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Kontrak<br>(NOPES / SPK / SPP)</td>
                <td colspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">BAP</td>
                <td colspan=\"3\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">SP2D</td>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Rekanan</td>
                <td rowspan=\"2\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Keterangan</td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">jml</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Harga<br>Satuan</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah<br>Harga</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nomor</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nilai</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nomor</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nomor</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Tanggal</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nilai SP2D</td>
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
            </tr>
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"3%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>
            </thead>";
             for ($i = 1; $i <= 50; $i++) 
            {
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
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
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                </tr>";
            }
            
            $cRet .="</table>";
         
         $data['prev']= $cRet;    
         $this->_mpdf('',$cRet,'5','5',5,'1'); 
         } 
    }
    
    
    function lap_rekap_invent(){
         if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"1\">
            
            <tr>
                <td colspan=\"2\" align=\"left\" style=\"font-size:10px;border: solid 1px white;\">Provinsi</td>
                <td colspan=\"5\" align=\"left\" style=\"font-size:10px;border: solid 1px white;\">:</td>
            </tr>
            <tr>
                <td colspan=\"2\" align=\"left\" style=\"font-size:10px;border: solid 1px white;\">Kabupaten/Kota</td>
                <td colspan=\"5\" align=\"left\" style=\"font-size:10px;border: solid 1px white;\">:</td>
            </tr>
            <tr>
                <td colspan=\"2\" align=\"left\" style=\"font-size:10px;border: solid 1px white;\">Satuan Kerja</td>
                <td colspan=\"5\" align=\"left\" style=\"font-size:10px;border: solid 1px white;\">:</td>
            </tr>
            <tr>
                <td colspan=\"7\" align=\"left\" style=\"font-size:10px;border: solid 1px white;border-bottom:solid 1px black;\"></td>
            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">No</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Golongan</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Kode<br>Bidang<br>Barang</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Nama Bidang Barang</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah<br>Barang</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah<br>Harga<br>(Rp)</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Keterangan</td>
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
             <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"48%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; font-family:tahoma;\"></td>
            </tr>";
            
             for ($i = 1; $i <= 50; $i++) 
            {
                $cRet .="
                 <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                </tr>";
            }
            
            $cRet .="</table>";
         
         $data['prev']= $cRet;    
         $this->_mpdf('',$cRet,'5','5',5,'0');  
         }
    }
    
    function lap_jelas_aset(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
          $cRet =" <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
             <tr>
                <td align=\"center\" colspan=\"17\" style=\"font-size:12px;border: solid 1px white;\">PEMERINTAH PROPINSI</td>
            </tr>
            <tr>
                <td align=\"center\" colspan=\"17\" style=\"font-size:12px;border: solid 1px white;\">LAPORAN PENJELASAN ASET</td>
            </tr>
            <tr>
                <td align=\"left\" colspan=\"17\" style=\"font-size:12px;border: solid 1px white;border-bottom:solid 1px black;\">&ensp;</td>
            </tr>
           
            <tr>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:10px; font-family:tahoma;\">No</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:10px; font-family:tahoma;\">Nama SKPD</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:10px; font-family:tahoma;\">Neraca per 31<br>Desember</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:10px; font-family:tahoma;\">Asset</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:10px; font-family:tahoma;\">KDP</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:10px; font-family:tahoma;\">Hibah/<br>Persediaan</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:10px; font-family:tahoma;\">Total<br>Belanja<br>Modal</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:10px; font-family:tahoma;\">Neraca<br>Saldo</td>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px; font-family:tahoma;\">PENAMBAHAN</td>
                <td align=\"center\" colspan=\"3\" style=\"font-size:10px; font-family:tahoma;\">PENGURANGAN</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:10px; font-family:tahoma;\">Penambahan-<br>Pengurangan</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:10px; font-family:tahoma;\">Neraca per 31<br>Desember</td>
                <td align=\"center\" rowspan=\"2\" style=\"font-size:10px; font-family:tahoma;\">Keterangan</td>
            </tr>
            
            <tr>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">KDP jadi <br>Asset</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Selisi lain2</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumalah</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">KDP</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Selisih</td>
                <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">Jumlah</td>
            </tr>
            
            
            <tr>
                <td align=\"center\" width =\"2%\" style=\"font-size:10px; font-family:tahoma;\">1</td>
                <td align=\"center\" width =\"15%\" style=\"font-size:10px; font-family:tahoma;\">2</td>
                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">3</td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">4</td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">5</td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">6</td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">7</td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">8</td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">9</td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">10</td>
                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">11</td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">12</td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">13</td>
                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">14</td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">15</td>
                <td align=\"center\" width =\"7%\" style=\"font-size:10px; font-family:tahoma;\">16</td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; font-family:tahoma;\">17</td>
            </tr>
             </thead>";
             
             $csql="SELECT kd_skpd,nm_skpd FROM mskpd";
             
             $hasil = $this->db->query($csql);
             $i = 0;
             foreach ($hasil->result() as $row)
             {
                $i++;
               $cRet .=" <tr>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\">$i</td>
                    <td align=\"left\" style=\"font-size:10px; font-family:tahoma;\">$row->nm_skpd</td>
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
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                </tr>";
            }

            $cRet .="</table>";
         
         $data['prev']= $cRet;    
         $this->_mpdf('',$cRet,'5','5',5,'1');
         }  
    }
 /*LAPORAN PENCARIAN*/
 
 function lap_kib_cari(){
	
		$konfig		= $this->ambil_config();
		$prov		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
		$oto		= $this->session->userdata('otori');
		
		$jabatan1	= strtoupper($_REQUEST['jabatan1']);
		$jabatan2	= strtoupper($_REQUEST['jabatan2']);
		$tahun 		= $_REQUEST['tahun'];
		$tahun2		= $_REQUEST['tahun2'];
		$skpd		= $_REQUEST['skpd'];
		$kriteria 	= $_REQUEST['cari'];
		$gol	 	= $_REQUEST['gol'];
		$judul 		= strtoupper($_REQUEST['judul']);
		$nmpenggu	= strtoupper($_REQUEST['nmpenggu']);
		$nippenggu 	= $_REQUEST['nippenggu'];
		$nmpengu 	= strtoupper($_REQUEST['nmpengu']);
		$nippengu	= $_REQUEST['nippengu'];
		$lctgl	 	= $_REQUEST['lctgl'];
		$where1 	= '';       
        if($tahun2 == ''){ 
            $where1 = "where a.kd_skpd like '%$skpd%' and a.tahun like '%$tahun%' and b.nm_brg like '%$kriteria%'";
        }else{
            $where1 = "where a.kd_skpd like '%$skpd%' and b.nm_brg like '%$kriteria%' AND a.tahun>='$tahun' AND a.tahun<='$tahun2'";
        } 
 
	$id           = $this->uri->segment(3);
	$cetak        = $this->uri->segment(4);
	$halaman_awal = $this->uri->segment($this->uri->total_segments());
	// legal = 21.59 x 35.56 // 215 x 355
	define('FPDF_FONTPATH', $this->config->item('fonts_path'));

	$this->load->library('fpdf');
	
	$this->fpdf->Footer();
	$this->fpdf->SetFillColor(34,0,538);
	$this->fpdf->FPDF($orientation='L', $unit='mm', $size='LEGAL');
	$this->fpdf->addPage();
	
	$this->fpdf->SetMargins($left = 10, $top = 10, $right = 10);


	// sisa panjang dalam = 215 - (10 + 10) = 195
	// $this->fpdf->SetFontSize(12);
	if ($judul==''){
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 335, $h = 7, $txt='CETAK HASIL PENCARIAN', $border=0, $ln=0, $align='C', $fill=false, $link='');

	}elseif($judul<>''){
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell($w = 335, $h = 7, $judul, $border=0, $ln=0, $align='C', $fill=false, $link='');

	}
	
	$this->fpdf->Ln();

	$this->fpdf->SetFont('helvetica','B',10);
	$this->fpdf->Cell($w = 50, $h = 5, $txt='KABUPATEN/KOTA ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, $txt=': MAKASSAR', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	
	$this->fpdf->Cell($w = 50, $h = 5, $txt='PROVINSI ', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell($w = 70, $h = 5, $txt=': SULAWESI SELATAN', $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Ln();

	$height_table  = 7;
	$width_no_urut = 30;
	$width_rek     = 115;
	$width_nilai   = 15;
	
	$this->fpdf->SetFont('helvetica','B',9);
	$this->fpdf->Cell(15, $height_table, $txt='NO', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, $height_table, $txt='KODE BARANG', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, $height_table, $txt='KODE SKPD', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, $height_table, $txt='NAMA BARANG', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, $height_table, $txt='MERK/TYPE', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(35, $height_table, $txt='SPESIFIKASI', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, $height_table, $txt='BAHAN', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(25, $height_table, $txt='ASAL', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, $height_table, $txt='KONDISI', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, $height_table, $txt='TAHUN', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, $height_table, $txt='JUMLAH', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, $height_table, $txt='HARGA', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(43, $height_table, $txt='KET', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();

	$this->fpdf->Cell(15, 5, $txt='1', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $txt='2', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $txt='3', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $txt='4', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='5', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(35, 5, $txt='6', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $txt='7', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(25, 5, $txt='8', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $txt='9', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $txt='10', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $txt='11', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $txt='12', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(43, 5, $txt='13', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	
	if($gol=='01'){
    $sql1x="SELECT distinct b.kd_skpd,a.nm_skpd from ms_skpd a inner join trkib_a b on a.kd_skpd=b.kd_skpd LEFT JOIN mbarang c ON b.kd_brg=c.kd_brg WHERE c.nm_brg LIKE '%$kriteria%'";  
    $query = $this->db->query($sql1x);
	
	}
		if($gol=='02'){
    $sql1x="SELECT distinct b.kd_skpd,a.nm_skpd from ms_skpd a inner join trkib_b b on a.kd_skpd=b.kd_skpd LEFT JOIN mbarang c ON b.kd_brg=c.kd_brg WHERE c.nm_brg LIKE '%$kriteria%'";  
    $query = $this->db->query($sql1x);
	
	}
		if($gol=='03'){
    $sql1x="SELECT distinct b.kd_skpd,a.nm_skpd from ms_skpd a inner join trkib_c b on a.kd_skpd=b.kd_skpd LEFT JOIN mbarang c ON b.kd_brg=c.kd_brg WHERE c.nm_brg LIKE '%$kriteria%'";  
    $query = $this->db->query($sql1x);
	
	}
		if($gol=='04'){
    $sql1x="SELECT distinct b.kd_skpd,a.nm_skpd from ms_skpd a inner join trkib_d b on a.kd_skpd=b.kd_skpd LEFT JOIN mbarang c ON b.kd_brg=c.kd_brg WHERE c.nm_brg LIKE '%$kriteria%'";  
    $query = $this->db->query($sql1x);
	
	}
		if($gol=='05'){
    $sql1x="SELECT distinct b.kd_skpd,a.nm_skpd from ms_skpd a inner join trkib_e b on a.kd_skpd=b.kd_skpd LEFT JOIN mbarang c ON b.kd_brg=c.kd_brg WHERE c.nm_brg LIKE '%$kriteria%'";  
    $query = $this->db->query($sql1x);
	
	}
		if($gol=='06'){
    $sql1x="SELECT distinct b.kd_skpd,a.nm_skpd from ms_skpd a inner join trkib_f b on a.kd_skpd=b.kd_skpd LEFT JOIN mbarang c ON b.kd_brg=c.kd_brg WHERE c.nm_brg LIKE '%$kriteria%'";  
    $query = $this->db->query($sql1x);
	
	}
	
	$nilai1=0;
	$jumlah1=0;
	$i=1;
	foreach ($query->result() as $row){
		$kd_skpd 	= $row->kd_skpd;
		$nm_skpd 	= $row->nm_skpd;
		
	if($gol=='01'){
	$this->fpdf->SetFont('helvetica','B',11);
	$this->fpdf->Cell(38, 5, $kd_skpd, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(297, 5, $nm_skpd, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$sql1="SELECT a.kd_brg,left(rtrim(b.nm_brg),34) as nm_brg,'' AS merek,a.no_sertifikat AS gabung,'' AS kd_bahan,a.kd_skpd,
	left(rtrim(a.asal),12) as asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,left(rtrim(a.keterangan),20) as keterangan
	FROM trkib_a a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg $where1 and a.kd_skpd= '$kd_skpd'"; 
		
	$query = $this->db->query($sql1);
	$this->fpdf->SetFont('helvetica','',9);  
	$height_table = 5;
    foreach ($query->result() as $row){
		$nilai1 	= $row->nilai+$nilai1;
		$jumlah1 	= $row->jumlah+$jumlah1;
		$kd_brg 	= $row->kd_brg;
        $nm_brg 	= $row->nm_brg;
        $merek  	= $row->merek;
        $gabung 	= $row->gabung;
        $kd_bahan 	= $row->kd_bahan;
		$kd_skpd 	= $row->kd_skpd;
        $asal 		= $row->asal;
        $tahun 		= $row->tahun;
        $kondisi 	= $row->kondisi;
        $jumlah 	= $row->jumlah;
		$nilai  	= number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
	$this->fpdf->SetFillColor(120,255,121);
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $kd_skpd , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(35, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(25, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(43, 5, $keterangan, $border=1, $ln=0, $align='L', $fill=false, $link='');

		$i++;
		$this->fpdf->Ln();
		}

	}		
 
	elseif($gol=='02'){
	$this->fpdf->SetFont('helvetica','B',11);
	$this->fpdf->Cell(38, 5, $kd_skpd, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(297, 5, $nm_skpd, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$sql1="SELECT a.kd_brg,left(rtrim(b.nm_brg),34) as nm_brg,left(rtrim(a.merek),10) as merek,left(rtrim(a.no_mesin),16) AS gabung,left(rtrim(a.kd_bahan),11) as kd_bahan,a.kd_skpd,
	left(rtrim(a.asal),12) as asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,left(rtrim(a.keterangan),20) as keterangan  
	FROM trkib_b a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg $where1 and a.kd_skpd= '$kd_skpd'";  
	$query = $this->db->query($sql1);
	$this->fpdf->SetFont('helvetica','',9);  
	$height_table = 5;
    foreach ($query->result() as $row){
		$nilai1 	= $row->nilai+$nilai1;
		$jumlah1 	= $row->jumlah+$jumlah1;
		$kd_brg 	= $row->kd_brg;
        $nm_brg 	= $row->nm_brg;
        $merek  	= $row->merek;
        $gabung 	= $row->gabung;
        $kd_bahan 	= $row->kd_bahan;
		$kd_skpd 	= $row->kd_skpd;
        $asal 		= $row->asal;
        $tahun 		= $row->tahun;
        $kondisi 	= $row->kondisi;
        $jumlah 	= $row->jumlah;
		$nilai  	= number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $kd_skpd , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(35, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(25, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(43, 5, $keterangan, $border=1, $ln=0, $align='L', $fill=false, $link='');

		$i++;
		$this->fpdf->Ln();
		}
	  }
	  
	  elseif($gol=='03'){
	$this->fpdf->SetFont('helvetica','B',11);
	$this->fpdf->Cell(38, 5, $kd_skpd, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(297, 5, $nm_skpd, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$sql1="SELECT a.kd_brg,left(rtrim(b.nm_brg),34) as nm_brg,a.luas_tanah AS merek,a.luas_lantai AS gabung,a.jenis_gedung AS kd_bahan,a.kd_skpd,
	left(rtrim(a.asal),12) as asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,left(rtrim(a.keterangan),20) as keterangan  
	FROM trkib_c a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg $where1 and a.kd_skpd= '$kd_skpd'";  
	  
	$query = $this->db->query($sql1);
	$this->fpdf->SetFont('helvetica','',9);  
	$height_table = 5;
    foreach ($query->result() as $row){
		$nilai1 	= $row->nilai+$nilai1;
		$jumlah1 	= $row->jumlah+$jumlah1;
		$kd_brg 	= $row->kd_brg;
        $nm_brg 	= $row->nm_brg;
        $merek  	= $row->merek;
        $gabung 	= $row->gabung;
        $kd_bahan 	= $row->kd_bahan;
		$kd_skpd 	= $row->kd_skpd;
        $asal 		= $row->asal;
        $tahun 		= $row->tahun;
        $kondisi 	= $row->kondisi;
        $jumlah 	= $row->jumlah;
		$nilai  	= number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $kd_skpd , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(35, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(25, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(43, 5, $keterangan, $border=1, $ln=0, $align='L', $fill=false, $link='');

		$i++;
		$this->fpdf->Ln();
		}}
		elseif($gol=='04'){
	$this->fpdf->SetFont('helvetica','B',11);
	$this->fpdf->Cell(38, 5, $kd_skpd, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(297, 5, $nm_skpd, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$sql1="SELECT a.kd_brg,left(rtrim(b.nm_brg),34) as nm_brg,a.panjang AS merek,a.luas AS gabung,'' AS kd_bahan,a.kd_skpd,
	left(rtrim(a.asal),12) as asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,left(rtrim(a.keterangan),20) as keterangan 
	FROM trkib_d a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg $where1 and a.kd_skpd= '$kd_skpd'";  
	  
	$query = $this->db->query($sql1);
	$this->fpdf->SetFont('helvetica','',9);  
	$height_table = 5;
    foreach ($query->result() as $row){
		$nilai1 	= $row->nilai+$nilai1;
		$jumlah1 	= $row->jumlah+$jumlah1;
		$kd_brg 	= $row->kd_brg;
        $nm_brg 	= $row->nm_brg;
        $merek  	= $row->merek;
        $gabung 	= $row->gabung;
        $kd_bahan 	= $row->kd_bahan;
		$kd_skpd 	= $row->kd_skpd;
        $asal 		= $row->asal;
        $tahun 		= $row->tahun;
        $kondisi 	= $row->kondisi;
        $jumlah 	= $row->jumlah;
		$nilai  	= number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $kd_skpd , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(35, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(25, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(43, 5, $keterangan, $border=1, $ln=0, $align='L', $fill=false, $link='');

		$i++;
		$this->fpdf->Ln();
		}}
		elseif($gol=='05'){
	$this->fpdf->SetFont('helvetica','B',11);
	$this->fpdf->Cell(38, 5, $kd_skpd, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(297, 5, $nm_skpd, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$sql1="SELECT a.kd_brg,left(rtrim(b.nm_brg),34) as nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.kd_skpd,
	left(rtrim(a.peroleh),12) as asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,left(rtrim(a.keterangan),20) as keterangan 
	FROM trkib_e a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg $where1 and a.kd_skpd= '$kd_skpd'";  
	  
	$query = $this->db->query($sql1);
	$this->fpdf->SetFont('helvetica','',9);  
	$height_table = 5;
    foreach ($query->result() as $row){
		$nilai1 	= $row->nilai+$nilai1;
		$jumlah1 	= $row->jumlah+$jumlah1;
		$kd_brg 	= $row->kd_brg;
        $nm_brg 	= $row->nm_brg;
        $merek  	= $row->merek;
        $gabung 	= $row->gabung;
        $kd_bahan 	= $row->kd_bahan;
		$kd_skpd 	= $row->kd_skpd;
        $asal 		= $row->asal;
        $tahun 		= $row->tahun;
        $kondisi 	= $row->kondisi;
        $jumlah 	= $row->jumlah;
		$nilai  	= number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $kd_skpd , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(35, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(25, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(43, 5, $keterangan, $border=1, $ln=0, $align='L', $fill=false, $link='');

		$i++;
		$this->fpdf->Ln();
		}}
		elseif($gol=='06'){
	$this->fpdf->SetFont('helvetica','B',11);
	$this->fpdf->Cell(38, 5, $kd_skpd, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(297, 5, $nm_skpd, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Ln();
	$sql1="SELECT a.kd_brg,left(rtrim(b.nm_brg),34) as nm_brg,'' AS merek,a.luas AS gabung,'' AS kd_bahan,a.kd_skpd,
	left(rtrim(a.asal),12) as asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,left(rtrim(a.keterangan),20) as keterangan 
	FROM trkib_f a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg $where1 and a.kd_skpd= '$kd_skpd'";  
	  
	$query = $this->db->query($sql1);
	$this->fpdf->SetFont('helvetica','',9);  
	$height_table = 5;
    foreach ($query->result() as $row){
		$nilai1 	= $row->nilai+$nilai1;
		$jumlah1 	= $row->jumlah+$jumlah1;
		$kd_brg 	= $row->kd_brg;
        $nm_brg 	= $row->nm_brg;
        $merek  	= $row->merek;
        $gabung 	= $row->gabung;
        $kd_bahan 	= $row->kd_bahan;
		$kd_skpd 	= $row->kd_skpd;
        $asal 		= $row->asal;
        $tahun 		= $row->tahun;
        $kondisi 	= $row->kondisi;
        $jumlah 	= $row->jumlah;
		$nilai  	= number_format($row->nilai,"2",".",",");
        $keterangan = $row->keterangan;
		
		
	$this->fpdf->Cell(15, 5, $i, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(23, 5, $kd_brg, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(22, 5, $kd_skpd , $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(60, 5, $nm_brg, $border=1, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $merek, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(35, 5, $gabung, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $kd_bahan, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(25, 5, $asal, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $kondisi, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $tahun, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $jumlah, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(27, 5, $nilai, $border=1, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(43, 5, $keterangan, $border=1, $ln=0, $align='L', $fill=false, $link='');

		$i++;
		$this->fpdf->Ln();
		}}
}
	  		
	$this->fpdf->SetFont('helvetica','B',11);
	$this->fpdf->Cell(250, 5, $text='', $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(15, 5, $jumlah1, $border=1, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(70, 5, $text="Rp. ".number_format($nilai1,"2",".",",")."", $border=1, $ln=0, $align='L', $fill=false, $link='');

		$this->fpdf->Ln();
		$this->fpdf->Ln();
		
	if($nmpenggu<>''){
	$this->fpdf->SetFont('helvetica','B',12);
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(110, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(110, 5, $text='', $border=0, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='Makassar,', $border=0, $ln=0, $align='R', $fill=false, $link='');
	$this->fpdf->Cell(70, 5, $this->tanggal_indonesia($lctgl), $border=0, $ln=0, $align='L', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
		$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(110, 5, $jabatan1, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(90, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(110, 5, $jabatan2, $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
		$this->fpdf->Ln();$this->fpdf->Ln();$this->fpdf->Ln();$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(110, 5, $text="( ".$nmpenggu." )", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(90, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(110, 5, $text="( ".$nmpengu." )", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(110, 5, $text="NIP. ".$nippenggu."", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(90, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(110, 5, $text="NIP. ".$nippengu."", $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Cell(20, 5, $text='', $border=0, $ln=0, $align='C', $fill=false, $link='');
	$this->fpdf->Ln();
	
	}
	
	$this->fpdf->Output();

}

    function lap_kib_carix(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		
		$konfig		= $this->ambil_config();
		$prov		= strtoupper($konfig['nm_client']);
        $kota 		= strtoupper($konfig['kota']);
        $logo 		= $konfig['logo'];
		$oto		= $this->session->userdata('otori');
		$nm			= $this->session->userdata('nama_simbakda');
		
		$jabatan1	= strtoupper($_REQUEST['jabatan1']);
		$jabatan2	= strtoupper($_REQUEST['jabatan2']);
		$tahun 		= $_REQUEST['tahun'];
		$skpd		= $_REQUEST['skpd'];
		$kriteria 	= $_REQUEST['cari'];
		$gol	 	= $_REQUEST['gol'];
		$judul 		= strtoupper($_REQUEST['judul']);
		$nmpenggu	= strtoupper($_REQUEST['nmpenggu']);
		$nippenggu 	= $_REQUEST['nippenggu'];
		$nmpengu 	= strtoupper($_REQUEST['nmpengu']);
		$nippengu	= $_REQUEST['nippengu'];
		$lctgl	 	= $_REQUEST['lctgl'];
		
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where a.kd_skpd like '%$skpd%' and a.tahun like '%$tahun%' and b.nm_brg like '%$kriteria%'";
        }else{
            $where1 = "where a.kd_skpd like '%$skpd%' and a.tahun like '%$tahun%' and b.nm_brg like '%$kriteria%'";
        }  	
		
        $cRet  = "";
        if($judul==''){
		$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
			<tr>
                <td align=\"center\" colspan=\"12\" style=\"font-size:14px;\"><b>CETAK HASIL PENCARIAN</b></td>
            </tr> "; }
        elseif($judul<>''){
		$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            
			<tr>
                <td align=\"center\" colspan=\"12\" style=\"font-size:14px;\"><b>$judul</b></td>
            </tr> "; }
       $cRet .="<tr>
                <td align=\"left\" width=\"15%\" style=\"font-size:12px;\"><b>&ensp;KOTA</b></td>
                <td align=\"left\" width=\"85%\" style=\"font-size:12px;\"><b>:&ensp;$kota</b></td>
            </tr>
            <tr>
                <td align=\"left\" style=\"font-size:12px;\"><b>&ensp;PROVINSI</b></td>
                <td align=\"left\" style=\"font-size:12px;\"><b>:&ensp;$prov</b></td>
            </tr>
			</table>
			<br/>";
			
 $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<thead>
            <tr>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>NO</b></td>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>KODE BARANG</b></td>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>KODE SKPD</b></td>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>NAMA BARANG</b></td>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>MEREK</b></td>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>SPESIFIKASI</b></td>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>BAHAN</b></td>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>ASAL</b></td>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>KONDISI</b></td>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>TAHUN</b></td>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>JUMLAH</b></td>
                <td  bgcolor=\"#CCCCCC\" rowspan=\"2\" align=\"center\" style=\"font-size:13px\"><b>HARGA</b></td>
            </tr>
            </thead>";
			
 if($gol=='01'){        
$csql="SELECT a.kd_brg,b.nm_brg,'' AS merek,a.no_sertifikat AS gabung,'' AS kd_bahan,a.kd_skpd,
a.asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,a.keterangan 
FROM trkib_a a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";}
elseif($gol=='02'){        
$csql="SELECT a.kd_brg,b.nm_brg,a.merek,a.no_mesin AS gabung,a.kd_bahan,a.kd_skpd,
a.asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,a.keterangan 
FROM trkib_b a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";} 
elseif($gol=='03'){        
$csql="SELECT a.kd_brg,b.nm_brg,a.luas_tanah AS merek,a.luas_lantai AS gabung,a.jenis_gedung AS kd_bahan,a.kd_skpd,
a.asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,a.keterangan 
FROM trkib_c a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";} 
elseif($gol=='04'){        
$csql="SELECT a.kd_brg,b.nm_brg,a.panjang AS merek,a.luas AS gabung,'' AS kd_bahan,a.kd_skpd,
a.asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,a.keterangan 
FROM trkib_d a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";}
elseif($gol=='05'){        
$csql="SELECT a.kd_brg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.kd_skpd,
a.peroleh AS asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,a.keterangan 
FROM trkib_e a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";}
elseif($gol=='06'){        
$csql="SELECT a.kd_brg,b.nm_brg,'' AS merek,a.luas AS gabung,'' AS kd_bahan,a.kd_skpd,
a.asal,a.tahun,a.kondisi,'1' AS jumlah,a.nilai,a.keterangan 
FROM trkib_f a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";}
                         
             $hasil 	= $this->db->query($csql);
              $i 		= 1;
			  $jumlahx	= 0;
			  $nilaix	= 0;
             foreach ($hasil->result() as $row){
			 $jumlahx = $row->jumlah+$jumlahx;
			 $nilaix  = $row->nilai+$nilaix;
			 
		$cRet .="<tr>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_brg</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_skpd</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->nm_brg</td>
                    <td align=\"left\" style=\"font-size:11px; font-family:tahoma;\">$row->merek</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->gabung</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kd_bahan</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->asal</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->kondisi</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->tahun</td>
                    <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$row->jumlah</td>
                    <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\">".number_format($row->nilai)."</td>
                </tr>";
				$i++;
             }
		$cRet .="<tr>
					<td colspan=\"10\" bgcolor=\"#CCCCCC\" align=\"center\" style=\"font-size:10px; font-family:tahoma;\"></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px; font-family:tahoma;\"><b>$jumlahx</b></td>
                    <td align=\"center\" bgcolor=\"#CCCCCC\" style=\"font-size:12px; font-family:tahoma;\"><b>Rp. ".number_format($nilaix)."</b></td>
                </tr>
		</table>";
			
		//$nmpenggu	= $_REQUEST['nmpenggu'];
		//$nippenggu 	= $_REQUEST['nippenggu'];
			
			/*if($nmpenggu==''){
				$cRet .="<tr>
					<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\">$i</td>
                </tr>";}*/
				
			if($nmpenggu<>''){
				$cRet .="
				<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                    <td align=\"left\" colspan=\"3\" style=\"font-size:11px; font-family:tahoma;\"></td>
							<td align=\"center\" colspan=\"2\" style=\"font-size:11px; font-family:tahoma;\"></td>
                    <td align=\"center\" colspan=\"3\" style=\"font-size:11px; font-family:tahoma;\">$kota, ".$this->tanggal_indonesia($lctgl)."</td>
                <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"></td>
                </tr>
				<tr>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                    <td align=\"center\" colspan=\"3\" style=\"font-size:11px; font-family:tahoma;\"><B>$jabatan1</B></td>
							<td align=\"center\" colspan=\"2\" style=\"font-size:11px; font-family:tahoma;\"></td>
                    <td align=\"center\" colspan=\"3\" style=\"font-size:11px; font-family:tahoma;\"><B>$jabatan2</B></td>
                <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"></td>
                </tr>
				<tr>
					<td align=\"center\" colspan=\"12\" style=\"font-size:22px\"></td>
                </tr>
				<tr>
					<td align=\"center\" colspan=\"12\" style=\"font-size:22px\"></td>
                </tr>
				<tr>
					<td align=\"center\" colspan=\"12\" style=\"font-size:22px\"></td>
                </tr>
				<tr>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                    <td align=\"center\" colspan=\"3\" style=\"font-size:11px; font-family:tahoma;\"><B>( <u>$nmpenggu</u> )</B></td>
							<td align=\"center\" colspan=\"2\" style=\"font-size:11px; font-family:tahoma;\"></td>
                    <td align=\"center\" colspan=\"3\" style=\"font-size:11px; font-family:tahoma;\"><B>( <u>$nmpengu</u> )</B></td>
                <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"></td>
                </tr>
				<tr><BR/>
				<td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                    <td align=\"center\" colspan=\"3\" style=\"font-size:11px; font-family:tahoma;\"><B>NIP. $nippenggu</B></td>
							<td align=\"center\" colspan=\"2\" style=\"font-size:11px; font-family:tahoma;\"></td>
                    <td align=\"center\" colspan=\"3\" style=\"font-size:11px; font-family:tahoma;\"><B>NIP. $nippengu</B></td>
                <td align=\"center\" style=\"font-size:11px; font-family:tahoma;\"></td>
                <td align=\"right\" style=\"font-size:11px; font-family:tahoma;\"></td>
                </tr></table>
				";}
			echo $cRet;
		//$cRet .="</table>";
		//$data['prev']= $cRet;    
		//$this->_mpdf('',$cRet,10,10,10,'1');
         }
    }
/*------------------*/ 

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
         //$this->mpdf->SetFooter('Printed Simbakda on @ 01-07-2015 || Page {PAGENO} of {nb}');
        $this->mpdf->AddPage($orientasi);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output();
               
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
