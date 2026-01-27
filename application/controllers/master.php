<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {
        
	public function __construct() {
		parent::__construct();
	}
	public function index($data) {
    	if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
      	    //echo $data['table'];
			//$query = 'select * from mgolongan order by golongan';
	  		//$data = $this->Mdata->getall($query,"golongan/index");
         	$this->template->set('title','.::SIMBAKDA::.');
         	$this->template->load('index',$data['tabel'],$data['isi']);		
		}	
	}
    
    function refuser()
    {
        $data['page_title']= 'INPUT USER';
        $this->template->set('title', 'INPUT USER');   
        $this->template->load('index','referensi/new_user',$data) ; 
    }
    
    function otorisasi()
    {
        $data['page_title']= 'OTORISASI';
        $this->template->set('title', 'OTORISASI');   
        $this->template->load('index','referensi/otorisasi',$data) ; 
    }
    
    function konfigurasi()
    {
        $data['page_title']= 'OTORISASI';
        $data = $this->ambil_konfigurasi();
        $this->template->set('title', 'OTORISASI');   
        $this->template->load('index','referensi/konfigurasi',$data) ;
    }
	    
		function ganti_pass()
    {
        $data['page_title']= 'OTORISASI';
        $data = $this->ambil_konfigurasi();
        $this->template->set('title', 'OTORISASI');   
        $this->template->load('index','referensi/ganti_pass',$data) ;
    }
    
    function ambil_konfigurasi(){

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
    
    function simpan_konfigurasi(){
        $client  = $this->input->post('client');
        $pimpinan  = $this->input->post('pimpinan');
        $nip_pimp  = $this->input->post('nip_pimp');
        $pkt_pimp  = $this->input->post('pkt_pimp');
        $kota  = $this->input->post('kota');
        $logo  = $this->input->post('logo');
        
        $csql = "update config set nm_client='$client',kepala='$pimpinan',nip_kepala='$nip_pimp', pkt_kepala='$pkt_pimp',kota='$kota',logo='$logo'";
        $query1 = $this->db->query($csql);  
        
    }
	
	function simpan_password(){
	//nm_admin:nm_admin,email:email,password:password,reply_pass:reply_pass
        $id             = $this->input->post('id');
        $skpd  			= $this->input->post('skpd');
        $uskpd  		= $this->input->post('uskpd');
        $nm_admin  		= $this->input->post('nm_admin');
        $email  		= $this->input->post('email');
        $password  		= $this->input->post('password');
        $reply_pass  	= $this->input->post('reply_pass');
        $username  		= $this->input->post('username');
        $waktu  		= $this->input->post('waktu');
        $msg = array();
        //$csql = "update muser set iduser=md5('$username'),password=md5('$password'),nama_admin='$nm_admin',email_admin='$email' where unit_skpd='$uskpd' and skpd='$skpd'";
        $csql   = "UPDATE user SET user_name='$username',password=md5('$password'),nama='$nm_admin' WHERE id_user='$id'";
		$query1 = $this->db->query($csql);  
			$csq2 = "insert into muser_temp values('','$id','$password','$nm_admin','','','$skpd','$uskpd','$nm_admin','$email','$waktu')";
			$query2 = $this->db->query($csq2); 
				if($query1){
					$msg = array('pesan'=>'1');
					echo json_encode($msg);
				}else {
					$msg = array('pesan'=>'0');
					echo json_encode($msg);
					exit();
				}
    }
    
	  function import_data()
    {
        $data['page_title']= 'IMPORT';
        $this->template->set('title', 'IMPORT');   
        $this->template->load('index','referensi/import_data',$data) ; 
    }
    
	  function export_data()
    {
        $data['page_title']= 'EXSPORT';
        $this->template->set('title', 'EXSPORT');   
        $this->template->load('index','referensi/export_data',$data) ; 
    }
    public function subkelompok() {
    	if($this->auth->is_logged_in() == false){
        	redirect(site_url().'welcome/login');
      	}else{
			$query = "select kd_kelompok, nm_kelompok,(select concat(kelompok,' - ',nm_kelompok) as co from 
            mkelompok where mkelompok.kelompok = mkelompok1.kelompok) as kelompok from mkelompok1 order by kd_kelompok";
	  		$data['isi'] = $this->Mdata->getall($query,"/master/subkelompok");
            $data['tabel'] = "mkelompok1/index" ;
            $this->index($data); 		
		}	
	}
	public function cari_subkel(){
	   if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$this->auth->restrict();
		$cari = $this->input->post('cari');
    	$query = "select kd_kelompok, nm_kelompok ,(select concat(kelompok,' - ',nm_kelompok) as co from 
        mkelompok where mkelompok.kelompok = mkelompok1.kelompok) as kelompok from mkelompok1 where kd_kelompok 
        like '%".$cari."%' or nm_kelompok like '%".$cari."%' order by kd_kelompok";
        
		//$query = 'select * from mbidang where bidang like "%'.$cari.'%" or nm_bidang like "%'.$cari.'%"  order by bidang'; 
		$data = $this->Mdata->getall($query,'berita/index');
        $this->template->set('title','.::SIMBAKDA::.');
        $this->template->load('index','mkelompok1/index',$data);
        }
   	}
    
    function ambil_warna() {
        $lccr = $this->input->post('q');
        $sql = "SELECT kd_warna, nm_warna FROM mwarna where upper(kd_warna) like upper('%$lccr%') or upper(nm_warna) like upper('%$lccr%') ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_warna' => $resulte['kd_warna'],  
                        'nm_warna' => $resulte['nm_warna'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    

    function ambil_bahan() {
        $lccr = $this->input->post('q');
        $sql = "SELECT kd_bahan, nm_bahan FROM mbahan where upper(kd_bahan) like upper('%$lccr%') or upper(nm_bahan) like upper('%$lccr%') ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_bahan' => $resulte['kd_bahan'],  
                        'nm_bahan' => $resulte['nm_bahan'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
    function ambil_satuan() {
        $lccr = $this->input->post('q');
        $sql = "SELECT kd_satuan, nm_satuan FROM msatuan where upper(kd_satuan) like upper('%$lccr%') or upper(nm_satuan) like upper('%$lccr%') ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_satuan' => $resulte['kd_satuan'],  
                        'nm_satuan' => $resulte['nm_satuan'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
	public function input_subkel()
	{
	   if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
	   // mencegah user yang belum login untuk mengakses halaman ini
    	   $this->auth->restrict();
    	 
    	   $this->load->library('form_validation');
    	 
    	   $this->form_validation->set_rules('kd_kel', 'Sub Kelompok', 'trim|required');
    	   $this->form_validation->set_rules('nama', 'Uraian', 'trim|required');
    	   $this->form_validation->set_rules('jns_kel', 'Kelompok', 'trim|required');
    	   $this->form_validation->set_error_delimiters(' <span style="color:#FF0000; font-size:9;">', '</span>');
    	 
    	   if ($this->form_validation->run() == FALSE)
    	   {  
    	      //$query = "select bidang,nm_bidang from mbidang";
              $query = "select kelompok,concat(kelompok,' - ',nm_kelompok) as nm_kelompok from mkelompok";
              $data_pilih = $this->Mdata->viewdata($query);
              $lcb = $data_pilih->num_rows();
              $lcdata = "";
    
              foreach($data_pilih->result()as $dt_kel){
                $data['option'][$dt_kel->kelompok]=$dt_kel->nm_kelompok;
              }    
               
              //$data['option'] = array('1'=>'Aset','2'=>'Non Aset');
    		  $this->template->set('title','.::SIMBAKDA::.');
    		  $this->template->load('index','mkelompok1/input',$data);
    	   }
    	   else
    	   {
    	   	  $id = $this->input->post('kd_kel');
    		  $cek = array('kd_kelompok'=>$id);
    	   	  if($this->Mdata->check_id($cek,'mkelompok1') == false) {
    	   	    
              //$query = "select bidang,nm_bidang from mbidang";
              $query = "select kelompok,concat(kelompok,' - ',nm_kelompok) as nm_kelompok from mkelompok";
              $data_pilih = $this->Mdata->viewdata($query);
              $lcb = $data_pilih->num_rows();
              $lcdata = "";
    
              foreach($data_pilih->result()as $dt_kel){
                $data['option'][$dt_kel->kelompok]=$dt_kel->nm_kelompok;
              }  
    		  	//$data['option'] = array('1'=>'Aset','2'=>'Non Aset');
    			$data['errinput'] = 'Sub Kelompok sudah terdaftar!';
    		  	$this->template->set('title','.::SIMBAKDA::.');
    		  	$this->template->load('index','mkelompok1/input',$data);
    	   	  }else {
    		  $data_input = array(
    			 'kd_kelompok' =>$this->input->post('kd_kel'),
    			 'nm_kelompok'   =>$this->input->post('nama'),
    			 'kelompok'   =>$this->input->post('jns_kel')
    		  );
    		  $this->Mdata->save($data_input,'mkelompok1');
    		  // kembalikan ke halaman manajemen user
    		  redirect(site_url().'/master/subkelompok');
    		  }
    	   }
        }
	}
    
    function perolehan() {
       // $lccr = $this->input->post('q');
        $sql = "SELECT * FROM cara_peroleh ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'kd_cr_oleh' => $resulte['kd_cr_oleh'],        
                        'cara_perolehan' => $resulte['cara_peroleh']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
    function mkondisi() {
       // $lccr = $this->input->post('q');
        $sql = "SELECT * FROM mkondisi order by kode ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'kode' => $resulte['kode'],        
                        'kondisi' => $resulte['kondisi'],
                        'nmkondisi'=> $resulte['nm_kondisi']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}   
	
	function mriwayat() {
       // $lccr = $this->input->post('q');
        $sql = "SELECT * FROM mriwayat order by kode ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'kode' => $resulte['kode'],        
                        'riwayat' => $resulte['riwayat']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
     function pengawas() {
       // $lccr = $this->input->post('q');
        $sql = "SELECT * FROM pengawas ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'nip' => $resulte['nip'],        
                        'nama' => $resulte['nama']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
    function load_oto(){

		$coba[] = array('oto' => '01','ket' => 'Administrator');		
		$coba[] = array('oto' => '02','ket' => 'Operator 1');		
		$coba[] = array('oto' => '03','ket' => 'Operator 2');		

		$result["rows"] = $coba;   
        echo json_encode($result);
	 
	}
    
    function load_otorisasi() {
       
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 30;
	    $offset = ($page-1)*$rows;        

        $rs = $this->db->query("select count(*) as tot FROM ms_menu where parent<>'0' ");
        
        $trh = $rs->row();

		$sql = "SELECT idmenu,judul,if(m01='1','YA','TIDAK') as m01,if(m02='1','YA','TIDAK') as m02,if(m03='1','YA','TIDAK') as m03 FROM ms_menu where parent<>'0' order by idmenu limit $offset,$rows  ";
        $query1 = $this->db->query($sql);  


        $ii = 0;
        foreach($query1->result_array() as $resulte){ 

            $coba[] = array(
                        'idmenu' => $resulte['idmenu'],
                        'judul'  => $resulte['judul'],
                        'administrator' => $resulte['m01'],
                        'operator1'	   => $resulte['m02'],
                        'operator2'	=> $resulte['m03']
                        );
                        $ii++;
        }
        
        $result["rows"] = $coba;   
		$result["total"] = $trh->tot; 				
        echo json_encode($result);
    	$query1->free_result();   
	}
    
	   function malasan() {
        $sql 	= "SELECT * FROM malasan ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(
                        'id' => $ii,
                        'no' => $resulte['no'],        
                        'alasan' => $resulte['alasan']
                        );
                        $ii++;
        }
        echo json_encode($result);
	}
	
	function simpan_malasan(){
	$id_barang	= $this->input->post('id');
	$keterangan	= $this->input->post('ket');
	$kode		= $this->input->post('kode');
	$kd_brg		= substr($kode,0,2);
	if ($kd_brg=='01'){
	$this->db->query("update trhapus_a set keterangan='$keterangan' where id_barang='$id_barang'");
	}if($kd_brg=='02'){
	$this->db->query("update trhapus_b set keterangan='$keterangan' where id_barang='$id_barang'");
	}if($kd_brg=='03'){
	$this->db->query("update trhapus_c set keterangan='$keterangan' where id_barang='$id_barang'");
	}if($kd_brg=='04'){
	$this->db->query("update trhapus_d set keterangan='$keterangan' where id_barang='$id_barang'");
	}if($kd_brg=='05'){
	$this->db->query("update trhapus_e set keterangan='$keterangan' where id_barang='$id_barang'");
	}else{
	$this->db->query("update trhapus_f set keterangan='$keterangan' where id_barang='$id_barang'");
	} 
	
	}
	
    function yatidak1() {
		$result[] = array('administrator' => 'YA');
		$result[] = array('administrator' => 'TIDAK');                       
        echo json_encode($result);    	   
	}

 	function yatidak2() {
		$result[] = array('operator1' => 'YA');
		$result[] = array('operator1' => 'TIDAK');                       	
        echo json_encode($result);
	}

 	function yatidak3() {
		$result[] = array('operator2' => 'YA');
		$result[] = array('operator2' => 'TIDAK');                       
        echo json_encode($result);
	}
    
    function simpan_otorisasi(){

		$id			=trim($this->input->post('id'));	
		$adm		=trim($this->input->post('adm'));	
		$ope1		=trim($this->input->post('oper1'));	
		$ope2       =trim($this->input->post('oper2'));
        

		if($adm=='YA'){
			$m01='1';
		}else{
			$m01='0';
		} 
		if($ope1=='YA'){
			$m02='1';
		}else{
			$m02='0';
		} 
		if($ope2=='YA'){
			$m03='1';
		}else{
			$m03='0';
		}

		$this->db->query(" update ms_menu set m01='$m01',m02='$m02',m03='$m03' where rtrim(idmenu)='$id' ");
		
	}
    
    function load_user() {
       
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;

        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';

        if ($kriteria != ''){                               
            $where=" where nmuser like '%$kriteria%' OR ket like '%$kriteria%' ";            
        }			   

        $rs = $this->db->query("select count(*) as tot FROM muser $where order by nmuser");
        $trh = $rs->row();
        

        $sql = "SELECT * FROM muser $where order by skpd,nmuser limit $offset,$rows";
        $query1 = $this->db->query($sql);  

	
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
			$otori=$resulte['oto'];
			if($otori=='01'){
				$nmoto='Administrator';
			}elseif($otori=='02'){
				$nmoto='Operator 1';			
			}elseif($otori=='03'){
				$nmoto='Operator 2';			
			}

            $coba[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],
                        'nmuser' => $resulte['nmuser'],
                        'pass'=>$resulte['password'],
                        'oto'    => $resulte['oto'],
                        'nmoto'  => $nmoto,
                        'ket'    => $resulte['ket'],
						'skpd'	 => $resulte['skpd'],
						'uskpd'	 => $resulte['unit_skpd']
                        );
                        $ii++;
        }
        
		$result["total"] = $trh->tot; 				
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
	}
    
   
    function simpan_user(){
        $user = md5(trim($this->input->post('user')));
        $pass = md5(trim($this->input->post('pass')));
        $skpd = $this->input->post('skpd');
        $nmskpd = $this->input->post('user');
        $unit_skpd = $this->input->post('unit_skpd');
        $oto = $this->input->post('oto');
        $ket = $this->input->post('ket');
        $del = trim($this->input->post('del'));
        $nama_admin = '';
        $email_admin = '';

		$query1 = $this->db->query("delete from muser where nmuser='$nmskpd' and iduser='$user' and password='$pass'");  
		if ($del=='0'){
		   $query1 = $this->db->query("insert into muser values('','$user','$pass','$nmskpd','$oto','$ket','$skpd','$unit_skpd','$nama_admin','$email_admin','' ) ");  
		}
	}

    function update_user_dh(){
        $kode = $this->input->post('kode');
        $user = md5(trim($this->input->post('user')));
        $pass = md5(trim($this->input->post('pass')));
        $skpd = $this->input->post('skpd');
        $nmuser = $this->input->post('user');
        $unit_skpd = $this->input->post('unit_skpd');
        $oto = $this->input->post('oto');
        $ket = $this->input->post('ket');
        $msg = array();

        $sql="update muser set password='$pass', nmuser='$nmuser',oto='$oto',ket='$ket',iduser='$user',skpd='$skpd',unit_skpd='$unit_skpd' where kode='$kode'";
        $asg = $this->db->query($sql);
                if($asg){
                    $msg = array('pesan'=>'1');
                    echo json_encode($msg);
                }else{
                   $msg = array('pesan'=>'0');
                    echo json_encode($msg);
                }  
        
    }
    
    
    function ambil_lokasi() {
        $lccr = $this->input->post('q');
        $sql = "SELECT kd_lokasi, nm_lokasi,kd_skpd FROM mlokasi where upper(kd_lokasi) like upper('%$lccr%') or upper(nm_lokasi) like upper('%$lccr%') ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_lokasi' => $resulte['kd_lokasi'],  
                        'nm_lokasi' => $resulte['nm_lokasi'],  
						'kd_skpd'	=> $resulte['kd_skpd']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
    function mstatus() {
       // $lccr = $this->input->post('q');
        $sql = "SELECT * FROM st_tanah order by kode";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'kode' => $resulte['kode'],        
                        'status' => $resulte['status']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
	function mjenis() {
        $sql = "SELECT * FROM mjenis order by kode";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'kode' => $resulte['kode'],        
                        'jns_bangunan' => $resulte['jns_bangunan']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
	}	

	function mkonstruksi() {
       // $lccr = $this->input->post('q');
        $sql = "SELECT * FROM mkonstruksi ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'kode' => $resulte['kode'],        
                        'nm_konstruksi' => $resulte['nm_konstruksi']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
	function mkonstruksi2() {
       // $lccr = $this->input->post('q');
        $sql = "SELECT * FROM mkonstruksi2 ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'kode' => $resulte['kode'],        
                        'nm_konstruksi' => $resulte['nm_konstruksi']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
     function mdana() {
       // $lccr = $this->input->post('q');
        $sql = "SELECT * FROM mdana ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'kode' => $resulte['kd_sumberdana'],        
                        'sumber_dana' => $resulte['nm_sumberdana']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
    function mbukti() {
       // $lccr = $this->input->post('q');
        $sql = "SELECT * FROM mbukti ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'kode' => $resulte['kode'],        
                        'Bukti' => $resulte['bukti_pembayaran']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
    function dasar_perolehan() {
       // $lccr = $this->input->post('q');
        $sql = "SELECT * FROM mdasar ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'kode' => $resulte['kode'],        
                        'dasar_perolehan' => $resulte['dasar_peroleh']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
    
	public function edit_subkel() {
	   if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
	   $this->auth->restrict();
      
	   $this->load->library('form_validation');
	   //$this->form_validation->set_rules('bid', 'bid', 'trim|required');
	   $this->form_validation->set_rules('nama', 'nama', 'trim|required');
	   $this->form_validation->set_rules('jns_kel', 'jns_kel', 'trim|required');
	   $this->form_validation->set_error_delimiters(' <span style="color:#FF0000">', '</span>');
	 
	   // dapatkan id user dari segment ke-3 dari URI
	   $id = $this->uri->segment(3);
	   $cond = array ('kd_kelompok'=>$id);
	   if ($this->form_validation->run() == FALSE)
	   {
	      
          $query = "select kelompok,concat(kelompok,' - ',nm_kelompok) as nm_kelompok from mkelompok";
          $data_pilih = $this->Mdata->viewdata($query);
          $lcb = $data_pilih->num_rows();
          $lcdata = "";
    
           foreach($data_pilih->result()as $dt_kel){
            $data['option'][$dt_kel->kelompok]=$dt_kel->nm_kelompok;
          }
          

		  $data['msubkel'] = $this->Mdata->getdata($cond,'mkelompok1');
		  $this->template->set('title','.::SIMBAKDA::.');
		  $this->template->load('index','mkelompok1/edit',$data);
	   }
	   else
	   {
	       $data_user = array(
           	 'nm_kelompok'   =>$this->input->post('nama'),
			 'kelompok'   =>$this->input->post('jns_kel')
		  );
          
//          echo $this->input->post('nama')."<br>";
//          echo $skdjskd."<br>";
//          echo $this->input->post('jns_bid')."<br>";
          
		  $this->Mdata->update($data_user,$cond,'mkelompok1');
		  // kembalikan ke halaman manajemen user
		  redirect(site_url().'/master/subkelompok');
	   }	
       }
	}
	public function del_subkel()
    {
	   
	   // mencegah user yang belum login untuk mengakses halaman ini
	   $this->auth->restrict();
	   // dapatkan id user dari segment ke-3 dari URI
	   $id = $this->uri->segment(3);
	   $cond = array('kd_kelompok'=>$id);
	   $this->Mdata->delete($cond,'mkelompok1');
	   // kembalikan ke halaman manajemen user
	   redirect(site_url().'/master/subkelompok');
	}
//=========================== end of master sub kelompok ===============================

//===========================start of master barang ====================================
    public function barang() {
    	if($this->auth->is_logged_in() == false){
        	redirect(site_url().'welcome/login');
      	}else{
			$query = "select kd_brg,kd_rek5,nm_brg,(select concat(kd_kelompok,' - ',nm_kelompok) as co from 
            mkelompok1 where mkelompok1.kd_kelompok = mbarang.kd_kelompok) as kd_kelompok from mbarang order by kd_brg";
	  		$data['isi'] = $this->Mdata->getall($query,"/master/barang");
            $data['tabel'] = "mbarang/index" ;
            $this->index($data); 		
		}	
	}
    
    function submkel1()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT MASTER SUB KELOMPOK';
        $this->template->set('title', 'INPUT MASTER SUB KELOMPOK');   
        $this->template->load('index','master/msubkel',$data) ;
        } 
    }
    
    function mkel1()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
       	}else{
            $data['page_title']= 'INPUT MASTER KELOMPOK';
            $this->template->set('title', 'INPUT MASTER KELOMPOK');   
            $this->template->load('index','master/mkelompok',$data) ;
        } 
    }
    function mruang()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
            $data['page_title']= 'INPUT MASTER RUANG';
            $this->template->set('title', 'INPUT MASTER RUANG');   
            $this->template->load('index','master/mruang',$data) ;
        } 
    }
    
    function mpangkat()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
            $data['page_title']= 'INPUT MASTER PANGKAT';
            $this->template->set('title', 'INPUT MASTER PANGKAT');   
            $this->template->load('index','master/mpangkat',$data) ; 
       }
    }
    function mwarna()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
            $data['page_title']= 'INPUT MASTER WARNA';
            $this->template->set('title', 'INPUT MASTER WARNA');   
            $this->template->load('index','master/mwarna',$data) ;
        } 
    }
    
    function mgol1()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
            $data['page_title']= 'INPUT MASTER GOLONGAN';
            $this->template->set('title', 'INPUT MASTER GOLONGAN');   
            $this->template->load('index','master/mgolongan',$data) ;
        } 
    }
    
    function mttd()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
            $data['page_title']= 'INPUT PENANDATANGAN';
            $this->template->set('title', 'INPUT PENANDATANGAN');   
            $this->template->load('index','master/mttd',$data) ;
        } 
    }
    
    function musaha()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT MASTER GOLONGAN';
        $this->template->set('title', 'INPUT MASTER GOLONGAN');   
        $this->template->load('index','master/mperusahaan',$data) ;
        } 
    }
    function mlokasi()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT MASTER LOKASI';
        $this->template->set('title', 'INPUT MASTER LOKASI');   
        $this->template->load('index','master/mlokasi',$data) ;
        } 
    }
    
    function mbid1()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT MASTER BIDANG';
        $this->template->set('title', 'INPUT MASTER BIDANG');   
        $this->template->load('index','master/mbidang',$data) ;
        } 
    }
    
    function msatuan()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT MASTER SATUAN';
        $this->template->set('title', 'INPUT MASTER SATUAN');   
        $this->template->load('index','master/msatuan',$data) ;
        } 
    }

    
    function mbidang_skpd()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT MASTER BIDANG SKPD';
        $this->template->set('title', 'INPUT MASTER BIDANG SKPD');   
        $this->template->load('index','master/mbidang_skpd',$data) ;
        } 
    }
    
    function munit_bidang()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT MASTER UNIT BIDANG';
        $this->template->set('title', 'INPUT MASTER UNIT BIDANG');   
        $this->template->load('index','master/munit_bidang',$data) ;
        } 
    }
    function munit_kerja()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT MASTER UNIT KERJA';
        $this->template->set('title', 'INPUT MASTER UNIT KERJA');   
        $this->template->load('index','master/munit_kerja',$data) ;
        } 
    }
    
    
    function mmilik()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT MASTER BIDANG';
        $this->template->set('title', 'INPUT MASTER PEMILIK');   
        $this->template->load('index','master/mmilik',$data) ;
        } 
    }
    
    function mwilayah()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT MASTER WILAYAH';
        $this->template->set('title', 'INPUT MASTER WILAYAH');   
        $this->template->load('index','master/mwilayah',$data) ;
        } 
    }
    function malamat()
    {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $data['page_title']= 'INPUT MASTER ALAMAT';
        $this->template->set('title', 'INPUT MASTER ALAMAT');   
        $this->template->load('index','master/malamat',$data) ;
        } 
    }
    
    function munit()
    {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $data['page_title']= 'INPUT MASTER UNIT';
        $this->template->set('title', 'INPUT MASTER UNIT');   
        $this->template->load('index','master/munit',$data) ;
        } 
    }
    
    function mbarang()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $data['page_title']= 'INPUT MASTER BIDANG';
        $this->template->set('title', 'INPUT MASTER BIDANG');   
        $this->template->load('index','master/mbarang',$data) ;
        } 
    }

	    function mmasa()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
            $data['page_title']= 'INPUT MASTER UMUR BARANG';
            $this->template->set('title', 'INPUT MASTER UMUR BARANG');   
            $this->template->load('index','master/mmasa',$data) ;
        } 
    }
    
	   function mcari()
    {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
            $data['page_title']= 'PENCARIAN BARANG';
            $this->template->set('title', 'PENCARIAN BARANG');   
            $this->template->load('index','master/mcari',$data) ;
        } 
    }
	
	public function cari_barang(){
		$this->auth->restrict();
		$cari = $this->input->post('cari');
    	$query = "select kd_brg,kd_rek5,nm_brg,(select concat(kd_kelompok,' - ',nm_kelompok) as co from 
        mkelompok1 where mkelompok1.kd_kelompok = mbarang.kd_kelompok) as kd_kelompok from mbarang where kd_kelompok 
        like '%".$cari."%' or nm_kelompok like '%".$cari."%' order by kd_kelompok";
        
		//$query = 'select * from mbidang where bidang like "%'.$cari.'%" or nm_bidang like "%'.$cari.'%"  order by bidang'; 
		$data = $this->Mdata->getall($query,'berita/index');
        $this->template->set('title','.::SIMBAKDA::.');
        $this->template->load('index','mkelompok1/index',$data);
   	}
	public function input_barang()
	{
	   // mencegah user yang belum login untuk mengakses halaman ini
	   $this->auth->restrict();
	 
	   $this->load->library('form_validation');
	 
	   $this->form_validation->set_rules('kd_kel', 'Sub Kelompok', 'trim|required');
	   $this->form_validation->set_rules('nama', 'Uraian', 'trim|required');
	   $this->form_validation->set_rules('jns_kel', 'Kelompok', 'trim|required');
	   $this->form_validation->set_error_delimiters(' <span style="color:#FF0000; font-size:9;">', '</span>');
	 
	   if ($this->form_validation->run() == FALSE)
	   {  
	      //$query = "select bidang,nm_bidang from mbidang";
          $query = "select kelompok,concat(kelompak,' - ',nm_kelompok) as nm_kelompok from mkelompok";
          $data_pilih = $this->Mdata->viewdata($query);
          $lcb = $data_pilih->num_rows();
          $lcdata = "";

          foreach($data_pilih->result()as $dt_kel){
            $data['option'][$dt_kel->kelompok]=$dt_kel->nm_kelompok;
          }    
           
          //$data['option'] = array('1'=>'Aset','2'=>'Non Aset');
		  $this->template->set('title','.::SIMBAKDA::.');
		  $this->template->load('index','mkelompok1/input',$data);
	   }
	   else
	   {
	   	  $id = $this->input->post('kd_kel');
		  $cek = array('kd_kelompok'=>$id);
	   	  if($this->Mdata->check_id($cek,'mkelompok1') == false) {
	   	    
          //$query = "select bidang,nm_bidang from mbidang";
          $query = "select kelompok,concat(kelompak,' - ',nm_kelompok) as nm_kelompok from mkelompok";
          $data_pilih = $this->Mdata->viewdata($query);
          $lcb = $data_pilih->num_rows();
          $lcdata = "";

          foreach($data_pilih->result()as $dt_kel){
            $data['option'][$dt_kel->kelompok]=$dt_kel->nm_kelompok;
          }  
		  	//$data['option'] = array('1'=>'Aset','2'=>'Non Aset');
			$data['errinput'] = 'Sub Kelompok sudah terdaftar!';
		  	$this->template->set('title','.::SIMBAKDA::.');
		  	$this->template->load('index','mkelompok1/input',$data);
	   	  }else {
		  $data_input = array(
			 'kd_kelompok' =>$this->input->post('kd_kel'),
			 'nm_kelompok'   =>$this->input->post('nama'),
			 'kelompok'   =>$this->input->post('jns_kel')
		  );
		  $this->Mdata->save($data_input,'mkelompok1');
		  // kembalikan ke halaman manajemen user
		  redirect(site_url().'/master/subkelompok');
		  }
	   }
	}
	public function edit_barang() {
	   $this->auth->restrict();
      
	   $this->load->library('form_validation');
	   //$this->form_validation->set_rules('bid', 'bid', 'trim|required');
	   $this->form_validation->set_rules('nama', 'nama', 'trim|required');
	   $this->form_validation->set_rules('jns_kel', 'jns_kel', 'trim|required');
	   $this->form_validation->set_error_delimiters(' <span style="color:#FF0000">', '</span>');
	 
	   // dapatkan id user dari segment ke-3 dari URI
	   $id = $this->uri->segment(3);
       $skdjskd = $this->uri->segment(3);
	   $cond = array ('kd_kelompok'=>$id);
	   if ($this->form_validation->run() == FALSE)
	   {
	      
          $query = "select kelompok,concat(kelompok,' - ',nm_kelompok) as nm_kelompok from mkelompok";
          $data_pilih = $this->Mdata->viewdata($query);
          $lcb = $data_pilih->num_rows();
          $lcdata = "";
    
           foreach($data_pilih->result()as $dt_kel){
            $data['option'][$dt_kel->kelompok]=$dt_kel->nm_kelompok;
          }
          

		  $data['msubkel'] = $this->Mdata->getdata($cond,'mkelompok1');
		  $this->template->set('title','.::SIMBAKDA::.');
		  $this->template->load('index','mkelompok1/edit',$data);
	   }
	   else
	   {
	       $data_user = array(
           	 'nm_kelompok'   =>$this->input->post('nama'),
			 'kelompok'   =>$this->input->post('jns_kel')
		  );
          
//          echo $this->input->post('nama')."<br>";
//          echo $skdjskd."<br>";
//          echo $this->input->post('jns_bid')."<br>";
          
		  $this->Mdata->update($data_user,$cond,'mkelompok1');
		  // kembalikan ke halaman manajemen user
		  redirect(site_url().'/master/subkelompok');
	   }	
	}
	public function del_barang()
    {
	
	   // mencegah user yang belum login untuk mengakses halaman ini
	   $this->auth->restrict();
	   // dapatkan id user dari segment ke-3 dari URI
	   $id = $this->uri->segment(3);
	   $cond = array('kd_kelompok'=>$id);
	   $this->Mdata->delete($cond,'mkelompok1');
	   // kembalikan ke halaman manajemen user
	   redirect(site_url().'/master/subkelompok');
	}
