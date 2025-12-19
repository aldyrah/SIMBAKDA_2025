<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bhp extends CI_Controller {
        
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
    
    function list_bhp()
    {
        $data['page_title']= 'INPUT LIST BHP';
        $this->template->set('title', 'INPUT LIST BHP');   
        $this->template->load('index','bhp/list_bhp',$data) ; 
    }
	
	  function bhp_keluar()
    {
        $data['page_title']= 'INPUT LIST BHP';
        $this->template->set('title', 'INPUT LIST BHP');   
        $this->template->load('index','bhp/bhp_keluar',$data) ; 
    }
	
	  function bhp_masuk()
    {
        $data['page_title']= 'INPUT LIST BHP';
        $this->template->set('title', 'INPUT LIST BHP');   
        $this->template->load('index','bhp/bhp_masuk',$data) ; 
    }
	
	
	function load_brghbs() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';

        if ($kriteria <> ''){                               
            $where="where nama like'%$kriteria%' or spek like '%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mbarang_hbs  $where order by kode");
        $trh = $rs->row();
		
        $sql = "SELECT * FROM mbarang_hbs $where order by kode limit $offset,$rows";
        $query1 = $this->db->query($sql);  
		
        $ii = 0;
        foreach($query1->result_array() as $resulte)
         { 
            $coba[] = array(
                        'id' 		=> $ii,        
                        'kode' 		=> $resulte['kode'],
                        'nama' 		=> $resulte['nama'],
                        'tipe' 		=> $resulte['tipe'],
                        'header' 	=> $resulte['header'],
                        'jenis' 	=> $resulte['jenis'],
                        'satuan' 	=> $resulte['satuan'],
                        'spek' 		=> $resulte['spek']                                                                               
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
	
    function load_mbarang_hbs() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';

        if ($kriteria <> ''){                               
            $where="where nama like'%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mbarang_hbs where nama like'%$kriteria%' order by kode");
        $trh = $rs->row();
        $sql = "SELECT * FROM mbarang_hbs where nama like'%$kriteria%' order by kode limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' 		=> $ii,        
                        'kode' 		=> $resulte['kode'],
                        'nama' 		=> $resulte['nama'],
                        'tipe' 		=> $resulte['tipe'],
                        'header' 	=> $resulte['header'],
                        'jenis' 	=> $resulte['jenis'],
                        'satuan' 	=> $resulte['satuan'],
                        'spek' 		=> $resulte['spek']                                                                               
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
    
    function ambil_golongan() {
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
            $where="where nama like'%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mbarang_hbs a $where order by kode");
        $trh = $rs->row();
        $sql = "SELECT * FROM mbarang_hbs WHERE LENGTH(RTRIM(kode))='2' $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' 		=> $ii,        
                        'kode' 		=> $resulte['kode'],
                        'nama' 		=> $resulte['nama']                                                                              
                        );
                        $ii++;
        }
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}	

    function ambil_bidang() {
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
            $where="where mbarang_hbs like'%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mbarang_hbs a $where order by kode");
        $trh = $rs->row();
        $sql = "SELECT * FROM mbarang_hbs WHERE LENGTH(RTRIM(kode))='4' $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' 		=> $ii,        
                        'kode' 		=> $resulte['kode'],
                        'nama' 		=> $resulte['nama']                                                                              
                        );
                        $ii++;
        }
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}

    function ambil_kelompok() {
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
            $where="where mbarang_hbs like'%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mbarang_hbs a $where order by kode");
        $trh = $rs->row();
        $sql = "SELECT * FROM mbarang_hbs WHERE LENGTH(RTRIM(kode))='6' $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' 		=> $ii,        
                        'kode' 		=> $resulte['kode'],
                        'nama' 		=> $resulte['nama']                                                                              
                        );
                        $ii++;
        }
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}

    function ambil_subkel() {
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
            $where="where mbarang_hbs like'%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mbarang_hbs a $where order by kode");
        $trh = $rs->row();
        $sql = "SELECT * FROM mbarang_hbs WHERE LENGTH(RTRIM(kode))='8' $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' 		=> $ii,        
                        'kode' 		=> $resulte['kode'],
                        'nama' 		=> $resulte['nama']                                                                              
                        );
                        $ii++;
        }
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}

function simpan_masuk_bhp(){

        $tabel  	= $this->input->post('tabel');
        $nomor  	= $this->input->post('no');
        $tgl    	= $this->input->post('tgl');
        $no_terima 	= $this->input->post('no_terima');
        $tgl_terima	= $this->input->post('tgl_terima');
        $unit  		= $this->input->post('unit');
        $skpd   	= $this->input->post('skpd');
        $giat   	= $this->input->post('giat');
        $nmuskpd 	= $this->input->post('nmuskpd');
        $tahun    	= $this->input->post('tahun');
        $total 		= $this->input->post('total');    
        $comp 		= $this->input->post('comp');  
        $cnmgiat    = $this->input->post('nmgiat');
        $kd_rek5    = $this->input->post('kd_rek5');
        $usernm     = $this->session->userdata('nmuser');
        $update     = date('y-m-d H:i:s');
        $nspj       = $this->input->post('nspj');  
        
        $msg        = array();
        
        if ($tabel == 'trh_masuk_bhp') {
		$sqlx = "delete from trh_masuk_bhp where skpd='$skpd' and no_dokumen='$nomor'";
		$asgx = $this->db->query($sqlx);
		$sqly = "update trd_masuk_bhp set kodegiat='$giat' where skpd='$skpd' and no_dokumen='$nomor'";
		$asgy = $this->db->query($sqly);
            if ($asgx){
                $sql = "insert into trh_masuk_bhp(no_dokumen,tgl_dokumen,unit,skpd,user,thang,total,nm_perush,no_terima,tgl_terima,kodegiat,namagiat,username,tgl_update,kd_rek5,nilai_spj) 
                                           values('$nomor','$tgl','$unit','$skpd','$nmuskpd','$tahun','$total','$comp','$no_terima','$tgl_terima','$giat','$cnmgiat','$usernm','$update','$kd_rek5','$nspj')";
                $asg = $this->db->query($sql);

                if (!($asg)){
                   $msg = array('pesan'=>'0');
                   echo json_encode($msg);
                    exit();
                } else {
                    $msg = array('pesan'=>'1');
                    echo json_encode($msg);
                }             
            } else {
                $msg = array('pesan'=>'0');
                echo json_encode($msg);
                exit();
            }
            
        }  
    }

