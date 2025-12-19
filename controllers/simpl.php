<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simpl extends CI_Controller {
        
	public function __construct() {
		parent::__construct();
	}
	public function index($data) {
    	/* if($this->auth->is_logged_in() == false){
        	redirect(site_url().'/welcome/login');
      	}else{ */
         	$this->template->set('title','.::SIMBAKDA::.');
         	$this->template->load('index',$data['tabel'],$data['isi']);		
		//}	
	}
	
	function input_data()
    {
        $data['page_title']= 'TRANSAKSI INPUT DATA SIMPL';
        $this->template->set('title', 'TRANSAKSI INPUT DATA SIMPL');   
        $this->template->load('index','simpl/input_data',$data) ;         
    }
	
	 function simpan_master(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $tabel  	= $this->input->post('tabel');
        $lckolom 	= $this->input->post('kolom');
        $lcnilai 	= $this->input->post('nilai');
        $cid 		= $this->input->post('cid');
        //$cidx 		= $this->input->post('cidx');
        $lcid 		= $this->input->post('lcid');
        //$cidxx 		= $this->input->post('cidxx');
        
        //$sql = "delete from $tabel where $cid='$lcid'"; //and  $cidx='$cidxx'
		$sql = "select * from $tabel";		
		$asg = $this->db->query($sql);
        if($asg){
            $sql = "insert into $tabel $lckolom values $lcnilai";
            $asg = $this->db->query($sql);
                if (!($asg)){
                   $msg = array('pesan'=>'0');
                   echo json_encode($msg);
                    exit();
                } else {
                    $msg = array('pesan'=>'1');
                    echo json_encode($msg);
                }
        }else {
                $msg = array('pesan'=>'0');
                echo json_encode($msg);
                exit();
            }
        }
       
    }
	
	function update_master(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $query 	 = $this->input->post('st_query');
        $simakda = $this->input->post('simakda');
        $asg = $this->db->query($query);
		if($simakda<>''){
        $asgx = $this->mdata->conn($simakda);
		  }
		  if (!($asg)){
                   $msg = array('pesan'=>'0');
                   echo json_encode($msg);
                    exit();
                } else {
                    $msg = array('pesan'=>'1');
                    echo json_encode($msg);
                }
        }
		  
    }
	
    	function hapus_master2(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $query = $this->input->post('st_query');
        $asg = $this->db->query($query);
		  
		  if (!($asg)){
                   $msg = array('pesan'=>'0');
                   echo json_encode($msg);
                    exit();
                } else {
                    $msg = array('pesan'=>'1');
                    echo json_encode($msg);
                }
        }
		  
    }
	
	function hapus_master(){
        //no:cnomor,skpd:cskpd
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $ctabel = $this->input->post('tabel');
        $cid 	= $this->input->post('cid');
        $cnid 	= $this->input->post('cnid');
        $skpd 	= $this->input->post('skpd');
        $thn 	= $this->input->post('thn');
        
        $csql = "delete from $ctabel where $cid ='$cnid'";
        $asg  = $this->db->query($csql);
        if ($asg){
            echo '1'; 
        } else{
            echo '0';
        }
        }  
	}
	
	function jabatan()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT TABEL DAFTAR BAGIAN';
        $this->template->set('title', 'INPUT TABEL DAFTAR BAGIAN');   
        $this->template->load('index','simpl/daftar_jabatan',$data) ;
        } 
    }
	function bagian()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT TABEL DAFTAR BAGIAN';
        $this->template->set('title', 'INPUT TABEL DAFTAR BAGIAN');   
        $this->template->load('index','simpl/daftar_bagian',$data) ;
        } 
    }
	
	function kegiatan()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT TABEL DAFTAR KEGIATAN';
        $this->template->set('title', 'INPUT TABEL DAFTAR KEGIATAN');   
        $this->template->load('index','simpl/daftar_kegiatan',$data) ;
        } 
    }
	
    function load_bagian() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
	    $offset = ($page-1)*$rows;
        
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';
		$skpd= $this->session->userdata('skpd');
        if ($kriteria <> ''){                               
            $where="and nama like'%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mbagian_bidang a where kd_skpd='$skpd' $where order by kode");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM mbagian_bidang where kd_skpd='$skpd' $where ORDER BY kode limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' 		=> $ii,        
                        'kode' 		=> $resulte['kode'],
                        'nama' 		=> $resulte['nama'],
                        'singkatan' => $resulte['singkatan']                                                                               
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}

	function load_jabatan() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $skpd  	  = $this->session->userdata('skpd');
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
	    $offset = ($page-1)*$rows;
        
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';

        if ($kriteria <> ''){                               
            $where="and nama like'%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mjabatan a where kd_skpd='$skpd' $where order by kode");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM mjabatan where kd_skpd='$skpd' $where ORDER BY kode limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],
                        'kd_skpd' => $resulte['kd_skpd'],
                        'tahun' => $resulte['tahun'],
                        'nama' => $resulte['nama'],
                        'singkatan' => $resulte['singkatan']                                                                               
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}	
	
	function pejabat()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT TABEL DAFTAR PEJABAT';
        $this->template->set('title', 'INPUT TABEL DAFTAR PEJABAT');   
        $this->template->load('index','simpl/nama_pejabat',$data) ;
        } 
    }
    function load_pejabat() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $skpd  	  = $this->session->userdata('skpd');
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';

        if ($kriteria <> ''){                               
            $where="and nama like'%$kriteria%' ";  // or nama_singkat like '%$kriteria%'        
        }
        $rs = $this->db->query("select count(*) as tot FROM mpejabat a $where order by kode");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM mpejabat where kd_skpd='$skpd' $where order by kode limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' 		=> $ii,        
                        'kode' 		=> $resulte['kode'],
                        'kd_skpd' 	=> $resulte['kd_skpd'],
                        'singkat' 	=> $resulte['singkat'],
                        'nama' 		=> $resulte['nama'],
                        'nip' 		=> $resulte['nip'],
                        'pangkat' 	=> $resulte['pangkat'],
                        'jabatan' 	=> $resulte['jabatan'],
                        'nama_singkat' => $resulte['nama_singkat'],
                        'bagian'   => $resulte['bagian']                                                                               
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}

	function skpd()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUTAN SKPD';
        $this->template->set('title', 'INPUTAN SKPD');   
        $this->template->load('index','simpl/skpd',$data) ;
        } 
    }

    function load_skpd() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
	    $offset   = ($page-1)*$rows;
        $skpd  	  = $this->session->userdata('skpd');
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where 	  ='';

        if ($kriteria <> ''){                               
            $where="where kode like'%$kriteria%' or nama like '%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mhorganisasi a $where order by kode");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        //$sql = "SELECT * FROM mhorganisasi $where ";
        $sql 	= "SELECT a.*,IFNULL(MAX(b.no_transaksi),0)+1 AS no_trans FROM mhorganisasi a LEFT JOIN plh_form_isian b ON a.kode=b.kd_uskpd WHERE a.kode='$skpd'";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
		$no_trans = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' 				=> $ii,        
                        'kd_skpd' 			=> $resulte['kode'],
                        'nm_skpd' 			=> $resulte['nama'],
						'nama_skpd' 		=> $resulte['nama_skpd'],
						'jabatan_skpd' 		=> $resulte['jabatan_skpd'],
                        'pangkat_skpd' 		=> $resulte['pangkat_skpd'],
						'nip_skpd' 			=> $resulte['nip_skpd'],
                        'nama_bendout' 		=> $resulte['nama_bendout'],
						'jabatan_bendout' 	=> $resulte['jabatan_bendout'],
						'pangkat_bendout' 	=> $resulte['pangkat_bendout'],
                        'nip_bendout' 		=> $resulte['nip_bendout'],
						'nama_ppb' 			=> $resulte['nama_ppb'],
						'jabatan_ppb' 		=> $resulte['jabatan_ppb'],
						'pangkat_ppb' 		=> $resulte['pangkat_ppb'],
                        'nip_ppb' 			=> $resulte['nip_ppb'],
						'no_sk' 			=> $resulte['no_sk'],
						'tgl_sk' 			=> $resulte['tgl_sk'],
						'bagian' 			=> $resulte['bagian'],
						'alamat' 			=> $resulte['alamat'],
						'bank' 				=> $resulte['bank'],
						'rekening' 			=> $resulte['rekening'],
                        'npwp' 				=> $resulte['npwp'],     
                        'no_trans' 			=> $resulte['no_trans']                                                                              
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}	
	
	function load_hitung() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$skpd 	  = $this->input->post('skpd');
		$no_transaksi	  = $this->input->post('no_transaksi');
        $where 	  = '';
			//DB jumlah,jml_hps,jml_tawar,jml_akhir 
		$sql="SELECT * FROM (