//=========================== end of master barang ===============================
function load_cari() {
    if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		
        $kriteria = '';
        $gol	 	= $this->input->post('gol');
        $kriteria 	= $this->input->post('cari');
        $skpd	 	= $this->input->post('skpd');
        $tahun	 	= $this->input->post('tahun');
        $tahun2	 	= $this->input->post('tahun2');
		
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		
        $oto  = $this->session->userdata('otori');
        $where1 = '';     
		$kunci	= '';
		
		if($gol=='01'){
			$kunci	= "(upper(a.tahun) like upper('%$kriteria%') 
					or upper(a.asal) like upper('%$kriteria%') 
					or upper(a.keterangan) like upper('%$kriteria%') 
					or upper(a.nilai) like upper('%$kriteria%')
					or upper(b.nm_brg) like upper('%$kriteria%')
					or upper(a.no_sertifikat) like upper('%$kriteria%') 
					or upper(a.luas) like upper('%$kriteria%') 
					or upper(a.penggunaan) like upper('%$kriteria%')
					or upper(a.alamat1) like upper('%$kriteria%')
					)";
		}if($gol=='02'){
			$kunci	= "(upper(a.tahun) like upper('%$kriteria%') 
					or upper(a.kondisi) like upper('%$kriteria%') 
					or upper(a.keterangan) like upper('%$kriteria%') 
					or upper(a.nilai) like upper('%$kriteria%')
					or upper(b.nm_brg) like upper('%$kriteria%') 
					or upper(a.asal) like upper('%$kriteria%') 
					or upper(a.merek) like upper('%$kriteria%')
					or upper(a.no_polisi) like upper('%$kriteria%')
					)";
		}if($gol=='03'){
			$kunci	= "(upper(a.tahun) like upper('%$kriteria%') 
					or upper(a.kondisi) like upper('%$kriteria%') 
					or upper(a.keterangan) like upper('%$kriteria%') 
					or upper(a.nilai) like upper('%$kriteria%')
					or upper(b.nm_brg) like upper('%$kriteria%') 
					or upper(a.asal) like upper('%$kriteria%') 
					or upper(a.luas_gedung) like upper('%$kriteria%') 
					or upper(a.luas_tanah) like upper('%$kriteria%')
					or upper(a.luas_lantai) like upper('%$kriteria%')
					or upper(a.alamat1) like upper('%$kriteria%')
					)";
		}if($gol=='04'){
			$kunci	= "(upper(a.tahun) like upper('%$kriteria%') 
					or upper(a.kondisi) like upper('%$kriteria%') 
					or upper(a.keterangan) like upper('%$kriteria%') 
					or upper(a.nilai) like upper('%$kriteria%')
					or upper(b.nm_brg) like upper('%$kriteria%')
					or upper(a.asal) like upper('%$kriteria%') 
					or upper(a.panjang) like upper('%$kriteria%') 
					or upper(a.luas) like upper('%$kriteria%')
					or upper(a.lebar) like upper('%$kriteria%')
					or upper(a.alamat1) like upper('%$kriteria%')
					)";
		}if($gol=='05'){
			$kunci	= "(upper(a.tahun) like upper('%$kriteria%') 
					or upper(a.kondisi) like upper('%$kriteria%') 
					or upper(a.keterangan) like upper('%$kriteria%') 
					or upper(a.nilai) like upper('%$kriteria%')
					or upper(b.nm_brg) like upper('%$kriteria%')
					or upper(a.peroleh) like upper('%$kriteria%') 
					or upper(a.asal) like upper('%$kriteria%')
					or upper(a.cipta) like upper('%$kriteria%')
					or upper(a.penerbit) like upper('%$kriteria%')
					or upper(a.kd_bahan) like upper('%$kriteria%')
					or upper(a.judul) like upper('%$kriteria%')
					)";
		}if($gol=='06'){
			$kunci	= "(upper(a.tahun) like upper('%$kriteria%') 
					or upper(a.kondisi) like upper('%$kriteria%') 
					or upper(a.keterangan) like upper('%$kriteria%') 
					or upper(a.nilai) like upper('%$kriteria%')
					or upper(b.nm_brg) like upper('%$kriteria%') 
					or upper(a.luas) like upper('%$kriteria%')
					or upper(a.asal) like upper('%$kriteria%')
					or upper(a.alamat1) like upper('%$kriteria%')
					)";
		}
		
        if($tahun2 == ''){ 
            $where1 = "where a.kd_skpd like '%$skpd%' and a.tahun like '%$tahun%' and $kunci";
        }else{
            $where1 = "where a.kd_skpd like '%$skpd%' and $kunci AND a.tahun>='$tahun' AND a.tahun<='$tahun2'";
        }        
 if($gol=='01'){        
$sql="SELECT a.kd_brg,b.nm_brg,'-' AS merek,a.nilai,a.tahun,a.kd_skpd,a.kondisi,a.keterangan
FROM trkib_a a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";}
 elseif($gol=='02'){        
$sql="SELECT a.kd_brg,b.nm_brg,ifnull((a.merek),'-') as merek,a.nilai,a.tahun,a.kd_skpd,a.kondisi,a.keterangan
FROM trkib_b a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";} 
 elseif($gol=='03'){        
$sql="SELECT a.kd_brg,b.nm_brg,ifnull((a.luas_tanah),'-') as merek,a.nilai,a.tahun,a.kd_skpd,a.kondisi,a.keterangan
FROM trkib_c a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";}
 elseif($gol=='04'){        
$sql="SELECT a.kd_brg,b.nm_brg,ifnull((a.panjang),'-') as merek,a.nilai,a.tahun,a.kd_skpd,a.kondisi,a.keterangan
FROM trkib_d a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";}
 elseif($gol=='05'){        
$sql="SELECT a.kd_brg,b.nm_brg,ifnull((a.judul),'-') as merek,a.nilai,a.tahun,a.kd_skpd ,a.kondisi,a.keterangan
FROM trkib_e a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";}
 elseif($gol=='06'){        
$sql="SELECT a.kd_brg,b.nm_brg,'-' AS merek,a.nilai,a.tahun,a.kd_skpd,a.kondisi,a.keterangan
FROM trkib_f a INNER JOIN mbarang b ON a.kd_brg=b.kd_brg 
$where1";}
		
       // $sql = "SELECT * from mbarang_umur $where order by kd_barang";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' 			=> $ii,        
                        'golongan' 		=> $resulte['kd_brg'],
                        'nm_golongan' 	=> $resulte['nm_brg'],
                        'jenis' 		=> $resulte['merek'],    
                        'nilai' 		=> $resulte['nilai'],
                        'tahun' 		=> $resulte['tahun'],      
                        'kd_skpd' 		=> $resulte['kd_skpd']                                                                                             
                        );
                        $ii++;
        }
           
        echo json_encode($result);
       }
    	   
	}




 function load_masa() {
    if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';
        if ($kriteria <> ''){                               
            $where="where (upper(nama) like upper('%$kriteria%') or kd_barang like'%$kriteria%')";            
        }
        
        $sql = "SELECT * from mbarang_umur $where order by kd_barang";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'golongan' => $resulte['kd_barang'],
                        'nm_golongan' => $resulte['nama'],
                        'jenis' => $resulte['umur']                                                                                           
                        );
                        $ii++;
        }
           
        echo json_encode($result);
       }
    	   
	}


 function load_golongan() {
    if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';
        if ($kriteria <> ''){                               
            $where="where (upper(nm_golongan) like upper('%$kriteria%') or golongan like'%$kriteria%')";            
        }
        
        $sql = "SELECT *,IF(jenis=1,'Aset','Non Aset') AS ketjenis from mgolongan $where order by golongan";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'golongan' => $resulte['golongan'],
                        'nm_golongan' => $resulte['nm_golongan'],
                        'jenis' => $resulte['jenis'],
                        'ketjenis' => $resulte['ketjenis']                                                                                           
                        );
                        $ii++;
        }
           
        echo json_encode($result);
       }
    	   
	}
    
    function load_bidang_skpd() {
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
            $where="where nm_bidskpd like'%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM mbidskpd $where order by kd_bidskpd");
        $trh = $rs->row();
        $sql = "SELECT * FROM mbidskpd $where order by kd_bidskpd limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_bidskpd' => $resulte['kd_bidskpd'],
                        'nm_bidskpd' => $resulte['nm_bidskpd'],
                        'kd_skpd' => $resulte['kd_skpd']                                                                                      
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result(); 
        }  
	}
    
    function load_unit_bidang() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        //$coba = array();
	    $offset = ($page-1)*$rows;
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';
        if ($kriteria <> ''){                               
            $where="where nm_uskpd like'%$kriteria%' or kd_uskpd like'%$kriteria%' or kd_skpd like '%$kriteria%'";            
        }
        $rs = $this->db->query("select count(*) as tot FROM unit_skpd $where order by kd_uskpd");
        $trh = $rs->row();
        $sql = "SELECT * FROM unit_skpd $where order by kd_uskpd limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_uskpd' => $resulte['kd_uskpd'],
                        'nm_uskpd' => $resulte['nm_uskpd'],
                        'kd_bidskpd' => $resulte['kd_bidskpd'],
                        'alamat' => $resulte['alamat'],
                        'kd_skpd' => $resulte['kd_skpd'],
                        'nm_skpd' => $resulte['nm_skpd']                                                                                      
                        );
                        $ii++;
        }
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result(); 
        }  
	}
    
    function load_unit_kerja() {
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
            $where="where nm_uker like'%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM unit_kerja $where order by kd_uker");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM unit_kerja $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_uker' => $resulte['kd_uker'],
                        'nm_uker' => $resulte['nm_uker'],
                        'kd_uskpd' => $resulte['kd_uskpd'],
                        'alamat' => $resulte['alamat'],
                        'kd_skpd' => $resulte['kd_skpd']                                                                                      
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
    
    function load_bidang() {
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
            $where="where a.nm_bidang like'%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mbidang a $where order by bidang");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT a.*, concat(golongan,' - ',(SELECT nm_golongan FROM mgolongan WHERE golongan = a.golongan)) AS nmgol FROM mbidang a $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'bidang' => $resulte['bidang'],
                        'nm_bidang' => $resulte['nm_bidang'],
                        'golongan' => $resulte['golongan'],
                        'nmgol' => $resulte['nmgol']                                                                                           
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}  
    
      function load_usaha() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        
        $kriteria = '';
        $kriteria = $this->input->post('cari'); 
        $where2='';
        if($kriteria <> ''){
          $where2 =" where UPPER(a.nm_comp) LIKE UPPER('%$kriteria%')";
        }
		
        /*$where1 ='';
        $skpd 		= $this->session->userdata('unit_skpd');
        $oto  		= $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where kd_unit like '%' ";
        }else{
            $where1 = "where kd_unit ='$skpd' ";
        } */       
         
        $rs = $this->db->query("select count(*) as tot FROM mcompany a  $where2 order by kd_comp");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT a.*, CASE 
                    WHEN a.bentuk='1' THEN 'PT/NV'
                    WHEN a.bentuk='2' THEN 'CV'
                    WHEN a.bentuk='3' THEN 'FIRMA'
                    WHEN a.bentuk='4' THEN 'Lain-lain'
                    END AS nmbentuk FROM mcompany a  $where2 order by kd_comp limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_comp' => $resulte['kd_comp'],
                        'nm_comp' => $resulte['nm_comp'],
                        'kd_skpd' => $resulte['kd_skpd'],
                        'kd_unit' => $resulte['kd_unit'],
                        'bentuk' => $resulte['bentuk'],
                        'alamat' => $resulte['alamat'],
                        'pimpinan' => $resulte['pimpinan'],
                        'kd_bank' => $resulte['kd_bank'],
                        'rekening' => $resulte['rekening'],
                        'nmbentuk' => $resulte['nmbentuk']
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();
        }   
	} 
    
    function load_subkelompok() {
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
            $where="where a.nm_kelompok like'%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mkelompok1 a $where order by kd_kelompok");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT a.*, concat(kelompok,' - ',(SELECT nm_kelompok FROM mkelompok WHERE kelompok = a.kelompok)) AS nmkel FROM mkelompok1 a $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_kelompok' => $resulte['kd_kelompok'],
                        'nm_kelompok' => $resulte['nm_kelompok'],
                        'kelompok' => $resulte['kelompok'],
                        'nmkel' => $resulte['nmkel']                                                                                           
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result(); 
        }  
	} 
    
    function load_barang() {
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
            $where="where a.nm_brg like'%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mbarang a $where order by kd_brg");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT a.*, concat(kd_kelompok,' - ',(SELECT nm_kelompok FROM mkelompok1 WHERE kd_kelompok = a.kd_kelompok)) AS nmkel FROM mbarang a $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_brg' => $resulte['kd_brg'],
                        'nm_brg' => $resulte['nm_brg'],
                        'kd_rek5' => $resulte['kd_rek5'],
                        'kd_kelompok' => $resulte['kd_kelompok'],
                        'nmkel' => $resulte['nmkel']                                                                                           
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
    
    function load_wilayah() {
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
            $where="where nm_wilayah like'%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mwilayah a $where order by kd_wilayah");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM mwilayah $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_wilayah' => $resulte['kd_wilayah'],
                        'nm_wilayah' => $resulte['nm_wilayah'],
                        'kd_provinsi' => $resulte['kd_provinsi'],
                        'nm_provinsi' => $resulte['nm_provinsi']                                                                               
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}
    
    function load_alamat() {
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
            $where="where nm_distrik like'%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM m_alamat a $where order by kd_distrik");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM m_alamat $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_distrik' => $resulte['kd_distrik'],
                        'nm_distrik' => $resulte['nm_distrik']                                                                            
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
        $query1->free_result();   
        }
    }
    function load_unit() {
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
            $where="where nm_unit like'%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM m_unit a $where order by kd_unit");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT a.kd_unit,a.nm_unit,a.kd_distrik,b.nm_distrik FROM m_unit a inner join m_alamat b on a.kd_distrik=b.kd_distrik $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_unit' => $resulte['kd_unit'],
                        'kd_distrik' => $resulte['kd_distrik'],
                        'nm_distrik' => $resulte['nm_distrik'],
                        'nm_unit' => $resulte['nm_unit']                                                                            
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
        $query1->free_result();   
        }
    }
       function load_lokasi() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $result     = array();
        $coba       = array();
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        
        $skpd 		= $this->session->userdata('unit_skpd');
        $oto  		= $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where kd_skpd like '%' ";
        }else{
            $where1 = "where kd_lokasi ='$skpd' ";
        }        
          
        $kriteria = '';
        $kriteria = $this->input->post('cari');
          $where2='';
        if($kriteria <> ''){
            $where2 ="and (UPPER(nm_lokasi) LIKE UPPER('%$kriteria%') or UPPER(kd_skpd) LIKE UPPER('%$kriteria%'))";
        }
		
        $rs = $this->db->query("select count(*) as tot FROM mlokasi a $where1 and UPPER(a.kd_skpd) LIKE UPPER('%$kriteria%') order by kd_lokasi");
        $trh = $rs->row();
        
        $sql = "SELECT * FROM mlokasi $where1 $where2 order by kd_skpd,kd_lokasi,kd_uker limit $offset,$rows";
        $query1 = $this->db->query($sql); 
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_lokasi' => $resulte['kd_lokasi'],
                        'nm_lokasi' => $resulte['nm_lokasi'],
                        'kd_uker' => $resulte['kd_uker'],
						'kd_skpd' => $resulte['kd_skpd']
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();  
        } 
	}

    function load_lokasi_dh() {
       if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $result     = array();
        $coba       = array();
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        
        // $skpd       = $this->session->userdata('unit_skpd');
        $skpd       = $this->session->userdata('skpd');
        $oto        = $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where a.kd_skpd like '%' ";
        }else{
            $where1 = "where a.kd_skpd ='$skpd' ";
        }        
          
        $kriteria = '';
        $kriteria = $this->input->post('cari');
          $where2='';
        if($kriteria <> ''){
            $where2 ="and (UPPER(a.nm_lokasi) LIKE UPPER('%$kriteria%') or UPPER(a.kd_skpd) LIKE UPPER('%$kriteria%') or UPPER(c.nm_skpd) LIKE UPPER('%$kriteria%'))";
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mlokasi a $where1 and UPPER(a.kd_skpd) LIKE UPPER('%$kriteria%') order by kd_lokasi");
        $trh = $rs->row();
        
        $sql = "SELECT a.kd_lokasi,a.nm_lokasi,a.kd_uker,b.nm_uker,a.kd_skpd,c.nm_skpd FROM mlokasi a LEFT JOIN unit_kerja b ON a.kd_uker=b.kd_uker LEFT JOIN ms_skpd c ON a.kd_skpd=c.kd_skpd $where1 $where2 order by a.kd_skpd,a.kd_lokasi,a.kd_uker limit $offset,$rows";
        $query1 = $this->db->query($sql); 
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_lokasi' => $resulte['kd_lokasi'],
                        'nm_lokasi' => $resulte['nm_lokasi'],
                        'kd_uker' => $resulte['kd_uker'],
                        'nm_uker' => $resulte['nm_uker'],
                        'kd_skpd' => $resulte['kd_skpd'],
                        'nm_skpd' => $resulte['nm_skpd']
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
        $query1->free_result();  
        } 
    }
    
	    /*function load_hapus() {
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
            $where="where nm_lokasi like'%$kriteria%' or kd_lokasi like '%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mlokasi a $where order by kd_lokasi");
        $trh = $rs->row();
        
        $sql = "SELECT * FROM mlokasi $where order by kd_lokasi,kd_uker,kd_skpd limit $offset,$rows";
        $query1 = $this->db->query($sql); 
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_lokasi' => $resulte['kd_lokasi'],
                        'nm_lokasi' => $resulte['nm_lokasi'],
                        'kd_uker' => $resulte['kd_uker'],
						'kd_skpd' => $resulte['kd_skpd']
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();  
        } 
	}*/
	
    function load_ruang() {
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
            $where="where nm_ruang like'%$kriteria%' or kd_ruang like '%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mruang  $where order by kd_ruang");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM mruang $where order by kd_ruang limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_ruang' => $resulte['kd_ruang'],
                        'nm_ruang' => $resulte['nm_ruang'],
                        'kd_uker' => $resulte['kd_uker']                                                                               
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result(); 
        }  
	}
    
    function load_satuan() {
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
            $where="where nm_satuan like'%$kriteria%' or kd_satuan like '%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM msatuan  $where order by kd_satuan");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM msatuan $where order by kd_satuan limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_satuan' => $resulte['kd_satuan'],
                        'nm_satuan' => $resulte['nm_satuan']                                                                           
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result(); 
        }  
	}
    
    function load_pangkat() {
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
            $where="where nm_pangkat like'%$kriteria%' or kd_pangkat like '%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mpangkat  $where order by kd_pangkat");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM mpangkat $where order by kd_pangkat limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_pangkat' => $resulte['kd_pangkat'],
                        'nm_pangkat' => $resulte['nm_pangkat']                                                                           
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result(); 
        }  
	}
    
    function load_warna() {
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
            $where="where nm_warna like'%$kriteria%' or kd_warna like '%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mwarna  $where order by kd_warna");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM mwarna $where order by kd_warna limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_warna' => $resulte['kd_warna'],
                        'nm_warna' => $resulte['nm_warna']                                                                           
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();   
        }
	}

    function ceknip(){
        $cnip=$this->input->post('nip');
        $sub=$this->input->post('kd_lokasi');
        $query=$this->db->query("SELECT COUNT(*) AS jumlah FROM ttd WHERE nip='$cnip' AND kd_lokasi='$sub'");
        $result=array();
        foreach ($query->result_array() as $resulte) {
            $result[]= array('jumlah' =>$resulte['jumlah']);
        }
        echo json_encode($result);
    }
    
    function load_ttd() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $skpd	 	= $this->input->post('kdlokasi');
        $oto  		= $this->session->userdata('otori');
        $coba = array();
        /*$where1 = '';       
        if($oto == '01'){ 
            $where1 = "where unit like '%' ";
        }else{
            $where1 = "where unit ='$skpd' ";
        } */       
          
        $kriteria = '';
        $kriteria = $this->input->post('cari');
          $where2='';
        if($kriteria <> ''){
            $where2 ="and UPPER(nama) LIKE UPPER('%$kriteria%')";
        }
		
        $rs = $this->db->query("select count(*) as tot FROM ttd where kd_lokasi='$skpd' $where2 ORDER BY nm_skpd");
        $trh = $rs->row();
        $result["total"] = $trh->tot;
        
        $sql = "SELECT *,IF((COUNT(skpd)+COUNT(nip)+COUNT(nama))='3','OK','NO') AS tanda FROM ttd where kd_lokasi='$skpd' $where2 GROUP BY unit,nip,nm_skpd,kd_pangkat,ckey,nama ORDER BY nm_skpd limit $offset,$rows";//
        $query1 = $this->db->query($sql);  
        $result = array();
               
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' 		=> $ii,        
                        'nip' 		=> $resulte['nip'],
                        'nama' 		=> $resulte['nama'],
                        'jabatan'	=> $resulte['jabatan'],
                        'kd_skpd' 	=> $resulte['skpd'],
                        'unit'    	=> $resulte['unit'],
                        'nm_skpd' 	=> $resulte['nm_skpd'],
                        'ckey' 		=> $resulte['ckey'],
                        'kd_pangkat' => $resulte['kd_pangkat'],
                        'status' 	=> $resulte['tanda']
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"]  = $coba;   
        echo json_encode($result);
    	$query1->free_result(); 
        }  
	}
    
    
    function load_milik() {
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
            $where="where nm_milik like'%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mmilik a $where order by kd_milik");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM mmilik $where order by kd_milik limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_milik' => $resulte['kd_milik'],
                        'nm_milik' => $resulte['nm_milik']                                                                               
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();  
        } 
	}
    
    
    function load_kelompok() {
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
            $where="where a.nm_kelompok like'%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM mkelompok a $where order by kelompok");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT a.*, concat(bidang,' - ',(SELECT nm_bidang FROM mbidang WHERE bidang = a.bidang)) AS nmbid FROM mkelompok a $where limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kelompok' => $resulte['kelompok'],
                        'nm_kelompok' => $resulte['nm_kelompok'],
                        'bidang' => $resulte['bidang'],
                        'nmbid' => $resulte['nmbid']                                                                                           
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
    	$query1->free_result();
        }   
	}  
    
    function ambil_kelompok_dh(){

        $lccr=$this->input->post('q');

        if($lccr!=''){
            $where="and(upper(kelompok) like upper('%$lccr%') or upper(nm_kelompok) like upper('%$lccr%'))  ";
        }else{
            $where="";
        }

        $sql="SELECT * FROM mkelompok WHERE LEFT(kelompok,2) IN ('02','03','04') AND kelompok NOT IN (SELECT kd_barang FROM mbarang_umur) $where order by kelompok";
        $query1   = $this->db->query($sql);  
        $result   = array();
        $ii       = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(
                'id'      => $ii,        
                'kelompok' => $resulte['kelompok'],  
                'nm_kelompok' => $resulte['nm_kelompok']
                );
            $ii++;
        }
        echo json_encode($result);
        $query1->free_result(); 
    }



    function update_master(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $query = $this->input->post('st_query');
        $asg = $this->db->query($query);
        }
    }
    function simpan_master(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $tabel   = $this->input->post('tabel');
        $lckolom = $this->input->post('kolom');
        $lcnilai = $this->input->post('nilai');
        $cid     = $this->input->post('cid');
        $lcid    = $this->input->post('lcid');
        

            $sql = "insert into $tabel $lckolom values $lcnilai";
            $asg = $this->db->query($sql);
        }
    }
    
    function simpan_mbidang(){
        $tabel= $this->input->post('tabel');
        $lckolom= $this->input->post('kolom');
        $lcnilai= $this->input->post('nilai');
        $cid= $this->input->post('cid');
        $lcid= $this->input->post('lcid');
        $skpd= $this->input->post('skpd');

        $sql = "delete from $tabel where $cid='$lcid' and kd_skpd='$skpd'";
        $asg = $this->db->query($sql);
        if($asg){
            $sql="insert into $tabel $lckolom values $lcnilai";
            $asg=$this->db->query($sql);
        }
    }
    function del_bid(){
        $tabel= $this->input->post('tabel');
        $cnid= $this->input->post('cnid');
        $cid= $this->input->post('cid');
        $cid2= $this->input->post('cid2');
        $skpd= $this->input->post('skpd');

         $csql = "delete from $tabel where $cid = '$cnid' and $cid2='$skpd'";
        $asg = $this->db->query($csql);
        if ($asg){
            echo '1'; 
        } else{
            echo '0';
        }
    }

    function simpan_unitbidang(){
        $tabel= $this->input->post('tabel');
        $lckolom= $this->input->post('kolom');
        $lcnilai= $this->input->post('nilai');
        $cid= $this->input->post('cid');
        $cid2= $this->input->post('cid2');
        $lcid= $this->input->post('lcid');
        $skpd= $this->input->post('skpd');

        $sql = "delete from $tabel where $cid='$lcid' and $cid2='$skpd'";
        $asg = $this->db->query($sql);
        if($asg){
            $sql="insert into $tabel $lckolom values $lcnilai";
            $asg=$this->db->query($sql);
        }
    }

    function del_ubid(){
        $tabel= $this->input->post('tabel');
        $cnid= $this->input->post('cnid');
        $cid= $this->input->post('cid');
        $cid2= $this->input->post('cid2');
        $skpd= $this->input->post('skpd');

         $csql = "delete from $tabel where $cid = '$cnid' and $cid2='$skpd'";
        $asg = $this->db->query($csql);
        if ($asg){
            echo '1'; 
        } else{
            echo '0';
        }
    }

    function del_lokasi(){
        $tabel=$this->input->post('tabel');
        $cnid=$this->input->post('cnid');
        $cid=$this->input->post('cid');
        $cnid2=$this->input->post('cnid2');
        $cid2=$this->input->post('cid2');
        $cnid3=$this->input->post('cnid3');
        $cid3=$this->input->post('cid3');

        $csql = "delete from $tabel where $cid = '$cnid' and $cid2='$cnid2' and $cid3='$cnid3'";
        $asg = $this->db->query($csql);
        if ($asg){
            echo '1'; 
        } else{
            echo '0';
        }
    }

    function simpan_lokasi(){
        $tabel= $this->input->post('tabel');
        $lckolom= $this->input->post('kolom');
        $lcnilai= $this->input->post('nilai');
        $cid= $this->input->post('cid');
        $cid2= $this->input->post('cid2');
        $lcid= $this->input->post('lcid');
        $skpd= $this->input->post('skpd');
        $cid3=$this->input->post('cid3');
        $kd_uker=$this->input->post('kd_uker');
        $sql = "delete from $tabel where $cid='$lcid' and $cid2='$skpd' AND $cid3='$kd_uker'";
        $asg = $this->db->query($sql);
        if($asg){
            $sql="insert into $tabel $lckolom values $lcnilai";
            $asg=$this->db->query($sql);
        }
    }
//DEMANSYAH 4 maret 2016
    function simpan_usaha(){
        $ckdusaha   =$this->input->post('ckdusaha');
        $cnmusaha   =$this->input->post('cnmusaha');
        $cjnsusaha  =$this->input->post('cjnsusaha');
        $calamat    =$this->input->post('calamat');
        $cpimpin    =$this->input->post('cpimpin');
        $ckdbank    =$this->input->post('ckdbank');
        $ckdrek     =$this->input->post('ckdrek');

        $query = $this->db->query("SELECT IF(MAX(kd_comp)IS NULL,LPAD('1',4,0),LPAD(MAX(kd_comp)+1,4,0))AS nomor FROM mcompany");

          foreach($query->result() as $res){
          $no  =$res->nomor;
           }
           if($ckdusaha<=$no){
                $sql="INSERT INTO mcompany (kd_comp,nm_comp,bentuk,alamat,pimpinan,kd_bank,rekening) VALUES
                                   ('$no','$cnmusaha','$cjnsusaha','$calamat','$cpimpin','$ckdbank','$ckdrek')";
                $query1 = $this->db->query($sql);
           }else{
                $sql="INSERT INTO mcompany (kd_comp,nm_comp,bentuk,alamat,pimpinan,kd_bank,rekening) VALUES
                                   ('$ckdusaha','$cnmusaha','$cjnsusaha','$calamat','$cpimpin','$ckdbank','$ckdrek')";
                $query1 = $this->db->query($sql);
           } 
        
    }
    
    
     function hapus_master(){
        //no:cnomor,skpd:cskpd
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $ctabel = $this->input->post('tabel');
        $cid    = $this->input->post('cid');
        $cnid   = $this->input->post('cnid');
        
        $csql = "delete from $ctabel where $cid = '$cnid'";
        $asg = $this->db->query($csql);
        if ($asg){
            echo '1'; 
        } else{
            echo '0';
        }
        }              
    }
	
	function hapus_master_unit(){
        //no:cnomor,skpd:cskpd
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $ctabel = $this->input->post('tabel');
        $cid = $this->input->post('cid');
        $cnid = $this->input->post('cnid');
        $cunit = $this->input->post('unit');
        $ckd_unit = $this->input->post('kolom');
        
        $csql = "delete from $ctabel where $cid = '$cnid' and $ckd_unit='$cunit'";
        $asg = $this->db->query($csql);
        if ($asg){
            echo '1'; 
        } else{
            echo '0';
        }
        }              
    }
	
	function hapus_master_lengkap(){
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $ctabel 	= $this->input->post('tabel');
        $cid 		= $this->input->post('cid');
        $cnid 		= $this->input->post('cnid');
        $cid2 		= $this->input->post('cid2');
        $cnid2 		= $this->input->post('cnid2');
        $cid3 		= $this->input->post('cid3');
        $cnid3 		= $this->input->post('cnid3');
        
        $csql = "delete from $ctabel where $cid = '$cnid' and $cid2 = '$cnid2' and $cid2 = '$cnid2'";
        $asg = $this->db->query($csql);
        if ($asg){
            echo '1'; 
        } else{
            echo '0';
        }
        }              
    }
    
    function load_kiba() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $kd_unit = $this->session->userdata('skpd');
        $lccr = $this->input->post('q');
		$where ="";
		if($lccr<>''){
		$where="and b.nm_brg like '%$lccr%'";
		}
        $sql = "select a.no_reg,a.id_barang,b.nm_brg as nama,b.kd_rek_pelihara,a.kd_brg,a.tahun,a.keterangan,a.nilai,'' as kd_satuan from trkib_a a
				left join mbarang b on a.kd_brg=b.kd_brg where a.kd_skpd='$kd_unit' $where";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' 			=> $ii,        
                        'no_reg' 		=> $resulte['no_reg'],
                        'id_barang' 	=> $resulte['id_barang'],
                        'no_reg2' 		=> $resulte['kd_rek_pelihara'],  
                        'nm_bidang' 	=> $resulte['nama'], 
						'kd_brg' 		=> $resulte['kd_brg'], 
                        'tahun' 		=> $resulte['tahun'], 
						'keterangan' 	=> $resulte['keterangan'],
                        'nilai' 		=> $resulte['nilai'],
                        'satuan' 		=> $resulte['kd_satuan']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
	function load_kibb() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $kd_unit = $this->session->userdata('skpd');
        $lccr = $this->input->post('q');
		$where ="";
		if($lccr<>''){
		$where="and b.nm_brg like '%$lccr%'";
		}
        $sql = "select a.no_reg,a.id_barang,b.nm_brg as nama,b.kd_rek_pelihara,a.kd_brg,a.kondisi,a.tahun,a.keterangan,a.nilai,a.kd_satuan from trkib_b a
				left join mbarang b on a.kd_brg=b.kd_brg where a.kd_skpd='$kd_unit' $where";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'no_reg'	 	=> $resulte['no_reg'],  
                        'id_barang' 	=> $resulte['id_barang'],
                        'nm_bidang' 	=> $resulte['nama'], 
						'kd_brg' 		=> $resulte['kd_brg'],
                        'no_reg2' 		=> $resulte['kd_rek_pelihara'], 
                        'kondisi' 		=> $resulte['kondisi'],  
                        'tahun' 		=> $resulte['tahun'], 
						'keterangan' 	=> $resulte['keterangan'],
                        'nilai' 		=> $resulte['nilai'],
                        'satuan' 		=> $resulte['kd_satuan']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}

    function load_kibb_dh() {
       $kdbrg = $this->input->post('kdbrg');
       $tahun = $this->input->post('tahun');
       $skpd = $this->input->post('skpd');
        
        $lccr = $this->input->post('q');
        $where ="";
        if($lccr<>''){
        $where="and b.nm_brg like '%$lccr%'";
        }
        $sql = "SELECT a.no_dokumen,a.no_reg,a.id_barang,b.nm_brg AS nama,b.kd_rek_pelihara,a.kd_brg,a.kondisi,a.tahun,a.keterangan,a.nilai,
                a.kd_satuan,a.masa_manfaat,IF(MAX(a.pemeliharaan_ke)IS NULL,LPAD('1',4,0),LPAD(MAX(a.pemeliharaan_ke)+1,4,0))AS pelihara 
                FROM trkib_b a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg where a.kd_skpd='$skpd' and a.tahun='$tahun' and a.kd_brg='$kdbrg' $where GROUP BY a.no_reg";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'no_dokumen'    => $resulte['no_dokumen'],
                        'no_reg'        => $resulte['no_reg'],
                        'id_barang'     => $resulte['id_barang'],
                        'nama'          => $resulte['nama'],
                        'kd_rek_pelihara'=> $resulte['kd_rek_pelihara'],
                        'kd_brg'        => $resulte['kd_brg'],
                        'kondisi'       => $resulte['kondisi'],
                        'tahun'         => $resulte['tahun'],
                        'keterangan'    => $resulte['keterangan'],
                        'nilai'         => $resulte['nilai'],
                        'nilai2'        => number_format($resulte['nilai'],2,'.',','),
                        'kd_satuan'     => $resulte['kd_satuan'],
                        'masa_manfaat'  => $resulte['masa_manfaat'],
                        'pelihara'      => $resulte['pelihara']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
   
           
    }

     function load_kibc_dh() {
       $kdbrg = $this->input->post('kdbrg');
       $tahun = $this->input->post('tahun');
       $skpd = $this->input->post('skpd');
        
        $lccr = $this->input->post('q');
        $where ="";
        if($lccr<>''){
        $where="and b.nm_brg like '%$lccr%'";
        }
        $sql = "SELECT a.no_dokumen,a.no_reg,a.id_barang,b.nm_brg AS nama,b.kd_rek_pelihara,a.kd_brg,a.kondisi,a.tahun,a.keterangan,a.nilai,
                a.masa_manfaat,IF(MAX(a.pemeliharaan_ke)IS NULL,LPAD('1',4,0),LPAD(MAX(a.pemeliharaan_ke)+1,4,0))AS pelihara 
                FROM trkib_c a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg where a.kd_skpd='$skpd' and a.tahun='$tahun' and a.kd_brg='$kdbrg' $where GROUP BY a.no_reg";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'no_dokumen'    => $resulte['no_dokumen'],
                        'no_reg'        => $resulte['no_reg'],
                        'id_barang'     => $resulte['id_barang'],
                        'nama'          => $resulte['nama'],
                        'kd_rek_pelihara'=> $resulte['kd_rek_pelihara'],
                        'kd_brg'        => $resulte['kd_brg'],
                        'kondisi'       => $resulte['kondisi'],
                        'tahun'         => $resulte['tahun'],
                        'keterangan'    => $resulte['keterangan'],
                        'nilai'         => $resulte['nilai'],
                        'nilai2'        => number_format($resulte['nilai'],2,'.',','),
                        'masa_manfaat'  => $resulte['masa_manfaat'],
                        'pelihara'      => $resulte['pelihara']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
   
           
    }

    function load_kibc() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $kd_unit = $this->session->userdata('skpd');
        $lccr = $this->input->post('q');
		$where ="";
		if($lccr<>''){
		$where="and b.nm_brg like '%$lccr%'";
		}
        $sql = "select a.no_reg,a.id_barang,b.nm_brg as nama,b.kd_rek_pelihara,a.kd_brg,a.kondisi,a.tahun,a.keterangan,a.nilai,'' as kd_satuan from trkib_c a
				left join mbarang b on a.kd_brg=b.kd_brg where a.kd_skpd='$kd_unit' $where";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'no_reg'		=> $resulte['no_reg'], 
                        'id_barang' 	=> $resulte['id_barang'],
                        'nm_bidang' 	=> $resulte['nama'],  
                        'kd_brg' 		=> $resulte['kd_brg'],
                        'no_reg2' 		=> $resulte['kd_rek_pelihara'], 
                        'kondisi' 		=> $resulte['kondisi'],  
                        'tahun' 		=> $resulte['tahun'], 
						'keterangan' 	=> $resulte['keterangan'],
                        'nilai' 		=> $resulte['nilai'],
                        'satuan' 		=> $resulte['kd_satuan']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}

    function load_kibd_dh() {
       $kdbrg = $this->input->post('kdbrg');
       $tahun = $this->input->post('tahun');
       $skpd = $this->input->post('skpd');
        
        $lccr = $this->input->post('q');
        $where ="";
        if($lccr<>''){
        $where="and b.nm_brg like '%$lccr%'";
        }
        $sql = "SELECT a.no_dokumen,a.no_reg,a.id_barang,b.nm_brg AS nama,b.kd_rek_pelihara,a.kd_brg,a.kondisi,a.tahun,a.keterangan,a.nilai,
                a.masa_manfaat,IF(MAX(a.pemeliharaan_ke)IS NULL,LPAD('1',4,0),LPAD(MAX(a.pemeliharaan_ke)+1,4,0))AS pelihara 
                FROM trkib_d a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg where a.kd_skpd='$skpd' and a.tahun='$tahun' and a.kd_brg='$kdbrg' $where GROUP BY a.no_reg";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'no_dokumen'    => $resulte['no_dokumen'],
                        'no_reg'        => $resulte['no_reg'],
                        'id_barang'     => $resulte['id_barang'],
                        'nama'          => $resulte['nama'],
                        'kd_rek_pelihara'=> $resulte['kd_rek_pelihara'],
                        'kd_brg'        => $resulte['kd_brg'],
                        'kondisi'       => $resulte['kondisi'],
                        'tahun'         => $resulte['tahun'],
                        'keterangan'    => $resulte['keterangan'],
                        'nilai'         => $resulte['nilai'],
                        'nilai2'        => number_format($resulte['nilai'],2,'.',','),
                        'masa_manfaat'  => $resulte['masa_manfaat'],
                        'pelihara'      => $resulte['pelihara']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
   
           
    }
	
    function load_kibd() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$kd_skpd = $this->session->userdata('skpd');
        $kd_skpd = $this->input->post('skpd');
        $kd_unit = $this->input->post('unit');

        $lccr = $this->input->post('q');
		$where ="";
		if($lccr<>''){
		$where="and b.nm_brg like '%$lccr%'";
		}
        $sql = "select a.no_reg,a.id_barang,b.nm_brg as nama,b.kd_rek_pelihara,a.kd_brg,a.kondisi,a.tahun,a.keterangan,a.nilai,'' as kd_satuan from trkib_d a
				left join mbarang b on a.kd_brg=b.kd_brg where a.kd_skpd='$kd_skpd' and a.kd_unit='$kd_unit' $where";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'no_reg' 		=> $resulte['no_reg'],  
                        'id_barang' 	=> $resulte['id_barang'],
                        'nm_bidang' 	=> $resulte['nama'],
						'kd_brg' 		=> $resulte['kd_brg'],
                        'no_reg2' 		=> $resulte['kd_rek_pelihara'], 
                        'kondisi' 		=> $resulte['kondisi'],  
                        'tahun' 		=> $resulte['tahun'], 
						'keterangan' 	=> $resulte['keterangan'], 
                        'nilai' 		=> $resulte['nilai'],
                        'satuan' 		=> $resulte['kd_satuan']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
	function load_kibe() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $kd_unit = $this->session->userdata('skpd');
        $lccr = $this->input->post('q');
		$where ="";
		if($lccr<>''){
		$where="and b.nm_brg like '%$lccr%'";
		}
        $sql = "select a.no_reg,a.id_barang,b.nm_brg as nama,b.kd_rek_pelihara,a.kd_brg,a.kondisi,a.tahun,a.keterangan,a.nilai,a.kd_satuan from trkib_e a
				left join mbarang b on a.kd_brg=b.kd_brg where a.kd_skpd='$kd_unit' $where";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'no_reg' 		=> $resulte['no_reg'],  
                        'id_barang' 	=> $resulte['id_barang'],
                        'nm_bidang' 	=> $resulte['nama'], 
						'kd_brg' 		=> $resulte['kd_brg'],
                        'no_reg2' 		=> $resulte['kd_rek_pelihara'], 
                        'kondisi' 		=> $resulte['kondisi'],  
                        'tahun' 		=> $resulte['tahun'], 
						'keterangan' 	=> $resulte['keterangan'],
                        'nilai' 		=> $resulte['nilai'],
                        'satuan' 		=> $resulte['kd_satuan']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
    function load_kibf() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $kd_unit = $this->session->userdata('skpd');
        $lccr = $this->input->post('q');
		$where ="";
		if($lccr<>''){
		$where="and b.nm_brg like '%$lccr%'";
		}
        $sql = "select a.no_reg,a.id_barang,b.nm_brg as nama,b.kd_rek_pelihara,a.kd_brg,a.kondisi,a.tahun,a.keterangan,a.nilai,'' as kd_satuan from trkib_f a
				left join mbarang b on a.kd_brg=b.kd_brg where a.kd_skpd='$kd_unit' $where";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' 			=> $ii,        
                        'no_reg' 		=> $resulte['no_reg'],  
                        'id_barang' 	=> $resulte['id_barang'], 
                        'nm_bidang' 	=> $resulte['nama'], 
						'kd_brg' 		=> $resulte['kd_brg'],
                        'no_reg2' 		=> $resulte['kd_rek_pelihara'], 
                        'kondisi' 		=> $resulte['kondisi'],  
                        'tahun' 		=> $resulte['tahun'], 
						'keterangan' 	=> $resulte['keterangan'],
                        'nilai' 		=> $resulte['nilai'],
                        'satuan' 		=> $resulte['kd_satuan']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