function simpan_keluar_bhp(){
        $tabel  	= $this->input->post('tabel');
        $nomor  	= $this->input->post('no');
        
        $tgl    	= $this->input->post('tgl');
        $uskpd   	= $this->input->post('uskpd');
        $kdskpd   	= $this->input->post('kdskpd');
        $nmuskpd 	= $this->input->post('nmuskpd');
        $tahun    	= $this->input->post('tahun');
        $total 		= $this->input->post('total');   
        $kdruang 	= $this->input->post('kdruang');  
        $penerima 	= $this->input->post('penerima');   		
        $csql    	= $this->input->post('sql');
        $giat       = $this->input->post('giat');
        $nmgiat     = $this->input->post('nmgiat');
        $usernm     = $this->session->userdata('nmuser');
        $update     = date('y-m-d H:i:s');   
        $msg        = array();
        $plonline   = $this->session->userdata('plonline');
        $nomor_aset = $nomor.'.'.$kdskpd.'/'.'SIMBAKDA';
                $kdsql = "select nm_skpd from ms_skpd where kd_skpd='$kdskpd'";
                $kdasg = $this->db->query($kdsql);
                foreach($kdasg->result() as $row){
                    $nm_skpd=$row->nm_skpd;
                }

        if ($tabel == 'trh_keluar_bhp') {
            $sql = "delete from trh_keluar_bhp where unit='$uskpd' and no_dokumen='$nomor'";
            $asg = $this->db->query($sql);
            if ($asg){
                $sql = "insert into trh_keluar_bhp(no_dokumen,tgl_keluar,unit,skpd,user,thang,total,penerima,ruang,kodegiat,nm_kegiatan,username,tgl_update) 
                                            values('$nomor','$tgl','$uskpd','$kdskpd','$nmuskpd','$tahun','$total','$penerima','$kdruang','$giat','$nmgiat','$usernm','$update')";
                $asg = $this->db->query($sql);
                if (!($asg)){
                   $msg = array('pesan'=>'0');
                   echo json_encode($msg);
                    exit();
                } else {
                    $msg = array('pesan'=>'1');
                    echo json_encode($msg);
                }             
            } else {
                $msg = array('pesan'=>'0');
                echo json_encode($msg);
                exit();
            }
            
        }  

        if($plonline == '1') {
            $dbsimakda=$this->load->database('simakda', TRUE);
            $sqldelju = "delete from trhju_pkd where kd_skpd='$kdskpd' and no_voucher='$nomor_aset'";
            $asg      = $dbsimakda->query($sqldelju);
            if($asg){
                $sqlhju = "insert into trhju_pkd (no_voucher,tgl_voucher,kd_skpd,nm_skpd,ket,total_d,total_k,tabel,username,tgl_update) values 
                                            ('$nomor_aset','$tgl','$kdskpd','$nm_skpd','','$total','$total','93','$usernm','$update')";
                $query1 = $dbsimakda->query($sqlhju);
            }
              

        }
    }
	
	function simpan_bhp(){

		$kode		=trim($this->input->post('kode'));	
		$nama		=trim($this->input->post('nama'));	
		$header		=trim($this->input->post('header'));	
		$satuan     =trim($this->input->post('satuan'));
        
		$this->db->query(" update mbarang_hbs set nama='$nama',header='$header',satuan='$satuan' where kode='$kode' ");
		
	}

