<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Syncron extends CI_Controller {

	function __contruct()
	{	
		parent::__construct();
	}
    
  
	function v_syncron(){
			$data['page_title']= 'Syncron Toni';
			$this->template->set('title', 'SYNC');   
			$this->template->load('template','master/v_syncron',$data) ; 
	}

	function v_syncron_cleo(){
			$data['page_title']= 'Syncron Toni';
			$this->template->set('title', 'SYNC');   
			$this->template->load('template','master/v_syncron_cleo',$data) ; 
	}

	function v_uplink(){
			$data['page_title']= 'Uplink Toni';
			$this->template->set('title', 'U P l I N K');   
			$this->template->load('template','master/v_syncron_cleo',$data) ; 
	}
 
	function titik($str){
		$panjang=120;
		if($panjang>=strlen($str)){
			$selisih=$panjang-strlen($str);
			for($i=1;$i<=$selisih;$i++){
				$str .='.';
			}
			$hasil=$str;
		}else{
			$hasil=substr($str,0,100);
		} 
		return $hasil;
	}

	function hitrecord(){
		$tabel =$this->input->post('tabel');	
        $cek=$this->request();//cek koneksi
		if($cek=='0'){
			$serverdb = $this->load->database('s_procedure', TRUE);//koneksi ke database temp
			$serverdb->query("delete from $tabel");

			$query = $this->db->query(" SELECT * FROM $tabel ");  
			$rec   = count($query->result_array());

			$data=array("jumlah"=>$rec);
			echo json_encode($data);
			$query->free_result();
		}else if($cek=='10060'){
			$rec='out';
			$data=array("jumlah"=>$rec);
			echo json_encode($data);
		}else{
			$rec=0;
			$data=array("jumlah"=>$rec);
			echo json_encode($data);
		}
	}

	function request(){
		$host="192.168.73.1"; //ip server
		$port=3306;$timeout=1;
		$fp=@fsockopen($host, $port, $errno, $errstr, $timeout);
		if($fp) { 
			$errno;
		}else{ 
			$errno;
		}
		@fclose($fp);
		return json_decode($errno);
	   
	 }
	   
	
	function cek_syncron(){
		$tabel =$this->input->post('tabel');		
		$baris =$this->input->post('baris');
		$hasil=$this->request();
		if($hasil =='0'){
		$serverdb = $this->load->database('s_procedure', TRUE); //connecting database on server temp
		$sql=$serverdb->query("SELECT table_name FROM information_schema.tables WHERE table_schema = DATABASE()
								AND table_name='$tabel'");//ambil table_name di server
		$i=1;
		$result = array();
		
		 foreach($sql->result_array() as $resulte){
			 $no      = $i;
			 $tables = $resulte['table_name'];
					//$kd_skpd=empty($row->Tables_in_simakda_ex) || $row->Tables_in_simakda_ex == 0 ? '&nbsp;' :$row->Tables_in_simakda_ex;
			
					//=============================================================
					$i++;
					$sqlw=$serverdb->query("SELECT column_name
											FROM information_schema.columns
											WHERE table_schema = DATABASE()
											AND table_name='$tables'
											ORDER BY ordinal_position ");//ambil column name di server temp
					$id=array();
					$ii=0;
					foreach($sqlw->result_array() as $row){
					    $id[]=$row['column_name'];	
						$ii++;
					}
					
					//=========ambil isi server
					if($ii=='1'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0] from $tables limit $baris,1");
							$id2=array();
							foreach($sqlisi2->result() as $row2){
							  $isi1=$row2->$id[0];
								//=============================================================
								$inserv=$serverdb->query("insert into $tables(".$id[0].") values ('$isi1')");
								 if($inserv){
									$isi =$id[0]."-> ".$isi1 ;
									$hasil=$this->request();
								 }else{
									$isi =$id[0]."-> ".$isi1 ;
									$hasil=$this->request();
								 }	
							}
					}else if($ii=='2'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1] from $tables limit $baris,1");
							$id2=array();
							foreach($sqlisi2->result() as $row2){
							  $isi1=$row2->$id[0];
							  $isi2=$row2->$id[1];
								//=============================================================
								$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].") values ('$isi1','$isi2')");
								 if($inserv){
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }else{
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }	
							}
					}else if($ii=='3'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2] from $tables limit $baris,1");
							$id2=array();
							foreach($sqlisi2->result() as $row2){
							  $isi1=$row2->$id[0];
							  $isi2=$row2->$id[1];
							  $isi3=$row2->$id[2];
								//=============================================================
								$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].") values ('$isi1','$isi2','$isi3')");
								 if($inserv){
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }else{
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }	
							}
					}else if($ii=='4'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3] from $tables limit $baris,1");
							$id2=array();
							foreach($sqlisi2->result() as $row2){
							  $isi1=$row2->$id[0];
							  $isi2=$row2->$id[1];
							  $isi3=$row2->$id[2];
							  $isi4=$row2->$id[3];
								//=============================================================
								$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].") values ('$isi1','$isi2','$isi3','$isi4')");
								 if($inserv){
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }else{
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }	
							}
					}else if($ii=='5'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4] from $tables limit $baris,1");
							$id2=array();
							foreach($sqlisi2->result() as $row2){
							  $isi1=$row2->$id[0];
							  $isi2=$row2->$id[1];
							  $isi3=$row2->$id[2];
							  $isi4=$row2->$id[3];
							  $isi5=$row2->$id[4];
								//=============================================================
								$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].") values ('$isi1','$isi2','$isi3','$isi4','$isi5')");
								 if($inserv){
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }else{
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }	
							}
					}else if($ii=='6'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='7'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='8'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='9'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='10'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='11'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='12'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='13'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='14'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='15'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='16'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='17'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='18'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='19'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='20'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='21'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='22'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='23'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='24'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='25'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='26'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='27'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='28'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='29'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='30'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='31'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='32'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='33'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='34'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='35'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='36'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='37'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='38'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='39'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='40'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='41'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='42'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='43'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='44'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='45'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='46'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='47'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45],$id[46] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
						  $isi47=$row2->$id[46];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].",".$id[46].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46','$isi47')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='48'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45],$id[46],$id[47] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
						  $isi47=$row2->$id[46];
						  $isi48=$row2->$id[47];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].",".$id[46].",".$id[47].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46','$isi47','$isi48')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='49'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45],$id[46],$id[47],$id[48] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
						  $isi47=$row2->$id[46];
						  $isi48=$row2->$id[47];
						  $isi49=$row2->$id[48];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].",".$id[46].",".$id[47].",".$id[48].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46','$isi47','$isi48','$isi49')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='50'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45],$id[46],$id[47],$id[48],$id[49] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
						  $isi47=$row2->$id[46];
						  $isi48=$row2->$id[47];
						  $isi49=$row2->$id[48];
						  $isi50=$row2->$id[49];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].",".$id[46].",".$id[47].",".$id[48].",".$id[49].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46','$isi47','$isi48','$isi49','$isi50')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='51'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$this->db->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45],$id[46],$id[47],$id[48],$id[49],$id[50] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
						  $isi47=$row2->$id[46];
						  $isi48=$row2->$id[47];
						  $isi49=$row2->$id[48];
						  $isi50=$row2->$id[49];
						  $isi51=$row2->$id[50];
							//=============================================================
							$inserv=$serverdb->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].",".$id[46].",".$id[47].",".$id[48].",".$id[49].",".$id[50].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46','$isi47','$isi48','$isi49','$isi50','$isi51')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}
		   }
		  if($hasil==0){$hasil='[ok]';}else{$hasil='[gagal]';}
		  $isi  =$this->titik($isi).$hasil;
		  $datx=array("isi"=>$isi,"baris"=>($baris+1),"pesan"=>'0');
          echo json_encode($datx);
		}else{
			 $isi  =$this->titik('Request Time out').$hasil;
			 $datx=array("isi"=>$isi,"pesan"=>'1');
			 echo json_encode($datx);
		}

	}

	function hitrecord_cleo(){
		$tabel =$this->input->post('tabel');	
        $cek=$this->request(); //cek koneksi
		if($cek=='0'){
			$this->db->query("delete from $tabel");

			$serverdb = $this->load->database('s_utama', TRUE);
			$query = $serverdb->query(" SELECT * FROM $tabel ");  
			$rec   = count($query->result_array());

			$data=array("jumlah"=>$rec);
			echo json_encode($data);
			$query->free_result();
		}else if($cek=='10060'){
			$rec='out';
			$data=array("jumlah"=>$rec);
			echo json_encode($data);
		}else{
			$rec=0;
			$data=array("jumlah"=>$rec);
			echo json_encode($data);
		}
	}
	
	function cek_syncron_cleo(){
		$tabel =$this->input->post('tabel');		
		$baris =$this->input->post('baris');
		$hasil=$this->request();
		if($hasil =='0'){
		$serverdb = $this->load->database('s_utama', TRUE); //connecting database on server utama
		$sql=$this->db->query("SELECT table_name FROM information_schema.tables WHERE table_schema = DATABASE()
								AND table_name='$tabel'");//ambil table_name di server
		$i=1;
		$result = array();
		
		 foreach($sql->result_array() as $resulte){
			 $no      = $i;
			 $tables = $resulte['table_name'];
					//$kd_skpd=empty($row->Tables_in_simakda_ex) || $row->Tables_in_simakda_ex == 0 ? '&nbsp;' :$row->Tables_in_simakda_ex;
			
					//=============================================================
					$i++;
					$sqlw=$this->db->query("SELECT column_name
											FROM information_schema.columns
											WHERE table_schema = DATABASE()
											AND table_name='$tables'
											ORDER BY ordinal_position ");//ambil column name di server utama
					$id=array();
					$ii=0;
					foreach($sqlw->result_array() as $row){
					    $id[]=$row['column_name'];	
						$ii++;
					}

					//=========ambil isi server
					if($ii=='1'){
						//=========ambil isi client + isi ke server temp
						$sqlisi2=$serverdb->query("select $id[0] from $tables limit $baris,1");
							$id2=array();
							foreach($sqlisi2->result() as $row2){
							  $isi1=$row2->$id[0];
								//=============================================================
								$inserv=$this->db->query("insert into $tables(".$id[0].") values ('$isi1')");
								 if($inserv){
									$isi =$id[0]."-> ".$isi1 ;
									$hasil=$this->request();
								 }else{
									$isi =$id[0]."-> ".$isi1 ;
									$hasil=$this->request();
								 }	
							}
					}else if($ii=='2'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1] from $tables limit $baris,1");
							$id2=array();
							foreach($sqlisi2->result() as $row2){
							  $isi1=$row2->$id[0];
							  $isi2=$row2->$id[1];
								//=============================================================
								$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].") values ('$isi1','$isi2')");
								 if($inserv){
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }else{
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }	
							}
					}else if($ii=='3'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2] from $tables limit $baris,1");
							$id2=array();
							foreach($sqlisi2->result() as $row2){
							  $isi1=$row2->$id[0];
							  $isi2=$row2->$id[1];
							  $isi3=$row2->$id[2];
								//=============================================================
								$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].") values ('$isi1','$isi2','$isi3')");
								 if($inserv){
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }else{
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }	
							}
					}else if($ii=='4'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3] from $tables limit $baris,1");
							$id2=array();
							foreach($sqlisi2->result() as $row2){
							  $isi1=$row2->$id[0];
							  $isi2=$row2->$id[1];
							  $isi3=$row2->$id[2];
							  $isi4=$row2->$id[3];
								//=============================================================
								$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].") values ('$isi1','$isi2','$isi3','$isi4')");
								 if($inserv){
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }else{
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }	
							}
					}else if($ii=='5'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4] from $tables limit $baris,1");
							$id2=array();
							foreach($sqlisi2->result() as $row2){
							  $isi1=$row2->$id[0];
							  $isi2=$row2->$id[1];
							  $isi3=$row2->$id[2];
							  $isi4=$row2->$id[3];
							  $isi5=$row2->$id[4];
								//=============================================================
								$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].") values ('$isi1','$isi2','$isi3','$isi4','$isi5')");
								 if($inserv){
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }else{
									$isi =$id[0]."-> ".$isi1." | ".$isi2;
									$hasil=$this->request();
								 }	
							}
					}else if($ii=='6'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='7'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='8'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='9'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='10'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='11'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='12'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='13'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='14'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='15'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='16'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='17'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='18'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='19'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='20'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='21'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='22'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='23'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='24'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='25'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='26'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='27'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='28'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='29'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='30'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='31'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='32'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='33'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='34'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='35'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='36'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='37'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='38'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='39'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='40'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='41'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='42'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='43'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='44'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='45'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='46'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='47'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45],$id[46] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
						  $isi47=$row2->$id[46];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].",".$id[46].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46','$isi47')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='48'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45],$id[46],$id[47] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
						  $isi47=$row2->$id[46];
						  $isi48=$row2->$id[47];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].",".$id[46].",".$id[47].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46','$isi47','$isi48')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='49'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45],$id[46],$id[47],$id[48] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
						  $isi47=$row2->$id[46];
						  $isi48=$row2->$id[47];
						  $isi49=$row2->$id[48];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].",".$id[46].",".$id[47].",".$id[48].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46','$isi47','$isi48','$isi49')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='50'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45],$id[46],$id[47],$id[48],$id[49] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
						  $isi47=$row2->$id[46];
						  $isi48=$row2->$id[47];
						  $isi49=$row2->$id[48];
						  $isi50=$row2->$id[49];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].",".$id[46].",".$id[47].",".$id[48].",".$id[49].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46','$isi47','$isi48','$isi49','$isi50')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}else if($ii=='51'){
						//=========ambil isi server utama + isi ke client
						$sqlisi2=$serverdb->query("select $id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9],$id[10],$id[11],$id[12],$id[13],$id[14],$id[15],$id[16],$id[17],$id[18],$id[19],$id[20],$id[21],$id[22],$id[23],$id[24],$id[25],$id[26],$id[27],$id[28],$id[29],$id[30],$id[31],$id[32],$id[33],$id[34],$id[35],$id[36],$id[37],$id[38],$id[39],$id[40],$id[41],$id[42],$id[43],$id[44],$id[45],$id[46],$id[47],$id[48],$id[49],$id[50] from $tables limit $baris,1");
						$id2=array();
						foreach($sqlisi2->result() as $row2){
						  $isi1=$row2->$id[0];
						  $isi2=$row2->$id[1];
						  $isi3=$row2->$id[2];
						  $isi4=$row2->$id[3];
						  $isi5=$row2->$id[4];
						  $isi6=$row2->$id[5];
						  $isi7=$row2->$id[6];
						  $isi8=$row2->$id[7];
						  $isi9=$row2->$id[8];
						  $isi10=$row2->$id[9];
						  $isi11=$row2->$id[10];
						  $isi12=$row2->$id[11];
						  $isi13=$row2->$id[12];
						  $isi14=$row2->$id[13];
						  $isi15=$row2->$id[14];
						  $isi16=$row2->$id[15];
						  $isi17=$row2->$id[16];
						  $isi18=$row2->$id[17];
						  $isi19=$row2->$id[18];
						  $isi20=$row2->$id[19];
						  $isi21=$row2->$id[20];
						  $isi22=$row2->$id[21];
						  $isi23=$row2->$id[22];
						  $isi24=$row2->$id[23];
						  $isi25=$row2->$id[24];
						  $isi26=$row2->$id[25];
						  $isi27=$row2->$id[26];
						  $isi28=$row2->$id[27];
						  $isi29=$row2->$id[28];
						  $isi30=$row2->$id[29];
						  $isi31=$row2->$id[30];
						  $isi32=$row2->$id[31];
						  $isi33=$row2->$id[32];
						  $isi34=$row2->$id[33];
						  $isi35=$row2->$id[34];
						  $isi36=$row2->$id[35];
						  $isi37=$row2->$id[36];
						  $isi38=$row2->$id[37];
						  $isi39=$row2->$id[38];
						  $isi40=$row2->$id[39];
						  $isi41=$row2->$id[40];
						  $isi42=$row2->$id[41];
						  $isi43=$row2->$id[42];
						  $isi44=$row2->$id[43];
						  $isi45=$row2->$id[44];
						  $isi46=$row2->$id[45];
						  $isi47=$row2->$id[46];
						  $isi48=$row2->$id[47];
						  $isi49=$row2->$id[48];
						  $isi50=$row2->$id[49];
						  $isi51=$row2->$id[50];
							//=============================================================
							$inserv=$this->db->query("insert into $tables(".$id[0].",".$id[1].",".$id[2].",".$id[3].",".$id[4].",".$id[5].",".$id[6].",".$id[7].",".$id[8].",".$id[9].",".$id[10].",".$id[11].",".$id[12].",".$id[13].",".$id[14].",".$id[15].",".$id[16].",".$id[17].",".$id[18].",".$id[19].",".$id[20].",".$id[21].",".$id[22].",".$id[23].",".$id[24].",".$id[25].",".$id[26].",".$id[27].",".$id[28].",".$id[29].",".$id[30].",".$id[31].",".$id[32].",".$id[33].",".$id[34].",".$id[35].",".$id[36].",".$id[37].",".$id[38].",".$id[39].",".$id[40].",".$id[41].",".$id[42].",".$id[43].",".$id[44].",".$id[45].",".$id[46].",".$id[47].",".$id[48].",".$id[49].",".$id[50].") values ('$isi1','$isi2','$isi3','$isi4','$isi5','$isi6','$isi7','$isi8','$isi9','$isi10','$isi11','$isi12','$isi13','$isi14','$isi15','$isi16','$isi17','$isi18','$isi19','$isi20','$isi21','$isi22','$isi23','$isi24','$isi25','$isi26','$isi27','$isi28','$isi29','$isi30','$isi31','$isi32','$isi33','$isi34','$isi35','$isi36','$isi37','$isi38','$isi39','$isi40','$isi41','$isi42','$isi43','$isi44','$isi45','$isi46','$isi47','$isi48','$isi49','$isi50','$isi51')");
							 if($inserv){
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }else{
								$isi =$id[0]."-> ".$isi1." | ".$isi2;
								$hasil=$this->request();
							 }	
						}
					}
		   }
		  if($hasil==0){$hasil='[ok]';}else{$hasil='[gagal]';}
		  $isi  =$this->titik($isi).$hasil;
		  $datx=array("isi"=>$isi,"baris"=>($baris+1),"pesan"=>'0');
          echo json_encode($datx);
		}else{
			 $isi  =$this->titik('Request Time out').$hasil;
			 $datx=array("isi"=>$isi,"pesan"=>'1');
			 echo json_encode($datx);
		}

	}






}