//-- formulir pengadaaan --//
// ASLI aldi buat
//    function ambil_barang() {
//         if($this->auth->is_logged_in() == false){
//            	redirect(site_url().'/welcome/login');
//       	}else{
//         $oto	 = $this->session->userdata('oto');
//         $kd_unit = $this->session->userdata('unit_skpd');
// 		$where="";
// 		if($oto=='01'){
// 		$where="";
// 		}else{
// 		$where="and kd_unit='$kd_unit'";
// 		}
//         $lccr = $this->input->post('gol');
//         $sql = "SELECT no_dokumen,kd_brg,kd_uskpd,nm_brg,merek,jumlah,harga,total,ket FROM trd_planbrg where left(kd_brg,2)='$lccr' $where order by kd_brg";
//         $query1 = $this->db->query($sql);  
//         $result = array();
//         $ii = 0;
//         foreach($query1->result_array() as $resulte)
//         { 
           
//             $result[] = array(
//                         'id' 			=> $ii,        
//                         'no_dokumen' 	=> $resulte['no_dokumen'],
//                         'kd_brg' 		=> $resulte['kd_brg'], 
//                         'kd_uskpd' 		=> $resulte['kd_uskpd'], 
//                         'nm_brg' 		=> $resulte['nm_brg'], 
//                         'merek' 		=> $resulte['merek'], 
//                         'jumlah' 		=> $resulte['jumlah'], 
//                         'harga' 		=> $resulte['harga'], 
//                         'total' 		=> $resulte['total'],   
//                         'ket' 	 		=> $resulte['ket']
                       
//                         );
//                         $ii++;
//         }   
//         echo json_encode($result);
//         } 
// 	}
// aldi buat
// coba aldi
// function ambil_barang() {
//     // Mengambil input pencarian dari POST
//     $lccr = $this->input->post('gol');
//     log_message('debug', 'gol: ' . $lccr); // Log untuk memeriksa input

//     // Menyusun kondisi pencarian
//     if($lccr != '') {
//         $where = "WHERE LEFT(kd_brg, 2) = '$lccr'";
//     } else {
//         $where = "";
//     }

//     // Menentukan unit berdasarkan otorisasi pengguna
//     $oto = $this->session->userdata('oto');
//     $kd_unit = $this->session->userdata('unit_skpd');

//     if ($oto != '01') {
//         $where .= " AND kd_unit='$kd_unit'";
//     }

//     // Menyusun query untuk mengambil data barang
//     $sql = "SELECT no_dokumen, kd_brg, kd_uskpd, nm_brg, merek, jumlah, harga, total, ket 
//             FROM trd_planbrg $where 
//             ORDER BY kd_brg";

//     // Menjalankan query
//     $query1 = $this->db->query($sql);
//     $result = array();
//     $ii = 0;

//     // Mengolah hasil query
//     foreach ($query1->result_array() as $resulte) {
//         $result[] = array(
//             'id'         => $ii,
//             'no_dokumen' => $resulte['no_dokumen'],
//             'kd_brg'     => $resulte['kd_brg'],
//             'kd_uskpd'   => $resulte['kd_uskpd'],
//             'nm_brg'     => $resulte['nm_brg'],
//             'merek'      => $resulte['merek'],
//             'jumlah'     => $resulte['jumlah'],
//             'harga'      => $resulte['harga'],
//             'total'      => $resulte['total'],
//             'ket'        => $resulte['ket']
//         );
//         $ii++;
//     }
//     log_message('debug', 'Hasil: ' . json_encode($result)); // Log untuk memeriksa hasil
   
//     // Mengembalikan hasil dalam format JSON
//     echo json_encode($result);
// }

// coba aldi

        public function ambil_barang() {
            // Mengambil input pencarian dari POST
            $lccr = $this->input->post('gol');
            
            // Menyusun kondisi pencarian
            $where = ' WHERE 1=1 '; // Memulai kondisi dengan true untuk mempermudah penambahan kondisi berikutnya

        if ($lccr != '') {
            $where .= " AND LEFT(kd_brg, 2) = '$lccr'"; // Menambahkan kondisi jika ada input pencarian
        }

        // Menentukan unit berdasarkan otorisasi pengguna
        $oto = $this->session->userdata('oto');
        $kd_unit = $this->session->userdata('unit_skpd');

        if ($oto != '01') {
            $where .= " AND kd_unit = '$kd_unit'"; // Menambahkan filter unit jika otorisasi bukan '01'
        }

        // Query untuk mengambil data barang
        $sql = "SELECT no_dokumen, kd_brg, kd_uskpd, nm_brg, merek, jumlah, harga, total, ket 
                FROM trd_planbrg 
                $where 
                ORDER BY kd_brg";

        $query = $this->db->query($sql);
        $result = array();
        $ii = 0;

        // Mengolah hasil query
        foreach ($query->result_array() as $row) {
            $result[] = array(
                'id'         => $ii,
                'kd_brg'     => $row['kd_brg'],
                'nm_brg'     => $row['nm_brg'],
                'no_dokumen' => $row['no_dokumen'],
                'merek'      => $row['merek'],
                'jumlah'     => $row['jumlah'],
                'harga'      => $row['harga'],
                'total'      => $row['total'],
                'ket'        => $row['ket']
            );
            $ii++;
        }

        // Mengembalikan hasil dalam format JSON
        echo json_encode($result);
        }

// fungction baru aldi FORM KIB_A
        public function ambil_barang2() {
            // Mengambil input pencarian dari POST
            $lccr = $this->input->post('gol');
            
            // Menyusun kondisi pencarian
            $where = ' WHERE 1=1 '; // Memulai kondisi dengan true untuk mempermudah penambahan kondisi berikutnya

        if ($lccr != '') {
            $where .= " AND LEFT(kd_brg, 2) = '$lccr'"; // Menambahkan kondisi jika ada input pencarian
        }

        // Menentukan unit berdasarkan otorisasi pengguna
        $oto = $this->session->userdata('oto');
        $kd_unit = $this->session->userdata('unit_skpd');

        if ($oto != '01') {
            $where .= " AND kd_unit = '$kd_unit'"; // Menambahkan filter unit jika otorisasi bukan '01'
        }

        // Query untuk mengambil data barang
        $sql = "SELECT nm_brg, kd_brg, kd_unit, id_barang 
                FROM trkib_a
                $where 
                ORDER BY kd_brg;";

        $query = $this->db->query($sql);
        $result = array();
        $ii = 0;

        // Mengolah hasil query
        foreach ($query->result_array() as $row) {
            $result[] = array(
                'id'         => $ii,
                'kd_brg'     => $row['kd_brg'],
                'kd_unit'    => $row['kd_unit'],
                'nm_brg'     => $row['nm_brg'],
                'id_barang' => $row['id_barang']
            );
            $ii++;
        }
      

        // Mengembalikan hasil dalam format JSON
        echo json_encode($result);
        }

        public function get_no_dokumen() {
            $id_barang = $this->input->post('id_barang'); // Ambil kd_brg yang dikirim dari Ajax
            $this->db->where('id_barang', $id_barang);    // Query berdasarkan kd_brg
            $result = $this->db->get('trkib_a')->row();  // Ambil satu baris data
        
            if ($result) {
                echo json_encode(['id_barang' => $result->id_barang]);  // Kirim kembali no_dokumen dalam format JSON
            } else {
                echo json_encode(['id_barang' => '']);  // Jika tidak ada data, kirim kosong
            }
        }

        // end barang 2

        public function ambil_barang3() {
            // Mengambil input pencarian dari POST
            $lccr = $this->input->post('gol');
            
            // Menyusun kondisi pencarian
            $where = ' WHERE 1=1 '; // Memulai kondisi dengan true untuk mempermudah penambahan kondisi berikutnya

        if ($lccr != '') {
            $where .= " AND LEFT(kd_brg, 2) = '$lccr'"; // Menambahkan kondisi jika ada input pencarian
        }

        // Menentukan unit berdasarkan otorisasi pengguna
        $oto = $this->session->userdata('oto');
        $kd_unit = $this->session->userdata('unit_skpd');

        if ($oto != '01') {
            $where .= " AND kd_unit = '$kd_unit'"; // Menambahkan filter unit jika otorisasi bukan '01'
        }

        // Query untuk mengambil data barang
        $sql = "SELECT nm_brg, kd_brg, kd_unit, id_barang 
                FROM trkib_b
                $where 
                ORDER BY kd_brg;";

        $query = $this->db->query($sql);
        $result = array();
        $ii = 0;

        // Mengolah hasil query
        foreach ($query->result_array() as $row) {
            $result[] = array(
                'id'         => $ii,
                'kd_brg'     => $row['kd_brg'],
                'kd_unit'    => $row['kd_unit'],
                'nm_brg'     => $row['nm_brg'],
                'id_barang' => $row['id_barang']
            );
            $ii++;
        }
      

        // Mengembalikan hasil dalam format JSON
        echo json_encode($result);
        }

        public function get_no_dokumen3() {
            $id_barang = $this->input->post('id_barang'); // Ambil kd_brg yang dikirim dari Ajax
            $this->db->where('id_barang', $id_barang);    // Query berdasarkan kd_brg
            $result = $this->db->get('trkib_b')->row();  // Ambil satu baris data
        
            if ($result) {
                echo json_encode(['id_barang' => $result->id_barang]);  // Kirim kembali no_dokumen dalam format JSON
            } else {
                echo json_encode(['id_barang' => '']);  // Jika tidak ada data, kirim kosong
            }
        }

        //emd ambilbarang3

        //ambil barang 4
        public function ambil_barang4() {
            // Mengambil input pencarian dari POST
            $lccr = $this->input->post('gol');
            
            // Menyusun kondisi pencarian
            $where = ' WHERE 1=1 '; // Memulai kondisi dengan true untuk mempermudah penambahan kondisi berikutnya

        if ($lccr != '') {
            $where .= " AND LEFT(kd_brg, 2) = '$lccr'"; // Menambahkan kondisi jika ada input pencarian
        }

        // Menentukan unit berdasarkan otorisasi pengguna
        $oto = $this->session->userdata('oto');
        $kd_unit = $this->session->userdata('unit_skpd');

        if ($oto != '01') {
            $where .= " AND kd_unit = '$kd_unit'"; // Menambahkan filter unit jika otorisasi bukan '01'
        }

        // Query untuk mengambil data barang
        $sql = "SELECT nm_brg, kd_brg, kd_unit, id_barang 
                FROM trkib_c
                $where 
                ORDER BY kd_brg;";

        $query = $this->db->query($sql);
        $result = array();
        $ii = 0;

        // Mengolah hasil query
        foreach ($query->result_array() as $row) {
            $result[] = array(
                'id'         => $ii,
                'kd_brg'     => $row['kd_brg'],
                'kd_unit'    => $row['kd_unit'],
                'nm_brg'     => $row['nm_brg'],
                'id_barang' => $row['id_barang']
            );
            $ii++;
        }
      

        // Mengembalikan hasil dalam format JSON
        echo json_encode($result);
        }

        public function get_no_dokumen4() {
            $id_barang = $this->input->post('id_barang'); // Ambil kd_brg yang dikirim dari Ajax
            $this->db->where('id_barang', $id_barang);    // Query berdasarkan kd_brg
            $result = $this->db->get('trkib_c')->row();  // Ambil satu baris data
        
            if ($result) {
                echo json_encode(['id_barang' => $result->id_barang]);  // Kirim kembali no_dokumen dalam format JSON
            } else {
                echo json_encode(['id_barang' => '']);  // Jika tidak ada data, kirim kosong
            }
        }
        //end ambilbarang 4
        //ambil barang 5
        public function ambil_barang5() {
            // Mengambil input pencarian dari POST
            $lccr = $this->input->post('gol');
            
            // Menyusun kondisi pencarian
            $where = ' WHERE 1=1 '; // Memulai kondisi dengan true untuk mempermudah penambahan kondisi berikutnya

        if ($lccr != '') {
            $where .= " AND LEFT(kd_brg, 2) = '$lccr'"; // Menambahkan kondisi jika ada input pencarian
        }

        // Menentukan unit berdasarkan otorisasi pengguna
        $oto = $this->session->userdata('oto');
        $kd_unit = $this->session->userdata('unit_skpd');

        if ($oto != '01') {
            $where .= " AND kd_unit = '$kd_unit'"; // Menambahkan filter unit jika otorisasi bukan '01'
        }

        // Query untuk mengambil data barang
        $sql = "SELECT nm_brg, kd_brg, kd_unit, id_barang 
                FROM trkib_d
                $where 
                ORDER BY kd_brg;";

        $query = $this->db->query($sql);
        $result = array();
        $ii = 0;

        // Mengolah hasil query
        foreach ($query->result_array() as $row) {
            $result[] = array(
                'id'         => $ii,
                'kd_brg'     => $row['kd_brg'],
                'kd_unit'    => $row['kd_unit'],
                'nm_brg'     => $row['nm_brg'],
                'id_barang' => $row['id_barang']
            );
            $ii++;
        }
      

        // Mengembalikan hasil dalam format JSON
        echo json_encode($result);
        }

        public function get_no_dokumen5() {
            $id_barang = $this->input->post('id_barang'); // Ambil kd_brg yang dikirim dari Ajax
            $this->db->where('id_barang', $id_barang);    // Query berdasarkan kd_brg
            $result = $this->db->get('trkib_d')->row();  // Ambil satu baris data
        
            if ($result) {
                echo json_encode(['id_barang' => $result->id_barang]);  // Kirim kembali no_dokumen dalam format JSON
            } else {
                echo json_encode(['id_barang' => '']);  // Jika tidak ada data, kirim kosong
            }
        }
        //end ambilbarang 5
        //ambil barang 6
        public function ambil_barang6() {
            // Mengambil input pencarian dari POST
            $lccr = $this->input->post('gol');
            
            // Menyusun kondisi pencarian
            $where = ' WHERE 1=1 '; // Memulai kondisi dengan true untuk mempermudah penambahan kondisi berikutnya

        if ($lccr != '') {
            $where .= " AND LEFT(kd_brg, 2) = '$lccr'"; // Menambahkan kondisi jika ada input pencarian
        }

        // Menentukan unit berdasarkan otorisasi pengguna
        $oto = $this->session->userdata('oto');
        $kd_unit = $this->session->userdata('unit_skpd');

        if ($oto != '01') {
            $where .= " AND kd_unit = '$kd_unit'"; // Menambahkan filter unit jika otorisasi bukan '01'
        }

        // Query untuk mengambil data barang
        $sql = "SELECT nm_brg, kd_brg, kd_unit, id_barang 
                FROM trkib_e
                $where 
                ORDER BY kd_brg;";

        $query = $this->db->query($sql);
        $result = array();
        $ii = 0;

        // Mengolah hasil query
        foreach ($query->result_array() as $row) {
            $result[] = array(
                'id'         => $ii,
                'kd_brg'     => $row['kd_brg'],
                'kd_unit'    => $row['kd_unit'],
                'nm_brg'     => $row['nm_brg'],
                'id_barang' => $row['id_barang']
            );
            $ii++;
        }
      

        // Mengembalikan hasil dalam format JSON
        echo json_encode($result);
        }

        public function get_no_dokumen6() {
            $id_barang = $this->input->post('id_barang'); // Ambil kd_brg yang dikirim dari Ajax
            $this->db->where('id_barang', $id_barang);    // Query berdasarkan kd_brg
            $result = $this->db->get('trkib_e')->row();  // Ambil satu baris data
        
            if ($result) {
                echo json_encode(['id_barang' => $result->id_barang]);  // Kirim kembali no_dokumen dalam format JSON
            } else {
                echo json_encode(['id_barang' => '']);  // Jika tidak ada data, kirim kosong
            }
        }
        //end ambilbarang 6
        //ambil barang 7
        public function ambil_barang7() {
            // Mengambil input pencarian dari POST
            $lccr = $this->input->post('gol');
            
            // Menyusun kondisi pencarian
            $where = ' WHERE 1=1 '; // Memulai kondisi dengan true untuk mempermudah penambahan kondisi berikutnya

        if ($lccr != '') {
            $where .= " AND LEFT(kd_brg, 2) = '$lccr'"; // Menambahkan kondisi jika ada input pencarian
        }

        // Menentukan unit berdasarkan otorisasi pengguna
        $oto = $this->session->userdata('oto');
        $kd_unit = $this->session->userdata('unit_skpd');

        if ($oto != '01') {
            $where .= " AND kd_unit = '$kd_unit'"; // Menambahkan filter unit jika otorisasi bukan '01'
        }

        // Query untuk mengambil data barang
        $sql = "SELECT nm_brg, kd_brg, kd_unit, id_barang 
                FROM trkib_e
                where kd_brg=''
                ORDER BY kd_brg;";

        $query = $this->db->query($sql);
        $result = array();
        $ii = 0;

        // Mengolah hasil query
        foreach ($query->result_array() as $row) {
            $result[] = array(
                'id'         => $ii,
                'kd_brg'     => $row['kd_brg'],
                'kd_unit'    => $row['kd_unit'],
                'nm_brg'     => $row['nm_brg'],
                'id_barang' => $row['id_barang']
            );
            $ii++;
        }
      

        // Mengembalikan hasil dalam format JSON
        echo json_encode($result);
        }

        public function get_no_dokumen7() {
            $id_barang = $this->input->post('id_barang'); // Ambil kd_brg yang dikirim dari Ajax
            $this->db->where('id_barang', $id_barang);    // Query berdasarkan kd_brg
            $result = $this->db->get('trkib_e')->row();  // Ambil satu baris data
        
            if ($result) {
                echo json_encode(['id_barang' => $result->id_barang]);  // Kirim kembali no_dokumen dalam format JSON
            } else {
                echo json_encode(['id_barang' => '']);  // Jika tidak ada data, kirim kosong
            }
        }
        //end ambilbarang 7
        //ambil barang 8
        public function ambil_barang8() {
            // Mengambil input pencarian dari POST
            $lccr = $this->input->post('gol');
            
            // Menyusun kondisi pencarian
            $where = ' WHERE 1=1 '; // Memulai kondisi dengan true untuk mempermudah penambahan kondisi berikutnya

        if ($lccr != '') {
            $where .= " AND LEFT(kd_brg, 2) = '$lccr'"; // Menambahkan kondisi jika ada input pencarian
        }

        // Menentukan unit berdasarkan otorisasi pengguna
        $oto = $this->session->userdata('oto');
        $kd_unit = $this->session->userdata('unit_skpd');

        if ($oto != '01') {
            $where .= " AND kd_unit = '$kd_unit'"; // Menambahkan filter unit jika otorisasi bukan '01'
        }

        // Query untuk mengambil data barang
        $sql = "SELECT nm_brg, kd_brg, kd_unit, id_barang 
                FROM trkib_e
                where kd_brg=''
                ORDER BY kd_brg;";

        $query = $this->db->query($sql);
        $result = array();
        $ii = 0;

        // Mengolah hasil query
        foreach ($query->result_array() as $row) {
            $result[] = array(
                'id'         => $ii,
                'kd_brg'     => $row['kd_brg'],
                'kd_unit'    => $row['kd_unit'],
                'nm_brg'     => $row['nm_brg'],
                'id_barang' => $row['id_barang']
            );
            $ii++;
        }
      

        // Mengembalikan hasil dalam format JSON
        echo json_encode($result);
        }

        public function get_no_dokumen8() {
            $id_barang = $this->input->post('id_barang'); // Ambil kd_brg yang dikirim dari Ajax
            $this->db->where('id_barang', $id_barang);    // Query berdasarkan kd_brg
            $result = $this->db->get('trkib_e')->row();  // Ambil satu baris data
        
            if ($result) {
                echo json_encode(['id_barang' => $result->id_barang]);  // Kirim kembali no_dokumen dalam format JSON
            } else {
                echo json_encode(['id_barang' => '']);  // Jika tidak ada data, kirim kosong
            }
        }
        //end ambilbarang 7
        //ambil barang 8
        public function ambil_barang9() {
            // Mengambil input pencarian dari POST
            $lccr = $this->input->post('gol');
            
            // Menyusun kondisi pencarian
            $where = ' WHERE 1=1 '; // Memulai kondisi dengan true untuk mempermudah penambahan kondisi berikutnya

        if ($lccr != '') {
            $where .= " AND LEFT(kd_brg, 2) = '$lccr'"; // Menambahkan kondisi jika ada input pencarian
        }

        // Menentukan unit berdasarkan otorisasi pengguna
        $oto = $this->session->userdata('oto');
        $kd_unit = $this->session->userdata('unit_skpd');

        if ($oto != '01') {
            $where .= " AND kd_unit = '$kd_unit'"; // Menambahkan filter unit jika otorisasi bukan '01'
        }

        // Query untuk mengambil data barang
        $sql = "SELECT nm_brg, kd_brg, kd_unit, id_barang 
                FROM trkib_e
                where kd_brg=''
                ORDER BY kd_brg;";

        $query = $this->db->query($sql);
        $result = array();
        $ii = 0;

        // Mengolah hasil query
        foreach ($query->result_array() as $row) {
            $result[] = array(
                'id'         => $ii,
                'kd_brg'     => $row['kd_brg'],
                'kd_unit'    => $row['kd_unit'],
                'nm_brg'     => $row['nm_brg'],
                'id_barang' => $row['id_barang']
            );
            $ii++;
        }
      

        // Mengembalikan hasil dalam format JSON
        echo json_encode($result);
        }

        public function get_no_dokumen9() {
            $id_barang = $this->input->post('id_barang'); // Ambil kd_brg yang dikirim dari Ajax
            $this->db->where('id_barang', $id_barang);    // Query berdasarkan kd_brg
            $result = $this->db->get('trkib_e')->row();  // Ambil satu baris data
        
            if ($result) {
                echo json_encode(['id_barang' => $result->id_barang]);  // Kirim kembali no_dokumen dalam format JSON
            } else {
                echo json_encode(['id_barang' => '']);  // Jika tidak ada data, kirim kosong
            }
        }
        //end ambilbarang 8
        //ambil barang 9
        public function ambil_barang10() {
            // Mengambil input pencarian dari POST
            $lccr = $this->input->post('gol');
            
            // Menyusun kondisi pencarian
            $where = ' WHERE 1=1 '; // Memulai kondisi dengan true untuk mempermudah penambahan kondisi berikutnya

        if ($lccr != '') {
            $where .= " AND LEFT(kd_brg, 2) = '$lccr'"; // Menambahkan kondisi jika ada input pencarian
        }

        // Menentukan unit berdasarkan otorisasi pengguna
        $oto = $this->session->userdata('oto');
        $kd_unit = $this->session->userdata('unit_skpd');

        if ($oto != '01') {
            $where .= " AND kd_unit = '$kd_unit'"; // Menambahkan filter unit jika otorisasi bukan '01'
        }

        // Query untuk mengambil data barang
        $sql = "SELECT nm_brg, kd_brg, kd_unit, id_barang 
                FROM trkib_e
                where kd_brg=''
                ORDER BY kd_brg;";

        $query = $this->db->query($sql);
        $result = array();
        $ii = 0;

        // Mengolah hasil query
        foreach ($query->result_array() as $row) {
            $result[] = array(
                'id'         => $ii,
                'kd_brg'     => $row['kd_brg'],
                'kd_unit'    => $row['kd_unit'],
                'nm_brg'     => $row['nm_brg'],
                'id_barang' => $row['id_barang']
            );
            $ii++;
        }
      

        // Mengembalikan hasil dalam format JSON
        echo json_encode($result);
        }

        public function get_no_dokumen10() {
            $id_barang = $this->input->post('id_barang'); // Ambil kd_brg yang dikirim dari Ajax
            $this->db->where('id_barang', $id_barang);    // Query berdasarkan kd_brg
            $result = $this->db->get('trkib_e')->row();  // Ambil satu baris data
        
            if ($result) {
                echo json_encode(['id_barang' => $result->id_barang]);  // Kirim kembali no_dokumen dalam format JSON
            } else {
                echo json_encode(['id_barang' => '']);  // Jika tidak ada data, kirim kosong
            }
        }
        //end ambilbarang 9
        //ambil barang 10
         
// BATAS FUNCTION BARU ALDI
//----------PENERIMAAN 
		 function ambil_penerimaan_barang() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $skpd = $this->input->post('skpd');
        $lccr = $this->input->post('gol');
        $sql = "SELECT kd_brg,nm_brg,kd_kegiatan,jumlah,harga,total,keterangan FROM trd_isianbrg where kd_uskpd='$skpd' and left(kd_brg,2)='$lccr' order by kd_brg";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' 			=> $ii,        
                        //'no_dokumen' 	=> $resulte['no_dokumen'],
                        'kd_brg' 		=> $resulte['kd_brg'],  
                        'nm_brg' 		=> $resulte['nm_brg'], 
                        'kd_kegiatan' 	=> $resulte['kd_kegiatan'], 
                        'jumlah' 		=> $resulte['jumlah'], 
                        'harga' 		=> $resulte['harga'], 
                        'total' 		=> $resulte['total'],   
                        'keterangan' 	=> $resulte['keterangan']
                       
                        );
                        $ii++;
        }   
        echo json_encode($result);
        } 
	}
//------------------------//	
//----------KELUAR BARANG--------// 
	 function ambil_keluar_barang() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $unit = $this->input->post('unit');
        $dok = $this->input->post('dok');
        $sql = "SELECT b.* FROM trh_terimabrg a LEFT JOIN trd_terimabrg b ON a.`kd_unit`=b.`kd_unit` AND a.`kd_uskpd`=a.`kd_uskpd`
				WHERE a.`no_dokumen`='$dok' AND b.`kd_unit`='$unit'";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' 		=> $ii,    
                        'no_bap' 	=> $resulte['no_bap'],
						'no_dokumen'=> $resulte['no_dokumen'],
						'kd_brg' 	=> $resulte['kd_brg'],
						'kd_unit' 	=> $resulte['kd_unit'],
						'kd_uskpd' 	=> $resulte['kd_uskpd'],
						'nm_brg' 	=> $resulte['nm_brg'],
						'merek' 	=> $resulte['merek'],
						'tahun' 	=> $resulte['tahun'],
						'jumlah' 	=> $resulte['jumlah'],
						'harga' 	=> $resulte['harga'],
						'total' 	=> $resulte['total'],
						'cad' 		=> $resulte['cad'],
						'ket' 		=> $resulte['ket']
                        );
                        $ii++;
        }   
        echo json_encode($result);
        } 
	}
	