function simpan_barang(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $tabel  = $this->input->post('tabel');
        $lckolom = $this->input->post('kolom');
        $lcnilai = $this->input->post('nilai');
        $cid = $this->input->post('cid');
        $lcid = $this->input->post('lcid');
        
        $sql = "delete from $tabel where $cid='$lcid'";
        $asg = $this->db->query($sql);
        if($asg){
            $sql = "insert into $tabel $lckolom values $lcnilai";
            $asg = $this->db->query($sql);
        }}
    }
	
	function update_barang(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $query = $this->input->post('st_query');
        $asg = $this->db->query($query);
        }
    }
	
	 function trh_masukbhp(){  
        $skpd = $this->session->userdata('skpd');
        $oto  = $this->session->userdata('otori');
        $thn  = $this->session->userdata('ta_simbakda');
 
        /*$where1 = '';       
        if($oto == '01'){ 
            $where1 = "where a.unit like '%' ";
        }else{
            $where1 = "where a.unit ='$skpd'";// and thang='$thn'
        }*/

        $where1 = '';       
        if($oto == '01' && $skpd=='1.20.05.01'){
            $where1 = "where a.skpd like '%' ";
        }else if($oto == '01' && $skpd<>'1.20.05.01'){
            $where1 = "where a.skpd ='$skpd' ";
        }else if($oto=='02' && $skpd<>'1.20.05.01'){
            $where1 = "where a.skpd ='$skpd' ";
        }else if($oto=='02' && $skpd=='1.20.05.01'){
            $where1 = "where a.skpd like '%' ";
        }
        
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;        
        $kriteria = $this->input->post('cari');
        $where2 ='';
        if ($kriteria <> ''){                               
            $where2="and (upper(a.no_dokumen) like upper('%$kriteria%') or a.tgl_dokumen like '%$kriteria%' or upper(a.namagiat) like upper('%$kriteria%')) ";            
        }
        
        $sql = "SELECT count(*) as total FROM trh_masuk_bhp a 
				INNER JOIN trd_masuk_bhp b ON
				a.`skpd`=b.`skpd` AND a.`unit`=b.`unit` AND a.`no_dokumen`=b.`no_dokumen`
				$where1 $where2" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
       	$result["total"] = $total->total; 
        $query1->free_result(); 
        
        $sql = "SELECT a.no_dokumen,a.tgl_dokumen,a.unit,a.skpd,a.thang,a.total,
				a.nm_perush,a.user,a.no_terima,a.tgl_terima,b.kodegiat,a.namagiat,a.kd_rek5,a.nilai_spj
				FROM trh_masuk_bhp a 
				INNER JOIN trd_masuk_bhp b ON
				a.skpd=b.skpd AND a.unit=b.unit AND a.no_dokumen=b.no_dokumen
				$where1 $where2 GROUP BY a.`no_dokumen` limit $offset,$rows";
        $query1 = $this->db->query($sql);          
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $row[] = array(                        
                        'no_dokumen'    => $resulte['no_dokumen'],
                        'tgl_dokumen'   => $resulte['tgl_dokumen'],
                        'kd_unit'       => $resulte['unit'],
                        'kd_uskpd'      => $resulte['skpd'],
                        'nm_uskpd'      => $resulte['user'],
                        'tahun'         => $resulte['thang'],
                        'total'         => number_format($resulte['total'],2,'.',','),
                        'nm_kegiatan'   => $resulte['namagiat'],
                        'nm_perush'     => $resulte['nm_perush'],
                        'no_terima'     => $resulte['no_terima'],
                        'tgl_terima'    => $resulte['tgl_terima'],
                        'kodegiat'      => $resulte['kodegiat'],
                        'kd_rek5'       => $resulte['kd_rek5'],
                        'nspj'          => number_format($resulte['nilai_spj'],2,'.',','),
                        'nspj2'         => $resulte['nilai_spj']			                        			
                        );
                        $ii++;
        }
        $result["rows"] = $row; 
        echo json_encode($result);
        $query1->free_result();                 	   
	}
	
	 function trd_masukbhp(){
        $nomor = $this->input->post('no'); 
        $skpd  = $this->input->post('skpd'); 
		
		$csql = "SELECT SUM(total) AS total from 
				 trd_masuk_bhp where no_dokumen='$nomor' and skpd='$skpd'";
		$rs = $this->db->query($csql)->row();
		
        $sql = "SELECT b.*,a.nm_perush,a.unit,a.skpd,a.tgl_dokumen,a.no_terima,a.tgl_terima 
		FROM trh_masuk_bhp a 
		INNER JOIN trd_masuk_bhp b ON a.no_dokumen=b.no_dokumen 
		and a.unit=b.unit and a.skpd=b.skpd
        WHERE a.no_dokumen = '$nomor' and a.skpd='$skpd'";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(  
                        'idx'           => $ii, 		
                        'unit'    		=> $resulte['unit'],
                        'skpd' 		   	=> $resulte['skpd'],
                        'tgl_dokumen'  	=> $resulte['tgl_dokumen'],
                        'nm_perush'    	=> $resulte['nm_perush'], 
                        'no_dokumen'    => $resulte['no_dokumen'],                      
                        'kode_brg'      => $resulte['kode_brg'],
                        'detail_brg'    => $resulte['detail_brg'],
                        'merk'          => $resulte['merk'],
                        'jumlah'        => $resulte['jumlah'],
                        'harga'         => $resulte['harga'],
                        'total'         => $resulte['total'], 
						'jml_tot'		=> $rs->total,
                        'keterangan'    => $resulte['keterangan'],
                        'kodegiat'      => $resulte['kodegiat'],
                        'satuan'        => $resulte['satuan'],
                        'sdana'         => $resulte['sdana'],                        
                        'asal'          => $resulte['asal'],
                        'no_terima'     => $resulte['no_terima'],                        
                        'tgl_terima'    => $resulte['tgl_terima']                                                                                                                                                           
                        );
                        $ii++;
        }           
        echo json_encode($result);
    }
	
	
	function trh_keluarbhp(){  
        $skpd = $this->session->userdata('skpd');
        $oto  = $this->session->userdata('otori');
        $thn  = $this->session->userdata('ta_simbakda');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where a.unit like '%' ";
        }else{
            $where1 = "where a.unit ='$skpd' ";
        }

        $where1 = '';       
        if($oto == '01' && $skpd=='1.20.05.01'){
            $where1 = "where a.skpd like '%' ";
        }else if($oto == '01' && $skpd<>'1.20.05.01'){
            $where1 = "where a.skpd ='$skpd' ";
        }else if($oto=='02' && $skpd<>'1.20.05.01'){
            $where1 = "where a.skpd ='$skpd' ";
        }else if($oto=='02' && $skpd=='1.20.05.01'){
            $where1 = "where a.skpd like '%' ";
        }
        
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;        
        $kriteria = $this->input->post('cari');
        $where2 ='';
        if ($kriteria <> ''){                               
            $where2="and (upper(a.no_dokumen) like upper('%$kriteria%') or a.tgl_keluar like '%$kriteria%' or upper(c.nm_kegiatan) like upper('%$kriteria%')) ";            
        }
        
        $sql = "SELECT count(*) as total from trh_keluar_bhp a 
				INNER JOIN trd_keluar_bhp b ON
				a.`skpd`=b.`skpd` AND a.`unit`=b.`unit` AND a.`no_dokumen`=b.`no_dokumen`
				$where1 $where2 " ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
       	$result["total"] = $total->total; 
        $query1->free_result(); 
        
        $sql = "SELECT a.no_dokumen,a.tgl_keluar,a.penerima,
				a.unit,a.skpd,a.thang,a.total,a.user,a.keterangan,a.ruang,a.nm_kegiatan 
				FROM trh_keluar_bhp a INNER JOIN trd_keluar_bhp b ON
				a.skpd=b.skpd AND a.unit=b.unit AND a.no_dokumen=b.no_dokumen
				$where1 $where2 GROUP BY a.no_dokumen
				ORDER BY a.no_dokumen,a.tgl_keluar,a.no_dokumen,a.skpd 
				 limit $offset,$rows";
        $query1 = $this->db->query($sql);          
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $row[] = array(                        
                        'no_dokumen'    => $resulte['no_dokumen'],
                        'tgl_dokumen'   => $resulte['tgl_keluar'],
                        'kd_uskpd'      => $resulte['skpd'],
                        'kd_unit'       => $resulte['unit'],
                        'nm_uskpd'      => $resulte['user'],
                        'tahun'         => $resulte['thang'],
                        'total'         => $resulte['total'],
                        'penerima'      => $resulte['penerima'],
                        'ruang'      	=> $resulte['ruang'],
                        'nm_kegiatan'   => $resulte['nm_kegiatan']		                        			
                        );
                        $ii++;
        }
        $result["rows"] = $row; 
        echo json_encode($result);
        $query1->free_result();                 	   
	}
	
	 function trd_keluarbhp(){
        $nomor = $this->input->post('no');
        $skpd  = $this->input->post('kode');         
        $sql = "SELECT a.* FROM trd_keluar_bhp a 
		INNER JOIN trh_keluar_bhp b ON b.no_dokumen=a.no_dokumen
		and b.unit=a.unit and b.skpd=a.skpd		
		WHERE b.unit='$skpd' and b.no_dokumen='$nomor'";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(   		
                        'no_dokumen'    => $resulte['no_dokumen'],                      
                        'kode_brg'        => $resulte['kd_brg'],
                        'detail_brg'    => $resulte['detail_brg'],
                        'merk'          => $resulte['merk'],
                        'jumlah'        => $resulte['jumlahbrg'],
                        'harga'         => $resulte['harga'],
                        'total'         => $resulte['totjumlah'],
                        'satuan'        => $resulte['satuan'],     
                        'untuk'  	  	=> $resulte['peruntukan'],
                        'kodegiat'      => $resulte['kodegiat'],                   
                        'keterangan'    => $resulte['keterangan'],                   
                        'sisa'    		=> '',
                        'tgl_dokumen'	=> ''                      						
                        );
                        $ii++;
        }           
        echo json_encode($result);
    }	
	
	 function trd_stock(){
        $nomor = $this->input->post('no');
        $skpd  = $this->input->post('kode');    
        $giat  = $this->input->post('kodegiat');      
			$sql = "SELECT sisa,detail_brg,harga,kode_brg FROM(SELECT (IFNULL(SUM(a.jml_masuk),0)-IFNULL(SUM(a.jml_keluar),0)) AS sisa,a.detail_brg,a.harga,a.kode_brg FROM
					thistory_bhp a 
					WHERE a.skpd='$skpd' 
					AND a.kodegiat='$giat'
					GROUP BY a.kode_brg) aa WHERE sisa<>'0' order by kode_brg";	
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(   		
                        'nama'     => $resulte['detail_brg'],                      
                        'sisa'     => $resulte['sisa'], 
                        'harga'    => number_format($resulte['harga'])                                                                                                                                                      
                        );
                        $ii++;
        }           
        echo json_encode($result);
    }
	
    function test(){
        $online = $this->session->userdata('plonline');
        echo $online;
    }


    function ambil_nomor_trans() { 
    $dbsimakda=$this->load->database('simakda', TRUE);
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        
        $skpd       = $this->session->userdata('skpd');
        $oto        = $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = " a.kd_skpd like '%' ";
        }else{
            $where1 = " a.kd_skpd ='$skpd' ";
        }       
        //$skpd= $this->input->post('kdskpd');  
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 =" and UPPER(a.no_bukti) LIKE UPPER('%$lccr%') ";
        }
        
        /*$sql    = "SELECT a.no_bukti,a.tgl_bukti,a.kd_skpd,a.nm_skpd,b.nilai,b.kd_kegiatan,b.nm_kegiatan,b.kd_rek5 FROM trhtransout a INNER JOIN trdtransout b ON a.no_bukti=b.no_bukti
                   WHERE b.kd_rek5 IN ('5220101','5220102','5220103','5220104','5220105','5220106','5220107',
                   '5220108','5220109','5220110','5220111','5220112','5220113','5220201','5220202','5220203','5220204',
                   '5220205','5220207','5220208','5220209','5220210','5220305','5221101','5221102','5221103','5221104','5221105','5221106',
                   '5221201','5221202','5221203','5221204','5221205','5221206','5221207','5221301','5221302','5221401','5221402','5221403','5221404',
                   '5221405','5222005','5222003','5222006','5222007','5222008','5222009','5222010','5222011','5222012','5222013','5222014','5222015','5222016'
                   ) and $where1 AND a.no_bukti NOT IN (SELECT a.no_dokumen FROM simbakda_biak.trh_masuk_bhp a JOIN simbakda_biak.trd_masuk_bhp b ON a.no_dokumen=b.no_dokumen) $where2 ORDER BY a.tgl_bukti,a.no_bukti";*/
