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
        //$csql    	= $this->input->post('sql');   
        $msg        = array();
        
        if ($tabel == 'trh_masuk_bhp') {
		$sqlx = "delete from trh_masuk_bhp where skpd='$skpd' and no_dokumen='$nomor'";
		$asgx = $this->db->query($sqlx);
		$sqly = "update trd_masuk_bhp set kodegiat='$giat' where skpd='$skpd' and no_dokumen='$nomor'";
		$asgy = $this->db->query($sqly);
            if ($asgx){
                $sql = "insert into trh_masuk_bhp(no_dokumen,tgl_dokumen,unit,skpd,user,thang,total,nm_perush,no_terima,tgl_terima) 
                        values('$nomor','$tgl','$unit','$skpd','$nmuskpd','$tahun','$total','$comp','$no_terima','$tgl_terima')";
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
        $msg        = array();
        
        if ($tabel == 'trh_keluar_bhp') {
            $sql = "delete from trh_keluar_bhp where unit='$uskpd' and no_dokumen='$nomor'";
            $asg = $this->db->query($sql);
            if ($asg){
                $sql = "insert into trh_keluar_bhp(no_dokumen,tgl_keluar,unit,skpd,user,thang,total,penerima,ruang) 
                        values('$nomor','$tgl','$uskpd','$kdskpd','$nmuskpd','$tahun','$total','$penerima','$kdruang')";
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
        $skpd = $this->session->userdata('unit_skpd');
        $oto  = $this->session->userdata('otori');
        $thn  = $this->session->userdata('ta_simbakda');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where a.unit like '%' ";
        }else{
            $where1 = "where a.unit ='$skpd'";// and thang='$thn'
        }
        
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;        
        $kriteria = $this->input->post('cari');
        $where2 ='';
        if ($kriteria <> ''){                               
            $where2="and (upper(a.no_dokumen) like upper('%$kriteria%') or a.tgl_dokumen like '%$kriteria%' or upper(c.nm_kegiatan) like upper('%$kriteria%')) ";            
        }
        
        $sql = "SELECT count(*) as total FROM trh_masuk_bhp a 
				INNER JOIN trd_masuk_bhp b ON
				a.`skpd`=b.`skpd` AND a.`unit`=b.`unit` AND a.`no_dokumen`=b.`no_dokumen`
				INNER JOIN trskpd c ON a.skpd=c.`kd_skpd` AND c.kd_kegiatan=b.kodegiat
				$where1 $where2" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
       	$result["total"] = $total->total; 
        $query1->free_result(); 
        
        $sql = "SELECT a.no_dokumen,a.tgl_dokumen,a.unit,a.skpd,a.thang,a.total,
				a.nm_perush,a.user,a.no_terima,a.tgl_terima,b.kodegiat,c.`nm_kegiatan` 
				FROM trh_masuk_bhp a 
				INNER JOIN trd_masuk_bhp b ON
				a.`skpd`=b.`skpd` AND a.`unit`=b.`unit` AND a.`no_dokumen`=b.`no_dokumen`
				INNER JOIN trskpd c ON a.skpd=c.`kd_skpd` AND c.kd_kegiatan=b.kodegiat
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
                        'nm_kegiatan'   => $resulte['nm_kegiatan'],
                        'total'         => number_format($resulte['total'],2)			                        			
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
        $skpd = $this->session->userdata('unit_skpd');
        $oto  = $this->session->userdata('otori');
        $thn  = $this->session->userdata('ta_simbakda');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where a.unit like '%' ";
        }else{
            $where1 = "where a.unit ='$skpd' ";
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
				INNER JOIN trskpd c ON a.skpd=c.`kd_skpd` AND c.kd_kegiatan=b.kodegiat $where1 $where2 " ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
       	$result["total"] = $total->total; 
        $query1->free_result(); 
        
        $sql = "SELECT a.no_dokumen,a.tgl_keluar,a.penerima,
				a.unit,a.skpd,a.thang,a.total,a.user,a.keterangan,a.ruang,
				c.`nm_kegiatan`,b.`kodegiat` 
				FROM trh_keluar_bhp a 
				INNER JOIN trd_keluar_bhp b ON
				a.`skpd`=b.`skpd` AND a.`unit`=b.`unit` AND a.`no_dokumen`=b.`no_dokumen`
				INNER JOIN trskpd c ON a.skpd=c.`kd_skpd` AND c.kd_kegiatan=b.kodegiat
				$where1 $where2 GROUP BY a.no_dokumen
				ORDER BY a.tgl_keluar,a.no_dokumen,a.skpd 
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
                        'nm_kegiatan'         => $resulte['nm_kegiatan'],
                        'total'         => $resulte['total'],
                        'penerima'      => $resulte['penerima'],
                        'ruang'      	=> $resulte['ruang']		                        			
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
			$sql = "SELECT sisa,detail_brg,harga,kode_brg FROM(SELECT (SUM(a.jml_masuk)-SUM(a.jml_keluar)) AS sisa,a.detail_brg,a.harga,a.kode_brg FROM
					thistory_bhp a 
					WHERE a.skpd='$skpd' 
					AND a.kodegiat='$giat'
					GROUP BY a.kode_brg,a.harga) aa WHERE sisa<>'0' order by kode_brg";	
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
	
	function ambil_giat_keluar() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $skpd = $this->session->userdata('skpd'); 
        $oto  = $this->session->userdata('otori');
		if($oto=='01'){
			$where ="WHERE a.skpd like '%'";
		}else{
			$where ="WHERE a.skpd='$skpd'";
		}
		
        $lccr = $this->input->post('q');
		$where2="";
		if($lccr<>''){
		 $where2="and upper(b.nm_kegiatan) like upper('%$lccr%')";}
		
        $sql = "SELECT b.kd_kegiatan,b.nm_kegiatan FROM trd_masuk_bhp a
				LEFT JOIN trskpd b ON b.kd_skpd=a.skpd
				AND b.kd_kegiatan=a.kodegiat $where $where2 
				GROUP BY b.kd_kegiatan ORDER BY b.kd_kegiatan";
				
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' 	=> $ii,        
                        'kode'  => $resulte['kd_kegiatan'],  
                        'nama'  => $resulte['nm_kegiatan']  
                       
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
		$where="";
		if($lccr==''){
		$where="";
		}else{
		$where="and upper(nama) like upper('%$lccr%')";
		}
        $sql = "SELECT * FROM mbarang_hbs 
		WHERE LENGTH(RTRIM(kode))>='9' $where order by kode";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_brg' => $resulte['kode'],  
                        'nm_brg' => $resulte['nama'],   
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
		$where  = "WHERE skpd like '%'";
		}else{
		$where  = "WHERE skpd='$skpd'";
		}
		
		$where2 ="";
		if($lccr<>''){
		$where2 ="and upper(nama) like upper('%$lccr%')";
		}
		
        $sql = "SELECT kode_brg,detail_brg,satuan_brg,spek from thistory_bhp  
		$where $where2 group by kode_brg order by kode_brg";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_brg' => $resulte['kode_brg'],  
                        'nm_brg' => $resulte['detail_brg'],
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
				a.jumlah,a.sisa,a.harga,a.total,a.koderek,a.keterangan,
				a.satuan,a.kodegiat,a.cad,a.sdana,a.asal,b.nama,b.spek,
				c.tgl_dokumen FROM trd_masuk_bhp a 
				INNER JOIN mbarang_hbs b ON b.kode=a.kode_brg 
				left join trh_masuk_bhp c on c.no_dokumen=a.no_dokumen 
				and c.skpd=a.skpd and c.unit=a.unit	
				left join trd_keluar_bhp d on d.no_dokumen=a.no_dokumen 
				and d.skpd=a.skpd and d.unit=a.unit
				$where $where2 GROUP BY a.kode_brg,a.harga,a.keterangan order by a.kode_brg"; 		//(a.jumlah-d.jumlahbrg) as tot,
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
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
            $where="where skpd='$skpd' AND kode_brg='$kd_brg' and kodegiat='$giat' and harga='$harga' "; //GROUP BY harga           
        }
		
        $sql = "SELECT (SUM(jml_masuk)-SUM(jml_keluar)) AS stock FROM $table $where";
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
        $no    = $this->input->post('no');    $unit  = $this->input->post('unit');   
        $skpd  = $this->input->post('skpd');  $tgl   = $this->input->post('tgl'); 
        $jml_sisa    = $this->input->post('jml_sisa');    $waktu  = $this->input->post('waktu');   
        $kd  = $this->input->post('kd');  $nm   = $this->input->post('nm'); 
        $mrk    = $this->input->post('mrk');    $satuan  = $this->input->post('satuan');   
        $hrg  = $this->input->post('hrg');  $tot   = $this->input->post('tot'); 
        $ket    = $this->input->post('ket');    $giat  = $this->input->post('giat');   
        $dn  = $this->input->post('dn');  $asl   = $this->input->post('asl');  $jml   = $this->input->post('jml');   
		
		$cno    =  explode('||',$no);    $cunit  =  explode('||',$unit);   
        $cskpd  =  explode('||',$skpd);  $ctgl   =  explode('||',$tgl); 
        $cjml_sisa    =  explode('||',$jml_sisa);    $cwaktu  =  explode('||',$waktu);   
        $ckd  =  explode('||',$kd);  $cnm   =  explode('||',$nm); 
        $cmrk    =  explode('||',$mrk);    $csatuan  =  explode('||',$satuan);   
        $chrg  =  explode('||',$hrg);  $ctot   =  explode('||',$tot); 
        $cket    =  explode('||',$ket);    $cgiat  =  explode('||',$giat);   
        $cdn  =  explode('||',$dn);  $casl   =  explode('||',$asl); 
		$pj=count($cno); $cjml   =  explode('||',$jml); 
		
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
		
		if($asg){
          $csql = "SELECT SUM(total) AS total from trd_masuk_bhp where no_dokumen = '".$cno[$i]."' and unit='$unit'";
          $rs = $this->db->query($csql)->row() ;  
          if($rs){       
                $sql2 = "update trh_masuk_bhp set total ='$rs->total' where no_dokumen='".$cno[$i]."' and unit='$unit'";
                $asg2 = $this->db->query($sql2);   
            }
            
           echo number_format($rs->total); 
        }else{
           echo 'Data Tidak Tersimpan';
        }
         
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
		$no_dok   = $this->input->post('no_dok'); $utk   = $this->input->post('utk');
        $no    = $this->input->post('no');    $unit  = $this->input->post('unit'); 
		$kdruang   = $this->input->post('kdruang'); $jml   = $this->input->post('jml');  
        $skpd  = $this->input->post('skpd');  $tgl   = $this->input->post('tgl'); 
        $jml_sisa    = $this->input->post('jml_sisa');    $waktu  = $this->input->post('waktu');   
        $kd  = $this->input->post('kd');  $nm   = $this->input->post('nm'); 
        $mrk    = $this->input->post('mrk');    $satuan  = $this->input->post('satuan');   
        $hrg  = $this->input->post('hrg');  $tot   = $this->input->post('tot'); 
        $ket    = $this->input->post('ket');    $giat  = $this->input->post('giat');   
        $dn  = $this->input->post('dn');  $asl   = $this->input->post('asl');     
		$ss   = $this->input->post('ss'); $tgld   = $this->input->post('tgld'); 
		$cno    =  explode('||',$no);    $cunit  =  explode('||',$unit);   
        $cskpd  =  explode('||',$skpd);  $ctgl   =  explode('||',$tgl); 
        $cjml_sisa    =  explode('||',$jml_sisa);    $cwaktu  =  explode('||',$waktu);   
        $ckd  =  explode('||',$kd);  $cnm   =  explode('||',$nm); 
        $cmrk    =  explode('||',$mrk);    $csatuan  =  explode('||',$satuan);   
        $chrg  =  explode('||',$hrg);  $ctot   =  explode('||',$tot); 
        $cket    =  explode('||',$ket);    $cgiat  =  explode('||',$giat);   
        $cdn  =  explode('||',$dn);  $casl   =  explode('||',$asl); 
		$pj=count($cno); $cjml   =  explode('||',$jml); $cutk   =  explode('||',$utk);
		$css   =  explode('||',$ss); $ctgld   =  explode('||',$tgld);
		/*hapus data apabila ada*/	
		$sql_del   = "delete from trd_keluar_bhp where skpd='$skpd' and no_dokumen='$no_dok'";
		$del  	   = $this->db->query($sql_del);
		$sql_del   = "delete from thistory_bhp where skpd='$skpd' and no_dokumen='$no_dok'";
		$del  	   = $this->db->query($sql_del);

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
		
		if($asg){
          $csql = "SELECT SUM(total) AS total from trd_keluar_bhp where no_dokumen = '".$cno[$i]."' and unit='$unit'";
          $rs = $this->db->query($csql)->row() ;  
          if($rs){       
                $sql2 = "update trh_keluar_bhp set total ='$rs->total' where no_dokumen='".$cno[$i]."' and unit='$unit'";
                $asg2 = $this->db->query($sql2);   
            }
            
           echo number_format($rs->total); 
        }else{
           echo 'Data Tidak Tersimpan';
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