//------------------------//	
	
    function ambil_gol() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT golongan, nm_golongan FROM mgolongan where upper(golongan) like upper('%$lccr%') or upper(nm_golongan) like upper('%$lccr%') order by golongan ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'golongan' => $resulte['golongan'],  
                        'nm_golongan' => $resulte['nm_golongan'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}

    function ambil_gol_52() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('q');
        $sql = "SELECT golongan, nm_golongan FROM mgolongan where golongan in ('03','04','05')  order by golongan ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'golongan' => $resulte['golongan'],  
                        'nm_golongan' => $resulte['nm_golongan'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }
  
    function ambil_bidang() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('gol');
        $sql = "SELECT bidang,nm_bidang FROM mbidang where golongan='$lccr' order by bidang";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'bidang' => $resulte['bidang'],  
                        'nm_bidang' => $resulte['nm_bidang']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}

    function ambil_golongan_dh() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('gol');
        $sql = "SELECT golongan,nm_golongan FROM mgolongan where golongan in ('03','04') order by golongan";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'gol' => $resulte['golongan'],  
                        'nm_golongan' => $resulte['nm_golongan']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }
    
    function ambil_kelompok() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('bidang');
        $sql = "SELECT kelompok,nm_kelompok FROM mkelompok where bidang='$lccr' order by kelompok";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kelompok' => $resulte['kelompok'],  
                        'nm_kelompok' => $resulte['nm_kelompok']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
     function ambil_kelompok1() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('kelompok');
        $sql = "SELECT kd_kelompok,nm_kelompok FROM mkelompok1 WHERE kelompok='$lccr' order by kd_kelompok";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_kelompok' => $resulte['kd_kelompok'],  
                        'nm_kelompok' => $resulte['nm_kelompok']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}

    function ambil_keg(){
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{

        $skpd=$this->input->post('kdskpd');
        $unit=$this->input->post('unit');    

        $where='';
        if($unit==''){
            $where="skpd='$skpd'";
        }else{
            $where="skpd='$skpd' AND unit='$unit'";
        }

        $lccr = $this->input->post('kelompok');
        $sql = "SELECT DISTINCT(kodegiat)AS giat,namagiat FROM trh_masuk_bhp WHERE $where";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'giat' => $resulte['giat'],  
                        'namagiat' => $resulte['namagiat']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    }

    function ambil_keg_kel(){
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{

        $skpd=$this->input->post('kdskpd');
        $unit=$this->input->post('unit');    

        $where='';
        if($unit==''){
            $where="skpd='$skpd'";
        }else{
            $where="skpd='$skpd' AND unit='$unit'";
        }

        $lccr = $this->input->post('kelompok');
        $sql = "SELECT DISTINCT(kodegiat)AS giat,nm_kegiatan FROM trh_keluar_bhp WHERE $where";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'giat' => $resulte['giat'],  
                        'namagiat' => $resulte['nm_kegiatan']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    }
    
    function load_brg() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('subkel');
        $sql = "SELECT * FROM mbarang WHERE kd_kelompok='$lccr' ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_brg' => $resulte['kd_brg'],  
                        'nm_brg' => $resulte['nm_brg']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
        
    
	
	  function mmetode() {
       // $lccr = $this->input->post('q');
        $sql = "SELECT * FROM mmetode order by kode ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,
                        'kode' => $resulte['kode'],        
                        'metode' => $resulte['metode']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
    function ambil_kel() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT kelompok, nm_kelompok FROM mkelompok where upper(kelompok) like upper('%$lccr%') or upper(nm_kelompok) like upper('%$lccr%') ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kelompok' => $resulte['kelompok'],  
                        'nm_kelompok' => $resulte['nm_kelompok'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
    function ambil_pangkat() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT kd_pangkat, nm_pangkat FROM mpangkat where upper(kd_pangkat) like upper('%$lccr%') or upper(nm_pangkat) like upper('%$lccr%') order by kd_pangkat";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_pangkat' => $resulte['kd_pangkat'],  
                        'nm_pangkat' => $resulte['nm_pangkat'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
    function ambil_key() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT nm_kunci,singkatan FROM kunci_ttd where upper(nm_kunci) like upper('%$lccr%')";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'nm_kunci'  => $resulte['nm_kunci'],
                        'singkatan' => $resulte['singkatan']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
	function no_urutx() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$lccr = $this->input->post('q');
        $sql = "SELECT max(no_urut)+1 as no_urut FROM trkib_a";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'no_urut' => $resulte['no_urut']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
	function master_max() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $table = $this->input->post('table');
        $kolom = $this->input->post('kolom');
        $sql = "SELECT IFNULL(MAX($kolom),0)+1 AS kode FROM $table";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        //'id' => $ii,        
                        'no_urut' => $resulte['kode']
                        );
                        //$ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}

    function max_satuan() {
        
        $table = $this->input->post('table');
        $kolom = $this->input->post('kolom');
        $sql = "SELECT IF(MAX($kolom)IS NULL,LPAD('1',2,0),LPAD(MAX($kolom)+1,2,0))AS kode FROM $table";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        //'id' => $ii,        
                        'no_urut' => $resulte['kode']
                        );
                        //$ii++;
        }
           
        echo json_encode($result);
        
           
    }


    function ambil_bulan(){
        $lccr = $this->input->post('q');
        if($lccr!=''){
            $where="where (upper(n_bulan) like upper('%$lccr%') or upper(nama_bulan) like upper('%$lccr%'))";
        }else{
            $where="";
        }
        $sql="SELECT * FROM bulan $where";
        $query1 = $this->db->query($sql); 
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'n_bulan'   => $resulte['n_bulan'], 
                        'bulan' => $resulte['nama_bulan']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    }

    

    function ambil_file_pdf(){
         $filePath = 'files/a/(Perolehan-Penerimaan) FORMAT IV.A.1.1.1.pdf';
        //Membuat kondisi jika file tidak ada
        if (!file_exists($filePath)) {
        echo "The file $filePath does not exist";
        die();
        }
        //nama file untuk tampilan
        $filename="(Perolehan-Penerimaan) FORMAT IV.A.1.1.1.pdf";
        header('Content-type:application/pdf');
        header('Content-disposition: inline; filename="'.$filename.'"');
        header('content-Transfer-Encoding:binary');
        header('Accept-Ranges:bytes');
        //membaca dan menampilkan file
        readfile($filePath);
    }    

    function ambil_ubidskpdh() {
              
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{

        $unit_skpd       = $this->session->userdata('unit_skpd');
        $oto        = $this->session->userdata('otori');
        $skpd       = $this->input->post('skpd');
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where  kd_skpd='$skpd' ";
        }else{
            $where1 = "where kd_skpd ='$skpd' and kd_lokasi='$unit_skpd' ";
        } 
         
        
        
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 ="and upper(kd_skpd) like upper('%$lccr%') or upper(nm_lokasi) like upper('%$lccr%') ";
        }
        
        $sql = "SELECT kd_skpd,kd_lokasi, nm_lokasi FROM mlokasi $where1 $where2 ORDER BY kd_skpd,kd_lokasi";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_skpd'   => $resulte['kd_skpd'], 
                        'kd_uskpd' => $resulte['kd_lokasi'],  
                        'nm_uskpd'   => $resulte['nm_lokasi']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }
	
	function ambil_ubidskpd2() {
              
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
      	 
        $skpd 		= $this->session->userdata('skpd');
        $oto  		= $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where  kd_skpd like '%' ";
        }else{
            $where1 = "where kd_skpd ='$skpd' ";
        }        
          
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 ="and upper(kd_skpd) like upper('%$lccr%') or upper(nm_lokasi) like upper('%$lccr%') ";
        }
        
        $sql = "SELECT kd_skpd,kd_lokasi, nm_lokasi FROM mlokasi $where1 $where2 
        group by kd_skpd ORDER BY kd_skpd,kd_lokasi";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_skpd' 	=> $resulte['kd_skpd'], 
                        'kd_lokasi' => $resulte['kd_lokasi'],  
                        'nm_skpd' 	=> $resulte['nm_lokasi']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}

    
      function ambil_msskpd2() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		
		$skpd 		= $this->session->userdata('skpd');
        $oto  		= $this->session->userdata('otori');
        $lccr = $this->input->post('q');
        $where1 = ''; 
        $where2 = '';
        // if ($oto =='01'){
        //     $where3 ='';
        // }else{
            $where3 ="WHERE a.kd_skpd='$skpd'";
        // }
       
        // if($oto == '01' && $skpd=='1.20.05.01'){ 
        //     $where1 = "WHERE a.kd_skpd like '%' ";
        //     if($lccr!=''){
        //         $where2="and upper(a.kd_skpd) like upper('%$lccr%') or UPPER(a.nm_skpd) LIKE UPPER('%$lccr%') or upper(b.nm_lokasi) like upper('%$lccr%')";
        //     }else{
        //         $where2="";
        //     }
        // }else if($oto == '01' && $skpd<>'1.20.05.01'){
        //     $where1 = "WHERE a.kd_skpd ='$skpd' and upper(b.nm_lokasi) like upper('%$lccr%')";
        // }else if($oto=='02' && $skpd<>'1.20.05.01'){
        //     $where1 = "WHERE a.kd_skpd ='$skpd' and upper(b.nm_lokasi) like upper('%$lccr%')";
        // }else if($oto=='02' && $skpd=='1.20.05.01'){
        //     $where1 = "WHERE a.kd_skpd like '%' ";
        //         if($lccr!=''){
        //         $where2="and upper(a.kd_skpd) like upper('%$lccr%') or UPPER(a.nm_skpd) LIKE UPPER('%$lccr%') or upper(b.nm_lokasi) like upper('%$lccr%')";
        //     }else{
        //         $where2="";
        //     }
        // }
        if($oto == '01' && $skpd=='1.20.05.01'){ 
            $where1 = "WHERE a.kd_skpd like '%' ";
            if($lccr!=''){
                $where2="and upper(a.kd_skpd) like upper('%$lccr%') or UPPER(a.nm_skpd) LIKE UPPER('%$lccr%') or upper(b.nm_lokasi) like upper('%$lccr%')";
            }else{
                $where2="";
            }
        }else if($oto == '01' && $skpd<>'1.20.05.01'){
            $where1 = "WHERE a.kd_skpd ='$skpd' and upper(b.nm_lokasi) like upper('%$lccr%')";
        }else if($oto=='02' && $skpd<>'1.20.05.01'){
            $where1 = "WHERE a.kd_skpd ='$skpd' and upper(b.nm_lokasi) like upper('%$lccr%')";
        }else if($oto=='02' && $skpd=='1.20.05.01'){
            $where1 = "WHERE a.kd_skpd like '%' ";
                if($lccr!=''){
                $where2="and upper(a.kd_skpd) like upper('%$lccr%') or UPPER(a.nm_skpd) LIKE UPPER('%$lccr%') or upper(b.nm_lokasi) like upper('%$lccr%')";
            }else{
                $where2="";
            }
        }


		
  //       $sql 	= "SELECT a.kd_skpd,a.nm_skpd,b.kd_lokasi,b.nm_lokasi FROM ms_skpd a inner 
		// join mlokasi b on a.kd_skpd=b.kd_skpd $where1 ORDER BY a.kd_skpd,b.kd_lokasi";//GROUP BY a.kd_skpd order by nm_skpd
        $sql    = "SELECT a.kd_skpd,a.nm_skpd,b.kd_lokasi,b.nm_lokasi FROM ms_skpd a inner 
        join mlokasi b on a.kd_skpd=b.kd_skpd $where3 ORDER BY a.kd_skpd,b.kd_lokasi";//GROUP BY a.kd_skpd order by nm_skpd
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' 		=> $ii,        
                        'kd_skpd' 	=> $resulte['kd_skpd'],  
                        'kd_lokasi' => $resulte['kd_lokasi'],  
                        'nm_skpd' 	=> $resulte['nm_skpd'],    
                        'nm_lokasi' => $resulte['nm_lokasi'] 
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
    	   
	}

    // function ambil_msskpd_SENDIRI() {
    //     if($this->auth->is_logged_in() == false){
    //         redirect(site_url().'/welcome/login');
    //     }else{
        
    //     $skpd       = $this->session->userdata('skpd');
    //     $oto        = $this->session->userdata('otori');
    //     $lccr = $this->input->post('q');
    //     $where1 = ''; 
    //     $where2 = '';
       
    //     // if($oto == '01' && $skpd=='1.20.05.01'){ 
    //     //     $where1 = "WHERE a.kd_skpd like '%' ";
    //     //     if($lccr!=''){
    //     //         $where2="and upper(a.kd_skpd) like upper('%$lccr%') or UPPER(a.nm_skpd) LIKE UPPER('%$lccr%') or upper(b.nm_lokasi) like upper('%$lccr%')";
    //     //     }else{
    //     //         $where2="";
    //     //     }
    //     // }else if($oto == '01' && $skpd<>'1.20.05.01'){
    //     //     $where1 = "WHERE a.kd_skpd ='$skpd' and upper(b.nm_lokasi) like upper('%$lccr%')";
    //     // }else if($oto=='02' && $skpd<>'1.20.05.01'){
    //     //     $where1 = "WHERE a.kd_skpd ='$skpd' and upper(b.nm_lokasi) like upper('%$lccr%')";
    //     // }else if($oto=='02' && $skpd=='1.20.05.01'){
    //     //     $where1 = "WHERE a.kd_skpd like '%' ";
    //     //         if($lccr!=''){
    //     //         $where2="and upper(a.kd_skpd) like upper('%$lccr%') or UPPER(a.nm_skpd) LIKE UPPER('%$lccr%') or upper(b.nm_lokasi) like upper('%$lccr%')";
    //     //     }else{
    //     //         $where2="";
    //     //     }
    //     // }
    //     if($oto == '01' && $skpd=='1.20.05.01'){ 
    //         $where1 = "WHERE a.kd_skpd like '%' ";
    //         if($lccr!=''){
    //             $where2="and upper(a.kd_skpd) like upper('%$lccr%') or UPPER(a.nm_skpd) LIKE UPPER('%$lccr%') or upper(b.nm_lokasi) like upper('%$lccr%')";
    //         }else{
    //             $where2="";
    //         }
    //     }else if($oto == '01' && $skpd<>'1.20.05.01'){
    //         $where1 = "WHERE a.kd_skpd ='$skpd' and upper(b.nm_lokasi) like upper('%$lccr%')";
    //     }else if($oto=='02' && $skpd<>'1.20.05.01'){
    //         $where1 = "WHERE a.kd_skpd ='$skpd' and upper(b.nm_lokasi) like upper('%$lccr%')";
    //     }else if($oto=='02' && $skpd=='1.20.05.01'){
    //         $where1 = "WHERE a.kd_skpd like '%' ";
    //             if($lccr!=''){
    //             $where2="and upper(a.kd_skpd) like upper('%$lccr%') or UPPER(a.nm_skpd) LIKE UPPER('%$lccr%') or upper(b.nm_lokasi) like upper('%$lccr%')";
    //         }else{
    //             $where2="";
    //         }
    //     }


        
    //     $sql     = "SELECT a.kd_skpd,a.nm_skpd,b.kd_lokasi,b.nm_lokasi FROM ms_skpd a inner 
    //     join mlokasi b on a.kd_skpd=b.kd_skpd $where1 ORDER BY a.kd_skpd,b.kd_lokasi";//GROUP BY a.kd_skpd order by nm_skpd
        
    //     $query1 = $this->db->query($sql);  
    //     $result = array();
    //     $ii = 0;
    //     foreach($query1->result_array() as $resulte)
    //     { 
           
    //         $result[] = array(
    //                     'id'        => $ii,        
    //                     'kd_skpd'   => $resulte['kd_skpd'],  
    //                     'kd_lokasi' => $resulte['kd_lokasi'],  
    //                     'nm_skpd'   => $resulte['nm_skpd'],    
    //                     'nm_lokasi' => $resulte['nm_lokasi'] 
                       
    //                     );
    //                     $ii++;
    //     }
    //     echo json_encode($result);
    //     }
           
    // }

    //18 juli
    function load_sdana() {
    // $skpd     = $this->session->userdata('skpd');
    $skpd =$this->input->post('kd_skpd');
    $lccr=$this->input->post('q');
    $sql = "SELECT sumber_ubah AS nm_sdana,kd_skpd FROM trdrka WHERE kd_skpd='$skpd' and left(kd_rek5,3)='523' GROUP BY sumber_ubah";
    $query1 = $this->db->query($sql);  
    $result = array();
    $ii = 0;
    foreach($query1->result_array() as $resulte)
    { 

        $result[] = array(
            'id' => $ii,        
            'nm_sdana' => $resulte['nm_sdana'],
            'kd_skpd' => $resulte['kd_skpd']
            );
        $ii++;
    }

    echo json_encode($result);

}

    function kegi() {
    $spd=$this->input->post('spd');
    $lccr   =$this->input->post('q');
    // $skpd   =$this->session->userdata('skpd');
    $skpd =$this->input->post('kd_skpd');
    $sumber =$this->input->post('sumber');
    

$sql="SELECT kd_kegiatan,nm_kegiatan,SUM(nilai_ubah)AS nilai ,sumber_ubah,(SELECT dana FROM ms_dana WHERE nm_sdana=sumber_ubah) AS dana FROM trdrka 
WHERE kd_skpd='$skpd' AND sumber_ubah<>'' AND LEFT(KD_REK5,3)='523' and sumber_ubah='$sumber' GROUP BY kd_kegiatan ORDER BY kd_kegiatan";
$query1 = $this->db->query($sql);  
$result = array();
$ii = 0;
foreach($query1->result_array() as $resulte)
{ 
    $result[] = array(
        'id' => $ii,        
        'kd_kegiatan' => $resulte['kd_kegiatan'],  
        'nm_kegiatan' => $resulte['nm_kegiatan'],  
        'dana' => $resulte['dana'],  
        'nilai' => number_format($resulte['nilai'],"2",".",",")
        );
    $ii++;
}

echo json_encode($result);
// $query1->free_result();    
}

	
	function ambil_msskpd() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$skpd 		= $this->session->userdata('skpd');
        $oto  		= $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where a.kd_skpd like '%' ";
        }else{
            $where1 = "where a.kd_skpd ='$skpd' ";
        }        
          
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 ="and UPPER(a.nm_skpd) LIKE UPPER('%$lccr%') or UPPER(a.kd_skpd) LIKE UPPER('%$lccr%') ";
        }
		
        $sql 	= "SELECT a.kd_skpd,a.nm_skpd FROM ms_skpd a $where1 $where2 order by kd_skpd";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_skpd' => $resulte['kd_skpd'],    
                        'nm_skpd' => $resulte['nm_skpd'],  
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
    	   
	}

    function cek_kd_bidang(){
        
        $kd_bid=$this->input->post('kd_bid');
        $kd_skpd=$this->input->post('kd_skpd');

        $query=$this->db->query("SELECT COUNT(*) AS jumlah FROM mbidskpd WHERE kd_bidskpd='$kd_bid' AND kd_skpd='$kd_skpd'");
        $result=array();
        foreach ($query->result_array() as $resulte) {
            $result[]= array('jumlah' =>$resulte['jumlah']);
        }
        echo json_encode($result);
    }

    function cek_kd_unit(){
        
        $kd_bid=$this->input->post('kd_bid');
        $kd_skpd=$this->input->post('kd_skpd');
        $kd_unit=$this->input->post('kd_unit');
        $query=$this->db->query("SELECT COUNT(*) AS jumlah FROM unit_skpd WHERE kd_uskpd='$kd_unit' AND kd_skpd='$kd_skpd' AND kd_bidskpd='$kd_bid'");
        $result=array();
        foreach ($query->result_array() as $resulte) {
            $result[]= array('jumlah' =>$resulte['jumlah']);
        }
        echo json_encode($result);
    }

    function cek_kd_unit_kerja(){
        
        $kd_bid=$this->input->post('bidang');
        $kd_unit=$this->input->post('kdunit');
        $skpd=$this->input->post('kd_skpd');
        $query=$this->db->query("SELECT COUNT(*) AS jumlah FROM unit_kerja WHERE kd_uker='$kd_unit' AND kd_uskpd='$kd_bid' and kd_skpd='$skpd'");
        $result=array();
        foreach ($query->result_array() as $resulte) {
            $result[]= array('jumlah' =>$resulte['jumlah']);
        }
        echo json_encode($result);
    }

    function cek_mlokasi(){
        
        $skpd=$this->input->post('skpd');
        $kduker=$this->input->post('kduker');
        $kdlokasi=$this->input->post('kdlokasi');
        $query=$this->db->query("SELECT COUNT(*) AS jumlah FROM mlokasi WHERE kd_lokasi='$kdlokasi' AND kd_skpd='$skpd' and kd_uker='$kduker'");
        $result=array();
        foreach ($query->result_array() as $resulte) {
            $result[]= array('jumlah' =>$resulte['jumlah']);
        }
        echo json_encode($result);
    }

	 
    function ambil_mrekap() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT gol,nama FROM mrekap WHERE UPPER(gol) LIKE UPPER('%$lccr%') OR UPPER(nama) LIKE UPPER('%$lccr%') and gol is not null order by gol";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'gol' => $resulte['gol'],  
                        'nama' => $resulte['nama'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
		 
    function ambil_mrekap_penyusutan() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT gol,nama FROM mrekap 
		WHERE gol is not null 
		and gol<>'01' and gol<>'06' order by gol";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'gol' => $resulte['gol'],  
                        'nama' => $resulte['nama'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
	function ambil_skpdsek() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$skpd	= $this->session->userdata('skpd');
        $lccr 	= $this->input->post('q');
        $sql 	= "SELECT kd_lokasi,nm_lokasi FROM mlokasi WHERE UPPER(kd_lokasi) LIKE UPPER('%$lccr%') OR UPPER(nm_lokasi) LIKE UPPER('%$lccr%') and kd_skpd='$skpd' order by kd_skpd,nm_skpd";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_skpd' => $resulte['kd_lokasi'],  
                        'nm_skpd' => $resulte['nm_lokasi'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
    function ambil_skpd() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('q');
        $sql = "SELECT kd_lokasi,nm_lokasi,kd_skpd FROM mlokasi WHERE UPPER(kd_lokasi) LIKE UPPER('%$lccr%') OR UPPER(nm_lokasi) LIKE UPPER('%$lccr%')";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_skpd' => $resulte['kd_lokasi'],  
                        'nm_skpd' => $resulte['nm_lokasi'],  
                        'kd_skpd'     => $resulte['kd_skpd'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }
    
    function ambil_distrik() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('q');
        $sql = "SELECT * FROM m_alamat WHERE UPPER(kd_distrik) LIKE UPPER('%$lccr%') OR UPPER(nm_distrik) LIKE UPPER('%$lccr%')";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_distrik' => $resulte['kd_distrik'],  
                        'nm_distrik' => $resulte['nm_distrik'], 
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }

    function ambil_skpd_dh() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $oto        = $this->session->userdata('otori');
        $skpd       = $this->session->userdata('skpd');
        $where1 = '';
        $where2 = '';       
        /*if($oto == '01'){ 
            $where1 = "where kd_skpd like '%' ";
        }else{
            $where1 = "where kd_skpd ='$skpd' ";
        } */
        $lccr = $this->input->post('q');
        if($oto == '01' && $skpd=='1.20.05.01'){ 
            $where1 = "WHERE kd_skpd like '%' ";
            if($lccr!=''){
                $where2="AND UPPER(kd_skpd) LIKE UPPER('%$lccr%') OR UPPER(nm_skpd) LIKE UPPER('%$lccr%')";
            }else{
                $where2="";
            }
        }else if($oto == '01' && $skpd<>'1.20.05.01'){
            $where1 = "WHERE kd_skpd ='$skpd' ";
        }else if($oto=='02' && $skpd<>'1.20.05.01'){
            $where1 = "WHERE kd_skpd ='$skpd' ";
        }else if($oto=='02' && $skpd=='1.20.05.01'){
            $where1 = "WHERE kd_skpd like '%' ";
                if($lccr!=''){
                $where2="AND UPPER(kd_skpd) LIKE UPPER('%$lccr%') OR UPPER(nm_skpd) LIKE UPPER('%$lccr%')";
            }else{
                $where2="";
            }
        }

        
        
        $sql = "SELECT kd_skpd,nm_skpd FROM ms_skpd $where1 $where2  ORDER BY kd_skpd";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_skpd' => $resulte['kd_skpd'],  
                        'nm_skpd' => $resulte['nm_skpd']  
                        
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }

    function ambil_skpd2() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('q');
        $sql = "SELECT * FROM unit_skpd WHERE UPPER(kd_uskpd) LIKE UPPER('%$lccr%') OR UPPER(nm_uskpd) LIKE UPPER('%$lccr%')";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_uskpd' => $resulte['kd_uskpd'],  
                        'nm_uskpd' => $resulte['nm_uskpd'],  
                        'kd_skpd'    => $resulte['kd_skpd'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }
    
    function ambil_bidskpd() {
        /*if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{*/
            $skpd=$this->input->post('skpd');
        $lccr = $this->input->post('q');
        $cari='';
        if($lccr!=''){
            $cari="AND upper(kd_bidskpd) like upper('%$lccr%') or upper(nm_bidskpd) like upper('%$lccr%')";
        }else{
            $cari="";
        }
        $sql = "SELECT kd_bidskpd, nm_bidskpd,kd_skpd FROM mbidskpd where kd_skpd='$skpd' $cari";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_bidskpd' => $resulte['kd_bidskpd'],  
                        'nm_bidskpd' => $resulte['nm_bidskpd'],  
                        'kd_skpd'    => $resulte['kd_skpd']
                        );
                        $ii++;
        }
        echo json_encode($result);
        //}
	}
	
     function ambil_ubidskpd() {
              
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$tabel 	= $this->input->post('tabel');
        $skpd 	= $this->session->userdata('skpd');
        $oto  		= $this->session->userdata('otori');
 
        $where1 = '';       
        

        if($oto == '01' && $skpd=='1.20.05.01'){ 
            $where1 = " a.kd_skpd like '%' ";
        }else if($oto=='01' && $skpd<>'1.20.05.01'){
            $where1 = " a.kd_skpd ='$skpd' ";
        }else if($oto=='02' && $skpd<>'1.20.05.01'){
            $where1 = " a.kd_skpd ='$skpd' ";
        }else if($oto=='02' && $skpd=='1.20.05.01'){
            $where1 = " a.kd_skpd like '%' ";
        }         
          
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 ="upper(a.kd_lokasi) like upper('%$lccr%') or upper(a.nm_lokasi) like upper('%$lccr%') ";
        }
        
        $sql = "SELECT a.kd_lokasi, a.nm_lokasi,a.kd_skpd from mlokasi a where $where1 $where2 order by nm_lokasi";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_uskpd' => $resulte['kd_lokasi'],  
                        'nm_uskpd' => $resulte['nm_lokasi'],  
						'kd_skpd'  => $resulte['kd_skpd'], 
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
	 function ambil_uskpd() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $skpd = $this->input->post('skpd');
        $uskpd = $this->input->post('kduskpd');
        $oto  = $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where kd_lokasi='$uskpd' ";
        }elseif($skpd=='1.02.01.00' || $skpd=='1.01.01.00'){
            $where1 = "where kd_skpd='$skpd' ";
		}
		else{
            $where1 = "where kd_lokasi ='$uskpd' ";
        }
        $sql = "SELECT kd_lokasi, nm_lokasi FROM mlokasi $where1 
		and upper(nm_lokasi) like upper('%$lccr%') order by nm_lokasi";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_uskpd' => $resulte['kd_lokasi'],  
                        'nm_uskpd' => $resulte['nm_lokasi'],  
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
	}

     function ambil_uskpd_dh() {
       if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('q');
        $skpd = $this->input->post('skpd');
        /*$uskpd = $this->input->post('kduskpd');
        $oto  = $this->session->userdata('otori');*/
 
        /*$where1 = '';       
        if($oto == '01'){ 
            $where1 = "where kd_lokasi='$uskpd' ";
        }elseif($skpd=='1.02.01.00' || $skpd=='1.01.01.00'){
            $where1 = "where kd_skpd='$skpd' ";
        }
        else{
            $where1 = "where kd_lokasi ='$uskpd' ";
        }*/
        $sql = "SELECT kd_uker,nm_uker FROM unit_kerja WHERE kd_skpd='$skpd' and upper(nm_uker) like upper('%$lccr%') order by kd_uker";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_uskpd' => $resulte['kd_uker'],  
                        'nm_uskpd' => $resulte['nm_uker'],  
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
    }

    function ambil_lokasi_dh() {
       /*if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{*/
        $lccr = $this->input->post('q');
        $sub = $this->input->post('sub');

        if($lccr!=''){
            $where="and upper(nm_lokasi) like upper('%$lccr%') or upper(kd_lokasi) like upper('%$lccr%')";
        }else{
            $where="";
        }
        
        $sql = "SELECT * FROM mlokasi WHERE kd_uker='$sub' $where order by kd_uker";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_sub' => $resulte['kd_lokasi'],  
                        'nm_sub' => $resulte['nm_lokasi'],  
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        //}
    }
	
	function max_gol_hbs() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$oto  	= $this->session->userdata('otori');
        
        $sql = "SELECT MAX(LEFT(kode,2))+1 AS kode FROM mbarang_hbs";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result [] = array(
                        'id' => $ii,        
                        'max_kode' => $resulte['kode'],   
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
	}	
	
	function max_bid_hbs() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$oto  	= $this->session->userdata('otori');
        $kode 	= $this->input->post('h');
        
        $sql = "SELECT IFNULL(MAX(RIGHT(kode,2)),0)+1 AS max_gol FROM mbarang_hbs 
		WHERE LEFT(kode,2)='$kode' AND LENGTH(kode)='4'";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result [] = array(
                        'id' => $ii,        
                        'max_kode' => $resulte['max_gol'],   
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
	}
	
	function max_kel_hbs() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$oto  	= $this->session->userdata('otori');
        $kode 	= $this->input->post('h');
        
        $sql = "SELECT IFNULL(MAX(RIGHT(kode,2)),0)+1 AS max_gol FROM mbarang_hbs 
		WHERE LEFT(kode,4)='$kode' AND LENGTH(kode)='6'";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result [] = array(
                        'id' => $ii,        
                        'max_kode' => $resulte['max_gol'],   
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
	}
	
	function max_subkel_hbs() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$oto  	= $this->session->userdata('otori');
        $kode 	= $this->input->post('h');
        
        $sql = "SELECT IFNULL(MAX(RIGHT(kode,2)),0)+1 AS max_gol FROM mbarang_hbs 
		WHERE LEFT(kode,6)='$kode' AND LENGTH(kode)='8'";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result [] = array(
                        'id' => $ii,        
                        'max_kode' => $resulte['max_gol'],   
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
	}
	
	function max_sub2_hbs() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
		$oto  	= $this->session->userdata('otori');
        $kode 	= $this->input->post('h');
        
        $sql = "SELECT IFNULL(MAX(RIGHT(kode,4)),0)+1 AS max_gol FROM mbarang_hbs 
				WHERE LEFT(kode,8)='$kode' AND LENGTH(kode)='12'";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result [] = array(
                        'id' => $ii,        
                        'kode' => $resulte['max_gol'],   
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
	}
	
	function ambil_maxkode_ruang() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr 	= $this->input->post('q');
        $skpd 	= $this->input->post('kdlokasi');
		$oto  	= $this->session->userdata('otori');
        
		$csql1='';
        if ($oto =='01'){
            $csql1 = "where kd_unit = '$lccr' and ckey='PA' and tingkat='1'";
        }else {
            $csql1 = "where kd_unit = '$lccr' and ckey='PA' and tingkat='1'";
        }
		
        $sql = "SELECT IFNULL(MAX(no_urut),0)+1 AS max_kode FROM mruang where kd_lokasi='$skpd'";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result [] = array(
                        'id' => $ii,        
                        'max_kode' => $resulte['max_kode'],   
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
	}
    
     function ambil_ruang() {
        $lccr 			= $this->input->post('q');
        $unit_skpd 		= $this->input->post('kdlokasi');
		$oto  			= $this->session->userdata('otori');
		//$unit_skpd  	= $this->session->userdata('unit_skpd');
		$csql1='';
        if ($oto =='01'){
            $csql1 = "where kd_lokasi ='$unit_skpd'";
        }else {
            $csql1 = "where kd_lokasi ='$unit_skpd'";
        }
        $sql = "SELECT * FROM mruang $csql1"; // and upper(kd_ruang) like upper('%$lccr%') or upper(nm_ruang) like upper('%$lccr%') 
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_ruang' => $resulte['kd_ruang'],  
                        'nm_ruang' => $resulte['nm_ruang'],
                        'kd_skpd'  => $resulte['kd_skpd'], 
                        'kd_unit'  => $resulte['kd_unit'],
                        'kd_lokasi'=> $resulte['kd_lokasi'],  
                        'keterangan'  => $resulte['keterangan'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}

    function ambil_ruangdh() {
        $lccr           = $this->input->post('q');
        $unit_skpd      = $this->input->post('kdlokasi');
        $oto            = $this->session->userdata('otori');
        //$unit_skpd    = $this->session->userdata('unit_skpd');
        $csql1='';
        if ($oto =='01'){
            $csql1 = "where kd_unit ='$unit_skpd'";
        }else {
            $csql1 = "where kd_unit ='$unit_skpd'";
        }
        //$sql = "SELECT * FROM mruang $csql1 "; // and upper(kd_ruang) like upper('%$lccr%') or upper(nm_ruang) like upper('%$lccr%')
        $sql = "SELECT * FROM mruang ";  
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_ruang' => $resulte['kd_ruang'],  
                        'nm_ruang' => $resulte['nm_ruang'],
                        'kd_skpd'  => $resulte['kd_skpd'], 
                        'kd_unit'  => $resulte['kd_unit'],
                        'kd_lokasi'=> $resulte['kd_lokasi'],  
                        'keterangan'  => $resulte['keterangan'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
           
    }
	
	function ambil_ruang_bidang() {
        $lccr 			= $this->input->post('q');
        $skpd 			= $this->input->post('skpd');
		$oto  			= $this->session->userdata('otori');
		$csql1='';
        if ($oto =='01'){
            $csql1 = "where kd_skpd ='$skpd'";
        }else {
            $csql1 = "where kd_skpd ='$skpd'";
        }
        $sql = "SELECT * FROM mruang $csql1"; // and upper(kd_ruang) like upper('%$lccr%') or upper(nm_ruang) like upper('%$lccr%') 
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_ruang' => $resulte['kd_ruang'],  
                        'nm_ruang' => $resulte['nm_ruang'],
                        'kd_skpd'  => $resulte['kd_skpd'], 
                        'kd_unit'  => $resulte['kd_unit'],  
                        'keterangan'  => $resulte['keterangan'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
    	   
	}
    
     function ambil_jenis() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $kode = $this->input->post('kode');
        $sql = "SELECT * FROM jenis_kib where kode LIKE '$kode%' order by kode";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],  
                        'jenis' => $resulte['jenis'],  
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
	} 
    function ambil_jenis2() {
       if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('q');
        $where='';
        if($lccr!=''){
            $where="AND UPPER(kode) LIKE UPPER('%$lccr%') OR UPPER(jenis) LIKE UPPER('%$lccr%')";
        }else{
            $where="";
        }
        $sql = " SELECT * FROM jenis_kib WHERE LEFT(kode,2) IN ('01','02','03','04','05') $where ORDER BY kode";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],  
                        'jenis' => $resulte['jenis'],  
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
    }

     function ambil_jenis_kib() {
       if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $kode = $this->input->post('kode');
        $sql = "SELECT * FROM mbarang_umur where kd_barang LIKE '$kode%' order by kd_barang";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kd_barang'],  
                        'jenis' => $resulte['nama'],   
                        'umur' => $resulte['umur']
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
	}
    
    function ambil_uker() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT kd_uker, nm_uker FROM unit_kerja where upper(kd_uker) like upper('%$lccr%') or upper(nm_uker) like upper('%$lccr%') ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_uker' => $resulte['kd_uker'],  
                        'nm_uker' => $resulte['nm_uker']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}

    function ambil_uker_dh() {
       /* if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{*/
        $lccr = $this->input->post('q');
        $skpd=$this->input->post('skpd');
        if($lccr!=''){
            $where=" and upper(kd_uker) like upper('%$lccr%') or upper(nm_uker) like upper('%$lccr%')";
        }else{
            $where="";
        }
        $sql = "SELECT kd_uker, nm_uker FROM unit_kerja where kd_skpd='$skpd' $where ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_uker' => $resulte['kd_uker'],  
                        'nm_uker' => $resulte['nm_uker']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        //}
           
    }
    
    function ambil_pa() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$lccr = $this->input->post('q');
        $oto  	= $this->session->userdata('otori');
        $lccr 	= $this->input->post('kduskpd');
        $kode 	= $this->session->userdata('kode');
        
		// $csql1='';
  //       if ($oto =='01'){
  //           $csql1 = "where skpd = '$lccr' and ckey='QQ'"; //and tingkat='1'
  //       }else {
  //           $csql1 = "where skpd = '$lccr' and ckey='QQ'"; //and tingkat='1'
  //       }
        $csql1='';
        if ($oto =='01'){
            $csql1 = "where skpd = '$lccr'"; //and tingkat='1'
        }else {
            $csql1 = "where skpd = '$lccr'"; //and tingkat='1'
        }
		        
        $sql = "SELECT nip,nama FROM ttd $csql1 ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'nama' => $resulte['nama'],
                        'nip' => $resulte['nip']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	function ambil_pa2() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$lccr = $this->input->post('q');
        $oto  	= $this->session->userdata('otori');
        $lccr 	= $this->input->post('kduskpd');
        $kode 	= $this->session->userdata('kode');
        
		$csql1='';
        if ($oto =='01'){
            $csql1 = "where kd_lokasi = '$lccr' and ckey='QQ'";
        }else {
            $csql1 = "where kd_lokasi = '$lccr' and ckey='QQ'";
        }
		        
        $sql = "SELECT nip,nama FROM ttd $csql1 ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'nama' => $resulte['nama'],
                        'nip' => $resulte['nip']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
	function ambil_pb() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$lccr = $this->input->post('q');
        $oto  = $this->session->userdata('otori');
        $lccr = $this->input->post('kduskpd');
        
		$csql1='';
        if ($oto =='01'){
            $csql1 = "where skpd = '$lccr' and ckey='BK'"; //and tingkat='1'
        }else {
            $csql1 = "where skpd = '$lccr' and ckey='BK'"; //and tingkat='1'
        }
        
        $sql = "SELECT nip,nama FROM ttd $csql1 ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'nama' => $resulte['nama'],
                        'nip' => $resulte['nip']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}	
	
	function ambil_pn() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$lccr = $this->input->post('q');
        $oto  = $this->session->userdata('otori');
        $lccr = $this->input->post('kduskpd');
        
		$csql1='';
        if ($oto =='01'){
            $csql1 = "where skpd = '$lccr' and ckey='PN'"; //and tingkat='1'
        }else {
            $csql1 = "where skpd = '$lccr' and ckey='PN'"; //and tingkat='1'
        }
        
        $sql = "SELECT nip,nama FROM ttd $csql1 ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'nama' => $resulte['nama'],
                        'nip' => $resulte['nip']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}	
	
	function ambil_pb2() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$lccr = $this->input->post('q');
        $oto  = $this->session->userdata('otori');
        $lccr = $this->input->post('kduskpd');
        
		$csql1='';
        if ($oto =='01'){
            $csql1 = "where kd_lokasi = '$lccr' and ckey='BK'";
        }else {
            $csql1 = "where kd_lokasi = '$lccr' and ckey='BK'";
        }
        
        $sql = "SELECT nip,nama FROM ttd $csql1 ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'nama' => $resulte['nama'],
                        'nip' => $resulte['nip']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
	
    function ambil_bb() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$lccr = $this->input->post('q');
        $lccr = $this->input->post('kduskpd');
        
        if ($lccr!=''){
            $csql1 = "where skpd = '$lccr' and ckey='BB'";
        }else {
            $csql1 = "where ckey='BB'";
        }
        
        $sql = "SELECT nip,nama FROM ttd $csql1 ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'nama' => $resulte['nama'],
                        'nip' => $resulte['nip']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
    function ambil_bb2() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$lccr = $this->input->post('q');
        $lccr = $this->input->post('kduskpd');
        
        if ($lccr!=''){
            $csql1 = "where unit = '$lccr' and ckey='BB'";
        }else {
            $csql1 = "where ckey='BB'";
        }
        
        $sql = "SELECT nip,nama FROM ttd $csql1 ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'nama' => $resulte['nama'],
                        'nip' => $resulte['nip']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    function ambil_uker2() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        //$lccr = $this->input->post('q');
        $lccr = $this->input->post('kduskpd');
        
        if ($lccr!=''){
            $csql1 = "where kd_uskpd = '$lccr'";
        }else {
            $csql1 = "";
        }
        
        $sql = "SELECT kd_uker, nm_uker FROM unit_kerja $csql1 ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_uker' => $resulte['kd_uker'],  
                        'nm_uker' => $resulte['nm_uker']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
    function ambil_compy() {        
        $lccr = $this->input->post('q');    
       // $comp = $this->input->post('rekan');
        $sql = "SELECT kd_comp,nm_comp FROM mcompany where upper(nm_comp) like upper('%$lccr%')  order by nm_comp,kd_comp ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_comp' => $resulte['kd_comp'],  
                        'nm_comp' => $resulte['nm_comp']  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
	   $query1->free_result();
	}
	    
	function ambil_rekanan($lccr='') { 
		//$lccr= $this->uri->segment(3);     
        $lccr = $this->input->post('kode');
        $sql 	= "SELECT kd_ruang, nm_ruang FROM mruang where nm_ruang like '%$lccr%' order by nm_ruang ";
        $query1 = $this->db->query($sql);  
        $arr	= array();
		foreach($query1->result_array() as $resulte){ 
			$arr['query'] = $lccr;
			$arr['suggestions'][] = array(
				'value'	=>$resulte['nm_ruang'],
				'data'	=>$resulte['kd_ruang']
			);
        }

        echo json_encode($arr);
    	$query1->free_result();   
           
	}