$sql    = "SELECT a.no_bukti,a.tgl_bukti,a.kd_skpd,a.nm_skpd,b.nilai,b.kd_kegiatan,b.nm_kegiatan,b.kd_rek5 FROM trhtransout a INNER JOIN trdtransout b ON a.no_bukti=b.no_bukti
                   WHERE b.kd_rek5 IN ('5220101','5220102','5220103','5220104','5220105','5220106','5220107',
                   '5220108','5220109','5220110','5220111','5220112','5220113','5220201','5220202','5220203','5220204',
                   '5220205','5220207','5220208','5220209','5220210','5220305'
                   ) and $where1 AND a.no_bukti NOT IN (SELECT a.no_dokumen FROM simbakda_biak.trh_masuk_bhp a JOIN simbakda_biak.trd_masuk_bhp b ON a.no_dokumen=b.no_dokumen) $where2 ORDER BY a.tgl_bukti,a.no_bukti";


        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'          => $ii,        
                        'no_bukti'    => $resulte['no_bukti'],
                        'tgl_bukti'   => $resulte['tgl_bukti'],
                        'kd_skpd'     => $resulte['kd_skpd'],
                        'nm_skpd'     => $resulte['nm_skpd'],
                        'nilai2'      => number_format($resulte['nilai'],2,'.',','),
                        'nilai'       => $resulte['nilai'],
                        'kd_kegiatan' => $resulte['kd_kegiatan'],
                        'nm_kegiatan' => $resulte['nm_kegiatan'],
                        'kd_rek5'     => $resulte['kd_rek5']
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
    }



	  function dana() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$lccr = $this->input->post('bidang');
        $sql = "SELECT * FROM mdana";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kd_sumberdana'],  
                        'nama' => $resulte['nm_sumberdana']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
	}
	
	   function ambil_giat() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $skpd = $this->session->userdata('skpd'); 
        $oto  = $this->session->userdata('otori');
		if($oto=='01'){
			$where ="WHERE kd_skpd like '%'";
		}else{
			$where ="WHERE kd_skpd='$skpd'";
		}
		
        $lccr = $this->input->post('q');
		$where2="";
		if($lccr<>''){
		 $where2="and upper(kd_kegiatan) like upper('%$lccr%') 
		or upper(nm_kegiatan) like upper('%$lccr%')";}
		
        $sql = "SELECT kd_kegiatan,nm_kegiatan FROM trskpd 
				$where $where2 order by kd_kegiatan";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kd_kegiatan'],  
                        'nama' => $resulte['nm_kegiatan']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}

    function ambil_keg_dh() { 
        $dbsimakda=$this->load->database('simakda', TRUE);
               
        $skpd= $this->input->post('skpd');  
        $lccr = $this->input->post('q');
        
          $where2='';
        if($lccr <> ''){
            $where2 =" and (UPPER(kd_kegiatan) LIKE UPPER('%$lccr%') OR UPPER(nm_kegiatan) LIKE UPPER('%$lccr%'))  ";
        }
        
        $sql    = "SELECT kd_kegiatan,nm_kegiatan FROM trdrka WHERE LEFT(kd_rek5,3)='522' AND kd_skpd='$skpd' group by kd_kegiatan order by kd_kegiatan ";
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'        => $ii,        
                        'kode' => $resulte['kd_kegiatan'],
                        'nama' => $resulte['nm_kegiatan']
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
	
	function ambil_giat_keluar() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        /*$skpd = $this->session->userdata('skpd'); 
        $oto  = $this->session->userdata('otori');
		if($oto=='01'){
			$where ="WHERE a.skpd like '%'";
		}else{
			$where ="WHERE a.skpd='$skpd'";
		}*/
		$skpd = $this->input->post('skpd');
        $unit = $this->input->post('unit');
        $lccr = $this->input->post('q');
		$where2="";
		if($lccr<>''){
		 $where2="and upper(a.namagiat) like upper('%$lccr%')";}
		
        $sql = "SELECT a.kodegiat,a.namagiat FROM trh_masuk_bhp a
				WHERE a.skpd='$skpd' and a.unit='$unit' $where2 
				GROUP BY a.kodegiat ORDER BY a.kodegiat";
				
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' 	=> $ii,        
                        'kode'  => $resulte['kodegiat'],  
                        'nama'  => $resulte['namagiat']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
	function load_idmax() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$skpd 	  = $this->input->post('skpd');
		$table	  = $this->input->post('table');
		$kolom	  = $this->input->post('kolom');
        $where 	  = '';

        if ($skpd <> ''){                               
            $where="where unit='$skpd'";            
        }
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
        
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}	
	
	function min_sisa() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$skpd 	  = $this->input->post('skpd');
		$kd_brg	  = $this->input->post('brg');
		$table	  = $this->input->post('table');
		$kolom1	  = $this->input->post('kolom1');
		$kolom2	  = $this->input->post('kolom2');
        $where 	  = '';

        if ($skpd <> ''){                               
            $where="where skpd='$skpd' AND kode_brg='$kd_brg'";            
        }
        $sql = "SELECT ifnull((SUM($kolom1)-SUM($kolom2)),0) AS sisa FROM $table $where";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba= array(
                        'min' 			=> $resulte['sisa']                                                                              
                        );
                        //$ii++;
        }
        
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
	
	
	function asal() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$lccr = $this->input->post('kelompok');
        $sql = "SELECT * FROM cara_peroleh order by kd_cr_oleh";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kd_cr_oleh'],  
                        'nama' => $resulte['cara_peroleh']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
	function ambil_brg() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $ckdrek   = $this->input->post('kdrekbrg');
        $kode5    = $this->input->post('kode5');

		$where="";
		if($ckdrek!=''){
		  $where="and b.kd_barang not in ($ckdrek) and upper(b.nm_barang) like upper('%$lccr%')";
		}else{
		  $where="and upper(b.nm_barang) like upper('%$lccr%')";
		}
        /*$sql = "SELECT * FROM mbarang_hbs 
		WHERE LENGTH(RTRIM(kode))>='9' $where order by kode";*/
        $sql = "SELECT a.satuan,a.harga,a.spek,b.kd_barang,b.nm_barang from map_bph b join mbarang_hbs a on b.kd_barang=a.kode where b.kd_rek5='$kode5' $where order by kd_barang";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_brg' => $resulte['kd_barang'],  
                        'nm_brg' => $resulte['nm_barang'],   
                        'satuan' => $resulte['satuan'],   
                        'harga'  => $resulte['harga'],
                        'spek' 	 => $resulte['spek']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
	function ambil_jenis_brg() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$skpd = $this->session->userdata('skpd'); 
        $oto  = $this->session->userdata('otori');	
        $lccr = $this->input->post('q');
		
		if($oto=='01'){
		$where  = "WHERE a.skpd like '%'";
		}else{
		$where  = "WHERE a.skpd='$skpd'";
		}
		
		$where2 ="";
		if($lccr<>''){
		$where2 ="and upper(b.nama) like upper('%$lccr%')";
		}
		
        $sql = "SELECT a.kode_brg,a.detail_brg,a.satuan_brg,a.spek,b.kode,b.nama FROM thistory_bhp a INNER JOIN mbarang_hbs b ON LEFT(a.kode_brg,8)=b.kode
		        $where $where2 group by a.kode_brg order by a.kode_brg";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_brg' => $resulte['kode'],  
                        'nm_brg' => $resulte['nama'],
                        'satuan' => $resulte['satuan_brg'],
                        'spek'   => $resulte['spek']  
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
	function ambil_brg_keluar() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $skpd = $this->input->post('skpd');
        $giat = $this->input->post('giat');
		//$skpd = $this->session->userdata('skpd'); 
        $oto  = $this->session->userdata('otori');
		
		if($oto=='01'){
		$where ="where a.skpd like '%'";	
		}else{
		$where ="where a.skpd='$skpd' AND a.kodegiat='$giat'";
			
		}
		
		$where2="";
		if($lccr<>''){
		$where2="and upper(b.nama) like upper('%$lccr%')";
		}
		
        /* $sql = "SELECT a.*,b.nama,c.tgl_dokumen FROM trd_masuk_bhp a 
				INNER JOIN mbarang_hbs b ON b.kode=a.kode_brg 
				left join trh_masuk_bhp c on c.no_dokumen=a.no_dokumen 
				and c.skpd=a.skpd and c.unit=a.unit	
				WHERE a.unit='$unit' AND a.kodegiat='$giat' $where order by kode"; */
		$sql = "SELECT a.kode_brg,a.unit,a.skpd,a.detail_brg,a.merk,
				IFNULL(SUM(a.jumlah),0)AS jumlah,IFNULL(SUM(a.jumlah),0)-(SELECT IFNULL(SUM(jumlahbrg),0) FROM trd_keluar_bhp WHERE kd_brg=a.kode_brg AND kodegiat=a.kodegiat)AS sisa,a.harga,a.total,a.koderek,a.keterangan,
				a.satuan,a.kodegiat,a.cad,a.sdana,a.asal,b.nama,b.spek,
				c.tgl_dokumen FROM trd_masuk_bhp a 
				INNER JOIN mbarang_hbs b ON b.kode=a.kode_brg 
				left join trh_masuk_bhp c on c.no_dokumen=a.no_dokumen 
				and c.skpd=a.skpd and c.unit=a.unit	
				left join trd_keluar_bhp d on d.no_dokumen=a.no_dokumen 
				and d.skpd=a.skpd and d.unit=a.unit
				where a.skpd='$skpd' AND a.kodegiat='$giat' $where2 GROUP BY a.kode_brg order by a.kode_brg"; 		//(a.jumlah-d.jumlahbrg) as tot,
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'idx' => $ii,        
                        'kd_brg' 	 => $resulte['kode_brg'],  
                        'nm_brg'	 => $resulte['nama'],    
                        'spek'	 	 => $resulte['spek'],  
                        'tgl_dokumen'=> $resulte['tgl_dokumen'], 
						'unit' 		 => $resulte['unit'],
						'skpd' 		 => $resulte['skpd'],
						'detail_brg' => $resulte['detail_brg'],
						'merk' 		 => $resulte['merk'],
						'jumlah' 	 => $resulte['jumlah'],
						//'jml_sisa' 	 => $resulte['tot'],
						'sisa' 		 => $resulte['sisa'],
						'harga' 	 => $resulte['harga'],
						'total' 	 => $resulte['total'],
						'koderek' 	 => $resulte['koderek'],
						'keterangan' => $resulte['keterangan'],
						'satuan' 	 => $resulte['satuan'],
						'kodegiat' 	 => $resulte['kodegiat'],
						'cad' 		 => $resulte['cad'],
						'sdana' 	 => $resulte['sdana'],
						'asal' 		 => $resulte['asal']

                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
	function ambil_stock_brg(){
		  if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$skpd 	  = $this->input->post('skpd');
		$table	  = $this->input->post('table');
		$kd_brg	  = $this->input->post('kd_brg');
		$giat	  = $this->input->post('giat');
		$harga	  = $this->input->post('harga');
        $where 	  = '';

        if ($skpd <> ''){                               
            $where="where skpd='$skpd' AND kode_brg='$kd_brg' and kodegiat='$giat' "; //GROUP BY harga           
        }
		
        $sql = "SELECT (IFNULL(SUM(jml_masuk),0)-IFNULL(SUM(jml_keluar),0)) AS stock FROM $table $where";
        $query1 = $this->db->query($sql);  
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba= array(
                        'stock' 	=> $resulte['stock']                                                                              
                        );
                        //$ii++;
        }
        
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();
			
		}
	}
	/************************inputan lama********************/
	function trd_masuk_bhp(){
        $csql  = $this->input->post('sql');
        $csql2 = $this->input->post('sql2');
        $nodok = $this->input->post('nodok');   
        $unit = $this->input->post('unit'); 
        $sql  = "insert into trd_masuk_bhp(no_dokumen,sdana,asal,kodegiat,spek,kode_brg,unit,
						skpd,detail_brg,satuan,merk,jumlah,harga,total,keterangan)"; 
        $asg  = $this->db->query($sql.$csql);
		/*history*/
        $sql2  = "insert into thistory_bhp
		(no_dokumen,kode_brg,unit,skpd,detail_brg,merk,jml_masuk,jml_keluar,sisa,harga,total,koderek,satuan_brg,kodegiat,sdana,asal,ruang,tgl_masuk,tgl_keluar,tgl_gabung,date_time,spek,keterangan)"; 
        $asg2  = $this->db->query($sql2.$csql2);
		/*end*/
        if($asg){
          $csql = "SELECT SUM(total) AS total from trd_masuk_bhp where no_dokumen = '$nodok' and unit='$unit'";
          $rs = $this->db->query($csql)->row() ;  
          if($rs){       
                $sql2 = "update trh_masuk_bhp set total ='$rs->total'  where no_dokumen='$nodok' and unit='$unit'";
                $asg2 = $this->db->query($sql2);   
            }
            
           echo number_format($rs->total); 
        }else{
           echo 'Data Tidak Tersimpan';
        } 
         
    }
	/*************************inputan baru**************************/
	function detail_masuk_bhp(){
        $no_dok   = $this->input->post('no_dok'); 
        $no       = $this->input->post('no');    $unit  = $this->input->post('unit');   
        $skpd     = $this->input->post('skpd');  $tgl   = $this->input->post('tgl'); 
        $jml_sisa = $this->input->post('jml_sisa');    $waktu  = $this->input->post('waktu');   
        $kd       = $this->input->post('kd');  $nm   = $this->input->post('nm'); 
        $mrk      = $this->input->post('mrk');    $satuan  = $this->input->post('satuan');   
        $hrg      = $this->input->post('hrg');  $tot   = $this->input->post('tot'); 
        $ket      = $this->input->post('ket');    $giat  = $this->input->post('giat');   
        $dn       = $this->input->post('dn');  $asl   = $this->input->post('asl');  $jml   = $this->input->post('jml');   
		
        $cno       =  explode('||',$no);    $cunit  =  explode('||',$unit);   
        $cskpd     =  explode('||',$skpd);  $ctgl   =  explode('||',$tgl); 
        $cjml_sisa =  explode('||',$jml_sisa);    $cwaktu  =  explode('||',$waktu);   
        $ckd       =  explode('||',$kd);  $cnm   =  explode('||',$nm); 
        $cmrk      =  explode('||',$mrk);    $csatuan  =  explode('||',$satuan);   
        $chrg      =  explode('||',$hrg);  $ctot   =  explode('||',$tot); 
        $cket      =  explode('||',$ket);    $cgiat  =  explode('||',$giat);   
        $cdn       =  explode('||',$dn);  $casl   =  explode('||',$asl); 
        $pj        =  count($cno); $cjml   =  explode('||',$jml); 
        
		/*hapus data apabila ada*/	
		$sql_del   = "delete from trd_masuk_bhp where skpd='$skpd' and no_dokumen='$no_dok'";
		$del  	   = $this->db->query($sql_del);
		$sql_del   = "delete from thistory_bhp where skpd='$skpd' and no_dokumen='$no_dok'";
		$del  	   = $this->db->query($sql_del);
		for($i=0;$i<$pj;$i++){
                if (trim($cno[$i])!=''){  //and kode_brg='".$ckd[$i]."'
				/*simpan*/
				$sql   = "insert into trd_masuk_bhp(no_dokumen,sdana,asal,kodegiat,spek,kode_brg,unit,
						  skpd,detail_brg,satuan,merk,jumlah,harga,total,keterangan) values
						  ('".$cno[$i]."','".$cdn[$i]."','".$casl[$i]."','".$cgiat[$i]."','','".$ckd[$i]."',
						  '$unit','$skpd','".$cnm[$i]."','".$csatuan[$i]."','".$cmrk[$i]."','".$cjml[$i]."',
						  '".$chrg[$i]."','".$ctot[$i]."','".$cket[$i]."')"; 
				$asg  = $this->db->query($sql);
                echo $asg;
				/*history*/
				$sql2  = "insert into thistory_bhp
				(no_dokumen,kode_brg,unit,skpd,detail_brg,merk,jml_masuk,jml_keluar,sisa,harga,total,koderek,
				satuan_brg,kodegiat,sdana,asal,ruang,tgl_masuk,tgl_keluar,tgl_gabung,date_time,spek,keterangan)
				values ('".$cno[$i]."','".$ckd[$i]."','$unit','$skpd','".$cnm[$i]."','".$cmrk[$i]."',
				'".$cjml[$i]."','','".$cjml[$i]."','".$chrg[$i]."','".$ctot[$i]."','','".$csatuan[$i]."',
				'".$cgiat[$i]."','".$cdn[$i]."','".$casl[$i]."','','$tgl','',
				'$tgl','$waktu','','".$cket[$i]."')"; 
				$asg2  = $this->db->query($sql2);
				
				
				}
		}
		
		// if($asg){
  //         $csql = "SELECT SUM(total) AS total from trd_masuk_bhp where no_dokumen = '".$cno[$i]."' and unit='$unit'";
  //         $rs = $this->db->query($csql)->row() ;  
  //         if($rs){       
  //               $sql2 = "update trh_masuk_bhp set total ='$rs->total' where no_dokumen='".$cno[$i]."' and unit='$unit'";
  //               $asg2 = $this->db->query($sql2);   
  //           }
  //          echo number_format($rs->total); 
  //       }else{
  //          echo 'Data Tidak Tersimpan';
  //       }
         
    }
	
	
	 function hapus_masukbhp(){
        $nomor = $this->input->post('no');
        $unit  = $this->input->post('unit');
        $msg = array();
        $sql = "delete from trd_masuk_bhp where no_dokumen='$nomor' and unit='$unit'";
        $asg = $this->db->query($sql);
        $sqlx = "delete from thistory_bhp where no_dokumen='$nomor' and unit='$unit'";
        $asgx = $this->db->query($sqlx);
        if ($asg){
            $sql = "delete from trh_masuk_bhp where no_dokumen='$nomor' and unit='$unit'";
            $asg = $this->db->query($sql);
            if (!($asg)){
              $msg = array('pesan'=>'0');
              echo json_encode($msg);
               exit();
            } 
        } else {
            $msg = array('pesan'=>'0');
            echo json_encode($msg);
            exit();
        }
        $msg = array('pesan'=>'1');
        echo json_encode($msg);
    }
	
	function update_masuk_bhp(){
		$nodok = $this->input->post('cno');
		$unit  = $this->input->post('cunit');
		$query = $this->input->post('st_query');
		$thistory 	= $this->input->post('thistory');
		$asg   		= $this->db->query($query);
		$thist   	= $this->db->query($thistory);
			if($asg){
			  $csql = "SELECT SUM(total) AS total from trd_masuk_bhp where no_dokumen = '$nodok' and unit='$unit'";
			  $rs = $this->db->query($csql)->row();  
			  if($rs){       
					$sql2 = "update trh_masuk_bhp set total ='$rs->total' where no_dokumen='$nodok' and unit='$unit' ";
					$asg2 = $this->db->query($sql2);   
					}
			  // echo number_format($rs->total); 
			}
	}
	