(SELECT SUM(jumlah) AS jml FROM pld_form_isian WHERE unit_skpd='$skpd' AND no_transaksi='$no_transaksi') AS jml,
(SELECT SUM(jml_hps) AS hrg_hps FROM pld_form_isian WHERE unit_skpd='$skpd' AND no_transaksi='$no_transaksi') AS hrg_hps,
(SELECT SUM(jml_tawar) AS hrg_twr FROM pld_form_isian WHERE unit_skpd='$skpd' AND no_transaksi='$no_transaksi') AS hrg_twr,
(SELECT SUM(jml_akhir) AS hrg_akhir FROM pld_form_isian WHERE unit_skpd='$skpd' AND no_transaksi='$no_transaksi') AS hrg_akhir,
(SELECT SUM(jumlah) AS jml2 FROM pld_form_rincian WHERE kd_skpd='$skpd' AND no_transaksi='$no_transaksi') AS jml2,
(SELECT SUM(jml_hps) AS hrg_hps2 FROM pld_form_rincian WHERE kd_skpd='$skpd' AND no_transaksi='$no_transaksi') AS hrg_hps2,
(SELECT SUM(jml_tawar) AS hrg_twr2 FROM pld_form_rincian WHERE kd_skpd='$skpd' AND no_transaksi='$no_transaksi') AS hrg_twr2,
(SELECT SUM(jml_akhir) AS hrg_akhir2 FROM pld_form_rincian WHERE kd_skpd='$skpd' AND no_transaksi='$no_transaksi') AS hrg_akhir2
)";
       /*  $sql = "SELECT IFNULL(SUM(a.jumlah),0) AS jml,IFNULL(SUM(a.jml_hps),0) AS hrg_hps,
IFNULL(SUM(a.jml_tawar),0) AS hrg_twr,IFNULL(SUM(a.jml_akhir),0) AS hrg_akhir,
IFNULL(SUM(b.jumlah),0) AS jml2,IFNULL(SUM(b.jml_hps),0) AS hrg_hps2,
IFNULL(SUM(b.jml_tawar),0) AS hrg_twr2,IFNULL(SUM(b.jml_akhir),0) AS hrg_akhir2  
FROM pld_form_isian a
LEFT JOIN pld_form_rincian b ON a.no_transaksi=b.no_transaksi AND a.kode=b.kode AND a.unit_skpd=b.kd_skpd AND a.tahun=b.tahun
				WHERE unit_skpd='$skpd' AND a.no_transaksi='$no_transaksi'"; */
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba= array(
                        'jml' 			=> $resulte['jml']+$resulte['jml2'],
                        'hrg_hps' 		=> $resulte['hrg_hps']+$resulte['hrg_hps2'],
                        'hrg_twr' 		=> $resulte['hrg_twr']+$resulte['hrg_twr2'],
                        'hrg_akhir' 	=> $resulte['hrg_akhir']+$resulte['hrg_akhir2']                                                                              
                        );
                       // $ii++;
        }
        
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}

    function loadmax(){
        $table    = $this->input->post('table');
        $kolom    = $this->input->post('kolom');
        $rs = $this->db->query("select count(*) as tot FROM $table");
        $trh = $rs->row();
        $sql = "SELECT IFNULL(MAX($kolom),0)+1 AS kode FROM $table ";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba= array(
                        'kode'          => $resulte['kode']                                                                              
                        );
                        
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
        $query1->free_result();  
    }
	
	function load_idmax() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$kriteria = '';
        //$kriteria = $this->input->post('cari');
        //$skpd	  = '';
		$skpd 	  = $this->input->post('skpd');
		$table	  = $this->input->post('table');
		$kolom	  = $this->input->post('kolom');
        $where 	  = '';

        if ($skpd <> ''){                               
            $where="where kd_skpd ='$skpd'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM $table");
        $trh = $rs->row();
        $sql = "SELECT IFNULL(MAX($kolom),0)+1 AS kode FROM $table $where";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba= array(
                        'kode' 			=> $resulte['kode']                                                                              
                        );
                        //$ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
	function load_idmax_dpa() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$skpd 	  = $this->input->post('skpd');
		$table	  = $this->input->post('table');
		$kolom	  = $this->input->post('kolom');
        $where 	  = '';

        if ($skpd <> ''){                               
            $where="where unit_skpd ='$skpd'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM $table a order by kode");
        $trh = $rs->row();
        $sql = "SELECT IFNULL(MAX($kolom),0)+1 AS kode FROM $table $where";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba= array(
                        'kode' 			=> $resulte['kode']                                                                              
                        );
                        //$ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
	  function load_nomax() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $skpd  	  = $this->session->userdata('skpd');
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where 	  ='';

        if ($kriteria <> ''){                               
            $where="where kode like'%$kriteria%' or nama like '%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mhorganisasi a $where order by kode");
        $trh = $rs->row();
        $sql = "SELECT IFNULL(MAX(b.no_transaksi),0)+1 AS no_trans FROM mhorganisasi a LEFT JOIN plh_form_isian b ON a.kode=b.kd_uskpd WHERE a.kode='$skpd'";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
		$no_trans = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba= array(
                        'no_trans' 			=> $resulte['no_trans']                                                                              
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}	

	function rekanan()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT TABEL DAFTAR REKANAN';
        $this->template->set('title', 'INPUT TABEL DAFTAR REKANAN');   
        $this->template->load('index','simpl/nama_rekanan',$data) ;
        } 
    }
    function load_rekanan() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{

        $kd_skpd  	  = $this->session->userdata('skpd');      
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
	    $offset = ($page-1)*$rows;
        
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';

        if ($kriteria <> ''){                               
            $where="where nama like'%$kriteria%' or pimpinan like '%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mrekanan a $where order by kode");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM mrekanan where kd_skpd='$kd_skpd' order by kode limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
								'id' 				=> $ii,        
								'kode'		 		=> $resulte['kode'],
								'kd_skpd'		 	=> $resulte['kd_skpd'],
								'pimpinan'			=> $resulte['pimpinan'],
								'jabatan'		 	=> $resulte['jabatan'],
								'bentuk'			=> $resulte['bentuk'],
								'nama'		 		=> $resulte['nama'],
								'bank'				=> $resulte['bank'],
								'rekening'		 	=> $resulte['rekening'],
								'npwp'		 		=> $resulte['npwp'],
								'kantor'		 	=> $resulte['kantor'],
								'rumah'		 		=> $resulte['rumah'],
								'kota'		 		=> $resulte['kota'],
								'kodepos'		 	=> $resulte['kodepos'],
								'nama_perantara'	=> $resulte['nama_perantara'],
								'pimpinan_perantara'=> $resulte['pimpinan_perantara'],
								'rek_perantara'		=> $resulte['rek_perantara'],
								'ppn'		 		=> $resulte['ppn'],
								'pph'		 		=> $resulte['pph'],
								'ktp'		 		=> $resulte['ktp'],
								'bank_perantara'	=> $resulte['bank_perantara'],
								'jabat_perantara'	=> $resulte['jabat_perantara'],
								'notaris'			=> $resulte['notaris'],
								'no_notaris'		=> $resulte['no_notaris'],
								'tgl_notaris'		=> $resulte['tgl_notaris']
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}	
	
	function pajak()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT TABEL DAFTAR PAJAK';
        $this->template->set('title', 'INPUT TABEL DAFTAR PAJAK');   
        $this->template->load('index','simpl/daftar_pajak',$data) ;
        } 
    }
    function load_pajak() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 15;
	    $offset = ($page-1)*$rows;
        
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';

        if ($kriteria <> ''){                               
            $where="where kode like'%$kriteria%' or nama like '%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mpajak a $where order by kode");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM mpajak $where order by kode limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],
                        'nama' => $resulte['nama'],
                        'besar' => $resulte['besar'],
                        'ket' => $resulte['ket']                                                                              
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}	
	
	function bank()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT TABEL DAFTAR BANK';
        $this->template->set('title', 'INPUT TABEL DAFTAR BANK');   
        $this->template->load('index','simpl/daftar_bank',$data) ;
        } 
    }
    function load_bank() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
	    $offset = ($page-1)*$rows;
        
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';

        if ($kriteria <> ''){                               
            $where="where kode like'%$kriteria%' or nama like '%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mbank a $where order by kode");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM mbank $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],
                        'nama' => $resulte['nama']                                                                             
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}	
	
	   function fomulir_simpl()
    {
   	    if($this->auth->is_logged_in() == false) {
        	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT ADMINISTRASI PENGADAAN LANGSUNG';
        $this->template->set('title', 'INPUT ADMINISTRASI PENGADAAN LANGSUNG');   
        $this->template->load('index','transaksi/form_simpl',$data) ;    
        }     
    }
	
	
	   function fomulir_input_pl()
    {
   	    if($this->auth->is_logged_in() == false) {
        	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT ADMINISTRASI PENGADAAN LANGSUNG';
        $this->template->set('title', 'INPUT ADMINISTRASI PENGADAAN LANGSUNG');   
        $this->template->load('index','simpl/mpl_input',$data) ;    
        }     
    }	
	
  function load_giat() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		
		$rs = $this->db->query("select count(*) as tot FROM m_giat");
        $trh = $rs->row();
        $sql = "SELECT * from m_giat";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_kegiatan' => $resulte['kd_kegiatan'],
                        'nm_kegiatan' => $resulte['nm_kegiatan']                                                                                    
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
	
 function load_kegiatan() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		//$where1 = "where organisasi ='$kd_skpd' ";
		$cari = $this->input->post('q');
		$where="";
		if($cari<>''){
		$where="and nama like upper('%$cari%')"; 		
		}
		$kd_skpd = $this->session->userdata('skpd');
		$rs = $this->db->query("select count(*) as tot FROM m_kegiatan");
        $trh = $rs->row();
        $sql = "SELECT * from m_kegiatan where organisasi ='$kd_skpd' $where order by kode";
        $query1 = $this->db->query($sql); 
		$result = array();		
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(
                        'id' => $ii,        
                        'kd_kegiatan' => $resulte['kode'],
                        'nm_kegiatan' => $resulte['nama'],
						'program' => $resulte['program'],
                        'urusan' => $resulte['urusan'],						
						'organisasi' => $resulte['organisasi'],
                        'bagian' => $resulte['bagian'],	 						
                        );
                        $ii++;
        }
        echo json_encode($result);
    	$query1->free_result();   
        }
	}	