/* 	
    function ambil_ruangan($lccr='') {        

		//$lccr= $this->uri->segment(3);
        $sql 	= "SELECT * FROM mruang where nm_ruang like '%$lccr%' order by nm_ruang ";
        $query1 = $this->db->query($sql);  
        $arr	= array();
		foreach($query1->result_array() as $resulte){ 
			$arr['query'] = $lccr;
			$arr['suggestions'][] = array(
				'value'	=>$resulte['nm_ruang'],
				'data'	=>$resulte['kd_ruang']
			);
        }

        echo json_encode($arr);
    	$query1->free_result();   
           
	} */

    function ambil_milik() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT kd_milik, nm_milik FROM mmilik where upper(kd_milik) like upper('%$lccr%') or upper(nm_milik) like upper('%$lccr%') ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_milik' => $resulte['kd_milik'],  
                        'nm_milik' => $resulte['nm_milik']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
    function ambil_wilayah() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT kd_wilayah, nm_wilayah FROM mwilayah where upper(kd_wilayah) like upper('%$lccr%') or upper(nm_wilayah) like upper('%$lccr%') ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_wilayah' => $resulte['kd_wilayah'],  
                        'nm_wilayah' => $resulte['nm_wilayah']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}

    function ambil_kel1() {
        if ($this->auth->is_logged_in() == false) {
            redirect(site_url() . '/welcome/login');
        } else {
            $lccr = $this->input->post('q');
            
            // Query for mkelompok1 with the count of mbarang
            $sql = "SELECT a.kd_kelompok, 
       a.nm_kelompok, 
       b.latest_kd_brg,
       (SELECT COUNT(kd_brg) + 1 
        FROM mbarang 
        WHERE kd_kelompok = a.kd_kelompok) AS jml
FROM mkelompok1 a
LEFT JOIN (
    SELECT m1.kd_kelompok, m1.kd_brg AS latest_kd_brg, m1.id
    FROM mbarang m1
    JOIN (
        SELECT kd_kelompok, MAX(id) AS max_id
        FROM mbarang
        GROUP BY kd_kelompok
    ) m2 ON m1.kd_kelompok = m2.kd_kelompok AND m1.id = m2.max_id
) b ON a.kd_kelompok = b.kd_kelompok
                    WHERE upper(a.kd_kelompok) LIKE upper('%$lccr%') 
                       OR upper(a.nm_kelompok) LIKE upper('%$lccr%')
ORDER BY kd_kelompok ASC, b.latest_kd_brg DESC;";
            
            $query = $this->db->query($sql);
    
            // Fetch the results
            $result = array();
            $ii = 0;
            foreach ($query->result_array() as $resulte) {

    // Default jika belum ada barang
    $last_part = 0;

    if (!empty($resulte['latest_kd_brg'])) {
        // Ambil angka setelah titik terakhir
        $parts = explode('.', $resulte['latest_kd_brg']);
        $last_part = (int) end($parts);
    }

    // Tambah 1
    $last_part2 = $last_part + 1;

    // Padding 4 digit → 0001
    $last_part2 = str_pad($last_part2, 4, '0', STR_PAD_LEFT);

    $result[] = array(
        'id' => $ii,
        'kd_kelompok' => $resulte['kd_kelompok'],
        'nm_kelompok' => $resulte['nm_kelompok'],
        'nakhir' => $last_part2,
    );

    $ii++;
            }
    
            echo json_encode($result);
        }
    }
    
      function ambil_bank() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT kode, nama FROM mbank where upper(kode) like upper('%$lccr%') or upper(nama) like upper('%$lccr%') order by kode";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_bank' => $resulte['kode'],  
                        'nm_bank' => $resulte['nama']
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
    function ambil_rek5() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT kd_rek5, nm_rek5 FROM mrek5 where upper(kd_rek5) like upper('%$lccr%') or upper(nm_rek5) like upper('%$lccr%') ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_rek5' => $resulte['kd_rek5'],  
                        'nm_rek5' => $resulte['nm_rek5'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
    function ambil_bid() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT bidang, nm_bidang FROM mbidang where upper(bidang) like upper('%$lccr%') or upper(nm_bidang) like upper('%$lccr%') ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'bidang' => $resulte['bidang'],  
                        'nm_bidang' => $resulte['nm_bidang'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
    function ambil_bidbar_e() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        $sql = "SELECT bidang, nm_bidang FROM mbidang where golongan='05' and (upper(bidang) like upper('%$lccr%') or upper(nm_bidang) like upper('%$lccr%')) ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'bidang' => $resulte['bidang'],  
                        'nm_bidang' => $resulte['nm_bidang'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
    	   
	}
    
    function tahun() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');
        if($lccr!=''){
            $where="where (upper(tahun) like upper('%$lccr%'))";
        }else{
            $where="";
        }
        $sql = "SELECT tahun FROM tahun $where order by tahun";
        // die($sql);
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array('tahun' => $resulte['tahun']);
            $ii++;
        }
           
        echo json_encode($result);
	   $query1->free_result();
       } 
	}

	
	 function ambil_brg() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr = $this->input->post('q');    
        $lccr2 = $this->input->post('r');           
        //$gol  = $this->input->post('subkel');
        $gol  = $this->input->post('gol');
        //$sts  = $this->input->post('sts'); 
		$csql1 ="";
        if ($gol!=''){
            //$csql1 = "left(kd_brg,11) = '$gol' and ";
                    $csql1 = "left(kd_brg,2) = '$gol' and ";
		}else {
            $csql1 = "";
        }
        /* if ($lccr=='' && $lccr2 != ''){
            $lccr = $lccr2;
        }
        if ($sts=='mrek5'){
            $field2 = ",b.nm_rek5";
            $csql2  = " inner join mrek5 b on a.kd_rek5=b.kd_rek5";    
        }else{
            $field2 = ",'' as nm_rek5";
            $csql2  = "";
        } */
                //$sql = "SELECT a.kd_brg,a.nm_brg,a.kd_rek5 $field2 FROM mbarang a $csql2 where $csql1 (upper(a.kd_brg) like upper('%$lccr%') or upper(a.nm_brg) like upper('%$lccr%')) order by kd_brg ";//limit 0,100    

/**kode pke rek5**/
		/*         $sql = "SELECT a.kd_brg,a.nm_brg,b.nm_rek5 ,a.kd_rek5 FROM mbarang a 
		left join mrek5 b on a.kd_rek5=b.kd_rek5 
		where $csql1 (upper(a.kd_brg) like upper('%$lccr%') or upper(a.nm_brg) like upper('%$lccr%')) order by kd_brg ";//limit 0,100    
		*/		
 /**end kode**/
 
 $sql = "SELECT * FROM mbarang a
		 where $csql1 (upper(a.kd_brg) like upper('%$lccr%') or upper(a.nm_brg) like upper('%$lccr%')) order by kd_brg ";//limit 0,100    

 
 $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_brg' => $resulte['kd_brg'],  
                        'nm_brg' => $resulte['nm_brg'],
                        'kd_rek5'=> $resulte['kd_rek5'],
                        'nm_rek5'=> $resulte['nm_rek5']                        
                        );
                        $ii++;
        }
           
        echo json_encode($result);
	   $query1->free_result();
       }
    }