/*******************************INPUTAN LAMA*******************************/	
	function trd_keluar_bhp(){
        $csqlx  	= $this->input->post('sql2');
        $csql  		= $this->input->post('sql');
        $nodok 		= $this->input->post('nodok'); 
        $sisa  		= $this->input->post('sisa');    
        $unit  		= $this->input->post('unit');    
        $brg   		= $this->input->post('brg');  
        $sql  		= "insert into trd_keluar_bhp(no_dokumen,kodegiat,spek,kd_brg,unit,skpd,detail_brg,satuan,merk,jumlahbrg,harga,totjumlah,keterangan,ruang,peruntukan)"; 
        $asg  		= $this->db->query($sql.$csql);
		/*history*/
		$sqlx  		= "insert into thistory_bhp(no_dokumen,kode_brg,unit,skpd,detail_brg,merk,jml_masuk,jml_keluar,sisa,harga,total,koderek,satuan_brg,kodegiat,sdana,asal,ruang,tgl_masuk,tgl_keluar,tgl_gabung,date_time,spek,keterangan)"; 
        $asgx  		= $this->db->query($sqlx.$csqlx);
		/*end*/
       if($asgx){
          $csql = "SELECT SUM(totjumlah) AS total from trd_keluar_bhp where no_dokumen = '$nodok' and unit='$unit'";
          $rs = $this->db->query($csql)->row() ;  
          if($rs){       
                $sql2 = "update trh_keluar_bhp set total ='$rs->total' where no_dokumen='$nodok' and unit='$unit' ";
                $asg2 = $this->db->query($sql2);   
            }
            
           echo number_format($rs->total); 
        }else{
           echo 'Data Tidak Tersimpan';
        } 
         
    }
	