/***********INPUTAN PL BARU*********/	
function load_rincian() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		
        $kd_skpd = $this->input->post('kd_skpd');
		$kd_giat = $this->input->post('kd_giat');
        
		$rs = $this->db->query("select count(*) as tot FROM mkegiatan");
        $trh = $rs->row();
        $sql = "SELECT a.organisasi,a.kodegiat,a.koderek,a.no,a.uraian,a.c4,a.n4,a.satuan,a.jumlah FROM rinci_rkaskpd a WHERE a.organisasi='$kd_skpd' AND a.kodegiat='$kd_giat' AND NOT EXISTS
				(SELECT b.kode,b.no,b.unit_skpd,b.kodegiat FROM pld_form_isian b WHERE b.kode=a.koderek AND a.no=b.no AND a.organisasi=b.unit_skpd AND a.kodegiat=b.kodegiat) order by a.no";
        $query1 = $this->db->query($sql); 
		$result = array();		
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(
                        'id' => $ii,        				
						'organisasi' => $resulte['organisasi'],
						'kodegiat'   => $resulte['kodegiat'], 
						'koderek' 	 => $resulte['koderek'],
						'no' 		 => $resulte['no'],
						'uraian' 	 => $resulte['uraian'],
						'c4' 		 => $resulte['c4'],
						'n4' 		 => $resulte['n4'],
						'satuan' 	 => $resulte['satuan'], 
						'jumlah' 	 => $resulte['jumlah']						
                        );
                        $ii++;
        }
        echo json_encode($result);
    	$query1->free_result();   
        }
	}	
	
function simpan_pld_rincian(){
	
        $skpd 	= $this->session->userdata('unit_skpd');
        $csql 	= $this->input->post('sql');
        $nodok 	= $this->input->post('nodok'); 
        $koderek 	= $this->input->post('koderek');
        $kodegiat 	= $this->input->post('kodegiat');
        $no 	= $this->input->post('no');
		$fa		= "delete from pld_form_isian_temp where no_transaksi = '$nodok' and kode='$koderek' and kodegiat='$kodegiat' and no='$no' and unit_skpd='$skpd'"; 
        $iz  	= $this->db->query($fa);
		if($iz){ 
        $sql  	= "insert into pld_form_isian_temp(no_transaksi,kode,kodegiat,no,unit_skpd,tahun,uraian,satuan,vol,harga,harga_hps,harga_tawar,harga_akhir,jumlah,jml_hps,jml_tawar,jml_akhir)"; 
        $asg  	= $this->db->query($sql.$csql);
		}
        if($asg){
          $csql = "SELECT SUM(jumlah) AS total from pld_form_isian_temp where no_transaksi = '$nodok' and unit_skpd='$skpd'";
          $rs 	= $this->db->query($csql)->row() ;  
          if($rs){       
                $sql2 = "update plh_form_isian set total ='$rs->total' where no_transaksi = '$nodok' and kd_uskpd='$skpd'";
                $asg2 = $this->db->query($sql2);   
            }
            
           echo number_format($rs->total); 
        }else{
           echo 'Data Tidak Tersimpan';
        } 
         
    }
	
	function simpan_pld_rincian2(){
	
        $skpd 	= $this->session->userdata('skpd');
        $csql 	= $this->input->post('sql');
        $nodok 	= $this->input->post('nodok'); 
        $koderek 	= $this->input->post('koderek');
        $kodegiat 	= $this->input->post('kodegiat');
        $no 	= $this->input->post('no');
		$fa		= "delete from pld_form_isian where no_transaksi = '$nodok' and kode='$koderek' and kodegiat='$kodegiat' and no='$no' and unit_skpd='$skpd'"; 
        $iz  	= $this->db->query($fa);
		if($iz){ 
        $sql  	= "insert into pld_form_isian(no_transaksi,kode,kodegiat,no,unit_skpd,tahun,uraian,satuan,vol,harga,harga_hps,harga_tawar,harga_akhir,jumlah,jml_hps,jml_tawar,jml_akhir,merek,tipe_detail,warna,bahan,satuan_detail,kondisi,keterangan)"; 
        $asg  	= $this->db->query($sql.$csql);
		}
        if($asg){
          $csql = "SELECT SUM(jumlah) AS total from pld_form_isian where no_transaksi = '$nodok' and unit_skpd='$skpd'";
          $rs 	= $this->db->query($csql)->row() ;  
          if($rs){       
                $sql2 = "update plh_form_isian set total ='$rs->total' where no_transaksi = '$nodok' and kd_uskpd='$skpd'";
                $asg2 = $this->db->query($sql2);   
            }
            
           echo number_format($rs->total); 
        }else{
           echo 'Data Tidak Tersimpan';
        } 
         
    }

function ambil_pld_rincian(){
        $nomor = $this->input->post('no');
        $skpd  = $this->input->post('kode');           
        $sql   = "SELECT b.*,sum(b.jumlah) as total_jml,sum(b.harga_hps) as total_hps,sum(b.harga_tawar) as total_twr,sum(b.harga_akhir) as total_akhir 
				  FROM plh_form_isian a left JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi and b.unit_skpd=a.kd_uskpd
				  WHERE a.no_transaksi = '$nomor' and a.kd_uskpd = '$skpd' group by no_transaksi,unit_skpd,kode,kodegiat,no";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(            
                        'no_transaksi'   => $resulte['no_transaksi'],                     
                        'kd_skpd'    	 => $resulte['unit_skpd'],                      
                        'kode'       	 => $resulte['kode'],                     
                        'kodegiat'       => $resulte['kodegiat'],
                        'no'     	     => $resulte['no'],                      
                        'uraian'    	 => $resulte['uraian'],
                        'satuan'     	 => $resulte['satuan'],
                        'vol'        	 => $resulte['vol'],
                        'harga'      	 => $resulte['harga'],
                        'jumlah'     	 => $resulte['vol']*$resulte['harga'],//$resulte['jumlah'] 
                        'harga_hps'      => $resulte['harga_hps'],
                        'harga_tawar'    => $resulte['harga_tawar'],
                        'harga_akhir'    => $resulte['harga_akhir'],
                        'total_jml'    	 => $resulte['total_jml'],
                        'total_hps'    	 => $resulte['total_hps'],  
                        'total_twr'      => $resulte['total_twr'],
                        'total_akhir'    => $resulte['total_akhir']                                                                                                                                                          
                        );
                        $ii++;
        }           
        echo json_encode($result);
    }
	