function ambil_brg_dh()
{
    if ($this->auth->is_logged_in() == false) {
        redirect(site_url() . '/welcome/login');
        return;
    }

    $lccr   = $this->input->post('q');
    $lccr2  = $this->input->post('r'); // belum dipakai
    $gol    = $this->input->post('bidang');

    // Filter pencarian
    if ($lccr != '') {
        $like = "AND (
                    UPPER(a.kd_brg) LIKE UPPER('%$lccr%')
                    OR UPPER(a.nm_brg) LIKE UPPER('%$lccr%')
                 )";
    } else {
        $like = "";
    }

    $sql = "
        SELECT 
            a.kd_brg,
            a.nm_brg,
            a.kd_rek5,
            a.nm_rek5
        FROM mbarang a
        WHERE LEFT(a.kd_brg, 9) = '$gol'
        $like
        ORDER BY a.kd_brg
    ";

    $query  = $this->db->query($sql);
    $result = array();
    $i      = 0;

    foreach ($query->result_array() as $row) {
        $result[] = array(
            'id'        => $i,
            'kd_brg'    => $row['kd_brg'],
            'nm_brg'    => $row['nm_brg'],
            'kd_rek5'   => $row['kd_rek5'],
            'nm_rek5'   => $row['nm_rek5']
        );
        $i++;
    }

    $query->free_result();
    echo json_encode($result);
}

	
	function ambil_brg_kib() {
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
        $lccr 	= $this->input->post('q');    
        $lccr2 	= $this->input->post('r');           
        $gol  	= $this->input->post('subkel');
        $sts  	= $this->input->post('sts');       

        //$sql = "SELECT a.kd_brg,a.nm_brg $field2 FROM mbarang a $csql2 where $csql1 (upper(a.kd_brg) like upper('%$lccr%') or upper(a.nm_brg) like upper('%$lccr%')) order by kd_brg limit 0,100 ";    
       $sql = "SELECT a.kd_brg,a.nm_brg FROM mbarang a 
	   where left(a.kd_brg,11) = '$gol' and (upper(a.kd_brg) like upper('%$lccr%') 
	   or upper(a.nm_brg) like upper('%$lccr%')) order by kd_brg";    
		$query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_brg' => $resulte['kd_brg'],  
                        'nm_brg' => $resulte['nm_brg']                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
	   $query1->free_result();
       }
    }
    
        function ambil_kontrak() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
      
        $lccr   = $this->input->post('q');    
        $lccr2  = $this->input->post('r');
    
         
        $thn1    = $this->input->post('thn1');      
   


      //  $thn2    = $this->input->post('thn2'); 
    


      $sql = "select distinct a.no_dokumen as no_kontrak,b.keterangan from trh_isianbrg a join trd_isianbrg b on a.no_dokumen=b.no_dokumen where YEAR(a.tgl_dokumen)>='$thn1' and upper(a.no_dokumen) like upper('%$lccr%') order by a.no_dokumen ";    
        $query1 = $this->db->query($sql);
  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'no_kontrak' => $resulte['no_kontrak'],
                        'keterangan' => $resulte['keterangan']                   
                        );
                        $ii++;
        }
           
        echo json_encode($result);
       $query1->free_result();
       }
    }

    function ambil_dana() {        
        $lccr = $this->input->post('q');    
        $sql = "SELECT kd_sumberdana, nm_sumberdana FROM mdana where upper(nm_sumberdana) like upper('%$lccr%') order by kd_sumberdana, nm_sumberdana ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_sumberdana' => $resulte['kd_sumberdana'],  
                        'nm_sumberdana' => $resulte['nm_sumberdana']                         
                        );
                        $ii++;
        }
           
        echo json_encode($result);
	   $query1->free_result();
	}
    
    function ambil_unit() {        
        $lccr = $this->input->post('q');
        $kode = $this->input->post('uskpd');
        if ($kode == ""){
            $csql = "";
        }else{
            $csql = " ltrim(kd_uskpd) = ltrim('$kode') and";
        }
        $sql = "SELECT kd_uker, nm_uker FROM unit_kerja where $csql upper(nm_uker) like upper('%$lccr%')  order by kd_uker, nm_uker ";        
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_uker' => $resulte['kd_uker'],  
                        'nm_uker' => $resulte['nm_uker']                         
                        );
                        $ii++;
        }    
           
        echo json_encode($result);
	   $query1->free_result();
	} 
    
    function ambil_lap() 
    {        
        $oto="m".$this->session->userdata('otori_simbakda');
        $lccr = $this->input->post('q');    
        $sql = "SELECT idmenu,judul,link  FROM ms_menu where upper(judul) like upper('%$lccr%') and parent='4' and $oto='1' order by judul ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'idmenu' => $resulte['idmenu'],  
                        'judul' => $resulte['judul'],
                        'link' => $resulte['link']                        
                        );
                        $ii++;
        }
           
        echo json_encode($result);
	   $query1->free_result();
	} 
    
	function ambil_kiba() {
              
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
      	 
        $skpd = $this->session->userdata('skpd');
        $oto  = $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where  kd_unit like '%' ";
        }else{
            $where1 = "where kd_unit ='$skpd' ";
        }        
          
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 ="and upper(kd_unit) like upper('%$lccr%') or upper(nm_uskpd) like upper('%$lccr%') ";
        }
        
        $sql = "SELECT a.*,(select nm_brg from mbarang where kd_brg=a.kd_brg) as nama_barang FROM trkib_a a $where1 $where2  order by kd_unit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_unit' => $resulte['kd_unit'],  
                        'no_reg' => $resulte['no_reg'], 
                        'kd_brg' => $resulte['kd_brg'], 
                        'nama_barang' => $resulte['nama_barang'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
	}
   	function ambil_kibb() {
              
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
      	 
        $skpd = $this->session->userdata('skpd');
        $oto  = $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where  kd_unit like '%' ";
        }else{
            $where1 = "where kd_unit ='$skpd' ";
        }        
          
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 ="and upper(kd_unit) like upper('%$lccr%') or upper(nm_uskpd) like upper('%$lccr%') ";
        }
        
        $sql = "SELECT a.*,(select nm_brg from mbarang where kd_brg=a.kd_brg) as nama_barang FROM trkib_b a $where1 $where2  order by kd_unit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_unit' => $resulte['kd_unit'],  
                        'no_reg' => $resulte['no_reg'], 
                        'kd_brg' => $resulte['kd_brg'], 
                        'nama_barang' => $resulte['nama_barang'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
	}
	function ambil_kibc() {
              
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
      	 
        $skpd = $this->session->userdata('skpd');
        $oto  = $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where  kd_unit like '%' ";
        }else{
            $where1 = "where kd_unit ='$skpd' ";
        }        
          
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 ="and upper(kd_unit) like upper('%$lccr%') or upper(nm_uskpd) like upper('%$lccr%') ";
        }
        
        $sql = "SELECT a.*,(select nm_brg from mbarang where kd_brg=a.kd_brg) as nama_barang FROM trkib_c a $where1 $where2  order by kd_unit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_unit' => $resulte['kd_unit'],  
                        'no_reg' => $resulte['no_reg'], 
                        'kd_brg' => $resulte['kd_brg'], 
                        'nama_barang' => $resulte['nama_barang'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
	}
	function ambil_kibd() {
              
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
      	 
        $skpd = $this->session->userdata('skpd');
        $oto  = $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where  kd_unit like '%' ";
        }else{
            $where1 = "where kd_unit ='$skpd' ";
        }        
          
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 ="and upper(kd_unit) like upper('%$lccr%') or upper(nm_uskpd) like upper('%$lccr%') ";
        }
        
        $sql = "SELECT a.*,(select nm_brg from mbarang where kd_brg=a.kd_brg) as nama_barang FROM trkib_d a $where1 $where2  order by kd_unit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_unit' => $resulte['kd_unit'],  
                        'no_reg' => $resulte['no_reg'], 
                        'kd_brg' => $resulte['kd_brg'], 
                        'nama_barang' => $resulte['nama_barang'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
	}
	function ambil_kibe() {
              
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
      	 
        $skpd = $this->session->userdata('skpd');
        $oto  = $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where  kd_unit like '%' ";
        }else{
            $where1 = "where kd_unit ='$skpd' ";
        }        
          
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 ="and upper(kd_unit) like upper('%$lccr%') or upper(nm_uskpd) like upper('%$lccr%') ";
        }
        
        $sql = "SELECT a.*,(select nm_brg from mbarang where kd_brg=a.kd_brg) as nama_barang FROM trkib_e a $where1 $where2  order by kd_unit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_unit' => $resulte['kd_unit'],  
                        'no_reg' => $resulte['no_reg'], 
                        'kd_brg' => $resulte['kd_brg'], 
                        'nama_barang' => $resulte['nama_barang'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
	}
	function ambil_kibf() {
              
        if($this->auth->is_logged_in() == false){
           	redirect(site_url().'/welcome/login');
      	}else{
      	 
        $skpd = $this->session->userdata('skpd');
        $oto  = $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where  kd_unit like '%' ";
        }else{
            $where1 = "where kd_unit ='$skpd' ";
        }        
          
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 ="and upper(kd_unit) like upper('%$lccr%') or upper(nm_uskpd) like upper('%$lccr%') ";
        }
        
        $sql = "SELECT a.*,(select nm_brg from mbarang where kd_brg=a.kd_brg) as nama_barang FROM trkib_f a $where1 $where2  order by kd_unit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_unit' => $resulte['kd_unit'],  
                        'no_reg' => $resulte['no_reg'], 
                        'kd_brg' => $resulte['kd_brg'], 
                        'nama_barang' => $resulte['nama_barang'],  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
	}	
	
	
		function do_upload(){
		//DATANYA DI UPLOAD DULU
		$fl= $this->input->post('datasql');
		$upload_path_url = base_url().'upload/';
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'jpg|jpeg|txt|dat|sql|txt|abc';
        $config['max_size'] = '100000';
        $config['overwrite'] = TRUE; //overwrite user avatar

        $this->load->library('upload', $config);
	    $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('datasql')) {
			$data['status_upload']= $this->upload->display_errors();
        } else {
	
			
			//PROSES RESTORE DATA
			$dat =  $this->upload->data();
			$lfile=$dat['full_path'];


			$fl=fopen($lfile,'r');
			$jum=0;
			while (!feof($fl)) {
				$contents = fread($fl, filesize($lfile));

				//$this->_randomsleep();
			    //$query = $this->db->query($contents);  
				
				$baris=explode(";".chr(13),$contents);
				for($i=0;$i<=count($baris)-1;$i++){
					$q=$baris[$i];			        
					$jum++;	
					//$this->_randomsleep();
					//$query = $this->db->query($q);  

					$nm=FCPATH.'/restore/temp'.($i).'.txt';
					$fltemp=fopen($nm,'w+');
					fwrite($fltemp,$q);		
					fclose($fltemp);


				}			
			}

			$nm=FCPATH.'/restore/jumquery.txt';
			$fltemp=fopen($nm,'w+');
			fwrite($fltemp,$jum);		
			fclose($fltemp);


			fclose($fl);

			$data['page_title']= 'Backup';
			$data['status_upload']= 'Upload Berhasil'; //'Restore Berhasil';
			$this->template->set('title', 'Backup');   
			$this->template->load('template','backup/backup',$data) ;
		}

	}

    function ambil_spp() { 
    $dbsimakda=$this->load->database('simakda', TRUE);
        /*if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        
        $skpd       = $this->session->userdata('unit_skpd');
        $oto        = $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = "where kd_skpd like '%' ";
        }else{
            $where1 = "where kd_skpd ='$skpd' and ";
        } */       
        $skpd= $this->input->post('kdskpd');  
        $lccr = $this->input->post('q');
        $spp =$this->input->post('spp');
        $giat = $this->input->post('giat');
        $rek = $this->input->post('rek');
        $jns = $this->input->post('jns');
        $nom = $this->input->post('nom');
          $where2='';
        if($lccr <> ''){
            $where2 =" and UPPER(no_spp) LIKE UPPER('%$lccr%') ";
        }

  /*      if($jns=='1' || $jns=='2' || $jns=='3' || $jns=='7'){
            $sql ="SELECT a.no_sp2d,a.tgl_sp2d,b.nilai,a.keperluan FROM trhsp2d a JOIN trdtransout b ON a.no_sp2d=b.no_sp2d
                    WHERE a.kd_skpd='$skpd' AND a.no_sp2d='$sp2d' 
                    AND b.no_bukti='$nom' AND b.kd_kegiatan='$giat' AND b.kd_rek5='$rek'";

        }else{
            $sql ="SELECT a.no_sp2d,a.tgl_sp2d,b.nilai,a.keperluan FROM trhsp2d a join trdspp b on a.no_spp=b.no_spp 
                   where a.kd_skpd='$skpd' and a.no_sp2d='$sp2d' and b.kd_kegiatan='$giat' and b.kd_rek5='$rek' and jns_spp!='4' $where2 order by no_sp2d ";
        }*/


            $sql ="SELECT a.no_spp,a.tgl_spp,b.nilai,a.keperluan FROM trhspp a join trdspp b on a.no_spp=b.no_spp 
                   where a.kd_skpd='$skpd' and a.no_spp='$spp' and b.kd_kegiatan='$giat' and b.kd_rek5='$rek' and a.jns_spp!='4' $where2 order by a.no_spp ";
        
        
        
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'        => $ii,        
                        'no_spp' => $resulte['no_spp'],
                        'tgl_spp' => $resulte['tgl_spp'],
                        'nilai2' => number_format($resulte['nilai'],2,'.',','),
                        'nilai'=>$resulte['nilai'],
                        'keperluan' => $resulte['keperluan'] 
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }

    //     function ambil_nomor_kontrak() { 
    //     $dbsimakda=$this->load->database('simakda', TRUE);
    //     $kdskpd =$this->input->post('kdskpd');
    //     $jenis_kib =$this->input->post('golongan');
    //     if($jenis_kib=='03'){
    //         $tabel = 'trkib_c';
    //     }else{
    //         $tabel = 'trkib_d';
    //     }
    //     if($this->auth->is_logged_in() == false){
    //         redirect(site_url().'/welcome/login');
    //     }else{
        
    //     $skpd       = $this->session->userdata('skpd');
    //     $oto        = $this->session->userdata('otori');
    //     $lccr = $this->input->post('q');
    //     $where2a='';$where2b='';$where2c='';
    //     $where1 = '';       
    //     if($oto == '01' && $skpd=='1.20.05.01'){ 
    //         $where1 = " a.kd_skpd like '%' and ";
    //     }else if($oto=='01' && $skpd<>'1.20.05.01'){
    //         $where1 = " a.kd_skpd ='$skpd' and ";
    //     }else if($oto=='02' && $skpd<>'1.20.05.01'){
    //         $where1 = " a.kd_skpd ='$skpd' and ";
    //     }else if($oto=='02' && $skpd=='1.20.05.01'){
    //         $where1 = " a.kd_skpd like '%' and ";
    //     }       
          
        
    //     if($lccr <> ''){
    //         $where2a =" and (UPPER(a.no_kontrak) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
    //         $where2b =" and (UPPER(a.no_bukti) LIKE UPPER('%$lccr%') or UPPER(a.ket) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%'))";
    //         $where2c =" and (UPPER(a.no_spp) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
    //     }
    //     //$dbsimbakda = "simbakda_2019";

    //      $sql="SELECT no_dokumen,total AS nilai_brg,keterangan,kd_unit FROM $tabel where kd_skpd='$kdskpd'";   
    //     $query1 = $this->db->query($sql);  
    //     $result = array();
    //     $ii = 0;
    //     foreach($query1->result_array() as $resulte)
    //     { 
           
    //         $result[] = array(
    //                     'id'            => $ii,        
    //                     'no_dokumen'       => $resulte['no_dokumen'],
    //                     'nilai2'    => $resulte['nilai_brg'],
    //                     'keterangan'    => $resulte['keterangan'],
    //                     'kd_unit'      => $resulte['kd_unit']
    //                     // 'nkontrak2'     => number_format($resulte['nkontrak'],2,'.',','),
    //                     // 'no_sp2d'       => $resulte['no_sp2d'],
    //                     // 'nilai2'        => number_format($resulte['nilai'],2,'.',','),
    //                     // 'nilai'         => $resulte['nilai'],
    //                     // 'no_spp'        => $resulte['no_spp'],
    //                     // 'kd_kegiatan'   => $resulte['kd_kegiatan'],
    //                     // 'kd_rek5'       => $resulte['kd_rek5'],
    //                     // 'nm_kegiatan'   => $resulte['nm_kegiatan'],
    //                     // 'nm_rek5'       => $resulte['nm_rek5'],
    //                     // 'nilai_ubah'    => number_format($resulte['nilai_ubah'],2,'.',','),
    //                     // 'tgl_bukti'     => $resulte['tgl_bukti'],
    //                     // 'jns_spp'       => $resulte['jns_spp'],
    //                     // 'kode'       => $resulte['kode'],
    //                     // 'nmrekan'       => $resulte['nmrekan']
                       
    //                     );
    //                     $ii++;
    //     }
    //     echo json_encode($result);
    //     }
    // }
           
    function ambil_nomor_kontrak() { 
        $dbsimakda=$this->load->database('simakda', TRUE);
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        
        $skpd       = $this->session->userdata('skpd');
        $oto        = $this->session->userdata('otori');
        $lccr = $this->input->post('q');
        $where2a='';$where2b='';$where2c='';
        $where1 = '';       
        if($oto == '01' && $skpd=='1.20.05.01'){ 
            $where1 = " a.kd_skpd like '%' and ";
        }else if($oto=='01' && $skpd<>'1.20.05.01'){
            $where1 = " a.kd_skpd ='$skpd' and ";
        }else if($oto=='02' && $skpd<>'1.20.05.01'){
            $where1 = " a.kd_skpd ='$skpd' and ";
        }else if($oto=='02' && $skpd=='1.20.05.01'){
            $where1 = " a.kd_skpd like '%' and ";
        }       
          
        
        if($lccr <> ''){
            $where2a =" and (UPPER(a.no_kontrak) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2b =" and (UPPER(a.no_bukti) LIKE UPPER('%$lccr%') or UPPER(a.ket) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%'))";
            $where2c =" and (UPPER(a.no_spp) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
        }
        $dbsimbakda = "simbakda_2019";
        /*$sql    = "SELECT a.kd_skpd,a.no_kontrak,a.no_spp,c.no_sp2d,b.nilai,b.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan as keterangan FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp
                    WHERE $where1 a.no_kontrak!='' AND LEFT(b.kd_rek5,3)='523' 
                    AND (a.no_kontrak,b.kd_rek5) NOT IN (SELECT simbakda_biak.trh_isianbrg.no_dokumen,simbakda_biak.trd_isianbrg.kd_rek5 FROM simbakda_biak.trh_isianbrg JOIN simbakda_biak.trd_isianbrg ON simbakda_biak.trh_isianbrg.no_dokumen=simbakda_biak.trd_isianbrg.no_dokumen)
                    AND (a.no_kontrak,b.kd_rek5) NOT IN(SELECT simbakda_biak.trh_trpelihara.no_dokumen,simbakda_biak.trd_trpelihara.kd_rek FROM simbakda_biak.trh_trpelihara JOIN simbakda_biak.trd_trpelihara ON simbakda_biak.trh_trpelihara.no_dokumen=simbakda_biak.trd_trpelihara.no_dokumen) $where2a
                    UNION ALL
                    SELECT a.kd_skpd,a.no_bukti AS no_kontrak,''AS no_spp,b.no_sp2d,b.nilai,b.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket as keterangan FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti
                    WHERE $where1 LEFT(b.kd_rek5,3)='523' AND (a.no_bukti,b.kd_rek5) NOT IN 
                    (SELECT simbakda_biak.trh_isianbrg.no_dokumen,simbakda_biak.trd_isianbrg.kd_rek5 FROM simbakda_biak.trh_isianbrg JOIN simbakda_biak.trd_isianbrg ON 
                    simbakda_biak.trh_isianbrg.no_dokumen=simbakda_biak.trd_isianbrg.no_dokumen)
                    AND (a.no_bukti,b.kd_rek5) NOT IN(SELECT simbakda_biak.trh_trpelihara.no_dokumen,simbakda_biak.trd_trpelihara.kd_rek FROM simbakda_biak.trh_trpelihara JOIN
                    simbakda_biak.trd_trpelihara ON simbakda_biak.trd_trpelihara.no_dokumen=simbakda_biak.trh_trpelihara.no_dokumen) $where2b";*/

        /*$sql    = "SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,sum(b.nilai)as nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan,d.nilai_ubah 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                    LEFT JOIN trhtagih e ON a.no_kontrak=e.no_kontrak
                    WHERE $where1 a.no_kontrak!='' AND LEFT(b.kd_rek5,3)='523' AND a.jns_spp IN ('5','6') $where2a
                    AND (a.no_kontrak,b.kd_rek5) NOT IN (SELECT simbakda_biak.trh_isianbrg.no_dokumen,simbakda_biak.trd_isianbrg.kd_rek5 FROM simbakda_biak.trh_isianbrg JOIN simbakda_biak.trd_isianbrg ON simbakda_biak.trh_isianbrg.no_dokumen=simbakda_biak.trd_isianbrg.no_dokumen)
                    AND (a.no_kontrak,b.kd_rek5) NOT IN(SELECT simbakda_biak.trh_trpelihara.no_dokumen,simbakda_biak.trd_trpelihara.kd_rek FROM simbakda_biak.trh_trpelihara JOIN simbakda_biak.trd_trpelihara ON simbakda_biak.trh_trpelihara.no_dokumen=simbakda_biak.trd_trpelihara.no_dokumen) 
                    GROUP BY a.no_kontrak
                    UNION ALL
                    SELECT a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan,d.nilai_ubah 
                    FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                    WHERE $where1 LEFT(b.kd_rek5,3)='523' AND a.jns_spp IN ('1','2','3','7') $where2b AND (a.no_bukti,b.kd_rek5) NOT IN 
                    (SELECT simbakda_biak.trh_isianbrg.no_dokumen,simbakda_biak.trd_isianbrg.kd_rek5 FROM simbakda_biak.trh_isianbrg JOIN simbakda_biak.trd_isianbrg ON 
                    simbakda_biak.trh_isianbrg.no_dokumen=simbakda_biak.trd_isianbrg.no_dokumen)
                    AND (a.no_bukti,b.kd_rek5) NOT IN(SELECT simbakda_biak.trh_trpelihara.no_dokumen,simbakda_biak.trd_trpelihara.kd_rek FROM simbakda_biak.trh_trpelihara JOIN
                    simbakda_biak.trd_trpelihara ON simbakda_biak.trd_trpelihara.no_dokumen=simbakda_biak.trh_trpelihara.no_dokumen) ";*/
        /*$sql       ="SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,SUM(b.nilai)AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan,
                    d.nilai_ubah-((SELECT IFNULL(SUM($dbsimbakda.trd_isianbrg.total),0) FROM $dbsimbakda.trd_isianbrg JOIN $dbsimbakda.trh_isianbrg ON $dbsimbakda.trh_isianbrg.no_dokumen=$dbsimbakda.trd_isianbrg.no_dokumen WHERE $dbsimbakda.trd_isianbrg.kd_uskpd=a.kd_skpd AND $dbsimbakda.trd_isianbrg.kd_kegiatan=b.kd_kegiatan AND $dbsimbakda.trd_isianbrg.kd_rek5=b.kd_rek5)+
                    (SELECT IFNULL(SUM($dbsimbakda.trd_trpelihara.biaya_pelihara),0) FROM $dbsimbakda.trd_trpelihara JOIN $dbsimbakda.trh_trpelihara ON $dbsimbakda.trd_trpelihara.no_dokumen=$dbsimbakda.trh_trpelihara.no_dokumen WHERE $dbsimbakda.trd_trpelihara.kd_uskpd=a.kd_skpd AND $dbsimbakda.trd_trpelihara.kd_kegiatan=b.kd_kegiatan AND $dbsimbakda.trd_trpelihara.kd_rek=b.kd_rek5)) AS nilai_ubah 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE $where1 a.no_kontrak!='' AND LEFT(b.kd_rek5,3)='523' AND a.jns_spp IN ('5','6') $where2a
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT $dbsimbakda.trh_isianbrg.no_dokumen,$dbsimbakda.trd_isianbrg.kd_kegiatan,$dbsimbakda.trd_isianbrg.kd_rek5,IFNULL(SUM($dbsimbakda.trd_isianbrg.total),0)AS nilai FROM $dbsimbakda.trh_isianbrg JOIN $dbsimbakda.trd_isianbrg ON $dbsimbakda.trh_isianbrg.no_dokumen=$dbsimbakda.trd_isianbrg.no_dokumen GROUP BY  $dbsimbakda.trh_isianbrg.no_dokumen)
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN(SELECT $dbsimbakda.trh_trpelihara.no_dokumen,$dbsimbakda.trd_trpelihara.kd_kegiatan,$dbsimbakda.trd_trpelihara.kd_rek,IFNULL(SUM($dbsimbakda.trd_trpelihara.biaya_pelihara),0)AS nilai FROM $dbsimbakda.trh_trpelihara JOIN $dbsimbakda.trd_trpelihara ON $dbsimbakda.trh_trpelihara.no_dokumen=$dbsimbakda.trd_trpelihara.no_dokumen GROUP BY $dbsimbakda.trh_trpelihara.no_dokumen) 
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    UNION ALL
                    SELECT a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan,
                    d.nilai_ubah-((SELECT IFNULL(SUM($dbsimbakda.trd_isianbrg.total),0) FROM $dbsimbakda.trd_isianbrg JOIN $dbsimbakda.trh_isianbrg ON $dbsimbakda.trh_isianbrg.no_dokumen=$dbsimbakda.trd_isianbrg.no_dokumen WHERE $dbsimbakda.trd_isianbrg.kd_uskpd=a.kd_skpd AND $dbsimbakda.trd_isianbrg.kd_kegiatan=b.kd_kegiatan AND $dbsimbakda.trd_isianbrg.kd_rek5=b.kd_rek5)+
                    (SELECT IFNULL(SUM($dbsimbakda.trd_trpelihara.biaya_pelihara),0) FROM $dbsimbakda.trd_trpelihara JOIN $dbsimbakda.trh_trpelihara ON $dbsimbakda.trd_trpelihara.no_dokumen=$dbsimbakda.trh_trpelihara.no_dokumen WHERE $dbsimbakda.trd_trpelihara.kd_uskpd=a.kd_skpd AND $dbsimbakda.trd_trpelihara.kd_kegiatan=b.kd_kegiatan AND $dbsimbakda.trd_trpelihara.kd_rek=b.kd_rek5)) AS nilai_ubah 
                    FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                    WHERE $where1 LEFT(b.kd_rek5,3)='523' AND a.jns_spp IN ('1','2','3','7') $where2b AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT $dbsimbakda.trh_isianbrg.no_dokumen,$dbsimbakda.trd_isianbrg.kd_kegiatan,$dbsimbakda.trd_isianbrg.kd_rek5,IFNULL(SUM($dbsimbakda.trd_isianbrg.total),0)AS nilai FROM $dbsimbakda.trh_isianbrg JOIN $dbsimbakda.trd_isianbrg ON $dbsimbakda.trh_isianbrg.no_dokumen=$dbsimbakda.trd_isianbrg.no_dokumen GROUP BY  $dbsimbakda.trh_isianbrg.no_dokumen)
                    AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN(SELECT $dbsimbakda.trh_trpelihara.no_dokumen,$dbsimbakda.trd_trpelihara.kd_kegiatan,$dbsimbakda.trd_trpelihara.kd_rek,IFNULL(SUM($dbsimbakda.trd_trpelihara.biaya_pelihara),0)AS nilai FROM $dbsimbakda.trh_trpelihara JOIN $dbsimbakda.trd_trpelihara ON $dbsimbakda.trh_trpelihara.no_dokumen=$dbsimbakda.trd_trpelihara.no_dokumen GROUP BY $dbsimbakda.trh_trpelihara.no_dokumen)
                    UNION ALL
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,SUM(b.nilai)AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan,
                    d.nilai_ubah-((SELECT IFNULL(SUM($dbsimbakda.trd_isianbrg.total),0) FROM $dbsimbakda.trd_isianbrg JOIN $dbsimbakda.trh_isianbrg ON $dbsimbakda.trh_isianbrg.no_dokumen=$dbsimbakda.trd_isianbrg.no_dokumen WHERE $dbsimbakda.trd_isianbrg.kd_uskpd=a.kd_skpd AND $dbsimbakda.trd_isianbrg.kd_kegiatan=b.kd_kegiatan AND $dbsimbakda.trd_isianbrg.kd_rek5=b.kd_rek5)+
                    (SELECT IFNULL(SUM($dbsimbakda.trd_trpelihara.biaya_pelihara),0) FROM $dbsimbakda.trd_trpelihara JOIN $dbsimbakda.trh_trpelihara ON $dbsimbakda.trd_trpelihara.no_dokumen=$dbsimbakda.trh_trpelihara.no_dokumen WHERE $dbsimbakda.trd_trpelihara.kd_uskpd=a.kd_skpd AND $dbsimbakda.trd_trpelihara.kd_kegiatan=b.kd_kegiatan AND $dbsimbakda.trd_trpelihara.kd_rek=b.kd_rek5)) AS nilai_ubah 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE $where1 a.no_kontrak='' AND LEFT(b.kd_rek5,3)='523' AND a.jns_spp IN ('5','6') $where2c
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT $dbsimbakda.trh_isianbrg.no_dokumen,$dbsimbakda.trd_isianbrg.kd_kegiatan,$dbsimbakda.trd_isianbrg.kd_rek5,IFNULL(SUM($dbsimbakda.trd_isianbrg.total),0)AS nilai FROM $dbsimbakda.trh_isianbrg JOIN $dbsimbakda.trd_isianbrg ON $dbsimbakda.trh_isianbrg.no_dokumen=$dbsimbakda.trd_isianbrg.no_dokumen GROUP BY  $dbsimbakda.trh_isianbrg.no_dokumen)
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN(SELECT $dbsimbakda.trh_trpelihara.no_dokumen,$dbsimbakda.trd_trpelihara.kd_kegiatan,$dbsimbakda.trd_trpelihara.kd_rek,IFNULL(SUM($dbsimbakda.trd_trpelihara.biaya_pelihara),0)AS nilai FROM $dbsimbakda.trh_trpelihara JOIN $dbsimbakda.trd_trpelihara ON $dbsimbakda.trh_trpelihara.no_dokumen=$dbsimbakda.trd_trpelihara.no_dokumen GROUP BY $dbsimbakda.trh_trpelihara.no_dokumen) 
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai
                    ORDER BY kd_skpd,no_kontrak,tgl_bukti";*/
        // $sql ="SELECT c.jns_spp,a.kd_skpd,a.no_kontrak,f.kode,a.nmrekan,e.tgl_bukti,a.no_spp,c.no_sp2d,IFNULL(e.nkontrak,0)AS nkontrak,b.nilai AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan,
        //     d.nilai_ubah-
        //     ((SELECT IFNULL(SUM(g.total),0) FROM $dbsimbakda.trd_isianbrg g JOIN $dbsimbakda.trh_isianbrg h
        //     ON g.no_bukti=h.no_bukti AND h.no_dokumen=g.no_dokumen WHERE g.kd_uskpd=a.kd_skpd 
        //     AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek5=b.kd_rek5)+
        //     (SELECT IFNULL(SUM(g.biaya_pelihara),0) FROM $dbsimbakda.trd_trpelihara g JOIN $dbsimbakda.trh_trpelihara h ON g.no_dokumen=h.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek=b.kd_rek5)) AS nilai_ubah 
        //     FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
        //     LEFT JOIN trdrka d ON a.kd_skpd=d.kd_skpd AND b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti LEFT JOIN ms_perusahaan f ON a.nmrekan=f.nama
        //     WHERE $where1 a.no_kontrak!='' AND LEFT(b.kd_rek5,3)='523' AND a.jns_spp IN ('5','6') 
        //     AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek5,IFNULL(SUM(g.total),0)AS nilai FROM $dbsimbakda.trh_isianbrg h JOIN $dbsimbakda.trd_isianbrg g ON h.no_bukti=g.no_bukti AND h.no_dokumen=g.no_dokumen GROUP BY h.no_bukti,h.no_dokumen)
        //     AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek,IFNULL(SUM(g.biaya_pelihara),0)AS nilai FROM $dbsimbakda.trh_trpelihara h JOIN $dbsimbakda.trd_trpelihara g ON h.no_dokumen=g.no_dokumen GROUP BY h.no_dokumen) 
        //     AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkiba_kap b )
        //     AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibb_kap b )
        //     AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibc_kap b )
        //     AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibd_kap b )
        //     AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibg_kap b ) $where2a
        //     UNION ALL
        //     SELECT a.jns_spp,a.kd_skpd,a.no_bukti AS no_kontrak,'' as kode,'' AS nmrekan,a.tgl_bukti,''AS no_spp,b.no_sp2d,CAST(0 AS DECIMAL(18,2))AS nkontrak,b.nilai AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan,
        //     d.nilai_ubah-((SELECT IFNULL(SUM(g.total),0) FROM $dbsimbakda.trd_isianbrg g JOIN $dbsimbakda.trh_isianbrg h ON g.no_bukti=h.no_bukti AND h.no_dokumen=g.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek5=b.kd_rek5)+
        //     (SELECT IFNULL(SUM(g.biaya_pelihara),0) FROM $dbsimbakda.trd_trpelihara g JOIN $dbsimbakda.trh_trpelihara h ON g.no_dokumen=h.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek=b.kd_rek5)) AS nilai_ubah 
        //     FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON a.kd_skpd=d.kd_skpd AND b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
        //     WHERE $where1 LEFT(b.kd_rek5,3)='523' AND a.jns_spp IN ('1','2','3','7') 
        //     AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
        //     (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek5,IFNULL(SUM(g.total),0)AS nilai FROM $dbsimbakda.trh_isianbrg h JOIN $dbsimbakda.trd_isianbrg g ON h.no_bukti=g.no_bukti AND h.no_dokumen=g.no_dokumen GROUP BY  h.no_bukti,h.no_dokumen)
        //     AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek,IFNULL(SUM(g.biaya_pelihara),0)AS nilai FROM $dbsimbakda.trh_trpelihara h JOIN $dbsimbakda.trd_trpelihara g ON h.no_dokumen=g.no_dokumen GROUP BY h.no_dokumen)
        //     AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkiba_kap b )
        //     AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibb_kap b )
        //     AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibc_kap b )
        //     AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibd_kap b )
        //     AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibg_kap b ) $where2b
        //     UNION ALL
        //     SELECT c.jns_spp,a.kd_skpd,c.no_sp2d AS no_kontrak,e.kode,a.nmrekan,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,CAST(0 AS DECIMAL(18,2))AS nkontrak,b.nilai AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan,
        //     d.nilai_ubah-((SELECT IFNULL(SUM(g.total),0) FROM $dbsimbakda.trd_isianbrg g JOIN $dbsimbakda.trh_isianbrg h ON g.no_bukti=h.no_bukti AND h.no_bukti=g.no_bukti AND h.no_dokumen=g.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek5=b.kd_rek5)+
        //     (SELECT IFNULL(SUM(g.biaya_pelihara),0) FROM $dbsimbakda.trd_trpelihara g JOIN $dbsimbakda.trh_trpelihara h ON g.no_dokumen=h.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek=b.kd_rek5)) AS nilai_ubah 
        //     FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
        //     LEFT JOIN trdrka d ON a.kd_skpd=d.kd_skpd AND b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
        //     LEFT JOIN ms_perusahaan e ON a.nmrekan=e.nama 
        //     WHERE $where1 a.no_kontrak='' AND LEFT(b.kd_rek5,3)='523' AND a.jns_spp IN ('5','6') 
        //     AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek5,IFNULL(SUM(g.total),0)AS nilai FROM $dbsimbakda.trh_isianbrg h JOIN $dbsimbakda.trd_isianbrg g ON h.no_bukti=g.no_bukti AND h.no_dokumen=g.no_dokumen GROUP BY h.no_bukti,h.no_dokumen)
        //     AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek,IFNULL(SUM(g.biaya_pelihara),0)AS nilai FROM $dbsimbakda.trh_trpelihara h JOIN $dbsimbakda.trd_trpelihara g ON h.no_dokumen=g.no_dokumen GROUP BY h.no_dokumen) 
        //     AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkiba_kap b )
        //     AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibb_kap b )
        //     AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibc_kap b )
        //     AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibd_kap b )
        //     AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibd_kap b ) $where2c
            
        //     ORDER BY kd_skpd,no_kontrak,tgl_bukti";

         $sql="SELECT a.jns_spp,a.kd_skpd,a.no_kontrak,f.kode,a.nmrekan,e.tgl_bukti,a.no_spp,'' AS no_sp2d,IFNULL(e.nkontrak,0)AS nkontrak,b.nilai AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan, d.nilai_ubah-
((SELECT IFNULL(SUM(g.total),0) FROM simbakda_2019.trd_isianbrg g JOIN simbakda_2019.trh_isianbrg h
ON g.no_bukti=h.no_bukti AND h.no_dokumen=g.no_dokumen WHERE g.kd_uskpd=a.kd_skpd 
AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek5=b.kd_rek5)+
(SELECT IFNULL(SUM(g.biaya_pelihara),0) FROM simbakda_2019.trd_trpelihara g JOIN simbakda_2019.trh_trpelihara h 
ON g.no_dokumen=h.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek=b.kd_rek5)) AS nilai_ubah  
FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp 
LEFT JOIN trdrka d ON a.kd_skpd=d.kd_skpd AND b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 AND a.sumber=d.sumber_ubah
LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti LEFT JOIN ms_perusahaan f ON a.nmrekan=f.nama
WHERE a.kd_skpd ='$skpd' AND  a.no_kontrak!='' AND LEFT(b.kd_rek5,3)='523' AND a.jns_spp IN ('5','6') 
AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek5,IFNULL(SUM(g.total),0)AS nilai  
FROM simbakda_2019.trh_isianbrg h JOIN simbakda_2019.trd_isianbrg g ON h.no_bukti=g.no_bukti 
AND h.no_dokumen=g.no_dokumen GROUP BY h.no_bukti,h.no_dokumen)
AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek,
IFNULL(SUM(g.biaya_pelihara),0)AS nilai FROM simbakda_2019.trh_trpelihara h JOIN simbakda_2019.trd_trpelihara g 
ON h.no_dokumen=g.no_dokumen GROUP BY h.no_dokumen) 
AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 AS nilai 
FROM simbakda_2019.trdkiba_kap b )
AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 AS nilai 
FROM simbakda_2019.trdkibb_kap b )
AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5
AS nilai FROM simbakda_2019.trdkibc_kap b )
AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 AS nilai FROM simbakda_2019.trdkibd_kap b )
AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5  AS nilai FROM simbakda_2019.trdkibg_kap b ) 
UNION ALL
SELECT a.jns_spp,a.kd_skpd,a.no_bukti AS no_kontrak,'' AS kode,'' AS nmrekan,a.tgl_bukti,''AS no_spp,'' AS no_sp2d,
CAST(0 AS DECIMAL(18,2))AS nkontrak,b.nilai AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan,d.nilai_ubah-((SELECT IFNULL(SUM(g.total),0) FROM simbakda_2019.trd_isianbrg g JOIN simbakda_2019.trh_isianbrg h 
ON g.no_bukti=h.no_bukti AND h.no_dokumen=g.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan 
AND g.kd_rek5=b.kd_rek5)+
(SELECT IFNULL(SUM(g.biaya_pelihara),0) FROM simbakda_2019.trd_trpelihara g JOIN simbakda_2019.trh_trpelihara h 
ON g.no_dokumen=h.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek=b.kd_rek5)) 
AS nilai_ubah FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti 
LEFT JOIN trdrka d ON a.kd_skpd=d.kd_skpd AND b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
WHERE a.kd_skpd ='$skpd' AND  LEFT(b.kd_rek5,3)='523' AND a.jns_spp IN ('1','2','3','7') 
AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
(SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek5,IFNULL(SUM(g.total),0)AS nilai FROM simbakda_2019.trh_isianbrg h 
JOIN simbakda_2019.trd_isianbrg g 
ON h.no_bukti=g.no_bukti AND h.no_dokumen=g.no_dokumen GROUP BY  h.no_bukti,h.no_dokumen)
AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek,
IFNULL(SUM(g.biaya_pelihara),0)AS nilai FROM simbakda_2019.trh_trpelihara h JOIN simbakda_2019.trd_trpelihara g 
ON h.no_dokumen=g.no_dokumen GROUP BY h.no_dokumen)
AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,
b.nilai_rek5 AS nilai FROM simbakda_2019.trdkiba_kap b )
AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,
b.nilai_rek5 AS nilai FROM simbakda_2019.trdkibb_kap b )
AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,
b.nilai_rek5 AS nilai FROM simbakda_2019.trdkibc_kap b )
AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,
b.nilai_rek5 AS nilai FROM simbakda_2019.trdkibd_kap b )
AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,
b.nilai_rek5 AS nilai FROM simbakda_2019.trdkibg_kap b ) 
UNION ALL
SELECT a.jns_spp,a.kd_skpd,a.no_spp AS no_kontrak,e.kode,a.nmrekan,a.tgl_spp AS tgl_bukti,a.no_spp,'' AS no_sp2d,
CAST(0 AS DECIMAL(18,2))AS nkontrak,b.nilai AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,
b.nm_rek5,a.keperluan AS keterangan,
d.nilai_ubah-((SELECT IFNULL(SUM(g.total),0) FROM simbakda_2019.trd_isianbrg g JOIN simbakda_2019.trh_isianbrg h 
ON g.no_bukti=h.no_bukti AND h.no_bukti=g.no_bukti AND h.no_dokumen=g.no_dokumen WHERE g.kd_uskpd=a.kd_skpd 
AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek5=b.kd_rek5)+
(SELECT IFNULL(SUM(g.biaya_pelihara),0) FROM simbakda_2019.trd_trpelihara g JOIN simbakda_2019.trh_trpelihara h 
ON g.no_dokumen=h.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan 
AND g.kd_rek=b.kd_rek5)) AS nilai_ubah 
FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp
LEFT JOIN trdrka d ON a.kd_skpd=d.kd_skpd AND b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 AND a.sumber=d.sumber_ubah
LEFT JOIN ms_perusahaan e ON a.nmrekan=e.nama 
WHERE a.kd_skpd ='$skpd' AND  a.no_kontrak='' AND LEFT(b.kd_rek5,3)='523' AND a.jns_spp IN ('5','6') 
AND (a.no_spp,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek5,
IFNULL(SUM(g.total),0)AS nilai FROM simbakda_2019.trh_isianbrg h JOIN simbakda_2019.trd_isianbrg g 
ON h.no_bukti=g.no_bukti AND h.no_dokumen=g.no_dokumen GROUP BY h.no_bukti,h.no_dokumen)
AND (a.no_spp,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek,
IFNULL(SUM(g.biaya_pelihara),0)AS nilai FROM simbakda_2019.trh_trpelihara h JOIN simbakda_2019.trd_trpelihara g 
ON h.no_dokumen=g.no_dokumen GROUP BY h.no_dokumen) 
AND (a.no_spp,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,
b.nilai_rek5 AS nilai FROM simbakda_2019.trdkiba_kap b )
AND (a.no_spp,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,
b.nilai_rek5 AS nilai FROM simbakda_2019.trdkibb_kap b )
AND (a.no_spp,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,
b.nilai_rek5 AS nilai FROM simbakda_2019.trdkibc_kap b )
AND (a.no_spp,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,
b.nilai_rek5 AS nilai FROM simbakda_2019.trdkibd_kap b )
AND (a.no_spp,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,
b.nilai_rek5 AS nilai FROM simbakda_2019.trdkibd_kap b ) 
ORDER BY kd_skpd,no_kontrak,tgl_bukti";   
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'kd_skpd'       => $resulte['kd_skpd'],
                        'no_kontrak'    => $resulte['no_kontrak'],
                        'nkontrak'      => $resulte['nkontrak'],
                        'nkontrak2'     => number_format($resulte['nkontrak'],2,'.',','),
                        'no_sp2d'       => $resulte['no_sp2d'],
                        'nilai2'        => number_format($resulte['nilai'],2,'.',','),
                        'nilai'         => $resulte['nilai'],
                        'no_spp'        => $resulte['no_spp'],
                        'kd_kegiatan'   => $resulte['kd_kegiatan'],
                        'kd_rek5'       => $resulte['kd_rek5'],
                        'nm_kegiatan'   => $resulte['nm_kegiatan'],
                        'nm_rek5'       => $resulte['nm_rek5'],
                        'keterangan'    => $resulte['keterangan'],
                        'nilai_ubah'    => number_format($resulte['nilai_ubah'],2,'.',','),
                        'tgl_bukti'     => $resulte['tgl_bukti'],
                        'jns_spp'       => $resulte['jns_spp'],
                        'kode'       => $resulte['kode'],
                        'nmrekan'       => $resulte['nmrekan']
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
    }

    function ambil_nomor_kontrak_522() { 
    $dbsimakda=$this->load->database('simakda', TRUE);
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        
        $skpd       = $this->session->userdata('skpd');
        $oto        = $this->session->userdata('otori');
        $lccr = $this->input->post('q');
        $where2a='';$where2b='';$where2c='';
        $where1 = '';       
        if($oto == '01' && $skpd=='1.20.05.01'){ 
            $where1 = " a.kd_skpd like '%' and ";
        }else if($oto=='01' && $skpd<>'1.20.05.01'){
            $where1 = " a.kd_skpd ='$skpd' and ";
        }else if($oto=='02' && $skpd<>'1.20.05.01'){
            $where1 = " a.kd_skpd ='$skpd' and ";
        }else if($oto=='02' && $skpd=='1.20.05.01'){
            $where1 = " a.kd_skpd like '%' and ";
        }       
          
        
        if($lccr <> ''){
            $where2a =" and (UPPER(a.no_kontrak) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2b =" and (UPPER(a.no_bukti) LIKE UPPER('%$lccr%') or UPPER(a.ket) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%'))";
            $where2c =" and (UPPER(c.no_sp2d) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
        }
        $dbsimbakda = "simbakda_MAPPI";
        
        $sql       ="SELECT c.jns_spp,a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,IFNULL(e.nkontrak,0)AS nkontrak,b.nilai AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan,
            d.nilai_ubah-
            ((SELECT IFNULL(SUM(g.total),0) FROM $dbsimbakda.trd_isianbrg g JOIN $dbsimbakda.trh_isianbrg h
            ON g.no_bukti=h.no_bukti AND h.no_dokumen=g.no_dokumen WHERE g.kd_uskpd=a.kd_skpd 
            AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek5=b.kd_rek5)+
            (SELECT IFNULL(SUM(g.biaya_pelihara),0) FROM $dbsimbakda.trd_trpelihara g JOIN $dbsimbakda.trh_trpelihara h ON g.no_dokumen=h.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek=b.kd_rek5)) AS nilai_ubah 
            FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
            LEFT JOIN trdrka d ON a.kd_skpd=d.kd_skpd AND b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
            WHERE $where1 a.no_kontrak!='' AND b.kd_rek5 IN ('5222101','5222102','5222103') AND a.jns_spp IN ('5','6') 
            AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek5,IFNULL(SUM(g.total),0)AS nilai FROM $dbsimbakda.trh_isianbrg h JOIN $dbsimbakda.trd_isianbrg g ON h.no_bukti=g.no_bukti AND h.no_dokumen=g.no_dokumen GROUP BY h.no_bukti,h.no_dokumen)
            AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek,IFNULL(SUM(g.biaya_pelihara),0)AS nilai FROM $dbsimbakda.trh_trpelihara h JOIN $dbsimbakda.trd_trpelihara g ON h.no_dokumen=g.no_dokumen GROUP BY h.no_dokumen) 
            AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkiba_kap b )
            AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibb_kap b )
            AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibc_kap b )
            AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibd_kap b )
            AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibg_kap b ) $where2a
            UNION ALL
            SELECT a.jns_spp,a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,CAST(0 AS DECIMAL(18,2))AS nkontrak,b.nilai AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan,
            d.nilai_ubah-((SELECT IFNULL(SUM(g.total),0) FROM $dbsimbakda.trd_isianbrg g JOIN $dbsimbakda.trh_isianbrg h ON g.no_bukti=h.no_bukti AND h.no_dokumen=g.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek5=b.kd_rek5)+
            (SELECT IFNULL(SUM(g.biaya_pelihara),0) FROM $dbsimbakda.trd_trpelihara g JOIN $dbsimbakda.trh_trpelihara h ON g.no_dokumen=h.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek=b.kd_rek5)) AS nilai_ubah 
            FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON a.kd_skpd=d.kd_skpd AND b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
            WHERE $where1 b.kd_rek5 IN ('5222101','5222102','5222103') AND a.jns_spp IN ('1','2','3','7') 
            AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
            (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek5,IFNULL(SUM(g.total),0)AS nilai FROM $dbsimbakda.trh_isianbrg h JOIN $dbsimbakda.trd_isianbrg g ON h.no_bukti=g.no_bukti AND h.no_dokumen=g.no_dokumen GROUP BY  h.no_bukti,h.no_dokumen)
            AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek,IFNULL(SUM(g.biaya_pelihara),0)AS nilai FROM $dbsimbakda.trh_trpelihara h JOIN $dbsimbakda.trd_trpelihara g ON h.no_dokumen=g.no_dokumen GROUP BY h.no_dokumen)
            AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkiba_kap b )
            AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibb_kap b )
            AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibc_kap b )
            AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibd_kap b )
            AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibg_kap b ) $where2b
            UNION ALL
            SELECT c.jns_spp,a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,CAST(0 AS DECIMAL(18,2))AS nkontrak,b.nilai AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan,
            d.nilai_ubah-((SELECT IFNULL(SUM(g.total),0) FROM $dbsimbakda.trd_isianbrg g JOIN $dbsimbakda.trh_isianbrg h ON g.no_bukti=h.no_bukti AND h.no_bukti=g.no_bukti AND h.no_dokumen=g.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek5=b.kd_rek5)+
            (SELECT IFNULL(SUM(g.biaya_pelihara),0) FROM $dbsimbakda.trd_trpelihara g JOIN $dbsimbakda.trh_trpelihara h ON g.no_dokumen=h.no_dokumen WHERE g.kd_uskpd=a.kd_skpd AND g.kd_kegiatan=b.kd_kegiatan AND g.kd_rek=b.kd_rek5)) AS nilai_ubah 
            FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
            LEFT JOIN trdrka d ON a.kd_skpd=d.kd_skpd AND b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
            WHERE $where1 a.no_kontrak='' AND b.kd_rek5 IN ('5222101','5222102','5222103') AND a.jns_spp IN ('5','6') 
            AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek5,IFNULL(SUM(g.total),0)AS nilai FROM $dbsimbakda.trh_isianbrg h JOIN $dbsimbakda.trd_isianbrg g ON h.no_bukti=g.no_bukti AND h.no_dokumen=g.no_dokumen GROUP BY h.no_bukti,h.no_dokumen)
            AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT h.no_dokumen,g.kd_kegiatan,g.kd_rek,IFNULL(SUM(g.biaya_pelihara),0)AS nilai FROM $dbsimbakda.trh_trpelihara h JOIN $dbsimbakda.trd_trpelihara g ON h.no_dokumen=g.no_dokumen GROUP BY h.no_dokumen) 
            AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkiba_kap b )
            AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibb_kap b )
            AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibc_kap b )
            AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibd_kap b )
            AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT b.no_dokumen,b.kd_kegiatan,b.kd_rek5,b.nilai_rek5 as nilai FROM $dbsimbakda.trdkibg_kap b ) $where2c
            
            ORDER BY kd_skpd,no_kontrak,tgl_bukti";
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'kd_skpd'       => $resulte['kd_skpd'],
                        'no_kontrak'    => $resulte['no_kontrak'],
                        'nkontrak'      => $resulte['nkontrak'],
                        'nkontrak2'     => number_format($resulte['nkontrak'],2,'.',','),
                        'no_sp2d'       => $resulte['no_sp2d'],
                        'nilai2'        => number_format($resulte['nilai'],2,'.',','),
                        'nilai'         => $resulte['nilai'],
                        'no_spp'        => $resulte['no_spp'],
                        'kd_kegiatan'   => $resulte['kd_kegiatan'],
                        'kd_rek5'       => $resulte['kd_rek5'],
                        'nm_kegiatan'   => $resulte['nm_kegiatan'],
                        'nm_rek5'       => $resulte['nm_rek5'],
                        'keterangan'    => $resulte['keterangan'],
                        'nilai_ubah'    => number_format($resulte['nilai_ubah'],2,'.',','),
                        'tgl_bukti'     => $resulte['tgl_bukti'] 
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
    }


    function ambil_nomor_kontrak_kap_c() { 
        $dbsimakda=$this->load->database('simakda', TRUE);
        $dbsimbakda = "simbakda_biak";
        $skpd       = $this->input->post('skpd');
        $frek       = $this->input->post('frek');
        $jns_trans  = $this->input->post('jns_trans');
        $frek2      = $this->input->post('frek2');
        
        $lccr = $this->input->post('q');
        $where2a='';$where2b='';$where2c='';$where2d='';
        $notin1='';$notin2='';$notin3='';$notin4='';
        $where1 = '';       
              
        $where1 = " a.kd_skpd ='$skpd' and ";  

        if($frek<>''){
            $notin1 = " AND concat(a.no_kontrak,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin2 = " AND concat(a.no_bukti,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin3 = " AND concat(c.no_sp2d,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin4 = " AND concat(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d) not in ($frek2)";
        }
        
        if($lccr <> ''){
            $where2a =" and (UPPER(a.no_kontrak) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2b =" and (UPPER(a.no_bukti) LIKE UPPER('%$lccr%') or UPPER(a.ket) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%'))";
            $where2c =" and (UPPER(c.no_sp2d) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2d =" and (UPPER(a.no_dokumen) LIKE UPPER('%$lccr%') or UPPER(b.keterangan) LIKE UPPER('%$lccr%'))";
        }
        
        if($jns_trans==1){
            $sql ="SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                WHERE a.kd_skpd ='$skpd' AND a.no_kontrak!='' AND LEFT(b.kd_rek5,5)IN ('52324','52326') AND d.nm_kegiatan LIKE '%(pendamping%' AND a.jns_spp IN ('5','6')
                AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibd_kap s WHERE s.kd_skpd='$skpd'
                GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin1 $where2a
                GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                
                UNION ALL
                
                SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                WHERE a.kd_skpd ='$skpd' AND a.no_kontrak='' AND LEFT(b.kd_rek5,5)IN ('52324','52326') AND d.nm_kegiatan LIKE '%(pendamping%' AND a.jns_spp IN ('5','6')
                AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibd_kap s WHERE s.kd_skpd='$skpd'
                GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin3 $where2c
                GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai
                
                UNION ALL
                
                SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                WHERE a.kd_skpd ='$skpd' AND a.no_kontrak!='' AND b.kd_rek5 IN ('5222101','5222102','5222103') AND a.jns_spp IN ('5','6') 
                AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibd_kap s WHERE s.kd_skpd='$skpd'
                GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin1 $where2a
                GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                
                UNION ALL
                
                SELECT a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_bukti,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_bukti,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_bukti,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_bukti,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_bukti,'.',b.kd_rek5)) AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan 
                FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                WHERE a.kd_skpd ='$skpd' AND b.kd_rek5 IN ('5222101','5222102','5222103') AND a.jns_spp IN ('1','2','3','7')
                AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT s.no_dokumen AS no_bukti,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT s.no_dokumen AS no_bukti,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibd_kap s WHERE s.kd_skpd='$skpd'
                GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin2 $where2b
                
                UNION ALL
                
                SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                WHERE a.kd_skpd ='$skpd' AND a.no_kontrak='' AND b.kd_rek5 IN ('5222101','5222102','5222103') AND a.jns_spp IN ('5','6')
                AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibd_kap s WHERE s.kd_skpd='$skpd'
                GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin3 $where2c
                GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai

                UNION ALL
                
                SELECT a.kd_uskpd AS kd_skpd,a.no_dokumen AS no_kontrak,a.tgl_dokumen AS tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai_sp2d
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))AS nilai
                ,b.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,b.keterangan
                FROM $dbsimbakda.trd_isianbrg b JOIN $dbsimbakda.trh_isianbrg a ON a.no_bukti=b.no_bukti AND a.no_dokumen=b.no_dokumen
                WHERE status_kdp='L' AND a.kd_uskpd='$skpd' AND LEFT(b.kd_brg,2)='03' AND LEFT(b.kd_rek5,5)IN ('52324','52326') $notin4 $where2d
                
                UNION ALL
                
                SELECT a.kd_uskpd AS kd_skpd,a.no_dokumen AS no_kontrak,a.tgl_dokumen AS tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai_sp2d
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))AS nilai
                ,b.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,b.keterangan
                FROM $dbsimbakda.trd_isianbrg b JOIN $dbsimbakda.trh_isianbrg a ON a.no_bukti=b.no_bukti AND a.no_dokumen=b.no_dokumen
                WHERE status_kdp='L' AND a.kd_uskpd='$skpd' AND LEFT(b.kd_brg,2)='03' AND b.kd_rek5 IN ('5222101','5222102','5222103') $notin4 $where2d
                ORDER BY no_kontrak,tgl_bukti";
        }else{
            $sql = "SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                WHERE a.kd_skpd ='$skpd' AND a.no_kontrak!='' AND b.kd_rek5 IN ('5222003','5222012','5222018') AND a.jns_spp IN ('5','6') $notin1 $where2a
                GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                
                UNION ALL
                
                SELECT a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_bukti,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_bukti,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_bukti,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_bukti,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_bukti,'.',b.kd_rek5)) AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan 
                FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                WHERE a.kd_skpd ='$skpd' AND b.kd_rek5 IN ('5222003','5222012','5222018') AND a.jns_spp IN ('1','2','3','7') $notin2 $where2b
                
                UNION ALL
                
                SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                WHERE a.kd_skpd ='$skpd' AND a.no_kontrak='' AND b.kd_rek5 IN ('5222003','5222012','5222018') AND a.jns_spp IN ('5','6') $notin3 $where2c
                GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai
                ORDER BY no_kontrak,tgl_bukti";
        }
        
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'kd_skpd'       => $resulte['kd_skpd'],
                        'no_kontrak'    => $resulte['no_kontrak'],
                        'no_sp2d'       => $resulte['no_sp2d'],
                        'nilai2'        => number_format($resulte['nilai'],2,'.',','),
                        'nilai'         => $resulte['nilai'],
                        'no_spp'        => $resulte['no_spp'],
                        'kd_kegiatan'   => $resulte['kd_kegiatan'],
                        'kd_rek5'       => $resulte['kd_rek5'],
                        'nm_kegiatan'   => $resulte['nm_kegiatan'],
                        'nm_rek5'       => $resulte['nm_rek5'],
                        'keterangan'    => $resulte['keterangan'],
                        
                        'tgl_bukti'     => $resulte['tgl_bukti'] 
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        
    }

    function ambil_nomor_kontrak_kap_b() { 
        $dbsimakda=$this->load->database('simakda', TRUE);
        $dbsimbakda = "simbakda_biak";
        $skpd       = $this->input->post('skpd');
        $frek       = $this->input->post('frek');
        $frek2      = $this->input->post('frek2');
        $jns_trans  = $this->input->post('jns_trans');
        $lccr = $this->input->post('q');
        $where2a='';$where2b='';$where2c='';$where2d='';
        $notin1='';$notin2='';$notin3='';$notin4='';
        $where1 = '';       
              
        $where1 = " a.kd_skpd ='$skpd' and ";  

        if($frek<>''){
            $notin1 = " AND concat(a.no_kontrak,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin2 = " AND concat(a.no_bukti,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin3 = " AND concat(c.no_sp2d,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin4 = " AND concat(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d) not in ($frek2)";
        }
        
        if($lccr <> ''){
            $where2a =" and (UPPER(a.no_kontrak) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2b =" and (UPPER(a.no_bukti) LIKE UPPER('%$lccr%') or UPPER(a.ket) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%'))";
            $where2c =" and (UPPER(c.no_sp2d) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2d =" and (UPPER(a.no_dokumen) LIKE UPPER('%$lccr%') or UPPER(b.keterangan) LIKE UPPER('%$lccr%'))";
        }
        if($jns_trans==1){
            $sql  ="SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE a.kd_skpd ='$skpd' AND a.no_kontrak!='' AND LEFT(b.kd_rek5,5) IN ('52302','52303','52304','52305','52308','52309','52310','52311','52312','52313','52314','52315','52316','52317','52318','52319','52320')
                    AND a.jns_spp IN ('5','6') AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibb_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin1 $where2a
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    
                    UNION ALL
                    
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE a.kd_skpd ='$skpd' AND a.no_kontrak='' AND LEFT(b.kd_rek5,5) IN ('52302','52303','52304','52305','52308','52309','52310','52311','52312','52313','52314','52315','52316','52317','52318','52319','52320')
                    AND a.jns_spp IN ('5','6') AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibb_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin3 $where2c
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai
                    
                    UNION ALL
                    
                    SELECT a.kd_uskpd AS kd_skpd,a.no_dokumen AS no_kontrak,a.tgl_dokumen AS tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai_sp2d
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))AS nilai
                    ,b.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,b.keterangan
                    FROM $dbsimbakda.trd_isianbrg b JOIN $dbsimbakda.trh_isianbrg a ON a.no_bukti=b.no_bukti AND a.no_dokumen=b.no_dokumen
                    WHERE status_kdp='L' AND a.kd_uskpd='$skpd' AND LEFT(b.kd_brg,2)='02' 
                    AND LEFT(b.kd_rek5,5) IN ('52302','52303','52304','52305','52308','52309','52310','52311','52312','52313','52314','52315','52316','52317','52318','52319','52320') $notin4 $where2d
                    ORDER BY kd_skpd,no_kontrak,tgl_bukti";
        }else{
            $sql   ="SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE $where1 a.no_kontrak!='' AND b.kd_rek5 IN ('5222005','5222006','5222016','5222010','5222014','5222007','5222008','5222009') AND a.jns_spp IN ('5','6') $notin1 $where2a
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    
                    UNION ALL
                    
                    SELECT a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5)) AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan 
                    FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                    WHERE $where1 b.kd_rek5 IN ('5222005','5222006','5222016','5222010','5222014','5222007','5222008','5222009') AND a.jns_spp IN ('1','2','3','7') $notin2 $where2b 
                    
                    UNION ALL
                    
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE $where1 a.no_kontrak='' AND b.kd_rek5 IN ('5222005','5222006','5222016','5222010','5222014','5222007','5222008','5222009') AND a.jns_spp IN ('5','6') $notin3 $where2c
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai
                    ORDER BY kd_skpd,no_kontrak,tgl_bukti";
        }
        
        
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'kd_skpd'       => $resulte['kd_skpd'],
                        'no_kontrak'    => $resulte['no_kontrak'],
                        'no_sp2d'       => $resulte['no_sp2d'],
                        'nilai2'        => number_format($resulte['nilai'],2,'.',','),
                        'nilai'         => $resulte['nilai'],
                        'no_spp'        => $resulte['no_spp'],
                        'kd_kegiatan'   => $resulte['kd_kegiatan'],
                        'kd_rek5'       => $resulte['kd_rek5'],
                        'nm_kegiatan'   => $resulte['nm_kegiatan'],
                        'nm_rek5'       => $resulte['nm_rek5'],
                        'keterangan'    => $resulte['keterangan'],
                        
                        'tgl_bukti'     => $resulte['tgl_bukti'] 
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        
    }

    function ambil_nomor_kontrak_kap_d() { 
        $dbsimakda=$this->load->database('simakda', TRUE);
        $dbsimbakda = "simbakda_biak";
        $skpd       = $this->input->post('skpd');
        $frek       = $this->input->post('frek');
        $jns_trans  = $this->input->post('jns_trans');
        $frek2      = $this->input->post('frek2');
        
        $lccr = $this->input->post('q');
        $where2a='';$where2b='';$where2c='';$where2d='';
        $notin1='';$notin2='';$notin3='';$notin4='';
        $where1 = '';       
              
        $where1 = " a.kd_skpd ='$skpd' and ";  

        if($frek<>''){
            $notin1 = " AND concat(a.no_kontrak,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin2 = " AND concat(a.no_bukti,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin3 = " AND concat(c.no_sp2d,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin4 = " AND concat(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d) not in ($frek2)";
        }
        
        if($lccr <> ''){
            $where2a =" and (UPPER(a.no_kontrak) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2b =" and (UPPER(a.no_bukti) LIKE UPPER('%$lccr%') or UPPER(a.ket) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%'))";
            $where2c =" and (UPPER(c.no_sp2d) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2d =" and (UPPER(a.no_dokumen) LIKE UPPER('%$lccr%') or UPPER(b.keterangan) LIKE UPPER('%$lccr%'))";
        }
        
        if($jns_trans==1){
            $sql="SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE a.kd_skpd ='$skpd' and a.no_kontrak!='' AND b.kd_rek5 IN ('5222101','5222102','5222103') AND a.jns_spp IN ('5','6') 
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibc_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin1 $where2a
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    
                    UNION ALL
                    
                    SELECT a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5)) AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan 
                    FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                    WHERE a.kd_skpd ='$skpd' and b.kd_rek5 IN ('5222101','5222102','5222103') AND a.jns_spp IN ('1','2','3','7')
                    AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_bukti,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_bukti,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibc_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin2 $where2b 
                    
                    UNION ALL
                    
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE a.kd_skpd ='$skpd' and a.no_kontrak='' AND b.kd_rek5 IN ('5222101','5222102','5222103') AND a.jns_spp IN ('5','6')
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibc_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin3 $where2c
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai

                    UNION ALL
                    
                    SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE a.kd_skpd ='$skpd' and a.no_kontrak!='' AND LEFT(b.kd_rek5,5)IN ('52321','52322','52323') AND d.nm_kegiatan LIKE '%(pendamping%' AND a.jns_spp IN ('5','6') 
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibc_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin1 $where2a
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    
                    UNION ALL
                    
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE a.kd_skpd ='$skpd' and a.no_kontrak='' AND LEFT(b.kd_rek5,5)IN ('52321','52322','52323') AND d.nm_kegiatan LIKE '%(pendamping%' AND a.jns_spp IN ('5','6')
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibc_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin3 $where2c
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai
                    
                    UNION ALL
                    
                    SELECT a.kd_uskpd AS kd_skpd,a.no_dokumen AS no_kontrak,a.tgl_dokumen AS tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai_sp2d
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))AS nilai
                    ,b.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,b.keterangan
                    FROM $dbsimbakda.trd_isianbrg b JOIN $dbsimbakda.trh_isianbrg a ON a.no_bukti=b.no_bukti AND a.no_dokumen=b.no_dokumen
                    WHERE status_kdp='L' AND a.kd_uskpd='$skpd' AND LEFT(b.kd_brg,2)='04' AND LEFT(b.kd_rek5,5) IN ('52321','52322','52323') $notin4 $where2d
                    
                    UNION ALL
                    
                    SELECT a.kd_uskpd AS kd_skpd,a.no_dokumen AS no_kontrak,a.tgl_dokumen AS tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai_sp2d
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))AS nilai
                    ,b.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,b.keterangan
                    FROM $dbsimbakda.trd_isianbrg b JOIN $dbsimbakda.trh_isianbrg a ON a.no_bukti=b.no_bukti AND a.no_dokumen=b.no_dokumen
                    WHERE status_kdp='L' AND a.kd_uskpd='$skpd' AND LEFT(b.kd_brg,2)='04' AND b.kd_rek5 IN ('5222101','5222102','5222103') $notin4 $where2d
                    ORDER BY kd_skpd,no_kontrak,tgl_bukti";
        }else{
            $sql   ="SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE $where1 a.no_kontrak!='' AND b.kd_rek5 IN ('5222011','5222015','5222020') AND a.jns_spp IN ('5','6') $notin1 $where2a
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    UNION ALL
                    SELECT a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5)) AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan 
                    FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                    WHERE $where1 b.kd_rek5 IN ('5222011','5222015','5222020') AND a.jns_spp IN ('1','2','3','7') $notin2 $where2b 
                    UNION ALL
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE $where1 a.no_kontrak='' AND b.kd_rek5 IN ('5222011','5222015','5222020') AND a.jns_spp IN ('5','6') $notin3 $where2c
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai

                    ORDER BY kd_skpd,no_kontrak,tgl_bukti";
        }
        
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'kd_skpd'       => $resulte['kd_skpd'],
                        'no_kontrak'    => $resulte['no_kontrak'],
                        'no_sp2d'       => $resulte['no_sp2d'],
                        'nilai2'        => number_format($resulte['nilai'],2,'.',','),
                        'nilai'         => $resulte['nilai'],
                        'no_spp'        => $resulte['no_spp'],
                        'kd_kegiatan'   => $resulte['kd_kegiatan'],
                        'kd_rek5'       => $resulte['kd_rek5'],
                        'nm_kegiatan'   => $resulte['nm_kegiatan'],
                        'nm_rek5'       => $resulte['nm_rek5'],
                        'keterangan'    => $resulte['keterangan'],
                        'tgl_bukti'     => $resulte['tgl_bukti'] 
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        
    }


    function ambil_nomor_kontrak_kap_g() { 
        $dbsimakda=$this->load->database('simakda', TRUE);
        $dbsimbakda = "simbakda_biak";
        $skpd       = $this->input->post('skpd');
        $frek       = $this->input->post('frek');
        $jns_trans  = $this->input->post('jns_trans');
        $frek2      = $this->input->post('frek2');
        
        $lccr = $this->input->post('q');
        $where2a='';$where2b='';$where2c='';$where2d='';
        $notin1='';$notin2='';$notin3='';$notin4='';
        $where1 = '';       
              
        $where1 = " a.kd_skpd ='$skpd' and ";  

        if($frek<>''){
            $notin1 = " AND concat(a.no_kontrak,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin2 = " AND concat(a.no_bukti,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin3 = " AND concat(c.no_sp2d,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin4 = " AND concat(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d) not in ($frek2)";
        }
        
        if($lccr <> ''){
            $where2a =" and (UPPER(a.no_kontrak) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2b =" and (UPPER(a.no_bukti) LIKE UPPER('%$lccr%') or UPPER(a.ket) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%'))";
            $where2c =" and (UPPER(c.no_sp2d) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2d =" and (UPPER(a.no_dokumen) LIKE UPPER('%$lccr%') or UPPER(b.keterangan) LIKE UPPER('%$lccr%'))";
        }
        
        if($jns_trans==1){
            $sql="SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE $where1 a.no_kontrak!='' AND b.kd_rek5 IN ('5234001') AND a.jns_spp IN ('5','6') 
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibg_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin1 $where2a
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    UNION ALL
                    SELECT a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5)) AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan 
                    FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                    WHERE $where1 b.kd_rek5 IN ('5234001') AND a.jns_spp IN ('1','2','3','7')

                    AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_bukti,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_bukti,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibg_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin2 $where2b 
                    UNION ALL
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE $where1 a.no_kontrak='' AND b.kd_rek5 IN ('5234001') AND a.jns_spp IN ('5','6')
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibg_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin3 $where2c
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai

                    UNION ALL
                    SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE $where1 a.no_kontrak!='' AND LEFT(b.kd_rek5,5)IN ('52340') AND d.nm_kegiatan LIKE '%(pendamping%' AND a.jns_spp IN ('5','6') 
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibg_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin1 $where2a
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    UNION ALL
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE $where1 a.no_kontrak='' AND LEFT(b.kd_rek5,5)IN ('52340') AND d.nm_kegiatan LIKE '%(pendamping%' AND a.jns_spp IN ('5','6')
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibg_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin3 $where2c
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai
                    UNION ALL
                    SELECT a.kd_uskpd AS kd_skpd,a.no_dokumen AS no_kontrak,a.tgl_dokumen AS tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai_sp2d
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))AS nilai
                    ,b.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,b.keterangan
                    FROM $dbsimbakda.trd_isianbrg b JOIN $dbsimbakda.trh_isianbrg a ON a.no_bukti=b.no_bukti AND a.no_dokumen=b.no_dokumen
                    WHERE status_kdp='L' AND a.kd_uskpd='$skpd' AND LEFT(b.kd_brg,2)='07' AND b.kd_rek5 IN ('5234001') $notin4 $where2d

                    ORDER BY kd_skpd,no_kontrak,tgl_bukti";
        }else{
            $sql   ="SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE $where1 a.no_kontrak!='' AND b.kd_rek5 IN ('5222011','5222015','5222020') AND a.jns_spp IN ('5','6') $notin1 $where2a
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    UNION ALL
                    SELECT a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5)) AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan 
                    FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                    WHERE $where1 b.kd_rek5 IN ('5222011','5222015','5222020') AND a.jns_spp IN ('1','2','3','7') $notin2 $where2b 
                    UNION ALL
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE $where1 a.no_kontrak='' AND b.kd_rek5 IN ('5222011','5222015','5222020') AND a.jns_spp IN ('5','6') $notin3 $where2c
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai

                    ORDER BY kd_skpd,no_kontrak,tgl_bukti";
        }
        
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'kd_skpd'       => $resulte['kd_skpd'],
                        'no_kontrak'    => $resulte['no_kontrak'],
                        'no_sp2d'       => $resulte['no_sp2d'],
                        'nilai2'        => number_format($resulte['nilai'],2,'.',','),
                        'nilai'         => $resulte['nilai'],
                        'no_spp'        => $resulte['no_spp'],
                        'kd_kegiatan'   => $resulte['kd_kegiatan'],
                        'kd_rek5'       => $resulte['kd_rek5'],
                        'nm_kegiatan'   => $resulte['nm_kegiatan'],
                        'nm_rek5'       => $resulte['nm_rek5'],
                        'keterangan'    => $resulte['keterangan'],
                        
                        'tgl_bukti'     => $resulte['tgl_bukti'] 
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        
    }


    function ambil_nomor_kontrak_kap_a() { 
        $dbsimakda=$this->load->database('simakda', TRUE);
        $dbsimbakda = "simbakda_biak";
        $skpd       = $this->input->post('skpd');
        $frek       = $this->input->post('frek');
        $jns_trans  = $this->input->post('jns_trans');
        $frek2      = $this->input->post('frek2');
        
        $lccr = $this->input->post('q');
        $where2a='';$where2b='';$where2c='';$where2d='';
        $notin1='';$notin2='';$notin3='';$notin4='';
        $where1 = '';       
              
        $where1 = " a.kd_skpd ='$skpd' and ";  

        if($frek<>''){
            $notin1 = " AND concat(a.no_kontrak,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin2 = " AND concat(a.no_bukti,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin3 = " AND concat(c.no_sp2d,'.',b.kd_rek5,'.',b.nilai) not in ($frek2)";
            $notin4 = " AND concat(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d) not in ($frek2)";
        }
        
        if($lccr <> ''){
            $where2a =" and (UPPER(a.no_kontrak) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2b =" and (UPPER(a.no_bukti) LIKE UPPER('%$lccr%') or UPPER(a.ket) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%'))";
            $where2c =" and (UPPER(c.no_sp2d) LIKE UPPER('%$lccr%') or UPPER(a.keperluan) LIKE UPPER('%$lccr%') or UPPER(d.nm_skpd) LIKE UPPER('%$lccr%')) ";
            $where2d =" and (UPPER(a.no_dokumen) LIKE UPPER('%$lccr%') or UPPER(b.keterangan) LIKE UPPER('%$lccr%'))";
        }
        
        if($jns_trans==1){
            $sql="SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE $where1 a.no_kontrak!='' AND LEFT(b.kd_rek5,5) IN ('52301') AND a.jns_spp IN ('5','6') 
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibc_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin1 $where2a
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    
                    UNION ALL
                    
                    SELECT a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5)) AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan 
                    FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                    WHERE $where1 LEFT(b.kd_rek5,5) IN ('52301') AND a.jns_spp IN ('1','2','3','7')
                    AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_bukti,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (a.no_bukti,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_bukti,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibc_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin2 $where2b 
                    
                    UNION ALL
                    
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE $where1 a.no_kontrak='' AND LEFT(b.kd_rek5,5) IN ('52301') AND a.jns_spp IN ('5','6')
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibc_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin3 $where2c
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai

                    UNION ALL
                    
                    SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE $where1 a.no_kontrak!='' AND LEFT(b.kd_rek5,5) IN ('52301') AND d.nm_kegiatan LIKE '%(pendamping%' AND a.jns_spp IN ('5','6') 
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s WHERE s.kd_uskpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_kontrak,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibc_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin1 $where2a
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    
                    UNION ALL
                    
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE $where1 a.no_kontrak='' AND LEFT(b.kd_rek5,5) IN ('52301') AND d.nm_kegiatan LIKE '%(pendamping%' AND a.jns_spp IN ('5','6')
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.total),0)AS nilai FROM $dbsimbakda.trd_isianbrg s GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5,s.nilai_sp2d)
                    AND (c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai) NOT IN 
                    (SELECT s.no_dokumen AS no_sp2d,s.kd_kegiatan,s.kd_rek5,IFNULL(SUM(s.nilai_kap),0)AS nilai FROM $dbsimbakda.trdkibc_kap s WHERE s.kd_skpd='$skpd'
                    GROUP BY s.no_dokumen,s.kd_kegiatan,s.kd_rek5) $notin3 $where2c
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai
                    
                    UNION ALL
                    
                    SELECT a.kd_uskpd AS kd_skpd,a.no_dokumen AS no_kontrak,a.tgl_dokumen AS tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai_sp2d
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5,'.',v.nilai_rek5)=CONCAT(a.no_dokumen,'.',b.kd_rek5,'.',b.nilai_sp2d))AS nilai
                    ,b.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,b.keterangan
                    FROM $dbsimbakda.trd_isianbrg b JOIN $dbsimbakda.trh_isianbrg a ON a.no_bukti=b.no_bukti AND a.no_dokumen=b.no_dokumen
                    WHERE status_kdp='L' AND a.kd_uskpd='$skpd' AND LEFT(b.kd_brg,2)='01' AND LEFT(b.kd_rek5,5) IN ('52301') $notin4 $where2d
                    ORDER BY kd_skpd,no_kontrak,tgl_bukti";
        }else{
            $sql   ="SELECT a.kd_skpd,a.no_kontrak,e.tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=CONCAT(a.no_kontrak,'.',b.kd_rek5)) AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 LEFT JOIN trhtagih e ON a.no_tagih=e.no_bukti
                    WHERE $where1 a.no_kontrak!='' AND b.kd_rek5 IN ('5222011','5222015','5222020') AND a.jns_spp IN ('5','6') $notin1 $where2a
                    GROUP BY a.no_kontrak,b.kd_kegiatan,b.kd_rek5,b.nilai
                    UNION ALL
                    SELECT a.kd_skpd,a.no_bukti AS no_kontrak,a.tgl_bukti,''AS no_spp,b.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(a.no_bukti,'.',b.kd_rek5)) AS nilai,d.kd_kegiatan,b.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.ket AS keterangan 
                    FROM trhtransout a JOIN trdtransout b ON a.no_bukti=b.no_bukti LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5
                    WHERE $where1 b.kd_rek5 IN ('5222011','5222015','5222020') AND a.jns_spp IN ('1','2','3','7') $notin2 $where2b 
                    UNION ALL
                    SELECT a.kd_skpd,c.no_sp2d AS no_kontrak,c.tgl_sp2d AS tgl_bukti,a.no_spp,c.no_sp2d,b.nilai
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkiba_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibb_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibc_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibd_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))
                    -(SELECT IFNULL(SUM(v.nilai_kap),0) FROM $dbsimbakda.trdkibg_kap v WHERE CONCAT(v.no_dokumen,'.',v.kd_rek5)=concat(c.no_sp2d,'.',b.kd_rek5))AS nilai,b.kd_kegiatan,d.nm_kegiatan,b.kd_rek5,b.nm_rek5,a.keperluan AS keterangan 
                    FROM trhspp a JOIN trdspp b ON a.no_spp=b.no_spp JOIN trhsp2d c ON a.no_spp=c.no_spp 
                    LEFT JOIN trdrka d ON b.kd_kegiatan=d.kd_kegiatan AND b.kd_rek5=d.kd_rek5 
                    WHERE $where1 a.no_kontrak='' AND b.kd_rek5 IN ('5222011','5222015','5222020') AND a.jns_spp IN ('5','6') $notin3 $where2c
                    GROUP BY c.no_sp2d,b.kd_kegiatan,b.kd_rek5,b.nilai

                    ORDER BY kd_skpd,no_kontrak,tgl_bukti";
        }
        
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'kd_skpd'       => $resulte['kd_skpd'],
                        'no_kontrak'    => $resulte['no_kontrak'],
                        'no_sp2d'       => $resulte['no_sp2d'],
                        'nilai2'        => number_format($resulte['nilai'],2,'.',','),
                        'nilai'         => $resulte['nilai'],
                        'no_spp'        => $resulte['no_spp'],
                        'kd_kegiatan'   => $resulte['kd_kegiatan'],
                        'kd_rek5'       => $resulte['kd_rek5'],
                        'nm_kegiatan'   => $resulte['nm_kegiatan'],
                        'nm_rek5'       => $resulte['nm_rek5'],
                        'keterangan'    => $resulte['keterangan'],
                        
                        'tgl_bukti'     => $resulte['tgl_bukti'] 
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        
    }

    function ambil_rekening() { 
    $dbsimakda=$this->load->database('simakda', TRUE);
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        
        $skpd       = $this->session->userdata('skpd');
        $oto        = $this->session->userdata('otori');
 
        $where1 = '';       
        if($oto == '01'){ 
            $where1 = " a.kd_skpd like '%' and ";
        }else{
            $where1 = " a.kd_skpd ='$skpd' and ";
        }       
        $keg= $this->input->post('keg');  
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 =" and UPPER(nm_rek5) LIKE UPPER('%$lccr%') ";
        }
        
        $sql    = "SELECT * FROM trdrka WHERE kd_kegiatan='$keg' and LEFT(kd_rek5,3)='523'";
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'        => $ii,
                        'kd_rek5'   => $resulte['kd_rek5'],
                        'nm_rek5'   => $resulte['nm_rek5']        
                        
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
    }
	
	/*****import export data****/
	 function import_data_kib()
	{
        $config['upload_path'] = FCPATH.'/upload/';
		$config['allowed_types'] = 'xls';
        $config['max_size'] = '100000';
        $config['file_name'] = 'upload' . time();

		$this->load->library('upload', $config);
          
		if ( ! $this->upload->do_upload())
		{
			$data = array('error' => $this->upload->display_errors());
			
		}
		else
		{
            $data = array('error' => false);
			$upload_data = $this->upload->data();
            
            $this->load->library('excel_reader');
			$this->excel_reader->setOutputEncoding('CP1251');
        //    $this->excel_reader->setOutputEncoding('230787');
			$file = $upload_data['full_path'];
			$this->excel_reader->read($file);
			error_reporting(E_ALL ^ E_NOTICE);

			// Sheet 1
			$data = $this->excel_reader->sheets[0] ;
         
            $dataexcel = Array();
			for ($i = 1; $i <= $data['numRows']; $i++) {
                         if($data['cells'][$i+1][1] == '') break;
								$dataexcel[$i-1]['no_reg'] = $data['cells'][$i+1][1];
								$dataexcel[$i-1]['id_barang'] = $data['cells'][$i+1][2];
								$dataexcel[$i-1]['no'] = $data['cells'][$i+1][3];
								$dataexcel[$i-1]['no_oleh'] = $data['cells'][$i+1][4];
								$dataexcel[$i-1]['tgl_reg'] = $data['cells'][$i+1][5];
								$dataexcel[$i-1]['tgl_oleh'] = $data['cells'][$i+1][6];
								$dataexcel[$i-1]['no_dokumen'] = $data['cells'][$i+1][7];
								$dataexcel[$i-1]['kd_brg'] = $data['cells'][$i+1][8];
								$dataexcel[$i-1]['detail_brg'] = $data['cells'][$i+1][9];
								$dataexcel[$i-1]['kd_tanah'] = $data['cells'][$i+1][10];
								$dataexcel[$i-1]['nilai'] = $data['cells'][$i+1][11];
								$dataexcel[$i-1]['asal'] = $data['cells'][$i+1][12];
								$dataexcel[$i-1]['dsr_peroleh'] = $data['cells'][$i+1][13];
								$dataexcel[$i-1]['total'] = $data['cells'][$i+1][14];
								$dataexcel[$i-1]['kondisi'] = $data['cells'][$i+1][15];
								$dataexcel[$i-1]['konstruksi'] = $data['cells'][$i+1][16];
								$dataexcel[$i-1]['jenis'] = $data['cells'][$i+1][17];
								$dataexcel[$i-1]['bangunan'] = $data['cells'][$i+1][18];
								$dataexcel[$i-1]['luas'] = $data['cells'][$i+1][19];
								$dataexcel[$i-1]['jumlah'] = $data['cells'][$i+1][20];
								$dataexcel[$i-1]['tgl_awal_kerja'] = $data['cells'][$i+1][21];
								$dataexcel[$i-1]['status_tanah'] = $data['cells'][$i+1][22];
								$dataexcel[$i-1]['nilai_kontrak'] = $data['cells'][$i+1][23];
								$dataexcel[$i-1]['alamat1'] = $data['cells'][$i+1][24];
								$dataexcel[$i-1]['alamat2'] = $data['cells'][$i+1][25];
								$dataexcel[$i-1]['alamat3'] = $data['cells'][$i+1][26];
								$dataexcel[$i-1]['no_mutasi'] = $data['cells'][$i+1][27];
								$dataexcel[$i-1]['no_pindah'] = $data['cells'][$i+1][28];
								$dataexcel[$i-1]['no_hapus'] = $data['cells'][$i+1][29];
								$dataexcel[$i-1]['keterangan'] = $data['cells'][$i+1][30];
								$dataexcel[$i-1]['kd_skpd'] = $data['cells'][$i+1][31];
								$dataexcel[$i-1]['kd_unit'] = $data['cells'][$i+1][32];
								$dataexcel[$i-1]['milik'] = $data['cells'][$i+1][33];
								$dataexcel[$i-1]['wilayah'] = $data['cells'][$i+1][34];
								$dataexcel[$i-1]['username'] = $data['cells'][$i+1][35];
								$dataexcel[$i-1]['tgl_update'] = $data['cells'][$i+1][36];
								$dataexcel[$i-1]['tahun'] = $data['cells'][$i+1][37];
								$dataexcel[$i-1]['foto'] = $data['cells'][$i+1][38];
								$dataexcel[$i-1]['foto2'] = $data['cells'][$i+1][39];
								$dataexcel[$i-1]['no_urut'] = $data['cells'][$i+1][40];
								$dataexcel[$i-1]['lat'] = $data['cells'][$i+1][41];
								$dataexcel[$i-1]['lon'] = $data['cells'][$i+1][42];
								$dataexcel[$i-1]['kd_riwayat'] = $data['cells'][$i+1][43];
								$dataexcel[$i-1]['tgl_riwayat'] = $data['cells'][$i+1][44];
								$dataexcel[$i-1]['detail_riwayat'] = $data['cells'][$i+1][45]; 

			}
                     
            unlink($upload_data['full_path']);
            $this->load->model('Exmodel');
            $this->Exmodel->save_kib($dataexcel);
           
		}
      redirect('master/import_data');
   	}
	/************END************/
	/******EXPORT SEND TO MODEL******/
	function export_kib_a(){
	$this->mdata2->export_kib_a();
	}
	function export_kib_b(){
	$this->mdata2->export_kib_b();
	}
	function export_kib_c(){
	$this->mdata2->export_kib_c();
	}
	function export_kib_d(){
	$this->mdata2->export_kib_d();
	}
	function export_kib_e(){
	$this->mdata2->export_kib_e();
	}
	function export_kib_f(){
	$this->mdata2->export_kib_f();
	}
	/******END EXPORT TO MODEL*******/