/*******************************INPUTAN BARU*******************************/	
	function detail_keluar_bhp(){
        $no_dok    = $this->input->post('no_dok');      $utk        = $this->input->post('utk');
        $no        = $this->input->post('no');          $unit       = $this->input->post('unit'); 
        $kdruang   = $this->input->post('kdruang');     $jml        = $this->input->post('jml');  
        $skpd      = $this->input->post('skpd');        $tgl        = $this->input->post('tgl'); 
        $jml_sisa  = $this->input->post('jml_sisa');    $waktu      = $this->input->post('waktu');   
        $kd        = $this->input->post('kd');          $nm         = $this->input->post('nm'); 
        $mrk       = $this->input->post('mrk');         $satuan     = $this->input->post('satuan');   
        $hrg       = $this->input->post('hrg');         $tot        = $this->input->post('tot'); 
        $ket       = $this->input->post('ket');         $giat       = $this->input->post('giat');   
        $dn        = $this->input->post('dn');          $asl        = $this->input->post('asl');     
        $ss        = $this->input->post('ss');          $tgld       = $this->input->post('tgld'); 
        $cno       =  explode('||',$no);                $cunit      =  explode('||',$unit);   
        $cskpd     =  explode('||',$skpd);              $ctgl       =  explode('||',$tgl); 
        $cjml_sisa =  explode('||',$jml_sisa);          $cwaktu     =  explode('||',$waktu);   
        $ckd       =  explode('||',$kd);                $cnm        =  explode('||',$nm); 
        $cmrk      =  explode('||',$mrk);               $csatuan    =  explode('||',$satuan);   
        $chrg      =  explode('||',$hrg);               $ctot       =  explode('||',$tot); 
        $cket      =  explode('||',$ket);               $cgiat      =  explode('||',$giat);   
        $cdn       =  explode('||',$dn);                $casl       =  explode('||',$asl); 
        $pj        =  count($cno);                      $cjml       =  explode('||',$jml); 
        $cutk      =  explode('||',$utk);
        $css       =  explode('||',$ss);                $ctgld      =  explode('||',$tgld);
		/*hapus data apabila ada*/	
		$sql_del   = "delete from trd_keluar_bhp where skpd='$skpd' and no_dokumen='$no_dok'";
		$del  	   = $this->db->query($sql_del);
		$sql_del   = "delete from thistory_bhp where skpd='$skpd' and no_dokumen='$no_dok'";
		$del  	   = $this->db->query($sql_del);
        $plonline  = $this->session->userdata('plonline');
        $nomor_aset = $no_dok.'.'.$skpd.'/'.'SIMBAKDA';


    //csql2 = " values('"+no+"','"+kd+"','"+unit+"','"+skpd+"','"+nm+"','"+mrk+"','',
	//'"+jml+"','"+sisa+"','"+hrg+"','"+tot+"','','"+satuan+"','"+giat+"','"+dana+"',
	//'"+asl+"','"+kdruang+"','"+tgl_masuk+"','"+tgl+"','"+tgl+"','"+waktu+"','"+spek+"','"+ket+"')";   
		
		for($i=0;$i<$pj;$i++){
                if (trim($cno[$i])!=''){  //and kode_brg='".$ckd[$i]."'
				/*simpan*/

				$sql   = "insert into trd_keluar_bhp(no_dokumen,kodegiat,spek,kd_brg,unit,skpd,detail_brg,
				satuan,merk,jumlahbrg,harga,totjumlah,keterangan,ruang,peruntukan) values
						  ('".$cno[$i]."','".$cgiat[$i]."','','".$ckd[$i]."','$unit','$skpd','".$cnm[$i]."',
						  '".$csatuan[$i]."','".$cmrk[$i]."','".$cjml[$i]."','".$chrg[$i]."','".$ctot[$i]."',
						  '".$cket[$i]."','$kdruang','".$cutk[$i]."')"; 
				$asg  = $this->db->query($sql);
				/*history*/
				$sql2  = "insert into thistory_bhp
				(no_dokumen,kode_brg,unit,skpd,detail_brg,merk,jml_masuk,jml_keluar,sisa,harga,total,koderek,
				satuan_brg,kodegiat,sdana,asal,ruang,tgl_masuk,tgl_keluar,tgl_gabung,date_time,spek,keterangan)
				values ('".$cno[$i]."','".$ckd[$i]."','$unit','$skpd','".$cnm[$i]."','".$cmrk[$i]."',
				'','".$cjml[$i]."','".$css[$i]."','".$chrg[$i]."','".$ctot[$i]."','','".$csatuan[$i]."',
				'".$cgiat[$i]."','".$cdn[$i]."','".$casl[$i]."','$kdruang','".$ctgld[$i]."','$tgl',
				'$tgl','$waktu','','".$cket[$i]."')"; 
				$asg2  = $this->db->query($sql2);
				
				}
		}
		
		/*if($asg){
          $csql = "SELECT SUM(totjumlah) AS total from trd_keluar_bhp where no_dokumen = '$no_dok' and unit='$unit'";
          $rs = $this->db->query($csql)->row() ;  
          if($rs){       
                $sql2 = "update trh_keluar_bhp set total ='$rs->total' where no_dokumen = '$no_dok' and unit='$unit'";
                $asg2 = $this->db->query($sql2);   
            }
            
           echo number_format($rs->total); 
        }else{
           echo 'Data Tidak Tersimpan';
        }*/

        if($plonline == '1') {
            $dbsimakda=$this->load->database('simakda', TRUE);
            
            $sql2x = "delete from trdju_pkd where no_voucher='$nomor_aset' and kd_skpd='$skpd'";
            $asg = $dbsimakda->query($sql2x);

            $sqld = "SELECT kd_brg,totjumlah from trd_keluar_bhp where no_dokumen = '$no_dok' and unit='$unit'";
            $asgx = $this->db->query($sqld);

            foreach($asgx->result() as $rowx){
                    $kode=$rowx->kd_brg;
                    $total=$rowx->totjumlah;
                    $a=count($kode);
                $sqlmap ="SELECT kd_reklo,nm_reklo,kd_rinci_objek,nm_rinci_objek FROM map_bph WHERE kd_barang='$kode' ";
                $asg2  = $this->db->query($sqlmap);
                    foreach($asg2->result() as $row){
                    $kd_reklo       = explode('||', $row->kd_reklo);
                    $nm_reklo       = explode('||', $row->nm_reklo);
                    $kd_rinci_objek = explode('||', $row->kd_rinci_objek);
                    $nm_rinci_objek = explode('||', $row->nm_rinci_objek);
                for($c=0;$c<$a;$c++){
                            $sqlhju = "insert into trdju_pkd (no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos) values 
                            ('$nomor_aset','$skpd','','','".$kd_reklo[$c]."','".$nm_reklo[$c]."','$total','0','D','0','1','1')";
                            $query1 = $dbsimakda->query($sqlhju);  

                            $sqlhju2 = "insert into trdju_pkd (no_voucher,kd_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,debet,kredit,rk,jns,urut,pos) values 
                            ('$nomor_aset','$skpd','','','".$kd_rinci_objek[$c]."','".$nm_rinci_objek[$c]."','0','$total','K','0','2','1')";
                            $query2 = $dbsimakda->query($sqlhju2);
                }
              
              }

          }
        }
         
    }	
	
	
	function hapus_keluarbhp(){
        $nomor = $this->input->post('no');
        $unit  = $this->input->post('unit');
        $msg = array();
        $sql = "delete from trd_keluar_bhp where no_dokumen='$nomor' and unit='$unit'";
        $asg = $this->db->query($sql);
        $sqlx = "delete from thistory_bhp where no_dokumen='$nomor' and unit='$unit'";
        $asgx = $this->db->query($sqlx);
        if ($asg){
            $sql = "delete from trh_keluar_bhp where no_dokumen='$nomor' and unit='$unit'";
            $asg = $this->db->query($sql);
            if (!($asg)){
              $msg = array('pesan'=>'0');
              echo json_encode($msg);
               exit();
            } 
        } else {
            $msg = array('pesan'=>'0');
            echo json_encode($msg);
            exit();
        }
        $msg = array('pesan'=>'1');
        echo json_encode($msg);
    }
	
	function rubah_jml_keluar(){
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $query = $this->input->post('sql');
        $asg = $this->db->query($query);
        }
    }
	
	 function trd_bhp_hapus(){
        $nomor = $this->input->post('nomor');
        $skpd  = $this->input->post('skpd');
        $kd    = $this->input->post('kd');
        $kode   = $this->input->post('kode');
        $tot    = $this->input->post('total');
        $tabel1 = $this->input->post('tabel1');
        $tabel2 = $this->input->post('tabel2');
                 
        $sql = "delete from $tabel2 where no_dokumen='$nomor' 
				and $kode='$kd' and skpd='$skpd'";
        $asg = $this->db->query($sql);
		
		$sqlx = "delete from thistory_bhp where no_dokumen='$nomor' 
				and kode_brg='$kd' and skpd='$skpd'";
        $asgx = $this->db->query($sqlx);
		
        if($asg){
            $sql2 = "update $tabel1 set total ='$tot' 
			where no_dokumen='$nomor' and skpd='$skpd'";
            $asg2 = $this->db->query($sql2);
        }         
    }
	
}