function ambil_pld_rincian2(){
        $nomor = $this->input->post('no');
        $skpd  = $this->input->post('kode');           
        $sql   = "SELECT *,sum(jumlah) as total_jml,sum(harga_hps) as total_hps,sum(harga_tawar) as total_twr,sum(harga_akhir) as total_akhir 
		FROM pld_form_isian_temp WHERE no_transaksi = '$nomor' and unit_skpd = '$skpd' group by no_transaksi,unit_skpd,kode,kodegiat,no";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(            
                        'no_transaksi'   => $resulte['no_transaksi'],                     
                        'kd_skpd'    	 => $resulte['unit_skpd'],                      
                        'kode'       	 => $resulte['kode'],                     
                        'kodegiat'       => $resulte['kodegiat'],
                        'no'     	     => $resulte['no'],                      
                        'uraian'    	 => $resulte['uraian'],
                        'satuan'     	 => $resulte['satuan'],
                        'vol'        	 => $resulte['vol'],
                        'harga'      	 => $resulte['harga'],
                        'jumlah'     	 => $resulte['vol']*$resulte['harga'],//$resulte['jumlah'] 
                        'harga_hps'      => $resulte['harga_hps'],
                        'harga_tawar'    => $resulte['harga_tawar'],
                        'harga_akhir'    => $resulte['harga_akhir'],
                        'total_jml'    	 => $resulte['total_jml'],
                        'total_hps'    	 => $resulte['total_hps'],  
                        'total_twr'      => $resulte['total_twr'],
                        'total_akhir'    => $resulte['total_akhir']                                                                                                                                                            
                        );
                        $ii++;
        }           
        echo json_encode($result);
    }
	
	function simpan_rinci_rka(){
	
        $skpd 	= $this->session->userdata('unit_skpd');
        $csql 	= $this->input->post('sql');
        $nodok 	= $this->input->post('nodok'); 
        $koderek 	= $this->input->post('koderek');
        $kodegiat 	= $this->input->post('kodegiat');
        $no 	= $this->input->post('no');
        $no_urut 	= $this->input->post('no_urut');
        $kode_gabung 	= $this->input->post('kode_gabung');
		$fa		= "delete from pld_form_rincian where kd_skpd='$skpd' and no_urut='$no_urut'"; 
        $iz  	= $this->db->query($fa);
		if($iz){ 
        $sql  	= "insert into pld_form_rincian(no_transaksi,kode,kodegiat,no,no_urut,kode_gabung,kd_skpd,tahun,uraian_header,uraian,satuan,vol,harga,harga_hps,harga_tawar,harga_akhir,jumlah,jml_hps,jml_tawar,jml_akhir)"; 
        $asg  	= $this->db->query($sql.$csql);
		}
    }