//==========================================================================
    //untuk user

function muser_new()
    {
        $data['page_title']= 'Master User';
        $this->template->set('title', 'Master User');   
        $this->template->load('index','referensi/new_user',$data) ; 
    }

function load_new_user() {
       
        $result   = array();
        $row      = array();
        $page     = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows     = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset   = ($page-1)*$rows;
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where    = '';
        
        if ($kriteria <> ''){                               
            $where="where upper(a.user_name) like upper('%$kriteria%') or upper(a.nama) like upper('%$kriteria%') or upper(b.nm_skpd) like upper('%$kriteria%') or a.kd_skpd like '%$kriteria%' ";            
        }
             
        $sql    = "SELECT COUNT(*) as tot FROM USER a LEFT JOIN ms_skpd b ON a.kd_skpd=b.kd_skpd $where" ;
        $query1 = $this->db->query($sql);
        $total  = $query1->row();
        
        $sql    = "SELECT a.*,b.nm_skpd FROM user a JOIN ms_skpd b ON a.kd_skpd=b.kd_skpd $where order by a.id_user limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii     = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $row[] = array(
                        'id' => $ii,        
                        'id_user' => $resulte['id_user'],
                        'username' => $resulte['user_name'],
                        'password' => $resulte['password'],
                        'aplikasi' => $resulte['type'],
                        'nickname' => $resulte['nama'],
                        'kdskpd' => $resulte['kd_skpd'],
                        'nmskpd' => $resulte['nm_skpd']
                        );
                        $ii++;
        }
        $result["total"] = $total->tot;
        $result["rows"]  = $row; 
        echo json_encode($result);
    }

    function yatidak() {
        $result[] = array('status' => 'YA');
        $result[] = array('status' => 'TIDAK');                       
        echo json_encode($result);         
    }

function simpan_otorisasi_new(){
        $tet        =$this->input->post('vids');    
        $idx        =$this->input->post('idx'); 
        $tt         =$this->input->post('tt');  
        $sta        =trim($this->input->post('st'));    
        
        if ($sta=='YA'){
            $statue='1';
        }else{
             $statue='0';
        };
        
        $sql="select menu_id FROM otori where user_id='$tet' and menu_id='$idx'  ";
        $query1 = $this->db->query($sql);

        if ($query1->num_rows()>0){
           $this->db->query("update otori set akses='$statue' where menu_id='$idx' and user_id='$tet'");
        }else{
           $this->db->query("insert into otori(user_id,menu_id,akses) values ('$tet','$idx','$statue')");
        }

    }

    function load_otorisasi_new() {
        
       // $test= $this->uri->segment(3);
        $test= $this->input->post('idus');
        $find= $this->input->post('cari');
        $result = array();
        $row = array();
        $coba= array();
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;   
        $where='';
        $where1='';
        if($find <> ''){
            $where="and upper(title) like upper('%$find%')";
            $where1="where (upper(a.title) like upper('%$find%') or a.id like '%$find%')";
        }
        
        $sql="select count(*) as tot FROM dyn_menu where page_id<>'0' $where ";
        $query1 = $this->db->query($sql);
        $trh = $query1->row();

        //$sql = "SELECT a.id as idx,a.title as title, IF(b.akses=1,'YA','TIDAK') AS status FROM dyn_menu a JOIN otori b ON b.menu_id=a.id $where1 AND user_id=$test ORDER BY a.id limit $offset,$rows  ";
        $sql = "SELECT a.id as idx,a.title as title, (SELECT IF(b.akses=1,'YA','TIDAK') FROM otori b where b.menu_id=a.id AND user_id=$test) AS status FROM dyn_menu a $where1 ORDER BY a.id limit $offset,$rows  ";
        $query1 = $this->db->query($sql);  


        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte){ 

            $coba[] = array(
                        'id' => $ii,  
                        'idx' => $resulte['idx'],
                        'title'  => $resulte['title'],
                        'status'  => $resulte['status'],
                        );
                        $ii++;
        }
        
        $result["rows"] = $coba;   
        $result["total"] = $trh->tot;               
        echo json_encode($result);
    //  $query1->free_result();   
    }

    function dsimpan_user($userw,$optw){
        $sql=$this->db->query("select menu_id,akses from otori where user_id='$optw'");
        foreach($sql->result() as $row){
            $menu=$row->menu_id;
            $akses=empty($row->akses) || $row->akses == null ?'0' :$row->akses;

            $sqlw=mysql_query("select id_user from user where user_name='$userw'");
            $hasil=mysql_fetch_assoc($sqlw);
            $id=$hasil['id_user'];

            $sqlz=$this->db->query("insert into otori values('$id','$menu','$akses')");
        
        }
    }

    function simpan_new(){
        $user=$this->input->post('user');
        $pass=md5(trim($this->input->post('pass')));
        $apli=$this->input->post('apl');
        $nick=$this->input->post('nick');
        $skpd=$this->input->post('skpd');
        $opt=$this->input->post('opt');
        $lok=$this->input->post('lokasi');
        $msg = array();

        $sql=$this->db->query("insert into user (user_name,password,type,nama,kd_skpd,unit_skpd) values ('$user','$pass','$apli','$nick','$skpd','$lok')");
        if($sql){
             $this->dsimpan_user($user,$opt);
             $msg = array('pesan'=>'1');
             echo json_encode($msg);
        }else{
             $msg = array('pesan'=>'0');
             echo json_encode($msg);
             exit();
        }
    }

    function update_new(){
        $idus=$this->input->post('idus');
        $user=$this->input->post('user');
        $pass=trim($this->input->post('pass'));
        $passx=md5(trim($this->input->post('pass')));
        $apli=$this->input->post('apl');
        $nick=$this->input->post('nick');
        $skpd=$this->input->post('skpd');
        $opt=$this->input->post('opt');
        $lok=$this->input->post('lokasi');
        $msg = array();

        $sql   = "select id_user from user where id_user='$idus'";
        $res   = $this->db->query($sql);

        $pass   =mysql_query("select password from user where id_user='$idus'");
        $resulte=mysql_fetch_assoc($pass);
        $fool   =$resulte['password'];

        if($res->num_rows() > 0){
            if ($pass == $fool){
                $sql1 = "update user set user_name='$user',password='$pass',type='$apli',nama='$nick',kd_skpd='$skpd',unit_skpd='$lok' where id_user='$idus'";
                $asg1 = $this->db->query($sql1);
                if($asg1){
                   $msg = array('pesan'=>'1');
                   echo json_encode($msg);
                }else{
                    $msg = array('pesan'=>'0');
                    echo json_encode($msg);
                }
            }else{
                $sql = "update user set user_name='$user',password='$passx',type='$apli',nama='$nick',kd_skpd='$skpd',unit_skpd='$lok' where id_user='$idus'";
                $asg = $this->db->query($sql);
                if($asg){
                    $msg = array('pesan'=>'1');
                    echo json_encode($msg);
                }else{
                   $msg = array('pesan'=>'0');
                    echo json_encode($msg);
                }
            }
        }else{
             $msg = array('pesan'=>'2');
             echo json_encode($msg);
        }

    }

    function hapus_new(){
        $idus=$this->input->post('idus');
        $msg = array();
        $sql=$this->db->query("DELETE FROM otori WHERE user_id='$idus'");
        if($sql){
            $sqlz= $this->db->query("DELETE FROM USER WHERE id_user='$idus'");
             $msg = array('pesan'=>'1');
             echo json_encode($msg);
        }else{
             $msg = array('pesan'=>'0');
             echo json_encode($msg);
             exit();
        }
    }

    function ambil_nomor_kontrak_rencana() { 
    
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        
        $skpd       = $this->input->post('kdskpd');
        $unit       = $this->input->post('unit');       
        $lccr       = $this->input->post('q');  
        $where2a    ='';
        if($lccr <> ''){
            $where2a =" and (UPPER(a.no_dokumen) LIKE UPPER('%$lccr%') or UPPER(b.keterangan) LIKE UPPER('%$lccr%') ) ";
            
        }
        
        
        $sql ="SELECT a.no_dokumen,SUM(b.total)AS total,
                (CASE WHEN b.kd_rek5='5222102' THEN 'Jasa Konsultasi Perencanaan' END)AS jasa,
                b.keterangan FROM trh_isianbrg a JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen AND a.kd_uskpd=b.kd_uskpd
                WHERE b.kd_rek5='5222102' AND a.kd_uskpd='$skpd' $where2a AND a.no_dokumen NOT IN (SELECT no_rencana FROM trh_isianbrg WHERE no_rencana!='') GROUP BY b.kd_brg,a.no_dokumen";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'no_rencana'    => $resulte['no_dokumen'],
                        'nilai'         => number_format($resulte['total'],2,'.',','),
                        'jasa'          => $resulte['jasa'],
                        'keterangan'    => $resulte['keterangan']
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
    }

    function ambil_nomor_kontrak_awas() { 
    
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        
        $skpd       = $this->input->post('kdskpd');
        $unit       = $this->input->post('unit');       
        $lccr       = $this->input->post('q');  
        $where2a    ='';
        if($lccr <> ''){
            $where2a =" and (UPPER(a.no_dokumen) LIKE UPPER('%$lccr%') or UPPER(b.keterangan) LIKE UPPER('%$lccr%') ) ";
            
        }
        
        
        $sql ="SELECT a.no_dokumen,SUM(b.total)AS total,
                (CASE WHEN b.kd_rek5='5222103' THEN 'Jasa Konsultasi Pengawasan' END)AS jasa,
                b.keterangan FROM trh_isianbrg a JOIN trd_isianbrg b ON a.no_dokumen=b.no_dokumen AND a.kd_uskpd=b.kd_uskpd
                WHERE b.kd_rek5='5222103' AND a.kd_uskpd='$skpd' $where2a AND a.no_dokumen NOT IN (SELECT no_awas FROM trh_isianbrg WHERE no_awas!='') GROUP BY b.kd_brg,a.no_dokumen";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'no_awas'    => $resulte['no_dokumen'],
                        'nilai'         => number_format($resulte['total'],2,'.',','),
                        'jasa'          => $resulte['jasa'],
                        'keterangan'    => $resulte['keterangan']
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
    }

    function max_nomor(){
        $tabel = $this->input->post('tabel');
        $msg=array();
        $sqlz=mysql_query("SELECT IF(MAX(no_bukti)IS NULL,CONCAT(LPAD('1',6,0)),CONCAT(LPAD(MAX(no_bukti)+1,6,0))) AS nomor FROM $tabel");
        $hasil=mysql_fetch_assoc($sqlz);
        $num=$hasil['nomor'];

        $data=array('nomor'=>$num);
        echo json_encode($data);
    
    }

    function max_nomor2(){
        $tabel = $this->input->post('tabel');
        $skpd  = $this->input->post('skpd');
        $msg=array();
        $sqlz=mysql_query("SELECT IF(MAX(no_bukti)IS NULL,CONCAT(LPAD('1',6,0)),CONCAT(LPAD(MAX(no_bukti)+1,6,0))) AS nomor FROM $tabel WHERE kd_skpd='$skpd'");
        $hasil=mysql_fetch_assoc($sqlz);
        $num=$hasil['nomor'];

        $data=array('nomor'=>$num);
        echo json_encode($data);
    
    }

    //Untuk Reklas
    function ambil_golongan_rek() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('gol');
        $sql = "SELECT golongan,nm_golongan FROM mgolongan where golongan in ('02','03','04','07') order by golongan";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'gol' => $resulte['golongan'],  
                        'nm_golongan' => $resulte['nm_golongan']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }

    function ambil_golongan_rek_kib() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('gol');
        $sql = "SELECT golongan,nm_golongan FROM mgolongan where golongan in ('01','02','03','04','05') order by golongan";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'gol' => $resulte['golongan'],  
                        'nm_golongan' => $resulte['nm_golongan']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }

    function ambil_golongan_rek_kib_baru() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('gol');
        $sql = "SELECT golongan,nm_golongan FROM mgolongan where golongan in ('06') order by golongan";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'gol' => $resulte['golongan'],  
                        'nm_golongan' => $resulte['nm_golongan']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }

    function ambil_bidang_rek() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('gol');
        $cari = $this->input->post('q');
        $where ="";
        if($cari<>''){
            $where="and nm_brg like '%$cari%'";
        }
        $sql = "SELECT kd_brg,nm_brg FROM mbarang where left(kd_brg,2)='$lccr' $where order by kd_brg";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'bidang'    => $resulte['kd_brg'],  
                        'nm_bidang' => $resulte['nm_brg']
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }

function ambil_kdp_rek() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $skpd      = $this->input->post('skpd');           
        $kd_baru   = $this->input->post('kd_baru');  
        $gol       = $this->input->post('gol');
        $lccr      = $this->input->post('q');
        $p         = $this->input->post('p');  
        $sts_inp   = $this->input->post('sts_inp');  
        
        if($lccr!=''){
            $like="and (no_reg like '%$lccr%' or no_dokumen like '%$lccr%' or nm_brg like '%$lccr%' or nilai like '%$lccr%' or nilai_kontrak like '%$lccr%' or alamat1 like '%$lccr%' or keterangan like '%$lccr%' or detail_brg like '%$lccr%')";
        }else{
            $like="";
        }
        
 
         if($sts_inp=='1'){
            $sql = "SELECT a.id_barang,a.no_reg,a.no_dokumen,a.kd_brg,a.nm_brg,a.nilai_kontrak,a.no,a.no_oleh,a.tgl_reg,a.tgl_oleh,a.detail_brg,a.kd_tanah,
                        a.asal,a.dsr_peroleh,a.total,a.kondisi,a.konstruksi,a.jenis,a.bangunan,a.luas,a.jumlah,a.status_tanah,
                        a.alamat1,a.alamat2,a.alamat3,a.no_mutasi,a.tgl_mutasi,a.no_pindah,a.tgl_pindah,a.no_hapus,a.tgl_hapus,a.keterangan,a.kd_skpd,a.kd_unit,
                        a.milik,a.wilayah,a.tahun,a.foto,a.foto2,a.no_urut,a.lat,a.lon,a.kd_riwayat,a.tgl_riwayat,a.detail_riwayat,
                        (CASE 
                        WHEN a.id_barang IN (SELECT id_barang FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd) THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND YEAR(c.tgl_kap)<='$p' AND b.id_barang=a.id_barang)
                        WHEN a.id_barang IN (SELECT id_barang FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd) THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND YEAR(c.tgl_kap)<='$p' AND b.id_barang=a.id_barang)
                        WHEN a.id_barang IN (SELECT id_barang FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd) THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND YEAR(c.tgl_kap)<='$p' AND b.id_barang=a.id_barang)
                        WHEN a.id_barang IN (SELECT id_barang FROM trkib_g_kap WHERE kd_skpd=a.kd_skpd) THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibg_kap b JOIN trkib_g_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND YEAR(c.tgl_kap)<='$p' AND b.id_barang=a.id_barang)
                        END) AS nilai FROM trkib_f a WHERE a.kd_skpd='$skpd' and a.id_barang NOT IN (SELECT id_barang FROM trd_reklas WHERE kd_skpd='$skpd') 
                        and a.nilai_kontrak=(CASE 
                        WHEN a.id_barang IN (SELECT id_barang FROM trkib_b_kap WHERE kd_skpd=a.kd_skpd) THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibb_kap b JOIN trkib_b_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND YEAR(c.tgl_kap)<='$p' AND b.id_barang=a.id_barang)
                        WHEN a.id_barang IN (SELECT id_barang FROM trkib_c_kap WHERE kd_skpd=a.kd_skpd) THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibc_kap b JOIN trkib_c_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND YEAR(c.tgl_kap)<='$p' AND b.id_barang=a.id_barang)
                        WHEN a.id_barang IN (SELECT id_barang FROM trkib_d_kap WHERE kd_skpd=a.kd_skpd) THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibd_kap b JOIN trkib_d_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND YEAR(c.tgl_kap)<='$p' AND b.id_barang=a.id_barang)
                        WHEN a.id_barang IN (SELECT id_barang FROM trkib_g_kap WHERE kd_skpd=a.kd_skpd) THEN a.nilai+(SELECT IFNULL(SUM(b.nilai_kap),0)FROM trdkibg_kap b JOIN trkib_g_kap c ON b.no_bukti=c.no_bukti AND b.kd_skpd=c.kd_skpd AND b.kd_unit=c.kd_unit
                        WHERE b.kd_skpd=a.kd_skpd AND YEAR(c.tgl_kap)<='$p' AND b.id_barang=a.id_barang)
                        END)";
         }else if($sts_inp=='2'){
            if($gol=='01'){
                $sql="SELECT a.id_barang,a.no_reg,a.no_dokumen,a.kd_brg,a.nm_brg,''AS nilai_kontrak,a.no,a.no_oleh,a.tgl_reg,a.tgl_oleh,a.detail_brg,''AS kd_tanah,
                        a.asal,a.dsr_peroleh,a.total,a.kondisi,''AS konstruksi,''AS jenis,''AS bangunan,a.luas,a.jumlah,a.status_tanah,
                        a.alamat1,a.alamat2,a.alamat3,a.no_mutasi,a.tgl_mutasi,a.no_pindah,a.tgl_pindah,a.no_hapus,a.tgl_hapus,a.keterangan,a.kd_skpd,a.kd_unit,
                        a.milik,a.wilayah,a.tahun,a.foto1 AS foto,a.foto2,a.no_urut,a.lat,a.lon,a.kd_riwayat,a.tgl_riwayat,a.detail_riwayat,
                        a.nilai FROM trkib_a a WHERE a.kd_skpd='$skpd' AND a.kd_brg='$kd_baru' AND a.id_barang NOT IN (SELECT id_barang FROM trd_reklas WHERE kd_skpd='$skpd') ";
            }else if($gol=='02'){
                $sql="SELECT a.id_barang,a.no_reg,a.no_dokumen,a.kd_brg,a.nm_brg,''AS nilai_kontrak,a.no,a.no_oleh,a.tgl_reg,a.tgl_oleh,a.detail_brg,''AS kd_tanah,
                        a.asal,a.dsr_peroleh,a.total,a.kondisi,''AS konstruksi,''AS jenis,''AS bangunan,''AS luas,a.jumlah,''AS status_tanah,
                        '' AS alamat1,''AS alamat2,''AS alamat3,a.no_mutasi,a.tgl_mutasi,a.no_pindah,a.tgl_pindah,a.no_hapus,a.tgl_hapus,a.keterangan,a.kd_skpd,a.kd_unit,
                        a.milik,a.wilayah,a.tahun,a.foto,a.foto2,a.no_urut,''AS lat,''AS lon,a.kd_riwayat,a.tgl_riwayat,a.detail_riwayat,
                        a.nilai FROM trkib_b a WHERE a.kd_skpd='$skpd' AND a.kd_brg='$kd_baru' AND a.id_barang NOT IN (SELECT id_barang FROM trd_reklas WHERE kd_skpd='$skpd') ";
            }else if($gol=='03'){
                $sql="SELECT a.id_barang,a.no_reg,a.no_dokumen,a.kd_brg,a.nm_brg,''AS nilai_kontrak,a.no,a.no_oleh,a.tgl_reg,a.tgl_oleh,a.detail_brg,''AS kd_tanah,
                        a.asal,a.dsr_peroleh,a.total,a.kondisi,''AS konstruksi,''AS jenis,''AS bangunan,''AS luas,a.jumlah,a.status_tanah,
                        a.alamat1,a.alamat2,a.alamat3,a.no_mutasi,a.tgl_mutasi,a.no_pindah,a.tgl_pindah,a.no_hapus,a.tgl_hapus,a.keterangan,a.kd_skpd,a.kd_unit,
                        a.milik,a.wilayah,a.tahun,a.foto1 AS foto,a.foto2,a.no_urut,a.lat,a.lon,a.kd_riwayat,a.tgl_riwayat,a.detail_riwayat,
                        a.nilai FROM trkib_c a WHERE a.kd_skpd='$skpd' AND a.kd_brg='$kd_baru' AND a.id_barang NOT IN (SELECT id_barang FROM trd_reklas WHERE kd_skpd='$skpd') ";
            }else if($gol=='04'){
                $sql="SELECT a.id_barang,a.no_reg,a.no_dokumen,a.kd_brg,a.nm_brg,''AS nilai_kontrak,a.no,a.no_oleh,a.tgl_reg,a.tgl_oleh,a.detail_brg,''AS kd_tanah,
                        a.asal,a.dasar AS dsr_peroleh,a.total,a.kondisi,''AS konstruksi,''AS jenis,''AS bangunan,a.luas,a.jumlah,a.status_tanah,
                        a.alamat1,a.alamat2,a.alamat3,a.no_mutasi,a.tgl_mutasi,a.no_pindah,a.tgl_pindah,a.no_hapus,a.tgl_hapus,a.keterangan,a.kd_skpd,a.kd_unit,
                        a.milik,a.wilayah,a.tahun,a.foto,a.foto2,a.no_urut,a.lat,a.lon,a.kd_riwayat,a.tgl_riwayat,a.detail_riwayat,
                        a.nilai FROM trkib_d a WHERE a.kd_skpd='$skpd' AND a.kd_brg='$kd_baru' AND a.id_barang NOT IN (SELECT id_barang FROM trd_reklas WHERE kd_skpd='$skpd') ";
            }else if($gol=='05'){
                $sql="SELECT a.id_barang,a.no_reg,a.no_dokumen,a.kd_brg,a.nm_brg,''AS nilai_kontrak,a.no,a.no_oleh,a.tgl_reg,a.tgl_peroleh,a.detail_brg,''AS kd_tanah,
                        a.asal,a.dsr_peroleh,a.total,a.kondisi,''AS konstruksi,''AS jenis,''AS bangunan,''AS luas,a.jumlah,''AS status_tanah,
                        ''AS alamat1,''AS alamat2,''AS alamat3,a.no_mutasi,a.tgl_mutasi,a.no_pindah,a.tgl_pindah,a.no_hapus,a.tgl_hapus,a.keterangan,a.kd_skpd,a.kd_unit,
                        a.milik,a.wilayah,a.tahun,a.foto,a.foto2,a.no_urut,a.lat,a.lon,a.kd_riwayat,a.tgl_riwayat,a.detail_riwayat,
                        a.nilai FROM trkib_e a WHERE a.kd_skpd='$skpd' AND a.kd_brg='$kd_baru' AND a.id_barang NOT IN (SELECT id_barang FROM trd_reklas WHERE kd_skpd='$skpd')";
            }
         }
        

 
 $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'                => $ii,        
                        'id_barang'         => $resulte['id_barang'],
                        'no_reg'            => $resulte['no_reg'],
                        'no_dokumen'        => $resulte['no_dokumen'],
                        'kd_brg'            => $resulte['kd_brg'],
                        'nm_brg'            => $resulte['nm_brg'],
                        'nilai'             => number_format($resulte['nilai'],2,'.',','),
                        'nilai_kontrak'     => number_format($resulte['nilai_kontrak'],2,'.',','),
                        'no'                => $resulte['no'],
                        'no_oleh'           => $resulte['no_oleh'],
                        'tgl_reg'           => $resulte['tgl_reg'],
                        'tgl_oleh'          => $resulte['tgl_oleh'],
                        'detail_brg'        => $resulte['detail_brg'],
                        'kd_tanah'          => $resulte['kd_tanah'],
                        'asal'              => $resulte['asal'],
                        'dsr_peroleh'       => $resulte['dsr_peroleh'],
                        'total'             => $resulte['total'],
                        'kondisi'           => $resulte['kondisi'],
                        'konstruksi'        => $resulte['konstruksi'],
                        'jenis'             => $resulte['jenis'],
                        'bangunan'          => $resulte['bangunan'],
                        'luas'              => $resulte['luas'],
                        'jumlah'            => $resulte['jumlah'],
                        'status_tanah'      => $resulte['status_tanah'],
                        'alamat1'           => $resulte['alamat1'],
                        'alamat2'           => $resulte['alamat2'],
                        'alamat3'           => $resulte['alamat3'],
                        'no_mutasi'         => $resulte['no_mutasi'],
                        'tgl_mutasi'        => $resulte['tgl_mutasi'],
                        'no_pindah'         => $resulte['no_pindah'],
                        'tgl_pindah'        => $resulte['tgl_pindah'],
                        'no_hapus'          => $resulte['no_hapus'],
                        'tgl_hapus'         => $resulte['tgl_hapus'],
                        'keterangan'        => $resulte['keterangan'],
                        'kd_skpd'           => $resulte['kd_skpd'],
                        'kd_unit'           => $resulte['kd_unit'],
                        'milik'             => $resulte['milik'],
                        'wilayah'           => $resulte['wilayah'],
                        'tahun'             => $resulte['tahun'],
                        'foto'              => $resulte['foto'],
                        'foto2'             => $resulte['foto2'],
                        'no_urut'           => $resulte['no_urut'],
                        'lat'               => $resulte['lat'],
                        'lon'               => $resulte['lon'],
                        'kd_riwayat'        => $resulte['kd_riwayat'],
                        'tgl_riwayat'       => $resulte['tgl_riwayat'],
                        'detail_riwayat'    => $resulte['detail_riwayat'],
                        'nilai2'            => $resulte['nilai']                      
                        );
                        $ii++;
        }
           
        echo json_encode($result);
       $query1->free_result();
       }
    }
    
    function ambil_giat(){
        $dbsimakda=$this->load->database('simakda', TRUE);
        $skpd     = $this->input->post('skpd');
        $lccr = $this->input->post('q');
        $sql="SELECT kd_kegiatan,nm_kegiatan FROM trdrka WHERE LEFT(kd_rek5,3)='523' AND kd_skpd='$skpd' AND (kd_kegiatan LIKE '%$lccr%' OR nm_kegiatan LIKE '%$lccr%') GROUP BY kd_kegiatan";
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'kd_kegiatan'   => $resulte['kd_kegiatan'],
                        'nm_kegiatan'   => $resulte['nm_kegiatan']
                        
                        );
                        $ii++;
        }
        echo json_encode($result);
    }

    function ambil_kdrek5(){
        $dbsimakda=$this->load->database('simakda', TRUE);
        $lccr = $this->input->post('q');
        $giat     = $this->input->post('giat');
        $sql="SELECT kd_rek5,nm_rek5 FROM trdrka WHERE LEFT(kd_rek5,3)='523' AND kd_kegiatan='$giat' AND (kd_rek5 LIKE '%$lccr%' OR nm_rek5 LIKE '%$lccr%') GROUP BY kd_rek5";
        $query1 = $dbsimakda->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id'            => $ii,        
                        'kd_rek5'   => $resulte['kd_rek5'],
                        'nm_rek5'   => $resulte['nm_rek5']
                        
                        );
                        $ii++;
        }
        echo json_encode($result);
    }
    
    function tahun3() {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $lccr = $this->input->post('q');
        if($lccr!=''){
            $where="and (upper(tahun) like upper('%$lccr%'))";
        }else{
            $where="";
        }
        $sql = "SELECT tahun FROM tahun where tahun >=2016 $where  order by tahun";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array('tahun' => $resulte['tahun']);
            $ii++;
        }
           
        echo json_encode($result);
       $query1->free_result();
       } 
    }

    function ambil_jenis_2konsep() {
       if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $kode = $this->input->post('kode');
        $sql = "SELECT * FROM jenis_kib where kode = '$kode' order by kode";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],  
                        'jenis' => $resulte['jenis'],  
                       
                        );
                        $ii++;
        }
        echo json_encode($result);
        }
    }

    function mpaket()
    {
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        $data['page_title']= 'INPUT MASTER PAKET';
        $this->template->set('title', 'INPUT MASTER PAKET');   
        $this->template->load('index','master/mpaket',$data) ;
        } 
    }

    function load_paket() {
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
            $where="where nm_paket like'%$kriteria%' or kd_paket like '%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM ms_paket  $where order by kd_paket");
        $trh = $rs->row();
        //$result["total"] = $trh->tot;
        
        $sql = "SELECT * FROM ms_paket a INNER JOIN ms_skpd b ON a.kd_skpd=b.kd_skpd $where order by kd_paket limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        //$result = array();
        
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_paket' => $resulte['kd_paket'],
                        'kd_skpd' => $resulte['kd_skpd'],
                        'nm_skpd' => $resulte['nm_skpd'],
                        // 'nilai'   => number_format($resulte['nilai'],'0',',','.'),
                        'nilai'   => number_format($resulte['nilai']),
                        'nm_paket' => $resulte['nm_paket'],
                        //'nilai'  => number_format($resulte['nilai'])
                        );
                        $ii++;
        }
        
        $result["total"] = $trh->tot; 
        $result["rows"] = $coba;   
        echo json_encode($result);
        $query1->free_result(); 
        }  
    }
  function ambil_paket() {
              
        if($this->auth->is_logged_in() == false){
            redirect(site_url().'/welcome/login');
        }else{
        // $skpd  = $this->session->userdata('skpd');
        // $oto        = $this->session->userdata('otori');
 
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';

        if ($kriteria <> ''){                               
            $where="where nm_paket like'%$kriteria%' or kd_paket like '%$kriteria%'";            
        }
        
        $rs = $this->db->query("select count(*) as tot FROM ms_paket  $where order by kd_paket");
        $trh = $rs->row();
     /*   $where1 = '';       
        if($oto == '01' && $skpd=='1.20.05.01'){ 
            $where1 = " a.kd_skpd like '%' and ";
        }else if($oto=='01' && $skpd<>'1.20.05.01'){
            $where1 = " a.kd_skpd ='$skpd' and ";
        }else if($oto=='02' && $skpd<>'1.20.05.01'){
            $where1 = " a.kd_skpd ='$skpd' and ";
        }else if($oto=='02' && $skpd=='1.20.05.01'){
            $where1 = " a.kd_skpd like '%' and ";
        }         
          
        $lccr = $this->input->post('q');
          $where2='';
        if($lccr <> ''){
            $where2 ="upper(a.kd_lokasi) like upper('%$lccr%') or upper(a.nm_lokasi) like upper('%$lccr%') ";
        }*/
        //WISNU 17 09 2019
        $skpd  = $this->session->userdata('skpd');
        
        $sql = "SELECT * FROM ms_paket a INNER JOIN ms_skpd b ON a.kd_skpd=b.kd_skpd $where
        AND a.kd_skpd='$skpd' order by kd_paket limit $offset,$rows";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        'id' => $ii,        
                        'kd_paket' => $resulte['kd_paket'],  
                        'nm_paket' => $resulte['nm_paket'],
                        'kd_skpd' => $resulte['kd_skpd'],
                        'nm_skpd' => $resulte['nm_skpd'],
                        'nilai'   => number_format($resulte['nilai']),  
                       
                        );
                        $ii++;
        }
           
        echo json_encode($result);
        }
           
    }
    function max_paket() {
        
        $table = $this->input->post('table');
        $kolom = $this->input->post('kolom');
        $sql = "SELECT IF(MAX($kolom)IS NULL,LPAD('1',4,0),LPAD(MAX($kolom)+1,4,0))AS kode FROM $table";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
           
            $result[] = array(
                        //'id' => $ii,        
                        'no_urut' => $resulte['kode']
                        );
                        //$ii++;
        }
           
        echo json_encode($result);
        
           
    }


}