/********************INPUTAN PL END********************/	
   function load_pptk() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$skpd 	=  
        $page 	= isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows 	= isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		$kd_skpd = $this->input->post('skpd');
		$rs = $this->db->query("select count(*) as tot FROM mpejabat");
        $trh = $rs->row();
        $sql = "SELECT nama,kode FROM MPejabat WHERE singkat='PPTK' and kd_skpd='$kd_skpd' ORDER BY nama";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],
                        'nama' => $resulte['nama']                                                                                    
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
 
    function load_staf_terima() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$kd_skpd = $this->input->post('skpd');        
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		
		$rs = $this->db->query("select count(*) as tot FROM mpejabat");
        $trh = $rs->row();
        $sql = "SELECT nama,kode FROM mpejabat WHERE singkat='P_TRM' and kd_skpd='$kd_skpd' ORDER BY nama";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],
                        'nama' => $resulte['nama']                                                                                    
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
	
	function load_ketua() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$kd_skpd = $this->input->post('skpd');        
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		
		$rs = $this->db->query("select count(*) as tot FROM mpejabat");
        $trh = $rs->row();
        $sql = "SELECT nama,kode FROM mpejabat WHERE singkat='K_HSL' and kd_skpd='$kd_skpd' ORDER BY nama";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],
                        'nama' => $resulte['nama']                                                                                    
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
	function load_anggota() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$kd_skpd = $this->input->post('skpd');   
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		
		$rs = $this->db->query("select count(*) as tot FROM mpejabat");
        $trh = $rs->row();
        $sql = "SELECT nama,kode FROM mpejabat WHERE singkat='A_HSL' and kd_skpd='$kd_skpd' ORDER BY nama";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],
                        'nama' => $resulte['nama']                                                                                    
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
	
	function load_pengadaan() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$kd_skpd = $this->input->post('skpd');   
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		
		$rs = $this->db->query("select count(*) as tot FROM mpejabat");
        $trh = $rs->row();
        $sql = "SELECT nama,kode FROM mpejabat WHERE singkat='P_ADA' and kd_skpd='$kd_skpd' ORDER BY nama";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],
                        'nama' => $resulte['nama']                                                                                    
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
	
	function load_penerima() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$kd_skpd = $this->input->post('skpd');   
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		
		$rs = $this->db->query("select count(*) as tot FROM mpejabat");
        $trh = $rs->row();
        $sql = "SELECT nama,kode FROM mpejabat WHERE singkat='P_TRM' and kd_skpd='$kd_skpd' ORDER BY nama";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],
                        'nama' => $resulte['nama']                                                                                    
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
	
 	function load_rinci_skpd() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{ 
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
	    $offset = ($page-1)*$rows;
		
		$rs = $this->db->query("select count(*) as tot FROM rinci_rkaskpd");
        $trh = $rs->row();
        $kd_skpd = $this->input->post('kd_skpd');
		$kd_giat = $this->input->post('kd_giat');
		$no_trans = $this->input->post('no_transaksi');
$sql="SELECT * FROM (
SELECT a.organisasi,a.kodegiat,a.koderek,0 AS no,a.`namarek` AS uraian,'' AS c4,'' AS n4,'' AS satuan,'' AS jumlah 
FROM rkaskpd a WHERE a.organisasi='$kd_skpd' AND a.kodegiat='$kd_giat'
 
UNION 

SELECT a.organisasi,a.kodegiat,a.koderek,a.no,a.uraian,a.c4,a.n4,a.satuan,a.jumlah 
FROM rinci_rkaskpd a WHERE a.organisasi='$kd_skpd' AND a.kodegiat='$kd_giat' 
AND NOT EXISTS
(SELECT b.kode,b.no,b.unit_skpd,b.kodegiat FROM pld_form_isian b 
WHERE b.kode=a.koderek AND a.no=b.no AND a.organisasi=b.unit_skpd 
AND a.kodegiat=b.kodegiat AND b.no_transaksi='$no_trans')) ab ORDER BY kodegiat,koderek,no"; //
/*         $sql = "SELECT a.organisasi,a.kodegiat,a.koderek,a.no,a.uraian,a.c4,a.n4,a.satuan,a.jumlah FROM rinci_rkaskpd a WHERE a.organisasi='$kd_skpd' AND a.kodegiat='$kd_giat' AND NOT EXISTS
				(SELECT b.kode,b.no,b.unit_skpd,b.kodegiat FROM pld_form_isian b WHERE b.kode=a.koderek AND a.no=b.no AND a.organisasi=b.unit_skpd AND a.kodegiat=b.kodegiat and b.no_transaksi='$no_trans') order by a.kodegiat,a.koderek,a.no";
 */        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(    
						'kodegiat' => $resulte['kodegiat'],
						'koderek' => $resulte['koderek'],
						'no' => $resulte['no'],
						'uraian' => $resulte['uraian'],
						'c4' => $resulte['c4'],
						'n4' => $resulte['n4'],
						'satuan' => $resulte['satuan'], 
						'jumlah' => $resulte['jumlah']
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
 
	function simpan_hpl(){
        $iduser   		= $this->input->post('iduser');
        $ubah   		= $this->input->post('ubah');
        $tabel   		= $this->input->post('tabel');
        $no_transaksi 	= $this->input->post('no_transaksi');
		$kd_skpd 		= $this->input->post('kd_skpd');
        $tahun   		= $this->input->post('tahun');
        $kegiatan   	= $this->input->post('kegiatan');
		$nm_kegiatan   	= $this->input->post('nm_kegiatan');
        $keterangan   	= $this->input->post('keterangan');
        $pptk			= $this->input->post('pptk');
        $rekanan 		= $this->input->post('rekanan');
		$staf_penerima  = $this->input->post('staf_penerima');
        $ketua   		= $this->input->post('ketua');
        $anggota_satu 	= $this->input->post('anggota_satu');
        $anggota_dua   	= $this->input->post('anggota_dua');
        $total			= $this->input->post('total');  
		$jml_hps		= $this->input->post('jml_hps'); 
		$jml_tawar		= $this->input->post('jml_tawar'); 
		$jml_akhir		= $this->input->post('jml_akhir'); 
		$pajak			= $this->input->post('pajak'); 
		$pph1			= $this->input->post('pph1'); 
		$pph2			= $this->input->post('pph2');  
		$jml_ppn		= $this->input->post('jml_ppn'); 
		$jml_pph1		= $this->input->post('jml_pph1'); 
		$jml_pph2		= $this->input->post('jml_pph2'); 
        $csql   		= $this->input->post('sql'); 
		
        $msg        = array();
		/**********************INI********************/
		if ($tabel == 'plh_form_isian') {
            $fa = "delete from plh_form_isian where no_transaksi='$no_transaksi' and kd_uskpd='$kd_skpd'" ;
			$iz = $this->db->query($fa);
				/**************simakda***************/
				$ve = "delete from trhtagih where no_transaksi='$no_transaksi' and kd_skpd='$kd_skpd'" ;
				$ro = $this->mdata->conn($ve);
				if($ve){
				$sqlx = "insert into trhtagih (no_transaksi,tgl_bukti,no_sp2d,ket,username,tgl_update,kd_skpd,nm_skpd,
				total,no_tagih,sts_tagih,status,tgl_tagih,jns_spp) values ('$no_transaksi','','','$keterangan','','DATE(NOW())','$kd_skpd','','$jml_akhir','','','','','')";
				$asgx = $this->mdata->conn($sqlx);
				}
				/**************END***************/
			if(($fa)){
				$sql = "insert into plh_form_isian(iduser,no_transaksi,kd_uskpd,tahun,kegiatan,nm_kegiatan,keterangan,pptk,rekanan,staf_penerima,ketua,anggota_satu,anggota_dua,total,jml_hps,jml_tawar,jml_akhir,ppn,pph1,pph2,jml_ppn,jml_pph1,jml_pph2) 
						values('$iduser','$no_transaksi','$kd_skpd','$tahun','$kegiatan','$nm_kegiatan','$keterangan','$pptk','$rekanan','$staf_penerima','$ketua','$anggota_satu','$anggota_dua','$total','$jml_hps','$jml_tawar','$jml_akhir','$pajak','$pph1','$pph2','$jml_ppn','$jml_pph1','$jml_pph2')";
				$asg = $this->db->query($sql);
				/**************simakda***************/
				/**************END***************/
				
					if (!($asg)){
					   $msg = array('pesan'=>'0');
					   echo json_encode($msg);
						exit();
					} else {
						$msg = array('pesan'=>'1');
						echo json_encode($msg);
					}
				}
			}
		}/*88888888888888888888888888888888888888888888*/
		
		/* if ($tabel == 'plh_form_isian') {
			//if($ubah ==''){
            $sql = "delete from plh_form_isian where no_transaksi='$no_transaksi' and kd_uskpd='$kd_skpd'" ;
            //$sql="select ifnull(count(no_transaksi),0) as ada from plh_form_isian where kd_uskpd='$kd_skpd' and no_transaksi='$no_transaksi'";
			 $fa = $this->db->query($sql);
			 foreach($fa->result_array() as $iz)
				{
				$ada=$iz['ada'];
				}
						
            if ($ada>='1'){
                   $msg = array('pesan'=>'0');
                   echo json_encode($msg);
                   exit();
            } else {
                $sql = "insert into plh_form_isian(no_transaksi,kd_uskpd,kegiatan,nm_kegiatan,keterangan,pptk,rekanan,staf_penerima,ketua,anggota_satu,anggota_dua,total,jml_hps,jml_tawar,jml_akhir,ppn,pph1,pph2,jml_ppn,jml_pph1,jml_pph2) 
                        values('$no_transaksi','$kd_skpd','$kegiatan','$nm_kegiatan','$keterangan','$pptk','$rekanan','$staf_penerima','$ketua','$anggota_satu','$anggota_dua','$total','$jml_hps','$jml_tawar','$jml_akhir','$pajak','$pph1','$pph2','$jml_ppn','$jml_pph1','$jml_pph2')";
                $asg = $this->db->query($sql);
                if (!($asg)){
                   $msg = array('pesan'=>'0');
                   echo json_encode($msg);
                    exit();
                } else {
                    $msg = array('pesan'=>'1');
                    echo json_encode($msg);
                }
            } */
           /*  }else{
				$sql="UPDATE plh_form_isian SET kegiatan='$kegiatan',nm_kegiatan='$nm_kegiatan',keterangan='$keterangan',pptk='$pptk',rekanan='$rekanan',staf_penerima='$staf_penerima',ketua='$ketua',anggota_satu='$anggota_satu',anggota_dua='$anggota_dua',total='$total',jml_hps='$jml_hps',jml_tawar='$jml_tawar',jml_akhir='$jml_akhir',ppn='$pajak',pph1='$pph1',pph2='$pph2',jml_ppn='$jml_ppn',jml_pph1='$jml_pph1',jml_pph2='$jml_pph2' where no_transaksi='$no_transaksi' and kd_uskpd='$kd_skpd'";
				$iz = $this->db->query($sql);
			
			} */
        //} /* else if ($tabel == 'pld_form_isian') {
            
            // Simpan Detail //                       
               /*  $sql = "delete from pld_form_isian where no='$no_transaksi'";
                $asg = $this->db->query($sql);
                if (!($asg)){
                    $msg = array('pesan'=>'0');
                    echo json_encode($msg);
                    exit();
                }else{            
                    $sql = "insert into pld_form_isian(no_dokumen,kd_brg,nm_brg,merek,jumlah,harga,total,ket)"; 
    
                    $asg = $this->db->query($sql.$csql);
                    if (!($asg)){
                       $msg = array('pesan'=>'0');
                        echo json_encode($msg);
                        exit();
                    }  else {
                       $msg = array('pesan'=>'1');
                        echo json_encode($msg);
                    }
                }                                                                 
        }  
    } */
	
	function simpan_trd() {
		if(count($_POST) > 0) {
			foreach($_POST['data'] as $row){
				$insRow = array(
					'no_transaksi' => $_POST['no_transaksi'], 
					'kodegiat' 	   => $_POST['kodegiat'],      
					'kode' 		   => $row['koderek'],
					'no' 		   => $row['no'],
					'unit_skpd'    => $_POST['unit_skpd'], 
					'tahun' 	   => $_POST['tahun'], 
					'uraian'       => $row['uraian'],
					'satuan'       => $row['c4'],
					'vol'          => $row['n4'],
					'harga'        => $row['satuan'],
					'jumlah'       => $row['jumlah']
				);
				$query = $this->db->insert('pld_form_isian', $insRow);
			}
		}		
		//if(count($_POST) > 0) $query = $this->db->insert('pld_form_isian', $_POST);
		//$query = $this->db->query(" insert into pld_form_isian(no_transaksi,uraian,satuan,vol,harga,jumlah) values ('$no_transaksi','$uraian','$c4','$n4','$satuan','$jumlah') ");	
		//$query = $this->db->query(" update trskpd set total=( select sum(nilai) as jum from trdrka where kd_kegiatan='$kegiatan' and kd_skpd='$skpd' ),TK_MAS=( select sum(nilai) as jum from trdrka where kd_kegiatan='$kegiatan' and kd_skpd='$skpd' ),TU_MAS='Dana' where kd_kegiatan='$kegiatan' and kd_skpd='$skpd' ");	

    }
	
	function simpan_trd2() {
		if(count($_POST) > 0) {
			foreach($_POST['data'] as $row){
				$insRow = array(   
                        'no_transaksi'   	=> $row['no_transaksi'],                     
                        'kode'       	 	=> $row['kode'],                      
                        'kodegiat'   	 	=> $row['kodegiat'],
                        'no'     	     	=> $row['no'],                         
                        'unit_skpd'    	 	=> $_POST['ckd_skpd'],                   
                        'uraian'    	 	=> $row['uraian'],
                        'satuan'     	 	=> $row['satuan'],
                        'vol'        	 	=> $row['vol'],
                        'harga'      	    => $row['harga'],
                        'harga_hps'       	=> $row['harga_hps'],
                        'harga_tawar'     	=> $row['harga_tawar'],
                        'harga_akhir'     	=> $row['harga_akhir'],
                        'jumlah'     	    => $row['jumlah'],
                        //'total_jml'	    	=> $row['total_jml'],
                        'jml_hps'	    	=> $row['total_hps'],  
                        'jml_tawar'	    	=> $row['total_twr'],  
                        'jml_akhir'     	=> $row['total_akhir']  
				);
				$query = $this->db->insert('pld_form_isian', $insRow);
			}
		}		
    }
	
	
	function update_pld(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $query = $this->input->post('st_query');
        $asg = $this->db->query($query);
        }

    }
	
	 function ambil_plh_form_isian(){  
        $unit_skpd 	= $this->session->userdata('skpd');
        $oto  		= $this->session->userdata('otori');
        $iduser		= $this->session->userdata('iduser');
        $ket		= $this->session->userdata('nama_simbakda');
 
        $where1 = '';       
		if($unit_skpd=='1.01.01.00' && $ket!=''){
            $where1 = "where a.kd_uskpd ='$unit_skpd' and a.iduser='$iduser'";
        }elseif ($unit_skpd=='1.02.01.00' && $ket!=''){
            $where1 = "where a.kd_uskpd ='$unit_skpd' and a.iduser='$iduser'";
        }elseif ($unit_skpd=='1.03.01.00' && $ket!=''){
            $where1 = "where a.kd_uskpd ='$unit_skpd' and a.iduser='$iduser'";
        }elseif ($unit_skpd=='1.20.08.00' && $ket!=''){
            $where1 = "where a.kd_uskpd ='$unit_skpd' and a.iduser='$iduser'";
        }elseif ($unit_skpd=='1.20.03.00' && $ket!=''){
            $where1 = "where a.kd_uskpd ='$unit_skpd' and a.iduser='$iduser'";
        }else{
			$where1 = "where a.kd_uskpd ='$unit_skpd'";	
			}	
		
        
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100000;
	    $offset = ($page-1)*$rows;        
        $kriteria = $this->input->post('cari');
        $where2 ='';
        if ($kriteria <> ''){                               
            $where2="and (upper(a.no_transaksi) like upper('%$kriteria%') or upper(a.nm_kegiatan) like upper('%$kriteria%') or upper(a.kegiatan) like upper('%$kriteria%')) ";            
        }
        
        $sql = "SELECT count(*) as total from plh_form_isian a $where1 $where2 " ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
       	$result["total"] = $total->total; 
        $query1->free_result(); 
        
        $sql = "SELECT a.*,b.nama AS nm_pptk,c.nama AS nm_rekanan FROM plh_form_isian a
LEFT JOIN mpejabat b ON a.kd_uskpd=b.kd_skpd AND b.kode=a.pptk 
LEFT JOIN mrekanan c ON a.kd_uskpd=c.kd_skpd AND c.kode=a.rekanan $where1 $where2 order by a.no_transaksi,a.kd_uskpd ";
        $query1 = $this->db->query($sql);          
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $row[] = array(                        
                        'no_transaksi'    => $resulte['no_transaksi'],
                        'kd_skpd'   	  => $resulte['kd_uskpd'],
                        'kegiatan'        => $resulte['kegiatan'],
						'nm_kegiatan'     => $resulte['nm_kegiatan'],
                        'keterangan'      => $resulte['keterangan'],
                        'pptk'            => $resulte['pptk'],
                        'rekanan'         => $resulte['rekanan'],	
						'staf_penerima'   => $resulte['staf_penerima'],
                        'ketua'           => $resulte['ketua'],
                        'anggota_satu'    => $resulte['anggota_satu'],
                        'anggota_dua'     => $resulte['anggota_dua'],
						'total'     	  => $resulte['total'],
						'jml_hps'     	  => $resulte['jml_hps'],
						'jml_tawar'    	  => $resulte['jml_tawar'],
						'jml_akhir'    	  => $resulte['jml_akhir'],
						'ppn'          	  => $resulte['ppn'],
                        'pph1'    		  => $resulte['pph1'],
                        'pph2'     		  => $resulte['pph2'],
						'jml_ppn'     	  => $resulte['jml_ppn'],
						'jml_pph1'    	  => $resulte['jml_pph1'],
						'jml_pph2'    	  => $resulte['jml_pph2'],
						'nm_pptk'    	  => $resulte['nm_pptk'],
						'nm_rekanan'   	  => $resulte['nm_rekanan']	
                        );
                        $ii++;
        }
        $result["rows"] = $row; 
        echo json_encode($result);
        $query1->free_result();                 	   
	}        
    
    function ambil_pld_form_isian(){
        $nomor    = $this->input->post('no');  
        $kd_skpd  = $this->input->post('kode');             
        $sql 	  = "SELECT b.*,(SELECT IFNULL(MAX(no_urut),0)+1 AS kode FROM pld_form_rincian where kd_skpd='$kd_skpd') as max_urut FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi= b.no_transaksi
					and b.unit_skpd=a.kd_uskpd WHERE b.no_transaksi = '$nomor' and b.unit_skpd='$kd_skpd' order by kodegiat,kode,no";
			//$sql ="select * from pld_form_isian where no_transaksi='$nomor' and kd_skpd='$kd_skpd'";		
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(                                
                        'no_transaksi'   => $resulte['no_transaksi'],                     
                        'kd_skpd'    	 => $resulte['unit_skpd'],                   
                        'tahun'    	 => $resulte['tahun'],                          
                        'kode'       	 => $resulte['kode'],                      
                        'kodegiat'       	 => $resulte['kodegiat'],
                        'no'     	     => $resulte['no'],                      
                        'uraian'    	 => $resulte['uraian'],
                        'satuan'     	 => $resulte['satuan'],
                        'vol'        	 => $resulte['vol'],
                        'harga'      	 => $resulte['harga'],
                        'jumlah'     	 => $resulte['vol']*$resulte['harga'],//$resulte['jumlah'] 
                        'harga_hps'      => $resulte['harga_hps'],
                        'harga_tawar'    => $resulte['harga_tawar'],
                        'harga_akhir'    => $resulte['harga_akhir'],
                        'harga_hpsx'      => $resulte['vol']*$resulte['harga_hps'],
                        'harga_tawarx'    => $resulte['vol']*$resulte['harga_tawar'],
                        'harga_akhirx'    => $resulte['vol']*$resulte['harga_akhir'] ,
                        'merek'     	 => $resulte['merek'],
                        'tipe_detail'    => $resulte['tipe_detail'],
                        'warna'    		 => $resulte['warna'],
                        'bahan'    		 => $resulte['bahan'],
                        'satuan_detail'  => $resulte['satuan_detail'],
                        'kondisi'   	 => $resulte['kondisi'],
                        'keterangan'   	 => $resulte['keterangan'],
                        'max_urut'   	 => $resulte['max_urut']                                                                                                                                                         
                        );
                        $ii++;
        }           
        echo json_encode($result);
    }
	
	function load_rincian_rka(){
        $nomor    = $this->input->post('nomor');  
        $kd_skpd  = $this->input->post('skpd'); 
        $kode	  = $this->input->post('kode'); 
        $kodegiat = $this->input->post('kodegiat'); 
        $no  	  = $this->input->post('no');   
        $uraian   = $this->input->post('uraian'); 
        $tahun    = $this->input->post('tahun');   
		$sql = "SELECT a.* FROM pld_form_rincian a INNER JOIN pld_form_isian b
ON a.`no_transaksi`=b.`no_transaksi` AND a.`kode`=b.`kode` 
AND a.`kodegiat`=b.`kodegiat` AND a.`no`=b.`no` AND a.`kd_skpd`=b.`unit_skpd` AND a.`tahun`=b.`tahun` AND a.`uraian_header`=b.`uraian` 
WHERE b.`unit_skpd`='$kd_skpd' AND b.`kode`='$kode' AND b.`kodegiat`='$kodegiat' 
AND b.`no`='$no' AND b.tahun='$tahun' AND b.`uraian`='$uraian' and b.`no_transaksi`='$nomor' order by no_urut";

        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(                                
                        'no_transaksi'   => $resulte['no_transaksi'],                     
                        'kd_skpd'    	 => $resulte['kd_skpd'],                      
                        'kode'       	 => $resulte['kode'],                      
                        'kodegiat'       => $resulte['kodegiat'],
                        'no'     	     => $resulte['no'],   
                        'no_urut'  	     => $resulte['no_urut'],   
                        'kode_gabung'    => $resulte['kode_gabung'],                       
                        'uraian'    	 => $resulte['uraian'],
                        'satuan'     	 => $resulte['satuan'],
                        'vol'        	 => $resulte['vol'],
                        'harga'      	 => $resulte['harga'],
                        'jumlah'     	 => $resulte['vol']*$resulte['harga'],
                        'harga_hps'      => $resulte['harga_hps'],
                        'harga_tawar'    => $resulte['harga_tawar'],
                        'harga_akhir'    => $resulte['harga_akhir'],
                        'harga_hpsx'      => $resulte['vol']*$resulte['harga_hps'],
                        'harga_tawarx'    => $resulte['vol']*$resulte['harga_tawar'],
                        'harga_akhirx'    => $resulte['vol']*$resulte['harga_akhir']                                                                                                                                                         
                        );
                        $ii++;
        }           
        echo json_encode($result);
    }
	
	function ambil_pl_lengkap(){
        $nomor = $this->input->post('no');  
        $skpd  = $this->input->post('skpd');             
       // $sql   = "SELECT * FROM plh_form_isian a INNER JOIN pl_lengkap b ON a.no_transaksi=b.no_transaksi
				//  WHERE a.no_transaksi = '$nomor' and a.kd_uskpd='$skpd'";
		  //Bayem ->> Kalo di Join doble
		  $sql   = "SELECT * FROM pl_lengkap 
				    WHERE no_transaksi = '$nomor' and kd_skpd='$skpd'";
        $query1 = $this->db->query($sql);  
        //$query1->free_result(); 
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(         
                        'no_transaksi'  => $resulte['no_transaksi'],                    
                        'kd_skpd'     	=> $resulte['kd_skpd'],                     
                        'tahun'     	=> $resulte['tahun'],                        
                        'tgl_rab'     	=> $resulte['tgl_rab'],
                        'tgl_hps'     	=> $resulte['tgl_hps'],
                        'tgl_upl'       => $resulte['tgl_upl'],
                        'tgl_spr'      	=> $resulte['tgl_spr'],                    
                        'tgl_pi'     	=> $resulte['tgl_pi'],
                        'tgl_bappd'     => $resulte['tgl_bappd'],
                        'tgl_baek'      => $resulte['tgl_baek'],
                        'tgl_bahp'      => $resulte['tgl_bahp'],                     
                        'tgl_nodi'     	=> $resulte['tgl_nodi'],
                        'tgl_sppjb'     => $resulte['tgl_sppjb'],
                        'tgl_spk'       => $resulte['tgl_spk'],
                        'tgl_sp'      	=> $resulte['tgl_sp'],                      
                        'tgl_spbj'     	=> $resulte['tgl_spbj'],
						'spbj'    	 	=> $resulte['spbj'],
                        'tgl_bapb1'     => $resulte['tgl_bapb1'],
                        'tgl_bapb2'     => $resulte['tgl_bapb2'],
                        'tgl_bast'      => $resulte['tgl_bast'],                      
                        'tgl_bapp'     	=> $resulte['tgl_bapp'],
                        'tgl_sk'     	=> $resulte['tgl_sk'],
                        'tgl_kuitansi'  => $resulte['tgl_kuitansi'],
                        'tgl_ssp'      	=> $resulte['tgl_ssp'],
						'tgl_faktur'  	=> $resulte['tgl_faktur'],                      
                        'tgl_spt'     	=> $resulte['tgl_spt'],                     
                        'tgl_rngks_kntrk'     	=> $resulte['tgl_rngks_kntrk'],
                        'no_upl'     	=> $resulte['no_upl'],
                        'no_spr'        => $resulte['no_spr'],
                        'no_bappd'      => $resulte['no_bappd'],
						'no_baek'  		=> $resulte['no_baek'],                      
                        'no_bahp'     	=> $resulte['no_bahp'],
                        'no_nodi'    	=> $resulte['no_nodi'],
						'no_sppjb'      => $resulte['no_sppjb'],
                        'no_spk'      	=> $resulte['no_spk'],
						'no_sp'  		=> $resulte['no_sp'],                      
                        'ket_spbj'     	=> $resulte['ket_spbj'],
                        'no_bapb1'     	=> $resulte['no_bapb1'],
                        'no_bapb2'      => $resulte['no_bapb2'],
                        'no_bast'      	=> $resulte['no_bast'],
						'no_bapp'  		=> $resulte['no_bapp'],                      
                        'no_spt'     	=> $resulte['no_spt'],                      
                        'wkt_pel'     	=> $resulte['wkt_pel'],                      
                        'jns_pem'     	=> $resulte['jns_pem']                                                                                                                                                          
                        );
                       // $ii++;
        }           
        echo json_encode($result);
        //$query1->free_result(); 
    }
	
   function pld_plbrg(){
        
        $csql = $this->input->post('sql');
        $nodok = $this->input->post('nodok');    
        $sql  = "insert into pld_form_isian(no_transaksi,uraian,satuan,vol,harga,jumlah)"; 
        $asg  = $this->db->query($sql.$csql);
        if($asg){
          $csql = "SELECT SUM(total) AS total from pld_form_isian where no_transaksi = '$nodok' ";
          $rs = $this->db->query($csql)->row() ;  
          if($rs){       
                $sql2 = "update plh_form_isian set total ='$rs->total'  where no_transaksi='$nodok' ";
                $asg2 = $this->db->query($sql2);   
            }
            
           echo number_format($rs->total); 
        }else{
           echo 'Data Tidak Tersimpan';
        } 
         
    }
  function hapus_pl_isian(){
        $nomor 	= $this->input->post('no');
        $skpd 	= $this->input->post('kd_skpd');
        $msg 	= array();
        $sql 	= "delete from plh_form_isian where no_transaksi='$nomor' and kd_uskpd='$skpd'";
        $asg 	= $this->db->query($sql);
		if ($asg){
			$sql = "delete from pld_form_isian where no_transaksi='$nomor' and unit_skpd='$skpd'";
            $asg = $this->db->query($sql); 
				   $sql2 = "delete from pl_lengkap where no_transaksi='$nomor' and kd_skpd='$skpd'";
				   $asg2 = $this->db->query($sql2); 
					$sq3 = "delete from pld_form_rincian where no_transaksi='$nomor' and kd_skpd='$skpd'";
					$as3 = $this->db->query($sq3); 
			if (!($asg)){
			  $msg = array('pesan'=>'0');
			  echo json_encode($msg);
			   exit();
			}else{
				$msg = array('pesan'=>'1');
				echo json_encode($msg);
				}
				/* if($asg1){
							
						} */
        } else {
            $msg = array('pesan'=>'0');
            echo json_encode($msg);
            exit();
        }/* 
        $msg = array('pesan'=>'1');
        echo json_encode($msg); */
    }

	function hapus_pld_isian(){
        $nomor1 = $this->input->post('no_transaksi');
       // $nomor2 = $this->input->post('kode');
        $nomor3 = $this->input->post('no');
        $skpd = $this->input->post('kd_skpd');
        $kode = $this->input->post('kode');
        $kodegiat = $this->input->post('kodegiat');
        $msg = array();
        $sql = "delete from pld_form_isian where no_transaksi='$nomor1' and no='$nomor3' and unit_skpd='$skpd' and kode='$kode' 
		and kodegiat='$kodegiat'";
        $asg = $this->db->query($sql);
			
        $sql2 = "delete from pld_form_rincian where no_transaksi='$nomor1' and no='$nomor3' and kd_skpd='$skpd' and kode='$kode' 
		and kodegiat='$kodegiat'";
        $asg = $this->db->query($sql2);
         
		 if (!($asg)){
              $msg = array('pesan'=>'0');
              echo json_encode($msg);
               exit();
            } 
        else 
        $msg = array('pesan'=>'1');
        echo json_encode($msg);
    }
 function pld_lengkapan(){
        
        $csql  	  = $this->input->post('sql');
        $no_trans = $this->input->post('no_trans'); 
        $kd_skpd  = $this->input->post('ckd_skpd'); 
        $simakda  = $this->input->post('simakda');  
        $simakda2  = $this->input->post('simakda2'); 
		$sql  = "delete from pl_lengkap where no_transaksi='$no_trans' and kd_skpd='$kd_skpd'";
		$asg  = $this->db->query($sql);		
		if($asg){
		 $sql  = "insert into pl_lengkap(no_transaksi,kd_skpd,tahun,tgl_rab,tgl_hps,tgl_upl,tgl_spr,tgl_pi,tgl_bappd,tgl_baek,tgl_bahp,tgl_nodi,tgl_sppjb,tgl_spk,tgl_sp,tgl_spbj,spbj,tgl_bapb1,tgl_bapb2,tgl_bast,tgl_bapp,tgl_sk,tgl_kuitansi,tgl_ssp,tgl_faktur,tgl_spt,tgl_rngks_kntrk,no_upl,no_spr,no_bappd,no_baek,no_bahp,no_nodi,no_sppjb,no_spk,no_sp,ket_spbj,no_bapb1,no_bapb2,no_bast,no_bapp,no_spt,wkt_pel,jns_pem)"; 
		 $asg  = $this->db->query($sql.$csql);
		 $asgx = $this->mdata->conn($simakda);
		 $asgxx = $this->mdata->conn($simakda2);

        }
		}
		/*if($asg){
          $csql2 = "insert into pl_lengkap(tgl_rab,tgl_hps,tgl_upl,tgl_spr,tgl_pi,tgl_bappd,tgl_baek,tgl_bahp,tgl_nodi,tgl_sppjb,tgl_spk,tgl_sp,tgl_spbj,spbj,tgl_bapb1,tgl_bapb2,tgl_bast,tgl_bapp,tgl_sk,tgl_kuitansi,tgl_ssp,tgl_faktur,tgl_spt,no_upl,no_spr,	no_bappd,no_baek,no_bahp,no_nodi,no_sppjb,no_spk,no_sp,ket_spbj,no_bapb1,no_bapb2,no_bast,no_bapp,no_spt)";
          $rs = $this->db->query($csql2.$csql);  
          if($rs){       
                $sql2 = "update pl_lengkap set total ='$rs->total' where no_transaksi='$nodok' ";
                $asg2 = $this->db->query($sql2);   
            }
            
           echo number_format($rs->total); 
        }else{
           echo 'Data Tidak Tersimpan';
        } */
    
	
	function ctk_bap1 (){
		$konfig 	= $this->ambil_config();
		$kota  		= $konfig['kota'];
		$kota2 		= strtoupper($konfig['kota']);
		$prov 		= strtoupper($konfig['nm_client']);
		$thn  		= $this->session->userdata('ta_simbakda');
		$nm_skpd	= strtoupper($this->session->userdata('nama_simbakda'));
        $konfig		= $this->ambil_config();
		//$nmkab=strtoupper($konfig['nm_client']);
        $logo 		= $konfig['logo'];
		$no 		= $_REQUEST['nomor'];
		$csql 		= "SELECT a.kd_uskpd,a.kegiatan,a.nm_kegiatan,a.keterangan,b.nama,b.jabatan,b.nama_singkat,b.pangkat,b.nip,a.rekanan,c.tgl_rab,
(SELECT nama FROM mpejabat WHERE a.staf_penerima=kode) AS staf_penerima,
(SELECT jabatan FROM mpejabat WHERE a.staf_penerima=kode ) AS jabatan_penerima,
(SELECT nama_singkat FROM mpejabat WHERE a.staf_penerima=kode ) AS nama_singkat_penerima, 
(SELECT pangkat FROM mpejabat WHERE a.staf_penerima=kode ) AS pangkat_penerima,
(SELECT nip FROM mpejabat WHERE a.staf_penerima=kode ) AS nip_penerima, 
 
(SELECT nama FROM mpejabat WHERE a.ketua=kode ) AS ketua, 
(SELECT jabatan FROM mpejabat WHERE a.ketua=kode ) AS jabatan_ketua,
(SELECT nama_singkat FROM mpejabat WHERE a.ketua=kode ) AS nama_singkat_ketua, 
(SELECT pangkat FROM mpejabat WHERE a.ketua=kode ) AS pangkat_ketua,
(SELECT nip FROM mpejabat WHERE a.ketua=kode ) AS nip_ketua, 

(SELECT nama FROM mpejabat WHERE a.anggota_satu=kode ) AS anggota_satu,
(SELECT jabatan FROM mpejabat WHERE a.anggota_satu=kode ) AS jabatan_anggota_satu,
(SELECT nama_singkat FROM mpejabat WHERE a.anggota_satu=kode ) AS nama_singkat_anggota_satu, 
(SELECT pangkat FROM mpejabat WHERE a.anggota_satu=kode ) AS pangkat_anggota_satu,
(SELECT nip FROM mpejabat WHERE a.anggota_satu=kode ) AS nip_anggota_satu, 
 
(SELECT nama FROM mpejabat WHERE a.anggota_dua=kode ) AS anggota_dua, 
(SELECT jabatan FROM mpejabat WHERE a.anggota_dua=kode ) AS jabatan_anggota_dua,
(SELECT nama_singkat FROM mpejabat WHERE a.anggota_dua=kode ) AS nama_singkat_anggota_dua, 
(SELECT pangkat FROM mpejabat WHERE a.anggota_dua=kode ) AS pangkat_anggota_dua,
(SELECT nip FROM mpejabat WHERE a.anggota_dua=kode ) AS nip_anggota_dua

FROM plh_form_isian a INNER JOIN mpejabat b ON a.pptk=b.kode 
LEFT JOIN pl_lengkap c ON a.no_transaksi=c.no_transaksi WHERE a.no_transaksi='$no'";
                           
						   $hasil = $this->db->query($csql);
							$i = 0;
						foreach ($hasil->result() as $rowi){
	   $cRet  = '';
          $cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">

                  <tr>
                    <td colspan=\"2\" style=\"border: solid 1px white;\">
                    <table border=\"0\" width=\"100%\">
                        <tr>
                            <td rowspan=\"4\" width=\"10%\" style=\"font-size:12px;border: solid 1px white;\">
                            <img src=\"".base_url()."/data/$logo\" width=\"80px\" height=\"80px\" alt=\"\" />
                            </td>
                            <td width=\"90%\" align=\"center\" style=\"font-size:14px;border: solid 1px white\">
                            <b>PEMERINTAH $prov</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;border: solid 1px white\"><b>DINAS $nm_skpd</b>
                            </td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:10px;border: solid 1px white;\">Jl Urip Sumoharjo No.2 Makassar
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" style=\"font-size:8px;border: solid 1px white;\">
                                <hr/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" style=\"font-size:14px;\" align=\"center\">
                                <b><u>RENCANA ANGGARA BIAYA</u></b>
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
                            <td width=\"24%\" style=\"font-size:12px;\">Pekerjaan
                            </td>
                            <td width=\"1%\" style=\"font-size:12px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:12px;\">$rowi->keterangan
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:12px;\">Kegiatan
                            </td>
                            <td width=\"1%\" style=\"font-size:12px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:12px;\">$rowi->nm_kegiatan
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:12px;\">Tahun Anggaran
                            </td>
                            <td width=\"1%\" style=\"font-size:12px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:12px;\">$thn
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:12px;\">Kode Rekening 
                            </td>
                            <td width=\"1%\" style=\"font-size:12px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:12px;\">$rowi->kegiatan
                            </td>
                        </tr>
                        <tr>
                            <td width=\"24%\" style=\"font-size:12px;\">Sumber Dana
                            </td>
                            <td width=\"1%\" style=\"font-size:12px;\">:
                            </td>
                            <td  width=\"75%\" style=\"font-size:12px;\">APBD $prov Tahun Anggaran $thn
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
                                        <td bgcolor=\"#CCCCCC\" align=\"center\">NO</td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\">URAIAN</td>
                                        <td bgcolor=\"#CCCCCC\"  align=\"center\">SATUAN</td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\">KUANTITAS</td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\">HARGA SATUAN (Rp)</td>
                                        <td bgcolor=\"#CCCCCC\" align=\"center\">JUMLAH (Rp)</td>
                                    </tr>
									<tr>
                                        <td align=\"center\">1</td>
                                        <td align=\"center\">2</td>
                                        <td align=\"center\">3</td>
                                        <td align=\"center\">4</td>
                                        <td align=\"center\">5</td>
                                        <td align=\"center\">6=5x4</td>
                                    </tr>";
									
                              $csql = "SELECT b.uraian,b.satuan,b.vol,b.harga,b.jumlah FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE a.no_transaksi='$no'";
							  $hasil = $this->db->query($csql);
							  
							
								$i = 0;
								foreach ($hasil->result() as $row)
								{
									$i++;
									$cRet .="       
                                    <tr>
                                        <td align=\"center\">$i</td>
                                        <td align=\"left\">$row->uraian</td>
                                        <td align=\"center\">$row->satuan</td>
                                        <td align=\"center\">$row->vol</td>
                                        <td align=\"center\">".number_format($row->harga)."</td>
                                        <td align=\"center\">".number_format($row->jumlah)."</td>
                                    </tr>";
                                    }
									$tot = "SELECT SUM(b.jumlah) as tot FROM plh_form_isian a INNER JOIN pld_form_isian b ON a.no_transaksi=b.no_transaksi WHERE a.no_transaksi='$no'";
                                     $total = $this->db->query($tot);
									 foreach ($total->result() as $row)
								{
                              $cRet .="<tr>
                                        <td align=\"center\" colspan=\"5\">JUMLAH</td>
										<td align=\"center\">".number_format($row->tot)."</td>
                                    </tr>
                                </table>";}
                             $cRet .="</td>
                        </tr>
                    </table>
                    </td>
                  </tr>
				  <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                  <tr><td width=\"5%\"></td><td align=\"left\" colspan=\"3\">Terbilang :<i>(".$this->mdata2->terbilang($row->tot).")</i></td></tr>
				  <tr><td width=\"5%\"></td><td align=\"left\" colspan=\"3\"><i>Harga Telah Termasuk Kewajiban Pajak</i></td></tr>
				  </table><br/><br/>
                <tr>
                    <td colspan=\"2\" style=\"padding-left:5%;padding-right:2%;\">
                        <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                            <tr>
                                <td width=\"40%\" valign=\"top\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr><td></td>
                                            <td align=\"center\"><br>$rowi->jabatan<br>
                                            $nm_skpd<br>SELAKU $rowi->nama_singkat<br><br><br><br>
                                            <u>$rowi->nama</u><br>Pangkat: $rowi->pangkat<br>Nip. $rowi->nip
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width=\"30%\">
                                </td>
                                <td width=\"40%\">
                                    <table border=\"0\" width=\"100%\" style=\"font-size:12px;\">
                                        <tr>
                                            <td colspan=\"2\" align=\"center\">
											 Makassar,$rowi->tgl_rab<br><br>
                                                $rowi->nama_singkat_penerima<br><br><br><br><br>
												<u>$rowi->staf_penerima</u><br>Nip. $rowi->nip_penerima
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
                                            <td align=\"center\">Mengetahui<br>
                                            $rowi->jabatan_ketua<br>SELAKU  $rowi->nama_singkat_ketua<br><br><br><br><br>
                                            <u>$rowi->ketua</u><br>Pangkat: $rowi->pangkat_ketua<br>Nip. $rowi->nip_ketua
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
	
  function ambil_config(){

        $csql = " select * from config ";
        $query1 = $this->db->query($csql);  
        foreach($query1->result_array() as $resulte)
        { 
            $resulte = array(              
                         'nm_client' 	=> $resulte['nm_client'],                                              					
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

   function laporan_satu()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN APL';
        $this->template->set('title', 'CETAK LAPORAN APL');   
        $this->template->load('index','simpl/lap_apl_satu',$data) ;
        } 
    }

	  function cetak_realisasi()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN REALISASI';
        $this->template->set('title', 'CETAK LAPORAN REALISASI');   
        $this->template->load('index','simpl/lap_realisasi',$data) ;
        } 
    }
	
	  function cetak_realisasi_lain()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'CETAK LAPORAN REALISASI';
        $this->template->set('title', 'CETAK LAPORAN REALISASI DAN LAINNYA');   
        $this->template->load('index','simpl/lap_realisasi_lain',$data) ;
        } 
    }
	
}